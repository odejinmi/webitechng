<?php

namespace App\Http\Controllers\User;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Conversation;
use App\Models\Escrow;
use App\Models\EscrowCharge;
use App\Models\Message;
use App\Models\Transaction;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class EscrowController extends Controller {

    public function __construct()
    {
        $this->middleware('escrow.status');
        $this->middleware('kyc.status');
        $this->activeTemplate = activeTemplate();
    }

    public function welcome($type = null) {
        $pageTitle = 'My Escrow';
        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;
        $data['activeTemplateTrue'] = checkTemplate(true);

        return view($activeTemplate. 'user.vendor.escrow.welcome', $data,compact('pageTitle'));
    }


    public function index($type = null) {
        $pageTitle = 'My Escrow';
        $escrows   = Escrow::where(function ($query) {
            $query->orWhere('buyer_id', auth()->id())->orWhere('seller_id', auth()->id());
        })->with('seller', 'buyer');

        if ($type) {
            try {
                $escrows = $escrows->$type();
            } catch (Exception $e) {
                abort(404);
            }
        }

        $escrows = $escrows->orderBy('id', 'desc')->with('category')->paginate(getPaginate());
        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;
        $data['activeTemplateTrue'] = checkTemplate(true);

        return view($activeTemplate. 'user.vendor.escrow.index', $data,compact('pageTitle', 'escrows'));
    }

    public function stepOne() {
        $pageTitle = "New Escrow - Step One";
        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;
        $data['activeTemplateTrue'] = checkTemplate(true);

        return view($activeTemplate. 'user.vendor.escrow.step_one', $data, compact('pageTitle'));
    }

    public function submitStepOne(Request $request) {

        $request->validate([
            'type'        => 'required|in:1,2',
            'amount'      => 'required|numeric|gt:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $milestone = $request->milestone ? 1 : 0;

        $user = auth()->user();
        if ($request->type == 2)
        {
            if( $user->balance < $request->amount)
            {
                $notify[] = ['error', 'You do not have enough purchasing balance to put into escrow for this transaction'];
                return back()->withNotify($notify);
            }
        }

        $charge         = $this->getCharge($request->amount);
        $data           = $request->except('_token');
        $data['charge'] = $charge;
        $data['milestone'] = $milestone;
        session()->put('escrow_info', $data);


        return redirect()->route('user.escrow.step.two');
    }

    public function stepTwo() {
        $escrowInfo = session('escrow_info');
        $pageTitle  = "New Escrow - Step Two";

        $escrowInfo['charge'] = $this->getCharge($escrowInfo['amount']);

        if (!$escrowInfo) {
            $notify[] = ['error', 'Session invalidated'];
            return redirect()->route('user.escrow.step.one')->withNotify($notify);
        }

        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;
        $data['activeTemplateTrue'] = checkTemplate(true);

        return view($activeTemplate. 'user.vendor.escrow.step_two', $data,compact('pageTitle', 'escrowInfo'));
    }

    public function submitStepTwo(Request $request) {
        $request->validate([
            'email'        => 'required|max:40',
            'title'        => 'required|max:255',
            'details'      => 'required',
            'charge_payer' => 'required|in:1,2,3',
        ]);

        $this->checkSessionData($request->email);

        $escrowInfo   = session('escrow_info');
        $category_id  = $escrowInfo['category_id'];
        $user         = auth()->user();
        $toUser       = User::where('email', $request->email)->first();
        $amount       = $escrowInfo['amount'];
        $charge       = $this->getCharge($amount);

        $sellerCharge = 0;
        $buyerCharge  = 0;

        if ($request->charge_payer == 1) {
            $sellerCharge = $charge;
        } elseif ($request->charge_payer == 2) {
            $buyerCharge = $charge;
        } else {
            $sellerCharge = $charge / 2;
            $buyerCharge  = $charge / 2;
        }

        $escrow = new Escrow();

        if ($escrowInfo['type'] == 1) {
            $escrow->seller_id = $user->id;
            $escrow->buyer_id  = @$toUser->id ?? 0;

        } else {
            $escrow->buyer_id  = $user->id;
            $escrow->seller_id = @$toUser->id ?? 0;

            if( $user->balance < $amount)
            {
                $notify[] = ['error', 'You do not have enough balance to put into escrow for this transaction'];
                return back()->withNotify($notify);
            }

            if($escrowInfo['milestone'] != 1)
            {
                $user->balance -= $amount;
                $user->save();

                $transaction               = new Transaction();
                $transaction->user_id      = $user->id;
                $transaction->amount       = $amount;
                $transaction->post_balance = $user->balance;
                $transaction->charge       = 0;
                $transaction->trx_type     = '-';
                $transaction->remark       = "escrow_storage";
                $transaction->details      = 'Debited for escrow transaction safe';
                $transaction->trx          = getTrx();
                $transaction->save();
            }


        }

        $escrow->escrow_number = getTrx();
        $escrow->creator_id    = $user->id;
        $escrow->amount        = $amount;
        $escrow->charge_payer  = $request->charge_payer;
        $escrow->charge        = $charge;
        $escrow->buyer_charge  = $buyerCharge;
        $escrow->seller_charge = $sellerCharge;
        $escrow->milestone     = $escrowInfo['milestone'];
        $escrow->category_id   = $category_id;
        $escrow->title         = $request->title;
        $escrow->details       = $request->details;

        if (!$toUser) {
            $escrow->invitation_mail = $request->email;
        }

        $escrow->save();

        $conversation            = new Conversation();
        $conversation->escrow_id = $escrow->id;
        $conversation->buyer_id  = $escrow->buyer_id;
        $conversation->seller_id = $escrow->seller_id;
        $conversation->save();

        $message = 'Escrow created successfully';

        if (!$toUser) {
            $user = (object) [
                'fullname' => $request->email,
                'username' => $request->email,
                'email'    => $request->email,
                'mobile'    => $request->email,
                'sn'    => 0,
            ];

            notify($user, 'INVITATION_LINK', [
                'link' => route('user.register'),
            ]);

            $message = 'Escrow created and invitation link sent successfully';
        }

        session()->forget('escrow_info');
        $notify[] = ['success', $message];

        return redirect()->route('user.escrow.index')->withNotify($notify);
    }

    public function details($id) {
        $pageTitle    = "Escrow Details";
        $escrow       = Escrow::checkUser()->with('conversation.messages.sender', 'conversation.messages.admin')->findOrFail($id);
        $conversation = $escrow->conversation;
        $messages     = $conversation->messages;
        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;
        $data['activeTemplateTrue'] = checkTemplate(true);

        return view($activeTemplate. 'user.vendor.escrow.details', $data,compact('pageTitle', 'escrow', 'conversation', 'messages'));
    }

    public function replyMessage(Request $request) {

        $validate = Validator::make($request->all(), [
            'conversation_id' => 'required|exists:conversations,id',
            'message'         => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json(['error' => $validate->errors()]);
        }

        $conversation = Conversation::where('id', $request->conversation_id)->checkUser()->active()->first();

        if (!$conversation) {
            return response()->json(['error' => ['Conversation not found']]);
        }

        $message                  = new Message();
        $message->sender_id       = auth()->id();
        $message->conversation_id = $conversation->id;
        $message->message         = $request->message;
        $message->save();

        return [
            'created_diff' => $message->created_at->diffForHumans(),
            'created_time' => $message->created_at->format('h:i A'),
            'message'      => $message->message,
        ];
    }

    public function getMessages(Request $request) {
        $validate = Validator::make($request->all(), [
            'conversation_id' => 'required|exists:conversations,id',
        ]);

        if ($validate->fails()) {
            return response()->json(['error' => $validate->errors()]);
        }

        $conversation = Conversation::where('id', $request->conversation_id)->where(function ($query) {
            $query->orWhere('buyer_id', auth()->id())->orWhere('seller_id', auth()->id());
        })->first();

        if (!$conversation) {
            return response()->json(['error' => ['Conversation not found']]);
        }

        $escrow   = $conversation->escrow;
        $messages = Message::where('conversation_id', $conversation->id)->with('sender', 'admin')->get();
        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;
        $data['activeTemplateTrue'] = checkTemplate(true);

        return view($activeTemplate. 'user.vendor.escrow.message', $data,compact('messages', 'escrow'));
    }

    public function cancel($id) {
        $escrow = Escrow::checkUser()->notAccepted()->findOrFail($id);
        $escrow->status = Status::ESCROW_CANCELLED;
        $escrow->save();
        $user         = auth()->user();

        if ($escrow->buyer_id == auth()->id()) {
            $mailReceiver = $escrow->seller;
            $canceller    = 'buyer';

        } else {
            $mailReceiver = $escrow->buyer;
            $canceller    = 'seller';
        }
        if($escrow->milestone != 1)
            {
                $user->balance += $escrow->amount;
                $user->save();

                $transaction               = new Transaction();
                $transaction->user_id      = $user->id;
                $transaction->amount       = $escrow->amount;
                $transaction->post_balance = $user->balance;
                $transaction->charge       = 0;
                $transaction->trx_type     = '+';
                $transaction->remark       = "escrow_refund";
                $transaction->details      = 'Credited for escrow transaction cancel by seller';
                $transaction->trx          = getTrx();
                $transaction->save();
            }

        $conversation         = $escrow->conversation;
        $conversation->status = Status::CONVERSION_CLOSE;
        $conversation->save();

        if ($mailReceiver) {
            notify($mailReceiver, 'ESCROW_CANCELLED', [
                'title'      => $escrow->title,
                'amount'     => showAmount($escrow->amount),
                'canceller'  => $canceller,
                'total_fund' => $escrow->paid_amount,
                'currency'   => gs()->cur_text,
            ]);
        }

        $notify[] = ['success', 'Escrow cancelled successfully'];
        return back()->withNotify($notify);
    }

    public function accept($id) {

        $escrow = Escrow::checkUser()->where('creator_id', '!=', auth()->id())->notAccepted()->findOrFail($id);
        $escrow->status = Status::ESCROW_ACCEPTED;
        $escrow->save();

        if ($escrow->buyer_id = auth()->id()) {
            $mailReceiver = $escrow->seller;
            $accepter     = 'buyer';
        } else {
            $mailReceiver = $escrow->buyer;
            $accepter     = 'seller';
        }

        notify($mailReceiver, 'ESCROW_ACCEPTED', [
            'title'      => $escrow->title,
            'amount'     => showAmount($escrow->amount),
            'accepter'   => $accepter,
            'total_fund' => showAmount($escrow->paid_amount),
            'currency'   => gs()->cur_text,
        ]);

        $notify[] = ['success', 'Escrow accepted successfully'];
        return back()->withNotify($notify);
    }


    public function dispute(Request $request, $id) {
        $request->validate([
            'dispute_reason' => 'required|string',
        ]);

        $escrow = Escrow::checkUser()->accepted()->findOrFail($id);

        $escrow->status       = Status::ESCROW_DISPUTED;
        $escrow->disputer_id  = auth()->id();
        $escrow->dispute_note = $request->dispute_reason;
        $escrow->save();

        $conversation           = $escrow->conversation;
        $conversation->is_group = 1;
        $conversation->save();

        if ($escrow->buyer_id == auth()->id()) {
            $mailReceiver = $escrow->seller;
            $disputer     = 'buyer';
        } else {
            $mailReceiver = $escrow->buyer;
            $disputer     = 'seller';
        }

        notify($mailReceiver, 'ESCROW_DISPUTED', [
            'title'        => $escrow->title,
            'amount'       => showAmount($escrow->amount),
            'disputer'     => $disputer,
            'total_fund'   => showAmount($escrow->paid_amount),
            'dispute_note' => $request->details,
            'currency'     => gs()->cur_text,
        ]);

        $notify[] = ['success', 'Escrow disputed successfully'];
        return back()->withNotify($notify);
    }
    public function completeEscrow($id) {

        $escrow  = Escrow::where('seller_id', auth()->id())->accepted()->findOrFail($id);
        $escrow->completed = Status::ESCROW_COMPLETED;
        $escrow->save();
        $notify[] = ['success', 'Escrow marked as completed successfully'];
        return back()->withNotify($notify);
    }

    public function dispatchEscrow($id) {

        $escrow         = Escrow::where('buyer_id', auth()->id())->accepted()->findOrFail($id);

        if($escrow->completed != 1)
        {
            $notify[] = ['error', 'The other party needs to mark this transaction as completed before you can dispatch fund'];
            return back()->withNotify($notify);
        }
        $escrow->status = Status::ESCROW_COMPLETED;
        $escrow->save();

        $amount = $escrow->amount;
        $seller = $escrow->seller;
        $seller->balance += $amount;
        $seller->save();

        $trx                       = getTrx();
        $transaction               = new Transaction();
        $transaction->user_id      = $seller->id;
        $transaction->amount       = $amount;
        $transaction->post_balance = $seller->balance;
        $transaction->charge       = 0;
        $transaction->trx_type     = '+';
        $transaction->remark       = "escrow_payment_dispatched";
        $transaction->details      = 'Escrow payment dispatched';
        $transaction->trx          = $trx;
        $transaction->save();

        if ($escrow->seller_charge) {
            $seller->balance -= $escrow->seller_charge;
            $seller->save();

            $transaction               = new Transaction();
            $transaction->user_id      = $seller->id;
            $transaction->amount       = $escrow->seller_charge;
            $transaction->post_balance = $seller->balance;
            $transaction->charge       = 0;
            $transaction->trx_type     = '-';
            $transaction->remark       = "escrow_charge";
            $transaction->details      = 'Deducted as escrow charge';
            $transaction->trx          = $trx;
            $transaction->save();
        }

        notify($seller, 'ESCROW_PAYMENT_DISPATCHED', [
            'title'         => $escrow->title,
            'amount'        => showAmount($escrow->amount),
            'charge'        => showAmount($escrow->charge),
            'seller_charge' => showAmount($escrow->seller_charge),
            'trx'           => $trx,
            'post_balance'  => showAmount($seller->balance),
            'currency'      => gs()->cur_text,
        ]);

        $notify[] = ['success', 'Escrow payment dispatched successfully'];
        return back()->withNotify($notify);
    }


    private function checkSessionData($email) {
        $user       = auth()->user();
        $escrowInfo = session('escrow_info');

        if (!$escrowInfo) {
            throw ValidationException::withMessages(['error' => 'Session invalidated']);
        }

        if ($user->email == $email) {
            throw ValidationException::withMessages(['error' => 'You can not create escrow with yourself']);
        }

        $category = Category::active()->where('id', $escrowInfo['category_id'])->first();

        if (!$category) {
            throw ValidationException::withMessages(['error' => 'Invalid escrow type']);
        }
    }

    private function getCharge($amount) {
        $general       = gs();
        $percentCharge = $general->percent_charge;
        $fixedCharge   = $general->fixed_charge;
        $escrowCharge  = EscrowCharge::where('minimum', '<=', $amount)->where('maximum', '>=', $amount)->first();

        if ($escrowCharge) {
            $percentCharge = $escrowCharge->percent_charge;
            $fixedCharge   = $escrowCharge->fixed_charge;
        }

        $charge = $amount * $percentCharge / 100 + $fixedCharge;

        if ($charge && $charge > $general->charge_cap && $general->charge_cap != 0) {
            $charge = $general->charge_cap;
        }

        return $charge;
    }
}

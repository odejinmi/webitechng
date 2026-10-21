<?php

namespace App\Http\Controllers\User;

use App\Models\ChargesLimit;
use App\Models\Cryptocurrency;
use App\Models\Cryptowallet;
use App\Models\Cryptotrx;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Services\PayVesselService;
use App\Services\WalletLedgerService;
use RuntimeException;

class BankTransferController extends Controller
{

	public function __construct()
    {
        $this->middleware('kyc.status');
        $this->activeTemplate = activeTemplate();
    }

	public function index()
	{
            $pageTitle = 'Bank Transfer';
        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;
        $data['activeTemplateTrue'] = checkTemplate(true);

        return view($activeTemplate.'user.bank.index', $data, compact('pageTitle'));
	}

	public function start()
	{
		$general = gs();
		if ($general->transfer_provider === 'PAYVESSEL') {
            try {
                $reply = app(PayVesselService::class)->banks();
                $bankList = $reply['data']['banks'] ?? $reply['data']['bank_list'] ?? $reply['data'] ?? [];
                $banks = collect($bankList)->map(function ($bank) {
                    return [
                        'bankCode' => $bank['bank_code'] ?? $bank['bankCode'] ?? $bank['code'] ?? '',
                        'bankName' => $bank['bank_name'] ?? $bank['bankName'] ?? $bank['name'] ?? '',
                    ];
                })->filter(fn ($bank) => $bank['bankCode'] && $bank['bankName'])->values()->all();

                return $this->payVesselTransferView($banks);
            } catch (RuntimeException $exception) {
                $notify[] = ['error', $exception->getMessage()];
                return back()->withNotify($notify);
            }
        }
		/*
		if($general->transfer_provider == "MONNIFY")
        {
            $pageTitle = 'Bank Transfer';
            $banks = json_decode(file_get_contents(resource_path('views/partials/banks.json')), true);
			$activeTemplate = checkTemplate();
            $data['activeTemplate'] = $activeTemplate;
            $data['activeTemplateTrue'] = checkTemplate(true);
            return view($activeTemplate.'user.bank.monnify', $data, compact('pageTitle', 'banks'));
        }

		if($general->transfer_provider == "BLOCHQ")
        {
            $pageTitle = 'Bank Transfer';
            $banks = json_decode(file_get_contents(resource_path('views/partials/bhqbanks.json')), true);
			$activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;
        $data['activeTemplateTrue'] = checkTemplate(true);

        return view($activeTemplate.'user.bank.blochq', $data, compact('pageTitle', 'banks'));
        }
        */


		$user = Auth::user();
		$pageTitle = 'Bank Transfer';
		$curl = curl_init();
        $publicKey = env('STROPAYKEY'); // Fetch API key from environment variables
        $url = "https://strowallet.com/api/banks/lists?public_key=" . urlencode($publicKey); // Append public key as a query parameter

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
            ),
        ));
		$response = curl_exec($curl);
        $error = curl_error($curl);
		curl_close($curl);
		$reply = json_decode($response, true);
		if(!isset($reply['data']['bank_list']))
		{
            $notify[] = ['error', 'Error fetching bank list!'];
            return back()->withNotify($notify);
		}
		$banks = $reply['data']['bank_list'];
		$activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;
        $data['activeTemplateTrue'] = checkTemplate(true);
        $transactions = Transaction::where('user_id', auth()->id())->searchable(['trx'])->filter(['trx_type', 'remark'])->whereRemark('Bank Transfer')->orderBy('created_at', 'desc')->paginate(getPaginate());
        $data["totaltransfer"] = Transaction::where('user_id', auth()->id())
            ->whereRemark('Bank Transfer')
            ->sum('amount');
        $data["totaltransfercount"] = $transactions->count();
        $data["transferlog"] = $transactions;
        $data["yearTf"] = Transaction::where('user_id', auth()->id())
            ->selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year'); // Get only the list of years
        return view($activeTemplate.'user.bank.strowallet', $data, compact('pageTitle', 'user', 'banks'));
	}

    private function payVesselTransferView(array $banks)
    {
        $user = Auth::user();
        $pageTitle = 'Bank Transfer';
        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;
        $data['activeTemplateTrue'] = checkTemplate(true);
        $transactions = Transaction::where('user_id', auth()->id())->searchable(['trx'])->filter(['trx_type', 'remark'])->whereRemark('Bank Transfer')->orderBy('created_at', 'desc')->paginate(getPaginate());
        $data['totaltransfer'] = Transaction::where('user_id', auth()->id())->whereRemark('Bank Transfer')->sum('amount');
        $data['totaltransfercount'] = $transactions->count();
        $data['transferlog'] = $transactions;
        $data['yearTf'] = Transaction::where('user_id', auth()->id())->selectRaw('YEAR(created_at) as year')->distinct()->orderBy('year', 'desc')->pluck('year');

        return view($activeTemplate.'user.bank.strowallet', $data, compact('pageTitle', 'user', 'banks'));
    }

    /**
     * API Endpoint to fetch the list of available banks
     */
    public function getBankList()
    {
        if (gs()->transfer_provider === 'PAYVESSEL') {
            try {
                $reply = app(PayVesselService::class)->banks();
                $bankList = $reply['data']['banks'] ?? $reply['data']['bank_list'] ?? $reply['data'] ?? [];
                $banks = collect($bankList)->map(function ($bank) {
                    return [
                        'bankCode' => $bank['bank_code'] ?? $bank['bankCode'] ?? $bank['code'] ?? '',
                        'bankName' => $bank['bank_name'] ?? $bank['bankName'] ?? $bank['name'] ?? '',
                    ];
                })->filter(fn ($bank) => $bank['bankCode'] && $bank['bankName'])->values()->all();

                return response()->json([
                    'code' => 200,
                    'status' => 'ok',
                    'message' => 'Bank list retrieved successfully.',
                    'data' => ['banks' => $banks],
                ]);
            } catch (RuntimeException $exception) {
                return response()->json(['code' => 400, 'status' => 'error', 'message' => $exception->getMessage()], 400);
            }
        }

        try {
            $publicKey = env('STROPAYKEY');
            $url = "https://strowallet.com/api/banks/lists?public_key=" . urlencode($publicKey);

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_SSL_VERIFYPEER => true,
                CURLOPT_SSL_VERIFYHOST => 2,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                ),
            ));

            $response = curl_exec($curl);
            $error = curl_error($curl);
            curl_close($curl);

            if ($error) {
                return response()->json([
                    'code' => 500,
                    'status' => 'error',
                    'message' => 'Failed to connect to the bank provider.',
                ], 500);
            }

            $reply = json_decode($response, true);

            if(!isset($reply['data']['bank_list'])) {
                return response()->json([
                    'code' => 404,
                    'status' => 'error',
                    'message' => 'Bank list is currently unavailable.',
                ], 404);
            }

            return response()->json([
                'code' => 200,
                'status' => 'ok',
                'message' => 'Bank list retrieved successfully.',
                'data' => [
                    'banks' => $reply['data']['bank_list']
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'status' => 'error',
                'message' => 'An error occurred while fetching the bank list.',
            ], 500);
        }
    }

	public function validatebankstrowallet(Request $request)
	{
		if (gs()->transfer_provider === 'PAYVESSEL') {
            try {
                $reply = app(PayVesselService::class)->validateAccount(
                    (string) $request->input('account'),
                    (string) $request->input('bankcode')
                );
                $account = $reply['data'] ?? [];
                $accountName = $account['account_name'] ?? $account['accountName'] ?? null;

                if (!$accountName) {
                    throw new RuntimeException($reply['message'] ?? 'Unable to resolve account name.');
                }

                return response()->json([
                    'ok' => true,
                    'code' => 200,
                    'status' => 'success',
                    'message' => $accountName,
                    'sessionId' => $account['session_id'] ?? $account['sessionId'] ?? null,
                    'data' => $account,
                ]);
            } catch (RuntimeException $exception) {
                return response()->json(['ok' => false, 'status' => 'danger', 'message' => $exception->getMessage()], 400);
            }
        }

		$user = auth()->user();
		$json = file_get_contents('php://input');
		$input = json_decode($json, true);
		try{
            $bankcode = urlencode($input['bankcode']); // Encode for URL safety
            $account = urlencode($input['account']);
            $publicKey = urlencode(env('STROPAYKEY'));

            // Construct GET URL with query parameters
            $url = "https://strowallet.com/api/banks/get-customer-name?public_key={$publicKey}&bank_code={$bankcode}&account_number={$account}";

            // cURL Request
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_SSL_VERIFYPEER => true, // Ignore SSL verification (not recommended for production)
                CURLOPT_SSL_VERIFYHOST => 2,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json',
                    'Accept: application/json',
                ],
            ]);

            $response = curl_exec($curl);
            $error = curl_error($curl);
            curl_close($curl);
		$reply = json_decode($response,true);
			if(!isset($reply['data']['account_name']))
			{
				return response()->json([
                    'code' => 400,
                    'status' => 'error',
                    'message' => 'Error, ' . ($reply['message'] ?? 'Unable to resolve account name')
                ], 400);
			}
			if($reply['data']['account_name'])
			{
				return response()->json([
                    'code' => 200,
                    'status' => 'ok',
                    'message' => 'Account resolved successfully',
                    'data' => [
                        'account_name' => $reply['data']['account_name'],
                        'sessionId' => $reply['data']['sessionId'] ?? null,
                    ]
                ], 200);
			}
		}
		catch (\Exception $e) {
			return response()->json([
                'code' => 400,
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
		}

	}

	public function banktransferStrowallet()
	{
		$user = auth()->user();
		$json = file_get_contents('php://input');
		$input = json_decode($json, true);
		if (gs()->transfer_provider === 'PAYVESSEL') {
            return $this->banktransferPayVessel($input ?: []);
        }
		try{
		$bankcode = $input['bankcode'];
		$account = $input['account'];
		$account_name = $input['account_name'];
		$bank_name = $input['bank_name'];
		$amount = $input['amount'];
		$sessionId = $input['sessionId'];
		$wallet = $input['wallet'];
        $narration = !empty($input['narration']) ? $input['narration'] : 'transfer';
        $pin = $input['pin'];
		if (!Hash::check($pin, $user->trx_password))
		{
			return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Invalid transaction PIN'],400);
		}

            if ($amount > 50000)
            {
                return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Amount can not be greater than 50,000'],400);
            }

            $today = Carbon::today(); // start of day
            $tomorrow = Carbon::tomorrow(); // end of day

// Get today's bank transfer transactions for the user
            $transactions = Transaction::where('user_id', $user->id)
                ->where('remark', 'Bank Transfer')
                ->whereBetween('created_at', [$today, $tomorrow])
                ->get();
// Calculate total and max
            $totalAmount = $transactions->sum('amount');
            $maxAmount   = $transactions->max('amount');

            if ($totalAmount > 200000) {
                return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Daily limit exceeded'],400);
            }
		// $fee = ($amount / 100) * env('TRANSFERFEE');
		$fee = env('TRANSFERFEE');
		$total = $amount + $fee;
		if ($total > $user->balance && $wallet == 'main') {
			return response()->json(['ok'=>false,'status'=>'danger','message'=> 'You do not have sufficient balance in your main wallet for this transfer.'],400);
		}
		if ($total > $user->ref_balance && $wallet == 'ref') {
			return response()->json(['ok'=>false,'status'=>'danger','message'=> 'You do not have sufficient balance in your referral wallet for this transfer.'],400);
		}
		$curl = curl_init();
		$code = getTrx();
		if($wallet == 'main')
		{
			$user->balance -= $total;
			$user->save();
			$balance = $user->balance;
		}
			if($wallet == 'ref')
		{
			$user->ref_balance -= $total;
			$user->save();
			$balance = $user->ref_balance;
		}
		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://strowallet.com/api/banks/request',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_SSL_VERIFYHOST => 2,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS =>'{
			"public_key": "'.env('STROPAYKEY').'",
			"bank_code":"'.$bankcode.'",
			"amount":"'.$amount.'",
			"narration":"'.$narration.'",
			"name_enquiry_reference":"'.$sessionId.'",
			"account_number":"'.$account.'"
		}',
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json',
		),
		));
		$response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);
		$reply = json_decode($response,true);
		//return $reply;
			if(!isset($reply['success']))
			{
				// START RETURN MONEY TO USER PROCESS
				if($wallet == 'main')
				{
					$user->balance += $total;
					$user->save();
					$balance = $user->balance;
				}
				if($wallet == 'ref')
				{
					$user->ref_balance += $total;
					$user->save();
					$balance = $user->ref_balance;
				}
				// END RETURN MONEY TO USER PROCESS
				return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Error,'.@json_encode($reply['message'])],400);
			}
			if($reply['success'] != true)
			{
				// START RETURN MONEY TO USER PROCESS
				if($wallet == 'main')
				{
					$user->balance += $total;
					$user->save();
					$balance = $user->balance;
				}
				if($wallet == 'ref')
				{
					$user->ref_balance += $total;
					$user->save();
					$balance = $user->ref_balance;
				}
				// END RETURN MONEY TO USER PROCESS
				return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Error,'.@json_encode($reply['message'])],400);
			}
			if($reply['success'] = true)
			{

				$transaction               = new Transaction();
				$transaction->user_id      = $user->id;
				$transaction->amount       = $amount;
				$transaction->charge       = $fee;
				$transaction->post_balance = $balance;
				$transaction->trx_type     = '-';
				$transaction->details      = $narration;
				$transaction->trx          = $code;
				$transaction->val_1        = [
					'bank' => json_encode($bank_name),
					'account_name'   => json_encode($account_name),
					'account_number'     => json_encode($account),
				];

				// @$transaction->val_1        = @$bank_name.' '.@$account_name.' '.@$account;
				$transaction->remark       = 'Bank Transfer';
				$transaction->save();
				return response()->json(['ok'=>true,'status'=>'success','message'=> 'Transaction Successful','content'=> ''],200);
			}
		}
		catch (\Exception $e) {
			return response()->json(['ok'=>false,'status'=>'danger','message'=> $e->getMessage()],400);
		}


	}
    private function banktransferPayVessel(array $input)
    {
        $validator = Validator::make($input, [
            'bankcode' => 'required|string',
            'account' => 'required|string',
            'account_name' => 'required|string',
            'bank_name' => 'required|string',
            'amount' => 'required|numeric|min:1|max:50000',
            'wallet' => 'required|in:main,ref',
            'pin' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['ok' => false, 'status' => 'danger', 'message' => $validator->errors()->first()], 400);
        }

        $user = auth()->user();
        if (!Hash::check($input['pin'], $user->trx_password)) {
            return response()->json(['ok' => false, 'status' => 'danger', 'message' => 'Invalid transaction PIN'], 400);
        }

        $amount = (float) $input['amount'];
        $todayTotal = Transaction::where('user_id', $user->id)
            ->where('remark', 'Bank Transfer')
            ->whereBetween('created_at', [Carbon::today(), Carbon::tomorrow()])
            ->sum('amount');

        if (($todayTotal + $amount) > 200000) {
            return response()->json(['ok' => false, 'status' => 'danger', 'message' => 'Daily limit exceeded'], 400);
        }

        $fee = (float) env('TRANSFERFEE', 0);
        $total = $amount + $fee;
        $reference = getTrx();
        $narration = !empty($input['narration']) ? $input['narration'] : 'transfer';
        $ledger = app(WalletLedgerService::class);
        $debit = null;

        try {
            $debit = $ledger->debit($user->id, $input['wallet'], $total, function ($lockedUser, $balanceBefore, $balanceAfter) use ($amount, $fee, $reference, $narration, $input) {
                $transaction = new Transaction();
                $transaction->user_id = $lockedUser->id;
                $transaction->amount = $amount;
                $transaction->charge = $fee;
                $transaction->post_balance = $balanceAfter;
                $transaction->trx_type = '-';
                $transaction->details = $narration;
                $transaction->trx = $reference;
                $transaction->val_1 = [
                    'bank' => $input['bank_name'],
                    'account_name' => $input['account_name'],
                    'account_number' => $input['account'],
                ];
                $transaction->remark = 'Bank Transfer';
                $transaction->save();
            });

            $reply = app(PayVesselService::class)->transfer([
                'amount' => number_format($amount, 2, '.', ''),
                'account_number' => $input['account'],
                'bank_code' => $input['bankcode'],
                'account_name' => $input['account_name'],
                'narration' => $narration,
                'reference' => $reference,
            ]);

            return response()->json(['ok' => true, 'status' => 'success', 'message' => $reply['message'] ?? 'Transaction Successful', 'data' => $reply['data'] ?? null]);
        } catch (RuntimeException $exception) {
            if ($debit) {
                $ledger->credit($user->id, $input['wallet'], $total, function ($lockedUser, $balanceBefore, $balanceAfter) use ($amount, $reference) {
                    $transaction = new Transaction();
                    $transaction->user_id = $lockedUser->id;
                    $transaction->amount = $amount;
                    $transaction->charge = 0;
                    $transaction->post_balance = $balanceAfter;
                    $transaction->trx_type = '+';
                    $transaction->details = 'PayVessel bank transfer reversal';
                    $transaction->trx = $reference;
                    $transaction->remark = 'Bank Transfer Refund';
                    $transaction->save();
                });
            }

            return response()->json(['ok' => false, 'status' => 'danger', 'message' => $exception->getMessage()], 400);
        }
    }

	public function validatebankmonnify()
	{
        $token = monnifyToken();
		$user = auth()->user();
		$json = file_get_contents('php://input');
		$input = json_decode($json, true);
		$bank = $input['bankcode'];
		$account = $input['account'];
		try{
			$url = "https://monnify.com/api/v1/disbursements/account/validate?accountNumber=".$account."&bankCode=".$bank;
			if(env('MONIFYSTATUS') == 'TEST')
			{
			$url = "https://sandbox.monnify.com/api/v1/disbursements/account/validate?accountNumber=".$account."&bankCode=".$bank;
			}
			$curl = curl_init();
			curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$token.'',
                'Content-Type: application/json'
                ),
			));
			$response = curl_exec($curl);
			$reply = json_decode($response,true);
			curl_close($curl);
			// return $response;
			if(!isset($reply['responseBody']['accountName']))
			{
				return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Error!!!! ,'.@$reply['responseMessage']],400);
			}
			if($reply['responseBody']['accountName'])
			{
				return response()->json(['ok'=>true,'status'=>'success','message'=> $reply['responseBody']['accountName']],200);
			}
		}
		catch (\Exception $e) {
			return response()->json(['ok'=>false,'status'=>'danger','message'=> $e->getMessage()],400);
		}

	}

    public function banktransfernubanMonnify()
    {
        $token = monnifyToken();
        $user = auth()->user();
		$json = file_get_contents('php://input');
		try{
        	$input = json_decode($json, true);
			$bankcode = $input['bankcode'];
			$account = $input['account'];
			$amount = $input['amount'];
			$wallet = $input['wallet'];
			$narration = $input['narration'];
			$account_name = $input['account_name'];
			$bank_name = $input['bank_name'];
			$pin = $input['pin'];
			if (!Hash::check($pin, $user->trx_password))
			{
				return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Invalid transaction PIN'],400);
			}
			//$fee = ($amount / 100) * env('TRANSFERFEE');
			$fee = env('TRANSFERFEE');

			$total = $amount + $fee;
			if ($total > $user->balance && $wallet == 'main') {
				return response()->json(['ok'=>false,'status'=>'danger','message'=> 'You do not have sufficient balance in your main wallet for this transfer.'],400);
			}
			if ($total > $user->ref_balance && $wallet == 'ref') {
				return response()->json(['ok'=>false,'status'=>'danger','message'=> 'You do not have sufficient balance in your referral wallet for this transfer.'],400);
			}

        $code = getTrx();
        $token = monnifyToken();
        $url = "https://monnify.com/api/v2/disbursements/single";
        if(env('MONIFYSTATUS') == 'TEST')
        {
            $url = "https://sandbox.monnify.com/api/v2/disbursements/single";
        }
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "amount": "'.$amount.'",
            "reference": "'.$code.'",
            "narration": "'.$narration.'",
            "destinationBankCode": "'.$bankcode.'",
            "destinationAccountNumber": "'.$account.'",
            "currency": "NGN",
            "sourceAccountNumber": "'.env('MONIFYSOURCEACCOUNT').'"
        }',
        CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer '.$token.'',
        'Content-Type: application/json'
        ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $reply = json_decode($response,true);
        if(!isset($reply['responseBody']))
        {
			return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Error '.@$reply['responseMessage']],400);
        }
        if($reply['requestSuccessful'] != true)
        {
			return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Error '.@$reply['responseMessage']],400);
        }
        if($reply['requestSuccessful'] = true)
        {

            if($wallet == 'main')
				{
					$user->balance -= $total;
					$user->save();
					$balance = $user->balance;
				}
				if($wallet == 'ref')
				{
					$user->ref_balance -= $total;
					$user->save();
					$balance = $user->ref_balance;
				}

				$transaction               = new Transaction();
				$transaction->user_id      = $user->id;
				$transaction->amount       = $amount;
				$transaction->charge       = $fee;
				$transaction->post_balance = $balance;
				$transaction->trx_type     = '-';
				$transaction->details      = $narration;
				$transaction->val_1        = [
					'bank' => $bank_name,
					'account_name'   => $account_name,
					'account_number'     => $account,
				];
				$transaction->trx          = $code;
				$transaction->remark       = 'Bank Transfer';
				$transaction->save();
				return response()->json(['ok'=>true,'status'=>'success','message'=> 'Transaction Successful','content'=> json_encode($reply)],200);
        }
	}
		catch (\Exception $e) {
			return response()->json(['ok'=>false,'status'=>'danger','message'=> $e->getMessage()],400);
		}

    }

	public function validatebankblochq(Request $request)
	{
		$user = auth()->user();
		$json = file_get_contents('php://input');
		$input = json_decode($json, true);
// 		$bank = $input['bankcode'];
// 		$account = $input['account'];
		$bank = $request->bankcode;
		$account = $request->account;
		try{
			$url = "https://api.blochq.io/v1/resolve-account?account_number=".$account."&bank_code=".$bank;
			$curl = curl_init();
			curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.env('VIRTUALCARDSK'),
                'Content-Type: application/json'
                ),
			));
			$response = curl_exec($curl);
			$reply = json_decode($response,true);
			curl_close($curl);
			// return $response;
			if(!isset($reply['data']['account_name']))
			{
				return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Error!!!! ,'.@$reply['message']],400);
			}
			if($reply['data']['account_name'])
			{
				return response()->json(['ok'=>true,'status'=>'success','message'=> $reply['data']['account_name']],200);
			}
		}
		catch (\Exception $e) {
			return response()->json(['ok'=>false,'status'=>'danger','message'=> $e->getMessage()],400);
		}

	}

	public function banktransfernubanBlochq()
    {
        $user = auth()->user();
		$json = file_get_contents('php://input');
		try{
        	$input = json_decode($json, true);
			$bankcode = $input['bankcode'];
			$account = $input['account'];
			$amount = $input['amount'];
			$wallet = $input['wallet'];
			$narration = $input['narration'];
			$account_name = $input['account_name'];
			$bank_name = $input['bank_name'];
			$pin = $input['pin'];
			if (!Hash::check($pin, $user->trx_password))
			{
				return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Invalid transaction PIN'],400);
			}
			//$fee = ($amount / 100) * env('TRANSFERFEE');
			$fee = env('TRANSFERFEE');

			$total = $amount + $fee;
			if ($total > $user->balance && $wallet == 'main') {
				return response()->json(['ok'=>false,'status'=>'danger','message'=> 'You do not have sufficient balance in your main wallet for this transfer.'],400);
			}
			if ($total > $user->ref_balance && $wallet == 'ref') {
				return response()->json(['ok'=>false,'status'=>'danger','message'=> 'You do not have sufficient balance in your referral wallet for this transfer.'],400);
			}

        $code = getTrx();
		$send = $amount*100;
        $url = "https://api.blochq.io/v1/transfers";
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "amount": '.$send.',
            "reference": "'.$code.'",
            "narration": "'.$narration.'",
            "bank_code": "'.$bankcode.'",
            "account_number": "'.$account.'",
            "account_id": "'.env('VIRTUALCARD_ACCOUNTID').'"
        }',
        CURLOPT_HTTPHEADER => array(
			'Authorization: Bearer '.env('VIRTUALCARDSK'),
			'Content-Type: application/json'
        ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $reply = json_decode($response,true);
        if(!isset($reply['success']))
        {
			return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Error '.@json_encode($response)],400);
        }
        if($reply['success'] != true)
        {
			return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Error '.@$reply['message']],400);
        }
        if($reply['success'] = true)
        {

            if($wallet == 'main')
				{
					$user->balance -= $total;
					$user->save();
					$balance = $user->balance;
				}
				if($wallet == 'ref')
				{
					$user->ref_balance -= $total;
					$user->save();
					$balance = $user->ref_balance;
				}

				$transaction               = new Transaction();
				$transaction->user_id      = $user->id;
				$transaction->amount       = $amount;
				$transaction->charge       = $fee;
				$transaction->post_balance = $balance;
				$transaction->trx_type     = '-';
				$transaction->details      = $narration;
				$transaction->val_1        = [
					'bank' => $bank_name,
					'account_name'   => $account_name,
					'account_number'     => $account,
				];
				$transaction->trx          = $code;
				$transaction->remark       = 'Bank Transfer';
				$transaction->save();
				return response()->json(['ok'=>true,'status'=>'success','message'=> 'Transaction Successful. '.@strToUpper($reply['message']),'content'=> json_encode($reply)],200);
        }
	}
		catch (\Exception $e) {
			return response()->json(['ok'=>false,'status'=>'danger','message'=> $e->getMessage()],400);
		}

    }

	public function history(Request $request)
    {
        $pageTitle    = 'Bank Transfer Log';
        $remarks      = Transaction::distinct('remark')->orderBy('remark')->get('remark');
        $transactions = Transaction::where('user_id', auth()->id())->searchable(['trx'])->filter(['trx_type', 'remark'])->whereRemark('Bank Transfer')->orderBy('created_at', 'desc')->paginate(getPaginate());
        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;
        $data['activeTemplateTrue'] = checkTemplate(true);

        return view($activeTemplate. 'user.bank.history', $data, compact('pageTitle', 'transactions', 'remarks'));
    }


}

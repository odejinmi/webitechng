<?php

namespace App\Http\Controllers;
session_start();
use App\Constants\Status;
use App\Models\AdminNotification;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\Transaction; 
use App\Models\User; 
use App\Models\Admin;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class ApiMerchantController extends Controller
{
    public function networks(Request $request)
    {
        try { 
            
            $token = getBearerToken();
            if($token->ok != true)
            {
                return response()->json(
                    [
                        'status' => false,
                        'message' => $token->message,
                    ],
                    400
                );
            }

            if(gs()->internet_api_sme_provider == 'N3TDATA' || gs()->internet_api_sme_provider == 'GSUBZ')
            {
                $network['1'] = 'MTN';
                $network['2'] = 'Airtel';
                $network['3'] = 'Glo';
                $network['4'] = '9Mobile'; 
                    return response()->json(
                        [
                            'status' => true,
                            'message' => 'Network Populated',
                            'data' => $network,
                        ],
                        200
                    );
            }
            
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://simhosting.ogdams.ng/api/v1/get/networks/id',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.env('SIM_HOST_KEY').''
            ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            $reply = json_decode($response,true);
            if(!isset($reply['data']['msg']))
            {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'Error fetching network',
                    ],
                    400
                ); 
            }
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Network Populated',
                    'data' => $reply['data']['msg'],
                ],
                200
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'status' => false,
                    'message' => $th->getMessage(),
                ],
                400
            );
        }
    }

    public function dataplans()
    {
        if(gs()->internet_api_sme_provider == 'N3TDATA')
        {
            return $this->N3TDATAPLANS();
        }
        if(gs()->internet_api_sme_provider == 'GSUBZ')
        {
            return $this->GSUBZPLANS();
        }
        if(gs()->internet_api_sme_provider == 'SIMHOSTING')
        {
            return $this->SIMHOSTINGPLAN();
        }
    }

    public function SIMHOSTINGPLAN($networkid = 0, $planid = 0)
    {
        try {
            $token = getBearerToken();
            if($token->ok != true)
            {
                return response()->json(
                    [
                        'status' => false,
                        'message' => $token->message,
                    ],
                    400
                );
            }
            if(request()->NetworkId)
            {
                if(request()->NetworkId > 4)
                {
                    return response()->json(
                        [
                            'status' => false,
                            'message' => 'Invalid Network ID Provided',
                        ],
                        400
                    ); 
                }
            }
            
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://simhosting.ogdams.ng/api/v2/get/data/plans',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.env('SIM_HOST_KEY').''
            ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            $reply = json_decode($response,true);
            if(!isset($reply['data']))
            {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'Error fetching network',
                    ],
                    400
                ); 
            }
            $plans = $reply['data'];
            //START GET DATA PLAN BY NETWORK ID AND PLAN ID\\
            if($networkid > 0 && $planid > 0)
            { 
                foreach($plans as $data)
                {
                    $dataplans = $plans[$networkid];
                    {
                        foreach($dataplans as $datas)
                        {
                            if($datas['planId'] == $planid )
                            {
                                return $datas;
                            }
                        }
                    }
                }
            }
            //END DATA PLAN BY NETWORK ID AND PLAN ID\\

            if(request()->NetworkId)
            { 
                $plans = $plans[request()->NetworkId];
            }
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Plans Fetched',
                    'data' => $plans,
                ],
                200
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'status' => false,
                    'message' => $th->getMessage(),
                ],
                400
            );
        }
    }

    public function N3TDATAPLANS($planid=0)
    {
        try {
            $token = getBearerToken();;
            if($token->ok != true)
            {
                return response()->json(
                    [
                        'status' => false,
                        'message' => $token->message,
                    ],
                    400
                );
            }
            if(request()->NetworkId)
            {
                if(request()->NetworkId > 4)
                {
                    return response()->json(
                        [
                            'status' => false,
                            'message' => 'Invalid Network ID Provided',
                        ],
                        400
                    ); 
                }
            }
            
            $plans = json_decode(file_get_contents(resource_path('views/partials/APIn3tdata.json')));
            if(request()->NetworkId)
            { 
                $networkID=request()->NetworkId;
                $plans = $plans->$networkID;
            }
            //START GET DATA PLAN BY NETWORK ID AND PLAN ID\\
            if($planid > 0)
            { 
                foreach($plans as $data)
                {
                    if($data->plan_id == $planid )
                    {
                        return $data;
                    }
                }
            }
            //END DATA PLAN BY NETWORK ID AND PLAN ID\\
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Plans Fetched',
                    'data' => $plans,
                ],
                200
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'status' => false,
                    'message' => $th->getMessage(),
                ],
                400
            );
        }
    }

    public function GSUBZPLANS($networkidd = 0, $planid = 0)
    {
        try {
            $token = getBearerToken();
            if($token->ok != true)
            {
                return response()->json(
                    [
                        'status' => false,
                        'message' => $token->message,
                    ],
                    400
                );
            }
            if(request()->NetworkId)
            {
                if(request()->NetworkId > 4)
                {
                    return response()->json(
                        [
                            'status' => false,
                            'message' => 'Invalid Network ID Provided',
                        ],
                        400
                    ); 
                }
            }
            $plans = json_decode(file_get_contents(resource_path('views/partials/APIgsubzdata.json')));
            if(request()->NetworkId)
            { 
                $networkID=request()->NetworkId;
                $plans = $plans->$networkID;
            }
            //START GET DATA PLAN BY NETWORK ID AND PLAN ID\\
           // return $plans->$networkidd;
            if($networkidd > 0 && $planid > 0)
            { 
                foreach($plans as $data)
                {
                    $dataplans = $plans->$networkidd;
                    {
                        foreach($dataplans as $datas)
                        {
                            if($datas->plan_id == $planid )
                            {
                                return $datas;
                            }
                        }
                    }
                }
            }
            //END DATA PLAN BY NETWORK ID AND PLAN ID\\
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Plans Fetched',
                    'data' => $plans,
                ],
                200
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'status' => false,
                    'message' => $th->getMessage(),
                ],
                400
            );
        }
    }

    public function dataplanBuy()
    {
        try {

            $token = getBearerToken();
            if($token->ok != true)
            {
                return response()->json(
                    [
                        'status' => false,
                        'message' => $token->message,
                    ],
                    400
                );
            }
            $user = $token->user; 
            $json = file_get_contents('php://input');
            $input = json_decode($json, true); 
            if(gs()->internet_api_sme_provider == 'N3TDATA')
            {
                return $this->BUYN3TDATAPLAN($input,$user);
            }
            if(gs()->internet_api_sme_provider == 'GSUBZ')
            {
                return $this->BUYGSUBZPLAN($input,$user);
            }
            if(gs()->internet_api_sme_provider == 'SIMHOSTING')
            {
                return $this->BUYSIMHOSTINGPLAN($input,$user);
            }
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'status' => false,
                    'message' => $th->getMessage(),
                ],
                400
            );
        }
    }

    public function BUYSIMHOSTINGPLAN($input,$user)
    {
        try { 
            $plan = $this->SIMHOSTINGPLAN($input['networkId'],$input['planId']);
            if($user->balance < $plan['price'])
            {
                return response()->json(['ok'=>false,'message'=> 'Insufficient merchant balance'],400);
            }
            $code = getTrx();
            $url = 'https://simhosting.ogdams.ng/api/v1/vend/data';
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
            $headers = array(
            "Authorization: Bearer ".env('SIM_HOST_KEY')."",
            "Content-Type: application/json",
            );
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            $code = getTrx();
            $networkId = $input['networkId'];
            $phoneNumber = $input['phoneNumber'];
            $planId = $input['planId'];
            $data = <<<DATA
            {
                "networkId": "$networkId",
                "planId": "$planId",
                "phoneNumber": "$phoneNumber",
                "reference": "$code"
            }
            DATA;
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            //for debug only!
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $resp = curl_exec($curl);
            curl_close($curl);
            //var_dump($resp);
            $reply = json_decode($resp,true); 
            if(!isset($reply['status']))
            {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'Error initiating transaction',
                    ],
                    400
                ); 
            }
            if($reply['status'] != true)
            {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'Oops '. @$reply['data']['msg'],
                    ],
                    400
                ); 
            }

            //COMPLETE VENDING AND SAVE TO DB//
            if($networkId == 1)
            {
                $networkname = 'MTN';
            }
            if($networkId == 2)
            {
                $networkname = 'Airtel';
            }
            if($networkId == 3)
            {
                $networkname = 'Glo';
            }
            if($networkId == 4)
            {
                $networkname = '9Mobile';
            }
            $user->balance -= $plan['price'];
            $user->save();
            $balance_after = $user->balance;

            $order               = new Order();
            $order->user_id      = $user->id;
            $order->type         =  'internet';
            $order->val_1        = $input['phoneNumber'];
            $order->val_2        = @$plan['name'];
            $order->val_3         =  'api_data_vending';
            $order->deposit_code   = @$resp;
            $order->product_name = @$networkname;
            $order->product_logo = null;
            $order->details      = json_encode($reply,true);
            $order->quantity     = 1;
            $order->price        = @$plan['price'];
            $order->currency     = 'NGN';
            $order->status       = 'success';
            $order->payment      = @$plan['price'];
            $order->trx          = getTrx();
            $order->source       = 'Deposit Wallet';
            $order->balance_before  = $user->balance;
            $order->balance_after   = $balance_after;
            $order->transaction_id  = $code;
            $order->save();

            $transaction               = new Transaction();
            $transaction->user_id      = $order->user_id;
            $transaction->amount       = $order->payment;
            $transaction->post_balance = $order->balance_after;
            $transaction->charge       = 0;
            $transaction->trx_type     = '-';
            $transaction->details      = 'Purchased SME internet data via API';
            $transaction->trx          = $order->trx;
            $transaction->remark       = 'internet';
            $transaction->save();

            notify($user,'INTERNET_BUY', [
                'provider'        => @$networkname,
                'currency'        => @gs()->cur_text,
                'amount'          => @showAmount($plan['price']),
                'product'         => @$plan['name'], 
                'beneficiary'     => @$input['phoneNumber'], 
                'rate'           => @showAmount($plan['price']),
                'purchase_at'     => @Carbon::now(),
                'trx'             => @$code,
            ]);

            return response()->json(
                [
                    'status' => true,
                    'message' => $reply['data']['msg'],
                    'orderid'=> $code
                ],
                200
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'status' => false,
                    'message' => $th->getMessage(),
                ],
                400
            );
        }
    }
    
    public function BUYN3TDATAPLAN($input,$user)
    {
        try { 
            $plan = $this->N3TDATAPLANS($input['planId']);
            if($user->balance < $plan->price)
            {
                return response()->json(['ok'=>false,'message'=> 'Insufficient merchant balance'],400);
            }
            $code = getTrx();
            $token = getN3TToken();
            $url = 'https://n3tdata.com/api/data';
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
            $headers = array(
                "Authorization: Token ".$token."",
                "Content-Type: application/json",
            );
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            $code = getTrx();
            $networkId = $input['networkId'];
            $phoneNumber = $input['phoneNumber'];
            $planId = $input['planId'];
            $data = <<<DATA
            {
                "network": "$networkId",
                "data_plan": "$planId",
                "phone": "$phoneNumber",
                "request-id": "$code"
            }
            DATA;
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            //for debug only!
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $resp = curl_exec($curl);
            curl_close($curl);
            //var_dump($resp);
            $reply = json_decode($resp,true);  
            if(!isset($reply['status']) && !isset($reply['newbal']))
            {
                return response()->json(['status'=>false,'message'=> 'Sorry we cant process this request at the moment'],400);
            }
            if($reply['status'] == 'success')
            {
                //COMPLETE VENDING AND SAVE TO DB// 
                $user->balance -= $plan->price;
                $user->save();
                $balance_after = $user->balance;

                $order               = new Order();
                $order->user_id      = $user->id;
                $order->type         =  'internet';
                $order->val_1        = $input['phoneNumber'];
                $order->val_2        = @$plan->name;
                $order->val_3         =  'api_data_vending';
                $order->deposit_code = @$resp;
                $order->product_name = @$plan->network;
                $order->product_logo = null;
                $order->details      = json_encode($reply,true);
                $order->quantity     = 1;
                $order->price        = @$plan->price;
                $order->currency     = 'NGN';
                $order->status       = 'success';
                $order->payment      = @$plan->price;
                $order->trx          = getTrx();
                $order->source       = 'Deposit Wallet';
                $order->balance_before  = $user->balance;
                $order->balance_after   = $balance_after;
                $order->transaction_id  = $code;
                $order->save();

                $transaction               = new Transaction();
                $transaction->user_id      = $order->user_id;
                $transaction->amount       = $order->payment;
                $transaction->post_balance = $order->balance_after;
                $transaction->charge       = 0;
                $transaction->trx_type     = '-';
                $transaction->details      = 'Purchased SME internet data via API';
                $transaction->trx          = $order->trx;
                $transaction->remark       = 'internet';
                $transaction->save();

                notify($user,'INTERNET_BUY', [
                    'provider'        => @$plan->network,
                    'currency'        => @gs()->cur_text,
                    'amount'          => @showAmount($plan->price),
                    'product'         => @$plan->name, 
                    'beneficiary'     => @$input['phoneNumber'], 
                    'rate'           => @showAmount($plan->price),
                    'purchase_at'     => @Carbon::now(),
                    'trx'             => @$code,
                ]);
                return response()->json(['status'=>true,'message'=> @$reply['message'],'orderid'=> $reply['request-id']],200);
            }
            else
            {
                return response()->json(['status'=>false,'message'=> @$reply['message']. ' API ERROR'],400);
            }
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'status' => false,
                    'message' => $th->getMessage(),
                ],
                400
            );
        } 
    }
    
    public function BUYGSUBZPLAN($input,$user)
    {
        try { 
            $plan = $this->GSUBZPLANS($input['networkId'],$input['planId']);
            if($user->balance < $plan->price)
            {
                return response()->json(['ok'=>false,'message'=> 'Insufficient merchant balance'],400);
            }
            $code = getTrx();
            $token = getN3TToken();
            $url = 'https://gsubz.com/api/pay/';
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
            $headers = array(
                "Authorization: Bearer ".env('GSUBZAPI')."",
                "Content-Type: application/json",
            );
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            $code = getTrx();
            $networkId = $input['networkId'];
            $phoneNumber = $input['phoneNumber'];
            $planId = $input['planId'];
            $data = <<<DATA
            {
                "serviceID": "$plan->type",
                "plan": "$planId",
                "api": "env('GSUBZAPI')",
                "phone": "$phoneNumber",
                "requestID": "$code"
            }
            DATA;
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            //for debug only!
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $resp = curl_exec($curl);
            curl_close($curl);
            //var_dump($resp);
            $reply = json_decode($resp,true);  
            if(!isset($reply['status']) && !isset($reply['content']))
            {
                return response()->json(['status'=>false,'message'=> 'Sorry we cant process this request at the moment'],400);
            }
            if($reply['status'] == 'TRANSACTION_SUCCESSFUL' && $reply['content']['code'] == 200)
            {
                //COMPLETE VENDING AND SAVE TO DB// 
                $user->balance -= $plan->price;
                $user->save();
                $balance_after = $user->balance;

                $order               = new Order();
                $order->user_id      = $user->id;
                $order->type         =  'internet';
                $order->val_1        = $input['phoneNumber'];
                $order->val_2        = @$plan->name;
                $order->val_3         =  'api_data_vending';
                $order->deposit_code   = @$resp;
                $order->product_name = @$plan->network;
                $order->product_logo = null;
                $order->details      = json_encode($reply,true);
                $order->quantity     = 1;
                $order->price        = @$plan->price;
                $order->currency     = 'NGN';
                $order->status       = 'success';
                $order->payment      = @$plan->price;
                $order->trx          = getTrx();
                $order->source       = 'Deposit Wallet';
                $order->balance_before  = $user->balance;
                $order->balance_after   = $balance_after;
                $order->transaction_id  = $code;
                $order->save();

                $transaction               = new Transaction();
                $transaction->user_id      = $order->user_id;
                $transaction->amount       = $order->payment;
                $transaction->post_balance = $order->balance_after;
                $transaction->charge       = 0;
                $transaction->trx_type     = '-';
                $transaction->details      = 'Purchased SME internet data via API';
                $transaction->trx          = $order->trx;
                $transaction->remark       = 'internet';
                $transaction->save();

                notify($user,'INTERNET_BUY', [
                    'provider'        => @$plan->network,
                    'currency'        => @gs()->cur_text,
                    'amount'          => @showAmount($plan->price),
                    'product'         => @$plan->name, 
                    'beneficiary'     => @$input['phoneNumber'], 
                    'rate'           => @showAmount($plan->price),
                    'purchase_at'     => @Carbon::now(),
                    'trx'             => @$code,
                ]);
                return response()->json(['status'=>true,'message'=> @$reply['description'],'orderid'=> @$reply['content']['transactionID']],200);
            }
            else
            {
                return response()->json(['ok'=>false,'message'=> @$reply['description']. '. API ERROR!!'],400);
            }
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'status' => false,
                    'message' => $th->getMessage(),
                ],
                400
            );
        } 
    }

    public function TRXVERIFY()
    {
        try {
            $token = getBearerToken();
            if($token->ok != true)
            {
                return response()->json(
                    [
                        'status' => false,
                        'message' => $token->message,
                    ],
                    400
                );
            }
            $user = $token->user; 
            if(!request()->TrxId)
            { 
                return response()->json(['status'=>false,'message'=> 'Please specify transaction reference number'],400);
            }

            if(request()->TrxId)
            { 
                $trx = Order::whereTrx(request()->TrxId)->whereUserId($user->id)->where('val_3','api_data_vending')->first();
                if(!$trx)
                {
                    return response()->json(['status'=>false,'message'=> 'Transaction not found'],400);
                }
                return response()->json(
                    [
                        'status' => true,
                        'message' => 'Transaction Fetched',
                        'data' => $trx,
                    ],
                    200
                );
            }
            
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'status' => false,
                    'message' => $th->getMessage(),
                ],
                400
            );
        }
    }
    
     
    public function CREATECUSTOMER()
    {
        try { 
            $token = getBearerToken();
            if($token->ok != true)
            {
                return response()->json(
                    [
                        'status' => false,
                        'message' => $token->message,
                    ],
                    400
                );
            } 
            $user = $token->user; 
            $json = file_get_contents('php://input');
            $input = json_decode($json, true);  
            $vpaytoken = getVPAYToken();

            if($vpaytoken['status'] = false)
            {
                return response()->json(['status'=>false,'message'=> $vpaytoken['message']],400); 
            }            
            $vpaytoken = $vpaytoken['token'];
            $url = 'https://services2.vpay.africa/api/service/v1/query/customer/add';
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
            $headers = array(
                "publicKey: ".env('VPAY_API_KEY')."",
                "b-access-token: ".$vpaytoken."",
                "Content-Type: application/json",
            );
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            $code = getTrx();
            $contactfirstname = $input['contactfirstname'];
            $contactlastname = $input['contactlastname'];
            $email = $input['email'];
            $phone = $input['phone'];
            $data = <<<DATA
            {
                "contactfirstname": "$contactfirstname",
                "contactlastname": "$contactlastname",
                "email": "$email",
                "phone": "$phone"
            }
            DATA;
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            //for debug only!
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $resp = curl_exec($curl);
            curl_close($curl);
            //var_dump($resp);
            $reply = json_decode($resp,true);  
            if(!isset($reply['id']))
            {
                return response()->json(['status'=>false,'message'=> $reply['message'].'. Sorry we cant process this request at the moment'],400);
            }
            if($reply['id'])
            {
                $customerExist = Customer::whereUserId($user->id)->whereCustomerId($reply['id'])->first();
                if(!$customerExist)
                {
                //CREATE NEW CUSTOMER AND SAVE TO DB// 
                $customer               = new Customer();
                $customer->user_id      = $user->id;
                $customer->customer_id  =  $reply['id']; 
                $customer->status       = 1; 
                $customer->save(); 
                return $this->GENERATENUBAN($reply['id'],$vpaytoken);
                //return response()->json(['status'=>true,'message'=> 'New Customer Created','customerid'=> @$reply['id']],200);
                }
                else
                {
                    return response()->json(['status'=>true,'message'=> 'Customer already exist'],400); 
                }
            }
            else
            {
                return response()->json(['ok'=>false,'message'=> @$reply['message']. '. API ERROR!!'],400);
            }
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'status' => false,
                    'message' => $th->getMessage(),
                ],
                400
            );
        } 
        
    }
    

    public function GENERATENUBAN($cid, $token)
    {
        try { 
             
            $url = 'https://services2.vpay.africa/api/service/v1/query/customer/'.$cid.'/show';
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
            $headers = array(
                "publicKey: ".env('VPAY_API_KEY')."",
                "b-access-token: ".$token."",
                "Content-Type: application/json",
            );
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers); 
            //for debug only!
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $resp = curl_exec($curl);
            curl_close($curl);
            //var_dump($resp);
            $reply = json_decode($resp,true);  
            if(!isset($reply['nuban']))
            {
                return response()->json(['status'=>false,'message'=> $reply['message'].'. Sorry we cant process this request at the moment'],400);
            }
           // return $reply;
            if($reply['nuban'])
            {
                //RETURN CUSTOMER DETAILS//  
                $customer = Customer::whereCustomerId($reply['_id'])->first();
                $customer->account_name      = @$reply['contactfirstname'].' '.@$reply['contactlastname'];
                $customer->account_number    =  @$reply['nuban']; 
                $customer->email    =  @$reply['email']; 
                $customer->phone    =  @$reply['phone']; 
                $customer->bank_name         =  @$reply['virtualaccounts']['bank']; 
                $customer->status            = 1; 
                $customer->save(); 
                return response()->json(['status'=>true,'message'=> 'NUBAN Created','nuban'=> @$reply],200);
            }
            else
            {
                return response()->json(['ok'=>false,'message'=> @$reply['message']. '. API ERROR!!'],400);
            }
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'status' => false,
                    'message' => $th->getMessage(),
                ],
                400
            );
        } 
        
    }
    

    public function FETCHCUSTOMER()
    {
        try { 
            $token = getBearerToken();
            if($token->ok != true)
            {
                return response()->json(
                    [
                        'status' => false,
                        'message' => $token->message,
                    ],
                    400
                );
            } 
            $user = $token->user; 
            $json = file_get_contents('php://input');
            $input = json_decode($json, true);             
            $vpaytoken = getVPAYToken();
            if($vpaytoken['status'] = false)
            {
                return response()->json(['status'=>false,'message'=> $vpaytoken['message']],400); 
            }  
            $vpaytoken = $vpaytoken['token'];  
                  
            $url = 'https://services2.vpay.africa/api/service/v1/query/customer/'.$input['customerid'].'/show';
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
            $headers = array(
                "publicKey: ".env('VPAY_API_KEY')."",
                "b-access-token: ".$vpaytoken."",
                "Content-Type: application/json",
            );
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers); 
            //for debug only!
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $resp = curl_exec($curl);
            curl_close($curl);
            //var_dump($resp);
            $reply = json_decode($resp,true);  
            if(!isset($reply['nuban']))
            {
                return response()->json(['status'=>false,'message'=> $reply['message'].'. Sorry we cant process this request at the moment'],400);
            }
           // return $reply;
            if($reply['nuban'])
            {
                //RETURN CUSTOMER DETAILS//  
                $customer = Customer::whereUserId($user->id)->whereCustomerId($reply['_id'])->first();
                $customer->account_name      = @$reply['contactfirstname'].' '.@$reply['contactlastname'];
                $customer->account_number    =  @$reply['nuban']; 
                $customer->email    =  @$reply['email']; 
                $customer->phone    =  @$reply['phone']; 
                $customer->bank_name         =  @$reply['virtualaccounts']['bank']; 
                $customer->status            = 1; 
                $customer->save(); 
                return response()->json(['status'=>true,'message'=> 'Customer Fetched','customer'=> @$reply],200);
            }
            else
            {
                return response()->json(['ok'=>false,'message'=> @$reply['message']. '. API ERROR!!'],400);
            }
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'status' => false,
                    'message' => $th->getMessage(),
                ],
                400
            );
        } 
        
    }
    
    
    public function getVPAYToken()
    {
        $url = 'https://services2.vpay.africa/api/service/v1/query/merchant/login';
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        $headers = array(
            "publicKey: ".env('VPAY_API_KEY')."",
            "Content-Type: application/json",
                );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $username = env('VPAY_EMAIL');
        $password = env('VPAY_PASSWORD');
        $data = <<<DATA
                {
                    "username": "$username",
                    "password": "$password"
                }
        DATA;
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $resp = curl_exec($curl);
        curl_close($curl);
        //var_dump($resp);
        $reply = json_decode($resp,true); 

        if(!isset($reply['token']))
        { 
            $tokn = session()->get('vpaytoken');
            $token['status'] = $reply['status'];
            $token['message'] = $reply['message'];
            $token['token'] = $tokn;
        }
        else{
            session()->put('vpaytoken', $reply['token']);
            $token['token_real'] = $reply['token'];
            $token['token'] = session()->get('vpaytoken');
            $token['status'] = $reply['status'];
            $token['message'] = $reply['message'];
        }
        return $token;
    }
     
}

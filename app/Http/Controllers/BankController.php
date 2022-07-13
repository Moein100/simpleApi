<?php

namespace App\Http\Controllers;

use App\Http\Requests\BankRequest;
use App\Http\Requests\CreateRequest;
use App\Http\Resources\GetAllAccountsResource;
use App\Http\Resources\GetAllCustomersResource;
use App\Http\Resources\GetAmountResource;
use App\Http\Resources\HistoryResource;
use App\Models\Account;
use App\Models\Customer;
use App\Models\Transfer;
use Illuminate\Http\Request;

class BankController extends Controller
{

    public function allCustomers()
    {
        return GetAllCustomersResource::collection(Customer::all());
    }

    public function allAcounts()
    {
        return GetAllAccountsResource::collection(Account::all());
    }




    public function create(CreateRequest $request,Customer $customer)
    {
        if (!$request->amount || (int)$request->amount < 10) 
        {
            $amount=10;
        }else
        {
            $amount=(int)$request->amount;
        }
        
            $newAccount=Account::create([
                'customer_id' => $customer->id,
                'amount' => $amount
            ]);
    
            return ['data' => $newAccount];
        
       
    }

    public function transfer(BankRequest $request,$from,$to)
    {
        $mount=(int)$request->amount;
        $fromAccount=Account::find($from);
        $toAccount=Account::find($to);
        if ($fromAccount->amount < $mount || $fromAccount == $toAccount) {

            return response()->json([
                'data' => [],
                'message' =>'It is not possible'
            ],406);
        }
        $fromAccount->amount -= $mount;
        $fromAccount->save();
        $toAccount->amount += $mount;
        $toAccount->save();
        Transfer::create(
            [
                'account_id1' => $fromAccount->id,
                'account_id2' => $toAccount->id,
                'amount' => $mount,
            ]);
            return response()->json([
                'data' => [],
                'message' =>'success'
            ]);
    }


    public function getAmount(Account $account)
    {
        // return [
        //     'amount' => $account->amount."$",
        //     'Customer_name'=>$account->customer->name
        // ];
        return new GetAmountResource($account);
    }

    public function history(Account $account)
    {
        //before
    //    $transmitter_array=[];
    //    foreach ($account->transmitters as $transmitter) 
    //    {
    //     $array=
    //     [
    //         'transfererAccount_id' =>$transmitter->accountTransferer->id,
    //         'transferer_name' =>$transmitter->accountTransferer->customer->name,
    //         'recieverAccount_id'=> $transmitter->accountReciever->id,
    //         'reciever_name' => $transmitter->accountReciever->customer->name,
    //         'amount' => $transmitter->amount,
    //     ];
    //     array_push($transmitter_array,$array);
    //    }

    // $recieviers_array=[];
    // foreach ($account->recievers as $reciever) 
    //    {
    //     $array=
    //     [
    //         'recievedFromAccount_id' =>$reciever->accountTransferer->id,
    //         'transferer_name' =>$reciever->accountTransferer->customer->name,
    //         'recieverAccount_id'=> $reciever->accountReciever->id,
    //         'reciever_name' => $reciever->accountReciever->customer->name,
    //         'amount' => $reciever->amount,
    //     ];
    //     array_push($recieviers_array,$array);
    //    }

       
    //    return 
    //    [
    //     'this_account_transfered'=>$transmitter_array,
    //     'this_account_recieved'=>$recieviers_array
    //    ];
    //after
    return new HistoryResource($account);
    }
    

    
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
           $transmitter_array=[];
       foreach ($this->transmitters as $transmitter) 
       {
        $array=
        [
            'transfererAccount_id' =>$transmitter->accountTransferer->id,
            'transferer_name' =>$transmitter->accountTransferer->customer->name,
            'recieverAccount_id'=> $transmitter->accountReciever->id,
            'reciever_name' => $transmitter->accountReciever->customer->name,
            'amount' => $transmitter->amount,
        ];
        array_push($transmitter_array,$array);
       }

    $recieviers_array=[];
    foreach ($this->recievers as $reciever) 
       {
        $array=
        [
            'recievedFromAccount_id' =>$reciever->accountTransferer->id,
            'transferer_name' =>$reciever->accountTransferer->customer->name,
            'recieverAccount_id'=> $reciever->accountReciever->id,
            'reciever_name' => $reciever->accountReciever->customer->name,
            'amount' => $reciever->amount,
        ];
        array_push($recieviers_array,$array);
       }

       
       return 
       [
        'this_account_transfered'=>$transmitter_array,
        'this_account_recieved'=>$recieviers_array
       ];
        
    }
}

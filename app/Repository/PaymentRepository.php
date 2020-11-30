<?php


namespace App\Repository;


use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;

class PaymentRepository
{
    private static $apiKey;
    public function PaymentRepository() {
        $this->apiKey = env("API_KEY_PAGARME" , "efa90f90ewjfap9fjewapj9");
    }

    public function debitPayment() {

    }
    public function creditPayment($data) {
        return Http::post( 'https://api.pagar.me/1/transactions',[
                            "api_key"=> "$this->apiKey",
                            "amount" => $data->amount,
                            "card_number"=> $data->card_number,
                            "card_cvv"=> "$data->card_cvv",
                            "card_expiration_date"=> "$data->expiration_date",]);
    }
    public function  pixPayment(){
        // implementar
    }
    public function biletPayment($data){
        return Http::post("https://api.pagar.me/1/transactions" , [
            "amount" => $data->amount,
            "api_key" => $this->apiKey,
            "payment_method" => "boleto",
            "customer" => [
                "type" => "individual",
                "country" => "br",
                "name" => $data->name,
                "documents" => [[
                    "type" => "cpf",
                    "number" => $data->cof
                ]]
            ]
        ]);
    }

}

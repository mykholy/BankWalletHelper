<?php

namespace Mykholy\BankWalletHelper;

use GuzzleHttp\Client;


class BankWalletHelper
{

    private $URL;
    private $client_id;
    private $client_secret;

    public function __construct($client_id, $client_secret, $URL = "http://localhost/bank/")
    {
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
        $this->URL = $URL;
    }

    public function checkout($data)
    {


        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/json',
                'client-id' => $this->client_id,
                'client-secret' => $this->client_secret,
            ]
        ]);

        $response = $client->post($this->URL . 'api/v1/merchants/payment/checkout',
            ['body' => json_encode($data)]
        );

        header('Content-type: application/json');
        return json_decode($response->getBody(), true);

    }

    public function doCheckoutPayment($transaction_id)
    {


        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/json',
                'client-id' => $this->client_id,
                'client-secret' => $this->client_secret,
            ]
        ]);

        $response = $client->post($this->URL . 'api/v1/merchants/payment/doCheckoutPayment',
            ['form_params' => [
                'transaction_id' => $transaction_id,
            ]]
        );

        header('Content-type: application/json');
        return json_decode($response->getBody(), true);
    }

}

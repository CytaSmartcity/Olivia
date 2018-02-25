<?php namespace App\Classes;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Input;

class BOC
{

    public static $client_id     = 'dc25aaa9-9ba3-48ef-a253-22cc48c0569f';

    public static $client_secret = 'wQ0eX4xU1lH8qN7cI1mG3oJ6sH6sH4yW0fW3nO0hH2rH2iE1yT';


    public static function verifyCode()
    {
        $client = new Client();
        $code   = Input::get('code');

        $body = [
            'code'          => $code,
            'client_id'     => self::$client_id,
            'client_secret' => self::$client_secret,
            'grant_type'    => 'authorization_code',
            'scope'         => 'UserOAuth2Security',
        ];


        $request = $client->post('https://sandbox-apis.bankofcyprus.com/df-boc-org-sb/sb/psd2/oauth2/token', [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            'json'    => $body,
        ]);

        return true;
    }


    public static function getAccessToken($client)
    {

        $body = [
            'client_id'     => self::$client_id,
            'client_secret' => self::$client_secret,
            'grant_type'    => 'client_credentials',
            'scope'         => 'TPPOAuth2Security',
        ];

        $headers = [
            'accNumber'     => '351012345671',
            'url'           => 'https=>//sandbox-apis.bankofcyprus.com/df-boc-org-sb/sb/psd2',
            'tppId'         => 'singpaymentdata',
            'urlother'      => 'https=>//sandbox-apis.bankofcyprus.com/df-boc-org-sb/sb',
            'PmtId'         => '',
            'subscription2' => '',
            'originUserId'  => '50520218',
            'oauthCode'     => 'AAIkZGMyNWFhYTktOWJhMy00OGVmLWEyNTMtMjJjYzQ4YzA1NjlmF6NZPlw5LEOWPxpMBe74-EKnNkmmjIHNYZrMzQfhDQwhqjtVBRTjboIK9QnQfpmUh8C8Qvk6JGgh9IqN99IJkNFFLXct9fdMYZFe676NJqWYTjlRs5HW5PK0cSuv38KdVb8IDek9skF8Z56lsG0ITg',
            'journeyId'     => 'abc',
            'oauthCode2'    => '',
            'form_params'   => $body,
        ];

        $response = $client->post('https://sandbox-apis.bankofcyprus.com/df-boc-org-sb/sb/psd2/oauth2/token', $headers);

        $response = json_decode($response->getBody()->getContents());

        return $response->access_token;
    }


    public static function createSubscriptions($client, $access_token)
    {
        $body = [
            //'grant_type'    => 'client_credentials',
            //'scope'         => 'TPPOAuth2Security',
            'accounts' => [
                'transactionHistory'     => true,
                'balance'                => true,
                'details'                => true,
                'checkFundsAvailability' => true,
            ],
            'payments' => [
                'limit'    => 8.64181767,
                'currency' => 'EUR',
                'amount'   => 93.21948702,
            ],
        ];

        $headers = [
            'client_id'           => self::$client_id,
            'client_secret'       => self::$client_secret,
            'Authorization'       => 'Bearer '.$access_token,
            'content-type'        => 'application/json',
            'APIm-Debug-Trans-Id' => true,
            'app_name'            => 'olivia',
            'tppid'               => 'singpaymentdata',
            'originUserId'        => 50520218,
            'timeStamp'           => now()->timestamp,
            'journeyId'           => 'abc',
        ];

        $request = $client->post('https://sandbox-apis.bankofcyprus.com/df-boc-org-sb/sb/psd2/v1/subscriptions?client_id='.self::$client_id.'&client_secret='.self::$client_secret, [
            'headers' => $headers,
            'json'    => $body,
        ]);

        $response = json_decode($request->getBody()->getContents());

        return $response->subscriptionId;
    }


    public static function login($client, $access_token, $subscription_id)
    {

    }
}

<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Complain;
use GuzzleHttp\Client;

Route::get('/', function() {
    return view('welcome')->with('complains', Complain::latest()->take(5)->get());
})->name('dashboard');

Route::match(['get', 'post'], '/botman', 'BotManController@handle');
Route::get('/botman/tinker', 'BotManController@tinker');

Route::resource('complains', 'ComplainController');
Route::get('/pay', function() {

    return view('includes.payments');
});

Route::get('/map', function() {

    return view('includes.maps');
});

Route::get('/test', function() {

    $client = new Client();

    $headers = [
        'accNumber'      => '351012345671',
        'subscriptionId' => 'Subid000001 - 1519548222951',
        'url'            => 'https=>//sandbox-apis.bankofcyprus.com/df-boc-org-sb/sb/psd2',
        'client_id'      => 'dc25aaa9 - 9ba3 - 48ef - a253 - 22cc48c0569f',
        'client_secret'  => 'wQ0eX4xU1lH8qN7cI1mG3oJ6sH6sH4yW0fW3nO0hH2rH2iE1yT',
        'tppId'          => 'singpaymentdata',
        'urlother'       => 'https=>//sandbox-apis.bankofcyprus.com/df-boc-org-sb/sb',
        'PmtId'          => '',
        'subscription2'  => '',
        'originUserId'   => '50520218',
        'oauthCode'      => 'AAIkZGMyNWFhYTktOWJhMy00OGVmLWEyNTMtMjJjYzQ4YzA1NjlmF6NZPlw5LEOWPxpMBe74-EKnNkmmjIHNYZrMzQfhDQwhqjtVBRTjboIK9QnQfpmUh8C8Qvk6JGgh9IqN99IJkNFFLXct9fdMYZFe676NJqWYTjlRs5HW5PK0cSuv38KdVb8IDek9skF8Z56lsG0ITg',
        'journeyId'      => 'abc',
        'oauthCode2'     => ',',
    ];

    $body     = [
        'client_id'     => 'dc25aaa9-9ba3-48ef-a253-22cc48c0569f',//env('BOC_CLIENT_ID'),
        'client_secret' => 'wQ0eX4xU1lH8qN7cI1mG3oJ6sH6sH4yW0fW3nO0hH2rH2iE1yT',//env('BOC_APP_SECRET'),
        'grant_type'    => 'client_credentials',
        'scope'         => 'TTPOAuth2Security',
    ];
    $response = $client->post('https://sandbox-apis.bankofcyprus.com/df-boc-org-sb/sb/psd2/oauth2/token', [
        'headers' => $headers,
        'json'    => $body,
    ]);

    return $response->getBody()->getContents();
});

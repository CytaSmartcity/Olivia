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

use App\Classes\BOC;
use App\Complain;
use GuzzleHttp\Client;

Route::get('/', function() {
    return view('welcome')->with('complains', Complain::latest()->take(5)->get());
})->name('dashboard');

Route::match(['get', 'post'], '/botman', 'BotManController@handle');
Route::get('/botman/tinker', 'BotManController@tinker');

Route::resource('complains', 'ComplainController');
Route::resource('fines', 'FineController');
Route::get('/pay', function() {
    $client       = new Client();
    $access_token = BOC::getAccessToken($client);

    $code = 'AAI0EUKmh4DUQxe_MNmoO4mRLjzUkZYiSetYv8bEdZ6viKEpoIa9l19P0kU3ngqDxzr1T2piQpNQ2jFGKYvLgESUzkKVWOjXYjj4P_Il6OFuAQ';

    return view('includes.payments');
});

Route::get('/map', function() {
    $fuel = \DB::table('fuel_records')->get();

    return view('includes.maps', compact('fuel'));
})->name('map');

Route::get('/login', function() {
    $client = new Client();

    $client_id = 'dc25aaa9-9ba3-48ef-a253-22cc48c0569f';
    //$client_secret = 'wQ0eX4xU1lH8qN7cI1mG3oJ6sH6sH4yW0fW3nO0hH2rH2iE1yT';

    $access_token = BOC::getAccessToken($client);

    $subscription_id = BOC::createSubscriptions($client, $access_token);

    return redirect()->away('https://sandbox.bankofcyprus.com/sandbox/login?original-url=https%3A%2F%2Fsandbox-apis.bankofcyprus.com%2Fdf-boc-org-sb%2Fsb%2Fpsd2%2Foauth2%2Fauthorize%3Fresponse_type%3Dcode%26amp%3Bredirect_uri%3Dhttps%3A%2F%2Folivia-cyta.herokuapp.com%2F%26scope%3DUserOAuth2Security%26client_id%3D'.$client_id.'%26subscriptionid%3D'.$subscription_id.'%26rstate%3DP3WDKMoYgGpZICLtPR_8VVbm_u5JfRmP5Jswqf88UU8&app-name=Olivia&appid=5a926efee4b0932a8d3ea78e&org=chrysanthos-prodromou&orgid=5a926e2ee4b0932a8d3ea780&provider=df-boc-org-sb&providerid=5a439af0e4b07064433ef6e4&catalog=sb&catalogid=5a439af0e4b07064433ef6f0&g-transid=6f100acb5a927813048ef3c1&transid=76477377');

});

Route::get('/verify', function() {

    $verify = BOC::verifyCode();

    return $verify;
});

Route::get('/pay', function() {

    return view('includes.login');
});


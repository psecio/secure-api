<?php

require_once 'vendor/autoload.php';

$client = new GuzzleHttp\Client();
$hostnaem = 'http://localhost:8080';

$username = 'user1';
$apiKey = '[... key here ...]';

$res = $client->post($hostname.'/user/login', [
    'form_params' => [
        'username' => $username,
        'key' => $apiKey
    ]
]);
$result = json_decode($res->getBody());

if ($result->success == false) {
    die('Oops! '.$result->message);
    var_export($result);
}

// Now make a request with the key
$session = $result->message->session;
$body = '';
$messageHash = hash_hmac('SHA512', $body, $session.time());

$res = $client->post($hostname.'/test', [
    'headers' => [
        'X-Token' => $apiKey,
        'X-Token-Hash' => $messageHash
    ]
]);
var_export((string)$res->getBody());

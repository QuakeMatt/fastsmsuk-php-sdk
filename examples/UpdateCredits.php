<?php

use FastSMS\Client;
use FastSMS\Model\User;
use FastSMS\Exception\ApiException;

require __DIR__ . '/../vendor/autoload.php';
$config = require __DIR__ . '/config.php';

#init client
$client = new Client($config['token']);

#####################################
###########Create new user###########
#####################################
// Init Message data model
$data = array(
    'childUsername' => $config['existChildUser'],
    'quantity' => -5,
);
// Update credits
try {
    $result = $client->user->update($data);
    print_r($result);
    /*
     * Example return:
     * Array
     * (
     *    [status] => success
     * )
     */
} catch (ApiException $aex) {
    echo 'API error #' . $aex->getCode() . ': ' . $aex->getMessage();
} catch (Exception $ex) {
    echo $ex->getMessage();
}
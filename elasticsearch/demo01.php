<?php
/**
 * Created by PhpStorm.
 * User: zhangzibin
 * Date: 2018/5/3
 * Time: 16:03
 */

require "../vendor/autoload.php";

use Elasticsearch\ClientBuilder;

$client = ClientBuilder::create()->build();

$params = [
    'index' => 'my_index',
    'type'  => 'my_type',
    'id'    => 'my_id',
    'body'  => ['testField' => 'zhang'],
];

$response = $client->index($params);


$params = [
    'index' => 'my_index',
    'type'  => 'my_type',
    'id'    => 'my_id',
];

$response = $client->get($params);
print_r($response);
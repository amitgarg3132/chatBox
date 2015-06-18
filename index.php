<?php

$options = array
(
    'hostname' => 'localhost',
    'login'    => 'amit',
    'password' => 'amit',
    'port'     => '8983',
);

$client = new SolrClient($options);

$query = new SolrQuery();

$query->setQuery('pe*');

$query->setStart(0);

$query->setRows(50);

$query->addField('first_product_name')->addField('id');

$query_response = $client->query($query);

$response = $query_response->getResponse();

print_r($response);

?>


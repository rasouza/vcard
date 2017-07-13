<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Goutte\Client;

$client = new Client();
$crawler = $client->request('GET', 'https://rasouza.com.br/portfolio');

$crawler->filter('div.portfolio-item')->each(function ($item) {
    echo $item->text() . "\n\n";
});
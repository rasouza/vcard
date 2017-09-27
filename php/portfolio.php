<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Goutte\Client;

class Portfolio {
	public $title;
	public $link;
	public $image;

}


$client = new Client();
$crawler = $client->request('GET', 'https://rasouza.com.br/portfolio');

$port = [];
$i = 0;
$j = 0;
$k = 0;
$crawler->filter('div.portfolio-item')->each(function ($item) use (&$port, &$i, &$j, &$k) {

	
	$item->filter('a')->each(function ($link) use (&$port, &$i) {
		$obj = new Portfolio();
		$obj->link = $link->attr('href');
		$port[$i] = $obj;
		$i++;
	});


	$item->filter('div.portfolio-item-top img')->each(function ($img) use (&$port, &$j) {
		$port[$j]->image = 'https:' . $img->attr('data-src');
		$j++;
	});



	$item->filter('.portfolio-item-info h5')->each(function ($title) use (&$port, &$k) {
		$port[$k]->title = $title->text();
		$k++;
	});
    
});

echo json_encode($port);
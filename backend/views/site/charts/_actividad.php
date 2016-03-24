<?php

use yii\helpers\Url;

return [
	'title' => ['text' => 'Actividad'],
	'xAxis' => [
		'categories' => ['1','2','3']
	],
	'yAxis' => [
		'title' => ['text' => 'Realizado']
	],
	'series' => [
		['name' => 'Item', 'data' => [10,0,12]],
		['name' => 'Item', 'data' => [8,3,1]],
	]
];

?>
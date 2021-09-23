<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('test', function() {
	$query = "(sugar & salt) | patato";

	$andArray = [];
	$orArray = [];

    $exploded = preg_split("/[()]+/", $query, -1, PREG_SPLIT_NO_EMPTY);
    $array = array_filter($exploded);

    foreach ($array as $key => $element) {

    	if (strpos($element, '&') !== -1) {
    		$andArray[] = explode('&', $element);
    	}

    	// if (strpos($element, '|') !== -1) {
    	// 	$orArray[] = explode('|', $element);
    	// }
    }

    dd(array_filter(array_values($andArray)));
});
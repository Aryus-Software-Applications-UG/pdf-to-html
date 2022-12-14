<?php

/** @var \Laravel\Lumen\Routing\Router $router */
use Illuminate\Http\Request;

use App\Http\Controllers\HtmlToPdfController;


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    // return $router->app->version();
    die();
});

$router->get('/html-to-pdf/{pdfname}', function(Request $request, $pdfname) {
    
    $pdfController = new HtmlToPdfController();
    return $pdfController->generatePdf($pdfname, $request->url);

});
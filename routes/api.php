<?php

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

$router->group(['prefix'=>'api'], function() use ($router){
    $router->group(['prefix'=>'address'], function() use ($router){
        $router->post('/', 'AddressController@save');
        $router->get('/', 'AddressController@get');
        $router->get('/{id}', 'AddressController@getById');
        $router->put('/{id}', 'AddressController@update');
        $router->patch('/{id}', 'AddressController@patch');
        $router->delete('/{id}', 'AddressController@delete');
    });

    $router->group(['prefix'=>'client-additional-infos'], function() use ($router){
        $router->post('/', 'ClientAdditionalInfoController@save');
        $router->get('/', 'ClientAdditionalInfoController@get');
        $router->get('/{id}', 'ClientAdditionalInfoController@getById');
        $router->put('/{id}', 'ClientAdditionalInfoController@update');
        $router->patch('/{id}', 'ClientAdditionalInfoController@patch');
        $router->delete('/{id}', 'ClientAdditionalInfoController@delete');
    });

    $router->group(['prefix'=>'material-assets'], function() use ($router){
        $router->post('/', 'MaterialAssetController@save');
        $router->get('/', 'MaterialAssetController@get');
        $router->get('/{id}', 'MaterialAssetController@getById');
        $router->put('/{id}', 'MaterialAssetController@update');
        $router->patch('/{id}', 'MaterialAssetController@patch');
        $router->delete('/{id}', 'MaterialAssetController@delete');
    });

    $router->group(['prefix'=>'source-income'], function() use ($router){
        $router->post('/', 'SourceIncomeController@save');
        $router->get('/', 'SourceIncomeController@get');
        $router->get('/{id}', 'SourceIncomeController@getById');
        $router->put('/{id}', 'SourceIncomeController@update');
        $router->patch('/{id}', 'SourceIncomeController@patch');
        $router->delete('/{id}', 'SourceIncomeController@delete');
    });
}); 
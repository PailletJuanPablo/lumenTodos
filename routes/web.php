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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('login/', 'UsersAuthController@authenticate');

$router->post('register/', 'UsersAuthController@register');
$router->get('info', 'UsersAuthController@info');
$router->get('leer/', 'ExampleController@respuesta');

//Métodos de Clientes

$router->post('crearcliente/', 'ClientsController@agregarCliente');
$router->post('editarcliente/{id}/', 'ClientsController@editarCliente');
$router->get('vercliente/{id}', 'ClientsController@verCliente');
$router->post('eliminarcliente/{id}/', 'ClientsController@eliminarCliente');
$router->post('restaurarcliente/{id}/', 'ClientsController@resturarCliente');
$router->get('verclientes/', 'ClientsController@verClientes');


//Métodos de Tareas

$router->post('crearTarea/', 'WorksController@agregarTrabajo');
$router->post('editartarea/{id}/', 'WorksController@editarTarea');
$router->post('eliminartarea/{id}/', 'WorksController@eliminarTarea');
$router->post('restaurartarea/{id}/', 'WorksController@restaurarTarea');
$router->get('vertareas/', 'WorksController@verTareas');
$router->get('vertarea/{id}', 'WorksController@verTarea');



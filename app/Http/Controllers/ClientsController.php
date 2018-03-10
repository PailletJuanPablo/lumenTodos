<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function respuesta()
    {
        return response('Estás habilitado!', 200);
    }

    public function agregarCliente(Request $request)
    {

        $cliente = Client::create($request->all());
        return response(['Mensaje' => 'Creado Correctamente!', 'Datos' => $cliente], 200);
    }

    public function verCliente($id)
    {

        $cliente = Client::with('tareas')->find($id);
        if ($cliente) {
            return response($cliente, 200);
        } else {
            return response(['Mensaje' => 'No se encontró el cliente!'], 404);
        }
    }

    public function verClientes(){
        $cliente = Client::where('activo','=',1)->with('tareas')->get();
        return response($cliente, 200);

    }

    public function editarCliente(Request $request, $id)
    {

        $cliente = Client::find($id);

        if ($request->input('grado_importancia')) {

            $grado_importancia = $request->input('grado_importancia');
            $cliente->grado_importancia = $grado_importancia;

        }

        if ($request->input('nombre')) {

            $nombre = $request->input('nombre');
            $cliente->nombre = $nombre;

        }

        $cliente->save();

        return response()->json($cliente);
    }

    public function eliminarCliente($id){
        $cliente = Client::find($id);
        $cliente->activo = 0;
        $cliente->save();

        return response(['Mensaje' => 'Eliminada Correctamente!', 'Datos' => $cliente], 200);

    }

    public function resturarCliente($id){
        $client = Client::find($id);
        $client->activo = 1;
        $client->save();

        return response(['Mensaje' => 'Restaurada Correctamente!', 'Datos' => $client], 200);
    }
    //
}

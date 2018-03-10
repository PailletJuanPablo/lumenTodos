<?php

namespace App\Http\Controllers;

use App\Work;
use Illuminate\Http\Request;

class WorksController extends Controller
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

    public function agregarTarea(Request $request)
    {

        $trabajo = Work::create($request->all());
        return response(['Mensaje' => 'Creado Correctamente!', 'Datos' => $trabajo], 200);
    }

    public function editarTarea(Request $request, $id)
    {

        $tareaEditar = Work::find($id);

        if ($request->input('tarea')) {

            $tarea = $request->input('tarea');
            $tareaEditar->tarea = $tarea;

        }

        if ($request->input('fecha_limite')) {

            $fecha_limite = $request->input('fecha_limite');
            $tareaEditar->fecha_limite = $fecha_limite;

        }

        if ($request->input('prioridad')) {

            $prioridad = $request->input('prioridad');
            $tareaEditar->prioridad = $prioridad;

        }

        if ($request->input('estado')) {

            $estado = $request->input('estado');
            $tareaEditar->estado = $estado;

        }

        $tareaEditar->save();

        return response()->json($tareaEditar);
    }


    public function eliminarTarea($id){
        $tarea = Work::find($id);
        $tarea->activo = 0;
        $tarea->save();

        return response(['Mensaje' => 'Eliminada Correctamente!', 'Datos' => $tarea], 200);

    }

    public function restaurarTarea($id){
        $tarea = Work::find($id);
        $tarea->activo = 1;
        $tarea->save();

        return response(['Mensaje' => 'Restaurada Correctamente!', 'Datos' => $tarea], 200);
    }

    public function verTareas(){
        $tareas = Work::where('activo','=',1)->with('cliente')->get();
        return response($tareas, 200);

    }

    public function verTarea($id)
    {

        $tarea = Work::with('cliente')->find($id);
        if ($tarea) {
            return response($tarea, 200);
        } else {
            return response(['Mensaje' => 'No se encontró el cliente!'], 404);
        }
    }
    //
}

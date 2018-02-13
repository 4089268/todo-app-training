<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Todo;


/**
 * En esta clase deben implementar los metodos vacios de acuerdo a lo
 * previamente estudiado acerca de RESTFul. Recuerda que DEBEN validar los datos
 * de entrada y de regresar lo que les pide el método correctamente.
 *
 * Class TodoController
 * @package App\Http\Controllers
 */
class TodoController extends Controller
{
    /**
     * Este método del controlador regresa el listado del todos de la app
     * en un response del tipo json ordenados desde el más antiguo al más nuevo.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // TODO
        $todos = Todo::orderBy('id', 'DESC')->get();        
        //dd($todos);
        return response()->json($todos);        
    }

    /**
     * Este método del controlador debe crear un nuevo registro todo
     * y al final regresa el registro creado en un response del tipo
     * json.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // TODO
        $text  = $request -> text;
        $task  = Todo::create(['text'=>$text]);
        return response()->json($task);
    }

    /**
     * Modifica el item todo con el $id correspondiente
     * y regresa el mismo item modificado.
     *
     * @param integer $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request)
    {
        // TODO
        $task = Todo::find($id);
        $task->done = !boolval($task->done);
        $task->save();
        //dd($task);        
        return json_encode($task);
    }

    /**
     * Elimina el registro y devuelve un response 200 en caso de exito o un 400
     * en caso de fallo pero igual en tipo json.
     *
     * @param integer $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        // TODO
        $user = Todo::find($id);

        if(isset($user)){
            $user->delete();

            if(null ==Todo::find($id)){
                return response('Ok',200);
            }else{
                return response('Err',400);
            }                       
        }else{
             return response('Ok',200); 
        }

    }
}

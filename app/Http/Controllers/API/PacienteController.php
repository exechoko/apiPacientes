<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActualizarPacienteRequest;
use App\Http\Requests\GuardarPacienteRequest;
use App\Http\Resources\PacienteResource;
use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Nos retorna todos los pacientes en formato JSON
        return PacienteResource::collection(Paciente::all());
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GuardarPacienteRequest $request)
    {
        /*//Antes estaba Request en ves de GuardarPacienteRequest
        Paciente::create($request->all());
        return response()->json([
            'res' => true,
            'msg' => 'Paciente guardado corretamente'
        ], 200);*/

        //Usando el PacienteResource
        return (new PacienteResource(Paciente::create($request->all())))
            ->additional(['msg' => 'Paciente guardado correctamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Paciente $paciente)
    {
        /*//Para mostrar un paciente en particular
        return response()->json([
            'res' => true,
            'paciente' => $paciente
        ], 200);*/

        //Usando el PacienteResource (es un api resources de laravel)
        return new PacienteResource($paciente);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ActualizarPacienteRequest $request, Paciente $paciente)
    {
        $paciente->update($request->all());
        /*return response()->json([
            'res' => true,
            'mensaje' => 'Paciente Actualizado correctamente'
        ], 200);*/
 
        //Usando el PacienteResource
        return (new PacienteResource($paciente))
            ->additional(['msg' => 'Paciente actualizado correctamente'])
            ->response()
            ->setStatusCode(202); //se puede manejar el status code que devuelve el response
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paciente $paciente)
    {
        $paciente->delete();
        /*return response()->json([
            'res' => true,
            'mensaje' => 'Paciente Eliminado correctamente'
        ], 200);*/

        //Usando el PacienteResource
        return (new PacienteResource($paciente))
            ->additional(['msg' => 'Paciente eliminado']);
    }
}

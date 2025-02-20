<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use Monolog\Handler\IFTTTHandler;

class EstudianteController extends Controller
{
    public const MSG_NOT_FOUND    = 'Error: estudiante no encontrado';
    public const MSG_FIND_OK      = 'Estudiante encontrado';
    public const MSG_UPDATED_OK   = 'Estudiante actualizado correctamente';
    public const MSG_UPDATE_ERROR = 'Error: estudiante no actualizado';
    public const MSG_DELETED_OK   = 'Estudiante eliminado correctamente';
    public const MSG_DELETE_ERROR = 'Error: estudiante no eliminado';
    public const MSG_CREATE_OK    = 'Estudiante creado correctamente';
    public const MSG_CREATE_ERROR = 'Error: estudiante no creado';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Estudiante::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = Estudiante::create($request->input());

        return $result
            ? ResponseHelper::success($result, self::MSG_CREATE_OK)
            : ResponseHelper::error(self::MSG_CREATE_ERROR);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        if (Estudiante::find($id)) {
            $student = Estudiante::find($id);
            return ResponseHelper::success($student, self::MSG_FIND_OK);
        } else {
            return ResponseHelper::error(self::MSG_NOT_FOUND);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        $estudiante = Estudiante::find($id);

        if (!$estudiante) {
            return ResponseHelper::error(self::MSG_NOT_FOUND, 404);
        }

        $validatedData = $request->validate([
            'nombre'   => 'sometimes|required|string|max:255',
            'apellido' => 'sometimes|required|string|max:255',
            'foto'     => 'sometimes|nullable|string|max:255',
        ]);

        return $estudiante->update($validatedData)
            ? ResponseHelper::success($estudiante, self::MSG_UPDATED_OK)
            : ResponseHelper::error(self::MSG_UPDATE_ERROR);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $student = Estudiante::find($id);

        if (!$student) {
            return ResponseHelper::error(self::MSG_NOT_FOUND);
        }

        return Estudiante::destroy($id)
            ? ResponseHelper::success($student, self::MSG_DELETED_OK)
            : ResponseHelper::error(self::MSG_DELETE_ERROR);
    }
}

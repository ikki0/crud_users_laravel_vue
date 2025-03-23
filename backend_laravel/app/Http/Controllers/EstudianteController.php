<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Helpers\MessageConstants; // Importar las constantes de mensajes
use Illuminate\Database\QueryException;

class EstudianteController extends Controller
{
    private $messages;

    public function __construct()
    {
        $this->messages = MessageConstants::getMessages('Estudiante');
    }

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
        // Obtener los campos permitidos del modelo Estudiante
        $fillable = (new Estudiante)->getFillable();

        // ITERACIÓN SOBRE TODOS LOS CAMPOS RECIBIDOS
        foreach ($request->input() as $key => $value) {
            // VERIFICAR SI EL ELEMENTO NO EXISTE COMO CAMPO PERMITIDO
            if (!in_array($key, $fillable)) {
                return ResponseHelper::error("El campo '$key' no es válido.", 422);
            }
        }
        try {
            $validatedData = $request->validate([
                'nombre'   => 'required|string|max:255',
                'apellido' => 'required|string|max:255',
                'foto'     => 'nullable|string',
            ]);

            $result = Estudiante::create($validatedData);

            return $result
                ? ResponseHelper::success($result, $this->messages['MSG_CREATE_OK'])
                : ResponseHelper::error($this->messages['MSG_CREATE_ERROR']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return ResponseHelper::error($e->errors(), 422);
        } catch (QueryException $e) {
            return ResponseHelper::error("Error base de datos: " . $e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $student = Estudiante::find($id);

        return $student
            ? ResponseHelper::success($student, $this->messages['MSG_FIND_OK'])
            :  ResponseHelper::error($this->messages['MSG_NOT_FOUND']);
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
        $student = Estudiante::find($id);

        // VALIDAR EXISTENCIA ESTUDIANTE
        if (!$student) {
            return ResponseHelper::error($this->messages['MSG_NOT_FOUND'], 404);
        }

        // VALIDAR EXISTENCIA DE CAMPOS MODELO ESTUDIANTE
        $fillable = $student->getFillable(); // OBTENER CAMPOS PERMITIDOS

        foreach ($request->input() as $key => $value) {
            if (!in_array($key, $fillable)) {
                return ResponseHelper::error("El campo '$key' no es válido.", 422);
            }
        }

        try {
            $validatedData = $request->validate([
                'nombre'   => 'sometimes|required|string|max:255',
                'apellido' => 'sometimes|required|string|max:255',
                'foto'     => 'sometimes|nullable|string',
            ]);

            return $student->update($validatedData)
                ? ResponseHelper::success($student, $this->messages['MSG_UPDATED_OK'])
                : ResponseHelper::error($this->messages['MSG_UPDATE_ERROR']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return ResponseHelper::error($e->errors(), 422);
        } catch (QueryException $e) {
            return ResponseHelper::error("Error en base de datos: " . $e->getMessage(), 500);
        }
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
            return ResponseHelper::error($this->messages['MSG_NOT_FOUND']);
        }

        return Estudiante::destroy($id)
            ? ResponseHelper::success($student, $this->messages['MSG_DELETED_OK'])
            : ResponseHelper::error($this->messages['MSG_DELETE_ERROR']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Helpers\MessageConstants;
use Illuminate\Http\Request;
use App\Models\User;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    private $messages;

    public function __construct()
    {
        $this->messages = MessageConstants::getMessages('Usuario');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // VALIDAR PARÁMETROS DE ENTRADA EN $REQUEST
            $validateData = $request->validate([
                'name'       => 'required|string',
                'email'      => 'required|email',
                'password'   => 'required|string|min:8',
                "first_name" => 'required|string',
                "last_name"  => 'required|string'
            ]);

            if (!$validateData) {
                dd('error validate data');
            }

            // Encriptar la contraseña y actualizar el arreglo validado
            $validateData['password'] = bcrypt($validateData['password']);

            // CREAR USUARIO con el arreglo validado completo
            $result = User::create($validateData);

            return $result
                ? ResponseHelper::success($result, $this->messages['MSG_CREATE_OK'])
                : ResponseHelper::error($this->messages['MSG_CREATE_ERROR']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return ResponseHelper::error($e->errors(), 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = User::find($id);

        return $student
            ? ResponseHelper::success($student, $this->messages['MSG_FIND_OK'])
            :  ResponseHelper::error($this->messages['MSG_NOT_FOUND']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return ResponseHelper::error($this->messages['MSG_NOT_FOUND'], 404);
        }

        try {
            $validateData = $request->validate([
                'name'       => 'sometimes|string|max:255',
                'email'      => 'sometimes|email|max:255',
                'password'   => 'sometimes|string|min:8|max:255',
                "first_name" => 'sometimes|string|max:255',
                "last_name"  => 'sometimes|string|max:255'
            ]);
    
            return $user->update($validateData)
                ? ResponseHelper::success($user, $this->messages['MSG_UPDATED_OK'])
                : ResponseHelper::error($this->messages['MSG_UPDATE_ERROR']);

        } catch(\Illuminate\Validation\ValidationException $e) {
            return ResponseHelper::error($e->errors(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return ResponseHelper::error($this->messages['MSG_NOT_FOUND']);
        }

        return User::destroy($id)
            ? ResponseHelper::success($user, $this->messages['MSG_DELETED_OK'])
            : ResponseHelper::error($this->messages['MSG_DELETE_ERROR']);
    }
}

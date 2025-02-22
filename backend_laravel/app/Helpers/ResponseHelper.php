<?php

namespace App\Helpers;

class ResponseHelper
{
    /**
     * Genera una respuesta de éxito estandarizada.
     *
     * @param mixed  $data
     * @param string $message
     * @param int    $status
     * @return \Illuminate\Http\JsonResponse
     */
    public static function success($data, $message = 'Operación realizada correctamente', $status = 200)
    {
        return response()->json([
            'data'    => $data,
            'message' => $message
        ], $status);
    }

    /**
     * Genera una respuesta de error estandarizada.
     *
     * @param string $message
     * @param int    $status
     * @return \Illuminate\Http\JsonResponse
     */
    public static function error($message = 'Ocurrió un error', $status = 500)
    {
        return response()->json([
            'error'   => true,
            'message' => $message
        ], $status);
    }
}

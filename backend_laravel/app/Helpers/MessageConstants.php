<?php

namespace App\Helpers;

class MessageConstants
{
    public static function getMessages(string $entity)
    {
        return [
            'MSG_NOT_FOUND'    => "Error: $entity no encontrado",
            'MSG_FIND_OK'      => "$entity encontrado",
            'MSG_UPDATED_OK'   => "$entity actualizado correctamente",
            'MSG_UPDATE_ERROR' => "Error: $entity no actualizado",
            'MSG_DELETED_OK'   => "$entity eliminado correctamente",
            'MSG_DELETE_ERROR' => "Error: $entity no eliminado",
            'MSG_CREATE_OK'    => "$entity creado correctamente",
            'MSG_CREATE_ERROR' => "Error: $entity no creado",
        ];
    }
}

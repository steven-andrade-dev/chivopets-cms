<?php

namespace App\Helpers;

class ResponseMessages
{
    public static function successList(): string
    {
        return 'Lista recuperada exitosamente.';
    }

    public static function successCreate(): string
    {
        return 'Registro creado exitosamente.';
    }

    public static function successUpdate(): string
    {
        return 'Registro actualizado exitosamente.';
    }

    public static function successChange(): string
    {
        return 'Estado actualizado correctamente.';
    }

    public static function successDelete(): string
    {
        return 'Registro eliminado exitosamente.';
    }

    public static function errorNotFound(): string
    {
        return 'El recurso no fue encontrado.';
    }

    public static function requestMsgValidate(): string
    {
        return 'Revisar campos obligatorios.';
    }

    public static function errorEception(): string
    {
        return 'Ocurrió un error, intente nuevamente.';
    }
}

<?php

/**
 * Clase HttpStatus
 * 
 * Esta clase proporciona métodos estáticos para generar respuestas HTTP con códigos de estado y mensajes asociados.
 * Cada método representa un estado HTTP común y devuelve una respuesta JSON con el código y mensaje correspondientes.
 * Los métodos están diseñados para ser utilizados en contextos donde se necesitan respuestas HTTP estándar.
 */
class HttpStatus {

    /**
     * Respuesta Informativa - Expect: 100-continue
     * @return string
     */
    public static function error() {
        return self::response(100, 'Expect: 100-continue');
    }

    /**
     * Respuesta Exitosa - OK
     * @return string
     */
    public static function ok() {
        return self::response(200, 'OK');
    }

    /**
     * Respuesta de Creación Exitosa - CREATED
     * @return string
     */
    public static function creation() {
        return self::response(201, 'CREATED');
    }

    /**
     * Redireccionamiento Permanente - MOVED PERMANENTLY
     * @return string
     */
    public static function redirect() {
        return self::response(301, 'MOVED PERMANENTLY');
    }

    /**
     * Solicitud Incorrecta - BAD REQUEST
     * @return string
     */
    public static function badRequest() {
        return self::response(400, 'BAD REQUEST');
    }

    /**
     * No Autorizado - UNAUTHORIZED
     * @return string
     */
    public static function unauthorized() {
        return self::response(401, 'UNAUTHORIZED');
    }

    /**
     * Prohibido - FORBIDDEN
     * @return string
     */
    public static function forbiden() {
        return self::response(403, 'FORBIDDEN');
    }

    /**
     * No Encontrado - NOT FOUND
     * @return string
     */
    public static function notFound() {
        return self::response(404, 'NOT FOUND');
    }

    /**
     * Método No Permitido - METHOD NOT ALLOWED
     * @return string
     */
    public static function methodNotAllowed() {
        return self::response(405, 'METHOD NOT ALLOWED');
    }

    /**
     * Error del Servidor - Server Error
     * @return string
     */
    public static function serverError() {
        return self::response(500, 'Server Error');
    }

    /**
     * Método privado para construir una respuesta JSON con el código y el mensaje proporcionados
     * @param int $code Código de estado HTTP
     * @param string $message Mensaje de estado
     * @return string
     */
    private static function response($code, $message) {
        return json_encode(['status' => $code, 'message' => $message]);
    }

}

?>

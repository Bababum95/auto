<?php

class Response {
    public static function send($data, $status = 200) {
        return new WP_REST_Response($data, $status);
    }

    public static function error($message, $status = 400) {
        return new WP_REST_Response(['error' => $message], $status);
    }
}
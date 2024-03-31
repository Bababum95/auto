<?php

class Route {

    public static function get($path, $callback) {
        register_rest_route('auto/v1', $path, array(
            'methods' => 'GET',
            'callback' => $callback
        ));
    }

    public static function post($path, $callback) {
        register_rest_route('auto/v1', $path, array(
            'methods' => 'POST',
            'callback' => $callback
        ));
    }
}
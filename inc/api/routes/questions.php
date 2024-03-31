<?php

require_once __DIR__ . '/Route.php';
require_once __DIR__ . '/../controllers/QuestionController.php';

add_filter('rest_enabled', '__return_true');
add_filter('rest_jsonp_enabled', '__return_true');
remove_filter('rest_pre_serve_request', 'rest_send_cors_headers');

add_action('rest_api_init', function () {
    Route::get('/questions/test', [QuestionController::class, 'test']);
    Route::get('/questions/(?P<category>\d+)', [QuestionController::class, 'getPostsByCategory']);
});

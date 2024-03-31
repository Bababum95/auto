<?php

require_once get_template_directory() . '/inc/api/Response.php';

class QuestionController {
    public static function getPostsByCategory($request) {
        $categoryId = $request->get_param('category');
        $posts = get_question_posts_by_category_id($categoryId);

        return Response::send($posts);
    }

    public static function test() {
        return Response::send('test');
    }
}
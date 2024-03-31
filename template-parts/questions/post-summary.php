<?php

if( empty($args['id']) ) return;
$id = $args['id'];
$question_number = get_post_meta($id, '_question_number', true);
$penalty_points = get_post_meta($id, '_penalty_points', true);

echo '<div class="question" id="question-' . $question_number . '">';
    get_template_part(
        'template-parts/questions/header',
        null,
        array('number' => $question_number, 'value' => $penalty_points)
    );

    if (!empty($args['title'])) {
        echo $args['title'];
    }

    printf('
        <a href="%s" class="question__button">
            Zur Frage übergehen ->
        </a>
        </div>',
        get_post_meta($id, '_post_link', true)
    );

<?php
if( empty($args['id']) ) return;
$id = $args['id'];
$question_number = get_post_meta($id, '_question_number', true);
$penalty_points = get_post_meta($id, '_penalty_points', true);
$answers = get_post_meta($id, '_answers', true);
$definition = get_post_field('post_content', $id);

echo '<div class="question" id="question-' . $question_number . '">';
    get_template_part(
        'template-parts/questions/header',
        null,
        array('number' => $question_number, 'value' => $penalty_points)
    );

    if (!empty($args['title'])) {
        echo $args['title'];
    }

    if(has_post_thumbnail($id)) {
        the_post_thumbnail('post-thumbnail', array('class' => 'question__image'));
    }

    if (!empty($answers) && is_array($answers)) {
        echo '<ul class="question__answers">';
        foreach ($answers as $index => $answer) {
            printf(
                '<li class="question__answer %s">
                    <span class="question__answer-mark"></span>
                    <p class="question__answer-text">%s</p>
                    <p class="question__answer-comment">%s</p>
                </li>',
                esc_attr($answer['correct'] ? 'correct' : 'incorrect'),
                esc_html($answer['text']),
                esc_html($answer['comment'])
            );
        }
        echo '</ul>';
    }

    if (!empty($definition)) {
        printf('
            <div class="question__definition">
                <p class="question__definition-title">Question Definition</p>
                %s
            </div>',
            $definition,
        );
    }

echo '</div>';

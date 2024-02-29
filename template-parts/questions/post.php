<?php
if( empty($args['id']) ) return;
$id = $args['id'];
$question_number = get_post_meta($id, '_question_number', true);
$penalty_points = get_post_meta($id, '_penalty_points', true);
$answers = get_post_meta($id, '_answers', true);

?>
<div class="question" id="question-<?php echo $question_number; ?>">
    <div class="question__header">
        <span class="question__number"><?php echo $question_number; ?></span>
        <span class="question__points"><?php echo $penalty_points; ?> балла</span>
    </div>
    <?php

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
    ?>
    <div class="question__definition">
        <p class="question__definition-title">Question Definition</p>
        <?php the_content(); ?>
    </div>
</div>

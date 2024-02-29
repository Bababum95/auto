<?php
$args = array(
    'post_type'      => 'theory-exam-question',
    'posts_per_page' => -1,
);

$query = new WP_Query($args);

if ($query->have_posts()) {
    echo '<div ' . get_block_wrapper_attributes() . '>';
    while ($query->have_posts()) {
        $query->the_post();
        get_template_part(
            'template-parts/questions/post',
            null,
            array(
                'id' => get_the_ID(),
                'title' => '<h2 class="question__title">' . get_the_title() . '</h2>',
            ));
    }
    echo '</div>';
    wp_reset_postdata();
}
?>


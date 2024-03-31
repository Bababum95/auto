<?php
/**
 *  Render the post content.
 */
$current_category_id = get_query_var('cat');
$posts = get_question_posts_by_category_id($current_category_id);

if (empty($posts)) return;

printf('
    <div %s>
        %s
        <div class="wp-block-auto-questions-posts__observed">
            Loading...
        </div>
    </div>',
    get_block_wrapper_attributes(),
    $posts
);


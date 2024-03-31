<?php
/**
 *  Render the post content.
 */
echo $content;

$icons = [];
foreach ($attributes['data'] as $item) {
    if (!empty($item['icon'])) {
        $icons[] = 'social/' . $item['icon'];
    }
}


if(empty($icons)) return;

echo generate_svg_sprite($icons);

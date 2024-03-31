<?php
/**
 * The `generate_svg_sprite` function creates an SVG sprite by combining multiple SVG icons and
 * optionally setting their colors to currentColor.
 * 
 * @param array $icons An array containing the names of the SVG icons you want to include in the SVG sprite.
 * Each icon name corresponds to an SVG file located in the specified directory.
 * @param bool $currentColor A boolean parameter that determines whether the SVG icons should be styled with
 * the current color or not.
 * 
 * @return string Returns a string containing an SVG sprite that includes symbols for each icon specified
 * in the input array. The SVG sprite is generated by reading individual SVG files from a directory, modifying
 * their content to use the currentColor for fill and stroke if specified, and then combining them into a single
 * SVG sprite.
 */
function generate_svg_sprite(array $icons, $currentColor = true): string {
    $sprite = '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">';
    $dir = get_template_directory_uri() . '/dist/svg';
    foreach ($icons as $icon) {
        $svgContent = file_get_contents("{$dir}/{$icon}.svg");

        $start = strpos($svgContent, '<svg');
        $end = strpos($svgContent, '>', $start);

        $svgTeg = substr($svgContent, $start, $end - $start + 1);
        preg_match('/viewBox="([^"]+)"/', $svgTeg, $matches);
        $viewBox = $matches[1];
        $svgContent = str_replace($svgTeg, '', $svgContent);
        $svgContent = str_replace('</svg>', '', $svgContent);

        if($currentColor) {
            $svgContent = preg_replace('/fill="(?!none)(.*?)"/', 'fill="currentColor"', $svgContent);
            $svgContent = preg_replace('/stroke="(?!none)(.*?)"/', 'stroke="currentColor"', $svgContent);
        }

        $symbol = "<symbol preserveAspectRatio='none' id='{$icon}' viewBox='{$viewBox}'>{$svgContent}</symbol>";
        $sprite .= $symbol;
    }

    if (defined('WP_DEBUG') && WP_DEBUG) {
        $weight = strlen($sprite);
        $sprite .= "<!-- Weight: {$weight} bytes -->";
    }

    $sprite .= '</svg>';
    return $sprite;
}

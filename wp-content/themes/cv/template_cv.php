<?php
/* Template Name: CV */
wp_head();
function improved_trim_excerpt($text) {
    global $post;
    if ( '' == $text ) {
        $text = get_the_content('');
        $text = apply_filters('the_content', $text);
        $text = str_replace(']]>', ']]&gt;', $text);
        $text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text);
        $text = strip_tags($text, '<p><a><strong><br /><font><h2><h3><span>');
        $excerpt_length = 80;
        $words = explode(' ', $text, $excerpt_length + 1);
        if (count($words)> $excerpt_length) {
            array_pop($words);
            array_push($words, '[...]');
            $text = implode(' ', $words);
        }
    }
    return $text;
}

$categories = get_categories();
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'improved_trim_excerpt');

foreach( $categories as $category ) {
    $args = array('posts_per_page' => 6, "category" => $category->cat_ID);
    $posts = get_posts($args);
    $category_link = sprintf(
        '<h2><a href="%1$s" alt="%2$s">%3$s</a></h2>',
        esc_url( get_category_link( $category->term_id ) ),
        esc_attr( sprintf( __( 'textdomain' ), $category->name ) ),
        esc_html( $category->name )
    );

    echo $category_link;
    foreach ($posts as $post) {
        if(has_tag('test')) {
            echo "<div class='tags'>";
        }
        else {
            echo "<div>";
        }
        setup_postdata($post);
        the_title("<h3>", "</h3>");
        the_excerpt();
        edit_post_link( $link, $before, $after, $id, $class );
        echo "</div>";
    }
}
?>

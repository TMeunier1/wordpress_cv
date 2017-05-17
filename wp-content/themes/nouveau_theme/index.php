<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package CEUVEU
 */
wp_enqueue_style('CEUVEU', get_stylesheet_directory_uri().'/style.css');
get_header();
$categories=get_categories(array(
    'orderby' => 'id',
    'order' => 'ASC'
));
?>
<header>
    <nav>
        <ul>
            <?php
            foreach ($categories as $category) {
                echo '<li><a href=#'.$category->slug.'>'.$category->name.'</a></li>';
            }
            ?>
        </ul>
    </nav>
</header>
<main>
    <?php
    foreach($categories as $category) {
        $args=array(
            'showposts' => -1,
            'category__in' => array($category->term_id),
            'caller_get_posts'=>1
        );
        $posts=get_posts($args);
        if ($posts) {
            $cat_slug = get_term_by('slug');
            $category_link = get_category_link($cat_slug);
            echo '<h2 id='.$category->slug.'>'.$category->name.'</h2>';
            foreach($posts as $post) {
                setup_postdata($post);
                $mykey_values = get_post_custom_values('Date');
                foreach ($mykey_values as $value) {
                    ?>
                    <h3><?php echo "$value"; }?></h3>
                    <h4><?php the_title(); ?></h4>
                    <p><?php echo $post->post_content; ?></p>
                    <?php
                }
            }
        }
        ?>
</main>
<?php get_footer(); ?>

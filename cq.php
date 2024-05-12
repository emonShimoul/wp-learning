<?php
/**
 * Template Name: Custom Query
 */
?>

<?php get_header(); ?>
<body <?php body_class(); ?>>
<?php get_template_part("/template-parts/common/hero"); ?>

<div class="posts text-center">
    <?php
    $paged = get_query_var("paged")?get_query_var("paged"):1;
    $posts_per_page = 2;
    $post_ids = array(105, 107, 8, 12, 1);
    $_p = get_posts(array(
        'posts_per_page' => $posts_per_page,
        'post__in' => $post_ids,
        'orderby' => 'post__in',
        'paged' => $paged
        // 'order'=>'asc'
    ));
    foreach($_p as $post){
        setup_postdata($post);
        ?>
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <?php
    }
    // ovbiously have to call whenever the get_posts() function is used
    wp_reset_postdata();
    ?>

<div class="container post-pagination">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-8">
                <?php
                    echo paginate_links( array(
                        'total'=> ceil(count($post_ids) / $posts_per_page)
                    ));
                ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
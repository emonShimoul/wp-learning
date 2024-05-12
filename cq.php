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
    $_p = get_posts(array(
        'post__in'=>array(105,107,8),
        'orderby' => 'post__in'
        // 'order'=>'asc'
    ));
    foreach($_p as $post){
        setup_postdata($post);
        ?>
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <?php
    }
    ?>
</div>
<?php get_footer(); ?>
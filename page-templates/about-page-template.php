<?php
/*
* Template Name: About Page Template
*/

get_header(); 
?>

<body <?php body_class(); ?>>
<?php get_template_part("/template-parts/about-page/hero-page"); ?>

<div class="posts">
    <?php
    while(have_posts()){
        the_post();
    ?>
    <div class="post" <?php post_class(); ?>>
        <div class="container">
            <div class="row">

                <div class="col-md-10 offset-md-1">
                    <h2 class="post-title text-center"><?php the_title(); ?></h2>
                    <p class="text-center">
                        <strong><?php the_author(); ?></strong><br/>
                        <?php the_date(); ?>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <h2 class="text-center">
                        <!-- 
                            _e() means that the text will be translatable.
                            If we want to make any text translatable then we need to use _e(). 
                        -->
                        <?php _e("Testimonials","alpha") ?>
                    </h2>
                    <div class="testimonials text-center">
                        <?php
                        if ( class_exists( 'Attachments' ) ) {
                            $attachments = new Attachments( 'testimonials' );
                            if ( $attachments->exist() ) {
                                while ( $attachment = $attachments->get() ) { ?>
                                    <div>
                                        <?php echo $attachments->image( 'thumbnail' ); ?>
                                        <h4><?php echo esc_html($attachments->field( 'name' )); ?></h4>
                                        <p><?php echo esc_html($attachments->field( 'testimonial' )); ?></p>
                                        <p>
                                            <?php echo esc_html($attachments->field( 'position' )); ?>,
                                            <strong>
                                            <?php echo esc_html($attachments->field( 'company' )); ?>
                                            </strong>
                                        </p>
                                    </div>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                
                <div class="col-md-10 md-offset-1 text-center">
                    <p>
                        <?php
                        if(has_post_thumbnail()){
                            $thumbnail_url = get_the_post_thumbnail_url(null, "large");
                            // echo '<a href="'.$thumbnail_url'" data-featherlight="image">';
                            printf('<a href="%s" data-featherlight="image">', $thumbnail_url);
                            the_post_thumbnail("large", "class='img-fluid'");
                            echo '</a>';
                        }
                        ?>
                    </p>

                    <?php
                        the_content();

                        // next_post_link();
                        // echo "<br/>";
                        // previous_post_link();
                    ?>
                </div>

            </div>

        </div>
    </div>
    <?php
    }
    ?>
    
    <div class="container post-pagination">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-8">
                <?php
                    the_posts_pagination( array(
                        "screen_reader_text"=>' ',
                        "prev_text"=>"New Posts",
                        "next_text"=>"Old Posts"
                    ) );
                ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
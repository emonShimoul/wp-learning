<?php get_header(); ?>
<body <?php body_class(); ?>>
<?php get_template_part("/template-parts/common/hero"); ?>

<div class="posts">
    <?php
    while(have_posts()){
        the_post();
    ?>
    <div <?php post_class(); ?>>
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
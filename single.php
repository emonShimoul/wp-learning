<?php get_header(); ?>
<body <?php body_class(); ?>>
<?php get_template_part("/template-parts/common/hero"); ?>

<div class="container">
    <div class="row">
        <?php if(is_active_sidebar("sidebar-1")){ ?>
        <div class="col-md-8">
            <?php }else{ ?>
            <div class="col-md-10 offset-md-1">
            <?php } ?>
            <div class="posts">
                <?php
                while(have_posts()){
                    the_post();
                ?>
                <div <?php post_class(); ?>>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="post-title"><?php the_title(); ?></h2>
                                <p class="">
                                    <strong><?php the_author(); ?></strong><br/>
                                    <?php the_date(); ?>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
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

                                    wp_link_pages();

                                    // next_post_link();
                                    // echo "<br/>";
                                    // previous_post_link();
                                ?>
                            </div>

                            <div class="authorsection">
                                <div class="row">
                                    <div class="col-md-2 authorimage">
                                        <?php echo get_avatar(get_the_author_meta("id")); ?>
                                    </div>
                                    <div class="col-md-10">
                                        <h4><?php echo get_the_author_meta("display_name"); ?></h4>
                                        <p><?php echo get_the_author_meta("description"); ?></p>
                                    </div>
                                </div>
                            </div>

                            <?php if(comments_open()): ?>
                                <div class="col-md-10 offset-md-1">
                                    <?php
                                        comments_template();
                                    ?>
                                </div>
                            <?php endif; ?>
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
        </div>
        <?php if(is_active_sidebar("sidebar-1")){ ?>
        <div class="col-md-4">
            <?php
                if(is_active_sidebar("sidebar-1")){
                    dynamic_sidebar("sidebar-1");
                }
            ?>
        </div>
        <?php } ?>
    </div>
</div>


<?php get_footer(); ?>
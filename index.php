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
                <div class="col-md-12">
                    <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <p>
                        <strong><?php the_author(); ?></strong><br/>
                        <?php the_date(); ?>
                    </p>
                    <?php echo get_the_tag_list("<ul class=\"list-unstyled\"><li>","</li><li>","</li></ul>"); ?>

                    <?php
                    $alpha_format = get_post_format();
                    if($alpha_format=="audio"){
                        echo '<span class="dashicons dashicons-format-audio"></span>';
                    }else if($alpha_format=="video"){
                        echo '<span class="dashicons dashicons-format-video"></span>';
                    }else if($alpha_format=="image"){
                        echo '<span class="dashicons dashicons-format-image"></span>';
                    }else if($alpha_format=="quote"){
                        echo '<span class="dashicons dashicons-format-quote"></span>';
                    }else if($alpha_format=="link"){
                        echo '<span class="dashicons dashicons-admin-links"></span>';
                    }
                    ?>
                </div>
                <div class="col-md-8">
                    <p>
                        <?php
                        if(has_post_thumbnail()){
                            the_post_thumbnail("large", "class='img-fluid'");
                        }
                        ?>
                    </p>

                    <?php
                        // if(!post_password_required()){
                        //     the_excerpt();
                        // }else{
                        //     echo get_the_password_form();
                        // }
                        the_excerpt();
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
<?php
if(class_exists('Attachments')){
    // die();
    require_once "lib/attachments.php";
}

if(site_url()=="http://localhost/wordpress"){
    define("VERSION", time());
}else{
    define("VERSION", wp_get_theme()->get("Version"));
}

function alpha2_bootstrapping(){
    load_theme_textdomain("alpha2");
    add_theme_support("post-thumbnails");
    add_theme_support("title-tag");
    add_theme_support( 'html5', array( 'search-form' ) );
    $alpha_custom_header_details = array(
        'header-text'           => true,
        'default-text-color'    => '#222',
        'width'                 =>  1200,
        'height'                => 600,
        'flex-height'           => true,
        'flex-width'            => true
    );
    add_theme_support("custom-header", $alpha_custom_header_details);

    $alpha_custom_logo_defaults = array(
        "width" => '100',
        "height" => '100'
    );
    add_theme_support("custom-logo", $alpha_custom_logo_defaults);
    
    add_theme_support("custom-background");

    register_nav_menu("topmenu", __("Top Menu", "alpha2"));
    register_nav_menu("footermenu", __("Footer Menu", "alpha2"));

    add_theme_support( "post-formats", array("image", "quote", "video", "audio", "link") );

    add_image_size( 'alpha-square',400,400,true );
    // add_image_size( 'alpha-potrait', 400, 9999 );
    // add_image_size( 'alpha-landscape', 9999, 400 );
    // add_image_size( 'alpha-landscape-hard-cropped', 800, 300 );
    add_image_size( 'alpha-square-new1',401,401,array("left","top") );
    add_image_size( 'alpha-square-new2',500,500,array("center","center") );
    add_image_size( 'alpha-square-new2',600,600,array("right","center") );
}
add_action("after_setup_theme", "alpha2_bootstrapping");

// to load css and bootstrap file
function alpha2_assets(){
    wp_enqueue_style("bootstrap", "//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css");
    wp_enqueue_style("featherlight-css", "//cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.css");
    wp_enqueue_style("dashicons");
    wp_enqueue_style("tns-style", "https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css");
    wp_enqueue_style("alpha2", get_stylesheet_uri(), null, VERSION);
    wp_enqueue_script("tns-js", "https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js",null, "0.0.1", true);
    wp_enqueue_script("featherlight-js", "//cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.js",array("jquery"), "0.0.1", true);

    // old system to load internal js
    // wp_enqueue_script("alpha2-main", get_template_directory_uri()."/assets/js/main.js",null,"0.0.1",true);
    // new system to load internal js (only work from the wordpress version 4.7)
    wp_enqueue_script("alpha2-main", get_theme_file_uri("/assets/js/main.js"),null,VERSION,true);
}
add_action("wp_enqueue_scripts", "alpha2_assets");

function alpha2_sidebar(){
    register_sidebar(
        array(
            'name'      => __('Single Post Sidebar', 'alpha2'),
            'id'        => 'sidebar-1',
            'description' => __('Right Sidebar', 'alpha2'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );

    register_sidebar(
        array(
            'name'      => __('Footer Left', 'alpha2'),
            'id'        => 'footer-left',
            'description' => __('Widgetized Area On The Left Side', 'alpha2'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '',
            'after_title'   => '',
        )
    );

    register_sidebar(
        array(
            'name'      => __('Footer Right', 'alpha2'),
            'id'        => 'footer-right',
            'description' => __('Widgetized Area On The Right Side', 'alpha2'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '',
            'after_title'   => '',
        )
    );
}
add_action( "widgets_init", "alpha2_sidebar" );

function alpha2_the_excerpt($excerpt){
    if(!post_password_required()){
        return $excerpt;
    }else{
        echo get_the_password_form();
    }
}
add_filter("the_excerpt", "alpha2_the_excerpt");

function alpha2_protected_title_change(){
    return "%s";
}
add_filter("protected_title_format", "alpha2_protected_title_change");

function alpha_menu_item_class($classes, $item){
    $classes[] = "list-inline-item";
    return $classes;
}
add_filter("nav_menu_css_class", "alpha_menu_item_class", 10, 2);

if(!function_exists("alpha_about_page_template_banner")){
    function alpha_about_page_template_banner(){
        if(is_page()){
            $alpha_feat_image = get_the_post_thumbnail_url(null, "large");
        ?>
        <style>
            .page-header{
                background-image: url(<?php echo $alpha_feat_image; ?>);
            }
        </style>
        <?php
        }
    
        if(is_front_page()){
            if(current_theme_supports("custom-header")){
                ?>
                <style>
                    .header{
                        background-image: url(<?php echo header_image(); ?>);
                        margin-bottom: 50px;
                    }
    
                    .header h1.heading a, h3.tagline{
                        color: #<?php echo get_header_textcolor(); ?>;
    
                        <?php
                        if(!display_header_text()){
                            echo "display: none;";
                        }
                        ?>
                    }
                </style>
                <?php
            }
        }
    }
}

add_action("wp_head", "alpha_about_page_template_banner", 11);

function alpha_body_class($classes){
    unset($classes[array_search("custom-background", $classes)]);
    unset($classes[array_search("single-format-standard", $classes)]);
    $classes[] = "newclass"; // it will add a new class in the body tag
    return $classes;
}
add_filter("body_class", "alpha_body_class");

function alpha_post_class($classes){
    unset($classes[array_search("format-standard", $classes)]);
    return $classes;
}
add_filter("post_class", "alpha_post_class");


// To highlight the searched result
function alpha2_highlight_search_results($text){
    if(is_search()){
        // Use of regural expression
        $pattern = '/('.join('|', explode(' ', get_search_query())).')/i';
        $text = preg_replace($pattern, '<span class="search-highlight">\0</span>', $text);
    }
    return $text;
}
add_filter('the_content', 'alpha2_highlight_search_results');
add_filter('the_excerpt', 'alpha2_highlight_search_results');
add_filter('the_title', 'alpha2_highlight_search_results');

// To remove wordpress default behavior of applying src set.
// It creates an issue with cropping image
function alpha_image_srcset(){
    return null;
}
add_filter("wp_calculate_image_srcset", "alpha_image_srcset");

if(!function_exists("alpha_todays_date")){
    function alpha_todays_date(){
        echo date("d/m/y");
    }
}
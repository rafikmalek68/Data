<?php

////////////////////////////////////////////////////////////
//////                                                 ////
/////                                                 ////
////   Custom post type display                      ////
///                                                 ////
//                                                 ////
//////////////////////////////////////////////////////

$query = new WP_Query(array('post_type' => 'post', 'category_name' => 'News', 'posts_per_page' => 2));
while ($query->have_posts()) : $query->the_post();
    $thumb_id = get_post_thumbnail_id();
    $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
    $thumb_url = $thumb_url_array[0];
    $thumb_url;
    the_title();
    $dt = get_the_date();
    $date = new DateTime($dt);
    $date->format('M d, Y');
    the_content();
endwhile;
wp_reset_query();

////////////////////////////////////////////////////////////
//////                                                 ////
/////                                                 ////
////   ACF repeater display                          ////
///                                                 ////
//                                                 ////
//////////////////////////////////////////////////////

if (get_field('accordion_list')) {
    $i = 1;
    while (has_sub_field('accordion_list')):
        the_sub_field('accordion_description');
        $i++;
    endwhile;
}

//For single ACF
the_field('accordion_image');

////////////////////////////////////////////////////////////
//////                                                 ////
/////                                                 ////
////   Theme Seting menu for admin side              ////
///                                                 ////
//                                                 ////
//////////////////////////////////////////////////////

if (function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
        'page_title' => 'Theme General Settings',
        'menu_title' => 'Theme Settings',
        'menu_slug' => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect' => false
    ));

    acf_add_options_sub_page(array(
        'page_title' => 'Theme Header Settings',
        'menu_title' => 'Header',
        'parent_slug' => 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' => 'Theme Footer Settings',
        'menu_title' => 'Footer',
        'parent_slug' => 'theme-general-settings',
    ));
}


////////////////////////////////////////////////////////////
//////                                                 ////
/////                                                 ////
////   Register sidebar                              ////
///                                                 ////
//                                                 ////
////////////////////////////////////////////////////// 

function twentythirteen_widgets_init() {
    register_sidebar(array(
        'name' => __('Main Widget Area', 'twentythirteen'),
        'id' => 'sidebar-1',
        'description' => __('Appears in the footer section of the site.', 'twentythirteen'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Secondary Widget Area', 'twentythirteen'),
        'id' => 'sidebar-2',
        'description' => __('Appears on posts and pages in the sidebar.', 'twentythirteen'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => __('Woocommerce cart', 'twentyfifteen'),
        'id' => 'woocommerce-cart',
        'description' => __('Add widgets here to appear in your sidebar.', 'twentyfifteen'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}

// Call sidebar
dynamic_sidebar('woocommerce-cart');

////////////////////////////////////////////////////////////
//////                                                 ////
/////                                                 ////
////  Call Nav menu                                  ////
///                                                 ////
//                                                 ////
////////////////////////////////////////////////////// 

wp_nav_menu(array(
    'menu' => 'main-menu',
    'menu_class' => '',
    'container' => false
));

////////////////////////////////////////////////////////////
//////                                                 ////
/////                                                 ////
////  Call  woocommerce_breadcrumb();                ////
///                                                 ////
//                                                 ////
////////////////////////////////////////////////////// 

woocommerce_breadcrumb();

////////////////////////////////////////////////////////////
//////                                                 ////
/////                                                 ////
////  WPML language                                  ////
///                                                 ////
//                                                 ////
////////////////////////////////////////////////////// 

echo ICL_LANGUAGE_CODE;


////////////////////////////////////////////////////////////
//////                                                 ////
/////                                                 ////
////  Insert custom post data                        ////
///                                                 ////
//                                                 ////
////////////////////////////////////////////////////// 
$wpdb->insert(
    'wp_posts', array(
    'post_author' => 1,
    'post_date' => date("Y-m-d  h:i:s"),
    'post_date_gmt' => date("Y-m-d  h:i:s"),
    'post_content' => $description,
    'post_title' => $title,
    'post_excerpt' => '',
    'post_status' => 'publish',
    'comment_status' => 'closed',
    'post_name' => $title,
    'ping_status' => 'closed',
    'to_ping' => '',
    'pinged' => '',
    'post_modified' => date("Y-m-d  h:i:s"),
    'post_modified_gmt' => date("Y-m-d  h:i:s"),
    'post_content_filtered' => '',
    'post_parent' => 0,
    'menu_order' => 0,
    'post_type' => 'subscription',
    'comment_count' => 0
        )
);


$sub_post_id = $wpdb->insert_id;

add_post_meta($sub_post_id, 'first_name', $fname, 'true');
add_post_meta($sub_post_id, 'last_name', $lname, 'true');
add_post_meta($sub_post_id, 'email', $title, 'true');
add_post_meta($sub_post_id, 'phone', $phone, 'true');

///////////////////////////////////////////////////////
//                                                 ////
//                                                 ////
//                                                 ////
///////////////////////////////////////////////////////
//                                                 ////
//  Insert custom post data   2.6                  ////
//                                                 ////
//                                                 ////
//                                                 ////
//                                                 ////
//                                                 ////
//////////////////////////////////////////////////////

  
echo __($settings['header_text'], 'filterpage');


get_permalink(get_page_by_path('map'));
get_permalink();
get_permalink(get_page_by_title('Map'));
home_url('/map/');
home_url();



//trim content
$content = get_the_content();
$trimmed_content = wp_trim_words( $content, 10, '...' );
echo $trimmed_content; 
$id = icl_object_id($post->ID, 'page', false, ICL_LANGUAGE_CODE);
echo __('Benefit now from the high-grade tuning software at an affordable price.', 'filterpage');
?>        
<?php the_field('field_name', 'option'); 
//    sudo -s
 //   chmod -R 777 /var/www/html/testing/wp-content/

?>



    

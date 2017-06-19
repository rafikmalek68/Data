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
////////////////////////////////////////////////////////////////////////

add_action('wp_ajax_my_action', 'my_action');

function my_action() {

    global $wpdb;
    $cat_ids = $_POST['cat_ids'];
    $from = $_POST['from'];
    $to = $_POST['to'];

    $d = explode(',', $cat_ids);
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'paged' => $paged,
        'post_status' => 'publish',
        
        'meta_query' => array(
            array(
                'key' => '_price',
                'value' => $from,
                'compare' => '>='
            ),
            array(
                'key' => '_price',
                'value' => $to,
                'compare' => '<='
            )
        ),
        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => $d,
            ),
        ),
        
    );

    $query = new WP_Query($args);

    while ($query->have_posts()) : $query->the_post();
        wc_get_template_part('content', 'product');
    endwhile;

    
    wp_die();
}

add_filter('widget_text', 'do_shortcode');

function get_filter($atts) {

    $taxonomy = 'product_cat';
    $orderby = 'name';
    $show_count = 1;      // 1 for yes, 0 for no
    $pad_counts = 0;      // 1 for yes, 0 for no
    $hierarchical = 1;      // 1 for yes, 0 for no  
    $title = '';
    $empty = 0;

    $args = array(
        'taxonomy' => $taxonomy,
        'orderby' => $orderby,
        'show_count' => $show_count,
        'pad_counts' => $pad_counts,
        'hierarchical' => $hierarchical,
        'title_li' => $title,
        'hide_empty' => $empty
    );
    $all_categories = get_categories($args);

    $output.='<ul class="product-categories">';
    foreach ($all_categories as $cat) {
        if ($cat->category_parent == 0) {
            $category_id = $cat->term_id;
            $output.= '<li class="cat-item cat-item-17"><input type="checkbox" class="filter_cat" value="' . $cat->slug . '" />' . $cat->name . '</li>';
            $args2 = array(
                'taxonomy' => $taxonomy,
                'child_of' => 0,
                'parent' => $category_id,
                'orderby' => $orderby,
                'show_count' => $show_count,
                'pad_counts' => $pad_counts,
                'hierarchical' => $hierarchical,
                'title_li' => $title,
                'hide_empty' => $empty
            );
            $sub_cats = get_categories($args2);
            if ($sub_cats) {
                foreach ($sub_cats as $sub_category) {
                    $output.= $sub_category->name;
                }
            }
        }
    }

    $output.='</ul>';
    return $output;
}

add_shortcode('myfilter', 'get_filter'); //[myfilter]


?>
<script>var ajaxurl = "<?php echo admin_url('admin-ajax.php') ?>";</script>
<script>
jQuery(document).ready(function () {

    jQuery(".price_slider_wrapper .button").attr("type", "button");
    jQuery(".price_slider_wrapper .button").click(function () {
        var favorite = [];
        var cat_ids = '';
        var fromval = '';
        var toval = '';
        jQuery.each(jQuery(".filter_cat:checked"), function () {
            favorite.push(jQuery(this).val());
        });

        var fromval = jQuery(".price_label .from").text();
        var toval = jQuery(".price_label .to").text();
        var fromval = fromval.replace(/^\D+/g, '');
        var toval = toval.replace(/^\D+/g, '');

        cat_ids = favorite.join(", ");
        var data = {
            'action': 'my_action',
            'cat_ids': cat_ids,
            'from': fromval,
            'to': toval,
        };
        jQuery.post(ajaxurl, data, function (response) {
            jQuery(".products").html("");
            jQuery(".products").html(response);
        });


    });


    jQuery(".filter_cat").change(function () {
        
        var favorite = [];
        var cat_ids = '';
        var fromval = '';
        var toval = '';
        jQuery.each(jQuery(".filter_cat:checked"), function () {
            favorite.push(jQuery(this).val());
        });

        var fromval = jQuery(".price_label .from").text();
        var toval = jQuery(".price_label .to").text();
        var fromval = fromval.replace(/^\D+/g, '');
        var toval = toval.replace(/^\D+/g, '');

        cat_ids = favorite.join(", ");
        var data = {
            'action': 'my_action',
            'cat_ids': cat_ids,
            'from': fromval,
            'to': toval,
        };
        jQuery.post(ajaxurl, data, function (response) {
            jQuery(".products").html("");
            jQuery(".products").html(response);
        });

    });

});


</script>



    

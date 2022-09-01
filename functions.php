<?php
add_filter('show_admin_bar', '__return_false');

remove_action('wp_head',             'print_emoji_detection_script', 7 );
remove_action('admin_print_scripts', 'print_emoji_detection_script' );
remove_action('wp_print_styles',     'print_emoji_styles' );
remove_action('admin_print_styles',  'print_emoji_styles' );

remove_action('wp_head', 'wp_resource_hints', 2 );          //remove dns-prefetch
remove_action('wp_head', 'wp_generator');                   //remove meta name="generator"
remove_action('wp_head', 'wlwmanifest_link');               //remove wlwmanifest
remove_action('wp_head', 'rsd_link');                       //remove EditURI
remove_action('wp_head', 'rest_output_link_wp_head');       //remove 'https://api.w.org/
remove_action('wp_head', 'rel_canonical');                  //remove canonical
remove_action('wp_head', 'wp_shortlink_wp_head', 10);       //remove shortlink
remove_action('wp_head', 'wp_oembed_add_discovery_links');  //remove alternate

// styles
add_action('wp_enqueue_scripts', 'site_styles');
function site_styles () {
    $version = '0.1';
    wp_enqueue_style('slick-style-1', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', [], $version);
    wp_enqueue_style('slick-style-2', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css', [], $version);
    wp_enqueue_style('select', get_template_directory_uri() . '/assets/css/nice-select.css', [], $version);
    wp_enqueue_style('theme-style', get_stylesheet_uri());
    wp_enqueue_style('main-style', get_template_directory_uri() . '/assets/css/style.css', [], $version);
    if(is_page_template('front-page.php')){
        wp_enqueue_style('front-page-style', get_template_directory_uri() . '/assets/css/home.css', [], $version);
    }
    if(is_page_template('study-directions-page.php')){
        wp_enqueue_style('study-directions-style', get_template_directory_uri() . '/assets/css/study-directions.css', [], $version);
    }
    if(is_search()){
        wp_enqueue_style('search-style', get_template_directory_uri() . '/assets/css/search.css', [], $version);
    }
    if(is_archive()){
        wp_enqueue_style('archive-style', get_template_directory_uri() . '/assets/css/archive.css', [], $version);
    }
    if (is_single()) {
        wp_enqueue_style('project-style', get_template_directory_uri() . '/assets/css/project.css', [], $version);
    }

}

// scripts
add_action('wp_enqueue_scripts', 'site_scripts');
function site_scripts() {
    $version = '0.1';
    wp_deregister_script('jquery');
	wp_enqueue_script('jquery', '//code.jquery.com/jquery-3.6.1.min.js', [], $version , true);
    wp_enqueue_script('nice-select', get_template_directory_uri() . '/assets/js/jquery.nice-select.min.js', [], $version , true);
    wp_enqueue_script('slick', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', [], $version , true);
    if(is_page_template('front-page.php')){
        wp_enqueue_script('main', get_template_directory_uri() . '/assets/js/main.js', [], $version , true);
    }
    if(is_page_template('study-directions-page.php')){
        wp_enqueue_script('study-directions', get_template_directory_uri() . '/assets/js/study-directions.js', [], $version, true);
    }

}

// Carbon Fields
add_action( 'after_setup_theme', 'crb_load' );
function crb_load() {
	require_once( 'includes/carbon-fields/vendor/autoload.php' );
	\Carbon_Fields\Carbon_Fields::boot();
}

add_action('carbon_fields_register_fields', 'register_carbon_fields');
function register_carbon_fields () {
    require_once('includes/carbon-fields-options/theme-options.php');
    require_once('includes/carbon-fields-options/post-meta.php');
}

// Theme support
add_theme_support( 'title-tag' );
add_theme_support( 'custom-logo' );
add_theme_support('post-thumbnails');
add_image_size('product', 500, 313, true);

// Global variables

// hide front page text editor
function disable_content_editor()
{
    if (isset($_GET['post'])) {
        $post_ID = $_GET['post'];
    } else if (isset($_POST['post_ID'])) {
        $post_ID = $_POST['post_ID'];
    }

    if (!isset($post_ID) || empty($post_ID)) {
        return;
    }

    $page_template = get_post_meta($post_ID, '_wp_page_template', true);
    if ($page_template == 'front-page.php') {
        remove_post_type_support('page', 'editor');
    }
}
add_action('admin_init', 'disable_content_editor');

// include the menu etc
add_action( 'after_setup_theme', 'theme_support' );
function theme_support() {
  register_nav_menu( 'main_menu', 'Main menu' );
  register_nav_menu( 'footer_menu', 'Footer menu' );
}

/*
* Creating a function to create our CPT
*/
// Locations
add_action( 'init', 'register_post_types' );
function register_post_types() {
  register_post_type('project', [
    'labels' => [
      'name'               => 'Проекти', // основное название для типа записи
      'singular_name'      => 'Проект', // название для одной записи этого типа
      'add_new'            => 'Додати проект', // для добавления новой записи
      'add_new_item'       => 'Додавання проекту', // заголовка у вновь создаваемой записи в админ-панели.
      'edit_item'          => 'Редагування проекту', // для редактирования типа записи
      'new_item'           => 'Нова проект', // текст новой записи
      'view_item'          => 'Подивитися проект', // для просмотра записи этого типа.
      'search_items'       => 'Знайти проект', // для поиска по этим типам записи
      'not_found'          => 'Не знайдено', // если в результате поиска ничего не было найдено
      'not_found_in_trash' => 'Не знайдено у корзині', // если не было найдено в корзине
      'menu_name'          => 'Проекти', // название меню
    ],
    'menu_icon'          => 'dashicons-portfolio',
    'public'             => true,
    'menu_position'      => 5,
    'supports'           => ['title', 'thumbnail', 'page-attributes'],
    'has_archive'        => true,
    'rewrite'            => ['slug' => 'projects'],
    // 'numberposts'        => -1
   ] );

// Offers category
   register_taxonomy('project-categories', 'project', [
    'labels'        => [
      'name'                        => 'Категорії',
      'singular_name'               => 'Категорія проекту',
      'search_items'                => 'Шукати категорії',
      'popular_items'               => 'Популярні категорії',
      'all_items'                   => 'Усі категорії',
      'edit_item'                   => 'Редагувати категорію',
      'update_item'                 => 'Оновити категорію',
      'add_new_item'                => 'Додати нову категорію',
      'new_item_name'               => 'Нова назва категорії',
      'separate_items_with_commas'  => 'Відділити категорію комами',
      'add_or_remove_items'         => 'Додати або видалити категорію',
      'choose_from_most_used'       => 'Обрати найпопулярнішу категорію',
      'menu_name'                   => 'Категорії',
    ],
    'hierarchical'  => true,
  ]);
}


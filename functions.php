<?php
/**
 * WP-AI Framework - Functions
 */

// 0. Theme Setup
add_action('after_setup_theme', function() {
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
});

// 1. Enqueue Scripts y Tailwind CSS compilado
add_action('wp_enqueue_scripts', function() {
    // Tailwind CSS
    wp_enqueue_style(
        'wp-ai-tailwind', 
        get_template_directory_uri() . '/assets/css/style.css', 
        [], 
        filemtime(get_template_directory() . '/assets/css/style.css')
    );

    // GSAP Core
    wp_enqueue_script(
        'gsap', 
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js', 
        [], 
        '3.12.5', 
        true
    );

    // Custom Cursor Trail
    $cursor_script_path = get_template_directory() . '/assets/js/cursor-trail.js';
    if (file_exists($cursor_script_path)) {
        wp_enqueue_script(
            'wp-ai-cursor-trail', 
            get_template_directory_uri() . '/assets/js/cursor-trail.js', 
            ['gsap'], 
            filemtime($cursor_script_path),
            true
        );
    }
});

// 2. Definir Render Engine 
// (En el futuro esto vendrá de un plugin, por ahora vive en el tema para el Sprint 0.5)
function wp_ai_render_component($component_id, $variant, $data) {
    // Escapar datos de forma recursiva según las mejores prácticas
    // (Simplificado para el prototipo)
    
    // Aquí el adaptador busca en la carpeta de componentes sincronizada
    // Nota: para la validación local / Sprint 0.5 asumimos que los componentes se copian al tema
    $file_path = get_template_directory() . "/components/{$component_id}/{$variant}.php";
    
    if (file_exists($file_path)) {
        // Hacemos disponible $data al template
        include $file_path;
    } else {
        if (WP_DEBUG) {
            echo "<!-- Component missing: {$component_id}/{$variant} -->";
        }
    }
}

// 3. Incluir Registro de Post Types y Campos ACF
require_once get_template_directory() . '/includes/post-types.php';
require_once get_template_directory() . '/includes/acf-fields.php';
require_once get_template_directory() . '/includes/cron-portfolio-check.php';
require_once get_template_directory() . '/includes/admin-options.php';

// 4. Global Core Tech Stack Helper
function wp_ai_get_core_tech_stack() {
    return [
        ['name' => 'WordPress', 'icon' => 'wordpress'],
        ['name' => 'PHP', 'icon' => 'php'],
        ['name' => 'JavaScript', 'icon' => 'javascript'],
        ['name' => 'Tailwind CSS', 'icon' => 'tailwindcss'],
        ['name' => 'CSS', 'icon' => 'css'],
        ['name' => 'WooCommerce', 'icon' => 'woocommerce'],
        ['name' => 'LearnDash', 'icon' => 'learndash'],
        ['name' => 'MySQL', 'icon' => 'mysql'],
        ['name' => 'Python', 'icon' => 'python'],
        ['name' => 'cPanel', 'icon' => 'cpanel'],
        ['name' => 'Git / GitHub', 'icon' => 'git'],
        ['name' => 'HTML5', 'icon' => 'html5'],
        ['name' => 'Cloudflare', 'icon' => 'cloudflare'],
        ['name' => 'Figma', 'icon' => 'figma']
    ];
}

// 5. Ocultar el editor nativo de WordPress en la página de inicio (Home)
add_action('admin_init', function() {
    $post_id = $_GET['post'] ?? ($_POST['post_ID'] ?? null);
    if (!isset($post_id)) return;

    $frontpage_id = get_option('page_on_front');
    if (intval($post_id) === intval($frontpage_id)) {
        remove_post_type_support('page', 'editor');
    }
});

<?php
/**
 * WP-AI Framework - Functions
 */

// 0. Theme Setup
add_action('after_setup_theme', function() {
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
});

// 1. Enqueue Tailwind CSS compilado
add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style(
        'wp-ai-tailwind', 
        get_template_directory_uri() . '/assets/css/style.css', 
        [], 
        filemtime(get_template_directory() . '/assets/css/style.css')
    );
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

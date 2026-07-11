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

// 5. Ocultar el editor nativo de WordPress en ciertas páginas administradas por ACF
add_action('admin_init', function() {
    $post_id = $_GET['post'] ?? ($_POST['post_ID'] ?? null);
    if (!isset($post_id)) return;

    $frontpage_id = get_option('page_on_front');
    $template = get_post_meta($post_id, '_wp_page_template', true);
    
    if (intval($post_id) === intval($frontpage_id) || $template === 'page-sobre-mi.php') {
        remove_post_type_support('page', 'editor');
    }
});

// 6. AJAX Load More para el Blog
add_action('wp_ajax_nopriv_load_more_posts', 'wp_ai_load_more_posts');
add_action('wp_ajax_load_more_posts', 'wp_ai_load_more_posts');

function wp_ai_load_more_posts() {
    check_ajax_referer('blog_ajax_nonce', 'security');

    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '*';
    
    $args = [
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 9,
        'paged' => $paged
    ];
    
    if ($category !== '*') {
        $args['category_name'] = $category;
    }
    
    $query = new WP_Query($args);
    
    ob_start();
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            get_template_part('components/blog/card');
        endwhile;
    endif;
    $html = ob_get_clean();
    
    wp_send_json_success([
        'html' => $html,
        'max_pages' => $query->max_num_pages
    ]);
}

// 7. Sincronizar paginación del loop principal
add_action('pre_get_posts', 'wp_ai_sync_main_query_pagination');
function wp_ai_sync_main_query_pagination($query) {
    if (!is_admin() && $query->is_main_query()) {
        if ($query->is_home() || $query->is_post_type_archive('proyecto')) {
            $query->set('posts_per_page', 9);
        }
    }
}

// 8. AJAX Load More para el Portafolio
add_action('wp_ajax_nopriv_wp_ai_load_more_portfolio', 'wp_ai_load_more_portfolio');
add_action('wp_ajax_wp_ai_load_more_portfolio', 'wp_ai_load_more_portfolio');

function wp_ai_load_more_portfolio() {
    check_ajax_referer('portfolio_ajax_nonce', 'nonce');

    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
    
    $args = [
        'post_type' => 'proyecto',
        'posts_per_page' => 9,
        'paged' => $paged,
        'orderby' => 'menu_order date',
        'order' => 'DESC'
    ];
    
    $query = new WP_Query($args);
    
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            // Categorías para el filtro
            $cats = wp_get_post_terms(get_the_ID(), 'categoria_proyecto');
            $cat_slugs = [];
            if (!is_wp_error($cats) && !empty($cats)) {
                foreach ($cats as $c) {
                    $cat_slugs[] = $c->slug;
                }
            }
            
            // Tech stack
            $techs = wp_get_post_terms(get_the_ID(), 'tech_stack', ['fields' => 'names']);
            $techs = is_wp_error($techs) ? [] : array_slice($techs, 0, 3);
            ?>
            <div class="project-card group flex flex-col bg-gray-900/40 backdrop-blur-sm border border-gray-800/60 rounded-3xl overflow-hidden hover:border-brand-500/50 hover:bg-gray-900 transition-all duration-500 hover:-translate-y-2 shadow-xl hover:shadow-brand-500/10" data-categories="<?php echo esc_attr(implode(',', $cat_slugs)); ?>">
                <a href="<?php the_permalink(); ?>" class="flex flex-col h-full">
                    
                    <!-- Visual Area -->
                    <div class="relative w-full bg-gray-950 flex flex-col p-8 items-center justify-center overflow-hidden">
                        <!-- Simulated Gradient Background -->
                        <div class="absolute inset-0 bg-gradient-to-br from-gray-800 to-gray-950 group-hover:scale-105 transition-transform duration-700"></div>
                        <!-- Decorative Pattern -->
                        <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.15) 1px, transparent 0); background-size: 24px 24px;"></div>
                        
                        <!-- Browser Mockup Window -->
                        <div class="relative w-full bg-gray-900 border border-gray-700/50 rounded-xl shadow-2xl flex flex-col overflow-hidden backdrop-blur-md group-hover:-translate-y-3 transition-transform duration-500 z-0">
                            <!-- Browser Header -->
                            <div class="h-6 border-b border-gray-700/50 flex items-center px-3 gap-1.5 bg-gray-950/50 shrink-0">
                                <div class="w-2 h-2 rounded-full bg-red-500/50"></div>
                                <div class="w-2 h-2 rounded-full bg-yellow-500/50"></div>
                                <div class="w-2 h-2 rounded-full bg-green-500/50"></div>
                            </div>
                            <!-- Browser Content (Image) -->
                            <div class="relative w-full aspect-video overflow-hidden bg-gray-950">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('large', ['class' => 'absolute inset-0 w-full h-full object-cover object-top opacity-90 group-hover:opacity-100 transition-opacity duration-700']); ?>
                                <?php else: ?>
                                    <div class="absolute inset-0 flex items-center justify-center bg-gray-800 text-gray-500">
                                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Content Area -->
                    <div class="flex flex-col flex-grow p-8 bg-gray-900/80 relative z-10">
                        <h3 class="text-2xl font-bold text-white mb-4 group-hover:text-brand-400 transition-colors duration-300">
                            <?php the_title(); ?>
                        </h3>
                        <div class="text-gray-400 text-base leading-relaxed mb-6">
                            <?php 
                                $content = get_the_content();
                                $excerpt = get_the_excerpt();
                                if (empty($excerpt)) {
                                    echo wp_trim_words($content, 22);
                                } else {
                                    echo wp_trim_words($excerpt, 22);
                                }
                            ?>
                        </div>
                        
                        <!-- Footer of Card -->
                        <div class="mt-auto pt-6 border-t border-gray-800/60 flex items-center justify-between">
                            <!-- Tech Stack Pills -->
                            <?php if (!empty($techs)) : ?>
                                <div class="flex items-center gap-2">
                                    <?php foreach ($techs as $tech) : ?>
                                        <span class="bg-gray-950 text-gray-400 border border-gray-800 rounded-md px-2.5 py-1 text-[10px] font-semibold uppercase tracking-wider">
                                            <?php echo esc_html($tech); ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                            
                            <!-- Arrow Icon -->
                            <div class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 group-hover:bg-brand-500 group-hover:text-gray-950 transition-all duration-300 transform group-hover:scale-110">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <?php
        endwhile;
    endif;
    
    wp_die();
}

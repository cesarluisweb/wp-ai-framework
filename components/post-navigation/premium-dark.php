<?php
/**
 * Componente: Post Navigation (Premium Dark)
 * Muestra enlaces al post anterior y siguiente con miniaturas.
 * Se usa en plantillas individuales (single.php, single-servicio.php, single-proyecto.php)
 */

$post_type = get_post_type();
$current_id = get_the_ID();

$prev_post = get_previous_post();
if (!$prev_post) {
    // Si no hay post anterior (estamos en el más antiguo), buscamos el más reciente
    $prev_post_query = get_posts([
        'post_type'      => $post_type,
        'posts_per_page' => 1,
        'order'          => 'DESC',
        'orderby'        => 'date'
    ]);
    if (!empty($prev_post_query)) $prev_post = $prev_post_query[0];
}

$next_post = get_next_post();
if (!$next_post) {
    // Si no hay post siguiente (estamos en el más reciente), buscamos el más antiguo
    $next_post_query = get_posts([
        'post_type'      => $post_type,
        'posts_per_page' => 1,
        'order'          => 'ASC',
        'orderby'        => 'date'
    ]);
    if (!empty($next_post_query)) $next_post = $next_post_query[0];
}

// Evitar que enlace a sí mismo si solo hay 1 post en total
if ($prev_post && $prev_post->ID === $current_id) $prev_post = null;
if ($next_post && $next_post->ID === $current_id) $next_post = null;

if (!$prev_post && !$next_post) return;

// Función helper para renderizar el medio (miniatura o icono ACF)
$render_media = function($p_id) use ($post_type) {
    if (has_post_thumbnail($p_id)) {
        echo get_the_post_thumbnail($p_id, 'thumbnail', ['class' => 'w-full h-full object-cover group-hover:scale-110 transition-transform duration-500']);
        return;
    }
    
    // Fallback: Si es servicio, intentamos buscar su icono de ACF
    if ($post_type === 'servicio') {
        $icon_name = function_exists('wp_ai_get_field_fallback') ? wp_ai_get_field_fallback('icon', 'robot', $p_id) : get_post_meta($p_id, 'icon', true);
        if (!$icon_name) $icon_name = 'robot';
        
        $svg_html = function_exists('wp_ai_get_service_icon_svg') ? wp_ai_get_service_icon_svg($icon_name, 'w-8 h-8') : '';
        echo '<div class="w-full h-full flex items-center justify-center bg-gray-950 text-brand-400 group-hover:text-brand-300 group-hover:scale-110 transition-all duration-500">' . $svg_html . '</div>';
        return;
    }

    // Default genérico
    echo '<div class="w-full h-full flex items-center justify-center text-gray-600 bg-gray-900"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg></div>';
};
?>
<section class="border-t border-gray-800 bg-gray-950 py-12">
    <div class="w-full max-w-[1400px] mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <!-- Anterior -->
            <div>
                <?php if ($prev_post): ?>
                    <a href="<?php echo get_permalink($prev_post->ID); ?>" class="group flex items-center gap-6 p-6 rounded-3xl border border-gray-800 bg-gray-900 hover:border-brand-500/50 hover:bg-gray-800/50 transition-all duration-300">
                        <div class="w-20 h-20 shrink-0 rounded-2xl overflow-hidden bg-gray-800 border border-gray-700 relative">
                            <?php $render_media($prev_post->ID); ?>
                            <div class="absolute inset-0 bg-gray-900/40 group-hover:bg-transparent transition-colors duration-300 pointer-events-none"></div>
                        </div>
                        <div>
                            <span class="flex items-center gap-2 text-brand-400 text-sm font-bold uppercase tracking-wider mb-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                                Anterior
                            </span>
                            <h4 class="text-white font-bold text-lg leading-tight group-hover:text-brand-300 transition-colors line-clamp-2"><?php echo esc_html(get_the_title($prev_post->ID)); ?></h4>
                        </div>
                    </a>
                <?php endif; ?>
            </div>

            <!-- Siguiente -->
            <div class="flex justify-end">
                <?php if ($next_post): ?>
                    <a href="<?php echo get_permalink($next_post->ID); ?>" class="group flex flex-row-reverse items-center gap-6 p-6 rounded-3xl border border-gray-800 bg-gray-900 hover:border-brand-500/50 hover:bg-gray-800/50 transition-all duration-300 text-right w-full">
                        <div class="w-20 h-20 shrink-0 rounded-2xl overflow-hidden bg-gray-800 border border-gray-700 relative">
                            <?php $render_media($next_post->ID); ?>
                            <div class="absolute inset-0 bg-gray-900/40 group-hover:bg-transparent transition-colors duration-300 pointer-events-none"></div>
                        </div>
                        <div>
                            <span class="flex items-center justify-end gap-2 text-brand-400 text-sm font-bold uppercase tracking-wider mb-2">
                                Siguiente
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </span>
                            <h4 class="text-white font-bold text-lg leading-tight group-hover:text-brand-300 transition-colors line-clamp-2"><?php echo esc_html(get_the_title($next_post->ID)); ?></h4>
                        </div>
                    </a>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>

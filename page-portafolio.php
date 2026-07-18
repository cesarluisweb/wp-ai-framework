<?php
/**
 * Template Name: Portafolio
 */
get_header();
?>

<main class="pt-32 bg-gray-950 min-h-screen font-['Inter',sans-serif]">
    <div class="max-w-[1400px] mx-auto px-6 lg:px-8">
        
        <!-- Header Section -->
        <div class="text-center max-w-3xl mx-auto mb-20">
            <?php
            $hero_kicker = get_field('hero_kicker') ?: 'Portafolio de Casos';
            $hero_h1_normal = get_field('hero_h1_normal') ?: 'Ingeniería web orientada a';
            $hero_h1_highlight = get_field('hero_h1_highlight') ?: 'resultados.';
            $hero_description = get_field('hero_description') ?: 'Explora cómo he resuelto problemas técnicos complejos y escalado negocios mediante código estructurado, rendimiento extremo y automatización.';
            ?>
            <span class="inline-block uppercase tracking-[0.2em] text-brand-300 text-sm font-semibold mb-6">
                <?php echo esc_html($hero_kicker); ?>
            </span>
            <h1 class="text-4xl md:text-6xl font-black text-white mb-8 leading-tight tracking-tight">
                <?php echo esc_html($hero_h1_normal); ?> <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-400 to-brand-600"><?php echo esc_html($hero_h1_highlight); ?></span>
            </h1>
            <p class="text-xl text-gray-400 leading-relaxed">
                <?php echo esc_html($hero_description); ?>
            </p>
        </div>

        <!-- Filter Navigation -->
        <div class="flex flex-wrap justify-center gap-3 mb-16">
            <button data-filter="*" class="filter-btn bg-brand-500 text-gray-950 font-bold border-brand-500 border rounded-full px-6 py-2.5 transition-all duration-300 cursor-pointer shadow-[0_0_20px_rgba(var(--brand-500-rgb),0.3)]">
                Todos los Proyectos
            </button>
            <?php
            $categories = get_terms([
                'taxonomy' => 'categoria_proyecto',
                'hide_empty' => true,
            ]);
            
            if (!is_wp_error($categories) && !empty($categories)) {
                foreach ($categories as $category) {
                    echo '<button data-filter="' . esc_attr($category->slug) . '" class="filter-btn bg-gray-900/50 border border-gray-800 text-gray-400 font-medium rounded-full px-6 py-2.5 hover:text-white hover:border-gray-600 hover:bg-gray-800 transition-all duration-300 cursor-pointer">';
                    echo esc_html($category->name);
                    echo '</button>';
                }
            }
            ?>
        </div>

        <!-- Portfolio Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8 relative z-20" id="portfolio-grid">
            <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            
            // Dynamic Sorting based on ACF
            $sort_order = function_exists('get_field') ? get_field('portfolio_sort_order') : 'date_asc';
            if (!$sort_order) $sort_order = 'date_asc';

            $orderby = 'date';
            $order = 'ASC';

            switch ($sort_order) {
                case 'date_desc':
                    $orderby = 'date';
                    $order = 'DESC';
                    break;
                case 'modified_asc':
                    $orderby = 'modified';
                    $order = 'ASC';
                    break;
                case 'modified_desc':
                    $orderby = 'modified';
                    $order = 'DESC';
                    break;
                case 'title_asc':
                    $orderby = 'title';
                    $order = 'ASC';
                    break;
                case 'date_asc':
                default:
                    $orderby = 'date';
                    $order = 'ASC';
                    break;
            }

            $portfolio_args = [
                'post_type' => 'proyecto',
                'posts_per_page' => 9,
                'paged' => $paged,
                'orderby' => $orderby,
                'order' => $order
            ];
            $portfolio_query = new WP_Query($portfolio_args);

            if ($portfolio_query->have_posts()) :
                while ($portfolio_query->have_posts()) : $portfolio_query->the_post();
                    
                    // Categorías para el filtro
                    $cats = wp_get_post_terms(get_the_ID(), 'categoria_proyecto');
                    $cat_slugs = [];
                    $cat_name = '';
                    if (!is_wp_error($cats) && !empty($cats)) {
                        foreach ($cats as $c) {
                            $cat_slugs[] = $c->slug;
                        }
                        $cat_name = $cats[0]->name;
                    }
                    
                    // Tech stack
                    $techs = wp_get_post_terms(get_the_ID(), 'tech_stack', ['fields' => 'names']);
                    $techs = is_wp_error($techs) ? [] : array_slice($techs, 0, 3); // Max 3 tags

                    // Cliente
                    $client_name = get_post_meta(get_the_ID(), 'client_name', true);
            ?>
            <div class="project-card group flex flex-col bg-gray-900/40 backdrop-blur-sm border border-gray-800/60 rounded-3xl overflow-hidden hover:border-brand-500/50 hover:bg-gray-900 transition-all duration-500 hover:-translate-y-2 shadow-xl hover:shadow-brand-500/10" data-categories="<?php echo esc_attr(implode(',', $cat_slugs)); ?>">
                <a href="<?php the_permalink(); ?>" class="flex flex-col h-full">
                    
                    <!-- Visual Area -->
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
                                    <div class="p-4 flex flex-col gap-3 opacity-20">
                                        <div class="w-1/2 h-3 bg-gray-700/50 rounded"></div>
                                        <div class="w-full h-2 bg-gray-800/50 rounded"></div>
                                        <div class="w-3/4 h-2 bg-gray-800/50 rounded"></div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <!-- Overlay Title (Client Name) -->
                        <?php if ($client_name) : ?>
                            <div class="absolute top-4 right-4 bg-gray-950/80 backdrop-blur-md border border-gray-700/50 rounded-full px-4 py-1.5 z-10 shadow-lg flex items-center justify-center">
                                <span class="text-xs font-bold text-gray-300 tracking-wide leading-none"><?php echo esc_html($client_name); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Content Area -->
                    <div class="p-8 flex-grow flex flex-col relative">
                        <!-- Top left corner glow effect -->
                        <div class="absolute top-0 left-0 w-32 h-32 bg-brand-500/5 rounded-full blur-3xl -translate-x-16 -translate-y-16 group-hover:bg-brand-500/10 transition-colors duration-500"></div>

                        <?php if ($cat_name) : ?>
                            <span class="text-brand-400 text-xs font-black uppercase tracking-[0.15em] mb-3 block">
                                <?php echo esc_html($cat_name); ?>
                            </span>
                        <?php endif; ?>
                        
                        <h3 class="text-2xl font-bold text-white mb-4 group-hover:text-brand-300 transition-colors duration-300 leading-snug">
                            <?php the_title(); ?>
                        </h3>
                        
                        <!-- Description excerpt -->
                        <div class="text-gray-400 text-sm leading-relaxed mb-8 flex-grow line-clamp-3">
                            <?php 
                                $excerpt = get_the_excerpt();
                                if(empty($excerpt)) {
                                    $content = get_the_content();
                                    $content = strip_tags($content);
                                    echo wp_trim_words($content, 22);
                                } else {
                                    echo wp_trim_words($excerpt, 22);
                                }
                            ?>
                        </div>
                        
                        <!-- Footer of Card -->
                        <div class="mt-auto pt-6 border-t border-gray-800/60 flex items-end justify-between gap-4">
                            <!-- Tech Stack Pills -->
                            <?php if (!empty($techs)) : ?>
                                <div class="flex flex-wrap gap-2">
                                    <?php foreach ($techs as $tech) : ?>
                                        <span class="inline-block bg-gray-950 border border-gray-700/60 rounded-full px-3 py-1 text-[11px] text-gray-400 font-medium">
                                            <?php echo esc_html($tech); ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                            
                            <!-- Arrow Icon -->
                            <div class="w-8 h-8 shrink-0 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 group-hover:bg-brand-500 group-hover:text-gray-950 transition-all duration-300 transform group-hover:scale-110">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <?php
                endwhile;
            ?>
        </div>
        
        <?php
        if ($portfolio_query->max_num_pages > 1) :
        ?>
            <div class="mt-20 text-center relative z-20" id="load-more-container">
                <button id="load-more-portfolio" 
                        data-page="1" 
                        data-max="<?php echo $portfolio_query->max_num_pages; ?>" 
                        data-nonce="<?php echo wp_create_nonce('portfolio_ajax_nonce'); ?>" 
                        data-ajaxurl="<?php echo admin_url('admin-ajax.php'); ?>"
                        class="inline-flex items-center justify-center px-8 py-4 text-base font-bold text-white bg-gray-900 border border-gray-800 hover:border-brand-500/50 hover:bg-gray-800 rounded-xl transition-all duration-300 transform hover:-translate-y-0.5 shadow-lg group mx-auto cursor-pointer">
                    <span class="btn-text">Cargar más proyectos</span>
                    <svg class="w-5 h-5 ml-2 group-hover:translate-y-1 transition-transform btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                    </svg>
                    <!-- Spinner SVG (oculto por defecto) -->
                    <svg class="w-5 h-5 ml-2 animate-spin hidden btn-spinner" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                </button>
            </div>
            
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                const btn = document.getElementById('load-more-portfolio');
                if (!btn) return;
                
                btn.addEventListener('click', function() {
                    const grid = document.getElementById('portfolio-grid');
                    let currentPage = parseInt(btn.getAttribute('data-page'));
                    const maxPages = parseInt(btn.getAttribute('data-max'));
                    const ajaxurl = btn.getAttribute('data-ajaxurl');
                    const nonce = btn.getAttribute('data-nonce');
                    
                    if (currentPage >= maxPages) return;
                    
                    // Update UI
                    btn.classList.add('opacity-75', 'cursor-not-allowed');
                    btn.querySelector('.btn-icon').classList.add('hidden');
                    btn.querySelector('.btn-spinner').classList.remove('hidden');
                    btn.querySelector('.btn-text').textContent = 'Cargando...';
                    
                    const nextPage = currentPage + 1;
                    
                    const formData = new FormData();
                    formData.append('action', 'wp_ai_load_more_portfolio');
                    formData.append('page', nextPage);
                    formData.append('nonce', nonce);
                    
                    fetch(ajaxurl, {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.text())
                    .then(data => {
                        if (data) {
                            grid.insertAdjacentHTML('beforeend', data);
                            btn.setAttribute('data-page', nextPage);
                            
                            if (nextPage >= maxPages) {
                                btn.parentElement.remove();
                            } else {
                                // Restore UI
                                btn.classList.remove('opacity-75', 'cursor-not-allowed');
                                btn.querySelector('.btn-icon').classList.remove('hidden');
                                btn.querySelector('.btn-spinner').classList.add('hidden');
                                btn.querySelector('.btn-text').textContent = 'Cargar más proyectos';
                            }
                        }
                    })
                    .catch(error => console.error('Error:', error));
                });
            });
            </script>
        <?php endif; ?>
        <?php
            wp_reset_postdata();
        else :
        ?>
            <div class="col-span-full text-center py-24 bg-gray-900/50 rounded-3xl border border-gray-800 border-dashed">
                <h3 class="text-2xl font-bold text-white mb-2">No se encontraron proyectos</h3>
                <p class="text-gray-400">Pronto añadiré más casos de estudio a mi portafolio.</p>
            </div>
        <?php endif; ?>

    </div> <!-- Close max-w container -->

    <div class="py-12 lg:py-16"></div> <!-- Espaciador entre proyectos y CTA -->

    <!-- CTA Section Bottom -->
    <?php
    if(function_exists('wp_ai_render_component')) {
        $cta_h2 = get_field('cta_h2') ?: '¿Listo para construir el tuyo?';
        $cta_desc = get_field('cta_description') ?: 'Trabajemos juntos para llevar tu proyecto al siguiente nivel de rendimiento y escalabilidad.';
        $cta_btn_text = get_field('cta_button_text') ?: 'Empezar Proyecto Ahora';
        $cta_btn_url = get_field('cta_button_url') ?: '/contacto';

        wp_ai_render_component('cta', 'premium-dark', [
            'headline' => $cta_h2,
            'subheadline' => $cta_desc,
            'button' => [
                'label' => $cta_btn_text,
                'url' => $cta_btn_url
            ]
        ]);
    }
    ?>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filters = document.querySelectorAll('.filter-btn');
    const cards = document.querySelectorAll('.project-card');
    
    filters.forEach(filter => {
        filter.addEventListener('click', function() {
            const filterValue = this.getAttribute('data-filter');
            
            // Update button styles
            filters.forEach(f => {
                f.classList.remove('bg-brand-500', 'text-gray-950', 'border-brand-500', 'shadow-[0_0_20px_rgba(var(--brand-500-rgb),0.3)]');
                f.classList.add('bg-gray-900/50', 'border-gray-800', 'text-gray-400');
            });
            this.classList.remove('bg-gray-900/50', 'border-gray-800', 'text-gray-400');
            this.classList.add('bg-brand-500', 'text-gray-950', 'border-brand-500', 'shadow-[0_0_20px_rgba(var(--brand-500-rgb),0.3)]');
            
            // Filter logic
            cards.forEach(card => {
                const categories = card.getAttribute('data-categories').split(',');
                
                if (filterValue === '*' || categories.includes(filterValue)) {
                    card.style.display = 'flex';
                    // Pequeña animación de entrada
                    card.animate([
                        { opacity: 0, transform: 'translateY(20px)' },
                        { opacity: 1, transform: 'translateY(0)' }
                    ], {
                        duration: 400,
                        easing: 'cubic-bezier(0.4, 0, 0.2, 1)',
                        fill: 'both'
                    });
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
});
</script>

<?php get_footer(); ?>

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
            <span class="inline-block uppercase tracking-[0.2em] text-brand-300 text-sm font-semibold mb-6">
                Portafolio de Casos
            </span>
            <h1 class="text-4xl md:text-6xl font-black text-white mb-8 leading-tight tracking-tight">
                Ingeniería web orientada a <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-400 to-brand-600">resultados</span>.
            </h1>
            <p class="text-xl text-gray-400 leading-relaxed">
                Explora cómo he resuelto problemas técnicos complejos y escalado negocios mediante código estructurado, rendimiento extremo y automatización.
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
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8" id="portfolio-grid">
            <?php
            $portfolio_args = [
                'post_type' => 'proyecto',
                'posts_per_page' => -1,
                'orderby' => 'menu_order date',
                'order' => 'DESC'
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
                    <div class="relative h-64 w-full bg-gray-950 flex flex-col pt-8 px-8 items-center justify-end overflow-hidden">
                        <!-- Simulated Gradient Background -->
                        <div class="absolute inset-0 bg-gradient-to-br from-gray-800 to-gray-950 group-hover:scale-105 transition-transform duration-700"></div>
                        <!-- Decorative Pattern -->
                        <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.15) 1px, transparent 0); background-size: 24px 24px;"></div>
                        
                        <!-- Browser Mockup Window -->
                        <div class="relative w-full h-[115%] bg-gray-900 border border-gray-700/50 rounded-t-xl shadow-2xl flex flex-col overflow-hidden backdrop-blur-md group-hover:-translate-y-3 transition-transform duration-500 z-0">
                            <!-- Browser Header -->
                            <div class="h-6 border-b border-gray-700/50 flex items-center px-3 gap-1.5 bg-gray-950/50 shrink-0">
                                <div class="w-2 h-2 rounded-full bg-red-500/50"></div>
                                <div class="w-2 h-2 rounded-full bg-yellow-500/50"></div>
                                <div class="w-2 h-2 rounded-full bg-green-500/50"></div>
                            </div>
                            <!-- Browser Content (Image) -->
                            <div class="flex-1 relative overflow-hidden bg-gray-950">
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
                wp_reset_postdata();
            else :
            ?>
                <div class="col-span-full text-center py-24 bg-gray-900/50 rounded-3xl border border-gray-800 border-dashed">
                    <h3 class="text-2xl font-bold text-white mb-2">No se encontraron proyectos</h3>
                    <p class="text-gray-400">Pronto añadiré más casos de estudio a mi portafolio.</p>
                </div>
            <?php endif; ?>
        </div>
    </div> <!-- Close max-w container -->

    <!-- CTA Section Bottom -->
    <?php
    if(function_exists('wp_ai_render_component')) {
        wp_ai_render_component('cta', 'premium-dark', [
            'headline' => '¿Listo para construir el tuyo?',
            'subheadline' => 'Trabajemos juntos para llevar tu proyecto al siguiente nivel de rendimiento y escalabilidad.',
            'button' => [
                'label' => 'Empezar Proyecto Ahora',
                'url' => '/contacto'
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

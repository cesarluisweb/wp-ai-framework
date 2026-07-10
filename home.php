<?php
/**
 * Template Name: Blog Archive (home.php)
 * This file is automatically used by WordPress to display the blog posts index.
 */
get_header();
?>

<main class="pt-32 bg-gray-950 min-h-screen font-['Inter',sans-serif]">
    <div class="max-w-[1400px] mx-auto px-6 lg:px-8">
        
        <!-- Header Section -->
        <div class="text-center max-w-3xl mx-auto mb-20">
            <span class="inline-block uppercase tracking-[0.2em] text-brand-300 text-sm font-semibold mb-6">
                Blog y Recursos
            </span>
            <h1 class="text-4xl md:text-6xl font-black text-white mb-8 leading-tight tracking-tight">
                Reflexiones sobre <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-400 to-brand-600">Ingeniería Web</span>
            </h1>
            <p class="text-xl text-gray-400 leading-relaxed">
                Artículos, tutoriales y análisis técnicos sobre rendimiento web, WordPress avanzado, y arquitecturas escalables.
            </p>
        </div>

        <!-- Filter Navigation -->
        <div class="flex flex-wrap justify-center gap-3 mb-16">
            <button data-filter="*" class="filter-btn bg-brand-500 text-gray-950 font-bold border-brand-500 border rounded-full px-6 py-2.5 transition-all duration-300 cursor-pointer shadow-[0_0_20px_rgba(var(--brand-500-rgb),0.3)]">
                Todos los Artículos
            </button>
            <?php
            $categories = get_categories([
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

        <!-- Blog Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8" id="blog-grid">
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post();
                    
                    // Categorías para el filtro
                    $cats = get_the_category();
                    $cat_slugs = [];
                    $cat_name = '';
                    if (!empty($cats)) {
                        foreach ($cats as $c) {
                            $cat_slugs[] = $c->slug;
                        }
                        $cat_name = $cats[0]->name;
                    }
            ?>
            <div class="blog-card group flex flex-col bg-gray-900/40 backdrop-blur-sm border border-gray-800/60 rounded-3xl overflow-hidden hover:border-brand-500/50 hover:bg-gray-900 transition-all duration-500 hover:-translate-y-2 shadow-xl hover:shadow-brand-500/10" data-categories="<?php echo esc_attr(implode(',', $cat_slugs)); ?>">
                <a href="<?php the_permalink(); ?>" class="flex flex-col h-full">
                    
                    <!-- Visual Area -->
                    <div class="relative w-full aspect-[16/10] bg-gray-950 overflow-hidden flex-shrink-0">
                        <!-- Decorative Pattern -->
                        <div class="absolute inset-0 opacity-20 z-0" style="background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.15) 1px, transparent 0); background-size: 24px 24px;"></div>
                        
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="absolute inset-0 z-10 p-6 flex flex-col justify-end">
                                <div class="w-full h-full relative rounded-xl overflow-hidden border border-gray-700/50 shadow-2xl group-hover:-translate-y-2 transition-transform duration-500">
                                    <?php the_post_thumbnail('large', ['class' => 'absolute inset-0 w-full h-full object-cover opacity-90 group-hover:opacity-100 transition-opacity duration-700']); ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <!-- Fallback Image / Gradient -->
                            <div class="absolute inset-0 z-10 p-6 flex flex-col justify-end">
                                <div class="w-full h-full relative rounded-xl overflow-hidden border border-gray-700/50 shadow-2xl bg-gradient-to-br from-gray-800 to-gray-950 group-hover:-translate-y-2 transition-transform duration-500 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5L18.5 7M4 15l8-8 8 8"></path></svg>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Content Area -->
                    <div class="p-8 flex-grow flex flex-col relative z-20">
                        <!-- Top left corner glow effect -->
                        <div class="absolute top-0 left-0 w-32 h-32 bg-brand-500/5 rounded-full blur-3xl -translate-x-16 -translate-y-16 group-hover:bg-brand-500/10 transition-colors duration-500"></div>

                        <?php if ($cat_name) : ?>
                            <span class="text-brand-400 text-xs font-black uppercase tracking-[0.15em] mb-3 block relative z-10">
                                <?php echo esc_html($cat_name); ?>
                            </span>
                        <?php endif; ?>
                        
                        <h3 class="text-2xl font-bold text-white mb-4 group-hover:text-brand-300 transition-colors duration-300 leading-snug relative z-10">
                            <?php the_title(); ?>
                        </h3>
                        
                        <!-- Description excerpt -->
                        <div class="text-gray-400 text-sm leading-relaxed mb-8 flex-grow line-clamp-3 relative z-10">
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
                        <div class="mt-auto pt-6 border-t border-gray-800/60 flex items-center justify-between relative z-10">
                            <span class="text-gray-500 text-xs font-medium uppercase tracking-wider">
                                <?php echo get_the_date('d M Y'); ?>
                            </span>
                            
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
            else :
            ?>
                <div class="col-span-full text-center py-24 bg-gray-900/50 rounded-3xl border border-gray-800 border-dashed">
                    <h3 class="text-2xl font-bold text-white mb-2">No se encontraron artículos</h3>
                    <p class="text-gray-400">Aún no hay contenido publicado en el blog.</p>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Pagination -->
        <div class="mt-16 flex justify-center">
            <?php 
            echo paginate_links([
                'prev_text' => '&laquo; Anterior',
                'next_text' => 'Siguiente &raquo;',
                'type' => 'list',
                'class' => 'flex gap-2 pagination-links'
            ]); 
            ?>
        </div>

    </div> <!-- Close max-w container -->

    <!-- CTA Section Bottom -->
    <?php
    if(function_exists('wp_ai_render_component')) {
        wp_ai_render_component('cta', 'premium-dark', [
            'headline' => '¿Listo para escalar tu web?',
            'subheadline' => 'Deja que aplique todas estas técnicas de desarrollo en tu próximo proyecto para asegurar su éxito.',
            'button' => [
                'label' => 'Hablemos de tu proyecto',
                'url' => '/contacto'
            ]
        ]);
    }
    ?>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filters = document.querySelectorAll('.filter-btn');
    const cards = document.querySelectorAll('.blog-card');
    
    if (filters.length > 0 && cards.length > 0) {
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
    }
});
</script>

<style>
/* Estilos básicos para paginación de WordPress si la hay */
.pagination-links ul { display: flex; gap: 0.5rem; justify-content: center; align-items: center; }
.pagination-links li { list-style: none; }
.pagination-links a, .pagination-links span { padding: 0.5rem 1rem; border-radius: 0.5rem; background: rgba(17, 24, 39, 0.5); border: 1px solid rgba(31, 41, 55, 1); color: #9ca3af; transition: all 0.3s ease; }
.pagination-links a:hover { background: rgba(31, 41, 55, 1); color: white; border-color: rgba(75, 85, 99, 1); }
.pagination-links .current { background: var(--color-brand-500); color: #0a0a0a; border-color: var(--color-brand-500); font-weight: bold; }
</style>

<?php get_footer(); ?>

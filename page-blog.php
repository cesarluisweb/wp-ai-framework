<?php
/**
 * Template Name: Blog
 */
get_header();
?>

<main class="pt-32 bg-gray-950 min-h-screen font-['Inter',sans-serif]">
    <div class="max-w-[1400px] mx-auto px-6 lg:px-8">
        
        <!-- Header Section -->
        <div class="text-center max-w-3xl mx-auto mb-20">
            <?php
            $hero_kicker = get_field('hero_kicker') ?: 'Blog y Recursos';
            $hero_h1_normal = get_field('hero_h1_normal') ?: 'Reflexiones sobre';
            $hero_h1_highlight = get_field('hero_h1_highlight') ?: 'Ingeniería Web';
            $hero_description = get_field('hero_description') ?: 'Artículos, tutoriales y análisis técnicos sobre rendimiento web, WordPress avanzado, y arquitecturas escalables.';
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
        <div id="blog-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 relative z-20">
            <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $blog_args = [
                'post_type'      => 'post',
                'posts_per_page' => 9,
                'paged'          => $paged,
                'post_status'    => 'publish'
            ];
            $blog_query = new WP_Query($blog_args);

            if ($blog_query->have_posts()) :
                while ($blog_query->have_posts()) : $blog_query->the_post();
                    
                    get_template_part('components/blog/card');
                endwhile;
            ?>
        </div>
        
        <!-- Pagination (Load More Button) -->
        <?php if ($blog_query->max_num_pages > 1) : ?>
            <div class="mt-20 text-center relative z-20">
                <button id="load-more-blog" 
                        data-page="1" 
                        data-max="<?php echo $blog_query->max_num_pages; ?>" 
                        class="inline-flex items-center justify-center px-8 py-4 text-base font-bold text-white bg-gray-900 border border-gray-800 hover:border-brand-500/50 hover:bg-gray-800 rounded-xl transition-all duration-300 transform hover:-translate-y-0.5 shadow-lg group cursor-pointer">
                    <span class="btn-text">Cargar más artículos</span>
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
                const loadMoreBtn = document.getElementById('load-more-blog');
                if(!loadMoreBtn) return;
                
                loadMoreBtn.addEventListener('click', function() {
                    const btn = this;
                    let currentPage = parseInt(btn.getAttribute('data-page'));
                    const maxPages = parseInt(btn.getAttribute('data-max'));
                    const grid = document.getElementById('blog-grid');
                    
                    if (currentPage >= maxPages) return;
                    
                    // UI Loading state
                    btn.classList.add('opacity-75', 'cursor-not-allowed');
                    btn.querySelector('.btn-icon').classList.add('hidden');
                    btn.querySelector('.btn-spinner').classList.remove('hidden');
                    btn.querySelector('.btn-text').textContent = 'Cargando...';
                    
                    const nextPage = currentPage + 1;
                    
                    // Ajax request
                    const formData = new FormData();
                    formData.append('action', 'load_more_posts');
                    formData.append('page', nextPage);
                    
                    fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
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
                                btn.querySelector('.btn-text').textContent = 'Cargar más artículos';
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
                <h3 class="text-2xl font-bold text-white mb-2">No se encontraron artículos</h3>
                <p class="text-gray-400">Aún no hay contenido publicado en el blog.</p>
            </div>
        <?php endif; ?>

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

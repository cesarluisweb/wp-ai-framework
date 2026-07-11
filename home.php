<?php
/**
 * Template Name: Blog Archive (home.php)
 * This file is automatically used by WordPress to display the blog posts index.
 */
get_header();
?>

<main class="pt-32 bg-gray-950 min-h-screen font-['Inter',sans-serif]">
    <div class="max-w-[1400px] mx-auto px-6 lg:px-8" id="blog-container" data-nonce="<?php echo wp_create_nonce('blog_ajax_nonce'); ?>" data-ajaxurl="<?php echo admin_url('admin-ajax.php'); ?>">
        
        <!-- Header Section -->
        <div class="text-center max-w-3xl mx-auto mb-20">
            <?php
            $blog_page_id = get_option('page_for_posts');
            $hero_kicker = get_field('hero_kicker', $blog_page_id) ?: 'Blog y Recursos';
            $hero_h1_normal = get_field('hero_h1_normal', $blog_page_id) ?: 'Reflexiones sobre';
            $hero_h1_highlight = get_field('hero_h1_highlight', $blog_page_id) ?: 'Ingeniería Web';
            $hero_description = get_field('hero_description', $blog_page_id) ?: 'Artículos, tutoriales y análisis técnicos sobre rendimiento web, WordPress avanzado, y arquitecturas escalables.';
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
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8" id="blog-grid">
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post();
                    
                    get_template_part('components/blog/card');
                endwhile;
            else :
            ?>
                <div class="col-span-full text-center py-24 bg-gray-900/50 rounded-3xl border border-gray-800 border-dashed">
                    <h3 class="text-2xl font-bold text-white mb-2">No se encontraron artículos</h3>
                    <p class="text-gray-400">Aún no hay contenido publicado en el blog.</p>
                </div>
            <?php endif; ?>
        </div>
        
            


        <!-- Pagination (Load More Button) -->
        <div id="load-more-container" class="mt-20 text-center relative z-20 <?php echo ($wp_query->max_num_pages <= 1) ? 'hidden' : ''; ?>">
            <button id="load-more-blog" 
                    data-page="1" 
                    data-max="<?php echo $wp_query->max_num_pages; ?>" 
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
        
        <div class="py-12 lg:py-16"></div> <!-- Espaciador entre blog y CTA -->

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
    const container = document.getElementById('blog-container');
    if (!container) return;
    
    const ajaxUrl = container.getAttribute('data-ajaxurl');
    const nonce = container.getAttribute('data-nonce');
    const grid = document.getElementById('blog-grid');
    const loadMoreBtn = document.getElementById('load-more-blog');
    const loadMoreContainer = document.getElementById('load-more-container');
    const filters = document.querySelectorAll('.filter-btn');
    
    let activeCategory = '*';
    let isFetching = false;

    // Función centralizada para hacer el fetching
    function fetchBlogPosts(page, category, isLoadMore) {
        if (isFetching) return;
        isFetching = true;

        if (!isLoadMore) {
            // Estado de carga inicial (Skeleton o Spinner visual para el grid)
            grid.style.opacity = '0.5';
        } else {
            // Estado de carga para el botón
            loadMoreBtn.classList.add('opacity-75', 'cursor-not-allowed');
            loadMoreBtn.querySelector('.btn-icon').classList.add('hidden');
            loadMoreBtn.querySelector('.btn-spinner').classList.remove('hidden');
            loadMoreBtn.querySelector('.btn-text').textContent = 'Cargando...';
        }

        const formData = new FormData();
        formData.append('action', 'load_more_posts');
        formData.append('page', page);
        formData.append('category', category);
        formData.append('security', nonce);

        fetch(ajaxUrl, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(res => {
            if (res.success) {
                const data = res.data;
                
                if (!isLoadMore) {
                    // Si es un filtro, reemplazamos el grid completo
                    grid.innerHTML = data.html;
                    grid.style.opacity = '1';
                    
                    // Animación de entrada GSAP-like (usando Web Animations API)
                    const newCards = grid.querySelectorAll('.blog-card');
                    newCards.forEach((card, i) => {
                        card.animate([
                            { opacity: 0, transform: 'translateY(20px)' },
                            { opacity: 1, transform: 'translateY(0)' }
                        ], {
                            duration: 400,
                            delay: i * 50,
                            easing: 'cubic-bezier(0.4, 0, 0.2, 1)',
                            fill: 'both'
                        });
                    });
                } else {
                    // Si es "Cargar más", anexamos los resultados
                    grid.insertAdjacentHTML('beforeend', data.html);
                }

                // Actualizar paginación
                if (loadMoreBtn) {
                    loadMoreBtn.setAttribute('data-page', page);
                    loadMoreBtn.setAttribute('data-max', data.max_pages);

                    if (page >= data.max_pages) {
                        loadMoreContainer.classList.add('hidden');
                    } else {
                        loadMoreContainer.classList.remove('hidden');
                        
                        // Restaurar UI del botón
                        loadMoreBtn.classList.remove('opacity-75', 'cursor-not-allowed');
                        loadMoreBtn.querySelector('.btn-icon').classList.remove('hidden');
                        loadMoreBtn.querySelector('.btn-spinner').classList.add('hidden');
                        loadMoreBtn.querySelector('.btn-text').textContent = 'Cargar más artículos';
                    }
                }
                
                // Mensaje si no hay resultados en el filtro
                if(data.html.trim() === '') {
                    grid.innerHTML = `
                    <div class="col-span-full text-center py-24 bg-gray-900/50 rounded-3xl border border-gray-800 border-dashed">
                        <h3 class="text-2xl font-bold text-white mb-2">No se encontraron artículos</h3>
                        <p class="text-gray-400">Aún no hay contenido publicado en esta categoría.</p>
                    </div>`;
                }

            }
        })
        .catch(error => console.error('Error fetching posts:', error))
        .finally(() => {
            isFetching = false;
        });
    }

    // Evento de "Cargar más"
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
            let currentPage = parseInt(this.getAttribute('data-page'));
            const maxPages = parseInt(this.getAttribute('data-max'));
            
            if (currentPage >= maxPages) return;
            fetchBlogPosts(currentPage + 1, activeCategory, true);
        });
    }

    // Eventos de Filtro
    if (filters.length > 0) {
        filters.forEach(filter => {
            filter.addEventListener('click', function() {
                if(isFetching) return;
                
                activeCategory = this.getAttribute('data-filter');
                
                // Actualizar estilos de los botones
                filters.forEach(f => {
                    f.classList.remove('bg-brand-500', 'text-gray-950', 'border-brand-500', 'shadow-[0_0_20px_rgba(var(--brand-500-rgb),0.3)]');
                    f.classList.add('bg-gray-900/50', 'border-gray-800', 'text-gray-400');
                });
                this.classList.remove('bg-gray-900/50', 'border-gray-800', 'text-gray-400');
                this.classList.add('bg-brand-500', 'text-gray-950', 'border-brand-500', 'shadow-[0_0_20px_rgba(var(--brand-500-rgb),0.3)]');
                
                // Fetch página 1 de la nueva categoría
                fetchBlogPosts(1, activeCategory, false);
            });
        });
    }
});
</script>

<?php get_footer(); ?>

<?php
/**
 * Plantilla de Resultados de Búsqueda (Premium Dark B2B)
 */
get_header();
?>

<main class="pt-32 bg-gray-950 min-h-screen font-['Inter',sans-serif] pb-20">
    <div class="max-w-[1000px] mx-auto px-6 lg:px-8">
        
        <header class="mb-16 text-center">
            <span class="text-brand-400 font-bold uppercase tracking-widest text-sm mb-4 block">Resultados de Búsqueda</span>
            <h1 class="text-4xl md:text-5xl font-black text-white tracking-tight leading-tight">
                Has buscado: <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-300 to-brand-500">"<?php echo get_search_query(); ?>"</span>
            </h1>
        </header>

        <?php if (have_posts()) : ?>
            
            <div class="space-y-8">
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('bg-gray-900/40 p-8 rounded-3xl border border-gray-800/60 hover:border-brand-500/50 hover:bg-gray-900 transition-all duration-300 group flex flex-col md:flex-row gap-8'); ?>>
                        
                        <?php if (has_post_thumbnail()) : ?>
                        <div class="md:w-1/3 shrink-0">
                            <a href="<?php the_permalink(); ?>" class="block rounded-2xl overflow-hidden relative">
                                <?php the_post_thumbnail('medium_large', ['class' => 'w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500']); ?>
                                <div class="absolute inset-0 bg-gray-900/20 group-hover:bg-transparent transition-colors duration-300"></div>
                            </a>
                        </div>
                        <?php endif; ?>

                        <div class="<?php echo has_post_thumbnail() ? 'md:w-2/3' : 'w-full'; ?> flex flex-col justify-center">
                            <header class="mb-4">
                                <?php
                                $post_type = get_post_type();
                                $type_label = 'Artículo';
                                $type_color = 'text-brand-400';
                                
                                if ($post_type === 'servicio') {
                                    $type_label = 'Servicio';
                                    $type_color = 'text-purple-400';
                                } elseif ($post_type === 'proyecto') {
                                    $type_label = 'Portafolio';
                                    $type_color = 'text-emerald-400';
                                }
                                ?>
                                <span class="<?php echo $type_color; ?> font-bold uppercase tracking-wider text-xs mb-2 block">
                                    <?php echo esc_html($type_label); ?>
                                </span>
                                <?php the_title('<h2 class="text-2xl font-bold text-white leading-snug"><a href="' . esc_url(get_permalink()) . '" class="hover:text-brand-300 transition-colors">', '</a></h2>'); ?>
                            </header>

                            <div class="text-gray-400 leading-relaxed text-base mb-6 line-clamp-3">
                                <?php echo wp_trim_words(get_the_excerpt(), 25); ?>
                            </div>
                            
                            <a href="<?php the_permalink(); ?>" class="inline-flex items-center text-white font-bold hover:text-brand-400 group/link mt-auto w-fit">
                                Ver detalles
                                <svg class="w-4 h-4 ml-2 transform group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
            
            <div class="mt-16 flex justify-between items-center text-brand-400 font-semibold border-t border-gray-800 pt-8">
                <?php previous_posts_link('<span class="mr-2">&larr;</span> Página anterior'); ?>
                <?php next_posts_link('Siguiente página <span class="ml-2">&rarr;</span>'); ?>
            </div>

        <?php else : ?>
            <div class="text-center py-20 bg-gray-900/30 border border-gray-800/50 rounded-3xl">
                <div class="w-20 h-20 mx-auto bg-gray-800/50 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-10 h-10 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <h2 class="text-2xl md:text-3xl font-bold text-white mb-4">No encontramos resultados</h2>
                <p class="text-gray-400 text-lg max-w-md mx-auto mb-8">No hemos encontrado ningún proyecto, servicio o artículo que coincida con tu búsqueda. Intenta con otros términos.</p>
                <div class="max-w-md mx-auto relative">
                    <?php get_search_form(); ?>
                </div>
            </div>
        <?php endif; ?>
        
    </div>
</main>

<?php get_footer(); ?>

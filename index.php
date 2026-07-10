<?php
/**
 * Main Template File (Fallback)
 */
get_header();
?>

<main class="pt-32 bg-gray-950 min-h-screen font-['Inter',sans-serif]">
    <div class="max-w-[1000px] mx-auto px-6 lg:px-8">
        <?php if (have_posts()) : ?>
            
            <?php if (is_home() && !is_front_page()) : ?>
                <header class="mb-16 text-center">
                    <h1 class="text-4xl md:text-5xl font-black text-white tracking-tight">Blog</h1>
                </header>
            <?php endif; ?>

            <div class="space-y-12">
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('bg-gray-900/40 p-8 md:p-10 rounded-3xl border border-gray-800/60 hover:border-brand-500/50 transition-colors duration-300'); ?>>
                        <header class="mb-6">
                            <?php if (is_singular()) : ?>
                                <?php the_title('<h1 class="text-3xl md:text-5xl font-bold text-white leading-tight">', '</h1>'); ?>
                            <?php else : ?>
                                <?php the_title('<h2 class="text-2xl md:text-3xl font-bold text-white mb-4 leading-snug"><a href="' . esc_url(get_permalink()) . '" class="hover:text-brand-400 transition-colors">', '</a></h2>'); ?>
                            <?php endif; ?>
                            
                            <?php if ('post' === get_post_type()) : ?>
                                <div class="text-gray-500 text-sm font-medium mt-4 flex items-center gap-4">
                                    <span class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <?php echo get_the_date(); ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                        </header>

                        <div class="text-gray-400 leading-relaxed text-lg mb-8">
                            <?php 
                            if (is_singular()) {
                                the_content();
                            } else {
                                the_excerpt();
                            }
                            ?>
                        </div>
                        
                        <?php if (!is_singular()) : ?>
                            <a href="<?php the_permalink(); ?>" class="inline-flex items-center text-brand-400 font-bold hover:text-brand-300 group">
                                Leer artículo completo 
                                <span class="ml-2 transform group-hover:translate-x-1 transition-transform">&rarr;</span>
                            </a>
                        <?php endif; ?>
                    </article>
                <?php endwhile; ?>
            </div>
            
            <div class="mt-16 flex justify-between items-center text-brand-400 font-semibold">
                <?php previous_posts_link('<span class="mr-2">&larr;</span> Entradas más recientes'); ?>
                <?php next_posts_link('Entradas más antiguas <span class="ml-2">&rarr;</span>'); ?>
            </div>

        <?php else : ?>
            <div class="text-center py-32 bg-gray-900/30 border border-gray-800/50 rounded-3xl">
                <div class="w-20 h-20 mx-auto bg-gray-800/50 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-10 h-10 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h1 class="text-3xl font-bold text-white mb-4">Contenido no encontrado</h1>
                <p class="text-gray-400 text-lg max-w-md mx-auto">Parece que no podemos encontrar lo que estás buscando. Tal vez la búsqueda te ayude.</p>
                <div class="mt-8 max-w-sm mx-auto">
                    <?php get_search_form(); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>

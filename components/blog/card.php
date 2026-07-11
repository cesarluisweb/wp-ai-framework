<?php
/**
 * Blog Card Template Part
 */

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

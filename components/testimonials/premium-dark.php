<?php
/**
 * Component: Testimonials
 * Variant: premium-dark
 * 
 * Elegant testimonial carousel/grid.
 * 
 * Expected $data:
 * - section_kicker (string)
 * - section_title (string)
 * - testimonials (array of arrays: quote, author, role, company, rating)
 */

$section_kicker = $data['section_kicker'] ?? '';
$section_title = $data['section_title'] ?? 'Lo que dicen mis clientes';
$testimonials = $data['testimonials'] ?? [];
?>

<section id="testimonials" class="py-24 lg:py-32 bg-gray-950 relative overflow-hidden border-t border-gray-900">
    <!-- Fondo decorativo sutil -->
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_bottom,_rgba(0,169,204,0.03)_0%,_transparent_70%)] pointer-events-none"></div>

    <div class="w-full max-w-[1400px] mx-auto px-6 lg:px-8 relative z-10">
        
        <!-- Cabecera de la sección -->
        <div class="mb-16 lg:mb-20 text-center max-w-3xl mx-auto">
            <?php if (!empty($section_kicker)): ?>
                <span class="inline-block uppercase tracking-[0.2em] text-brand-300 text-sm font-semibold mb-4">
                    <?php echo esc_html($section_kicker); ?>
                </span>
            <?php endif; ?>
            
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white leading-tight">
                <?php echo esc_html($section_title); ?>
            </h2>
            <?php if (!empty($section_description)): ?>
                <p class="mt-5 text-lg text-gray-400 leading-relaxed"><?php echo esc_html($section_description); ?></p>
            <?php endif; ?>
        </div>

        <!-- Grid de Testimonios -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            <?php foreach($testimonials as $index => $testimonial): ?>
            <div class="flex flex-col justify-between bg-gray-900/40 backdrop-blur-sm border border-gray-800/60 rounded-3xl p-8 hover:bg-gray-900/80 transition-all duration-500 hover:border-brand-500/30 group">
                
                <div>
                    <!-- Estrellas -->
                    <?php if (isset($testimonial['rating'])): ?>
                    <div class="flex gap-1 mb-6">
                        <?php for($i=0; $i<$testimonial['rating']; $i++): ?>
                        <svg class="w-5 h-5 text-yellow-500/90 drop-shadow-[0_0_8px_rgba(234,179,8,0.4)]" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <?php endfor; ?>
                    </div>
                    <?php endif; ?>

                    <svg class="w-10 h-10 text-gray-800 mb-6 group-hover:text-brand-500/30 transition-colors duration-500" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"></path></svg>

                    <!-- Quote -->
                    <p class="text-gray-300 text-lg leading-relaxed mb-8 italic">
                        "<?php echo esc_html($testimonial['quote']); ?>"
                    </p>
                </div>

                <!-- Author -->
                <div class="flex items-center gap-4 mt-auto pt-6 border-t border-gray-800/50">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-gray-800 to-gray-900 border border-gray-700 flex items-center justify-center text-gray-400 font-bold uppercase shadow-inner overflow-hidden shrink-0">
                        <?php if (!empty($testimonial['image'])): ?>
                            <img src="<?php echo esc_url($testimonial['image']); ?>" alt="<?php echo esc_attr($testimonial['author']); ?>" class="w-full h-full object-cover">
                        <?php else: ?>
                            <?php echo substr(esc_html($testimonial['author']), 0, 1); ?>
                        <?php endif; ?>
                    </div>
                    <div>
                        <div class="text-white font-bold tracking-wide">
                            <?php echo esc_html($testimonial['author']); ?>
                        </div>
                        <div class="text-brand-400 text-sm font-medium">
                            <?php if (!empty($testimonial['role'])): ?><?php echo esc_html($testimonial['role']); ?> <span class="text-gray-600 px-1">•</span><?php endif; ?>
                            <span class="text-gray-400"><?php echo esc_html($testimonial['company']); ?></span>
                        </div>
                        <?php if (!empty($testimonial['link'])): ?>
                            <div class="mt-1">
                                <a href="<?php echo esc_url($testimonial['link']); ?>" target="_blank" rel="noopener noreferrer" class="text-brand-500 hover:text-brand-400 text-xs font-semibold underline underline-offset-4 transition-colors">
                                    Ver opinión original
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<style>
/* Ocultar barra de scroll para el carrusel en webkit */
.hide-scrollbar::-webkit-scrollbar {
    display: none;
}
</style>

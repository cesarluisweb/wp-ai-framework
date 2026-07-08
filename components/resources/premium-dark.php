<?php
/**
 * Component: Resources
 * Variant: premium-dark
 */

$section_kicker = $data['section_kicker'] ?? '';
$section_title = $data['section_title'] ?? '';
$resources = $data['resources'] ?? [];
?>

<section id="resources" class="py-24 bg-gray-950 relative border-t border-gray-900 overflow-hidden">
    <!-- Decoración de fondo -->
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_rgba(0,169,204,0.05)_0%,_transparent_50%)] pointer-events-none"></div>

    <div class="w-full max-w-[1400px] mx-auto px-6 lg:px-8 relative z-10">
        
        <div class="flex flex-col lg:flex-row gap-12 lg:items-end justify-between mb-16">
            <div class="max-w-2xl">
                <?php if (!empty($section_kicker)): ?>
                    <span class="inline-block uppercase tracking-[0.2em] text-brand-300 text-sm font-semibold mb-4">
                        <?php echo esc_html($section_kicker); ?>
                    </span>
                <?php endif; ?>
                
                <?php if (!empty($section_title)): ?>
                    <h2 class="text-3xl md:text-4xl font-black text-white tracking-tight">
                        <?php echo esc_html($section_title); ?>
                    </h2>
                <?php endif; ?>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <?php foreach($resources as $resource): ?>
                <div class="group relative bg-gray-900 border border-gray-800 p-8 lg:p-10 rounded-3xl overflow-hidden hover:border-brand-500/50 transition-all duration-500 flex flex-col justify-between">
                    
                    <!-- Glow effect on hover -->
                    <div class="absolute -inset-px bg-gradient-to-br from-brand-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-3xl pointer-events-none"></div>

                    <div>
                        <div class="w-12 h-12 rounded-xl bg-gray-800/80 border border-gray-700 flex items-center justify-center mb-6 text-brand-400 group-hover:scale-110 transition-transform duration-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        
                        <h3 class="text-2xl font-bold text-white mb-4">
                            <?php echo esc_html($resource['title']); ?>
                        </h3>
                        <p class="text-gray-400 leading-relaxed mb-8">
                            <?php echo esc_html($resource['description']); ?>
                        </p>
                    </div>

                    <div>
                        <a href="#" class="inline-flex items-center text-brand-400 font-semibold group/link">
                            <?php echo esc_html($resource['cta']); ?>
                            <svg class="w-5 h-5 ml-2 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

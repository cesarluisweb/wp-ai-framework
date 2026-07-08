<?php
/**
 * Component: CTA
 * Variant: gradient
 * 
 * Expected $data matches design-system/contracts/cta.yml
 */

$headline = $data['headline'] ?? '';
$subheadline = $data['subheadline'] ?? '';
$button = $data['button'] ?? null;
$guarantee = $data['guarantee'] ?? '';
?>

<section class="py-24" id="cta">
    <div class="container mx-auto px-6 max-w-5xl">
        <div class="relative rounded-3xl overflow-hidden bg-gray-900 px-6 py-20 md:px-12 md:py-24 text-center shadow-2xl">
            
            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-br from-emerald-600/20 via-transparent to-blue-600/20 mix-blend-overlay"></div>
            
            <div class="relative z-10 max-w-3xl mx-auto">
                <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 tracking-tight">
                    <?php echo esc_html($headline); ?>
                </h2>
                
                <?php if ($subheadline): ?>
                <p class="text-xl text-gray-300 mb-10 leading-relaxed max-w-2xl mx-auto">
                    <?php echo esc_html($subheadline); ?>
                </p>
                <?php endif; ?>
                
                <?php if ($button): ?>
                <div class="flex flex-col items-center justify-center">
                    <a href="<?php echo esc_url($button['url']); ?>" class="inline-flex items-center px-8 py-4 rounded-full bg-white text-gray-900 font-bold text-lg hover:scale-105 transition-transform duration-300 shadow-[0_0_40px_rgba(255,255,255,0.3)] hover:shadow-[0_0_60px_rgba(255,255,255,0.5)]">
                        <?php echo esc_html($button['label']); ?>
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                    
                    <?php if ($guarantee): ?>
                    <span class="mt-4 flex items-center text-sm text-gray-400 font-medium">
                        <svg class="w-4 h-4 mr-1 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        <?php echo esc_html($guarantee); ?>
                    </span>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
            
        </div>
    </div>
</section>

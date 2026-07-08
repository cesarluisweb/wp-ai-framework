<?php
/**
 * Component: Methodology (Framework SCALE)
 * Variant: premium-dark
 */

$section_kicker = $data['section_kicker'] ?? '';
$section_title = $data['section_title'] ?? '';
$section_description = $data['section_description'] ?? '';
$steps = $data['steps'] ?? [];
?>

<section id="methodology" class="py-24 lg:py-32 bg-gray-950 relative overflow-hidden border-b border-gray-900">
    <div class="w-full max-w-[1400px] mx-auto px-6 lg:px-8 relative z-10">
        
        <!-- Header -->
        <div class="max-w-3xl mb-16 lg:mb-20">
            <?php if (!empty($section_kicker)): ?>
                <span class="inline-block uppercase tracking-[0.2em] text-brand-300 text-sm font-semibold mb-4">
                    <?php echo esc_html($section_kicker); ?>
                </span>
            <?php endif; ?>
            
            <?php if (!empty($section_title)): ?>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white leading-tight mb-6">
                    <?php echo esc_html($section_title); ?>
                </h2>
            <?php endif; ?>
            
            <?php if (!empty($section_description)): ?>
                <p class="mt-5 text-lg text-gray-400 leading-relaxed">
                    <?php echo esc_html($section_description); ?>
                </p>
            <?php endif; ?>
        </div>

        <!-- SCALE Steps -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
            <?php foreach($steps as $index => $step): ?>
                <div class="bg-gray-900/50 border border-gray-800 rounded-3xl p-8 hover:bg-gray-800/50 transition-colors duration-300 group">
                    <div class="text-6xl font-black text-transparent bg-clip-text bg-gradient-to-b from-gray-700 to-gray-900 group-hover:from-brand-500 group-hover:to-brand-900 transition-all duration-500 mb-6">
                        <?php echo esc_html($step['letter']); ?>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-4">
                        <?php echo esc_html($step['title']); ?>
                    </h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        <?php echo esc_html($step['description']); ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

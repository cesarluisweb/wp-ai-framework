<?php
/**
 * Footer Component - Premium Dark (B2B Focus)
 * 
 * Expected $data variables:
 * - $headline (string)
 * - $email (string)
 * - $description (string)
 * - $quick_links (array of arrays: label, url)
 * - $social_links (array of arrays: platform, url)
 * - $legal_links (array of arrays: label, url)
 * - $copyright (string)
 */

$headline = $data['headline'] ?? '¿Listo para escalar?';
$email = $data['email'] ?? 'hello@example.com';
$description = $data['description'] ?? 'Desarrollo WordPress a medida y arquitectura de alto rendimiento para agencias y empresas.';
$quick_links = $data['quick_links'] ?? [];
$social_links = $data['social_links'] ?? [];
if (empty($social_links) && function_exists('wp_ai_get_social_links')) {
    $social_links = wp_ai_get_social_links();
}
$legal_links = $data['legal_links'] ?? [];
$copyright = $data['copyright'] ?? '© ' . date('Y') . ' Todos los derechos reservados.';
?>

<footer class="bg-gray-950 border-t border-gray-900 pt-24 pb-12 overflow-hidden relative">
    <!-- Decorative background elements -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-4xl h-px bg-gradient-to-r from-transparent via-brand-500/50 to-transparent"></div>
    <div class="absolute -top-40 left-1/2 -translate-x-1/2 w-[800px] h-[400px] bg-brand-600/5 blur-[120px] rounded-full pointer-events-none"></div>

    <div class="w-full max-w-[1400px] mx-auto px-6 lg:px-8 relative z-10">
        
        <!-- Middle Section: Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-12 mb-20 text-left">
            <!-- Brand / Bio -->
            <div class="lg:col-span-2">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center gap-3 text-xl font-black text-white tracking-tight hover:text-brand-300 transition-colors duration-300 mb-6">
                    <div class="relative w-10 h-10 flex items-center justify-center rounded-lg bg-gradient-to-br from-brand-400/20 to-brand-600/10 border border-brand-500/30">
                        <span class="text-brand-300 font-black text-xl leading-none mt-0.5">C</span>
                    </div>
                    <span>César Luis</span>
                </a>
                <p class="text-gray-400 text-lg max-w-sm leading-relaxed">
                    <?php echo esc_html($description); ?>
                </p>
            </div>

            <!-- Links Grid Container (Side-by-side on mobile, separate columns on desktop) -->
            <div class="grid grid-cols-2 gap-8 lg:col-span-2">
                <!-- Quick Links -->
                <div>
                    <h3 class="text-white font-bold text-lg mb-6 tracking-wide">Navegación</h3>
                    <ul class="flex flex-col gap-4">
                        <?php foreach ($quick_links as $link): ?>
                        <li>
                            <a href="<?php echo esc_url($link['url']); ?>" class="text-gray-400 hover:text-brand-300 transition-colors duration-300">
                                <?php echo esc_html($link['label']); ?>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div>
                    <h3 class="text-white font-bold text-lg mb-6 tracking-wide">Redes</h3>
                    <ul class="flex flex-col gap-4">
                        <?php foreach ($social_links as $social): ?>
                        <li>
                            <a href="<?php echo esc_url($social['url']); ?>" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-brand-300 transition-colors duration-300 flex items-center gap-3 group">
                                <span class="text-gray-500 group-hover:text-brand-300 transition-colors duration-300">
                                    <?php echo $social['icon']; // SVG ?>
                                </span>
                                <span class="font-medium"><?php echo esc_html($social['platform']); ?></span>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Bottom Section: Legal -->
        <div class="pt-8 border-t border-gray-800/50 flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-gray-500 text-sm">
                <?php echo esc_html($copyright); ?>
            </p>
            
            <ul class="flex flex-wrap items-center gap-6">
                <?php foreach ($legal_links as $legal): ?>
                <li>
                    <a href="<?php echo esc_url($legal['url']); ?>" class="text-gray-500 text-sm hover:text-gray-300 transition-colors duration-300">
                        <?php echo esc_html($legal['label']); ?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>

    </div>
</footer>

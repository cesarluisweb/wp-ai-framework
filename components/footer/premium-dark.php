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
$description = $data['description'] ?? 'Desarrollo web a medida para empresas que buscan resultados.';
$quick_links = $data['quick_links'] ?? [];
$social_links = $data['social_links'] ?? [];
$legal_links = $data['legal_links'] ?? [];
$copyright = $data['copyright'] ?? '© ' . date('Y') . ' Todos los derechos reservados.';
?>

<footer class="bg-gray-950 border-t border-gray-900 pt-24 pb-12 overflow-hidden relative">
    <!-- Decorative background elements -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-4xl h-px bg-gradient-to-r from-transparent via-brand-500/50 to-transparent"></div>
    <div class="absolute -top-40 left-1/2 -translate-x-1/2 w-[800px] h-[400px] bg-brand-600/5 blur-[120px] rounded-full pointer-events-none"></div>

    <div class="w-full max-w-[1400px] mx-auto px-6 lg:px-8 relative z-10">
        
        <!-- Top Section: Huge CTA -->
        <div class="mb-24 text-center md:text-left">
            <h2 class="text-4xl md:text-6xl font-black text-white mb-6 tracking-tight">
                <?php echo esc_html($headline); ?>
            </h2>
            <a href="mailto:<?php echo esc_attr($email); ?>" class="inline-block text-2xl md:text-4xl font-bold text-brand-400 hover:text-brand-300 transition-colors duration-300 group relative">
                <?php echo esc_html($email); ?>
                <span class="absolute -bottom-2 left-0 w-full h-1 bg-brand-400 scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
            </a>
        </div>

        <!-- Middle Section: Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-20">
            <!-- Brand / Bio -->
            <div class="md:col-span-2">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="text-2xl font-black text-white tracking-tight block mb-6">
                    César Luis <span class="text-brand-400">Amundaray</span>
                </a>
                <p class="text-gray-400 text-lg max-w-sm leading-relaxed">
                    <?php echo esc_html($description); ?>
                </p>
            </div>

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

            <!-- Social / Professional Links -->
            <div>
                <h3 class="text-white font-bold text-lg mb-6 tracking-wide">Redes</h3>
                <ul class="flex flex-col gap-4">
                    <?php foreach ($social_links as $social): ?>
                    <li>
                        <a href="<?php echo esc_url($social['url']); ?>" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-brand-300 transition-colors duration-300 flex items-center group">
                            <span class="mr-2 group-hover:translate-x-1 transition-transform duration-300">→</span>
                            <?php echo esc_html($social['platform']); ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
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

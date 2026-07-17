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
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-12 mb-20 text-left">
            <!-- Brand / Bio -->
            <div class="col-span-2 md:col-span-3 lg:col-span-2">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center gap-3 text-xl font-black text-white tracking-tight hover:text-brand-300 transition-colors duration-300 mb-6">
                    <div class="relative w-10 h-10 flex items-center justify-center rounded-lg bg-gradient-to-br from-brand-400/20 to-brand-600/10 border border-brand-500/30">
                        <span class="text-brand-300 font-black text-xl leading-none mt-0.5">C</span>
                    </div>
                    <span>César Luis</span>
                </a>
                <p class="text-gray-400 text-lg max-w-sm leading-relaxed">
                    <?php echo esc_html($description); ?>
                </p>
                <?php if (!empty($social_links)): ?>
                <div class="flex items-center gap-4 mt-6">
                    <?php foreach ($social_links as $social): ?>
                    <a href="<?php echo esc_url($social['url']); ?>" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-brand-300 transition-all duration-300 hover:scale-110" aria-label="<?php echo esc_attr($social['platform']); ?>">
                        <?php echo $social['icon']; ?>
                    </a>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- Column 2: Navegación -->
            <div class="col-span-1 md:col-span-1 lg:col-span-1">
                <h3 class="text-white font-bold text-lg mb-6 tracking-wide">Navegación</h3>
                <ul class="flex flex-col gap-4">
                    <li>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="text-gray-400 hover:text-brand-300 transition-colors duration-300">
                            Inicio
                        </a>
                    </li>
                    <?php foreach ($quick_links as $link): ?>
                    <li>
                        <a href="<?php echo esc_url($link['url']); ?>" class="text-gray-400 hover:text-brand-300 transition-colors duration-300">
                            <?php echo esc_html($link['label']); ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Column 3: Contacto -->
            <div class="col-span-1 md:col-span-1 lg:col-span-1">
                <h3 class="text-white font-bold text-lg mb-6 tracking-wide">Contacto</h3>
                <ul class="flex flex-col gap-4 text-sm">
                    <?php 
                    $contact_email = get_option('wp_ai_contact_email', 'hello@example.com');
                    $contact_phone = get_option('wp_ai_contact_phone');
                    
                    if (!empty($contact_email)): ?>
                    <li>
                        <a href="mailto:<?php echo esc_attr($contact_email); ?>" class="text-gray-400 hover:text-brand-300 transition-colors duration-300 break-all">
                            <?php echo esc_html($contact_email); ?>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php 
                    $wa_number = get_option('wp_ai_social_whatsapp');
                    if (empty($wa_number)) {
                        $wa_number = $contact_phone;
                    }
                    if (!empty($wa_number)): 
                        $wa_clean = preg_replace('/[^0-9]/', '', $wa_number);
                        $wa_link = 'https://wa.me/' . $wa_clean;
                    ?>
                    <li>
                        <a href="<?php echo esc_url($wa_link); ?>" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-brand-300 transition-colors duration-300 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" /><path d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1" /></svg>
                            Chat vía WhatsApp
                        </a>
                    </li>
                    <?php endif; ?>
                    <li>
                        <a href="<?php echo site_url('/contacto'); ?>" class="text-brand-400 font-semibold hover:text-brand-300 transition-colors duration-300 flex items-center gap-1">
                            ¿Hablamos? <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Column 4: Newsletter -->
            <div class="col-span-2 md:col-span-1 lg:col-span-1">
                <h3 class="text-white font-bold text-lg mb-6 tracking-wide">Newsletter</h3>
                <p class="text-gray-400 text-sm mb-4 leading-relaxed">
                    Recibe ideas de desarrollo web a medida e inteligencia artificial.
                </p>
                <form action="#" method="POST" class="space-y-3" id="newsletter-form">
                    <div class="relative">
                        <input type="email" name="newsletter_email" placeholder="Tu email corporativo" required 
                            class="w-full bg-gray-950 border border-gray-800 hover:border-gray-700 rounded-xl px-4 py-3 text-sm text-white placeholder:text-gray-600 focus:border-brand-500 focus:outline-none transition-colors duration-300">
                    </div>
                    <button type="submit" class="w-full bg-brand-500 hover:bg-brand-400 text-gray-950 font-bold py-3 px-4 rounded-xl text-sm transition-all duration-300 shadow-lg shadow-brand-500/10 cursor-pointer">
                        Suscribirme
                    </button>
                </form>
                <div id="newsletter-message" class="text-xs mt-2 hidden"></div>
            </div>
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('newsletter-form');
            const msg = document.getElementById('newsletter-message');
            if (form && msg) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    msg.textContent = '¡Gracias por suscribirte!';
                    msg.className = 'text-xs mt-2 text-green-400 font-medium';
                    msg.classList.remove('hidden');
                    form.reset();
                });
            }
        });
        </script>

        <!-- Bottom Section: Legal -->
        <div class="pt-8 border-t border-gray-800/50 flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-gray-400 text-sm">
                <?php echo esc_html($copyright); ?>
            </p>
            
            <ul class="flex flex-wrap items-center gap-6">
                <?php foreach ($legal_links as $legal): ?>
                <li>
                    <a href="<?php echo esc_url($legal['url']); ?>" class="text-gray-400 text-sm hover:text-gray-300 transition-colors duration-300">
                        <?php echo esc_html($legal['label']); ?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>

    </div>
<?php
    // WhatsApp floating button if link is set
    $whatsapp_option = get_option('wp_ai_social_whatsapp');
    $whatsapp_url = '';
    if (!empty($whatsapp_option)) {
        if (strpos($whatsapp_option, 'http') === 0) {
            $whatsapp_url = $whatsapp_option;
        } else {
            $clean = preg_replace('/[^0-9]/', '', $whatsapp_option);
            $whatsapp_url = 'https://wa.me/' . $clean;
        }
    }
    if (!empty($whatsapp_url)) : ?>
    <a href="<?php echo esc_url($whatsapp_url); ?>" target="_blank" rel="noopener noreferrer" class="fixed bottom-6 right-6 z-50 bg-brand-500 hover:bg-brand-400 text-gray-950 rounded-full p-4 shadow-lg flex items-center justify-center transition-colors duration-300" aria-label="WhatsApp">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 flex-shrink-0" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" /><path d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1" /></svg>
    </a>
<?php endif; ?>
</footer>

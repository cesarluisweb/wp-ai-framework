<?php
/**
 * Footer Template — wp-ai-theme
 * Renderiza el componente footer premium-dark, cierra </body> y </html>.
 */

// Footer — Consistente en toda la web
$copyright = get_option('wp_ai_footer_copyright', '© ' . date('Y') . ' César Luis. Todos los derechos reservados.');

if(function_exists('wp_ai_render_component')) wp_ai_render_component('footer', 'premium-dark', [
    'site_name' => get_bloginfo('name') ?: 'César Luis',
    'tagline' => 'Desarrollo WordPress Profesional',
    'quick_links' => [
        ['label' => 'Sobre Mí',    'url' => site_url('/sobre-mi')],
        ['label' => 'Servicios',   'url' => site_url('/servicios')],
        ['label' => 'Portafolio',  'url' => site_url('/portafolio')],
        ['label' => 'Blog',        'url' => site_url('/blog')],
        ['label' => 'Contacto',    'url' => site_url('/contacto')]
    ],
    'legal_links' => [
        ['label' => 'Privacidad', 'url' => '#'],
        ['label' => 'Aviso Legal', 'url' => '#']
    ],
    'copyright' => $copyright
]);
?>

    <!-- Lenis Smooth Scrolling (Inertial Scroll) -->
    <script src="https://unpkg.com/lenis@1.1.20/dist/lenis.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            window.lenis = new Lenis({
                lerp: 0.07, // Menor es más suave y mantequilla
                wheelMultiplier: 1, // Velocidad de la rueda
                smoothWheel: true,
            });

            function raf(time) {
                window.lenis.raf(time);
                requestAnimationFrame(raf);
            }

            requestAnimationFrame(raf);
        });
    </script>

    <?php wp_footer(); ?>
</body>
</html>

<?php
/**
 * Footer Template — wp-ai-theme
 * Renderiza el componente footer premium-dark, cierra </body> y </html>.
 */

// Footer — Consistente en toda la web
if(function_exists('wp_ai_render_component')) wp_ai_render_component('footer', 'premium-dark', [
    'site_name' => get_bloginfo('name') ?: 'César Luis',
    'tagline' => 'Desarrollo WordPress Profesional',
    'quick_links' => [
        ['label' => 'Sobre Mí',    'url' => site_url('/sobre-mi')],
        ['label' => 'Servicios',   'url' => site_url('/servicios')],
        ['label' => 'Portafolio',  'url' => site_url('/portafolio')],
        ['label' => 'Contacto',    'url' => site_url('/contacto')]
    ],
    'social_links' => [
        ['platform' => 'LinkedIn', 'url' => 'https://linkedin.com'],
        ['platform' => 'GitHub', 'url' => 'https://github.com']
    ],
    'legal_links' => [
        ['label' => 'Privacidad', 'url' => '#'],
        ['label' => 'Aviso Legal', 'url' => '#']
    ],
    'copyright' => '© 2026 César Luis Amundaray. Todos los derechos reservados.'
]);
?>

    <!-- Lenis Smooth Scrolling (Inertial Scroll) -->
    <script src="https://unpkg.com/lenis@1.1.20/dist/lenis.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const lenis = new Lenis({
                lerp: 0.07, // Menor es más suave y mantequilla
                wheelMultiplier: 1, // Velocidad de la rueda
                smoothWheel: true,
            });

            function raf(time) {
                lenis.raf(time);
                requestAnimationFrame(raf);
            }

            requestAnimationFrame(raf);
        });
    </script>

    <?php wp_footer(); ?>
</body>
</html>

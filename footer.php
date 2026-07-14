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

    <?php wp_footer(); ?>
</body>
</html>

<?php
/**
 * Header Template — wp-ai-theme
 * Renderiza el <head>, abre <body> e inyecta el componente header premium-dark.
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body <?php body_class('bg-gray-950 text-white font-sans antialiased'); ?>>

<?php
// Header Navigation — Consistente en toda la web
$header_data = [
    'site_name' => get_bloginfo('name') ?: 'César Luis',
    'nav_links' => [
        ['label' => 'Sobre Mí',    'url' => site_url('/sobre-mi')],
        ['label' => 'Servicios',   'url' => site_url('/servicios')],
        ['label' => 'Portafolio',  'url' => site_url('/portafolio')],
        ['label' => 'Contacto',    'url' => site_url('/contacto')]
    ],
    'cta_button' => [
        'label' => '¿Hablamos?',
        'url'   => site_url('/contacto')
    ]
];
if(function_exists('wp_ai_render_component')) wp_ai_render_component('header', 'premium-dark', $header_data);
?>

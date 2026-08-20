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
    <meta name="theme-color" content="#03131c">
    <?php wp_head(); ?>
    <link rel="icon" type="image/svg+xml" href="<?php echo esc_url(get_template_directory_uri() . '/assets/img/favicon.svg'); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url(get_template_directory_uri() . '/assets/img/favicon-32x32.png'); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url(get_template_directory_uri() . '/assets/img/apple-touch-icon.png'); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Albert+Sans:ital,wght@0,300..900;1,300..900&family=JetBrains+Mono:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    
    <!-- Speculation Rules API (Prerender nativo en hover) -->
    <script type="speculationrules">
    {
      "prerender": [{
        "where": {
          "and": [
            { "href_matches": "/*" },
            { "not": { "href_matches": "/wp-admin/*" } },
            { "not": { "href_matches": "/wp-login.php" } },
            { "not": { "href_matches": "/*?*" } },
            { "not": { "selector_matches": "[rel~=nofollow]" } }
          ]
        },
        "eagerness": "moderate"
      }]
    }
    </script>
</head>
<body <?php body_class('bg-gray-950 text-gray-200 font-sans antialiased'); ?>>

<?php
// Megamenu Data - Servicios
$services_mega = [];
$args_s = ['post_type' => 'servicio', 'posts_per_page' => 4, 'order' => 'ASC'];
$q_s = new WP_Query($args_s);
if ($q_s->have_posts()) {
    while($q_s->have_posts()) {
        $q_s->the_post();
        $icon = function_exists('get_field') ? get_field('icon') : 'code';
        $desc = function_exists('get_field') ? get_field('desc') : '';
        $services_mega[] = [
            'title' => get_the_title(),
            'url' => get_permalink(),
            'icon' => $icon ?: 'code',
            'desc' => wp_trim_words($desc, 12)
        ];
    }
    wp_reset_postdata();
}

// Megamenu Data - Portafolio
$portfolio_mega = [];
$args_p = ['post_type' => 'proyecto', 'posts_per_page' => 4];
$q_p = new WP_Query($args_p);
if ($q_p->have_posts()) {
    while($q_p->have_posts()) {
        $q_p->the_post();
        $portfolio_mega[] = [
            'title' => get_the_title(),
            'url' => get_permalink(),
            'image' => get_the_post_thumbnail_url(get_the_ID(), 'medium')
        ];
    }
    wp_reset_postdata();
}

// Megamenu Data - Blog
$blog_mega = [];
$args_b = ['post_type' => 'post', 'posts_per_page' => 4];
$q_b = new WP_Query($args_b);
if ($q_b->have_posts()) {
    while($q_b->have_posts()) {
        $q_b->the_post();
        $blog_mega[] = [
            'title' => get_the_title(),
            'url' => get_permalink(),
            'date' => get_the_date('d M Y'),
            'image' => get_the_post_thumbnail_url(get_the_ID(), 'thumbnail')
        ];
    }
    wp_reset_postdata();
}

$get_str = function($str, $fallback) {
    return function_exists('pll__') ? pll__($fallback) : $fallback;
};

// Polylang Languages
$languages = [];
if (function_exists('pll_the_languages')) {
    $languages = pll_the_languages(['raw' => 1, 'hide_if_empty' => 0]);
}

$header_data = [
    'site_name' => get_bloginfo('name') ?: 'César Luis',
    'languages' => $languages,
    'nav_links' => [
        ['label' => $get_str('nav_sobre_mi', 'Sobre Mí'),    'url' => function_exists('pll_home_url') ? site_url('/sobre-mi') : site_url('/sobre-mi')],
        ['label' => $get_str('nav_servicios', 'Servicios'),   'url' => site_url('/servicios'), 'type' => 'services', 'megamenu' => $services_mega],
        ['label' => $get_str('nav_portafolio', 'Portafolio'),  'url' => site_url('/portafolio'), 'type' => 'portfolio', 'megamenu' => $portfolio_mega],
        ['label' => $get_str('nav_blog', 'Blog'),        'url' => site_url('/blog'), 'type' => 'blog', 'megamenu' => $blog_mega],
        ['label' => $get_str('nav_contacto', 'Contacto'),    'url' => site_url('/contacto')]
    ],
    'cta_button' => [
        'label' => $get_str('cta_iniciar_proyecto', 'Iniciar Proyecto'),
        'url'   => site_url('/contacto')
    ]
];
if(function_exists('wp_ai_render_component')) wp_ai_render_component('header', 'premium-dark', $header_data);
?>

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
    <link rel="icon" type="image/svg+xml" href="<?php echo esc_url(get_template_directory_uri() . '/assets/img/favicon.svg'); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body <?php body_class('bg-gray-950 text-white font-sans antialiased'); ?>>

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

// Header Navigation — Consistente en toda la web
$header_data = [
    'site_name' => get_bloginfo('name') ?: 'César Luis',
    'nav_links' => [
        ['label' => 'Sobre Mí',    'url' => site_url('/sobre-mi')],
        ['label' => 'Servicios',   'url' => site_url('/servicios'), 'type' => 'services', 'megamenu' => $services_mega],
        ['label' => 'Portafolio',  'url' => site_url('/portafolio'), 'type' => 'portfolio', 'megamenu' => $portfolio_mega],
        ['label' => 'Blog',        'url' => site_url('/blog'), 'type' => 'blog', 'megamenu' => $blog_mega],
        ['label' => 'Contacto',    'url' => site_url('/contacto')]
    ],
    'cta_button' => [
        'label' => '¿Hablamos?',
        'url'   => site_url('/contacto')
    ]
];
if(function_exists('wp_ai_render_component')) wp_ai_render_component('header', 'premium-dark', $header_data);
?>

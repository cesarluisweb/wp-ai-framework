<?php
/**
 * WP-AI Framework - Front Page Template (Dynamic Integration)
 */
get_header();
?>


<?php
// 1. HEADER — Inyectado por get_header() arriba. No redefinir aquí.
// El header.php ya incluye el componente con los enlaces a las páginas reales.

// 2. HERO
$hero_data = [
    'kicker' => wp_ai_get_field_fallback('hero_kicker', 'PARTNER TÉCNICO'),
    'headline' => wp_ai_get_field_fallback('hero_headline', 'Desarrollo<br>WordPress<br>que funciona.'),
    'subheadline' => wp_ai_get_field_fallback('hero_subheadline', 'Creo, optimizo y doy soporte a sitios web para agencias y empresas que necesitan rendimiento, fidelidad al diseño y entregas impecables.'),
    'cta_primary' => [
        'label' => wp_ai_get_field_fallback('hero_cta_label', '¿Hablamos?'),
        'url' => wp_ai_get_field_fallback('hero_cta_url', '#cta'),
    ],
    'cta_secondary' => [
        'label' => 'Ver mi trabajo',
        'url' => '#portfolio'
    ],
    'hero_image' => ''
];
if(function_exists('wp_ai_render_component')) wp_ai_render_component('hero', 'premium-dark', $hero_data);


// 4. ABOUT
$bio_text = wp_ai_get_field_fallback('about_bio', '');
$bio_paragraphs = [];
if (!empty($bio_text)) {
    $bio_paragraphs = array_filter(array_map('trim', explode("\n", strip_tags($bio_text))));
}

if (!empty($bio_paragraphs)) {
    $about_data = [
        'headline' => wp_ai_get_field_fallback('about_headline', 'César Luis, desarrollador web WordPress'),
        'bio_paragraphs' => $bio_paragraphs,
        'image_url' => wp_ai_get_field_fallback('about_image', get_the_post_thumbnail_url(get_the_ID(), 'large'))
    ];
    if(function_exists('wp_ai_render_component')) wp_ai_render_component('about', 'premium-dark', $about_data);
}

// 5. PORTFOLIO (CPT)
$portfolio_limit = (int) wp_ai_get_field_fallback('home_portfolio_limit', 4);
$projects_arr = [];
$featured_ids = function_exists('get_field') ? get_field('home_featured_projects') : false;

$args_p = ['post_type' => 'proyecto', 'posts_per_page' => $portfolio_limit];

if (!empty($featured_ids) && is_array($featured_ids)) {
    // Si el campo devuelve objetos (Post Object) extraemos los IDs
    if (isset($featured_ids[0]->ID)) {
        $featured_ids = array_map(function($p) { return $p->ID; }, $featured_ids);
    }
    $args_p['post__in'] = $featured_ids;
    $args_p['orderby'] = 'post__in';
    // Ignoramos el límite de $portfolio_limit si el usuario seleccionó manualmente
    $args_p['posts_per_page'] = count($featured_ids); 
}

$q_p = new WP_Query($args_p);
if ($q_p->have_posts()) {
    while($q_p->have_posts()) {
        $q_p->the_post();
        $terms = wp_get_post_terms(get_the_ID(), 'categoria_proyecto', ['fields' => 'names']);
        $cat = (!empty($terms) && !is_wp_error($terms)) ? $terms[0] : 'Desarrollo Web';
        
        $tech_terms = wp_get_post_terms(get_the_ID(), 'tech_stack', ['fields' => 'names']);
        $techs = (!empty($tech_terms) && !is_wp_error($tech_terms)) ? $tech_terms : ['WordPress'];
        
        $projects_arr[] = [
            'title' => get_the_title(),
            'description' => get_the_excerpt() ?: apply_filters('the_content', get_the_content()),
            'category' => $cat,
            'tech_stack' => $techs,
            'image_url' => get_the_post_thumbnail_url(get_the_ID(), 'large'),
            'url' => get_permalink(),
            'image_gradient' => function_exists('get_field') ? get_field('css_gradient') : 'linear-gradient(135deg, #0a1f2a 0%, #144257 50%, #287799 100%)'
        ];
    }
    wp_reset_postdata();
}

if (!empty($projects_arr)) {
    if(function_exists('wp_ai_render_component')) wp_ai_render_component('portfolio', 'premium-dark', [
        'section_kicker' => 'Portafolio',
        'section_title' => 'Proyectos recientes',
        'section_description' => 'Una selección de trabajos donde la calidad del código y el resultado final hablan por sí solos.',
        'projects' => $projects_arr
    ]);
}

// 6. SERVICES (CPT)
$services_arr = [];
$featured_services_ids = function_exists('get_field') ? get_field('home_featured_services') : false;

$args_s = ['post_type' => 'servicio', 'posts_per_page' => -1, 'order' => 'ASC'];

if (!empty($featured_services_ids) && is_array($featured_services_ids)) {
    if (isset($featured_services_ids[0]->ID)) {
        $featured_services_ids = array_map(function($s) { return $s->ID; }, $featured_services_ids);
    }
    $args_s['post__in'] = $featured_services_ids;
    $args_s['orderby'] = 'post__in';
}

$q = new WP_Query($args_s);
if ($q->have_posts()) {
    while($q->have_posts()) {
        $q->the_post();
        $icon = function_exists('get_field') ? get_field('icon') : '';
        $desc = function_exists('get_field') ? get_field('desc') : '';
        $features_raw = function_exists('get_field') ? get_field('features') : '';
        $features = array_filter(array_map('trim', explode("\n", $features_raw)));
        
        $services_arr[] = [
            'title' => get_the_title(),
            'description' => $desc,
            'icon' => $icon ?: 'code',
            'features' => $features,
            'url' => get_permalink()
        ];
    }
    wp_reset_postdata();
}



if (!empty($services_arr)) {
    if(function_exists('wp_ai_render_component')) wp_ai_render_component('services', 'premium-dark', [
        'section_title' => 'Mis Soluciones',
        'services' => $services_arr
    ]);
}

// 3. MARQUEE STACK (Trust Bar)
$tech_stack = function_exists('wp_ai_get_core_tech_stack') ? wp_ai_get_core_tech_stack() : [];
if(!empty($tech_stack) && function_exists('wp_ai_render_component')) {
    wp_ai_render_component('marquee', 'premium-dark', ['items' => $tech_stack]);
}

// 7. TESTIMONIALS (CPT)
$testi_arr = [];
$featured_testimonials_ids = function_exists('get_field') ? get_field('home_featured_testimonials') : false;

$args_t = ['post_type' => 'testimonio', 'posts_per_page' => 6];

if (!empty($featured_testimonials_ids) && is_array($featured_testimonials_ids)) {
    if (isset($featured_testimonials_ids[0]->ID)) {
        $featured_testimonials_ids = array_map(function($t) { return $t->ID; }, $featured_testimonials_ids);
    }
    $args_t['post__in'] = $featured_testimonials_ids;
    $args_t['orderby'] = 'post__in';
    $args_t['posts_per_page'] = count($featured_testimonials_ids);
}

$q_t = new WP_Query($args_t);
if ($q_t->have_posts()) {
    while($q_t->have_posts()) {
        $q_t->the_post();
        $testi_arr[] = [
            'author' => get_the_title(),
            'quote' => get_post_meta(get_the_ID(), 'testimonial_content', true),
            'role' => '',
            'company' => get_post_meta(get_the_ID(), 'testimonial_country', true),
            'link' => get_post_meta(get_the_ID(), 'testimonial_link', true),
            'rating' => 5,
            'image' => get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'),
        ];
    }
    wp_reset_postdata();
}

if (!empty($testi_arr)) {
    if(function_exists('wp_ai_render_component')) wp_ai_render_component('testimonials', 'premium-dark', [
        'section_kicker' => 'Opiniones',
        'section_title' => 'Lo que dicen mis clientes',
        'testimonials' => $testi_arr
    ]);
}

// --- METRICS ---
$metrics_arr = [];
for ($i = 1; $i <= 3; $i++) {
    $val = wp_ai_get_field_fallback('metric_'.$i.'_val', '');
    $lab = wp_ai_get_field_fallback('metric_'.$i.'_lab', '');
    if (!empty($val) && !empty($lab)) {
        $metrics_arr[] = ['value' => $val, 'label' => $lab];
    }
}
if (!empty($metrics_arr)) {
    if(function_exists('wp_ai_render_component')) wp_ai_render_component('metrics', 'premium-dark', ['metrics' => $metrics_arr]);
}

// 8. FAQ (CPT)
$faq_arr = [];
$featured_faqs = wp_ai_get_field_fallback('home_featured_faq');

if ( !empty($featured_faqs) ) {
    // Utilizar las FAQs seleccionadas en ACF, respetando su orden manual
    foreach ($featured_faqs as $faq_post) {
        $faq_arr[] = [
            'question' => get_the_title($faq_post->ID),
            'answer' => apply_filters('the_content', $faq_post->post_content)
        ];
    }
} else {
    // Fallback: Mostrar todas (por fecha)
    $args_f = [
        'post_type' => 'faq', 
        'posts_per_page' => -1
    ];
    $q_f = new WP_Query($args_f);
    if ($q_f->have_posts()) {
        while($q_f->have_posts()) {
            $q_f->the_post();
            $faq_arr[] = [
                'question' => get_the_title(),
                'answer' => apply_filters('the_content', get_the_content())
            ];
        }
        wp_reset_postdata();
    }
}

if (!empty($faq_arr)) {
    if(function_exists('wp_ai_render_component')) wp_ai_render_component('faq', 'premium-dark', [
        'section_kicker' => 'Preguntas frecuentes',
        'section_title' => 'Resolvamos tus dudas',
        'section_description' => 'Las preguntas más comunes que recibo de agencias y empresas antes de trabajar juntos.',
        'questions' => $faq_arr
    ]);
}

// 9. METHODOLOGY
$scale_defaults = [
    ['letter' => 'S', 'title' => 'Setup', 'desc' => 'Alineación inicial y definición de objetivos del proyecto.'],
    ['letter' => 'C', 'title' => 'Core', 'desc' => 'Desarrollo de la arquitectura y estructura principal.'],
    ['letter' => 'A', 'title' => 'Auditoría', 'desc' => 'Análisis del estado actual y definición de arquitectura.'],
    ['letter' => 'L', 'title' => 'Lanzamiento', 'desc' => 'Despliegue a producción con pruebas rigurosas.'],
    ['letter' => 'E', 'title' => 'Evolución', 'desc' => 'Soporte continuo, monitoreo y mejoras progresivas.']
];

$method_steps = [];
for ($i = 1; $i <= 5; $i++) {
    $idx = $i - 1;
    $l = wp_ai_get_field_fallback('step_'.$i.'_letter', '');
    $t = wp_ai_get_field_fallback('step_'.$i.'_title', '');
    $d = wp_ai_get_field_fallback('step_'.$i.'_desc', '');
    
    // Forzar la letra de SCALE
    $l = $scale_defaults[$idx]['letter'];
    
    // Si el título está vacío (o no definido), usar los de por defecto para completar los 5
    if (empty($t)) {
        $t = $scale_defaults[$idx]['title'];
        $d = $scale_defaults[$idx]['desc'];
    }

    $method_steps[] = ['letter' => $l, 'title' => $t, 'description' => $d];
}
if (!empty($method_steps)) {
    if(function_exists('wp_ai_render_component')) wp_ai_render_component('methodology', 'premium-dark', [
        'section_kicker' => wp_ai_get_field_fallback('method_kicker', 'Metodología'),
        'section_title' => wp_ai_get_field_fallback('method_title', 'Framework SCALE™'),
        'section_description' => wp_ai_get_field_fallback('method_desc', 'Mi proceso estandarizado para garantizar que los proyectos complejos no fracasen. Predecible, seguro y escalable.'),
        'steps' => $method_steps
    ]);
}

// 10. BLOG (Native WP Posts)
$blog_arr = [];
$args_b = ['post_type' => 'post', 'posts_per_page' => 4];
$q_b = new WP_Query($args_b);
$count = 0;
if ($q_b->have_posts()) {
    while($q_b->have_posts()) {
        $q_b->the_post();
        $count++;
        $cats = get_the_category();
        $cat_name = !empty($cats) ? $cats[0]->name : 'Blog';
        
        $blog_arr[] = [
            'title' => get_the_title(),
            'excerpt' => get_the_excerpt() ?: wp_trim_words(get_the_content(), 15),
            'date' => get_the_date(),
            'category' => $cat_name,
            'read_time' => '5 min',
            'url' => get_permalink(),
            'gradient' => 'linear-gradient(135deg, #0a1f2a 0%, #144257 100%)',
            'is_fourth' => ($count === 4)
        ];
    }
    wp_reset_postdata();
}

if (!empty($blog_arr)) {
    if(function_exists('wp_ai_render_component')) wp_ai_render_component('blog', 'premium-dark', [
        'section_kicker' => 'Blog',
        'section_title' => 'Últimos artículos',
        'posts' => $blog_arr
    ]);
}

// 11. CTA
$cta_headline = wp_ai_get_field_fallback('cta_headline', '¿Tienes un proyecto en mente?');
$cta_subheadline = wp_ai_get_field_fallback('cta_subheadline', 'Cuéntame qué necesitas y te digo cómo puedo ayudarte. Sin compromiso.');
$cta_btn_label = wp_ai_get_field_fallback('cta_btn_label', 'Hablemos');
$cta_btn_url = wp_ai_get_field_fallback('cta_btn_url', '#contacto');

if(function_exists('wp_ai_render_component')) wp_ai_render_component('cta', 'premium-dark', [
    'headline' => $cta_headline,
    'subheadline' => $cta_subheadline,
    'button' => ['label' => $cta_btn_label, 'url' => $cta_btn_url],
    'guarantee' => 'Respuesta en menos de 24 horas'
]);

// 12. FOOTER
// Eliminado renderizado manual redundante. get_footer() se encarga globalmente.

get_footer();
?>

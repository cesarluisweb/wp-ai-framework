<?php
/**
 * Plantilla individual para Artículos de Blog
 * Diseño Premium Dark enfocado en SEO y legibilidad
 */

get_header();

$post_id = get_the_ID();
$title = get_the_title();
$content = get_the_content();
$image_url = get_the_post_thumbnail_url($post_id, 'full');
$author_name = get_the_author_meta('display_name');
$post_date = get_the_date();

// GEO/SEO: Schema Markup para el Artículo
$schema = [
    "@context" => "https://schema.org",
    "@type" => "BlogPosting",
    "headline" => $title,
    "image" => $image_url ?: '',
    "datePublished" => get_the_date('c'),
    "dateModified" => get_the_modified_date('c'),
    "author" => [
        "@type" => "Person",
        "name" => "César Luis Amundaray",
        "url" => home_url('/sobre-mi/')
    ],
    "publisher" => [
        "@type" => "Organization",
        "name" => "César Luis Amundaray",
        "logo" => [
            "@type" => "ImageObject",
            "url" => home_url('/assets/images/logo.png') // Fallback o logo real
        ]
    ],
    "description" => get_the_excerpt() ?: wp_trim_words(strip_tags($content), 30)
];
?>

<script type="application/ld+json">
<?php echo json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>
</script>

<main class="bg-gray-950 min-h-screen pb-20 selection:bg-brand-500 selection:text-white">
    
    <!-- Hero / Header del Artículo -->
    <section class="relative w-full overflow-hidden border-b border-gray-800 bg-gray-900 pb-20 pt-32">
        <!-- Background Blur/Glow Effects -->
        <div class="absolute top-0 left-1/4 w-[500px] h-[500px] bg-brand-500/10 rounded-full blur-[120px] pointer-events-none"></div>
        
        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-4xl mx-auto text-center flex flex-col items-center">
                <!-- Categorías -->
                <?php 
                $categories = get_the_category();
                if (!empty($categories)) : 
                ?>
                    <span class="inline-block text-brand-300 font-bold uppercase tracking-[0.2em] mb-6 border border-brand-500/30 bg-brand-500/10 px-4 py-1 rounded-full text-xs">
                        <?php echo esc_html($categories[0]->name); ?>
                    </span>
                <?php endif; ?>

                <h1 class="text-3xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-8">
                    <?php echo esc_html($title); ?>
                </h1>

                <!-- Meta del Post -->
                <div class="flex items-center gap-6 text-gray-500 text-sm font-medium">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <?php echo esc_html($post_date); ?>
                    </span>
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Por <?php echo esc_html($author_name); ?>
                    </span>
                </div>
            </div>
            
            <?php if ($image_url): ?>
            <div class="mt-16 w-full max-w-4xl mx-auto rounded-3xl overflow-hidden shadow-2xl border border-gray-800 relative">
                <div class="absolute inset-0 bg-gray-900 animate-pulse"></div>
                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($title); ?>" class="w-full h-auto max-h-[500px] object-cover relative z-10" loading="lazy">
                <div class="absolute inset-0 bg-gradient-to-t from-gray-950 via-transparent to-transparent z-20"></div>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Contenido Principal -->
    <section class="container mx-auto px-6 py-20">
        <div class="max-w-3xl mx-auto">
            <article class="prose prose-invert prose-sm md:prose-base lg:prose-lg max-w-none prose-headings:font-bold prose-h2:text-gray-200 prose-h2:mt-12 prose-h2:first:mt-0 prose-h2:mb-6 prose-p:text-gray-400 prose-p:leading-relaxed prose-li:text-gray-400 prose-strong:text-gray-200 prose-a:text-brand-400 hover:prose-a:text-brand-300 transition-colors">
                <?php echo wp_kses_post(apply_filters('the_content', $content)); ?>
            </article>

            <!-- Compartir o Navegación posterior -->
            <div class="mt-16 pt-8 border-t border-gray-800 flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="text-gray-500 text-sm">
                    ¿Te gustó el artículo? Compártelo en tus redes.
                </div>
                <div class="flex items-center gap-4">
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-white transition-colors">
                        LinkedIn
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Navegación de Posts -->
    <?php
    if(function_exists('wp_ai_render_component')) {
        wp_ai_render_component('post-navigation', 'premium-dark', []);
    }
    ?>

    <!-- CTA Section -->
    <?php
    if(function_exists('wp_ai_render_component')) {
        wp_ai_render_component('cta', 'premium-dark', [
            'headline' => '¿Listo para escalar tu infraestructura web?',
            'subheadline' => 'Desarrollo web a medida con arquitectura limpia, rendimiento extremo e integración de soluciones de Inteligencia Artificial.',
            'button' => [
                'label' => 'Hablemos de tu Proyecto',
                'url' => '/contacto'
            ]
        ]);
    }
    ?>

</main>

<?php get_footer(); ?>

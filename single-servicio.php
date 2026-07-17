<?php
/**
 * Plantilla individual para Servicios (Landing Page)
 * Diseño Premium Dark B2B
 */

get_header();

// Datos básicos del servicio
$post_id = get_the_ID();
$title = get_the_title();
$content = get_the_content();
$desc = get_post_meta($post_id, 'desc', true);
$icon_name = get_post_meta($post_id, 'icon', true);
$features_raw = get_post_meta($post_id, 'features', true);
$features = array_filter(array_map('trim', explode("\n", $features_raw)));

// GEO/SEO: Schema Markup para el Servicio
$schema = [
    "@context" => "https://schema.org",
    "@type" => "Service",
    "name" => $title,
    "description" => $desc ?: wp_trim_words(strip_tags($content), 30),
    "provider" => [
        "@type" => "Organization",
        "name" => "César Luis Amundaray",
        "url" => home_url()
    ]
];
?>

<script type="application/ld+json">
<?php echo json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>
</script>

<main class="bg-gray-950 min-h-screen selection:bg-brand-500 selection:text-white">
    
    <!-- Hero Section -->
    <section class="relative w-full overflow-hidden border-b border-gray-800 bg-gray-900 pb-20 pt-32">
        <!-- Background Glow -->
        <div class="absolute top-0 right-1/4 w-[500px] h-[500px] bg-brand-500/10 rounded-full blur-[120px] pointer-events-none"></div>
        
        <div class="w-full max-w-[1400px] mx-auto px-6 lg:px-8 relative z-10">
            <div class="max-w-4xl mx-auto text-center flex flex-col items-center">
                
                <!-- Icon -->
                <?php if ($icon_name): ?>
                <div class="mb-8 bg-gray-950 border border-gray-800 w-20 h-20 rounded-2xl flex items-center justify-center shadow-[0_0_30px_rgba(59,130,246,0.15)] relative">
                    <div class="absolute inset-0 bg-brand-400/10 rounded-2xl animate-pulse"></div>
                    <?php
                        if ($icon_name) {
                            // En single-servicio no queremos la clase w-6 h-6 por defecto, sino que herede currentColor
                            // Extraemos el innerHTML del SVG (ya que el contenedor exterior tiene sus propias clases w-10 h-10)
                            // En su lugar, es más fácil usar la función y sobreescribir la clase.
                            $svg_html = wp_ai_get_service_icon_svg($icon_name, 'w-10 h-10 text-brand-400 relative z-10');
                            
                            // Reemplazar todo el contenedor svg original por el devuelto por la función
                            echo $svg_html;
                        }
                    ?>
                </div>
                <?php endif; ?>

                <span class="inline-block text-brand-300 font-bold uppercase tracking-[0.2em] mb-4 text-sm">Servicio Especializado</span>
                <h1 class="text-4xl md:text-5xl lg:text-7xl font-extrabold text-white leading-tight mb-8">
                    <?php echo esc_html($title); ?>
                </h1>
                
                <?php if ($desc): ?>
                <p class="text-xl text-gray-400 max-w-3xl leading-relaxed">
                    <?php echo esc_html($desc); ?>
                </p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Contenido y Sidebar -->
    <section class="w-full py-20">
        <div class="w-full max-w-[1400px] mx-auto px-6 lg:px-8 flex flex-col lg:flex-row gap-16">
            
            <article class="w-full lg:w-8/12">
                <div class="prose prose-invert prose-sm md:prose-base lg:prose-lg max-w-none prose-headings:font-bold prose-h2:text-gray-200 prose-h2:mt-12 prose-h2:first:mt-0 prose-h2:mb-6 prose-h3:text-gray-200 prose-p:text-gray-400 prose-p:leading-relaxed prose-li:text-gray-400 prose-strong:text-gray-200 prose-a:text-brand-400 hover:prose-a:text-brand-300 transition-colors">
                    <?php 
                        if (!empty($content)) {
                            echo wp_kses_post(apply_filters('the_content', $content)); 
                        } else {
                            echo '<p class="text-gray-500 italic">Aquí irá la descripción larga del servicio...</p>';
                        }
                    ?>
                </div>

            </article>

            <!-- Sidebar: Características del Servicio -->
            <aside class="w-full lg:w-4/12">
                <div class="sticky top-32">
                    <?php if (!empty($features)): ?>
                    <div class="bg-gray-900 border border-gray-800 rounded-3xl p-8 shadow-2xl mb-8">
                        <h3 class="text-xl font-bold text-white mb-6 border-b border-gray-800 pb-4">¿Qué incluye?</h3>
                        
                        <ul class="space-y-4">
                            <?php foreach ($features as $feature): ?>
                                <li class="flex items-start gap-3 group">
                                    <div class="mt-1 bg-gray-950 p-1 rounded border border-gray-800 group-hover:border-brand-500/50 transition-colors shrink-0">
                                        <svg class="w-4 h-4 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <span class="text-gray-300 text-sm leading-relaxed"><?php echo esc_html($feature); ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                    
                    <!-- Tarjeta de Confianza -->
                    <div class="bg-gray-950 border border-brand-500/20 rounded-3xl p-8 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-brand-500/5 rounded-full blur-3xl pointer-events-none"></div>
                        <h4 class="text-lg font-bold text-white mb-3">Enfoque B2B Técnico</h4>
                        <p class="text-gray-400 text-sm leading-relaxed mb-6">Soluciones diseñadas específicamente para agencias que necesitan resolver cuellos de botella técnicos sin acumular deuda técnica a futuro.</p>
                        <div class="flex items-center gap-3 text-sm font-semibold text-brand-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            Garantía de Código Limpio
                        </div>
                    </div>
                </div>
            </aside>

        </div>
    </section>

    <!-- Navegación de Posts -->
    <?php
    if(function_exists('wp_ai_render_component')) {
        wp_ai_render_component('post-navigation', 'premium-dark', []);
    }
    ?>

    <!-- Unified CTA -->
    <?php
    if(function_exists('wp_ai_render_component')) {
        wp_ai_render_component('cta', 'premium-dark', [
            'headline' => '¿Preparado para escalar?',
            'subheadline' => 'Hablemos de tu proyecto y veamos cómo este servicio encaja en tu infraestructura.',
            'button' => [
                'label' => 'Agendar Diagnóstico',
                'url' => '/contacto'
            ]
        ]);
    }
    ?>

</main>

<?php get_footer(); ?>

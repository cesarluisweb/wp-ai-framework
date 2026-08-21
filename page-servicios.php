<?php
/**
 * Template Name: Servicios
 */
get_header();

// Fetch all services for the page AND for Schema generation
$servicios_args = [
    'post_type' => 'servicio',
    'posts_per_page' => -1,
    'order' => 'ASC'
];
$servicios_query = new WP_Query($servicios_args);

$schema_services = [];
if ($servicios_query->have_posts()) {
    while ($servicios_query->have_posts()) {
        $servicios_query->the_post();
        $schema_services[] = [
            "@type" => "Service",
            "name" => get_the_title(),
            "description" => wp_trim_words(get_post_meta(get_the_ID(), 'desc', true), 30),
            "provider" => [
                "@type" => "Person",
                "name" => "César Luis Amundaray",
                "url" => "https://cesarluis.com"
            ]
        ];
    }
    wp_reset_postdata();
}
?>

<!-- JSON-LD for SEO/GEO -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ItemList",
  "itemListElement": <?php echo json_encode($schema_services, JSON_UNESCAPED_UNICODE); ?>
}
</script>

<main class="pt-32 bg-gray-950 min-h-screen">
    <section class="max-w-[1400px] mx-auto px-6 lg:px-8 mb-24">
        
        <!-- Hero Section -->
        <div class="mb-20 text-center md:text-left flex flex-col items-center md:items-start">
            <?php
            $hero_kicker = wp_ai_get_field_fallback('hero_kicker', 'Servicios');
            $hero_h1_normal = wp_ai_get_field_fallback('hero_h1_normal', 'Arquitectura Web e IA para');
            $hero_h1_highlight = wp_ai_get_field_fallback('hero_h1_highlight', 'Escalar tu Agencia');
            $hero_description = wp_ai_get_field_fallback('hero_description', 'Servicios diseñados para resolver los cuellos de botella de agencias digitales. Integramos automatización, orquestación de LLMs y desarrollo de alto rendimiento sin deuda técnica.');
            ?>
            <span class="inline-block uppercase tracking-[0.2em] text-brand-300 text-sm font-semibold mb-6"><?php echo esc_html($hero_kicker); ?></span>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-gray-200 mb-8 leading-tight tracking-tight max-w-4xl">
                <?php echo esc_html($hero_h1_normal); ?> <br class="hidden md:inline"><span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-300 to-brand-500"><?php echo esc_html($hero_h1_highlight); ?></span>
            </h1>
            <p class="text-xl text-gray-400 max-w-3xl leading-relaxed">
                <?php echo esc_html($hero_description); ?>
            </p>
        </div>

        <!-- Services Bento Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php
            if ($servicios_query->have_posts()) :
                $index = 0;
                while ($servicios_query->have_posts()) : $servicios_query->the_post();
                    $desc = get_post_meta(get_the_ID(), 'desc', true);
                    $icon_name = get_post_meta(get_the_ID(), 'icon', true);
                    $features_raw = get_post_meta(get_the_ID(), 'features', true);
                    $features = array_filter(array_map('trim', explode("\n", $features_raw)));
                    
                    // Logic for asymmetric bento grid
                    // Index 0, 1 -> col-span-1
                    // Index 2 -> col-span-1 (but on LG spans 2 maybe? No, let's do:
                    // 0, 1 -> 1 col
                    // 2 -> spans 2 on MD/LG
                    // Wait, LG is 3 cols. Let's do:
                    // LG grid: 2 cols. 
                    // Items 2 and 5 span 2 cols.
                    $col_span = 'lg:col-span-1';
                    if ($index === 2 || $index === 5) {
                        $col_span = 'lg:col-span-2';
                    }
            ?>
            <a href="<?php the_permalink(); ?>" class="<?php echo $col_span; ?> bg-gray-900/40 border border-gray-800/80 rounded-3xl p-8 hover:bg-gray-900/80 transition-all duration-300 group hover:border-brand-500/30 flex flex-col block">
                
                <!-- Icon -->
                <div class="mb-6 bg-gray-950 inline-flex items-center justify-center w-16 h-16 shrink-0 rounded-2xl border border-gray-800 group-hover:border-brand-500/50 transition-colors">
                    <?php echo wp_ai_get_service_icon_svg($icon_name, 'w-8 h-8 text-brand-400'); ?>
                </div>
                
                <h3 class="text-2xl font-bold text-gray-200 mb-4"><?php the_title(); ?></h3>
                <p class="text-gray-400 mb-8 leading-relaxed"><?php echo esc_html($desc); ?></p>
                
                <?php if (!empty($features)) : ?>
                    <ul class="space-y-3 mt-auto">
                        <?php foreach ($features as $feature) : ?>
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-brand-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-300 text-sm"><?php echo esc_html($feature); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                
            </a>
            <?php
                $index++;
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </section>

    <!-- Filtro de Cualificación -->
    <section class="max-w-[1400px] mx-auto px-6 lg:px-8 mb-24 border-t border-gray-900 pt-24">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
            <!-- Es para ti -->
            <div class="bg-gray-900/20 border border-brand-500/20 rounded-3xl p-8 lg:p-12">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-12 h-12 rounded-full bg-brand-500/10 flex items-center justify-center">
                        <svg class="w-6 h-6 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-200"><?php echo esc_html(wp_ai_get_field_fallback('servicios_para_ti_titulo', 'Esto es para ti si...')); ?></h2>
                </div>
                <ul class="space-y-5 text-gray-300">
                    <?php 
                    $para_ti_default = "Eres una agencia o negocio B2B que necesita escalar su operatividad sin perder calidad.\nSabes que una web debe ser rápida, segura y estar optimizada para el SEO y las IAs (GEO).\nQuieres delegar la parte técnica en un profesional que se implique, no en un \"ejecutor de tareas\".\nValoras la transparencia, el código a medida y la automatización inteligente.";
                    $para_ti = wp_ai_get_field_fallback('servicios_para_ti', $para_ti_default);
                    $para_ti_items = array_filter(array_map('trim', explode("\n", $para_ti)));
                    foreach($para_ti_items as $item):
                    ?>
                    <li class="flex items-start gap-3">
                        <span class="text-brand-400 font-bold mt-1">•</span>
                        <span><?php echo esc_html($item); ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            
            <!-- NO es para ti -->
            <div class="bg-gray-950 border border-red-500/10 rounded-3xl p-8 lg:p-12 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-red-500/5 blur-[80px] rounded-full pointer-events-none"></div>
                <div class="flex items-center gap-4 mb-8 relative z-10">
                    <div class="w-12 h-12 rounded-full bg-red-500/10 flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-500/60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-400"><?php echo esc_html(wp_ai_get_field_fallback('servicios_no_para_ti_titulo', 'Y esto NO es para ti si...')); ?></h2>
                </div>
                <ul class="space-y-5 text-gray-500 relative z-10">
                    <?php 
                    $no_para_ti_default = "Buscas la solución más barata posible (el típico milagro por 300€).\nQuieres plantillas genéricas sin pensar en rendimiento ni escalabilidad.\nPrefieres micro-gestionar el proyecto línea por línea. Aquí contratamos confianza mutua.";
                    $no_para_ti = wp_ai_get_field_fallback('servicios_no_para_ti', $no_para_ti_default);
                    $no_para_ti_items = array_filter(array_map('trim', explode("\n", $no_para_ti)));
                    foreach($no_para_ti_items as $item):
                    ?>
                    <li class="flex items-start gap-3">
                        <span class="text-red-500/50 font-bold mt-1">✕</span>
                        <span><?php echo esc_html($item); ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </section>

    <!-- Methodology / Process -->
    <section class="max-w-[1400px] mx-auto px-6 lg:px-8 mb-24 border-t border-gray-900 pt-24">
        <div class="text-center mb-16">
            <span class="inline-block uppercase tracking-[0.2em] text-brand-300 text-sm font-semibold mb-4"><?php echo esc_html(wp_ai_get_field_fallback('servicios_proceso_kicker', 'Metodología')); ?></span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-200 mb-4"><?php echo esc_html(wp_ai_get_field_fallback('servicios_proceso_titulo', 'Cómo Trabajo')); ?></h2>
            <p class="text-gray-400 max-w-2xl mx-auto"><?php echo esc_html(wp_ai_get_field_fallback('servicios_proceso_desc', 'Un proceso claro y transparente de principio a fin, diseñado para agencias y proyectos serios.')); ?></p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php 
            $default_process = [
                1 => ['titulo' => 'Diagnóstico', 'desc' => 'Analizo tu situación actual, objetivos y restricciones técnicas para definir la estrategia de desarrollo correcta.'],
                2 => ['titulo' => 'Propuesta', 'desc' => 'Presento un plan técnico detallado con alcance, tiempos y costes exactos. Transparencia total, sin sorpresas ocultas.'],
                3 => ['titulo' => 'Desarrollo', 'desc' => 'Ejecuto el trabajo utilizando herramientas de IA de última generación, entregando avances verificables en cada sprint.'],
                4 => ['titulo' => 'Entrega y Soporte', 'desc' => 'Despliegue controlado en producción (Zero Downtime) con documentación completa y soporte técnico post-lanzamiento.'],
            ];
            
            for($i=1; $i<=4; $i++): 
                $title = wp_ai_get_field_fallback('servicios_proceso_'.$i.'_titulo', $default_process[$i]['titulo']);
                $desc = wp_ai_get_field_fallback('servicios_proceso_'.$i.'_desc', $default_process[$i]['desc']);
                $is_last = ($i === 4);
            ?>
            <!-- Step <?php echo $i; ?> -->
            <div class="relative">
                <div class="w-16 h-16 rounded-full bg-brand-500/10 border-2 <?php echo $is_last ? 'border-brand-500 shadow-[0_0_20px_rgba(59,130,246,0.4)] text-gray-200' : 'border-brand-500/50 shadow-[0_0_15px_rgba(59,130,246,0.2)] text-brand-400'; ?> flex items-center justify-center font-bold text-xl mb-6">0<?php echo $i; ?></div>
                <h3 class="text-xl font-bold text-gray-200 mb-3"><?php echo esc_html($title); ?></h3>
                <p class="text-gray-400 text-sm leading-relaxed"><?php echo esc_html($desc); ?></p>
                <?php if(!$is_last): ?>
                <div class="hidden lg:block absolute top-8 left-20 right-0 h-[2px] bg-gradient-to-r from-brand-500/50 to-transparent border-t-2 border-dashed border-gray-800"></div>
                <?php endif; ?>
            </div>
            <?php endfor; ?>
        </div>
    </section>

    <!-- Unified CTA -->
    <?php
    if(function_exists('wp_ai_render_component')) {
        $cta_h2 = wp_ai_get_field_fallback('cta_h2', '¿Necesitas alguno de estos servicios?');
        $cta_desc = wp_ai_get_field_fallback('cta_description', 'El trabajo de mantenimiento web y desarrollo se vuelve sencillo cuando trabajas con el aliado técnico correcto.');
        $cta_btn_text = wp_ai_get_field_fallback('cta_button_text', 'Contáctame');
        $cta_btn_url = wp_ai_get_field_fallback('cta_button_url', '/contacto');
        
        wp_ai_render_component('cta', 'premium-dark', [
            'headline' => $cta_h2,
            'subheadline' => $cta_desc,
            'button' => [
                'label' => $cta_btn_text,
                'url' => $cta_btn_url
            ]
        ]);
    }
    ?>

</main>

<!-- To fix the grid layout correctly across breakpoints for Bento -->
<style>
@media (min-width: 1024px) {
    /* Set explicitly to 2 columns on lg */
    .grid.lg\:grid-cols-3 {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}
</style>

<?php get_footer(); ?>

<?php
/**
 * Component: Services
 * Variant: premium-dark
 * 
 * 3-column elegant layout for B2B services.
 * 
 * Expected $data:
 * - section_title (string)
 * - services (array of arrays: title, description, features[], icon)
 */

$section_title = $data['section_title'] ?? 'Mis Soluciones';
$services = $data['services'] ?? [];

// Generar Schema de Servicios Dinámico para GEO
$schema_services = [];
foreach($services as $svc) {
    if(!empty($svc['title'])) {
        $schema_services[] = [
            "@type" => "Service",
            "name" => $svc['title'],
            "description" => $svc['description'] ?? '',
            "provider" => [
                "@type" => "Organization",
                "name" => "César Luis Amundaray"
            ]
        ];
    }
}
?>

<!-- SEO/GEO: Service Schema -->
<?php if(!empty($schema_services)): ?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": <?php echo json_encode($schema_services, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>
}
</script>
<?php endif; ?>


<section id="services" class="py-24 lg:py-32 bg-gray-950 relative overflow-hidden border-t border-gray-800/60">
    <!-- Decoración de fondo -->
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_rgba(0,169,204,0.03)_0%,_transparent_70%)] pointer-events-none"></div>

    <div class="w-full max-w-[1400px] mx-auto px-6 lg:px-8 relative z-10">
        
        <!-- Header -->
        <div class="mb-16">
            <span class="inline-block uppercase tracking-[0.2em] text-brand-300 text-sm font-semibold mb-4">Servicios</span>
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white leading-tight">
                <?php echo esc_html($section_title); ?>
            </h2>
            <?php if (!empty($section_description)): ?>
                <p class="mt-5 text-lg text-gray-400 leading-relaxed"><?php echo esc_html($section_description); ?></p>
            <?php endif; ?>
        </div>

        <!-- Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach($services as $index => $service): ?>
            <?php if (!empty($service['url'])): ?>
            <a href="<?php echo esc_url($service['url']); ?>" class="group relative bg-gray-900/40 backdrop-blur-sm border border-gray-800/60 rounded-2xl p-8 hover:bg-gray-900/80 transition-all duration-500 hover:-translate-y-2 hover:border-brand-500/30 overflow-hidden block">
            <?php else: ?>
            <div class="group relative bg-gray-900/40 backdrop-blur-sm border border-gray-800/60 rounded-2xl p-8 hover:bg-gray-900/80 transition-all duration-500 hover:-translate-y-2 hover:border-brand-500/30 overflow-hidden">
            <?php endif; ?>
                
                <!-- Efecto hover resplandor -->
                <div class="absolute inset-0 bg-gradient-to-br from-brand-400/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>

                <!-- Icono abstracto o SVG del json si aplica -->
                <div class="w-14 h-14 rounded-xl bg-gray-950 border border-gray-800 flex items-center justify-center mb-8 group-hover:border-brand-400/50 transition-colors duration-300 shadow-lg relative">
                    <?php 
                    $icon_name = isset($service['icon']) ? $service['icon'] : 'default';
                    echo wp_ai_get_service_icon_svg($icon_name, 'w-6 h-6 text-brand-300');
                    ?>
                    <!-- Glow interno en el ícono -->
                    <div class="absolute inset-0 bg-brand-400/20 blur-md rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>

                <h3 class="text-2xl font-bold text-white mb-4 group-hover:text-brand-300 transition-colors duration-300">
                    <?php echo esc_html($service['title']); ?>
                </h3>
                
                <p class="text-gray-400 leading-relaxed mb-6">
                    <?php echo esc_html($service['description']); ?>
                </p>

                <?php if (!empty($service['features'])): ?>
                <ul class="space-y-3">
                    <?php foreach($service['features'] as $feature): ?>
                    <li class="flex items-start">
                        <span class="text-brand-400 mr-3 mt-1 text-xs">◆</span>
                        <span class="text-gray-300 text-sm"><?php echo esc_html($feature); ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            <?php if (!empty($service['url'])): ?>
            </a>
            <?php else: ?>
            </div>
            <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

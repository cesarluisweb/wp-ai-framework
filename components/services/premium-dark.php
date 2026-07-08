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
            <div class="group relative bg-gray-900/40 backdrop-blur-sm border border-gray-800/60 rounded-2xl p-8 hover:bg-gray-900/80 transition-all duration-500 hover:-translate-y-2 hover:border-brand-500/30 overflow-hidden">
                
                <!-- Efecto hover resplandor -->
                <div class="absolute inset-0 bg-gradient-to-br from-brand-400/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>

                <!-- Icono abstracto o SVG del json si aplica -->
                <div class="w-14 h-14 rounded-xl bg-gray-950 border border-gray-800 flex items-center justify-center mb-8 group-hover:border-brand-400/50 transition-colors duration-300 shadow-lg relative">
                    <?php if (isset($service['icon']) && $service['icon'] === 'code'): ?>
                        <svg class="w-6 h-6 text-brand-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                    <?php elseif (isset($service['icon']) && $service['icon'] === 'shield'): ?>
                        <svg class="w-6 h-6 text-brand-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    <?php elseif (isset($service['icon']) && $service['icon'] === 'cpu'): ?>
                        <svg class="w-6 h-6 text-brand-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m14-6h2m-2 6h2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path></svg>
                    <?php elseif (isset($service['icon']) && $service['icon'] === 'robot'): ?>
                        <svg class="w-6 h-6 text-brand-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    <?php elseif (isset($service['icon']) && $service['icon'] === 'globe'): ?>
                        <svg class="w-6 h-6 text-brand-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                    <?php elseif (isset($service['icon']) && $service['icon'] === 'server'): ?>
                        <svg class="w-6 h-6 text-brand-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path></svg>
                    <?php else: ?>
                        <svg class="w-6 h-6 text-brand-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"></path></svg>
                    <?php endif; ?>
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
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

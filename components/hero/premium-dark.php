<?php
/**
 * Component: Hero
 * Variant: premium-dark
 * 
 * Layout asimétrico: texto izquierda + terminal derecha
 * Fondo con gradientes múltiples sutiles (paleta cian/teal)
 * Contadores animados con IntersectionObserver
 * 
 * Expected $data matches design-system/contracts/hero.yml
 */

$kicker = $data['kicker'] ?? '';
$headline = $data['headline'] ?? '';
$subheadline = $data['subheadline'] ?? '';
$cta_primary = $data['cta_primary'] ?? null;
$cta_secondary = $data['cta_secondary'] ?? null;
$trust_badges = $data['trust_badges'] ?? [];
$metrics = $data['metrics'] ?? [];
?>

<!-- SEO/GEO: Organization Schema -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "César Luis Amundaray",
  "url": "https://cesarluis.com",
  "logo": "https://cesarluis.com/logo.png",
  "description": "Ingeniería de IA para Agencias: Orquestación de LLMs, Agentes Autónomos y Arquitectura Web Preparada para GEO.",
  "sameAs": [
    "https://linkedin.com/in/cesarluisamundaray",
    "https://github.com/cesarluis"
  ],
  "contactPoint": {
    "@type": "ContactPoint",
    "email": "hola@cesarluis.com",
    "contactType": "customer support"
  }
}
</script>

<style>
@keyframes float-slow {
    0%, 100% { transform: translate(0, 0) scale(1); }
    33% { transform: translate(20px, -15px) scale(1.02); }
    66% { transform: translate(-15px, 10px) scale(0.98); }
}
@keyframes float-reverse {
    0%, 100% { transform: translate(0, 0) scale(1); }
    33% { transform: translate(-18px, 12px) scale(0.98); }
    66% { transform: translate(12px, -18px) scale(1.02); }
}
@keyframes float-diagonal {
    0%, 100% { transform: translate(0, 0) scale(1); }
    50% { transform: translate(15px, 15px) scale(1.01); }
}
@keyframes pulse-glow {
    0%, 100% { opacity: 0.3; }
    50% { opacity: 0.6; }
}
.hero-blob-1 { animation: float-slow 12s ease-in-out infinite; }
.hero-blob-2 { animation: float-reverse 15s ease-in-out infinite; }
.hero-blob-3 { animation: float-diagonal 18s ease-in-out infinite; }
.hero-blob-4 { animation: float-slow 20s ease-in-out infinite 3s; }
.hero-glow { animation: pulse-glow 5s ease-in-out infinite; }
</style>

<section class="relative bg-gray-950 text-white overflow-hidden lg:min-h-screen flex items-center pt-24 pb-12 lg:pt-20 lg:pb-0" id="hero">
    <!-- Fondo: gradientes múltiples, simétricos y sutiles -->
    <div class="absolute inset-0">
        <!-- Grid sutil -->
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: linear-gradient(rgba(0,216,255,1) 1px, transparent 1px), linear-gradient(90deg, rgba(0,216,255,1) 1px, transparent 1px); background-size: 80px 80px;"></div>
        
        <!-- Blobs simétricos: distribuidos uniformemente -->
        <div class="hero-blob-1 absolute top-[15%] left-[10%] w-[350px] h-[350px] rounded-full bg-brand-500/15 blur-[100px]"></div>
        <div class="hero-blob-2 absolute top-[10%] right-[15%] w-[300px] h-[300px] rounded-full bg-brand-400/12 blur-[90px]"></div>
        <div class="hero-blob-3 absolute bottom-[20%] left-[30%] w-[400px] h-[400px] rounded-full bg-brand-300/8 blur-[120px]"></div>
        <div class="hero-blob-4 absolute bottom-[15%] right-[10%] w-[280px] h-[280px] rounded-full bg-brand-500/10 blur-[80px]"></div>
        
        <!-- Gradiente radial central simétrico -->
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_rgba(0,169,204,0.06)_0%,_transparent_70%)]"></div>
        
        <!-- Viñeta para bordes -->
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_transparent_50%,_rgba(3,7,18,0.8)_100%)]"></div>
    </div>

    <div class="w-full max-w-[1400px] mx-auto px-6 lg:px-8 relative z-10 py-12 lg:py-0">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center lg:min-h-[calc(100vh-80px)]">
            
            <!-- Columna Izquierda: Contenido -->
            <div class="lg:col-span-7 py-12 lg:py-0 text-center lg:text-left flex flex-col items-center lg:items-start">
                <?php if ($kicker): ?>
                <div class="mb-8 inline-flex items-center px-4 py-1.5 rounded-full border border-brand-500/40 bg-brand-900/30 text-sm font-medium text-brand-300 backdrop-blur-sm">
                    <span class="flex w-2 h-2 rounded-full bg-brand-300 mr-2.5 animate-pulse"></span>
                    <?php echo esc_html($kicker); ?>
                </div>
                <?php endif; ?>

                <?php 
                    $headline_safe = wp_kses($headline, ['br' => []]);
                ?>
                <h1 class="text-[clamp(3.2rem,7vw,4.8rem)] font-black tracking-tight mb-8 leading-[1.05]">
                    <span class="block text-white"><?php echo $headline_safe; ?></span>
                </h1>

                <p class="text-lg md:text-xl text-gray-400 mb-10 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                    <?php echo esc_html($subheadline); ?>
                </p>

                <!-- CTAs -->
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 sm:gap-6 mb-14 w-full sm:w-auto px-6 sm:px-0">
                    <?php if ($cta_primary): ?>
                    <a href="<?php echo esc_url($cta_primary['url']); ?>" class="btn-primary group w-full sm:w-auto flex justify-center">
                        <span class="flex items-center">
                            <?php echo esc_html($cta_primary['label']); ?>
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </span>
                    </a>
                    <?php endif; ?>
                    
                    <?php if ($cta_secondary): ?>
                    <a href="<?php echo esc_url($cta_secondary['url']); ?>" class="group inline-flex items-center justify-center text-white font-semibold text-lg transition-colors duration-300 hover:text-brand-300 relative py-2 w-full sm:w-auto">
                        <span class="relative">
                            <?php echo esc_html($cta_secondary['label']); ?>
                            <span class="absolute left-0 bottom-0 w-full h-0.5 bg-brand-400 scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                        </span>
                    </a>
                    <?php endif; ?>
                </div>

                <!-- (Métricas removidas, movidas al componente metrics) -->
            </div>

            <!-- Columna Derecha: Terminal -->
            <div class="hidden lg:flex lg:col-span-5 justify-center items-center">
                <div class="relative w-full max-w-md">
                    <div class="relative rounded-xl border border-gray-800/80 bg-gray-900/60 backdrop-blur-xl shadow-2xl overflow-hidden">
                        <!-- Barra superior -->
                        <div class="flex items-center gap-2 px-4 py-3 border-b border-gray-800/50 bg-gray-900/80">
                            <div class="w-3 h-3 rounded-full bg-red-500/70"></div>
                            <div class="w-3 h-3 rounded-full bg-yellow-500/70"></div>
                            <div class="w-3 h-3 rounded-full bg-green-500/70"></div>
                            <span class="ml-3 text-xs text-gray-600 font-mono">~/proyecto-cliente</span>
                        </div>
                        <!-- Contenido -->
                        <div class="p-6 font-mono text-sm leading-relaxed">
                            <div class="text-gray-500 mb-3">// Lo que hago en cada proyecto:</div>
                            <div class="mb-4">
                                <span class="text-brand-300">✓</span> <span class="text-gray-300">Entender el problema real</span>
                            </div>
                            <div class="mb-4">
                                <span class="text-brand-300">✓</span> <span class="text-gray-300">Diseñar la arquitectura</span>
                            </div>
                            <div class="mb-4">
                                <span class="text-brand-300">✓</span> <span class="text-gray-300">Construir la solución</span>
                            </div>
                            <div class="mb-4">
                                <span class="text-brand-300">✓</span> <span class="text-gray-300">Entregar funcionando</span>
                            </div>
                            <div class="mt-6 pt-4 border-t border-gray-800/50">
                                <span class="text-gray-600">$</span> <span class="text-brand-300">deploy</span> <span class="text-gray-400">--production</span>
                            </div>
                            <div class="mt-2">
                                <span class="text-brand-400">→</span> <span class="text-gray-400">Sitio en producción.</span> <span class="text-brand-300">Sin sorpresas.</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Resplandor -->
                    <div class="hero-glow absolute -inset-4 bg-gradient-to-br from-brand-400/8 via-transparent to-brand-300/8 rounded-2xl blur-2xl -z-10"></div>
                </div>
            </div>

        </div>

        <!-- Trust Bar -->
        <?php if (!empty($trust_badges)): ?>
        <div class="pb-12 pt-8 border-t border-gray-800/30">
            <p class="text-xs text-gray-600 uppercase tracking-[0.2em] mb-5 font-semibold">Agencias y empresas que confían en mí</p>
            <div class="flex flex-wrap items-center gap-x-10 gap-y-3">
                <?php foreach($trust_badges as $badge): ?>
                    <span class="text-gray-500 font-medium text-sm hover:text-brand-300 transition-colors duration-300 cursor-default"><?php echo esc_html($badge); ?></span>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- (Script de animación movido a metrics) -->

<?php
/**
 * Component: About
 * Variant: technical-partner
 */

$kicker = $data['kicker'] ?? '';
$positioning_title = $data['positioning_title'] ?? '';
$unique_value_proposition = $data['unique_value_proposition'] ?? '';
$key_metrics = $data['key_metrics'] ?? [];
$tech_stack = $data['tech_stack'] ?? [];
$profile_image = $data['profile_image'] ?? '';
?>

<section class="py-24 bg-gray-900 border-t border-gray-800 relative overflow-hidden" id="about">
    <!-- Efecto de resplandor de fondo -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[1000px] h-[500px] opacity-20 pointer-events-none" 
         style="background: radial-gradient(circle, rgba(16,185,129,0.2) 0%, rgba(17,24,39,0) 70%);">
    </div>

    <div class="container mx-auto px-6 max-w-7xl relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 lg:gap-8 items-center">
            
            <!-- Columna Izquierda: Texto Principal -->
            <div class="lg:col-span-7">
                <?php if ($kicker): ?>
                <div class="inline-flex items-center px-3 py-1 rounded-full border border-emerald-900/50 bg-emerald-900/20 text-xs font-semibold tracking-wider text-emerald-400 uppercase mb-6">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    <?php echo esc_html($kicker); ?>
                </div>
                <?php endif; ?>

                <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-8 tracking-tight leading-tight">
                    <?php echo esc_html($positioning_title); ?>
                </h2>

                <p class="text-xl text-gray-400 leading-relaxed mb-12 max-w-2xl">
                    <?php echo esc_html($unique_value_proposition); ?>
                </p>

                <!-- Grid de Tecnologías -->
                <?php if (!empty($tech_stack)): ?>
                <div class="mt-8 pt-8 border-t border-gray-800">
                    <p class="text-sm font-semibold text-gray-500 uppercase tracking-widest mb-6">Stack Tecnológico Dominado</p>
                    <div class="flex flex-wrap gap-4">
                        <?php foreach($tech_stack as $tech): ?>
                        <div class="flex items-center px-4 py-2 bg-gray-800/50 border border-gray-700 rounded-md text-gray-300 shadow-sm hover:border-emerald-500/50 transition-colors duration-300">
                            <!-- Icono dinámico (por simplicidad usamos un SVG genérico de código) -->
                            <svg class="w-5 h-5 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                            <span class="font-medium"><?php echo esc_html($tech['name']); ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <!-- Columna Derecha: Métricas y Visual -->
            <div class="lg:col-span-5 relative">
                <div class="absolute inset-0 bg-gradient-to-tr from-emerald-600/10 to-blue-600/10 rounded-3xl transform rotate-3 scale-105 -z-10"></div>
                
                <div class="bg-gray-800 border border-gray-700 rounded-3xl p-8 lg:p-12 shadow-2xl relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-500/10 blur-3xl rounded-full"></div>
                    
                    <div class="flex flex-col space-y-10">
                        <?php foreach($key_metrics as $index => $metric): ?>
                        <div class="relative z-10 <?php echo $index > 0 ? 'pt-10 border-t border-gray-700/50' : ''; ?>">
                            <div class="text-5xl md:text-6xl font-black text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-emerald-200 mb-3 tracking-tighter">
                                <?php echo esc_html($metric['value']); ?>
                            </div>
                            <div class="text-gray-400 font-medium tracking-wide uppercase text-sm">
                                <?php echo esc_html($metric['label']); ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <!-- Opcional: Si el usuario pasa una imagen, la superponemos sutilmente o la mostramos en un widget flotante -->
                <?php if ($profile_image): ?>
                <div class="absolute -bottom-6 -left-6 w-32 h-32 rounded-2xl overflow-hidden border-4 border-gray-900 shadow-xl hidden md:block grayscale hover:grayscale-0 transition-all duration-500">
                    <img src="<?php echo esc_url($profile_image); ?>" alt="Perfil Técnico" class="w-full h-full object-cover">
                </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>

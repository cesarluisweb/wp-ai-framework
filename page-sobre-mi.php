<?php
/**
 * Template Name: Sobre Mí
 */
get_header();
?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Person",
  "name": "César Luis Amundaray",
  "jobTitle": "Desarrollador Web WordPress & Arquitecto de Soluciones IA",
  "url": "https://cesarluis.com",
  "sameAs": [
    "https://linkedin.com/in/cesarluis"
  ],
  "knowsAbout": [
    "WordPress", 
    "PHP", 
    "JavaScript", 
    "WooCommerce", 
    "AI/LLM Integration", 
    "SEO", 
    "GEO"
  ]
}
</script>

<main class="pt-24 pb-20 bg-gray-950">
    <!-- Hero Section -->
    <section class="max-w-[1400px] mx-auto px-6 lg:px-8 mb-24">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Text Content -->
            <div>
                <span class="text-brand-400 font-bold tracking-wider uppercase text-sm mb-4 block">Sobre Mí</span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                    César Luis <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-300 to-brand-500">Amundaray</span>
                </h1>
                <p class="text-xl text-gray-400 mb-8 max-w-2xl leading-relaxed">
                    Ingeniero, Desarrollador Web y Arquitecto de Soluciones IA. Transformo diseños en sitios web rápidos, fiables y escalables.
                </p>
                
                <!-- Metrics -->
                <div class="grid grid-cols-3 gap-2 sm:gap-4">
                    <div class="bg-gray-900 border border-gray-800 rounded-xl sm:rounded-2xl p-3 sm:p-6 text-center sm:text-left">
                        <div class="text-xl sm:text-3xl font-bold text-white mb-1">+8</div>
                        <div class="text-[10px] sm:text-sm text-gray-400 leading-tight">Años de exp.</div>
                    </div>
                    <div class="bg-gray-900 border border-gray-800 rounded-xl sm:rounded-2xl p-3 sm:p-6 text-center sm:text-left">
                        <div class="text-xl sm:text-3xl font-bold text-white mb-1">+100</div>
                        <div class="text-[10px] sm:text-sm text-gray-400 leading-tight">Proyectos</div>
                    </div>
                    <div class="bg-gray-900 border border-gray-800 rounded-xl sm:rounded-2xl p-3 sm:p-6 text-center sm:text-left">
                        <div class="text-xl sm:text-3xl font-bold text-white mb-1">5.0</div>
                        <div class="text-[10px] sm:text-sm text-gray-400 leading-tight">Calificación</div>
                    </div>
                </div>
            </div>
            
            <!-- Visual Content -->
            <div class="relative">
                <div class="aspect-square rounded-3xl bg-gradient-to-br from-brand-500/20 to-gray-900 border border-gray-800 flex items-center justify-center overflow-hidden relative group">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('large', ['class' => 'w-full h-full object-cover transition-transform duration-700 group-hover:scale-105']); ?>
                    <?php else : ?>
                        <!-- Placeholder para fotografía futura. -->
                        <div class="text-center">
                            <svg class="w-20 h-20 text-gray-800 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span class="text-sm text-gray-600">Imagen Destacada</span>
                        </div>
                    <?php endif; ?>
                </div>
                <!-- Elemento decorativo -->
                <div class="absolute -bottom-6 -left-6 w-48 h-48 bg-brand-500/20 rounded-full blur-3xl -z-10"></div>
            </div>
        </div>
    </section>

    <!-- Bio Section -->
    <section class="max-w-[1400px] mx-auto px-6 lg:px-8 mb-32 border-t border-gray-800/50 pt-24">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8">
            <div class="lg:col-span-5">
                <h2 class="text-3xl md:text-4xl font-bold text-white leading-tight lg:sticky lg:top-32">
                    De ingeniero electrónico a <span class="text-brand-400">Arquitecto IA</span>
                </h2>
            </div>
            <div class="lg:col-span-7">
                <div class="prose prose-lg prose-invert text-gray-300 leading-relaxed space-y-8">
                    <p class="text-xl text-white font-medium">
                        Soy ingeniero en electrónica de formación, originario de Venezuela. Hace más de 8 años descubrí mi verdadera pasión en el desarrollo web, y desde entonces no he dejado de construir. He trabajado en remoto para agencias de marketing digital y empresas en Latinoamérica y Europa, participando en proyectos de todo tipo: desde landing pages hasta plataformas e-learning con miles de usuarios.
                    </p>
                    <p>
                        En 2026, el desarrollo web cambió por completo. Hoy no escribo código línea por línea de forma manual: utilizo herramientas de inteligencia artificial de última generación para acelerar los procesos de desarrollo, garantizar la calidad del código y entregar resultados que antes habrían tomado semanas en cuestión de días. Esta evolución no reemplaza la experiencia técnica; la potencia. Mi conocimiento profundo de WordPress, PHP, JavaScript y arquitecturas web me permite dirigir estas herramientas con precisión quirúrgica.
                    </p>
                    <div class="pl-6 border-l-2 border-brand-500/50 py-2 my-8">
                        <p class="text-white italic m-0">
                            "Mi enfoque combina la resolución de problemas reales con un estándar de calidad implacable. No me limito a ejecutar tareas: entiendo el contexto del proyecto, propongo soluciones y me aseguro de que todo funcione correctamente antes de entregar."
                        </p>
                    </div>
                    <p>
                        Trabajo tanto solo como integrado en equipos de agencia, adaptándome a las herramientas y flujos de trabajo de cada cliente. Creo firmemente que el trabajo bien hecho es una forma de servicio. Cada proyecto es una oportunidad de crear algo útil, funcional y que genere resultados reales para mis clientes. Si buscas un desarrollador WordPress que combine experiencia sólida con las herramientas más avanzadas del mercado, estás en el lugar correcto.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stack Tecnológico -->
    <section class="max-w-[1400px] mx-auto px-6 lg:px-8 mb-32">
        <div class="bg-gray-900/50 border border-gray-800 rounded-3xl p-8 md:p-12">
            <h2 class="text-2xl font-bold text-white mb-8 text-center">Ecosistema & Stack Core</h2>
            <div class="flex flex-wrap gap-4 justify-center">
                <?php
                $tech_stack = function_exists('wp_ai_get_core_tech_stack') ? wp_ai_get_core_tech_stack() : [];
                
                foreach ($tech_stack as $tech) : ?>
                    <div class="bg-gray-950 border border-gray-800 rounded-full px-6 py-3 flex items-center gap-3 hover:border-brand-500/50 transition-colors">
                        <?php if ($tech['icon'] === 'learndash') : ?>
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 0 0-.491 6.347A48.627 48.627 0 0 1 12 20.904a48.627 48.627 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.57 50.57 0 0 0-2.658-.813A59.905 59.905 0 0 1 12 3.493a59.902 59.902 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                            </svg>
                        <?php elseif ($tech['icon'] === 'cloud') : ?>
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15a4.5 4.5 0 004.5 4.5H18a3.75 3.75 0 001.332-7.257 3 3 0 00-3.758-3.848 5.25 5.25 0 00-10.233 2.33A4.502 4.502 0 002.25 15z" />
                            </svg>
                        <?php elseif ($tech['icon'] === 'antigravity') : ?>
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 19V5m0 0L7 10m5-5l5 5" />
                                <ellipse cx="12" cy="15" rx="6" ry="2" stroke="currentColor" />
                            </svg>
                        <?php else : ?>
                            <img src="https://cdn.simpleicons.org/<?php echo $tech['icon']; ?>/ffffff" alt="<?php echo $tech['name']; ?>" class="h-6 w-auto object-contain max-w-[24px]" width="24" height="24" />
                        <?php endif; ?>
                        <span class="text-gray-300 text-sm font-medium"><?php echo $tech['name']; ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Experiencia Laboral -->
    <section class="max-w-4xl mx-auto px-6 lg:px-8 mb-24">
        <h2 class="text-3xl font-bold text-white text-center mb-16">Mi Trayectoria</h2>
        
        <div class="relative border-l-2 border-brand-500/30 ml-4 md:ml-0">
            <!-- Item 1 -->
            <div class="relative pl-8 pb-12">
                <div class="absolute left-[-9px] top-1 w-4 h-4 bg-brand-500 rounded-full border-4 border-gray-950"></div>
                <div class="text-brand-400 font-bold mb-2">2025 — Presente</div>
                <h3 class="text-2xl font-bold text-white mb-3">Arquitecto de Soluciones IA & WordPress</h3>
                <p class="text-gray-400 leading-relaxed">
                    Especialización en orquestación de LLMs, agentes autónomos y arquitectura web GEO para agencias y empresas. Desarrollo acelerado con IA, entregando en días lo que antes tomaba semanas sin comprometer la calidad.
                </p>
            </div>
            
            <!-- Item 2 -->
            <div class="relative pl-8 pb-12">
                <div class="absolute left-[-9px] top-1 w-4 h-4 bg-brand-500 rounded-full border-4 border-gray-950"></div>
                <div class="text-brand-400 font-bold mb-2">2021 — 2025</div>
                <h3 class="text-2xl font-bold text-white mb-3">Desarrollador WordPress Senior (Freelance)</h3>
                <p class="text-gray-400 leading-relaxed">
                    Descubrí lo que quería hacer en los próximos años y me enfoqué al 100% en aumentar mis conocimientos técnicos y mejorar mis habilidades para ser un excelente desarrollador web. Más de 100 proyectos entregados para agencias en España, Colombia, Argentina, México y otros países. Especialización en WooCommerce, LearnDash y constructores visuales, enfocándome en velocidad y fiabilidad.
                </p>
            </div>
            
            <!-- Item 3 -->
            <div class="relative pl-8">
                <div class="absolute left-[-9px] top-1 w-4 h-4 bg-brand-500 rounded-full border-4 border-gray-950"></div>
                <div class="text-brand-400 font-bold mb-2">2019 — 2021</div>
                <h3 class="text-2xl font-bold text-white mb-3">Inicios Digitales</h3>
                <p class="text-gray-400 leading-relaxed">
                    Incursioné en el trabajo desde casa, como community manager, copywriter y diseñador gráfico para diferentes corporaciones de negocio estadounidenses. Transición exitosa desde la ingeniería electrónica hacia el mundo digital.
                </p>
            </div>
        </div>
    </section>

    <!-- Valores Section -->
    <section class="max-w-[1400px] mx-auto px-6 lg:px-8 mb-24">
        <div class="flex flex-col md:flex-row gap-12 items-center bg-gray-900/30 border border-gray-800/50 rounded-3xl p-8 lg:p-12">
            <div class="max-w-2xl">
                <h2 class="text-3xl font-bold text-white mb-6">Mis Valores</h2>
                <div class="prose prose-invert text-gray-300">
                    <p>
                        Tengo valores cristianos desde mi niñez. Aquel que dijo ser el Camino, la Verdad y la Vida, mi Señor Jesucristo, es el pilar fundamental de mi vida. Todo lo que hago, procuro hacerlo con excelencia para Su gloria.
                    </p>
                    <p>
                        Como esposo, padre y profesional, prometo entregar mi máximo esfuerzo en cada proyecto. Mi compromiso es la calidad técnica y humana; no daré por terminado el trabajo hasta que el resultado funcione impecablemente para tu negocio.
                    </p>
                </div>
            </div>
            <div class="flex-1 flex justify-center">
                <div class="w-24 h-24 lg:w-32 lg:h-32 rounded-full bg-brand-500/10 flex items-center justify-center border border-brand-500/20">
                    <svg class="w-10 h-10 lg:w-12 lg:h-12 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="max-w-4xl mx-auto px-6 lg:px-8">
        <div class="bg-gray-900 border border-gray-800 rounded-3xl p-8 lg:p-12 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">¿Listo para trabajar juntos?</h2>
            <p class="text-gray-400 mb-8 max-w-2xl mx-auto">
                Cuéntame sobre tu proyecto y veamos cómo puedo ayudarte a alcanzar tus objetivos con tecnología de primer nivel.
            </p>
            <a href="/contacto" class="inline-block bg-brand-500 hover:bg-brand-400 text-white font-bold py-4 px-8 rounded-full transition-colors">
                ¿Hablamos?
            </a>
        </div>
    </section>
</main>

<?php get_footer(); ?>

<?php
/**
 * CTA — Premium Dark (Climax)
 *
 * @package suspended-starter
 *
 * Expected $data:
 *   headline     (string)
 *   subheadline  (string)
 *   button       (object) — label, url
 *   guarantee    (string)
 */

$headline    = $data['headline']    ?? '';
$subheadline = $data['subheadline'] ?? '';
$button      = $data['button']      ?? [];
$guarantee   = $data['guarantee']   ?? '';

$btn_label = $button['label'] ?? '';
$btn_url   = $button['url']   ?? '#';
?>

<section class="cta-section relative bg-gray-950 py-24 lg:py-32 font-['Inter',sans-serif] overflow-hidden border-t border-gray-900">

    <!-- Tech Grid Background (from Hero) -->
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: linear-gradient(rgba(0,216,255,1) 1px, transparent 1px), linear-gradient(90deg, rgba(0,216,255,1) 1px, transparent 1px); background-size: 80px 80px;"></div>
        <!-- Viñeta para bordes idéntica al Hero -->
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_transparent_50%,_rgba(3,7,18,0.8)_100%)] pointer-events-none"></div>
    </div>

    <!-- Floating Glows (Using standard tailwind blur classes) -->
    <div class="absolute top-0 left-1/4 w-[400px] h-[400px] bg-brand-500/10 rounded-full mix-blend-screen filter blur-3xl z-0 pointer-events-none"></div>
    <div class="absolute bottom-0 right-1/4 w-[500px] h-[500px] bg-brand-700/10 rounded-full mix-blend-screen filter blur-3xl z-0 pointer-events-none"></div>

    <!-- Content -->
    <div class="relative z-10 mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 text-center flex flex-col items-center">

        <!-- Glass Container -->
        <div id="cta-tilt-card" class="bg-gray-900/30 backdrop-blur-xl border border-gray-700/30 rounded-3xl md:rounded-[2.5rem] p-8 sm:p-10 md:p-16 lg:p-20 shadow-2xl relative w-full transition-transform duration-300 ease-out" style="transform-style: preserve-3d;">
            <!-- Inner subtle glow -->
            <div class="absolute inset-0 bg-gradient-to-b from-white/[0.02] to-transparent rounded-3xl md:rounded-[2.5rem] pointer-events-none" style="transform: translateZ(-10px);"></div>

            <div style="transform: translateZ(30px);">
                <?php if ( $headline ) : ?>
                    <h2 class="relative text-3xl md:text-5xl lg:text-6xl font-bold text-white tracking-tight leading-[1.15] mb-4 md:mb-6">
                        <?php echo wp_kses_post( $headline ); ?>
                    </h2>
                <?php endif; ?>

                <?php if ( $subheadline ) : ?>
                    <p class="relative text-base md:text-lg lg:text-xl text-gray-400 mb-10 md:mb-12 leading-normal md:leading-relaxed max-w-2xl mx-auto">
                        <?php echo wp_kses_post( $subheadline ); ?>
                    </p>
                <?php endif; ?>

                <?php if ( $btn_label ) : ?>
                    <div class="relative inline-block mt-2 group w-full sm:w-auto">
                        <!-- Outer glow behind button -->
                        <div class="absolute -inset-2 bg-gradient-to-r from-brand-300 to-brand-500 rounded-xl blur-lg opacity-30 group-hover:opacity-60 transition duration-500"></div>
                        <a href="<?php echo esc_url( $btn_url ); ?>"
                           class="relative flex sm:inline-flex items-center justify-center w-full sm:w-auto bg-brand-400 text-gray-950 font-bold px-8 md:px-10 py-4 md:py-5 text-lg md:text-xl rounded-xl transition-all duration-300 transform group-hover:-translate-y-1">
                            <?php echo esc_html( $btn_label ); ?>
                            <svg class="w-5 h-5 md:w-6 md:h-6 ml-2 md:ml-3 transition-transform duration-300 group-hover:translate-x-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                <?php endif; ?>

                <?php if ( $guarantee ) : ?>
                    <div class="relative mt-8 md:mt-12 flex flex-row items-center justify-center text-xs md:text-sm text-gray-500 font-medium">
                        <svg class="w-4 h-4 mr-2 text-green-500/70 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        <span class="text-left md:text-center"><?php echo esc_html( $guarantee ); ?></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</section>

<!-- CTA Tilt Script -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const card = document.getElementById('cta-tilt-card');
    // Asegurarnos de que GSAP esté disponible
    if (!card || typeof gsap === 'undefined') return;

    let mm = gsap.matchMedia();

    // Solo habilitar en pantallas grandes (desktop)
    mm.add("(min-width: 1024px)", () => {
        
        // Efecto Parallax con GSAP (Idéntico a la terminal del Hero)
        document.addEventListener('mousemove', (e) => {
            // Normalizar coordenadas del ratón de -1 a 1 basado en la ventana (viewport)
            const x = (e.clientX / window.innerWidth - 0.5) * 2;
            const y = (e.clientY / window.innerHeight - 0.5) * 2;

            // Animación suavizada con las matemáticas exactas de la terminal
            gsap.to(card, {
                x: x * 15,          // Movimiento lateral ligero
                y: y * 15,          // Movimiento vertical ligero
                rotationY: x * 6,   // Inclinación máxima de 6 grados
                rotationX: -y * 6,
                ease: "power2.out",
                duration: 0.8,
                transformPerspective: 1000
            });
        });
        
        // Reset cuando el ratón sale de la ventana
        document.addEventListener('mouseleave', () => {
            gsap.to(card, {
                x: 0,
                y: 0,
                rotationX: 0, 
                rotationY: 0,
                ease: "power3.out",
                duration: 1
            });
        });
    });
});
</script>

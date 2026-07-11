<?php
/**
 * Component: Metrics
 * Variant: premium-dark
 * 
 * Barra horizontal sutil debajo del hero con métricas.
 * 
 * Expected $data matches metrics.yml (metrics: value, label)
 */

$metrics = $data['metrics'] ?? [];
?>

<?php if (!empty($metrics)): ?>
<!-- 
  El padding vertical de la sección se maneja de forma responsiva:
  - En móvil (py-2): Cada métrica ya tiene "py-8" para separarse de los divisores (divide-y), por lo que la sección solo necesita 8px extra.
  - En tablet (md:py-10): Como las métricas pieriden su padding vertical al alinearse en horizontal (md:py-0), la sección asume el padding de 40px.
  - En escritorio (lg:py-14): Se da un respiro mayor (56px) para pantallas amplias.
-->
<section class="bg-[#0a0a0f] border-y border-gray-800/60 py-2 md:py-10 lg:py-14 relative overflow-hidden" id="metrics-section">
    <!-- Glows sutiles -->
    <div class="absolute top-0 left-1/4 w-1/2 h-px bg-gradient-to-r from-transparent via-brand-500/30 to-transparent"></div>
    <div class="absolute bottom-0 left-1/3 w-1/3 h-px bg-gradient-to-r from-transparent via-brand-400/20 to-transparent"></div>

    <div class="w-full max-w-[1400px] mx-auto px-6 lg:px-8 max-w-7xl">
        <div class="grid grid-cols-1 md:grid-cols-3 divide-y md:divide-y-0 md:divide-x divide-gray-800/50">
            <?php foreach($metrics as $index => $metric): ?>
            <div class="flex items-center justify-center py-8 md:py-0">
                <div class="grid grid-cols-[130px_1fr] md:flex md:items-center justify-start gap-6 md:gap-5 w-[320px] md:w-auto">
                    <!-- Valor de la métrica (Número a la izquierda) -->
                    <div class="metric-value-container relative shrink-0 text-center md:text-left">
                        <span class="text-5xl lg:text-7xl font-black text-white tracking-tighter" data-metric-value="<?php echo esc_attr($metric['value']); ?>">
                            <?php echo esc_html($metric['value']); ?>
                        </span>
                        <div class="absolute -inset-4 bg-brand-400/20 blur-xl rounded-full opacity-0 metric-glow transition-opacity duration-300"></div>
                    </div>
                    
                    <!-- Etiqueta (Texto a la derecha) -->
                    <div class="flex flex-col text-left">
                        <?php 
                            $words = explode(' ', $metric['label']);
                            if (count($words) >= 2) {
                                $half = ceil(count($words) / 2);
                                $line1 = implode(' ', array_slice($words, 0, $half));
                                $line2 = implode(' ', array_slice($words, $half));
                                echo '<span class="text-gray-400 font-medium text-sm md:text-base leading-snug uppercase tracking-wide">' . esc_html($line1) . '<br><span class="text-brand-300">' . esc_html($line2) . '</span></span>';
                            } else {
                                echo '<span class="text-gray-400 font-medium text-sm md:text-base leading-snug uppercase tracking-wide">' . esc_html($metric['label']) . '</span>';
                            }
                        ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Script de Animación Impactante -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const section = document.getElementById('metrics-section');
    const metricElements = section.querySelectorAll('[data-metric-value]');
    if (!metricElements.length) return;

    function animateImpactfulCounter(el) {
        const raw = el.getAttribute('data-metric-value');
        const prefix = raw.match(/^[^\d]*/)[0];
        const number = parseFloat(raw.replace(/[^\d.]/g, ''));
        const suffix = raw.match(/[^\d]*$/)[0];
        if (isNaN(number)) return;

        const isFloat = raw.includes('.');
        const duration = 2500; // 2.5 segundos
        const start = performance.now();
        const glow = el.nextElementSibling;

        // Efecto inicial
        el.style.transform = 'scale(0.8) translateY(20px)';
        el.style.opacity = '0';
        el.style.transition = 'transform 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275), opacity 0.5s ease-out';
        
        // Empezar cuenta
        setTimeout(() => {
            el.style.transform = 'scale(1.1) translateY(0)';
            el.style.opacity = '1';
            el.style.color = '#00D8FF'; // brand-300
            if (glow) glow.style.opacity = '1';
            
            function tick(now) {
                const elapsed = now - start - 500; // offset por el timeout
                if (elapsed < 0) {
                    requestAnimationFrame(tick);
                    return;
                }
                
                const progress = Math.min(elapsed / duration, 1);
                // Easing elástico/exponencial
                const eased = 1 - Math.pow(1 - progress, 4);
                
                let current = number * eased;
                if (!isFloat) current = Math.round(current);
                else current = current.toFixed(1);

                el.textContent = prefix + current + suffix;

                if (progress < 1) {
                    requestAnimationFrame(tick);
                } else {
                    // Estado final
                    el.textContent = prefix + number + (isFloat ? '.0' : '') + suffix;
                    el.style.transform = 'scale(1)';
                    el.style.color = '#ffffff';
                    if (glow) glow.style.opacity = '0';
                }
            }
            requestAnimationFrame(tick);
        }, 300);
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Pequeño delay escalonado para cada métrica
                metricElements.forEach((el, index) => {
                    setTimeout(() => {
                        animateCounter(el);
                    }, index * 200);
                });
                observer.disconnect();
            }
        });
    }, { threshold: 0.5 });

    // Helper to call our impact animation
    function animateCounter(el) {
        animateImpactfulCounter(el);
    }

    observer.observe(section);
});
</script>
<?php endif; ?>

/**
 * WP-AI Framework - Premium Cursor Aura (Spotlight)
 * Mantiene el cursor nativo pero añade un brillo interactivo de fondo.
 */

document.addEventListener('DOMContentLoaded', () => {
    // Solo aplicar en dispositivos con puntero fino (mouse)
    if (!window.matchMedia("(pointer: fine)").matches) return;

    const aura = document.createElement('div');
    aura.className = 'cursor-aura';
    
    // Posición inicial fuera de pantalla y centrado del elemento (-50%)
    gsap.set(aura, { xPercent: -50, yPercent: -50, x: -1000, y: -1000 });
    document.body.appendChild(aura);

    // Usamos quickTo para máximo rendimiento, con una duración mínima (0.1s) 
    // para que el aura siga al mouse instantáneamente pero sin verse entrecortada
    const xTo = gsap.quickTo(aura, "x", {duration: 0.1, ease: "power2.out"});
    const yTo = gsap.quickTo(aura, "y", {duration: 0.1, ease: "power2.out"});

    window.addEventListener("mousemove", e => {
        xTo(e.clientX);
        yTo(e.clientY);
    });

    // Interactividad: El aura reacciona sutilmente a los enlaces y botones
    const interactables = document.querySelectorAll('a, button, [role="button"], input, textarea, select');
    interactables.forEach(el => {
        el.addEventListener('mouseenter', () => {
            gsap.to(aura, { 
                scale: 0.6, // Concentra la luz para acentuar el elemento
                opacity: 1, // Mantiene el brillo completo
                duration: 0.3, 
                ease: "power2.out"
            });
        });
        
        el.addEventListener('mouseleave', () => {
            gsap.to(aura, { 
                scale: 1,
                opacity: 1,
                duration: 0.6, 
                ease: "power2.out"
            });
        });
    });
});

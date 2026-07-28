document.addEventListener("DOMContentLoaded", () => {
    // 1. Registro de plugins
    if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
        gsap.registerPlugin(ScrollTrigger);
    } else {
        return; // Fallback
    }

    // 2. Selección de elementos
    const heroContainer = document.querySelector('[data-hero-container]');
    const kicker = document.querySelector('[data-hero-kicker]');
    const headline = document.querySelector('[data-hero-headline]');
    const headlineSpan = headline ? headline.querySelector('span') : null;
    const subheadline = document.querySelector('[data-hero-subheadline]');
    const ctas = document.querySelector('[data-hero-ctas]');
    const terminalContainer = document.querySelector('[data-hero-terminal-container]');
    const terminal = document.querySelector('[data-hero-terminal]');

    if (!heroContainer) return;

    let mm = gsap.matchMedia();

    // Todo ocurre SOLO EN DESKTOP (min-width: 1024px)
    mm.add("(min-width: 1024px)", () => {
        
        // (Animaciones de entrada removidas para evitar problemas con capturas de bots y PageSpeed)
        // Sólo conservamos el efecto parallax con el movimiento del mouse.

        // 5. MatchMedia (Mouse Parallax)
        if (terminal && terminalContainer) {
            document.addEventListener("mousemove", (e) => {
                const x = (e.clientX / window.innerWidth - 0.5) * 2;
                const y = (e.clientY / window.innerHeight - 0.5) * 2;

                gsap.to(terminal, {
                    x: x * 30,
                    y: y * 30,
                    rotationY: x * 12,
                    rotationX: -y * 12,
                    ease: "power2.out",
                    duration: 0.8
                });
            });
        }
        
        // Opcional: Función de limpieza si se desmonta el matchMedia (poco común en tema clásico, pero buena práctica)
        return () => {
            document.removeEventListener("mousemove", null); // GSAP limpiará los tweens automáticamente
        };
    });
});

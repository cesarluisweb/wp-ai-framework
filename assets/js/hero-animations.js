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
        
        // 3. Preparación para animaciones (Estados Iniciales)
        // NOTA: Para evitar FOUC, en el HTML (premium-dark.php) usamos la clase lg:opacity-0
        // autoAlpha: 1 de GSAP se encargará de hacerlos visibles anulando esa clase.
        
        gsap.set(headline, { filter: "blur(10px)" }); // La opacidad ya está en 0 por CSS (lg:opacity-0)
        gsap.set(kicker, { scaleX: 0, transformOrigin: "0% 50%" }); 
        gsap.set(subheadline, { rotationX: -90, transformPerspective: 800, transformOrigin: "50% 0%" }); 
        gsap.set(ctas, { scale: 0, rotation: 10 }); 
        gsap.set(terminalContainer, { z: -500, rotationY: 45, rotationX: 10, scale: 0.6, transformPerspective: 1200 });

        // 4. Secuencia de entrada Cinematográfica
        const entryTl = gsap.timeline({ delay: 0.1 });
        
        entryTl
            // 4.1 Título PRIMERITO (Fade in desde blur, rápido)
            .to(headline, { 
                autoAlpha: 1, 
                filter: "blur(0px)",
                duration: 0.5, 
                ease: "power2.out" 
            })
            
            // 4.2 Kicker (Se despliega hacia la derecha) - Retraso sutil
            .to(kicker, { 
                autoAlpha: 1, 
                scaleX: 1, 
                duration: 0.5, 
                ease: "power4.out" 
            }, "-=0.2") 
            
            // 4.3 Subtítulo (Cae en 3D como bisagra)
            .to(subheadline, { 
                autoAlpha: 1, 
                rotationX: 0, 
                duration: 0.8, 
                ease: "elastic.out(1, 0.5)" 
            }, "-=0.3")
            
            // 4.4 CTAs (Saltan a la vista elásticamente)
            .to(ctas, { 
                autoAlpha: 1, 
                scale: 1, 
                rotation: 0, 
                duration: 0.8, 
                ease: "elastic.out(1, 0.4)" 
            }, "-=0.6")
            
            // 4.5 Terminal (Aterriza 3D con fuerza desde atrás)
            .to(terminalContainer, { 
                autoAlpha: 1, 
                z: 0, 
                rotationY: 0,
                rotationX: 0,
                scale: 1, 
                duration: 0.7, 
                ease: "power3.out" 
            }, "-=0.9"); 

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

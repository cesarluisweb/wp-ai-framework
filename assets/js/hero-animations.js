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

    // 3. Preparación para animaciones (Estados Iniciales Espectaculares)
    
    // Título con fade in y blur (desenfoque a enfoque)
    gsap.set(headline, { autoAlpha: 0, filter: "blur(10px)" });
    
    // Kicker: Unfold como cinta
    gsap.set(kicker, { autoAlpha: 0, scaleX: 0, transformOrigin: "0% 50%" }); 
    
    // Subtítulo: Swing 3D (Cae rotando desde arriba)
    gsap.set(subheadline, { autoAlpha: 0, rotationX: -90, transformPerspective: 800, transformOrigin: "50% 0%" }); 
    
    // CTAs: Pop elástico rotado
    gsap.set(ctas, { autoAlpha: 0, scale: 0, rotation: 10 }); 
    
    // Terminal: Slam 3D desde el fondo del espacio Z
    gsap.set(terminalContainer, { autoAlpha: 0, z: -500, rotationY: 45, rotationX: 10, scale: 0.6, transformPerspective: 1200 });

    // 4. Secuencia de entrada Cinematográfica
    // Arrancamos muy rápido para que no se sienta que la página está "cargando"
    const entryTl = gsap.timeline({ delay: 0.1 });
    
    entryTl
        // 4.1 Título PRIMERITO (Fade in desde blur, rápido)
        .to(headline, { 
            autoAlpha: 1, 
            filter: "blur(0px)",
            duration: 0.8, 
            ease: "power2.out" 
        })
        
        // 4.2 Kicker (Se despliega hacia la derecha) - Retraso sutil
        .to(kicker, { 
            autoAlpha: 1, 
            scaleX: 1, 
            duration: 0.8, 
            ease: "power4.out" 
        }, "-=0.1") // Empieza un instante antes de que el título termine de aparecer
        
        // 4.3 Subtítulo (Cae en 3D como bisagra)
        .to(subheadline, { 
            autoAlpha: 1, 
            rotationX: 0, 
            duration: 1.2, 
            ease: "elastic.out(1, 0.5)" 
        }, "-=0.4")
        
        // 4.4 CTAs (Saltan a la vista elásticamente)
        .to(ctas, { 
            autoAlpha: 1, 
            scale: 1, 
            rotation: 0, 
            duration: 1.2, 
            ease: "elastic.out(1, 0.4)" 
        }, "-=0.9")
        
        // 4.5 Terminal (Aterriza 3D con fuerza desde atrás)
        .to(terminalContainer, { 
            autoAlpha: 1, 
            z: 0, 
            rotationY: 0,
            rotationX: 0,
            scale: 1, 
            duration: 1.4, 
            ease: "power3.out" 
        }, "-=1.1"); // Empieza un poquito después que los botones



    // 6. MatchMedia (Mouse Parallax) - SOLO DESKTOP
    mm.add("(min-width: 1024px)", () => {
        // El parallax de la terminal ahora responde a TODO EL DOCUMENTO
        if (terminal && terminalContainer) {
            document.addEventListener("mousemove", (e) => {
                // Normalizamos las coordenadas relativas al tamaño total de la pantalla (-1 a 1)
                const x = (e.clientX / window.innerWidth - 0.5) * 2;
                const y = (e.clientY / window.innerHeight - 0.5) * 2;

                // Movemos y rotamos la terminal basándonos en la posición del cursor en pantalla
                gsap.to(terminal, {
                    x: x * 30, // Movimiento ampliado
                    y: y * 30,
                    rotationY: x * 12,
                    rotationX: -y * 12,
                    ease: "power2.out",
                    duration: 0.8
                });
            });
        }
    });
});

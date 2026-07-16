<?php
/**
 * Plantilla 404 (Premium Dark B2B)
 */
get_header();
?>

<main class="bg-gray-950 min-h-[80vh] flex items-center justify-center relative overflow-hidden selection:bg-brand-500 selection:text-white pt-32 pb-20">
    
    <!-- Efecto de fondo (Glow) -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-brand-500/10 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="container mx-auto px-6 relative z-10 text-center">
        
        <div class="inline-flex items-center justify-center mb-6">
            <div class="bg-gray-900 border border-gray-800 p-4 rounded-2xl shadow-[0_0_30px_rgba(59,130,246,0.1)]">
                <svg class="w-12 h-12 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
        </div>

        <h1 class="text-8xl md:text-9xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-brand-300 to-brand-600 tracking-tighter mb-4">
            404
        </h1>
        
        <h2 class="text-2xl md:text-3xl font-bold text-white mb-6">
            Endpoint no encontrado
        </h2>
        
        <p class="text-lg text-gray-400 max-w-lg mx-auto mb-10 leading-relaxed">
            Parece que la URL solicitada no existe en el servidor. Puede que haya sido movida, eliminada, o que la ruta sea incorrecta.
        </p>

        <a href="<?php echo esc_url(home_url('/')); ?>" class="inline-flex items-center gap-2 bg-brand-500 hover:bg-brand-400 text-white font-bold py-4 px-8 rounded-xl transition-colors shadow-lg shadow-brand-500/20">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Volver a la Home
        </a>
        
    </div>
</main>

<?php get_footer(); ?>

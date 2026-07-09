<?php
/**
 * About Section — Premium Dark
 *
 * @param array $data {
 *     @type string   $headline        Main section headline.
 *     @type array    $bio_paragraphs  Array of paragraph strings.
 * }
 */

$headline       = $data['headline']       ?? '';
$bio_paragraphs = $data['bio_paragraphs'] ?? [];
?>

<section id="about" class="relative py-24 lg:py-32 bg-gray-950 overflow-hidden border-b border-gray-900">
    <!-- Subtle ambient glow -->
    <div class="absolute top-1/2 left-1/4 -translate-y-1/2 w-[500px] h-[500px] bg-brand-500/5 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="w-full max-w-[1400px] mx-auto px-6 lg:px-8">
        <!-- Two-column grid -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-10 md:gap-12 lg:gap-16 items-start lg:items-center">

            <!-- LEFT — Dashboard Mockup Image -->
            <div class="md:col-span-4 lg:col-span-5 flex justify-center lg:justify-start">
                <div class="relative w-full max-w-[220px] sm:max-w-[260px] md:max-w-[240px] lg:max-w-none aspect-square md:aspect-[4/5] rounded-3xl overflow-hidden shadow-2xl mx-auto md:mx-0">
                    <!-- Glow behind image -->
                    <div class="absolute inset-0 bg-brand-400/20 blur-2xl rounded-full pointer-events-none"></div>
                    
                    <div class="relative z-10 w-full h-full rounded-2xl overflow-hidden border border-gray-800/80 bg-gray-900">
                        <!-- We use an absolute path for the scaffold router -->
                        <img 
                            src="/assets/img/mockup.jpg" 
                            alt="César Luis Dashboard Mockup"
                            class="w-full h-full object-cover opacity-90 hover:opacity-100 transition-opacity duration-500"
                            loading="lazy"
                        />
                        <!-- Subtle overlay for integration -->
                        <div class="absolute inset-0 bg-gradient-to-tr from-brand-950/40 via-transparent to-brand-500/10 mix-blend-overlay pointer-events-none"></div>
                    </div>
                </div>
            </div>

            <!-- RIGHT — Content -->
            <div class="md:col-span-8 lg:col-span-7 flex flex-col justify-center text-left mt-6 md:mt-0">

                <span class="inline-block uppercase tracking-[0.2em] text-brand-300 text-sm font-semibold mb-4">Sobre mí</span>
                <?php if ( ! empty( $headline ) ) : ?>
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white leading-tight mb-8">
                        <?php echo esc_html( $headline ); ?>
                    </h2>
                <?php endif; ?>

                <?php if ( ! empty( $bio_paragraphs ) ) : ?>
                    <div class="space-y-6">
                        <?php foreach ( $bio_paragraphs as $paragraph ) : ?>
                            <p class="text-gray-400 text-lg md:text-xl leading-relaxed">
                                <?php echo esc_html( $paragraph ); ?>
                            </p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</section>

<?php
/**
 * FAQ Section — Premium Dark
 * Variant: Interactive Accordion with SEO Schema JSON-LD support
 */

$section_kicker      = $data['section_kicker']      ?? '';
$section_title       = $data['section_title']       ?? '';
$section_description = $data['section_description'] ?? '';
$questions           = $data['questions']           ?? [];

// GEO/SEO: FAQPage Schema JSON-LD Generator
if ( ! empty( $questions ) ) :
    $faq_schema = [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => []
    ];
    foreach ( $questions as $item ) {
        $faq_schema['mainEntity'][] = [
            '@type' => 'Question',
            'name' => strip_tags( $item['question'] ),
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => strip_tags( $item['answer'] )
            ]
        ];
    }
    ?>
    <script type="application/ld+json">
    <?php echo json_encode( $faq_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ); ?>
    </script>
<?php endif; ?>

<section id="faq" class="py-24 lg:py-32 bg-gray-950 relative border-t border-gray-900">
    <!-- Fondo decorativo sutil -->
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_bottom,_rgba(0,169,204,0.03)_0%,_transparent_70%)] pointer-events-none"></div>

    <div class="w-full max-w-[1200px] mx-auto px-6 lg:px-8 relative z-10">
        
        <!-- Encabezado -->
        <div class="max-w-3xl mb-16 lg:mb-20 text-center mx-auto">
            <?php if ( ! empty( $section_kicker ) ) : ?>
                <span class="inline-block uppercase tracking-[0.2em] text-brand-300 text-sm font-semibold mb-4">
                    <?php echo esc_html( $section_kicker ); ?>
                </span>
            <?php endif; ?>
            
            <?php if ( ! empty( $section_title ) ) : ?>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white leading-tight mb-6">
                    <?php echo esc_html( $section_title ); ?>
                </h2>
            <?php endif; ?>
            
            <?php if ( ! empty( $section_description ) ) : ?>
                <p class="mt-5 text-lg text-gray-400 leading-relaxed max-w-2xl mx-auto">
                    <?php echo esc_html( $section_description ); ?>
                </p>
            <?php endif; ?>
        </div>

        <!-- Accordion UI -->
        <?php if ( ! empty( $questions ) ) : ?>
            <div class="max-w-4xl mx-auto space-y-4">
                <?php foreach ( $questions as $index => $item ) : ?>
                    <details class="group bg-gray-900/30 border border-gray-800/80 rounded-3xl p-6 transition-all duration-300 [&_summary::-webkit-details-marker]:hidden open:bg-gray-900/80 open:border-brand-500/30">
                        <summary class="flex justify-between items-center font-bold text-white text-lg md:text-xl cursor-pointer select-none">
                            <span><?php echo esc_html( $item['question'] ); ?></span>
                            <span class="ml-4 transition-transform duration-300 group-open:-rotate-180 shrink-0">
                                <svg class="w-6 h-6 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </span>
                        </summary>
                        <div class="mt-4 text-gray-400 leading-relaxed text-base md:text-lg border-t border-gray-800/60 pt-4 [&>p]:mb-4 [&>p:last-child]:mb-0">
                            <?php echo wp_kses_post( $item['answer'] ); ?>
                        </div>
                    </details>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
    </div>
</section>

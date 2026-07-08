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

<section class="cta-section bg-gradient-to-br from-brand-900 via-brand-700 to-gray-950 py-24 lg:py-32 font-['Inter',sans-serif]">

    <!-- Dot pattern background -->
    <div class="cta-dots" aria-hidden="true"></div>

    <!-- Content -->
    <div class="relative z-10 mx-auto max-w-3xl px-6 lg:px-8 text-center">

        <!-- Decorative glow ring behind content -->
        <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] rounded-full bg-brand-400/5 blur-3xl cta-pulse-ring pointer-events-none" aria-hidden="true"></div>

        <?php if ( $headline ) : ?>
            <h2 class="relative text-3xl md:text-4xl lg:text-5xl font-bold text-white leading-tight">
                <?php echo esc_html( $headline ); ?>
            </h2>
        <?php endif; ?>

        <?php if ( $subheadline ) : ?>
            <p class="relative text-xl text-gray-300 mt-6 mb-10 leading-relaxed max-w-2xl mx-auto">
                <?php echo esc_html( $subheadline ); ?>
            </p>
        <?php endif; ?>

        <?php if ( $btn_label ) : ?>
            <div class="relative">
                <a href="<?php echo esc_url( $btn_url ); ?>"
                   class="cta-btn inline-block bg-brand-300 text-gray-950 font-bold px-10 py-5 text-xl rounded-xl">
                    <?php echo esc_html( $btn_label ); ?>
                </a>
            </div>
        <?php endif; ?>

        <?php if ( $guarantee ) : ?>
            <p class="relative text-sm text-gray-400 mt-4">
                <?php echo esc_html( $guarantee ); ?>
            </p>
        <?php endif; ?>

    </div>
</section>

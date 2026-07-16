<?php
/**
 * Blog Grid — Premium Dark
 *
 * @package suspended-starter
 *
 * Expected $data:
 *   section_kicker  (string)
 *   section_title   (string)
 *   posts           (array)  — title, excerpt, date, category, read_time, url, gradient
 */

$section_kicker = $data['section_kicker'] ?? '';
$section_title  = $data['section_title']  ?? '';
$posts          = $data['posts']          ?? [];
?>

<section class="bg-gray-950 py-24 lg:py-32 font-['Inter',sans-serif]">
    <div class="w-full max-w-[1400px] mx-auto px-6 lg:px-8">

        <!-- ── Section header ── -->
        <?php if ( $section_kicker || $section_title ) : ?>
            <div class="mb-14">
                <?php if ( $section_kicker ) : ?>
                    <span class="inline-block text-brand-300 text-sm font-semibold tracking-widest uppercase mb-3">
                        <?php echo esc_html( $section_kicker ); ?>
                    </span>
                <?php endif; ?>
                <?php if ( $section_title ) : ?>
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white leading-tight">
                        <?php echo esc_html( $section_title ); ?>
                    </h2>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <!-- ── Post grid ── -->
        <?php if ( ! empty( $posts ) ) : ?>
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <?php foreach ( $posts as $post ) :
                    $title     = $post['title']     ?? '';
                    $excerpt   = $post['excerpt']   ?? '';
                    $date      = $post['date']      ?? '';
                    $category  = $post['category']  ?? '';
                    $read_time = $post['read_time'] ?? '';
                    $url       = $post['url']       ?? '#';
                    $gradient  = $post['gradient']  ?? 'linear-gradient(135deg, #287799, #144257)';
                    $is_fourth = $post['is_fourth'] ?? false;
                    $visibility = $is_fourth ? 'hidden md:block lg:hidden' : 'block';
                ?>
                    <a href="<?php echo esc_url( $url ); ?>"
                       class="blog-card group <?php echo $visibility; ?> rounded-xl overflow-hidden border border-gray-800/50 bg-white/[0.03] backdrop-blur-md">

                        <!-- Gradient header / image placeholder -->
                        <div class="relative h-48 rounded-t-xl overflow-hidden">
                            <div class="absolute inset-0" style="background: <?php echo esc_attr( $gradient ); ?>;"></div>

                            <!-- Category badge -->
                            <?php if ( $category ) : ?>
                                <span class="absolute bottom-4 left-4 bg-brand-400 text-gray-950 text-xs font-bold px-3 py-1 rounded-full z-10">
                                    <?php echo esc_html( $category ); ?>
                                </span>
                            <?php endif; ?>
                        </div>

                        <!-- Card body -->
                        <div class="p-6">
                            <?php if ( $title ) : ?>
                                <h3 class="text-lg font-bold text-white leading-snug transition-colors duration-200 group-hover:text-brand-300">
                                    <?php echo esc_html( $title ); ?>
                                </h3>
                            <?php endif; ?>

                            <?php if ( $excerpt ) : ?>
                                <p class="text-gray-400 text-sm mt-2 line-clamp-2 leading-relaxed">
                                    <?php echo esc_html( $excerpt ); ?>
                                </p>
                            <?php endif; ?>

                            <!-- Footer meta -->
                            <div class="flex items-center justify-between mt-5 pt-4 border-t border-gray-800/50">
                                <?php if ( $date ) : ?>
                                    <span class="text-gray-400 text-sm">
                                        <?php echo esc_html( $date ); ?>
                                    </span>
                                <?php endif; ?>
                                <?php if ( $read_time ) : ?>
                                    <span class="text-gray-400 text-sm">
                                        <?php echo esc_html( $read_time ); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>

            <!-- View all link -->
            <div class="mt-14 text-center">
                <a href="<?php echo esc_url(site_url('/blog')); ?>" class="inline-flex items-center justify-center px-8 py-4 text-base font-bold text-white bg-gray-900 border border-gray-800 hover:border-brand-500/50 hover:bg-gray-800 rounded-xl transition-all duration-300 transform hover:-translate-y-0.5 shadow-lg group">
                    Ver todos los artículos
                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>
        <?php endif; ?>

    </div>
</section>

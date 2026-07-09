<?php
/**
 * Portfolio – Premium Dark Component (Sticky Stack)
 *
 * Expected $data:
 *   section_kicker  (string)
 *   section_title   (string)
 *   section_description (string)
 *   projects        (array) — each: title, description, category, tech_stack[], url, image_gradient
 *
 * @package suspended-starter
 */

if ( empty( $data ) || ! is_array( $data ) ) {
    return;
}

$kicker     = $data['section_kicker']     ?? '';
$title      = $data['section_title']      ?? '';
$description = $data['section_description'] ?? '';
$projects   = $data['projects']           ?? [];
?>

<section id="portfolio" class="bg-gray-950 py-24 lg:py-32 font-['Inter',sans-serif] relative">
  <div class="w-full max-w-[1400px] mx-auto px-6 lg:px-8">

    <!-- Section Header -->
    <div class="mx-auto max-w-2xl text-center mb-8 lg:mb-24">
      <?php if ( $kicker ) : ?>
        <span class="inline-block uppercase tracking-[0.2em] text-brand-300 text-sm font-semibold mb-4">
          <?php echo esc_html( $kicker ); ?>
        </span>
      <?php endif; ?>

      <?php if ( $title ) : ?>
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white leading-tight">
          <?php echo esc_html( $title ); ?>
        </h2>
      <?php endif; ?>

      <?php if ( $description ) : ?>
        <p class="mt-5 text-lg text-gray-400 leading-relaxed">
          <?php echo esc_html( $description ); ?>
        </p>
      <?php endif; ?>
    </div>

    <!-- Sticky Projects Stack -->
    <?php if ( ! empty( $projects ) ) : ?>
      <div class="flex flex-col gap-8 relative">
        <?php foreach ( $projects as $index => $project ) :
          $p_title      = $project['title']          ?? '';
          $p_desc       = $project['description']    ?? '';
          $p_category   = $project['category']       ?? '';
          $p_tech       = $project['tech_stack']      ?? [];
          $p_url        = $project['url']            ?? '#';
          $p_image      = $project['image_url']      ?? '';
          $p_gradient   = $project['image_gradient'] ?? 'linear-gradient(135deg, #287799, #00D8FF)';
          
          // Calcula el offset superior para el efecto de apilamiento (sticky top)
          $top_offset = 6 + ($index * 2); // rem units
        ?>
          <div class="relative md:sticky flex w-full md:[top:var(--sticky-top)]"
               style="--sticky-top: <?php echo esc_attr( $top_offset ); ?>rem; z-index: <?php echo esc_attr( 10 + $index ); ?>;">
            
            <a href="<?php echo esc_url( $p_url ); ?>"
               class="group flex flex-col md:flex-row w-full md:h-[650px] bg-gray-900 border border-gray-800 rounded-3xl overflow-hidden shadow-2xl transition-all duration-300 hover:border-brand-500/50">

              <!-- Left Side: Content -->
              <div class="w-full md:w-5/12 p-8 md:p-10 lg:p-12 flex flex-col border-t md:border-t-0 md:border-r border-gray-800 relative overflow-hidden order-2 md:order-1">
                <!-- Subtle glow on hover -->
                <div class="absolute inset-0 bg-gradient-to-br from-brand-500/0 to-brand-500/0 group-hover:from-brand-500/5 transition-all duration-500 pointer-events-none"></div>

                <?php if ( $p_category ) : ?>
                  <span class="inline-block text-brand-300 text-sm font-bold uppercase tracking-widest mb-4">
                    <?php echo esc_html( $p_category ); ?>
                  </span>
                <?php endif; ?>

                <?php if ( $p_title ) : ?>
                  <h3 class="text-2xl md:text-3xl lg:text-4xl font-bold text-white mb-6 leading-tight group-hover:text-brand-300 transition-colors duration-300">
                    <?php echo esc_html( $p_title ); ?>
                  </h3>
                <?php endif; ?>

                <!-- Checkmarks from screenshot -->
                <div class="mb-8 flex-grow overflow-hidden">
                  <?php if ( $p_desc ) : 
                    // Eliminar corchetes de excerpt
                    $clean_desc = str_replace( ['[&hellip;]', '[...]', '&hellip;'], '', $p_desc );
                    
                    // Auto-formateo inteligente: Convertir frases clave en viñetas (bullets)
                    $clean_desc = str_replace('Contexto del Proyecto', '<ul class="mt-4 space-y-3"><li class="relative pl-5"><span class="absolute left-0 text-brand-300 font-bold text-xl leading-none top-1">•</span><strong class="text-white font-semibold">Contexto:</strong>', $clean_desc);
                    $clean_desc = str_replace('El Problema a Resolver', '</li><li class="relative pl-5"><span class="absolute left-0 text-brand-300 font-bold text-xl leading-none top-1">•</span><strong class="text-white font-semibold">Problema:</strong>', $clean_desc);
                    $clean_desc = str_replace('La Solución Implementada', '</li><li class="relative pl-5"><span class="absolute left-0 text-brand-300 font-bold text-xl leading-none top-1">•</span><strong class="text-white font-semibold">Solución:</strong>', $clean_desc);
                    
                    // Cerrar la lista si se abrió
                    if (strpos($clean_desc, '<ul') !== false) {
                        $clean_desc .= '</li></ul>';
                    }
                  ?>
                    <div class="text-gray-400 text-lg leading-relaxed [&>strong]:text-gray-200 [&>strong]:font-semibold [&>p]:mb-3 [&>p:last-child]:mb-0 line-clamp-5 xl:line-clamp-6">
                      <?php echo wp_kses_post( trim($clean_desc) ); ?>
                    </div>
                  <?php endif; ?>
                </div>

                <!-- Footer of Card (Tech + Link) -->
                <div class="mt-auto pt-8 border-t border-gray-800 shrink-0 flex flex-col">
                  <?php if ( ! empty( $p_tech ) ) : ?>
                    <div class="flex flex-wrap gap-2 mb-6">
                      <?php foreach ( $p_tech as $tech ) : ?>
                        <span class="inline-block bg-gray-950 border border-gray-700/60 rounded-full px-4 py-1.5 text-xs text-gray-400 font-medium">
                          <?php echo esc_html( $tech ); ?>
                        </span>
                      <?php endforeach; ?>
                    </div>
                  <?php endif; ?>
                  
                  <div class="flex items-center text-brand-300 font-semibold group-hover:translate-x-2 transition-transform duration-300">
                    Ver detalles del proyecto 
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                  </div>
                </div>
              </div>

              <!-- Right Side: Visual -->
              <div class="w-full md:w-7/12 relative min-h-[300px] md:min-h-full flex flex-col p-8 lg:p-16 items-center justify-center overflow-hidden order-1 md:order-2" style="background: <?php echo esc_attr( $p_gradient ); ?>;">
                
                <!-- Client Pill (Top Right) -->
                <?php 
                $client_name = '';
                if ( $p_url ) {
                    $post_id = url_to_postid( $p_url );
                    if ( $post_id ) {
                        $client_name = get_post_meta( $post_id, 'client_name', true );
                    }
                }
                
                if ( $client_name ) : ?>
                    <div class="absolute top-6 right-6 md:top-8 md:right-8 bg-gray-950/80 backdrop-blur-md border border-gray-700/50 rounded-full px-4 py-2 z-10 shadow-lg flex items-center justify-center">
                        <span class="text-xs font-bold text-gray-300 tracking-wide leading-none"><?php echo esc_html( $client_name ); ?></span>
                    </div>
                <?php endif; ?>

                <!-- Browser Mockup Window -->
                <div class="relative w-full bg-gray-950 border border-gray-700/50 rounded-2xl shadow-2xl flex flex-col overflow-hidden backdrop-blur-md group-hover:-translate-y-4 transition-transform duration-700 z-0">
                    <!-- Browser Header -->
                    <div class="h-8 lg:h-10 bg-gray-900 border-b border-white/10 flex items-center px-4 gap-2 shrink-0">
                        <div class="w-2.5 h-2.5 lg:w-3 lg:h-3 rounded-full bg-red-500/80"></div>
                        <div class="w-2.5 h-2.5 lg:w-3 lg:h-3 rounded-full bg-yellow-500/80"></div>
                        <div class="w-2.5 h-2.5 lg:w-3 lg:h-3 rounded-full bg-green-500/80"></div>
                    </div>
                    <!-- Browser Content (Image) -->
                    <div class="relative w-full aspect-video overflow-hidden bg-gray-950">
                        <?php if ( $p_image ) : ?>
                            <img src="<?php echo esc_url( $p_image ); ?>" alt="<?php echo esc_attr( $p_title ); ?>" class="absolute inset-0 w-full h-full object-cover object-top opacity-90 group-hover:opacity-100 transition-opacity duration-700">
                        <?php else : ?>
                            <div class="p-8 opacity-20">
                                <div class="w-1/3 h-8 bg-white rounded-lg mb-8"></div>
                                <div class="w-full h-4 bg-white rounded mb-4"></div>
                                <div class="w-5/6 h-4 bg-white rounded mb-4"></div>
                                <div class="w-4/6 h-4 bg-white rounded mb-12"></div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
              </div>

            </a>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

  </div>
</section>

<?php
/**
 * Plantilla individual para Proyectos del Portafolio
 * Diseño Premium Dark enfocado en SEO y legibilidad
 */

get_header();

// Recopilar datos del post actual
$post_id = get_the_ID();
$title = get_the_title();
$content = get_the_content();
$image_url = get_the_post_thumbnail_url($post_id, 'full');
$live_url = function_exists('get_field') ? get_field('live_url', $post_id) : get_post_meta($post_id, 'live_url', true);
$client_name = function_exists('get_field') ? get_field('client_name', $post_id) : get_post_meta($post_id, 'client_name', true);
$website_status = get_post_meta($post_id, '_website_status', true);

// Extraer términos
$cat_terms = wp_get_post_terms($post_id, 'categoria_proyecto', ['fields' => 'names']);
$category = (!empty($cat_terms) && !is_wp_error($cat_terms)) ? $cat_terms[0] : 'Caso de Estudio';

$tech_terms = wp_get_post_terms($post_id, 'tech_stack', ['fields' => 'names']);
$techs = (!empty($tech_terms) && !is_wp_error($tech_terms)) ? $tech_terms : [];

// Testimonio
$testimonio_id = function_exists('get_field') ? get_field('testimonio_asociado', $post_id, false) : get_post_meta($post_id, 'testimonio_asociado', true);
if (is_object($testimonio_id)) $testimonio_id = $testimonio_id->ID;
if (is_array($testimonio_id) && isset($testimonio_id[0])) $testimonio_id = $testimonio_id[0];

$test_content = $testimonio_id ? get_post_meta($testimonio_id, 'testimonial_content', true) : '';
$test_author = $testimonio_id ? get_the_title($testimonio_id) : '';
$test_country = $testimonio_id ? get_post_meta($testimonio_id, 'testimonial_country', true) : '';
$test_link = $testimonio_id ? get_post_meta($testimonio_id, 'testimonial_link', true) : '';
?>

<main class="bg-gray-950 min-h-screen pb-20 selection:bg-brand-500 selection:text-white">
    
    <!-- Hero Section -->
    <section class="relative w-full overflow-hidden border-b border-gray-800 bg-gray-900 pb-20 pt-32">
        <!-- Background Blur/Glow Effects -->
        <div class="absolute top-0 left-1/4 w-[500px] h-[500px] bg-brand-500/20 rounded-full blur-[120px] pointer-events-none"></div>
        
        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <span class="inline-block text-brand-300 font-bold uppercase tracking-[0.2em] mb-6 border border-brand-500/30 bg-brand-500/10 px-4 py-1 rounded-full text-sm">
                    <?php echo esc_html($category); ?>
                </span>
                <h1 class="text-4xl md:text-5xl lg:text-7xl font-extrabold text-white leading-tight mb-8">
                    <?php echo esc_html($title); ?>
                </h1>
            </div>
            
            <?php if ($image_url): ?>
            <div class="mt-16 w-full max-w-6xl mx-auto rounded-3xl overflow-hidden shadow-2xl border border-gray-800 relative group">
                <!-- Fallback en caso de que la imagen tarde en cargar -->
                <div class="absolute inset-0 bg-gray-900 animate-pulse"></div>
                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($title); ?>" class="w-full h-auto max-h-[600px] object-cover object-top relative z-10 transition-transform duration-1000 group-hover:scale-105" loading="lazy">
                <!-- Overlay suave para mantener contraste -->
                <div class="absolute inset-0 bg-gradient-to-t from-gray-950 via-transparent to-transparent z-20"></div>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Contenido y Sidebar -->
    <section class="container mx-auto px-6 py-20">
        <div class="flex flex-col lg:flex-row gap-16 max-w-7xl mx-auto">
            
            <!-- Principal: Contenido SEO -->
            <article class="w-full lg:w-8/12">
                <!-- El bloque "prose" es la joya de la corona para artículos SEO. Tailwind Typography se encarga de dar estilo perfecto a H2, P, UL, LI -->
                <div class="prose prose-invert prose-sm md:prose-base lg:prose-lg max-w-none prose-headings:font-bold prose-h2:text-white prose-h2:mt-12 prose-h2:first:mt-0 prose-h2:mb-6 prose-p:text-gray-400 prose-p:leading-relaxed prose-li:text-gray-400 prose-a:text-brand-400 hover:prose-a:text-brand-300 transition-colors">
                    <?php 
                        // Muestra el contenido largo inyectado por el script, con formato correcto.
                        echo wp_kses_post(apply_filters('the_content', $content)); 
                    ?>
                </div>
            </article>

            <!-- Sidebar: Detalles Técnicos -->
            <aside class="w-full lg:w-4/12">
                <div class="sticky top-32 bg-gray-900 border border-gray-800 rounded-3xl p-8 shadow-2xl">
                    <h3 class="text-2xl font-bold text-white mb-6 border-b border-gray-800 pb-4">Detalles del Proyecto</h3>
                    
                    <?php if ($client_name || $live_url): ?>
                    <div class="mb-8 border-b border-gray-800 pb-8">
                        <h4 class="text-sm text-gray-500 uppercase tracking-widest font-semibold mb-4">Información del Proyecto</h4>
                        <div class="space-y-4">
                            <?php if ($client_name): ?>
                            <div>
                                <span class="text-gray-500 text-xs block mb-1">Cliente</span>
                                <strong class="text-white text-lg"><?php echo esc_html($client_name); ?></strong>
                            </div>
                            <?php endif; ?>
                            
                            <?php if ($live_url): ?>
                            <div>
                                <span class="text-gray-500 text-xs block mb-1">Sitio Web</span>
                                <?php if ($website_status === 'offline'): ?>
                                    <div class="bg-gray-800/50 border border-gray-700/50 rounded-lg p-3 mt-1">
                                        <p class="text-[11px] text-gray-400 leading-tight italic">
                                            * El proyecto original ya no se encuentra en línea debido a cambios comerciales o finalización de soporte.
                                        </p>
                                    </div>
                                <?php else: ?>
                                    <a href="<?php echo esc_url($live_url); ?>" target="_blank" rel="noopener noreferrer" class="text-brand-400 hover:text-brand-300 font-medium transition-colors break-all flex items-center group">
                                        <?php 
                                            $parsed_url = parse_url($live_url, PHP_URL_HOST);
                                            echo esc_html($parsed_url ? $parsed_url : $live_url); 
                                        ?>
                                        <svg class="w-4 h-4 ml-1 opacity-0 group-hover:opacity-100 transform group-hover:translate-x-1 group-hover:-translate-y-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                    </a>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if (!empty($techs)): ?>
                    <div class="mb-8">
                        <h4 class="text-sm text-gray-500 uppercase tracking-widest font-semibold mb-4">Stack Tecnológico</h4>
                        <div class="flex flex-wrap gap-2">
                            <?php foreach ($techs as $tech): ?>
                                <span class="bg-gray-950 border border-gray-700 rounded-full px-4 py-2 text-sm text-gray-300">
                                    <?php echo esc_html($tech); ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Testimonio Asociado -->
                    <?php if ($test_content): ?>
                    <div class="mt-12 pt-8 border-t border-gray-800">
                        <div class="flex text-yellow-400 mb-4">
                            <!-- 5 Stars -->
                            <?php for($i=0; $i<5; $i++): ?>
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <?php endfor; ?>
                        </div>
                        <blockquote class="text-gray-300 italic mb-6 text-sm leading-relaxed">
                            "<?php echo esc_html($test_content); ?>"
                        </blockquote>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-white font-bold text-sm"><?php echo esc_html($test_author); ?></p>
                                <?php if ($test_country): ?>
                                    <p class="text-gray-500 text-xs mt-1"><?php echo esc_html($test_country); ?></p>
                                <?php endif; ?>
                            </div>
                            <?php if ($test_link): ?>
                                <a href="<?php echo esc_url($test_link); ?>" target="_blank" rel="noopener noreferrer" class="text-brand-400 hover:text-brand-300 text-xs font-semibold underline underline-offset-4 transition-colors">
                                    Ver original
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </aside>

        </div>
    </section>

</main>

<?php get_footer(); ?>

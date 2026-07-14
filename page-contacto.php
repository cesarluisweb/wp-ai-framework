<?php
/**
 * Template Name: Contacto
 */

$form_submitted = false;
$form_error = false;

// Manejo básico de formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_nonce']) && wp_verify_nonce($_POST['contact_nonce'], 'contact_form_action')) {
    $name = sanitize_text_field($_POST['contact_name'] ?? '');
    $email = sanitize_email($_POST['contact_email'] ?? '');
    $company = sanitize_text_field($_POST['contact_company'] ?? '');
    $type = sanitize_text_field($_POST['contact_type'] ?? '');
    $message_text = sanitize_textarea_field($_POST['contact_message'] ?? '');
    $budget = sanitize_text_field($_POST['contact_budget'] ?? '');
    
    if (!empty($name) && !empty($email) && is_email($email) && !empty($message_text)) {
        $to = get_option('admin_email');
        $subject = 'Nuevo prospecto cesarluis.com: ' . $type . ' - ' . $name;
        $body = "Nombre: $name\n";
        $body .= "Email: $email\n";
        $body .= "Empresa: $company\n";
        $body .= "Tipo de Proyecto: $type\n";
        $body .= "Presupuesto Estimado: $budget\n\n";
        $body .= "Mensaje:\n$message_text";
        
        $headers = [
            'Content-Type: text/plain; charset=UTF-8',
            'Reply-To: ' . $email
        ];
        
        // Se asume configuración wp_mail funcional
        $form_submitted = wp_mail($to, $subject, $body, $headers);
        if (!$form_submitted) {
            $form_error = true;
        }
    } else {
        $form_error = true;
    }
}

get_header();
?>

<!-- JSON-LD Schema for SEO/GEO -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ContactPage",
  "name": "Contacto - César Luis",
  "description": "Contáctame para proyectos de arquitectura web, orquestación de LLMs y desarrollo de alto rendimiento para agencias y empresas.",
  "url": "<?php the_permalink(); ?>",
  "mainEntity": {
    "@type": "Person",
    "name": "César Luis Amundaray",
    "jobTitle": "Arquitecto de Soluciones IA & Desarrollador WordPress",
    "email": "info@cesarluis.com",
    "sameAs": [
      "https://linkedin.com/in/cesarluis"
    ]
  }
}
</script>

<main class="pt-32 bg-gray-950">
    <section class="max-w-[1400px] mx-auto px-6 lg:px-8">
        
        <!-- Hero Section -->
        <div class="text-center mb-16">
            <?php
            $hero_kicker = get_field('hero_kicker') ?: 'Contacto';
            $hero_h1_normal = get_field('hero_h1_normal') ?: 'Hablemos de tu';
            $hero_h1_highlight = get_field('hero_h1_highlight') ?: 'proyecto';
            $hero_description = get_field('hero_description') ?: 'Cuéntame qué necesitas. Ya sea un sitio web a medida, una integración con IA o mantenimiento web continuo, te responderé en menos de 24 horas.';
            ?>
            <span class="text-brand-400 font-bold tracking-wider uppercase text-sm mb-4 block"><?php echo esc_html($hero_kicker); ?></span>
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                <?php echo esc_html($hero_h1_normal); ?> <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-300 to-brand-500"><?php echo esc_html($hero_h1_highlight); ?></span>
            </h1>
            <p class="text-xl text-gray-400 max-w-2xl mx-auto">
                <?php echo esc_html($hero_description); ?>
            </p>
        </div>

        <div class="flex flex-col lg:flex-row gap-12">
            
            <!-- Left Side: Form -->
            <div class="lg:w-7/12">
                <div class="bg-gray-900/40 border border-gray-800 rounded-3xl p-8 lg:p-12">
                    
                    <?php if ($form_submitted): ?>
                        <div class="bg-green-500/10 border border-green-500/30 rounded-xl p-6 text-green-400 mb-8 flex items-start gap-4">
                            <svg class="w-6 h-6 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <h3 class="font-bold text-lg mb-1">¡Mensaje enviado con éxito!</h3>
                                <p>Gracias por contactarme. He recibido tu mensaje y me pondré en contacto contigo en menos de 24 horas.</p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($form_error): ?>
                        <div class="bg-red-500/10 border border-red-500/30 rounded-xl p-4 text-red-400 mb-8 flex items-center gap-3">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Hubo un error al enviar tu mensaje. Por favor, verifica los campos e inténtalo de nuevo.</span>
                        </div>
                    <?php endif; ?>

                    <form action="<?php echo esc_url(get_permalink()); ?>" method="POST" class="space-y-6">
                        <?php wp_nonce_field('contact_form_action', 'contact_nonce'); ?>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="contact_name" class="block text-sm text-gray-400 font-semibold uppercase tracking-wider mb-2">Nombre completo *</label>
                                <input type="text" id="contact_name" name="contact_name" required
                                       class="w-full bg-gray-950 border border-gray-800 rounded-xl px-4 py-3 text-white placeholder:text-gray-600 focus:border-brand-500 focus:ring-1 focus:ring-brand-500 transition-colors"
                                       placeholder="Tu nombre o agencia">
                            </div>
                            <div>
                                <label for="contact_email" class="block text-sm text-gray-400 font-semibold uppercase tracking-wider mb-2">Email profesional *</label>
                                <input type="email" id="contact_email" name="contact_email" required
                                       class="w-full bg-gray-950 border border-gray-800 rounded-xl px-4 py-3 text-white placeholder:text-gray-600 focus:border-brand-500 focus:ring-1 focus:ring-brand-500 transition-colors"
                                       placeholder="tu@email.com">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="contact_company" class="block text-sm text-gray-400 font-semibold uppercase tracking-wider mb-2">Empresa (Opcional)</label>
                                <input type="text" id="contact_company" name="contact_company"
                                       class="w-full bg-gray-950 border border-gray-800 rounded-xl px-4 py-3 text-white placeholder:text-gray-600 focus:border-brand-500 focus:ring-1 focus:ring-brand-500 transition-colors"
                                       placeholder="Nombre de tu empresa">
                            </div>
                            <div>
                                <label for="contact_type" class="block text-sm text-gray-400 font-semibold uppercase tracking-wider mb-2">Servicio de interés</label>
                                <div class="relative">
                                    <select id="contact_type" name="contact_type"
                                            class="w-full bg-gray-950 border border-gray-800 rounded-xl px-4 py-3 text-white appearance-none focus:border-brand-500 focus:ring-1 focus:ring-brand-500 transition-colors">
                                        <option value="Desarrollo Web">Desarrollo Web a Medida</option>
                                        <option value="Mantenimiento Web">Mantenimiento Web</option>
                                        <option value="Integración IA">Integración de Agentes IA</option>
                                        <option value="Optimización SEO/GEO">Optimización SEO/GEO</option>
                                        <option value="Migración">Migración / Zero Downtime</option>
                                        <option value="Otro">Otro requerimiento</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="contact_budget" class="block text-sm text-gray-400 font-semibold uppercase tracking-wider mb-2">Presupuesto Estimado</label>
                            <div class="relative">
                                <select id="contact_budget" name="contact_budget"
                                        class="w-full bg-gray-950 border border-gray-800 rounded-xl px-4 py-3 text-white appearance-none focus:border-brand-500 focus:ring-1 focus:ring-brand-500 transition-colors">
                                    <option value="No estoy seguro">No estoy seguro / Quiero consultarlo</option>
                                    <option value="Menos de 1.000€">Menos de 1.000€</option>
                                    <option value="1.000€ - 3.000€">1.000€ - 3.000€</option>
                                    <option value="3.000€ - 10.000€">3.000€ - 10.000€</option>
                                    <option value="Más de 10.000€">Más de 10.000€</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="contact_message" class="block text-sm text-gray-400 font-semibold uppercase tracking-wider mb-2">Cuéntame sobre tu proyecto *</label>
                            <textarea id="contact_message" name="contact_message" required rows="5"
                                      class="w-full bg-gray-950 border border-gray-800 rounded-xl px-4 py-3 text-white placeholder:text-gray-600 focus:border-brand-500 focus:ring-1 focus:ring-brand-500 transition-colors resize-none"
                                      placeholder="Describe brevemente tus objetivos, plazos y cualquier restricción técnica..."></textarea>
                        </div>

                        <button type="submit" class="w-full bg-brand-500 hover:bg-brand-400 text-white font-bold py-4 px-8 rounded-xl transition-colors flex justify-center items-center gap-2 cursor-pointer">
                            <span>Enviar Mensaje</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Right Side: Info & Testimonial -->
            <div class="lg:w-5/12 space-y-8">
                
                <!-- Contact Info Card -->
                <!-- Contact Info Card -->
                <div class="bg-gray-900 border border-gray-800 rounded-3xl p-8">
                    <h3 class="text-xl font-bold text-white mb-6">Contacto Directo</h3>
                    
                    <div class="space-y-4">
                        <?php
                        $contact_email = get_option('wp_ai_contact_email', 'info@cesarluis.com');
                        if (!empty($contact_email)):
                        ?>
                        <a href="mailto:<?php echo esc_attr($contact_email); ?>" class="flex items-center gap-4 py-4 border-b border-gray-800 border-dashed group hover:border-brand-500/30 transition-colors">
                            <div class="bg-brand-500/10 p-3 rounded-xl shrink-0 text-brand-400 group-hover:bg-brand-500 group-hover:text-white transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm text-gray-500 mb-1">Email Profesional</div>
                                <div class="text-white font-medium"><?php echo esc_html($contact_email); ?></div>
                            </div>
                        </a>
                        <?php endif; ?>

                        <?php 
                        $wa_number = get_option('wp_ai_social_whatsapp');
                        $contact_phone = get_option('wp_ai_contact_phone');
                        if (empty($wa_number)) {
                            $wa_number = $contact_phone;
                        }
                        if (!empty($wa_number)): 
                            $wa_clean = preg_replace('/[^0-9]/', '', $wa_number);
                            $wa_link = 'https://wa.me/' . $wa_clean;
                        ?>
                        <a href="<?php echo esc_url($wa_link); ?>" target="_blank" rel="noopener noreferrer" class="flex items-center gap-4 pt-4 group transition-colors">
                            <div class="bg-brand-500/10 p-3 rounded-xl shrink-0 text-brand-400 group-hover:bg-brand-500 group-hover:text-white transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" /><path d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1" /></svg>
                            </div>
                            <div>
                                <div class="text-sm text-gray-500 mb-1">WhatsApp</div>
                                <div class="text-white font-medium">Chat Directo</div>
                            </div>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Socials Card -->
                <?php if (function_exists('wp_ai_get_social_links')): 
                    $socials = wp_ai_get_social_links();
                    if (!empty($socials)):
                ?>
                <div class="bg-gray-900 border border-gray-800 rounded-3xl p-8">
                    <h3 class="text-xl font-bold text-white mb-6">Redes Sociales</h3>
                    <div class="flex flex-wrap gap-4">
                        <?php foreach ($socials as $key => $social): ?>
                        <a href="<?php echo esc_url($social['url']); ?>" target="_blank" rel="noopener noreferrer" 
                           class="bg-gray-950 border border-gray-800 hover:border-brand-500/50 hover:bg-gray-800 text-gray-400 hover:text-brand-400 p-4 rounded-xl transition-all duration-300 transform hover:-translate-y-1"
                           aria-label="<?php echo esc_attr($social['platform']); ?>">
                            <?php 
                            // Render icon ensuring standard width for uniformity
                            $icon = $social['icon'];
                            $icon = str_replace('w-5 h-5', 'w-6 h-6', $icon);
                            echo $icon; 
                            ?>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php 
                    endif;
                endif; 
                ?>

                <!-- Random Testimonial Card -->
                <?php
                $testimonio_args = [
                    'post_type' => 'testimonio',
                    'posts_per_page' => 1,
                    'orderby' => 'rand'
                ];
                $testimonio_query = new WP_Query($testimonio_args);
                
                if ($testimonio_query->have_posts()) :
                    while ($testimonio_query->have_posts()) : $testimonio_query->the_post();
                        $author_name = get_the_title();
                        $role = get_post_meta(get_the_ID(), 'cargo', true) . ', ' . get_post_meta(get_the_ID(), 'empresa', true);
                        // Clean up trailing comma if enterprise is empty
                        $role = trim($role, ', ');
                        $quote = get_post_meta(get_the_ID(), 'testimonial_content', true);
                        if (empty($quote)) {
                            $quote = get_post_field('post_content', get_the_ID());
                        }
                ?>
                <div class="bg-gray-900/40 border border-gray-800 rounded-3xl p-8">
                    <div class="flex gap-1 text-yellow-500 mb-4">
                        <?php for ($i=0; $i<5; $i++): ?>
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                        <?php endfor; ?>
                    </div>
                    <blockquote class="text-gray-300 italic mb-6">
                        "<?php echo wp_trim_words(strip_tags($quote), 30); ?>"
                    </blockquote>
                    <div>
                        <div class="font-bold text-white"><?php echo esc_html($author_name); ?></div>
                        <div class="text-sm text-gray-500"><?php echo esc_html($role); ?></div>
                    </div>
                </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>

            </div>
        </div>
    </section>
    <!-- FAQ Section -->
    <?php
    $faq_arr = [];
    $args_f = [
        'post_type' => 'faq',
        'posts_per_page' => -1,
        'orderby' => 'menu_order date',
        'order' => 'ASC'
    ];
    $q_f = new WP_Query($args_f);
    if ($q_f->have_posts()) {
        while($q_f->have_posts()) {
            $q_f->the_post();
            $faq_arr[] = [
                'question' => get_the_title(),
                'answer' => apply_filters('the_content', get_the_content())
            ];
        }
        wp_reset_postdata();
    }
    
    if (!empty($faq_arr)) {
        if(function_exists('wp_ai_render_component')) wp_ai_render_component('faq', 'premium-dark', [
            'section_kicker' => 'Preguntas Frecuentes',
            'section_title' => get_field('contacto_faq_titulo') ?: 'Preguntas habituales antes de empezar', // Fallback
            'section_description' => get_field('contacto_faq_desc') ?: 'Despeja tus dudas sobre tiempos, flujo de trabajo, comunicación y costes antes de enviar el formulario.',
            'questions' => $faq_arr
        ]);
    }
    ?>
</main>

<?php get_footer(); ?>

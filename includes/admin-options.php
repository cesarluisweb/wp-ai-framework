<?php
/**
 * WP-AI Framework - Panel de Opciones Globales
 */

// Evitar acceso directo
if (!defined('ABSPATH')) {
    exit;
}

// 1. Agregar página de menú al Dashboard
add_action('admin_menu', function() {
    add_menu_page(
        __('Opciones del Tema', 'wp-ai-theme'),
        __('Opciones del Tema', 'wp-ai-theme'),
        'manage_options',
        'wp-ai-theme-options',
        'wp_ai_theme_options_page_render',
        'dashicons-admin-generic',
        59
    );
});

// 2. Registrar opciones y campos
add_action('admin_init', function() {
    // Grupo: Redes Sociales
    register_setting('wp_ai_theme_options_group', 'wp_ai_social_linkedin');
    register_setting('wp_ai_theme_options_group', 'wp_ai_social_twitter');
    register_setting('wp_ai_theme_options_group', 'wp_ai_social_github');
    register_setting('wp_ai_theme_options_group', 'wp_ai_social_instagram');
    register_setting('wp_ai_theme_options_group', 'wp_ai_social_facebook');
    register_setting('wp_ai_theme_options_group', 'wp_ai_social_youtube');
    register_setting('wp_ai_theme_options_group', 'wp_ai_social_tiktok');
    register_setting('wp_ai_theme_options_group', 'wp_ai_social_whatsapp');

    // Grupo: Datos de Contacto
    register_setting('wp_ai_theme_options_group', 'wp_ai_contact_email');
    register_setting('wp_ai_theme_options_group', 'wp_ai_contact_phone');

    // Grupo: Scripts de Terceros
    register_setting('wp_ai_theme_options_group', 'wp_ai_header_scripts');
    register_setting('wp_ai_theme_options_group', 'wp_ai_footer_scripts');

    // Grupo: Configuración General
    register_setting('wp_ai_theme_options_group', 'wp_ai_footer_copyright');
});

// 3. Renderizar la página de opciones
function wp_ai_theme_options_page_render() {
    // Comprobar permisos
    if (!current_user_can('manage_options')) {
        return;
    }

    // Mostrar mensaje de guardado
    if (isset($_GET['settings-updated'])) {
        add_settings_error('wp_ai_theme_messages', 'wp_ai_theme_message', __('Ajustes guardados correctamente.', 'wp-ai-theme'), 'updated');
    }
    settings_errors('wp_ai_theme_messages');
    ?>
    <div class="wrap wp-ai-options-wrap" style="max-width: 900px; margin-top: 20px;">
        <h1 style="font-weight: 800; font-size: 28px; margin-bottom: 25px; color: #0f172a; display: flex; items-center: center; gap: 10px;">
            <span class="dashicons dashicons-admin-generic" style="font-size: 28px; width: 28px; height: 28px; line-height: 28px; color: #287799;"></span>
            <?php echo esc_html(get_admin_page_title()); ?>
        </h1>

        <form action="options.php" method="post" style="background: #ffffff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1); border: 1px solid #e2e8f0;">
            <?php
            settings_fields('wp_ai_theme_options_group');
            ?>

            <!-- SECCIÓN: Redes Sociales -->
            <h2 style="font-size: 18px; font-weight: 700; border-bottom: 2px solid #f1f5f9; padding-bottom: 10px; margin-top: 0; margin-bottom: 20px; color: #1e293b;">
                <?php _e('Redes Sociales', 'wp-ai-theme'); ?>
            </h2>
            <p style="color: #64748b; font-size: 13px; margin-bottom: 20px;">
                <?php _e('Introduce las URLs completas de tus perfiles. Los iconos se mostrarán automáticamente en el menú móvil y otras partes del sitio.', 'wp-ai-theme'); ?>
            </p>

            <table class="form-table" role="presentation" style="margin-bottom: 30px;">
                <tr>
                    <th scope="row"><label for="wp_ai_social_linkedin">LinkedIn</label></th>
                    <td>
                        <input type="url" name="wp_ai_social_linkedin" id="wp_ai_social_linkedin" value="<?php echo esc_url(get_option('wp_ai_social_linkedin')); ?>" class="regular-text" placeholder="https://linkedin.com/in/usuario" />
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="wp_ai_social_twitter">Twitter / X</label></th>
                    <td>
                        <input type="url" name="wp_ai_social_twitter" id="wp_ai_social_twitter" value="<?php echo esc_url(get_option('wp_ai_social_twitter')); ?>" class="regular-text" placeholder="https://x.com/usuario" />
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="wp_ai_social_github">GitHub</label></th>
                    <td>
                        <input type="url" name="wp_ai_social_github" id="wp_ai_social_github" value="<?php echo esc_url(get_option('wp_ai_social_github')); ?>" class="regular-text" placeholder="https://github.com/usuario" />
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="wp_ai_social_instagram">Instagram</label></th>
                    <td>
                        <input type="url" name="wp_ai_social_instagram" id="wp_ai_social_instagram" value="<?php echo esc_url(get_option('wp_ai_social_instagram')); ?>" class="regular-text" placeholder="https://instagram.com/usuario" />
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="wp_ai_social_facebook">Facebook</label></th>
                    <td>
                        <input type="url" name="wp_ai_social_facebook" id="wp_ai_social_facebook" value="<?php echo esc_url(get_option('wp_ai_social_facebook')); ?>" class="regular-text" placeholder="https://facebook.com/pagina" />
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="wp_ai_social_youtube">YouTube</label></th>
                    <td>
                        <input type="url" name="wp_ai_social_youtube" id="wp_ai_social_youtube" value="<?php echo esc_url(get_option('wp_ai_social_youtube')); ?>" class="regular-text" placeholder="https://youtube.com/@canal" />
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="wp_ai_social_tiktok">TikTok</label></th>
                    <td>
                        <input type="url" name="wp_ai_social_tiktok" id="wp_ai_social_tiktok" value="<?php echo esc_url(get_option('wp_ai_social_tiktok')); ?>" class="regular-text" placeholder="https://tiktok.com/@usuario" />
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="wp_ai_social_whatsapp">WhatsApp (Enlace o Número)</label></th>
                    <td>
                        <input type="text" name="wp_ai_social_whatsapp" id="wp_ai_social_whatsapp" value="<?php echo esc_attr(get_option('wp_ai_social_whatsapp')); ?>" class="regular-text" placeholder="https://wa.me/tu_numero o número completo con código de país" />
                        <p class="description"><?php _e('Se usará para los iconos sociales y para el botón flotante.', 'wp-ai-theme'); ?></p>
                    </td>
                </tr>
            </table>

            <!-- SECCIÓN: Datos de Contacto -->
            <h2 style="font-size: 18px; font-weight: 700; border-bottom: 2px solid #f1f5f9; padding-bottom: 10px; margin-bottom: 20px; color: #1e293b;">
                <?php _e('Información de Contacto', 'wp-ai-theme'); ?>
            </h2>
            <table class="form-table" role="presentation" style="margin-bottom: 30px;">
                <tr>
                    <th scope="row"><label for="wp_ai_contact_email"><?php _e('Email Corporativo', 'wp-ai-theme'); ?></label></th>
                    <td>
                        <input type="email" name="wp_ai_contact_email" id="wp_ai_contact_email" value="<?php echo esc_attr(get_option('wp_ai_contact_email')); ?>" class="regular-text" placeholder="hola@cesarluis.com" />
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="wp_ai_contact_phone"><?php _e('Teléfono de Contacto', 'wp-ai-theme'); ?></label></th>
                    <td>
                        <input type="text" name="wp_ai_contact_phone" id="wp_ai_contact_phone" value="<?php echo esc_attr(get_option('wp_ai_contact_phone')); ?>" class="regular-text" placeholder="+58 412 000 0000" />
                    </td>
                </tr>
            </table>

            <!-- SECCIÓN: Scripts y Analítica -->
            <h2 style="font-size: 18px; font-weight: 700; border-bottom: 2px solid #f1f5f9; padding-bottom: 10px; margin-bottom: 20px; color: #1e293b;">
                <?php _e('Scripts de Integración', 'wp-ai-theme'); ?>
            </h2>
            <p style="color: #64748b; font-size: 13px; margin-bottom: 20px;">
                <?php _e('Pega aquí los códigos de seguimiento (Google Analytics, Facebook Pixel, Google Tag Manager, etc.). Se insertarán de forma segura en las ubicaciones correspondientes.', 'wp-ai-theme'); ?>
            </p>
            <table class="form-table" role="presentation" style="margin-bottom: 30px;">
                <tr>
                    <th scope="row"><label for="wp_ai_header_scripts"><?php _e('Scripts en Cabecera (Header)', 'wp-ai-theme'); ?></label></th>
                    <td>
                        <textarea name="wp_ai_header_scripts" id="wp_ai_header_scripts" rows="6" class="large-text code" placeholder="<!-- Pega aquí los códigos de Google Analytics, Tag Manager, etc. que van dentro de <head> -->"><?php echo esc_textarea(get_option('wp_ai_header_scripts')); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="wp_ai_footer_scripts"><?php _e('Scripts en Pie de Página (Footer)', 'wp-ai-theme'); ?></label></th>
                    <td>
                        <textarea name="wp_ai_footer_scripts" id="wp_ai_footer_scripts" rows="6" class="large-text code" placeholder="<!-- Pega aquí los códigos que van al final del <body> (ej: píxeles de conversión) -->"><?php echo esc_textarea(get_option('wp_ai_footer_scripts')); ?></textarea>
                    </td>
                </tr>
            </table>

            <!-- SECCIÓN: Configuración General -->
            <h2 style="font-size: 18px; font-weight: 700; border-bottom: 2px solid #f1f5f9; padding-bottom: 10px; margin-bottom: 20px; color: #1e293b;">
                <?php _e('Configuración General del Tema', 'wp-ai-theme'); ?>
            </h2>
            <table class="form-table" role="presentation" style="margin-bottom: 30px;">
                <tr>
                    <th scope="row"><label for="wp_ai_footer_copyright"><?php _e('Texto de Copyright', 'wp-ai-theme'); ?></label></th>
                    <td>
                        <input type="text" name="wp_ai_footer_copyright" id="wp_ai_footer_copyright" value="<?php echo esc_attr(get_option('wp_ai_footer_copyright', '© ' . date('Y') . ' César Luis. Todos los derechos reservados.')); ?>" class="large-text" />
                    </td>
                </tr>
            </table>

            <?php submit_button(__('Guardar Cambios', 'wp-ai-theme'), 'primaryLarge'); ?>
        </form>
    </div>
    <?php
}

/**
 * Retorna las redes sociales activas con sus iconos SVG y etiquetas.
 */
function wp_ai_get_social_links() {
    $raw_whatsapp = get_option('wp_ai_social_whatsapp');
    $whatsapp_url = '';
    if (!empty($raw_whatsapp)) {
        if (strpos($raw_whatsapp, 'http') === 0) {
            $whatsapp_url = $raw_whatsapp;
        } else {
            $clean_whatsapp = preg_replace('/[^0-9]/', '', $raw_whatsapp);
            $whatsapp_url = 'https://wa.me/' . $clean_whatsapp;
        }
    }

    $socials = [
        'linkedin'  => [
            'platform' => 'LinkedIn',
            'url'  => get_option('wp_ai_social_linkedin'),
            'icon' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>'
        ],
        'twitter'   => [
            'platform' => 'Twitter / X',
            'url'  => get_option('wp_ai_social_twitter'),
            'icon' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>'
        ],
        'github'    => [
            'platform' => 'GitHub',
            'url'  => get_option('wp_ai_social_github'),
            'icon' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>'
        ],
        'instagram' => [
            'platform' => 'Instagram',
            'url'  => get_option('wp_ai_social_instagram'),
            'icon' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>'
        ],
        'facebook'  => [
            'platform' => 'Facebook',
            'url'  => get_option('wp_ai_social_facebook'),
            'icon' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>'
        ],
        'youtube'   => [
            'platform' => 'YouTube',
            'url'  => get_option('wp_ai_social_youtube'),
            'icon' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.163a3.003 3.003 0 0 0-2.11-2.11C19.518 3.5 12 3.5 12 3.5s-7.518 0-9.388.553a3.003 3.003 0 0 0-2.11 2.11C0 8.033 0 12 0 12s0 3.967.502 5.837a3.003 3.003 0 0 0 2.11 2.11c1.87.553 9.388.553 9.388.553s7.518 0 9.388-.553a3.003 3.003 0 0 0 2.11-2.11C24 15.967 24 12 24 12s0-3.967-.502-5.837zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>'
        ],
        'tiktok'    => [
            'platform' => 'TikTok',
            'url'  => get_option('wp_ai_social_tiktok'),
            'icon' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.17-2.86-.74-3.9-1.78-.31-.31-.59-.67-.83-1.06-.03 2.53.01 5.06-.02 7.59-.08 1.94-.78 3.89-2.18 5.24-1.57 1.54-3.91 2.29-6.09 2.06-2.58-.25-4.99-1.92-5.96-4.36-1.18-2.92-.37-6.52 2-8.52 1.48-1.25 3.44-1.85 5.37-1.69v4.07c-.95-.12-1.94.13-2.67.75-.82.68-1.19 1.83-1 2.87.21 1.13.98 2.13 2.03 2.56.96.4 2.07.29 2.91-.32.69-.5 1.07-1.33 1.07-2.17.02-3.86.01-7.72.02-11.58-.02-.02-.02-.04-.02-.06z"/></svg>'
        ],
        'whatsapp'  => [
            'platform' => 'WhatsApp',
            'url'  => $whatsapp_url,
            'icon' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.588-5.946C.056 5.348 5.399.01 12.01.01c3.202.001 6.212 1.246 8.477 3.513 2.262 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.504-5.731-1.464L0 24zm6.59-4.846c1.6.95 3.197 1.451 4.793 1.451 5.424 0 9.835-4.409 9.838-9.832.002-2.628-1.022-5.097-2.883-6.958C16.474 1.954 14.008 1.93 11.98 1.93c-5.422 0-9.832 4.409-9.835 9.832-.001 1.765.483 3.42 1.4 4.9L2.52 21.05l4.127-1.896zm12.39-7.397c-.328-.164-1.94-.959-2.242-1.07-.301-.109-.522-.164-.74.164-.219.329-.848 1.07-1.066 1.399-.177.23-.356.246-.684.082-.328-.164-1.386-.51-2.64-1.627-.974-.871-1.632-1.947-1.823-2.275-.192-.329-.02-.507.144-.671.148-.148.328-.383.493-.575.164-.192.219-.328.328-.548.11-.219.055-.411-.027-.575-.083-.164-.74-1.782-1.013-2.44-.266-.64-.56-.554-.74-.564-.17-.008-.37-.01-.57-.01-.2 0-.523.074-.797.373-.273.3-1.045 1.02-1.045 2.487 0 1.468 1.07 2.885 1.218 3.085.149.2 2.11 3.22 5.11 4.517.714.31 1.272.494 1.707.633.717.227 1.37.195 1.887.118.577-.087 1.777-.726 2.025-1.428.248-.702.248-1.302.174-1.428-.074-.127-.273-.2-.601-.365z"/></svg>'
        ]
    ];

    return array_filter($socials, function($social) {
        return !empty($social['url']);
    });
}

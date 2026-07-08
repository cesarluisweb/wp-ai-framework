<?php
/**
 * Cron Job para verificar el estado online/offline de los proyectos del portafolio.
 */

// 1. Añadir el intervalo semanal al Cron de WordPress
add_filter( 'cron_schedules', 'wp_ai_add_weekly_cron_schedule' );
function wp_ai_add_weekly_cron_schedule( $schedules ) {
    $schedules['weekly'] = array(
        'interval' => 604800, // 7 días * 24 horas * 60 minutos * 60 segundos
        'display'  => __( 'Una vez a la semana', 'wp-ai-theme' )
    );
    return $schedules;
}

// 2. Programar el evento si no está programado
add_action( 'wp', 'wp_ai_schedule_portfolio_check' );
function wp_ai_schedule_portfolio_check() {
    if ( ! wp_next_scheduled( 'wp_ai_portfolio_status_check_event' ) ) {
        wp_schedule_event( time(), 'weekly', 'wp_ai_portfolio_status_check_event' );
    }
}

// 3. La acción que se ejecutará en el Cron
add_action( 'wp_ai_portfolio_status_check_event', 'wp_ai_execute_portfolio_check' );
function wp_ai_execute_portfolio_check() {
    $args = array(
        'post_type'      => 'proyecto',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
    );

    $query = new WP_Query( $args );

    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            $post_id = get_the_ID();
            
            // Obtener la URL en vivo
            $live_url = function_exists('get_field') ? get_field('live_url', $post_id) : get_post_meta($post_id, 'live_url', true);

            if ( ! empty( $live_url ) && wp_http_validate_url( $live_url ) ) {
                // Hacer la petición HTTP
                $response = wp_remote_get( $live_url, array(
                    'timeout'     => 10,
                    'redirection' => 3,
                ) );

                if ( is_wp_error( $response ) ) {
                    // Si hay error de conexión (timeout, dns, etc)
                    update_post_meta( $post_id, '_website_status', 'offline' );
                } else {
                    $response_code = wp_remote_retrieve_response_code( $response );
                    // Consideramos online si es menor a 400 (200 OK, 301/302 Redirects válidos)
                    if ( $response_code < 400 && $response_code >= 200 ) {
                        update_post_meta( $post_id, '_website_status', 'online' );
                    } else {
                        update_post_meta( $post_id, '_website_status', 'offline' );
                    }
                }
            }
        }
        wp_reset_postdata();
    }
}

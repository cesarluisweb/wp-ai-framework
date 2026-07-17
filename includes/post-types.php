<?php
/**
 * Registro de Custom Post Types y Taxonomías
 */

function wp_ai_register_post_types() {

    // 1. CPT: Portafolio (Proyectos)
    $labels_portfolio = array(
        'name'                  => 'Proyectos',
        'singular_name'         => 'Proyecto',
        'menu_name'             => 'Portafolio',
        'name_admin_bar'        => 'Proyecto',
        'add_new'               => 'Añadir Nuevo',
        'add_new_item'          => 'Añadir Nuevo Proyecto',
        'new_item'              => 'Nuevo Proyecto',
        'edit_item'             => 'Editar Proyecto',
        'view_item'             => 'Ver Proyecto',
        'all_items'             => 'Todos los Proyectos',
        'search_items'          => 'Buscar Proyectos',
        'not_found'             => 'No se encontraron proyectos.',
    );

    $args_portfolio = array(
        'labels'             => $labels_portfolio,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'proyectos' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-portfolio',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'show_in_rest'       => true,
    );

    register_post_type( 'proyecto', $args_portfolio );

    // Taxonomía para Proyectos (Stack Tecnológico)
    register_taxonomy( 'tech_stack', array( 'proyecto' ), array(
        'hierarchical'      => false,
        'labels'            => array(
            'name'              => 'Stack Tecnológico',
            'singular_name'     => 'Tecnología',
            'search_items'      => 'Buscar Tecnologías',
            'all_items'         => 'Todas las Tecnologías',
            'edit_item'         => 'Editar Tecnología',
            'update_item'       => 'Actualizar Tecnología',
            'add_new_item'      => 'Añadir Nueva Tecnología',
            'menu_name'         => 'Stack Tecnológico',
        ),
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
    ));

    // Taxonomía para Proyectos (Categoría de Proyecto)
    register_taxonomy( 'categoria_proyecto', array( 'proyecto' ), array(
        'hierarchical'      => true,
        'labels'            => array(
            'name'              => 'Categorías de Proyecto',
            'singular_name'     => 'Categoría',
            'search_items'      => 'Buscar Categorías',
            'all_items'         => 'Todas las Categorías',
            'parent_item'       => 'Categoría Padre',
            'parent_item_colon' => 'Categoría Padre:',
            'edit_item'         => 'Editar Categoría',
            'update_item'       => 'Actualizar Categoría',
            'add_new_item'      => 'Añadir Nueva Categoría',
            'new_item_name'     => 'Nueva Categoría',
            'menu_name'         => 'Categorías',
        ),
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
    ));

    // 2. CPT: Testimonios
    $args_testimonials = array(
        'labels'             => array(
            'name'                  => 'Testimonios',
            'singular_name'         => 'Testimonio',
            'menu_name'             => 'Testimonios',
            'add_new'               => 'Añadir Nuevo',
            'add_new_item'          => 'Añadir Nuevo Testimonio',
            'edit_item'             => 'Editar Testimonio',
            'all_items'             => 'Todos los Testimonios',
        ),
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-format-quote',
        'supports'           => array( 'title', 'thumbnail' ), // Título (nombre) e Imagen destacada (foto). ACF para el resto.
    );

    register_post_type( 'testimonio', $args_testimonials );

    // 3. CPT: Servicios
    $args_services = array(
        'labels'             => array(
            'name'                  => 'Servicios',
            'singular_name'         => 'Servicio',
            'menu_name'             => 'Servicios',
            'add_new'               => 'Añadir Nuevo',
            'add_new_item'          => 'Añadir Nuevo Servicio',
            'edit_item'             => 'Editar Servicio',
            'all_items'             => 'Todos los Servicios',
        ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_position'      => 7,
        'menu_icon'          => 'dashicons-hammer',
        'supports'           => array( 'title', 'editor' ),
        'show_in_rest'       => true,
    );

    register_post_type( 'servicio', $args_services );

    // 4. CPT: FAQ
    $args_faq = array(
        'labels'             => array(
            'name'                  => 'Preguntas (FAQ)',
            'singular_name'         => 'Pregunta',
            'menu_name'             => 'FAQ',
            'add_new'               => 'Añadir Nueva',
            'add_new_item'          => 'Añadir Nueva Pregunta',
            'edit_item'             => 'Editar Pregunta',
            'all_items'             => 'Todas las Preguntas',
        ),
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_position'      => 8,
        'menu_icon'          => 'dashicons-editor-help',
        'supports'           => array( 'title', 'editor', 'page-attributes' ), // title, editor, and page-attributes for ordering
        'show_in_rest'       => true,
    );

    register_post_type( 'faq', $args_faq );
}
add_action( 'init', 'wp_ai_register_post_types' );

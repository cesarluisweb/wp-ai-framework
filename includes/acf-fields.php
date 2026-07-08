<?php
/**
 * ACF Config (Free Version)
 * Los campos se configuran visualmente o mediante importación JSON (acf-export-gratis.json).
 * Al ser la versión gratuita, no usamos acf_add_options_page() aquí.
 */

// Si necesitas registrar campos locales vía PHP en el futuro, puedes hacerlo aquí.
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_home_portfolio',
	'title' => 'Contenido Destacado de la Portada',
	'fields' => array(
		array(
			'key' => 'field_home_featured_projects',
			'label' => 'Proyectos Destacados',
			'name' => 'home_featured_projects',
			'type' => 'relationship',
			'instructions' => 'Selecciona y ordena los proyectos que deseas mostrar en la portada. Si lo dejas vacío, se mostrarán los últimos.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'post_type' => array(
				0 => 'proyecto',
			),
			'taxonomy' => '',
			'filters' => array(
				0 => 'search',
				1 => 'taxonomy',
			),
			'elements' => '',
			'min' => '',
			'max' => '',
			'return_format' => 'object',
		),
		array(
			'key' => 'field_home_featured_testimonials',
			'label' => 'Opiniones Destacadas',
			'name' => 'home_featured_testimonials',
			'type' => 'relationship',
			'instructions' => 'Selecciona y ordena las opiniones (testimonios) a mostrar (Máximo 6). Si lo dejas vacío, se mostrarán los últimos.',
			'required' => 0,
			'conditional_logic' => 0,
			'post_type' => array(
				0 => 'testimonio',
			),
			'filters' => array(
				0 => 'search',
			),
			'max' => 6,
			'return_format' => 'object',
		),
		array(
			'key' => 'field_home_featured_services',
			'label' => 'Servicios Destacados',
			'name' => 'home_featured_services',
			'type' => 'relationship',
			'instructions' => 'Selecciona y ordena los servicios a mostrar. Si lo dejas vacío, se mostrarán todos.',
			'required' => 0,
			'conditional_logic' => 0,
			'post_type' => array(
				0 => 'servicio',
			),
			'filters' => array(
				0 => 'search',
			),
			'return_format' => 'object',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'page_type',
				'operator' => '==',
				'value' => 'front_page',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_proyecto_testimonio',
	'title' => 'Testimonio Asociado',
	'fields' => array(
		array(
			'key' => 'field_testimonio_asociado',
			'label' => 'Testimonio del Cliente',
			'name' => 'testimonio_asociado',
			'type' => 'post_object',
			'instructions' => 'Selecciona un testimonio para mostrar en la página individual de este proyecto.',
			'required' => 0,
			'post_type' => array(
				0 => 'testimonio',
			),
			'return_format' => 'object',
			'ui' => 1,
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'proyecto',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'side',
	'style' => 'default',
));

acf_add_local_field_group(array(
	'key' => 'group_testimonio_meta',
	'title' => 'Datos del Testimonio',
	'fields' => array(
		array(
			'key' => 'field_testimonial_content',
			'label' => 'Reseña',
			'name' => 'testimonial_content',
			'type' => 'textarea',
		),
		array(
			'key' => 'field_testimonial_country',
			'label' => 'País / Empresa',
			'name' => 'testimonial_country',
			'type' => 'text',
		),
		array(
			'key' => 'field_testimonial_link',
			'label' => 'URL de Referencia (LinkedIn / Fiverr)',
			'name' => 'testimonial_link',
			'type' => 'url',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'testimonio',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
));

endif;

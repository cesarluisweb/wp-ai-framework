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
		array(
			'key' => 'field_home_featured_faq',
			'label' => 'Preguntas Frecuentes (FAQ) Destacadas',
			'name' => 'home_featured_faq',
			'type' => 'relationship',
			'instructions' => 'Selecciona y ordena las FAQs a mostrar. Si lo dejas vacío, se mostrarán todas.',
			'required' => 0,
			'conditional_logic' => 0,
			'post_type' => array(
				0 => 'faq',
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

acf_add_local_field_group(array(
	'key' => 'group_sobre_mi_page',
	'title' => 'Ajustes de Sobre Mí',
	'fields' => array(
		array(
			'key' => 'tab_sobre_mi_hero',
			'label' => 'Hero',
			'type' => 'tab',
		),
		array(
			'key' => 'field_sobre_mi_hero_kicker',
			'label' => 'Kicker',
			'name' => 'sobre_mi_hero_kicker',
			'type' => 'text',
		),
		array(
			'key' => 'field_sobre_mi_hero_headline_prefix',
			'label' => 'Titular (Prefijo)',
			'name' => 'sobre_mi_hero_headline_prefix',
			'type' => 'text',
		),
		array(
			'key' => 'field_sobre_mi_hero_headline_highlight',
			'label' => 'Titular (Destacado)',
			'name' => 'sobre_mi_hero_headline_highlight',
			'type' => 'text',
		),
		array(
			'key' => 'field_sobre_mi_hero_description',
			'label' => 'Descripción',
			'name' => 'sobre_mi_hero_description',
			'type' => 'textarea',
		),
		array(
			'key' => 'field_sobre_mi_metric_1_number',
			'label' => 'Métrica 1 (Número)',
			'name' => 'sobre_mi_metric_1_number',
			'type' => 'text',
		),
		array(
			'key' => 'field_sobre_mi_metric_1_label',
			'label' => 'Métrica 1 (Etiqueta)',
			'name' => 'sobre_mi_metric_1_label',
			'type' => 'text',
		),
		array(
			'key' => 'field_sobre_mi_metric_2_number',
			'label' => 'Métrica 2 (Número)',
			'name' => 'sobre_mi_metric_2_number',
			'type' => 'text',
		),
		array(
			'key' => 'field_sobre_mi_metric_2_label',
			'label' => 'Métrica 2 (Etiqueta)',
			'name' => 'sobre_mi_metric_2_label',
			'type' => 'text',
		),
		array(
			'key' => 'field_sobre_mi_metric_3_number',
			'label' => 'Métrica 3 (Número)',
			'name' => 'sobre_mi_metric_3_number',
			'type' => 'text',
		),
		array(
			'key' => 'field_sobre_mi_metric_3_label',
			'label' => 'Métrica 3 (Etiqueta)',
			'name' => 'sobre_mi_metric_3_label',
			'type' => 'text',
		),
		array(
			'key' => 'tab_sobre_mi_bio',
			'label' => 'Biografía',
			'type' => 'tab',
		),
		array(
			'key' => 'field_sobre_mi_bio_headline_prefix',
			'label' => 'Titular (Prefijo)',
			'name' => 'sobre_mi_bio_headline_prefix',
			'type' => 'text',
		),
		array(
			'key' => 'field_sobre_mi_bio_headline_highlight',
			'label' => 'Titular (Destacado)',
			'name' => 'sobre_mi_bio_headline_highlight',
			'type' => 'text',
		),
		array(
			'key' => 'field_sobre_mi_bio_text_1',
			'label' => 'Texto Principal',
			'name' => 'sobre_mi_bio_text_1',
			'type' => 'wysiwyg',
			'media_upload' => 0,
		),
		array(
			'key' => 'field_sobre_mi_bio_quote',
			'label' => 'Frase Destacada (Quote)',
			'name' => 'sobre_mi_bio_quote',
			'type' => 'textarea',
		),
		array(
			'key' => 'field_sobre_mi_bio_text_2',
			'label' => 'Texto Secundario',
			'name' => 'sobre_mi_bio_text_2',
			'type' => 'wysiwyg',
			'media_upload' => 0,
		),
		array(
			'key' => 'tab_sobre_mi_trayectoria',
			'label' => 'Trayectoria',
			'type' => 'tab',
		),
		array(
			'key' => 'field_sobre_mi_trayectoria_headline',
			'label' => 'Titular',
			'name' => 'sobre_mi_trayectoria_headline',
			'type' => 'text',
		),
		array(
			'key' => 'field_sobre_mi_trayectoria_1_period',
			'label' => 'Trayectoria 1 (Período)',
			'name' => 'sobre_mi_trayectoria_1_period',
			'type' => 'text',
		),
		array(
			'key' => 'field_sobre_mi_trayectoria_1_role',
			'label' => 'Trayectoria 1 (Rol)',
			'name' => 'sobre_mi_trayectoria_1_role',
			'type' => 'text',
		),
		array(
			'key' => 'field_sobre_mi_trayectoria_1_description',
			'label' => 'Trayectoria 1 (Descripción)',
			'name' => 'sobre_mi_trayectoria_1_description',
			'type' => 'textarea',
		),
		array(
			'key' => 'field_sobre_mi_trayectoria_2_period',
			'label' => 'Trayectoria 2 (Período)',
			'name' => 'sobre_mi_trayectoria_2_period',
			'type' => 'text',
		),
		array(
			'key' => 'field_sobre_mi_trayectoria_2_role',
			'label' => 'Trayectoria 2 (Rol)',
			'name' => 'sobre_mi_trayectoria_2_role',
			'type' => 'text',
		),
		array(
			'key' => 'field_sobre_mi_trayectoria_2_description',
			'label' => 'Trayectoria 2 (Descripción)',
			'name' => 'sobre_mi_trayectoria_2_description',
			'type' => 'textarea',
		),
		array(
			'key' => 'field_sobre_mi_trayectoria_3_period',
			'label' => 'Trayectoria 3 (Período)',
			'name' => 'sobre_mi_trayectoria_3_period',
			'type' => 'text',
		),
		array(
			'key' => 'field_sobre_mi_trayectoria_3_role',
			'label' => 'Trayectoria 3 (Rol)',
			'name' => 'sobre_mi_trayectoria_3_role',
			'type' => 'text',
		),
		array(
			'key' => 'field_sobre_mi_trayectoria_3_description',
			'label' => 'Trayectoria 3 (Descripción)',
			'name' => 'sobre_mi_trayectoria_3_description',
			'type' => 'textarea',
		),
		array(
			'key' => 'tab_sobre_mi_valores',
			'label' => 'Valores',
			'type' => 'tab',
		),
		array(
			'key' => 'field_sobre_mi_valores_headline',
			'label' => 'Titular',
			'name' => 'sobre_mi_valores_headline',
			'type' => 'text',
		),
		array(
			'key' => 'field_sobre_mi_valores_text',
			'label' => 'Texto de Valores',
			'name' => 'sobre_mi_valores_text',
			'type' => 'wysiwyg',
			'media_upload' => 0,
		),
		array(
			'key' => 'tab_sobre_mi_cta',
			'label' => 'Llamado a la Acción (CTA)',
			'type' => 'tab',
		),
		array(
			'key' => 'field_sobre_mi_cta_headline',
			'label' => 'Titular',
			'name' => 'sobre_mi_cta_headline',
			'type' => 'text',
		),
		array(
			'key' => 'field_sobre_mi_cta_subheadline',
			'label' => 'Subtítulo',
			'name' => 'sobre_mi_cta_subheadline',
			'type' => 'textarea',
		),
		array(
			'key' => 'field_sobre_mi_cta_btn_label',
			'label' => 'Etiqueta del Botón',
			'name' => 'sobre_mi_cta_btn_label',
			'type' => 'text',
		),
		array(
			'key' => 'field_sobre_mi_cta_btn_url',
			'label' => 'URL del Botón',
			'name' => 'sobre_mi_cta_btn_url',
			'type' => 'text',
		),
		array(
			'key' => 'field_sobre_mi_cta_guarantee',
			'label' => 'Garantía / Nota bajo el botón',
			'name' => 'sobre_mi_cta_guarantee',
			'type' => 'text',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'page_template',
				'operator' => '==',
				'value' => 'page-sobre-mi.php',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => array(
		0 => 'the_content',
	),
));

acf_add_local_field_group(array(
	'key' => 'group_global_hero_cta',
	'title' => 'Configuración de Página (Héroe y CTA)',
	'fields' => array(
		array('key' => 'field_hero_kicker', 'label' => 'Kicker (Subtítulo superior)', 'name' => 'hero_kicker', 'type' => 'text'),
		array('key' => 'field_hero_h1_normal', 'label' => 'H1 Texto Normal', 'name' => 'hero_h1_normal', 'type' => 'text'),
		array('key' => 'field_hero_h1_highlight', 'label' => 'H1 Texto Resaltado', 'name' => 'hero_h1_highlight', 'type' => 'text'),
		array('key' => 'field_hero_description', 'label' => 'Descripción del Héroe', 'name' => 'hero_description', 'type' => 'textarea', 'rows' => 3),
		array('key' => 'field_cta_kicker', 'label' => 'CTA Kicker', 'name' => 'cta_kicker', 'type' => 'text'),
		array('key' => 'field_cta_h2', 'label' => 'CTA Título', 'name' => 'cta_h2', 'type' => 'text'),
		array('key' => 'field_cta_description', 'label' => 'CTA Descripción', 'name' => 'cta_description', 'type' => 'textarea', 'rows' => 3),
		array('key' => 'field_cta_button_text', 'label' => 'CTA Botón Texto', 'name' => 'cta_button_text', 'type' => 'text'),
		array('key' => 'field_cta_button_url', 'label' => 'CTA Botón URL', 'name' => 'cta_button_url', 'type' => 'text'),
	),
	'location' => array(
		array(array('param' => 'page_template', 'operator' => '==', 'value' => 'page-servicios.php')),
		array(array('param' => 'page_template', 'operator' => '==', 'value' => 'page-portafolio.php')),
		array(array('param' => 'page_template', 'operator' => '==', 'value' => 'page-blog.php')),
		array(array('param' => 'page_template', 'operator' => '==', 'value' => 'page-contacto.php')),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
));

acf_add_local_field_group(array(
	'key' => 'group_servicios_contenido',
	'title' => 'Contenido Servicios',
	'fields' => array(
		array('key' => 'field_servicios_para_ti', 'label' => 'Esto es para ti (Una por línea)', 'name' => 'servicios_para_ti', 'type' => 'textarea', 'rows' => 5),
		array('key' => 'field_servicios_no_para_ti', 'label' => 'Esto NO es para ti (Una por línea)', 'name' => 'servicios_no_para_ti', 'type' => 'textarea', 'rows' => 5),
		array('key' => 'field_servicios_proceso_1_titulo', 'label' => 'Proceso Paso 1 Título', 'name' => 'servicios_proceso_1_titulo', 'type' => 'text'),
		array('key' => 'field_servicios_proceso_1_desc', 'label' => 'Proceso Paso 1 Descripción', 'name' => 'servicios_proceso_1_desc', 'type' => 'textarea', 'rows' => 2),
		array('key' => 'field_servicios_proceso_2_titulo', 'label' => 'Proceso Paso 2 Título', 'name' => 'servicios_proceso_2_titulo', 'type' => 'text'),
		array('key' => 'field_servicios_proceso_2_desc', 'label' => 'Proceso Paso 2 Descripción', 'name' => 'servicios_proceso_2_desc', 'type' => 'textarea', 'rows' => 2),
		array('key' => 'field_servicios_proceso_3_titulo', 'label' => 'Proceso Paso 3 Título', 'name' => 'servicios_proceso_3_titulo', 'type' => 'text'),
		array('key' => 'field_servicios_proceso_3_desc', 'label' => 'Proceso Paso 3 Descripción', 'name' => 'servicios_proceso_3_desc', 'type' => 'textarea', 'rows' => 2),
	),
	'location' => array(
		array(array('param' => 'page_template', 'operator' => '==', 'value' => 'page-servicios.php')),
	),
	'menu_order' => 1,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
));

acf_add_local_field_group(array(
	'key' => 'group_contacto_faq',
	'title' => 'Configuración Contacto',
	'fields' => array(
		array('key' => 'field_contacto_faq_titulo', 'label' => 'FAQ Título', 'name' => 'contacto_faq_titulo', 'type' => 'text'),
		array('key' => 'field_contacto_faq_desc', 'label' => 'FAQ Descripción', 'name' => 'contacto_faq_desc', 'type' => 'textarea', 'rows' => 2),
	),
	'location' => array(
		array(array('param' => 'page_template', 'operator' => '==', 'value' => 'page-contacto.php')),
	),
	'menu_order' => 1,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
));

endif;

<?php

// ============================================
// THEME SUPPORT
// ============================================
add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form','comment-form','comment-list','gallery','caption','style','script']);
});

// ============================================
// REGISTER CUSTOM POST TYPE: PELICULA
// ============================================
add_action('init', function () {
    register_post_type('pelicula', [
        'labels' => [
            'name'          => 'Películas',
            'singular_name' => 'Película',
        ],
        'public'       => true,
        'has_archive'  => true,
        'show_in_rest' => true,
        'supports'     => ['title', 'editor', 'thumbnail', 'custom-fields'],
        'menu_icon'    => 'dashicons-video-alt',
    ]);
});

// ============================================
// ENQUEUE STYLES & SCRIPTS
// ============================================
add_action('wp_enqueue_scripts', function () {
    $theme_dir = get_template_directory();
    $theme_uri = get_template_directory_uri();

    // CSS desde Vite (dist/)
    $css_path = '/dist/main.css';
    if (file_exists($theme_dir . $css_path)) {
        wp_enqueue_style(
            'tailwind-main',
            $theme_uri . $css_path,
            [],
            filemtime($theme_dir . $css_path)
        );
    }

    // JS desde Vite (dist/)
    $js_path = '/dist/main.js';
    if (file_exists($theme_dir . $js_path)) {
        wp_enqueue_script(
            'app',
            $theme_uri . $js_path,
            [],
            filemtime($theme_dir . $js_path),
            true // en footer
        );
    }
});

// ============================================
// ACF FIELDS (si no tienes plugin ACF)
// ============================================
if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group([
        'key'      => 'group_pelicula',
        'title'    => 'Datos de la Película',
        'fields'   => [
            [
                'key'        => 'field_titol',
                'name'       => 'titol',
                'label'      => 'Título',
                'type'       => 'text',
                'required'   => true,
            ],
            [
                'key'        => 'field_imatge',
                'name'       => 'imatge',
                'label'      => 'Imagen (URL)',
                'type'       => 'text',
                'required'   => true,
            ],
            [
                'key'        => 'field_edat',
                'name'       => 'edat',
                'label'      => 'Edad mínima',
                'type'       => 'number',
                'required'   => true,
            ],
            [
                'key'        => 'field_etiquetes',
                'name'       => 'etiquetes',
                'label'      => 'Etiquetas (#arte #musica)',
                'type'       => 'text',
            ],
            [
                'key'        => 'field_descripcio',
                'name'       => 'descripcio',
                'label'      => 'Descripción',
                'type'       => 'textarea',
            ],
            [
                'key'        => 'field_valor_ludic',
                'name'       => 'valor_ludic',
                'label'      => 'Valor Lúdico (0-100)',
                'type'       => 'range',
                'min'        => 0,
                'max'        => 100,
                'step'       => 1,
            ],
            [
                'key'        => 'field_valor_cultural',
                'name'       => 'valor_cultural',
                'label'      => 'Valor Cultural (0-100)',
                'type'       => 'range',
                'min'        => 0,
                'max'        => 100,
                'step'       => 1,
            ],
            [
                'key'        => 'field_valor_educatiu',
                'name'       => 'valor_educatiu',
                'label'      => 'Valor Educativo (0-100)',
                'type'       => 'range',
                'min'        => 0,
                'max'        => 100,
                'step'       => 1,
            ],
            [
                'key'        => 'field_valor_artistic',
                'name'       => 'valor_artistic',
                'label'      => 'Valor Artístico (0-100)',
                'type'       => 'range',
                'min'        => 0,
                'max'        => 100,
                'step'       => 1,
            ],
            [
                'key'        => 'field_temes',
                'name'       => 'temes',
                'label'      => 'Temas (separados por comas)',
                'type'       => 'textarea',
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'pelicula',
                ],
            ],
        ],
    ]);
}
?>
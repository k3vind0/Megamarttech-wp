<?php
function megamarttech_enqueue_scripts() {
    // Encolar la hoja principal ubicada en /css/style.css (separada del style.css de cabecera)
    $css_path = get_template_directory() . '/css/style.css';
    if ( file_exists( $css_path ) ) {
        wp_enqueue_style('megamarttech-style', get_template_directory_uri() . '/css/style.css', array(), filemtime( $css_path ));
    } else {
        // Fallback al style.css raíz si no existe
        wp_enqueue_style('megamarttech-style', get_stylesheet_uri(), array(), time());
    }
    // Theme JS (theme toggles, helpers)
    wp_enqueue_script('megamarttech-theme-js', get_template_directory_uri() . '/js/theme.js', array(), filemtime( get_template_directory() . '/js/theme.js' ), true );

    // Cart frontend logic (localStorage cart for demo / client-side)
    wp_enqueue_script('megamarttech-cart-js', get_template_directory_uri() . '/js/cart.js', array(), filemtime( get_template_directory() . '/js/cart.js' ), true );
}
add_action('wp_enqueue_scripts', 'megamarttech_enqueue_scripts');

function megamarttech_setup() {
    // Soporte básico y avanzado para WooCommerce
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
    
    // Soporte para funciones nativas de WordPress
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'megamarttech_setup');

/**
 * COMPATIBILIDAD CON CONTRASEÑAS BCRYPT DE LARAVEL (FASE 3)
 * Permite que los usuarios migrados de Laravel inicien sesión con sus contraseñas originales
 */
function megamarttech_check_laravel_bcrypt_password($check, $password, $hash, $user_id) {
    // Si la validación de WP falla y el hash empieza con $2y$ (formato Bcrypt de Laravel)
    if ( ! $check && strpos( $hash, '$2y$' ) === 0 ) {
        if ( password_verify( $password, $hash ) ) {
            $check = true;
            // Opcional: Re-hashear la contraseña al formato nativo de WordPress si quieres que se actualice sola
            // wp_set_password( $password, $user_id );
        }
    }
    return $check;
}
add_filter('check_password', 'megamarttech_check_laravel_bcrypt_password', 10, 4);

/**
 * 1. Adaptar Campos de Formularios de WooCommerce a Bootstrap 5 (Fase 2)

 * Esto afectará al Checkout, Mi Cuenta y cualquier formulario generado por Woo
 */
function megamarttech_bootstrap_woo_fields($args, $key, $value) {
    // Añadimos la clase 'form-control' a los inputs y textareas
    if($args['type'] !== 'checkbox' && $args['type'] !== 'radio') {
        $args['input_class'][] = 'form-control';
    }
    // Aseguramos que la etiqueta no flote mal
    $args['label_class'][] = 'form-label fw-bold mt-2';
    
    return $args;
}
add_filter('woocommerce_form_field_args', 'megamarttech_bootstrap_woo_fields', 10, 3);

/**
 * 2. Adaptar Botones de WooCommerce a Bootstrap 5
 * Convierte botones grises nativos al diseño primario/outline
 */
function megamarttech_bootstrap_woo_buttons() {
    echo '<style>
        .woocommerce button.button.alt, 
        .woocommerce-page button.button.alt,
        .woocommerce a.button.alt,
        .woocommerce input.button.alt {
            background-color: #0d6efd !important;
            color: #fff !important;
            border-radius: 50rem !important;
            padding: 0.5rem 1.5rem !important;
            border: none;
        }
        .woocommerce button.button.alt:hover {
            background-color: #0b5ed7 !important;
        }
        .woocommerce-cart .wc-proceed-to-checkout a.checkout-button {
            display: block;
            width: 100%;
            text-align: center;
        }
        .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button {
            border-radius: 50rem !important;
            padding: 0.5rem 1.5rem;
        }
    </style>';
}
add_action('wp_head', 'megamarttech_bootstrap_woo_buttons', 999);

/**
 * 3. AJAX handler para añadir productos personalizados al carrito de WooCommerce
 * Útil para los botones data-buy-btn en páginas estáticas (auriculares, teclados, etc.)
 */
function megamarttech_ajax_add_to_cart() {
    $product_sku = sanitize_text_field( $_POST['product_sku'] ?? '' );
    $product_name = sanitize_text_field( $_POST['product_name'] ?? '' );
    
    if ( empty( $product_sku ) && empty( $product_name ) ) {
        wp_send_json_error( array( 'message' => 'No product data provided' ) );
    }
    
    // Try to find product by SKU first, then by name
    $product_id = 0;
    if ( ! empty( $product_sku ) ) {
        $product_id = wc_get_product_id_by_sku( $product_sku );
    }
    
    if ( ! $product_id && ! empty( $product_name ) ) {
        // Try to find by name
        $products = wc_get_products( array( 'name' => $product_name, 'limit' => 1 ) );
        if ( ! empty( $products ) ) {
            $product_id = $products[0]->get_id();
        }
    }
    
    if ( ! $product_id ) {
        // Product not found in WooCommerce, create a simple product
        $product = new WC_Product_Simple();
        $product->set_name( $product_name );
        $product->set_status( 'publish' );
        $product->set_catalog_visibility( 'visible' );
        $product->set_price( floatval( $_POST['product_price'] ?? 0 ) );
        $product->set_regular_price( floatval( $_POST['product_price'] ?? 0 ) );
        if ( ! empty( $product_sku ) ) {
            $product->set_sku( $product_sku );
        }
        $product_id = $product->save();
    }
    
    if ( $product_id ) {
        WC()->cart->add_to_cart( $product_id, 1 );
        wp_send_json_success( array( 'product_id' => $product_id, 'message' => 'Product added to cart' ) );
    } else {
        wp_send_json_error( array( 'message' => 'Could not find or create product' ) );
    }
}
add_action( 'wp_ajax_add_to_cart_via_ajax', 'megamarttech_ajax_add_to_cart' );
add_action( 'wp_ajax_nopriv_add_to_cart_via_ajax', 'megamarttech_ajax_add_to_cart' );

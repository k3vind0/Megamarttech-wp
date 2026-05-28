<?php
/**
 * SCRIPT DE MIGRACIÓN: LARAVEL A WORDPRESS / WOOCOMMERCE
 * Este script lee las tablas 'users' y 'products' de la base de datos de Laravel,
 * insertando nativamente los registros dentro del sistema de WordPress.
 */

// 1. Cargar el entorno de WordPress para tener acceso a sus funciones (wp_insert_post, wp_insert_user, etc.)
require_once( __DIR__ . '/wp-load.php' );

// 2. Configurar la conexión a la base de datos antigua de Laravel
// ¡ATENCIÓN! Cambia estos datos por las credenciales reales de tu DB de Laravel
$laravel_db_host = '127.0.0.1';
$laravel_db_name = 'nombre_bd_laravel';
$laravel_db_user = 'root';
$laravel_db_pass = '';

try {
    $pdo = new PDO("mysql:host=$laravel_db_host;dbname=$laravel_db_name;charset=utf8", $laravel_db_user, $laravel_db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<h2>Conexión exitosa a la base de datos de Laravel. Comenzando la migración...</h2>";
} catch (PDOException $e) {
    die("Error al conectar con la base de datos de Laravel: " . $e->getMessage() . " - Por favor configura las credenciales en este archivo.");
}

global $wpdb;

echo "<h3>--- MIGRACIÓN DE USUARIOS ---</h3>";

// 3. Consultar usuarios en Laravel
$stmtUsers = $pdo->query("SELECT * FROM users");
$users = $stmtUsers->fetchAll(PDO::FETCH_ASSOC);

$count_users = 0;
foreach ($users as $u) {
    // Verificar si el correo ya existe en WP
    if ( email_exists($u['email']) ) {
        echo "<p style='color:orange;'>El usuario con email {$u['email']} ya existe en WordPress. Saltando...</p>";
        continue;
    }

    // Convertir tu lógica de roles de Laravel ('admin', 'user') a los de WordPress ('administrator', 'customer')
    $wp_role = (isset($u['role']) && $u['role'] == 'admin') ? 'administrator' : 'customer';
    
    // Obtener nombre (si está dividido o solo en campo 'name')
    $name_parts = explode(' ', $u['name'] ?? 'Usuario');
    $first_name = $name_parts[0];
    $last_name = isset($name_parts[1]) ? $name_parts[1] : '';

    // Crear el arreglo de datos del usuario
    $userdata = array(
        'user_login' => $u['email'], // O puedes usar su nombre sin espacios
        'user_email' => $u['email'],
        'first_name' => $first_name,
        'last_name'  => $last_name,
        'user_pass'  => wp_generate_password(24), // Password temporal para evitar que wp_insert_user rompa el hash de Laravel
        'role'       => $wp_role
    );

    // Insertar el usuario en WP
    $user_id = wp_insert_user( $userdata );

    if ( ! is_wp_error( $user_id ) ) {
        // Inyectar manualmente el hash Bcrypt de Laravel a la base de datos de WP
        // Sin esto, wp_insert_user destruiría el formato del hash.
        $wpdb->update( 
            $wpdb->users, 
            array( 'user_pass' => $u['password'] ), 
            array( 'ID' => $user_id ) 
        );
        echo "<p style='color:green;'>Usuario migrado: {$u['email']} (Rol: {$wp_role})</p>";
        $count_users++;
    } else {
        echo "<p style='color:red;'>Error al crear usuario {$u['email']}: " . $user_id->get_error_message() . "</p>";
    }
}


echo "<h3>--- MIGRACIÓN DE PRODUCTOS ---</h3>";

// 4. Consultar productos en Laravel
// Asumo columnas comunes de un e-commerce a medida (name, description, price, stock, image). 
// Modifica los nombres de los atributos $p['columna'] por los exactos que usaste en Laravel.
$stmtProducts = $pdo->query("SELECT * FROM products");
$products = $stmtProducts->fetchAll(PDO::FETCH_ASSOC);

$count_products = 0;
foreach ($products as $p) {
    // Si ya existe un producto con el mismo nombre, prevenir duplicados
    $existing_product = get_page_by_title( $p['name'] ?? 'Producto Desconocido', OBJECT, 'product' );
    if ( $existing_product ) {
        echo "<p style='color:orange;'>El producto '{$p['name']}' ya existe. Saltando...</p>";
        continue;
    }

    // Crear la estructura de Post/Product de WP
    $post = array(
        'post_author'  => 1, // Asignar al Admin principal
        'post_content' => $p['description'] ?? '',
        'post_status'  => 'publish',
        'post_title'   => $p['name'] ?? 'Producto Nuevo',
        'post_name'    => sanitize_title( $p['name'] ?? 'Producto Nuevo' ),
        'post_type'    => 'product',
        'post_parent'  => '',
        'menu_order'   => 0
    );

    // Insertar producto en WP (Tabla wp_posts)
    $product_id = wp_insert_post( $post );

    if ( $product_id ) {
        // Asignar que es un "Producto Simple" en la taxonomía
        wp_set_object_terms( $product_id, 'simple', 'product_type' );

        // Inyectar los datos en los Metaatos que requiere WooCommerce (Tabla wp_postmeta)
        
        $price = (float)($p['price'] ?? 0);
        
        // Atributos obligatorios para la visibilidad en tienda
        update_post_meta( $product_id, '_visibility', 'visible' );
        update_post_meta( $product_id, '_stock_status', 'instock');
        
        // Control de inventario (Si lo tenías en Laravel)
        if(isset($p['stock'])) {
            update_post_meta( $product_id, '_manage_stock', 'yes' );
            update_post_meta( $product_id, '_stock', $p['stock'] );
        }
        
        // Precios
        update_post_meta( $product_id, '_price', $price );
        update_post_meta( $product_id, '_regular_price', $price );
        
        // Descuentos (Si tienes un campo 'discount_price' en Laravel, puedes migrarlo)
        if ( isset($p['discount_price']) && $p['discount_price'] > 0 && $p['discount_price'] < $price ) {
            update_post_meta( $product_id, '_sale_price', $p['discount_price'] );
            update_post_meta( $product_id, '_price', $p['discount_price'] ); // WooCommerce setea siempre el _price activo al menor
        }
        
        echo "<p style='color:green;'>Producto migrado: {$post['post_title']}</p>";
        $count_products++;
    }
}

echo "<h3>Migración Finalizada!</h3>";
echo "<h4>Usuarios Exitosos: {$count_users}</h4>";
echo "<h4>Productos Exitosos: {$count_products}</h4>";
echo "<h5>Asegúrate de eliminar este archivo (migrador-laravel-wp.php) por seguridad y privacidad luego de finalizar.</h5>";
?>
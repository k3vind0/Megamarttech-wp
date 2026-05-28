<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() . '/css/style.css' ); ?>" />
    <?php wp_head(); ?>
</head>
<body <?php body_class('bg-light d-flex flex-column min-vh-100'); ?>>
<header>
        <!-- Barra de anuncio superior -->
        <div class="bg-primary text-white py-1 px-3 d-flex justify-content-between align-items-center"
            style="font-size:0.8rem;">
            <span>¡Bienvenido a MegaMartTech mundial!</span>
            <div class="d-flex gap-3">
                <span><i class="bi bi-geo-alt me-1"></i>Entregar a 423651</span>
                <span><i class="bi bi-truck me-1"></i>Rastrear pedido</span>
                <span><i class="bi bi-tag me-1"></i>Todas las Ofertas</span>
            </div>
        </div>

        <!-- Navbar principal -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white py-2 border-bottom shadow-sm">
            <div class="container align-items-center">
                <a class="navbar-brand text-primary fs-3 me-auto d-flex align-items-center gap-2" href="<?php echo home_url('/'); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/imagenes/logo.png" alt="Logo MegaMartTech" height="40">
                    MegaMartTech
                </a>
                
                <!-- Barra de búsqueda para desktop -->
                <div class="d-none d-lg-flex flex-grow-1 mx-4">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                        <input class="form-control border-start-0 ps-0" type="search" placeholder="Buscar teléfonos, laptops y más...">
                    </div>
                </div>

                <div class="d-flex gap-3 align-items-center">
                    <!-- Icono de búsqueda para móvil -->
                    <a href="#" class="text-decoration-none text-dark d-lg-none d-flex align-items-center gap-1" data-bs-toggle="collapse" data-bs-target="#mobileSearch" aria-expanded="false" aria-controls="mobileSearch">
                        <i class="bi bi-search fs-5"></i>
                    </a>

                    <a href="<?php echo esc_url( home_url('/?page_id=18/') ); ?>" class="text-decoration-none text-primary d-flex align-items-center gap-1 border border-primary rounded-pill px-3 py-1 bg-primary bg-opacity-10">
                        <i class="bi bi-info-circle-fill fs-6"></i>
                        <span class="d-none d-lg-inline small fw-bold">Nosotros</span>
                    </a>
                    
                    <?php
                    // Obtener URLs con fallbacks seguros
                    $nosotros_url = home_url('/?page_id=18/');
                    $login_url = home_url('/?page_id=10/');
                    $cart_url = '#';
                    if ( function_exists('wc_get_cart_url') ) {
                        $cu = wc_get_cart_url();
                        if ( !empty($cu) ) $cart_url = $cu;
                    }
                    ?>
                    <?php if ( is_user_logged_in() ) :
                        $current_user = wp_get_current_user(); ?>
                        <a href="<?php echo esc_url( admin_url('profile.php') ); ?>" class="text-decoration-none text-dark d-flex align-items-center gap-1">
                            <i class="bi bi-person-circle fs-5"></i>
                            <span class="d-none d-lg-inline small">Hola, <?php echo esc_html( $current_user->display_name ?: $current_user->user_login ); ?></span>
                        </a>
                        <a href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>" class="text-decoration-none text-danger d-flex align-items-center gap-1 ms-2 d-none d-lg-flex">
                            <i class="bi bi-box-arrow-right fs-5"></i>
                            <span class="small">Salir</span>
                        </a>
                    <?php else : ?>
                        <a href="<?php echo esc_url( $login_url ); ?>" class="text-decoration-none text-dark d-flex align-items-center gap-1">
                            <i class="bi bi-person fs-5"></i>
                            <span class="d-none d-lg-inline small">Registrarse / Iniciar Sesión</span>
                        </a>
                    <?php endif; ?>
                    <a href="<?php echo esc_url( $cart_url ); ?>" class="text-decoration-none text-dark d-flex align-items-center gap-1">
                        <span class="position-relative d-inline-block">
                            <i class="bi bi-cart fs-5"></i>
                            <span data-cart-count class="badge bg-danger rounded-circle" style="display:none; font-size:0.65rem; position: absolute; top: -8px; right: -10px; padding:4px 6px;"></span>
                        </span>
                        <span class="d-none d-lg-inline small">Carrito</span>
                    </a>
                </div>
            </div>
        </nav>
        
        <!-- Contenedor colapsable de búsqueda para móvil -->
        <div class="collapse d-lg-none border-bottom px-3 py-2 bg-light" id="mobileSearch">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                <input class="form-control border-start-0 ps-0" type="search" placeholder="Buscar...">
            </div>
        </div>

        <!-- Barra de categorías centrada -->
        <nav class="navbar navbar-expand-lg bg-white border-bottom shadow-sm py-1">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#categoriesNav" aria-controls="categoriesNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="categoriesNav">
                    <ul class="navbar-nav gap-1 flex-wrap">
                        <li class="nav-item dropdown">
                            <a class="btn btn-primary text-white rounded-pill px-3 py-1 dropdown-toggle fw-semibold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size:0.85rem;">
                                <i class="bi bi-controller me-1"></i>Accesorios Inteligentes
                            </a>
                            <ul class="dropdown-menu shadow border-0">
                                <li><a class="dropdown-item" href="<?php echo esc_url( home_url('/?page_id=20/') ); ?>"><i class="bi bi-headset me-2 text-primary"></i>Auriculares</a></li>
                                <li><a class="dropdown-item" href="<?php echo esc_url( home_url('/?page_id=24/') ); ?>"><i class="bi bi-keyboard me-2 text-primary"></i>Teclados</a></li>
                                <li><a class="dropdown-item" href="<?php echo esc_url( home_url('/?page_id=22/') ); ?>"><i class="bi bi-mouse me-2 text-primary"></i>Ratones y Alfombrillas</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link btn btn-outline-secondary rounded-pill px-3 py-1 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size:0.85rem;">
                                Laptops & Computadoras
                            </a>
                            <ul class="dropdown-menu shadow border-0">
                                <li><a class="dropdown-item" href="#">Laptops Gaming</a></li>
                                <li><a class="dropdown-item" href="#">Estaciones de trabajo</a></li>
                                <li><a class="dropdown-item" href="#">Monitores</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link btn btn-outline-secondary rounded-pill px-3 py-1 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size:0.85rem;">
                                Teléfonos Móviles
                            </a>
                            <ul class="dropdown-menu shadow border-0">
                                <li><a class="dropdown-item" href="#">Gama Alta</a></li>
                                <li><a class="dropdown-item" href="#">Gama Media</a></li>
                                <li><a class="dropdown-item" href="#">Económicos</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link btn btn-outline-secondary rounded-pill px-3 py-1 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size:0.85rem;">
                                Nube & Redes
                            </a>
                            <ul class="dropdown-menu shadow border-0">
                                <li><a class="dropdown-item" href="#">Servicios en la Nube</a></li>
                                <li><a class="dropdown-item" href="#">Routers</a></li>
                                <li><a class="dropdown-item" href="#">Servidores</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link btn btn-outline-secondary rounded-pill px-3 py-1 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size:0.85rem;">
                                Software & Des.
                            </a>
                            <ul class="dropdown-menu shadow border-0">
                                <li><a class="dropdown-item" href="#">Herramientas Dev</a></li>
                                <li><a class="dropdown-item" href="#">Productividad</a></li>
                                <li><a class="dropdown-item" href="#">Licencias</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link btn btn-outline-secondary rounded-pill px-3 py-1 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size:0.85rem;">
                                Accesorios
                            </a>
                            <ul class="dropdown-menu shadow border-0">
                                <li><a class="dropdown-item" href="#">Cargadores</a></li>
                                <li><a class="dropdown-item" href="#">Cables</a></li>
                                <li><a class="dropdown-item" href="#">Almacenamiento</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link btn btn-outline-secondary rounded-pill px-3 py-1 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size:0.85rem;">
                                Hogar Inteligente
                            </a>
                            <ul class="dropdown-menu shadow border-0">
                                <li><a class="dropdown-item" href="#">IoT</a></li>
                                <li><a class="dropdown-item" href="#">Seguridad</a></li>
                                <li><a class="dropdown-item" href="#">Automatización</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
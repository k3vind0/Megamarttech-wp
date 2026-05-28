<?php get_header(); ?>
<main>
        <!-- Carrusel principal -->
        <section class="mb-4">
            <div id="carouselPrincipal" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselPrincipal" data-bs-slide-to="0" class="active"
                        aria-current="true"></button>
                    <button type="button" data-bs-target="#carouselPrincipal" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#carouselPrincipal" data-bs-slide-to="2"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="<?php echo get_template_directory_uri(); ?>/imagenes/C1.png" class="d-block w-100" alt="Slide 1"
                            style="max-height:480px; object-fit:cover;">
                        <div class="carousel-caption d-none d-md-block text-start ps-5">
                            <p class="text-white mb-1">Mejor oferta en línea en relojes inteligentes</p>
                            <h2 class="fw-bold display-5 text-white">WEARABLE INTELIGENTE.</h2>
                             <p class="fs-5 fw-semibold text-white">HASTA 80% DE DESCUENTO</p>
                            <a href="#" class="btn btn-primary rounded-pill px-4">Comprar Ahora</a>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="<?php echo get_template_directory_uri(); ?>/imagenes/C2.png" class="d-block w-100" alt="Slide 2"
                            style="max-height:480px; object-fit:cover;">
                        <div class="carousel-caption d-none d-md-block text-start ps-5">
                            <p class="text-white-50 mb-1">Últimos modelos disponibles</p>
                            <h2 class="fw-bold display-5 text-white">TELÉFONOS INTELIGENTES.</h2>
                            <p class="fs-5 fw-semibold text-white">HASTA 60% DE DESCUENTO</p>
                            <a href="#" class="btn btn-primary rounded-pill px-4">Comprar Ahora</a>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="<?php echo get_template_directory_uri(); ?>/imagenes/C3.png" class="d-block w-100" alt="Slide 3"
                            style="max-height:480px; object-fit:cover;">
                        <div class="carousel-caption d-none d-md-block text-start ps-5">
                            <p class="text-white-50 mb-1">Las mejores marcas a los precios más bajos</p>
                            <h2 class="fw-bold display-5 text-white">ELECTRÓNICA.</h2>
                            <p class="fs-5 fw-semibold text-white">HASTA 70% DE DESCUENTO</p>
                            <a href="#" class="btn btn-primary rounded-pill px-4">Comprar Ahora</a>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselPrincipal"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-primary rounded-circle p-3"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselPrincipal"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-primary rounded-circle p-3"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>

        
<!-- Sección Nuestros Productos Dinámicos -->
<section class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0 fs-4">Aprovecha la mejor oferta en <span class="text-primary">Productos</span></h5>
        <a href="<?php echo wc_get_page_permalink('shop'); ?>" class="text-primary text-decoration-none fw-semibold">Ver Todo <i class="bi bi-chevron-right"></i></a>
    </div>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-3">
    <?php
    if (class_exists('WooCommerce')):
        $args = array( 'post_type' => 'product', 'posts_per_page' => 10, 'status' => 'publish' );
        $loop = new WP_Query( $args );
        if ( $loop->have_posts() ) :
            while ( $loop->have_posts() ) : $loop->the_post();
                global $product;
                if(!$product) continue;
                $currency = get_woocommerce_currency_symbol();
                $title    = get_the_title();
                $img_url  = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'medium') : wc_placeholder_img_src();
                $link     = get_the_permalink();
                $is_on_sale = $product->is_on_sale();
                $reg_price = (float)$product->get_regular_price();
                $sale_price = (float)$product->get_sale_price();
                $price = $product->get_price();
                $saved = 0; $pct = 0;
                if ($is_on_sale && $reg_price > 0) {
                    $saved = $reg_price - $sale_price;
                    $pct = round(($saved / $reg_price) * 100);
                }
    ?>
    <div class="col">
        <div class="card h-100 border-0 shadow-sm position-relative card-hover">
            <?php if ($is_on_sale && $reg_price > 0) : ?>
                <span class="badge bg-primary position-absolute top-0 end-0 m-2 rounded-pill"><?php echo $pct; ?>% OFF</span>
            <?php endif; ?>
            
            <a href="<?php echo esc_url($link); ?>">
                <img src="<?php echo esc_url($img_url); ?>" class="card-img-top p-3" alt="<?php echo esc_attr($title); ?>" style="height: 180px; object-fit: contain;">
            </a>
            <div class="card-body pt-0 px-3 pb-3">
                <p class="card-title small fw-semibold mb-1 text-dark"><?php echo esc_html($title); ?></p>
                <div class="d-flex gap-2 align-items-center mb-1">
                    <?php if ($is_on_sale) : ?>
                        <span class="fw-bold text-dark"><?php echo $currency.number_format($sale_price, 2); ?></span>
                        <span class="text-muted text-decoration-line-through small"><?php echo $currency.number_format($reg_price, 2); ?></span>
                    <?php else : ?>
                        <span class="fw-bold text-dark"><?php echo $currency.number_format($price, 2); ?></span>
                    <?php endif; ?>
                </div>
                <?php if ($is_on_sale && $reg_price > 0) : ?>
                    <small class="text-success fw-semibold">Guarda <?php echo $currency.number_format($saved, 2); ?></small>
                <?php else: ?>
                    <small class="text-transparent px-1">&nbsp;</small>
                <?php endif; ?>
                <div class="mt-2 text-center">
                    <a href="?add-to-cart=<?php echo $product->get_id(); ?>" class="btn btn-sm btn-outline-primary w-100 rounded-pill ajax_add_to_cart" data-quantity="1" data-product_id="<?php echo $product->get_id(); ?>">Agregar</a>
                </div>
            </div>
        </div>
    </div>
    <?php endwhile; wp_reset_postdata(); else: echo '<p class="w-100 text-center py-4 bg-white rounded shadow-sm">No hay productos en tienda aún.</p>'; endif; endif; ?>
</div>
</section>

<!-- Sección Top Categories -->
        <section class="container my-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0 fs-4">Compra desde <span class="text-primary">Categorías Principales</span></h5>
                <a href="#" class="text-primary text-decoration-none fw-semibold">Ver Todo <i
                        class="bi bi-chevron-right"></i></a>
            </div>

            <div class="row row-cols-2 row-cols-md-4 row-cols-lg-7 g-3 text-center">

                <div class="col">
                    <div
                        class="categoria-circulo rounded-circle bg-white shadow-sm d-flex justify-content-center align-items-center mx-auto mb-2 border border-primary border-2">
                        <img src="<?php echo get_template_directory_uri(); ?>/imagenes/reloj1.png" alt="Mobile" class="img-fluid p-2">
                    </div>
                    <small class="fw-semibold text-dark">Móviles</small>
                </div>

                <div class="col">
                    <div
                        class="categoria-circulo rounded-circle bg-white shadow-sm d-flex justify-content-center align-items-center mx-auto mb-2">
                        <img src="<?php echo get_template_directory_uri(); ?>/imagenes/reloj1.png" alt="Cosmetics" class="img-fluid p-2">
                    </div>
                    <small class="fw-semibold text-dark">Cosméticos</small>
                </div>

                <div class="col">
                    <div
                        class="categoria-circulo rounded-circle bg-white shadow-sm d-flex justify-content-center align-items-center mx-auto mb-2">
                        <img src="<?php echo get_template_directory_uri(); ?>/imagenes/reloj1.png" alt="Electrónica" class="img-fluid p-2">
                    </div>
                    <small class="fw-semibold text-dark">Electrónica</small>
                </div>

                <div class="col">
                    <div
                        class="categoria-circulo rounded-circle bg-white shadow-sm d-flex justify-content-center align-items-center mx-auto mb-2">
                        <img src="<?php echo get_template_directory_uri(); ?>/imagenes/reloj1.png" alt="Muebles" class="img-fluid p-2">
                    </div>
                    <small class="fw-semibold text-dark">Muebles</small>
                </div>

            </div>
        </section>

        <!-- Sección Top Electronics Brands -->
        <section class="container my-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0 fs-4">Mejores Marcas de <span class="text-primary">Electrónica</span></h5>
                <a href="#" class="text-primary text-decoration-none fw-semibold">Ver Todo <i
                        class="bi bi-chevron-right"></i></a>
            </div>

            <div id="brandCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">

                    <div class="carousel-item active">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="card border-0 shadow-sm card-hover bg-dark text-white overflow-hidden">
                                    <img src="<?php echo get_template_directory_uri(); ?>/imagenes/C1.png" class="card-img" alt="iPhone"
                                        style="opacity:0.7; object-fit:cover; height:180px;">
                                    <div class="card-img-overlay d-flex flex-column justify-content-end p-3">
                                        <span class="badge bg-secondary mb-1 w-auto"
                                            style="width:fit-content!important">IPHONE</span>
                                        <p class="fw-bold mb-0 fs-5 text-white">HASTA 80% DE DESCUENTO</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-0 shadow-sm card-hover brand-card-warm overflow-hidden">
                                    <img src="<?php echo get_template_directory_uri(); ?>/imagenes/C2.png" class="card-img" alt="Realme"
                                        style="object-fit:cover; height:180px;">
                                    <div class="card-img-overlay d-flex flex-column justify-content-end p-3">
                                        <span class="badge bg-warning mb-1"
                                            style="width:fit-content">REALME</span>
                                        <p class="fw-bold mb-0 fs-5 text-white">HASTA 80% DE DESCUENTO</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-0 shadow-sm card-hover brand-card-peach overflow-hidden">
                                    <img src="<?php echo get_template_directory_uri(); ?>/imagenes/C3.png" class="card-img" alt="Xiaomi"
                                        style="object-fit:cover; height:180px;">
                                    <div class="card-img-overlay d-flex flex-column justify-content-end p-3">
                                        <span class="badge bg-danger text-white mb-1"
                                            style="width:fit-content">XIAOMI</span>
                                        <p class="fw-bold mb-0 fs-5 text-white">HASTA 80% DE DESCUENTO</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="card border-0 shadow-sm card-hover bg-dark text-white overflow-hidden">
                                    <img src="<?php echo get_template_directory_uri(); ?>/imagenes/C1.png" class="card-img" alt="Samsung"
                                        style="opacity:0.7; object-fit:cover; height:180px;">
                                    <div class="card-img-overlay d-flex flex-column justify-content-end p-3">
                                        <span class="badge bg-primary mb-1" style="width:fit-content">SAMSUNG</span>
                                        <p class="fw-bold mb-0 fs-5">HASTA 75% DE DESCUENTO</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-0 shadow-sm card-hover brand-card-warm overflow-hidden">
                                    <img src="<?php echo get_template_directory_uri(); ?>/imagenes/C2.png" class="card-img" alt="OnePlus"
                                        style="object-fit:cover; height:180px;">
                                    <div class="card-img-overlay d-flex flex-column justify-content-end p-3">
                                        <span class="badge bg-danger text-white mb-1"
                                            style="width:fit-content">ONEPLUS</span>
                                        <p class="fw-bold mb-0 fs-5">HASTA 65% DE DESCUENTO</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-0 shadow-sm card-hover brand-card-peach overflow-hidden">
                                    <img src="<?php echo get_template_directory_uri(); ?>/imagenes/C3.png" class="card-img" alt="Sony"
                                        style="object-fit:cover; height:180px;">
                                    <div class="card-img-overlay d-flex flex-column justify-content-end p-3">
                                        <span class="badge bg-dark text-white mb-1"
                                            style="width:fit-content">SONY</span>
                                        <p class="fw-bold mb-0 fs-5">HASTA 70% DE DESCUENTO</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Indicadores -->
                <div class="d-flex justify-content-center gap-2 mt-3">
                    <button type="button" data-bs-target="#brandCarousel" data-bs-slide-to="0"
                        class="btn btn-primary rounded-circle p-1" style="width:12px;height:12px;"></button>
                    <button type="button" data-bs-target="#brandCarousel" data-bs-slide-to="1"
                        class="btn btn-secondary rounded-circle p-1" style="width:12px;height:12px;"></button>
                </div>
            </div>
        </section>
        <section class="container my-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0 fs-4">Nuestra <span class="text-primary">Ubicación</span></h5>
                <a href="https://maps.google.com" target="_blank" class="text-primary text-decoration-none fw-semibold">
                    Cómo llegar <i class="bi bi-chevron-right"></i>
                </a>
            </div>

            <div class="row g-4 align-items-stretch">

                <!-- Info de contacto -->
                <div class="col-12 col-md-4">
                    <div class="card h-100 border-0 shadow-sm p-4">
                        <h6 class="fw-bold text-primary mb-3"><i class="bi bi-shop me-2"></i>MegaSell Tienda Principal
                        </h6>
                        <ul class="list-unstyled small">
                            <li class="mb-3">
                                <i class="bi bi-geo-alt-fill text-primary me-2"></i>
                                Av. Javier Prado Este 4200, Surco, Lima, Perú
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-clock-fill text-primary me-2"></i>
                                Lun - Sáb: 9:00am - 9:00pm<br>
                                <span class="ms-4">Dom: 10:00am - 6:00pm</span>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-telephone-fill text-primary me-2"></i>
                                +51 01 234-5678
                            </li>
                            <li>
                                <i class="bi bi-envelope-fill text-primary me-2"></i>
                                contacto@megasell.com
                            </li>
                        </ul>
                        <a href="https://maps.google.com" target="_blank"
                            class="btn btn-primary rounded-pill btn-sm mt-auto">
                            <i class="bi bi-map me-1"></i> Abrir en Google Maps
                        </a>
                    </div>
                </div>

                <!-- Mapa -->
                <div class="col-12 col-md-8">
                    <div class="rounded-3 overflow-hidden shadow-sm h-100" style="min-height: 350px;">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3901.1!2d-76.9748!3d-12.0853!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105c6e4a1234567%3A0xabcdef!2sAv.+Javier+Prado+Este+4200%2C+Lima!5e0!3m2!1ses!2spe!4v1234567890"
                            width="100%" height="100%" style="border:0; min-height:350px;" allowfullscreen=""
                            loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

            </div>
        </section>
    </main>
<?php get_footer(); ?>
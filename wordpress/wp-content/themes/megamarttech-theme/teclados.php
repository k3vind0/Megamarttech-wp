<?php 
/* Template Name: Teclados */
get_header(); 
?>
<main class="flex-grow-1">

        <h2 class="fw-bold mb-4"><i class="bi bi-keyboard text-primary me-2"></i>Teclados Gaming</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 card-hover">
                    <img src="<?php echo get_template_directory_uri(); ?>/imagenes/C1.png" class="card-img-top" alt="Teclado Mecánico" style="height: 250px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold">Teclado Mecánico Switch Blue</h5>
                        <p class="card-text text-muted">Switches ultra rápidos, carcasa de aluminio y RGB por tecla.</p>
                        <h4 class="text-primary fw-bold">$79.99</h4>
                        <button class="btn btn-primary w-100 mt-2" data-buy-btn
                            data-product-id="tec1"
                            data-product-name="Teclado Mecánico Switch Blue"
                            data-product-price="79.99"
                            data-product-image="<?php echo get_template_directory_uri(); ?>/imagenes/C1.png"
                            >Añadir al carrito</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 card-hover">
                    <img src="<?php echo get_template_directory_uri(); ?>/imagenes/C2.png" class="card-img-top" alt="Teclado Óptico" style="height: 250px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold">Teclado Óptico Pro</h5>
                        <p class="card-text text-muted">Tiempo de respuesta 0.2ms, diseño TKL 80%.</p>
                        <h4 class="text-primary fw-bold">$109.99</h4>
                        <button class="btn btn-primary w-100 mt-2" data-buy-btn
                            data-product-id="tec2"
                            data-product-name="Teclado Óptico Pro"
                            data-product-price="109.99"
                            data-product-image="<?php echo get_template_directory_uri(); ?>/imagenes/C2.png"
                            >Añadir al carrito</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 card-hover">
                    <img src="<?php echo get_template_directory_uri(); ?>/imagenes/C3.png" class="card-img-top" alt="Teclado Membrana" style="height: 250px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold">Teclado Híbrido Silencioso</h5>
                        <p class="card-text text-muted">Sensación mecánica con funcionamiento silencioso.</p>
                        <h4 class="text-primary fw-bold">$49.99</h4>
                        <button class="btn btn-primary w-100 mt-2" data-buy-btn
                            data-product-id="tec3"
                            data-product-name="Teclado Híbrido Silencioso"
                            data-product-price="49.99"
                            data-product-image="<?php echo get_template_directory_uri(); ?>/imagenes/C3.png"
                            >Añadir al carrito</button>
                    </div>
                </div>
            </div>
        </div>
    
</main>
<?php get_footer(); ?>
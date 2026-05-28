<?php 
/* Template Name: Ratones y Alfombrillas */
get_header(); 
?>
<main class="flex-grow-1">

        <h2 class="fw-bold mb-4"><i class="bi bi-mouse text-primary me-2"></i>Ratones y Alfombrillas</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 card-hover">
                    <img src="<?php echo get_template_directory_uri(); ?>/imagenes/C1.png" class="card-img-top" alt="Ratón 1" style="height: 250px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold">Ratón Gamer 16000 DPI</h5>
                        <p class="card-text text-muted">Sensor óptico de alta precisión, 8 botones programables.</p>
                        <h4 class="text-primary fw-bold">$59.99</h4>
                        <button class="btn btn-primary w-100 mt-2" data-buy-btn
                            data-product-id="rat1"
                            data-product-name="Ratón Gamer 16000 DPI"
                            data-product-price="59.99"
                            data-product-image="<?php echo get_template_directory_uri(); ?>/imagenes/C1.png"
                            >Añadir al carrito</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 card-hover">
                    <img src="<?php echo get_template_directory_uri(); ?>/imagenes/C2.png" class="card-img-top" alt="Ratón 2" style="height: 250px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold">Ratón Inalámbrico Ultra Ligero</h5>
                        <p class="card-text text-muted">Peso pluma, batería de larga duración, latencia cero.</p>
                        <h4 class="text-primary fw-bold">$89.99</h4>
                        <button class="btn btn-primary w-100 mt-2" data-buy-btn
                            data-product-id="rat2"
                            data-product-name="Ratón Inalámbrico Ultra Ligero"
                            data-product-price="89.99"
                            data-product-image="<?php echo get_template_directory_uri(); ?>/imagenes/C2.png"
                            >Añadir al carrito</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 card-hover">
                    <img src="<?php echo get_template_directory_uri(); ?>/imagenes/C3.png" class="card-img-top" alt="Alfombrilla" style="height: 250px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold">Alfombrilla XXL RGB</h5>
                        <p class="card-text text-muted">Superficie antideslizante de microfibra con luces LED.</p>
                        <h4 class="text-primary fw-bold">$29.99</h4>
                        <button class="btn btn-primary w-100 mt-2" data-buy-btn
                            data-product-id="rat3"
                            data-product-name="Alfombrilla XXL RGB"
                            data-product-price="29.99"
                            data-product-image="<?php echo get_template_directory_uri(); ?>/imagenes/C3.png"
                            >Añadir al carrito</button>
                    </div>
                </div>
            </div>
        </div>
    
</main>
<?php get_footer(); ?>
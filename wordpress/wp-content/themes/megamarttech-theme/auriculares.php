<?php 
/* Template Name: Auriculares */
get_header(); 
?>
<main class="flex-grow-1">

        <h2 class="fw-bold mb-4"><i class="bi bi-headset text-primary me-2"></i>Auriculares Gaming</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 card-hover">
                    <img src="<?php echo get_template_directory_uri(); ?>/imagenes/C1.png" class="card-img-top" alt="Auricular 1" style="height: 250px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold">Auricular Pro Sound V1</h5>
                        <p class="card-text text-muted">Sonido 7.1 envolvente, micrófono con cancelación de ruido.</p>
                        <h4 class="text-primary fw-bold">$89.99</h4>
                        <button class="btn btn-primary w-100 mt-2" data-buy-btn
                            data-product-id="aur1"
                            data-product-name="Auricular Pro Sound V1"
                            data-product-price="89.99"
                            data-product-image="<?php echo get_template_directory_uri(); ?>/imagenes/C1.png"
                            >Añadir al carrito</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 card-hover">
                    <img src="<?php echo get_template_directory_uri(); ?>/imagenes/C2.png" class="card-img-top" alt="Auricular 2" style="height: 250px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold">Auricular Wireless Elite</h5>
                        <p class="card-text text-muted">Estéreo Inalámbrico, baja latencia, confort supremo.</p>
                        <h4 class="text-primary fw-bold">$129.99</h4>
                        <button class="btn btn-primary w-100 mt-2" data-buy-btn
                            data-product-id="aur2"
                            data-product-name="Auricular Wireless Elite"
                            data-product-price="129.99"
                            data-product-image="<?php echo get_template_directory_uri(); ?>/imagenes/C2.png"
                            >Añadir al carrito</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 card-hover">
                    <img src="<?php echo get_template_directory_uri(); ?>/imagenes/C3.png" class="card-img-top" alt="Auricular 3" style="height: 250px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold">Auricular RGB Gamer</h5>
                        <p class="card-text text-muted">Iluminación RGB, bajos ultra potentes, diseño ergonómico.</p>
                        <h4 class="text-primary fw-bold">$69.99</h4>
                        <button class="btn btn-primary w-100 mt-2" data-buy-btn
                            data-product-id="aur3"
                            data-product-name="Auricular RGB Gamer"
                            data-product-price="69.99"
                            data-product-image="<?php echo get_template_directory_uri(); ?>/imagenes/C3.png"
                            >Añadir al carrito</button>
                    </div>
                </div>
            </div>
        </div>
    
</main>
<?php get_footer(); ?>
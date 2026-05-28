<footer class="bg-primary text-white py-5 mt-4">
        <div class="container">
            <div class="row g-4">

                <div class="col-12 col-md-4">
                    <h4 class="fw-bold mb-3">MegaMartTech</h4>
                    <p class="fw-semibold mb-2">Contáctanos</p>
                    <p class="mb-1 small">
                        <i class="bi bi-whatsapp me-2"></i>WhatsApp<br>
                        <span class="ms-4">+51 912 345 678</span>
                    </p>
                    <p class="mb-3 small">
                        <i class="bi bi-telephone me-2"></i>Llámanos<br>
                        <span class="ms-4">+51 912 345 678</span>
                    </p>
                    <p class="fw-semibold mb-2">Descargar App</p>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="#"><img
                                src="https://upload.wikimedia.org/wikipedia/commons/3/3c/Download_on_the_App_Store_Badge.svg"
                                alt="App Store" height="36"></a>
                        <a href="#"><img
                                src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg"
                                alt="Google Play" height="36"></a>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <p class="fw-semibold mb-3">Categorías Más Populares</p>
                    <ul class="list-unstyled small">
                        <li class="mb-1"><a href="#" class="text-white text-decoration-none">› Básicos</a></li>
                        <li class="mb-1"><a href="#" class="text-white text-decoration-none">› Bebidas</a></li>
                        <li class="mb-1"><a href="#" class="text-white text-decoration-none">› Cuidado Personal</a></li>
                        <li class="mb-1"><a href="#" class="text-white text-decoration-none">› Cuidado del Hogar</a></li>
                        <li class="mb-1"><a href="#" class="text-white text-decoration-none">› Cuidado de Bebés</a></li>
                        <li class="mb-1"><a href="#" class="text-white text-decoration-none">› Verduras & Frutas</a>
                        </li>
                        <li class="mb-1"><a href="#" class="text-white text-decoration-none">› Snacks & Alimentos</a></li>
                        <li class="mb-1"><a href="#" class="text-white text-decoration-none">› Lácteos & Panadería</a></li>
                    </ul>
                </div>

                <div class="col-12 col-md-4">
                    <p class="fw-semibold mb-3">Servicio al Cliente</p>
                    <ul class="list-unstyled small">
                        <li class="mb-1"><a href="<?php echo esc_url( home_url('/nosotros/') ); ?>" class="text-white text-decoration-none">› Sobre Nosotros</a></li>
                        <li class="mb-1"><a href="#" class="text-white text-decoration-none">› Términos y Condiciones</a>
                        </li>
                        <li class="mb-1"><a href="#" class="text-white text-decoration-none">› Preguntas Frecuentes</a></li>
                        <li class="mb-1"><a href="#" class="text-white text-decoration-none">› Política de Privacidad</a></li>
                        <li class="mb-1"><a href="#" class="text-white text-decoration-none">› Política de Desechos Electrónicos</a></li>
                        <li class="mb-1"><a href="#" class="text-white text-decoration-none">› Política de Cancelación y Devoluciones</a></li>
                    </ul>
                </div>

            </div>
            <hr class="border-white mt-4">
            <p class="text-center small mb-0">© 2022 Todos los derechos reservados. Reliance Retail Ltd.</p>
        </div>
    </footer>
    
        <!-- Modal: Añadido al carrito -->
        <div class="modal fade" id="addToCartModal" tabindex="-1" aria-labelledby="addToCartModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title fw-bold" id="addToCartModalLabel">Producto agregado</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <p class="mb-2">Has añadido <strong id="productName"></strong> al carrito.</p>
                        <div class="d-flex gap-2 justify-content-center">
                            <a href="<?php echo wc_get_cart_url(); ?>" class="btn btn-primary">Ver carrito</a>
                            <a href="<?php echo home_url('/'); ?>" class="btn btn-outline-secondary">Seguir comprando</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php wp_footer(); ?>
</body>
</html>
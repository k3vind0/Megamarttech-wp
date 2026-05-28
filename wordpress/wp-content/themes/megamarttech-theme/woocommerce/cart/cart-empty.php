<?php
/**
 * Empty cart page
 *
 * @package WooCommerce/Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="d-flex align-items-center mb-4">
    <i class="bi bi-cart3 fs-2 text-primary me-2"></i>
    <h2 class="fw-bold mb-0">Tu Carrito de Compras</h2>
</div>

<div class="row g-4 mb-5">
    <!-- Mensaje de Carrito Vacío -->
    <div class="col-12 col-lg-8">
        <div class="p-5 text-center rounded d-flex flex-column justify-content-center align-items-center h-100" style="background-color: #d1f5f9; border-radius: 0.5rem;">
            <i class="bi bi-cart-x fs-1 text-secondary mb-2"></i>
            <p class="fs-6 mb-0 text-secondary">
                Tu carrito está vacío. 
                <a href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>" class="text-primary text-decoration-none">Continúa comprando</a>
            </p>
        </div>
    </div>

    <!-- Resumen de Compra Simulado (Como en tu Laravel) -->
    <div class="col-12 col-lg-4">
        <div class="card border-0 shadow-sm p-4" style="border-radius: 1rem;">
            <h5 class="fw-bold mb-4">Resumen del Pedido</h5>
            
            <div class="d-flex justify-content-between mb-3 text-muted">
                <span>Subtotal</span>
                <span>$0.00</span>
            </div>
            <div class="d-flex justify-content-between mb-3 text-muted">
                <span>Envío</span>
                <span class="text-success">Gratis</span>
            </div>
            <div class="d-flex justify-content-between mb-3 pb-3 border-bottom text-muted">
                <span>Impuestos estim.</span>
                <span>$0.00</span>
            </div>
            
            <div class="d-flex justify-content-between mb-4 fw-bold fs-5">
                <span>Total</span>
                <span class="text-primary">$0.00</span>
            </div>

            <button class="btn btn-primary w-100 rounded-pill py-2 mb-3 fw-bold disabled" style="cursor: not-allowed;">PROCEDER AL PAGO</button>
            <a href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>" class="btn btn-outline-secondary w-100 rounded-pill py-2 fw-bold text-dark border-secondary">CONTINUAR COMPRANDO</a>
        </div>
    </div>
</div>

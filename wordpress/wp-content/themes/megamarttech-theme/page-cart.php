<?php
/*
Template Name: Cart Page
*/
defined( 'ABSPATH' ) || exit;
get_header();
?>

<main class="container py-5 flex-grow-1">
    <h2 class="fw-bold mb-4"><i class="bi bi-cart3 text-primary me-2"></i>Tu Carrito de Compras</h2>

    <div class="row g-4">
        <div class="col-lg-8">
            <?php if ( function_exists('WC') ) : 
                $cart = WC()->cart->get_cart();
                if ( ! empty( $cart ) ) :
                    foreach ( $cart as $cart_item_key => $cart_item ) :
                        $product = wc_get_product( $cart_item['product_id'] );
                        $thumbnail = $product ? $product->get_image( 'thumbnail', array( 'style' => 'max-height:80px;' ) ) : '<img src="' . esc_url( get_template_directory_uri() . '/imagenes/C1.png' ) . '" class="img-fluid rounded" style="max-height:80px;" />';
                        $name = $product ? $product->get_name() : esc_html( $cart_item['data']->get_name() );
                        $categories = $product ? wc_get_product_category_list( $product->get_id(), ', ' ) : '';
                        $price = wc_price( $cart_item['line_total'] );
                        $qty = intval( $cart_item['quantity'] );
            ?>
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-2 text-center">
                            <?php echo $thumbnail; ?>
                        </div>
                        <div class="col-md-4">
                            <h5 class="fw-bold mb-1"><?php echo esc_html( $name ); ?></h5>
                            <p class="text-muted small mb-0"><?php echo wp_kses_post( $categories ); ?></p>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group input-group-sm w-75 mx-auto" data-cart-key="<?php echo esc_attr( $cart_item_key ); ?>">
                                <button class="btn btn-outline-secondary qty-decrease" type="button">-</button>
                                <input type="text" class="form-control text-center cart-qty-input" value="<?php echo esc_attr( $qty ); ?>" data-cart-key="<?php echo esc_attr( $cart_item_key ); ?>">
                                <button class="btn btn-outline-secondary qty-increase" type="button">+</button>
                            </div>
                        </div>
                        <div class="col-md-2 text-end">
                            <span class="fw-bold fs-5 text-primary"><?php echo $price; ?></span>
                        </div>
                        <div class="col-md-1 text-end">
                            <button class="btn btn-sm text-danger remove-cart-item" data-cart-key="<?php echo esc_attr( $cart_item_key ); ?>"><i class="bi bi-trash fs-5"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                    endforeach;
                else:
            ?>
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <p class="mb-0">Tu carrito está vacío.</p>
                    <a href="<?php echo esc_url( home_url() ); ?>" class="btn btn-outline-secondary mt-3">Continuar Comprando</a>
                </div>
            </div>
            <?php
                endif;
            else:
            ?>
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <p class="mb-0">WooCommerce no está activo. Este carrito usa WooCommerce para mostrar los items.</p>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="fw-bold mb-4">Resumen del Pedido</h5>
                    <?php if ( function_exists('WC') ) : ?>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span><?php echo WC()->cart->get_cart_subtotal(); ?></span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Envío</span>
                            <span class="text-success"><?php echo WC()->cart->get_shipping_total() ? wc_price( WC()->cart->get_shipping_total() ) : 'Gratis'; ?></span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Impuestos estim.</span>
                            <span><?php echo wc_price( WC()->cart->get_taxes_total() ); ?></span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <span class="fw-bold fs-5">Total</span>
                            <span class="fw-bold fs-5 text-primary"><?php echo WC()->cart->get_total(); ?></span>
                        </div>
                        <a href="<?php echo esc_url( function_exists('wc_get_checkout_url') ? wc_get_checkout_url() : home_url('/checkout/') ); ?>" class="btn btn-primary w-100 fw-bold py-2">Proceder al Pago</a>
                        <a href="<?php echo esc_url( home_url() ); ?>" class="btn btn-outline-secondary w-100 fw-bold py-2 mt-2">Continuar Comprando</a>
                    <?php else: ?>
                        <p>Resumen no disponible.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</main>

<?php get_footer();

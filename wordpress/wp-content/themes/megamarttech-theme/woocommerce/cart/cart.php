<?php
/**
 * Cart Page Template Override
 * Uses WooCommerce native cart rendering with Bootstrap 5 styling
 */
defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<div class="d-flex align-items-center mb-4">
    <i class="bi bi-cart3 fs-2 text-primary me-2"></i>
    <h2 class="fw-bold mb-0">Tu Carrito de Compras</h2>
</div>

<div class="row g-4 mb-5">
    <div class="col-12 col-lg-8">
        <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
            <?php do_action( 'woocommerce_before_cart_table' ); ?>
            
            <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents table table-borderless align-middle" cellspacing="0">
                <thead class="d-none">
                    <tr>
                        <th class="product-remove">&nbsp;</th>
                        <th class="product-thumbnail">&nbsp;</th>
                        <th class="product-name"><?php esc_html_e( 'Producto', 'woocommerce' ); ?></th>
                        <th class="product-price"><?php esc_html_e( 'Precio', 'woocommerce' ); ?></th>
                        <th class="product-quantity"><?php esc_html_e( 'Cantidad', 'woocommerce' ); ?></th>
                        <th class="product-subtotal"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php do_action( 'woocommerce_before_cart_contents' ); ?>

                    <?php
                    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                        $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                        $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                        $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                        ?>
                        <tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
                            <td class="product-remove text-center">
                                <?php
                                    echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                        'woocommerce_cart_item_remove_link',
                                        sprintf(
                                            '<a href="%s" class="btn btn-sm text-danger" aria-label="%s" data-product_id="%s" data-product_sku="%s"><i class="bi bi-trash fs-5"></i></a>',
                                            esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                            esc_html__( 'Remove this item', 'woocommerce' ),
                                            esc_attr( $product_id ),
                                            esc_attr( $_product->get_sku() )
                                        ),
                                        $cart_item_key
                                    );
                                ?>
                            </td>

                            <td class="product-thumbnail text-center" style="width: 100px;">
                                <?php
                                $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                                echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                ?>
                            </td>

                            <td class="product-name" data-title="<?php esc_attr_e( 'Producto', 'woocommerce' ); ?>">
                                <h5 class="fw-bold mb-1">
                                <?php
                                if ( ! $product_permalink ) {
                                    echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
                                } else {
                                    echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s" class="text-decoration-none text-dark">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                                }
                                ?>
                                </h5>
                                <p class="text-muted small mb-0">
                                <?php
                                // Meta data
                                echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                ?>
                                </p>
                            </td>

                            <td class="product-price text-center" data-title="<?php esc_attr_e( 'Precio', 'woocommerce' ); ?>">
                                <span class="fw-bold"><?php echo WC()->cart->get_product_price( $_product ); ?></span>
                            </td>

                            <td class="product-quantity text-center" data-title="<?php esc_attr_e( 'Cantidad', 'woocommerce' ); ?>">
                                <div class="input-group input-group-sm w-75 mx-auto">
                                    <?php
                                    if ( $_product->is_sold_individually() ) {
                                        $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                                    } else {
                                        $product_quantity = woocommerce_quantity_input(
                                            array(
                                                'input_name'   => "cart[{$cart_item_key}][qty]",
                                                'input_value'  => $cart_item['quantity'],
                                                'max_value'    => $_product->get_max_purchase_quantity(),
                                                'min_value'    => '0',
                                                'product_name' => $_product->get_name(),
                                            ),
                                            $_product,
                                            false
                                        );
                                    }
                                    echo $product_quantity; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                    ?>
                                </div>
                            </td>

                            <td class="product-subtotal text-end" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
                                <span class="fw-bold fs-5 text-primary"><?php echo WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ); ?></span>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>

                    <?php do_action( 'woocommerce_cart_contents' ); ?>

                    <tr>
                        <td colspan="6" class="actions pt-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="submit" class="btn btn-outline-secondary rounded-pill" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>">
                                    <i class="bi bi-arrow-clockwise me-1"></i> <?php esc_html_e( 'Update cart', 'woocommerce' ); ?>
                                </button>
                                <a href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>" class="btn btn-outline-primary rounded-pill">
                                    <i class="bi bi-arrow-left me-1"></i> Continuar Comprando
                                </a>
                            </div>
                            <?php do_action( 'woocommerce_cart_actions' ); ?>
                            <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
                        </td>
                    </tr>

                    <?php do_action( 'woocommerce_after_cart_contents' ); ?>
                </tbody>
            </table>
            <?php do_action( 'woocommerce_after_cart_table' ); ?>
        </form>
        
        <?php do_action( 'woocommerce_before_cart_collaterals' ); ?>
    </div>

    <div class="col-12 col-lg-4">
        <div class="card border-0 shadow-sm p-4" style="border-radius: 1rem;">
            <?php do_action( 'woocommerce_cart_collaterals' ); ?>
        </div>
    </div>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
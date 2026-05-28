/**
 * MegaMartTech - WooCommerce Cart Badge Support
 * Actualiza el badge del carrito usando los fragments de WooCommerce
 */
(function() {
    'use strict';
    
    try {
        var wcParamsExists = (typeof wc_add_to_cart_params !== 'undefined');
        
        function updateCartCount() {
            try {
                if (!wcParamsExists) return;
                
                fetch(wc_add_to_cart_params.ajax_url + '?wc-ajax=get_refreshed_fragments', {
                    credentials: 'same-origin'
                })
                .then(function(response) { return response.json(); })
                .then(function(data) {
                    if (data && data.fragments) {
                        var tempDiv = document.createElement('div');
                        tempDiv.innerHTML = data.fragments['div.widget_shopping_cart_content'];
                        var countSpan = tempDiv.querySelector('.count');
                        if (countSpan) {
                            var count = parseInt(countSpan.textContent) || 0;
                            var badge = document.querySelector('[data-cart-count]');
                            if (badge) {
                                badge.textContent = count;
                                badge.style.display = count > 0 ? 'inline' : 'none';
                            }
                        }
                    }
                })
                .catch(function() {});
            } catch(e) {}
        }

        document.addEventListener('DOMContentLoaded', function() {
            if (wcParamsExists) {
                updateCartCount();
                document.body.addEventListener('added_to_cart', function() {
                    setTimeout(updateCartCount, 500);
                });
            }
        });
    } catch(e) {}
})();
<?php

use Automattic\WooCommerce\Blocks\Payments\Integrations\AbstractPaymentMethodType;

final class WC_Payway_Blocks extends AbstractPaymentMethodType {

    // private $gateway;
    protected $name = 'paywaynetrecurring';// your payment gateway name

    public function initialize() {
        $this->settings = get_option( 'woocommerce_paywaynetrecurring_settings', [] );
        // $this->gateway = new WC_Payway_Gateway_Rest_Recurring();
    }

    public function get_payment_method_script_handles() {

        wp_register_script(
            'paywaynetrecurring-blocks-integration',
            plugin_dir_url(__FILE__) . 'checkout.js',
            [
                'wc-blocks-registry',
                'wc-settings',
                'wp-element',
                'wp-html-entities',
                'wp-i18n',
            ],
            null,
            true
        );
        
        return [ 'paywaynetrecurring-blocks-integration' ];
    }

    public function get_payment_method_data() {
        return [
            'title' => 'Pay via PayWay',
            'description' => $this->settings['description'],
        ];
    }

}
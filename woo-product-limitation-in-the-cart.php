<?php
/*
Plugin Name: Woo Product Limitation in the Cart
Description: Only Allow 1 Product in the Cart
Version: 1.0.1 
Auhtor: Jyoti
*/

add_filter( 'woocommerce_add_to_cart_validation', 'geekerhub_only_one_in_cart', 9999 );
   
function geekerhub_only_one_in_cart( $passed ) {
   wc_empty_cart();
   return $passed;
}
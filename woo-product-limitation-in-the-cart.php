<?php
/*
Plugin Name: Woo Product Limitation in the Cart
Description: Only Allow 1 Product in the Cart
Version: 1.0.1 
Auhtor: Jyoti
*/


// Hook to add the menu
add_action('admin_menu', 'add_plugin_menu');

// Add a menu page
function add_plugin_menu() {
    add_menu_page(
        'Woo Product Limitation',
        'Product Limitation',
        'manage_options',
        'woo-product-limitation-settings',
        'woo_product_limitation_settings_page'
    );
}

// Callback function for the menu page
function woo_product_limitation_settings_page() {
    ?>
   <style>
    /* Style the form container */
    .wrap-container {
        max-width: 600px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border-radius: 4px;
    }

    /* Style the form header */
    .wp-heading-inline {
        margin-bottom: 20px;
    }

    /* Style the success notice */
    .notice {
        background-color: #d4edda;
        border-color: #c3e6cb;
        color: #155724;
    }

    /* Style the form table */
    .form-table {
        width: 100%;
        border-collapse: collapse;
    }

    .form-table th {
        text-align: right;
        width: 40%;
        padding: 10px;
    }

    .form-table td {
        width: 60%;
        padding: 10px;
    }

    /* Style the input field */
    .regular-text {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    /* Style the submit button */
    .submit input[type="submit"] {
        background-color: #0073e6;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
 }

    .submit input[type="submit"]:hover {
        background-color: #005bb5;
    }


</style>

    <?php
     if (isset($_POST['woo_product_limit'])) {
        // Save the submitted value
        update_option('woo_product_limit', $_POST['woo_product_limit']);
        echo '<div class="updated"><p>Settings saved.</p></div>';
    }
    // Display a well-formatted form to input and save the value
    echo '<div class="wrap-container">';
    echo '<h2 class="wp-heading-inline">Woo Product Limitation Settings</h2>';

   

    $woo_product_limit = get_option('woo_product_limit', 10); // Default value is 10

    echo '<form method="post" action="">';
    echo '<table class="form-table">';
    echo '<tr valign="top">';
    echo '<th scope="row">Product Limit:</th>';
    echo '<td><input type="number" id="woo_product_limit" name="woo_product_limit" value="' . esc_attr($woo_product_limit) . '" /></td>';
    echo '</tr>';
    echo '</table>';
    echo '<p class="submit" style="text-align: center"><input type="submit" class="button-primary" value="Save" /></p>';
    echo '</form>';

    echo '</div>';
}




add_filter( 'woocommerce_add_to_cart_validation', 'geekerhub_only_two_in_cart', 9999 );
   
function geekerhub_only_two_in_cart( $passed ) {
   wc_empty_cart();
   return $passed;
}
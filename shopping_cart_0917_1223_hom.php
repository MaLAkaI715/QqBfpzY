<?php
// 代码生成时间: 2025-09-17 12:23:57
class Shopping_cart extends CI_Controller {
    /**
     * Constructor
     * Initializes the controller and loads the necessary libraries.
     */
    public function __construct() {
        parent::__construct();
        // Load the cart library
        $this->load->library('cart');
    }

    /**
     * Index Method
     * Displays the shopping cart.
     */
    public function index() {
        // Check if the cart has items
        if ($this->cart->total_items() > 0) {
            // Load the view file
            $this->load->view('shopping_cart_view');
        } else {
            // Display an error message if the cart is empty
            $this->session->set_flashdata('error', 'Your cart is empty.');
            redirect('products');
        }
    }

    /**
     * Add Item Method
     * Adds an item to the cart.
     *
     * @param int $product_id
     * @param int $quantity
     */
    public function add_item($product_id, $quantity) {
        // Find the product by ID
        $product = $this->Product_model->get_product($product_id);

        // Check if the product exists
        if ($product) {
            // Add the product to the cart
            $data = array(
                'id' => $product->id,
                'qty' => $quantity,
                'price' => $product->price,
                'name' => $product->name
            );
            $this->cart->insert($data);
            redirect('products');
        } else {
            // Display an error message if the product does not exist
            $this->session->set_flashdata('error', 'Product not found.');
            redirect('products');
        }
    }

    /**
     * Update Cart Method
     * Updates the cart by updating the quantity of items.
     */
    public function update_cart() {
        // Get the cart items from the POST data
        $cart_data = $this->input->post('cart');

        foreach ($cart_data as $key => $value) {
            // Update the cart item
            $data = array(
                'rowid' => $key,
                'qty' => $value['qty']
            );
            $this->cart->update($data);
        }

        // Redirect back to the cart page
        redirect('shopping_cart');
    }

    /**
     * Remove Item Method
     * Removes an item from the cart.
     *
     * @param int $row_id
     */
    public function remove_item($row_id) {
        // Remove the item from the cart
        $this->cart->remove($row_id);
        redirect('shopping_cart');
    }
}

/**
 * Product Model
 * This model handles the database operations related to products.
 */
class Product_model extends CI_Model {
    /**
     * Constructor
     * Initializes the model and loads the necessary database.
     */
    public function __construct() {
        parent::__construct();
        // Load the database
        $this->load->database();
    }

    /**
     * Get Product Method
     * Retrieves a product by its ID.
     *
     * @param int $product_id
     * @return mixed
     */
    public function get_product($product_id) {
        // Query the database for the product
        $query = $this->db->get_where('products', array('id' => $product_id));
        return $query->row();
    }
}

/**
 * Shopping Cart View
 * This view displays the shopping cart.
 */
function shopping_cart_view() {
    echo """
    <div class="shopping-cart">
        <h2>Your Shopping Cart</h2>
        <div class="items">
            {items}
        </div>
        <div class="total">
            Total: {total}
        </div>
    </div>
    """;
}

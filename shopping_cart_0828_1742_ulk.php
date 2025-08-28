<?php
// 代码生成时间: 2025-08-28 17:42:27
class Shopping_cart extends CI_Controller {

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        // Load the necessary models and libraries
        $this->load->model('Cart_model');
        $this->load->library('session');
    }

    /**
     * Display shopping cart contents
     */
    public function index() {
        // Check if user is logged in
        if (!$this->session->userdata('is_logged_in')) {
            redirect('login');
        }

        // Get cart items from the model
        $data['cart_items'] = $this->Cart_model->get_cart_items();

        // Load the view with cart items
        $this->load->view('cart', $data);
    }

    /**
     * Add item to the shopping cart
     */
    public function add() {
        // Check if item ID is provided
        if (!$this->input->post('item_id')) {
            show_error('Item ID is required to add to the cart.', 400);
        }

        // Get item details
        $item_id = $this->input->post('item_id');
        $item_details = $this->Cart_model->get_item($item_id);

        // Check if item exists
        if (!$item_details) {
            show_error('Item not found.', 404);
        }

        // Add item to the cart
        $cart_data = array(
            'id' => $item_id,
            'name' => $item_details['name'],
            'price' => $item_details['price'],
            'qty' => 1
        );

        $this->cart->insert($cart_data);

        // Redirect to cart page
        redirect('shopping_cart');
    }

    /**
     * Update cart item quantity
     */
    public function update() {
        // Check for required fields
        if (!$this->input->post('rowid') || !$this->input->post('qty')) {
            show_error('Row ID and quantity are required.', 400);
        }

        // Update cart item quantity
        $row_id = $this->input->post('rowid');
        $qty = $this->input->post('qty');

        $data = array(
            'rowid' => $row_id,
            'qty' => $qty
        );

        $this->cart->update($data);

        // Redirect to cart page
        redirect('shopping_cart');
    }

    /**
     * Remove item from the shopping cart
     */
    public function remove() {
        // Check for required fields
        if (!$this->input->post('rowid')) {
            show_error('Row ID is required to remove from the cart.', 400);
        }

        // Remove item from the cart
        $row_id = $this->input->post('rowid');
        $this->cart->remove($row_id);

        // Redirect to cart page
        redirect('shopping_cart');
    }
}

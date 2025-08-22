<?php
// 代码生成时间: 2025-08-22 08:39:45
class Cart_service extends CI_Controller {

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('cart_model'); // Load the cart model
    }

    /**
     * Add item to cart
     *
     * @param int $product_id
     * @param int $quantity
     * @return void
     */
    public function add($product_id, $quantity) {
        if (!is_numeric($product_id) || !is_numeric($quantity)) {
            show_error('Invalid product or quantity');
        }

        $result = $this->cart_model->add($product_id, $quantity);
        if ($result) {
            echo json_encode(array('status' => 'success', 'message' => 'Item added to cart'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Failed to add item to cart'));
        }
    }

    /**
     * Remove item from cart
     *
     * @param int $product_id
     * @return void
     */
    public function remove($product_id) {
        if (!is_numeric($product_id)) {
            show_error('Invalid product');
        }

        $result = $this->cart_model->remove($product_id);
        if ($result) {
            echo json_encode(array('status' => 'success', 'message' => 'Item removed from cart'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Failed to remove item from cart'));
        }
    }

    /**
     * Update item quantity in cart
     *
     * @param int $product_id
     * @param int $quantity
     * @return void
     */
    public function update($product_id, $quantity) {
        if (!is_numeric($product_id) || !is_numeric($quantity)) {
            show_error('Invalid product or quantity');
        }

        $result = $this->cart_model->update($product_id, $quantity);
        if ($result) {
            echo json_encode(array('status' => 'success', 'message' => 'Item quantity updated'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Failed to update item quantity'));
        }
    }

    /**
     * Get cart items
     *
     * @return void
     */
    public function get_items() {
        $items = $this->cart_model->get_items();
        if ($items) {
            echo json_encode(array('status' => 'success', 'data' => $items));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'No items in cart'));
        }
    }
}

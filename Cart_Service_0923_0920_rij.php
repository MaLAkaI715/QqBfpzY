<?php
// 代码生成时间: 2025-09-23 09:20:24
class Cart_Service {
    
    protected $CI;
    
    public function __construct() {
        // Get CodeIgniter instance
        $this->CI =& get_instance();
    }
    
    /**
     * Adds an item to the cart
     *
     * @param array $item
     * @return bool
     */
    public function addItem($item) {
        if (!isset($item['id']) || !isset($item['name']) || !isset($item['price'])) {
            // Item must have id, name, and price
            return false;
        }
        
        // Load shopping cart library
        $this->CI->load->library('cart');
        
        // Add item to cart
        $this->CI->cart->insert($item);
        
        return true;
    }
    
    /**
     * Removes an item from the cart
     *
     * @param int $rowid
     * @return bool
     */
    public function removeItem($rowid) {
        // Load shopping cart library
        $this->CI->load->library('cart');
        
        // Remove item from cart
        if ($this->CI->cart->remove($rowid)) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Updates the quantity of an item in the cart
     *
     * @param int $rowid
     * @param int $quantity
     * @return bool
     */
    public function updateQuantity($rowid, $quantity) {
        // Load shopping cart library
        $this->CI->load->library('cart');
        
        // Update item quantity
        if ($this->CI->cart->update(array(
                    'rowid' => $rowid,
                    'qty' => $quantity
                ))) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Returns the cart contents
     *
     * @return array
     */
    public function getCartContents() {
        // Load shopping cart library
        $this->CI->load->library('cart');
        
        return $this->CI->cart->contents();
    }
    
    /**
     * Clears the cart contents
     *
     * @return bool
     */
    public function clearCart() {
        // Load shopping cart library
        $this->CI->load->library('cart');
        
        // Clear cart
        return $this->CI->cart->destroy();
    }
}

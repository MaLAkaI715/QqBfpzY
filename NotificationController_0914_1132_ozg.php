<?php
// 代码生成时间: 2025-09-14 11:32:28
defined('BASEPATH') OR exit('No direct script access allowed');

// NotificationController.php
class NotificationController extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        // Load the model
        $this->load->model('NotificationModel');
    }
    
    // Display the notification list
    public function index() {
        // Check if user is logged in
        if (!$this->session->userdata('is_logged_in')) {
            // Redirect to login page
            redirect('login');
        }
        
        // Fetch all notifications
        $data['notifications'] = $this->NotificationModel->getNotifications();
        
        // Load the view
        $this->load->view('notifications/index', $data);
    }
    
    // Send a notification
    public function sendNotification() {
        // Check if user is logged in
        if (!$this->session->userdata('is_logged_in')) {
            // Redirect to login page
            redirect('login');
        }
        
        // Validate input
        $this->form_validation->set_rules('message', 'Message', 'required');
        
        if ($this->form_validation->run() === FALSE) {
            // Load the send notification view
            $this->load->view('notifications/send');
        } else {
            // Get the message from POST data
            $message = $this->input->post('message');
            
            // Send the notification
            if ($this->NotificationModel->sendNotification($message)) {
                // Set success message
                $this->session->set_flashdata('message', 'Notification sent successfully.');
            } else {
                // Set error message
                $this->session->set_flashdata('message', 'Failed to send notification.');
            }
            
            // Redirect back to send notification view
            redirect('notification/send');
        }
    }
}

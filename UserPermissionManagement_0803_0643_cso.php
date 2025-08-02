<?php
// 代码生成时间: 2025-08-03 06:43:10
class UserPermissionManagement extends CI_Controller {

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('UserPermissionModel'); // Load the model
        $this->load->helper('url'); // Load URL helper
    }

    /**
     * Index method to display the list of permissions
     */
    public function index() {
        $data['permissions'] = $this->UserPermissionModel->getPermissions(); // Retrieve permissions from the model
        $this->load->view('user_permissions', $data); // Load the view with permissions
    }

    /**
     * Method to add a new permission
     */
    public function addPermission() {
        if ($this->input->post()) { // Check if form is submitted
            $data = array(
                'permission_name' => $this->input->post('permission_name') // Get the permission name from post data
            );
            $this->UserPermissionModel->addPermission($data); // Add permission using the model
            redirect('UserPermissionManagement'); // Redirect back to index
        }
        $this->load->view('add_permission'); // Load the add permission view
    }

    /**
     * Method to edit a permission
     */
    public function editPermission($id) {
        if ($this->input->post()) { // Check if form is submitted
            $data = array(
                'permission_name' => $this->input->post('permission_name') // Get the permission name from post data
            );
            $this->UserPermissionModel->updatePermission($id, $data); // Update permission using the model
            redirect('UserPermissionManagement'); // Redirect back to index
        }
        $data['permission'] = $this->UserPermissionModel->getPermissionById($id); // Retrieve a single permission
        $this->load->view('edit_permission', $data); // Load the edit permission view
    }

    /**
     * Method to delete a permission
     */
    public function deletePermission($id) {
        $this->UserPermissionModel->deletePermission($id); // Delete permission using the model
        redirect('UserPermissionManagement'); // Redirect back to index
    }
}

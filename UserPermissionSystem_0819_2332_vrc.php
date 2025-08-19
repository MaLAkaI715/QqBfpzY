<?php
// 代码生成时间: 2025-08-19 23:32:59
class UserPermissionSystem extends CI_Controller 
{

    /**
     * Constructor
     *
     * Loads the necessary models and libraries.
     */
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('UserPermissionModel');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    /**
     * Index method to display the user permissions list.
     */
    public function index() 
    {
        $data['permissions'] = $this->UserPermissionModel->get_all_permissions();
        $this->load->view('user_permissions/index', $data);
    }

    /**
     * Method to add a new user permission.
     */
    public function add_permission() 
    {
        $this->form_validation->set_rules('permission_name', 'Permission Name', 'required');

        if ($this->form_validation->run() === FALSE) 
        {
            $this->load->view('user_permissions/add');
        } 
        else 
        {
            $this->UserPermissionModel->add_permission();
            redirect('user_permissions');
        }
    }

    /**
     * Method to update an existing user permission.
     */
    public function update_permission($id) 
    {
        $this->form_validation->set_rules('permission_name', 'Permission Name', 'required');

        if ($this->form_validation->run() === FALSE) 
        {
            $data['permission'] = $this->UserPermissionModel->get_permission_by_id($id);
            $this->load->view('user_permissions/edit', $data);
        } 
        else 
        {
            $this->UserPermissionModel->update_permission($id);
            redirect('user_permissions');
        }
    }

    /**
     * Method to delete a user permission.
     */
    public function delete_permission($id) 
    {
        $this->UserPermissionModel->delete_permission($id);
        redirect('user_permissions');
    }
}

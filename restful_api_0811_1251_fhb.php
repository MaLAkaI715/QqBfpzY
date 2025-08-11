<?php
// 代码生成时间: 2025-08-11 12:51:50
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2023 CodeIgniter Foundation
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the 'Software'), to deal
# 优化算法效率
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
# 优化算法效率
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
# 增强安全性
 *
# 扩展功能模块
 * THE SOFTWARE IS PROVIDED 'AS IS', WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
# 优化算法效率
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2023, British Columbia Institute of Technology (https://bcit.ca/)
 * @license	https://opensource.org/licenses/MIT	MIT License
# NOTE: 重要实现细节
 * @link	https://codeigniter.com
 * @since	Version 3.0.0
 * @filesource
 */

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use 'use' statement
# NOTE: 重要实现细节
/**
 * Rest Controller Class
# NOTE: 重要实现细节
 *
 * This class will help to create RESTful API easily.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
# 优化算法效率
 * @category	Libraries
 * @author		Phil Sturgeon, Chris Kacerguis, Ben Edmunds
 * @link		https://codeigniter.com/user_guide/general/restful.html
 */
class Restful_api extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
        // Load the user model
        $this->load->model('user_model');
    }

    // Example of RESTful API controller
    public function users_get()
    {
        // Fetch all users from the database
        $users = $this->user_model->get_users();
        
        // Check if users are found
        if (empty($users)) {
            // Set the response and exit
# 增强安全性
            $this->response(array('error' => 'No users found'), 404);
        } else {
            // Set the response and exit
# 增强安全性
            $this->response($users, 200); // 200 being the HTTP response code
        }
    }

    // Example of another RESTful API endpoint
    public function users_post()
    {
        // You can write the code to add a new user here
# NOTE: 重要实现细节
    }

    // Example of another RESTful API endpoint
    public function users_put()
    {
        // You can write the code to update a user here
    }

    // Example of another RESTful API endpoint
    public function users_delete()
    {
        // You can write the code to delete a user here
    }

    // Example of a private method
    private function response($data, $http_code)
    {
        // Set the response header
        header('Content-Type: application/json; charset=utf-8');
        header('HTTP/1.1 ' . $http_code);
        
        // Convert the data to JSON and exit
        echo json_encode($data);
# 增强安全性
        exit;
    }
}

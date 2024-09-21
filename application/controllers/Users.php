<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');        
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->library('form_validation');
    }

    public function index($page = 0) {

    // Get sorting parameters from URL
    $sort_by = $this->input->get('sort_by') ?: 'id';
    $sort_order = $this->input->get('sort_order') === 'desc' ? 'desc' : 'asc';
    
    // Determine the next sorting order
    $next_sort_order = ($sort_order === 'asc') ? 'desc' : 'asc';

       $config = [
    'base_url' => site_url('users/index'),
    'total_rows' => $this->User_model->count_users(),
    'per_page' => 5,
    'uri_segment' => 3,
    'full_tag_open' => '<ul class="pagination justify-content-end p-3">', // Added border and padding
    'full_tag_close' => '</ul>',
    'num_tag_open' => '<li class="page-item">', 
    'num_tag_close' => '</li>',
    'cur_tag_open' => '<li class="page-item active"><a class="page-link">', // Active link
    'cur_tag_close' => '</a></li>',
    'next_tag_open' => '<li class="page-item">',
    'next_tag_close' => '</li>',
    'prev_tag_open' => '<li class="page-item">',
    'prev_tag_close' => '</li>',
    'first_tag_open' => '<li class="page-item">',
    'first_tag_close' => '</li>',
    'last_tag_open' => '<li class="page-item">',
    'last_tag_close' => '</li>',
    'next_link' => 'Next', 
    'prev_link' => 'Previous', 
    'attributes' => ['class' => 'page-link'], // Class for pagination links
];


        $this->pagination->initialize($config);
        
        // Fetch sorted users
    $data['users'] = $this->User_model->get_users($config['per_page'], $page, $sort_by, $sort_order);
    $data['links'] = $this->pagination->create_links();
    $data['sort_by'] = $sort_by;
    $data['sort_order'] = $sort_order;
    $data['next_sort_order'] = $next_sort_order;

        $this->load->view('users/index', $data);
    }

    public function create() {
        $this->form_validation->set_rules('name', 'Name', 'required|regex_match[/^[a-zA-Z\s]+$/]');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
    $this->form_validation->set_rules('address', 'Address', 'required');
    $this->form_validation->set_rules('phone', 'Phone', 'required|regex_match[/^[0-9]+$/]|is_unique[users.phone]');

  
     if ($this->form_validation->run() == FALSE) {
            $this->load->view('users/create');
        } else {
            $data = [
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'address' => $this->input->post('address'),
                'phone' => $this->input->post('phone')
            ];
            $this->User_model->create_user($data);
            redirect('users');
        }
    }

    public function edit($id) {
        $data['user'] = $this->User_model->get_user($id);

        $this->form_validation->set_rules('name', 'Name', 'required|regex_match[/^[a-zA-Z\s]+$/]');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check[' . $id . ']');
    $this->form_validation->set_rules('address', 'Address', 'required');
    $this->form_validation->set_rules('phone', 'Phone', 'required|regex_match[/^[0-9]+$/]|callback_phone_check[' . $id . ']');

   
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('users/edit', $data);
        } else {
            $updateData = [
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'address' => $this->input->post('address'),
                'phone' => $this->input->post('phone')
            ];
            $this->User_model->update_user($id, $updateData);
            redirect('users');
        }
    }

    public function email_check($email, $id) {
        $result = $this->User_model->get_user_by_email_or_phone($email, null, $id);
        if ($result) {
            $this->form_validation->set_message('email_check', 'This email is already taken.');
            return FALSE;
        }
        return TRUE;
    }

    public function phone_check($phone, $id) {
        $result = $this->User_model->get_user_by_email_or_phone(null, $phone, $id);
        if ($result) {
            $this->form_validation->set_message('phone_check', 'This phone number is already taken.');
            return FALSE;
        }
        return TRUE;
    }

    public function delete($id) {
        $this->User_model->delete_user($id);
        redirect('users');
    }
}


<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FormController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load any models or libraries here if needed
    }

    public function index() {
        $this->load->view('form_view'); // Load the form view
    }

    public function submit() {
        // Handle form submission
        $data = $this->input->post();
        
        // You can process the data here (e.g., save to database)
        
        // For demonstration, we'll just show the submitted data
        $this->load->view('form_success', $data);
    }
}

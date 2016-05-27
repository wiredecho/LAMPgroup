<?php

class Upload extends CI_Controller {

        public function __construct() {
                parent::__construct();
                $this->load->helper(array('form', 'url'));
        }

        public function index() {
                $this->load->view('upload_form', array('error' => ' ' ));
        }

        public function do_upload() {
                $config['upload_path']          = './uploaded_images/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 10000;
                $config['max_width']            = 102400;
                $config['max_height']           = 76800;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('userfile')) {
                        $error = array('error' => $this->upload->display_errors());

                        $this->load->view('upload_form', $error);
                }
                else {
                        $data = array('upload_data' => $this->upload->data());

                        $this->load->view('upload_success', $data);
                }
        }
}
?>
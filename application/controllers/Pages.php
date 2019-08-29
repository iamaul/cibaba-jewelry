<?php 

class Pages extends CI_Controller {
    public function view($page = 'home') {
        if (!file_exists(APPPATH.'views/resources/pages/'.$page.'.php')) {
            show_404();
        }

        $this->load->view('resources/layout/header');
        $this->load->view('resources/layout/navbar');
        $this->load->view('resources/pages/'.$page);
        $this->load->view('resources/layout/footer');
    }    
}

?>
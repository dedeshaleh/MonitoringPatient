<?php
class Template{
    protected $_ci;
    
    function __construct(){
        $this->_ci = &get_instance();
    }
    
  function frontend($content, $data = NULL){
	  date_default_timezone_set('Asia/Jakarta');
	  ini_set('date.timezone', 'Asia/Jakarta');
        // $level=$_SESSION['level'];
        // $level_menu=$_SESSION['level_menu'];
		
        $data['header'] = $this->_ci->load->view('template/front/header', $data, TRUE);
        $data['content'] = $this->_ci->load->view($content, $data, TRUE);
        $data['footer'] = $this->_ci->load->view('template/front/footer', $data, TRUE);
        
        $this->_ci->load->view('template/front/index', $data);
    }
	
  function backend($content, $data = NULL){
	  date_default_timezone_set('Asia/Jakarta');
	  ini_set('date.timezone', 'Asia/Jakarta');
        // $level=$_SESSION['level'];
        // $level_menu=$_SESSION['level_menu'];
		
        $data['header'] = $this->_ci->load->view('template/backend/header', $data, TRUE);
        $data['sidebar'] = $this->_ci->load->view('template/backend/sidebar', $data, TRUE);
        $data['content'] = $this->_ci->load->view($content, $data, TRUE);
        $data['footer'] = $this->_ci->load->view('template/backend/footer', $data, TRUE);
        
        $this->_ci->load->view('template/backend/index', $data);
    }

    function backend2($content, $data = NULL){
        $data['header'] = $this->_ci->load->view('template/back/header', $data, TRUE);
        $data['content'] = $this->_ci->load->view($content, $data, TRUE);
        $data['footer'] = $this->_ci->load->view('template/back/footer2', $data, TRUE);
        
        $this->_ci->load->view('template/back/index', $data);
    }
}
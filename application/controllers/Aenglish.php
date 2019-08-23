<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
class Aenglish extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
		$this->load->model('Admin_model');
		$this->load->library(array('user_agent', 'pagination', 'ImageManipulator'));
		$this->load->helper('url');
		$this->load->helper('custom');
		$this->load->helper('form');
		$this->load->library('upload');
		$this->load->library('session');
		$this->load->library('form_validation');
	}
	public function index() {
	    echo 'English Admin';
	}
	/*header Menu Language change Start*/
	public function headmenulist(){
	    $language = 'en';
	    $data['menulist'] = $this->Admin_model->headmenulist($language);
	    $this->load->view('admin/headmenulist', $data);
	}
	public function addheadmenu(){
	    $language = 'en';
	    if(isset($_POST) && !empty($_POST)){
	        $this->form_validation->set_rules('navbartype', 'Navbar type','trim|required');
    		$this->form_validation->set_rules('menu_type', 'Menu Type', 'trim|required');
    		$this->form_validation->set_rules('for_menu', 'For Menu', 'trim|required');
    		$this->form_validation->set_rules('menu_name', 'Menu Name', 'trim|required');
    		if ($this->form_validation->run() == false) {
    			$this->load->view('admin/addheadmenu');
    		}else{
    		    $inputdata = array(
    		        'navbartype' => $this->input->post('navbartype'),
    		        'for_menu' => $this->input->post('for_menu'),
    		        'menu_type' => $this->input->post('menu_type'),
    		        'language' => $language,
    		        'menu_name' => $this->input->post('menu_name'),
                );
                $response = $this->Admin_model->addheadmenu($inputdata);
                if($response){
                    $this->session->set_flashdata('msg','<div class="alert alert-success">Menu Added Successfully.</div>');
                    redirect(base_url().'index.php/aenglish/addheadmenu');
                }else{
                    $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to Add Menu.</div>');
                    redirect(base_url().'index.php/aenglish/addheadmenu');
                }
    		}
	    }else{
	        $this->load->view('admin/addheadmenu');
	    }
	}
	public function editheadmenu($id){
	    $language = 'en';
	    $data['editmenu'] = $this->Admin_model->editheadmenu($language, $id);
	    $this->load->view('admin/editheadmenu', $data);
	}
	public function updateheadmenu($id){
	    $language = 'en';
	    $data['editmenu'] = $this->Admin_model->editheadmenu($language, $id);
	    $this->form_validation->set_rules('navbartype', 'Navbar type','trim|required');
		$this->form_validation->set_rules('menu_type', 'Menu Type', 'trim|required');
		$this->form_validation->set_rules('for_menu', 'For Menu', 'trim|required');
		$this->form_validation->set_rules('menu_name', 'Menu Name', 'trim|required');
		if ($this->form_validation->run() == false) {
			$this->load->view('admin/editheadmenu', $data);
		}else{
		    $inputdata = array(
		        'navbartype' => $this->input->post('navbartype'),
		        'for_menu' => $this->input->post('for_menu'),
		        'menu_type' => $this->input->post('menu_type'),
		        'language' => $language,
		        'menu_name' => $this->input->post('menu_name'),
            );
            $response = $this->Admin_model->updateheadmenu($inputdata, $id);
            if($response){
                $this->session->set_flashdata('msg','<div class="alert alert-success">Menu Updated Successfully.</div>');
                redirect(base_url().'index.php/aenglish/headmenulist');
            }else{
                $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to Update Menu.</div>');
                redirect(base_url().'index.php/aenglish/editheadmenu/'.$id);
            }
		}
	}
	public function deleteheadmenu($id){
	    $language = 'en';
	    $response = $this->Admin_model->deleteheadmenu($language, $id);
	    if($response){
	        $this->session->set_flashdata('msg','<div class="alert alert-success">Menu Deleted Successfully.</div>');
            redirect(base_url().'index.php/aenglish/headmenulist');
	    }else{
	        $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to Delete a Menu.</div>');
            redirect(base_url().'index.php/aenglish/headmenulist');
	    }
	}
	/*header Menu Language change End*/
	
	/*Left Menu Language change Start*/
	public function leftmenulist(){
	    $language = 'en';
	    $data['leftmenulist'] = $this->Admin_model->leftmenulist($language);
	    $this->load->view('admin/leftmenulist', $data);
	}
	public function addleftmenu(){
	    $data['geners'] = $this->Admin_model->generslist();
	    $language = 'en';
	    if(isset($_POST) && !empty($_POST)){
	        $this->form_validation->set_rules('navbartype', 'Navbar type','trim|required');
    		$this->form_validation->set_rules('menu_type', 'Menu Type', 'trim|required');
    		$this->form_validation->set_rules('for_menu', 'For Menu', 'trim|required');
    		$this->form_validation->set_rules('menu_name', 'Menu Name', 'trim|required');
    		if ($this->form_validation->run() == false) {
    			$this->load->view('admin/addheadmenu',$data);
    		}else{
    		    $inputdata = array(
    		        'navbartype' => $this->input->post('navbartype'),
    		        'for_menu' => $this->input->post('for_menu'),
    		        'menu_type' => $this->input->post('menu_type'),
    		        'language' => $language,
    		        'menu_name' => $this->input->post('menu_name'),
                );
                $response = $this->Admin_model->addleftmenu($inputdata);
                if($response){
                    $this->session->set_flashdata('msg','<div class="alert alert-success">Menu Added Successfully.</div>');
                    redirect(base_url().'index.php/aenglish/addleftmenu');
                }else{
                    $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to Add Menu.</div>');
                    redirect(base_url().'index.php/aenglish/addleftmenu');
                }
    		}
	    }else{
	        $this->load->view('admin/addleftmenu',$data);
	    }
	}
	public function editleftmenu($id){
	    $language = 'en';
	    $data['geners'] = $this->Admin_model->generslist();
	    $data['editleftmenu'] = $this->Admin_model->editleftmenu($language, $id);
	    $this->load->view('admin/editleftmenu', $data);
	}
	public function updateleftmenu($id){
	    $language = 'en';
	    $data['geners'] = $this->Admin_model->generslist();
	    $data['editleftmenu'] = $this->Admin_model->editleftmenu($language, $id);
	    $this->form_validation->set_rules('navbartype', 'Navbar type','trim|required');
		$this->form_validation->set_rules('menu_type', 'Menu Type', 'trim|required');
		$this->form_validation->set_rules('for_menu', 'For Menu', 'trim|required');
		$this->form_validation->set_rules('menu_name', 'Menu Name', 'trim|required');
		if ($this->form_validation->run() == false) {
			$this->load->view('admin/editleftmenu', $data);
		}else{
		    $inputdata = array(
		        'navbartype' => $this->input->post('navbartype'),
		        'for_menu' => $this->input->post('for_menu'),
		        'menu_type' => $this->input->post('menu_type'),
		        'language' => $language,
		        'menu_name' => $this->input->post('menu_name'),
            );
            $response = $this->Admin_model->updateleftmenu($inputdata, $id);
            if($response){
                $this->session->set_flashdata('msg','<div class="alert alert-success">Menu Updated Successfully.</div>');
                redirect(base_url().'index.php/aenglish/leftmenulist');
            }else{
                $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to Update Menu.</div>');
                redirect(base_url().'index.php/aenglish/editleftmenu/'.$id);
            }
		}
	}
	public function deleteleftmenu($id){
	    $language = 'en';
	    $response = $this->Admin_model->deleteleftmenu($language, $id);
	    if($response){
	        $this->session->set_flashdata('msg','<div class="alert alert-success">Menu Deleted Successfully.</div>');
            redirect(base_url().'index.php/aenglish/leftmenulist');
	    }else{
	        $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to Delete a Menu.</div>');
            redirect(base_url().'index.php/aenglish/leftmenulist');
	    }
	}
	/*Left Menu Language change End*/
	
	/*Profile Menu Language change Start*/
	public function profilemenulist(){
	    $language = 'en';
	    $data['profilemenulist'] = $this->Admin_model->profilemenulist($language);
	    $this->load->view('admin/profilemenulist', $data);
	}
	public function addprofilemenu(){
	    $language = 'en';
	    if(isset($_POST) && !empty($_POST)){
	        $this->form_validation->set_rules('navbartype', 'Navbar type','trim|required');
    		$this->form_validation->set_rules('menu_type', 'Menu Type', 'trim|required');
    		$this->form_validation->set_rules('for_menu', 'For Menu', 'trim|required');
    		$this->form_validation->set_rules('menu_name', 'Menu Name', 'trim|required');
    		if ($this->form_validation->run() == false) {
    			$this->load->view('admin/addprofilemenu');
    		}else{
    		    $inputdata = array(
    		        'navbartype' => $this->input->post('navbartype'),
    		        'for_menu' => $this->input->post('for_menu'),
    		        'menu_type' => $this->input->post('menu_type'),
    		        'language' => $language,
    		        'menu_name' => $this->input->post('menu_name'),
                );
                $response = $this->Admin_model->addprofilemenu($inputdata);
                if($response){
                    $this->session->set_flashdata('msg','<div class="alert alert-success">Menu Added Successfully.</div>');
                    redirect(base_url().'index.php/aenglish/addprofilemenu');
                }else{
                    $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to Add Menu.</div>');
                    redirect(base_url().'index.php/aenglish/addprofilemenu');
                }
    		}
	    }else{
	        $this->load->view('admin/addprofilemenu');
	    }
	}
	public function editprofilemenu($id){
	    $language = 'en';
	    $data['editprofilemenu'] = $this->Admin_model->editprofilemenu($language, $id);
	    $this->load->view('admin/editprofilemenu', $data);
	}
	public function updateprofilemenu($id){
	    $language = 'en';
	    $data['editprofilemenu'] = $this->Admin_model->editprofilemenu($language, $id);
	    $this->form_validation->set_rules('navbartype', 'Navbar type','trim|required');
		$this->form_validation->set_rules('menu_type', 'Menu Type', 'trim|required');
		$this->form_validation->set_rules('for_menu', 'For Menu', 'trim|required');
		$this->form_validation->set_rules('menu_name', 'Menu Name', 'trim|required');
		if ($this->form_validation->run() == false) {
			$this->load->view('admin/editprofilemenu', $data);
		}else{
		    $inputdata = array(
		        'navbartype' => $this->input->post('navbartype'),
		        'for_menu' => $this->input->post('for_menu'),
		        'menu_type' => $this->input->post('menu_type'),
		        'language' => $language,
		        'menu_name' => $this->input->post('menu_name'),
            );
            $response = $this->Admin_model->updateprofilemenu($inputdata, $id);
            if($response){
                $this->session->set_flashdata('msg','<div class="alert alert-success">Menu Updated Successfully.</div>');
                redirect(base_url().'index.php/aenglish/profilemenulist');
            }else{
                $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to Update Menu.</div>');
                redirect(base_url().'index.php/aenglish/editprofilemenu/'.$id);
            }
		}
	}
	public function deleteprofilemenu($id){
	    $language = 'en';
	    $response = $this->Admin_model->deleteprofilemenu($language, $id);
	    if($response){
	        $this->session->set_flashdata('msg','<div class="alert alert-success">Menu Deleted Successfully.</div>');
            redirect(base_url().'index.php/aenglish/profilemenulist');
	    }else{
	        $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to Delete a Menu.</div>');
            redirect(base_url().'index.php/aenglish/profilemenulist');
	    }
	}
	/*Profile Menu Language change End*/
	
	/* home page slide show images & links start */
	public function homeslides(){
	    $language = 'en';
	    $data['homeslides'] = $this->Admin_model->homeslides($language);
	    $this->load->view('admin/homeslides', $data);
	}
	public function addhomeslide(){
	    $language = 'en';
	    if(isset($_POST) && !empty($_POST)){
	        $this->form_validation->set_rules('caption', 'Caption','trim|min_length[5]|max_length[200]');
	        if(!isset($_FILES['slideimage']['name']) || empty($_FILES['slideimage']['name'])) {
    		    $this->form_validation->set_rules('slideimage', 'Slide Image', 'trim|required');
	        }
    		$this->form_validation->set_rules('slideurl', 'Slide URL', 'trim|valid_url');
    		if ($this->form_validation->run() == false) {
    			$this->load->view('admin/addhomeslide');
    		}else{
    		    $slideimage = '';
				$config['upload_path'] = 'assets/images/';  
				$config['allowed_types'] = 'jpg|jpeg|png|gif';
				$config['file_name'] = $_FILES['slideimage']['name']; 
				$config['encrypt_name'] = TRUE;
				$this->load->library('upload',$config);
				$this->upload->initialize($config);   
				if($this->upload->do_upload('slideimage')){
					$uploadData = $this->upload->data();
					$slideimage = $uploadData['file_name'];
                    $inputdata = array(
                        'caption' => $this->input->post('caption'),
                        'slideimage' => $slideimage,
                        'slideurl' => $this->input->post('slideurl'),
                        'language' => $language,
                        'type' => 'banner',
                    );
                    $response = $this->Admin_model->addhomeslide($inputdata);
                    if($response){
                        $this->session->set_flashdata('msg','<div class="alert alert-success">Slide added Successfully.</div>');
                        redirect(base_url().'index.php/aenglish/addhomeslide');
                    }else{
                        $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to add Slide.</div>');
                        redirect(base_url().'index.php/aenglish/addhomeslide');
                    }
				}else{
				    $error = array('error' => $this->upload->display_errors());
				    $this->load->view('admin/addhomeslide',$error);
				}
    		}
	    }else{
	        $this->load->view('admin/addhomeslide');
	    }
	}
	public function edithomeslide($id){
	    $language = 'en';
	    $data['editslide'] = $this->Admin_model->edithomeslide($language,$id);
	    $this->load->view('admin/edithomeslide', $data);
	}
	public function updatehomeslide($id){
	    $language = 'en';
	    $data['editslide'] = $this->Admin_model->edithomeslide($id,$language);
	    $this->form_validation->set_rules('caption', 'Caption','trim|min_length[5]|max_length[200]');
		$this->form_validation->set_rules('slideurl', 'Slide URL', 'trim|valid_url');
		if ($this->form_validation->run() == false) {
			$this->load->view('admin/edithomeslide', $data);
		}else{
		    $slideimage = '';
		    if(isset($_FILES['slideimage']['name']) && !empty($_FILES['slideimage']['name'])) {
    			$config['upload_path'] = 'assets/images/';  
    			$config['allowed_types'] = 'jpg|jpeg|png|gif';
    			$config['file_name'] = $_FILES['slideimage']['name']; 
    			$config['encrypt_name'] = TRUE;
    			$this->load->library('upload',$config);
    			$this->upload->initialize($config);   
    			if($this->upload->do_upload('slideimage')){
    				$uploadData = $this->upload->data();
    				$slideimage = $uploadData['file_name'];
    			}
		    }else{
			    $error = array('error' => $this->upload->display_errors());
			    $this->load->view('admin/addhomeslide',$error);
			}
            $inputdata = array(
                'caption' => $this->input->post('caption'),
                'slideurl' => $this->input->post('slideurl'),
                'language' => $language,
            );
            if(!empty($slideimage)){
                $inputdata['slideimage'] = $slideimage;
            }
            $response = $this->Admin_model->updatehomeslide($inputdata, $id);
            if($response){
                $this->session->set_flashdata('msg','<div class="alert alert-success">Slide updated Successfully.</div>');
                redirect(base_url().'index.php/aenglish/homeslides');
            }else{
                $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to update Slide.</div>');
                redirect(base_url().'index.php/aenglish/addhomeslide/'.$id);
            }
		}
	}
	public function deletehomeslide($id){
	    $response = $this->Admin_model->deletehomeslide($id);
        if($response){
            $this->session->set_flashdata('msg','<div class="alert alert-success">Slide deleted Successfully.</div>');
            redirect(base_url().'index.php/aenglish/homeslides');
        }else{
            $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to delete Slide.</div>');
            redirect(base_url().'index.php/aenglish/homeslides');
        }
	}
	/* home page slide show images & links end */
	
	/*Users List Start */
	public function userslist(){
	    $language = 'en';
	    $data['languages'] = $this->Admin_model->languages();
	    $data['userslist'] = $this->Admin_model->userslist($language);
	    $this->load->view('admin/userslist', $data);
	}
	public function profilestories($userid){ // writer Stories, series, life events, nano stories list
	    $language = 'en';
	    $data['profilestories'] = $this->Admin_model->profilestories($language,$userid);
	    $this->load->view('admin/profilestories', $data);
	}
	public function blockprofile($userid){
	    $response = $this->Admin_model->blockprofile($userid);
	    if($response){
	        $this->session->set_flashdata('msg','<div class="alert alert-success">User Blocked Successfully.</div>');
            redirect(base_url().'index.php/aenglish/userslist');
	    }else{
	        $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to Block User.</div>');
            redirect(base_url().'index.php/aenglish/userslist');
	    }
	}
	public function unblockprofile($userid){
	    $response = $this->Admin_model->unblockprofile($userid);
	    if($response){
	        $this->session->set_flashdata('msg','<div class="alert alert-success">User Unblocked Successfully.</div>');
            redirect(base_url().'index.php/aenglish/userslist');
	    }else{
	        $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to Unblock User.</div>');
            redirect(base_url().'index.php/aenglish/userslist');
	    }
	}
	public function verifyprofile($userid){
	    $response = $this->Admin_model->verifyprofile($userid);
	    if($response){
	        $this->session->set_flashdata('msg','<div class="alert alert-success">User Verified Successfully.</div>');
            redirect(base_url().'index.php/aenglish/userslist');
	    }else{
	        $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to Verify User.</div>');
            redirect(base_url().'index.php/aenglish/userslist');
	    }
	}
	public function notverifyprofile($userid){
	    $response = $this->Admin_model->notverifyprofile($userid);
	    if($response){
	        $this->session->set_flashdata('msg','<div class="alert alert-success">User Un Verified Successfully.</div>');
            redirect(base_url().'index.php/aenglish/userslist');
	    }else{
	        $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to Un Verify User.</div>');
            redirect(base_url().'index.php/aenglish/userslist');
	    }
	}
	public function deleteprofile(){
	    $response = $this->Admin_model->deleteprofile($userid);
	    if($response){
	        $this->session->set_flashdata('msg','<div class="alert alert-success">User Deleted Successfully.</div>');
            redirect(base_url().'index.php/aenglish/userslist');
	    }else{
	        $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to Delete User.</div>');
            redirect(base_url().'index.php/aenglish/userslist');
	    }
	}
	
	public function usersearch(){
	    $language = 'en';
	    if(isset($_POST) && !empty($_POST)){
	        $data['usersearch'] = $this->Admin_model->usersearch($language, $_POST);
	        $this->load->view('admin/usersearch', $data);
	    }
	}
	public function pstoriessearch($userid){
	    $language = 'en';
	    if(isset($_POST['type']) && !empty($_POST['type'])){
            $data['pstoriessearch'] = $this->Admin_model->pstoriessearch($language, $userid, $_POST['type']);
    	    $this->load->view('admin/pstoriessearch', $data);
	    }else{
	        $data['pstoriessearch'] = $this->Admin_model->pstoriessearch($language, $userid);
    	    $this->load->view('admin/pstoriessearch', $data);
	    }
	}
	public function addearningcount(){
	    $language = 'en';
	    if(isset($_POST['userid']) && !empty($_POST['userid']) && isset($_POST['earningcount']) && !empty($_POST['earningcount'])){
	        $response = $this->Admin_model->addearningcount($language, $_POST['userid'], $_POST['earningcount']);
    	    if($response == 1){
    	        echo 1;
    	    }else{
    	        echo 0;
    	    }
	    }else{
	        echo 0;
	    }
	}
	/*Users List End*/
	
	/*Stories List start*/
	public function storieslist(){
	    $language = 'en';
	    $data['geners'] = $this->Admin_model->generslist($language);
	    $data['storieslist'] = $this->Admin_model->storieslist($language);
	    $this->load->view('admin/storieslist', $data);
	}
	public function storyreports($sid){
	    $data['storyreports'] = $this->Admin_model->storyreports($sid);
	    $this->load->view('admin/storyreports', $data);
	}
	public function deletestory($sid){
	    $response = $this->Admin_model->deletestory($sid);
	    if($response){
	        $this->session->set_flashdata('msg','<div class="alert alert-success">Story Deleted Successfully.</div>');
            redirect(base_url().'index.php/aenglish/storieslist');
	    }else{
	        $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to Delete Story.</div>');
            redirect(base_url().'index.php/aenglish/storieslist');
	    }
	}
	public function deleteseries($sid){
	    $response = $this->Admin_model->deleteseries($sid);
	    if($response){
	        $this->session->set_flashdata('msg','<div class="alert alert-success">Series Deleted Successfully.</div>');
            redirect(base_url().'index.php/aenglish/storieslist');
	    }else{
	        $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to Delete Series.</div>');
            redirect(base_url().'index.php/aenglish/storieslist');
	    }
	}
	public function adminchoice($sid){ // story as admin choice
	    $response = $this->Admin_model->adminchoice($sid);
	    if($response){
	        echo 1;
	        //$this->session->set_flashdata('msg','<div class="alert alert-success">Story Moved into Admin Choice Successfully.</div>');
            //redirect(base_url().'index.php/aenglish/storieslist');
	    }else{
	        echo 0;
	       // $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to Admin Choice Story.</div>');
            //redirect(base_url().'index.php/aenglish/storieslist');
	    }
	}
	public function storiessearch(){
	    $language = 'en';
	    $data['storiessearch'] = $this->Admin_model->storiessearch($language, $_POST);
	    $this->load->view('admin/storiessearch', $data);
	}
	/*Stories List End*/
	
	/* Blog Posts start */
	public function blogs(){
	    $language = 'en';
	    $data['blogs'] = $this->Admin_model->blogs($language);
	    $this->load->view('admin/blogs', $data);
	}
	public function addblog(){
	    $language = 'en';
	    if(isset($_POST) && !empty($_POST)){
	        $this->form_validation->set_rules('title', 'Title','trim|required|min_length[5]|max_length[200]');
	        if(!isset($_FILES['blogimage']['name']) || empty($_FILES['blogimage']['name'])) {
    		    $this->form_validation->set_rules('blogimage', 'Blog Image', 'trim|required');
	        }
    		$this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[10]');
    		if ($this->form_validation->run() == false) {
    			$this->load->view('admin/addblog');
    		}else{
		        $blogimage = ''; $image = '';
                $config['upload_path'] = 'assets/images/';  
				$config['allowed_types'] = 'jpg|jpeg|png|gif';
				$config['file_name'] = $_FILES['blogimage']['name']; 
				$config['encrypt_name'] = TRUE;
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('blogimage')){
                    $uploadData = $this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/images/'.$uploadData['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = FALSE;
                    $config['quality'] = '85%';
                    $config['width'] = 230;
                    $config['height'] = 170;
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                    $blogimage = $uploadData['file_name'];
                    
                    $date = strtotime(date('Y-m-d h:i:s'));
                    $newNamePrefix = $date.'_';
                    $manipulator = new ImageManipulator($_FILES['blogimage']['tmp_name']);
                    $newImage = $manipulator->resample(730, 540, FALSE);
                    $image = $newNamePrefix.$_FILES['blogimage']['name'];
                    // saving file to uploads folder
                    $manipulator->save('assets/images/'.$newNamePrefix.$_FILES['blogimage']['name']);
                        
                    $inputdata = array(
                        'caption' => $this->input->post('title'),
                        'slideimage' => $blogimage,
                        'image' => $image,
                        'description' => $this->input->post('description'),
                        'language' => $language,
                        'type' => 'blog',
                    );
                    $response = $this->Admin_model->addblog($inputdata);
                    if($response){
                        $this->session->set_flashdata('msg','<div class="alert alert-success">Blog added Successfully.</div>');
                        redirect(base_url().'index.php/aenglish/addblog');
                    }else{
                        $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to add Blog.</div>');
                        redirect(base_url().'index.php/aenglish/addblog');
                    }
				}else{
				    $error = array('error' => $this->upload->display_errors());
				    $this->load->view('admin/addblog',$error);
				}
    		}
	    }else{
	        $this->load->view('admin/addblog');
	    }
	}
	public function editblog($id){
	    $language = 'en';
	    $data['editblog'] = $this->Admin_model->editblog($language,$id);
	    $this->load->view('admin/editblog', $data);
	}
	public function updateblog($id){
	    $language = 'en';
	    $data['editblog'] = $this->Admin_model->editblog($language,$id);
	    $this->form_validation->set_rules('title', 'Title','trim|required|min_length[5]|max_length[200]');
    	$this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[10]');
		if ($this->form_validation->run() == false) {
			$this->load->view('admin/editblog', $data);
		}else{
		    $blogimage = ''; $image = '';
		    if(isset($_FILES['blogimage']['name']) && !empty($_FILES['blogimage']['name'])) {
    			$config['upload_path'] = 'assets/images/';  
    			$config['allowed_types'] = 'jpg|jpeg|png|gif';
    			$config['file_name'] = $_FILES['blogimage']['name']; 
    			$config['encrypt_name'] = TRUE;
    			$this->load->library('upload',$config);
    			$this->upload->initialize($config);   
    			if($this->upload->do_upload('blogimage')){
    				$uploadData = $this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/images/'.$uploadData['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = FALSE;
                    $config['quality'] = '90%';
                    $config['width'] = 230;
                    $config['height'] = 170;
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                    $blogimage = $uploadData['file_name'];
                    
                    $date = strtotime(date('Y-m-d h:i:s'));
                    $newNamePrefix = $date.'_';
                    $manipulator = new ImageManipulator($_FILES['blogimage']['tmp_name']);
                    $newImage = $manipulator->resample(730, 540, FALSE);
                    $image = $newNamePrefix.$_FILES['blogimage']['name'];
                    // saving file to uploads folder
                    $manipulator->save('assets/images/'.$newNamePrefix.$_FILES['blogimage']['name']);
    			}
		    }else{
			    $error = array('error' => $this->upload->display_errors());
			    $this->load->view('admin/editblog', $data);
			}
            $inputdata = array(
                'caption' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'language' => $language,
            );
            if(!empty($blogimage)){
                $inputdata['slideimage'] = $blogimage;
            }
            if(!empty($image)){
                $inputdata['image'] = $image;
            }
            $response = $this->Admin_model->updateblog($inputdata, $id);
            if($response){
                $this->session->set_flashdata('msg','<div class="alert alert-success">Blog updated Successfully.</div>');
                redirect(base_url().'index.php/aenglish/blogs');
            }else{
                $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to update Blog.</div>');
                redirect(base_url().'index.php/aenglish/editblog/'.$id);
            }
		}
	}
	public function deleteblog($id){
	    $response = $this->Admin_model->deleteblog($id);
        if($response){
            $this->session->set_flashdata('msg','<div class="alert alert-success">Blog deleted Successfully.</div>');
            redirect(base_url().'index.php/aenglish/blogs');
        }else{
            $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to delete Blog.</div>');
            redirect(base_url().'index.php/aenglish/blogs');
        }
	}
	/* Blog Posts end */
	
	/* Reports Start */
	public function reports(){
	    $data['reports'] = $this->Admin_model->reports();
	    $this->load->view('admin/reports',$data);
	}
	public function reportblockstory($sid){
	    $response = $this->Admin_model->reportblockstory($sid);
        if($response){
            $this->session->set_flashdata('msg','<div class="alert alert-success">Story Blocked Successfully.</div>');
            redirect(base_url().'index.php/aenglish/reports');
        }else{
            $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to Block Story.</div>');
            redirect(base_url().'index.php/aenglish/reports');
        }
	}
	public function reportblockseries($sid){
	    $response = $this->Admin_model->reportblockseries($sid);
        if($response){
            $this->session->set_flashdata('msg','<div class="alert alert-success">Series Blocked Successfully.</div>');
            redirect(base_url().'index.php/aenglish/reports');
        }else{
            $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to Block Series.</div>');
            redirect(base_url().'index.php/aenglish/reports');
        }
	}
	public function reportdeletestory($sid){
	    $response = $this->Admin_model->reportdeletestory($sid);
        if($response){
            $this->session->set_flashdata('msg','<div class="alert alert-success">Story deleted Successfully.</div>');
            redirect(base_url().'index.php/aenglish/reports');
        }else{
            $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to delete Story.</div>');
            redirect(base_url().'index.php/aenglish/reports');
        }
	}
	public function reportdeleteseries($sid){
	    $response = $this->Admin_model->reportdeleteseries($sid);
        if($response){
            $this->session->set_flashdata('msg','<div class="alert alert-success">Series deleted Successfully.</div>');
            redirect(base_url().'index.php/aenglish/reports');
        }else{
            $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to delete Series.</div>');
            redirect(base_url().'index.php/aenglish/reports');
        }
	}
	public function reportstypesearch(){
	    $language = 'en';
	    if(isset($_POST['reportstype']) && !empty($_POST['reportstype'])){
	        $data['reportssearch'] = $this->Admin_model->reportstypesearch($language, $_POST['reportstype']);
	        $this->load->view('admin/reportssearch', $data);
	    }
	}
	/* Reports end */
	
	/* Stories Reports start */
	public function storiesreports(){
	    $language = 'en';
	    $data['reports'] = $this->Admin_model->storiesreports($language);
	    $this->load->view('admin/storiesreports',$data);
	}
	public function blockstory($storyid){
	    $language = 'en';
	    $response = $this->Admin_model->blockstory($language, $storyid);
	    if($response == 1){
            $this->session->set_flashdata('msg','<div class="alert alert-success">Story Blocked Successfully.</div>');
            redirect(base_url().'index.php/aenglish/storiesreports');
        }else{
            $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to block Story.</div>');
            redirect(base_url().'index.php/aenglish/storiesreports');
        }
	}
	public function blockseries($seriesid){
	    $language = 'en';
	    $response = $this->Admin_model->blockseries($language, $seriesid);
	    if($response == 1){
            $this->session->set_flashdata('msg','<div class="alert alert-success">Series Blocked Successfully.</div>');
            redirect(base_url().'index.php/aenglish/storiesreports');
        }else{
            $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to block Series.</div>');
            redirect(base_url().'index.php/aenglish/storiesreports');
        }
	}
	public function unblockstory($storyid){
	    $language = 'en';
	    $response = $this->Admin_model->unblockstory($language, $storyid);
	    if($response == 1){
            $this->session->set_flashdata('msg','<div class="alert alert-success">Story Unblocked Successfully.</div>');
            redirect(base_url().'index.php/aenglish/storiesreports');
        }else{
            $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to Unblock Story.</div>');
            redirect(base_url().'index.php/aenglish/storiesreports');
        }
	}
	public function unblockseries($seriesid){
	    $language = 'en';
	    $response = $this->Admin_model->unblockseries($language, $seriesid);
	    if($response == 1){
            $this->session->set_flashdata('msg','<div class="alert alert-success">Series Unblocked Successfully.</div>');
            redirect(base_url().'index.php/aenglish/storiesreports');
        }else{
            $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to Unblock Series.</div>');
            redirect(base_url().'index.php/aenglish/storiesreports');
        }
	}
	/* Stories Reports end */
	
	/* Stories comments Reports start */
	public function storiescmtreports(){
	    $language = 'en';
	    $data['storiescmtreports'] = $this->Admin_model->storiescmtreports($language);
	    $this->load->view('admin/storiescmtreports',$data);
	}
	/* Stories comments Reports end */
	
	/* communities Reports start */
	public function communitiesreports(){
	    $language = 'en';
	    $data['commreports'] = $this->Admin_model->communitiesreports($language);
	    $this->load->view('admin/communitiesreports',$data);
	}
	public function blockcommreportstory($comm_story_id){
	    $language = 'en';
	    $response = $this->Admin_model->blockcommreportstory($language, $comm_story_id);
	    if($response == 1){
            $this->session->set_flashdata('msg','<div class="alert alert-success">Community Story Blocked Successfully.</div>');
            redirect(base_url().'index.php/aenglish/communitiesreports');
        }else{
            $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to block Community Story.</div>');
            redirect(base_url().'index.php/aenglish/communitiesreports');
        }
	}
	public function unblockcommreportstory($comm_story_id){
	    $language = 'en';
	    $response = $this->Admin_model->unblockcommreportstory($language, $comm_story_id);
	    if($response == 1){
            $this->session->set_flashdata('msg','<div class="alert alert-success">Community Story un blocked Successfully.</div>');
            redirect(base_url().'index.php/aenglish/communitiesreports');
        }else{
            $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to Un block Community Story.</div>');
            redirect(base_url().'index.php/aenglish/communitiesreports');
        }
	}
	public function deletecommreportstory($comm_story_id){
	    $language = 'en';
	    $response = $this->Admin_model->deletecommreportstory($language, $comm_story_id);
	    if($response == 1){
            $this->session->set_flashdata('msg','<div class="alert alert-success">Community Story deleted Successfully.</div>');
            redirect(base_url().'index.php/aenglish/communitiesreports');
        }else{
            $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to delete Community Story.</div>');
            redirect(base_url().'index.php/aenglish/communitiesreports');
        }
	}
	/* communities Reports end */
	
	/* communities Comments Reports start */
	public function communitiescmtreports(){
	    $language = 'en';
        $data['communitiescmtreports'] = $this->Admin_model->communitiescmtreports($language);
        $this->load->view('admin/communitiescmtreports', $data);
	}
	public function unblockcommcmtreport($comm_commentid){
	    $language = 'en';
	    $response = $this->Admin_model->unblockcommcmtreport($language, $comm_commentid);
	    if($response == 1){
            $this->session->set_flashdata('msg','<div class="alert alert-success">Community comment Unblocked Successfully.</div>');
            redirect(base_url().'index.php/aenglish/communitiescmtreports');
        }else{
            $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to Un block Community Comment.</div>');
            redirect(base_url().'index.php/aenglish/communitiescmtreports');
        }
	}
	public function blockcommcmtreport($comm_commentid){
	    $language = 'en';
	    $response = $this->Admin_model->blockcommcmtreport($language, $comm_commentid);
	    if($response == 1){
            $this->session->set_flashdata('msg','<div class="alert alert-success">Community comment Blocked Successfully.</div>');
            redirect(base_url().'index.php/aenglish/communitiescmtreports');
        }else{
            $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to Block Community Comment.</div>');
            redirect(base_url().'index.php/aenglish/communitiescmtreports');
        }
	}
	public function deletecommcmtreport($comm_commentid){
	    $language = 'en';
	    $response = $this->Admin_model->deletecommcmtreport($language, $comm_commentid);
	    if($response == 1){
            $this->session->set_flashdata('msg','<div class="alert alert-success">Community comment Deleted Successfully.</div>');
            redirect(base_url().'index.php/aenglish/communitiescmtreports');
        }else{
            $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to Delete Community Comment.</div>');
            redirect(base_url().'index.php/aenglish/communitiescmtreports');
        }
	}
	/* communities Comments Reports end */
	
	/* communities start */
	public function communities(){
	    $language = 'en';
        $data['communities'] = $this->Admin_model->communities($language);
        $this->load->view('admin/communities', $data);
	}
	public function addcommunity(){
	    $language = 'en';
        $data['geners'] = $this->Admin_model->generslist();
        if(isset($_POST) && !empty($_POST)){
	        $this->form_validation->set_rules('gener', 'Gener','trim|required');
	        if(!isset($_FILES['comm_image']['name']) || empty($_FILES['comm_image']['name'])) {
    		    $this->form_validation->set_rules('comm_image', 'Blog Image', 'trim|required');
	        }
    		$this->form_validation->set_rules('about_communities', 'Description', 'trim|min_length[10]');
    		if ($this->form_validation->run() == false) {
    			$this->load->view('admin/addcommunity', $data);
    		}else{
    		    $comm_image = '';
				$config['upload_path'] = 'assets/images/';  
				$config['allowed_types'] = 'jpg|jpeg|png|gif';
				$config['file_name'] = $_FILES['comm_image']['name']; 
				$config['encrypt_name'] = TRUE;
				$this->load->library('upload',$config);
				$this->upload->initialize($config);   
				if($this->upload->do_upload('comm_image')){
					$uploadData = $this->upload->data();
					$comm_image = $uploadData['file_name'];
                    $inputdata = array(
                        'comm_image' => $comm_image,
                        'gener' => $this->input->post('gener'),
                        'joincomm_lang' => $language,
                        'about_communities' => $this->input->post('about_communities'),
                    );
                    $response = $this->Admin_model->addcommunity($inputdata);
                    if($response == 1){
                        $this->session->set_flashdata('msg','<div class="alert alert-success">Community added Successfully.</div>');
                        redirect(base_url().'index.php/aenglish/communities');
                    }else{
                        $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to add Community.</div>');
                        redirect(base_url().'index.php/aenglish/communities');
                    }
				}else{
				    $data = array('error' => $this->upload->display_errors());
				    $this->load->view('admin/addcommunity',$data);
				}
    		}
	    }else{
            $this->load->view('admin/addcommunity', $data);
	    }
	}
	public function editcommunity($id){
	    $language = 'en';
	    $data['geners'] = $this->Admin_model->generslist();
        $data['editcommunity'] = $this->Admin_model->editcommunity($language, $id);
        $this->load->view('admin/editcommunity', $data);
	}
	public function updatecommunity($id){
	    $language = 'en';
	    $data['geners'] = $this->Admin_model->generslist();
        $data['editcommunity'] = $this->Admin_model->editcommunity($language, $id);
        
        $this->form_validation->set_rules('gener', 'Gener','trim|required');
		$this->form_validation->set_rules('about_communities', 'Description', 'trim|min_length[10]');
		if ($this->form_validation->run() == false) {
			$this->load->view('admin/editcommunity', $data);
		}else{
		    $comm_image = '';
		    if(isset($_FILES['comm_image']['name']) && !empty($_FILES['comm_image']['name'])) {
				$config['upload_path'] = 'assets/images/';  
				$config['allowed_types'] = 'jpg|jpeg|png|gif';
				$config['file_name'] = $_FILES['comm_image']['name']; 
				$config['encrypt_name'] = TRUE;
				$this->load->library('upload',$config);
				$this->upload->initialize($config);   
				if($this->upload->do_upload('comm_image')){
					$uploadData = $this->upload->data();
					$comm_image = $uploadData['file_name'];
				}else{
				    $data = array('error' => $this->upload->display_errors());
				    $this->load->view('admin/editcommunity', $data);
				}
		    }
            $inputdata = array(
                'gener' => $this->input->post('gener'),
                'joincomm_lang' => $language,
                'about_communities' => $this->input->post('about_communities'),
            );
            if(!empty($comm_image)){
                $inputdata['comm_image'] = $comm_image;
            }
            $response = $this->Admin_model->updatecommunity($inputdata,$id);
            if($response == 1){
                $this->session->set_flashdata('msg','<div class="alert alert-success">Community updated Successfully.</div>');
                redirect(base_url().'index.php/aenglish/communities');
            }else{
                $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to update Community.</div>');
                redirect(base_url().'index.php/aenglish/communities');
            }
		}
	}
	public function deletecommunity($id){
	    $response = $this->Admin_model->deletecommunity($id);
        if($response){
            $this->session->set_flashdata('msg','<div class="alert alert-success">Community deleted Successfully.</div>');
            redirect(base_url().'index.php/aenglish/communities');
        }else{
            $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to delete Community.</div>');
            redirect(base_url().'index.php/aenglish/communities');
        }
	}
	/* communities end */
	
	/* Geners Start */
	public function geners($id = false){
	    $data['geners'] = $this->Admin_model->generslist();
	    if(isset($id) && !empty($id) && (isset($_POST['gener']) && !empty($_POST['gener']))){
	        $response = $this->Admin_model->updategener($id, $_POST['gener']);
	        if($response){
                $this->session->set_flashdata('msg','<div class="alert alert-success">Gener Updated Successfully.</div>');
                redirect(base_url().'index.php/aenglish/geners');
            }else{
                $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to update Gener.</div>');
                redirect(base_url().'index.php/aenglish/geners');
            }
	    }else if(isset($id) && !empty($id) && (!isset($_POST['gener']) || empty($_POST['gener']))){
	        $data['editgener'] = $this->Admin_model->editgener($id);
	    }else if(isset($_POST['gener']) && !empty($_POST['gener'])){
	        $addresponse = $this->Admin_model->addgener($_POST['gener']);
	        if($addresponse){
                $this->session->set_flashdata('msg','<div class="alert alert-success">Gener added Successfully.</div>');
                redirect(base_url().'index.php/aenglish/geners');
            }else{
                $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to add Gener.</div>');
                redirect(base_url().'index.php/aenglish/geners');
            }
	    }
        $this->load->view('admin/geners', $data);
	}
	public function deletegener($id){
	    $response = $this->Admin_model->deletegener($id);
	    if($response){
            $this->session->set_flashdata('msg','<div class="alert alert-success">Gener deleted Successfully.</div>');
            redirect(base_url().'index.php/aenglish/geners');
        }else{
            $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to delete Gener.</div>');
            redirect(base_url().'index.php/aenglish/geners');
        }
	}
	/* Geners end */
	/* profile monetisation start */
	public function profilemonetize(){
	    $data['mprofiles'] = $this->Admin_model->profilemonetize();
	    $this->load->view('admin/profilemonetize', $data);
	}
	public function monitizeuser(){
	    if(isset($_POST['userid']) && !empty($_POST['userid'])){
	        $response = $this->Admin_model->monitizeuser($_POST['userid']);
	        if($response == 1){
                echo 1;
            }else{
                echo 0;
            }
	    }
	}
	public function unmonitizeuser(){
	    if(isset($_POST['userid']) && !empty($_POST['userid'])){
	        $response = $this->Admin_model->unmonitizeuser($_POST['userid']);
	        if($response == 1){
                echo 1;
            }else{
                echo 0;
            }
	    }
	}
	/* profile monetisation end */
	
	/* stories monetisation start */
	public function storiesmonetize(){
	    $language = 'en';
	    $data['mstories'] = $this->Admin_model->storiesmonetize($language);
	    $this->load->view('admin/storiesmonetize', $data);
	}
	public function enablestoriesmonetize(){
	    $language = 'en';
	    $data['enablemstories'] = $this->Admin_model->storiesmonetize($language);
	    $this->load->view('admin/enablestoriesmonetize', $data);
	}
	public function disablestoriesmonetize(){
	    $language = 'en';
	    $data['disablemstories'] = $this->Admin_model->storiesmonetize($language);
	    $this->load->view('admin/disablestoriesmonetize', $data);
	}
	public function removestoriesmonetize(){
	    $language = 'en';
	    $data['removemstories'] = $this->Admin_model->storiesmonetize($language);
	    $this->load->view('admin/removestoriesmonetize', $data);
	}
	public function enablesmonetize(){
	    $language = 'en';
	    if(isset($_POST['storyid']) && !empty($_POST['storyid'])){
	        $response = $this->Admin_model->enablesmonetize($language, $_POST['storyid']);
	        if($response == 1){
                echo 1;
            }else{
                echo 0;
            }
	    }
	}
	public function adsstory(){
	    $language = 'en';
	    if(isset($_POST['storyid']) && !empty($_POST['storyid']) && isset($_POST['adscript']) && !empty($_POST['adscript'])){
	        $response = $this->Admin_model->adsstory($language, $_POST);
	        if($response == 1){
                echo 1;
            }else{
                echo 0;
            }
	    }else{
	        echo 2;
	    }
	}
	public function disablesmonetize(){
	    $language = 'en';
	    if(isset($_POST['storyid']) && !empty($_POST['storyid'])){
	        $response = $this->Admin_model->disablesmonetize($language, $_POST['storyid']);
	        if($response == 1){
                echo 1;
            }else{
                echo 0;
            }
	    }
	}
	public function removead(){
	    $language = 'en';
	    if(isset($_POST['storyid']) && !empty($_POST['storyid']) && isset($_POST['ads']) && !empty($_POST['ads'])){
	        $response = $this->Admin_model->removead($language, $_POST);
	        if($response == 1){
                echo 1;
            }else{
                echo 0;
            }
	    }
	}
	/* stories monetisation end */
	
	/* transactions requests monetisation start */
	public function transreqs(){
	    $language = 'en';
	    $data['transreqs'] = $this->Admin_model->transreqs($language);
	    $this->load->view('admin/transreqs', $data);
	}
	public function payment(){
	    $language = 'en';
	    if(isset($_POST['id']) && !empty($_POST['id'])){
    	    $response = $this->Admin_model->payment($language, $_POST['id']);
    	    if($response == 1){
                echo 1;
            }else{
                echo 0;
            }
	    }
	}
	/* transactions requests monetisation end */
	
	/* Landing page text start */
	public function landingpage(){
	    $language = 'en';
	    $data['landingpages'] = $this->Admin_model->landingpage($language);
	    $this->load->view('admin/landingpage', $data);
	}
	public function addlandingpage(){
	    $language = 'en';
	    if(isset($_POST) && !empty($_POST)){
	        $this->form_validation->set_rules('title', 'Title','trim|required|min_length[5]|max_length[200]');
	        if(!isset($_FILES['landimage']['name']) || empty($_FILES['landimage']['name'])) {
    		    $this->form_validation->set_rules('landimage', 'Image', 'trim|required');
	        }
    		$this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[10]');
    		if ($this->form_validation->run() == false) {
    			$this->load->view('admin/addlandingpage');
    		}else{
    		    $landimage = '';
				$config['upload_path'] = 'assets/images/';  
				$config['allowed_types'] = 'jpg|jpeg|png|gif';
				$config['file_name'] = $_FILES['landimage']['name'];
				$config['encrypt_name'] = TRUE;
				$config['max_width'] = 500;
                $config['max_height'] = 250;
                $config['min_width'] = 450;
                $config['min_height'] = 200;
				$this->load->library('upload',$config);
				$this->upload->initialize($config);   
				if($this->upload->do_upload('landimage')){
					$uploadData = $this->upload->data();
					$landimage = $uploadData['file_name'];
                    $inputdata = array(
                        'caption' => $this->input->post('title'),
                        'slideimage' => $landimage,
                        'description' => $this->input->post('description'),
                        //'language' => $language,
                        'type' => 'landingpage',
                    );
                    $response = $this->Admin_model->addlandingpage($inputdata);
                    if($response){
                        $this->session->set_flashdata('msg','<div class="alert alert-success">Landing page text added Successfully.</div>');
                        redirect(base_url().'index.php/aenglish/addlandingpage');
                    }else{
                        $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to add Landing page text.</div>');
                        redirect(base_url().'index.php/aenglish/addlandingpage');
                    }
				}else{
				    $error = array('error' => $this->upload->display_errors());
				    $this->load->view('admin/addlandingpage',$error);
				}
    		}
	    }else{
	        $this->load->view('admin/addlandingpage');
	    }
	}
	public function editlandingpage($id){
	    $language = 'en';
	    $data['editlandpage'] = $this->Admin_model->editlandingpage($language,$id);
	    $this->load->view('admin/editlandingpage', $data);
	}
	public function updatelandingpage($id){
	    $language = 'en';
	    $data['editlandpage'] = $this->Admin_model->editlandingpage($language,$id);
	    $this->form_validation->set_rules('title', 'Title','trim|required|min_length[5]|max_length[200]');
    	$this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[10]');
		if ($this->form_validation->run() == false) {
			$this->load->view('admin/editlandingpage', $data);
		}else{
		    $landimage = '';
		    if(isset($_FILES['landimage']['name']) && !empty($_FILES['landimage']['name'])) {
    			$config['upload_path'] = 'assets/images/';  
    			$config['allowed_types'] = 'jpg|jpeg|png|gif';
    			$config['file_name'] = $_FILES['landimage']['name']; 
    			$config['encrypt_name'] = TRUE;
    			$config['max_width'] = 500;
                $config['max_height'] = 250;
                $config['min_width'] = 450;
                $config['min_height'] = 200;
    			$this->load->library('upload',$config);
    			$this->upload->initialize($config);   
    			if($this->upload->do_upload('landimage')){
    				$uploadData = $this->upload->data();
    				$landimage = $uploadData['file_name'];
    			}
		    }else{
			    $error = array('error' => $this->upload->display_errors());
			    $this->load->view('admin/editlandingpage', $data);
			}
            $inputdata = array(
                'caption' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                //'language' => $language,
            );
            if(!empty($landimage)){
                $inputdata['slideimage'] = $landimage;
            }
            $response = $this->Admin_model->updatelandingpage($inputdata, $id);
            if($response){
                $this->session->set_flashdata('msg','<div class="alert alert-success">Landing page content updated Successfully.</div>');
                redirect(base_url().'index.php/aenglish/landingpage');
            }else{
                $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to update Landing page content.</div>');
                redirect(base_url().'index.php/aenglish/editlandingpage/'.$id);
            }
		}
	}
	public function deletelandingpage($id){
	    $response = $this->Admin_model->deletelandingpage($id);
        if($response){
            $this->session->set_flashdata('msg','<div class="alert alert-success">Landing page content deleted Successfully.</div>');
            redirect(base_url().'index.php/aenglish/landingpage');
        }else{
            $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to delete Landing page content.</div>');
            redirect(base_url().'index.php/aenglish/landingpage');
        }
	}
	/*  Landing page text end*/
	
	/*  Type write for landing page start */
	public function typewrites(){
	    $language = 'en';
	    $data['typewrites'] = $this->Admin_model->typewrites($language);
	    if(isset($_POST) && !empty($_POST)){
	        $this->form_validation->set_rules('typewrite', 'Type Write','trim|required|min_length[3]|max_length[50]');
    		if ($this->form_validation->run() == false) {
    			$this->load->view('admin/typewrites', $data);
    		}else{
    		    $inputdata = array(
                    'caption' => $this->input->post('typewrite'),
                    'type' => 'typewrite',
    		    );
    		    $response = $this->Admin_model->addtypewrite($inputdata);
    		    if($response){
                    $this->session->set_flashdata('msg','<div class="alert alert-success">Type write added Successfully.</div>');
                    redirect(base_url().'index.php/aenglish/typewrites');
                }else{
                    $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to add Type write.</div>');
                    redirect(base_url().'index.php/aenglish/typewrites');
                }
    		}
	    }else{
	        $this->load->view('admin/typewrites', $data);
	    }
	}
	public function edittypewrite($id){
	    $language = 'en';
	    $data['typewrites'] = $this->Admin_model->typewrites($language);
	    $data['edittypewrite'] = $this->Admin_model->edittypewrite($id);
	    if(isset($_POST) && !empty($_POST)){
	        $this->form_validation->set_rules('typewrite', 'Type Write','trim|required|min_length[3]|max_length[50]');
    		if ($this->form_validation->run() == false) {
    			$this->load->view('admin/typewrites', $data);
    		}else{
    		    $inputdata = array(
                    'caption' => $this->input->post('typewrite'),
                    'type' => 'typewrite',
    		    );
    		    $response = $this->Admin_model->updatetypewrite($inputdata, $id);
    		    if($response){
                    $this->session->set_flashdata('msg','<div class="alert alert-success">Type write Updated Successfully.</div>');
                    redirect(base_url().'index.php/aenglish/typewrites');
                }else{
                    $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to Update Type write.</div>');
                    redirect(base_url().'index.php/aenglish/typewrites');
                }
    		}
	    }else{
	        $this->load->view('admin/typewrites', $data);
	    }
	}
	public function deletetypewrite($id){
	    $response = $this->Admin_model->deletetypewrite($id);
	    if($response){
            $this->session->set_flashdata('msg','<div class="alert alert-success">Type write Deleted Successfully.</div>');
            redirect(base_url().'index.php/aenglish/typewrites');
        }else{
            $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to Delete Type write.</div>');
            redirect(base_url().'index.php/aenglish/typewrites');
        }
	}
	/*  Type write for landing page end*/
	
	/*  static pages text start */
	public function staticpages(){
	    $language = 'en';
	    $data['staticpages'] = $this->Admin_model->staticpages($language);
	    $this->load->view('admin/staticpages', $data);
	}
	public function addstaticpage(){
	    $language = 'en';
	    if(isset($_POST) && !empty($_POST)){
	        $this->form_validation->set_rules('pagetype', 'Page','trim|required|min_length[5]');
    		$this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[10]');
    		if ($this->form_validation->run() == false) {
    			$this->load->view('admin/addstaticpage');
    		}else{
    		    $image = '';
    		    if(!isset($_FILES['image']['name']) || empty($_FILES['image']['name'])) {
    				$config['upload_path'] = 'assets/images/';  
    				$config['allowed_types'] = 'jpg|jpeg|png|gif';
    				$config['file_name'] = $_FILES['image']['name'];
    				$config['encrypt_name'] = TRUE;
    				$this->load->library('upload',$config);
    				$this->upload->initialize($config);   
    				if($this->upload->do_upload('image')){
    					$uploadData = $this->upload->data();
    					$image = $uploadData['file_name'];
    				}else{
    				    $error = array('error' => $this->upload->display_errors());
    				    $this->load->view('admin/addstaticpage',$error);
    				}
    		    }
                $inputdata = array(
                    'pagetype' => $this->input->post('pagetype'),
                    'type' => 'staticpage',
                    'description' => $this->input->post('description'),
                    'image' => $image,
                    'language' => $language,
                );
                $response = $this->Admin_model->addstaticpage($inputdata);
                if($response){
                    $this->session->set_flashdata('msg','<div class="alert alert-success">Static page added Successfully.</div>');
                    redirect(base_url().'index.php/aenglish/addstaticpage');
                }else{
                    $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to add static page.</div>');
                    redirect(base_url().'index.php/aenglish/addstaticpage');
                }
    		}
	    }else{
	        $this->load->view('admin/addstaticpage');
	    }
	}
	public function editstaticpage($id){
	    $language = 'en';
	    $data['editstaticpage'] = $this->Admin_model->editstaticpage($language,$id);
	    $this->load->view('admin/editstaticpage', $data);
	}
	public function updatestaticpage($id){
	    $language = 'en';
	    $data['editstaticpage'] = $this->Admin_model->editstaticpage($language,$id);
        $this->form_validation->set_rules('pagetype', 'Page','trim|required');
		$this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[10]');
		if ($this->form_validation->run() == false) {
		    $this->load->view('admin/editstaticpage', $data);
		}else{
		    $image = '';
		    if(!isset($_FILES['image']['name']) || empty($_FILES['image']['name'])) {
				$config['upload_path'] = 'assets/images/';  
				$config['allowed_types'] = 'jpg|jpeg|png|gif';
				$config['file_name'] = $_FILES['image']['name'];
				$config['encrypt_name'] = TRUE;
				$this->load->library('upload',$config);
				$this->upload->initialize($config);   
				if($this->upload->do_upload('image')){
					$uploadData = $this->upload->data();
					$image = $uploadData['file_name'];
				}else{
				    $data['error'] = $this->upload->display_errors();
				    $this->load->view('admin/editstaticpage', $data);
				}
		    }
            $inputdata = array(
                'pagetype' => $this->input->post('pagetype'),
                'type' => 'staticpage',
                'description' => $this->input->post('description'),
                'language' => $language,
            );
            if(isset($image) && !empty($image)){
                $inputdata['image'] = $image;
            }
            $response = $this->Admin_model->updatestaticpage($inputdata, $id);
            if($response){
                $this->session->set_flashdata('msg','<div class="alert alert-success">Static page updated Successfully.</div>');
                redirect(base_url().'index.php/aenglish/staticpages');
            }else{
                $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to update Static page.</div>');
                redirect(base_url().'index.php/aenglish/editstaticpage/'.$id);
            }
		}
	}
	public function deletestaticpage($id){
	    $language = 'en';
	    $response = $this->Admin_model->deletestaticpage($language,$id);
        if($response){
            $this->session->set_flashdata('msg','<div class="alert alert-success">Static page deleted Successfully.</div>');
            redirect(base_url().'index.php/aenglish/staticpages');
        }else{
            $this->session->set_flashdata('msg','<div class="alert alert-danger">Failed to delete Static page.</div>');
            redirect(base_url().'index.php/aenglish/staticpages');
        }
	}
	/* static pages text end */
	
	
}
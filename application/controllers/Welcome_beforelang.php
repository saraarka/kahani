<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
class Welcome extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
		$this->load->model('User_model');
		$this->load->library(array('user_agent','pagination','upload'));
		$this->load->helper('custom');
		$this->session->set_userdata('language','en');
		$this->load->library('ImageManipulator');
	}
	public function index()
	{
	    if(isset($this->session->userdata['logged_in']['user_id'])) {
			redirect(base_url().'home');
		}
		$header['languages'] = $this->User_model->language();
		$header['gener'] = $this->User_model->gener();
		$header['typewrites'] = $this->User_model->typewrites();
		$header['landinggrids'] = $this->User_model->landiggrids();
		$header['landinglogos'] = $this->User_model->landinglogos();
		$this->load->view('landing.php',$header);
		$this->load->view('fbg_login.php',$header);
	}
	public function languages(){
	    $header['languages'] = $this->User_model->language();
	    $data['status'] = 1;
	    $data['response'] = $header['languages']->result();
	    echo json_encode($data);
	}
	public function selectlang($language = false){
	    if(isset($language) && !empty($language)){
	        $this->session->set_userdata('language',$language);
	        echo 1;
	    }else{
	        echo 0;
	    }
	}
	public function alpha_dash_space($name){
        if (! preg_match('/^[a-zA-Z\s]+$/', $name)) {
            $this->form_validation->set_message('alpha_dash_space', 'The %s field may only contain alpha characters & White spaces');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    public function signup() {
		$this->form_validation->set_rules('name', 'Name','trim|required|min_length[3]|max_length[30]|alpha_numeric_spaces');
		$this->form_validation->set_rules('email', 'Email Id', 'trim|required|valid_email|is_unique[signup.email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
		//$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]');
		if ($this->form_validation->run() == false) {
			$data['validations'] = $this->form_validation->error_array();
			$data['status']=-1;
			echo json_encode($data);
		}else{
			$inputdata = array(
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'password' => md5($this->input->post('password')),
			);      
			$userid = $this->User_model->insertUser($inputdata); 
			if(isset($userid) && !empty($userid)){
				$this->User_model->sendEmail($inputdata['email']);
				    $data['status'] = 1;
    				$data['response'] = $userid;
    				echo json_encode($data);
				/*$response = $this->User_model->registerlogin($userid);
				if(isset($response) && ($response->num_rows() == 1)){
				    $result = $response->result();
				    $session_data = array(
						'name' => $result[0]->name,
						'email' => $result[0]->email,
						'user_id' => $result[0]->user_id,
						'profile_image' => $result[0]->profile_image,
					);
					$this->session->set_userdata('logged_in', $session_data);
					$this->session->set_userdata('language', $result[0]->writer_language);
					$data['status'] = 1;
    				$data['response'] = $inputdata['email'];
    				echo json_encode($data);
				}else{
				    $data['status'] = 1;
    				$data['response'] = $inputdata['email'];
    				echo json_encode($data);
				}*/
			} else {
				$data['status'] = 2;
				$data['response'] = 'fail';
				echo json_encode($data);
			}
		}
	}
	
	public function socialfbg(){
	    $this->form_validation->set_rules('fbgname', 'Name','trim|required|min_length[3]|max_length[30]|callback_alpha_dash_space');
		$this->form_validation->set_rules('fbgemail', 'Email Id', 'trim|required|valid_email');
		$this->form_validation->set_rules('fbgpassword', 'Password', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('fbgid', 'Facebook Google Id', 'trim|required');
		$this->form_validation->set_rules('fbgtype', 'Login Facebook Google Type', 'trim|required');
		if ($this->form_validation->run() == false) {
			$data['validations'] = $this->form_validation->error_array();
			$data['status']=-1;
			echo json_encode($data);
		}else{
			$inputdata = array(
				'name' => $this->input->post('fbgname'),
				'email' => $this->input->post('fbgemail'),
				'password' => md5($this->input->post('fbgpassword')),
				'fbg_id' => $this->input->post('fbgid'),
				'logintype' => $this->input->post('fbgtype'),
				'user_activation' => 1,
			);      
			$userid = $this->User_model->socialfbg($inputdata); 
			if(isset($userid) && !empty($userid)){
			    $response = $this->User_model->registerlogin($userid);
				if(isset($response) && ($response->num_rows() == 1)){
				    $result = $response->result();
				    $session_data = array(
						'name' => $result[0]->name,
						'email' => $result[0]->email,
						'user_id' => $result[0]->user_id,
						'profile_image' => $result[0]->profile_image,
					);
					$this->session->set_userdata('logged_in', $session_data);
					$this->session->set_userdata('language', $result[0]->writer_language);
					$data['status'] = 1;
    				$data['response'] = $inputdata['email'];
    				echo json_encode($data);
				}else{
				    $data['status'] = 1;
    				$data['response'] = $inputdata['email'];
    				echo json_encode($data);
				}
			} else {
				$data['status'] = 2;
				$data['response'] = 'fail';
				echo json_encode($data);
			}
		}
	}
	public function resendemail(){
	    if(isset($_POST['email']) && !empty($_POST['email'])){
	        $response = $this->User_model->sendEmail($_POST['email']);
	        if($response){
	            echo json_encode(1);
	        }else{
	            echo json_encode(0);
	        }
	    }else{
	        echo json_encode(0);
	    }
	}
	public function verify($hash=NULL)
	{
		if ($this->User_model->verifyEmailID($hash)) 
		{
			$this->session->set_flashdata('signinmsg','<div class="alert alert-success text-center">Your Email Address is successfully verified! Please login to access your account!</div>');
			redirect(base_url());
		} 
		else {
			$this->session->set_flashdata('signinmsg','<div class="alert alert-danger text-center">Sorry! There is error verifying your Email Address!</div>');
			redirect(base_url());
		}
	}
	public function signin(){
	    if(isset($this->session->userdata['logged_in']['user_id'])) {
			redirect(base_url().'home');
		}
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|md5'); 
		if ($this->form_validation->run() == FALSE) {
			$data['validations'] = $this->form_validation->error_array();
			$data['status']=-1;
			echo json_encode($data);
		} else {
			$inputdata = array(
				'email' => $this->input->post('email'),
				'password' => $this->input->post('password'),
			);
			$result = $this->User_model->signin($inputdata);
			if(isset($result) && ($result->num_rows() == 1)) {
				$result = $result->result();
				$session_data = array(
					'name' => $result[0]->name,
					'email' => $result[0]->email,
					'user_id' => $result[0]->user_id,
					'profile_image' => $result[0]->profile_image,
				);
				//$this->session->set_userdata('logged_in', $session_data);
				if(isset($result[0]->writer_language) && !empty($result[0]->writer_language)){
				    $usercommunities = $this->User_model->checkfbgusercomm($result[0]->user_id);
				    if(isset($usercommunities) && ($usercommunities->num_rows() >= 2)){
				        $this->session->set_userdata('logged_in', $session_data);
				        $this->session->set_userdata('language', $result[0]->writer_language);
    				    $data['status'] = 1;
        				$data['response'] = 'success';
        				echo json_encode($data);
				    }else{
				        $data['status'] = 1;
        				$data['response']['res'] = 'nocommunities';
        				$data['response']['userid'] = $result[0]->user_id;
        				echo json_encode($data);
				    }
				}else{
				    $data['status'] = 1;
    				$data['response']['res'] = 'nolanguage';
    				$data['response']['userid'] = $result[0]->user_id;
    				echo json_encode($data);
				}
				
			} else {
				$data['status'] = 2;
				$data['response'] = 'fail';
				echo json_encode($data);
			}
		}
	}
	public function login() {
	    if(isset($this->session->userdata['logged_in']['user_id'])) {
			redirect(base_url().'home');
		}
		$header['languages'] = $this->User_model->language();
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|md5'); 
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('header.php', $header);
			$this->load->view('footer.php');
		} else {
			$data = array(
				'email' => $this->input->post('email'),
				'password' => $this->input->post('password')
			);
			$result = $this->User_model->signin($data);
			if(isset($result) && ($result->num_rows() == 1)) {
				$result = $result->result();
						$session_data = array(
							'name' => $result[0]->name,
							'email' => $result[0]->email,
							'user_id' => $result[0]->user_id,
							'profile_image' => $result[0]->profile_image,
						);
						$this->session->set_userdata('logged_in', $session_data);
						redirect(base_url().'home');
			} else {
				$this->session->set_flashdata('signinmsg', '<div class="alert alert-danger text-center">Invalid Username or Password! Please try with correct details </div>');
				$this->load->view('header.php', $header);
				//$this->load->view('login.php');
				$this->load->view('footer.php');
			}
		}
	}
	public function logout(){
       	$this->session->sess_destroy('logged_in');
        $data['message_display'] = 'Successfully Logout';
        redirect(base_url());
    }
    public function changepassword()
	{
        if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){
		    $data['editprofile'] = $this->User_model->editprofile($this->session->userdata['logged_in']['user_id']);
            $this->form_validation->set_rules('oldpassword', 'Old Password', 'trim|required|md5');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|md5');
            $this->form_validation->set_rules('repassword', 'Confirm Password', 'trim|required|matches[password]|md5');
            if ($this->form_validation->run() == FALSE) {
                $data['validations'] = $this->form_validation->error_array();
    			$data['status']=-1;
    			echo json_encode($data);
            }else {
                $passwordcheck = $this->User_model->changepassword($this->input->post('oldpassword'));
                if(isset($passwordcheck)) {
                    $response = $this->User_model->resetpassword($this->input->post('password'),$this->session->userdata['logged_in']['user_id']);
                    if($response){
                        $data['status']=1;
                    	$data['response']='success';
    			        echo json_encode($data);
                    }else{
                        $data['status']=2;
                    	$data['response']='fail';
    			        echo json_encode($data);
                    }
                }else{
                	$data['status']=2;
                	$data['response']='wrongoldpwd';
			        echo json_encode($data);
                }
            }
        }else{
            $data['status']=3;
        	$data['response']='nouser';
	        echo json_encode($data);
        }
    }
    public function resetpassword(){
        $data1['languages'] = $this->User_model->language();
    	    $this->load->view('header', $data1);
			$this->load->view('resetpassword');
			$this->load->view('footer');
    }
    public function forgotpassword() {
		$this->form_validation->set_rules('femail', 'Email Id', 'trim|required|valid_email');
		if ($this->form_validation->run() == FALSE) {
			$data['validations'] = $this->form_validation->error_array();
			$data['status']=-1;
			echo json_encode($data);
		} else {
			$existemail = $this->User_model->forgot_pass($this->input->post('femail'));
			if(isset($existemail) && !empty($existemail)){
			    $data['status'] = 1;
				$data['response'] = $existemail;
				echo json_encode($data);
				/*$new = $this->generate_password(6);
    				$this->email->from(ADMIN_EMAIL, ADMIN_NAME);
    				$this->email->to($this->input->post('femail'));     
    				$this->email->subject(ADMIN_NAME.' Reset Password');
    				$this->email->message('You have requested the new password, Here is your new password: <b>'.$new.'</b>');
    				$this->email->set_mailtype('html');
    				$status = $this->email->send();
				if(!empty($status)) {
				    $query = $this->User_model->resetpassword(md5($new), $existemail);
				    $data['status'] = 1;
    				$data['response'] = 'success';
    				echo json_encode($data);
				} else {
					$data['status'] = 2;
    				$data['response'] = 'notupdated';
    				echo json_encode($data);
				}*/
			} else{
				$data['status'] = 2;
				$data['response'] = 'fail';
				echo json_encode($data);
			}
		}
	}
	public function forgotpwd($hash){
	    if(isset($this->session->userdata['logged_in']['user_id'])) {
			redirect(base_url().'home');
		}
		$header['languages'] = $this->User_model->language();
		$header['gener'] = $this->User_model->gener();
		$header['typewrites'] = $this->User_model->typewrites();
		$header['landinggrids'] = $this->User_model->landiggrids();
		$header['landinglogos'] = $this->User_model->landinglogos();
		$header['hash'] = $hash;
		$this->load->view('landing.php', $header);
	}
	public function newpassword(){
	    $this->form_validation->set_rules('userid', 'User Id', 'trim|required');
	    $this->form_validation->set_rules('newpassword', 'New Password', 'trim|required|min_length[5]|max_length[20]');
	    $this->form_validation->set_rules('cnewpassword', 'Confirm New Password', 'trim|required|matches[newpassword]');
		if ($this->form_validation->run() == FALSE) {
			$data['validations'] = $this->form_validation->error_array();
			$data['status']=-1;
			echo json_encode($data);
		} else {
		    if(md5($_POST['newpassword']) == md5($_POST['cnewpassword']) && !empty($_POST['userid'])){
		        $response = $this->User_model->resetfpassword(md5($_POST['newpassword']), $_POST['userid']);
	            if($response){
		            $data['status'] = 1;
    				$data['response'] = 'success';
    				echo json_encode($data);
				} else {
					$data['status'] = 2;
    				$data['response'] = 'fail';
    				echo json_encode($data);
				}
		    }else{
		        $data['status'] = 3;
				$data['response'] = 'notmatch';
				echo json_encode($data);
		    }
		}
	}
	public function generate_password($length=6) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$password = substr(str_shuffle($chars),0,$length );
		return $password;
	}
	public function chooselanguage(){
        if(isset($_POST['choselanguage']) && !empty($_POST['choselanguage'])){
            $this->session->set_userdata('language',$_POST['choselanguage']);
            echo json_encode(1);
        }else{
            json_encode(0);
        }
    }
    public function choosecommu(){
        if(isset($_POST['cslang']) && !empty($_POST['cslang'])){
            $langupdate = $this->User_model->langupdate($_POST['cslang']);
        } $userid = 0;
        if(isset($_POST['userid']) && !empty($_POST['userid'])){
            $userid = $_POST['userid'];
        }
        if(isset($_POST['commids']) && count($_POST['commids']) > 0){
			$resultarray = array_count_values($_POST['commids']);
			$commus = array(); 
			foreach($resultarray as $key => $value){
				if(($value > 1) && ($value % 2 == 0)){
				}else{
					array_push($commus,$key);
				}
			}
			if(count($commus) > 0){
				$response = $this->User_model->choosecommu($commus, $userid);
				if($response){
				    if(isset($userid) && !empty($userid)){
				        $responsesess = $this->User_model->registerlogin($userid);
        				if(isset($responsesess) && ($responsesess->num_rows() == 1)){
        				    $result = $responsesess->result();
        				    $session_data = array(
        						'name' => $result[0]->name,
        						'email' => $result[0]->email,
        						'user_id' => $result[0]->user_id,
        						'profile_image' => $result[0]->profile_image,
        					);
        					$this->session->set_userdata('logged_in', $session_data);
        					$this->session->set_userdata('language', $result[0]->writer_language);
        				}
				    }
					echo 1;
				}else{
					echo 0;
				}
			}
        }else{
            echo 0;
        }
    }
    public function unchoosecommu(){
        if(isset($_POST['uncommids']) && isset($_POST['commids'])){
            $unselectedresponse = $this->User_model->unchoosedcommu($_POST['uncommids']);
            $response = $this->User_model->choosecommu($_POST['commids']);
            if($response || $unselectedresponse){
                echo 1;
            }else{
                echo 0;
            }
        }else{
            echo 0;
        }
    }
        public function username(){
        if(isset($_POST['username']) && !empty($_POST['username'])){
            if(strlen($_POST['username']) > 5){
                $response = $this->User_model->username($_POST['username']);
                if($response->num_rows() > 0){
                    echo 4;
                }else{
                    echo 1;
                }
            }else{
                echo 3;
            }
        }else{
            echo 2;
        }
    }
    public function updateusername(){
        if(isset($_POST['username']) && !empty($_POST['username'])){
            $this->form_validation->set_rules('username', 'User Name', 'trim|required|alpha_numeric|min_length[5]');
    		if ($this->form_validation->run() == FALSE) {
    		    $data['validations'] = $this->form_validation->error_array();
    			$data['status']=-1;
    			echo json_encode($data);
            } else {
                $response = $this->User_model->username($_POST['username']);
                if($response->num_rows() > 0){
                    echo 3;
                }else{
                    $response = $this->User_model->updateusername($_POST['username']);
                    if($response){
                        echo 1;
                    }else{
                        echo 4;
                    }
                }
            }	
        }else{
            echo 2;
        }
    }
	public function home($language = false){
	    if(isset($language) && !empty($language)) {
	        $this->session->set_userdata('language',$language);
	    }else{
	        $this->session->set_userdata('language','en');
	    }
		$header['gener'] = $this->User_model->gener();
		$header['languages'] = $this->User_model->language();
		$data['banner'] = $this->User_model->banner();
		$data['get_series'] = $this->User_model->get_series();
		$data['get_storys'] = $this->User_model->get_storys();
		$data['get_nano'] = $this->User_model->get_nano();
		$data['get_life'] = $this->User_model->get_life();
		$data['top_get_series'] = $this->User_model->top_get_series();
		$data['top_get_storys'] = $this->User_model->top_get_storys();
		$data['top_get_life'] = $this->User_model->top_get_life();
		$data['adminchoices'] = $this->User_model->admin_choice();
		$data['get_writer'] = $this->User_model->get_top_writer();
		$data['follow_count'] = $this->User_model->follow_count();
		$data['following'] = $this->User_model->following();
		if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){
	        $data['yournetworks'] = $this->User_model->yournetworks($this->session->userdata['logged_in']['user_id']);
		}
		$this->load->view('header.php',$header);
		$this->load->view('sidebar.php');
		$this->load->view('index.php',$data);
		$this->load->view('footer.php');
		
	}
	public function writers(){
	    $header['gener'] = $this->User_model->gener();
		$header['languages'] = $this->User_model->language();
		$data['get_writer'] = $this->User_model->get_top_writer();
		$data['follow_count'] = $this->User_model->follow_count();
		$data['following'] = $this->User_model->following();
	    $this->load->view('header.php',$header);
		$this->load->view('sidebar.php');
		$this->load->view('writers.php',$data);
		$this->load->view('footer.php');
	}
	public function get_story_groupdata(){
	    if(!isset($this->session->userdata['logged_in']['user_id']) || empty($this->session->userdata['logged_in']['user_id'])){
	        echo 'notlogin';
 	    }else if(isset($_POST['id']) && !empty($_POST['id'])) {
			$storyid = $this->input->post('id');
	        $data['storysuggesttogroup'] = $this->User_model->get_story_data($storyid);
	        $data['communities_gener'] = $this->User_model->usercommunities_gener();
            $this->load->view('storysuggesttogroup', $data);
		}else{
		    $this->load->view('storysuggesttogroup');
		}
 	}
	public function get_story_data() {
	    if(!isset($this->session->userdata['logged_in']['user_id']) || empty($this->session->userdata['logged_in']['user_id'])){
	        echo 'notlogin';
 	    }else if(isset($_POST['id']) && !empty($_POST['id'])) {
			$storyid = $this->input->post('id');
	        $data['storysuggesttofrd'] = $this->User_model->get_story_data($storyid);
	        $data['allusers'] = $this->User_model->allusers();
            $this->load->view('storysuggesttofrd', $data);
		}else{
		    $this->load->view('storysuggesttofrd');
		}
 	}
	public function series(){
	    $header['gener'] = $this->User_model->gener();
		$header['languages'] = $this->User_model->language();
		$this->load->view('header.php',$header);
		$this->load->view('series.php');
		$this->load->view('footer.php');
	}
	public function series_story_uplode() {
	    if(!isset($this->session->userdata['logged_in']['user_id']) ){
	        redirect(base_url());
	    }else{
    	    $header['gener'] = $this->User_model->gener();
    		$header['languages'] = $this->User_model->language();
            $this->form_validation->set_rules('language', 'Language','trim|required');
            $this->form_validation->set_rules('title', 'Title','trim|required');
            if(isset($_POST['language']) && ($_POST['language'] != 'en')){
                $this->form_validation->set_rules('etitle', 'English Title','trim|required');
            }
    		$this->form_validation->set_rules('genre', 'Gener','trim|required');
    		$this->form_validation->set_rules('copyrights', 'Copy Rights','trim|required');
    		$this->form_validation->set_rules('keywords', 'Key Words','trim');
    		$this->form_validation->set_rules('pay_story', ' Pay Story','trim|required');
    		if ($this->form_validation->run() == false) {
        		$this->load->view('header.php', $header);
        		$this->load->view('series.php');
                $this->load->view('footer.php');
    		}else{
                $picture1 =''; $image ='';
                if(isset($_FILES['cover_image']['name']) && !empty($_FILES['cover_image']['name'])){
                    $config['upload_path'] = 'assets/images/';
                    $config['allowed_types'] = 'jpg|jpeg|png|gif';
                    $config['max_size']     = '2048';
                    $config['encrypt_name'] = TRUE;
                    $this->load->library('upload',$config);
                    $this->upload->initialize($config);
                    if(!$this->upload->do_upload('cover_image')){
                        $error = array('error' => $this->upload->display_errors());
                        $this->load->view('header.php', $header);
                		$this->load->view('series.php', $error);
                        $this->load->view('footer.php');
                    }else if($this->upload->do_upload('cover_image')){
                        $uploadData = $this->upload->data();
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = 'assets/images/'.$uploadData['file_name'];
                        $config['create_thumb'] = FALSE;
                        $config['maintain_ratio'] = TRUE;
                        $config['quality'] = '100%';
                        $config['width'] = 293;
                        $config['height'] = 280;
                        $this->load->library('image_lib', $config);
                        $this->image_lib->resize();
                        $picture1 = $uploadData['file_name'];
                        //unlink($config['source_image']);
                        
                        $date = strtotime(date('Y-m-d h:i:s'));
                        $newNamePrefix = $date.'_';
                        $manipulator = new ImageManipulator($_FILES['cover_image']['tmp_name']);
                        $newImage = $manipulator->resample(200, 180);
                        $image = $newNamePrefix.$_FILES['cover_image']['name'];
                        // saving file to uploads folder
                        $manipulator->save('assets/images/'.$newNamePrefix.$_FILES['cover_image']['name']);
                        
                    }else{
                        $error = array('error' => $this->upload->display_errors());
                        $this->load->view('header.php', $header);
                		$this->load->view('series.php', $error);
                        $this->load->view('footer.php');
                    }
                }
                $data = array(
                    'title' => $this->input->post('title'),
                    'etitle' => $this->input->post('etitle'),
                    'user_id' => $this->session->userdata['logged_in']['user_id'],
                    'genre'=> $this->input->post('genre'),
                    'copyrights' => $this->input->post('copyrights'),
                    'keywords' => $this->input->post('keywords'),
                    'language'=> $this->input->post('language'),
                    'cover_image' => $picture1,
                    'image' => $image,
                    'pay_story' => $this->input->post('pay_story'),
                    'date' => date("Y-m-d"),
                    'type' => 'series',
                    //'draft' => 'draft',
                );
                $lid  = $this->User_model->series_story_uplode($data);
                redirect(base_url().'series_priview/'.$lid);
    		}
	    }
    }
	public function series_priview($lid)
	{
        if($this->session->userdata('logged_in')==NULL) redirect(base_url());
        $header['gener'] = $this->User_model->gener();
		$header['languages'] = $this->User_model->language();
		$data['res'] = $this->User_model->edit_story($lid);
		$this->load->view('header.php', $header);
		$this->load->view('series_priview.php',$data);
        $this->load->view('footer.php');
  	}
  	public function addseriesepisode($series_id){
        $data = array(
            'story_id' => $series_id,
            'user_id' => $this->session->userdata['logged_in']['user_id'],
            'draft' => 'draft',
        );
        $response = $this->User_model->addseriesepisode($data);
    	if(isset($response) && !empty($response)){
    	    echo $response;
    	}else{
    	    echo 0;
    	}
    }
	public function addstory_intro($lid){
	    $header['gener'] = $this->User_model->gener();
		$header['languages'] = $this->User_model->language();
		$data['res']  = $this->User_model->edit_story($lid);
		//$this->form_validation->set_rules('pay_story', ' Pay Story','trim|required');
		$this->form_validation->set_rules('story', 'story', 'trim|required');
		$this->form_validation->set_rules('story_id', 'story_id', 'trim|required');
		$this->form_validation->set_rules('draft', 'Draft', 'trim');
		$add = '';
		if(isset($_POST['addepisode']) && !empty($_POST['addepisode'])){
		    $add = $_POST['addepisode'];
		}
		if ($this->form_validation->run() == FALSE) {
    		$this->load->view('header.php', $header);
    		$this->load->view('series_story',$data);//series_priview.php
            $this->load->view('footer.php');
        } else {
			$inputdata = array(
				'story' => $this->input->post('story'),
				'story_id' => $this->input->post('story_id'),
				//'pay_story' => $this->input->post('pay_story'),
			);
			if(isset($_POST['draft']) && ($_POST['draft'] == 'draft')){
			    $inputdata['draft'] = $_POST['draft'];
			}
			$res = $this->User_model->addstory($inputdata, $lid);
			if($add == 'yes'){
			    redirect(base_url('new_series_admin?id='.$lid.'&story_id='.$lid.'&add='.$add));
			}else{
		        redirect(base_url('new_series_admin?id='.$lid.'&story_id='.$lid));
			}
		}
	}
	public function new_series_admin() {
	    $header['gener'] = $this->User_model->gener();
		$header['languages'] = $this->User_model->language();
		if(isset($_POST['seimage_sid']) && isset($_GET['id']) && !empty($_GET['id'])){
            $picture1 = ''; $image = '';
            if(isset($_FILES['cover_image']['name']) && !empty($_FILES['cover_image']['name'])){
                $config['upload_path'] = 'assets/images/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size']     = '2048';
                $config['encrypt_name'] = TRUE;
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('cover_image')){
                    $uploadData = $this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/images/'.$uploadData['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['quality'] = '100%';
                    $config['width'] = 293;
                    $config['height'] = 280;
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                    $picture1 = $uploadData['file_name'];
                    //unlink($config['source_image']);
                    
                    $date = strtotime(date('Y-m-d h:i:s'));
                    $newNamePrefix = $date.'_';
                    $manipulator = new ImageManipulator($_FILES['cover_image']['tmp_name']);
                    $newImage = $manipulator->resample(200, 180);
                    $image = $newNamePrefix.$_FILES['cover_image']['name'];
                    // saving file to uploads folder
                    $manipulator->save('assets/images/'.$newNamePrefix.$_FILES['cover_image']['name']);
                }
            }
            $inputdata = array(
                'story_id' => $_GET['id'],
                'user_id' => $this->session->userdata['logged_in']['user_id'],
                'draft' => 'draft',
            );
            if(!empty($picture1)){
                $inputdata['cover_image'] = $picture1;
                $inputdata['image'] = $image;
            }
            $response = $this->User_model->seriesaddtodrafts($inputdata, $_POST['seimage_sid']);
        	if(isset($response) && !empty($response)){
        	    echo $response;
        	}else{
        	    echo 0;
        	}
        }else{
            $uniqueviews = $this->User_model->uniqueviews($_GET['id']);
    		$data['admin_story_view'] = $this->User_model->admin_story_view();
    		$data['new_series'] = $this->User_model->new_series($_GET['id'],$_GET['story_id']);
    		$data['recentseries'] = $this->User_model->recentseries();
    		$data['comment_get'] = $this->User_model->comment_get();
    		$data['new_episode'] = $this->User_model->new_episode($_GET['story_id']);
    		$data['userstorys'] = $this->User_model->userstorys();
    		$data['lastepisode'] = $this->User_model->checkforlastepisode($_GET['story_id']);
    		$data['seriesftitle'] = $this->User_model->seriesftitle($_GET['story_id']);
    		$data['nextepisode'] = $this->User_model->nextepisode($_GET['id'],$_GET['story_id']);
    		if(isset($_GET['id'], $_GET['story_id']) && ($_GET['id'] == $_GET['story_id'])){
    		    $data['reviews'] = $this->User_model->reviews_series();
    		}else{
    		    $data['reviews'] = $this->User_model->reviews();
    		}
    		$data['favorites'] = $this->User_model->favoritreadlater('favorite');
    		$this->load->view('header.php', $header);
            $this->load->view('new_series_admin.php',$data);
            $this->load->view('footer.php');
        }
	}
	public function seriesaddtodrafts(){
	    if(isset($_POST['title']) && isset($_POST['story'])){
	        $title = preg_replace('/\s+/', '', $_POST['title']);
	        //$_POST['story'] = str_replace('nbsp;',' ',$_POST['story']);
	        $story = preg_replace('/\s+/', '', $_POST['story']);
	        if(!empty($title) && !empty($story)){
                $data = array(
            		'user_id' => $this->session->userdata['logged_in']['user_id'],
            		'story_id' => $this->input->post('series_id'),
            		'title' => $this->input->post('title'),
            		'story' => $this->input->post('story'),
            		'genre' => $this->input->post('genre'),
            		'copyrights' => $this->input->post('copyrights'),
            		'language' => $this->input->post('language'),
            		'type' => $this->input->post('type'),
            		'last_episode' => $this->input->post('lastepisode'),
            		'draft' => $this->input->post('draft'),
            		'updated_at' => date("Y-m-d"),
            	);
            	$sid = $this->input->post('sid');
            	if(!empty($sid)){
                	$response = $this->User_model->seriesaddtodrafts($data, $sid);
                	if(isset($response) && !empty($response)){
                	    echo $response;
                	}else{
                	    echo 0;
                	}
            	}else{
            	    echo 0;
            	}
	        }else{
	            echo 0;
	        }
	    }else{
	        echo 0;
	    }
    }
    public function prefaceautosave(){
        if(isset($_POST['story']) && isset($_POST['sid']) && !empty($_POST['story']) && !empty($_POST['sid']) && isset($_POST['pay_story'])){
            $data = array('draft' => 'draft', 'story' => $_POST['story'], 'pay_story' => $_POST['pay_story']);
            $response = $this->User_model->prefaceautosave($data, $_POST['sid']);
            if($response){
                echo 1;
            }else{
                echo 0;
            }
        }
    }
	public function new_series() {
	    $header['gener'] = $this->User_model->gener();
		$header['languages'] = $this->User_model->language();
	    $uniqueviews = $this->User_model->uniqueviews($_GET['id']);
	    $data['nextepisode'] = $this->User_model->nextepisode($_GET['id'],$_GET['story_id']);
		$res = $this->User_model->viewsupdate();
		$data['comment_like'] = $this->User_model->comment_like();
		$data['recentseries'] = $this->User_model->recentseries();
		if(isset($_GET['id'], $_GET['story_id']) && ($_GET['id'] == $_GET['story_id'])){
		    $data['reviews'] = $this->User_model->reviews_series();
		}else{
		    $data['reviews'] = $this->User_model->reviews();
		}
		$data['userrating'] = $this->User_model->userrating();
		$data['comment_get'] = $this->User_model->comment_get();
		$data['new_series'] = $this->User_model->new_series($_GET['id'],$_GET['story_id']);
		// For Meta tags social share end
		if(isset($data['new_series']) && ($data['new_series']->num_rows() > 0 )){
		    $metatags = $data['new_series']->result();
		    $header['ogtitle'] = $metatags[0]->title;
		    $header['ogetitle'] = $metatags[0]->etitle;
		    $header['ogkeywords'] = $metatags[0]->keywords;
		    $header['ogdescription'] = strip_tags($metatags[0]->story);
		    $header['ogauthor'] = $metatags[0]->name;
		    $header['ogurl'] = urlencode(base_url().'new_series?id='.$_GET['id'].'&story_id='.$_GET['story_id']);
		    if(isset($metatags[0]->image) && !empty($metatags[0]->image)){
		        $header['ogimage'] = $metatags[0]->image;
		    }else{
		        $header['ogimage'] = '1.jpg';
		    }
		} // For Meta tags social share end
		$data['new_episode'] = $this->User_model->new_episode($_GET['story_id']);
		$data['favorites'] = $this->User_model->favoritreadlater('favorite');
		$data['following'] = $this->User_model->following();
		$data['subscriptions'] = $this->User_model->favoritreadlater('seriessubscribe');
		$data['countsubs'] = $this->User_model->seriesreadlater('seriessubscribe');
		$data['seriesftitle'] = $this->User_model->seriesftitle($_GET['story_id']);
		//$data['funding'] = $this->User_model->funding();
		//$data['colfund'] = $this->User_model->colfund();
		//$data['reviews21'] = $this->User_model->reviews2();
		//$data['comment_replay_get'] = $this->User_model->comment_replay_get();
		//$data['likes_get'] = $this->User_model->likes_get();
		//$data['communities_gener'] = $this->User_model->communities_gener();
		//$data['allusers'] = $this->User_model->allusers();
		//$data1['languages'] = $this->User_model->language();
		$this->load->view('header.php', $header);
		$this->load->view('new_series.php',$data);
		$this->load->view('footer.php');
	}
	public function addepisodeimage(){
        print_r($_POST);
        print_r($_FILES);
    }
    public function addepisode(){
    	$picture1 =''; $image ='';
        if(!empty($_FILES['cover_image']['name'])) {
            $config['upload_path'] = 'assets/images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size']     = '2048';
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            if($this->upload->do_upload('cover_image')){
                $uploadData = $this->upload->data();
                $config['image_library'] = 'gd2';
                $config['source_image'] = 'assets/images/'.$uploadData['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['quality'] = '100%';
                $config['width'] = 293;
                $config['height'] = 280;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $picture1 = $uploadData['file_name'];
                //unlink($config['source_image']);
                
                $date = strtotime(date('Y-m-d h:i:s'));
                $newNamePrefix = $date.'_';
                $manipulator = new ImageManipulator($_FILES['cover_image']['tmp_name']);
                $newImage = $manipulator->resample(200, 180);
                $image = $newNamePrefix.$_FILES['cover_image']['name'];
                // saving file to uploads folder
                $manipulator->save('assets/images/'.$newNamePrefix.$_FILES['cover_image']['name']);
            }
        }
        $sid = 0;
        if(isset($_POST['sid']) && ($_POST['sid'])){
    	    $sid = $_POST['sid'];
    	}
    	$user_id = $this->session->userdata['logged_in']['user_id'];
    	$series_id = $this->input->post('series_id');
    	$title = $this->input->post('title');
    	$story = $this->input->post('story');
    	$genre = $this->input->post('genre');
    	$copyrights = $this->input->post('copyrights');
    	$language = $this->input->post('language');
    	$type = $this->input->post('type');
    	$lastepisode = $this->input->post('lastepisode');
    	$draft = '';
    	if(strlen($story) > 199){ }else{ $draft = 'draft'; }
    	$data = array(
    		'user_id'=>$user_id,
    		'story_id'=>$series_id,
    		'title'=>$title,
    		'story'=>$story,
    		'genre'=>$genre,
    		'copyrights'=>$copyrights,
    		'language'=>$language,
    		'type'=>$type,
    		'draft' => $draft,
    		'last_episode' => $lastepisode,
    	);
    	if(!empty($picture1)){
    	    $data['cover_image'] = $picture1;
    	    $data['image'] = $image;
    	}
    	$response = $this->User_model->checkforlastepisode($series_id);
    	if(isset($response) && ($response->num_rows() > 0)){
    	    $this->session->flashdata('msg','<span class="alert alert-danger"> Series End. </span>');
    	    redirect(base_url().'new_series_admin?id='.$series_id.'&story_id='.$series_id);
    	}else{
    	    $data = $this->User_model->addepisode($data, $sid);
    	    redirect(base_url().'new_series_admin?id='.$series_id.'&story_id='.$series_id);
    	}
    }
    public function story_info($sid){
		if($this->session->userdata('logged_in')==NULL) redirect(base_url());
		$header['gener'] = $this->User_model->gener();
		$header['languages'] = $this->User_model->language();
		$data['tagslist'] = $this->User_model->lifetagslist();
		$data['story_info'] = $this->User_model->story_info($sid);
        $this->load->view('header', $header);
		$this->load->view('story_info',$data);
		//$this->load->view('footer');
	}
	public function story_info_uplode(){
        $sid = $this->input->post('hidden');
        $title = $this->input->post('title');
        $etitle = $this->input->post('etitle');
        $copyrights = $this->input->post('copyrights');
        $type = $this->input->post('type');
        $story_id = $this->input->post('story_id');	
        $updata = array(
            'title' => $title,
            'etitle'=> $etitle,
            //'genre' => $genre,
            'copyrights'=> $copyrights,
            'type' => $type,
            'story_id' => $story_id,
        );
        if(isset($_POST['genre']) && !empty($_POST['genre'])){
            $updata['genre'] = $_POST['genre'];
        }
        if(isset($_POST['pay_story']) && !empty($_POST['pay_story'])){
            $updata['pay_story'] = $_POST['pay_story'];
        }
        if(isset($_POST['keywords'])){
            $updata['keywords'] = $_POST['keywords'];
        }
        $data  = $this->User_model->story_info_uplode($sid,$updata);
        if($type == 'series'){
      	    redirect(base_url('new_series_admin?id='.$sid.'&story_id='.$story_id));
      	} else {
            redirect(base_url('admin_story?id='.$sid));
        }
    }
    public function series_edit($sid){
	 	if($this->session->userdata('logged_in')==NULL) redirect(base_url());
	 	$header['gener'] = $this->User_model->gener();
		$header['languages'] = $this->User_model->language();
		$data['series_edit'] = $this->User_model->series_edit($sid);
		$this->load->view('header.php', $header);
        $this->load->view('series_edit.php',$data);
        $this->load->view('footer.php');
	}
	public function updatestory() {
		$header['gener'] = $this->User_model->gener();
		$header['languages'] = $this->User_model->language();
		$data['series_edit'] = $this->User_model->series_edit($_POST['story_id']);
		$this->form_validation->set_rules('story', 'story', 'trim|required');
		$this->form_validation->set_rules('story_id', 'story_id', 'trim|required');
		$this->form_validation->set_rules('draft', 'Draft', 'trim');
		$data = array();
		if ($this->form_validation->run() == FALSE) {
		    redirect(base_url().'series_edit/'.$_POST['story_id']);
    		/*$this->load->view('header.php', $header);
    		$this->load->view('series_edit.php',$data); //admin_story_view.php
            $this->load->view('footer.php');*/
        } else {
        	$picture1 =''; $image =''; 
			/*if(!empty($_FILES['cover_image']['name'])) {
				$config['upload_path'] = 'assets/images/';  
				$config['allowed_types'] = 'jpg|jpeg|png|gif';
				$config['file_name'] = $_FILES['cover_image']['name']; 
				$config['encrypt_name'] = TRUE;
				$this->load->library('upload',$config);
				$this->upload->initialize($config);   
				if($this->upload->do_upload('cover_image')){
					$uploadData = $this->upload->data();
					$picture1 = $uploadData['file_name'];
				}
			}*/
			if(!empty($_FILES['cover_image']['name'])) {
                $config['upload_path'] = 'assets/images/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size']     = '2048';
                $config['encrypt_name'] = TRUE;
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('cover_image')){
                    $uploadData = $this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/images/'.$uploadData['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['quality'] = '100%';
                    $config['width'] = 293;
                    $config['height'] = 280;
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                    $picture1 = $uploadData['file_name'];
                    //unlink($config['source_image']);
                    
                    $date = strtotime(date('Y-m-d h:i:s'));
                    $newNamePrefix = $date.'_';
                    $manipulator = new ImageManipulator($_FILES['cover_image']['tmp_name']);
                    $newImage = $manipulator->resample(200, 180);
                    $image = $newNamePrefix.$_FILES['cover_image']['name'];
                    // saving file to uploads folder
                    $manipulator->save('assets/images/'.$newNamePrefix.$_FILES['cover_image']['name']);
                }
            }
    		$id = $this->input->post('hidden');
            $story = $this->input->post('story');	
            $story_id = $this->input->post('story_id');	
			$inputdata = array(
				'story' => $story,
				'story_id'=>$story_id,
				'draft' => $this->input->post('draft'),
			);
			if(!empty($picture1)){
				$inputdata['cover_image'] = $picture1;
			}
			if(!empty($image)){
				$inputdata['image'] = $image;
			}
			$res = $this->User_model->updatestory($inputdata,$id);
			redirect(base_url('new_series_admin?id='.$id.'&story_id='.$story_id));
    	}
	}
	public function saveupdatestory($storyid){
	    $picture1 =''; $image = '';
		if(isset($_FILES['cover_image']['name']) && !empty($_FILES['cover_image']['name'])){
            $config['upload_path'] = 'assets/images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size']     = '2048';
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            if(!$this->upload->do_upload('cover_image')){
                $this->session->set_flashdata('errmsg', 'The Upload Image size should be less than 2MB.');
                redirect(base_url().'admin_story_view/'.$storyid);
            }else if($this->upload->do_upload('cover_image')){
                $uploadData = $this->upload->data();
                $config['image_library'] = 'gd2';
                $config['source_image'] = 'assets/images/'.$uploadData['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['quality'] = '100%';
                $config['width'] = 293;
                $config['height'] = 280;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $picture1 = $uploadData['file_name'];
                
                $date = strtotime(date('Y-m-d h:i:s'));
                $newNamePrefix = $date.'_';
                $manipulator = new ImageManipulator($_FILES['cover_image']['tmp_name']);
                if(isset($_POST['type']) && ($_POST['type'] == 'life')){
                    $newImage = $manipulator->resample(266, 165);
                }else{
                    $newImage = $manipulator->resample(200, 180);
                }
                $image = $newNamePrefix.$_FILES['cover_image']['name'];
                $manipulator->save('assets/images/'.$newNamePrefix.$_FILES['cover_image']['name']);
                
            }else{
                $this->session->set_flashdata('errmsg', 'The Upload Image size should be less than 2MB.');
                redirect(base_url().'admin_story_view/'.$storyid);
            }
        }
	    $inputdata = array(
			'story' => $this->input->post('story'),
		);
		if(!empty($picture1)){
			$inputdata['cover_image'] = $picture1;
		}
		if(!empty($picture1)){
			$inputdata['image'] = $image;
		}
		$res = $this->User_model->updatestory($inputdata, $storyid);
		if($res){
		    redirect(base_url().'admin_story?id='.$storyid);
		}else{
		    redirect(base_url().'admin_story_view/'.$storyid);
		}
	}
	public function updatestory12($id)
	{
		//print_r($_POST);exit();
		//$data['admin_story_view'] = $this->User_model->admin_story_view();
		//$data['editstory'] = $this->User_model->editstory($id);
		$data1['languages'] = $this->User_model->language();
		$this->form_validation->set_rules('story', 'story', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
		
		$this->load->view('header.php', $data1);
		$this->load->view('admin_story.php',$data);
        $this->load->view('footer.php');
        } else {	
        $picture1 =''; 
			if(!empty($_FILES['cover_image']['name'])) {
				$config['upload_path'] = 'assets/images/';  
				$config['allowed_types'] = 'jpg|jpeg|png|gif';
				$config['file_name'] = $_FILES['cover_image']['name']; 
				$config['encrypt_name'] = TRUE;
				$this->load->library('upload',$config);
				$this->upload->initialize($config);   
				if($this->upload->do_upload('cover_image')){
					$uploadData = $this->upload->data();
					$picture1 = $uploadData['file_name'];
				}
			}		
			$inputdata = array(
				'story' => $this->input->post('story'),
				'story_id'=>$id,
			);
			if(!empty($picture1)){
				$inputdata['cover_image']=$picture1;
			}
			
			//print_r($inputdata);exit();
			$res=$this->User_model->updatestory($inputdata,$id);
			redirect(base_url('admin_story?id='.$id));
			
		}
	}
	public function addtodrafts(){
	    if(isset($_POST['sid']) && isset($_POST['story']) && isset($_POST['draft'])){
	        $sid = $_POST['sid'];
	        $data = array(
	            'story' => $_POST['story'],
	            'draft' => $_POST['draft'],
	            'user_id' => $this->session->userdata['logged_in']['user_id'],
	            'updated_at' => date("Y-m-d"),
	        );
	        $response  = $this->User_model->addtodrafts($data, $sid);
	        if($response){
	            echo 1;
	        }else{
	            echo 0;
	        }
	    }
	}
	public function saveaddtodrafts($storyid){
	    if(isset($_POST['story']) && !empty($_POST['story'])){
	        $data = array(
	            'draft_story' => $_POST['story'],
	            'updated_at' => date("Y-m-d"),
	        );
    	    $response  = $this->User_model->addtodrafts($data, $storyid);
    	    if($response){
    		    echo 1;
    		}else{
    		    echo 0;
    		}
	    }
	}
	public function deletedraft() {
	    if(isset($_POST['sid']) && isset($_POST['draft'])){
	        $response  = $this->User_model->deletedraft($_POST['sid'], $_POST['draft']);
	        if($response){
	            echo 1;
	        }else{
	            echo 0;
	        }
	    }else{
	        echo 0;
	    }
	}
	public function savedeletedraft($storyid){
        $data = array(
            'draft_story' => '',
        );
	    $response  = $this->User_model->addtodrafts($data, $storyid);
	    if($response){
		    echo 1;
		}else{
		    echo 0;
		}
	}
	public function readlater(){
    	if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){
        	$user_id = $this->session->userdata['logged_in']['user_id'];
        	$story_id = $this->input->post('sid');
        	$type = $this->input->post('type');
        	$data = array(
        		'user_id' => $user_id,
        		'story_id' => $story_id,
        		'type' => $type,
        	);
        	$response = $this->User_model->readlater($data);
        	if($response){
        	    echo $response;
        	}else{
        	    echo 0;
        	}
    	}else{
    	    echo 0;
    	}
    }
    public function uploadstoryimg(){
        
        
        /*if(isset($_POST['file']) && !empty($_POST['file'])){
		    $base = $_POST['file'];
            $binary = base64_decode($base);
            header('charset=utf-8');
            $datetime = Date('YmdHis');
            $imagepath = 'assets/images/'.$datetime.'.jpg';
            $file = fopen($imagepath, 'wb');
            $datawrite = fwrite($file, $binary);
            fclose($file);
            if($datawrite > 0){
                $data['image'] = $datetime.'.jpg';
            }
            //$data['image'] = $_POST['image'];
    		$result = $this->User_model->add_image($data);
    		if($result == 1) {
    			$resultdata['status'] = 'success';
    	        echo json_encode($resultdata);
    		} else {
    			$resultdata['status'] = 'fail';
    	        echo json_encode($resultdata);
    		}
		}*/
        
        
        list($type, $data) = explode(';', $_POST['file']);
        list(, $data) = explode(',', $data);
        $file_data = base64_decode($data);
        
        // Get file mime type
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $file_mime_type = finfo_buffer($finfo, $file_data, FILEINFO_MIME_TYPE);
        
        // File extension from mime type
        if($file_mime_type == 'image/jpeg' || $file_mime_type == 'image/jpg')
        	$file_type = 'jpeg';
        else if($file_mime_type == 'image/png')
        	$file_type = 'png';
        else if($file_mime_type == 'image/gif')
        	$file_type = 'gif';
        else 
        	$file_type = 'other';
        
        // Validate type of file
        if(in_array($file_type, [ 'jpeg', 'png', 'gif', 'jpg' ])) {
        	// Set a unique name to the file and save
        	$datetime = Date('YmdHis');
            $imagepath = 'assets/images/storyimgs/'.$datetime.'.'.$file_type;
            //$file = fopen($imagepath, 'wb');
        	file_put_contents($imagepath, $file_data);
        	//echo base_url().$imagepath;
        	
        	 list($width, $height) = getimagesize(base_url().$imagepath);
        	 if(isset($width) && ($width > 700)){
                $manipulator = new ImageManipulator($imagepath);
                $newImage = $manipulator->resample(700, 400);
                $manipulator->save($imagepath);
                echo base_url().$imagepath;
        	 }else{
        	     echo base_url().$imagepath;
        	 }
        }
        else {
        	echo 'Error : Only JPEG, PNG & GIF allowed';
        }
        
        
        
        /*$origins = rtrim(base_url(), '/'); //xml,xhr request
        //$accepted_origins = array("http://localhost", "http://dailindia.in", "http://codexworld.com", "http://dailindia.in/storycarry");
        $accepted_origins = array("http://localhost", $origins);
        //print_r($accepted_origins);
        $imageFolder = "assets/images/storyimgs/"; // Images upload path
        reset($_FILES);
        $temp = current($_FILES);
        if(is_uploaded_file($temp['tmp_name'])){
            if(isset($_SERVER['HTTP_ORIGIN'])){
                // Same-origin requests won't set an origin. If the origin is set, it must be valid.
                if(in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)){
                    header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
                }else{
                    header("HTTP/1.1 403 Origin Denied");
                    return;
                }
            }
            if(preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])){ // Sanitize input
                header("HTTP/1.1 400 Invalid file name.");
                return;
            }
            if(!in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "png", "jpeg"))){ // Verify extension
                header("HTTP/1.1 400 Invalid extension.");
                return;
            }
            $filetowrite = $imageFolder . $temp['name']; // Accept upload if there was no origin, or if it is an accepted origin
            
            $image_info = getimagesize($temp['tmp_name']);
            $targetfile = $temp['tmp_name'];
            if(isset($image_info[0]) && ($image_info[0] > 700)){
                $manipulator = new ImageManipulator($targetfile);
                $newImage = $manipulator->resample(800, 400);
                $manipulator->save('assets/images/storyimgs/'.$targetfile);
                echo json_encode(array('location' => base_url().'assets/images/storyimgs/'.$targetfile));
            }else{
                move_uploaded_file($temp['tmp_name'], $filetowrite);
                echo json_encode(array('location' => base_url().$filetowrite)); // Respond to the successful upload with JSON.
            }
        } else {
            header("HTTP/1.1 500 Server Error"); // Notify editor that the upload failed
        }*/
    }
    public function storymonitizeradio(){
	    if(isset($this->session->userdata['logged_in']['user_id'])){
	        $userid = $this->session->userdata['logged_in']['user_id'];
	        $language = $this->session->userdata['language'];
	        $followwritecount = $this->User_model->followwritecount($language,$userid);
	        if($followwritecount->num_rows() > 0){
	            echo 1;
	        }else{
	            echo 2;
	        }
	    }else{
	        echo 0;
	    }
	}
    public function story(){
		if($this->session->userdata('logged_in')==NULL) redirect(base_url());
		$header['gener'] = $this->User_model->gener();
		$header['languages'] = $this->User_model->language();
		$this->load->view('header.php', $header);
		$this->load->view('story.php');
        $this->load->view('footer.php');
	}
	public function story_story_uplode() {
	    $header['gener'] = $this->User_model->gener();
		$header['languages'] = $this->User_model->language();
	    $this->form_validation->set_rules('language', 'Language','trim|required');
		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		if(isset($_POST['language']) && ($_POST['language'] != 'en')){
		    $this->form_validation->set_rules('etitle', 'English Title', 'trim|required');
		}
		$this->form_validation->set_rules('genre', 'Gener', 'trim|required');
		$this->form_validation->set_rules('copyrights', 'Copy Rights', 'trim|required');
		$this->form_validation->set_rules('keywords', 'Key Words', 'trim');
		$this->form_validation->set_rules('pay_story', 'Monitization', 'trim|required');
		if ($this->form_validation->run() == false) {
			$this->load->view('header.php', $header);
    		$this->load->view('story.php');
            $this->load->view('footer.php');
		}else{
		    $picture1 =''; $image ='';
		    if(isset($_FILES['cover_image']['name']) && !empty($_FILES['cover_image']['name'])){
                $config['upload_path'] = 'assets/images/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size']     = '2048';
                $config['encrypt_name'] = TRUE;
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                if(!$this->upload->do_upload('cover_image')){
                    $error = array('error' => $this->upload->display_errors());
                    $this->load->view('header.php', $header);
            		$this->load->view('story.php', $error);
                    $this->load->view('footer.php');
                }else if($this->upload->do_upload('cover_image')){
                    $uploadData = $this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/images/'.$uploadData['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['quality'] = '85%';
                    $config['width'] = 293;
                    $config['height'] = 280;
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                    $picture1 = $uploadData['file_name'];
    
                    $validExtensions = array('.jpg', '.jpeg', '.gif', '.png'); //// array of valid extensions
                    $fileExtension = strrchr($_FILES['cover_image']['name'], "."); //// get extension of the uploaded file
                    // check if file Extension is on the list of allowed ones
                    if (in_array($fileExtension, $validExtensions)) {
                        $date = strtotime(date('Y-m-d h:i:s'));
                        $newNamePrefix = $date.'_';
                        $manipulator = new ImageManipulator($_FILES['cover_image']['tmp_name']);
                        $newImage = $manipulator->resample(200, 180);
                        $image = $newNamePrefix.$_FILES['cover_image']['name'];
                        // saving file to uploads folder
                        $manipulator->save('assets/images/'.$newNamePrefix.$_FILES['cover_image']['name']);
                    }
                }else{
                    $error = array('error' => $this->upload->display_errors());
                    $this->load->view('header.php', $header);
            		$this->load->view('story.php', $error);
                    $this->load->view('footer.php');
                }
            }
            $inputdata = array(
                'title' => $this->input->post('title'),
                'etitle' => $this->input->post('etitle'),
                'user_id' => $this->session->userdata['logged_in']['user_id'],
                'genre'=> $this->input->post('genre'),
                'copyrights' => $this->input->post('copyrights'),
                'keywords' => $this->input->post('keywords'),
                'language'=> $this->input->post('language'),
                'cover_image' => $picture1,
                'image' => $image,
                'pay_story' => $this->input->post('pay_story'),
                'date' => date("Y-m-d"),
                'type' => 'story',
                'draft' => 'draft',
            );
            $lid  = $this->User_model->series_story_uplode($inputdata);
            redirect(base_url().'series_story/'.$lid);
		}
    }
	public function series_story($lid) {
		if($this->session->userdata('logged_in')==NULL) redirect(base_url());
		$header['gener'] = $this->User_model->gener();
		$header['languages'] = $this->User_model->language();
        $data['res']  = $this->User_model->edit_story($lid);
        //$data['new_episode'] = $this->User_model->new_episode($lid);
        $data['new_episode'] = $this->User_model->new_episode_show($lid);
        $data['seriesftitle'] = $this->User_model->seriesftitle($lid);
       
		$this->load->view('header.php', $header);
		$this->load->view('series_story.php',$data);
        $this->load->view('footer.php');
	}
	public function addstory($lid){
	    $header['gener'] = $this->User_model->gener();
		$header['languages'] = $this->User_model->language();
		$data['res']  = $this->User_model->edit_story($lid);
		$this->form_validation->set_rules('story', 'story', 'trim|required');
		$this->form_validation->set_rules('story_id', 'story_id', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
    		$this->load->view('series_story.php',$data);
            $this->load->view('footer.php');
        } else {
			$inputdata = array(
				'story' => $this->input->post('story'),
				'story_id' => $this->input->post('story_id'), // or 'story_id' => $lid, for type 'story' writing
				////'draft' => '',
			);
			if(strlen($_POST['story']) > 199){ $inputdata['draft'] = ''; }else{ $inputdata['draft'] = 'draft';	}
			if(isset($_POST['lastepisode']) && ($_POST['lastepisode'] == 'yes')){
			    $inputdata['last_episode'] = $_POST['lastepisode'];
			}
			if(isset($_POST['fromdraft']) && ($_POST['fromdraft'] == 'fromdraft')){
			    //$lid = $_POST['sid'];
			}else{
			    //$inputdata['story_id'] = $this->input->post('story_id');
			}
			$res = $this->User_model->addstory($inputdata,$lid, 'predraftseriespub'); //publish previous draft series
			if($inputdata['draft'] == 'draft'){
			    $this->session->set_flashdata('msg','Story needs minimum 200 characters.');
			    redirect(base_url().'addstory/'.$lid);
			}else{
			    redirect(base_url('home'));
			}
		}
	}
	public function seriesaddstory($lid){
	    
	    $header['gener'] = $this->User_model->gener();
		$header['languages'] = $this->User_model->language();
		$data['res']  = $this->User_model->edit_story($lid);
		$this->form_validation->set_rules('story', 'story', 'trim|required');
		$this->form_validation->set_rules('story_id', 'story_id', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
    		$this->load->view('header.php', $header);
    		$this->load->view('series_story.php',$data);
            $this->load->view('footer.php');
        } else {
			$inputdata = array(
				'story' => $this->input->post('story'),
				'draft' => '',
			);
			if(isset($_POST['lastepisode']) && ($_POST['lastepisode'] == 'yes')){
			    $inputdata['last_episode'] = $_POST['lastepisode'];
			}
			$res = $this->User_model->seriesaddstory($inputdata,$lid);
			redirect(base_url('drafts'));
		}
	}
	public function nano_story()
	{
		if($this->session->userdata('logged_in')==NULL) redirect(base_url());
		$header['gener'] = $this->User_model->gener();
		$header['languages'] = $this->User_model->language();
	    $this->load->view('header.php', $header);
		$this->load->view('nano_story.php');
        $this->load->view('footer.php');
	}
	public function nano_insert(){
	    $header['gener'] = $this->User_model->gener();
		$header['languages'] = $this->User_model->language();
		$this->form_validation->set_rules('story', 'Story', 'trim|required');
		$this->form_validation->set_rules('language', ' Language','trim|required');
		if ($this->form_validation->run() == false) {
		    $this->load->view('header.php', $header);
    		$this->load->view('nano_story.php',$data);
            $this->load->view('footer.php');
		}else{
    		$user_id = $this->session->userdata['logged_in']['user_id'];
    		$story = $this->input->post('story');
    		$language = $this->input->post('language');
    		$data=array(
    			'user_id' => $user_id,
    			'story' => $story,
    			'language' => $language,
    			'type' => 'nano',
    	    );
    	    $data = $this->User_model->nano_insert($data);
    	    redirect(base_url().'home');
		}
	}
	public function life() {
		if($this->session->userdata('logged_in')==NULL) redirect(base_url());
		$header['gener'] = $this->User_model->gener();
		$header['languages'] = $this->User_model->language();
		$data['tagslist'] = $this->User_model->lifetagslist();
		$this->load->view('header.php', $header);
		$this->load->view('life.php',$data);
		$this->load->view('footer.php');
	}
	public function life_story_uplode() {
	    $header['gener'] = $this->User_model->gener();
		$header['languages'] = $this->User_model->language();
		$data['tagslist'] = $this->User_model->lifetagslist();
	    $this->form_validation->set_rules('language', 'Language','trim|required');
		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		if(isset($_POST['language']) && ($_POST['language'] != 'en')){
		    $this->form_validation->set_rules('etitle', 'English Title', 'trim|required');
		}
		$this->form_validation->set_rules('copyrights', 'Copy Rights', 'trim|required');
		$this->form_validation->set_rules('keywords', 'Key Words', 'trim');
		$this->form_validation->set_rules('writing_style', 'Writing Style', 'trim|required');
		$this->form_validation->set_rules('pay_story', 'Monitization', 'trim|required');
		if ($this->form_validation->run() == false) {
            $this->load->view('header.php', $header);
            $this->load->view('life.php',$data);
            $this->load->view('footer.php');
		}else{
		    $picture1 =''; $image ='';
		    if(isset($_FILES['cover_image']['name']) && !empty($_FILES['cover_image']['name'])){
                $config['upload_path'] = 'assets/images/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size']     = '2048';
                $config['encrypt_name'] = TRUE;
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                if(!$this->upload->do_upload('cover_image')){
                    $data = array('error' => $this->upload->display_errors());
                    $this->load->view('header.php', $header);
                    $this->load->view('life.php', $data);
                    $this->load->view('footer.php');
                }else if($this->upload->do_upload('cover_image')){
                    $uploadData = $this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/images/'.$uploadData['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = FALSE;
                    $config['quality'] = '85%';
                    $config['width'] = 293;
                    $config['height'] = 280;
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                    $picture1 = $uploadData['file_name'];
                    
                    $date = strtotime(date('Y-m-d h:i:s'));
                    $newNamePrefix = $date.'_';
                    $manipulator = new ImageManipulator($_FILES['cover_image']['tmp_name']);
                    $newImage = $manipulator->resample(266, 165, false);
                    $image = $newNamePrefix.$_FILES['cover_image']['name'];
                    // saving file to uploads folder
                    $manipulator->save('assets/images/'.$newNamePrefix.$_FILES['cover_image']['name']);
                        
                }else{
                    $error = array('error' => $this->upload->display_errors());
                    $this->load->view('header.php', $header);
                    $this->load->view('life.php', $data);
                    $this->load->view('footer.php');
                }
            }
            $keywords = '';
            if(isset($_POST['keywords']) && count($_POST['keywords']) > 0){
                $keywords = implode(',',$this->input->post('keywords'));
            }
            $inputdata = array(
                'title' => $this->input->post('title'),
                'etitle' => $this->input->post('etitle'),
                'user_id' => $this->session->userdata['logged_in']['user_id'],
                'copyrights' => $this->input->post('copyrights'),
                'keywords' => $keywords,
                'language'=> $this->input->post('language'),
                'cover_image' => $picture1,
                'image' => $image,
                'pay_story' => $this->input->post('pay_story'),
                'writing_style' => $this->input->post('writing_style'),
                'date' => date("Y-m-d"),
                'type' => 'life',
                'draft' => 'draft',
            );
            $lifetags = $this->User_model->lifetags($this->input->post('keywords'));
            $lid  = $this->User_model->series_story_uplode($inputdata);
            redirect(base_url().'series_story/'.$lid);
	    }
    }
	
	//<!-- Transaction -->
	public function trans() {
	    if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){
    	    $user_id = $this->session->userdata['logged_in']['user_id'];
    	    $data['transactions'] = $this->User_model->transactions($user_id);
    	    $data['transstories'] = $this->User_model->transstories($user_id);
    	    $this->load->view('header.php');
    	    $this->load->view('transaction.php',$data);
    	    $this->load->view('footer.php');
	    }else{
	        redirect(base_url().'home');
	    }
	}
	
	public function share_feed_communities(){
    	if($this->session->userdata('logged_in')==NULL) redirect(base_url());
    	$user_id = $this->session->userdata['logged_in']['user_id'];
    	$username = $this->session->userdata['logged_in']['name'];
    	$storyid = $this->input->post('sid');
    	$title = $this->input->post('title');
    	$image = $this->input->post('image');
    	$story = $this->input->post('story');
    	$type = $this->input->post('type');
    	$url = $this->input->post('url');
    	$comm_ids = '';
    	$comm_ids = $this->input->post('comm_id');
    	
    	$description = ''; //$comm_ids = '';
    	if(isset($_POST['description'])){
    	    $description = $this->input->post('description');
    	}
    	/*if(isset($_POST['comm_ids']) && count($_POST['comm_ids'])){
    	    $comm_ids = $_POST['comm_ids'];
    	}elseif(isset($_POST['comm_id']) && count($_POST['comm_id'])){
    	    $comm_ids = $this->input->post('comm_id');
    	}else{
    	    $comm_ids = '';
    	}*/
    	$author = array('storywname' => $this->input->post('storywname'), 'storywid' => $this->input->post('storywid'));
    	$data = array(
    		'user_id' => $user_id,
    		'name' => $username,
    		'story' => $story,
    		//'date' => date('Y-m-d H:i:s'),
    		'titleurl' => $url,
    		'image' => $image,
    		'title' => $title,
    		'type' => $type,
    		'urldescription' => $description,
    	);
    	$response = $this->User_model->share_feed_communities($data,$comm_ids,$storyid, $author);
    	if($response){
    	    echo 1;
    	}else{
    	    echo 0;
    	}
    }
    public function friendnote(){
    	if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){
        	$user_id = $this->session->userdata['logged_in']['user_id'];
        	$username = $this->session->userdata['logged_in']['name'];
        	$title = $this->input->post('title');
        	$sid = $this->input->post('sid');
        	$to_idtext = $this->input->post('to_idtext');
        	$redirect_uri = 'only_story_view?id='.$sid;
        	if(isset($_POST['url']) && !empty($_POST['url'])){
        	    $redirect_uri = $this->input->post('url');
        	}
        	$data = array(
        		'from_id' => $user_id,
        		'from_name' => $username,
        		'title_id' => $sid,
        		'redirect_uri' => $redirect_uri,
        		'type'=>'suggestion',
        		'title'=> $title,
        		'description' => $to_idtext,
        	);
        	$to_ids = '';
        	if(isset($_POST['to_ids'])){
        	    $to_ids = $_POST['to_ids'];
        	}elseif(isset($_POST['to_id'])){
        	    $to_ids = $_POST['to_id'];
        	}else{
        	    $to_ids = '';
        	}
        	$response = $this->User_model->frindnote($data, $to_ids);
        	if($response){
        	    echo 1;
        	}else{
        	    echo 0;
        	}
    	}else{
    	    echo 0;
    	}
    }
    
    public function follow(){
		if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){
    		$user_id = $this->session->userdata['logged_in']['user_id'];
        	$name = $this->session->userdata['logged_in']['name'];
        	$writer_id = $this->input->post('writer_id');
        	$writer_name = $this->input->post('writer_name');
        	if($user_id != $writer_id){
            	$data = array(
            		'user_id' => $user_id,
            		'name' => $name,
            		'writer_id' => $writer_id,
            		'writer_name' => $writer_name,
            		'date' => DATE('Y-m-d'),
            	);
            	$response = $this->User_model->follow($data);
            	if($response){
            		$this->output->set_output(json_encode($response));
            	} else {
            		$this->output->set_output(json_encode('fail'));
            	}
        	}else{
        	    $this->output->set_output(json_encode('fail'));
        	}
		}
    }
    public function communities() {
	    $header['languages'] = $this->User_model->language();
	    $header['gener'] = $this->User_model->gener();
		$data['get_communities'] = $this->User_model->get_communities(8);
		$data['join_comm'] = $this->User_model->join_communities();
		$data['joinedcommunities'] = $this->User_model->joinedcommunities(0,8);
		$data['unjoinedcommunities'] = $this->User_model->unjoinedcommunities($data['join_comm'],0,8);
		$this->load->view('header.php', $header);
		$this->load->view('communities.php',$data);
        $this->load->view('footer.php');
	}
	public function loadcommunities(){
	    if(isset($_POST['limit']) && !empty($_POST['start'])){
	        $data['get_communities'] = $this->User_model->loadcommunities($_POST['start'], $_POST['limit']);
	        $this->load->view('loadcommunities.php',$data);
	    }
	}
	public function floadcommunities(){
	    if(isset($_POST['limit']) && !empty($_POST['start'])){
	        $data['join_comm'] = $this->User_model->join_communities();
	        $data['unjoinedcommunities'] = $this->User_model->unjoinedcommunities($data['join_comm'],$_POST['start'], $_POST['limit']);
	        $this->load->view('loadcommunities.php',$data);
	    }
	}
	public function jloadcommunities(){
	    if(isset($_POST['limit']) && !empty($_POST['start'])){
	        $data['join_comm'] = $this->User_model->join_communities();
	        $data['joinedcommunities'] = $this->User_model->joinedcommunities($_POST['start'],$_POST['limit']);
	        $this->load->view('loadcommunities.php',$data);
	    }
	}
	public function testing() {	
        if(isset($_POST['searchurl'])){
            $_POST['searchurl'] = (parse_url($_POST['searchurl'], PHP_URL_SCHEME) ? '' : 'http://') . $_POST['searchurl'];
        }
 		$this->form_validation->set_rules('searchurl', ' Story', 'trim|valid_url');
 		$this->form_validation->set_rules('community_id','Community','trim|required');
		if ($this->form_validation->run() == TRUE) {
			$title = ''; $description = ''; $image = '';
			$tags = get_meta_tags($_POST['searchurl']);
			if(isset($tags['title']) && !empty($tags['title'])){
				$title = $tags['title'];
			}
			if(isset($tags['description']) && !empty($tags['description'])){
				$description = $tags['description'];
			}
			$fp = file_get_contents($_POST['searchurl']);
	        $html_encoded = htmlentities($fp);
	        if (!$fp) 
	            $urlcontent = '';
	        if($title == ''){
		        $titleres = preg_match("/<title>(.*)<\/title>/siU", $fp, $title_matches);
		        if (!$titleres) 
		            $title = ''; 
		        $title = preg_replace('/\s+/', ' ', $title_matches[1]);
		        $title = trim($title);
		    }

	        $imageres = preg_match_all('@property="og:image" content="([^"]+)"@' , $fp, $image_matches);
	        if(!$imageres)
	       		$image = '';
	       		if(isset($image_matches[1][0]) && !empty($image_matches[1][0]))
	       			$image = $image_matches[1][0];
	       		$user_id = $this->session->userdata['logged_in']['user_id'];
				$name = $this->session->userdata['logged_in']['name'];
	       		$data = array(
					'user_id' => $user_id,
					'name' => $name,
					'comm_id' => $_POST['community_id'],
					'story' => $description,
					'titleurl' => $_POST['searchurl'],
					'title' => $title,
					'image' => $image,
					'date' => DATE('Y-m-d'),
					'type' =>'url',
					'urldescription' => $_POST['urldescription'],
				);
				$this->output->set_output(json_encode($data));
		}else{
			$this->output->set_output(json_encode('wrongurl'));
		}
 	}
 	
	public function co_view() {
        if($this->session->userdata('logged_in')==NULL) redirect(base_url());
        $header['languages'] = $this->User_model->language();
        $header['gener'] = $this->User_model->gener();
        $data['communities_story_get']=$this->User_model->communities_story_get('',0,6);
        $data['communities_story_get_likes']=$this->User_model->communities_get_topstory('',0,6);
        $data['communities_story_weekback']=$this->User_model->communities_story_weekback();
        //$data['communities_comments_get'] = $this->User_model->communities_comments_get();
        $data['comm_comment_count'] = $this->User_model->comm_comment_count();
        //$data['comm_like_count'] = $this->User_model->comm_like_count();
        $data['commstory_likes'] = $this->User_model->usercommstory_likes();
        $data['get_communities_adout'] = $this->User_model->get_communities_adout();
        $data['get_communities_all'] = $this->User_model->get_communities();
        $data['join_comm'] = $this->User_model->join_communities();
        $data['comm_joines'] = $this->User_model->comm_joines();
        $data['following'] = $this->User_model->following();
        
        $this->load->view('header.php', $header);
        $this->load->view('co_view.php',$data);    
        $this->load->view('footer.php');
    }
    public function commstoryview($commid, $comm_storyid){
        $header['languages'] = $this->User_model->language();
        $data['communities_story_get']=$this->User_model->commstoryview($commid, $comm_storyid);
        $data['comm_comment_count'] = $this->User_model->comm_comment_count();
        $data['commstory_likes'] = $this->User_model->usercommstory_likes();
        $data['get_communities_adout'] = $this->User_model->get_communities_adout();
        $data['get_communities_all'] = $this->User_model->get_communities();
        $data['join_comm'] = $this->User_model->join_communities();
        $data['comm_joines'] = $this->User_model->comm_joines();
        $data['following'] = $this->User_model->following();
        
        $this->load->view('header.php', $header);
        $this->load->view('commstoryview.php',$data);    
        $this->load->view('footer.php');
	}
    public function loadcommustories($commuid){
 	    if(isset($_POST['limit']) && !empty($_POST['start'])){
 	        $data['loadcommustories']=$this->User_model->communities_story_get($commuid,$_POST['start'], $_POST['limit']);
 	        $data['comm_comment_count'] = $this->User_model->comm_comment_count();
 	        $this->load->view('loadcommustories.php',$data);
 	    }
 	}
 	public function toploadcommustories($commuid){
 	    if(isset($_POST['limit']) && !empty($_POST['start'])){
 	        $data['toploadcommustories']=$this->User_model->communities_get_topstory($commuid,$_POST['start'], $_POST['limit']);
 	        $data['comm_comment_count'] = $this->User_model->comm_comment_count();
 	        $this->load->view('loadcommustories.php',$data);
 	    }
 	}
    public function communities_joinform(){
        if(isset($this->session->userdata['logged_in']['user_id'])){
        	$user_id = $this->session->userdata['logged_in']['user_id'];
        	$username = $this->session->userdata['logged_in']['name'];
        	$comm_id = $this->input->post('comm_id');
        	$gener = $this->input->post('gener');
        	$data = array(
        		'user_id' => $user_id,
        		'username' => $username,
        		'comm_id' => $comm_id,
        		'gener' => $gener,
        		'status' => 'joined'
        	);
        	$response = $this->User_model->communities_join($data);
        	redirect(base_url('co_view/'.$comm_id));
        }else{
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function communities_join(){
    	if($this->session->userdata('logged_in')==NULL) redirect(base_url());
    	if(isset($_POST['comm_id']) && !empty($_POST['comm_id']) && isset($_POST['gener']) && !empty($_POST['gener'])) {
        	$user_id = $this->session->userdata['logged_in']['user_id'];
        	$username = $this->session->userdata['logged_in']['name'];
        	$comm_id = $this->input->post('comm_id');
        	$gener = $this->input->post('gener');
        	$data = array(
        		'user_id' => $user_id,
        		'username' => $username,
        		'comm_id' => $comm_id,
        		'gener' => $gener,
        		'status' => 'joined'
        	);
        	$response = $this->User_model->communities_join($data);
        	//redirect(base_url('index.php/Welcome/co_view/'.$comm_id),'refresh');
        	if($response){
        	    $this->output->set_output(json_encode($response));
        	}else{
        	    $this->output->set_output(json_encode('fail'));
        	}
    	}else{
    	    $this->output->set_output(json_encode('fail'));
    	}
    }
    public function communities_story() {
		if($this->session->userdata('logged_in')==NULL) redirect(base_url());
		$user_id = $this->session->userdata['logged_in']['user_id'];
		$name = $this->session->userdata['logged_in']['name'];
		if(isset($_POST['type']) && ($_POST['type'] == 'url')){
            $_POST['story'] = (parse_url($_POST['story'], PHP_URL_SCHEME) ? '' : 'http://') . $_POST['story'];
			$this->form_validation->set_rules('story','Story', 'trim|required|valid_url');
			//$this->form_validation->set_rules('story','Story', 'trim|required|regex_match[/^(?:(ftp|http|https)?:\/\/)?(?:[\w-]+\.)+([a-z]|[A-Z]|[0-9]){2,6}$/gi]');
			if ($this->form_validation->run() == FALSE) {
				echo 'wrongurl';
			}else{
				$comm_id = $this->input->post('comm_id');
				$story_url = $this->input->post('story');
				$urldescription = $this->input->post('urldescription');
				$title = ''; $description = ''; $image = '';
				if(filter_var($story_url, FILTER_VALIDATE_URL)){
    				$tags = get_meta_tags($story_url);
    				if(isset($tags['title']) && !empty($tags['title'])){
    					$title = $tags['title'];
    				}
    				if(isset($tags['description']) && !empty($tags['description'])){
    					$description = $tags['description'];
    				}
    				$fp = file_get_contents($story_url);
    		        $html_encoded = htmlentities($fp);
    		        if (!$fp) 
    		            $urlcontent = '';
    		        if($title == ''){
    			        $titleres = preg_match("/<title>(.*)<\/title>/siU", $fp, $title_matches);
    			        if (!$titleres) 
    			            $title = ''; 
    			        $title = preg_replace('/\s+/', ' ', $title_matches[1]);
    			        $title = trim($title);
    			    }
    		        $imageres = preg_match_all('@property="og:image" content="([^"]+)"@' , $fp, $image_matches);
    		        if(!$imageres)
    		       		$image = '';
    		       		if(isset($image_matches[1][0]) && !empty($image_matches[1][0]))
    		       			$image = $image_matches[1][0];
    	       		$data = array(
    					'user_id' => $user_id,
    					'name' => $name,
    					'comm_id' => $comm_id,
    					'story' => $description,
    					'titleurl' => $story_url,
    					'title' => $title,
    					'image' => $image,
    					//'date' => DATE('Y-m-d'),
    					'type' =>'url',
    					'urldescription' => $urldescription,
    					//'comm_language' => $this->session->userdata['language'],
    				);
    				if(!empty($title) || !empty($description)){
    					$requestdata['insertedposts'] = $this->User_model->communities_story($data);
    					if($requestdata['insertedposts']->num_rows() > 0){
    					    $requestdata['commstory_likes'] = $this->User_model->usercommstory_likes();
    					    $requestdata['comm_comment_count'] = $this->User_model->comm_comment_count();
    					    $this->load->view('posturlform', $requestdata);
    					}else{
    						echo 'fail';
    					}
    				}else{
    					echo 'notvalid';
    				}
				}else{
				    echo 'notvalid';
				}
			}
		}else{
			$this->form_validation->set_rules('story','Story', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				echo 'noinput';
			}else{
				$quotes = ''; $story = '';
				if(isset($_POST['quotes'])){
					$quotes = $this->input->post('quotes');
				}
				$comm_id = $this->input->post('comm_id');
				if($quotes == 'quotes'){
					$story = '<i class="fa fa-quote-left fa-2x"> </i> '.$this->input->post('story');
				}else{
					$story = $this->input->post('story');
				} 
				$comm_id = $this->input->post('comm_id');
				$data = array(
					'user_id' => $user_id,
					'name' => $name,
					'comm_id' => $comm_id,
					'story' => $story,
					//'date' => DATE('Y-m-d H:i:s'),
					'type' =>'story',
					//'comm_language' => $this->session->userdata['language'],
				);
				if($quotes == 'quotes'){
				    $data['typeoftype'] = 'quotes';
				}
				if(!empty($story)){
					$requestdata['insertedposts'] = $this->User_model->communities_story($data);
					if($requestdata['insertedposts']->num_rows() > 0){
					    $requestdata['commstory_likes'] = $this->User_model->usercommstory_likes();
					    $requestdata['comm_comment_count'] = $this->User_model->comm_comment_count();
					    $this->load->view('posturlform', $requestdata);
					}else{
						echo 'fail';
					}
				}else{
					echo 'noinput';
				}
			}
		}
	}
	public function updatecomm_post(){
	    if($this->session->userdata('logged_in')==NULL) redirect(base_url());
		$user_id = $this->session->userdata['logged_in']['user_id'];
		$name = $this->session->userdata['logged_in']['name'];
		$comm_storyid = $this->input->post('comm_storyid');
		if(isset($_POST['url']) && ($_POST['url'] == 'url')){
		    $this->form_validation->set_rules('story','Story', 'trim|required|valid_url');
		}
		if ($this->form_validation->run() == TRUE) {
			$story_url = $this->input->post('story');
			$title = ''; $description = ''; $image = '';
			$tags = get_meta_tags($story_url);
			if(isset($tags['title']) && !empty($tags['title'])){
				$title = $tags['title'];
			}
			if(isset($tags['description']) && !empty($tags['description'])){
				$description = $tags['description'];
			}
			$fp = file_get_contents($story_url);
	        $html_encoded = htmlentities($fp);
	        if (!$fp) 
	            $urlcontent = '';
	        if($title == ''){
		        $titleres = preg_match("/<title>(.*)<\/title>/siU", $fp, $title_matches);
		        if (!$titleres) 
		            $title = ''; 
		        $title = preg_replace('/\s+/', ' ', $title_matches[1]);
		        $title = trim($title);
		    }
	        $imageres = preg_match_all('@property="og:image" content="([^"]+)"@' , $fp, $image_matches);
	        if(!$imageres)
	       		$image = '';
	       		if(isset($image_matches[1][0]) && !empty($image_matches[1][0]))
	       			$image = $image_matches[1][0];
	       		$user_id = $this->session->userdata['logged_in']['user_id'];
				$name = $this->session->userdata['logged_in']['name'];
	       		$data = array(
					'user_id' => $user_id,
					'name' => $name,
					'story' => $description,
					'titleurl' => $story_url,
					'title' => $title,
					'image' => $image,
					'date' => DATE('Y-m-d'),
					'type' =>'url',
					//'comm_language' => $this->session->userdata['language'],
				);
				$request = $this->User_model->updatecomm_post($data, $comm_storyid);
				if($request) {
    				$response['status'] = 1;
    				$response['response'] = 'success';
    				echo json_encode($response);
    			}else{
    				$response['status'] = 1;
    				$response['response'] = 'fail';
    				echo json_encode($response);
    			}
		}else{
		    $this->form_validation->set_rules('story','Story', 'trim|required');
		    if ($this->form_validation->run() == false) {
    			$response['validations'] = $this->form_validation->error_array();
    			$response['status']=-1;
    			echo json_encode($response);
    		}else{
    		    $quotes = ''; $story = '';
    			if(isset($_POST['quotes'])){
    				$quotes = $this->input->post('quotes');
    			}
    			if($quotes == 'quotes'){
    				//$story = '<i class="fa fa-quote-left fa-2x"> </i> '.$this->input->post('story');
    				if(strpos($_POST['story'], 'fa-quote-left')){
    				    $story = $this->input->post('story');
    				}else{
    				    $story = '<i class="fa fa-quote-left fa-2x"> </i> '.$this->input->post('story');
    				}
    			}else{
    				$story = $this->input->post('story');
    			}
    			$data = array(
    				'user_id' => $user_id,
    				'name' => $name,
    				'story' => $story,
    				//'date' => DATE('Y-m-d H:i:s'),
    				'type' =>'story',
    				//'comm_language' => $this->session->userdata['language'],
    			);
    			if($quotes == 'quotes'){
    			    $data['typeoftype'] = 'quotes';
    			}
    			if(!empty($story)){
        			$request1 = $this->User_model->updatecomm_post($data, $comm_storyid);
        			if($request1) {
        				$response['status'] = 1;
        				$response['response'] = 'success';
        				echo json_encode($response);
        			}else{
        				$response['status'] = 1;
        				$response['response'] = 'fail';
        				echo json_encode($response);
        			}
    			}else{
    			    $response['status'] = 1;
    				$response['response'] = 'fail';
    				echo json_encode($response);
    			}
    		}
		}
	}
	public function communities_comments(){
    	if($this->session->userdata('logged_in')==NULL) redirect(base_url());
    	if(isset($_POST['tcomment']) && isset($_POST['tstory_id']) && isset($_POST['tcomm_id'])){
    	    $_POST['comment'] = $_POST['tcomment']; $_POST['story_id'] = $_POST['tstory_id']; $_POST['comm_id'] = $_POST['tcomm_id'];
    	}
    	if(isset($_POST['comment']) && !empty($_POST['comment'])){
	    	$user_id = $this->session->userdata['logged_in']['user_id'];
	    	$name = $this->session->userdata['logged_in']['name'];
	    	$comm_id = $this->input->post('comm_id');
	    	$story_id = $this->input->post('story_id');
	    	$comment = $this->input->post('comment');
	    	$inputdata = array(
	    		'user_id' => $user_id,
	    		'name' => $name,
	    		'comm_id' => $comm_id,
	    		'story_id' => $story_id,
	    		'comment' => $comment,
	    		//'date' => DATE('Y-m-d'),
	    	);
	    	if(isset($_POST['comment_id'])){
	    	    $inputdata['comment_id'] = $_POST['comment_id'];
	    	}
	    	$result = $this->User_model->communities_comments($inputdata);
	    	if($result){
	    	    if(isset($this->session->userdata['logged_in']['profile_image']) && !empty($this->session->userdata['logged_in']['profile_image'])){
	    	        $inputdata['profile_image'] = $this->session->userdata['logged_in']['profile_image'];
	    	    }else{
	    	        $inputdata['profile_image'] = '2.png';
	    	    }
	    	    $inputdata['id'] = $result;
	    		$data['status'] = 1;
				$data['response'] = $inputdata;
				echo json_encode($data);
	    	}else{
	    		$data['status'] = 2;
				$data['response'] = 'fail';
				echo json_encode($data);
	    	}	
	    }else{
	    	$data['validations'] = 'Please Enter Comment Message';
			$data['status'] = -1;
			echo json_encode($data);
	    }
    }
    public function editcomm_post(){
        if(isset($_POST['comm_story_id']) && !empty($_POST['comm_story_id']) && isset($_POST['posted_by']) && ($_POST['posted_by'] == $this->session->userdata['logged_in']['user_id'])){
			$data['editcomm_post'] = $this->User_model->editcomm_post($_POST['comm_story_id']);
			$this->load->view('editcomm_post',$data);
		}else{
			echo 0;
		}
	}
	public function deletecomm_post(){
	    if(isset($_POST['comm_story_id']) && !empty($_POST['comm_story_id']) && isset($_POST['posted_by']) && ($_POST['posted_by'] == $this->session->userdata['logged_in']['user_id'])){
			$result = $this->User_model->deletecomm_post($_POST['comm_story_id']);
			if($result){
				echo 1;
			}else{
				echo 0;
			}
		}else{
			echo 0;
		}
	}
    public function communities_commentslast(){
        $response = $this->User_model->communities_commentslast();
        if($response->num_rows() > 0){
			$data['response'] = $response->result();
			echo json_encode($data);
        }else{
            $data['response'] = '';
            echo json_encode($data);
        }
    }
    public function comm_likes(){
		$user_id=$this->session->userdata['logged_in']['user_id'];
    	$name=$this->session->userdata['logged_in']['name'];
    	$story_id=$this->input->post('story_id');
    	$data = array(
    		'user_id' => $user_id,
    		'name' => $name,
    		'story_id' => $story_id,
    		'likes' => 'like',
    		//'date' => DATE('Y-m-d'),
    	);
    	$response = $this->User_model->comm_likes($data,$story_id);
    	if($response){
    		echo 1;
    	}else{
    		echo 0;
    	}
    }
    public function feed() {
        $header['gener'] = $this->User_model->gener();
    	$header['languages'] = $this->User_model->language();
		$data['feed'] = $this->User_model->feed(0,6);
		$data['yourfeeds'] = $this->User_model->yourfeeds(0,6);
		$data['storiesfeed'] = $this->User_model->storiesfeed(0,6);
		$data['feed_comments'] = $this->User_model->feed_comments();
		$data['comm_comment_count'] = $this->User_model->comm_comment_count();
    	$data['commstory_likes'] = $this->User_model->usercommstory_likes();
    	$data['join_comm'] = $this->User_model->join_communities();
    	$data['get_communities_all'] = $this->User_model->get_communities('all');
		$this->load->view('header.php', $header);
		$this->load->view('sidebar.php');
		$this->load->view('feed.php',$data);
        $this->load->view('footer.php');
	}
	
	public function loadmorefeed(){
	    if(isset($_POST['limit']) && !empty($_POST['start'])){
	        $data['feedtab'] = $this->User_model->feed($_POST['start'], $_POST['limit']);
	        $this->load->view('loadmorefeed.php',$data);
	    }
	}
	public function loadmoreyourfeed(){
	    if(isset($_POST['limit']) && !empty($_POST['start'])){
	        $data['yourfeedtab'] = $this->User_model->yourfeeds($_POST['start'], $_POST['limit']);
	        $this->load->view('loadmorefeed.php',$data);
	    }
	}
	public function loadmorestoryfeed(){
	    if(isset($_POST['limit']) && !empty($_POST['start'])){
	        $data['storiesfeed'] = $this->User_model->storiesfeed($_POST['start'], $_POST['limit']);
	        $this->load->view('loadmorefeed.php',$data);
	    }
	}
	
	/* Story feed comments start */
	public function fscomment(){
	    $storyid = $this->input->post('storyid');
    	if(isset($_POST['comment']) && !empty($_POST['comment']) && isset($this->session->userdata['logged_in']['user_id'])){
        	$user_id = $this->session->userdata['logged_in']['user_id'];
        	$name = $this->session->userdata['logged_in']['name'];
        	$comment = $this->input->post('comment');
        	$inputdata = array(
        		'comment' => $comment,
        		'story_id' => $storyid,
        		'user_id' => $user_id,
        		'name' => $name,
        	);
        	$response = $this->User_model->comment($inputdata,$storyid);
        	if($response->num_rows() > 0){
        	    $resdata = $response->result();
        	    $hydhmdatetime = 'hydhmdatetime';
        	    $resdata[0]->$hydhmdatetime = $this->User_model->hydhmdatetime($resdata[0]->date);
        	    
	    		$data['status'] = 1;
				$data['response'] = $resdata[0];
				echo json_encode($data);
	    	}else{
	    		$data['status'] = 2;
				$data['response'] = 'fail';
				echo json_encode($data);
	    	}
        }else{
            $data['status'] = 2;
			$data['response'] = 'fail';
			echo json_encode($data);
        }
	}
	public function storyloadcomments(){
	     if(isset($_POST["limit"], $_POST["start"], $_POST['story_id']) && !empty($_POST['story_id'])){
            $data['comment_get'] = $this->User_model->comment_get($_POST['story_id'], $_POST["start"], $_POST["limit"]);
            $this->load->view('storyloadcomments.php',$data);
        }
	}
	public function fsloadcomments(){
	    if(isset($_POST['storyid']) && !empty($_POST['storyid']) && isset($_POST['commentid']) && !empty($_POST['commentid'])){
    	    $data['fsloadcomments'] = $this->User_model->fsloadcomments($_POST['storyid'], $_POST['commentid']);
    	    $data['fslastcomment'] = $this->User_model->fslastcomment($_POST['storyid']);
    	    $this->load->view('fsloadcomments.php',$data);
	    }
	}
	public function fsloadsubcomment(){
	    if(isset($_POST['storyid']) && !empty($_POST['storyid']) && isset($_POST['comment_id']) && 
	    !empty($_POST['comment_id']) && isset($_POST['subcommentid']) && !empty($_POST['subcommentid']) ){
    	    $data['fsloadsubcomments'] = $this->User_model->fsloadsubcomments($_POST['storyid'], $_POST['comment_id'],$_POST['subcommentid']);
    	    $data['fslastsubcomment'] = $this->User_model->fslastsubcomment($_POST['storyid'], $_POST['comment_id']);
    	    $this->load->view('fsloadcomments.php',$data);
	    }
	}
	public function toberead(){
		if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){
            $userid = $this->session->userdata['logged_in']['user_id'];
            $header['gener'] = $this->User_model->gener();
            $header['languages'] = $this->User_model->language();
            $data['rlseries'] = $this->User_model->libraryseries($userid, 'readlater');
            $data['rlstories'] = $this->User_model->librarystories($userid, 'readlater');
            $data['rllife'] = $this->User_model->librarylife($userid, 'readlater');
            /*$data['scseries'] = $this->User_model->libraryseries($userid, 'seriessubscribe');
            $data['scstories'] = $this->User_model->librarystories($userid, 'seriessubscribe');
            $data['sclife'] = $this->User_model->librarylife($userid, 'seriessubscribe');
            $data['frseries'] = $this->User_model->libraryseries($userid, 'favorite');
            $data['frstories'] = $this->User_model->librarystories($userid, 'favorite');
            $data['frlife'] = $this->User_model->librarylife($userid, 'favorite');*/
            
            $data['reviews21'] = $this->User_model->reviews2();
            $data['allusers'] = $this->User_model->allusers();
            $data['favorites'] = $this->User_model->favorites();
            $data['favoriteslife'] = $this->User_model->favorites('life');
            $data['subscribes'] = $this->User_model->subscribes();
            $this->load->view('header', $header);
            $this->load->view('sidebar.php');
    		$this->load->view('library',$data);
    		$this->load->view('footer');
		}else{
		    redirect(base_url().'home');
		}
	}
	public function seriessubscribe(){
	    if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){
            $userid = $this->session->userdata['logged_in']['user_id'];
    	    $data['scseries'] = $this->User_model->libraryseries($userid, 'seriessubscribe');
            $data['scstories'] = $this->User_model->librarystories($userid, 'seriessubscribe');
            $data['sclife'] = $this->User_model->librarylife($userid, 'seriessubscribe');
            $data['reviews21'] = $this->User_model->reviews2();
            $data['allusers'] = $this->User_model->allusers();
            $data['favorites'] = $this->User_model->favorites();
            $data['favoriteslife'] = $this->User_model->favorites('life');
            $data['subscribes'] = $this->User_model->subscribes();
            $this->load->view('librarysubscribe',$data);
	    }
	}
	public function storiesfavorite(){
	    if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){
            $userid = $this->session->userdata['logged_in']['user_id'];
    	    $data['frseries'] = $this->User_model->libraryseries($userid, 'favorite');
            $data['frstories'] = $this->User_model->librarystories($userid, 'favorite');
            $data['frlife'] = $this->User_model->librarylife($userid, 'favorite');
            $data['reviews21'] = $this->User_model->reviews2();
            $data['allusers'] = $this->User_model->allusers();
            $data['favorites'] = $this->User_model->favorites();
            $data['favoriteslife'] = $this->User_model->favorites('life');
            $data['subscribes'] = $this->User_model->subscribes();
    		$this->load->view('libraryfavorite',$data);
	    }
    }
	
	public function deletelibrary() {
	    if(isset($_POST['story_id']) && !empty($_POST['story_id']) && isset($_POST['type']) && !empty($_POST['type'])){
			$result = $this->User_model->deletelibrary($_POST['story_id'], $_POST['type']);
			if($result){
				echo 1;
			}else{
				echo 0;
			}
		}else{
			echo 0;
		}
	}
	public function nanoviewsadd(){
	    if(isset($_POST['sid']) && !empty($_POST['sid'])){
	        $response = $this->User_model->viewsupdate($_POST['sid']);
	        if($response){
	            echo 1;
	        }else{
	            echo 0;
	        }
	    }
	}
	public function nanolike($story_id){
        if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){
        	$data = array(
        		'user_id' => $this->session->userdata['logged_in']['user_id'],
        		'story_id' => $story_id,
        		'type' => 'nanolike',
        	);
        	//print_r($data);exit();
        	$response = $this->User_model->nanolike($data);
        	if($response){
        	    echo $response;
        	}else{
        	    echo 0;
        	}
        }else{
            echo 0;
        }
    }
	public function nano_view() {
	    if(isset($_GET['id']) && !empty($_GET['id'])){ 
    	    $header['gener'] = $this->User_model->gener();
    	    $header['languages'] = $this->User_model->language();
    	    $data['nano_view'] = $this->User_model->get_story_data($_GET['id']);
    	    // For Meta tags social share end
    		if(isset($data['nano_view']) && ($data['nano_view']->num_rows() > 0 )){
    		    $metatags = $data['nano_view']->result();
    		    if(isset($metatags[0]->type) && ($metatags[0]->type == 'nano')){
    		        $header['ogtitle'] = '[ Short Story ]';
    		        $header['ogetitle'] = '[ Nano Story ]';
    		    }else{
    		        $header['ogtitle'] = $metatags[0]->title;
    		        $header['ogetitle'] = $metatags[0]->etitle;
    		    }
    		    $header['ogkeywords'] = $metatags[0]->keywords;
    		    $header['ogdescription'] = strip_tags($metatags[0]->story);
    		    $header['ogauthor'] = $metatags[0]->name;
    		    $header['ogurl'] = base_url().'only_story_view?id='.$_GET['id'];
    		    if(isset($metatags[0]->image) && !empty($metatags[0]->image)){
    		        $header['ogimage'] = $metatags[0]->image;
    		    }else{
    		        $header['ogimage'] = 'series-stories.jpg';
    		    }
    		} // For Meta tags social share end
		
    	    $this->load->view('header.php',$header);
    	    $this->load->view('sidebar.php');
    	    $this->load->view('nano_view.php',$data);
    	    $this->load->view('footer.php');
	    }
	}
	public function only_story_view() {
	    $header['gener'] = $this->User_model->gener();
	    $header['languages'] = $this->User_model->language();
	    $uniqueviews = $this->User_model->uniqueviews($_GET['id']);
		$data['admin_story_view'] = $this->User_model->admin_story_view1();
		// For Meta tags social share end
		if(isset($data['admin_story_view']) && ($data['admin_story_view']->num_rows() > 0 )){
		    $metatags = $data['admin_story_view']->result();
		    if(isset($metatags[0]->type) && ($metatags[0]->type == 'nano')){
		        $header['ogtitle'] = '[ Short Story ]';
		        $header['ogetitle'] = '[ Nano Story ]';
		    }else{
		        $header['ogtitle'] = $metatags[0]->title;
		        $header['ogetitle'] = $metatags[0]->etitle;
		    }
		    $header['ogkeywords'] = $metatags[0]->keywords;
		    $header['ogdescription'] = strip_tags($metatags[0]->story);
		    $header['ogauthor'] = $metatags[0]->name;
		    $header['ogurl'] = base_url().'only_story_view?id='.$_GET['id'];
		    if(isset($metatags[0]->image) && !empty($metatags[0]->image)){
		        $header['ogimage'] = $metatags[0]->image;
		    }else{
		        $header['ogimage'] = 'series-stories.jpg';
		    }
		} // For Meta tags social share end
		$res = $this->User_model->viewsupdate();
		$data['comment_like'] = $this->User_model->comment_like();
		$data['recentstories'] = $this->User_model->recentstories($_GET['id']);
		$data['recentstorieslife'] = $this->User_model->recentlife($_GET['id']);
		$data['reviews'] = $this->User_model->reviews();
		$data['userrating'] = $this->User_model->userrating();
		$data['comment_get'] = $this->User_model->comment_get();
		//$data['funding'] = $this->User_model->funding();
		//$data['colfund'] = $this->User_model->colfund();
		$data['reviews21'] = $this->User_model->reviews2();
		//$data['comment_replay_get'] = $this->User_model->comment_replay_get();
		//$data['communities_gener'] = $this->User_model->communities_gener();
		//$data['allusers'] = $this->User_model->allusers();
		$data['favorites'] = $this->User_model->favoritreadlater('favorite');
		//$data1['languages'] = $this->User_model->language();
		$data['following'] = $this->User_model->following();
		$this->load->view('header.php',$header);
		$this->load->view('only_story_view.php',$data);
        $this->load->view('footer.php');
        /*$this->load->view('headmetatags.php',$header);
		$this->load->view('only_story_view.php',$data);
        $this->load->view('footer.php');*/
	}
	public function admin_story(){
	    $data['admin_story_view'] = $this->User_model->admin_story_view();
	    $uniqueviews = $this->User_model->uniqueviews($_GET['id']);
		$res = $this->User_model->viewsupdate();
		$data['comment_like'] = $this->User_model->comment_like();
		$data['reviews'] = $this->User_model->reviews();
		$data['comment_get'] = $this->User_model->comment_get();
		$data['reviews21'] = $this->User_model->reviews2();
		//$data['allusers'] = $this->User_model->allusers();
		$data['recentstories'] = $this->User_model->recentstories($_GET['id']);
		//$data1['languages'] = $this->User_model->language();
	    $this->load->view('header.php');
        $this->load->view('admin_story.php',$data);
        $this->load->view('footer.php');
    }
    public function admin_story_view($sid){
	    $header['gener'] = $this->User_model->gener();
		$header['languages'] = $this->User_model->language();
	    $data['editstory'] = $this->User_model->editstory($sid);
	//	$data['get_episode'] = $this->User_model->get_episode($sid);
	    $this->load->view('header.php', $header);
        $this->load->view('admin_story_view.php',$data);
        $this->load->view('footer.php');
    }
	public function rating() {
		if(isset($_POST['rating']) && !empty($_POST['rating']) && isset($_POST['sid']) && !empty($_POST['sid'])) {
			$response = $this->User_model->rating($_POST['rating'],$_POST['sid']);
			$rating = $this->User_model->reviews($_POST['sid']);
			if($response){
				echo json_encode(array('status' => 1, 'rating' => $rating));
			}else{
				echo json_encode(array('status' => 0));
			}
		}else{
			echo json_encode(array('status' => 0));
		}
	}
	public function ongoingcomplet(){
	    if(isset($_POST['sid']) && !empty($_POST['sid']) ) {
			$response = $this->User_model->ongoingcomplet($_POST['sid']);
			if($response){
				echo 1;
			}else{
				echo 0;
			}
		}else{
			echo 0;
		}
	}
	public function seriesall() {
	    $header['gener'] = $this->User_model->gener();
		$header['languages'] = $this->User_model->language();
		$data['top_get_series'] = $this->User_model->top_get_series();
		$data['get_series'] = $this->User_model->get_series();
        $this->load->view('header.php',$header);
        $this->load->view('sidebar.php');
	    $this->load->view('seriesall.php',$data);
	    $this->load->view('footer.php');
    }
    public function seriesallloadmore($type){
	    if(isset($_POST["limit"], $_POST["start"])){
            $data['viewallloadmore'] = $this->User_model->seriesallloadmore($type, $_POST["start"], $_POST["limit"]);
            $data['type'] = $type;
            $this->load->view('seriesallloadmore.php',$data, false);
        }
	}
    
    public function lifeall() {
        $header['gener'] = $this->User_model->gener();
		$header['languages'] = $this->User_model->language();
        //$data['get_life'] = $this->User_model->get_life('','all');
        $data['get_life'] = $this->User_model->viewallhome('life',0, 7);
		$data['top_get_life'] = $this->User_model->top_get_life();
		$data['lifetagslist'] = $this->User_model->lifetagslist(15);
        $this->load->view('header.php',$header);
        $this->load->view('sidebar.php');
	    $this->load->view('lifeall.php',$data);
	    $this->load->view('footer.php');
    }
    
    public function viewallyournetwork(){
        $header['gener'] = $this->User_model->gener();
		$header['languages'] = $this->User_model->language();
        if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){
            $data['viewallyournetwork'] = $this->User_model->yournetworks($this->session->userdata['logged_in']['user_id'],0, 7);
            $this->load->view('header.php',$header);
            $this->load->view('sidebar.php');
    	    $this->load->view('viewallyournetwork.php',$data);
    	    $this->load->view('footer.php');
        }
    }
    public function viewallloadyournetwork(){
        if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id']) 
         && isset($_POST["limit"]) && isset($_POST["start"])){
            $data['viewallyournetwork'] = $this->User_model->yournetworks($this->session->userdata['logged_in']['user_id'], $_POST['start'], $_POST['limit']);
            $this->load->view('viewallloadyournetwork.php',$data, false);
        }
    }
    
    public function viewallhome($type){
        $header['gener'] = $this->User_model->gener();
		$header['languages'] = $this->User_model->language();
        $data['viewallhome'] = $this->User_model->viewallhome($type,0, 7);
        $data['lifetagslist'] = $this->User_model->lifetagslist(15);
        $this->load->view('header.php',$header);
        $this->load->view('sidebar.php');
	    $this->load->view('viewallhome.php',$data);
	    $this->load->view('footer.php');
    }
    public function viewallloadmore($type){
        if(isset($_POST["limit"], $_POST["start"])){
            $data['viewallloadmore'] = $this->User_model->viewallhome($type, $_POST['start'], $_POST['limit']);
            $this->load->view('viewallloadmore.php',$data, false);
        }
	}
	public function topviewallhome($type){
	    $header['gener'] = $this->User_model->gener();
		$header['languages'] = $this->User_model->language();
        $data['topviewallhome'] = $this->User_model->topviewallhome($type,0,7);
        $this->load->view('header.php',$header);
        $this->load->view('sidebar.php');
	    $this->load->view('topviewallhome.php',$data);
	    $this->load->view('footer.php');
    }
    public function topviewallloadmore($type){
        if(isset($_POST["limit"], $_POST["start"])){
            $data['pagenum'] = 0;
            $data['topviewallloadmore'] = $this->User_model->topviewallhome($type, $_POST['start'],$_POST['limit']);
            $this->load->view('topviewallloadmore.php',$data, false);
        }
	}
    
    public function geners($generid = false) {
        $header['gener'] = $this->User_model->gener();
        $header['languages'] = $this->User_model->language();
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $generid = $_GET['id'];
            $data['genertopstories'] = $this->User_model->genertopstories($generid, 0,7);
    		$data['generstories'] = $this->User_model->generstories($generid,0,4);
            $this->load->view('header.php', $header);
            $this->load->view('sidebar.php');
    	    $this->load->view('geners.php',$data);    
    	    $this->load->view('footer.php');
        }else if(isset($_POST['generid']) && !empty($_POST['generid'])){
            $generid = $_POST['generid'];
            $data['generseries'] = $this->User_model->viewallhome('series', 0, 4, $generid);
            $this->load->view('generseries.php',$data);
        }else if(isset($generid) && !empty($generid) && (isset($_POST["limit"], $_POST["start"])) ){
            $data['loadgenerstories'] = $this->User_model->generstories($generid, $_POST["start"], $_POST["limit"]);
            $this->load->view('generstories.php',$data);
        }
    }
    
    public function genertopstories($generid) {
        if(isset($_POST["limit"], $_POST["start"])){
            $data['loadgenerstories'] = $this->User_model->genertopstories($generid, $_POST["start"], $_POST["limit"], $generid);
            $this->load->view('generstories.php',$data, false);
        }else{
            $header['gener'] = $this->User_model->gener();
            $header['languages'] = $this->User_model->language();
            $data['genertopstories'] = $this->User_model->genertopstories($generid, 0, 7);
            $this->load->view('header.php', $header);
            $this->load->view('sidebar.php');
    	    $this->load->view('genertopstories.php',$data);    
    	    $this->load->view('footer.php');
        }
    }
    
    public function generviewallloadmore($generid){
        /*if(isset($_POST['id']) && !empty($_POST['id'])){
    	    $this->perPage = 4;
            $lastID = $this->input->post('id');
            $data['postNum'] = $this->User_model->viewallhome('series', $lastID, 'count', $generid);
            $conditions['limit'] = $this->perPage;
            $data['viewallloadmore'] = $this->User_model->viewallhome('series', $lastID, '', $generid);
            $data['postLimit'] = $this->perPage;
            $this->load->view('generseriesfilters.php',$data, false);
        }*/
        if(isset($_POST["limit"], $_POST["start"])){
            $data['viewallloadmore'] = $this->User_model->viewallhome('series', $_POST["start"], $_POST["limit"], $generid);
            $this->load->view('generseriesfilters.php',$data, false);
        }
	}
	
	public function fersloadmore(){
	    if(isset($_POST["limit"], $_POST["start"], $_POST["user_id"]) && !empty($_POST["user_id"])){
	        $userid = $_POST["user_id"];
            $data['loadmoreresults'] = $this->User_model->followers_names($userid, $_POST["start"],$_POST["limit"]);
            $data['following'] = $this->User_model->following();
            $this->load->view('followloadmore.php',$data, false);
        }
	}
	public function fingloadmore(){
	    if(isset($_POST["limit"], $_POST["start"], $_POST["user_id"]) && !empty($_POST["user_id"])){
	        $userid = $_POST["user_id"];
            $data['loadmoreresultdatas'] = $this->User_model->following_names($userid, $_POST["start"],$_POST["limit"]);
            $data['following'] = $this->User_model->following();
            $this->load->view('followloadmore.php',$data, false);
        }
	}
    public function profile(){
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $userid = $_GET['id'];
            $header['gener'] = $this->User_model->gener();
            $header['languages'] = $this->User_model->language();
            if(isset($this->session->userdata['logged_in']['user_id']) && ($this->session->userdata['logged_in']['user_id'] == $userid)){
                //$data['client'] = $this->User_model->client_profile($userid);
                $data['client'] = $this->User_model->writer_profile($userid);
                $data['clientprofile'] = $this->User_model->client_profile($userid);
        		$data['writerseries'] = $this->User_model->writerseries($userid);
        		$data['writerstories'] = $this->User_model->writerstories($userid);
        		$data['writernanos'] = $this->User_model->writernanos($userid);
        		$data['writerlifes'] = $this->User_model->writerlifes($userid);
        		/*$data['rlseries'] = $this->User_model->libraryseries($userid, 'seriessubscribe'); //readlater
                $data['rlstories'] = $this->User_model->librarystories($userid, 'favorite'); //readlater
                $data['rllife'] = $this->User_model->librarylife($userid, 'favorite'); //readlater*/
        		$data['reviews21'] = $this->User_model->reviews2();
        		/*$data['readingseries'] = $this->User_model->readlatermylists('series');
        		$data['readingstories'] = $this->User_model->readlatermylists('story');
        		$data['readinglifes'] = $this->User_model->readlatermylists('life');*/
        		$data['follow_count'] = $this->User_model->follow_count();
        		$data['nano_like_count'] = $this->User_model->nano_like_count();
        		$data['followers_names'] = $this->User_model->followers_names($userid, 0,5);
                $data['following_names'] = $this->User_model->following_names($userid, 0,5);
                $data['following'] = $this->User_model->following();
        		$this->load->view('header.php', $header);
        		$this->load->view('myprofile.php',$data);
                $this->load->view('footer.php');
    	    }else if(!empty($userid)){
    	        $data['writer_profile'] = $this->User_model->writer_profile($userid);
    	        $data['clientprofile'] = $this->User_model->client_profile($userid);
        		$data['writerseries'] = $this->User_model->writerseries($userid);
        		$data['writerstories'] = $this->User_model->writerstories($userid);
        		$data['writerlifes'] = $this->User_model->writerlifes($userid);
        		$data['writernanos'] = $this->User_model->writernanos($userid);
        		/*$data['rlseries'] = $this->User_model->libraryseries($userid, 'seriessubscribe'); //readlater
                $data['rlstories'] = $this->User_model->librarystories($userid, 'favorite'); //readlater
                $data['rllife'] = $this->User_model->librarylife($userid, 'favorite'); //readlater */
                $data['follow_count'] = $this->User_model->follow_count();
                $data['pro_comment'] = $this->User_model->pro_comment($userid);
                $data['followers_names'] = $this->User_model->followers_names($userid, 0,7);
                $data['following_names'] = $this->User_model->following_names($userid, 0,7);
        		$data['following'] = $this->User_model->following();
        		$this->load->view('header.php', $header);
        		$this->load->view('profile.php',$data);
                $this->load->view('footer.php');
    	    }
        }
    }
    public function profilereading(){
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $userid = $_GET['id'];
            if(isset($this->session->userdata['logged_in']['user_id']) && ($this->session->userdata['logged_in']['user_id'] == $userid)){
                $data['rlseries'] = $this->User_model->libraryseries($userid, 'seriessubscribe'); //readlater
                $data['rlstories'] = $this->User_model->librarystories($userid, 'favorite'); //readlater
                $data['rllife'] = $this->User_model->librarylife($userid, 'favorite'); //readlater
                $data['reviews21'] = $this->User_model->reviews2();
        		$this->load->view('myprofilereading.php',$data);
    	    }else if(!empty($userid)){
        		$data['rlseries'] = $this->User_model->libraryseries($userid, 'seriessubscribe'); //readlater
                $data['rlstories'] = $this->User_model->librarystories($userid, 'favorite'); //readlater
                $data['rllife'] = $this->User_model->librarylife($userid, 'favorite'); //readlater
                $data['reviews21'] = $this->User_model->reviews2();
        		$this->load->view('profilereading.php',$data);
    	    }
        }
    }
    
    public function profileviewall() {
        $header['gener'] = $this->User_model->gener();
        $header['languages'] = $this->User_model->language();
        if(isset($_GET['type']) && isset($_GET['id']) && !empty($_GET['type']) && !empty($_GET['id'])){
            $data['writer_profile'] = $this->User_model->writer_profile($_GET['id']);
    		$data['profileviewall'] = $this->User_model->profileviewall($_GET['id'], $_GET['type'],0,7);
            $data['follow_count'] = $this->User_model->follow_count();
            $data['pro_comment'] = $this->User_model->pro_comment($_GET['id']);
            $data['followers_names'] = $this->User_model->followers_names($_GET['id'], 0,7);
            $data['following_names'] = $this->User_model->following_names($_GET['id'], 0,7);
    		$data['following'] = $this->User_model->following();
    		$this->load->view('header.php', $header);
    		$this->load->view('profileviewall.php',$data);
            $this->load->view('footer.php');
        }else if(isset($_GET['id']) && !empty($_GET['id'])){
            redirect(base_url().'index.php/welcome/profile?id='.$_GET['id']);
        }else{
            redirect(base_url().'home');
        }
    }
    public function profilealloadmore(){
	    if(isset($_POST['limit']) && isset($_POST['start'])){
            $data['profilealloadmore'] = $this->User_model->profileviewall($_GET['id'], $_GET['type'], $_POST['start'], $_POST['limit']);
            $this->load->view('profilealloadmore.php',$data, false);
	    }
	}
    public function my_profile($id) {
        if(isset($this->session->userdata['logged_in']['user_id']) && ($this->session->userdata['logged_in']['user_id'] == $id)){
    		$data1['languages'] = $this->User_model->language();
    		if(isset($id) && !empty($id)){
    			$data['editprofile'] = $this->User_model->editprofile($id);
    			$header['geners'] = $this->User_model->gener();
    			$usercomms = $this->User_model->usercommunities_gener();
    			$data['usercomms'] = array();
    			foreach($usercomms->result() as $usercomm){
    			    array_push($data['usercomms'], $usercomm->id);
    			}
    			$this->load->view('header.php', $header);
        		$this->load->view('editmy_profile.php',$data);
                $this->load->view('footer.php');
    		}
        }else if(isset($id) && !empty($id)){
            redirect(base_url().'profile?id='.$id);
        }else{
            redirect(base_url());
        }
    }
    
    public function updateprofile($id) {
		$data1['languages'] = $this->User_model->language();
		$data['editprofile'] = $this->User_model->editprofile($id);
		$header['geners'] = $this->User_model->gener();
		$usercomms = $this->User_model->usercommunities_gener();
		$data['usercomms'] = array();
		foreach($usercomms->result() as $usercomm){
		    array_push($data['usercomms'], $usercomm->id);
		}
		if(!isset($_POST['uemailstatus'])){
		    $_POST['uemailstatus'] = 'private';
		}
		if(!isset($_POST['uphonestatus'])){
		    $_POST['uphonestatus'] = 'private';
		}
		$this->form_validation->set_rules('aboutus', 'aboutus', 'trim');
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('lastname', 'lastname', 'trim');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		//$this->form_validation->set_rules('username', 'User Name', 'trim|required|alpha_numeric|min_length[5]');
		$this->form_validation->set_rules('gender', 'Gender', 'trim');
		$this->form_validation->set_rules('dob', 'Date of Birth', 'trim');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required|numeric');
		$this->form_validation->set_rules('uemailstatus', 'Email Status', 'trim|required');
		$this->form_validation->set_rules('uphonestatus', 'Phone Status', 'trim|required');
		$dbemail = $this->User_model->dbemail();
		$user_activation  = 0;
		if(isset($dbemail) && !empty($dbemail) && ($_POST['email'] != $dbemail)){
		    $user_activation = 2;
		    $this->User_model->sendEmail($_POST['email']);
		}
		if ($this->form_validation->run() == FALSE) {
    		$this->load->view('header.php', $header); 
    		$this->load->view('editmy_profile.php',$data);
            $this->load->view('footer.php');
        } else {			
			$picture1 =''; $picture2 ='';
			if(!empty($_FILES['banner_image']['name'])) {
			    $config['upload_path'] = 'assets/images/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size']     = '2048';
                $config['encrypt_name'] = TRUE;
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('banner_image')){
                    $buploadData = $this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/images/'.$buploadData['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['quality'] = '90%';
                    $config['width'] = 100;
                    $config['height'] = 100;
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                    $picture1 = $buploadData['file_name'];
                }
			}
			if(!empty($_FILES['profile_image']['name'])) {
			    $config['upload_path'] = 'assets/images/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size']     = '2048';
                $config['encrypt_name'] = TRUE;
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('profile_image')){
                    $uploadData = $this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/images/'.$uploadData['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['quality'] = '90%';
                    $config['width'] = 100;
                    $config['height'] = 100;
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                    $picture2 = $uploadData['file_name'];
                }
			}
			$inputdata = array(
				'aboutus' => $this->input->post('aboutus'),
				'name' => $this->input->post('name'),
				'lastname' => $this->input->post('lastname'),
				'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'),
				//'profile_name' => $this->input->post('username'),
				'dob' => $this->input->post('dob'),
				'gender' => $this->input->post('gender'),
				'uemailstatus' => $this->input->post('uemailstatus'),
				'uphonestatus' => $this->input->post('uphonestatus'),
			);
			if($user_activation != 0){
			   $inputdata['user_activation'] = $user_activation;
			}
			if(!empty($picture1)){
				$inputdata['banner_image']=$picture1;
			}
			if(!empty($picture2)){
				$inputdata['profile_image']=$picture2;
			}
			$userid = $this->session->userdata['logged_in']['user_id'];
			$res = $this->User_model->updateprofile($inputdata,$userid);
			if($res){
			    $this->session->set_flashdata('editmsg', '<span class="text-success">Profile Updated Successfully</span>');
			}
			redirect(base_url('profile?id='.$userid));
		}
	}
	
    public function profilecomments($profileid){
	    if(isset($_POST['limitStart']) && !empty($_POST['limitStart'])){
	        $data['pro_comments'] = $this->User_model->profilecomments($profileid,$_POST['limitStart']);
	    }else{
	        $data['pro_comments'] = $this->User_model->profilecomments($profileid);
	    }
	    $this->load->view('profilecomments.php',$data);
	}
	public function pro_comment(){
    	if($this->session->userdata('logged_in')==NULL) redirect(base_url());
    	$user_id = $this->session->userdata['logged_in']['user_id'];
    	$name = $this->session->userdata['logged_in']['name'];
    	if(isset($_POST['pro_comment']) && trim($_POST['pro_comment']) && isset($_POST['profile_id']) && !empty($_POST['profile_id'])){
        	$pro_comment = $this->input->post('pro_comment');
        	$profile_id = $this->input->post('profile_id');
        	$commentid = $this->input->post('comment_id');
        	$data = array(
        		'pro_comment' => $pro_comment,
        		'profile_id' => $profile_id,
        		'user_id' => $user_id,
        		'name' => $name,
        		'comment_id' => $commentid,
        	);
        	$data = $this->User_model->pro_comment_1($data);
        	if($data){
        	    echo 1;
        	}else{
        	    echo 0;
        	}
    	}else{
    	    echo 0;
    	}
    }
    public function pro_commentpost(){
        $response = $this->User_model->pro_commentpost();
        if($response->num_rows() > 0){
			$data['response'] = $response->result();
			$hydhmdatetime = 'hydhmdatetime';
        	$data['response'][0]->$hydhmdatetime = $this->User_model->hydhmdatetime($data['response'][0]->date);
			echo json_encode($data);
        }else{
            $data['response'] = '';
            echo json_encode($data);
        }
    }
    
    public function addreplycomment(){
	    if(isset($_POST['pro_comment']) && !empty($_POST['pro_comment']) && isset($_POST['profile_id']) && !empty($_POST['profile_id'])){
	        $user_id = $this->session->userdata['logged_in']['user_id'];
        	$name = $this->session->userdata['logged_in']['name'];
        	$pro_comment = $this->input->post('pro_comment');
        	$profile_id = $this->input->post('profile_id');
        	$commentid = 0;
        	if(isset($_POST['comment_id']) && !empty($_POST['comment_id'])){
        	    $commentid = $this->input->post('comment_id');
        	}
        	$data=array(
        		'pro_comment' => $pro_comment,
        		'user_id' => $user_id,
        		'name' => $name,
        		'profile_id' => $profile_id,
        		'comment_id' => $commentid,
        	);
        	$result = $this->User_model->pro_comment_1($data);
        	if($result){
        	    echo 1;
        	}else{
        	    echo 0;
        	}
	    }else{
	        echo 2;
	    }
	}
	public function profilereplycomments($profileid){
	    if(isset($_POST['limitStart']) && !empty($_POST['limitStart']) && isset($_POST['cid']) && !empty($_POST['cid'])){
	        $data['proreply_comments'] = $this->User_model->profilereplycomments($profileid, $_POST['cid'], $_POST['limitStart']);
	    }elseif((!isset($_POST['limitStart']) || empty($_POST['limitStart'])) && isset($_POST['cid']) && !empty($_POST['cid'])){
	        $data['proreply_comments'] = $this->User_model->profilereplycomments($profileid, $_POST['cid']);
	    }else{
	        $data['proreply_comments'] = $this->User_model->profilereplycomments($profileid);
	    }
	    $this->load->view('profilereplycomments.php',$data);
	}
	public function reportpro_comment(){
	    if(isset($_POST['reportpro_cmt']) && !empty($_POST['reportpro_cmt']) && isset($_POST['reportuser_id']) && 
	        isset($_POST['reportcommentid']) && isset($this->session->userdata['logged_in']['user_id'])){
    	    $data = array(
    	        'comm_story_id' => $_POST['reportcommentid'],
    	        'posted_byid' => $_POST['reportuser_id'],
        		'reported_by' => $this->session->userdata['logged_in']['user_id'],
        		'type' => 'profile_comment',
        		'report_msg' => $_POST['reportpro_cmt'],
        	);
    	    $result = $this->User_model->reportcomm_post($data);
        	if($result){
        	    echo 1;
        	}else{
        	    echo 0;
        	}
	    }else{
	        echo 2;
	    }
	}
	public function editpro_comment($commentid){
	    $editpro_comment = $this->User_model->editpro_comment($commentid);
	    if($editpro_comment->num_rows() == 1){
	        $data['response'] = $editpro_comment->result();
			echo json_encode($data);
		}else{
		    echo 0;
		}
	}
	public function updateprocomment(){
	    if(isset($_POST['comment']) && !empty($_POST['comment']) && isset($_POST['cid']) && !empty($_POST['cid'])){
	        $data = array('pro_comment' => $_POST['comment']);
	        $cid = $_POST['cid'];
	        $response = $this->User_model->updateprocomment($data, $cid);
	        if($response){
	            echo 1;
	        }else{
	            echo 0;
	        }
	    }else{
	        echo 2;
	    }
	}
	public function deletepro_comment($commentid){ // changing for cmt count ajax
	    $response = $this->User_model->deletepro_comment($commentid);
        if($response){
            //echo 1;
            echo json_encode($response, JSON_PRETTY_PRINT);
        }else{
            echo 0;
        }
	}
	public function deleteprocmtcount(){
	    if(isset($_POST['cid']) && !empty($_POST['cid'])){
	        $response = $this->User_model->deleteprocmtcount($_POST['cid']);
	        echo $response;
	    }
	}
	public function editnano($nanosid){
        $result = $this->User_model->editnano($nanosid);
        $data['story'] = ''; $data['nanolang'] = '';
        if($result->num_rows() > 0){ foreach($result->result() as $result){
            $data['story'] = $result->story;
            $data['nanolang'] = $result->nanolang;
        }   }
        echo json_encode($data);
    }
    public function updatenano(){
        if(isset($_POST['story']) && isset($_POST['nanosid'])){
            $result = $this->User_model->updatenano($_POST['story'] , $_POST['nanosid']);
            if($result){
                echo 1;
            }else{
                echo 0;
            }
        }
    }
    public function deletenano($nanosid){
        $result = $this->User_model->deletenano($nanosid);
        if($result){
            echo 1;
        }else{
            echo 0;
        }
    }
	public function drafts(){
	    if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){
            $header['gener'] = $this->User_model->gener();
    		$header['languages'] = $this->User_model->language();
            $data['drafts'] = $this->User_model->drafts();
    		$this->load->view('header.php',$header);
    		$this->load->view('drafts.php', $data);
            $this->load->view('footer.php');
	    }else{
	        redirect(base_url().'home');
	    }
    }
    
    public function upload_profileimg(){
        if(isset($_FILES['profileimg']['name']) && !empty($_FILES['profileimg']['name'])){
            $config['upload_path'] = 'assets/images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            //$config['max_size'] = '2048';
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ( $this->upload->do_upload('profileimg')) {
                $uploadpimg = $this->upload->data();
                //echo base_url().'assets/images/'.$uploadpimg['file_name'];
                $data['image'] = $uploadpimg['file_name'];
                $this->load->view('profileimg', $data);
            } else {
               $this->load->view('profileimg');
            }
        }else{
            $this->load->view('profileimg');
        }
    }
    
    public function image_crop(){
        $link_array = explode('/',$_POST['img']);
        $imagename = end($link_array);
        $imageextension = explode('.',$imagename);
        $filename = $_POST['img'];
        $path = 'assets/images/'.$imagename;
        
        $targ_w = $targ_h = 120;
        switch($imageextension[1]) {
            case 'gif' :
                $type ="gif";
                $img = imagecreatefromgif($filename);
                break;
            case 'png' :
                $type ="png";
                $img = imagecreatefrompng($filename);
                break;
            case 'jpg' :
                $type ="jpg";
                $img = imagecreatefromjpeg($filename);
                break;
            case 'jpeg' :
                $type ="jpg";
                $img = imagecreatefromjpeg($filename);
                break;
            default : 
                die ("ERROR; UNSUPPORTED IMAGE TYPE");
                break;
        }
        $dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
        imagecopyresampled($dst_r,$img,0,0,$_POST['x'],$_POST['y'],$targ_w,$targ_h,$_POST['w'],$_POST['h']);

        if($type=="gif")
        {
            imagegif($dst_r, $path);
        }
        elseif($type=="jpg")
        {
            imagejpeg($dst_r, $path);
        }
        elseif($type=="png")
        {
            imagepng($dst_r, $path);
        }
        elseif($type=="bmp")
        {
            imagewbmp($dst_r, $path);
        }
        if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){
            $response = $this->User_model->updateprofileimg($this->session->userdata['logged_in']['user_id'], $imagename);
            $_SESSION['logged_in']['profile_image'] = $imagename;
            echo base_url().$path;
        }
        echo base_url().$path;
    }
    
    public function uploaddraftimage(){
        if(isset($_POST['story_id']) && isset($_FILES['cover_image']['name']) && !empty($_FILES['cover_image']['name'])){
            $picture1 = ''; $image = '';
            if(isset($_FILES['cover_image']['name']) && !empty($_FILES['cover_image']['name'])){
                $config['upload_path'] = 'assets/images/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size']     = '2048';
                $config['encrypt_name'] = TRUE;
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('cover_image')){
                    $uploadData = $this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/images/'.$uploadData['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['quality'] = '100%';
                    $config['width'] = 293;
                    $config['height'] = 280;
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                    $picture1 = $uploadData['file_name'];
                    
                    $date = strtotime(date('Y-m-d h:i:s'));
                    $newNamePrefix = $date.'_';
                    $manipulator = new ImageManipulator($_FILES['cover_image']['tmp_name']);
                    $newImage = $manipulator->resample(200, 180);
                    $image = $newNamePrefix.$_FILES['cover_image']['name'];
                    // saving file to uploads folder
                    $manipulator->save('assets/images/'.$newNamePrefix.$_FILES['cover_image']['name']);
                }
            }
            if(!empty($picture1) && !empty($_POST['story_id'])){
                $data = array('cover_image' => $picture1, 'image' => $image);
                $response = $this->User_model->uploaddraftimage($_POST['story_id'], $data);
                if($response == 1){
                    echo 1;
                }else{
                    echo 0;
                }
            }
        }
    }
    
    public function notifications(){
	    $header['gener'] = $this->User_model->gener();
		$header['languages'] = $this->User_model->language();
	    $data['notifications'] = $this->User_model->notificationslist(0,15);
		$this->load->view('header.php',$header);
		$this->load->view('notifications.php',$data);
        $this->load->view('footer.php');
	}
	public function loadnotifications(){
	    if(isset($_POST['limit']) && !empty($_POST['limit']) && isset($_POST['start']) && !empty($_POST['limit'])){
    	    $data['notifications'] = $this->User_model->notificationslist($_POST['start'],$_POST['limit']);
    	    $this->load->view('loadnotifications.php',$data);
	    }
	}
	public function tab2loadnotifications(){
	    if(isset($_POST['limit']) && !empty($_POST['limit']) && isset($_POST['start']) && !empty($_POST['limit'])){
    	    $data['tab2'] = $this->User_model->notificationslist($_POST['start'],$_POST['limit']);
    	    $this->load->view('loadnotifications.php',$data);
	    }
	}
	
	public function tab3loadnotifications(){
	    if(isset($_POST['limit']) && !empty($_POST['limit']) && isset($_POST['start']) && !empty($_POST['limit'])){
    	    $data['tab3'] = $this->User_model->notificationslist($_POST['start'],$_POST['limit']);
    	    $this->load->view('loadnotifications.php',$data);
	    }
	}
	
    public function comment(){
    	$storyid = $this->input->post('storyid');
    	if(isset($_POST['comment']) && !empty($_POST['comment']) && isset($this->session->userdata['logged_in']['user_id'])){
        	$user_id = $this->session->userdata['logged_in']['user_id'];
        	$name = $this->session->userdata['logged_in']['name'];
        	$comment = $this->input->post('comment');
        	$inputdata = array(
        		'comment' => $comment,
        		'story_id' => $storyid,
        		'user_id' => $user_id,
        		'name' => $name,
        	);
        	$response = $this->User_model->comment($inputdata,$storyid);
        	if($response->num_rows() > 0){
        	    $data['comment_get'] = $response;
        	    $this->load->view('comment_page',$data);
        	}else{
        	    $this->load->view('comment_page');
        	}
        }else{
            $this->load->view('comment_page');
        }
    }
    public function updatecomment(){
	    if(isset($_POST['comment']) && !empty($_POST['comment']) && isset($_POST['cid']) && !empty($_POST['cid'])){
	        $data = array('comment' => $_POST['comment']);
	        $cid = $_POST['cid'];
	        $response = $this->User_model->updateprocomment($data, $cid);
	        if($response){
	            echo 1;
	        }else{
	            echo 0;
	        }
	    }else{
	        echo 2;
	    }
	}
	
	public function addstoryreplycomment(){
	    if(isset($_POST['comment']) && !empty($_POST['comment']) && isset($_POST['story_id']) && !empty($_POST['story_id'])){
	        $user_id = $this->session->userdata['logged_in']['user_id'];
        	$name = $this->session->userdata['logged_in']['name'];
        	$comment = $this->input->post('comment'); 
        	$story_id = $this->input->post('story_id');
        	$commentid = 0;
        	if(isset($_POST['comment_id']) && !empty($_POST['comment_id'])){
        	    $commentid = $this->input->post('comment_id');
        	}
        	$data=array(
        		'comment' => $comment,
        		'user_id' => $user_id,
        		'name' => $name,
        		'story_id' => $story_id,
        		'comment_id' => $commentid,
        	);
        	$result = $this->User_model->pro_comment_1($data);
        	if($result){
        	    echo 1;
        	}else{
        	    echo 0;
        	}
	    }else{
	        echo 2;
	    }
	}
	
	public function search(){
        if(isset($_GET['searchtext']) && !empty($_GET['searchtext'])){
            $header['gener'] = $this->User_model->gener();
		    $header['languages'] = $this->User_model->language();
            $header['searchtext'] = $_GET['searchtext'];
    		$data['get_writer'] = $this->User_model->get_top_writer($header['searchtext']);
    		/*$data['get_series'] = $this->User_model->get_series($header['searchtext']);
    		$data['get_storys'] = $this->User_model->get_storys($header['searchtext']);
    		$data['get_life'] = $this->User_model->get_life($header['searchtext']);*/
    		$data['get_series'] = $this->User_model->search_series($header['searchtext'],0,7);
    		$data['get_storys'] = $this->User_model->search_storys($header['searchtext'],0,7);
    		$data['get_life'] = $this->User_model->search_life($header['searchtext'],0,3);
    		$data['reviews21'] = $this->User_model->reviews2();
    		$data['following'] = $this->User_model->following();
    		$data['follow_count'] = $this->User_model->follow_count();
    		$data['series_count'] = $this->User_model->series_count();
    		$this->load->view('header.php',$header);
    		$this->load->view('searchdata.php', $data);
            $this->load->view('footer.php');
        }else{
            $header['gener'] = $this->User_model->gener();
		    $header['languages'] = $this->User_model->language();
            $header['searchtext'] = '';
            $this->load->view('header.php',$header);
    		$this->load->view('searchdata.php');
            $this->load->view('footer.php');
        }
    }
    public function searchresult(){
        if(isset($_GET['type']) && !empty($_GET['type']) && isset($_GET['searchtext']) && !empty($_GET['searchtext'])){
            $header['gener'] = $this->User_model->gener();
		    $header['languages'] = $this->User_model->language();
		    
            //$data['searchresults'] = $this->User_model->searchresult($_GET['type'], $_GET['searchtext'],0,7);
            if($_GET['type'] == 'series'){
                $data['searchresults'] = $this->User_model->search_series($_GET['searchtext'],0,7);
            }else if($_GET['type'] == 'story'){ 
    		    $data['searchresults'] = $this->User_model->search_storys($_GET['searchtext'],0,7);
            }else if($_GET['type'] == 'life'){ 
    		    $data['searchresults'] = $this->User_model->search_life($_GET['searchtext'],0,7);
            }
    		$data['reviews2'] = $this->User_model->reviews2();
    		//$data['gener'] = $this->User_model->gener();
    		$data['filter12'] = $this->User_model->get_seriesall();
    		$data['follow_count'] = $this->User_model->follow_count();
            $header['searchtext'] = $_GET['searchtext'];
    		$this->load->view('header.php', $header);
            $this->load->view('searchresult.php',$data);
            $this->load->view('footer.php');
        }else{
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function searchresultloadmore(){
        if((isset($_POST["limit"], $_POST["start"])) && isset($_GET['type']) && !empty($_GET['type']) && isset($_GET['searchtext']) && !empty($_GET['searchtext'])){
            //$data['loadsearchresults'] = $this->User_model->searchresult($_GET['type'], $_GET['searchtext'], $_POST["start"], $_POST["limit"]);
            if($_GET['type'] == 'series'){
                $data['loadsearchresults'] = $this->User_model->search_series( $_GET['searchtext'], $_POST["start"], $_POST["limit"]);
            }else if($_GET['type'] == 'story'){ 
    		    $data['loadsearchresults'] = $this->User_model->search_storys($_GET['searchtext'], $_POST["start"], $_POST["limit"]);
            }else if($_GET['type'] == 'life'){ 
    		    $data['loadsearchresults'] = $this->User_model->search_life($_GET['searchtext'], $_POST["start"], $_POST["limit"]);
            }else{
                $data = '';
            }
            $this->load->view('searchresultloadmore.php',$data, false);
        }
    }
    public function searchresultwriter(){
        if(isset($_GET['type']) && !empty($_GET['type']) && isset($_GET['searchtext']) && !empty($_GET['searchtext'])){
            $header['language'] = $this->User_model->language();
            $header['gener'] = $this->User_model->gener();
            $header['searchtext'] = $_GET['searchtext'];
            $data['searchresults'] = $this->User_model->searchresultwriter($_GET['type'], $_GET['searchtext'],0,4);
    		$data['reviews2'] = $this->User_model->reviews2();
    		
    		$data['filter12'] = $this->User_model->get_seriesall();
            $data['following'] = $this->User_model->following();
            $data['follow_count'] = $this->User_model->follow_count();
    		$this->load->view('header.php', $header);
            $this->load->view('searchresult.php',$data);
            $this->load->view('footer.php');
        }else{
            $header['language'] = $this->User_model->language();
            $header['gener'] = $this->User_model->gener();
            $header['searchtext'] = '';
            $this->load->view('header.php', $header);
            $this->load->view('searchresult.php');
            $this->load->view('footer.php');
        }
    }
    public function searchwriterloadmore(){
        if((isset($_POST["limit"], $_POST["start"])) && isset($_GET['type']) && !empty($_GET['type']) && isset($_GET['searchtext']) && !empty($_GET['searchtext'])){
            $data['loadsearchresults'] = $this->User_model->searchresultwriter($_GET['type'], $_GET['searchtext'], $_POST["start"], $_POST["limit"]);
            $data['following'] = $this->User_model->following();
            $this->load->view('searchresultloadmore.php',$data, false);
        }
    }
	public function commloadcomments($topstory = false){
	    if(isset($_POST['storyid']) && !empty($_POST['storyid']) && isset($_POST['commentid']) && !empty($_POST['commentid'])){
    	    $data['commloadcomments'] = $this->User_model->commloadcomments($_POST['storyid'], $_POST['commentid']);
    	    $data['commlastcomment'] = $this->User_model->commlastcomment($_POST['storyid']);
    	    if(isset($topstory) && !empty($topstory)){
    	        $data['topstory'] = 'topstory';
    	    }
    	    $this->load->view('commloadcomments.php',$data);
	    }
	}
	public function commloadsubcomments($topstory = false){
	    if(isset($_POST['storyid']) && !empty($_POST['storyid']) && isset($_POST['comment_id']) && 
	    !empty($_POST['comment_id']) && isset($_POST['subcommentid']) && !empty($_POST['subcommentid']) ){
    	    $data['commloadsubcomments'] = $this->User_model->commloadsubcomments($_POST['storyid'], $_POST['comment_id'],$_POST['subcommentid']);
    	    $data['commlastsubcomment'] = $this->User_model->commlastsubcomment($_POST['storyid'], $_POST['comment_id']);
    	    if(isset($topstory) && !empty($topstory)){
    	        $data['topstory'] = 'topstory';
    	    }
    	    $this->load->view('commloadcomments.php',$data);
	    }
	}
	
	public function deletecommcomment(){
	    if(isset($_POST['commentid']) && !empty($_POST['commentid'])){
	        $response = $this->User_model->deletecommcomment($_POST['commentid']);
	        if($response){
	            echo json_encode($response, JSON_PRETTY_PRINT);
	        }else{
	            echo 0;
	        }
	    }
	}
	public function editcommcomment(){
	    if(isset($_POST['commentid']) && !empty($_POST['commentid'])){
	        $data['editcommcomment'] = $this->User_model->editcommcomment($_POST['commentid']);
	        if(isset($data['editcommcomment']) && ($data['editcommcomment']->num_rows() > 0)){
	            $this->load->view('editcommcomment.php',$data);
	        }else{
	            echo 0;
	        }
	    }else{
	        echo 0;
	    }
	}
	public function updatecommcomment(){
	    if(isset($_POST['commentid']) && !empty($_POST['commentid']) && isset($_POST['comment']) && !empty($_POST['comment'])){
            $comment = $this->input->post('comment');
            $id = $this->input->post('commentid');
	        $response = $this->User_model->updatecommcomment($id, $comment);
	        if($response){
	            echo 1;
	        }else{
	            echo 0;
	        }
	    }else{
	        echo 0;
	    }
	}
	
	public function reportcomm_post() {
		$this->form_validation->set_rules('reportmsg', 'Enter Your Text','trim|required|min_length[10]');
		$this->form_validation->set_rules('comm_story_id', 'Community Post','trim|required');
		$this->form_validation->set_rules('posted_byid', 'Posted By','trim|required');
		if ($this->form_validation->run() == FALSE) {
            $data['validations'] = $this->form_validation->error_array();
			$data['status'] = -1;
			echo json_encode($data);
		}else{
		    $reported_by = 0;
		    if(isset($this->session->userdata['logged_in']['user_id'])){
		        $reported_by = $this->session->userdata['logged_in']['user_id'];
		    }
		    $inputdata =  array(
		        'comm_story_id' => $this->input->post('comm_story_id'),
		        'posted_byid' => $this->input->post('posted_byid'),
		        'reported_by' => $reported_by,
		        'type' => 'commpost_report',
		        'report_msg' => $this->input->post('reportmsg'),
		    );
		    $result = $this->User_model->reportcomm_post($inputdata);
		    if($result){
	    		$data['status'] = 1;
				$data['response'] = 'success';
				echo json_encode($data);
	    	}else{
	    		$data['status'] = 2;
				$data['response'] = 'fail';
				echo json_encode($data);
	    	}
		}
	}
	
	public function reportcommcomment(){
	    if(isset($_POST['commentid']) && !empty($_POST['commentid']) && isset($_POST['userid']) && !empty($_POST['userid']) && isset($_POST['reportmsg']) && !empty($_POST['reportmsg'])){
	        $reported_by = 0;
		    if(isset($this->session->userdata['logged_in']['user_id'])){
		        $reported_by = $this->session->userdata['logged_in']['user_id'];
		    }
	        $inputdata =  array(
		        'comment_id' => $this->input->post('commentid'),
		        'posted_byid' => $this->input->post('userid'),
		        'reported_by' => $reported_by,
		        'type' => 'comm_comment',
		        'report_msg' => $this->input->post('reportmsg'),
		    );
		    $result = $this->User_model->reportcomm_post($inputdata);
		    if($result){
	    		$data['status'] = 1;
				$data['response'] = 'success';
				echo json_encode($data);
	    	}else{
	    		$data['status'] = 2;
				$data['response'] = 'fail';
				echo json_encode($data);
	    	}
	    }else{
	        $data['status'] = 2;
			$data['response'] = 'reportmsg';
			echo json_encode($data);
	    }
	}
	
	public function reportstories(){
	    if(isset($_POST['reportcmt']) && !empty($_POST['reportcmt']) && isset($_POST['report_storyid']) && 
	        isset($_POST['report_userid']) && isset($_POST['type'])){
    	    $data = array(
    	        'posted_byid' => $_POST['report_userid'],
    	        'reported_by' => $this->session->userdata['logged_in']['user_id'],
        		'story_id' => $_POST['report_storyid'],
        		'type' => $_POST['type'],
        		'report_msg' => $_POST['reportcmt'],
        	);
    	    $result = $this->User_model->reportcomm_post($data);
        	if($result){
        	    echo 1;
        	}else{
        	    echo 0;
        	}
	    }else{
	        echo 2;
	    }
	}
	
	public function reportstoriescomment(){
	    if(isset($_POST['reportcmt']) && !empty($_POST['reportcmt']) && isset($_POST['reportcommentid']) && 
	        isset($_POST['report_storyid']) && isset($_POST['report_userid'])){
    	    $data = array(
    	        'comment_id' => $_POST['reportcommentid'],
    	        'posted_byid' => $_POST['report_userid'],
    	        'reported_by' => $this->session->userdata['logged_in']['user_id'],
        		'story_id' => $_POST['report_storyid'],
        		'type' => $_POST['report_storytype'],
        		'report_msg' => $_POST['reportcmt'],
        	);
    	    $result = $this->User_model->reportcomm_post($data);
        	if($result){
        	    echo 1;
        	}else{
        	    echo 0;
        	}
	    }else{
	        echo 2;
	    }
	}
	
	/* monitize request start */
	public function monitizeonreq(){
	    $userid = $this->session->userdata['logged_in']['user_id'];
	    $language = $this->session->userdata('language');
	    $followwritecount = $this->User_model->followwritecount($language,$userid);
	    if($followwritecount->num_rows() > 0){
	        $monitizeonreq = $this->User_model->monitizeonreq($userid);
	        if($monitizeonreq == 1){
	            echo 1;
	        }else{
	            echo 0;
	        }
	    }else{
	        echo 2; 
	    }
	}
	public function monitizeoffreq(){
	    $userid = $this->session->userdata['logged_in']['user_id'];
	    $monitizeoffreq = $this->User_model->monitizeoffreq($userid);
	    if($monitizeoffreq == 1){
	        echo 1;
	    }else{
	        echo 0;
	    }
	}
	/* monitize request end */
	/* story monitize request start */
	public function storymonitizeonreq(){
	    $userid = $this->session->userdata['logged_in']['user_id'];
	    if(isset($_POST['storyid']) && !empty($_POST['storyid'])){
    	    $monitizeonreq = $this->User_model->storymonitizeonreq($userid,$_POST['storyid']);
    	    if($monitizeonreq == 1){
    	        echo 1;
    	    }else{
    	        echo 0;
    	    }
	    }
	}
	public function storymonitizeoffreq(){
	    $userid = $this->session->userdata['logged_in']['user_id'];
	    if(isset($_POST['storyid']) && !empty($_POST['storyid'])){
    	    $monitizeoffreq = $this->User_model->storymonitizeoffreq($userid,$_POST['storyid']);
    	    if($monitizeoffreq == 1){
    	        echo 1;
    	    }else{
    	        echo 0;
    	    }
	    }
	}
	public function paymenttype(){
	    $userid = $this->session->userdata['logged_in']['user_id'];
	    if(isset($_POST['paymenttype']) && !empty($_POST['paymenttype'])){
	        $data['accountdetails'] = $this->User_model->paymenttype($userid,$_POST);
	        $data['paymenttype'] = $_POST['paymenttype'];
	        $this->load->view('paymenttype', $data);
	    }else{
	        echo 0;
	    }
	}
	public function paymentdetails(){
	    if(isset($_POST['paymenttype']) && ($_POST['paymenttype'] == 'paytm')){
	        $this->form_validation->set_rules('paytmphone', 'Paytm Phone','trim|required|exact_length[10]');
	    }else if(isset($_POST['paymenttype']) && ($_POST['paymenttype'] == 'bankaccount')){
	        $this->form_validation->set_rules('accountno', 'Account number','trim|required|min_length[8]|max_length[34]');
	        $this->form_validation->set_rules('ifsccode', 'Paytm Phone','trim|required|min_length[10]|max_length[35]');
	        $this->form_validation->set_rules('bankname', 'Paytm Phone','trim|required|min_length[3]|max_length[150]');
	        $this->form_validation->set_rules('accounteename', 'Paytm Phone','trim|required|min_length[5]|max_length[200]');
	    }
		if ($this->form_validation->run() == FALSE) {
            $data['validations'] = $this->form_validation->error_array();
			$data['status'] = -1;
			echo json_encode($data);
		}else{
		    $userid = $this->session->userdata['logged_in']['user_id'];
		    if(isset($_POST['paymenttype']) && ($_POST['paymenttype'] == 'paytm')){
    		    $inputdata = array(
    		        'paymenttype1' => $this->input->post('paymenttype'),
    		        'paytmphone' => $this->input->post('paytmphone'),
                );
                $response = $this->User_model->paymentdetails($userid, $inputdata);
    		    if($response == 1){
        	        $data['status'] = 1;
    				$data['response'] = 'success';
    				echo json_encode($data);
        	    }else{
        	        $data['status'] = 2;
    				$data['response'] = 'fail';
    				echo json_encode($data);
    	        }
		    }else if(isset($_POST['paymenttype']) && ($_POST['paymenttype'] == 'bankaccount')){
		        $inputdata = array(
    		        'paymenttype2' => $this->input->post('paymenttype'),
    		        'accountno' => $this->input->post('accountno'),
    		        'ifsccode' => $this->input->post('ifsccode'),
    		        'bankname' => $this->input->post('bankname'),
    		        'accounteename' => $this->input->post('accounteename'),
                );
                $response = $this->User_model->paymentdetails($userid, $inputdata);
    		    if($response == 1){
        	        $data['status'] = 1;
    				$data['response'] = 'success';
    				echo json_encode($data);
        	    }else{
        	        $data['status'] = 2;
    				$data['response'] = 'fail';
    				echo json_encode($data);
    	        }
		    }else{
		        
		    }
	    }
	}
	public function requestformoney(){
	    $userid = $this->session->userdata['logged_in']['user_id'];
	    if(isset($_POST['paymenttype']) && !empty($_POST['paymenttype'])){
	        $response = $this->User_model->requestformoney($userid, $_POST['paymenttype']);
		    if($response == 1){
    	        echo 1;
    	    }else{
    	        echo 0;
	        }
	    }
	}
	public function translist(){
	    $userid = $this->session->userdata['logged_in']['user_id'];
	    $response = $this->User_model->translist($userid);
	    if(isset($response) && ($response->num_rows() > 0)){
	        echo json_encode($response->result());
	    }else{
	        echo 0;
        }
	}
	/* story monitize request end */
	
	public function landingpage(){
	    $userid = $this->session->userdata['logged_in']['user_id'];
	    $response = $this->User_model->translist($userid);
	    if(isset($response) && ($response->num_rows() > 0)){
	        echo json_encode($response->result());
	    }else{
	        echo 0;
        }
	}
	
	public function readingliststatus($status){
	    if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){
	        $response = $this->User_model->readingliststatus($status, $this->session->userdata['logged_in']['user_id']);
    	    if($response){
    	        echo 1;
    	    }else{
    	        echo 0;
            }
	    }
	}
	
	
	
	
	public function about()
	{
		$this->load->view('about.php');
	}
	public function error(){
	    $this->load->view('error.php');
	}
	
	public function terms(){
	    $this->load->view('terms.php');
	}
	
	public function faq()
	{
	    $this->load->view('faq.php');
	}
	public function privacy_policy()
	{
	    $this->load->view('privacy.php');
	}
	
		/* Blog start*/
		
	public function blogsearch() {
        if(isset($_POST['search']) && !empty($_POST['search'])) {
			$dataresult = array();
            $response = $this->User_model->blogsearch($_POST['search']);
			//print_r($res);
        }
    }
		
    public function blog() {
        $data['blogs'] = $this->User_model->blogdetail();
        $this->load->view('blog.php', $data);
    }
    public function blogdetail($blogid) {
        $data['blogs'] = $this->User_model->blogdetail($blogid);
        $data['blogcomments'] = $this->User_model->blogcommentlists($blogid);
        $this->load->view('blogdetail.php',$data);
    }

    public function blog_comments() {
        if(isset($_POST['comment']) && !empty($_POST['comment']) && isset($_POST['blogid']) && !empty($_POST['blogid'])) {
            $comment = $this->input->post('comment');
            $blog_id = $this->input->post('blogid');
            $inputdata = array(
                'comment' => $comment,
                'blog_id' => $blog_id,
                'date' => DATE('Y-m-d'),
            );
            $result = $this->User_model->blog_comments($inputdata);
            if($result){
                $data['status'] = 1;
                $data['response'] = $inputdata;
                echo json_encode($data);
            }else{
                $data['status'] = 2;
                $data['response'] = 'fail';
                echo json_encode($data);
            }
        }else{
            $data['validations'] = 'Please Enter Comment Message';
            $data['status'] = -1;
            echo json_encode($data);
        }
    }
    
    
    public function ssearch() {
        if(isset($_GET['searchs']) && !empty($_GET['searchs'])){
            $data['searchs'] = $_GET['searchs'];
    		$data['blogs'] = $this->User_model->blogdetailsearch($data['searchs']);
    		$this->load->view('bsearchdata.php', $data);
        }
    }
    /* Blog end*/
	
	
	
	public function checkfacebooklogin(){
	    if(isset($_POST['id']) && !empty($_POST['id'])){
	        $inputdata = array(
	            'fbg_id' => $_POST['id'],
	            'logintype' => 'fb',
	        );
	        $userid = $this->User_model->checkfacebooklogin($inputdata, 1);
	        if(isset($userid) && !empty($userid)){
                $checkfbusercomm = $this->User_model->checkfbgusercomm($userid);
                if(isset($checkfbusercomm) && ($checkfbusercomm->num_rows() >= 2)){
                    echo json_encode(array('status' => 1, 'lresponse' => 'gotologin', 'userid' => $userid));
                }else{
                    echo json_encode(array('status' => 1, 'lresponse' => 'gotocomm', 'userid' => $userid));
                }
	        }else if(isset($_POST['email']) && !empty($_POST['email'])){
	            $user_id = $this->User_model->checkfacebooklogin(array('email' => $_POST['email']), 1, $inputdata);
	            if(isset($user_id) && !empty($user_id)){
                    $checkfbusercomm = $this->User_model->checkfbgusercomm($user_id);
                    if(isset($checkfbusercomm) && ($checkfbusercomm->num_rows() >= 2)){
                        echo json_encode(array('status' => 1, 'lresponse' => 'gotologin', 'userid' => $user_id));
                    }else{
                        echo json_encode(array('status' => 1, 'lresponse' => 'gotocomm', 'userid' => $user_id));
                    }
    	        }else{
    	            $user = $this->User_model->checkfacebooklogin($inputdata);
    	            if(isset($user) && !empty($user)){
    	                echo json_encode(array('status' => 1, 'lresponse' => 'gotolang', 'userid' => $user));
    	            }else if(isset($_POST['email']) && !empty($_POST['email']) && ($useremail = $this->User_model->checkfacebooklogin(array('email' => $_POST['email'])))){
    	                echo json_encode(array('status' => 1, 'lresponse' => 'gotolang', 'userid' => $useremail));
    	            }else{
    	                echo json_encode(array('status' => 1, 'lresponse' => 'gotofbgsignup'));
    	            }
    	        }
	        }else{
	            $user = $this->User_model->checkfacebooklogin($inputdata);
	            if(isset($user) && !empty($user)){
	                echo json_encode(array('status' => 1, 'lresponse' => 'gotolang', 'userid' => $user));
	            }else if(isset($_POST['email']) && !empty($_POST['email']) && ($useremail = $this->User_model->checkfacebooklogin(array('email' => $_POST['email'])))){
	                echo json_encode(array('status' => 1, 'lresponse' => 'gotolang', 'userid' => $useremail));
	            }else{
	                echo json_encode(array('status' => 1, 'lresponse' => 'gotofbgsignup'));
	            }
	        }
	    }else{
	        echo json_encode(array('status' => 0));
	    }
	}
	
	public function facebooklogin(){
	    if(isset($_POST['id']) && isset($_POST['fname']) && isset($_POST['lname'])){
	        $inputdata = array(
				'name' => $_POST['fname'],
				'lastname' => $_POST['lname'],
				'user_activation' => 1,
				'logintype' => 'fb',
			);
			$inputdata['fbg_id'] = $_POST['id'];
			$userid = $this->User_model->facebooklogin($inputdata, $_POST['id']); 
			if(isset($userid) && !empty($userid)){
				$response = $this->User_model->registerlogin($userid);
				if(isset($response) && ($response->num_rows() == 1)){
				    $result = $response->result();
				    $session_data = array(
						'name' => $result[0]->name,
						'email' => $result[0]->email,
						'user_id' => $result[0]->user_id,
						'profile_image' => $result[0]->profile_image,
						'logintype' => 'fb',
					);
					$this->session->set_userdata('logged_in', $session_data);
					$this->session->set_userdata('language', $result[0]->writer_language);
					echo 1;
				}else{
    				echo 0;
				}
			}else{
				echo 0;
			}
	    }else{
	        echo 0;
	    }
	}
	
	public function checkgooglelogin(){
	    if(isset($_POST['id']) && !empty($_POST['id']) && !isset($this->session->userdata['logged_in']['user_id'])){
	        $inputdata = array(
	            'fbg_id' => $_POST['id'],
	            'logintype' => 'google',
	        );
	        $userid = $this->User_model->checkgooglelogin($inputdata, 1);
	        if(isset($userid) && !empty($userid)){
                $checkgoousercomm = $this->User_model->checkfbgusercomm($userid);
                if(isset($checkgoousercomm) && ($checkgoousercomm->num_rows() >= 2)){
                    echo json_encode(array('status' => 1, 'lresponse' => 'gotologin', 'userid' => $userid));
                }else{
                    echo json_encode(array('status' => 1, 'lresponse' => 'gotocomm', 'userid' => $userid));
                }
	        }else if(isset($_POST['email']) && !empty($_POST['email'])){
	            $user_id = $this->User_model->checkgooglelogin(array('email' => $_POST['email']), 1, $inputdata);
	            if(isset($user_id) && !empty($user_id)){
                    $checkgoousercomm = $this->User_model->checkfbgusercomm($user_id);
                    if(isset($checkgoousercomm) && ($checkgoousercomm->num_rows() >= 2)){
                        echo json_encode(array('status' => 1, 'lresponse' => 'gotologin', 'userid' => $user_id));
                    }else{
                        echo json_encode(array('status' => 1, 'lresponse' => 'gotocomm', 'userid' => $user_id));
                    }
    	        }else{
    	            $user = $this->User_model->checkgooglelogin($inputdata);
    	            if(isset($user) && !empty($user)){
    	                echo json_encode(array('status' => 1, 'lresponse' => 'gotolang', 'userid' => $user));
    	            }else if(isset($_POST['email']) && !empty($_POST['email']) && ($useremail = $this->User_model->checkgooglelogin(array('email' => $_POST['email'])))){
    	                echo json_encode(array('status' => 1, 'lresponse' => 'gotolang', 'userid' => $useremail));
    	            }else{
    	                echo json_encode(array('status' => 1, 'lresponse' => 'gotofbgsignup'));
    	            }
    	        }
	        }else{
	            $user = $this->User_model->checkgooglelogin($inputdata);
	            if(isset($user) && !empty($user)){
	                echo json_encode(array('status' => 1, 'lresponse' => 'gotolang', 'userid' => $user));
	            }else if(isset($_POST['email']) && !empty($_POST['email']) && ($useremail = $this->User_model->checkgooglelogin(array('email' => $_POST['email'])))){
	                echo json_encode(array('status' => 1, 'lresponse' => 'gotolang', 'userid' => $useremail));
	            }else{
	                echo json_encode(array('status' => 1, 'lresponse' => 'gotofbgsignup'));
	            }
	        }
	    }else{
	        echo json_encode(array('status' => 0));
	    }
	}
	public function googlelogin(){
	    if(isset($_POST['id']) && isset($_POST['fname']) && isset($_POST['lname'])){
	        $inputdata = array(
				'name' => $_POST['fname'],
				'lastname' => $_POST['lname'],
				'user_activation' => 1,
				'logintype' => 'google',
			);
			$inputdata['fbg_id'] = $_POST['id'];
			$userid = $this->User_model->googlelogin($inputdata, $_POST['id']); 
			
			if(isset($userid) && !empty($userid)){
				$response = $this->User_model->registerlogin($userid);
				if(isset($response) && ($response->num_rows() == 1)){
				    $result = $response->result();
				    $session_data = array(
						'name' => $result[0]->name,
						'email' => $result[0]->email,
						'user_id' => $result[0]->user_id,
						'profile_image' => $result[0]->profile_image,
						'logintype' => 'google',
					);
					$this->session->set_userdata('logged_in', $session_data);
					$this->session->set_userdata('language', $result[0]->writer_language);
					echo 1;
				}else{
    				echo 0;
				}
			}else{
				echo 0;
			}
	    }else{
	        echo 0;
	    }
	}
	
	/*public function adminstoryloader(){
	    if(isset($_POST['limit']) && !empty($_POST['limit']) && isset($_POST['start']) && !empty($_POST['limit'])){
    	    $data['comment_get'] = $this->User_model->adminstorylist($_POST['start'],$_POST['limit']);
    	    $this->load->view('adminstoryloadmore.php',$data);
	    }
	}*/
	
	
}

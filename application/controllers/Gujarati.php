<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
class Gujarati extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
		$this->load->model('User_model');
		$this->load->library(array('user_agent','pagination','upload', 'ImageManipulator'));
		$this->load->helper('custom');
	}
	public function index() {
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
	        $sent_mailstatus = $this->User_model->sent_mailstatus($this->session->userdata['logged_in']['email']);
		}
		$this->load->view('otherlangs/header.php',$header);
		$this->load->view('otherlangs/sidebar.php');
		$this->load->view('otherlangs/index.php',$data);
		$this->load->view('otherlangs/footer.php');
	}
	public function languages(){
	    $header['languages'] = $this->User_model->language();
	    $data['status'] = 1;
	    $data['response'] = $header['languages']->result();
	    echo json_encode($data);
	}
	
	public function alpha_dash_space($name){
	    if(strlen(trim($name)) < 1){
	        $this->form_validation->set_message('alpha_dash_space', 'The %s field is required');
            return FALSE;
        }else if (! preg_match('/^[a-zA-Z0-9\s]+$/', $name)) {
            $this->form_validation->set_message('alpha_dash_space', 'The %s field should not contain special characters');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    public function alpha_dash_space_underscore($name){
        if(strlen(trim($name)) < 1){
            $this->form_validation->set_message('alpha_dash_space_underscore', 'The %s field is required');
            return FALSE;
        }else if (! preg_match('/^[a-zA-Z0-9\s-_]+$/', $name)) {
            $this->form_validation->set_message('alpha_dash_space_underscore', 'The %s field may only contain alpha numeric characters & spaces, underscore(_), hyphen(-)');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    public function signup() {
		$this->form_validation->set_rules('name', 'Name','trim|required|min_length[3]|max_length[30]|callback_alpha_dash_space');
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
			redirect(base_url().$this->uri->segment(1));
		} 
		else {
			$this->session->set_flashdata('signinmsg','<div class="alert alert-danger text-center">Sorry! There is error verifying your Email Address!</div>');
			redirect(base_url().$this->uri->segment(1));
		}
	}
	public function signin(){
	    if(isset($this->session->userdata['logged_in']['user_id'])) {
			redirect(base_url().$this->uri->segment(1));
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
				        $preferedlang = $this->User_model->langfullname($result[0]->writer_language);
    				    $data['status'] = 1;
        				$data['response'] = 'success';
        				$data['preferedlang'] = $preferedlang;
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
			redirect(base_url().$this->uri->segment(1));
		}
		$header['gener'] = $this->User_model->gener();
		$header['languages'] = $this->User_model->language();
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|md5'); 
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('otherlangs/header.php', $header);
			$this->load->view('otherlangs/footer.php');
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
				redirect(base_url().$this->uri->segment(1));
			} else {
				$this->session->set_flashdata('signinmsg', '<div class="alert alert-danger text-center">Invalid Username or Password! Please try with correct details </div>');
				$this->load->view('otherlangs/header.php', $header);
				$this->load->view('otherlangs/footer.php');
			}
		}
	}
	public function logout(){
       	$this->session->sess_destroy('logged_in');
        $data['message_display'] = 'Successfully Logout';
        redirect(base_url().$this->uri->segment(1));
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
        $header['gener'] = $this->User_model->gener();
		$header['languages'] = $this->User_model->language();
	    $this->load->view('otherlangs/header', $header);
		$this->load->view('otherlangs/resetpassword');
		$this->load->view('otherlangs/footer');
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
			} else{
				$data['status'] = 2;
				$data['response'] = 'fail';
				echo json_encode($data);
			}
		}
	}
	public function forgotpwd($hash){
	    if(isset($this->session->userdata['logged_in']['user_id'])) {
			redirect(base_url().$this->uri->segment(1));
		}
		$header['languages'] = $this->User_model->language();
		$header['gener'] = $this->User_model->gener();
		$header['typewrites'] = $this->User_model->typewrites();
		$header['landinggrids'] = $this->User_model->landiggrids();
		$header['landinglogos'] = $this->User_model->landinglogos();
		$header['hash'] = $hash;
		$this->load->view('otherlangs/landing.php', $header);
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
        if(isset($_POST['choselanguage'], $_POST['userid']) && !empty($_POST['choselanguage']) && !empty($_POST['userid'])){
            $langupdate = $this->User_model->langupdate($_POST['choselanguage'], $_POST['userid']);
            if($langupdate){
                echo json_encode(1);
            }else{
                json_encode(0);
            }
        }else{
            json_encode(0);
        }
    }
    public function choosecommu(){
        if(isset($_POST['commids'], $_POST['cslang'], $_POST['userid']) && !empty($_POST['userid']) && !empty($_POST['cslang']) && (count($_POST['commids']) > 0)){
			$userid = $_POST['userid'];
			$resultarray = array_count_values($_POST['commids']);
			$commus = array(); 
			foreach($resultarray as $key => $value){
				if(($value > 1) && ($value % 2 == 0)){
				}else{
					array_push($commus,$key);
				}
			}
			if(count($commus) > 0){
				$response = $this->User_model->choosecommu($commus, $userid, $_POST['cslang']);
				if($response){
				    if(isset($userid, $this->session->userdata['logged_in']['user_id']) && ($userid == $this->session->userdata['logged_in']['user_id'])){
				        echo 1;
				    } else if(isset($userid) && !empty($userid)){
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
        					echo $this->User_model->langfullname($result[0]->writer_language);
        				}else{
        				    echo 1; // from userid you can login
        				}
				    }else{
				        echo 1; // from userid you can login
				    }
				}else{
					echo 0;
				}
			}
        }else{
            echo 0;
        }
    }
    public function unchoosecommu($bynamelang = false){
        if(isset($bynamelang, $_POST['genre'], $_POST['language']) && ($bynamelang == 'bynamelang') && !empty($_POST['genre']) && !empty($_POST['language'])){
            $unselectedresponse = $this->User_model->unchoosedcommu('', $_POST['genre'], $_POST['language']);
            if($unselectedresponse){
                echo 1;
            }else{
                echo 0;
            }
        }else if(isset($_POST['uncommids']) && isset($_POST['commids'])){
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
	public function writers(){
	    $header['gener'] = $this->User_model->gener();
		$header['languages'] = $this->User_model->language();
		$data['get_writer'] = $this->User_model->get_top_writer('',0,5);
		$data['follow_count'] = $this->User_model->follow_count();
		$data['following'] = $this->User_model->following();
	    $this->load->view('otherlangs/header.php',$header);
		$this->load->view('otherlangs/sidebar.php');
		$this->load->view('otherlangs/writers.php',$data);
		$this->load->view('otherlangs/footer.php');
	}
	public function topwriterloading(){
	    if(isset($_POST['limit'], $_POST['start'])){
	        $data['get_writer'] = $this->User_model->get_top_writer('',$_POST['start'], $_POST['limit']);
	        $data['follow_count'] = $this->User_model->follow_count();
		    $data['following'] = $this->User_model->following();
	        $this->load->view('otherlangs/writersloadmore.php',$data);
	    }
	}
	public function get_story_groupdata(){
	    if(!isset($this->session->userdata['logged_in']['user_id']) || empty($this->session->userdata['logged_in']['user_id'])){
	        echo 'notlogin';
 	    }else if(isset($_POST['id']) && !empty($_POST['id'])) {
			$storyid = $this->input->post('id');
	        $data['storysuggesttogroup'] = $this->User_model->get_story_data($storyid);
	        $data['communities_gener'] = $this->User_model->usercommunities_gener();
            $this->load->view('otherlangs/storysuggesttogroup', $data);
		}else{
		    $this->load->view('otherlangs/storysuggesttogroup');
		}
 	}
	public function get_story_data() {
	    if(!isset($this->session->userdata['logged_in']['user_id']) || empty($this->session->userdata['logged_in']['user_id'])){
	        echo 'notlogin';
 	    }else if(isset($_POST['id']) && !empty($_POST['id'])) {
			$storyid = $this->input->post('id');
	        $data['storysuggesttofrd'] = $this->User_model->get_story_data($storyid);
	        $data['allusers'] = $this->User_model->allusers();
            $this->load->view('otherlangs/storysuggesttofrd', $data);
		}else{
		    $this->load->view('otherlangs/storysuggesttofrd');
		}
 	}
	public function series(){
	    $header['gener'] = $this->User_model->gener();
		$header['languages'] = $this->User_model->language();
		$this->load->view('otherlangs/series.php', $header);
	}
	public function series_story_uplode() {
	    if(!isset($this->session->userdata['logged_in']['user_id']) ){
	        redirect(base_url().$this->uri->segment(1));
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
        		$this->load->view('otherlangs/series.php', $header);
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
                        $header['error'] = $this->upload->display_errors();
                		$this->load->view('otherlangs/series.php', $header);
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
                        //unlink($config['source_image']);
                        
                        $date = strtotime(date('Y-m-d h:i:s'));
                        $newNamePrefix = $date.'_';
                        $manipulator = new ImageManipulator($_FILES['cover_image']['tmp_name']);
                        $newImage = $manipulator->resample(200, 180, FALSE);
                        $image = $newNamePrefix.$_FILES['cover_image']['name'];
                        // saving file to uploads folder
                        $manipulator->save('assets/images/'.$newNamePrefix.$_FILES['cover_image']['name']);
                        
                    }else{
                        $header['error'] = $this->upload->display_errors();
                		$this->load->view('otherlangs/series.php', $header);
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
                redirect(base_url().$this->uri->segment(1).'/series_priview/'.$lid);
    		}
	    }
    }
	public function series_priview($lid) {
        if($this->session->userdata('logged_in')==NULL) redirect(base_url().$this->uri->segment(1));
		$header['res'] = $this->User_model->edit_story($lid);
		$this->load->view('otherlangs/series_priview.php',$header);
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
		$this->form_validation->set_rules('story', 'story', 'trim|required');
		$this->form_validation->set_rules('story_id', 'story_id', 'trim|required');
		$this->form_validation->set_rules('draft', 'Draft', 'trim');
		$add = '';
		if(isset($_POST['addepisode']) && !empty($_POST['addepisode'])){
		    $add = $_POST['addepisode'];
		}
		if ($this->form_validation->run() == FALSE) {
    		$this->load->view('otherlangs/header.php', $header);
    		$this->load->view('otherlangs/series_story',$data);//series_priview.php
            $this->load->view('otherlangs/footer.php');
        } else {
            $title = preg_replace('/\s+/', '', $_POST['title']);
			$inputdata = array(
				'story' => $this->input->post('story'),
				'story_id' => $this->input->post('story_id'),
			);
			if(isset($_POST['draft']) && ($_POST['draft'] == 'draft')){
			    $inputdata['draft'] = $_POST['draft'];
			}
			$res = $this->User_model->addstory($inputdata, $lid);
			if($add == 'yes'){
			    redirect(base_url($this->uri->segment(1).'/episode/'.$title.'-'.$lid.'/'.$title.'-'.$lid));
			}else{
		       redirect(base_url($this->uri->segment(1).'/admin-series/'.$title.'-'.$lid.'/'.$title.'-'.$lid));
			}
		}
	}
	public function new_series_admin($seriesnamesid, $seriesnamestoryid) {
	    $series_sid = explode('-', $seriesnamesid);
	    $sid  = end($series_sid); // get series sid & sid in db table
	    $series_storyid = explode('-', $seriesnamestoryid);
	    $s_storyid  = end($series_storyid); // get series story_id & story_id in db table
	    $header['gener'] = $this->User_model->gener();
		$header['languages'] = $this->User_model->language();
		if(isset($_POST['seimage_sid']) && isset($sid) && !empty($sid)){
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
                    $config['maintain_ratio'] = FALSE;
                    $config['quality'] = '85%';
                    $config['width'] = 293;
                    $config['height'] = 280;
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                    $picture1 = $uploadData['file_name'];
                    //unlink($config['source_image']);
                    
                    $date = strtotime(date('Y-m-d h:i:s'));
                    $newNamePrefix = $date.'_';
                    $manipulator = new ImageManipulator($_FILES['cover_image']['tmp_name']);
                    $newImage = $manipulator->resample(200, 180,FALSE);
                    $image = $newNamePrefix.$_FILES['cover_image']['name'];
                    // saving file to uploads folder
                    $manipulator->save('assets/images/'.$newNamePrefix.$_FILES['cover_image']['name']);
                }
            }
            $inputdata = array(
                'story_id' => $sid,
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
            $uniqueviews = $this->User_model->uniqueviews($sid);
    		$data['admin_story_view'] = $this->User_model->admin_story_view($sid);
    		$data['new_series'] = $this->User_model->new_series($sid,$s_storyid);
		    $data['recentseries'] = $this->User_model->recentseries($sid,$s_storyid);
    		$data['comment_get'] = $this->User_model->comment_get($sid, 0,2);
    		$data['new_episode'] = $this->User_model->new_episode($s_storyid);
    		$data['userstorys'] = $this->User_model->userstorys();
    		$data['lastepisode'] = $this->User_model->checkforlastepisode($s_storyid);
    		$data['seriesftitle'] = $this->User_model->seriesftitle($s_storyid);
    		$data['nextepisode'] = $this->User_model->nextepisode($sid,$s_storyid);
    		if(isset($sid, $s_storyid) && ($sid == $s_storyid)){
    		    $data['reviews'] = $this->User_model->reviews_series($sid);
    		}else{
    		    $data['reviews'] = $this->User_model->reviews($sid);
    		}
    		$data['favorites'] = $this->User_model->favoritreadlater('favorite',$sid);
    		$data['story_id'] = $s_storyid;
    		$this->load->view('otherlangs/header.php', $header);
            $this->load->view('otherlangs/new_series_admin.php',$data);
            $this->load->view('otherlangs/footer.php');
        }
	}
	public function seriesaddtodrafts(){
	    if(isset($_POST['title']) && isset($_POST['story'])){
	        $title = preg_replace('/\s+/', '', $_POST['title']);
	        //$_POST['story'] = str_replace('nbsp;',' ',$_POST['story']);
	        $story = preg_replace('/\s+/', '', $_POST['story']);
	        if(!empty($title) || !empty($story)){
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
        if(isset($_POST['story'],$_POST['sid']) && !empty($_POST['story']) && !empty($_POST['sid']) && isset($_POST['pay_story'])){
            $data = array('draft' => 'draft', 'story' => $_POST['story'], 'pay_story' => $_POST['pay_story']);
            $response = $this->User_model->prefaceautosave($data, $_POST['sid']);
            if($response){
                echo 1;
            }else{
                echo 0;
            }
        }
    }
	public function new_series($seriesnamesid, $seriesnamestoryid) {
	    $series_sid = explode('-', $seriesnamesid);
	    $sid  = end($series_sid); // get series sid & sid in db table
	    $series_storyid = explode('-', $seriesnamestoryid);
	    $s_storyid  = end($series_storyid); // get series story_id & story_id in db table
	    $header['gener'] = $this->User_model->gener();
		$header['languages'] = $this->User_model->language();
	    $uniqueviews = $this->User_model->uniqueviews($sid);
	    $data['nextepisode'] = $this->User_model->nextepisode($sid,$s_storyid);
		$res = $this->User_model->viewsupdate($sid);
		$data['comment_like'] = $this->User_model->comment_like($sid);
		$data['recentseries'] = $this->User_model->recentseries($sid,$s_storyid);
		if(isset($sid, $s_storyid) && ($sid == $s_storyid)){
		    $data['reviews'] = $this->User_model->reviews_series($sid);
		}else{
		    $data['reviews'] = $this->User_model->reviews($sid);
		}
		$data['userrating'] = $this->User_model->userrating($sid);
		$data['comment_get'] = $this->User_model->comment_get($sid);
		$data['new_series'] = $this->User_model->new_series($sid,$s_storyid);
		// For Meta tags social share end
		if(isset($data['new_series']) && ($data['new_series']->num_rows() > 0 )){
		    $metatags = $data['new_series']->result();
		    $header['ogtitle'] = $metatags[0]->title;
		    $header['ogetitle'] = $metatags[0]->etitle;
		    $header['ogkeywords'] = $metatags[0]->keywords;
		    $header['ogdescription'] = strip_tags($metatags[0]->story);
		    $header['ogauthor'] = $metatags[0]->name;
		    $header['ogurl'] = urlencode(base_url().'series/'.$seriesnamesid.'/'.$seriesnamestoryid);
		    $header['ogsesslang'] = $this->User_model->langshortname($this->uri->segment(1));
		    if(isset($metatags[0]->image) && !empty($metatags[0]->image)){
		        $header['ogimage'] = $metatags[0]->image;
		    }else{
		        $header['ogimage'] = '1.jpg';
		    }
		} // For Meta tags social share end
		$data['new_episode'] = $this->User_model->new_episode($s_storyid);
		$data['favorites'] = $this->User_model->favoritreadlater('favorite',$sid);
		$data['following'] = $this->User_model->following();
		$data['subscriptions'] = $this->User_model->favoritreadlater('seriessubscribe',$s_storyid);
		$data['countsubs'] = $this->User_model->seriesreadlater('seriessubscribe', $s_storyid);
		$data['seriesftitle'] = $this->User_model->seriesftitle($s_storyid);
		$this->load->view('otherlangs/header.php', $header);
		$this->load->view('otherlangs/new_series.php',$data);
		$this->load->view('otherlangs/footer.php');
	}
	public function addnewepisode($seriesnamesid, $seriesnamestoryid) {
	    $series_sid = explode('-', $seriesnamesid);
	    $sid  = end($series_sid); // get series sid & sid in db table
	    $series_storyid = explode('-', $seriesnamestoryid);
	    $s_storyid  = end($series_storyid); // get series story_id & story_id in db table
		$header['new_episode'] = $this->User_model->new_episode($s_storyid);
		$header['seriesftitle'] = $this->User_model->seriesftitle($s_storyid);
		$header['story_id'] = $s_storyid;
	    $this->load->view('otherlangs/newepisode.php',$header);
	}
	public function addepisodeimage(){
        if(isset($_FILES['cover_image']['name'], $_POST['seriesid']) && !empty($_FILES['cover_image']['name']) && !empty($_POST['seriesid'])) {
            $picture1 =''; $image ='';
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
                $newImage = $manipulator->resample(200, 180, FALSE);
                $image = $newNamePrefix.$_FILES['cover_image']['name'];
                $manipulator->save('assets/images/'.$newNamePrefix.$_FILES['cover_image']['name']);
                $data = array('cover_image' => $picture1, 'image' => $image);
                $returndata = array();
                $returndata['picture'] = $picture1;
                if(isset($_POST['seimage_sid']) && !empty($_POST['seimage_sid'])){
                    $response = $this->User_model->uploaddraftimage($_POST['seimage_sid'], $data);
                    echo json_encode($returndata);
                }else{
                    $siddata = array(
                        'story_id' => $_POST['seriesid'],
                        'user_id' => $this->session->userdata['logged_in']['user_id'],
                        'draft' => 'draft',
                        'type' => 'series',
                    );
                    $sidresponse = $this->User_model->addseriesepisode($siddata);
                    if(!empty($sidresponse)){
                        $response = $this->User_model->uploaddraftimage($sidresponse, $data);
                        $returndata['sid'] = $sidresponse;
                        echo json_encode($returndata);
                    }else{
                        echo 0;
                    }
                }
            }else{
                echo 0;
            }
        }else{
            echo 0;
        }
    }
    public function addepisode($seriesnamesid, $seriesnamestoryid){
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
                $config['maintain_ratio'] = FALSE;
                $config['quality'] = '85%';
                $config['width'] = 293;
                $config['height'] = 280;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $picture1 = $uploadData['file_name'];
                //unlink($config['source_image']);
                
                $date = strtotime(date('Y-m-d h:i:s'));
                $newNamePrefix = $date.'_';
                $manipulator = new ImageManipulator($_FILES['cover_image']['tmp_name']);
                $newImage = $manipulator->resample(200, 180,FALSE);
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
    	//if(strlen($story) > 199){ }else{ $draft = 'draft'; }
    	if(strlen(trim($title)) > 0){ }else{ $draft = 'draft'; }
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
    	    redirect(base_url().$this->uri->segment(1).'/admin-series/'.$seriesnamesid.'/'.$seriesnamestoryid);
    	}else{
    	    $data = $this->User_model->addepisode($data, $sid);
    	    redirect(base_url().$this->uri->segment(1).'/admin-series/'.$seriesnamesid.'/'.$seriesnamestoryid);
    	}
    }
    public function story_info($sid){
        if($this->session->userdata('logged_in')==NULL) redirect(base_url());
		$header['gener'] = $this->User_model->gener();
		$header['languages'] = $this->User_model->language();
		$header['story_info'] = $this->User_model->story_info($sid);
		$header['sid'] = $sid;
		if(isset($header['story_info']) && $header['story_info']->num_rows() == 1){
		    $result = $header['story_info']->result();
		    if(isset($result[0]->type) && ($result[0]->type == 'series') && ($result[0]->sid == $result[0]->story_id)){
		        $header['preface'] = 'preface';
		        $this->load->view('otherlangs/editseries_info.php',$header);
		    }else if(isset($result[0]->type) && ($result[0]->type == 'series') && ($result[0]->sid != $result[0]->story_id)){
		        redirect(base_url().$this->uri->segment(1).'/series_edit/'.$sid);
		    }else if(isset($result[0]->type) && ($result[0]->type == 'story')){
		        $this->load->view('otherlangs/editstory_info.php',$header);
		    }else if(isset($result[0]->type) && ($result[0]->type == 'life')){
		        $header['tagslist'] = $this->User_model->lifetagslist();
		        $this->load->view('otherlangs/editlife_info.php',$header);
		    }else{
		        
		    }
		}else{
		    
		}
	}
	public function updateseries_info($sid){
        $header['gener'] = $this->User_model->gener();
        $header['languages'] = $this->User_model->language();
        $header['story_info'] = $this->User_model->story_info($sid);
        $header['sid'] = $sid;
        if(isset($_POST['editstorytype']) && ($_POST['editstorytype'] == 'seriespreface')){
            $this->form_validation->set_rules('title', 'title', 'trim|required');
            $this->form_validation->set_rules('genre', 'Gener', 'trim|required');
            $this->form_validation->set_rules('copyrights', 'copyrights', 'trim|required');
            $this->form_validation->set_rules('keywords', 'keywords', 'trim|required');
            $this->form_validation->set_rules('pay_story', 'Monitization', 'trim|required');
            if(isset($_POST['language']) && ($_POST['language'] != 'en')){
                $this->form_validation->set_rules('etitle', 'English Title', 'trim|required');
            }
            if ($this->form_validation->run() == FALSE) {
                $header['preface'] = 'preface';
                $this->load->view('otherlangs/editseries_info.php',$header);
            }else{
                $picture1 =''; $image ='';
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
                        $newImage = $manipulator->resample(200, 180, FALSE);
                        $image = $newNamePrefix.$_FILES['cover_image']['name'];
                        // saving file to uploads folder
                        $manipulator->save('assets/images/'.$newNamePrefix.$_FILES['cover_image']['name']);
                    }
                }
                $updatedata = array(
                    'title' => $this->input->post('title'),
                    'etitle' => $this->input->post('etitle'),
                    'genre' => $this->input->post('genre'),
                    'copyrights' => $this->input->post('copyrights'),
                    'keywords' => $this->input->post('keywords'),
                    'pay_story' => $this->input->post('pay_story'),
                );
                if(isset($picture1) && !empty($picture1)){
                    $updatedata['cover_image'] = $picture1;
                }
                if(isset($image) && !empty($image)){
                    $updatedata['image'] = $image;
                }
                $result  = $this->User_model->update_info($sid,$updatedata);
                if($result){
                    redirect(base_url($this->uri->segment(1).'/admin-series/'.preg_replace('/\s+/', '-',$this->input->post('title')).'-'.$sid.'/'.preg_replace('/\s+/', '-',$this->input->post('title')).'-'.$sid));
                }else{
                    $header['preface'] = 'preface';
                    $this->load->view('otherlangs/editseries_info.php',$header);
                }
            }
        }else{
            redirect(base_url($this->uri->segment(1).'/story_info/'.$sid));
        }
	}
	public function updatestory_info($sid){
	    $header['gener'] = $this->User_model->gener();
        $header['languages'] = $this->User_model->language();
        $header['story_info'] = $this->User_model->story_info($sid);
        $header['sid'] = $sid;
        if(isset($_POST) && !empty($_POST)){
            $this->form_validation->set_rules('title', 'title', 'trim|required');
            $this->form_validation->set_rules('genre', 'Gener', 'trim|required');
            $this->form_validation->set_rules('copyrights', 'copyrights', 'trim|required');
            $this->form_validation->set_rules('keywords', 'keywords', 'trim|required');
            $this->form_validation->set_rules('pay_story', 'Monitization', 'trim|required');
            if(isset($_POST['language']) && ($_POST['language'] != 'en')){
                $this->form_validation->set_rules('etitle', 'English Title', 'trim|required');
            }
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('otherlangs/editstory_info.php',$header);
            }else{
                $picture1 =''; $image ='';
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
                        $newImage = $manipulator->resample(200, 180, FALSE);
                        $image = $newNamePrefix.$_FILES['cover_image']['name'];
                        // saving file to uploads folder
                        $manipulator->save('assets/images/'.$newNamePrefix.$_FILES['cover_image']['name']);
                    }
                }
                $updatedata = array(
                    'title' => $this->input->post('title'),
                    'etitle' => $this->input->post('etitle'),
                    'genre' => $this->input->post('genre'),
                    'copyrights' => $this->input->post('copyrights'),
                    'keywords' => $this->input->post('keywords'),
                    'pay_story' => $this->input->post('pay_story'),
                );
                if(isset($picture1) && !empty($picture1)){
                    $updatedata['cover_image'] = $picture1;
                }
                if(isset($image) && !empty($image)){
                    $updatedata['image'] = $image;
                }
                $result  = $this->User_model->update_info($sid,$updatedata);
                if($result){
                    redirect(base_url($this->uri->segment(1).'/admin-story/'.preg_replace('/\s+/', '-',$this->input->post('title')).'-'.$sid));
                }else{
                    $this->load->view('otherlangs/editstory_info.php',$header);
                }
            }
        }else{
            redirect(base_url($this->uri->segment(1).'/story_info/'.$sid));
        }
	}
	public function updatelife_info($sid){
	    $header['gener'] = $this->User_model->gener();
        $header['languages'] = $this->User_model->language();
        $header['story_info'] = $this->User_model->story_info($sid);
        $header['sid'] = $sid;
        if(isset($_POST) && !empty($_POST)){
            $this->form_validation->set_rules('title', 'title', 'trim|required');
            $this->form_validation->set_rules('pay_story', 'Monitization', 'trim|required');
            $this->form_validation->set_rules('writing_style', 'Display Name', 'trim|required');
            if(isset($_POST['language']) && ($_POST['language'] != 'en')){
                $this->form_validation->set_rules('etitle', 'English Title', 'trim|required');
            }
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('otherlangs/editlife_info.php',$header);
            }else{
                $picture1 =''; $image ='';
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
                        $newImage = $manipulator->resample(266, 165, FALSE);
                        $image = $newNamePrefix.$_FILES['cover_image']['name'];
                        // saving file to uploads folder
                        $manipulator->save('assets/images/'.$newNamePrefix.$_FILES['cover_image']['name']);
                    }
                }
                $updatedata = array(
                    'title' => $this->input->post('title'),
                    'etitle' => $this->input->post('etitle'),
                    'writing_style' => $this->input->post('writing_style'),
                    'pay_story' => $this->input->post('pay_story'),
                );
                $keywords = '';
                if(isset($_POST['keywords'])){
                    $keywords = $_POST['keywords'];
                }
                if(isset($picture1) && !empty($picture1)){
                    $updatedata['cover_image'] = $picture1;
                }
                if(isset($image) && !empty($image)){
                    $updatedata['image'] = $image;
                }
                $result  = $this->User_model->updatelife_info($sid,$updatedata, $keywords);
                if($result){
                    redirect(base_url($this->uri->segment(1).'/admin-story/'.preg_replace('/\s+/', '-',$this->input->post('title')).'-'.$sid));
                }else{
                    $this->load->view('otherlangs/editlife_info.php',$header);
                }
            }
        }else{
            redirect(base_url($this->uri->segment(1).'/story_info/'.$sid));
        }
	}
	/*public function story_info_uplode(){
	    $this->form_validation->set_rules('title', 'title', 'trim|required|callback_alpha_dash_space_underscore');
		if ($this->form_validation->run() == FALSE) {
		    $this->session->set_flashdata('titlemsg', 'Title allows alpha numeric spaces and underscore(_) and hyphen(-) ');
		    redirect(base_url().$this->uri->segment(1).'/story_info/'.$_POST['hidden']);
		}
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
      	    redirect(base_url($this->uri->segment(1).'/admin-series/'.preg_replace('/\s+/', '-',$title).'-'.$sid.'/'.preg_replace('/\s+/', '-',$title).'-'.$story_id));
      	} else {
            redirect(base_url($this->uri->segment(1).'/admin-story/'.preg_replace('/\s+/', '-', $title).'-'.$sid));
        }
    }*/
    public function series_edit($sid){
	 	if($this->session->userdata('logged_in')==NULL) redirect(base_url().$this->uri->segment(1));
		$header['series_edit'] = $this->User_model->series_edit($sid);
        $this->load->view('otherlangs/series_edit.php',$header);
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
		    redirect(base_url().$this->uri->segment(1).'/series_edit/'.$_POST['story_id']);
        } else {
            $title = preg_replace('/\s+/', '-',$_POST['title']);
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
                    $config['maintain_ratio'] = FALSE;
                    $config['quality'] = '85%';
                    $config['width'] = 293;
                    $config['height'] = 280;
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                    $picture1 = $uploadData['file_name'];
                    //unlink($config['source_image']);
                    
                    $date = strtotime(date('Y-m-d h:i:s'));
                    $newNamePrefix = $date.'_';
                    $manipulator = new ImageManipulator($_FILES['cover_image']['tmp_name']);
                    $newImage = $manipulator->resample(200, 180,FALSE);
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
			if(isset($_POST['title']) && !empty($_POST['title'])){
				$inputdata['title'] = $_POST['title'];
			}
			if(!empty($picture1)){
				$inputdata['cover_image'] = $picture1;
			}
			if(!empty($image)){
				$inputdata['image'] = $image;
			}
			$res = $this->User_model->updatestory($inputdata,$id);
			redirect(base_url($this->uri->segment(1).'/admin-series/'.$title.'-'.$id.'/'.$title.'-'.$story_id));
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
                redirect(base_url().$this->uri->segment(1).'/admin_story_view/'.$storyid);
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
                if(isset($_POST['type']) && ($_POST['type'] == 'life')){
                    $newImage = $manipulator->resample(266, 165,FALSE);
                }else{
                    $newImage = $manipulator->resample(200, 180,FALSE);
                }
                $image = $newNamePrefix.$_FILES['cover_image']['name'];
                $manipulator->save('assets/images/'.$newNamePrefix.$_FILES['cover_image']['name']);
                
            }else{
                $this->session->set_flashdata('errmsg', 'The Upload Image size should be less than 2MB.');
                redirect(base_url().$this->uri->segment(1).'/admin_story_view/'.$storyid);
            }
        }
	    $inputdata = array(
			'story' => $this->input->post('story'),
		);
		$title = $this->input->post('title');
		if(!empty($picture1)){
			$inputdata['cover_image'] = $picture1;
		}
		if(!empty($picture1)){
			$inputdata['image'] = $image;
		}
		$res = $this->User_model->updatestory($inputdata, $storyid);
		if($res){
		    redirect(base_url().$this->uri->segment(1).'/admin-story/'.preg_replace('/\s+/', '-',$title).'-'.$storyid);
		}else{
		    redirect(base_url().$this->uri->segment(1).'/admin_story_view/'.$storyid);
		}
	}
	/*public function updatestory12($id)
	{
		$header['gener'] = $this->User_model->gener();
		$header['languages'] = $this->User_model->language();
		$this->form_validation->set_rules('story', 'story', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
		
		$this->load->view('otherlangs/header.php', $header);
		$this->load->view('otherlangs/admin_story.php',$data);
        $this->load->view('otherlangs/footer.php');
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
			redirect(base_url($this->uri->segment(1).'/admin_story?id='.$id));
		}
	}*/
	public function addtodrafts(){
	    if(isset($_POST['sid']) && isset($_POST['story']) && isset($_POST['draft'])){
	        $sid = $_POST['sid'];
	        $data = array(
	            'story' => $_POST['story'],
	            'draft' => $_POST['draft'],
	            'user_id' => $this->session->userdata['logged_in']['user_id'],
	            'updated_at' => date("Y-m-d"),
	        );
	        if(isset($_POST['title'])){
	            $data['title'] = $_POST['title'];
	        }
	        $response  = $this->User_model->addtodrafts($data, $sid);
	        if($response){
	            echo 1;
	        }else{
	            echo 0;
	        }
	    }else{
	        echo 0;
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
                $newImage = $manipulator->resample(700, 400,FALSE);
                $manipulator->save($imagepath);
                echo base_url().$imagepath;
        	 }else{
        	     echo base_url().$imagepath;
        	 }
        }
        else {
        	echo 'Error : Only JPEG, PNG & GIF allowed';
        }
    }
    public function storymonitizeradio(){
	    if(isset($this->session->userdata['logged_in']['user_id'])){
	        $userid = $this->session->userdata['logged_in']['user_id'];
	        $language = $this->User_model->langshortname($this->uri->segment(1));
	        $followwritecount = $this->User_model->followwritecount($userid, $language);
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
		$this->load->view('otherlangs/story.php', $header);
	}
	public function story_story_uplode() {
	    if($this->session->userdata('logged_in')==NULL) redirect(base_url().$this->uri->segment(1));
	    $header['gener'] = $this->User_model->gener();
		$header['languages'] = $this->User_model->language();
		if(isset($_POST) && !empty($_POST)){
    	    $this->form_validation->set_rules('language', 'Language','trim|required', array('required' => 'This field is required'));
    		$this->form_validation->set_rules('title', 'Title', 'trim|required', array('required' => 'This field is required'));
    		if(isset($_POST['language']) && ($_POST['language'] != 'en')){
    		    $this->form_validation->set_rules('etitle', 'English Title', 'trim|required', array('required' => 'This field is required'));
    		}
    		$this->form_validation->set_rules('genre', 'Gener', 'trim|required', array('required' => 'This field is required'));
    		$this->form_validation->set_rules('copyrights', 'Copy Rights', 'trim|required', array('required' => 'This field is required'));
    		$this->form_validation->set_rules('keywords', 'Key Words', 'trim');
    		$this->form_validation->set_rules('pay_story', 'Monitization', 'trim|required', array('required' => 'This field is required'));
    		if ($this->form_validation->run() == false) {
    		    $this->load->view('otherlangs/story.php', $header);
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
                        $header['error'] = $this->upload->display_errors();
                		$this->load->view('otherlangs/story.php', $header);
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
        
                        $validExtensions = array('.jpg', '.jpeg', '.gif', '.png'); //// array of valid extensions
                        $fileExtension = strrchr($_FILES['cover_image']['name'], "."); //// get extension of the uploaded file
                        // check if file Extension is on the list of allowed ones
                        if (in_array($fileExtension, $validExtensions)) {
                            $date = strtotime(date('Y-m-d h:i:s'));
                            $newNamePrefix = $date.'_';
                            $manipulator = new ImageManipulator($_FILES['cover_image']['tmp_name']);
                            $newImage = $manipulator->resample(200, 180, FALSE);
                            $image = $newNamePrefix.$_FILES['cover_image']['name'];
                            // saving file to uploads folder
                            $manipulator->save('assets/images/'.$newNamePrefix.$_FILES['cover_image']['name']);
                        }
                    }else{
                        $header['error'] = $this->upload->display_errors();
                		$this->load->view('otherlangs/story.php', $header);
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
                redirect(base_url().$this->uri->segment(1).'/series_story/'.$lid);
    		}
		}else{
		    $this->load->view('otherlangs/story.php', $header);
		}
    }
	public function series_story($lid) {
		if($this->session->userdata('logged_in')==NULL) redirect(base_url().$this->uri->segment(1));
        $data['res']  = $this->User_model->edit_story($lid);
		$this->load->view('otherlangs/series_story.php',$data);
	}
	public function admin_story_view($sid){
	    $header['gener'] = $this->User_model->gener();
		$header['languages'] = $this->User_model->language();
	    $header['editstory'] = $this->User_model->editstory($sid);
        $this->load->view('otherlangs/admin_story_view.php',$header);
    }
    public function series_series($lid) {
		if($this->session->userdata('logged_in')==NULL) redirect(base_url());
        $data['res']  = $this->User_model->edit_story($lid);
        $data['new_episode'] = $this->User_model->new_episode_show($lid);
        $data['seriesftitle'] = $this->User_model->seriesftitle($lid);
		$this->load->view('otherlangs/series_series.php',$data);
	}
	public function addstory($lid){
	    $header['gener'] = $this->User_model->gener();
		$header['languages'] = $this->User_model->language();
		$data['res']  = $this->User_model->edit_story($lid);
		$this->form_validation->set_rules('story', 'story', 'trim|required');
		$this->form_validation->set_rules('story_id', 'story_id', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
		    $this->load->view('otherlangs/header.php', $header);
    		$this->load->view('otherlangs/series_story.php',$data);
            $this->load->view('otherlangs/footer.php');
        } else {
			$inputdata = array(
				'story' => $this->input->post('story'),
				'story_id' => $this->input->post('story_id'), // or 'story_id' => $lid, for type 'story' writing
				'draft' => '',
			);
			if(isset($_POST['writing_style']) && !empty($_POST['writing_style'])){
			    $inputdata['writing_style'] = $_POST['writing_style'];
			}
			$res = $this->User_model->addstory($inputdata,$lid); //publish previous draft series
			if($inputdata['draft'] == 'draft'){
			    $this->session->set_flashdata('msg','Story saved in drafts, for publishing needs minimum 200 characters.');
			    redirect(base_url().$this->uri->segment(1).'/addstory/'.$lid);
			}else{
			    redirect(base_url($this->uri->segment(1)));
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
    		$this->load->view('otherlangs/header.php', $header);
    		$this->load->view('otherlangs/series_story.php',$data);
            $this->load->view('otherlangs/footer.php');
        } else {
			$inputdata = array(
				'story' => $this->input->post('story'),
				'draft' => '',
			);
			if(isset($_POST['lastepisode']) && ($_POST['lastepisode'] == 'yes')){
			    $inputdata['last_episode'] = $_POST['lastepisode'];
			}
			$res = $this->User_model->seriesaddstory($inputdata,$lid);
			redirect(base_url($this->uri->segment(1).'/drafts'));
		}
	}
	public function nano_story() {
		if($this->session->userdata('logged_in')==NULL) redirect(base_url().$this->uri->segment(1));
		$header['languages'] = $this->User_model->language();
		$this->load->view('otherlangs/nano_story.php', $header);
	}
	public function nano_insert(){
		$header['languages'] = $this->User_model->language();
		$this->form_validation->set_rules('story', 'Story', 'trim|required');
		$this->form_validation->set_rules('language', ' Language','trim|required');
		if ($this->form_validation->run() == false) {
    		$this->load->view('otherlangs/nano_story.php',$header);
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
    	    redirect(base_url().$this->uri->segment(1));
		}
	}
	public function life() {
		if($this->session->userdata('logged_in')==NULL) redirect(base_url().$this->uri->segment(1));
		$header['gener'] = $this->User_model->gener();
		$header['languages'] = $this->User_model->language();
		$header['tagslist'] = $this->User_model->lifetagslist();
		$this->load->view('otherlangs/life.php',$header);
	}
    public function lifetagssearch(){
        if(isset($_GET['search']) && !empty($_GET['search'])){
            $response = $this->User_model->lifetagssearch($_GET['search']);
            $data = array(); $i = 0; 
            if($response->num_rows() > 0){ foreach($response->result() as $res){
                $data[$i]['value'] = $res->tagname;
                $data[$i]['text'] = $res->tagname."  -  Tag used in ".$res->tagcount." Life Events";
                $i++;
            }   }
            echo json_encode($data);
        }
    }
	public function life_story_uplode() {
	    $header['gener'] = $this->User_model->gener();
		$header['languages'] = $this->User_model->language();
		$header['tagslist'] = $this->User_model->lifetagslist();
	    $this->form_validation->set_rules('language', 'Language','trim|required');
		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		if(isset($_POST['language']) && ($_POST['language'] != 'en')){
		    $this->form_validation->set_rules('etitle', 'English Title', 'trim|required');
		}
		$this->form_validation->set_rules('keywords', 'Key Words', 'trim');
		$this->form_validation->set_rules('writing_style', 'Writing Style', 'trim|required');
		$this->form_validation->set_rules('pay_story', 'Monitization', 'trim|required');
		if ($this->form_validation->run() == false) {
            $this->load->view('otherlangs/life.php',$header);
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
                    $header['error'] = $this->upload->display_errors();
                    $this->load->view('otherlangs/life.php', $header);
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
                    $newImage = $manipulator->resample(266, 165, FALSE);
                    $image = $newNamePrefix.$_FILES['cover_image']['name'];
                    // saving file to uploads folder
                    $manipulator->save('assets/images/'.$newNamePrefix.$_FILES['cover_image']['name']);
                        
                }else{
                    $header['error'] = $this->upload->display_errors();
                    $this->load->view('otherlangs/life.php', $header);
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
            $lifetags = $this->User_model->lifetags($this->input->post('keywords'), $_POST['language']);
            $lid  = $this->User_model->series_story_uplode($inputdata);
            redirect(base_url().$this->uri->segment(1).'/series_story/'.$lid);
	    }
    }
	
	//<!-- Transaction -->
	public function trans() {
	    $header['gener'] = $this->User_model->gener();
		$header['languages'] = $this->User_model->language();
	    if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){
    	    $user_id = $this->session->userdata['logged_in']['user_id'];
    	    $data['transactions'] = $this->User_model->transactions($user_id);
    	    $data['transstories'] = $this->User_model->transstories($user_id);
    	    $this->load->view('otherlangs/header.php', $header);
    	    $this->load->view('otherlangs/transaction.php',$data);
    	    $this->load->view('otherlangs/footer.php');
	    }else{
	        redirect(base_url().$this->uri->segment(1));
	    }
	}
	
	public function share_feed_communities(){
    	if($this->session->userdata('logged_in')==NULL) redirect(base_url().$this->uri->segment(1));
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
    	$author = '';
    	if(isset($_POST['storywname'], $_POST['storywid']) && !empty($_POST['storywname']) && !empty($_POST['storywid'])){
    	    $author = array('storywname' => $this->input->post('storywname'), 'storywid' => $this->input->post('storywid'));
    	}
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
        	$redirect_uri = $this->uri->segment(1).'/story/'.preg_replace('/\s+/', '-',$title)."-".$sid;
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
        		'created_at' => Date('Y-m-d H;i:s'),
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
		$this->load->view('otherlangs/header.php', $header);
		$this->load->view('otherlangs/communities.php',$data);
        $this->load->view('otherlangs/footer.php');
	}
	public function loadcommunities(){
	    if(isset($_POST['limit']) && !empty($_POST['start'])){
	        $data['get_communities'] = $this->User_model->loadcommunities($_POST['start'], $_POST['limit']);
	        $this->load->view('otherlangs/loadcommunities.php',$data);
	    }
	}
	public function floadcommunities(){
	    if(isset($_POST['limit']) && !empty($_POST['start'])){
	        $data['join_comm'] = $this->User_model->join_communities();
	        $data['unjoinedcommunities'] = $this->User_model->unjoinedcommunities($data['join_comm'],$_POST['start'], $_POST['limit']);
	        $this->load->view('otherlangs/loadcommunities.php',$data);
	    }
	}
	public function jloadcommunities(){
	    if(isset($_POST['limit']) && !empty($_POST['start'])){
	        $data['join_comm'] = $this->User_model->join_communities();
	        $data['joinedcommunities'] = $this->User_model->joinedcommunities($_POST['start'],$_POST['limit']);
	        $this->load->view('otherlangs/loadcommunities.php',$data);
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
 	
	public function co_view($commname) {
        if($this->session->userdata('logged_in')==NULL) redirect(base_url().$this->uri->segment(1));
        if(isset($commname) && !empty($commname)){
            $commuid = $this->User_model->communityname($commname);
            $header['languages'] = $this->User_model->language();
            $header['gener'] = $this->User_model->gener();
            $data['communities_story_get']=$this->User_model->communities_story_get($commuid,0,6);
            //$data['communities_story_get_likes']=$this->User_model->communities_get_topstory($commuid,0,6);
           // $data['communities_story_weekback']=$this->User_model->communities_story_weekback($commuid);
            //$data['communities_comments_get'] = $this->User_model->communities_comments_get();
            $data['comm_comment_count'] = $this->User_model->comm_comment_count($commuid);
            //$data['comm_like_count'] = $this->User_model->comm_like_count();
            $data['commstory_likes'] = $this->User_model->usercommstory_likes();
            $data['get_communities_adout'] = $this->User_model->get_communities_adout($commuid);
            $data['get_communities_all'] = $this->User_model->get_communities();
            $data['join_comm'] = $this->User_model->join_communities();
            $data['comm_joines'] = $this->User_model->comm_joines($commuid);
            $data['following'] = $this->User_model->following();
            $data['commuid'] = $commuid;
            $this->load->view('otherlangs/header.php', $header);
            $this->load->view('otherlangs/co_view.php',$data);    
            $this->load->view('otherlangs/footer.php');
        }
    }
    public function community_about() {
        if(isset($_POST['comm_id']) && !empty($_POST['comm_id'])){
            $data['get_communities_adout'] = $this->User_model->get_communities_adout($_POST['comm_id']);
            $this->load->view('co_viewtab.php',$data);    
        }
    }
    public function community_tpost(){
        if(isset($_POST['comm_id']) && !empty($_POST['comm_id'])){
            $data['communities_story_get_likes'] = $this->User_model->communities_get_topstory($_POST['comm_id'],0,6);
            $data['communities_story_weekback'] = $this->User_model->communities_story_weekback($_POST['comm_id']);
            $data['comm_comment_count'] = $this->User_model->comm_comment_count($_POST['comm_id']);
            $data['commstory_likes'] = $this->User_model->usercommstory_likes();
            $data['commuid'] = $_POST['comm_id'];
            $this->load->view('co_viewtab.php',$data);    
        }
    }
    public function commstoryview($commname, $comm_storyid){
        $commid = $this->User_model->communityname($commname);
        if(isset($commid) && !empty($commid)){
            $header['languages'] = $this->User_model->language();
            $header['gener'] = $this->User_model->gener();
            $data['communities_story_get']=$this->User_model->commstoryview($commid, $comm_storyid);
            $data['comm_comment_count'] = $this->User_model->comm_comment_count($commid,$comm_storyid);
            $data['commstory_likes'] = $this->User_model->usercommstory_likes();
            $data['get_communities_adout'] = $this->User_model->get_communities_adout($commid);
            $data['get_communities_all'] = $this->User_model->get_communities();
            $data['join_comm'] = $this->User_model->join_communities();
            $data['comm_joines'] = $this->User_model->comm_joines($commid);
            $data['following'] = $this->User_model->following();
            $data['commuid'] = $commid;
            $this->load->view('otherlangs/header.php', $header);
            $this->load->view('otherlangs/commstoryview.php',$data);    
            $this->load->view('otherlangs/footer.php');
        }else{
            redirect(base_url().$this->uri->segment(1).'/community/'.$commname);
        }
	}
    public function loadcommustories($commuid){
 	    if(isset($_POST['limit']) && !empty($_POST['start'])){
 	        $data['loadcommustories']=$this->User_model->communities_story_get($commuid,$_POST['start'], $_POST['limit']);
 	        $data['comm_comment_count'] = $this->User_model->comm_comment_count($commuid);
 	        $data['commuid'] = $commuid;
 	        $this->load->view('otherlangs/loadcommustories.php',$data);
 	    }
 	}
 	public function toploadcommustories($commuid){
 	    if(isset($_POST['limit']) && !empty($_POST['start'])){
 	        $data['toploadcommustories']=$this->User_model->communities_get_topstory($commuid,$_POST['start'], $_POST['limit']);
 	        $data['comm_comment_count'] = $this->User_model->comm_comment_count($commuid);
 	        $data['commuid'] = $commuid;
 	        $this->load->view('otherlangs/loadcommustories.php',$data);
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
        	redirect(base_url($this->uri->segment(1).'/community/'.preg_replace('/\s+/','-',$gener)));
        }else{
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function communities_join(){
    	if($this->session->userdata('logged_in')==NULL) redirect(base_url().$this->uri->segment(1));
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
		if($this->session->userdata('logged_in')==NULL) redirect(base_url().$this->uri->segment(1));
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
    				);
    				if(!empty($title) || !empty($description)){
    					$requestdata['insertedposts'] = $this->User_model->communities_story($data);
    					if($requestdata['insertedposts']->num_rows() > 0){
    					    $requestdata['commstory_likes'] = $this->User_model->usercommstory_likes();
    					    $requestdata['comm_comment_count'] = $this->User_model->comm_comment_count($comm_id);
    					    $this->load->view('otherlangs/posturlform', $requestdata);
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
				$data = array(
					'user_id' => $user_id,
					'name' => $name,
					'comm_id' => $comm_id,
					'story' => $story,
					//'date' => DATE('Y-m-d H:i:s'),
					'type' =>'story',
				);
				if($quotes == 'quotes'){
				    $data['typeoftype'] = 'quotes';
				}
				if(!empty($story)){
					$requestdata['insertedposts'] = $this->User_model->communities_story($data);
					if($requestdata['insertedposts']->num_rows() > 0){
					    $requestdata['commstory_likes'] = $this->User_model->usercommstory_likes();
					    $requestdata['comm_comment_count'] = $this->User_model->comm_comment_count($comm_id);
					    $this->load->view('otherlangs/posturlform', $requestdata);
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
	    if($this->session->userdata('logged_in')==NULL) redirect(base_url().$this->uri->segment(1));
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
    	if($this->session->userdata('logged_in')==NULL) redirect(base_url().$this->uri->segment(1));
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
			$this->load->view('otherlangs/editcomm_post',$data);
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
		//$data['yourfeeds'] = $this->User_model->yourfeeds(0,6);
		//$data['storiesfeed'] = $this->User_model->storiesfeed(0,6);
		$data['feed_comments'] = $this->User_model->feed_comments();
    	$data['commstory_likes'] = $this->User_model->usercommstory_likes();
    	$data['join_comm'] = $this->User_model->join_communities();
    	$data['get_communities_all'] = $this->User_model->get_communities('all');
		$this->load->view('otherlangs/header.php', $header);
		$this->load->view('otherlangs/sidebar.php');
		$this->load->view('otherlangs/feed.php',$data);
        $this->load->view('otherlangs/footer.php');
	}
	
	public function tab_yourfeed() {
	    $data['yourfeeds'] = $this->User_model->yourfeeds(0,6);
	    $this->load->view('feedyourfeed.php',$data);
	}
	public function tab_stories() {
	    $data['storiesfeed'] = $this->User_model->storiesfeed(0,6);
	    $this->load->view('feedstories.php',$data);
	}
	
	public function loadmorefeed(){
	    if(isset($_POST['limit']) && !empty($_POST['start'])){
	        $data['feedtab'] = $this->User_model->feed($_POST['start'], $_POST['limit']);
	        $this->load->view('otherlangs/loadmorefeed.php',$data);
	    }
	}
	public function loadmoreyourfeed(){
	    if(isset($_POST['limit']) && !empty($_POST['start'])){
	        $data['yourfeedtab'] = $this->User_model->yourfeeds($_POST['start'], $_POST['limit']);
	        $this->load->view('otherlangs/loadmorefeed.php',$data);
	    }
	}
	public function loadmorestoryfeed(){
	    if(isset($_POST['limit']) && !empty($_POST['start'])){
	        $data['storiesfeed'] = $this->User_model->storiesfeed($_POST['start'], $_POST['limit']);
	        $this->load->view('otherlangs/loadmorefeed.php',$data);
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
            $this->load->view('otherlangs/storyloadcomments.php',$data);
        }
	}
	public function fsloadcomments(){
	    if(isset($_POST['storyid']) && !empty($_POST['storyid']) && isset($_POST['commentid']) && !empty($_POST['commentid'])){
    	    $data['fsloadcomments'] = $this->User_model->fsloadcomments($_POST['storyid'], $_POST['commentid']);
    	    $data['fslastcomment'] = $this->User_model->fslastcomment($_POST['storyid']);
    	    $this->load->view('otherlangs/fsloadcomments.php',$data);
	    }
	}
	public function fsloadsubcomment(){
	    if(isset($_POST['storyid']) && !empty($_POST['storyid']) && isset($_POST['comment_id']) && 
	    !empty($_POST['comment_id']) && isset($_POST['subcommentid']) && !empty($_POST['subcommentid']) ){
    	    $data['fsloadsubcomments'] = $this->User_model->fsloadsubcomments($_POST['storyid'], $_POST['comment_id'],$_POST['subcommentid']);
    	    $data['fslastsubcomment'] = $this->User_model->fslastsubcomment($_POST['storyid'], $_POST['comment_id']);
    	    $this->load->view('otherlangs/fsloadcomments.php',$data);
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
            
            $data['reviews21'] = $this->User_model->reviews2();
            $data['allusers'] = $this->User_model->allusers();
            $data['favorites'] = $this->User_model->favorites();
            $data['favoriteslife'] = $this->User_model->favorites('life');
            $data['subscribes'] = $this->User_model->subscribes();
            $this->load->view('otherlangs/header', $header);
            $this->load->view('otherlangs/sidebar.php');
    		$this->load->view('otherlangs/library',$data);
    		$this->load->view('otherlangs/footer');
		}else{
		    redirect(base_url().$this->uri->segment(1));
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
            $this->load->view('otherlangs/librarysubscribe',$data);
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
    		$this->load->view('otherlangs/libraryfavorite',$data);
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
	public function nano_view($nanoid) {
	    $header['gener'] = $this->User_model->gener();
	    $header['languages'] = $this->User_model->language();
	    $data['nano_view'] = $this->User_model->get_story_data($nanoid);
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
		    $header['ogurl'] = base_url().'nano/'.$nanoid;
		    $header['ogsesslang'] = $this->User_model->langshortname($this->uri->segment(1));
		    if(isset($metatags[0]->image) && !empty($metatags[0]->image)){
		        $header['ogimage'] = $metatags[0]->image;
		    }else{
		        $header['ogimage'] = 'series-stories.jpg';
		    }
		} // For Meta tags social share end
	
	    $this->load->view('otherlangs/header.php',$header);
	    $this->load->view('otherlangs/sidebar.php');
	    $this->load->view('otherlangs/nano_view.php',$data);
	    $this->load->view('otherlangs/footer.php');
	}
	public function only_story_view($storynameid) {
	    $storyname_id = explode('-', $storynameid);
	    $storyid  = end($storyname_id);
	    $header['gener'] = $this->User_model->gener();
	    $header['languages'] = $this->User_model->language();
	    $uniqueviews = $this->User_model->uniqueviews($storyid);
		$data['admin_story_view'] = $this->User_model->admin_story_view1($storyid);
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
		    $header['ogurl'] = base_url().'story/'.$storynameid;
		    $header['ogsesslang'] = $this->User_model->langshortname($this->uri->segment(1));
		    if(isset($metatags[0]->image) && !empty($metatags[0]->image)){
		        $header['ogimage'] = $metatags[0]->image;
		    }else{
		        $header['ogimage'] = 'series-stories.jpg';
		    }
		} // For Meta tags social share end
		$res = $this->User_model->viewsupdate($storyid);
		$data['comment_like'] = $this->User_model->comment_like($storyid);
		if(isset($metatags[0]->type) && ($metatags[0]->type == 'life')){
		    $data['recentstorieslife'] = $this->User_model->recentlife($storyid);
		}else{
		    $data['recentstories'] = $this->User_model->recentstories($storyid);
		}
		$data['reviews'] = $this->User_model->reviews($storyid);
		$data['userrating'] = $this->User_model->userrating($storyid);
		$data['comment_get'] = $this->User_model->comment_get($storyid);
		$data['reviews21'] = $this->User_model->reviews2();
		$data['favorites'] = $this->User_model->favoritreadlater('favorite', $storyid);
		$data['following'] = $this->User_model->following();
		$this->load->view('otherlangs/header.php',$header);
		$this->load->view('otherlangs/only_story_view.php',$data);
        $this->load->view('otherlangs/footer.php');
	}
	public function admin_story($storynameid){
	    $header['gener'] = $this->User_model->gener();
		$header['languages'] = $this->User_model->language();
	    $storyname_id = explode('-', $storynameid);
	    $storyid  = end($storyname_id);
	    $data['admin_story_view'] = $this->User_model->admin_story_view($storyid);
	    //$uniqueviews = $this->User_model->uniqueviews($storyid);
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
		    $header['ogurl'] = base_url().'story/'.$storynameid;
		    $header['ogsesslang'] = $this->User_model->langshortname($this->uri->segment(1));
		    if(isset($metatags[0]->image) && !empty($metatags[0]->image)){
		        $header['ogimage'] = $metatags[0]->image;
		    }else{
		        $header['ogimage'] = 'series-stories.jpg';
		    }
		} // For Meta tags social share end
		//$res = $this->User_model->viewsupdate($storyid);
		$data['comment_like'] = $this->User_model->comment_like($storyid);
		$data['reviews'] = $this->User_model->reviews($storyid);
		$data['comment_get'] = $this->User_model->comment_get($storyid);
		$data['reviews21'] = $this->User_model->reviews2();
		if(isset($metatags[0]->type) && ($metatags[0]->type == 'life')){
		    $data['recentstorieslife'] = $this->User_model->recentlife($storyid);
		}else{
		    $data['recentstories'] = $this->User_model->recentstories($storyid);
		}
	    $this->load->view('otherlangs/header.php', $header);
        $this->load->view('otherlangs/admin_story.php',$data);
        $this->load->view('otherlangs/footer.php');
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
        $this->load->view('otherlangs/header.php',$header);
        $this->load->view('otherlangs/sidebar.php');
	    $this->load->view('otherlangs/seriesall.php',$data);
	    $this->load->view('otherlangs/footer.php');
    }
    public function seriesallloadmore($type){
	    if(isset($_POST["limit"], $_POST["start"])){
            $data['viewallloadmore'] = $this->User_model->seriesallloadmore($type, $_POST["start"], $_POST["limit"]);
            $data['type'] = $type;
            $this->load->view('otherlangs/seriesallloadmore.php',$data, false);
        }
	}
    
    public function lifeall() {
        $header['gener'] = $this->User_model->gener();
		$header['languages'] = $this->User_model->language();
        //$data['get_life'] = $this->User_model->get_life('','all');
        $data['get_life'] = $this->User_model->viewallhome('life',0, 7);
		$data['top_get_life'] = $this->User_model->top_get_life();
		$data['lifetagslist'] = $this->User_model->lifetagslist(15);
        $this->load->view('otherlangs/header.php',$header);
        $this->load->view('otherlangs/sidebar.php');
	    $this->load->view('otherlangs/lifeall.php',$data);
	    $this->load->view('otherlangs/footer.php');
    }
    
    public function viewallyournetwork(){
        $header['gener'] = $this->User_model->gener();
		$header['languages'] = $this->User_model->language();
        if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){
            $data['viewallyournetwork'] = $this->User_model->yournetworks($this->session->userdata['logged_in']['user_id'],0, 7);
            $this->load->view('otherlangs/header.php',$header);
            $this->load->view('otherlangs/sidebar.php');
    	    $this->load->view('otherlangs/viewallyournetwork.php',$data);
    	    $this->load->view('otherlangs/footer.php');
        }
    }
    public function viewallloadyournetwork(){
        if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id']) 
         && isset($_POST["limit"]) && isset($_POST["start"])){
            $data['viewallyournetwork'] = $this->User_model->yournetworks($this->session->userdata['logged_in']['user_id'], $_POST['start'], $_POST['limit']);
            $this->load->view('otherlangs/viewallloadyournetwork.php',$data, false);
        }
    }
    
    public function viewallhome($type){
        if(($this->uri->segment(2) == 'series') && ($this->uri->segment(3) == 'latest')) {
            $type = 'series';
        }else if(($this->uri->segment(2) == 'stories') && ($this->uri->segment(3) == 'latest')) {
            $type = 'story';
        }else if(($this->uri->segment(2) == 'lifeevents') && ($this->uri->segment(3) == 'latest')) {
            $type = 'life';
        }else if(($this->uri->segment(2) == 'shortstories')) {
            $type = 'nano';
        }
        $header['gener'] = $this->User_model->gener();
		$header['languages'] = $this->User_model->language();
        $data['viewallhome'] = $this->User_model->viewallhome($type,0, 7);
        $data['lifetagslist'] = $this->User_model->lifetagslist(15);
        $this->load->view('otherlangs/header.php',$header);
        $this->load->view('otherlangs/sidebar.php');
	    $this->load->view('otherlangs/viewallhome.php',$data);
	    $this->load->view('otherlangs/footer.php');
    }
    public function viewallloadmore($type){
        if(isset($_POST["limit"], $_POST["start"])){
            $data['viewallloadmore'] = $this->User_model->viewallhome($type, $_POST['start'], $_POST['limit']);
            $data['type'] = $type;
            $this->load->view('otherlangs/viewallloadmore.php',$data, false);
        }
	}
	public function topviewallhome($type){
        if(($this->uri->segment(2) == 'series') && ($this->uri->segment(3) == 'top')) {
            $type = 'series';
        }else if(($this->uri->segment(2) == 'stories') && ($this->uri->segment(3) == 'top')) {
            $type = 'story';
        }else if(($this->uri->segment(2) == 'lifeevents') && ($this->uri->segment(3) == 'top')) {
            $type = 'life';
        }else if(($this->uri->segment(2) == 'shortstories')){
            $type = 'nano';
        }
	    $header['gener'] = $this->User_model->gener();
		$header['languages'] = $this->User_model->language();
        $data['topviewallhome'] = $this->User_model->topviewallhome($type,0,7);
        $data['lifetagslist'] = $this->User_model->lifetagslist(15);
        $this->load->view('otherlangs/header.php',$header);
        $this->load->view('otherlangs/sidebar.php');
	    $this->load->view('otherlangs/topviewallhome.php',$data);
	    $this->load->view('otherlangs/footer.php');
    }
    public function topviewallloadmore($type){
        if(isset($_POST["limit"], $_POST["start"])){
            $data['pagenum'] = 0;
            $data['topviewallloadmore'] = $this->User_model->topviewallhome($type, $_POST['start'],$_POST['limit']);
            $this->load->view('otherlangs/topviewallloadmore.php',$data, false);
        }
	}
    
    public function geners($genername = false) {
        $generid = 0;
        if(isset($genername) && !empty($genername)){
            $generid = $this->User_model->genername($genername);
        }
        $header['gener'] = $this->User_model->gener();
        $header['languages'] = $this->User_model->language();
        if(isset($generid) && !empty($generid) && (isset($_POST["limit"], $_POST["start"])) ){
            $data['loadgenerstories'] = $this->User_model->generstories($generid, $_POST["start"], $_POST["limit"]);
            $this->load->view('otherlangs/generstories.php',$data);
        }else if(isset($generid) && !empty($generid)){
            $data['genertopstories'] = $this->User_model->genertopstories($generid, 0,7);
    		$data['generstories'] = $this->User_model->generstories($generid,0,4);
            $this->load->view('otherlangs/header.php', $header);
            $this->load->view('otherlangs/sidebar.php');
    	    $this->load->view('otherlangs/geners.php',$data);    
    	    $this->load->view('otherlangs/footer.php');
        }else if(isset($_POST['generid']) && !empty($_POST['generid'])){
            $data['generseries'] = $this->User_model->viewallhome('series', 0, 4, $_POST['generid']);
            $this->load->view('otherlangs/generseries.php',$data);
        }
    }
    
    public function genertopstories($genername) {
        if(isset($genername) && !empty($genername)){
            $generid = $this->User_model->genername($genername);
            if(isset($_POST["limit"], $_POST["start"], $generid)){
                $data['loadgenerstories'] = $this->User_model->genertopstories($generid, $_POST["start"], $_POST["limit"], $generid);
                $this->load->view('otherlangs/generstories.php',$data, false);
            }else if($generid){
                $header['gener'] = $this->User_model->gener();
                $header['languages'] = $this->User_model->language();
                $data['genertopstories'] = $this->User_model->genertopstories($generid, 0, 7);
                $this->load->view('otherlangs/header.php', $header);
                $this->load->view('otherlangs/sidebar.php');
        	    $this->load->view('otherlangs/genertopstories.php',$data);    
        	    $this->load->view('otherlangs/footer.php');
            }
        }
    }
    
    public function generviewallloadmore($generid){
        if(isset($_POST["limit"], $_POST["start"])){
            $data['viewallloadmore'] = $this->User_model->viewallhome('series', $_POST["start"], $_POST["limit"], $generid);
            $this->load->view('otherlangs/generseriesfilters.php',$data, false);
        }
	}
	
	public function fersloadmore(){
	    if(isset($_POST["limit"], $_POST["start"], $_POST["user_id"]) && !empty($_POST["user_id"])){
	        $userid = $_POST["user_id"];
            $data['loadmoreresults'] = $this->User_model->followers_names($userid, $_POST["start"],$_POST["limit"]);
            $data['following'] = $this->User_model->following();
            $this->load->view('otherlangs/followloadmore.php',$data, false);
        }
	}
	public function fingloadmore(){
	    if(isset($_POST["limit"], $_POST["start"], $_POST["user_id"]) && !empty($_POST["user_id"])){
	        $userid = $_POST["user_id"];
            $data['loadmoreresultdatas'] = $this->User_model->following_names($userid, $_POST["start"],$_POST["limit"]);
            $data['following'] = $this->User_model->following();
            $this->load->view('otherlangs/followloadmore.php',$data, false);
        }
	}
    public function profile($profilename){
        if(isset($profilename) && !empty($profilename)){
            $userid = $this->User_model->userid($profilename);
            $header['gener'] = $this->User_model->gener();
            $header['languages'] = $this->User_model->language();
            if(isset($this->session->userdata['logged_in']['user_id']) && ($this->session->userdata['logged_in']['user_id'] == $userid)){
                $data['client'] = $this->User_model->writer_profile($userid);
                //$data['clientprofile'] = $this->User_model->client_profile($userid);
        		$data['writerseries'] = $this->User_model->writerseries($userid);
        		$data['writerstories'] = $this->User_model->writerstories($userid);
        		$data['writernanos'] = $this->User_model->writernanos($userid);
        		$data['writerlifes'] = $this->User_model->writerlifes($userid);
        		$data['reviews21'] = $this->User_model->reviews2();
        		$data['follow_count'] = $this->User_model->follow_count();
        		$data['nano_like_count'] = $this->User_model->nano_like_count();
        		$data['followers_names'] = $this->User_model->followers_names($userid, 0,5);
                //$data['following_names'] = $this->User_model->following_names($userid, 0,5);
                $data['following'] = $this->User_model->following();
                $data['userid'] = $userid;
        		$this->load->view('otherlangs/header.php', $header);
        		$this->load->view('otherlangs/myprofile.php',$data);
                $this->load->view('otherlangs/footer.php');
    	    }else if(!empty($userid)){
    	        $data['writer_profile'] = $this->User_model->writer_profile($userid);
    	        //$data['clientprofile'] = $this->User_model->client_profile($userid);
        		$data['writerseries'] = $this->User_model->writerseries($userid);
        		$data['writerstories'] = $this->User_model->writerstories($userid);
        		$data['writerlifes'] = $this->User_model->writerlifes($userid);
        		$data['writernanos'] = $this->User_model->writernanos($userid);
                $data['follow_count'] = $this->User_model->follow_count();
                $data['pro_comment'] = $this->User_model->pro_comment($userid);
                $data['followers_names'] = $this->User_model->followers_names($userid, 0,5);
               //$data['following_names'] = $this->User_model->following_names($userid, 0,5);
        		$data['following'] = $this->User_model->following();
        		$data['userid'] = $userid;
        		$this->load->view('otherlangs/header.php', $header);
        		$this->load->view('otherlangs/profile.php',$data);
                $this->load->view('otherlangs/footer.php');
    	    }else{
    	        $this->load->view('error.php');
    	    }
        }
    }
    public function profilefollowing(){		
        if(isset($_POST['userid']) && !empty($_POST['userid'])){		
            $data['following_names'] = $this->User_model->following_names($_POST['userid'], 0,5);		
            $data['following'] = $this->User_model->following();		
            $this->load->view('otherlangs/following_names.php',$data);		
        }		
    }
    public function profilereading(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            $userid = $_POST['id'];
            if(isset($this->session->userdata['logged_in']['user_id']) && ($this->session->userdata['logged_in']['user_id'] == $userid)){
                $data['rlseries'] = $this->User_model->libraryseries($userid, 'seriessubscribe'); //readlater
                $data['rlstories'] = $this->User_model->librarystories($userid, 'favorite'); //readlater
                $data['rllife'] = $this->User_model->librarylife($userid, 'favorite'); //readlater
                $data['reviews21'] = $this->User_model->reviews2();
                $data['userid'] = $userid;
        		$this->load->view('otherlangs/myprofilereading.php',$data);
    	    }else if(!empty($userid)){
        		$data['rlseries'] = $this->User_model->libraryseries($userid, 'seriessubscribe'); //readlater
                $data['rlstories'] = $this->User_model->librarystories($userid, 'favorite'); //readlater
                $data['rllife'] = $this->User_model->librarylife($userid, 'favorite'); //readlater
                $data['reviews21'] = $this->User_model->reviews2();
                $data['userid'] = $userid;
        		$this->load->view('otherlangs/profilereading.php',$data);
    	    }
        }
    }
    public function profilereadall(){
        if(isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['type']) && ($_POST['type'] == 'series')){
            $data['rlseries'] = $this->User_model->libraryseries($_POST['id'], 'seriessubscribe');
            $data['reviews21'] = $this->User_model->reviews2();
            $data['userid'] = $_POST['id'];
            $this->load->view('otherlangs/profilereadall.php',$data);
        }else if(isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['type']) && ($_POST['type'] == 'story')){
            $data['rlstories'] = $this->User_model->librarystories($_POST['id'], 'favorite'); //readlater
            $data['reviews21'] = $this->User_model->reviews2();
            $data['userid'] = $_POST['id'];
            $this->load->view('otherlangs/profilereadall.php',$data);
        }else if(isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['type']) && ($_POST['type'] == 'life')){
            $data['rllife'] = $this->User_model->librarylife($_POST['id'], 'favorite'); //readlater
            $data['reviews21'] = $this->User_model->reviews2();
            $data['userid'] = $_POST['id'];
            $this->load->view('otherlangs/profilereadall.php',$data);
        }
    }
    public function profileviewall() {
        $type_pid = explode('-',$this->uri->segment(3));
        $profilename = $type_pid[0];
        $type = end($type_pid);
        $pid = $this->User_model->userid($profilename);
        $header['gener'] = $this->User_model->gener();
        $header['languages'] = $this->User_model->language();
        if(isset($type, $pid) && !empty($pid) && in_array($type, array('series','story', 'life', 'nano'))){
            $data['writer_profile'] = $this->User_model->writer_profile($pid);
    		$data['profileviewall'] = $this->User_model->profileviewall($pid, $type,0,7);
            $data['follow_count'] = $this->User_model->follow_count();
            $data['pro_comment'] = $this->User_model->pro_comment($pid);
            $data['followers_names'] = $this->User_model->followers_names($pid, 0,5);
            $data['following_names'] = $this->User_model->following_names($pid, 0,5);
    		$data['following'] = $this->User_model->following();
    		$data['type'] = $type;
    		$data['userid'] = $pid;
    		$this->load->view('otherlangs/header.php', $header);
    		$this->load->view('otherlangs/profileviewall.php',$data);
            $this->load->view('otherlangs/footer.php');
        }else if(isset($pid) && !empty($pid)){
            redirect(base_url().$this->uri->segment(1).'/'.$profilename);
        }else{
            redirect(base_url().$this->uri->segment(1));
        }
    }
    public function profilealloadmore(){
        if(isset($_POST['profile']) && !empty($_POST['profile'])){
            $type_pid = explode('-',$_POST['profile']);
            $profilename = $type_pid[0];
            $type = end($type_pid);
            $pid = $this->User_model->userid($profilename);
    	    if(isset($_POST['limit'], $_POST['start'], $pid, $type)){
    	        $data['type'] = $type;
    	        $data['userid'] = $pid;
                $data['profilealloadmore'] = $this->User_model->profileviewall($pid, $type, $_POST['start'], $_POST['limit']);
                $this->load->view('otherlangs/profilealloadmore.php',$data, false);
    	    }
        }
	}
    public function my_profile($id) {
        $profilename = $this->User_model->hprofilename($id);
        if(isset($this->session->userdata['logged_in']['user_id']) && ($this->session->userdata['logged_in']['user_id'] == $id)){
    		$header['languages'] = $this->User_model->language();
    		$header['geners'] = $this->User_model->gener();
    		if(isset($id) && !empty($id)){
    			$data['editprofile'] = $this->User_model->editprofile($id);
    			$usercomms = $this->User_model->usercommunities_gener();
    			$data['usercomms'] = array();
    			foreach($usercomms->result() as $usercomm){
    			    //array_push($data['usercomms'], $usercomm->id);
    			    array_push($data['usercomms'], $usercomm->gener);
    			}
    			$this->load->view('otherlangs/header.php', $header);
        		$this->load->view('otherlangs/editmy_profile.php',$data);
                $this->load->view('otherlangs/footer.php');
    		}
        }else if(isset($id) && !empty($id)){
            redirect(base_url().$this->uri->segment(1)."/".$profilename);
        }else{
            redirect(base_url().$this->uri->segment(1));
        }
    }
    
    public function updateprofile($id) {
        $profilename = $this->User_model->hprofilename($id);
		$header['languages'] = $this->User_model->language();
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
		$this->form_validation->set_rules('phone', 'Phone', 'trim|numeric');
		$this->form_validation->set_rules('uemailstatus', 'Email Status', 'trim|required');
		$this->form_validation->set_rules('uphonestatus', 'Phone Status', 'trim|required');
		$dbemail = $this->User_model->dbemail();
		$user_activation  = 0;
		if(isset($dbemail) && !empty($dbemail) && ($_POST['email'] != $dbemail)){
		    $user_activation = 2;
		    $this->User_model->sendEmail($_POST['email']);
		}
		if ($this->form_validation->run() == FALSE) {
    		$this->load->view('otherlangs/header.php', $header); 
    		$this->load->view('otherlangs/editmy_profile.php',$data);
            $this->load->view('otherlangs/footer.php');
        } else {			
			$picture1 =''; $picture2 =''; $image = '';
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
                    $config['maintain_ratio'] = FALSE;
                    $config['quality'] = '85%';
                    $config['width'] = 1500;
                    $config['height'] = 250;
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                    $picture1 = $buploadData['file_name'];
                }
                $date = strtotime(date('Y-m-d h:i:s'));
                $newNamePrefix = $date.'_';
                $manipulator = new ImageManipulator($_FILES['banner_image']['tmp_name']);
                $newImage = $manipulator->resample(265, 115, FALSE);
                $image = $newNamePrefix.$_FILES['banner_image']['name'];
                $manipulator->save('assets/images/'.$newNamePrefix.$_FILES['banner_image']['name']); // saving file to uploads folder
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
                    $config['maintain_ratio'] = FALSE;
                    $config['quality'] = '85%';
                    $config['width'] = 120;
                    $config['height'] = 120;
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
			} if(!empty($picture1)){
				$inputdata['banner_image'] = $picture1;
			} if(!empty($picture2)){
				$inputdata['profile_image'] = $picture2;
			} if(!empty($image)){
			    $inputdata['pbanner_image'] = $image;
			}
			$userid = $this->session->userdata['logged_in']['user_id'];
			$res = $this->User_model->updateprofile($inputdata,$userid);
			if($res){
			    $this->session->set_flashdata('editmsg', '<span class="text-success">Profile Updated Successfully</span>');
			}
			redirect(base_url($this->uri->segment(1).'/'.$profilename));
		}
	}
	public function removeprofilepic($profileid) {		
	    $profilename = $this->User_model->hprofilename($profileid);		
	    if(isset($this->session->userdata['logged_in']['user_id']) && ($this->session->userdata['logged_in']['user_id'] == $profileid)){		
	        $userid = $this->session->userdata['logged_in']['user_id'];		
	        $inputdata = array('profile_image' => '');		
	        $res = $this->User_model->updateprofile($inputdata,$userid);		
			if($res){		
			    $_SESSION['logged_in']['profile_image'] = '';		
			    $this->session->set_flashdata('editmsg', '<span class="text-success">Profile Image Deleted Successfully</span>');		
			}		
			redirect(base_url().$this->uri->segment(1).'/'.$profilename);		
	    }		
	}		
	public function removeprofilecover($profileid) {		
	    if(isset($this->session->userdata['logged_in']['user_id']) && ($this->session->userdata['logged_in']['user_id'] == $profileid)){		
	        $userid = $this->session->userdata['logged_in']['user_id'];		
	        $inputdata = array('banner_image' => '', 'pbanner_image' => '');		
	        $res = $this->User_model->updateprofile($inputdata,$userid);		
			if($res){		
			    $this->session->set_flashdata('editmsg', '<span class="text-success">Profile Banner Image Deleted Successfully</span>');		
			}		
			redirect(base_url().$this->uri->segment(1).'/'.$profilename);
	    }		
	}
    public function profilecomments($profileid){
	    if(isset($_POST['limitStart']) && !empty($_POST['limitStart'])){
	        $data['pro_comments'] = $this->User_model->profilecomments($profileid,$_POST['limitStart']);
	    }else{
	        $data['pro_comments'] = $this->User_model->profilecomments($profileid);
	    }
	    $this->load->view('otherlangs/profilecomments.php',$data);
	}
	public function pro_comment(){
    	if($this->session->userdata('logged_in')==NULL) redirect(base_url().$this->uri->segment(1));
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
	    $this->load->view('otherlangs/profilereplycomments.php',$data);
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
    		$this->load->view('otherlangs/header.php',$header);
    		$this->load->view('otherlangs/drafts.php', $data);
            $this->load->view('otherlangs/footer.php');
	    }else{
	        redirect(base_url().$this->uri->segment(1));
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
                $config['image_library'] = 'gd2';
                $config['source_image'] = 'assets/images/'.$uploadpimg['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = FALSE;
                $config['quality'] = '100%';
                $config['width'] = 450;
                $config['height'] = 340;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $data['image'] = $uploadpimg['file_name'];
                
                $this->load->view('otherlangs/profileimg', $data);
            } else {
               $this->load->view('otherlangs/profileimg');
            }
        }else{
            $this->load->view('otherlangs/profileimg');
        }
    }
    
    public function image_crop(){
        if(isset($_POST['img']) && !empty($_POST['img'])){
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
        }else if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id']) && isset($_POST['fullimg'])){
            $link_arrayfullimg = explode('/',$_POST['fullimg']);
            $imagenamefullimg = end($link_arrayfullimg);
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'assets/images/'.$imagenamefullimg;
            $config['new_image'] = 'assets/images/'.$imagenamefullimg;
            $config['maintain_ratio'] = FALSE;
            $config['width']         = 120;
            $config['height']       = 120;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            $response = $this->User_model->updateprofileimg($this->session->userdata['logged_in']['user_id'], $imagenamefullimg);
            $_SESSION['logged_in']['profile_image'] = $imagenamefullimg;
            echo base_url().'assets/images/'.$imagenamefullimg;
        }
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
                    $newImage = $manipulator->resample(200, 180,FALSE);
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
        if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){
    	    $header['gener'] = $this->User_model->gener();
    		$header['languages'] = $this->User_model->language();
    	    $data['notifications'] = $this->User_model->notificationslist(0,15);
    		$this->load->view('otherlangs/header.php',$header);
    		$this->load->view('otherlangs/notifications.php',$data);
            $this->load->view('otherlangs/footer.php');
        }else{
            redirect(base_url().$this->uri->segment(1));
        }
	}
	public function communitynotis(){
	    if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){
	        $data['notifications'] = $this->User_model->communitynotis(0,15);
	        $this->load->view('otherlangs/notificationscommu.php',$data);
	    }
	}
	public function suggestnotis(){
	    if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){
	        $data['notifications'] = $this->User_model->suggestnotis(0,15);
	        $this->load->view('otherlangs/notificationssugg.php',$data);
	    }
	}
	public function loadnotifications(){
	    if(isset($_POST['limit']) && !empty($_POST['limit']) && isset($_POST['start']) && !empty($_POST['limit'])){
    	    $data['notifications'] = $this->User_model->notificationslist($_POST['start'],$_POST['limit']);
    	    $this->load->view('otherlangs/loadnotifications.php',$data);
	    }
	}
	public function tab2loadnotifications(){
	    if(isset($_POST['limit']) && !empty($_POST['limit']) && isset($_POST['start']) && !empty($_POST['limit'])){
    	    //$data['tab2'] = $this->User_model->notificationslist($_POST['start'],$_POST['limit']);
    	    $data['tab2'] = $this->User_model->communitynotis($_POST['start'],$_POST['limit']);
    	    $this->load->view('otherlangs/loadnotifications.php',$data);
	    }
	}
	
	public function tab3loadnotifications(){
	    if(isset($_POST['limit']) && !empty($_POST['limit']) && isset($_POST['start']) && !empty($_POST['limit'])){
    	    //$data['tab3'] = $this->User_model->notificationslist($_POST['start'],$_POST['limit']);
    	    $data['tab3'] = $this->User_model->suggestnotis($_POST['start'],$_POST['limit']);
    	    $this->load->view('otherlangs/loadnotifications.php',$data);
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
        	    $this->load->view('otherlangs/comment_page',$data);
        	}else{
        	    $this->load->view('otherlangs/comment_page');
        	}
        }else{
            $this->load->view('otherlangs/comment_page');
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
	    if(isset($_POST['comment']) && !empty($_POST['comment']) && isset($_POST['story_id']) && !empty($_POST['story_id']) && isset($this->session->userdata['logged_in']['user_id'])){
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
	    $header['gener'] = $this->User_model->gener();
		$header['languages'] = $this->User_model->language();
        if(isset($_GET['searchtext']) && !empty($_GET['searchtext'])){
            $header['searchtext'] = $_GET['searchtext'];
    		$data['get_writer'] = $this->User_model->searchresultwriter('people', $header['searchtext'], 0,5);
    		$data['get_series'] = $this->User_model->search_series($header['searchtext'],0,7);
    		$data['get_storys'] = $this->User_model->search_storys($header['searchtext'],0,7);
    		$data['get_life'] = $this->User_model->search_life($header['searchtext'],0,3);
    		$data['reviews21'] = $this->User_model->reviews2();
    		$data['following'] = $this->User_model->following();
    		$data['follow_count'] = $this->User_model->follow_count();
    		$data['series_count'] = $this->User_model->series_count();
    		$this->load->view('otherlangs/header.php',$header);
    		$this->load->view('otherlangs/searchdata.php', $data);
            $this->load->view('otherlangs/footer.php');
        }else{
            $header['searchtext'] = '';
            $this->load->view('otherlangs/header.php',$header);
    		$this->load->view('otherlangs/searchdata.php');
            $this->load->view('otherlangs/footer.php');
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
    		$this->load->view('otherlangs/header.php', $header);
            $this->load->view('otherlangs/searchresult.php',$data);
            $this->load->view('otherlangs/footer.php');
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
            $this->load->view('otherlangs/searchresultloadmore.php',$data, false);
        }
    }
    public function searchresultwriter(){
        $header['languages'] = $this->User_model->language();
        $header['gener'] = $this->User_model->gener();
        if(isset($_GET['type']) && !empty($_GET['type']) && isset($_GET['searchtext']) && !empty($_GET['searchtext'])){
            $header['searchtext'] = $_GET['searchtext'];
            $data['searchresults'] = $this->User_model->searchresultwriter($_GET['type'], $_GET['searchtext'],0,4);
    		$data['reviews2'] = $this->User_model->reviews2();
    		
    		$data['filter12'] = $this->User_model->get_seriesall();
            $data['following'] = $this->User_model->following();
            $data['follow_count'] = $this->User_model->follow_count();
    		$this->load->view('otherlangs/header.php', $header);
            $this->load->view('otherlangs/searchresult.php',$data);
            $this->load->view('otherlangs/footer.php');
        }else{
            $header['searchtext'] = '';
            $this->load->view('otherlangs/header.php', $header);
            $this->load->view('otherlangs/searchresult.php');
            $this->load->view('otherlangs/footer.php');
        }
    }
    public function searchwriterloadmore(){
        if((isset($_POST["limit"], $_POST["start"])) && isset($_GET['type']) && !empty($_GET['type']) && isset($_GET['searchtext']) && !empty($_GET['searchtext'])){
            $data['loadsearchresults'] = $this->User_model->searchresultwriter($_GET['type'], $_GET['searchtext'], $_POST["start"], $_POST["limit"]);
            $data['following'] = $this->User_model->following();
            $this->load->view('otherlangs/searchresultloadmore.php',$data, false);
        }
    }
	public function commloadcomments($topstory = false){
	    if(isset($_POST['storyid']) && !empty($_POST['storyid']) && isset($_POST['commentid']) && !empty($_POST['commentid'])){
    	    $data['commloadcomments'] = $this->User_model->commloadcomments($_POST['storyid'], $_POST['commentid']);
    	    $data['commlastcomment'] = $this->User_model->commlastcomment($_POST['storyid']);
    	    if(isset($topstory) && !empty($topstory)){
    	        $data['topstory'] = 'topstory';
    	    }
    	    $this->load->view('otherlangs/commloadcomments.php',$data);
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
    	    $this->load->view('otherlangs/commloadcomments.php',$data);
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
	            $this->load->view('otherlangs/editcommcomment.php',$data);
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
	    if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){
    	    $userid = $this->session->userdata['logged_in']['user_id'];
    	    $followwritecount = $this->User_model->followwritecount($userid);
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
	    if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){
    	    $userid = $this->session->userdata['logged_in']['user_id'];
    	    if(isset($_POST['paymenttype']) && !empty($_POST['paymenttype'])){
    	        $data['accountdetails'] = $this->User_model->paymenttype($userid);
    	        $data['paymenttype'] = $_POST['paymenttype'];
    	        $this->load->view('otherlangs/paymenttype', $data);
    	    }else{
    	        echo 0;
    	    }
	    }
	}
	public function paymentdetailscheck(){
	    if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){
	        $userid = $this->session->userdata['logged_in']['user_id'];
    	    if(isset($_POST['paymenttype']) && ($_POST['paymenttype'] == 'paytm')){
    	        $response = $this->User_model->paymenttype($userid);
    	        if($response->num_rows() == 1){
    	            $result = $response->result();
    	            if(isset($result[0]->paytmphone) && !empty($result[0]->paytmphone) && strlen($result[0]->paytmphone) > 8){
    	                $data['status'] = 1;
        				$data['response'] = 'success';
        				echo json_encode($data);
    	            }else{
    	                $data['status'] = 2;
        				$data['response'] = 'fail';
        				echo json_encode($data);
    	            }
    	        }
    	    }else if(isset($_POST['paymenttype']) && ($_POST['paymenttype'] == 'bankaccount')){
    	        $response = $this->User_model->paymenttype($userid);
    	        if($response->num_rows() == 1){
    	            $result = $response->result();
    	            if(isset($result[0]->accountno, $result[0]->ifsccode, $result[0]->bankname, $result[0]->branchname, 
    	                $result[0]->accounteename) && !empty($result[0]->accountno) && !empty($result[0]->ifsccode) && 
    	                !empty($result[0]->bankname) && !empty($result[0]->branchname )&& !empty($result[0]->accounteename)){
    	                $data['status'] = 1;
        				$data['response'] = 'success';
        				echo json_encode($data);
    	            }else{
    	                $data['status'] = 2;
        				$data['response'] = 'fail';
        				echo json_encode($data);
    	            }
    	        }
    	    }else if(isset($_POST['paymenttype']) && ($_POST['paymenttype'] == 'googlepay')){
    	        $response = $this->User_model->paymenttype($userid);
    	        if($response->num_rows() == 1){
    	            $result = $response->result();
    	            if(isset($result[0]->googlepayphone) && !empty($result[0]->googlepayphone) && strlen($result[0]->googlepayphone) > 8){
    	                $data['status'] = 1;
        				$data['response'] = 'success';
        				echo json_encode($data);
    	            }else{
    	                $data['status'] = 2;
        				$data['response'] = 'fail';
        				echo json_encode($data);
    	            }
    	        }
    	    }else{
    	        $data['status'] = 3;
				$data['response'] = 'failed';
				echo json_encode($data);
    	    }
	    }else{
	        $data['status'] = 3;
			$data['response'] = 'failed';
			echo json_encode($data);
	    }
	}
	public function paymentdetails(){
	    if(isset($_POST['paymenttype']) && ($_POST['paymenttype'] == 'paytm')){
	        $this->form_validation->set_rules('paytmphone', 'Paytm Phone','trim|required|numeric|exact_length[10]');
	    }else if(isset($_POST['paymenttype']) && ($_POST['paymenttype'] == 'bankaccount')){
	        $this->form_validation->set_rules('accountno', 'Account number','trim|required|min_length[8]|max_length[34]');
	        $this->form_validation->set_rules('ifsccode', 'Ifsc Code','trim|required|min_length[10]|max_length[35]');
	        $this->form_validation->set_rules('bankname', 'Bank Name','trim|required|min_length[3]|max_length[150]');
	        $this->form_validation->set_rules('accounteename', 'Accountee Name','trim|required|min_length[5]|max_length[200]');
	        $this->form_validation->set_rules('branchname', 'Branch Name','trim|required|min_length[5]|max_length[200]');
	    }else if(isset($_POST['paymenttype']) && ($_POST['paymenttype'] == 'googlepay')){
	        $this->form_validation->set_rules('googlepayphone', 'Google Pay Phone','trim|required|numeric|exact_length[10]');
	    }
		if ($this->form_validation->run() == FALSE) {
            $data['validations'] = $this->form_validation->error_array();
			$data['status'] = -1;
			echo json_encode($data);
		}else if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){
		    $userid = $this->session->userdata['logged_in']['user_id'];
		    if(isset($_POST['paymenttype']) && ($_POST['paymenttype'] == 'paytm') && !empty($userid)){
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
		    }else if(isset($_POST['paymenttype']) && ($_POST['paymenttype'] == 'bankaccount') && !empty($userid)){
		        $inputdata = array(
    		        'paymenttype2' => $this->input->post('paymenttype'),
    		        'accountno' => $this->input->post('accountno'),
    		        'ifsccode' => $this->input->post('ifsccode'),
    		        'bankname' => $this->input->post('bankname'),
    		        'accounteename' => $this->input->post('accounteename'),
                    'branchname' => $this->input->post('branchname'),
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
		    }else if(isset($_POST['paymenttype']) && ($_POST['paymenttype'] == 'googlepay') && !empty($userid)){
		        $inputdata = array(
    		        'paymenttype3' => $this->input->post('paymenttype'),
    		        'googlepayphone' => $this->input->post('googlepayphone'),
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
	    if(isset($_POST['paymenttype'], $this->session->userdata['logged_in']['user_id']) && !empty($_POST['paymenttype']) && !empty($this->session->userdata['logged_in']['user_id'])){
    	    $userid = $this->session->userdata['logged_in']['user_id'];
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
		$this->load->view('otherlangs/about.php');
	}
	public function error(){
	    $this->load->view('otherlangs/error.php');
	}
	
	public function terms(){
	    $this->load->view('otherlangs/terms.php');
	}
	
	public function faq()
	{
	    $this->load->view('otherlangs/faq.php');
	}
	public function privacy_policy()
	{
	    $this->load->view('otherlangs/privacy.php');
	}
	public function contact() {
	    if(isset($_POST) && !empty($_POST)){
	        $uploadedfile = '';
	        if(isset($_FILES['file']['name']) && !empty($_FILES['file']['name'])){
                $config['upload_path'] = 'assets/images/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|doc|docx|xls|xlsx';
                $config['max_size']     = '2048';
                $config['encrypt_name'] = TRUE;
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                $this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('file')) {
	                $error = array('error' => $this->upload->display_errors());
	            }else {
	                $arr_image = $this->upload->data();
	                $uploadedfile = $arr_image['file_name'];
	            }
	        }
	        $data = array(
	            'request_for' => $this->input->post('request_for'),
	            'name' => $this->input->post('name'),
	            'email' => $this->input->post('email'),
	            'link' => $this->input->post('link'),
	            'descr' => $this->input->post('descr'),
	            'file' => $uploadedfile,
	       );
	       $response = $this->User_model->contact($data);
	       if($response){
	           $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Email Sent Successfully, We will get back you soon.</div>');
	           $this->load->view('contact.php');
	       }else{
	           $this->load->view('contact.php');
	       }
	    }else{
	        $this->load->view('contact.php');
	    }
	}
	
		/* Blog start*/
		
	public function blogsearch() {
        if(isset($_POST['search']) && !empty($_POST['search'])) {
			$dataresult = array();
            $response = $this->User_model->blogsearch($_POST['search']);
        }
    }
		
    public function blog() {
        $data['blogs'] = $this->User_model->blogdetail('',0,3);
        $this->load->view('otherlangs/blog.php', $data);
    }
    public function blogloadmore(){
        if(isset($_POST['start'], $_POST['limit']) && !empty($_POST['limit'])) {
            $data['blogsload'] = $this->User_model->blogdetail('',$_POST['start'],$_POST['limit']);
            $this->load->view('otherlangs/blogloadmore.php', $data);
        }
    }
    public function blogdetail($blognameid) {
        $blog_id = explode('-', $blognameid);
	    $blogid  = end($blog_id);
        $data['blogs'] = $this->User_model->blogdetail($blogid);
        $data['blogcomments'] = $this->User_model->blogcommentlists($blogid, 0,5);
        $data['blogcommentscount'] = $this->User_model->blogcommentlists($blogid);
        $this->load->view('otherlangs/blogdetail.php',$data);
    }

    public function blogloadcomments(){
	     if(isset($_POST["limit"], $_POST["start"], $_POST['blog_id']) && !empty($_POST['blog_id']) && !empty($_POST["limit"])){
            $data['blogcomments'] = $this->User_model->blogcommentlists($_POST['blog_id'], $_POST["start"], $_POST["limit"]);
            $this->load->view('otherlangs/blogloadcomments.php',$data);
        }
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
    		$this->load->view('otherlangs/bsearchdata.php', $data);
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
}
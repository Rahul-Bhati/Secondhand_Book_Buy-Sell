<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function	__construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('cookie');
		$this->load->database();
		$this->load->library('session');
		$this->load->model("Admin_Record");
	}
	public function index()
	{
		$this->load->view('admin_login');
	}
     public function check()
	{
		if(!get_cookie("user")){
			if($this->input->post("email")=="" || $this->input->post("pass")==""){
				redirect(base_url()."index.php/Admin/index/empty");
			}else{
                    $email = $this->input->post("email");
                    $pass = $this->input->post("pass");
                    $rec = $this->Admin_Record->check($email,$pass);
				if($rec=="success"){
					$this->input->set_cookie("user",$email,3600);
					$this->session->set_userdata($email,$pass);
					redirect(base_url()."index.php/Admin/Dashboard/");
				}else if($rec=="inc_email"){
					redirect(base_url()."index.php/Admin/index/inc_email");
				}else if($rec=="inc_pass"){
					redirect(base_url()."index.php/Admin/index/inc_pass");
				}
			}
		}else{
			redirect(base_url()."index.php/Admin/Dashboard");
		}
	}
     public function Dashboard(){
          $this->load->view('Dashboard');
     }
	public function add_category(){
		if(get_cookie("user")){
			if($this->input->post('cat')==""){
				echo "empty";
			}else{
				$a=array();
				$code="";
				for($i='A'; $i<='Z'; $i++ ){
					array_push($a,$i);
					if($i='Z')
						break;
				}
				for($i='a'; $i<='z'; $i++ ){
					array_push($a,$i);
					if($i='z')
						break;
				}	
				for($i=0; $i<=9; $i++ ){
					array_push($a,$i);	
				}
					
				$b=array_rand($a,6);
				for($i=0; $i<sizeof($b); $i++ ){
					$code=$code.$a[$b[$i]];
				}	
				$data = array("code"=>$code,"cat_name"=>$this->input->post('cat'));
				$rec = $this->Admin_Record->add_category($data);
				if($rec=="success"){
					echo "success";
				}else if($rec=="already"){
					echo "already";
				}else{
					echo "again";
				}
			}
		}else{
			redirect(base_url());
		}
	}
	public function edit_category(){
		if(get_cookie("user")){
			if($this->input->post('val')==""){
				echo "empty";
			}else{
				$code=$this->input->post('code');
				$data = array("cat_name"=>$this->input->post('val'));
				$rec = $this->Admin_Record->update_category($data,$code);
				if($rec=="success"){
					echo "success";
				}else if($rec=="already"){
					echo "already";
				}else{
					echo "again";
				}
			}
		}else{
			redirect(base_url());
		}
	}
	public function delete_category(){
		if($this->Admin_Record->delete_category($this->input->post('code'))){
			echo "success";
		}else{
			echo "again";
		}
	}
	public function books(){
		$this->load->view('admin_books');
	}
	public function users(){
		$this->load->view('users');
	}
	public function book_delete(){
		if($this->Admin_Record->book_delete($this->uri->segment('3'))){
			redirect(base_url()."index.php/Admin/books/0/book_delete");
		}else{
			redirect(base_url()."index.php/Admin/books/0/again");
		}
	}
	public function user_delete(){
		if(get_cookie("user")){
			if($this->Admin_Record->user_delete($this->input->post('e'))){
				echo "success";
			}else{
				echo "again";
			}
		}else{
			redirect(base_url());
		}
		
	}
	public function user_block(){
		//echo $this->Admin_Record->user_block($this->input->post('e'));
		if(get_cookie("user")){
			$rec = $this->Admin_Record->user_block($this->input->post('e'));
			if($rec=="unblock"){
				echo "unblock";
			}else if($rec=="block"){
				echo "block";
			}else{
				echo "again";
			}
		}else{
			redirect(base_url());
		}
		
	}
	public function Logout(){
		$this->session->unset_userdata(get_cookie("user"));
		delete_cookie("user");
		redirect(base_url());
	}
}
?>
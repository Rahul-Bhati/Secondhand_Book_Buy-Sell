<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function	__construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('cookie');
		$this->load->database();
		$this->load->library('session');
		$this->load->model("Record");
	}
	public function index()
	{
		$this->load->view('Home');
	}
	public function signIn()
	{
		if($this->uri->segment(3)!=""){
			$rec = $this->uri->segment(3);
			$this->load->view('signIn',$rec);
		}else{
			$this->load->view('signIn');
		}
	}
	public function login()
	{
		if(!get_cookie("login") && !$this->session->userdata(get_cookie("login"))){
			redirect(base_url());
		}else{
			$this->load->view('login');
		}
	}
	public function register()
	{
		if(!get_cookie("login") && !$this->session->userdata(get_cookie("login"))){
			if($this->input->post("user")=="" || $this->input->post("email")=="" || $this->input->post("phone")=="" || $this->input->post("pass")==""){
				redirect(base_url()."index.php/Welcome/signIn/empty");
			}else{
				$data = array("name"=>$this->input->post("user"),
					"email"=>$this->input->post("email"),
					"phone"=>$this->input->post("phone"),
					"pass"=>$this->input->post("pass"),
				);
				//$this->Record->registration($data);
				if($this->Record->registration($data)){
					redirect(base_url()."index.php/Welcome/signIn/success");
				}else{
					redirect(base_url()."index.php/Welcome/signIn/again");
				}
			}
		}else{
			redirect(base_url()."index.php/Welcome/signIn/again");
		}
	}
	public function check()
	{
		if(!get_cookie("login")){
			if($this->input->post("email")=="" || $this->input->post("pass")==""){
				redirect(base_url()."index.php/Welcome/signIn/empty");
			}else{
					$email = $this->input->post("email");
					$pass = $this->input->post("pass");
				if($this->Record->check($email,$pass)){
					$this->input->set_cookie("login",$email,3600);
					$this->session->set_userdata($email,$pass);
					redirect(base_url()."index.php/Welcome/profile/");
				}else{
					redirect(base_url()."index.php/Welcome/signIn/again");
				}
			}
		}else{
			redirect(base_url()."index.php/Welcome/profile");
		}
	}
	public function profile()
	{
		//echo get_cookie('login');
		$this->load->view('profile');
	}
	public function upload_data()
	{
		$this->load->view('upload');
	}
	public function submit()
	{
		if(get_cookie("login") && $this->session->userdata(get_cookie("login"))){
			if($this->input->post("title")=="" || $this->input->post("detail")=="" || $this->input->post("price")==""){
				redirect(base_url()."index.php/Welcome/upload_data/empty");
			}else{
				$sn=0;
				$rec = $this->Record->snOfBook();
				foreach ($rec as $row) {
					$sn = $row->sn;
				}
				$sn++;
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
				$code = $code."_".$sn;
				$email = get_cookie('login');
				$data = array("sn"=>$sn,
					"code"=>$code,
					"title"=>$this->input->post("title"),
					"detail"=>$this->input->post("detail"),
					"category"=>$this->input->post("category"),
					"price"=>$this->input->post("price"),
					"mrp"=>$this->input->post("mrp"),
					"email"=>$email,
				);
				//print_r($data);
				if($this->Record->submit_img_data($data)){
					redirect(base_url()."index.php/Welcome/upload_img/".$code);
				}else{
					redirect(base_url()."index.php/Welcome/upload_data");
				}
			}
		}
		else{
			redirect(base_url()."index.php/Welcome/signIn/logout");
		}
	}
	public function Edit_img_data(){
		$this->load->view('Edit_img_data');
	}
	public function update(){
		if(get_cookie("login") && $this->session->userdata(get_cookie("login"))){
			$code = $this->uri->segment('3');
			if($this->input->post("title")=="" || $this->input->post("detail")=="" || $this->input->post("price")==""){
				redirect(base_url()."index.php/Welcome/Edit_img_data/".$code."/empty");
			}else{
				$data = array(
					"title"=>$this->input->post("title"),
					"detail"=>$this->input->post("detail"),
					"category"=>$this->input->post("category"),
					"price"=>$this->input->post("price"),
				);
				if($this->Record->update_img_data($data,$code)){
					redirect(base_url()."index.php/Welcome/profile/0/book_data_updated");
				}else{
					redirect(base_url()."index.php/Welcome/Edit_img_data/".$code."/again");
				}
			}
		}
		else{
			redirect(base_url()."index.php/Welcome/signIn/logout");
		}
	}
	public function delete_img_data(){
		$code = $this->uri->segment('3');
		if($this->Record->delete_img_data($code)){
			@unlink(FCPATH . 'uploads/' . $code.".png"); // delete old image
			redirect(base_url()."index.php/Welcome/profile/0/book_delete");
		}else{
			redirect(base_url()."index.php/Welcome/profile/0/book_delete_fail");
		}
	}
	public function upload_img()
	{
		$this->load->view('upload_img', array('error' => ' ' ));
	}
	public function Edit_img()
	{
		$this->load->view('Edit_img', array('error' => ' ' ));
	}
	public function do_upload_img()
	{
		if(get_cookie("login") && $this->session->userdata(get_cookie("login"))){
			$code = $this->uri->segment(3);
			$config['upload_path']          = './uploads/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 2048000;
			$config['file_name']           = $code.".png";

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('userfile'))
			{
				$error = array('error' => $this->upload->display_errors());

				$this->load->view('upload_img', $error);
			}
			else
			{
				//$data = array('upload_data' => $this->upload->data());

				redirect(base_url()."index.php/Welcome/profile/0/booksuccess");
				//$this->load->view('upload_book', array('error' => ' ' ));
			}
		}else{
			redirect(base_url()."index.php/Welcome/signIn/logout");
		}
	}
	public function update_img()
	{
		if(get_cookie("login") && $this->session->userdata(get_cookie("login"))){
			$code = $this->uri->segment(3);
			$config['upload_path']          = './uploads/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 2048000;
			$config['file_name']           = $code.".png";

			@unlink(FCPATH . 'uploads/' . $code.".png"); // delete old image

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('userfile'))
			{
				$error = array('error' => $this->upload->display_errors());

				$this->load->view('upload_img', $error);
			}
			else
			{
				//$data = array('upload_data' => $this->upload->data());
				redirect(base_url()."index.php/Welcome/profile/0/book_img_update");
				//$this->load->view('upload_book', array('error' => ' ' ));
			}
		}else{
			redirect(base_url()."index.php/Welcome/signIn/logout");
		}
	}
	public function edit_user(){
		$this->load->view('edit_user');
	}
	public function update_user(){
		if(get_cookie("login") && $this->session->userdata(get_cookie("login"))){
			if($this->input->post('n') != "" || $this->input->post('p') != ""){
				$data =array("name"=>$this->input->post('n'),"phone"=>$this->input->post('p'));
				if($this->Record->update_user_db($data)){
					echo "success";
				}else{
					echo "again";
				}
			}else{
				echo "empty";
			}
		}else{
			redirect(base_url()."index.php/Welcome/signIn/logout");
		}
	}
	public function edit_pass(){
		$this->load->view('edit_pass');
	}
	public function update_pass(){
		if(get_cookie("login") && $this->session->userdata(get_cookie("login"))){
			if($this->input->post('cp') != "" || $this->input->post('np') != "" || $this->input->post('rp') != ""){
				$data =array("cp"=>$this->input->post('cp'),
					"np"=>$this->input->post('np'),
					"rp"=>$this->input->post('rp'),
				);
				//$rec = $this->Record->update_pass_db($data);
				//echo $rec;
				if($this->Record->update_pass_db($data)){
					echo "success";
				}else{
					echo "again";
				}
			}else{
				echo "empty";
			}
		}else{
			redirect(base_url()."index.php/Welcome/signIn/logout");
		}
	}
	public function view_book(){
		$this->load->view('view_book');
	}
	public function msg(){
		if($this->uri->segment('3')){
			$msg = $this->input->post('msg');
			$book_code = $this->uri->segment('3');
			if(get_cookie("login")){
					if($msg != "" || $book_code != ""){
						//echo $msg." ".$code;
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
						$data = array("msg_send"=>$msg,"book_code"=>$book_code,"code"=>$code);
						$rec = $this->Record->msg($data);
						if($rec=="success"){
							redirect(base_url()."index.php/Welcome/view_book/".$book_code."/success");
						}else if($rec=="already"){
							redirect(base_url()."index.php/Welcome/view_book/".$book_code."/already");
						}
						else{
							redirect(base_url()."index.php/Welcome/view_book/".$book_code."/again");
						}
				}else{
					redirect(base_url()."index.php/Welcome/view_book/".$book_code."/empty");
				}
			}else{
				redirect(base_url()."index.php/Welcome/view_book/".$book_code."/login_fail");
			}
		}else{
			redirect(base_url());
		}
	}
	public function cart(){
		if($this->uri->segment('3')){
			$book_code = $this->uri->segment('3');	
			if(get_cookie("login")){				
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
				$rec = $this->Record->cart($book_code,$code);
				if($rec=="success"){
					redirect(base_url()."index.php/Welcome/view_book/".$book_code."/csuccess");
				}else if($rec=="already"){
					redirect(base_url()."index.php/Welcome/view_book/".$book_code."/calready");
				}
				else{
					redirect(base_url()."index.php/Welcome/view_book/".$book_code."/cagain");
				}
			}else{
				redirect(base_url()."index.php/Welcome/view_book/".$book_code."/clogin_fail");
			}
		}else{
			redirect(base_url());
		}
	}
	public function books(){
		$this->load->view('books');
	}
	public function cart_view(){
		$this->load->view('cart_view');
	}
	public function delete_cart(){
		$code = $this->input->post('code');
		if($this->Record->delete_cart($code)){
			echo "success";
		}else{
			echo "again";
		}
	}
	public function delete_msg(){
		$code = $this->input->post('code');
		if($this->Record->delete_msg($code)){
			echo "success";
		}else{
			echo "again";
		}
	}
	public function message(){
		$this->load->view('msg_page');
	}
	public function search(){
		$sch = $this->input->post('search');
		$rec["sch"] = $this->Record->search($sch);
		$this->load->view('search',$rec);
	}
	
	public function logout(){
		$this->session->unset_userdata(get_cookie("login"));
		delete_cookie("login");
		redirect(base_url());
	}
}

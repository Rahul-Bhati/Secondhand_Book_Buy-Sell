<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Record extends CI_Model
	{
		public function check($email,$pass){
			$this->db->select('pass');
			$this->db->from('user');
			$this->db->where("email",$email);
			//return $this->db->get()->result();
			foreach($this->db->get()->result() as $row){
				$rpass = $row->pass;
				if($rpass == $pass){
					return true;
				}
			}
		}
		public function snOfBook(){
			$this->db->select('sn');
			$this->db->from('book_data');
			return $this->db->get()->result();
		}
		public function registration($data){
			$this->db->select('*');
			$this->db->from('user');
			$this->db->where("email",$data['email']);
			$rec = $this->db->get()->result();
			if(sizeof($rec)==0){
				$this->db->insert("user",$data);
				return true;
			}
		}
		public function submit_img_data($data){
			$this->db->insert("book_data",$data);
			return true;
		}
		public function delete_img_data($code){
			$this->db->where("code",$code);
			$this->db->delete("book_data");
			return true;
		}
		public function update_img_data($data,$code){
			$this->db->where("code",$code);
			$this->db->update("book_data",$data);
			return true;
		}
		public function update_user_db($data){
			$this->db->where("email",get_cookie('login'));
			$this->db->update("user",$data);
			return true;
		}
		public function update_pass_db($data){
			$this->db->select('pass');
			$this->db->from('user');
			$this->db->where("email",get_cookie('login'));
			foreach($this->db->get()->result() as $row){
				$rpass = $row->pass;
				if($rpass == $data["cp"]){
					if($data["np"]==$data["rp"]){
						//echo $rpass." ".$data["cp"];
						$rec = array("pass"=>$data['np']);
						$this->db->set($rec);
						$this->db->where("email",get_cookie('login'));
						$this->db->update("user");
						return true;
				 	}else {
						return false;
					}
				}else {
					return false;
				}
			}
			return false;
		}
		public function msg($data){
			$email = get_cookie('login');
			$this->db->select('*');
			$this->db->from('book_data');
			$this->db->where("code",$data['book_code']);
			$query = $this->db->get();
			foreach($query->result() as $row){
				if($email == $row->email){
					return "already";
				}
				$rdata = array( "code"=>$data['code'],"book_code"=>$data['book_code'],
					"from_email"=>$email,"to_email"=>$row->email,"msg_send"=>$data['msg_send']
				);
				$this->db->insert("msg",$rdata);
				return "success";
			}
		}
		public function search($sch){
			$s = explode(" ",$sch);
			$this->db->select('*');
			$this->db->from('book_data');
			$this->db->like("title",$sch);
			foreach ($s as $sc) {
				$this->db->or_like("title",$sc);
			}
			$query = $this->db->get();
			return $query->result();
		}
		public function cart($book_code,$code){
			$multiwhere = ['book_code'=>$book_code,'email'=>get_cookie('login')];
			$this->db->select('*');
			$this->db->from('cart');
			$this->db->where($multiwhere);
			$query = $this->db->get();
			foreach($query->result() as $row){
				return "already";
			}
			$data = array("code"=>$code,'book_code'=>$book_code,"email"=>get_cookie('login'));
			$this->db->insert("cart",$data);
			return "success";
		}
		public function delete_cart($code){
			$this->db->where("code",$code);
			$this->db->delete("cart");
			return true;
		}
		public function delete_msg($code){
			$this->db->where("code",$code);
			$this->db->delete("msg");
			return true;
		}
	}
?>
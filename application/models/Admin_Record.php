<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Admin_Record extends CI_Model
	{
		public function check($email,$pass){
			$this->db->select('pass');
			$this->db->from('admin');
			$this->db->where("email",$email);
			//return $this->db->get()->result();
			foreach($this->db->get()->result() as $row){

				$rpass = $row->pass;
				if($rpass == $pass){
					return "success";
				}else{
					return "inc_pass";
				}
			}
			return "inc_email";
		}
		public function add_category($cat){
			$this->db->select('*');
			$this->db->from('category');
			$this->db->where("cat_name",$cat['cat_name']);
			foreach($this->db->get()->result() as $row){
				return "already";
			}
			$this->db->insert("category",$cat);
			return "success";
		}
		public function update_category($cat,$code){
			$this->db->select('*');
			$this->db->from('category');
			$this->db->where("cat_name",$cat['cat_name']);
			foreach($this->db->get()->result() as $row){
				return "already";
			}
			$this->db->where("code",$code);
			$this->db->update("category",$cat);
			return "success";
		}
		public function delete_category($data){
			$this->db->where("code",$data);
			$this->db->delete("category");
			return true;
		}
		public function book_delete($data){
			$this->db->where("code",$data);
			$this->db->delete("book_data");
			return true;
		}
		public function user_delete($data){
			$this->db->where("email",$data);
			$this->db->delete("user");
			return true;
		}
		public function user_block($data){
			$this->db->select('status');
			$this->db->from('user');
			$this->db->where("email",$data);
			foreach($this->db->get()->result() as $row){
				if($row->status==1){
					$r_data = array("status"=>0);
					$this->db->where("email",$data);
					$this->db->update("user",$r_data);
					return "unblock";
				}else if($row->status==0){
					$r_data = array("status"=>1);
					$this->db->where("email",$data);
					$this->db->update("user",$r_data);
					return "block";
				}
			}
		}
     }
     
?>
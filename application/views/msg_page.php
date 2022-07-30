<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!get_cookie("login") || !$this->session->userdata(get_cookie("login"))){
     redirect(base_url()."index.php/Welcome/index/Login_Fail");
}
else{
	$email = get_cookie("login");
	$id = 0;
	if($this->uri->segment('3')){
		$id = $this->uri->segment('3');
	}
	else{
		$id = 0;
	}
	$start = $id*10;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>BookShop - find and download free Books</title>

	<link rel="shortcut icon" href="<?php echo base_url()."img/fav.png";?>" />
	<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="<?php echo base_url()."assets/css/w3.css"; ?>" >
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	<style>
		a{
			text-decoration: none;
			cursor: pointer;
			color: #000;
		}
		i{
			cursor: pointer;
		}
		.navbar-brand:hover{
			color: #000;
		}
		.navbar-toggler:hover{
			border-color: #000;
		}
		.head-img{
               width: auto;
               height: 100%;
               background-image:url('<?php echo base_url()."img/blog-3.jpg"?>');
          }
	     .flex-container {
			display: flex;
			justify-content: center;
		}
		.flex-container > div {
			margin: 10px;
			padding: 20px;
			font-size: 15px;
			font-weight: 500;
		}
	

		.wrapper
		{
			padding-bottom: 90px;
		}

		.divider
		{
			position: relative;
			margin-top: 90px;
			height: 1px;
		}

		.div-transparent:before
		{
			content: "";
			position: absolute;
			top: 0;
			left: 5%;
			right: 5%;
			width: 90%;
			height: 1px;
			background-image: linear-gradient(to right, transparent, rgb(48,49,51), transparent);
		}

		.div-dot:after
		{
			content: "";
			position: absolute;
			z-index: 1;
			top: -9px;
			left: calc(50% - 9px);
			width: 18px;
			height: 18px;
			background-color: goldenrod;
			border: 1px solid rgb(48,49,51);
			border-radius: 50%;
			box-shadow: inset 0 0 0 2px white,
					0 0 0 4px white;
		}
	</style>
	
</head>
<body>
	<div class="container-fluid" style="font-size:18px;;font-weight:550">
		<nav class="navbar navbar-expand-lg">
			<div class="container-fluid">
				<a class="navbar-brand" style="font-size:25px;font-weight:600px;" href="<?php echo base_url();?>"><i class="bx bxs-book" style="color:#27ae60;"></i>BookShop</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"><img src="<?php echo base_url()."img/menu.png";?>" class="img-fluid"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a style="color: black;" class="nav-link active" aria-current="page" href="<?php echo base_url();?>">Home</a>
					</li>
					<li class="nav-item">
						<a style="color: black;" class="nav-link" href="<?php echo base_url()."index.php/Welcome/books";?>">Books</a>
					</li>
					<li class="nav-item">
						<a style="color: black;" class="nav-link" href="<?php echo base_url()."index.php/Welcome/cart_view";?>">Carts</a>
					</li>
                         <li class="nav-item">
						<a style="color: black;" class="nav-link" href="<?php echo base_url()."index.php/Welcome/message";?>">Message</a>
					</li>
					<li class="nav-item">
						<a style="color: black;" class="nav-link" href="<?php echo base_url()."index.php/Welcome/profile"; ?>">Profile</a>
					</li>
					<li class="nav-item">
						<a style="color: black;" class="nav-link" href="<?php echo base_url()."index.php/Welcome/logout"; ?>">Logout</a>
					</li>
					</ul>
					<form action="<?php echo base_url()."index.php/Welcome/search"; ?>" class="d-flex" method="post">
					<input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
					<button class="btn btn-outline-success" type="submit">Search</button>
					</form>
				</div>
			</div>
		</nav>
	</div><br>
     <div class="container-fluid head-img">
          <div class="flex-container">
               <div class="container" style="padding: 3%;">
                    <center><h1 style="font-weight: 700;border-bottom:3px solid #000;width:180px;padding:5px;">Messages</h1></center>
               </div>
          </div>
     </div><br><br>
	<div class="container" id="msg"></div>
     <div class="container" id="rec">
          <div class="col-sm-12">
               <div class="flex-container row" style="padding: 2%;">
					<?php
					$flag=0;
					$page = 0;
					$this->db->select('*');
					$this->db->from('msg');
					$this->db->where('to_email',get_cookie('login'));
					$this->db->limit(10,$start);
					$query = $this->db->get()->result();
					$count = sizeof($query);
					foreach($query as $rd){
						$page++;
						$flag++;
                              ?>
					<div class="card col-sm-6" id="d-<?php echo $rd->code;?>">
                              <div class="row">
                                   <?php 
                                   $this->db->select('*');
                                   $this->db->from('user');
                                   $this->db->where('email',$rd->from_email);
                                   $query = $this->db->get();
                                   foreach($query->result() as $row){
                                   ?>
                                        <div class="col-sm-4">
                                             <center><i class="bx bx-user" style="font-size: 150px;"></i></center>
                                        </div>
                                        <div class="col-sm-8">
                                             <h5 class="name" style="font-weight: 550;"><?php echo $row->name; ?></h5>
                                             <p class="description" style="font-size:13px;font-weight: 500;"><i class='bx bx-envelope'></i> <?php echo $row->email; ?></p>
                                             <h5><i class='bx bx-phone'></i> <?php echo $row->phone; ?></h5>
                                             <p class="" style="font-size:13px;font-weight: 500;"><i class='bx bx-message'></i> <?php echo $rd->msg_send; ?> </p>
                                             <button class="w3-button w3-small w3-blue see-more">See Book</button>
                                             <button class="w3-button w3-small w3-red" rel="<?php echo $rd->code;?>">Delete</button>
                                        </div>
                                        <script>
                                             $(document).ready(function(){
                                                  $(".see-more").click(function(){
                                                       $("#book-slot").css("display","flex");
                                                       $(this).hide();
                                                  });
                                             });
									$(document).on("click",".bx.bx-x",function(){
										$("#msg").hide(500);
									});
									$(document).on("click",".w3-red",function(){
										var e = $(this).attr("rel");
										$.post(
											"<?php echo base_url()."index.php/Welcome/delete_msg"?>",{code:e},function(data){
												if(data.trim()=="success"){
													$("#msg").html("<h5 class='alert alert-success' >Message Removed ! <i class='bx bx-x' style='float:right;'></i></h5>");
													$("#d-"+e).fadeOut(1000);
												}else{
													$("#msg").html("<h5 class='alert alert-danger' >Try Again ! <i class='bx bx-x' style='float:right;'></i></h5>");
												}
											}
										);
									});
                                        </script>
                                   <?php
                                   }
                                   ?>
                              </div><br>
                              <div class="row" style="display:none;" id="book-slot">
                                   <?php 
                                   $this->db->select('*');
                                   $this->db->from('book_data');
                                   $this->db->where('code',$rd->book_code);
                                   $this->db->limit(20);
                                   $query = $this->db->get();
                                   foreach($query->result() as $row){
                                   ?>   
                                        <a href="<?php echo base_url()."index.php/Welcome/view_book/".$row->code;?>" style="display: flex;color:#000">
                                        <div class="col-sm-4">
                                             <center><img src="<?php echo base_url()."uploads/".$row->code.".png";?>" alt="" style="width: 100px;padding-top:10px;" class="img-fluid book-img" title="click to see more"></center>
                                        </div>
                                        <div class="col-sm-8">
                                             <h5 class="name" style="font-weight: 550;"><?php echo $row->title; ?></h5>
                                             <p class="description" style="font-size:13px;font-weight: 500;"><?php echo $row->detail; ?></p>
                                             <h5><?php echo $row->price; ?> &nbsp;<span style="font-size:12px;font-weight: 500;"><s><?php echo $row->mrp; ?></s></span></h5>
                                        </div></a>
                                   <?php
                                   }
                                   ?>
                              </div>
                         </div>
					<?php
					}
					if($flag==0){
						?>
						<p>no messsage recevied till now.</p>
						<?php
					}
					if($page==0 && $id>0){
						redirect(base_url()."index.php/Welcome/message/0");
					}
					?>
			</div>
		</div>
		<div class="col-sm-12">
               <div class="row">
				<div class="col-sm-4"></div>
				<div class="col-sm-4 flex-container" >
					<?php
						if($id>0){
							$prev = $id-1;
					?>
					<div class="prev"><a href="<?php echo base_url()."index.php/Welcome/books/".$prev;?>"><i class='bx bx-chevrons-left'></i> Prev Page</a></div> 
					<?php
						}
						$next = $id+1;
					?>
 					<?php
						if($count>=10){
					?>
					<div class="next" style="display:inline;"><a href="<?php echo base_url()."index.php/Welcome/books/".$next;?>">Next Page <i class='bx bx-chevrons-right'></i></a></div>
					<?php
					}
					?>	
				</div>
				<div class="col-sm-4"></div>
			</div>
		</div>
	</div>
     <div class="container">
		<div class="col-sm-12">
			<div class="row">
				<div class="wrapper">
				<div class="divider div-transparent div-dot"></div>
				</div><br><br>
			</div><br><br>
			<div class="row" style="margin-bottom:10px;">
				<div class="col-sm-12"></div>
				<div class="col-sm-4">
					<div class="container">
						<h2 style="font-weight: 700;">BookShop.com</h2>
						<span style="font-weight: 500;">Best Recycle is Book Recycle. Keep Your Books Flowing.</span>
					</div>
				</div>
				<div class="col-sm-5">
					<div class="container">
						<h4 style="font-weight: 550;">Sell Old Books Online</h4>
						<span style="font-weight: 400;font-size:12px;">BookFlow is customer to customer platform like Olx for books. Sell and buy old books in India at zero commission. Click socal media link for 24x7 customer care.</span>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="container">
						<h3>Follow us on:</h3>
						<a href="" style="font-size:25px;color:black;"><i class='bx bxl-facebook-circle'></i></a> &nbsp;
						<a href="" style="font-size:25px;color:black;"><i class='bx bxl-instagram' ></i></a>&nbsp;
						<a href="" style="font-size:25px;color:black;"><i class='bx bxl-twitter' ></i></a>
					</div>
				</div>
				<div class="col-sm-12" style="padding:40px;">
					<center>© BookShop.com <br> All rights reserved and created by Rahul Bhati</center>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<?php
}
?>
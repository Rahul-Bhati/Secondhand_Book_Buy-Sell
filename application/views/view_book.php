<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$flag=0;
if(!get_cookie("login") || !$this->session->userdata(get_cookie("login"))){
     $flag=0;
}
else{
	$flag=1;
}
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
	<link rel="stylesheet" href="<?php echo base_url()."assets/css/swiper-bundle.min.css"; ?>" >
	<link rel="stylesheet" href="<?php echo base_url()."assets/css/style.css"; ?>" >
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

	<style>
		a{
			text-decoration: none;
			cursor: pointer;
			color: #000;
		}
		a:hover{
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
		.banner{
			width: auto;
			height: 100%;
			overflow: hidden;
			box-sizing: border-box;
			background-image: url('<?php echo base_url()."img/banner-bg.jpg"; ?>');
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
					<?php
						if($flag==0){
					?>
					<li class="nav-item dropdown" style="color: black;">
						<a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" style="color: black;">Sign In</a>
						<ul class="dropdown-menu">
						<li><a class="dropdown-item" href="<?php echo base_url()."index.php/Welcome/signIn"; ?>">User</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url()."index.php/Admin"; ?>">Admin</a></li>
						</ul>
					</li>
					<?php
						}else{
							?>
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
							<?php
						}
					?>
					</ul>
					<form action="<?php echo base_url()."index.php/Welcome/search"; ?>" class="d-flex" method="post">
					<input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
					<button class="btn btn-outline-success" type="submit">Search</button>
					</form>
				</div>
			</div>
		</nav>
	</div>
	<div class="flex-container">
		<div class="container" id="alert-cart" style="margin-left:80%;margin-top:-14px;display: block;position:absolute;">
			<?php
				if($this->uri->segment('4')=="csuccess"){
					?>
					<h5 style="font-size: 13px;font-weight:550;width:20%;" class='alert alert-success' >Book Added in Cart ! <i class='bx bx-x' style="float:right;"></i></h5>
					<?php
				}else if($this->uri->segment('4')=="calready"){
					?>
					<h5 style="font-size: 13px;font-weight:550;width:20%;" class='alert alert-primary' >Already Added in Cart ! <i class='bx bx-x' style="float:right;"></i></h5>
					<?php
				}
				else if($this->uri->segment('4')=="cagain"){
					?>
					<h5 style="font-size: 13px;font-weight:550;width:20%;" class='alert alert-danger' >Try Again ! <i class='bx bx-x' style="float:right;"></i></h5>
					<?php
				}
				else if($this->uri->segment('4')=="clogin_fail"){
					?>
					<h5 style="font-size: 13px;font-weight:550;width:20%;" class='alert alert-warning'>You Have to Login First  ! <i class='bx bx-x' style="float:right;"></i></h5>
					<?php
				}
			?>
			<script>
				$(document).ready(function(){
					$(".bx.bx-x").click(function(){
						$("#alert-cart").hide(500);
						//$("#alert-cart").css("display","none");
					});
				});
			</script>
		</div>
	</div><br><br>
	<?php
	$category = "";
	$code = $this->uri->segment('3');
	$this->db->select('*');
	$this->db->from('book_data');
	$this->db->where("code",$code);
	$query = $this->db->get();
	foreach($query->result() as $row){
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where("email",$row->email);
		$query = $this->db->get();
		foreach($query->result() as $usr){
			$category = $row->category;
	?>
	<div class="container-fluid banner">
		<div class="col-sm-12">
			<div class="row" style="padding: 20px 0;">
				<div class="col-sm-1"></div>
				<div class="col-sm-4">
					<img src="<?php echo base_url()."uploads/".$row->code.".png";?>" alt="" style="width: 200px;" class="img-fluid">
				</div>
				<div class="col-sm-4" style="float: right;align-items:center;">
					<h2 class="" style="font-weight: 700;"><?php echo $row->title; ?></h2>
					<p class="" style="font-size:13px;font-weight: 550;"><?php echo $row->detail; ?></p>
					<p class="category" style="font-size:13px;font-weight: 550;"><?php echo $row->category; ?></p>
					<h5 style="font-weight: 550;"><span>Price : </span><?php echo $row->price; ?> &nbsp;<span style="font-size:12px;font-weight: 500;">MRP: <?php echo $row->mrp; ?></span></h5><br>
					<button class="w3-button w3-small w3-blue">
						<a href="<?php echo base_url()."index.php/Welcome/cart/".$row->code;?>" style="color: white;"><i class='bx bx-cart'></i> Add Cart</a></button>
				</div>
				<div class="col-sm-3" id="msg">
					<?php
						if($this->uri->segment('4')=="success"){
							?>
							<h5 class='alert alert-success' >Message Sent !</h5>
							<?php
						}else if($this->uri->segment('4')=="already"){
							?>
							<h5 class='alert alert-primary' >You Already Have this Book !</h5>
							<?php
						}
						else if($this->uri->segment('4')=="again"){
							?>
							<h5 class='alert alert-danger' >Try Again !</h5>
							<?php
						}
						else if($this->uri->segment('4')=="empty"){
							?>
							<h5 class='alert alert-warning' >Fill Message Field  !</h5>
							<?php
						}
						else if($this->uri->segment('4')=="login_fail"){
							?>
							<h5 class='alert alert-warning'>You Have to Login First  !</h5>
							<?php
						}
					?>
					<br>
					<form method="post" action="<?php echo base_url()."index.php/Welcome/msg/".$row->code;?>">
						<div class="container w3-card" style="background-color: white;">
							<div class="card-header">
								Publisher : <?php echo $usr->name?>
							</div>
							<div class="card-body">
								<label class="form-label">Send Message</label>
								<textarea type="text" row=3 name='msg' class="form-control" style="resize:none;"></textarea><br>
								<input type="submit" class="w3-button w3-small w3-red" value="send">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div><br><br>
	<?php 
		}
	}
	?>

	<!-- =============================== Similiar ============================== -->
	<div class="container">
		<div class="slide-container swiper">
			<div class="slide-content">
				<div class="card-wrapper swiper-wrapper">
					<?php
					$check=0;
					if($flag==1){
						$email = get_cookie('login');
						$multiwhere = ['category'=>$category,'email!='=>$email,'code!='=>$this->uri->segment('3')];
					}else{
						$multiwhere = ['category'=>$category,'code!='=>$this->uri->segment('3')];
					}
					$this->db->select('*');
					$this->db->from('book_data');
					$this->db->where($multiwhere);
					$this->db->limit(10);
					$query = $this->db->get();
					foreach($query->result() as $row){
						$check++;
					}
					if($check>3){
						foreach($query->result() as $row){
						?>
						<div class="card swiper-slide">
						<div class="image-content">
							<span class="overlay"></span>
							<div class="card-image">
								<img src="<?php echo base_url()."uploads/".$row->code.".png";?>" alt="" class="card-img">
							</div>
						</div>
						<div class="card-content">
							<h2 class="name"><?php echo $row->title; ?></h2>
							<p class="description"><?php echo $row->detail; ?></p>
							<span style="font-size:17px;font-weight: 600;"><?php echo $row->price; ?> &nbsp;<span style="font-size:12px;font-weight: 500;"><s><?php echo $row->mrp; ?></s></span></span>
							<button class="button"><a href="<?php echo base_url()."index.php/Welcome/view_book/".$row->code;?>" style="color: white;">View More</a></button>
						</div>
						</div>
						<?php
						}
					}else{
						$record=0;
						$this->db->select('*');
						$this->db->from('book_data');
						if($flag==1){
							$this->db->where("email!=",$email);
						}
						$this->db->order_by('rand()');
						$this->db->limit(10);
						$query = $this->db->get();
						foreach($query->result() as $row){
						?>
						<div class="card swiper-slide">
							<div class="image-content">
								<span class="overlay"></span>
								<div class="card-image">
									<img src="<?php echo base_url()."uploads/".$row->code.".png";?>" alt="" class="card-img">
								</div>
							</div>
							<div class="card-content">
								<h2 class="name"><?php echo $row->title; ?></h2>
								<p class="description"><?php echo $row->detail; ?></p>
								<span style="font-size:17px;font-weight: 600;"><?php echo $row->price; ?> &nbsp;<span style="font-size:12px;font-weight: 500;"><s><?php echo $row->mrp; ?></s></span></span>
								<button class="button"><a href="<?php echo base_url()."index.php/Welcome/view_book/".$row->code;?>" style="color: white;">View More</a></button>
							</div>
						</div>
					<?php
						}
					}
					?>
				</div>
			</div>
			<div class="swiper-button-next swiper-navBtn"></div>
			<div class="swiper-button-prev swiper-navBtn"></div>
			<div class="swiper-pagination"></div>
		</div>
		<!-- Swiper JS -->
		<script src="<?php echo base_url()."assets/js/swiper-bundle.min.js"; ?>"></script>
		<script src="<?php echo base_url()."assets/js/script.js"; ?>"></script>
	</div>
	<br>
	
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

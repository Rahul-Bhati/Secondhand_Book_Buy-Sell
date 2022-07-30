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
	<title>BookShop  - find and download free Books</title>
	<link rel="stylesheet" href="<?php echo base_url()."assets/css/w3.css"; ?>" >
	<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
	<link rel="shortcut icon" href="img/fav.png" />
	<link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	<style>
		.navbar-brand:hover{
			color: #000;
		}
		.navbar-toggler:hover{
			border-color: #000;
		}
		a{
			text-decoration: none;
			cursor: pointer;
			color: #000;
		}
		a:hover{
			color: #000;
		}
		.banner{
			width: auto;
			height: 100%;
			overflow: hidden;
			box-sizing: border-box;
			background-image: url('img/banner-bg.jpg');
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


		/* Footer Divider */
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
			<div class="container">
				<a class="navbar-brand" style="font-size:25px;font-weight:600px;" href="<?php echo base_url();?>"><i class="bx bxs-book" style="color:#27ae60;"></i>BookShop</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"><img src="img/menu.png" class="img-fluid"></span>
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
	</div><br>
     <div class="container-fluid head-img">
          <div class="flex-container">
               <div class="container" style="padding: 3%;">
                    <center><h1 style="font-weight: 700;border-bottom:3px solid #000;width:300px;">Search Books</h1></center>
               </div>
          </div>
     </div><br><br>
     <div class="container" id="rec">
          <div class="col-sm-12">
               <div class="row">
				<div class="col-sm-12" style="display: flex;justify-content:center; ">
					<div class="flex-container row" style="padding: 2%;">
                         <?php
						foreach($sch as $row){
							?>
							<div class="card container col-sm-5" style="margin:10px 15px;padding: 15px 0;">
								<div class="container row">
									<div class="col-sm-4">
										<img src="<?php echo base_url()."uploads/".$row->code.".png";?>" alt="" class="img-fluid">
									</div>
									<div class="col-sm-8">
										<center><h5 class="name" style="font-weight: 550;"><?php echo $row->title; ?></h5>
										<p class="description" style="font-size:13px;font-weight: 500;"><?php echo $row->detail; ?></p>
										<h5><?php echo $row->price; ?></h5>
										<button class="w3-button w3-small w3-blue"><a href="<?php echo base_url()."index.php/Welcome/view_book/".$row->code;?>">View More</a></button></center>
									</div>
								</div>
							</div>
							<?php
						}
                         ?>
                         </div>
                    </div>
               </div>
          </div>
     </div><br><br>
     
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
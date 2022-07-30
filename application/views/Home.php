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
	<link rel="shortcut icon" href="<?php echo base_url()."img/fav.png"?>" />
	<link rel="stylesheet" href="<?php echo base_url()."assets/css/style.css"?>">
	<link rel="stylesheet" href="<?php echo base_url()."assets/css/w3.css"; ?>" >
	<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="<?php echo base_url()."assets/css/swiper-bundle.min.css"?>">
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
			background-image: url('<?php echo base_url()."img/banner-bg.jpg"?>');
		}
		.book-quote{
			width: auto;
			height: 100%;
			overflow: hidden;
			box-sizing: border-box;
			background:#f3f3f3
		}
		.book-quote img{
			width: 100%;
			padding: 5%;
		}
		.carousel-inner{
			width: 100%;
			height: 100%;
			display: flex;
		}
		.carousel-inner img{
			width: 100%;
			height: 100%;
			padding: 0px 10px;
		}
		.container .stand{
			display: flex;
			width: 100%;
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
					<span class="navbar-toggler-icon"><img src="<?php echo base_url()."img/menu.png"?>" class="img-fluid"></span>
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
						<a style="color: black;" class="nav-link" href="#Arrival">Arrivals</a>
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
	<div class="container-fluid">
		<div class="col-sm-12">
			<div class="row banner">
				<div class="col-sm-6">
					<div class="container">
						<h3 style="margin-top: 20%;"><center style="font-weight:700;font-size:50px;">Upto 70% OFF</center></h3>
						<p><center>Buy And Sell Used Books In India. Search And Buy Second Hand Books Near You. Post Free Ad To Sell Old Books In City.</center></p>
						<center><button id='btn-sell' class="w3-button w3-small w3-red"><a href="" style="text-decoration: none;">SELL USED BOOKS</a></button></center>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="container" style="max-width: 25rem;">
						<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
							<div class="carousel-inner">
								<div class="carousel-item active">
									<a href=""><img src="<?php echo base_url()."img/book-1.png"?>" class="d-block w-100" alt="..."></a>
								</div>
								<div class="carousel-item">
									<a href=""><img src="<?php echo base_url()."img/book-2.png"?>" class="d-block w-100" alt="..."></a>
								</div>
								<div class="carousel-item">
									<a href=""><img src="<?php echo base_url()."img/book-3.png"?>" class="d-block w-100" alt="..."></a>
								</div>
							</div>
						</div>
						<div class="container"><img src="<?php echo base_url()."img/stand.png"?>" class="stand" alt=""></div>
					</div>
				</div>
			</div>
		</div>
	</div><br><br>
	<div class="container">
		<div class="col-sm-12">
			<div class="row">
				<div class="col-sm-3">
					<div class="container" style="display: flex;">
						<i class='bx bxs-truck' style="color:#27ae60;font-size:3rem;padding-top:12px;"></i>&nbsp;
						<div class="content" style="padding-left: 5px;">
							<h3 style="font-weight: 550;font-size:20px;">Free shipping</h3>
							<p style="margin-top: -5px;">order over $100</p>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="container" style="display: flex;">
						<i class='bx bxs-lock-alt' style="color:#27ae60;font-size:3rem;padding-top:12px;"></i>&nbsp;
						<div class="content" style="padding-left: 5px;">
							<h3 style="font-weight: 550;font-size:20px;">Secure Payment</h3>
							<p style="margin-top: -5px;">100 secure payment</p>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="container" style="display: flex;">
						<i class='bx bx-revision' style="color:#27ae60;font-size:3rem;padding-top:12px;"></i>&nbsp;
						<div class="content" style="padding-left: 5px;">
							<h3 style="font-weight: 550;font-size:20px;">Easy Returns</h3>
							<p style="margin-top: -5px;">10 Days Returns</p>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="container" style="display: flex;">
						<i class='bx bx-support' style="color:#27ae60;font-size:3rem;padding-top:12px;"></i>&nbsp;
						<div class="content" style="padding-left: 5px;">
							<h3 style="font-weight: 550;font-size:20px;">24/7 Support</h3>
							<p style="margin-top: -5px;">Call Us Anytime</p>
						</div>
					</div>
				</div>
			</div>
		</div><br><br>
	</div>
	<div class="container-fluid">
			<div class="col-sm-12">
				<div class="row book-quote">
					<div class="col-sm-6">
						<div class="container"  style="padding:20%">
							<h2 style="font-weight: 700;">So many books, so little time.</h2>
							<h5 style="font-weight: 550;">- Frank Zappa</h5>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="container">
							<img src="<?php echo base_url()."img/deal-img.jpg"?>" class="img-fluid" >
						</div>
					</div>
				</div>
			</div>
		</div><br><br>
		<div class="container">
			<div class="col-sm-12">
				<div class="row" id="Arrival">
					<div class="col-sm-4"></div>
					<div class="col-sm-4">
						<center><h3 style="font-weight: 700;border:.5px solid darkgrey;padding:5px 0;">New Arrival</h3></center>
					</div>
					<div class="col-sm-4"></div>
				</div><br>
			</div>
		</div>
<!-- =============================== Slider ============================== -->
	<div class="container">
		<div class="slide-container swiper">
			<div class="slide-content">
				<div class="card-wrapper swiper-wrapper">
					<?php
					$email = get_cookie("login");
					$this->db->select('*');
					$this->db->from('book_data');
					if($flag==1){
						$this->db->where('email<>',$email);	
					}
					$this->db->order_by("sn", "desc");
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
						<p class="description"><?php echo $row->category; ?></p>
						<span style="font-size:17px;font-weight: 600;"><?php echo $row->price; ?> &nbsp;<span style="font-size:12px;font-weight: 500;"><s><?php echo $row->mrp; ?></s></span></span>
						<button class="button"><a href="<?php echo base_url()."index.php/Welcome/view_book/".$row->code;?>" style="text-decoration: none;color:#f3f3f3">View More</a></button>
					</div>
					</div>
					<?php
					}
					?>
				</div>
			</div>

			<div class="swiper-button-next swiper-navBtn"></div>
			<div class="swiper-button-prev swiper-navBtn"></div>
			<div class="swiper-pagination"></div>
		</div>
		<!-- Swiper JS -->
		<script src="<?php echo base_url()."assets/js/swiper-bundle.min.js,map"?>"></script>
		<script src="<?php echo base_url()."assets/js/swiper-bundle.min.js"?>"></script>
		<script src="<?php echo base_url()."assets/js/script.js"?>"></script>
	</div>
	<br><br>
	<!-- =============================== Footer ============================== -->
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
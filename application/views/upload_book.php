<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!get_cookie("login") || !$this->session->userdata(get_cookie("login"))){
     redirect(base_url());
}
else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Bookly - find and download free Books</title>

	<link rel="stylesheet" href="<?php echo base_url()."assets/bootstrap.min.css"; ?>">
	<link rel="stylesheet" href="<?php echo base_url()."assets/w3.css"; ?>" >
	<script src="<?php echo base_url()."assets/bootstrap.min.js"; ?>"></script>
	<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
	<link rel="shortcut icon" href="<?php echo base_url()."img/fav.png";?>" />
	<link rel="stylesheet" href="<?php echo base_url()."assets/style.css";?> ">
	<style>
		a{
			text-decoration: none;
			cursor: pointer;
			color: #000;
		}
		.navbar-brand:hover{
			color: #000;
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
	<script>
	</script>
</head>
<body>
	<div class="container-fluid" style="font-size:18px;;font-weight:550">
		<nav class="navbar navbar-expand-lg">
			<div class="container-fluid">
				<a class="navbar-brand" style="font-size:25px;font-weight:600px;" href="<?php echo base_url();?>"><i class="bx bxs-book" style="color:#27ae60;"></i>Bookly</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a style="color: black;" class="nav-link active" aria-current="page" href="<?php echo base_url();?>">Home</a>
					</li>
					<li class="nav-item dropdown">
						<a style="color: black;" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						Books
						</a>
						<ul style="color: black;" class="dropdown-menu" aria-labelledby="navbarDropdown">
						<li><a class="dropdown-item" href="#">Free Books</a></li>
						<li><a class="dropdown-item" href="#">Paid Books</a></li>
						</ul>
					</li>
					<li class="nav-item">
						<a style="color: black;" class="nav-link" href="#Arrival">Arrivals</a>
					</li>
					<li class="nav-item">
						<a style="color: black;" class="nav-link" href="#Featured">Featured</a>
					</li>
					<li class="nav-item">
						<a style="color: black;" class="nav-link" href="#">Carts</a>
					</li>
					<li class="nav-item">
						<a style="color: black;" class="nav-link" href="<?php echo base_url()."index.php/Welcome/profile"; ?>">Profile</a>
					</li>
					</ul>
					<form class="d-flex">
					<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
					<button class="btn btn-outline-success" type="submit">Search</button>
					</form>
				</div>
			</div>
		</nav>
	</div><br><br>
	<div class="container">
          <div class="col-sm-12">
               <div class="row">
                    <div class="col-sm-3"></div>
				<div class="col-sm-6 w3-card">
                         <div class="container">
                              <h4 style="font-weight: 700;">Upload Book</h4><br>
                              <?php echo $error;?>
                              <?php 
                                   $code = $this->uri->segment(3);
                                   echo form_open_multipart(base_url()."index.php/Welcome/do_upload_book/$code");?>
                              <input type="file" name="userfile" size="20" class="form-control"/><br/>
                              <input type="submit" class="w3-button w3-small w3-blue" value="upload" /><br>
                              </form><br>
                         </div>
				</div>
                    <div class="col-sm-3"></div>
			</div>
		</div>
	</div>
	<div class="container-fluid">
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
						<h2 style="font-weight: 700;">Bookly.com</h2>
						<span style="font-weight: 500;">Best Recycle is Book Recycle. Keep Your Books Flowing.</span>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="container">
						<h4 style="font-weight: 550;">Sell Old Books Online</h4>
						<span style="font-weight: 400;font-size:12px;">BookFlow is customer to customer platform like Olx for books. Sell and buy old books in India at zero commission. Click socal media link for 24x7 customer care.</span>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="container">
						<h3>Follow us on:</h3>
						<a href="" style="font-size:25px;color:black;"><i class='bx bxl-facebook-circle'></i></a> &nbsp;
						<a href="" style="font-size:25px;color:black;"><i class='bx bxl-instagram' ></i></a>&nbsp;
						<a href="" style="font-size:25px;color:black;"><i class='bx bxl-twitter' ></i></a>
					</div>
				</div>
				<div class="col-sm-12" style="padding:40px;">
					<center>© Bookly.com <br> All rights reserved and created by Rahul Bhati</center>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<?php
}
?>
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
	<title>BookShop - find and download free Books</title>

	<link rel="shortcut icon" href="<?php echo base_url()."img/fav.png";?>" />
	<link rel="stylesheet" href="<?php echo base_url()."assets/css/w3.css"; ?>" >
	<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

	<style>
		a{
			text-decoration: none;
			cursor: pointer;
			color: #000;
		}
		.navbar-brand:hover{
			color: #000;
		}
          .navbar-toggler:hover{
			border-color: #000;
		}
          .head-img{
               width: 100%;
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
		.flex-container h3{
			font-weight: 700;
			font-size: 20px;
		}
          form .user-details{
               justify-content: space-between;
               margin: 20px 0 12px 0;
          }
          form .user-details .input-box{
               margin-bottom: 15px;
               width: calc(100%  - 20px);
          }
          form .input-box span.details{
               display: block;
               font-weight: 500;
               margin-bottom: 5px;
          }
          .user-details .input-box input{
               height: 45px;
               width: 100%;
               outline: none;
               font-size: 16px;
               border-radius: 5px;
               padding-left: 15px;
               border: 1px solid #ccc;
               border-bottom-width: 2px;
               transition: all 0.3s ease;
          }
          .user-details .input-box textarea{
               height: 45px;
               width: 100%;
               outline: none;
               font-size: 16px;
               border-radius: 5px;
               padding-left: 15px;
               border: 1px solid #ccc;
               border-bottom-width: 2px;
               transition: all 0.3s ease;
               resize: none;
          }
          .user-details .input-box select{
               height: 45px;
               width: 100%;
               outline: none;
               font-size: 16px;
               border-radius: 5px;
               padding-left: 15px;
               border: 1px solid #ccc;
               border-bottom-width: 2px;
               transition: all 0.3s ease;
          }
          .user-details .input-box input:focus,
          .user-details .input-box input:valid{
               border-color: #9b59b6;
          }
          .user-details .input-box select:focus,
          .user-details .input-box select:valid{
               border-color: #9b59b6;
          }

          form .button{
               height: 45px;
               margin: 35px 0
          }
          form .button input{
               height: 100%;
               width: 100%;
               border-radius: 5px;
               border: none;
               color: #fff;
               font-size: 18px;
               font-weight: 500;
               letter-spacing: 1px;
               cursor: pointer;
               transition: all 0.3s ease;
               background: linear-gradient(135deg, #71b7e6, #9b59b6);
          }
          form .button input:hover{
               /* transform: scale(0.99); */
               background: linear-gradient(-135deg, #71b7e6, #9b59b6);
               }
          @media(max-width: 584px){
          .container{
               max-width: 100%;
          }
          form .user-details .input-box{
                    margin-bottom: 15px;
                    width: 100%;
               }
               form .category{
                    width: 100%;
               }
               .content form .user-details{
                    max-height: 300px;
                    overflow-y: scroll;
               }
               .user-details::-webkit-scrollbar{
                    width: 5px;
               }
               }


          @media(max-width: 459px){
               .container .content .category{
                    flex-direction: column;
               }
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
	</div>
     <div class="container-fluid head-img">
          <div class="flex-container">
               <div >
                    <h3>Upload Book Details</h3>
               </div>
          </div>
     </div><br>
     <div class="container">
          <div class="col-sm-12">
               <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6 w3-card-2">
                         <?php
                         if($this->uri->segment(3)=="again"){
                         ?>
                              <h5 class="alert alert-danger" >Try Again !</h5>
                         <?php
                         }else if($this->uri->segment(3)=="empty"){
                         ?>
                              <h5 class="alert alert-warning" >All Fill Field !</h5>
                         <?php
                         }
                         ?>
                    <form action="<?php echo base_url().'index.php/Welcome/submit'; ?>" method="post">
                    <div class="user-details">
                         <div class="input-box">
                              <span class="details">Title</span>
                              <input type="text" name="title" placeholder="Enter Book Title" required>
                         </div>
                         <div class="input-box">
                              <span class="details">Detail</span>
                              <textarea type="text" row="3" name="detail" placeholder="Enter Book Detail" required></textarea>
                         </div>
                         <div class="input-box">
				          <span class="details">Category</span>
                              <select name="category"> 
                                   <option value="Competative Exam">Competative Exam</option>
                                   <option value="Engineering">Engineering</option>
                                   <option value="Medical">Medical</option>
                                   <option value="Magazines">Magazines</option>
                                   <option value="Management Book">Management Book</option>
                                   <option value="School Books">School Books</option>
                                   <option value="Stories">Stories</option>
                              </select> 
			          </div>
                         <div class="input-box">
                              <span class="details">Price (in US Dollar)</span>
                              <input type="text" name="price" placeholder="Enter Book Price" required>
                         </div>
                         <div class="input-box">
                              <span class="details">MRP (in US Dollar)</span>
                              <input type="text" name="mrp" placeholder="Enter Book MRP" required>
                         </div>
                    </div>  
                    <div class="button">
                         <input type="submit" value="Submit">
                    </div>
                    </form>
                    </div>
                    <div class="col-sm-3"></div>
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
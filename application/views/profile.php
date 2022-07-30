<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!get_cookie("login") || !$this->session->userdata(get_cookie("login"))){
     redirect(base_url());
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
		.flex-container center{
			font-weight: 700;
			font-size: 20px;
		}
		.flex-container h4{
			font-size: 15px;
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
		$(document).on("click",".bx.bxs-edit",function(){
			$.post(
				"<?php echo base_url()."index.php/Welcome/edit_user/"; ?>",{},function(data){
					$("#msg").html(data);
				}
			);
		});
		$(document).on("click",".update-user",function(){
			var n = $("#name").val();
			var p = $("#phone").val();
			$.post(
				"<?php echo base_url()."index.php/Welcome/update_user/"; ?>",{n:n,p:p},function(data){
					if(data.trim()=="success"){
						$("#msg").html("<h5 class='alert alert-success' >Profile Edited Successfuly ! <i class='bx bx-x' style='float:right;'></i></h5>");
					}else if(data.trim()=="empty"){
						$("#msg").html("<h5 class='alert alert-warning' >All Field Required ! <i class='bx bx-x' style='float:right;'></i></h5>");
					}
					else{
						$("#msg").html("<h5 class='alert alert-danger' >Try Again ! <i class='bx bx-x' style='float:right;'></i></h5>");
						//location.reload(false);
					}
				}
			);
		});
		$(document).on("click",".cng_pass",function(){
			$.post(
				"<?php echo base_url()."index.php/Welcome/edit_pass/"; ?>",{},function(data){
					$("#msg").html(data);
				}
			);
		});
		$(document).on("click",".update-pass",function(){
			var cp = $("#cp").val();
			var np = $("#np").val();
			var rp = $("#rp").val();
			//alert(cp+" "+np+" "+rp);
			$.post(
				"<?php echo base_url()."index.php/Welcome/update_pass/"; ?>",{cp:cp,np:np,rp:rp},function(data){
					if(data.trim()=="success"){
						$("#msg").html("<h5 class='alert alert-success' >Password Changed ! <i class='bx bx-x' style='float:right;'></i></h5>");
					}else if(data.trim()=="empty"){
						$("#msg").html("<h5 class='alert alert-warning' >All Field Required ! <i class='bx bx-x' style='float:right;'></i></h5>");
					}
					else{
						$("#msg").html("<h5 class='alert alert-danger' >Try Again ! <i class='bx bx-x' style='float:right;'></i></h5>");
						//location.reload(false);
					}
				}
			);
		});
		$(document).on("click",".bx.bx-x",function(){
			$("#msg").hide(500);
		});
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
	</div><br>
     <div class="container">
          <div class="col-sm-12">
               <div class="row w3-card">
                    <div class="col-sm-2">
                         <div class="container">
                              <img src="<?php echo base_url()."img/fav.png" ?>" class="img-fluid" style="padding: 5px 0;"/>
                         </div>
                    </div>
                    <div class="col-sm-4">
                         <?php 
                              $email = get_cookie("login");
                              $this->db->select('*');
                              $this->db->from('user');
                              $this->db->where("email",$email);
                              foreach($this->db->get()->result() as $row){
                                   ?>
                                   <h4 style="font-weight: 550;font-size:1.5rem;"><?php echo $row->name; ?></h4>
                                   <h4 style="font-weight: 550;font-size:1.3rem;"><?php echo $row->email; ?></h4><br>
							<span style="font-weight:500;font-size:1rem;"><i class='bx bxs-user'></i> Profile</span> | 
							<span style="font-weight:500;font-size:1rem;"><i class='bx bxs-edit'>&nbsp;Edit Profile</i></span> |
							<span style="font-weight:500;font-size:1rem;"><i class='bx bxs-key cng_pass'>&nbsp;Change Password</i></span>
                                   <?php
                              }
                         ?>
                    </div>
                    <div class="col-sm-6">
					<div class="flex-container">
						<div style="background-color:burlywood;"><center>0</center><h4>Total Book Buy</h4></div>
						<?php
							$this->db->select('*');
							$this->db->from('book_data');
							$this->db->where("email",$email);
							$rec = $this->db->get()->result();
						?>
						<div style="background-color:#1abc9c;"><center><?php echo sizeof($rec)?></center><h4>Total Book Upload</h4></div>
						<div class="w3-red">
							<button class="w3-button" >
								<a href="<?php echo base_url()."index.php/Welcome/upload_data"?>" style="color:#000">
									<center><i class='bx bx-upload' ></i></center>
									<h4> Upload Book</h4>
								</a>
							</button>
						</div>
					</div>
				</div>
               </div>
          </div>
     </div><br><br>
	<div class="container">
		<div class="col-sm-12" id="msg">
			<?php
				if($this->uri->segment(4)=="book_delete"){
				?>
					<h5 class="alert alert-primary" >Book Deleted Successfully !</h5>
				<?php
				}else if($this->uri->segment(4)=="book_delete_fail"){
				?>
					<h5 class="alert alert-warning" >Book not Deleted. Try Again !</h5>
				<?php
				}else if($this->uri->segment(4)=="book_data_updated"){
				?>
					<h5 class="alert alert-success" >Book Updated Successfully !</h5>
				<?php
				}else if($this->uri->segment(4)=="booksuccess"){
				?>
					<h5 class="alert alert-success" >Book Uploaded Successfully !</h5>
				<?php
				}else if($this->uri->segment(4)=="book_img_update"){
				?>
					<h5 class="alert alert-success" >Book Image Updated Successfully !</h5>
				<?php
				}
			?>
		</div><br>
          <div class="col-sm-12"  id="rec">
               <div class="row w3-card">
				<div class="col-sm-12">
					<h4 style="font-weight: 700;"><center>Your All Book</center></h4>
				</div><br>
				<div class="col-sm-12" style="display: flex;justify-content:center; ">
					<div class="flex-container row" style="padding: 2%;">
					<?php
					$page=0;
					$email = get_cookie("login");
					$this->db->select('*');
					$this->db->from('book_data');
					$this->db->where("email",$email);
					$this->db->limit(10,$start);
					$query = $this->db->get();
					$count = sizeof($query->result());
					$book = 0;
					foreach($query->result() as $row){
						$page++;
						$book = 1;
					?>
					<div class="card container col-sm-5" style="margin:10px 15px;padding: 15px 0;">
						<div class="container-fluid row">
							<div class="col-sm-5">
								<img src="<?php echo base_url()."uploads/".$row->code.".png";?>" alt="" class="img-fluid">
							</div>
							<div class="col-sm-7">
								<center><h5 class="name" style="font-weight: 550;"><?php echo $row->title; ?></h5>
								<p class="description" style="font-size:13px;font-weight: 500;"><?php echo $row->detail; ?></p>
								<h5><?php echo $row->price; ?> &nbsp;<span style="font-size:12px;font-weight: 500;"><s><?php echo $row->mrp; ?></s></span></h5>
								<div class="container-fluid" style="display: flex;width:auto">
									<button class="w3-button w3-small w3-yellow" style="margin-top: 10px;">
										<a style="font-size:10px;" href="<?php echo base_url()."index.php/Welcome/Edit_img_data/".$row->code;?>" ><i class='bx bx-edit' style="font-size:13px;"> Edit</i></a>
									</button>&nbsp;
									<button class="w3-button w3-small w3-red" style="margin-top: 10px;">
										<a style="font-size:10px;" href="<?php echo base_url()."index.php/Welcome/delete_img_data/".$row->code;?>"><i class='bx bx-trash' style="font-size:13px;color: white;"> Delete</i></a>
									</button>
								</div>
							</div>
						</div>
					</div>
					<?php
					}
					if($book==0){
						?>
						<p>no book upladed till now.</p>
						<?php
					}
					if($page==0 && $id>0){
						redirect(base_url()."index.php/Welcome/profile");
					}
					?>
					</div><br>
				</div>
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
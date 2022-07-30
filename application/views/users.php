<?php 
	if(!get_cookie('user') || !$this->session->userdata(get_cookie("user"))){
		redirect(base_url()."index.php/Admin/index/");
	}
	else{
          $email = get_cookie('user');
?>

<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="utf-8" />
     <meta http-equiv="X-UA-Compatible" content="IE=edge" />
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
     <meta name="description" content="" />
     <meta name="author" content="" />
     <title>BookShop</title>
     <link rel="shortcut icon" href="<?php echo base_url()."img/fav.png"?>" />
     <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
     <link href="<?php echo base_url()."assets/css/styles.css";?>" rel="stylesheet" />
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
     <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

</head>
<body class="sb-nav-fixed">
     <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
          <!-- Navbar Brand-->
          <a class="navbar-brand ps-3" href="dashboard.php">My Music</a>
          <!-- Sidebar Toggle-->
          <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class='bx bx-menu'></i></i></button>
     </nav>
     <div id="layoutSidenav">
          <div id="layoutSidenav_nav">
               <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
               <div class="sb-sidenav-menu">
                    <div class="nav">
                         <div class="sb-sidenav-menu-heading">Core</div>
                         <a class="nav-link" href="<?php echo base_url()."index.php/Admin/Dashboard"?>">
                              <div class="sb-nav-link-icon"><i class='bx bx-tachometer'></i></div>
                              Dashboard
                         </a>
                         <a class="nav-link" href="<?php echo base_url()."index.php/Admin/books"?>">
                              <div class="sb-nav-link-icon"><i class='bx bx-book' ></i></div>
                              Books
                         </a>
                         <a class="nav-link" href="<?php echo base_url()."index.php/Admin/users"?>">
                              <div class="sb-nav-link-icon"><i class='bx bx-user' ></i></div>
                              Users
                         </a>
                         <div class="sb-sidenav-menu-heading">Interface</div>
                         <a class="nav-link" href="<?php echo base_url()."index.php/Admin/Logout"?>"><i class='bx bx-log-out-circle' ></i>&nbsp;Logout</a>
                    </div>
               </div>
               <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <?php echo $email; ?>
               </div>
               </nav>
          </div>
          <div id="layoutSidenav_content">
               <main id="record">
                    <span id="store" prel="" pid="" prec="0"></span>
               <div class="container-fluid px-4">
                    <h1 class="mt-4" style="font-weight: 700;">All Users</h1>
                    <ol class="breadcrumb mb-4">
                         <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    <div class="col-sm-12" id="msg"></div><br><br>
                    <div class="container" id="rec">
                         <div class="col-sm-12 card">     
                         <?php
                              $email = get_cookie('user');
                              $this->db->select('*');
                              $this->db->from('user');
                              $this->db->where('email!=',$email);
                              $query = $this->db->get()->result();
                              foreach($query as $row){
                              ?>
                              <div class="row" style="padding: 10px;" id="d-<?php echo $row->email?>">
                                   <div class="col-sm-3"><?php echo $row->name?></div>
                                   <div class="col-sm-3"><?php echo $row->email?></div>
                                   <div class="col-sm-3">
                                        <?php
                                             if($row->status==0){
                                        ?>
                                        <button class="w3-button w3-yellow w3-small"> 
                                             <i  id="<?php echo $row->email?>" class='bx bx-block' rel="<?php echo $row->email?>"> Block</i>
                                        </button>
                                        <?php
                                             }else{
                                             ?>
                                        <button class="w3-button w3-yellow w3-small"> 
                                             <i  id="<?php echo $row->email?>" class='bx bx-block'  rel="<?php echo $row->email?>"> Unblock</i>
                                        </button>
                                             <?php
                                             }
                                        ?>          
                                   </div>
                                   <div class="col-sm-3"><button class="w3-button w3-red w3-small" rel="<?php echo $row->email?>"> Delete</button></div>
                              </div>
                              <?php
                              }
                         ?>     
                         <script>
                              $(document).on("click",".w3-red",function(){
                                   var e = $(this).attr("rel");
                                   $.post(
                                        "<?php echo base_url()."index.php/Admin/user_delete"?>",{e:e},function(data){
                                             if(data.trim()=="success"){
                                                  $("#msg").html("<h5 class='alert alert-success' >User Deleted Successfully ! <i class='bx bx-x' style='float:right;'></i></h5>");
                                                  $("#d-"+e).fadeOut(1000);
                                             }else{
                                                  $("#msg").html("<h5 class='alert alert-danger' >Try Again ! <i class='bx bx-x' style='float:right;'></i></h5>");
                                                  //location.reload(false);
                                             }
                                        }
                                   );
                              });
                              $(document).on("click",".bx-block",function(){
                                   var e = $(this).attr("rel");
                                   $.post(
                                        "<?php echo base_url()."index.php/Admin/user_block"?>",{e:e},function(data){
                                             if(data.trim()=="block"){
                                                  $("#msg").html("<h5 class='alert alert-success' >User Blocked Successfully ! <i class='bx bx-x' style='float:right;'></i></h5>");
                                             }else if(data.trim()=="unblock"){
                                                  $("#msg").html("<h5 class='alert alert-success' >User Unblocked Successfully ! <i class='bx bx-x' style='float:right;'></i></h5>");
                                             }else  if(data.trim()=="again"){
                                                  $("#msg").html("<h5 class='alert alert-danger' >Try Again ! <i class='bx bx-x' style='float:right;'></i></h5>");
                                             }
                                             setInterval(function(){
                                                  location.reload(true);
                                             },1000);
                                             //$("#msg").html(data);
                                        }
                                   );
                              });
 
                              $(document).on("click",".bx.bx-x",function(){
                                   $("#msg").hide(500);
                              });
                         </script>
                         </div>
                    </div>
               </div>
               </main>
               <footer class="py-4 bg-light mt-auto">
               <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                         <div class="text-muted">Copyright &copy; Your Website 2021</div>
                         <div>
                              <a href="#">Privacy Policy</a>
                              &middot;
                              <a href="#">Terms &amp; Conditions</a>
                         </div>
                    </div>
               </div>
               </footer>
          </div>
     </div>
     <script src="<?php echo base_url()."assets/js/scripts.js";?>"></script>
     <script src="<?php echo base_url()."assets/js/datatables-simple-demo.js";?>"></script>
</body>
</html>
<?php
	}
?>
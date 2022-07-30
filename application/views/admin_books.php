<?php 
	if(!get_cookie('user') || !$this->session->userdata(get_cookie("user"))){
		redirect(base_url()."index.php/Admin/index/");
	}
	else{
          $email = get_cookie('user');
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
                    <h1 class="mt-4" style="font-weight: 700;">All Books</h1>
                    <ol class="breadcrumb mb-4">
                         <li class="breadcrumb-item active">Dashboard</li>
                    </ol><br><br>
                    <div class="col-sm-12" id="msg">
                          <?php
                              if($this->uri->segment('4')=="book_delete"){
                                   ?>
                                   <h5 class='alert alert-success' >Book Deleted Successfully !</h5>
                                   <?php
                              }
                              else if($this->uri->segment('4')=="again"){
                                   ?>
                                   <h5 class='alert alert-danger' >Try Again !</h5>
                                   <?php
                              }
                         ?>
                    </div>
                    <div class="container" id="rec">
                         <div class="col-sm-12">
                              <div class="row">
                                   <div class="col-sm-12" style="display: flex;justify-content:center; ">
                                        <div class="flex-container row" style="padding: 2%;">
                                        <?php
                                        $page=0;
                                        $email = get_cookie('user');
                                        $this->db->select('*');
                                        $this->db->from('book_data');
                                        $this->db->where('email!=',$email);
                                        $this->db->limit(10,$start);
                                        $query = $this->db->get()->result();
                                        $count = sizeof($query);
                                        foreach($query as $row){
                                             $page++;
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
                                                       <button class="w3-button w3-small w3-blue"><a href="<?php echo base_url()."index.php/Admin/book_delete/".$row->code;?>">Delete</a></button></center>
                                                  </div>
                                             </div>
                                        </div>
                                        <?php
                                        }
                                        if($page==0){
                                             redirect(base_url()."index.php/Admin/books");
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
                                        <div class="prev"><a href="<?php echo base_url()."index.php/Admin/books/".$prev;?>"><i class='bx bx-chevrons-left'></i> Prev Page</a></div> 
                                        <?php
                                             }
                                             $next = $id+1;
                                        ?>
                                        <?php
                                             if($count>=10){
                                        ?>
                                        <div class="next" style="display:inline;"><a href="<?php echo base_url()."index.php/Admin/books/".$next;?>">Next Page <i class='bx bx-chevrons-right'></i></a></div>
                                        <?php
                                        }
                                        ?>	
                                   </div>
                                   <div class="col-sm-4"></div>
                              </div>
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
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
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                         <li class="breadcrumb-item active">Dashboard</li>
                    </ol><br><br>
                    <div class="col-sm-12" id="msg"></div>
                    <div class="col-sm-12">
                         <div class="card text-white bg-primary mb-3">
                              <div class="card-header">Category</div>
                              <div class="card-body">
                                   <div id="cat">	
                                        <label class="form-label">Add Category</label>
                                        <input class="form-control"  type="text" id="category" placeholder="category name" /><br>
                                        <button value="add" class="btn btn-success">Add</button>
                                   </div>
                                   <script>
                                        $(document).on("click",".btn.btn-success",function(){
                                             var cat = $("#category").val() ;
                                             $.post(
                                                  "<?php echo base_url()."index.php/Admin/add_category"?>",{cat:cat},function(data){
                                                       if(data.trim()=="success"){
                                                            $("#msg").html("<h5 class='alert alert-success' >Category Added ! <i class='bx bx-x' style='float:right;'></i></h5>");
                                                       }else if(data.trim()=="empty"){
                                                            $("#msg").html("<h5 class='alert alert-warning' >All Field Required ! <i class='bx bx-x' style='float:right;'></i></h5>");
                                                       }else if(data.trim()=="already"){
                                                            $("#msg").html("<h5 class='alert alert-warning' >Category Already exict ! <i class='bx bx-x' style='float:right;'></i></h5>");
                                                       }else{
                                                            $("#msg").html("<h5 class='alert alert-danger' >Try Again ! <i class='bx bx-x' style='float:right;'></i></h5>");
                                                            //location.reload(false);
                                                       }
                                                       $("#category").val("");
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
               </div>
               <div class="row" >
               <div class="col-sm-12">
                    <div class="container-fluid px-4">
                         <div id="cat-msg" class="col-sm-12"></div>
                         <center>
                              <h2 style="width:200px;font-family:serif;font-weight: 700;border:2px solid black;padding:5px;">
                                   <center>All Category</center>
                              </h2>
                         </center><br>
                         <div class="row">
                         <script>
                             
                         </script>
                              <table class="table table-borderless">
                         <?php
                              $this->db->select('*');
                              $this->db->from('category');
                              foreach($this->db->get()->result() as $row){
                                   ?>
                                        <tr id="d-<?php echo $row->code?>">
                                             <td><h4 id="c-<?php echo $row->code?>" style="font-weight: 550;" ><?php echo $row->cat_name?></h4></td>
                                             <td>
                                                  <button class="w3-button w3-blue">
                                                       <i id="class-<?php echo $row->code?>" rel="<?php echo $row->code?>" class='bx bx-edit' style="font-weight: 550;color:white;"> Edit</i>
                                                  </button>
                                             </td>
                                             <td>
                                                  <button class="w3-button w3-red" id="<?php echo $row->code?>">
                                                       <i class='bx bx-trash' style="font-weight: 550;color:white;"> Delete</i>
                                                  </button>
                                             </td>
                                        </tr>
                                   <?php
                              }
                         ?>    
                              </table>
                              <script>
                                   $(document).on("click",".bx-edit",function(){
                                        var code = $(this).attr("rel") ;
                                        var val = $("#c-"+code).text();
                                        $("#c-"+code).html("<input type='text' value='"+val+"' id='val-"+code+"' class='form-control'>");
                                        $("#class-"+code).attr("class","bx bx-save");
                                        $("#class-"+code).text(" Save");
                                   });
                                   $(document).on("click",".bx-save",function(){
                                        var code = $(this).attr("rel") ;
                                        var val = $("#val-"+code).val();
                                        $.post(
                                             "<?php echo base_url()."index.php/Admin/edit_category"?>",{code:code,val:val},function(data){
                                                  if(data.trim()=="success"){
                                                       $("#cat-msg").html("<h5 class='alert alert-success' >Category Updated ! <i class='bx bx-x' style='float:right;'></i></h5>");
                                                  }else if(data.trim()=="empty"){
                                                       $("#cat-msg").html("<h5 class='alert alert-warning' >All Field Required ! <i class='bx bx-x' style='float:right;'></i></h5>");
                                                  }else if(data.trim()=="already"){
                                                       $("#cat-msg").html("<h5 class='alert alert-warning' >Category Already exict ! <i class='bx bx-x' style='float:right;'></i></h5>");
                                                  }
                                                  else if(data.trim()=="again"){
                                                       $("#cat-msg").html("<h5 class='alert alert-danger' >Try Again ! <i class='bx bx-x' style='float:right;'></i></h5>");
                                                  }
                                                  $("#c-"+code).text(val);
                                                  $("#class-"+code).attr("class","bx bx-edit");
                                                  $("#class-"+code).text(" Edit");
                                                  //$("#cat-msg").html(data);
                                             }
                                        );
                                   });
                                   $(document).on("click",".w3-red",function(){
                                        var code = $(this).attr("id") ;
                                        $.post(
                                             "<?php echo base_url()."index.php/Admin/delete_category"?>",{code:code},function(data){
                                                  if(data.trim()=="success"){
                                                       $("#cat-msg").html("<h5 class='alert alert-success' >Category Deleted ! <i class='bx bx-x' style='float:right;'></i></h5>");
                                                  }else if(data.trim()=="again"){
                                                       $("#cat-msg").html("<h5 class='alert alert-danger' >Try Again ! <i class='bx bx-x' style='float:right;'></i></h5>");
                                                  }
                                                  $("#d-"+code).fadeOut(500) ;
                                                  //$("#cat-msg").html(data);
                                             }
                                        );
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
<?php 
	if(get_cookie('user')){
		redirect(base_url()."index.php/Admin/Dashboard/");
	}
	else{
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - SB Admin</title>
        <link href="<?php echo base_url()."assets/css/styles.css";?>" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Admin Panel</h3></div>
                                    <div class="card-body">
								<div class="container-fluid" id="msg">
                                        <?php
                                             if($this->uri->segment(3)=="inc_pass"){
                                             ?>
                                                  <h5 class="alert alert-danger" >Password not matched !</h5>
                                             <?php
                                             }else if($this->uri->segment(3)=="inc_email"){
                                             ?>
                                                  <h5 class="alert alert-danger" >Email not matched !</h5>
                                             <?php
                                             }else if($this->uri->segment(3)=="empty"){
                                             ?>
                                                  <h5 class="alert alert-warning" >All Field Required !</h5>
                                             <?php
                                             }else if($this->uri->segment(3)=="logout"){
                                             ?>
                                                  <h5 class="alert alert-warning" >You Are Logout Successfully !</h5>
                                             <?php
                                             }
                                             ?>
								</div>
                                        <form method="post" action="<?php echo base_url().'index.php/Admin/check'; ?>">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" type="email" name="email" placeholder="name@example.com" />
                                                <label for="inputEmail">Email address</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" type="password" name="pass" placeholder="Password" />
                                                <label for="inputPassword">Password</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a ><input type="submit" value="Login" class="btn btn-primary"></a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url()."js/scripts.js";?>"></script>
    </body>
</html>
<?php
	}
?>
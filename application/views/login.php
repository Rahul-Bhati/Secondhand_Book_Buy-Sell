<style>
.title > a {
     width: 100px;
     height: 40px;
     text-align: center;
     font-size: 25px;
     text-decoration: none;
}
</style>
<div class="title">Login 
     <a href="<?php echo base_url()."index.php/Welcome/signIn" ;?>" style="float: right;"><button class="btn btn-info" >Back</button></a>
     <a href="<?php echo base_url()?>"  style="float: right;"><button class="btn btn-info" >Home</button></a>
</div>
<div class="content">
     <form action="<?php echo base_url().'index.php/Welcome/check'; ?>" method="post">
          <div class="user-details">
          <div class="input-box">
               <span class="details">Email</span>
               <input type="text" name="email" placeholder="Enter your email" required>
          </div>
          <div class="input-box">
               <span class="details">Password</span>
               <input type="password" name="pass" placeholder="Enter your password" required>
          </div>
          <div class="button" style="display: flex;">
               <input type="submit" class="btn btn-info" value="Login">
          </div>
     </form>
</div>
<style>
		
          .user-details{
               justify-content: space-between;
               margin: 20px 0 12px 0;
          }
          .user-details .input-box{
               margin-bottom: 15px;
               width: calc(100%  - 20px);
          }
          .input-box span.details{
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
          .button{
               height: 45px;
               margin: 35px 0
          }
          .button input{
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
          .button input:hover{
               /* transform: scale(0.99); */
               background: linear-gradient(-135deg, #71b7e6, #9b59b6);
               }
          @media(max-width: 584px){
               .container{
                    max-width: 100%;
               }
               .user-details .input-box{
                    margin-bottom: 15px;
                    width: 100%;
               }
               .category{
                    width: 100%;
               }
               .user-details{
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
		
	</style>
     <div class="row">
          <?php
               $email = get_cookie('login');
               $this->db->select('*');
               $this->db->from('user');
               $this->db->where('email',$email);
               foreach($this->db->get()->result() as $row){
          ?>
          <div class="col-sm-3"></div>
          <div class="col-sm-6 w3-card-4">
               <div class="user-details">
                    <div class="input-box">
                         <span class="details">Username</span>
                         <input type="text" id="name" value="<?php echo $row->name; ?>" required>
                    </div>
                    <div class="input-box">
                         <span class="details">Phone</span>
                         <input type="text" id="phone" value="<?php echo $row->phone; ?>" required>
                    </div>
               </div>  
               <div class="button">
                    <input type="submit" class="update-user" value="Update">
               </div>
          </div>
          <?php 
               }
           ?>
          <div class="col-sm-3"></div>
     </div>
          

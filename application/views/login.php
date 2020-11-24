<html>
    <head>
        <title>Login</title>
        
        
        <link rel="stylesheet" href="<?php echo base_url();?>css/style.css">
    </head>
    
    <body>
        
        
        <div id="wrapper">
            
            <div id="header">
                
                <h2 align="center">Welcome to PHIS Tuck Shop</h2>
            </div>
            
            <div class="clr"></div>
            
            <div id="container">
                
                <div class="content_left"></div>
                
                <div class="content">

                    
<form action="<?php echo base_url();?>admin_login/check_administrator" method="post" onsubmit="return validateStandard(this)">
    <h4 style="margin-left: 200px">Welcome to Store </br> Please Enter your Email and Password</h4>
    
    <div style="margin-left: 200px; color: red;">
            <?php
            $exception=$this->session->userdata('exception');
            if(isset($exception))
            {
                echo $exception;
                $this->session->unset_userdata('exception');
            }
            
            ?>
    </div>
    <div style="margin-left: 200px; color: green;">
            <?php
            $message=$this->session->userdata('message');
            if(isset($message))
            {
                echo $message;
                $this->session->unset_userdata('message');
            }
            
            ?>
    </div>
    
    
    
    <table cellspacing="10px" align="center">
        <tr>
            <td>Email Address</td>
            <td>
                <input type="email" name="admin_email_address" required="1" err="Enter email address" size="38"><span class="required">*</span>
            </td>
        </tr>
        
        <tr>
            <td>Password</td>
            <td>
                <input type="password" name="admin_password" required="1" err="Enter Password" size="38"><span class="required">*</span>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <input type="submit" name="btn" value="Login">
            </td>
        </tr>
    </table>
</form> 
                </div>
                
                <div class="content_right"></div>
                
                
                
            </div>
            
             <div class="clr"  > </div>
            <div id="footer" >
                
                <p style="float: left; padding-left: 20px"> All copyright reserved by PHIS</p>

                <p style="float: right; text-align: left; padding-right: 20px;">Developed by VTG</p>

            </div>
            
            
            
            
            
            
        </div>
        
        
        
    </body>
</html>
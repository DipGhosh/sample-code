<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url().admin_css;?>bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url().admin_css;?>sb-admin.css" rel="stylesheet">



    <!-- Custom Fonts -->
    <link href="<?php echo base_url().public_folder.admin;?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="wrapper">

        <div class = "container">
            <div class="liginLogo"><img src="<?php echo base_url().admin_images;?>logo_horizontal-1.png" alt="" width="250" ></div>
            <?php 
            $attributes = array('class' => 'form-signin', 'id' => 'myform');
            echo form_open('admin/login', $attributes);
            ?>
				       
					<h3 class="form-signin-heading">Welcome Back! Please Sign In</h3>
					  <hr class="colorgraph"><br>

					  <input type="text" class="form-control" name="username" placeholder="Username" required="" autofocus />
					  <input type="password" class="form-control" name="password" placeholder="Password" required=""/>     		  

					  <button class="btn btn-lg btn-primary btn-block"  name="Submit" value="Login" type="Submit">Login</button>  			
				</form>			
		</div>

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="<?php echo base_url().admin_js;?>jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url().admin_js;?>bootstrap.min.js"></script>

    
    

</body>

</html>

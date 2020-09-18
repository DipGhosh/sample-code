<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin</title>

   <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet"> 
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url().admin_css;?>bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url().admin_css;?>animate.css">
	<link rel="stylesheet" href="<?php echo base_url().admin_css;?>bootstrap-table.css">

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

<script language = "javascript" type ="text/javascript">
  function  lanfTrans ( lan )
 {
 	alert();
   switch ( lan )
   {
   case 'en': document.getElementById ( 'dlang').value = 'en' ; document.langForm.submit ( ); break;
   
   case 'de' : document.getElementById ( 'dlang').value = 'de'; document.langForm.submit ( ); break;
   }
 }
</script >
</head>

<body>

<div class="wrapper">
	<!-- Sidebar Holder -->
	<nav id="sidebar">
		<div class="sidebar-header">
			<a href="<?php echo base_url().admin;?>dashboard"><h3><img src="<?php echo base_url().admin_images;?>logo_horizontal-1.png" alt="" width="200" ></h3>
			<strong><img src="<?php echo base_url().admin_images;?>logo.png" alt="" width="50" height="50"></strong></a>
		</div>

		<ul class="list-unstyled components">
			<div class="user-panel">
			   <div class="image"><img src="<?php echo base_url().admin_images;?>avatar2.png" alt="User Image" class="img-circle"></div> 
			   <div class="info">
			   <p>Hi Admin</p> <p><!-- <small>You haven,t miss any task this week!</small> --></p> 
			   <div>
			  <!--  <a href="#"><i class="fa fa-cogs" aria-hidden="true"></i><small>Settings</small></a> 
			   <a href="#"><i class="fa fa-user-o" aria-hidden="true"></i><small>Profile</small></a>  -->
			   <a href="<?php echo base_url().admin;?>login/logout"><i class="fa fa-sign-out" aria-hidden="true"></i><small><?php echo $this->lang->line('logout');?></small></a></div>
			   </div>
				<img src="<?php echo base_url().admin_images;?>avatar-bg.png" alt="User Image" class="bg-user">
			   </div>
			<li 

			<?php if($this->uri->segment(2) == 'dashboard'){
				echo 'class="active"';
			}?> >
				<a href="<?php echo base_url().admin;?>dashboard">
					<i class="fa fa-fw fa-dashboard"></i> <?php echo $this->lang->line('dashboard');?>
				</a>
			</li>
			<li <?php if($this->uri->segment(2) == 'category'){
				echo 'class="active"';
			}?> >
				<a href="<?php echo base_url().admin;?>category"><i class="fa fa-cubes" aria-hidden="true"></i><?php echo $this->lang->line('categories');?></a>
			</li>
			<li <?php if($this->uri->segment(2) == 'details'){
				echo 'class="active"';
			}?> >
				<a href="<?php echo base_url().admin;?>details"><i class="fa fa-file-text" aria-hidden="true"></i> <?php echo $this->lang->line('details');?></a>
			</li>

			<li <?php if($this->uri->segment(2) == 'users'){
				echo 'class="active"';
			}?> >
				<a href="<?php echo base_url().admin;?>users"><i class="fa fa-user" aria-hidden="true"></i> <?php echo $this->lang->line('users');?></a>
			</li>

			<li <?php if($this->uri->segment(2) == 'question'){
				echo 'class="active"';
						}?>>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-question-circle" aria-hidden="true"></i> <?php echo $this->lang->line('question');?> <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="<?php echo base_url().admin;?>question"><?php echo $this->lang->line('question_list');?></a>
                            </li>
                            <li>
                                <a href="<?php echo base_url().admin;?>question/add"><?php echo $this->lang->line('add_question');?></a>
                            </li>
                        </ul>
                    </li>
			
				
				<li <?php if($this->uri->segment(2) == 'cms'){
				echo 'class="active"';
						}?>>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo1"><i class="fa fa-columns" aria-hidden="true"></i> CMS <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo1" class="collapse">
                            <li>
                                <a href="<?php echo base_url().admin;?>cms"><?php echo $this->lang->line('cms');?></a>
                            </li>
                            <li>
                                <a href="<?php echo base_url().admin;?>cms/add"><?php echo $this->lang->line('add_cms');?></a>
                            </li>
                        </ul>
                    </li>

			

				<li <?php if($this->uri->segment(2) == 'banner'){
				echo 'class="active"';
						}?>>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo2"><i class="fa fa-fw fa-arrows-v"></i> Banner <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo2" class="collapse">
                            <li>
                                <a href="<?php echo base_url().admin;?>banner"><?php echo $this->lang->line('banner');?></a>
                            </li>
                            <li>
                                <a href="<?php echo base_url().admin;?>banner/add">
                                <?php echo $this->lang->line('add_banner');?>	
                                </a>
                            </li>
                        </ul>
                    </li>


                    <li <?php if($this->uri->segment(2) == 'review'){
						echo 'class="active"';
					}?> >
						<a href="<?php echo base_url().admin;?>review"><i class="fa fa-star-half-o" aria-hidden="true"></i><?php echo $this->lang->line('review');?> </a>
					</li>

					<li <?php if($this->uri->segment(2) == 'certificate'){
						echo 'class="active"';
					}?> >
						<a href="<?php echo base_url().admin;?>certificate"><i class="fa fa-certificate" aria-hidden="true"></i><?php echo $this->lang->line('certificate');?></a>
					</li>

			<!-- <li>
				<a href="tables.html"><i class="fa fa-fw fa-bar-chart-o"></i> Reports</a>
			</li> -->
			
		</ul>

		
	</nav>

	<!-- Page Content Holder -->
	<div id="content">

		<nav class="navbar navbar-default wow fadeInDown">
			<div class="container-fluid">

				<div class="navbar-header">
					<button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
						<i class="glyphicon glyphicon-align-left"></i>
						<!--<span>Toggle Sidebar</span>-->
					</button>
				</div>

				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-right top-nav">
					<li class="dropdown">

						<select onchange="javascript:window.location.href='<?php echo base_url(); ?>admin/LanguageSwitcher/switchLang/'+this.value;">
						    <option value="english" <?php if($this->session->userdata('site_lang') == 'english') echo 'selected="selected"'; ?>>English</option>
						   
						    <option value="german" <?php if($this->session->userdata('site_lang') == 'german') echo 'selected="selected"'; ?>>German</option>   
						</select>
						

						<?php 
						/*
						echo $this->session-> userdata( 'language');
						echo google_translate("This b a hasa in Eng s he became ..?",$this->session-> userdata( 'language') , "id", "text");
						?>
						<!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a> -->
						<?php 
							echo form_open ( 'admin/dashboard/languages' , array ( 'name' => 'langForm', 'id' => 
								'langForm'));
						?>
							<input type = "hidden" name = "dlang" id = "dlang">
							<input type = "hidden" name = "current" id = "current" value = "<?php echo uri_string();?>">

							
							<img src = "<?php echo  base_url();?>images/en.png" 
							onClick ="lanfTrans('en');" width = "16" height = "11" title = "English">&nbsp;
							<img src = "<?php echo  base_url();?>images/es_flag.gif" onClick = "lanfTrans ('de');" width = "16" height = "11" title = "German "> &nbsp;
						<?php
							echo form_close ();*/
						?>
					
					</li>

					<!-- <li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
						<ul class="dropdown-menu alert-dropdown">
							<li>
								<a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
							</li>
							<li>
								<a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>
							</li>
							<li>
								<a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>
							</li>
							<li>
								<a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>
							</li>
							<li>
								<a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>
							</li>
							<li>
								<a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="#">View All</a>
							</li>
						</ul>
					</li> -->

				</ul>
				</div>
			</div>
		</nav>
		

		<?php echo $content;?>
		
	</div>
</div>
    
    <div class="loader"></div>

    <!-- jQuery -->
    <script src="<?php echo base_url().admin_js;?>jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url().admin_js;?>bootstrap.min.js"></script>
     <script src="<?php echo base_url().admin_js;?>jquery.raty.min.js"></script>



    <script src="<?php echo base_url().admin_js;?>wow.js"></script>
     <script src="<?php echo base_url().admin_js;?>bootstrap-table.js"></script>
      <script src="<?php echo base_url().admin_js;?>bootstrap-table-filter-control.js"></script>
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <!-- Morris Charts JavaScript -->
    
    <!-- Flot Charts JavaScript -->
    <!--[if lte IE 8]><script src="js/excanvas.min.js"></script><![endif]-->
    
    <script type="text/javascript">
             $(document).ready(function () {



             	$( "#frmaddcat" ).validate();
             	$( "#frmaddEdit" ).validate();

             	$( "#addDetail" ).validate({

					    rules: {
					    certificate_month: {
					      require_from_group: [1, ".month-group"]
					    },
					    certificate_year: {
					      require_from_group: [1, ".month-group"]
					    }
					  }

             	});
             	$( "#editDetail" ).validate({
             		rules: {
					    certificate_month: {
					      require_from_group: [1, ".month-group"]
					    },
					    certificate_year: {
					      require_from_group: [1, ".month-group"]
					    }
					  }
             	});

             	$( "#addQuestion" ).validate();
             	$( "#editQuestion" ).validate();


             	<?php if(!empty($rating)){
             		$i = 0;
             		foreach ($rating as $ratingValue) {
             			?>
             			$('#fixed<?php echo $i;?>').raty({
             				path: '../../../public/admin/img/',
							  readOnly:  true,
							  half:true,
							  start:    <?php echo  $ratingValue->rating;?>
							});

             		<?php $i++; }
             	}
             	?>

             	

             	CKEDITOR.plugins.addExternal( 'font', '/public/admin/ckeditor/font/', 'plugin.js' );

             	<?php if(($this->uri->segment(2) == 'cms' && $this->uri->segment(3) == 'add') ||  ($this->uri->segment(2) == 'cms' && $this->uri->segment(3) == 'edit') ){?>
             		CKEDITOR.replace( 'title',{
             			extraPlugins: 'font'

             		} );
             	 	CKEDITOR.replace( 'cms_description',{
             	 		extraPlugins: 'font'
             	 	} );

             	 	CKEDITOR.replace( 'title_de',{
             			extraPlugins: 'font'

             		} );
             	 	CKEDITOR.replace( 'cms_description_de',{
             	 		extraPlugins: 'font'
             	 	} );
             	<?php } ?>
             	 
                 $('#sidebarCollapse').on('click', function () {
                     $('#sidebar').toggleClass('active');
                 });



                  $('.selectcategory').on('change', function() {
                    
                    	
                    	

                  if(this.value != ''){
                      $.ajax({
                          type: 'POST',
                          data: {
                              cat_id: $(this).val()
                             
                          },
                          url: "<?php echo base_url();?>admin/question/detail-ajax",
                           
                          success: function (response) {

                            console.log(response);
                            //alert(response);
                             //$('.loader').hide();
                            $(".ajaxDetails").html(response);
                              
                          },
                          error: function (xhr, ajaxOptions, thrownError) {


                             //$('.loader').hide();
                          }
                      });

                    }
                    else
                    {
                    	alert("Please select Category.");
                    }

                 });


             });


             $(document).ready(function(){


             	
              

			    var max_fields      = 3; //maximum input boxes allowed
			    var wrapper         = $(".choiceSelection"); //Fields wrapper
			    var add_button      = $(".add_field_button"); //Add button ID
			    var countInc = '';
			    var x = 0; //initlal text box count

			    	$("body").on("click",'.add',function(e){
			     
			        e.preventDefault();
			        if(x < max_fields){ //max input box allowed
			          
			            x++; //text box increment
			            $(wrapper).append(' <div class="col-md-12 col-xs-12 removeSectionAdd"><div class="form-group"><label class="control-label col-xs-2">Choice</label><div class="col-xs-10"><input type="text" class="form-control"  name="choice[]" placeholder="Description"></div></div><div class="form-group"><label class="control-label col-xs-2">Correct</label><div class="col-xs-10"><input type="radio" name="correct'+x+'" value="Y">Yes <input type="radio" name="correct'+x+'" value="N">N </div></div><a href="javascript:void(0);" class="remove"><i class="fa fa-minus" aria-hidden="true"></i></i></a></div>'); //add input box
			                                      }

			       




			    });


			    	 $('body').on('click', '.remove', function() {
                    //code
                    $(this).closest(".removeSectionAdd").remove();
                    x--;
                });


			    	$(".correctAns").click(function(){

			    		
			    		$(".correctAns").prop("checked", false);
			    		$(this).prop("checked", true);
				      
				    });

				    $(".filterSubCat").change(function(){

				    	window.location.href = "<?php echo base_url().admin;?>question/?sub_cat_id="+$(this).val();

			    		//alert($(this).val());
			    		
				       
				    });

				     $(".filterDetails").change(function(){

				    	window.location.href = "<?php echo base_url().admin;?>details/?sub_cat_id="+$(this).val();

			    		//alert($(this).val());
			    		
				       
				    });

				    

				    

             });

         </script>
         
    <script>
		$(window).load(function() {
			$(".loader").fadeOut("slow");
		});
	</script>

    
  <script>
    wow = new WOW(
      {
        animateClass: 'animated',
        offset:       100,
        callback:     function(box) {
          console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
        }
      }
    );
    wow.init();
    document.getElementById('moar').onclick = function() {
      var section = document.createElement('section');
      section.className = 'section--purple wow fadeInDown';
      this.parentNode.insertBefore(section, this);
    };
  </script>

</body>

</html>

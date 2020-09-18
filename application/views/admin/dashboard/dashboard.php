<div class="pageHeading wow fadeInDown">
			<div class="row">
				<div class="col-sm-6"><h2><?php echo $this->lang->line('dashboard');?></h2></div>
				<div class="col-sm-6"></div>
			</div>
		</div>

        <div class="container-fluid">
            <div class="row adminSec wow fadeInRight">
                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-video">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-8">
                                        <div class="huge"><?php echo $categoryCount;?></div>
                                        <p><?php echo $this->lang->line('course');?></p>
                                        
                                    </div>
                                    <div class="col-xs-4">
                                        <span class="iconSec"><img src="<?php echo base_url().admin_images;?>icon2.png"></span>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-images">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-8">
                                        <div class="huge"><?php echo $userCount;?></div>
                                        <p><?php echo $this->lang->line('users');?></p>
                                    </div>
                                    <div class="col-xs-4">
                                        <span class="iconSec"><img src="<?php echo base_url().admin_images;?>icon3.png"></span>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    

                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-slider">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-8">
                                        <div class="huge"><?php echo $questionCount;?></div>
                                        <p><?php echo $this->lang->line('question');?></p>
                                    </div>
                                    <div class="col-xs-4">
                                        <span class="iconSec"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
        </div>

        <div class="container-fluid">
            <div class="row adminSec">
                <div class="col-lg-8 col-md-12 wow fadeInLeft">
                    <div class="dashboardCategorySec">
                    <div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i><?php echo $this->lang->line('category');?> </h3>
						</div>
						<div class="panel-body">

							<?php if($this->session->flashdata('success')){?>

								<div class="alert alert-success">
								  <strong><?php echo $this->session->flashdata('success');?></strong> 
								</div>

							<?php } ?>
							

							
						   <div class="table-responsive">
							<table class="table table-bordered table-hover table-striped" data-toggle="table"  data-classes="table table-hover">
							<thead>
								<tr>
									<th data-sortable="true">Cat Id</th>
									<th data-sortable="true"><?php echo $this->lang->line('category_name');?></th>
									<th data-sortable="false"><?php echo $this->lang->line('category_image');?></th>
									<th data-sortable="false"><?php echo $this->lang->line('category_description');?></th>
									<th data-sortable="false"><?php echo $this->lang->line('status');?></th>
									
									
								</tr>
							</thead>
							<tbody>
								<?php if(!empty($category)){

									foreach ($category as  $categoryValue) {
										
									?>

									<tr>
									<td><?php echo $categoryValue->cat_id;?></td>
									<td><?php echo ($this->session->userdata('site_lang') == 'english') ? $categoryValue->category_name : $categoryValue->category_name_de; ?></td>
									<td><img width="100" height="100" src="<?php echo base_url().$categoryValue->category_image;?>"></td>

									<td><?php echo ($this->session->userdata('site_lang') == 'english') ? $categoryValue->category_description : $categoryValue->category_description_de ;?></td>
									<td>

									<?php if ($categoryValue->status == 'Y') {
										echo $this->lang->line("active");
									}
									else {
											echo $this->lang->line("inactive");
										}	
										?>
									</td>
									
									
								</tr>


								<?php }  } ?>
								 
								
							</tbody>
						</table>
						
						</div>

						</div>
					</div>
                    </div>
                    <div class="dashboardCategorySec">
                    


                    	<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i><?php echo $this->lang->line("details");?> </h3>
							 

						</div>
						<div class="panel-body">

							<?php if($this->session->flashdata('success')){?>

								<div class="alert alert-success">
								  <strong><?php echo $this->session->flashdata('success');?></strong> 
								</div>

							<?php } ?>
							

							
						   <div class="table-responsive">
							<table class="table table-bordered table-hover table-striped" data-toggle="table"  data-classes="table table-hover">
							<thead>
								<tr>
									
									<th data-sortable="false"><?php echo $this->lang->line("category");?></th>
									<th data-sortable="false"><?php echo $this->lang->line("name");?></th>
									<th data-sortable="false"><?php echo $this->lang->line("description");?></th>
									<th data-sortable="false"><?php echo $this->lang->line("file");?></th>
									<th data-sortable="false"><?php echo $this->lang->line("file_extension");?></th>
									<th data-sortable="false"><?php echo $this->lang->line("status");?></th>
									
									
								</tr>
							</thead>
							<tbody>
								<?php if(!empty($subCategory)){

									foreach ($subCategory as  $categoryValue) {
										
									?>

									<tr>
									
									<td><?php echo ($this->session->userdata('site_lang') == 'english') ? $categoryValue->category_name : $categoryValue->category_name_de;?></td>
									<td><?php echo ($this->session->userdata('site_lang') == 'english') ? $categoryValue->sub_category_name : 
									$categoryValue->sub_category_name_de;?></td>
									<td><?php echo ($this->session->userdata('site_lang') == 'english') ? $categoryValue->sub_category_description : $categoryValue->sub_category_description_de;?></td>
									<td>
										<?php if($categoryValue->file_type == 'image'){
											?>
											<img width="100" height="100" src="<?php echo base_url().$categoryValue->sub_category_image;?>">
										<?php } else{?>
											<a target="_blank" href="<?php echo base_url().$categoryValue->sub_category_image;?>"><?php echo $categoryValue->file_type;?></a>
										<?php } ?>
										</td>

										<td><?php echo $categoryValue->file_ext;?></td>
									<td>
									<?php if ($categoryValue->status == 'Y') {
										echo "Active";
									}
									else {
											echo "Inactive";
										}	
										?>
									</td>
									
									
								</tr>


								<?php }  } ?>
								 
								
							</tbody>
						</table>
						
						</div>

						</div>
					</div>



                    </div>
                </div>
                <div class="col-lg-4 col-md-12 wow fadeInRight">
                    <div class="dashboardCategorySec">
                    



                    	<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i> Review </h3>
							 

						</div>
						<div class="panel-body">

							
							

							
						   <div class="table-responsive">
							<table class="table table-bordered table-hover table-striped" data-toggle="table"  data-classes="table table-hover">
							<thead>
								<tr>
									
									
									<th data-sortable="false"><?php echo $this->lang->line("name");?></th>
									<th data-sortable="false"><?php echo $this->lang->line("average_review");?></th>
									<th data-sortable="false"><?php echo $this->lang->line("review_comment");?></th>
									
								</tr>
							</thead>
							<tbody>
								<?php if(!empty($review)){

									foreach ($review as  $categoryValue) {
										
									$avreage = $this->Common_model->average($this->table_ratings,array( 
									'sub_cat_id' => $categoryValue->sub_cat_id ),'rating');

									//print_r($avreage);
									?>

									<tr>
									
									<td><?php echo ($this->session->userdata('site_lang') == 'english') ? $categoryValue->sub_category_name : $categoryValue->sub_category_name_de;?></td>
									<td><?php echo number_format($avreage->rating,2);?></td>
									<td>
										<a href="<?php echo base_url();?>admin/review/details/<?php echo $categoryValue->sub_cat_id;?>"><i class="fa fa-comments"></i></a> 

										
									</td>
									
								</tr>


								<?php }  } ?>
								 
								
							</tbody>
						</table>
						
						</div>

						</div>
					</div>



                    </div>
                </div>
            </div>
        </div>
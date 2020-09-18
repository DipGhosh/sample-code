<div class="pageHeading wow fadeInDown">
			<div class="row">
				<div class="col-sm-6"><h2><?php echo $this->lang->line("details");?></h2></div>
				<div class="col-sm-6">
					
				</div>
			</div>
			
			
		</div>

		<div class="entrySection2">
			
			<div class="wow fadeInRight animated">
                       
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i> <?php echo $this->lang->line("manage_details");?> </h3>
							 <div class="row searchSect">
                                <div class="col-lg-8 col-sm-7">
                                    <select class="form-control filterDetails" >
								<?php if(!empty($category)){
									?>
									<option value="">Select Details </option>
									<?php foreach ($category as $subCategoryValue) {
										?>
										<option value="<?php echo $subCategoryValue->cat_id;?>"

											<?php
											if(isset($_GET['sub_cat_id'])){
											 if($_GET['sub_cat_id'] == $subCategoryValue->cat_id){ echo " Selected";} }

											 ?>
											><?php echo $subCategoryValue->category_name;?></option>
										<?php 
									}?>
									</select>
								<?php }?>
                                </div>

                                
                                   <div class="col-lg-4 col-sm-5">
                                	
                                   	<a href="<?php echo base_url();?>admin/details/add" class="btn btn-primary pull-right"><?php echo $this->lang->line("add_details");?></a>
                                  
                                </div>

                               
                            </div>

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
									<th data-sortable="false"><?php echo $this->lang->line("settings");?></th>
									
								</tr>
							</thead>
							<tbody>
								<?php if(!empty($subCategory)){

									foreach ($subCategory as  $categoryValue) {
										
									?>

									<tr>
									
									<td><?php echo ($this->session->userdata('site_lang') == 'english') ? $categoryValue->category_name : $categoryValue->category_name_de;?></td>
									<td><?php echo ($this->session->userdata('site_lang') == 'english') ? $categoryValue->sub_category_name : $categoryValue->sub_category_name_de;?></td>
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
										echo $this->lang->line("active");
									}
									else {
											echo $this->lang->line("inactive");
										}	
										?>
									</td>
									<td>
										<a href="<?php echo base_url();?>admin/details/edit/<?php echo $categoryValue->sub_cat_id;?>"><i class="fa fa-edit"></i></a> 

										<a onclick="return confirm('Are you sure want to delete?');" href="<?php echo base_url();?>admin/details/delete/<?php echo $categoryValue->sub_cat_id;?>" class="text-danger"><i class="fa fa-trash" aria-hidden="true"></i></a> 

										<?php if ($categoryValue->status == 'Y') {
											?>

											<a href="<?php echo base_url();?>admin/details/inactive/<?php echo $categoryValue->sub_cat_id;?>">
										<?php echo $this->lang->line("make_inactive");?></a>

										<?php }
										else { ?>
												<a href="<?php echo base_url();?>admin/details/active/<?php echo $categoryValue->sub_cat_id;?>">
												<?php echo $this->lang->line("make_active");?></a>
										<?php }	?>
									</td>
									
								</tr>


								<?php }  } ?>
								 
								
							</tbody>
						</table>
						<?php echo $links;?>
						</div>

						</div>
					</div>
					</div>
			</div>
		</div>
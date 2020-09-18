<div class="pageHeading wow fadeInDown">
			<div class="row">
				<div class="col-sm-6"><h2>Category</h2></div>
				<div class="col-sm-6">
					
				</div>
			</div>
			
			
		</div>

		<div class="entrySection2">
			
			<div class="wow fadeInRight animated">
                       
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i> 
								<?php echo $this->lang->line("manage_category");?> <a href="<?php echo base_url();?>admin/category/add" class="btn btn-primary pull-right"><?php echo $this->lang->line("add_category");?></a></h3>
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
									<th data-sortable="true"><?php echo $this->lang->line("category_name");?></th>
									<th data-sortable="false"><?php echo $this->lang->line("category_image");?></th>
									<th data-sortable="false"><?php echo $this->lang->line("category_description");?></th>
									<th data-sortable="false"><?php echo $this->lang->line("status");?></th>
									<th data-sortable="false"><?php echo $this->lang->line("settings");?></th>
									
								</tr>
							</thead>
							<tbody>
								<?php if(!empty($category)){

									foreach ($category as  $categoryValue) {
										
									?>

									<tr>
									<td><?php echo $categoryValue->cat_id;?></td>
									<td><?php echo ($this->session->userdata('site_lang') == 'english') ? $categoryValue->category_name : $categoryValue->category_name_de;?></td>
									<td><img width="100" height="100" src="<?php echo base_url().$categoryValue->category_image;?>"></td>

									<td><?php echo ($this->session->userdata('site_lang') == 'english') ? $categoryValue->category_description : $categoryValue->category_description_de;?></td>
									<td>

									<?php if ($categoryValue->status == 'Y') {
										echo "Active";
									}
									else {
											echo "Inactive";
										}	
										?>
									</td>
									<td>

										<a href="<?php echo base_url();?>admin/category/edit/<?php echo $categoryValue->cat_id;?>"><i class="fa fa-edit"></i></a> 

										<a onclick="return confirm('Are you sure want to delete?');" href="<?php echo base_url();?>admin/category/delete/<?php echo $categoryValue->cat_id;?>" class="text-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>

										<?php if ($categoryValue->status == 'Y') {
												?>

												<a href="<?php echo base_url();?>admin/category/inactive/<?php echo $categoryValue->cat_id;?>">
											<?php echo $this->lang->line("make_inactive");?></a>

											<?php }
											else { ?>
													<a href="<?php echo base_url();?>admin/category/active/<?php echo $categoryValue->cat_id;?>">
													<?php echo $this->lang->line("make_active");?></a>
											<?php }	?>


										

 

									</td>
									
								</tr>


								<?php }  } ?>
								 
								
							</tbody>
						</table>
						<!-- <nav aria-label="Page navigation example"> -->
						<?php echo $links;?>
						<!-- </nav> -->
						</div>

						</div>
					</div>
					</div>
			</div>
		</div>
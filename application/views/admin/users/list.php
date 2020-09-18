<div class="pageHeading wow fadeInDown">
			<div class="row">
				<div class="col-sm-6"><h2><?php echo $this->lang->line("users");?></h2></div>
				<div class="col-sm-6">
					
				</div>
			</div>
			
			
		</div>

		<div class="entrySection2">
			
			<div class="wow fadeInRight animated">
                       
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i><?php echo $this->lang->line("manage_users");?></h3>
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
									<th data-sortable="false"><?php echo $this->lang->line("user_name");?></th>
									<th data-sortable="false"><?php echo $this->lang->line("email");?></th>
									<th data-sortable="false"><?php echo $this->lang->line("organisation");?></th>
									<th data-sortable="false"><?php echo $this->lang->line("institute");?></th>
									<th data-sortable="false"><?php echo $this->lang->line("profession");?></th>
									<th data-sortable="false"><?php echo $this->lang->line("profile_image");?></th>
									<th data-sortable="false"><?php echo $this->lang->line("status");?></th>
									<!-- <th data-sortable="false">Settings</th> -->
									
								</tr>
							</thead>
							<tbody>
								<?php if(!empty($subCategory)){

									foreach ($subCategory as  $categoryValue) {
										
									?>

									<tr>
									<td><?php echo $categoryValue->user_name;?></td>
									<td><?php echo $categoryValue->email;?></td>
									<td><?php echo $categoryValue->organisation;?></td>
									<td><?php echo $categoryValue->institute;?></td>
									<td><?php echo $categoryValue->profession;?></td>
									<td>
										
									<?php if($categoryValue->profiles_image != ''){
										?>
										<img width="100" height="100" src="<?php echo base_url().$categoryValue->profiles_image;?>">
									<?php  } ?>	
									
										
										</td>
									<td>
									<?php if ($categoryValue->active == 'Y') {
										?>
										<a href="<?php echo base_url();?>admin/users/inactive/<?php echo $categoryValue->user_id;?>">Make Inactive</a> 
									<?php }
									else {
										?>
											<a href="<?php echo base_url();?>admin/users/active/<?php echo $categoryValue->user_id;?>">Make Active</a> 
									<?php 	}	?>
									</td>
									<!-- <td>
										<a href="<?php echo base_url();?>admin/details/edit/<?php echo $categoryValue->sub_cat_id;?>"><i class="fa fa-edit"></i></a> 
									</td> -->
									
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
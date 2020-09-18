<div class="pageHeading wow fadeInDown">
			<div class="row">
				<div class="col-sm-6"><h2><?php echo $this->lang->line('cms');?></h2></div>
				<div class="col-sm-6">
					
				</div>
			</div>
			
			
		</div>

		<div class="entrySection2">
			
			<div class="wow fadeInRight animated">
                       
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i><?php echo $this->lang->line('manage_cms');?>  <a href="<?php echo base_url();?>admin/cms/add" class="btn btn-primary pull-right"><?php echo $this->lang->line('add_cms');?></a></h3>
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
									<th data-sortable="false"><?php echo $this->lang->line('title');?></th>
									<th data-sortable="false"><?php echo $this->lang->line('description');?></th>
									<th data-sortable="false"><?php echo $this->lang->line('status');?></th>
									<th data-sortable="false"><?php echo $this->lang->line('settings');?></th>
									
								</tr>
							</thead>
							<tbody>
								<?php if(!empty($subCategory)){

									foreach ($subCategory as  $categoryValue) {
										
									?>

									<tr>
									<td><?php echo ($this->session->userdata('site_lang') == 'english') ? $categoryValue->title : $categoryValue->title_de;?></td>
									<td><?php echo ($this->session->userdata('site_lang') == 'english') ? $categoryValue->description : $categoryValue->description_de;?></td>
									
									<td>
									<?php if ($categoryValue->status == 'Y') {
											echo $this->lang->line('active');
									}
									else {
											echo $this->lang->line('inactive');
											
										}	
										?>
									</td>
									<td>
										<a href="<?php echo base_url();?>admin/cms/edit/<?php echo $categoryValue->id;?>"><i class="fa fa-edit"></i></a> 

										

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
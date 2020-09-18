<div class="pageHeading wow fadeInDown">
			<div class="row">
				<div class="col-sm-6"><h2><?php echo $this->lang->line('banner');?></h2></div>
				<div class="col-sm-6">
					
				</div>
			</div>
			
			
		</div>

		<div class="entrySection2">
			
			<div class="wow fadeInRight animated">
                       
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i><?php echo $this->lang->line('manage_banner');?><a href="<?php echo base_url();?>admin/banner/add" class="btn btn-primary pull-right"><?php echo $this->lang->line('add_banner');?></a></h3>
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
									<th data-sortable="false"><?php echo $this->lang->line('banner_title');?></th>
									<th data-sortable="false"><?php echo $this->lang->line('banner_description');?></th>
									<th data-sortable="false"><?php echo $this->lang->line('image');?></th>
									
									<th data-sortable="false"><?php echo $this->lang->line('settings');?></th>
									
								</tr>
							</thead>
							<tbody>
								<?php if(!empty($banner)){

									foreach ($banner as  $categoryValue) {
										
									?>

									<tr>
									<td><?php echo ($this->session->userdata('site_lang') == 'english') ? $categoryValue->title : $categoryValue->title_de;?></td>
									<td><?php echo ($this->session->userdata('site_lang') == 'english') ? $categoryValue->description : $categoryValue->description_de;?></td>
									<td><img width="100" height="100" src="<?php echo base_url().$categoryValue->file;?>"></td>

									
									<td>

										<a href="<?php echo base_url();?>admin/banner/edit/<?php echo $categoryValue->id;?>"><i class="fa fa-edit"></i></a> 

										<a onclick="return confirm('Are you sure want to delete?');" href="<?php echo base_url();?>admin/banner/delete/<?php echo $categoryValue->id;?>" class="text-danger"><i class="fa fa-trash" aria-hidden="true"></i></a> 

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
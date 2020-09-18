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
							<h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i><?php echo $this->lang->line("review");?>  </h3>
							 

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
									
									
									<th data-sortable="false"><?php echo $this->lang->line("name");?></th>
									<th data-sortable="false"><?php echo $this->lang->line("average_review");?></th>
									<th data-sortable="false"><?php echo $this->lang->line("review_comment");?></th>
									
								</tr>
							</thead>
							<tbody>
								<?php if(!empty($subCategory)){

									foreach ($subCategory as  $categoryValue) {
										
									$avreage = $this->Common_model->average($this->table_ratings,array( 
									'sub_cat_id' => $categoryValue->sub_cat_id ),'rating');

									//print_r($avreage);
									?>

									<tr>
									
									<td><?php echo $categoryValue->sub_category_name;?></td>
									<td><?php echo number_format($avreage->rating,2);?></td>
									<td>
										<a href="<?php echo base_url();?>admin/review/details/<?php echo $categoryValue->sub_cat_id;?>"><i class="fa fa-comments"></i></a> 

										
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
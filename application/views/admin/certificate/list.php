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

							<?php /*if($this->session->flashdata('success')){?>

								<div class="alert alert-success">
								  <strong><?php echo $this->session->flashdata('success');?></strong> 
								</div>

							<?php } */?>
							

							
						   <div class="table-responsive">
							<table class="table table-bordered table-hover table-striped" data-toggle="table"  data-classes="table table-hover">
							<thead>
								<tr>
									
									
									<th data-sortable="false"><?php echo $this->lang->line("user_name");?></th>
									<th data-sortable="false"><?php echo $this->lang->line("email");?></th>
									<th data-sortable="false"><?php echo $this->lang->line("attempt");?></th>
									<th data-sortable="false"><?php echo $this->lang->line("view_certificate");?></th>
									
								</tr>
							</thead>
							<tbody>
								<?php if(!empty($users)){

									foreach ($users as  $usersVal) {
										
										$passCount = $this->Common_model->numrows($this->table_exam_data,
											array('user_id' => $usersVal->user_id, 'result' => 'Y' ));
										$failedCount = $this->Common_model->numrows($this->table_exam_data,array('user_id' => $usersVal->user_id, 'result' => 'N' ));
									?>

									<tr>
									
									<td><?php echo $usersVal->user_name;?></td>
									<td><?php echo $usersVal->email;?></td>
									<td>
										Passed (<?php echo $passCount;?>)<br>
										Falied (<?php echo $failedCount;?>) </td>
									<td>
										<a href="<?php echo base_url();?>admin/certificate/details/<?php echo $usersVal->user_id;?>"><i class="fa fa-file-archive-o" aria-hidden="true"></i></a> 

										
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
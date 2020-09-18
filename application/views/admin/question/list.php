<div class="pageHeading wow fadeInDown">
			<div class="row">
				<div class="col-sm-6"><h2><?php echo $this->lang->line("question");?></h2></div>
				<div class="col-sm-6">
					
				</div>
			</div>
			
			
		</div>

		<div class="entrySection2">
			
			<div class="wow fadeInRight animated">
                       
				<div class="col-lg-12">
					<div class="panel panel-default">

						 

						<div class="panel-heading">
							<h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i><?php echo $this->lang->line("manage_question");?>

								
								<!-- <a href="<?php echo base_url();?>admin/question/add" class="btn btn-primary pull-right">Add Question</a> -->


							 </h3>
                            
                           

                            <div class="row searchSect">
                                <div class="col-lg-8 col-sm-7">
                                    <select class="form-control filterSubCat" >
								<?php if(!empty($subCategory)){
									?>
									<option value="">Select Details </option>
									<?php foreach ($subCategory as $subCategoryValue) {
										?>
										<option value="<?php echo $subCategoryValue->sub_cat_id;?>"

											<?php
											if(isset($_GET['sub_cat_id'])){
											 if($_GET['sub_cat_id'] == $subCategoryValue->sub_cat_id){ echo " Selected";} }

											 ?>
											><?php echo $subCategoryValue->sub_category_name;?></option>
										<?php 
									}?>
									</select>
								<?php }?>
                                </div>

                                

                                <div class="col-lg-4 col-sm-5">
                                	

                                    <a href="<?php echo base_url();?>admin/question/add" class="btn btn-primary pull-right"><?php echo $this->lang->line("add_question");?></a>
                                    <a href="<?php echo base_url();?>admin/question/import-data" class="btn btn-primary pull-right">Import Data</a>
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
									<th data-sortable="false"><?php echo $this->lang->line("question");?></th>
									
									<th data-sortable="false"><?php echo $this->lang->line("settings");?></th>
									
								</tr>
							</thead>
							<tbody>
								<?php if(!empty($question)){

									foreach ($question as  $questionValue) {
										
									?>

									<tr>
									<td><?php echo ($this->session->userdata('site_lang') == 'english') ? $questionValue->sub_category_name : $questionValue->sub_category_name_de;?></td>
									<td><?php echo ($this->session->userdata('site_lang') == 'english') ? $questionValue->question : $questionValue->question_de;?></td>
									
									<td>
										<a href="<?php echo base_url();?>admin/question/edit/<?php echo $questionValue->question_id;?>"><i class="fa fa-edit"></i></a> 

										<a onclick="return confirm('Are you sure want to delete?');" href="<?php echo base_url();?>admin/question/delete/<?php echo $questionValue->question_id;?>" class="text-danger"><i class="fa fa-trash" aria-hidden="true"></i></a> 

									</td>
									
								</tr>


								<?php }  } else
								{ ?>
									<tr><td style="color: red;">No data found.</td><td></td><td></td></tr>
							<?php 	}?>
								 
								
							</tbody>
						</table>
						<?php echo $links;?>
						</div>

						</div>
					</div>
					</div>
			</div>
		</div>
<div class="pageHeading wow fadeInDown">
			<div class="row">
				<div class="col-sm-6"><h2><?php echo $this->lang->line('details');?></h2></div>
				<div class="col-sm-6">
					
				</div>
			</div>
			
			
		</div>

		<div class="entrySection2">
			
			<div class="wow fadeInRight animated">
                       
				<div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i><?php echo $this->lang->line('add_details');?></h3>
                            </div>
                            
                            <?php if($this->session->flashdata('error')){?>

								<div class="alert alert-danger">
								  <strong><?php echo $this->session->flashdata('error');?></strong> 
								</div>

							<?php } ?>

                            <div class="panel-body">

                            	<?php 
                            	$attributes = array('class' => 'form-horizontal','id' => 'editDetail');
								echo form_open_multipart('admin/details/edit', $attributes);

								?>
                              <input type="hidden" name="sub_cat_id" value="<?php echo $details->sub_cat_id;?>">
                              <div class="form-group">
									<label class="control-label col-xs-2"><?php echo $this->lang->line('category');?></label>
									<div class="col-xs-10">
										<select class="form-control" name="cat_id" required="required">
											<option value="">Select Category</option>
											<?php if(!empty($category)){
												foreach ($category as $categoryValue) {
													?>
													<option

													<?php if($details->cat_id ==  $categoryValue->cat_id){
														echo 'Selected';
													}?>
													 value="<?php echo $categoryValue->cat_id;?>">
													<?php echo $categoryValue->category_name;?></option>
											<?php 	}
											}
											?>
											
										</select>
									
									</div>
								</div>


                              
								<div class="form-group">
									<label class="control-label col-xs-2"><?php echo $this->lang->line('name');?>(EN)</label>
									<div class="col-xs-10">
									<input class="form-control" value="<?php echo $details->sub_category_name;?>" required="required" name="cat_name" placeholder="Description">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-xs-2"><?php echo $this->lang->line('name');?> (DE)</label>
									<div class="col-xs-10">
									<input class="form-control" value="<?php echo $details->sub_category_name_de;?>" required="required" name="cat_name_de" placeholder="Beschreibung">
									</div>
								</div>


								<div class="form-group">
									<label class="control-label col-xs-2"><?php echo $this->lang->line('description');?>(EN)</label>
									<div class="col-xs-10">
									<textarea class="form-control" name="cat_description" required="required" placeholder="Description"  ><?php echo $details->sub_category_description;?></textarea> 
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-xs-2"><?php echo $this->lang->line('description');?> (DE)</label>
									<div class="col-xs-10">
									<textarea class="form-control" required="required" name="cat_description_de" placeholder="Beschreibung"  ><?php echo $details->sub_category_description_de;?></textarea> 
									</div>
								</div>


								<div class="form-group">
									<label class="control-label col-xs-2"><?php echo $this->lang->line('file');?></label>
									<div class="col-xs-10">
										<a target="_blank" href="<?php echo base_url().$details->sub_category_image;?>"><?php echo $this->lang->line('file');?></a>
									</div>
								</div>




								<div class="form-group">
									<label class="control-label col-xs-2"><?php echo $this->lang->line('update_file');?> (pdf,doc,docx,mp4)</label>
									<div class="col-xs-10">
										<input class="form-control" type="file" name="fileup" placeholder="Description">
									</div>
								</div>

								
								<div class="form-group">
									<label class="control-label col-xs-2"><?php echo $this->lang->line('video_duration');?></label>
									<div class="col-xs-10">
									<input class="form-control"  name="duration" placeholder="30 minutes" value="<?php echo $details->duration;?>">
									</div>
								</div>


								<div class="form-group">
									<label class="control-label col-xs-2"><?php echo $this->lang->line('pass_percentage');?></label>
									<div class="col-xs-10">
									<input type="text" class="form-control"  name="percentage" placeholder="Pass Percentage" required="required" value="<?php echo $details->percentage;?>">
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-xs-2"><?php echo $this->lang->line('no_of_question_for_exam');?></label>
									<div class="col-xs-10">
									<input type="text" class="form-control"  name="question_exam" placeholder="No Of Question For Exam" required="required" value="<?php echo $details->no_of_question_exam;?>">
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-xs-2"><?php echo $this->lang->line('certificate_valid_month');?></label>
									<div class="col-xs-4">
									<select class="form-control month-group" name="certificate_month">
											<option value="">Select  Month</option>
											<?php 
												for ($i = 1;$i<= 12;$i++) {
													?>
													<option


													<?php if($details->certificate_valid_month ==  $i){
														echo 'Selected';
													}?>
													 value="<?php echo $i;?>">
													<?php echo $i;?></option>
											<?php 	} ?>						 
																						
										</select>
									</div>

									<label class="control-label col-xs-2"><?php echo $this->lang->line('certificate_valid_year');?></label>
									<div class="col-xs-4">
									<select class="form-control month-group" name="certificate_year">
											<option value="">Select Year </option>
											<?php 
												for ($i = 1;$i<= 50;$i++) {
													?>
													<option
													<?php if($details->certificate_valid_year ==  $i){
														echo 'Selected';
													}?> 
													 value="<?php echo $i;?>">
													<?php echo $i;?></option>
											<?php 	} ?>						 
																						
										</select>
									</div>


								</div>


								<div class="form-group">
									<label class="control-label col-xs-2">&nbsp;</label>
									<div class="col-xs-10">
									<button type="submit" class="btn btn-primary"><?php echo $this->lang->line('submit');?></button>
									</div>
								</div>



							</form>
                                
                            </div>
                        </div>
                        </div>
			</div>
		</div>
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
                                <h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i></i><?php echo $this->lang->line('add_details');?></h3>
                            </div>
                            
                            <?php if($this->session->flashdata('error')){?>

								<div class="alert alert-danger">
								  <strong><?php echo $this->session->flashdata('error');?></strong> 
								</div>

							<?php } ?>

                            <div class="panel-body">

                            	<?php 
                            	$attributes = array('class' => 'form-horizontal','id' => 'addDetail');
								echo form_open_multipart('admin/details/add', $attributes);

								?>
                              
                              <div class="form-group">
									<label class="control-label col-xs-2"><?php echo $this->lang->line('category');?></label>
									<div class="col-xs-10">
										<select class="form-control" name="cat_id" required="required">
											<option value="">Select Category</option>
											<?php if(!empty($category)){
												foreach ($category as $categoryValue) {
													?>
													<option value="<?php echo $categoryValue->cat_id;?>">
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
									<input class="form-control" required="required" name="cat_name" placeholder="Description">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-xs-2"><?php echo $this->lang->line('name');?> (DE)</label>
									<div class="col-xs-10">
									<input class="form-control" required="required" name="cat_name_de" placeholder="Beschreibung">
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-xs-2"><?php echo $this->lang->line('description');?>(EN)</label>
									<div class="col-xs-10">
									<textarea class="form-control" required="required" name="cat_description" placeholder="Description"  ></textarea> 
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-xs-2"><?php echo $this->lang->line('description');?>(DE)</label>
									<div class="col-xs-10">
									<textarea class="form-control" required="required" name="cat_description_de" placeholder="Beschreibung"  ></textarea> 
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-xs-2"><?php echo $this->lang->line('file');?> (pdf,doc,docx,mp4)</label>
									<div class="col-xs-10">
										<input class="form-control" required="required" type="file" name="fileup" placeholder="Description">
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-xs-2"><?php echo $this->lang->line('video_duration');?></label>
									<div class="col-xs-10">
									<input class="form-control"  name="duration" placeholder="30 minutes">
									</div>
								</div>


								<div class="form-group">
									<label class="control-label col-xs-2"><?php echo $this->lang->line('pass_percentage');?></label>
									<div class="col-xs-10">
									<input type="text" class="form-control" required="required" name="percentage" placeholder="Pass Percentage">
									</div>
								</div>
							
								
								<div class="form-group">
									<label class="control-label col-xs-2"><?php echo $this->lang->line('no_of_question_for_exam');?></label>
									<div class="col-xs-10">
									<input type="text" class="form-control" required="required"  name="question_exam" placeholder="No Of Question For Exam" >
									</div>
								</div>

								<!-- <div class="form-group">
									<label class="control-label col-xs-2">Certificate Valid For(Month)</label>
									<div class="col-xs-10">
									<select class="form-control" name="certificate" required="required">
											<option value="">Select </option>
											<?php 
												for ($i = 1;$i<= 50;$i++) {
													?>
													<option value="<?php echo $i;?>">
													<?php echo $i;?></option>
											<?php 	} ?>						 
																						
										</select>
									</div>
								</div> -->
								<div class="form-group">
									<label class="control-label col-xs-2"><?php echo $this->lang->line('certificate_valid_month');?></label>
									<div class="col-xs-4">
									<select class="form-control month-group" name="certificate_month">
											<option value="">Select  Month</option>
											<?php 
												for ($i = 1;$i<= 12;$i++) {
													?>
													<option value="<?php echo $i;?>">
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
													<option value="<?php echo $i;?>">
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
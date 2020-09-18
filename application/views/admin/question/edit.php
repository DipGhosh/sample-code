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
                                <h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i> Edit Question</h3>
                            </div>
                            
                            <?php if($this->session->flashdata('error')){?>

								<div class="alert alert-danger">
								  <strong><?php echo $this->session->flashdata('error');?></strong> 
								</div>

							<?php } ?>

                            <div class="panel-body">

                            	<?php 
                            	$attributes = array('class' => 'form-horizontal', 'id' => 'editQuestion');
								echo form_open_multipart('admin/question/edit', $attributes);

								?>
                              <input type="hidden" name="question_id" value="<?php echo $question->question_id;?>">
                              <div class="form-group">
									<label class="control-label col-xs-2"><?php echo $this->lang->line("category");?></label>
									<div class="col-xs-10">
										<select class="form-control selectcategory" name="cat_id" required="required">
											<option value="">Select Category</option>
											<?php if(!empty($category)){
												foreach ($category as $categoryValue) {
													?>
													<option value="<?php echo $categoryValue->cat_id;?>"

														<?php if($question->cat_id == $categoryValue->cat_id ){
															echo " Selected";
														}?>

														>
													<?php echo $categoryValue->category_name;?></option>
											<?php 	}
											}
											?>
											
										</select>
									
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-xs-2"><?php echo $this->lang->line("details");?></label>
									<div class="col-xs-10 ajaxDetails" >
										<select class="form-control" name="sub_cat_id" required="required">
											<option value="">Select Detail</option>
											<?php if(!empty($subCategory)){
												foreach ($subCategory as  $subCategoryValue) {
													
												?>
												<option value="<?php echo $subCategoryValue->sub_cat_id;?>"

														<?php if($question->sub_cat_id == $subCategoryValue->sub_cat_id ){
															echo " Selected";
														}?>

														>
													<?php echo $subCategoryValue->sub_category_name;?></option>

											<?php  } } ?>
											
										</select>
									
									</div>
								</div>
                              

                             	 <div class="form-group">
									<label class="control-label col-xs-2"><?php echo $this->lang->line("question");?>(EN)</label>
									<div class="col-xs-10">
									<textarea class="form-control" required="required" name="question" placeholder="Description"  ><?php echo $question->question;?></textarea> 
									</div>
								</div>


								 <div class="form-group">
									<label class="control-label col-xs-2"><?php echo $this->lang->line("question");?>(DE)</label>
									<div class="col-xs-10">
									<textarea class="form-control" required="required" name="question_de" placeholder="Description"  ><?php echo $question->question_de;?></textarea> 
									</div>
								</div>



								<?php if(!empty($choice)){
									$i = 0;
									$j = 1;
									foreach($choice as $choiceValue ){
									?>

								 <input type="hidden" name="choice_id[]" value="<?php echo $choiceValue->choice_id;?>">
								

								<div class="choiceSection">

								<div class="form-group">
                                    <div class="rowInner">
                                        <div class="col-lg-1">
                                            <label><input type="radio" name="correct<?php echo $i;?>" class="correctAns" value="Y" <?php if($choiceValue->correct == 'Y'){ echo "checked"; } ?>> Yes </label>
                                        </div>
                                        <div class="col-lg-11">
                                            <div class="row">
                                                <label class="control-label col-xs-1"><?php echo $this->lang->line("option");?>(EN) <?php echo $j;?></label>
                                                <div class="col-xs-11">
                                                <input type="text" class="form-control"  name="choice[]" placeholder="Answer" required="required" value="<?php echo $choiceValue->choice;?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-1">
                                        </div>

                                        <div class="col-lg-11">
                                            <div class="row">
                                                <label class="control-label col-xs-1"><?php echo $this->lang->line("option");?>(DE) <?php echo $j;?></label>
                                                <div class="col-xs-11">
                                                <input type="text" class="form-control"  name="choice_de[]" placeholder="Answer" required="required" value="<?php echo $choiceValue->choice_de;?>">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
								</div>


								

								

								</div>

								<?php $i++; $j++; } } ?>
								<!-- <a href="javascript:void(0);" class="add"><i class="fa fa-plus" aria-hidden="true"></i>
								</a> -->

								
								<!-- <div class="choiceSelection"></div> -->
								

								

								<div class="form-group">
									<label class="control-label col-xs-2">&nbsp;</label>
									<div class="col-xs-10">
									<button type="submit" class="btn btn-primary"><?php echo $this->lang->line("submit");?></button>
									</div>
								</div>



							</form>
                                
                            </div>
                        </div>
                        </div>
			</div>
		</div>
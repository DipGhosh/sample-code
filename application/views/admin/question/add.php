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
                                <h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i><?php echo $this->lang->line("add_question");?></h3>
                            </div>
                            
                            <?php if($this->session->flashdata('error')){?>

								<div class="alert alert-danger">
								  <strong><?php echo $this->session->flashdata('error');?></strong> 
								</div>

							<?php } ?>

                            <div class="panel-body">

                            	<?php 
                            	$attributes = array('class' => 'form-horizontal', 'id' => 'addQuestion');
								echo form_open_multipart('admin/question/add', $attributes);

								?>
                              
                              <div class="form-group">
									<label class="control-label col-xs-2"><?php echo $this->lang->line("category");?></label>
									<div class="col-xs-10">
										<select class="form-control selectcategory" name="cat_id" required="required">
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
									<label class="control-label col-xs-2"><?php echo $this->lang->line("details");?></label>
									<div class="col-xs-10 ajaxDetails" >
										<select class="form-control" name="sub_cat_id" required="required" required="required">
											<option value="">Select Detail</option>
											
										</select>
									
									</div>
								</div>
                              

                             	 <div class="form-group">
									<label class="control-label col-xs-2"><?php echo $this->lang->line("question");?>(EN)</label>
									<div class="col-xs-10">
									<textarea class="form-control" required="required" name="question" placeholder="Description"  ></textarea> 
									</div>
								</div>


								<div class="form-group">
									<label class="control-label col-xs-2"><?php echo $this->lang->line("question");?>(DE)</label>
									<div class="col-xs-10">
									<textarea class="form-control" required="required" name="question_de" placeholder="Description"  ></textarea> 
									</div>
								</div>


								<?php 
								$j = 1;
								for($i =0;$i <= 3;$i++){?>

								
								<div class="choiceSection">

								<div class="form-group">
                                    <div class="rowInner">
                                        <div class="col-lg-1">
                                            <label><input type="radio" name="correct<?php echo $i;?>" class="correctAns" value="Y"> Yes </label>
                                        </div>
                                        <div class="col-lg-11">
                                            <div class="row">
                                                <label class="control-label col-xs-1"><?php echo $this->lang->line("option");?>(EN) <?php echo $j;?></label>
                                                <div class="col-xs-11">
                                                <input type="text" class="form-control"  name="choice[]" placeholder="Answer" required="required">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-1">
                                        </div>
                                        <div class="col-lg-11">
                                            <div class="row">
                                                <label class="control-label col-xs-1"><?php echo $this->lang->line("option");?>(DE) <?php echo $j;?></label>
                                                <div class="col-xs-11">
                                                <input type="text" class="form-control"  name="choice_de[]" placeholder="Answer" required="required">
                                                </div>
                                            </div>
                                        </div>


                                    </div>
								</div>


								

								

								</div>

								<?php $j++; } ?>
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
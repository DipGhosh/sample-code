<div class="pageHeading wow fadeInDown">
			<div class="row">
				<div class="col-sm-6"><h2><?php echo $this->lang->line("category");?></h2></div>
				<div class="col-sm-6">
					
				</div>
			</div>
			
			
		</div>

		<div class="entrySection2">
			
			<div class="wow fadeInRight animated">
                       
				<div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i><?php echo $this->lang->line("edit_category");?></h3>
                            </div>
                            
                            <?php if($this->session->flashdata('error')){?>

								<div class="alert alert-danger">
								  <strong><?php echo $this->session->flashdata('error');?></strong> 
								</div>

							<?php } ?>

                            <div class="panel-body">

                            	<?php 
                            	$attributes = array('class' => 'form-horizontal', 'id' => 'frmaddEdit');
								echo form_open_multipart('admin/category/edit', $attributes);


								?>
                              	<input type="hidden" name="cat_id" value="<?php echo $categoryDetails->cat_id;?>">
								<div class="form-group">
									<label class="control-label col-xs-2"><?php echo $this->lang->line("category_name");?> (EN)</label>
									<div class="col-xs-10">
									<input class="form-control" value="<?php echo $categoryDetails->category_name;?>" name="cat_name" required="required" placeholder="Description">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-xs-2"><?php echo $this->lang->line("category_name");?> (DE)</label>
									<div class="col-xs-10">
									<input class="form-control" value="<?php echo $categoryDetails->category_name_de;?>" required="required"   name="cat_name_de" placeholder="Beschreibung">
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-xs-2"><?php echo $this->lang->line("category_description");?> (EN)</label>
									<div class="col-xs-10">
									<textarea class="form-control" required="required" name="cat_description" placeholder="Description"  ><?php echo $categoryDetails->category_description;?></textarea> 
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-xs-2"><?php echo $this->lang->line("category_description");?> (DE)</label>
									<div class="col-xs-10">
									<textarea class="form-control" required="required" name="cat_description_de" placeholder="Beschreibung"  ><?php echo $categoryDetails->category_description_de;?></textarea> 
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-xs-2"><?php echo $this->lang->line("category_image");?></label>
									<a href="<?php echo base_url().$categoryDetails->category_image;?>">File</a>
								</div>


								<div class="form-group">
									<label class="control-label col-xs-2"><?php echo $this->lang->line("category_image");?> (jpg,jpeg,png)</label>
									<div class="col-xs-10">
										<input class="form-control" type="file"  name="fileup" placeholder="Description">
									</div>
								</div>

								

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
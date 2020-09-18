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
                                <h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i><?php echo $this->lang->line("add_category");?></h3>
                            </div>
                            
                            <?php if($this->session->flashdata('error')){?>

								<div class="alert alert-danger">
								  <strong><?php echo $this->session->flashdata('error');?></strong> 
								</div>

							<?php } ?>

                            <div class="panel-body">

                            	<?php 
                            	$attributes = array('class' => 'form-horizontal', 'id' => 'frmaddcat' );
								echo form_open_multipart('admin/category/add', $attributes);

								?>
                              
								<div class="form-group">
									<label class="control-label col-xs-2">
										<?php echo $this->lang->line("category_name");?> (EN)</label>
									<div class="col-xs-10">
									<input class="form-control" required="required"  name="cat_name" placeholder="Description">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-xs-2"><?php echo $this->lang->line("category_name");?> (DE)</label>
									<div class="col-xs-10">
									<input class="form-control" required="required"  name="cat_name_de" placeholder="Beschreibung">
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-xs-2">
										<?php echo $this->lang->line("category_description");?> (EN)</label>
									<div class="col-xs-10">
									<textarea class="form-control" required="required" name="cat_description" placeholder="Description"  ></textarea> 
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-xs-2"><?php echo $this->lang->line("category_description");?> (DE)</label>
									<div class="col-xs-10">
									<textarea class="form-control" required="required" name="cat_description_de" placeholder="Beschreibung"  ></textarea> 
									</div>
								</div>


								<div class="form-group">
									<label class="control-label col-xs-2">
										<?php echo $this->lang->line("category_image");?> (jpg,jpeg,png)</label>
									<div class="col-xs-10">
										<input class="form-control" required="required" type="file" name="fileup" placeholder="Description">
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
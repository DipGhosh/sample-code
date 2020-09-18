<div class="pageHeading wow fadeInDown">
			<div class="row">
				<div class="col-sm-6"><h2><?php echo $this->lang->line('cms');?></h2></div>
				<div class="col-sm-6">
					
				</div>
			</div>
			
			
		</div>

		<div class="entrySection2">
			
			<div class="wow fadeInRight animated">
                       
				<div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i> <?php echo $this->lang->line('edit_cms');?></h3>
                            </div>
                            
                            <?php if($this->session->flashdata('error')){?>

								<div class="alert alert-danger">
								  <strong><?php echo $this->session->flashdata('error');?></strong> 
								</div>

							<?php } ?>

                            <div class="panel-body">

                            	<?php 
                            	$attributes = array('class' => 'form-horizontal');
								echo form_open_multipart('admin/cms/edit', $attributes);

								?>
                              <input type="hidden" name="cms_id" value="<?php echo $details->id;?>">
                              


                              
								<div class="form-group">
									<label class="control-label col-xs-2"><?php echo $this->lang->line('title');?>(EN)</label>
									<div class="col-xs-10">
									<textarea class="form-control" name="title" placeholder="title"  >
										<?php echo $details->title;?>
									</textarea> 
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-xs-2"><?php echo $this->lang->line('title');?>(DE)</label>
									<div class="col-xs-10">
									<textarea class="form-control" name="title_de" placeholder="title"  >
										<?php echo $details->title_de;?>
									</textarea> 
									</div>
								</div>


								 <div class="form-group">
									<label class="control-label col-xs-2"><?php echo $this->lang->line('description');?>(EN)</label>
									<div class="col-xs-10">
									<textarea class="form-control" name="cms_description" placeholder="Description"  ><?php echo $details->description;?></textarea> 
									</div>
								</div>


								<div class="form-group">
									<label class="control-label col-xs-2"><?php echo $this->lang->line('description');?>(DE)</label>
									<div class="col-xs-10">
									<textarea class="form-control" name="cms_description_de" placeholder="Description"  ><?php echo $details->description_de;?></textarea> 
									</div>
								</div>



								<div class="form-group">
									<label class="control-label col-xs-2">&nbsp;</label>
									<div class="col-xs-10">
									<button type="submit" class="btn btn-primary">Submit</button>
									</div>
								</div>



							</form>
                                
                            </div>
                        </div>
                        </div>
			</div>
		</div>
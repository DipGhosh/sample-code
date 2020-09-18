<div class="pageHeading wow fadeInDown">
			<div class="row">
				<div class="col-sm-6"><h2><?php echo $this->lang->line('banner');?></h2></div>
				<div class="col-sm-6">
					
				</div>
			</div>
			
			
		</div>

		<div class="entrySection2">
			
			<div class="wow fadeInRight animated">
                       
				<div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i> <?php echo $this->lang->line('add_banner');?></h3>
                            </div>
                            
                            <?php if($this->session->flashdata('error')){?>

								<div class="alert alert-danger">
								  <strong><?php echo $this->session->flashdata('error');?></strong> 
								</div>

							<?php } ?>

                            <div class="panel-body">

                            	<?php 
                            	$attributes = array('class' => 'form-horizontal');
								echo form_open_multipart('admin/banner/edit', $attributes);

								?>
                              
								<input type="hidden" name="id" value="<?php echo $categoryDetails->id;?>">

								<div class="form-group">
									<label class="control-label col-xs-2"><?php echo $this->lang->line('banner_title');?>(EN)</label>
									<div class="col-xs-10">
									<textarea class="form-control" name="title" placeholder="Title"  ><?php echo $categoryDetails->title;?></textarea> 
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-xs-2"><?php echo $this->lang->line('banner_title');?>(DE)</label>
									<div class="col-xs-10">
									<textarea class="form-control" name="title_de" placeholder="Title"  ><?php echo $categoryDetails->title_de;?></textarea> 
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-xs-2"><?php echo $this->lang->line('banner_description');?>(EN)</label>
									<div class="col-xs-10">
									<textarea class="form-control" name="banner_description" placeholder="Description"  ><?php echo $categoryDetails->description;?></textarea> 
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-xs-2"><?php echo $this->lang->line('banner_description');?>(DE)</label>
									<div class="col-xs-10">
									<textarea class="form-control" name="banner_description_de" placeholder="Description"  ><?php echo $categoryDetails->description_de;?></textarea> 
									</div>
								</div>


								<div class="form-group">
									<label class="control-label col-xs-2"><a target="_blank" href="<?php echo base_url().$categoryDetails->file;?>"><?php echo $this->lang->line('file');?></a></label>
									
								</div>



								<div class="form-group">
									<label class="control-label col-xs-2"><?php echo $this->lang->line('image');?></label>
									<div class="col-xs-10">
										<input class="form-control" type="file" name="fileup" placeholder="Description">
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
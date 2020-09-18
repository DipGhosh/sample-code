<div class="pageHeading wow fadeInDown">
			<div class="row">
				<div class="col-sm-6"><h2>Question</h2></div>
				<div class="col-sm-6">
					
				</div>
			</div>
			
			
		</div>

		<div class="entrySection2">
			
			<div class="wow fadeInRight animated">
                       
				<div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i> Import Question</h3>
                            </div>
                            
                            <?php if($this->session->flashdata('error')){?>

								<div class="alert alert-danger">
								  <strong><?php echo $this->session->flashdata('error');?></strong> 
								</div>

							<?php } ?>

							<?php if($this->session->flashdata('success')){?>

								<div class="alert alert-success">
								  <strong><?php echo $this->session->flashdata('success');?></strong> 
								</div>

							<?php } ?>

                            <div class="panel-body">

                            	<?php 
                            	$attributes = array('class' => 'form-horizontal');
								echo form_open_multipart('admin/question/import-data', $attributes);

								?>
                              
                             

								<div class="form-group">
									<label class="control-label col-xs-2">Upload File</label>
									<div class="col-xs-10 ajaxDetails" >

										<input type="file" name="csv_file"  class="form-control">
										
									
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
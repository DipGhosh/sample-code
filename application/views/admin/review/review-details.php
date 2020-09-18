<div class="pageHeading wow fadeInDown">
			<div class="row">
				<div class="col-sm-6"><h2><?php echo $this->lang->line("review");?></h2></div>
				<div class="col-sm-6">
					
				</div>
			</div>
			
			
		</div>

		<div class="entrySection2">
			
			<div class="wow fadeInRight animated">
                       
				<div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i> <?php echo $subCatDetails->sub_category_name;?></h3>
                            </div>
                            
                            
                            <div class="panel-body">
                                
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped" data-toggle="table"  data-classes="table table-hover">
                                        <thead>
                                            <tr>
                                                <th><?php echo $this->lang->line("user");?></th>
                                                <th><?php echo $this->lang->line("review");?></th>
                                                <th><?php echo $this->lang->line("rating");?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!empty($rating))
                                          { 
                                            $i = 0;
                                            foreach ($rating as $ratingValue) {
                                                ?>
                                            <tr>
                                                <td>
                                                    <?php echo $this->Common_model->getValue('users', 'user_name', array('user_id' =>  $ratingValue->user_id))?>
                                                </td>
                                                <td>
                                                    <?php echo $ratingValue->review;?>
                                                </td>
                                                <td>
                                                    <div id="fixed<?php echo $i;?>"></div>
                                                </td>
                                            </tr>
                                            <?php $i++; }

                                              }
                                              else
                                              {
                                                ?>
                                                <!-- <div class="alert alert-danger">
                                                  <strong>No review available.</strong>
                                                </div> -->
                                             <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                            	
                              
                              		
								
                                
                            </div>
                        </div>
                        </div>
			</div>
		</div>
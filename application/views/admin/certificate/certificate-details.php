<div class="pageHeading wow fadeInDown">
			<div class="row">
				<div class="col-sm-6"><h2><?php echo $this->lang->line("certificate");?></h2></div>
				<div class="col-sm-6">
					
				</div>
			</div>
			
			
		</div>

		<div class="entrySection2">
			
			<div class="wow fadeInRight animated">
                       
				<div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i> <?php echo $userDetails->user_name;?></h3>
                            </div>
                            
                            
                            <div class="panel-body">
                                
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped" data-toggle="table"  data-classes="table table-hover">
                                        <thead>
                                            <tr>
                                               
                                                <th><?php echo $this->lang->line("course");?></th>
                                                <th><?php echo $this->lang->line("percentage");?></th>
                                                <th><?php echo $this->lang->line("result");?></th>
                                                <th><?php echo $this->lang->line("exam_date");?></th>
                                                <th><?php echo $this->lang->line("certificate");?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!empty($subCategory))
                                          { 
                                            $i = 0;
                                            foreach ($subCategory as $subCategoryValue) {

                                                $examData = $this->Common_model->dbQuery("SELECT * from exam_data where user_id = '".$this->uri->segment(4)."' AND sub_cat_id = '".$subCategoryValue->sub_cat_id."' order by exam_id desc limit 0,1");


                                                if(!empty($examData)){

                                                    //print_r($examData);
                                                ?>
                                            <tr>
                                                <td>
                                                    <?php echo $subCategoryValue->sub_category_name;?>
                                                    <?php


                                                     //echo $this->Common_model->getValue('users', 'user_name', array('user_id' =>  $ratingValue->user_id))?>
                                                </td>
                                                <td>
                                                    <?php echo $examData[0]->percentage;?>
                                                </td>
                                                <td>
                                                <?php if($examData[0]->result == 'Y'){
                                                   
                                                        echo "Passed";
                                                   }
                                                else{
                                                    echo "Failed";
                                                }    
                                                ?> 
                                                </td>

                                                  <td>
                                                    <?php echo date('Y-m-d',strtotime($examData[0]->exam_date));?>
                                                </td>
                                                 <td>
                                                  
                                                <?php if($examData[0]->result == 'Y'){
                                                   ?>
                                                    <a target="_blank" href="<?php echo base_url();?>admin/certificate/show-certificate/<?php echo $userDetails->user_id;?>/<?php echo $examData[0]->exam_id;?>/<?php echo $subCategoryValue->sub_cat_id;?>">View Certificate</a>
                                                   <?php 
                                                }
                                                else{
                                                    echo "No Certificate";
                                                }    
                                                ?> 


                                                </td>
                                            </tr>
                                            <?php $i++; } }

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
<div id="main">
<?php get_breadcrumb(); ?>
<script>
function checkalldata(){}
</script>
<style type="text/css">
    .hf {
    padding: 12px;
    font-size: 14px;
}
</style>
            <div id="content">
                <div class="row">
                
                                    <div class="col-md-12">
                        
                        <section class="panel">
                                                <header class="panel-heading">
                                                        
                                                        <div class="row">
                                                            <div class="col-md-8 col-sm-6 col-xs-12">
                                                                <h3>  Abc process </h3>
                                                            </div>
                                                            <div class="col-md-4 col-sm-6 col-xs-12 text-right">
                                                               <div class="row">
                                                                <div class="col-md-6">
                                                                    <select class="form-control">
                                                                                        <option>Action</option>
                                                                                        <option>Option 2</option>
                                                                                        <option>Option 3</option>
                                                                                        <option>Option 4</option>
                                                                                        <option>Option 5</option>
                                                                                </select>
                                                                </div>
                                                                 <div class="col-md-6">
                                                                    <select class="form-control">
                                                                                        <option>Generate</option>
                                                                                        <option>Option 2</option>
                                                                                        <option>Option 3</option>
                                                                                        <option>Option 4</option>
                                                                                        <option>Option 5</option>
                                                                                </select>
                                                                </div>

                                                               </div>
                                                            </div>

                                                        </div>
                                                </header>
                                               
                                                <div class="panel-body">
                                                       
                                                    <section class="panel">
                                               <div class="tabbable">
                                                <ul class="nav nav-tabs">
                                                        <li class="active"><a href="#home" data-toggle="tab">Result</a></li>
                                                        <li><a href="#profile" data-toggle="tab">Other</a></li>
                                                </ul>
                                                <div class="tab-content">
                                                       <div class="tab-pane fade in active" id="home">
                                                      <div class="row">
                                                          <div class="col-xs-6">
                                                              <header class="panel-heading">
                                                        
                                                        <div class="row">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <h4>  Run Detail </h4>
                                                            </div>

                                                        </div>
                                                </header>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                        <div class="hf">
                                                            <span class="content_half">Status </span><span class="content_half">Status</span>
                                                        </div>
                                                         <div class="hf">
                                                            <span class="content_half">Prority </span><span class="content_half">Status</span>
                                                        </div>
                                                         <div class="hf">
                                                            <span class="content_half">Envoirment</span><span class="content_half">Status</span>
                                                        </div>
                                                         <div class="hf">
                                                            <span class="content_half">Block </span><span class="content_half">Status</span>
                                                        </div>
                                                         <div class="hf">
                                                            <span class="content_half">Create by </span><span class="content_half">Status</span>
                                                        </div>
                                                         <div class="hf">
                                                            <span class="content_half">Started</span><span class="content_half">Status</span>
                                                        </div>

                                                         </div>
                                                    </div>
                                                          </div>
                                                                                                                    <div class="col-xs-6">
                                                              <header class="panel-heading">
                                                        
                                                        <div class="row">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <h4>  Submission Status </h4>
                                                            </div>

                                                        </div>
                                                </header>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                        <div class="hf">
                                                            <span class="content_half">Progress  </span><span class="content_half">Status</span>
                                                        </div>
                                                         <div class="hf">
                                                            <span class="content_half">Sucessfull  </span><span class="content_half">Status</span>
                                                        </div>
                                                         <div class="hf">
                                                            <span class="content_half">No of recordes </span><span class="content_half">Status</span>
                                                        </div>
                                                         <div class="hf">
                                                            <span class="content_half">No of process ecord </span><span class="content_half">Status</span>
                                                        </div>
                                                         </div>
                                                    </div>
                                                          </div>
                                                      </div>
                                                       </div>
                                                       <div class="tab-pane fade" id="profile">
                                                        sdasdsad
                                                       </div>
                                                </div>
                                                <div class="row">
                            <div class="col-md-12 text-right">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#md-normal">Run This Process</button>
                            </div>
                        </div>
                                        </div>
                                        </section>
                                                </div>
                                        </section>
                    </div> 
                    
                </div>
                <!-- //content > row-->
            </div>
            <!-- //content-->
                    <div id="md-normal" class="modal fade">
                <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                        <h4 class="modal-title">Business Process Start Sucessfully !</h4>
                </div>
                <!-- //modal-header-->
                <div class="modal-body">
                    <div class="row">
                         <div class="col-md-12 text-right">
                                <button class="btn btn-default">View result</button>
                                <button class="btn btn-primary">View Business Process Result</button>
                            </div>
                    </div>
                </div>
                <!-- //modal-body-->
        </div>
        <!-- //modal-->
              
                 <?php echo success_fail_message_popup();?> 
        
                 <?php echo delete_confirmation_popup(); ?>

    </div>

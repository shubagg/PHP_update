<div id="main" class="dashboard">
<?php get_breadcrumb(); ?>

      <div id="content" >
            
   
    <section class="panel">
      <header class="panel-heading">
    <h3 class="title">LIST</h3>
    </header>
    
        <div class="panel-body">
          <div class="table-responsive">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-hover" data-provide="data-table" id="">
              <thead>
                <tr>
                  
                  
                  <th>Email</th>
                  
                  <th>Action</th>
                  
                  
                </tr>
              </thead>
              <tbody align="center">
              <?php $get_contact=get_email_by_id(array('id'=>0)); 
                      $i=1; $k=0;
              $stack = array();             
              foreach($get_contact['data'] as $contact)
               {
               
                $stack[$k][] = $i;
                $stack[$k][]= $contact['email'];
              
              ?>
                <tr class="odd gradeX">
                  <td><?php echo $contact['email']; ?></td>
                  <td style="width:8%">
                    <span class="tooltip-area">
                    <a data-original-title="Delete" data-toggle="modal" id="<?php echo $contact['id']; ?>" onclick='delete_contact(this.id)' data-target="#sure_to_delete"  class="btn btn-default btn-sm" title=""><i class="fa fa-trash-o"></i></a></span>
                  </td> 
                </tr>
                <?php $i++; $k++; } ?>
                
              </tbody>
            </table>
          </div>
        </div>
      </section>  
  </div> 
      <!-- //content-->
    </div>

    <!-- //main-->

      <div id="success_modal" class="modal fade"
            data-header-color="#736086">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"
                aria-hidden="true">
                <i class="fa fa-times"></i>
              </button>
              <h4 class="modal-title" id="model_head">
                <i class="glyphicon glyphicon-ok-circle"></i> Confirmation
              </h4>
            </div>
            <!-- //modal-header-->
            <div class="modal-body text_alignment">
              <div class="confirmation_successful">
                <i class="glyphicon glyphicon-ok-circle icon_size"></i><br>
                <span id="model_des">Confirmation Successfull</span>  <!-- Spelling -->
              </div>
            </div>
            <!-- //modal-body-->
          </div>
      <!-- //Role popup ends-->
      <div id="sure_to_delete" class="modal fade" data-backdrop="static" data-keyboard="false" data-width="300" >
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-times"></i></button>
                    <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Are you sure?</h4>
                    </div>
                    <!-- //modal-header-->
                    <form class="form-horizontal" data-collabel="2" data-label="color" id="deleteData">
                    <div class="modal-body text_alignment">
                    <div class="button_holder"> 
                    
                    <div id="deletType">
                    
                              </div>
                                </div>
                            </div>
                    </form>                
        <!-- //modal-body-->
        </div> 
      <div id="error_message" class="modal fade" data-backdrop="static" data-keyboard="false" data-width="300" >
        <div class="modal-header">
          <button  type="button" class="close"></button>
          <h4 class="modal-title"><i class="glyphicon glyphicon-exclamation-sign"></i> <span id="error_head"></span></h4>
        </div>
        <!-- //modal-header-->
        <div class="modal-body text_alignment">
          <div class="button_holder">
            <p><strong id="error_body"></strong></p>
          </div>
        </div>
        <!-- //modal-body--> 
      </div>
            
            <div id="basic_search" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" data-width="600" >
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="del1"><i class="fa fa-times"></i></button>
            <h3><i class="glyphicon glyphicon-search"></i> Search</h3>
        </div>
        <div class="modal-body text_alignment">
                <span class="searcherrorcat" style="color: red;" class="error"></span>
                       <form id="catsearchform"> 
                        
                        <table>
                        <?php
                            
                            show_accordian($dat,'',0,1,'user_category',$category_data,$user_id);
                        ?>
                        </table>       
                
            <div class="clr"></div>
            
          
          <button type="button" data-dismiss="modal" class="btn btn-inverse top-gap bottom-gap right left-gap">
            <i class="glyphicon glyphicon-remove-sign"></i> Cancel</button>
            <button onclick="get_category_user()" type="button" class="btn btn-theme-inverse top-gap bottom-gap right" >
            <i class="glyphicon glyphicon-search"></i> Search</button>    
           </form> 
        </div>
      </div>
  </div>
  <!-- //wrapper-->


  <!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->

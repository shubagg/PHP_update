<?php get_admin_header(); ?>
<?php get_admin_header_menu(); ?>
<?php get_admin_left_sidebar(); ?>
<div id="main" class="dashboard">
<?php 
        
    $advanced_search = $this->get_advance_search(); 
    if($advanced_search){
?>
<span class="top-advance-search"><button class="btn btn-default adv_srch" style="background: transparent; border: none;" >Advance Search <i class="fa fa-plus-circle" aria-hidden="true"></i></button></span>
<?php
  include_once(include_admin_template("common_templates/approval", "default_advanced_search"));    
}

?>
<?php //get_breadcrumb(); ?>
<ol class="breadcrumb">
    <li>Admin </li><li>Approvals </li><li class="active">Pending Approval </li></ol>

    <div id="content">
        <div class="row">
            <div class="col-lg-12">
                <!--------------------------------- Include Page Header ------------------------------------------>
        <?php 
    
          // include_once(include_admin_template("common_templates/approval", "page_header"));
    
        ?>
                
                
            
                
<!------------------------------ Include Listing Page -------------------------------------->
            
            <?php 
                $listing_data = $this->customise_listing_data();
                if(isset($listing_data['status']) && $listing_data['status']=='true')
                {
                   include_once(include_admin_template("common_templates/approval", "listing1"));
                }
            ?>
                
            </div>
        </div>
        <!-- //content > row-->
    </div>

<!--<div class="modal-scrollable z-1060">-->
    

</div>
<div id="approval_modal" class="modal container fade in" tabindex="-1" aria-hidden="false" data-width="400" >
    <div class="modal-header">
    <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                            <h4 class="modal-title"> <?php echo $ui_string['details']; ?></h4>
                    </div>
                    </div>
                    
                    </div>
        
                            <!-- //modal-header-->
        <div class="modal-body">
                              
            <div class="clr"></div>
                 <div class="modal_data" id="approval_modal_data">
                               
     
                 </div> 
        </div>
                            <!-- //modal-body-->
    </div>

<!--</div>-->
<?php get_admin_footer(); ?>
<script type="text/javascript">
    function approve(id)
    {
        if(id!="")
        {
            $.ajax({

                url:webservice_url+'/fn_approved',
                data:{"id":id},
                type:'post',
                success:function(suc)
                {
                    console.log(suc);
                    if(suc)
                    {
                        $('#'+id).attr('data-status',status)
                       
                        msg_head=ui_string['confirm'];
                        msg_body=ui_string['approve'];
                        
                    }
                    else
                    {
                        msg_head=ui_string['notconfirm'];
                        msg_body=ui_string['notconfirm'];
                    }
                    $("#model_head").html(msg_head);
                    $("#model_des").html(msg_body);
                    $('#success_modal').modal();
                    setTimeout(function(){ $('#success_modal').modal('toggle'); },2000);
                     unloading();
                     make_datatable();
                }

            })
        }

    }
    function reject(id)
    {
        if(id!="")
        {
            $.ajax({

                url:webservice_url+'/fn_rejected',
                data:{"id":id},
                type:'post',
                success:function(suc)
                {
                    if(suc)
                    {
                        $('#'+id).attr('data-status',status)
                       
                        msg_head=ui_string['confirm'];
                        msg_body=ui_string['reject'];
                        
                    }
                    else
                    {
                        msg_head=ui_string['notconfirm'];
                        msg_body=ui_string['notconfirm'];
                    }
                    $("#model_head").html(msg_head);
                    $("#model_des").html(msg_body);
                    $('#success_modal').modal();
                    setTimeout(function(){ $('#success_modal').modal('toggle'); },2000);
                     unloading();
                     make_datatable();
                }

            })
        }
    }

</script>
<script type="text/javascript">
    function show_approval_details(id)
    {
        var result = '<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-hover datatable">'
        result += '<thead><tr><th colspan="2">Approval Request For</th></tr></thead><tbody>';
        if(id!="")
        {
            $.ajax({

                url:webservice_url+'/get_show_approval_details',
                data:{"id":id},
                type:'post',
                success:function(suc)
                {
                    console.log(suc['success']);
                    if(suc['success']=='true')
                    {
                        var data = suc['data'];
                        $.each( data, function( key, value ) {
                          alert(key+'--'+value);
                          result += '<tr><td>'+key+'</td><td>'+value+'</td></tr>';
                        });
                        result += '</tbody><table>';
                        $('#approval_modal_data').html(result);
                        $('#approval_modal').modal();
                    }
                    else
                    {
                        result += '<tr><td>No Details Available</td></tr>';
                        result += '</tbody><table>';
                        $('#approval_modal_data').html(result);
                        $('#approval_modal').modal();

                    }
                }

            })
        }
        
        
    }
</script>
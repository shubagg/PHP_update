<?php 
is_user_logged_in();
get_admin_header(); 
get_admin_header_menu( $language );
$history=get_inventory_requests(array('id'=>$_GET['iid'],'userId'=>'','index'=>0,'nor'=>1,'object'=>'true'));
$history=$history['data'][0];
include_once(include_admin_template("inventory","request_history")); 
?>
<script type="text/javascript">
    function manage_approval(service){
        $.ajax({
            url:site_url+"webservices/"+service,
            data:"id=<?php echo $_GET['approval_id']; ?>",
            type:"POST",
            dataType:"json",
            success:function(suc)
                    {
                        if(suc['success']=='true'){
                            $('#success_modal').modal();
                            location.reload();
                        }else{
                            $('#error_head').html('Error!');
                            $('#error_body').html('There is some error');
                            $('#error_message').modal();
                            setTimeout(function(){ $('#error_message').modal('toggle'); },2000);
                        }
                       
                    }
        })
    }
</script>
<?php  get_admin_footer(); ?>
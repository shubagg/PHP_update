<div id="<?php echo $popupId; ?>" class="modal fade container">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button> <!-- Removed onclick="getUsersList(1);"  from button -->
        <h4 class="modal-title"><i class="glyphicon glyphicon-user"></i> Assign License</h4>
    </div>
    <!-- //modal-header-->
    <div>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#bakc1" aria-controls="bakc1" role="tab" data-toggle="tab">Users</a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content" >
        <div role="tabpanel" class="tab-pane active" id="bakc1">
            <div class="table-responsive tabsshow" id="head1">
                <div class="clearfix"></div>
                <?php 
                $column_head=array('checkbox','Name','Email');  
                $show_fields=array('checkbox','name','email');
                $All_data=array("head"=>$column_head);
                $table_data=array("table_id"=>"EnrollPopUpTable","table_data"=>$All_data);
                get_ajax_datatable($table_data,$show_fields,admin_ui_url()."/licenses_management/ajax/datatable_ajax_assign.php?id=".$data['userId']);
                ?> 
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="bakc2">

            <div class="table-responsive tabsshow" id="head2">
                <span class="tooltip-area">
                    <button onclick="$('#enroll-Cats').modal();document.getElementById('catusersall').reset();" type="button" data-toggle="tooltip" data-placement="top" title="Select Categories" class="btn btn-default bottom-gap right" >
                    <i class="glyphicon glyphicon-list"></i></button> 
                </span>

                <table class="table table-striped table-hover bhos" data-provide="data-table" style="width: 100% !important;">
                    <thead>
                        <tr>
                            <th>S.no</th>
                            <th>Categories</th>
                            <th>Enrolled On</th>
                            <th>Total Users</th>       
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="CatEnrolledHistory">

                    </tbody>
                </table>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button type="button" class="btn btn-theme-inverse bottom-gap right" onclick="SaveAllData('<?php echo $setting; ?>');" >
                Add</button>  
                <button type="button" data-dismiss="modal" class="btn btn-inverse right left-gap bottom-gap">
                Cancel</button>    

            </div>
        </div>
    </div>
    </div>
<!-- //modal-body-->
</div>
<script>
$(document).ready(function() { 
setTimeout(function(){
//alert("hello");
$('.ripu').click();},2150);
});

var mid='<?php echo $data['mid']; ?>';
var smid='<?php echo $data['smid']; ?>';
var group_id = '';
parent_cats=<?php echo json_encode($parent_cats); ?>;
var allEnrolledUsers=[];
var robotid="";
function genericUsersPopup(asid,id)
{
    allEnrolledUsers=[];
    allCheckedArrayValues=[]
    getEnrolledUsers(asid);
    robotid=id;
    $('.controlTowerPlay').attr('data-asid', asid);
    $('.controlTowerPlay').attr('data-id', id);
    $('#<?php echo $popupId; ?>').modal();
}


function checkalldata(id)
{
    getEnrolledUsers(popUpItemId);
}

function getEnrolledUsers(cid)
{
    popUpItemId=cid;
    // allCheckedArrayValues=[];
    $('.check_box').attr('checked',false);
    var datatosend="itemId="+cid+"&mid="+mid+"&smid="+smid;
    if(group_id){ datatosend+="&proj_group_id="+group_id; }
    $.ajax({
        url:"<?php echo site_url(); ?>webservices/get_enrolled",
        data:datatosend,
        type:"POST",
        success:function(suc)
        {
            var objectType=typeof suc;
            if(objectType!='object'){ suc=JSON.parse(suc); }
            if(suc['success']=='true')
            {         
            var userIds=suc['data']['users'];
            add_category_html(suc['data']['category']);
            // allCheckedArrayValues=[];

            for(i=0;i<userIds.length;i++)
            {
            if(!allCheckedArrayValues.inArray(userIds[i]))
            {
            allEnrolledUsers.push(userIds[i]);
            allCheckedArrayValues.push(userIds[i]);
            }  
            }
            for(k=0;k<allCheckedArrayValues.length;k++)
            {
            $('#ch_'+allCheckedArrayValues[k]).attr('checked',true);
            }
            //CatEnrolledHistory
            }
            else
            {
            var s=[];
            add_category_html(s);
            }
        }

    });
}


function SaveAllData(setting)
{  
    if(setting=='2')
    {
        $('#enrolled_users_from_popup').val(0);
        $('#enrolled_users_from_popup').val(allCheckedArrayValues.toString());

        $('#enrolled_categories_from_popup').val(0);
        $('#enrolled_categories_from_popup').val(catData);
        $('#<?php echo $popupId; ?>').modal('toggle');

        <?php if($returnVal==true){?> getUsersIds(allCheckedArrayValues.toString(),catData); <?php } ?>
    }
    else
    { 
        if(popUpItemId)
        {
            if(allCheckedArrayValues!=""){
           
            //alert("userId="+allCheckedArrayValues.toString()+"&itemId="+popUpItemId+"&categoryId="+catData+"&mid="+mid+"&smid="+smid+"&proj_group_id="+group_id);
            $('body').modalmanager('loading');
            $('.modal-scrollable').css('pointer-events','none');
            setTimeout(function(){ 
            /******************************/
                $.ajax({
                    url:"<?php echo site_url(); ?>webservices/enroll",
                    data:"userId="+allCheckedArrayValues.toString()+"&itemId="+popUpItemId+"&categoryId="+catData+"&mid="+mid+"&smid="+smid+"&proj_group_id="+group_id,
                    type:"POST",
                    async:false,
                    success:function(suc)
                    {
                        if(suc['success']=='false')
                        {
                            alert(suc['data']);
                        }
                        else
                        {  
                            $.ajax({
                                url:"<?php echo admin_ui_url(); ?>licenses_management/ajax/licenses.php?action=statusactive",
                                data:"userId="+allCheckedArrayValues.toString()+"&asid="+popUpItemId+"&id="+robotid,
                                type:"POST",
                                success:function(data){
                                  console.log(data);
                                   $(".check_box_enroll").attr('checked', false);
                                    $('#<?php echo $popupId; ?>').modal('toggle');
                                    $('#succ').html('Users enrolled to licenses successfully');
                                    $('#success_modal').modal();
                                    setTimeout(function(){ location.reload();  },1000);
                                }
                            });
                        }
                    }
                })
            //  set_notification_after_updation(mid,smid,popUpItemId,allEnrolledUsers.toString());
            /******************************/
            }, 500);
            //in resource


        }
        else
        {
            $('#error_body').html('Please Select Atleast one user');
            $('#error_message').modal();
            setTimeout(function(){ location.reload();  },2000);
        } 
    }
        else
        {
        alert('Please Add item Id');
        }
    }
}

var catData='';
function getCategoryQuery()
{
    catData='';
    var ch1='';
    var ch2='';
    for(i=0;i<parent_cats.length;i++)
    {
        ch2='';
        $('.p-'+parent_cats[i]).each(function(){
        if($('#'+this.id).attr('checked'))
        {
        ch2+=this.value+",";
        } 
        })
        ch1+=ch2.slice(0,-1)+"|";
    }
    ch1=ch1.slice(0,-1);
    catData=ch1;
    $('#enroll-Cats').modal('toggle');
}


function add_category_html(suc)
{
    var html='';
    if(suc.length>0)
    {
        for(l=0;l<suc.length;l++)
        {
            html+="<tr>";
            html+="<td>"+(l+1)+"</td>";
            var json_data=JSON.parse(suc[l]['categoryData']);
            var html1='';
            for(k=0;k<json_data.length;k++)
            {
                html1+='<strong>'+json_data[k]['code']+' : </strong>';
                var html2='';
                for(m=0;m<json_data[k]['all'].length;m++)
                {
                html2+=json_data[k]['all'][m]['title']+" , ";
                }
                html1+=html2.slice(0,-3)+"<br />";
            }
            html+="<td>"+html1+"</td>";
            var milliseconds=suc[l]['createdOn']['sec']+"000";
            var dt=new Date(parseInt(milliseconds));
            var theyear=dt.getFullYear();
            var themonth=dt.getMonth()+1;
            var thetoday=dt.getDate();
            var formattedDate=theyear+"/"+themonth+"/"+thetoday;
            html+="<td>"+formattedDate+"</td>";
            html+="<td>"+suc[l]['totalUsers']+"</td>";
            html+='<td><a onclick="delete_enrolled_category(\''+suc[l]['id']+'\');" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" href="javascript:void(0)" title="Delete"><i class="fa fa-trash-o"></i></a></td>';
            html+="</tr>";
        }
    }
    else
    {
        html+="<tr>";
        html+="<td colspan='5'>Sorry no records found</td>";
        html+="</tr>";
    }
    $('#CatEnrolledHistory').html(html);
}

var categoryIndexId='';
function delete_enrolled_category(ind)
{
    categoryIndexId=ind;
    $('#delete_course_enrolled_categories').modal();
}

function delete_course_enrolled_categories()
{
    $.ajax({
        url:"<?php echo site_url(); ?>webservices/delete_category_enrolled_to_item",
        data:"id="+categoryIndexId+"&mid="+mid+"&smid="+smid+"&itemId="+popUpItemId,
        type:"POST",
        success:function(suc)
        {
            $('#enroll-user').modal('toggle');
            $('#delete_course_enrolled_categories').modal('toggle');
            $('#succ').html('Enrolled category deleted successfully');
            $('#confirm-box').modal();
            setTimeout(function(){ $('#confirm-box').modal('toggle');},1000);   
        }
    });
}

$(".checkEnrolled").click(function () {
    if($('#checkenrolled11:checkbox:checked').length>0)
    {
        $("#checkenrolled11").attr('checked', false);
    }
    else
    {
        $("#checkenrolled11").attr('checked', true);
    }
    checkallEnrolled();
});
function delete_license(id,userId)
{
    if(userId=="")
    {
        $("#model_head").html(ui_string['notconfirm']);
        $("#model_des").html("No user are associate with this license");
        $('#success_modal').modal();
        setTimeout(function(){location.reload(); },3000);
    }
    else
    {
        $.ajax({
                    type: "POST",
                    url:  admin_ui_url+"licenses_management/ajax/licenses.php?action=delete",
                    data: "id="+id,
                    success: function(data) {
                       console.log(data);
                       data=JSON.parse(data);
                        
                        if(data['success']=='true')
                        {
                            $("#model_head").html(ui_string['confirm']);
                            $("#model_des").html("Licenses Status Successfully Updated");
                            $('#success_modal').modal();
                            //setTimeout(function(){ window.location=userDetailurl; },1000);
                            setTimeout(function(){ location.reload(); },2000)
                        }
                        else
                        {
                            $("#model_head").html(ui_string['notconfirm']);
                            $("#model_des").html("Licenses Status Request Failed");
                            $('#success_modal').modal();
                            setTimeout(function(){location.reload(); },2000);
                           
                           
                        }
                        
                    },
                  
                    error: function(){
                          alert('error handing here');
                    }
                });
    }
}
</script>
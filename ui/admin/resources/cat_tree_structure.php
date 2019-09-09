<?php
include_once '../../../global.php';

$cat = curl_post($webservice_url."/get_category",array());
$all_cats=$cat['category'];
//print_r($all_cats);

echo "<br /><br /><hr/><br /><br />";

?>
<script type="text/javascript" src="http://server/saas/ui/assets/js/jquery.min.js"></script>
<script>
function show_childs1(id)
{
    var classes = $('#'+id).attr('class');
    
    /*if(document.getElementById('chk-'+id).checked==true)
    {
        $('.checkbox-'+id).prop('checked',true);
    }  
    else
    {
        $('.checkbox-'+id).prop('checked',false);
    }  
    */
    
    if($('.parent-'+id).hasClass('active1'))
    {
        $('#icon-'+id).addClass('fa-plus-square');
        $('#icon-'+id).removeClass('fa-minus-square');
        $('.parent-'+id).removeClass(classes);
        $('.parent-'+id).removeClass('active1');
        $('.parent-'+id).hide();
    }
    else
    {
        $('#icon-'+id).addClass('fa-minus-square');
        $('#icon-'+id).removeClass('fa-plus-square');
        $('.parent-'+id).addClass('active1');
        $('.parent-'+id).addClass(classes);
        $('.parent-'+id).show();
    }
}
</script>

<?php
function get_category_tree1($all_cats,$parentid)
{
    $ret=array();
    $return='';
    for($i=0;$i<sizeof($all_cats);$i++)
    {
        if($all_cats[$i]['parent_id']==$parentid)
        {
            $ar=array('id'=>$all_cats[$i]['id'],'name'=>$all_cats[$i]['name'],'parent_id'=>$parentid);
            $retd=get_category_tree1($all_cats,$all_cats[$i]['id']);
            if(sizeof($retd)){
                $ar=array('id'=>$all_cats[$i]['id'],'name'=>$all_cats[$i]['name'],'parent_id'=>$parentid,"child"=>$retd);
            }
            array_push($ret,$ar);
        }
    }  
    return $ret;  
}


function get_category_tree2($all_cats,$parentid)
{
    $ret=array();
    $return='';
    for($i=0;$i<sizeof($all_cats);$i++)
    {
        if($all_cats[$i]['parent_id']==$parentid)
        {
            $ar=array('id'=>$all_cats[$i]['id'],'name'=>$all_cats[$i]['name'],'parent_id'=>$parentid);
            $retd=get_category_tree2($all_cats,$all_cats[$i]['id']);
            if(sizeof($retd)){
                $ar=array('id'=>$all_cats[$i]['id'],'name'=>$all_cats[$i]['name'],'parent_id'=>$parentid,"child"=>$retd);
            }
            array_push($ret,$ar);
        }
    }  
    return $ret;  
}

$dat=get_category_tree1($all_cats,0);

echo "<pre>";
$dat1=get_category_tree2($all_cats,0);
print_r($dat1);

echo "<br /><br /><hr/><br /><br />";

function show_accordian1($dat,$space,$parent_id,$no,$chkname)
{
      
    $space.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    for($k=0;$k<sizeof($dat);$k++)
    {
        echo $parent_id;
        $pid=$dat[$k]['parent_id'];
        ?>
            <tr class="parent-<?php echo $dat[$k]['parent_id']."-".$no; ?> all-open"  id="<?php echo $dat[$k]['id']."-".$no; ?>" <?php if($dat[$k]['parent_id']!=0){ ?> <?php } ?>>
                    <?php
                        if(sizeof($dat[$k]['child']))
                        {
                    ?>     
                            <td id="tdpad-<?php echo $dat[$k]['id']."-".$no; ?>" onclick="show_childs1('<?php echo $dat[$k]['id']."-".$no; ?>');" class="tdpadd">
                            <i style="cursor: pointer;" id="icon-<?php echo $dat[$k]['id']."-".$no; ?>" class="fa fa-plus-square"></i>
                            </td>  
                    <?php
                        }
                        else
                        {
                    ?>     
                             <td>&nbsp;</td>
                    <?php
                        }
                    ?> 
                    
                    <td style="text-align: left;" class="tdpadd">
                    <?php echo $space; if($pid!=0){ ?>
                    <input name="<?php echo $chkname; ?>[]" value="<?php echo $dat[$k]['id']; ?>" id="chk-<?php echo $dat[$k]['id']."-".$no; ?>" onclick="check_all_childs('<?php echo $dat[$k]['id']."-".$no; ?>')" class="checkbox-<?php echo $dat[$k]['parent_id']."-".$no; ?>  p-parent_name" type="checkbox" />
                    <?php } ?>&nbsp;&nbsp;&nbsp;<?php echo $dat[$k]['name']; ?></td>     
            </tr>
        <?php
            if(sizeof($dat[$k]['child']))
            {
                show_accordian1($dat[$k]['child'],$space,$dat[$k]['parent_id'],$no,$chkname);
            }
        
    }
}


function show_category_accordians1($dat,$space,$parent_id,$no)
{
      
    $space.="----";
    for($k=0;$k<sizeof($dat);$k++)
    {
        echo $parent_id;
        $pid=$dat[$k]['parent_id'];
        ?>
                   
                    
                    <?php echo $space; if($pid!=0){ ?>
                    
                    <option value="<?php echo $dat[$k]['id']; ?>"><?php echo $space.$dat[$k]['name']; ?></option>
                     <?php } else {?><option value="<?php echo $dat[$k]['id']; ?>">---<?php echo $dat[$k]['name']; ?></option><?php } ?>

        <?php
            if(sizeof($dat[$k]['child']))
            {
                show_category_accordians1($dat[$k]['child'],$space,$dat[$k]['parent_id'],$no);
            }
        
    }
}



//echo "<table>";
//show_accordian1($dat,'',0,1,'chk1');
//echo "</table>";


?>



<?php
//echo '<select name="cat" onchange="get_res_data(this);">';
//show_category_accordians1($dat,'-',0,1);
//echo '</select>';

?> 
<script>
function get_res_data(res){
    alert(res);
}
</script>
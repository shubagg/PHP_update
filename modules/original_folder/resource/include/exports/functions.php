<?php

function get_category_tree($all_cats,$parentid)
{
    $ret=array();
    $return='';
    for($i=0;$i<sizeof($all_cats);$i++)
    {
        if($all_cats[$i]['parent_id']==$parentid)
        {
            $ar=array('id'=>$all_cats[$i]['id'],'name'=>$all_cats[$i]['name'],'parent_id'=>$parentid);
            $retd=get_category_tree($all_cats,$all_cats[$i]['id']);
            if(sizeof($retd)){
                $ar=array('id'=>$all_cats[$i]['id'],'name'=>$all_cats[$i]['name'],'parent_id'=>$parentid,"child"=>$retd);
            }
            array_push($ret,$ar);
        }
    }  
    return $ret;  
}


function show_accordian($dat,$space,$parent_id,$no,$chkname)
{
      
      $space.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    for($k=0;$k<sizeof($dat);$k++)
    {
        $pid=$dat[$k]['parent_id'];
        ?>
            <tr class="parent-<?php echo $dat[$k]['parent_id']."-".$no; ?> all-open"  id="<?php echo $dat[$k]['id']."-".$no; ?>" <?php if($dat[$k]['parent_id']!=0){ ?> style="display:none;"<?php } ?>>
                    <?php
                        if(sizeof($dat[$k]['child']))
                        {
                    ?>     
                            <td id="tdpad-<?php echo $dat[$k]['id']."-".$no; ?>" onclick="show_childs('<?php echo $dat[$k]['id']."-".$no; ?>');" class="tdpadd">
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
                    <?php echo $space; if($parent_id!=0){ ?>
                    <input name="<?php echo $chkname; ?>[]" value="<?php echo $dat[$k]['id']; ?>" id="chk-<?php echo $dat[$k]['id']."-".$no; ?>" onclick="check_all_childs('<?php echo $dat[$k]['id']."-".$no; ?>')" class="checkbox-<?php echo $dat[$k]['parent_id']."-".$no; ?>  p-parent_name" type="checkbox" />
                    <?php } ?>&nbsp;&nbsp;&nbsp;<?php echo $dat[$k]['name']; ?></td>     
            </tr>
        <?php
            if(sizeof($dat[$k]['child']))
            {
                show_accordian($dat[$k]['child'],$space,$dat[$k]['parent_id'],$no,$chkname);
            }
        
    }
}

?>
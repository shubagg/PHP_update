<?php include_once("../../../global.php");  ?>

<i class="fa fa-times slide-toggle"  style="margin-left: 269px; margin-top: 14px;"></i>
      <?php
      $id = $_POST['catid'];
   $dept = $_POST['dept'];
   //echo $value1;
      
      //echo "$id";
         $managersInfo=get_category_managers(array('categoryid'=>$id));

         //58c7d3546d9557284e3c9869
             if($managersInfo['success']=='true')
             {
                 $userId=str_replace(",", "|", $managersInfo['data']);
                 $userData=get_resource_by_id(array('id'=>$userId,'fields'=>'name,designation'));
                 // print_r($userData);
             
         
        ?>

        <ul>
      <li style="padding:10px;">
         <h3><?php echo $dept; ?></h3>
      </li>

      <li class="label-lg mm-label" style="font-size: 20px;  margin-right: 32px; max-height: 100px; overflow-y: scroll;
font-weight: 700;
text-transform: uppercase;
text-indent: 20px;
line-height: 45px;font-family: "Arial", sans-serif;">Managers</li>
      <li class="manager-list">
         <?php if ($userData['success']=='true' && $userData['data']!='')
            {
                        foreach($userData['data'] as $user1)
                            {
                   ?>
                            <span><?php echo $user1['name']; ?></span> 
                      <?php } ?>
              </li>
              <li class="text-center"><button type="button" style="margin-top: 20px; margin-bottom: 10px;" class="btn btn-theme-inverse btn-transparent" id="view">View all member</button></li>
              <li class="" id="viewmore" style="display: none">
                 <form>
                    <table cellpadding="0" cellspacing="0" border="0" class="table custom_tabel table-striped" id="table-example">
                       <thead>
                          <tr>
                             <th><input type="checkbox" id="inlineCheckbox1" value="option1"></th>
                             <th>Designation</th>
                             <th>Action</th>
                          </tr>
                       </thead>
                       <tbody align="center">
                    <?php foreach($userData['data'] as $user2) 
                        {  ?>
                          <tr class="odd gradeX">
                             <td><input type="checkbox" id="inlineCheckbox1" value="option1"></td>
                             <td><?php echo $user2['designation']; ?></td>
                             <td>
                                <select  class="selectpicker form-control" data-style="btn-theme-inverse">
                                   <option>Manager</option>
                                   <option>Member</option>
                                </select>
                             </td>
                          </tr>
                    <?php 
                        }
            }
                     ?>
               </tbody>
            </table>
         </form>
      </li>
   </ul>
   <?php
}
else
{
?>
<ul>
<li style="padding:9px;">
         <h3><?php echo $dept; ?></h3>
      </li>

 <li class="label-lg mm-label">No record Found</li>
</ul>
<?php
}
   ?>
   

<script>
$(document).ready(function(){
        $(".slide-toggle").click(function(){
             $("html").removeClass(" mm-right mm-opened mm-opening");
         // $(".mm-menu").css({ 'background' : '' });
 
          
        });

    });
$(document).ready(function(){
   $("#view").click(function(){
   
        $("#viewmore").show();
});  });
</script>
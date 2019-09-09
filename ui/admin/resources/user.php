<?php
/* Check User Permission */
if (check_user_permission('resources', 'users', 'all') != '1' || check_user_permission('resources', 'users', 'view') != '1') {
    header("location:" . site_url() . "admin/404");
}
global $companyId;
$login_user = is_user_logged_in();
$cat = get_category(array());
$all_cats = $cat['data'];


$get_modules = get_modules(array());
//print_r($get_modules);

$get_roles = get_roles(array());
$get_roles = $get_roles['data'];
$role = get_roles(array());
$role = $role['data'];
//print_r($role);
$get_module_json = get_module_json(array());
$user_role = $get_module_json['data'];

$mr1 = array();
$usr_role = '';
$id = isset($_GET['id']) ? $_GET['id'] : '';
$category = array();
$machine = array();
if ($id) {
    $id = str_replace(' ', '+', $id);
    $decrypt = encrypt_decrypt('', 'decrypt', 'nikky', $id);
    $id = $user_id = str_replace(array('\'', '"'), '', $decrypt['data']);
    $get_users = get_users(array('id' => $id));
    $user = $get_users['data'][0];
    $usr_role = $user['role'];
    $category = $user['category'];
    $machine = $user['machine'];
    $user_role_sel = get_roles(array('id' => $usr_role));
    $select_user_roles = ucfirst($user_role_sel['data'][0]['title']);
}
if (isset($user_id)) {
    $imageData = get_media(array('smid' => '1', 'asmid' => '1', 'amid' => '1', 'aiid' => $user_id, 'object' => 'true'));
    $profileImage = $imageData['data'][0];
}
$get_user_login_data = get_resource_by_id(array('id' => $login_user, 'fields' => 'user_type,name,role,designation'));
if ($get_user_login_data['success'] == 'true') {
    $get_user_login = $get_user_login_data['data'][0];
    $user_role = get_roles(array('id' => $get_user_login['role']));
    $login_user_roles = $user_role['data'][0]['title'];
}

/* $imageData=get_association_data("1","10","1",$id);
  $profile_picture='';
  if(isset($imageData['media']['1'][$id][0]['mediaName']))
  {
  $profile_picture=$imageData['media']['1'][$id][0]['mediaName'];
  } */

//if($profile_picture!=''){$img_url=site_url().'uploads/media/images/'.$profile_picture;}  
//else{$img_url=admin_assets_url().'img/avatar.png';}


if (isset($profileImage) && $profileImage != '') {

    $img_url = $profileImage['url'];
} else {
    $img_url = site_url() . 'company/' . $companyId . '/uploads/default_media/avatar.png';
}
?>

<?php get_admin_header(); ?>

<?php get_admin_header_menu(); ?>

<?php get_admin_left_sidebar(); ?> 

<?php include_once(include_admin_template("resources", "user")); ?>

<script>
    var uid = '<?php echo $id; ?>';
    var ui_url = '<?php echo ui_url(); ?>';
    var admin_ui_url = '<?php echo admin_ui_url(); ?>';
    var site_url = '<?php echo site_url(); ?>';
    var admin_assets_url = '<?php echo admin_assets_url(); ?>';
    var addUserurl = '<?php echo get_url("addUser") ?>';
    var userDetailurl = '<?php echo get_url("userDetail") ?>';
    var usr_role = '<?php echo $usr_role; ?>';
    var user_roles = '<?php echo $login_user_roles; ?>';
    var select_user_roles = '<?php echo $select_user_roles; ?>';
    var id = '<?php echo $id; ?>';
    function show_hide_permission(id) {
        if (id == 'show') {

            $("#rolePermission").slideDown();
            $("#perHide").show();
            $("#perShow").hide();

        } else if (id == 'hide') {
            $("#rolePermission").slideUp();
            $("#perShow").show();
            $("#perHide").hide();
        }
    }
    $(document).ready(function () {
        if (uid != '')
        {
            var prers = usr_role.split(",");

            for (i = 0; i < prers.length; i++)
            {
                $('#ch_' + prers[i]).attr('checked', "checked");

            }
        }
        if (id != '')
        {
            if (user_roles == 'admin')
            {
                $('#machine_div').hide();
                $('#attender').attr('checked', 'checked');
                setTimeout(function () { $('#user_machine').modal(),1000});
            } else
            {
                var radioValue = $("input[name='numbers[]']:checked").val();
                if (radioValue == '5cf4c668518be4001e000032')
                {
                    $('#attender_div').hide();
                    $('#selected_role').html(select_user_roles);
                    $('#machine').attr('checked', 'checked');

                } else
                {
                    $('#machine_div').hide();
                    $('#selected_role').html(select_user_roles);
                    $('#attender').attr('checked', 'checked');
                   setTimeout(function () { $('#user_machine').modal(),1000});
                }

            }
        }
    });


</script>
<script type="text/javascript" src="<?php echo getAdminJsUrl('resources', 'user'); ?>"></script>  
<script type="text/javascript" src="<?php echo getAdminJsUrl('resources', 'role'); ?>"></script>  
<?php get_admin_footer(); ?> 


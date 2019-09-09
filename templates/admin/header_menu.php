<?php
global $companyId;
$l = "";
$get_notification = get_notification_by_id(array("id" => 0, "userId" => $_SESSION['user']["user_id"], 'desktopNotification' => '1', 'seen' => '0'));
if (sizeof($get_notification['data']) > 0) {
    $l = sizeof($get_notification['data']);
}


$currentUserid = $_SESSION['user']["user_id"];
$profile_picture = '';
$imageData = get_media(array('smid' => '1', 'asmid' => '1', 'amid' => '1', 'aiid' => $_SESSION['user']["user_id"], 'object' => 'true'));
$profile_picture1 = $imageData['data'];

if (isset($profile_picture1) && !empty($profile_picture1)) {
    $profile_picture = $profile_picture1;
}

if ($profile_picture != '') {
    $profile_picture = end($profile_picture);
    $img_url = $profile_picture['url'];
} else {
    $img_url = admin_assets_url() . 'img/avatar.png';
}
?>
<div id="header">

    <div class="logo-area clearfix">
        <a href="#" class="logo"></a>
    </div>
    <!-- //logo-area-->

    <div class="tools-bar">
        <ul class="nav navbar-nav nav-main-xs">
            <li><a href="javascript:void(0);" class="icon-toolsbar nav-mini"><img  src="<?php echo site_url(); ?>company/<?php echo $companyId; ?>/sidebar-logo.png"></a></li>
        </ul>
        <!--     <div style="position: absolute;right: 20%;top: 9px">
              <button class="btn_actoin languageButton btn-sm" onclick="change_language('ch')" type="button" style="background-color: Transparent; border: none;"> <?php // echo $ui_string['chinese_lang'];   ?> </button>
              <button class="btn_actoin languageButton btn-sm" onclick="change_language('en')" type="button" style="background-color: Transparent; border: none;" > <?php // echo $ui_string['english_lang'];   ?> </button>
            </div> -->
        <ul class="nav navbar-nav navbar-right tooltip-area">
            <!--<li class="hidden-xs hidden-sm"><a href="#" class="h-seperate">Help</a></li>--> 
            <!--<li><button class="btn btn-circle btn-header-search" ><i class="fa fa-search"></i></button></li>-->
            <li class="dropdown"><a href="#" class="avatar-header dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" onclick="showhide();"> 
                    <img alt="" src="<?php echo $img_url; ?>"  class="circle"> <span class="badge" id="nmb"><?php echo $l; ?></span> </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <div class="panel-heading b-light bg-light"> <strong><?php echo $ui_string['youhave']; ?> <span class="count" style="display: inline;" id="nlen"><?php echo $l; ?></span> <?php echo $ui_string['notification']; ?></strong> </div>
                    <li>
                        <div class="widget-im notification">
                            <ul  id="set_ntfc" class="icon-right arrow">


                            </ul>
                            <div class="panel-heading b-light bg-light"><span class="cur" style="cursor: pointer;"  onclick="window.location = '<?php echo site_url(); ?>admin/notification'"><?php echo $ui_string['seeallnoti']; ?></span></div>
                        </div>
                    </li>
                </ul>
            </li>
            <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"> <em><?php echo $ui_string['welcome']; ?>, <?php echo $_SESSION['user']["name"]; ?> </em> <i class="dropdown-icon fa fa-angle-down"></i> </a>
                <ul class="dropdown-menu pull-right icon-right arrow">
                  <!--<li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
                          <li><a href="#"><i class="fa fa-cog"></i> Setting </a></li>
                          <li><a href="#"><i class="fa fa-bookmark"></i> Bookmarks</a></li>-->
                    <li><a href="<?php echo site_url(); ?>admin/profile"><i class="fa fa-user"></i> <?php echo $ui_string['profile']; ?> </a></li>
                    <li class="divider"></li>
                     <!-- <li><a href="<?php echo site_url(); ?>admin/language"><i class="fa fa-language"></i> <?php echo $ui_string['language']; ?> </a></li>
                    <li class="divider"></li> -->
                    <li style="text-transform: capitalize;"><a onclick="logout();" href="javascript:"><i class="fa fa-sign-out"></i> <?php echo $ui_string['signout']; ?> </a></li>

                </ul>
                <!-- //dropdown-menu--> 
            </li>
            <li>&nbsp;</li>
            <!--<li class="visible-lg"> <a href="#" class="h-seperate fullscreen" data-toggle="tooltip" title="Full Screen" data-container="body"  data-placement="left"> <i class="fa fa-expand"></i> </a> </li>-->
        </ul>


    </div>
    <!-- //tools-bar-->

</div>
<?php
$csrf = new CSRF_Protect();
$csrf->echoInputField();
?>
<script>

    function ssologout() {
        $.ajax({
            url: admin_ui_url + "sso/logout1.php",
            type: "POST",
            data: "type=ssologout",
            success: function (suc) {
                setTimeout(function () {
                    window.location = 'https://yashduggal5.auth0.com/v2/logout?returnTo=http://localhost/Teamerge/ui/admin/sso/admin_index.php';
                }, 200);
            }


        });
    }

    function logout() {
        $.ajax({
            url: admin_ui_url + "logout.php",
            type: "POST",
            data: "type=logout&_csrf=" + $('#_csrf').val(),
            success: function (suc) {
                setTimeout(function () {
                    window.location = admin_ui_url;
                }, 200);
            }
        });
    }


    function gotopage(id, path, uid2, customer_id)
    {
        $.ajax({
            url: "<?php echo admin_ui_url(); ?>notification/ajax/notification_manage.php",
            data: "id=" + id + "&customer_id=" + customer_id + "&action=update_notification",
            type: "post",
            success: function (suc)
            {
                var urlpath = window.atob(path);
                var check = urlpath.split("?");
                if (check.length == 1)
                {
                    window.open("<?php echo site_url(); ?>admin/" + window.atob(path), '_blank');
                }
                else
                {
                    window.open("<?php echo site_url(); ?>admin/" + window.atob(path), '_blank');
                }
            }
        })

    }

    function getNTFCCount(action)
    {
        if (action == 1)
        {
            $.ajax({
                url: "<?php echo admin_ui_url(); ?>notification/ajax/notification_manage.php",
                data: "userId=<?php echo $currentUserid; ?>&action=count_notification",
                type: "post",
                success: function (suc)
                {
                    /*if(suc.trim()=='logout')
                     {
                     window.location='signout.php';
                     }*/
                    var a = JSON.parse(suc);
                    if (a != '' && a != undefined)
                    {
                        var l = "";
                        $("#nmb").hide();
                        if (a['data'] > 0)
                        {
                            l = a['data'];
                            $("#nmb").html(l);
                            $("#nlen").html(l);
                            $("#nmb").show();
                        }
                    }

                }
            })
        }
        else
        {
            $.ajax({
                url: "<?php echo admin_ui_url(); ?>notification/ajax/notification_manage.php",
                data: "userId=<?php echo $currentUserid; ?>&action=get_notification&index=0",
                type: "post",
                success: function (suc)
                {
                    var a = JSON.parse(suc);
                    var l = "";
                    $("#nmb").hide();
                    if (a['data'].length > 0)
                    {
                        l = a['data'].length;
                        $("#nmb").show();
                    }
                    var str = "";
                    var count = 1;
                    for (i = 0; i < l; i++)
                    {
                        //var nottxt=ui_string['eid'+a['data'][i].eventid];
                        var p = window.btoa(a['data'][i].url1);
                        var nid = a['data'][i].id;
                        var uid2 = a['data'][i].uid2;
                        var seen = (a['data'][i].seen == 0) ? 'style="background:#F7F7F7"' : '';
                        str += '<li style="cursor:pointer">';
                        str += '<section class="thumbnail-in" ' + seen + ' onclick="gotopage(\'' + nid + '\',\'' + p + '\',\'' + uid2 + '\',' + l + ');">';
                        str += '<div class="widget-im-tools tooltip-area pull-right"><span>';
                        str += a['data'][i].timeago + ' ago';
                        str += '</span></div><h4> ' + a['data'][i].t + '</h4>';
                        str += '<div class="pre-text"> ' + ui_string['urlGo'] + ' ' + a['data'][i].url1 + ' </div>';
                        str += '</section></li>';
                        count++;
                        if (count > 10)
                        {
                            break;
                        }
                    }
                    $("#set_ntfc").html(str);

                }
            })
        }

    }

    setInterval(function () {
        getNTFCCount(1);
    }, 20000);

    function showhide()
    {
        $("#nmb").toggle();
        getNTFCCount(2);
    }
    function user_login_check() {

        setInterval(function () {

            var admin_ui_url = '<?php echo admin_ui_url(); ?>';
            var formData = "";

            $.ajax({
                type: "POST",
                url: admin_ui_url + "resources/ajax/add_user.php?action=check_user_login_status",
                data: formData,
                success: function (data) {
                    if (data == 0) {

                        setTimeout(function () {
                            window.location = admin_ui_url;
                        }, 1000);
                    }

                }
            });

        }, 10000);
    }
//user_login_check();
</script>

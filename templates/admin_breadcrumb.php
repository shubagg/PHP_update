<span style="display:none;" class="top-advance-search"><button class="btn btn-default" onclick="$('#adv_search').slideToggle();"  style="background: transparent; border: none;" >Advance Search <i class="fa fa-plus-circle" aria-hidden="true"></i></button></span>
<?php include_once(include_admin_template("common_templates/default", "default_advanced_search")); ?>
<ol class="breadcrumb">
    <?php
    $crumbs = explode("/", $_SERVER["REQUEST_URI"]);
    unset($crumbs[0]);
    if (ENVIROMENT_ACCESS == 0) {
        unset($crumbs[1]);
    }
    $newurl = "";
    if (isset($crumbs[3]) && $crumbs[3] == 'manageblog') {
        $newurl = explode("?", $crumbs[4]);
        $newfield = explode("&", $newurl[1]);
        $newurl = $newfield[0];
    }
    $bcrumb = "";
    $totalBread = sizeof($crumbs);
    $k = 1;
    $cb = array();
    if (isset($_GET['panel']) && $_GET['panel'] != '') {
        $bcrumb .= '<li><a href="javascript:;" onclick="window.location=\'' . site_url() . 'admin/coach\'">Admin Panel</a></li>';
    }
    foreach ($crumbs as $crumb) {
        $tmp = explode("?", $crumb);
        $exClass = '';
        array_push($cb, $tmp[0]);

        if ($totalBread == $k) {
            $exClass = 'class="active"';
        }
        $bcrumb .= '<li ' . $exClass . '>';
        if ($totalBread == $k || $k == 1) {
            $ihc = explode('-', $tmp[0]);

            $bcrumb .= ucwords(str_replace(array(".php", "-", "_"), array("", " ", " "), $tmp[0]) . ' ');
        } else {

            if ($newurl != "") {
                $bcrumb .= '<a href="' . site_url() . implode("/", $cb) . '?' . $newurl . '">' . ucwords(str_replace(array(".php", "-", "_"), array("", " ", " "), $tmp[0]) . ' ') . '</a>';
            } else {
                $bcrumb .= '<a href="' . site_url() . implode("/", $cb) . '">' . ucwords(str_replace(array(".php", "-", "_"), array("", " ", " "), $tmp[0]) . ' ') . '</a>';
            }
        }
        $bcrumb .= '</li>';
        $k++;
    }
    echo $bcrumb;
    ?>
</ol>
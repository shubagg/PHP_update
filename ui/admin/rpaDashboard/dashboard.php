<?php
/*Check User Permission*/
if(check_user_permission('dashboard', 'dashboard', 'all') != '1' || check_user_permission('dashboard', 'dashboard', 'view') != '1') {
    header("location:".site_url()."admin/404");
}
include_once("../../../global.php");
$userIds = is_user_logged_in();
//check_user_permission_with_redirect("rpa","chatbot");
$companyData = get_company_data();
//$userInfo = get_user_hirarchy(array('userId' => $userIds, 'mongoObject' => 'true'));
//$userInfos=implode('|',$userInfo['data']);
//$where=array('status'=>'1','id'=>$userInfos,'fields'=>'name,email');
$where = array('status' => '1', 'id' => $userIds, 'fields' => 'machine,role');
$machine = curl_post("/get_resource_by_id", $where);
$user_role = get_roles(array('id' => $machine['data'][0]['role']));
$user_roles='';
if($user_role['success']=='true')
{
  $user_roles=$user_role['data'][0]['title'];  
}
$machine_chart_id=$userIds;
$machine_id = implode('|', $machine['data'][0]['machine']);
$where_condition = array('status' => '1', 'id' => $machine_id, 'fields' => 'name,email');
$return = curl_post("/get_resource_by_id", $where_condition);
if($return['success']=='true')
{
    $machine_chart_id=$return['data'][0]['id'];

}
//for get robot list
if (isset($_SESSION['user']['email']) && !empty($_SESSION['user']['email'])) {
    $get_robot = curl_post("/get_all_robot_list", array('username' => $_SESSION['user']['email']));
}
$strt_date = '';
$end_date = '';
$strt_date_scheduler = '';
$strt_date_task_done = '';
$robot_id_task_done = '';

$userId = $userIds;  
if (isset($_SESSION['robot_status_user']['userId']) && !empty($_SESSION['robot_status_user']['userId'])) {
    $userChecked = explode(',', $_SESSION['robot_status_user']['userId']);
    $userId = $_SESSION['robot_status_user']['userId'];
}
else if($user_roles=='user')
{
  $userId = $machine_chart_id;  
}
if (isset($_SESSION['robot_status_user']['strt_date']) && !empty($_SESSION['robot_status_user']['strt_date'])) {
    $strt_date = $_SESSION['robot_status_user']['strt_date'];
}
if (isset($_SESSION['robot_status_user']['end_date']) && !empty($_SESSION['robot_status_user']['end_date'])) {
    $end_date = $_SESSION['robot_status_user']['end_date'];
}
$user_id_scheduler = $userIds;  

if (isset($_SESSION['scheduler_user']['userId']) && !empty($_SESSION['scheduler_user']['userId'])) {
    $user_checked_scheduler = explode(',', $_SESSION['scheduler_user']['userId']);
    $user_id_scheduler = $_SESSION['scheduler_user']['userId'];
}
else if($user_roles=='user')
{
  $user_id_scheduler = $machine_chart_id;  
}
if (isset($_SESSION['scheduler_user']['strt_date']) && !empty($_SESSION['scheduler_user']['strt_date'])) {
    $strt_date_scheduler = $_SESSION['scheduler_user']['strt_date'];
}


//for task done dashboard

if (isset($_SESSION['task_done']['strt_date']) && !empty($_SESSION['task_done']['strt_date'])) {
    $strt_date_task_done = $_SESSION['task_done']['strt_date'];
}
if (isset($_SESSION['task_done']['robotId']) && !empty($_SESSION['task_done']['robotId'])) {
    $robot_id_task_done = $_SESSION['task_done']['robotId'];
}
$user_id_robot_run_count = $userIds;

if (isset($_SESSION['robot_run_count']['userId']) && !empty($_SESSION['robot_run_count']['userId'])) {
    $user_checked_robot_run_count = explode(',', $_SESSION['robot_run_count']['userId']);
    $user_id_robot_run_count = $_SESSION['robot_run_count']['userId'];
}
else if($user_roles=='user')
{
  $user_id_robot_run_count = $machine_chart_id;  
}
if (isset($_SESSION['robot_run_count']['strt_date']) && !empty($_SESSION['robot_run_count']['strt_date'])) {
    $strt_date_robot_run_count = $_SESSION['robot_run_count']['strt_date'];
}
?>
<?php get_admin_header(); ?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<?php get_admin_header_menu($language); ?>
<?php get_admin_left_sidebar($language); ?> 
<style>
    #content{
        position:relative;
    }
    .show-user_slide span{    position: absolute;
                              right: -14px;
                              background-color: red;
                              color: #fff;
                              width: 26px;
                              text-align: center;
                              border-radius: 70px;
                              height: 20px;
    }
    .slidePanel-content {
        height: 82vh;
    }
    #user-profilee{
        height:80vh;
        overflow: hidden;
        overflow-y: auto;
    }
    #user-profilee::-webkit-scrollbar {
        width: 5px;
    }

    #user-profilee::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    }

    #user-profilee::-webkit-scrollbar-thumb {
        background-color: #4f6e88;
        outline: 1px solid slategrey;
    }

    .slidePanel-content {
        position: absolute;
        z-index: 1310;
        max-width: 100%;
        max-height: 82vh;
        background: #fff;
        -webkit-box-shadow: -5px 0 20px 0 rgba(66,66,66,.2);
        box-shadow: -5px 0 20px 0 rgba(66,66,66,.2);
        top: 0px;
        right:0px;
        display:none;
        width: 340px;
        padding:10px;
    }

    .media .media-list  {
        float:left;
        margin-right:10px;
    }
    .media-list h5{
        color: #424242;
        font-weight: 500;
        font-family: Roboto,sans-serif;
        margin-bottom:5px;
    }
    .show-user_slide{
        cursor: pointer;
        position: relative;
    }
    .show-user_slide i{
        font-size: 32px;
    }
    .breadcrumb{
        padding:18px 20px 25px 20px;
    }
    .avatar img {
        width: 34px;
        border-radius: 100px;
    }
    small{
        font-size: 80%;
        font-weight: 300;
        margin-top:20px;
    }
    .taskaction{
        background-color: #fff;
        height: 150px;
        margin: 20px 0px 20px 0px;
        padding: 10px;
    }

    .table thead > tr > th, .table tbody > tr > th, .table tfoot > tr > th, .table thead > tr > td, .table tbody > tr > td, .table tfoot > tr > td {		    
        border-left: none;
    }
    .table>thead:last-child>tr:last-child>td{
        border-right: none;
    }
    .table thead > tr > td{
        color:#fff;
    }
    .table thead > tr > td:nth-last-child(1) {
        border-right: none;
    } 
    .table tbody > tr > td:nth-last-child(1) {
        border-right: none;
    } 
    .table tbody > tr > td {
        border-bottom: none;
    } 

    .graph_left_right{
        margin-left:-60px;
    }
    .graph_center{
        text-align: center;
        margin-left:5px;
    }


</style>
<?php if (!check_user_permission("dashboard", "dashboard", "all") == 1) { ?>
    <div id="main">
        <ol class="breadcrumb">
            <li>Admin </li>
            <li class="active">Dashboard </li>

        </ol>

        <script>
            function checkalldata() {}
        </script>
        <div id="content">
            <div class="row">
                <h1 style="text-align: center;"><b>Welcome To Admin Panel</b></h1>
            </div>
        </div>
        <?php
    } else {
        include_once(include_admin_template("rpaDashboard", "dashboard"));
        ?>
        <div class="clearfix"></div>
        <?php
        include($server_path . "ui/admin/rpaDashboard/chatsection.php");
    }
    ?>
    <script>
        $(document).ready(function () {
            $(".show-user_slide").click(function () {
                $(".slidePanel-content").animate({
                    width: "toggle",
                    display: "block",
                });
            });
        });
    </script>
    <script>
        var ui_url = '<?php echo ui_url(); ?>';
        var admin_ui_url = '<?php echo admin_ui_url(); ?>';
        var panelId = '<?php echo $_SESSION['user']['user_id']; ?>';
        var user_ids = '<?php echo $userId; ?>';
        var strt_date = '<?php echo $strt_date; ?>';
        var end_date = '<?php echo $end_date; ?>';
        var user_ids_scheduler = '<?php echo $user_id_scheduler; ?>';
        var strt_date_scheduler = '<?php echo $strt_date_scheduler; ?>';
        var user_ids_task_done = '<?php echo $user_ids_robot_run_count; ?>';
        var strt_date_task_done = '<?php echo $strt_date_robot_run_count; ?>';
        var user_ids_robot_run_count = '<?php echo $user_id_robot_run_count; ?>';
        var strt_date_robot_run_count = '<?php echo $strt_date_robot_run_count; ?>';
        var robot_id_task_done = '<?php echo $robot_id_task_done; ?>';
        var chatcounter = 1;
        var helpcounter = 1;
        var logo_url = '<?php echo admin_assets_url(); ?>/img/loaders.gif"';
    </script>
    <link type="text/css" rel="stylesheet" href="<?php echo site_url() . "company/" . $companyData['cid'] . "/assets/chart/css/chat.css"; ?>" />
    <script type="text/javascript" src="<?php echo site_url() . "company/" . $companyData['cid'] . "/assets/chart/js/prettify.js"; ?>"></script>
    <script type="text/javascript" src="<?php echo site_url() . "company/" . $companyData['cid'] . "/assets/chart/js/gauge.js"; ?>"></script>  
    <script type="text/javascript" src="<?php echo admin_ui_url(); ?>rpaDashboard/js/chat.js"></script>
    <script type="text/javascript" src="<?php echo site_url() . "company/" . $companyData['cid'] . "/"; ?>assets/js/chat-bot.js"></script>
    <script type="text/javascript" src="<?php echo site_url() . "company/"; ?>js/rpaDashboard/charts.js"></script>

    <script type="text/javascript">
        prettyPrint();

        $('#divisionsCbx').click(function () {
            $('.subDivisions').toggle();
            $('#subDivisions').toggle();
            fdSlider.redrawAll();
        })

        function update() {
            var opts = {};
            var tmp_opts = opts;
            tmp_opts.renderTicks = {};

            if ($('.subDivisions:visible').length) {
                $('.renderTicks').each(function () {
                    var val = $(this).hasClass("color") ? this.value : parseFloat(this.value);
                    if ($(this).hasClass("color")) {
                        val = "#" + val;
                    }
                    if (this.name.indexOf("divLength") != -1 ||
                            this.name.indexOf("subLength") != -1) {
                        val /= 100;
                    }
                    if (this.name.indexOf("divWidth") != -1 ||
                            this.name.indexOf("subWidth") != -1) {
                        val /= 10;
                    }

                    $('#opt-' + this.name.replace(".", "-")).text(val);

                    if (this.name.indexOf(".") != -1) {
                        var elems = this.name.split(".");

                        for (var i = 0; i < elems.length - 1; i++) {
                            if (!(elems[i] in tmp_opts)) {
                                tmp_opts.renderTicks[elems[i]] = {};
                            }
                            tmp_opts = tmp_opts.renderTicks[elems[i]];
                        }
                        tmp_opts.renderTicks[elems[elems.length - 1]] = val;
                    } else if ($(this).hasClass("color")) {
                        // color picker is removing # from color values
                        opts.renderTicks[this.name] = "#" + this.value
                        $('#opt-' + this.name.replace(".", "-")).text("#" + this.value);
                    } else {
                        opts.renderTicks[this.name] = val;
                    }
                });
            }


            $('.opts input[min], .opts .color').not('.renderTicks').each(function () {
                var val = $(this).hasClass("color") ? this.value : parseFloat(this.value);
                if ($(this).hasClass("color")) {
                    val = "#" + val;
                }
                if (this.name.indexOf("lineWidth") != -1 ||
                        this.name.indexOf("radiusScale") != -1 ||
                        this.name.indexOf("angle") != -1 ||
                        this.name.indexOf("pointer.length") != -1) {
                    val /= 100;
                } else if (this.name.indexOf("pointer.strokeWidth") != -1) {
                    val /= 1000;
                }
                $('#opt-' + this.name.replace(".", "-")).text(val);
                if (this.name.indexOf(".") != -1) {
                    var elems = this.name.split(".");
                    var tmp_opts = opts;
                    for (var i = 0; i < elems.length - 1; i++) {
                        if (!(elems[i] in tmp_opts)) {
                            tmp_opts[elems[i]] = {};
                        }
                        tmp_opts = tmp_opts[elems[i]];
                    }
                    tmp_opts[elems[elems.length - 1]] = val;
                } else if ($(this).hasClass("color")) {
                    // color picker is removing # from color values
                    opts[this.name] = "#" + this.value
                    $('#opt-' + this.name.replace(".", "-")).text("#" + this.value);
                } else {
                    opts[this.name] = val;
                }
                if (this.name == "currval") {
                    // update current demo gauge
                    demoGauge.set(parseInt(this.value));
                    AnimationUpdater.run();
                }
            });
            $('#opts input:checkbox').each(function () {
                opts[this.name] = this.checked;
                $('#opt-' + this.name).text(this.checked);
            });
            demoGauge.animationSpeed = opts.animationSpeed;
            opts.generateGradient = true;
            console.log(opts);
            demoGauge.setOptions(opts);
            demoGauge.ctx.clearRect(0, 0, demoGauge.ctx.canvas.width, demoGauge.ctx.canvas.height);
            demoGauge.render();
            if ($('#share').is(':checked')) {
                window.location.replace('#?' + $('form').serialize());
            }

        }
        function initGauge() {
            document.getElementById("class-code-name").innerHTML = "Gauge";
            demoGauge = new Gauge(document.getElementById("canvas-preview"));
            demoGauge.setTextField(document.getElementById("preview-textfield"));
            demoGauge.maxValue = 3000;
            demoGauge.set(1244);
        }
        ;
        function initDonut() {
            document.getElementById("class-code-name").innerHTML = "Donut";
            demoGauge = new Donut(document.getElementById("canvas-preview"));
            demoGauge.setTextField(document.getElementById("preview-textfield"));
            demoGauge.maxValue = 3000;
            demoGauge.set(1244);
        }
        ;
        function initZones() {
            document.getElementById("class-code-name").innerHTML = "Gauge";
            demoGauge = new Gauge(document.getElementById("canvas-preview"));
            var opts = {
                angle: -0.25,
                lineWidth: 0.2,
                radiusScale: 0.9,
                pointer: {
                    length: 0.6,
                    strokeWidth: 0.05,
                    color: '#000000'
                },
                staticLabels: {
                    font: "10px sans-serif",
                    labels: [200, 500, 2100, 2800],
                    fractionDigits: 0
                },
                staticZones: [
                    {strokeStyle: "#F03E3E", min: 0, max: 200},
                    {strokeStyle: "#FFDD00", min: 200, max: 500},
                    {strokeStyle: "#30B32D", min: 500, max: 2100},
                    {strokeStyle: "#FFDD00", min: 2100, max: 2800},
                    {strokeStyle: "#F03E3E", min: 2800, max: 3000}
                ],
                limitMax: false,
                limitMin: false,
                highDpiSupport: true
            };
            demoGauge.setOptions(opts);
            demoGauge.setTextField(document.getElementById("preview-textfield"));
            demoGauge.minValue = 0;
            demoGauge.maxValue = 3000;
            demoGauge.set(1244);
        }
        ;
        function initNew() {
            document.getElementById("class-code-name").innerHTML = "Gauge";
            demoGauge = new Gauge(document.getElementById("canvas-preview"));
            var bigFont = "14px sans-serif";
            var opts = {
                angle: 0.1,
                radiusScale: 0.9,
                lineWidth: 0.2,
                pointer: {
                    length: 0.6,
                    strokeWidth: 0.05,
                    color: '#000000'
                },
                staticLabels: {
                    font: "10px sans-serif",
                    labels: [{label: 200, font: bigFont},
                        {label: 750},
                        {label: 1500},
                        {label: 2250},
                        {label: 3000},
                        {label: 3500, font: bigFont}],
                    fractionDigits: 0
                },
                staticZones: [
                    {strokeStyle: "rgb(255,0,0)", min: 0, max: 500, height: 1.2},
                    {strokeStyle: "rgb(200,100,0)", min: 500, max: 1000, height: 1.1},
                    {strokeStyle: "rgb(150,150,0)", min: 1000, max: 1500, height: 1},
                    {strokeStyle: "rgb(100,200,0)", min: 1500, max: 2000, height: 0.9},
                    {strokeStyle: "rgb(0,255,0)", min: 2000, max: 3100, height: 0.8},
                    {strokeStyle: "rgb(80,255,80)", min: 3100, max: 3500, height: 0.7},
                    {strokeStyle: "rgb(130,130,130)", min: 2470, max: 2530, height: 1}
                ],
                limitMax: false,
                limitMin: false,
                highDpiSupport: true
            };
            demoGauge.setOptions(opts);
            document.getElementById("preview-textfield").className = "preview-textfield";
            demoGauge.setTextField(document.getElementById("preview-textfield"));
            demoGauge.minValue = 0;
            demoGauge.maxValue = 3500;
            demoGauge.set(2122);
        }
        ;
        $(function () {
            var params = {};
            var hash = /^#\?(.*)/.exec(location.hash);
            if (hash) {
                $('#share').prop('checked', true);
                $.each(hash[1].split(/&/), function (i, pair) {
                    var kv = pair.split(/=/);
                    params[kv[0]] = kv[kv.length - 1];
                });
            }
            $('.opts input[min], #opts .color').each(function () {
                var val = params[this.name];
                if (val !== undefined)
                    this.value = val;
                this.onchange = update;
            });
            $('.opts input[name=currval]').mouseup(function () {
                AnimationUpdater.run();
            });

            $('.opts input:checkbox').each(function () {
                this.checked = !!params[this.name];
                this.onclick = update;
            });
            $('#share').click(function () {
                window.location.replace(this.checked ? '#?' + $('form').serialize() : '#!');
            });

            $("#type-select li").click(function () {
                $("#type-select li").removeClass("active")
                $(this).addClass("active");
                var type = $(this).attr("type");
                if (type == "donut") {
                    initDonut();
                    $("input[name=lineWidth]").val(10);
                    $("input[name=fontSize]").val(24);
                    $("input[name=angle]").val(35);
                    $("#preview-textfield").removeClass("reset");
                    $("input[name=colorStart]").val("6F6EA0")[0].color.importColor();
                    $("input[name=colorStop]").val("C0C0DB")[0].color.importColor();
                    $("input[name=strokeColor]").val("EEEEEE")[0].color.importColor();

                    fdSlider.disable('input-ptr-len');
                    fdSlider.disable('input-ptr-stroke');
                    $("#input-ptr-color").prop('disabled', true);

                    selectGaguge1.set(1);
                    selectGaguge2.set(3000);
                    selectGauge3.set(1);
                    selectGauge4.set(1);

                } else if (type == "zones") {
                    initZones();
                    fdSlider.disable('input-ptr-len');
                    fdSlider.disable('input-ptr-stroke');
                    $("#preview-textfield").removeClass("reset").addClass("reset");
                    $("input[name=angle]").val(-20);
                    $("input[name=lineWidth]").val(20);

                    fdSlider.enable('input-ptr-len');
                    fdSlider.enable('input-ptr-stroke');
                    $("input[name=colorStart]").prop('disabled', true);
                    $("input[name=colorStop]").prop('disabled', true);
                    $("input[name=strokeColor]").prop('disabled', true);

                    $("input[name=colorStop]").prop('disabled', true);
                    $("input[name=strokeColor]").prop('disabled', true);

                    selectGaguge1.set(1);
                    selectGaguge2.set(1);
                    selectGauge3.set(3000);
                    selectGauge4.set(1);

                } else if (type == "new") {
                    initNew();
                    $("input[name=lineWidth]").val(30);
                    $("input[name=fontSize]").val(41);
                    $("input[name=angle]").val(10);
                    $("#preview-textfield").removeClass("reset").addClass("reset");
                    selectGaguge1.set(1);
                    selectGaguge2.set(1);
                    selectGauge3.set(1);
                    selectGauge4.set(2213);
                } else {
                    initGauge();
                    $("input[name=lineWidth]").val(44);
                    $("input[name=fontSize]").val(41);
                    $("input[name=angle]").val(15);
                    $("#preview-textfield").removeClass("reset").addClass("reset");


                    $("input[name=colorStart]").val("6FADCF")[0].color.importColor();
                    $("input[name=colorStop]").val("8FC0DA")[0].color.importColor();
                    $("input[name=strokeColor]").val("E0E0E0")[0].color.importColor();

                    fdSlider.enable('input-ptr-len');
                    fdSlider.enable('input-ptr-stroke');
                    $("#input-ptr-color").prop('disabled', false);
                    selectGaguge1.set(3000);
                    selectGaguge2.set(1);
                    selectGauge3.set(1);
                    selectGauge4.set(1);
                }

            });

            selectGaguge1 = new Gauge(document.getElementById("select-1"));
            selectGaguge1.maxValue = 0.1;
            selectGaguge1.set(0.0);



            selectGaguge2 = new Donut(document.getElementById("select-2"));
            selectGaguge2.maxValue = 0;
            selectGaguge2.set(0);

            selectGaguge3 = new Donut(document.getElementById("select-3"));
            selectGaguge3.maxValue = 0;
            selectGaguge3.set(0);


            selectGaguge21 = new Donut(document.getElementById("select-21"));
            selectGaguge21.maxValue = 0;
            selectGaguge21.set(0);


            selectGaguge31 = new Donut(document.getElementById("select-31"));
            selectGaguge31.maxValue = 0;
            selectGaguge31.set(0);


            initGauge();
            update();

        });
    </script>
    <script type="text/javascript" src="<?php echo admin_ui_url() . "rpaDashboard/js/dash_chart.js"; ?>"></script>
    <script>
        setInterval(function () {
            let userEmailId = $("#userEmailId").val();
            let user_machine_Id = $("#user_machine_Id").val();
            train_request_send(userEmailId, "", user_machine_Id);
        }, 60000);
    </script>
    <?php get_admin_footer(); ?> 
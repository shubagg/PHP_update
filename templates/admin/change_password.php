<!DOCTYPE html>
<html lang="en">
<head>
<!-- Meta information -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<!-- Title-->
<?php $companyData=get_company_data(); ?>
<title><?php echo ucfirst($companyData['name']); ?> |  <?php echo $ui_string['adminpanel'];?></title>
<!-- Favicons -->
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo admin_assets_url(); ?>ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo admin_assets_url(); ?>ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo admin_assets_url(); ?>ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="<?php echo admin_assets_url(); ?>ico/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="<?php echo site_url().$companyData['logo']; ?>">
<!-- CSS Stylesheet-->
<link type="text/css" rel="stylesheet" href="<?php echo admin_assets_url(); ?>css/bootstrap/bootstrap.min.css" />
<link type="text/css" rel="stylesheet" href="<?php echo admin_assets_url(); ?>css/bootstrap/bootstrap-themes.css" />
<link type="text/css" rel="stylesheet" href="<?php echo admin_assets_url(); ?>css/style.css" />
<!-- <link type="text/css" rel="stylesheet" href="<?php echo admin_assets_url(); ?>css/loader.css" /> -->
<script type="text/javascript" src="<?php echo admin_assets_url(); ?>js/jquery.min.js"></script>
<script src="<?php echo site_url()."ui/js_error.php";?>"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<style>.error {
font-size: 12px !important;
color: #f00;
}

</style>
</head>
<body class="full-lg">
<div id="wrapper">
	<div id="main">
		<div id="content">
			<section class="panel">
				<div class="panel-body">
					<form id="changePassword" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
	                    <input type="hidden" name="forgotKey" value="<?php echo $forgotKey;?>">
	                    <div class="form-group">
							<label class="control-label remove_bg"><?php echo $ui_string['new_password'];?></label>
							<div>
								<input type="password" id="password" name="password" data-check-valid="blank,gt-5" data-valid-gt-error="<?php echo $ui_string['12017'];?>" data-error-show-in="epassword" data-error-setting="2" data-error-text="<?php echo $ui_string['1209'];?>" class="form-control required_field changePassword" placeholder="" value="">
							    <span id="epassword" class="error"></span>
	                        </div>
						</div>
	                    
	                    
						<div class="form-group">
							<label class="control-label remove_bg"><?php echo $ui_string['confirm_password'];?></label>
							<div>
								<input type="password" id="confirm_password" name="confirm_password" data-match-with="password" data-valid-match-error="<?php echo $ui_string['12022'];?>" data-check-valid="blank,gt-5,match" data-valid-gt-error="<?php echo $ui_string['12017'];?>" data-error-show-in="ecpassword" data-error-setting="2" data-error-text="<?php echo $ui_string['12019'];?>" class="form-control required_field changePassword" placeholder="">
							    <span id="ecpassword" class="error"></span>
	                        </div>
						</div>

	                   
						<div class="clr"></div>

	                  
						<button  onclick="return validation('changePassword')" type="button" class="btn btn-theme-inverse right">
							<i class="glyphicon glyphicon-circle-arrow-right"></i> <?php echo $ui_string['update'];;?>
						</button>
	                 
	                    
	                    
	                    
	                 
					</form>
				</div>
				<section>
		</div>
	</div>
</div>

        
    
    
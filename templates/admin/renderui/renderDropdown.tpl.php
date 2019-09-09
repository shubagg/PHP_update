<div id="main">

			<div id="content">
				<div data-type="PROJECT_LIST" data-html-id="nav1" data-params-status="H" data-params-smid="1" class="renderComponents"></div>
				<div data-type="DASH_TYPE" class="renderComponents" data-html-label="<?php echo $ui_string['dash_type'];?>" data-html-name="priglob" data-html-type="radio" data-html-item="<?php echo $ui_string['private']; ?>:1:pri:checked:onclick=RemoveButton()|<?php echo $ui_string['global']; ?>:0:glob::onclick=GetButton();"></div>
				<div id="manageDash" style="display: none;">
				<div data-type="CHECK_BOX" class="renderComponents"  data-html-name="priglob" data-html-type="checkbox" data-html-item="manage dashboard:1:pri:::|managegadget:0:glob::"></div>
				</div>
				<div data-type="PRODUCT_LIST" data-html-id="nav1" data-params-status="H" data-params-smid="1" class="renderComponents"></div>
				<div><button onclick="customDiv()">CustomDiv</button></div>
				<div id="customDiv"></div>
				<!-- //content > row-->
			</div>
			<!-- //content-->
		</div>
		<script>
			function customDiv(){
				$("#customDiv").attr("data-type","PROJECT_LIST");
				renderComponents($("#customDiv"));
			}
			function GetButton()
			{
				$('#manageDash').css('display','block');
			}
			function RemoveButton()
			{
				$('#manageDash').css('display','none');
			}
		</script>
		<!-- //main-->

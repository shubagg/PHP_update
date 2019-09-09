<div id="main">

			<div id="content">
				<div data-type="JOB_ASSIGN_OR_CREATOR" data-html-id="nav1" data-params-userid="59073d6d6d9557d12a3c9869" data-params-smid="1" data-params-smid="5" class="renderComponents"></div>

				<div><button onclick="customDiv()">CustomDiv</button></div>
				<div id="customDiv"></div>
				<!-- //content > row-->
			</div>
			<!-- //content-->
		</div>
		<script>
			function customDiv(){
				$("#customDiv").attr("data-type","USER_LIST");
				renderComponents($("#customDiv"));
			}
		</script>
		<!-- //main-->

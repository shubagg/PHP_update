    $(function() {
			   
		//////////     MOBILE CHECK    //////////   
		var iOS = /(iPad|iPhone|iPod)/g.test( navigator.userAgent );
		var android = /mobile|android/i.test (navigator.userAgent);
		
		if(iOS || android){
			$("html").addClass("isMobile");
			if(iOS) { $(".form-control").css("-webkit-appearance","caret"); }
			$("select.input-sm,select.input-lg ").css("line-height","1.3");
		 }
		 

		//////////     TIME AGO  FUNCTION   //////////
		var zeropad = function(num) {
			return ((num < 10) ? '0' : '') + num;
		};
		var iso8601 = function(date) {
			return date.getUTCFullYear() + "-" + zeropad(date.getUTCMonth() + 1) + "-" + zeropad(date.getUTCDate()) + "T" + zeropad(date.getUTCHours()) + ":" + zeropad(date.getUTCMinutes()) + ":" + zeropad(date.getUTCSeconds()) + "Z";
		};
		function prepareDynamicDates() {
			$('time.timeago.lasted').attr("datetime", iso8601(new Date()));
		}
		//////////     TIME AGO    //////////
		prepareDynamicDates();	
		$('time.timeago').timeago();
		
		
		
		//////////     TEXTAREA  AUTO SIZE    //////////
		$('textarea[data-height="auto"]').autosize();
		 $(".widget-write-post textarea").limit({  limit: 20 });
		 
		//////////     SELETE PICKER    //////////
		$('.selectpicker').selectpicker();
		
		//////////     INPUT MAXLENGTH    //////////
		$("input[maxlength] , textarea[maxlength] ").each(function() {
			$(this).maxlength({ bornIn:"#main" }); 
		});
		
		//////////     PRETTY PRINT CODE    //////////
		//addEventListener('load', function (event) { prettyPrint() }, false);
		
		
		//////////     TAB DROP    //////////
		$('[data-provide="tabdrop"]').tabdrop();
		
		//////////     TAB NEXT    //////////
		var $tabs = $('.tabbable li');
		$('#prevtab').on('click', function() {
			$tabs.filter('.active').prev('li').find('a[data-toggle="tab"]').tab('show');
		});
		$('#nexttab').on('click', function() {
			$tabs.filter('.active').next('li').find('a[data-toggle="tab"]').tab('show');
		});
		
		
		$('#flot_view a').click(function (e) {
		  e.preventDefault()
		  $(this).tab('show')
		})


		//////////     TOP SEARCH     //////////
		$(".btn-header-search , .close-header-search").on('click',function(){
				var navSearch=$(".widget-top-search");
				navSearch.toggleClass("nav-top-search");
				if($(this).hasClass("close-header-search")){
					$.clearOverlay();
					return true;
				}
				navSearch.find("input").focus();
				$.overlay(0.4);
		});
		 
		 
		//////////     NAV AND MAIN  COLLAPSE     //////////
		 $("a.nav-collapse").on('click',function(){
				var body=$("body");
					body.toggleClass( "nav-collapse-in" );
		});
		 
		 
		//////////     MAIL  COLLAPSE     //////////
		 $(".mail-collapse").on('click',function(){
				$("#main").toggleClass( "in" );  							
		});
		//////////     MAIL FAVOURITE      //////////
		$("a.mail-favourite").click(function(){
			$(this).toggleClass( "active" );
			var star=$(this).find(".fa");
		});
		 
		 
		 
		//////////     CHAT  COLLAPSE     //////////
		$('.widget-chat .chat-collapse').on('click', function () {
            var btn=$(this), chatBody=btn.closest(".widget-chat").find(".chat-body");
			btn.find("i").toggleClass( "fa-minus" );
			btn.find("i").toggleClass( "fa-plus" );
			chatBody.slideToggle(500);
       	});	



		//////////     FULLSCREEN  TOGGLE     //////////
		$('.fullscreen').click(function() {
			toggleFullScreen();
			$(this).find("i").toggleClass( "fa-expand" );
			$(this).find("i").toggleClass( "fa-compress" );
		});
		function toggleFullScreen() {
			if ((document.fullScreenElement && document.fullScreenElement !== null) || (!document.mozFullScreen && !document.webkitIsFullScreen) || (document.msRequestFullscreen !== null)) {
				if (document.documentElement.requestFullScreen) {
					document.documentElement.requestFullScreen();
				} else if (document.documentElement.mozRequestFullScreen) {
					document.documentElement.mozRequestFullScreen();
				} else if (document.documentElement.webkitRequestFullScreen) {
					document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
				}else if (document.documentElement.msRequestFullscreen) {
               			document.documentElement.msRequestFullscreen();
           			}
			} else {
				if (document.cancelFullScreen) {
					document.cancelFullScreen();
				} else if (document.mozCancelFullScreen) {
					document.mozCancelFullScreen();
				} else if (document.webkitCancelFullScreen) {
					document.webkitCancelFullScreen();
				}else if(document.msExitFullscreen){
					document.msExitFullscreen();
				}
			}
		}
		

		!(function($) {
		$.fn.capletBtn = function(options) {
				    var defaults = { };
				    var options = $.extend(defaults, options);
				    return this.each(function() {
						objBtn = $(this);
						if(objBtn.data("btn-group")=="monochromatic"){
								objBtn.each(function(i) {
									var group=$(this),
									fontColor, 
									btn=$(this).find(".btn"),
									color=$.inColor($(this).data("btn-color"), cepletColor);
									btn.each(function(i) {
										if(group.data("btn-step")==="lighten"){
											btncolor=$.xcolor.lighten( color || group.data("btn-color") || "#CCC", i == 0 ? i :  i+1 , group.data("btn-color-step") || 9);
										}else{
											btncolor= $.xcolor.darken( color || group.data("btn-color") || "#AAA",  i == 0 ? i :  i+1  ,group.data("btn-color-step") || 13) ;
										}
										$(this).css({"background-color": btncolor,"border-color":btncolor ,"color": group.data("btn-fcolor") || "#FFF" });
							
									});							   
								});
						}
						
				    });
		}
		})(jQuery)
		$('[data-btn-group="monochromatic"]').capletBtn();
		
		
		//////////     WIDGET IM      //////////
		$("a.im-delete , a.im-action").click(function(){
				imClose($(this),$(this).closest('section'));
				$(this).closest('section').toggleClass( "push-in" );
		});
		$("a.im-confirm").click(function(){
				var aClick=$(this), confirm=aClick.data("confirm"), parents=aClick.closest('li');		
				var imWrapper=aClick.closest("ul");
				var confirmClose=function(){
						parents.fadeOut(400,function(){
							$(this).remove();
							setTimeout(function () { imClose(aClick,imWrapper) }, 200); 
						});
					}
				if(confirm=="yes" || confirm=="accept"){
					confirmClose();
				}
				if(confirm=="actionNow"){
					alert("Your Action Complete !!")
					confirmClose();
				}
				if(confirm=="no" ){
					parents.find("section").toggleClass( "push-in" );
				}
		});
		var imClose=(function (el , wrapper) {
				if(el.hasClass("im-delete") || el.hasClass("im-action") ){
					el.parents('ul').find('li section').not(wrapper).removeClass("push-in");
				}
				if(el.hasClass("im-confirm")){
					var  nLi=wrapper.find('li').length;
					if(!nLi){
						wrapper.append('<li class="empty"><i class="fa fa-inbox fa-4x"></i><h5>No Result.</h5></li>');
					}
				}
		});

		
		
		
		//////////     MAP GOOGLE      //////////
		$(".mapTools").click(function(){
			$("#mapSetting").toggleClass( "active" );
		});
		$(".map-control-min").click(function(){
			$("#mapControl").toggleClass( "active" );
			$(this).find("i").toggleClass( "fa-chevron-down" );
			$(this).find("i").toggleClass( "fa-chevron-up" );
		});
		//Map Collapse
		$('a[data-toggle="collapse"]').click(function(){
				var caret=$(this).find(".collapse-caret");
				caret.toggleClass( "fa-angle-down" );
				caret.toggleClass( "fa-angle-up" );
		}); 
		
		$(".slide-trash").click(function(){
			$("#slide-trash").toggleClass( "active" );
		});
		
		

		//////////     PROGRESS BAR      //////////
		$('.progress-tooltip .progress-bar').progressbar({ display_text: 'tooltip' });
		$('.progress-bar').progressbar();
		
		
		//////////     TOOLTIP AND POPOVER     //////////
		$('.tooltip-area .btn').tooltip();
		$('.tooltip-area a[data-toggle="tooltip"]').tooltip();
		$('.popover-area [data-toggle="popover"]').popover();
		$('.popover-area-hover [data-toggle="popover"]').popover({ trigger:"hover" });
		
		

		//////////     OFF CANVAS MENU      //////////
		// Menu right
		$('nav#menu-right').mmenu({
			position	: 'right',
			counters	: true,
			searchfield	: {
				add					: true,
				search				: true,
				showLinksOnly		: false,
			}
		});
		// Menu Left
		var navMenu=$("nav#menu");
		navMenu.each(function(i) {
				var nav=$(this), data=nav.data();
				nav.mmenu({
					searchfield   :  data.search ? false : true,	
					slidingSubmenus	: true
				}).on( "closing.mm", function(){
					var highest=$(this).find("ul.mm-highest");
					highest.find(".mm-subclose").trigger('click');
					setTimeout(function () { closeSub() }, 200);
				});
		});
		
		$(".nav-mini").on('click',function(){
			$("body").toggleClass( "in" );  	
			closeSub();
			if($(window).width() < 991 ){
				navMenu.trigger( 'open.mm' );
			}
		});
		
		// function Auto close sub menu
		function closeSub(){
			if(navMenu.hasClass("mm-vertical")){
				navMenu.find("li").each(function(i) {
					$(this).removeClass("mm-opened");	
				});
			}else{
				navMenu.find("ul").each(function(i) {
					if(i==0){
						$(this).removeClass("mm-subopened , mm-hidden").addClass("mm-current");	
					}else{
						$(this).removeClass("mm-opened , mm-subopened , mm-current  , mm-highest").addClass("mm-hidden");						
					}	
				});
			}
		}
		
		//////////     TOGGLE  OPEN LEFT CANVAS MENU      //////////
		$("body").append('<div class="toggle-menu"/>');
		$('body').on("click",".toggle-menu",function( e ) {
				e.stopImmediatePropagation();
				e.preventDefault();
				$('nav#menu').trigger( 'open.mm' );
		});
		
		
		//////////     TOUCH TO OPEN CANVAS MENU      //////////
		$('li[data-counter-color]').each(function(i) {
			var counter=$(this).find("em.mm-counter");
			counter.css({"background-color":$.fillColor($(this)),"color":"#FFF" });
		});
		
		
		//////////     TOUCH TO OPEN CANVAS MENU      //////////
		var nav=document.getElementById("nav");
		if(nav){
			var wrapper= Hammer( nav );
			 wrapper.on("dragright", function(event) {	// hold , tap, doubletap ,dragright ,swipe, swipeup, swipedown, swipeleft, swiperight
				if((event.gesture.deltaY<=7 && event.gesture.deltaY>=-7) && event.gesture.deltaX >100){
					$('nav#menu').trigger( 'open.mm' );
				}
			 });
			 wrapper.on("dragleft", function(event) {
				if((event.gesture.deltaY<=5 && event.gesture.deltaY>=-5) && event.gesture.deltaX <-100){
					$('nav#contact-right').trigger( 'open.mm' );
				}
			 });
		}
			
	
		//////////     CORNER FLIP    //////////
		$(".corner-flip").each(function(i) {
			$(this).append('<div class="flip" />');
		}); 
	


		//////////     HORIZONTAL FORM  AUTO GENERENT COLUMN       //////////
		$(".form-horizontal").each(function() {
			var form=$(this) ,data=$(this).data(), colClass= "col-"+( data.col || "md" ), coldiv="" ,
			colOffset=colClass+"-offset-", labelClass=colClass +"-"+( data.collabel || "2" );
			 if(data.collabel){
				 coldiv=12-parseInt(data.collabel);
			}
			var divClass=colClass +"-"+( coldiv || "10" );
			$(this).find(".form-group").each(function(i) {
				$div=$(this).find("div").eq(0);
				$label=$(this).find("label.control-label");
				if($(this).hasClass("offset")){
					$div.addClass(colOffset+(data.collabel || "2"));
				}
				 if(data.alignlabel){
					 $label.css("text-align",data.alignlabel);
				}
				 if(data.label){
					 form.addClass('labelcustomize');
					 $text=$label.html();
					 $label.html("").append('<span class="'+data.label+'">'+$text+'</span>');
					 $label.find("span.icon").css({"border-color": data.colorlabel || "#EEE" });
				}
				if(!$(this).hasClass("none")){
					$label.addClass(labelClass);
					$div.addClass(divClass);
				}
			});
			if(data.label=="icon"){
				form.append('<div class="icon '+labelClass+' '+data.alignlabel+'" />')
				form.find("div.icon").css({"border-color": data.colorlabel || "#EEE" });
			}
		});



		//////////     ICHECK     //////////
		  var createiCheck = (function() {
		  $('.iCheck').each(function(i) {
				var  data=$(this).data() , 
				 input=$(this).find("input") , 
				 li=$(this).find("li") ,
				 index="cp"+i , 
				 insert_text,
				 iCheckColor = [ "black", "red","green","blue","aero","grey","orange","yellow","pink","purple"],
				 callCheck=data.style || "flat";
			 if(data.color && data.style !=="polaris" && data.style !=="futurico" ){
					hasColor= jQuery.inArray(data.color, iCheckColor);
					if(hasColor !=-1 && hasColor < iCheckColor.length){
						callCheck=callCheck+"-"+data.color;
					}
			}
			input.each(function(i) {
				var self = $(this), label=$(this).next(), label_text=label.html();
				self.attr("id","iCheck-"+index+"-"+i);
				if(data.style=="line"){
					insert_text='<div class="icheck_line-icon"></div><span>'+label_text+'</span>';
					label.remove();
					self.iCheck({ checkboxClass: 'icheckbox_'+callCheck, radioClass: 'iradio_'+callCheck, insert:insert_text  });
				}else{
					label.attr("for","iCheck-"+index+"-"+i);
				}
			});
			if(data.style!=="line"){
				input.iCheck({ checkboxClass: 'icheckbox_'+callCheck, radioClass: 'iradio_'+callCheck });
			}else{
				li.addClass("line");
			}
		  });
		});
		createiCheck();
	
		  $('.iCheckColor li').click(function() {
		    var self = $(this);
		    if (!self.hasClass('active')) {
			 self.siblings().removeClass('active');
			 var color = self.attr('class');
			$('.iCheck').each(function(i) {
				$(this).data("color",color)		  
			});
			$('.iCheck input').iCheck('destroy');
				createiCheck();
				self.addClass('active');
		    };
		  });
	
		 $('.ios-switch .switch').each(function(i) {
				$(this).addClass("ios");
		});
		
	
	
		//////////     ICHECK     //////////
		$(".ios-switch input:checkbox").change(function(){
			var targetLabel=$(this).parents('li').find("label span")		;	
			if( $(this).is(':checked')){
				targetLabel.text("ON");
			}else{
				targetLabel.text("OFF");
			}
		});	  
	
		//////////     AJAX RECALL ICHECK     //////////
		$(".load-ajax-form").on('click', function () {
			$.ajax({
			    url: "data/icheckForm.php",
			    cache: false,
			    type: "POST",
			    dataType: 'html',
			    success: function (data) {
				    $("#showForm").html(data);
				    createiCheck();
			    }
			});
		});
	
		//////////     COLOR PICKER     //////////
		$('[data-provide="colorpicker"]').each(function(i) {
			var id="color_"+i, $this=$(this).attr("id",id), data=$(this).data(),
			submit_btn=data.inline ? 0:1;
			if(data.addon && $this.is("input")){
				$('#'+id).next().css("width",$(this).outerHeight());
			}
			$this.colpick({
				bornIn:"#main",
				flat: data.inline || false,
				submit: submit_btn,
				layout: data.layout || 'hex',
				color: $this.val() || $.xcolor.random(),
				colorScheme: data.theme || "gray",
				onChange:function(hsb,hex,rgb) {
					$('#'+id).val('#'+hex);
					if(data.addon){
						$('#'+id).css({'border-color':'#'+hex });
						$('#'+id).next().css({'background-color':'#'+hex , 'border-color':'#'+hex });
					}
				},
				onSubmit:function(hsb,hex,rgb,el) {
					$(el).val('#'+hex); 
					$(el).colpickHide();
				}
			});
		});
	
	
		

		//////////     DATE TIME PICKER     //////////
		$('.form_datetime').datetimepicker({
			bornIn:"#main",
			weekStart: 1,
			todayBtn:  1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 2,
			forceParse: 0,
			showMeridian: 2,
			minView: 2,
			multidate: true,
			format: "yyyy-mm-dd",
			endDate: '+0d'
		});

		$('.form_datetime1').datetimepicker({
			bornIn:"#main",
			weekStart: 1,
			todayBtn:  1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 2,
			forceParse: 0,
			showMeridian: 2,
			minView: 2,
			multidate: true,
			format: "yyyy-mm-dd"
		});


		$('.form_datetime9').datetimepicker({
			bornIn:"",
			weekStart: 1,
			todayBtn: 1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 2,
			forceParse: 0,
			showMeridian: 2,
			minView: 2,
			multidate: true,
			format: "mm/dd/yyyy"
			});
			
		$('.booking_date').datetimepicker({
			bornIn:"",
			weekStart: 1,
			todayBtn: 1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 2,
			forceParse: 0,
			showMeridian: 2,
			minView: 2,
			multidate: true,
			format: "yyyy-mm-dd"
			});

		
		$('.date5').datetimepicker({
			weekStart: 1,
			todayBtn:  1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 2,
			forceParse: 0,
			showMeridian: 2,
			//minView: 2,
			multidate: true,
			format: "dd MM yyyy hh:ii"
		});
		
		
		//////////     DATE TIME RANG      //////////
		$('#daterange').daterangepicker();
		$('#reportrange').daterangepicker({
				startDate: moment().subtract('days', 29),
				endDate: moment(),
				minDate: '01/01/2015',
				maxDate: '12/31/2020',
				dateLimit: { days: 60 },
				/*parentEl:"#main",*/
				timePicker: false,
				timePickerIncrement: 1,
				timePicker12Hour: true,
				ranges: {
				   'Today': [moment(), moment()],
				   'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
				   'Last 7 Days': [moment().subtract('days', 6), moment()],
				   'This Month': [moment().startOf('month'), moment().endOf('month')],
				   'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
				},
				opens: 'right',
				buttonClasses: ['btn-sm'],
				applyClass: 'btn-inverse',
				cancelClass: 'btn-inverse',
				format: 'MM/DD/YYYY',
				separator: ' to ',
				locale: {
					fromLabel: 'From',
					toLabel: 'To',
					customRangeLabel: 'Custom Range',
					daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
					monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
					firstDay: 1
				}
			 },
			function(start, end) {
			$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
			console.log("Callback has been called!");
			$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
			var fromDate = $("input[name=daterangepicker_start]").val();
			farr = fromDate.split("/");
			fromDate = farr[2]+"-"+farr[0]+"-"+farr[1];
			var toDate = $("input[name=daterangepicker_end]").val();
			tarr = toDate.split("/");
			toDate = tarr[2]+"-"+tarr[0]+"-"+tarr[1];
			var user = $("#uid").val();
			window.location=ui_url+'attendance/attendance_view.php?fromDate='+fromDate+'&toDate='+toDate+'&id='+user
			console.log("work done");
			}
			);
			$('#reportrange span').html(moment().subtract('days', 29).format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
			   
		
		
		$('#JobDateRange').daterangepicker({
				startDate: moment().subtract('days', 29),
				endDate: moment(),
				minDate: '01/01/2015',
				maxDate: '12/31/2020',
				dateLimit: { days: 60 },
				/*parentEl:"#main",*/
				timePicker: false,
				timePickerIncrement: 1,
				timePicker12Hour: true,
				ranges: {
				   'Today': [moment(), moment()],
				   'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
				   'Last 7 Days': [moment().subtract('days', 6), moment()],
				   'This Month': [moment().startOf('month'), moment().endOf('month')],
				   'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
				},
				opens: 'right',
				buttonClasses: ['btn-sm'],
				applyClass: 'btn-inverse',
				cancelClass: 'btn-inverse',
				format: 'MM/DD/YYYY',
				separator: ' to ',
				locale: {
					fromLabel: 'From',
					toLabel: 'To',
					customRangeLabel: 'Custom Range',
					daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
					monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
					firstDay: 1
				}
			 },
			function(start, end) {
			$('#JobDateRange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
			advance_search_bydate_new('0');
			
			}
			);
			$('#JobDateRange span').html(moment().subtract('days', 29).format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
		
		
		//////////     PANEL  TOOLS     //////////
/*		$(".panel-tools[data-toolscolor]").each(function(i) {
			var tools=$(this), 
				data=$(this).data(), 
				btn=$(this).find(".btn"),
				step="";
				data.colorStep  = data.colorStep || true;
				if(tools.prev().hasClass("panel-heading") && !tools.hasClass("panel-tools-mini") ){
					tools.prev().css("border","none");
				}
				if(data.toolscolor){ 
					tools.css({"background-color":$.fillColor(tools) }) ;
					tools.parent().find(".panel-body .table thead > tr > th").css("border-bottom-color", $.fillColor(tools) );
				}
				btn.each(function(i) {
					$(this).css("background-color",$.xcolor.darken( $.fillColor(tools) , data.colorStep==false? 1:i+1 ,15))	;
				});
		});*/
		$('.panel-tools .btn-collapse').on('click', function () {
            var btn=$(this), panelBody=btn.closest(".panel").find(".panel-body");
			btn.toggleClass("in");
			btn.find("i").toggleClass( "fa-sort-amount-desc" );
			btn.find("i").toggleClass( "fa-sort-amount-asc" );
			if ($(this).hasClass("in")) {
				panelBody.slideUp();
			} else {
				panelBody.slideDown();
			}
        	});	
		$('.panel-tools .btn-reload').click(function (e) {
			var  btn=$(this), panelBody=btn.closest(".panel").find(".panel-body"),
			overlay=$('<div class="load-overlay"><div><div class="c1"></div><div class="c2"></div><div class="c3"></div><div class="c4"></div></div><span>Loading...</span></div>');
			btn.removeClass("btn-panel-reload").addClass("disabled")
			panelBody.append(overlay);
			overlay.css('opacity',1).fadeIn();
			setTimeout(function () {  
				btn.removeClass("disabled").addClass("btn-panel-reload") ;
				panelBody.find(overlay).fadeOut("slow",function(){ $(this).remove() });
			}, 5000);
		});
		$(".panel-tools").on('click',".btn-close",function(){
				var panel=$(this).closest('.panel'), tools=$(this).closest('.panel-tools');
				console.log(tools)
				var confirmGroup=$('<div class="pt-confirm-group">'+'<div class=" btn-group btn-group-justified">'+'<a class="btn btn-inverse close-confirm" href="javascript:void(0)" data-confirm="accept">Yes</a>'+'<a class="btn btn-theme btn-close" href="javascript:void(0)">No.</a>'+'</div>'+'</div>');
				var blockClose=$('<div class="blockerClose">');
				tools.toggleClass( "push-in");
				if(tools.hasClass("push-in")){
					tools.append(confirmGroup);
					panel.toggleClass( "push-in");
					blockClose.appendTo("#content");
					blockClose.css({ "height":$("#content").outerHeight() }).fadeTo(400,0.5);
					console.log($("#content").outerHeight())
				}else{
					$(".blockerClose").fadeOut(200,function(){ $(this).remove() }); 
					setTimeout(function () {
						 tools.find(".pt-confirm-group").remove(); 
						 panel.toggleClass( "push-in") ;
					}, 500);  
				}	  
		});
		$(".panel-tools").on('click','.close-confirm',function(){
			$(this).closest('.panel').fadeOut(500,function(){
					$(this).remove();
					$(".blockerClose").fadeOut(200,function(){ $(this).remove() }); 
			});
		});
		 $('#content').on('click' ,'.blockerClose', function() {
			var el=$(this); 
			el.fadeOut(200,function(){ $(this).remove() }); 
			$(".panel-tools.push-in").toggleClass("push-in",function(){
				var tools=$(this);
				setTimeout(function () { 
					tools.find(".pt-confirm-group").remove();
					tools.closest('.panel').removeClass("push-in");
				}, 500);  
			});	
		 });
		
    });


		$("#menu").hover(
			function () {
				$('#wrapper').addClass('ml-250');
				
			},
			function () {
				$('#wrapper').removeClass('ml-250');
			}
		);
		
		// $(document).ready(function(){
		// 	$("#menu").hover(function(){
		// 		$('body').toggleClass("in");
		// 	});
		// });
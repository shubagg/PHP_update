<?php
include_once '../global.php';
get_header($global_words);
 ?>
<style>
.page_404 {
margin: 0 auto;
padding: 30px 0;
font-family: Verdana, Geneva, sans-serif;
background: #E8E2E2  ;
/* position: absolute; */
width: 40%;
border: 1px solid #D6D0D0  ;
/* margin: -100px 0 0 -200px; */
/* top: 50%; */
/* left: 50%; */
margin-top: 40px;
box-shadow: 2px 2px 2px #ECECEC  ;
}

.page_404 h1  { color: #6F7B8A;
    text-align: center;
    font-weight: normal;
    font-size: 25px;}
.page_404 h6 {text-align: center;
    font-size: 16px;
    color: #6F7B8A;
    padding: 0px;
    margin: 0;}
.page_404 span { font-weight:bold;}
	
.page_404 p	{font-size: 15px;
    text-align: center;
	color: #6F7B8A;}

</style>
<body>

<div class="page_404">



<h1>ERROR <span> 404 – :)</span></h1>
<h6>Oops! That page can’t be found.</h6>
<p>Sorry, an error has occured, Requested page not found!</p>




</div>
  <div class="footer margn_tp_40" style="position: fixed;
    bottom: 0;
    left: 0px;
    right: 0;">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-4" style="margin-bottom:40px;">
        <h1 class="animated fast" data-effect="fadeInUp"><?php echo $global_words['download']; ?></h1>
        <h2><?php echo $global_words['mobile_app']; ?></h2>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-8 ">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"> <img src="<?php echo ui_url();?>assets/img/appstore1.png" class="animated fast" data-effect="fadeInRight" /> </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 "> <img src="<?php echo ui_url();?>assets/img/appstore2.png" class="animated fast" data-effect="fadeInRight" /> </div>
      </div>
    </div>
  </div>
</div>
<div class="fot_btm" style="position: fixed;
    bottom: 0;
    left: 0px;
    right: 0;">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
          <div class="quik_link">
            <ul>
              <li><a href="about"><?php echo $global_words['about']; ?></a></li>
              <li><a href="contact"> <?php echo $global_words['contact_us']; ?></a></li>
              <li><a href="help"> <?php echo $global_words['faq']; ?></a></li>
              <li><a href="term"> <?php echo $global_words['privacy']; ?></a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
          <div class="social-icons pull-right">
            <ul>
              <li><a href="#"> <span class="w-f"> </span></a></li>
              <li><a href="#"> <span class="w-tw"> </span></a></li>
              <li><a href="#"> <span class="w-in"> </span></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo ui_url();?>assets/js/jquery.touchSwipe.min.js"></script>
  
<script type="text/javascript" src="<?php echo ui_url();?>assets/js/jquery.liquidcarousel.pack.js"></script>


<script src="<?php echo ui_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo ui_url();?>assets/js/jquery-slidingCarousel.js" type="text/javascript"></script>

<script type="text/javascript" src="<?php echo ui_url();?>assets/js/customJs.js"></script>
<script src="<?php echo ui_url();?>assets/js/bootstrap-hover-dropdown.js"></script>

<script type="text/javascript" src="<?php echo ui_url();?>assets/js/simple-lightbox.js"></script>


    <script type="text/javascript">
        $(document).ready(function() {
        /*  var carousel = $("#carousel").slidingCarousel({
                squeeze: 100
            });*/


      $("#carousel1").slidingCarousel({auto:true});
        $("#carousel2").slidingCarousel({auto:true});
        $("#carousel3").slidingCarousel({auto:true});
        $("#carousel4").slidingCarousel({auto:true});
        $("#carousel5").slidingCarousel({auto:true});
        $("#carousel6").slidingCarousel({auto:true});
        $("#carousel7").slidingCarousel({auto:true});
        $("#carousel8").slidingCarousel({auto:true});
        $("#carousel0").slidingCarousel({auto:true});
        
        
        
        
        var i = 0;
        

    
    var automaic;


    
    $('.responsie_slider').hover( 
              function(e){clearInterval(automaic); }, // over
               function(e){ 

              automaic =  setInterval(function(){
      
                    if(i>2){
                      
                      i = 1;
                    }else if(i < 4){
                      
                      i++;
                    }else{
                    
                    }
                    
                    $('.nav2 li.dropdown:nth-child('+i+') a.dropdown-toggle').click();
                    
                    if(window.innerWidth < 768){
                     $('.nav2 .dropdown-menu').hide();
                    }
                
                    
                },8000);  
               }  // out
              
            );
  automaic =  setInterval(function(e){
      
                    if(i>2){
                      
                      i = 1;
                    }else if(i < 4){
                      
                      i++;
                    }else{
                    
                    }
                    
                    $('.nav2 li.dropdown:nth-child('+i+') a.dropdown-toggle').click();
                      if(window.innerWidth < 768){
                        $('.nav2 .dropdown-menu').hide();
                   }
                    
                },8000);
            
        });
        </script>

<script>
    // very simple to use!
    $(document).ready(function() {
      $('.js-activated').dropdownHover().dropdown();
    });
  </script>
  <script>
function adjustModalMaxHeightAndPosition() {
$('.modal').each(function () {
if ($(this).hasClass('in') == false) {
$(this).show();
}
;
var contentHeight = $(window).height() - 60;
var headerHeight = $(this).find('.modal-header').outerHeight() || 2;
var footerHeight = $(this).find('.modal-footer').outerHeight() || 2;
$(this).find('.modal-content').css({
'max-height': function () {
return contentHeight;
}
});
$(this).find('.modal-body').css({
'max-height': function () {
return contentHeight - (headerHeight + footerHeight);
            }
        });
        $(this).find('.modal-dialog').css({
            'margin-top': function () {
                return -($(this).outerHeight() / 2);
            },
            'margin-left': function () {
                return -($(this).outerWidth() / 2);
            }
        });
        if ($(this).hasClass('in') == false) {
            $(this).hide();
        }
        ;
    });
}
;
$(window).resize(adjustModalMaxHeightAndPosition).trigger('resize');
//@ sourceURL=pen.js
</script>

<script>
 $(document).ready(function(e) {
    $("#clik").click(function(e) {
        $(".hi_d").hide();
         $(".hi_d1").show();
         $(".sh_d").hide();
    });
    
     $(".jk").click(function(e) {
         $(".hi_d1").hide();
        $(".hi_d").show();
        
    });
    
     
    
    
});

</script>

<script>

  $(document).ready(function(e) {
    
    $(".src_hd").click(function(e) {
        $(".src_shw").slideToggle();
    });
    
});

</script>

<!---------------->

<script>
    $(function(){
        var gallery = $('.gallery a').simpleLightbox();
    });
</script>

<script>
$('#myTabs a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})
</script>

<script>
 $('.gb').click(function(e) {
   jQuery("#prices").text("INR 0");
    $(".bt").html('');
     $('.op').slideToggle();
});

</script>

<script>
$(document).ready(function() {
 $('.cl').click(function(e) {
    if(!$('body').hasClass("slideDown"))
    {
    e.stopPropagation();
    $('.ty'+this.id).slideToggle();
    $('.bt').removeClass('lg_f_cl2');
    $('.bt'+this.id).toggleClass('lg_f_cl2');
    $('.white').addClass("slideDown");
    }
    else{
    $('.ty').hide();
    $('.white').removeClass("slideDown");
    $('.bt').removeClass('lg_f_cl2');
    $('.bt'+this.id).toggleClass('lg_f_cl2');
    }
$('body').click(function() {
    if($('body').hasClass("slideDown")){
        
       $('.ty').hide();
       $('.white').removeClass("slideDown");
       $('.bt').removeClass('lg_f_cl2');
    }
});   
   

});


    });

</script>
<script>
 $(document).ready(function(e) {
    $("#clik").click(function(e) {
        $(".hi_d").show();
         $(".sh_d").hide();
    });

     $(".jk1").click(function(e) {
         $(".hi_d2").hide();
        $(".hi_d3").show();
        
    });
    
    
});

</script>


<script>

/*$('ul.nav-tabs li.dropdown').click(function(){
 // alert('dfdf');
 setTimeout(function(){

  $('.responsie_slider .slide:nth-child(1) img').click();
 },100);
  

});
*/
var lastimg = $('#carousel1 .slide').length;

$("#carousel1 .slide:nth-child("+lastimg+") img").one("load", function() {
// do stuff
setTimeout(function(){
    $('.responsie_slider').css("opacity","1");
    $('.spinner-loader').hide();

},500);
    
}).each(function() {
if(this.complete) $(this).load();
});

jQuery(document).on('keydown', '#search', function(ev) {
    if(ev.which == 13) {
        jQuery("#search").siblings("a").click();
    }
});

$("#search1").keyup(function(event){
    if(event.keyCode == 13){
        $("#reposiveserch").click();
    }
});

</script>
<script>
function remove_error_string_by_class()
{
    $('.error_message').html('');
    $('.error-message').html('');
    
}

</script>
<script>
function remove_error_string_by_id(span_error_id)
{
    //alert(span_error_id);
    $('#'+span_error_id).html('');
}


function check_enter_key(buton_id,event)
{
    if(event.keyCode == 13)
    {
        $('#'+buton_id).click();    
    }
    
}
</script>

<script>
    
    $('#caterory_listing_ajax  .col-xs-6:nth-child(2n)').after('<div class="cleara"></div>');

</script>
<script>
var make_my_tkt = '';
function open_modal_three(make_my_ticket)
{
    make_my_tkt = make_my_ticket;
    if(make_my_tkt == 'true')
    {
        var check_term=document.getElementById("checkbox_value").checked;
        $("#term_condition").html("");
        if(check_term==false)
        {
            document.getElementById("checkbox_value").focus();
            $("#term_condition").html("Please accept term & conditions");
            return false;
        }
    }
    
    
    
    $('.error-message').html('');
    $('#myModal3').modal();
}

</script>
<script>

function open_modal3()
{
    $('.error-message').html('');
    $('#myModal3').modal();
}

</script>

  </body>
  </html>
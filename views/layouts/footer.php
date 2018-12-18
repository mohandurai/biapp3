<?php
use app\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
/* @var $this \yii\web\View */
/* @var $content string */
AppAsset::register($this);
?>

<!-- <footer class="footer">
        <div class="container-fluid">
            <p class="col-md-2 col-md-push-1">&copy; BrandIdea <?= date('Y') ?></p>
            <p class="pull-right">Powered by Brand Idea Consultancy Services Pvt. Ltd.</p>
        </div>
</footer> -->
  <a class="change-theme" href="javascript:void(0)"><i class="fa fa-chevron-up"></i>&nbsp;Preference</a>
<section class="theme-section">

          <div class="theme-color">
            <label for="">Skin Color: </label>
                <a href="javascript:void(0)" id="gray" class="gray-color">&nbsp;</a>
                <a href="javascript:void(0)" id="green" class="green-color">&nbsp;</a>
                <a href="javascript:void(0)" id="yellow" class="yellow-color">&nbsp;</a>
                <a href="javascript:void(0)" id="white" class="white-color">&nbsp;</a>
                <a href="javascript:void(0)" id="blue" class="blue-color">&nbsp;</a>

          </div>

</section>
<!-- Error notification -->
  <!-- <div class="col-md-3 pull-right alert alert-danger" role="alert">
  <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
  This is a danger alert—check it out!
  </div> -->

<!-- Loader-->
<div class="spinner-wrapper">
<div class="sk-cube-grid">
  <div class="sk-cube sk-cube1"></div>
  <div class="sk-cube sk-cube2"></div>
  <div class="sk-cube sk-cube3"></div>
  <div class="sk-cube sk-cube4"></div>
  <div class="sk-cube sk-cube5"></div>
  <div class="sk-cube sk-cube6"></div>
  <div class="sk-cube sk-cube7"></div>
  <div class="sk-cube sk-cube8"></div>
  <div class="sk-cube sk-cube9"></div>
</div>
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog chat-content">

    <!-- Modal content-->
    <div class="modal-content">
      <!-- <div class="modal-header">

        <h4 class="modal-title">Modal Header</h4>
      </div> -->
      <div class="modal-body load-content">
        Chat with our experts
        <iframe border="0" width="100%" height="500" src="http://192.168.10.199/test/node-mongo-chat-master/"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- Modal -->
<div id="myModal_report" class="modal fade" role="dialog">
  <div class="modal-dialog report_iframe_content">

    <!-- report Modal content-->
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title">Custom Pivot Report</h4>
      </div>
      <div class="modal-body load-content">

        <iframe border="0" width="100%" height="455" src="http://192.168.10.199/test/mypivot/"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">
              $(window).on('load', function() {
                $(".spinner-wrapper").hide();
              });
                $(document).ready(function (){
                  // $(".chat").on("click", function() {
                  //     $(".load-content").load("");
                  // });
                  // $("#mydiv").html('<object data="http://192.168.10.32/Chat-Using-WebSocket-and-PHP-Socket-master/"/>');
                  // $(".chat").click(function(){
                  //     $("#myModal1").toggleClass();
                  // });
                  $(".nav-tabs li a").click(function(){
                        $(".popover-child").hide();
                        $("body").find(".Continuous").prop("checked", false);
                        $(".combine, .split").removeClass("combine-active split-active active-color");
                          $("#combineview, #splitview").css("display","none");
                  });
                  $("li.Discovery a").click(function(){
                    if($(".tree-multiselect input:checkbox:checked").length > 0){
                      $(".combine, .split").addClass("combine-active split-active ");
                    }
                    else {
                        $(".combine, .split").removeClass("combine-active split-active active-color");
                    }
                  });
                  $("li.Diagnostics a").click(function(){
                    if($("body").find(".Continuous").prop('checked') == false)
                    {
                      $(".combine, .split").removeClass("combine-active split-active active-color");
                      $(".combine, .split").css("pointer-events", "none");
                    }
                    else {
                        $(".combine, .split").addClass("combine-active split-active");
                    }
                  });
                  $("li.Prescriptn a").click(function(){
                    if($(this).find(".Continuous").prop('checked') == false)
                    {
                      $(".combine, .split").removeClass("combine-active split-active active-color");
                      $(".combine, .split").css("pointer-events", "none");
                    }
                    else {
                        $(".combine, .split").addClass("combine-active split-active");
                    }
                  });
                  $("li.Predictn a").click(function(){
                    if($(this).find(".Continuous").prop('checked') == false)
                    {
                      $(".combine, .split").removeClass("combine-active split-active active-color");
                      $(".combine, .split").css("pointer-events", "none");
                    }
                    else {
                        $(".combine, .split").addClass("combine-active split-active");
                    }
                  });
                  $('li.Discovery a').css("pointer-events", "auto");
                  $('li.Diagnostics a, li.Prescriptn a, li.Predictn a').css({"pointer-events": "none","color": "#999"});
                  $(document).on('click', '.tree-multiselect input[type=checkbox]', function() {
                    // alert($(".tree-multiselect input:checkbox:checked").length);
                    if($(".tree-multiselect input:checkbox:checked").length > 0){
                      // alert("1");
                      $('li.Discovery a').css("pointer-events", "auto");
                      $('li.Diagnostics a, li.Prescriptn a, li.Predictn a').css({"pointer-events": "auto","color": "#fff"});
                      $(".combine, .split").css("pointer-events","auto");
                    }
                    else {
                      // alert("2");
                        $('li.Discovery a').css({"pointer-events": "auto", "color": "#ffffff"});
                        $('li.Diagnostics a, li.Prescriptn a, li.Predictn a').css({"pointer-events": "none","color": "#999"});
                        $(".delete_selection").hide()
                    }
                  });

               $("#gray").click(function () {
                    $('body').attr('class', 'gray');
                    $('#mapframe').contents().find("body").attr('class', 'gray');
                    if($('body').hasClass('gray')){
                         sessionStorage.setItem('theme', 'gray');
                    }
                });
               $("#yellow").click(function () {
                   $('body').attr('class', 'yellow');
                   $('#mapframe').contents().find("body").attr('class', 'yellow');
                   if($('body').hasClass('yellow')){
                        sessionStorage.setItem('theme', 'yellow');
                    }
               });
               $("#green").click(function () {
                    $('body').attr('class','');
                    $('#mapframe').contents().find("body").attr('class', '');
                    sessionStorage.removeItem('theme');
               });
               $("#white").click(function () {
                    $('body').attr('class','white');
                    $('#mapframe').contents().find("body").attr('class', 'white');
                    if($('body').hasClass('white')){
                         sessionStorage.setItem('theme', 'white');
                     }
               });
               $("#blue").click(function () {
                    $('body').attr('class','blue');
                    $('#mapframe').contents().find("body").attr('class', 'blue');
                    if($('body').hasClass('blue')){
                         sessionStorage.setItem('theme', 'blue');
                     }
               });
               var theme = sessionStorage.getItem('theme');
                 if(theme !== ''){
                     $('body').addClass(theme);
                     $('#mapframe').contents().find("body").addClass(theme);
                 }
                 $('.change-theme').on('click', function () {
                     $('.theme-section').toggleClass('theme-section-on');
                 });
                 //Sidebar Navigation Collapse
                 $('#sidebarCollapse').on('click', function () {
                     $('#sidebar').toggleClass('active');
                 });
                 $("#sidebarCollapse").click(function(){
                     $("#content").toggleClass("col-md-12");
                     $("#content").toggleClass("col-md-10");
                   });
                 //Period Selection Toggle
                 $('.select-period').click(function() {
                     $('.period-selection').toggleClass('show-period');
                     $('.popover-child').css('display', 'none');
                 });
                 //Period Selection
                 $("[data-toggle=popover]").popover({
                     html: true,
                      content: function() {
                           return $('#popover-content').html();
                           }
                 });
                 $('.nav-stacked').removeClass('nav-stacked').addClass('nav-menu');
                //Treeview selection
                $("[data-toggle=popover-child]").popover({
                    html: true,
                     content: function() {
                          return $('#popover_left_menu').html();
                        }
                });
                $( ".period-calendar" ).click(function() {
                    $( ".arrow" ).remove();
                    $('.popover').css('min-width','450px');
                    //$('.period-calendar').addClass('active');
                });
                $( ".parent_li span" ).click(function() {
                    $( ".arrow" ).remove();
                });
                    //Not the Yii way, but the (simpler) jQuery way:
                    // find menu-item associated with this page and make current:
                    //$(".breadcrumb li").removeAttr('class');
                    $('.menu-nav a').each(function(index, value) {
                      if ($(this).prop("href") === window.location.href) {
                       $(".breadcrumb li").removeAttr('class');
                         $(this).addClass("active");
                          //$(".breadcrumb li").removeAttr('class');
                      }
                    });
                    $(".breadcrumb li").removeAttr('class');
                    $('#myTabs a').click(function (e) {
                      e.preventDefault()
                      $(this).tab('show')
                    })
                    $(".section").prop("disabled", true);
                      $('.combine').click(function(){
                        $(this).addClass('active-color');
                        //$('#combine').toggleClass('active-color');
                        $('#split').removeClass('active-color');
                        $('.split').removeClass('active-color');
                        $('#splitview').removeClass('in');
                        $('.popover-child').hide();
                        $('#mapframe').contents().find('.buttonexcel').hide();
                        $('#mapframe').contents().find('.buttons-excel').show();
                      });
                      $('.split').click(function(){
                          $(this).addClass('active-color');
                          //$('#split').toggleClass('active-color');
                          $('#combine').removeClass('active-color');
                          $('.combine').removeClass('active-color');
                          $('#combineview').removeClass('in');
                          $('.popover-child').hide();
                          $('#mapframe').contents().find('.buttonexcel').show();
                          // $('#mapframe').contents().find('.buttonthan').append('<button id="rep2"><span><img src="../images/excel_icon.png" style="width:18px;"></span></button>');
                      });
                      $('.popover_close').click(function(){
                          $( ".popover-child" ).hide();
                          // $('.popover-child').removeClass('popover-child-slide');
                      });
                      $('.combinesplit-colse').click(function(){
                          $( "#combineview" ).hide();
                          $( "#splitview" ).hide();
                      });
                      $('.child_menu').click(function(){
                        $('.child_menu').removeClass('active-span');
                          $(this).toggleClass('active-span');
                      });
                      $(".close").click(function(){
                          $('.period-selection').toggleClass('show-period');
                      });
                      $('.Single ').click(function(){
                          $('.single_period').css('display','block');
                          $('.continuous_period').css('display','none');
                      });
                      $('.Continuous').click(function(){
                          $('.single_period').css('display','none');
                          $('.continuous_period').css('display','block');
                      });
                      // $('.Mixed').click(function(){
                      //     $('.single_period').css('display','none');
                      //     $('.continuous_period').css('display','none');
                      //     $('.mixed_period').css('display','block');
                      // });
                    });
       </script>
       <script type="text/javascript">
       // Sidebar Navigation Category Menu List
      $(function () {
            $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Collapse this branch');
            $('.tree li ul > li').hide();
              $('.tree li.parent_li > span').on('click', function (e) {
                var children = $(this).parent('li.parent_li').find(' > ul > li');
                if (children.is(":visible")) {
                    children.hide('fast');
                    $(this).attr('title', 'Expand this branch').find(' > i').addClass('fa-chevron-right').removeClass('fa-chevron-down');
                } else {
                  $('.tree li ul > li').hide();
                    children.show('fast');
                    $(this).attr('title', 'Collapse this branch').find(' > i').addClass('fa-chevron-down').removeClass('fa-chevron-right');
                      //$(".tree-menu-list ul").toggle("collapse");
                }
                e.stopPropagation();
              });
              });
</script>
<script>
//My Selection scrollbar
(function($){
  $(window).on("load",function(){
      $("#myselection").mCustomScrollbar({
      theme:"light"
    });
    });
})(jQuery);
// Category Menu scrollbar
// (function($){
//     $(window).on("load",function(){
//       $(".tree").mCustomScrollbar({
//       theme:"light",
//       });
//     });
// })(jQuery);
// Category Menu scrollbar
(function($){
    $(window).on("load",function(){
      $("#sidebar").mCustomScrollbar({
      theme:"dark-thick",

    });
      });
})(jQuery);

</script>
<script src="js/jquery2.1.4.js"></script>
<script type="text/javascript">
var jq214 = jQuery.noConflict(true);
// $('body').find('.period .active').text();
</script>

<?php
use app\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>


<footer class="footer">
        <div class="container-fluid">
            <p class="pull-left">&copy; BrandIdea <?= date('Y') ?></p>

            <p class="pull-right">Powered by Brand Idea Consultancy Services Pvt. Ltd.</p>
        </div>
</footer>
<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<script type="text/javascript">
             $(document).ready(function () {
                 $('#sidebarCollapse').on('click', function () {
                     $('#sidebar').toggleClass('active');
                 });

                $('.nav-stacked').removeClass('nav-stacked').addClass('nav-menu');
                $("#sidebarCollapse").click(function(){
                    $("#content").toggleClass("col-md-12");
                    $("#content").toggleClass("col-md-10");
                });
                //Period Selection
                $("[data-toggle=popover]").popover({
                    html: true,
                     content: function() {
                          return $('#popover-content').html();
                          }
                });

                //Treeview selection
                $("[data-toggle=popover-menu]").popover({
                    html: true,
                     content: function() {
                          return $('#popover-child').html();
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
                        $(this).toggleClass('active-color');
                        $('#combine').toggleClass('active-color');
                        $('#split').toggleClass('active-color');

                      });
                      $('.split').click(function(){
                          $(this).toggleClass('active-color');
                          $('#split').toggleClass('active-color');
                          $('#combine').toggleClass('active-color');
                      });
             });
              $('.collapse').collapse()

       </script>
        <script type="text/javascript">
        $(function () {
                $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Collapse this branch');
                $('.tree li.parent_li > span').on('click', function (e) {
                  var children = $(this).parent('li.parent_li').find(' > ul > li');

                  if (children.is(":visible")) {
                      children.hide('fast');
                      $(this).attr('title', 'Expand this branch').find(' > i').addClass('glyphicon-chevron-down').removeClass('glyphicon-chevron-up');

                  } else {
                      children.show('fast');
                      $(this).attr('title', 'Collapse this branch').find(' > i').addClass('glyphicon-chevron-up').removeClass('glyphicon-chevron-down');
                        $(".tree-menu-list ul").removeClass("collapse");
                  }
                  e.stopPropagation();
                });
                });

        </script>


<!DOCTYPE html>
<html>
  <head>
    <title>Multiple Wizards</title>
    <!-- Bootstrap -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="../prettify.css" rel="stylesheet">
  </head>
  <body>
    <div class='container'>
		
		<div class="span9">
			<section id="wizard">
			  <div class="page-header">
	            <h1>Multiple Wizards</h1>
	          </div>
	
				<div id="rootwizard">
					<div class="navbar">
					  <div class="navbar-inner">
					    <div class="container">
					<ul>
					  	<li><a href="#tab1" data-toggle="tab">First</a></li>
						<li><a href="#tab2" data-toggle="tab">Second</a></li>
						<li><a href="#tab3" data-toggle="tab">Third</a></li>
						<li><a href="#tab4" data-toggle="tab">Forth</a></li>
						<li><a href="#tab5" data-toggle="tab">Fifth</a></li>
						<li><a href="#tab6" data-toggle="tab">Sixth</a></li>
						<li><a href="#tab7" data-toggle="tab">Seventh</a></li>
					</ul>
					 </div>
					  </div>
					</div>
					<div id="bar" class="progress progress-striped active">
					  <div class="bar"></div>
					</div>
					<div class="tab-content">
					    <div class="tab-pane" id="tab1">
					      <p>I'm in Section 1.</p>
					    </div>
					    <div class="tab-pane" id="tab2">
					      <p>Howdy, I'm in Section 2.</p>
					    </div>
						<div class="tab-pane" id="tab3">
							3
					    </div>
						<div class="tab-pane" id="tab4">
							4
					    </div>
						<div class="tab-pane" id="tab5">
							5
					    </div>
						<div class="tab-pane" id="tab6">
							6
					    </div>
						<div class="tab-pane" id="tab7">
							7
					    </div>
						<ul class="pager wizard">
							<li class="previous first" style="display:none;"><a href="#">First</a></li>
							<li class="previous"><a href="#">Previous</a></li>
							<li class="next last" style="display:none;"><a href="#">Last</a></li>
						  	<li class="next"><a href="#">Next</a></li>
						</ul>
					</div>	
				</div>
				
				<div id="pills">
					<ul>
					  	<li><a href="#pills-tab1" data-toggle="tab">First</a></li>
						<li><a href="#pills-tab2" data-toggle="tab">Second</a></li>
						<li><a href="#pills-tab3" data-toggle="tab">Third</a></li>
						<li><a href="#pills-tab4" data-toggle="tab">Forth</a></li>
						<li><a href="#pills-tab5" data-toggle="tab">Fifth</a></li>
						<li><a href="#pills-tab6" data-toggle="tab">Sixth</a></li>
						<li><a href="#pills-tab7" data-toggle="tab">Seventh</a></li>
					</ul>
					<div class="progress progress-danger progress-striped active">
					  <div class="bar"></div>
					</div>
					<div class="tab-content">
					    <div class="tab-pane" id="pills-tab1">
					      <p>I'm in Section 1.</p>
					    </div>
					    <div class="tab-pane" id="pills-tab2">
					      <p>Howdy, I'm in Section 2.</p>
					    </div>
						<div class="tab-pane" id="pills-tab3">
							3
					    </div>
						<div class="tab-pane" id="pills-tab4">
							4
					    </div>
						<div class="tab-pane" id="pills-tab5">
							5
					    </div>
						<div class="tab-pane" id="pills-tab6">
							6
					    </div>
						<div class="tab-pane" id="pills-tab7">
							7
					    </div>
						<ul class="pager wizard">
							<li class="previous first" style="display:none;"><a href="#">First</a></li>
							<li class="previous"><a href="#">Previous</a></li>
							<li class="next last" style="display:none;"><a href="#">Last</a></li>
						  	<li class="next"><a href="#">Next</a></li>
						</ul>
					</div>	
				</div>
				
				<div id="inverse">
					<div class="navbar navbar-inverse">
					  <div class="navbar-inner">
					    <div class="container">
					<ul>
					  	<li><a href="#inverse-tab1" data-toggle="tab">First</a></li>
						<li><a href="#inverse-tab2" data-toggle="tab">Second</a></li>
						<li><a href="#inverse-tab3" data-toggle="tab">Third</a></li>
						<li><a href="#inverse-tab4" data-toggle="tab">Forth</a></li>
						<li><a href="#inverse-tab5" data-toggle="tab">Fifth</a></li>
						<li><a href="#inverse-tab6" data-toggle="tab">Sixth</a></li>
						<li><a href="#inverse-tab7" data-toggle="tab">Seventh</a></li>
					</ul>
					 </div>
					  </div>
					</div>
					<div id="bar" class="progress progress-info progress-striped">
					  <div class="bar"></div>
					</div>
					<div class="tab-content">
					    <div class="tab-pane" id="inverse-tab1">
					      <p>I'm in Section 1.</p>
					    </div>
					    <div class="tab-pane" id="inverse-tab2">
					      <p>
					      	<input type='text' name='name' id='name' placeholder='Enter Your Name'>
					      </p>
					    </div>
						<div class="tab-pane" id="inverse-tab3">
							3
					    </div>
						<div class="tab-pane" id="inverse-tab4">
							4
					    </div>
						<div class="tab-pane" id="inverse-tab5">
							5
					    </div>
						<div class="tab-pane" id="inverse-tab6">
							6
					    </div>
						<div class="tab-pane" id="inverse-tab7">
							7
					    </div>
						<ul class="pager wizard">
							<li class="previous first" style="display:none;"><a href="#">First</a></li>
							<li class="previous"><a href="#">Previous</a></li>
							<li class="next last" style="display:none;"><a href="#">Last</a></li>
						  	<li class="next"><a href="#">Next</a></li>
						</ul>
					</div>	
				</div>
				
				<div id="tabsleft" class="tabbable tabs-left">
					<ul>
					  	<li><a href="#tabsleft-tab1" data-toggle="tab">First</a></li>
						<li><a href="#tabsleft-tab2" data-toggle="tab">Second</a></li>
						<li><a href="#tabsleft-tab3" data-toggle="tab">Third</a></li>
						<li><a href="#tabsleft-tab4" data-toggle="tab">Forth</a></li>
						<li><a href="#tabsleft-tab5" data-toggle="tab">Fifth</a></li>
						<li><a href="#tabsleft-tab6" data-toggle="tab">Sixth</a></li>
						<li><a href="#tabsleft-tab7" data-toggle="tab">Seventh</a></li>
					</ul>
					<div class="progress progress-info progress-striped">
					  <div class="bar"></div>
					</div>
					<div class="tab-content">
					    <div class="tab-pane" id="tabsleft-tab1">
					      <p>I'm in Section 1.</p>
					    </div>
					    <div class="tab-pane" id="tabsleft-tab2">
					      <p>Howdy, I'm in Section 2.</p>
					    </div>
						<div class="tab-pane" id="tabsleft-tab3">
							3
					    </div>
						<div class="tab-pane" id="tabsleft-tab4">
							4
					    </div>
						<div class="tab-pane" id="tabsleft-tab5">
							5
					    </div>
						<div class="tab-pane" id="tabsleft-tab6">
							6
					    </div>
						<div class="tab-pane" id="tabsleft-tab7">
							7
					    </div>
						<ul class="pager wizard">
							<li class="previous first"><a href="javascript:;">First</a></li>
							<li class="previous"><a href="javascript:;">Previous</a></li>
							<li class="next last"><a href="javascript:;">Last</a></li>
						  	<li class="next"><a href="javascript:;">Next</a></li>
							<li class="next finish" style="display:none;"><a href="javascript:;">Finish</a></li>
						</ul>
					</div>	
				</div>
				
			</section>
 		</div>
	</div>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
	<script src="../jquery.bootstrap.wizard.js"></script>
	<script src="../prettify.js"></script>
	<script>
	$(document).ready(function() {
	  	$('#rootwizard').bootstrapWizard({'tabClass': 'nav', 'debug': false, onShow: function(tab, navigation, index) {
				console.log('onShow');
			}, onNext: function(tab, navigation, index) {
				console.log('onNext');
			}, onPrevious: function(tab, navigation, index) {
				console.log('onPrevious');
			}, onLast: function(tab, navigation, index) {
				console.log('onLast');
			}, onTabClick: function(tab, navigation, index) {
				console.log('onTabClick');
				alert('on tab click disabled');
			}, onTabShow: function(tab, navigation, index) {
				console.log('onTabShow');
				var $total = navigation.find('li').length;
				var $current = index+1;
				var $percent = ($current/$total) * 100;
				$('#rootwizard').find('.bar').css({width:$percent+'%'});
			}});
			
			$('#pills').bootstrapWizard({'tabClass': 'nav nav-pills', 'debug': false, onShow: function(tab, navigation, index) {
					console.log('onShow');
				}, onNext: function(tab, navigation, index) {
					console.log('onNext');
				}, onPrevious: function(tab, navigation, index) {
					console.log('onPrevious');
				}, onLast: function(tab, navigation, index) {
					console.log('onLast');
				}, onTabClick: function(tab, navigation, index) {
					console.log('onTabClick');
					alert('on tab click disabled');
				}, onTabShow: function(tab, navigation, index) {
					console.log('onTabShow');
					var $total = navigation.find('li').length;
					var $current = index+1;
					var $percent = ($current/$total) * 100;
					$('#pills').find('.bar').css({width:$percent+'%'});
				}});
				
			$('#tabsleft').bootstrapWizard({'tabClass': 'nav nav-tabs', 'debug': false, onShow: function(tab, navigation, index) {
						console.log('onShow');
					}, onNext: function(tab, navigation, index) {
						console.log('onNext');
					}, onPrevious: function(tab, navigation, index) {
						console.log('onPrevious');
					}, onLast: function(tab, navigation, index) {
						console.log('onLast');
					}, onTabClick: function(tab, navigation, index) {
						console.log('onTabClick');
						
					}, onTabShow: function(tab, navigation, index) {
						console.log('onTabShow');
						var $total = navigation.find('li').length;
						var $current = index+1;
						var $percent = ($current/$total) * 100;
						$('#tabsleft').find('.bar').css({width:$percent+'%'});
						
						// If it's the last tab then hide the last button and show the finish instead
						if($current >= $total) {
							$('#tabsleft').find('.pager .next').hide();
							$('#tabsleft').find('.pager .finish').show();
							$('#tabsleft').find('.pager .finish').removeClass('disabled');
						} else {
							$('#tabsleft').find('.pager .next').show();
							$('#tabsleft').find('.pager .finish').hide();
						}
						
					}});
				
				$('#inverse').bootstrapWizard({'tabClass': 'nav', 'debug': false, onShow: function(tab, navigation, index) {
						console.log('onShow');
					}, onNext: function(tab, navigation, index) {
						console.log('onNext');
						if(index==2) {
							// Make sure we entered the name
							if(!$('#name').val()) {
								alert('You must enter your name');
								$('#name').focus();
								return false;
							}
						}
						
						// Set the name for the next tab
						$('#inverse-tab3').html('Hello, ' + $('#name').val());
						
					}, onPrevious: function(tab, navigation, index) {
						console.log('onPrevious');
					}, onLast: function(tab, navigation, index) {
						console.log('onLast');
					}, onTabClick: function(tab, navigation, index) {
						console.log('onTabClick');
						alert('on tab click disabled');
						return false;
					}, onTabShow: function(tab, navigation, index) {
						console.log('onTabShow');
						var $total = navigation.find('li').length;
						var $current = index+1;
						var $percent = ($current/$total) * 100;
						$('#inverse').find('.bar').css({width:$percent+'%'});
					}});
					
				
				$('#tabsleft .finish').click(function() {
					alert('Finished!, Starting over!');
					$('#tabsleft').find("a[href*='tabsleft-tab1']").trigger('click');
				});	
					
		});
		
	</script>
  </body>
</html>

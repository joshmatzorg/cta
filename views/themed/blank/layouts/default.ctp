<!doctype html>
<?php echo $this->Facebook->html(); ?>
	<head>
		<meta charset="utf-8"/>
		<link type="text/css" href="/cometchat/cometchatcss.php" rel="stylesheet">
		<script type="text/javascript" src="/cometchat/cometchatjs.php"></script>
		
		<title>
			<?php echo $title_for_layout; ?>
		</title>
		<?php echo $this->Html->meta('favicon.ico', '/img/favicon.ico', array('type' => 'icon'));?>
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<?php echo $this->Html->css('less'); ?>
		<?php echo $this->Html->css('jquery-ui'); ?>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script> 
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.10/jquery-ui.min.js"></script> 
		<script src="http://cdn.jquerytools.org/1.2.5/tiny/jquery.tools.min.js"></script>
		<?php echo $this->Html->script('hoverIntent'); ?>
		<?php echo $this->Html->script('superfish'); ?>
		<?php echo $this->Html->script('jquery.jeditable'); ?>
		<?php echo $this->Html->script('jquery.autocomplete.min'); ?>
		<?php echo $this->Html->script('tooltip.dynamic'); ?>
		<script type="text/javascript"> 
		$.fx.speeds._default = 500;
		$(document).ready(function() {
			<?php if(!isset($account)): ?>
				var $dialog = $( "#login" )
					.dialog({
						autoOpen: false,
						title: 'Login',
						draggable: false,
						resizable: false,
						height: 350,
						width: 700,
						modal: true,
						show: "fadein",
						hide: "fadeout",
					});
			
				$('#opener').click(function() {
					$dialog.dialog('open');
					// prevent the default action, e.g., following a link
					return false;
				});
				
				$(".ui-widget-overlay").live("click", function() {  $("#login").dialog("close"); } );
			<?php endif; ?>
			
			$("ul.sf-menu").superfish({ 
	            pathClass:  'current' 
	        }); 

		});
		
		
		</script> 
		<script type="text/javascript">
		
		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-22411238-1']);
		  _gaq.push(['_setDomainName', '.provokeone.com']);
		  _gaq.push(['_trackPageview']);
		
		  (function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();
		
		</script>
	</head>
	
	<body lang="en">
		<header> 
			<!-- logo -->
			<div id="logo" style="float:left;">
			<h1 style="margin:0px;"><?php echo $this->Html->link(__('Provoke One', true), '/', array()); ?></h1> 
			</div> 
			<!-- Absolute top nav -->
			<nav class="account">
				<ul class="account-bar">
					<li class="account-cell account-login">
						<?php // Currently name isn't stored in DB, so we can only use name if they're logged in through FB
							if($account): ?>
							<?php if(isset($facebook_user)): ?>
								Hi, <?php echo $facebook_user['first_name']; ?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo $this->Facebook->logout(array('redirect' => array('controller' => 'accounts', 'action' => 'logout'))); ?>
							<?php else: ?>
								Welcome!&nbsp;&nbsp;|&nbsp;&nbsp;<?php if(isset($facebook_user)): echo $this->Facebook->logout(array('redirect' => array('controller' => 'accounts', 'action' => 'logout'))); else: echo '<a href="/accounts/logout/">logout</a>'; endif; ?>
							<?php endif; ?>
						<?php else: ?>
							
							<?php echo $this->Html->link(__('Login', true), '#', array('id' => 'opener')); ?> or <?php echo $this->Html->link(__('Create an Account', true), array('controller' => 'Accounts', 'action' => 'register')); ?>
						<?php endif; ?>
						</li>
					<li class="account-cell account-view"><?php echo $this->Html->link(__('Account', true), 'http://provokeone.com/accounts/myaccount', array('class' => 'account-link', 'target' => '_blank')); ?></li>
					<li class="account-cell account-support"><?php echo $this->Html->link(__('Support', true), 'http://provokeone.mojohelpdesk.com', array('class' => 'account-link', 'target' => '_blank')); ?></li>
					<li class="account-cell account-browse"><?php echo $this->Html->link(__('Browse', true), array('#'), array('class' => 'account-dropdown')); ?></li>
				</ul>
			</nav>
			
			<nav style="clear:both;">
				<ul class="sf-menu"> 
					<li> 
						<a href="/">Home</a> 
					</li>  
					<li> 
						<a href="http://www.provokeone.com/ctagamewiki">Guide</a> 
					</li> 
					<li> 
						<a href="/forums">Forum</a> 
					</li>
					<li> 
						<a href="/fames">HoF</a> 
					</li> 
					<li>
						<a href="/play">Play</a>
					</li>
				</ul>
			</nav>
			<div style="clear:both;"></div>
			
		</header> 
		<section id="main" style="text-align:left;">
			
			<!-- Start content -->
			<div style="float: left; margin-bottom: 135px;">		
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->Session->flash('auth'); ?>
				<?php echo $content_for_layout; ?>
				<div style="clear:both;"></div>
			</div>	
			<!-- End content -->
			<div style="clear:both;"></div>
		</section>
		<?php if(!$account): ?>
		<!-- Start login dialog --> 
		<div style="display: none;" id="login" title="Login">
		
			<div style="float:left; width:50%;">
			<?php echo $this->Form->create('Account', array('controller' => 'accounts', 'action' => 'login')); ?>
			 
			    <?php
			        echo $this->Form->input('email');
			        echo $this->Form->input('password');
			        echo $this->Form->input('keep me logged in', array('type' => 'checkbox'))
			    ?>
			 
			<?php echo $this->Form->end('Login'); ?>
			</div>
			<?php //debug($Account); ?>
			<div style="float:left;width:50%;">
			<?php if(isset($facebook_user)): ?>
				<?php if(isset($facebook_user)): echo $this->Facebook->logout(array('redirect' => array('controller' => 'accounts', 'action' => 'logout'))); else: echo '<a href="/accounts/logout/">logout</a>'; endif; ?>
				<?php //debug($this->facebook_user); ?>
			<?php else: ?>
				<div style="color: red;">If you have purchased PP on Facebook before, please use this option.</div>
				<?php echo $this->Facebook->login(array('perms' => 'email', 'size' => 'xlarge')); ?>
			<?php endif; ?>
			</div>
		</div>
		<!-- End login Dialog --> 
		<?php endif; ?>
		<div style="clear:both;"></div>
		<!-- Footer -->
		<footer> 
		
			<section id="copyright"> 
				<p>
					<b><a href="/policies/privacy">Privacy Policy</a> | <a href="/policies/terms">Terms of Service</a> | <a href="http://provokeone.mojohelpdesk.com/" target="_blank">Support</a> | <a href="/forums">Forum</a></b>
				</p>
			</section> 
		
			<section id="footer-logo"> 
				<p>Provoke One | <span style="color:#444;">CTA is developed soley by <a href="http://joshmatz.com" target="_blank" style="color:#075070;">Josh Matz</a> with support from the CTA Community.</span></p>
			</section> 
		</footer> 
		<!-- End Footer -->
		<?php echo $this->Js->writeBuffer(); ?>
		<?php echo $this->element('sql_dump'); ?>
		<?php echo $this->Facebook->init(); ?>
	</body>
	
</html>
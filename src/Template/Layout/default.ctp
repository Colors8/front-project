<!DOCTYPE html>
<html>
<head>
	<?= $this->Html->charset() ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="" />
	<meta name="author" content="Beats" />

	<title><?php if(isset($seo_title)){echo $seo_title." | ";} ?>Beats ID</title>

	<link rel="alternate" type="application/rss+xml" title="Flux | New Dova" href="http://newdova.com/feed/">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo $this->request->webroot.'img/ui/favicon.png'; ?>">
	<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

	<?= $this->Html->css('style.css') ?>
	<?= $this->Html->css('font-awesome/css/font-awesome.min') ?>

	<?= $this->Html->script('jquery.min.js') ?>
	<?= $this->Html->script('skrollr.min.js') ?>
	<?= $this->Html->script('message.js') ?>

	<?= $this->fetch('meta') ?>
	<?= $this->fetch('css') ?>
	<?= $this->fetch('script') ?>
</head>
<body>
	
	<header id="site-header">
		<div class="container">

			<div id="site-header--logo">
				<a href="<?php echo $this->Url->build(["controller" => "Pages", "action" => "home"]); ?>">
					<img src="<?php echo $this->request->webroot.'img/ui/logo-white.png' ?>" />
				</a>
			</div>

			<nav id="site-menu">
				<ul>
					<li><a href="<?php echo $this->Url->build(["controller" => "Pages", "action" => "spec"]); ?>">
						<i class="fa fa-cog"></i><span>Specifications</span>
					</a></li>
					<li><a href="<?php echo $this->Url->build(["controller" => "Pages", "action" => "video"]); ?>">
						<i class="fa fa-volume-up"></i><span>Sound Experience</span>
					</a></li>
					<li><a href="<?php echo $this->Url->build(["controller" => "Beats", "action" => "add"]); ?>">
						<i class="fa fa-headphones"></i><span>3D Customizer</span>
					</a></li>
					<li><a href="<?php echo $this->Url->build(["controller" => "Beats", "action" => "index"]); ?>">
						<i class="fa fa-share-alt"></i><span>Community</span>
					</a></li>
				</ul>
			</nav>

			<div id="site-header--account">
				<?php if (!$this->request->session()->read('Auth.User')): ?>
					<div id="site-header--account-inner" onclick="" style="background-image: url('<?php echo $this->request->webroot.'img/ui/user.png'; ?>');"></div>
				<?php else: ?>
					<div id="site-header--account-inner" onclick="" style="background-image: url('<?php echo $this->request->webroot.'img/users/'.$this->request->session()->read('Auth.User.image'); ?>');"></div>
				<?php endif; ?>
				<div id="site-header--account-content">
					<?php if (!$this->request->session()->read('Auth.User')): ?>
						<ul>
							<li><a href="<?php echo $this->Url->build(["controller" => "Users", "action" => "register"]); ?>">
								<i class="fa fa-bolt"></i><span>Register</span>
							</a></li>
							<hr />
							<li><a href="<?php echo $this->Url->build(["controller" => "Users", "action" => "login"]); ?>">
								<i class="fa fa-sign-in"></i><span>Login</span>
							</a></li>
						</ul>
					<?php else: ?>
						<h4>Welcome <?php echo $this->request->session()->read('Auth.User.username'); ?> !</h4>
						<ul>
							<li><a href="<?php echo $this->Url->build(["controller" => "Users", "action" => "view", $this->request->session()->read('Auth.User.username')]); ?>">
								<i class="fa fa-user"></i><span>My account</span>
							</a></li>
							<li><a href="<?php echo $this->Url->build(["controller" => "Pages", "action" => "spec"]); ?>">
								<i class="fa fa-cog"></i><span>Specifications</span>
							</a></li>
							<li><a href="<?php echo $this->Url->build(["controller" => "Pages", "action" => "video"]); ?>">
								<i class="fa fa-volume-up"></i><span>Sound Experience</span>
							</a></li>
							<li><a href="<?php echo $this->Url->build(["controller" => "Beats", "action" => "add"]); ?>">
								<i class="fa fa-headphones"></i><span>3D Customizer</span>
							</a></li>
							<li><a href="<?php echo $this->Url->build(["controller" => "Beats", "action" => "index"]); ?>">
								<i class="fa fa-share-alt"></i><span>Community</span>
							</a></li>
							<hr />
							<li><a href="<?php echo $this->Url->build(["controller" => "Users", "action" => "logout"]); ?>">
								<i class="fa fa-sign-out"></i><span>Logout</span>
							</a></li>
						</ul>
					<?php endif; ?>
				</div>
			</div>
			<script>
				jQuery(function() {
					$(document).on('click', "#site-header--account-inner", function () {
						if ( $("#site-header--account-content").hasClass('active') ) {
							$("#site-header--account-content").removeClass('active');
							$("#site-header--account-inner").removeClass('active');
						} else {
							$("#site-header--account-content").addClass('active');
							$("#site-header--account-inner").addClass('active');
						}
					});
				});
			</script>

		</div>
	</header>

	<div id="site-content">
		<?= $this->Flash->render() ?>
		<?= $this->fetch('content') ?>
	</div>

	<footer id="site-footer" style="display: none;">

	</footer>

	<div id="loader" class="active">
		<div id="loader-circle"></div>
	</div>
	<script>
		jQuery(function() {

			var body = document.body,
			timer;

			window.addEventListener('scroll', function() {
				clearTimeout(timer);
				if(!body.classList.contains('disable-hover')) {
					body.classList.add('disable-hover')
				}
				timer = setTimeout(function(){
					body.classList.remove('disable-hover')
				},100);
			}, false);

			setTimeout(function(){$("#body").removeClass('hide');}, 200);
			setTimeout(function(){$("#loader").removeClass('active');}, 200);

			$(window).on('beforeunload ', function(e) {
				$("#loader").addClass('active');
			});
			
		});
	</script>

</body>
</html>

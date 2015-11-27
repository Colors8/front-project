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
	<?= $this->Html->css('galacticbox.css') ?>
	<?= $this->Html->css('font-awesome/css/font-awesome.min') ?>

	<?= $this->Html->script('jquery.min.js') ?>
	<?= $this->Html->script('skrollr.min.js') ?>
	<?= $this->Html->script('message.js') ?>
	<?= $this->Html->script('galacticbox.js') ?>
	<?= $this->Html->script('loader.js') ?>

	<?= $this->fetch('meta') ?>
	<?= $this->fetch('css') ?>
	<?= $this->fetch('script') ?>
</head>
<body>
	
	<?= $this->Flash->render() ?>
	<?= $this->fetch('content') ?>

	<div id="loader" class="active">
		<div id="loader-circle"></div>
	</div>

	<section id="galacticbox" class="">
		<div id="galacticbox-mask"></div>
		<div id="galacticbox-content"></div>
		<div id="galacticbox-close"></div>
	</section>

</body>
</html>

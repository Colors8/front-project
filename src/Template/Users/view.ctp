<div id="site-header--spacer"></div>

<div id="userview">

	<div id="userview-header"
			data-center="background-position: 50% 50%;"
			data-top-bottom="background-position: 50% 0%;"
			data-anchor-target="#userview-header">
		<div id="userview-header--inner">
			<div class="container2">

				<div id="userview-header--photo"
					style="background-image: url('<?php echo $this->request->webroot.'img/users/'.$this->request->session()->read('Auth.User.image') ?>');"></div>
				<div id="userview-header--content">
					<div id="userview-header--content-inner">
						<h2><?php echo $this->request->session()->read('Auth.User.username') ?></h2>
						<hr />
						<span>( <?php echo count($user->beats) ?> contributions )</span>
					</div>
				</div>

			</div>
		</div>
	</div>

	<div id="userview-customs">
		<div class="container">
			<div id="userview-customs--header">
				<a href="<?php echo $this->Url->build(["controller" => "Beats", "action" => "add"]); ?>"><button><i class="fa fa-plus"></i>New Headphone</button></a>
			</div>

			<?php foreach($user->beats as $beat): ?>
				<div class="userview-custom">
					<a href="<?php echo $this->Url->build(["controller" => "Beats", "action" => "add", $beat->id]); ?>">
						<div class="userview-custom--inner" style="background-image: url('<?php echo $this->request->webroot.'img/beats/'.$beat->image; ?>');">
							<div class="userview-custom--name"><h3><?php echo $beat->name; ?></h3></div>
						</div>
					</a>
					<a href="<?php echo $this->Url->build(["controller" => "Beats", "action" => "delete", $beat->id]); ?>">
						<div class="userview-custom--delete"><i class="fa fa-times"></i></div>
					</a>
				</div>
			<?php endforeach; ?>

		</div>
	</div>

</div>

<script>
	if(!(/Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/i).test(navigator.userAgent || navigator.vendor || window.opera)){
		var s = skrollr.init({
			forceHeight: false
		});
	}
</script>
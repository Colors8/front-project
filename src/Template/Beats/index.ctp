

	<div id="userview-customs">
		<div class="container">
			<div id="userview-customs--header">
				<a href="<?php echo $this->Url->build(["controller" => "Beats", "action" => "add"]); ?>"><button><i class="fa fa-plus"></i>New Headphone</button></a>
			</div>

			<?php foreach($beats as $beat): ?>
				<div class="userview-custom">
					<a href="<?php echo $this->Url->build(["controller" => "Beats", "action" => "add", $beat->id]); ?>">
						<div class="userview-custom--inner" style="background-image: url('<?php echo $this->request->webroot.'img/beats/'.$beat->image; ?>');">
							<div class="userview-custom--name"><h3><?php echo $beat->name; ?></h3></div>
						</div>
					</a>
				</div>
			<?php endforeach; ?>

		</div>
	</div>
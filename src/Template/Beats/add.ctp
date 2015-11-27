<?= $this->Html->script('webgl/three.min.js') ?>
<?= $this->Html->script('webgl/OrbitControls.js') ?>
<?= $this->Html->script('webgl/MTLLoader.js') ?>
<?= $this->Html->script('webgl/OBJMTLLoader.js') ?>
<?= $this->Html->script('webgl/Detector.js') ?>
<?= $this->Html->script('webgl/stats.min.js') ?>
<?= $this->Html->script('webgl/Projector.js') ?>

<?= $this->Html->script('customizer.js') ?>
<script>
	jQuery(function() {
		startWebGL(<?php echo $jsonbeats_origin; ?>);
	});
</script>

<section id="beatsid">

	<div id="beatsid-header"></div>

	<div id="beatsid-preview" class="<?php if(isset($beat_id)){echo "active";} ?>">
		<canvas id="canvas"></canvas>
		<div id="beatsid-music">
			<span>Drag & Drop your music !</span>
			<div id="beatsid-music--mute" class="beatsid-music--control" onclick="scene3D.onOffAudio()"><i class="fa fa-play"></i></div>
		</div>
		<div id="beatsid-panel--save">
			<?php if ($this->request->session()->read('Auth.User')): ?>
				<button class="save">Save this custom Beats</button>
			<?php else: ?>
				<a href="<?php echo $this->Url->build(["controller" => "Users", "action" => "register"]); ?>">
					<button class="">Create an account</button>
				</a>
			<?php endif; ?>
		</div>
	</div>

	<div id="beatsid-panel" class="<?php if(!isset($beat_id)){echo "active";} ?>">
		<div id="beatsid-panel--inner" class="">
			<div id="beatsid-parts">
				<div class="beatsid-paneltitle">
					<h1><?php echo $custom_name; ?></h1>
					<h2>Headphone parts</h2>
				</div>

				<div id="beatsid-parts--inner">
					<?php foreach( $parts as $part ): ?>
						<div class="beatsid-part" id="beatsid-part-<?= $part['simple']; ?>" data-simple="<?= $part['simple']; ?>">

							<div class="beatsid-part--icon" <?php
								if (isset($jsonbeats_array)) {
									foreach ($jsonbeats_array as $jsonbeats_elem) {
										if ($jsonbeats_elem["name"]==$part['simple']) {
											echo 'style="background-color: '.$jsonbeats_elem["color"].';" data-mesh="'.$jsonbeats_elem["obj"].'"';
										}
									}
								} else {
									echo 'style="background-color: #ffffff;" data-mesh="'.$part['simple'].'_normal.json"';
								}
							?>></div>
							<div class="beatsid-part--content"><span><?= $part['name']; ?></span></div>
							<div class="beatsid-part--arrow"><i class="fa fa-arrow-right"></i></div>

						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div id="beatsid-colorsm">

				<div id="beatsid-colorsm--close" onclick=""></div>
				<?php foreach( $parts as $part ): ?>
					<div class="beatsid-colors" id="beatsid-colors-<?= $part['simple']; ?>">
						<div class="beatsid-paneltitle">
							<h2><?= $part['name']; ?></h2>
							<h3>Color selection</h3>
						</div>
						<hr />
						<?php foreach( $part['colors'] as $color ): ?>
							<div class="beatsid-color" style="background-color: <?= $color['hex']; ?>;"
								onclick="scene3D.changeColor('<?= $part['simple']; ?>', '<?= $color['hex']; ?>');"></div>
						<?php endforeach; ?>
					</div>
				<?php endforeach; ?>

				<?php foreach( $parts as $part ): ?>
					<div class="beatsid-models" id="beatsid-models-<?= $part['simple']; ?>">
						<div class="beatsid-paneltitle">
							<h2>Model selection</h2>
						</div>
						<hr />
						<?php foreach( $part['models'] as $model ): ?>
							<div class="beatsid-model" style="background-model: <?= $model['obj']; ?>;"
								onclick="scene3D.changeModel('<?= $part['simple']; ?>', '<?= $model['obj']; ?>');"><?= $model['name']; ?></div>
						<?php endforeach; ?>
					</div>
				<?php endforeach; ?>

			</div>
		</div>
	</div>
	<div id="beatsid-panel--button" class="<?php if(!isset($beat_id)){echo "active";} ?>" onclick=""></div>

	<div id="beatsid-save--popup">
		<div id="beatsid-save--popup-mask" onclick=""></div>
		<div id="beatsid-save--popup-inner">
			<div id="userform">
				<h2>Save and Share your custom Beats Studio Wireless !</h2>
				<?php echo $this->Form->create(null, ['id'=>'beatsid-submit']); ?>
					<hr />
					<?php
						foreach( $parts as $part ) {
							echo $this->Form->input($part['simple']."_color", ['label' => false, 'required'=>'required', 'type'=>'hidden', 'value'=>'#ffffff']);
							echo $this->Form->input($part['simple']."_mesh", ['label' => false, 'required'=>'required', 'type'=>'hidden', 'value'=>$part['simple'].'_normal.json']);
						}
						echo $this->Form->input("image", ['label' => false, 'type'=>'hidden', 'value'=>'']);
						echo $this->Form->label('name', '<i class="fa fa-audio"></i><span>Pick a name for your Beats</span>', ['escape' => false]);
						echo $this->Form->input('name', ['label' => false, 'required'=>'required', 'type'=>'text']);
					?>
					<hr />
					<?php echo $this->Form->button(__('Save and Share')); ?>
				<?php echo $this->Form->end() ?>
			</div>
		</div>
	</div>

</section>
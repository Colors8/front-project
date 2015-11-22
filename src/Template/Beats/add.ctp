<?= $this->Html->script('webgl/three.min.js') ?>
<?= $this->Html->script('webgl/OrbitControls.js') ?>
<?= $this->Html->script('webgl/MTLLoader.js') ?>
<?= $this->Html->script('webgl/OBJMTLLoader.js') ?>
<?= $this->Html->script('webgl/Detector.js') ?>
<?= $this->Html->script('webgl/stats.min.js') ?>
<?= $this->Html->script('webgl/Projector.js') ?>

<section id="beatsid">

	<div id="beatsid-header"></div>

	<div id="beatsid-preview" class="<?php if(isset($beat_id)){echo "active";} ?>">
		<canvas id="canvas"></canvas>
		<div id="beatsid-music">
			<span>Drag & Drop your music !</span>
			<div id="beatsid-music--mute" class="beatsid-music--control" onclick="scene3D.onOffAudio()"><i class="fa fa-play"></i></div>
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
			<script>
				jQuery(function() {
					$(document).on('click', ".beatsid-part", function() {
						var targetColors = "#beatsid-colors-"+$(this).data("simple");
						var targetModels = "#beatsid-models-"+$(this).data("simple");

						$(".beatsid-colors").removeClass("visible");
						$(".beatsid-models").removeClass("visible");
						$(targetColors).addClass("visible");
						$(targetModels).addClass("visible");
						$("#beatsid-panel--inner").addClass('color');
					});
					$(document).on('click', "#beatsid-colorsm--close", function() {
						$("#beatsid-panel--inner").removeClass('color');
					});
				});
			</script>
		</div>
	</div>
	<div id="beatsid-panel--button" class="<?php if(!isset($beat_id)){echo "active";} ?>" onclick=""></div>
	<script>
		jQuery(function() {
			$(document).on('click', "#beatsid-panel--button", function() {
				if ( $("#beatsid-panel").hasClass('active') ) {
					$("#beatsid-panel").removeClass('active');
					$("#beatsid-preview").addClass('active');
					$("#beatsid-panel--button").removeClass('active');
				} else {
					$("#beatsid-panel").addClass('active');
					$("#beatsid-preview").removeClass('active');
					$("#beatsid-panel--button").addClass('active');
				}
			});
		});
	</script>

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
	<script>
		function giveHexColor(colorRGB) {
			var parts = colorRGB.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
			delete(parts[0]);
			for (var i = 1; i <= 3; ++i) {
				parts[i] = parseInt(parts[i]).toString(16);
				if (parts[i].length == 1) parts[i] = '0' + parts[i];
			}
			return ('#' + parts.join(''));
		}

		jQuery(function() {
			$(document).on('click', "#beatsid-panel--save button.save", function() {
				$(".beatsid-part").each(function() {
					var color = giveHexColor( $(this).children(".beatsid-part--icon").css("background-color") );
					var mesh = $(this).children(".beatsid-part--icon").data("mesh");
					$("#beatsid-submit input[name="+$(this).data("simple")+"_color]").val( color );
					$("#beatsid-submit input[name="+$(this).data("simple")+"_mesh]").val( mesh );
				});
				$("#beatsid-save--popup").addClass("active");
				$("#beatsid-submit input[name=image]").val( scene3D.renderer.domElement.toDataURL("image/png") );
			});
			$(document).on('click', "#beatsid-save--popup-mask", function() {
				$("#beatsid-save--popup").removeClass("active");
			});
		});
	</script>

</section>

<script>
	jQuery(function() {
		$( document ).on('click', ".beatsid-panelbox", function() {

			var number = $( this ).attr( "id" ).split( "-" ).pop();
			var targetPanelchoice = "#beatsid-panelchoice-" + number;
			var targetPanelbox = "#beatsid-panelbox-" + number;

			if ( $( this ).hasClass("active") ) {
				$( ".beatsid-panelchoice" ).removeClass( "active" );
				$( ".beatsid-panelbox" ).removeClass( "active" );
			} else {
				$( ".beatsid-panelchoice" ).removeClass( "active" );
				$( ".beatsid-panelbox" ).removeClass( "active" );
				$( targetPanelchoice ).addClass( "active" );
				$( targetPanelbox ).addClass( "active" );
			}
		});
	});
</script>

<script>

	var scene3D;
	$(document).ready(function () {
		jsonbeats_origin = <?php echo $jsonbeats_origin; ?>;
		scene3D = new Scene3D(jsonbeats_origin);

		scene3D.initialize();
		animate();
	});

	var Scene3D = function(jsonbeats_origin) {
		// Beats ID custom settings
		this.jsonbeats = jsonbeats_origin;

		// Audio Visualizer
		this.analyser;
		this.numberOfBars = 40;
		this.barsLeft = new Array();
		this.barsRight = new Array();
		this.audioContext = new AudioContext();
		this.sourceBuffer = this.audioContext.createBufferSource();
		this.fileResult;

		// Scene Three.js
		this.scene;
		this.camera;
		this.renderer;
		this.raycaster = new THREE.Raycaster();
		this.mouse = new THREE.Vector2();

		// JSON Loader
		this.loader = new THREE.JSONLoader();
		this.beats_headphone = new THREE.Group();

		// Headphones Rotation
		this.targetRotationX = 0;
		this.targetRotationOnMouseDownX = 0;
		this.targetRotationY = 0;
		this.targetRotationOnMouseDownY = 0;

		// Mouse States
		this.mouseX = 0;
		this.mouseXOnMouseDown = 0;
		this.mouseY = 0;
		this.mouseYOnMouseDown = 0;

		// Window sizes
		this.windowX = window.innerWidth;
		this.windowY = window.innerHeight;
		this.windowHalfX = window.innerWidth / 2;
		this.windowHalfY = window.innerHeight / 2;

		// Canvas sizes
		this.canvasX = document.getElementById("beatsid-preview").offsetWidth;
		this.canvasY = document.getElementById("beatsid-preview").offsetHeight;

		// Raytracer
		this.projector = new THREE.Projector();
		this.mouse_vector = new THREE.Vector3();
		this.mouse = { x: 0, y: 0, z: 1 };
		this.ray = new THREE.Raycaster( new THREE.Vector3(0,0,0), new THREE.Vector3(0,0,0) );
		this.intersects = [];

		// for Window resize
		this.rtime;
		this.timeout = false;
		this.delta = 200;
	}

	Scene3D.prototype.initialize = function () {
		// Hide Footer
		$("#site-footer").hide();

		// Create scene
		this.scene = new THREE.Scene();

		// Initialize renderer
		this.renderer = new THREE.WebGLRenderer({ antialias:true, alpha:true, canvas:document.getElementById("canvas"), preserveDrawingBuffer:true });
		this.renderer.setSize( this.canvasX, this.canvasY );

		// Create camera
		this.camera = new THREE.PerspectiveCamera(45, this.canvasX / this.canvasY, 0.1, 10000);
		this.camera.position.set( 0, 0, 60 );
		this.scene.add( this.camera );

		// Headphone Group
		this.beats_headphone.position.x = 0;
		this.beats_headphone.position.y = 0;
		this.beats_headphone.position.z = 0;
		this.scene.add( this.beats_headphone );

		// Hemisphere Light
		this.hemiLight = new THREE.HemisphereLight( 0xffffff, 0xffffff, 0.6 );
		this.hemiLight.color.setHSL( 0.6, 1, 0.6 );
		this.hemiLight.groundColor.setHSL( 0.095, 1, 0.75 );
		this.hemiLight.position.set( 0, 500, 0 );
		this.scene.add( this.hemiLight );

		// Directional Light
		this.dirLight = new THREE.DirectionalLight( 0xffffff, 1 );
		this.dirLight.color.setHSL( 0.1, 1, 0.95 );
		this.dirLight.position.set( -1, 1.75, 1 );
		this.dirLight.position.multiplyScalar( 50 );
		this.scene.add( this.dirLight );

		// Initialize Headphone Parts
		this.addObjectToHeadphone(this.jsonbeats[0].name, this.jsonbeats[0].obj, 200, this.jsonbeats[0].color);
		this.addObjectToHeadphone(this.jsonbeats[1].name, this.jsonbeats[1].obj, 200, this.jsonbeats[1].color);
		this.addObjectToHeadphone(this.jsonbeats[2].name, this.jsonbeats[2].obj, 020, this.jsonbeats[2].color);
		this.addObjectToHeadphone(this.jsonbeats[3].name, this.jsonbeats[3].obj, 300, this.jsonbeats[3].color);
		this.addObjectToHeadphone(this.jsonbeats[4].name, this.jsonbeats[4].obj, 020, this.jsonbeats[4].color);
		this.addObjectToHeadphone(this.jsonbeats[5].name, this.jsonbeats[5].obj, 020, this.jsonbeats[5].color);
		this.addObjectToHeadphone(this.jsonbeats[6].name, this.jsonbeats[6].obj, 100, this.jsonbeats[6].color);
		this.addObjectToHeadphone(this.jsonbeats[7].name, this.jsonbeats[7].obj, 200, this.jsonbeats[7].color);
		this.addObjectToHeadphone(this.jsonbeats[8].name, this.jsonbeats[8].obj, 020, this.jsonbeats[8].color);

		// Initialize Audio Visualizer
		this.createBars();
		this.setupAudioProcessing();
		this.getAudio();

		// Event listeners
		canvas = document.getElementById("canvas");
		canvas.addEventListener( 'mousedown', onMouseDown, false );
		canvas.addEventListener( 'touchstart', onTouchStart, false );
		canvas.addEventListener( 'touchmove', onTouchMove, false );
		canvas.addEventListener( 'dragenter', onMouseDragEnter, false);
		canvas.addEventListener( 'dragover', onMouseDragOver, false);
		canvas.addEventListener( 'dragleave', onMouseDragLeave, false);
		canvas.addEventListener( 'drop', onMouseDrop, false);
		window.addEventListener( 'resize', onWindowResize, false );
	}

	Scene3D.prototype.createBars = function () {
		for (var i = 0; i < this.numberOfBars; i++) {

			var barGeometry = new THREE.BoxGeometry(0.1, 0.1, 0.1);

			var material = new THREE.MeshPhongMaterial({
				color: "#aaa",
				shininess: 0
			});

			this.barsLeft[i] = new THREE.Mesh(barGeometry, material);
			this.barsLeft[i].position.set(this.numberOfBars - i - this.numberOfBars, 0, -20);
			this.barsLeft[i].visible = false;

			this.scene.add( this.barsLeft[i] );
		}
		for (var i = 0; i < this.numberOfBars; i++) {

			var barGeometry = new THREE.BoxGeometry(0.02, 0.1, 0.1);

			var material = new THREE.MeshPhongMaterial({
				color: "#aaa",
				shininess: 0
			});

			this.barsRight[i] = new THREE.Mesh(barGeometry, material);
			this.barsRight[i].position.set(i, 0, -20);
			this.barsRight[i].visible = false;

			this.scene.add( this.barsRight[i] );
		}
	}

	Scene3D.prototype.setupAudioProcessing = function () {
		var javascriptNode = this.audioContext.createScriptProcessor(2048, 1, 1);
		javascriptNode.connect(this.audioContext.destination);

		this.analyser = this.audioContext.createAnalyser();
		this.analyser.smoothingTimeConstant = 0.3;
		this.analyser.fftSize = 512;

		this.sourceBuffer.connect(this.analyser);
		this.analyser.connect(javascriptNode);
		this.sourceBuffer.connect(this.audioContext.destination);

		var that = this;
		javascriptNode.onaudioprocess = function () {
			var array = new Uint8Array(that.analyser.frequencyBinCount);
			that.analyser.getByteFrequencyData(array);

			var step = Math.round(array.length / that.numberOfBars);

			for (var i = that.numberOfBars-1; i >= 0; i--) {
				var value = array[i * step] / 8;
				value = value < 1 ? 1 : value;
				that.barsLeft[i].scale.y = value*4;
			}
			for (var i = 0; i < that.numberOfBars; i++) {
				var value = array[i * step] / 8;
				value = value < 1 ? 1 : value;
				that.barsRight[i].scale.y = value*4;
			}
		}
	}

	Scene3D.prototype.getAudio = function () {
		var request = new XMLHttpRequest();
		request.open("GET", "Asset/Aathi-StarMusiQ.Com.mp3", true);
		request.responseType = "arraybuffer";
		request.send();
		request.onload = function () {
			//that.start(request.response);
		}
	}

	Scene3D.prototype.startAudio = function (buffer) {
		var that = this;
		this.audioContext.decodeAudioData(buffer, decodeAudioDataSuccess, decodeAudioDataFailed);

		function decodeAudioDataSuccess( decodedBuffer ) {
			that.sourceBuffer.buffer = decodedBuffer
			that.sourceBuffer.loop = true
			that.sourceBuffer.start();
			that.showBars();
		}
		function decodeAudioDataFailed() {debugger}
	}

	Scene3D.prototype.onOffAudio = function () {
		var that = this;
		if(that.audioContext.state === 'running') {
			that.audioContext.suspend();
			$("#beatsid-music i").removeClass('fa-pause').addClass('fa-play');
			that.hideBars();
		} else if(that.audioContext.state === 'suspended') {
			that.audioContext.resume();
			$("#beatsid-music i").removeClass('fa-play').addClass('fa-pause');
			that.showBars();
		}
	}

	Scene3D.prototype.hideBars = function () {
		for (var i = 0; i < this.numberOfBars; i++) {
			this.barsLeft[i].visible = false;
		}
		for (var i = 0; i < this.numberOfBars; i++) {
			this.barsRight[i].visible = false;
		}
	}
	Scene3D.prototype.showBars = function () {
		for (var i = 0; i < this.numberOfBars; i++) {
			this.barsLeft[i].visible = true;
		}
		for (var i = 0; i < this.numberOfBars; i++) {
			this.barsRight[i].visible = true;
		}
	}

	Scene3D.prototype.addObjectToHeadphone = function ( obj_name, obj_json, obj_shininess, obj_color ) {
		var that = this;
		this.loader.load( '<?php echo $this->request->webroot."obj/"; ?>'+obj_json, function( geometry ) {
			object = new THREE.Mesh( geometry,
				new THREE.MeshPhongMaterial({
					color: obj_color,
					specular: 0x050505,
					shininess: obj_shininess
				})
			);
			object.name = obj_name;
			object.scale.set(2.5,2.5,2.5);
			object.position.set(0,0,0);
			that.beats_headphone.add( object );
		});
	}

	Scene3D.prototype.removebeats_headphoneEntity = function ( object ) {
		var selectedObject = this.scene.getObjectByName( object );
		this.beats_headphone.remove( selectedObject );
	}

	Scene3D.prototype.changeModel = function ( obj_simple, obj_name ) {
		var save_color = this.scene.getObjectByName( obj_simple ).material.color.getHex();
		var that = this;
		this.loader.load( '<?php echo $this->request->webroot."obj/"; ?>'+obj_name, function( geometry ) {
			object = new THREE.Mesh( geometry,
				new THREE.MeshPhongMaterial({
					color: save_color,
					specular: 0x050505,
					shininess: 100
				})
			);
			that.removebeats_headphoneEntity( obj_simple );
			object.name = obj_simple;
			object.scale.set(2.5,2.5,2.5);
			object.position.set(0,0,0);
			that.beats_headphone.add( object );
		});

		var target = "#beatsid-part-"+obj_simple+" .beatsid-part--icon";
		$(target).data("mesh", obj_name);
	}

	Scene3D.prototype.changeColor = function (obj_simple, obj_color) {
		this.scene.getObjectByName( obj_simple ).material.color.set( obj_color );
		var target = "#beatsid-part-"+obj_simple+" .beatsid-part--icon";
		$(target).attr("style", "background-color:"+obj_color+";");
	}

	function onWindowResize () {
		scene3D.rtime = new Date();
		if (scene3D.timeout === false) {
			scene3D.timeout = true;
			setTimeout(onWindowResizeEnd, scene3D.delta);
		}
	}

	function onWindowResizeEnd () {
		if (new Date() - scene3D.rtime < scene3D.delta) {
			setTimeout(onWindowResizeEnd, scene3D.delta);
		} else {
			scene3D.timeout = false;
			scene3D.canvasX = document.getElementById("beatsid-preview").offsetWidth;
			scene3D.canvasY = document.getElementById("beatsid-preview").offsetHeight;

			scene3D.camera.aspect = scene3D.canvasX / scene3D.canvasY;
			scene3D.camera.updateProjectionMatrix();

			scene3D.renderer.setSize(scene3D.canvasX, scene3D.canvasY);
		}
	}

	function onMouseDown ( event ) {
		event.preventDefault();

		document.addEventListener( 'mousemove', onMouseMove, false );
		document.addEventListener( 'mouseup', onMouseUp, false );
		document.addEventListener( 'mouseout', onMouseOut, false );

		scene3D.mouseXOnMouseDown = event.clientX - scene3D.windowHalfX;
		scene3D.targetRotationOnMouseDownX = scene3D.targetRotationX;

		scene3D.mouseYOnMouseDown = event.clientY - scene3D.windowHalfY;
		scene3D.targetRotationOnMouseDownY = scene3D.targetRotationY;

		scene3D.mouse.x = ( ( event.clientX - scene3D.renderer.domElement.offsetLeft ) / scene3D.renderer.domElement.width ) * 2 - 1;
		scene3D.mouse.y = - ( ( event.clientY - scene3D.renderer.domElement.offsetTop ) / scene3D.renderer.domElement.height ) * 2 + 1;
		scene3D.mouse_vector.set( scene3D.mouse.x, scene3D.mouse.y, scene3D.mouse.z );

		scene3D.projector.unprojectVector( scene3D.mouse_vector, scene3D.camera );
		var direction = scene3D.mouse_vector.sub( scene3D.camera.position ).normalize();

		scene3D.ray.set( scene3D.camera.position, direction );
		scene3D.intersects = scene3D.ray.intersectObject( scene3D.beats_headphone, true );

		if( scene3D.intersects.length ) {
			var targetColors = "#beatsid-colors-"+scene3D.intersects[0].object.name;
			var targetModels = "#beatsid-models-"+scene3D.intersects[0].object.name;
			$(".beatsid-colors").removeClass("visible");
			$(".beatsid-models").removeClass("visible");
			$(targetColors).addClass("visible");
			$(targetModels).addClass("visible");
			$("#beatsid-panel--inner").addClass('color');
		}
	}

	function onMouseMove ( event ) {
		scene3D.mouseX = event.clientX - scene3D.windowHalfX;
		scene3D.mouseY = event.clientY - scene3D.windowHalfY;
		scene3D.targetRotationX = scene3D.targetRotationOnMouseDownX + (scene3D.mouseX - scene3D.mouseXOnMouseDown) * 0.02;
		scene3D.targetRotationY = scene3D.targetRotationOnMouseDownY + (scene3D.mouseY - scene3D.mouseYOnMouseDown) * 0.02;
	}

	function onMouseUp ( event ) {
		document.removeEventListener( 'mousemove', onMouseMove, false );
		document.removeEventListener( 'mouseup', onMouseUp, false );
		document.removeEventListener( 'mouseout', onMouseOut, false );
	}

	function onMouseOut ( event ) {
		document.removeEventListener( 'mousemove', onMouseMove, false );
		document.removeEventListener( 'mouseup', onMouseUp, false );
		document.removeEventListener( 'mouseout', onMouseOut, false );
	}

	function onTouchStart ( event ) {
		if ( event.touches.length == 1 ) {
			event.preventDefault();

			scene3D.mouseXOnMouseDown = event.touches[ 0 ].pageX - scene3D.windowHalfX;
			scene3D.targetRotationOnMouseDownX = scene3D.targetRotationX;

			scene3D.mouseYOnMouseDown = event.touches[ 0 ].pageY - scene3D.windowHalfY;
			scene3D.targetRotationOnMouseDownY = scene3D.targetRotationY;
		}
	}

	function onTouchMove ( event ) {
		if ( event.touches.length == 1 ) {
			event.preventDefault();

			scene3D.mouseX = event.touches[ 0 ].pageX - scene3D.windowHalfX;
			scene3D.targetRotationX = scene3D.targetRotationOnMouseDownX + ( scene3D.mouseX - scene3D.mouseXOnMouseDown ) * 0.05;

			scene3D.mouseY = event.touches[ 0 ].pageY - scene3D.windowHalfY;
			scene3D.targetRotationY = scene3D.targetRotationOnMouseDownY + ( scene3D.mouseY - scene3D.mouseYOnMouseDown ) * 0.05;
		}
	}

	function onMouseDragEnter () {}

	function onMouseDragOver ( event ) {
		event.stopPropagation();
		event.preventDefault();
		event.dataTransfer.dropEffect = 'copy';
	}

	function onMouseDragLeave () {}

	function onMouseDrop ( event ) {
		event.stopPropagation();
		event.preventDefault();

		var file = event.dataTransfer.files[0];
		this.fileName = file.name;

		$("#beatsid-music span").text("Playing " + this.fileName);
		$("#beatsid-music i").removeClass('fa-play').addClass('fa-pause');

		var fileReader = new FileReader();
		fileReader.onload = function (event) {
			fileResult = event.target.result;
			scene3D.startAudio(fileResult);
		};
		fileReader.onerror = function (event) {
			debugger
		};
		fileReader.readAsArrayBuffer(file);
	}

	function animate () {
		scene3D.beats_headphone.rotation.x += ( scene3D.targetRotationY - scene3D.beats_headphone.rotation.x ) * 0.1;
		scene3D.beats_headphone.rotation.y += ( scene3D.targetRotationX - scene3D.beats_headphone.rotation.y ) * 0.1;
		scene3D.renderer.render(scene3D.scene, scene3D.camera);
		requestAnimationFrame(animate);
	}

</script>
<?= $this->Html->script('webgl/three.min.js') ?>
<?= $this->Html->script('webgl/OrbitControls.js') ?>
<?= $this->Html->script('webgl/MTLLoader.js') ?>
<?= $this->Html->script('webgl/OBJMTLLoader.js') ?>
<?= $this->Html->script('webgl/Detector.js') ?>
<?= $this->Html->script('webgl/stats.min.js') ?>
<?= $this->Html->script('webgl/Projector.js') ?>

<?php
	$parts = array(
		array(
			"name" => "Hoop",
			"simple" => "hoop",
			"models" => array(
				array(
					"name" => "Normal",
					"obj" => "hoop_normal.json"
				),
				array(
					"name" => "Cat version",
					"obj" => "hoop_cat.json"
				)
			),
			"colors" => array(
				array("name" => "Black","hex" => "#222222"),
				array("name" => "White","hex" => "#ffffff"),
				array("name" => "Red","hex" => "#ff5555"),
				array("name" => "Purple","hex" => "#8646aa"),
				array("name" => "Green","hex" => "#44f484"),
				array("name" => "Orange","hex" => "#ffaa44")
			)
		),
		array(
			"name" => "Ear Pieces",
			"simple" => "ear_pieces",
			"models" => array(),
			"colors" => array(
				array("name" => "Black","hex" => "#222222"),
				array("name" => "White","hex" => "#ffffff"),
				array("name" => "Red","hex" => "#ff5555"),
				array("name" => "Purple","hex" => "#8646aa"),
				array("name" => "Green","hex" => "#44f484"),
				array("name" => "Orange","hex" => "#ffaa44")
			)
		),
		array(
			"name" => "Ear Cushions",
			"simple" => "ear_cushions",
			"models" => array(),
			"colors" => array(
				array("name" => "Black","hex" => "#222222"),
				array("name" => "White","hex" => "#ffffff"),
				array("name" => "Red","hex" => "#ff5555"),
				array("name" => "Purple","hex" => "#8646aa"),
				array("name" => "Green","hex" => "#44f484"),
				array("name" => "Orange","hex" => "#ffaa44")
			)
		),
		array(
			"name" => "Metal parts",
			"simple" => "metal",
			"models" => array(),
			"colors" => array(
				array("name" => "Black","hex" => "#222222"),
				array("name" => "White","hex" => "#ffffff"),
				array("name" => "Red","hex" => "#ff5555"),
				array("name" => "Purple","hex" => "#8646aa"),
				array("name" => "Green","hex" => "#44f484"),
				array("name" => "Orange","hex" => "#ffaa44")
			)
		),
		array(
			"name" => "Foam Hoop",
			"simple" => "foam",
			"models" => array(),
			"colors" => array(
				array("name" => "Black","hex" => "#222222"),
				array("name" => "White","hex" => "#ffffff"),
				array("name" => "Red","hex" => "#ff5555"),
				array("name" => "Purple","hex" => "#8646aa"),
				array("name" => "Green","hex" => "#44f484"),
				array("name" => "Orange","hex" => "#ffaa44")
			)
		),
		array(
			"name" => "Beats Outline",
			"simple" => "beats_outline",
			"models" => array(),
			"colors" => array(
				array("name" => "Black","hex" => "#222222"),
				array("name" => "White","hex" => "#ffffff"),
				array("name" => "Red","hex" => "#ff5555"),
				array("name" => "Purple","hex" => "#8646aa"),
				array("name" => "Green","hex" => "#44f484"),
				array("name" => "Orange","hex" => "#ffaa44")
			)
		),
		array(
			"name" => "Beats Shape",
			"simple" => "beats_shape",
			"models" => array(),
			"colors" => array(
				array("name" => "Black","hex" => "#222222"),
				array("name" => "White","hex" => "#ffffff"),
				array("name" => "Red","hex" => "#ff5555"),
				array("name" => "Purple","hex" => "#8646aa"),
				array("name" => "Green","hex" => "#44f484"),
				array("name" => "Orange","hex" => "#ffaa44")
			)
		),
		array(
			"name" => "Beats B",
			"simple" => "beats_b",
			"models" => array(),
			"colors" => array(
				array("name" => "Black","hex" => "#222222"),
				array("name" => "White","hex" => "#ffffff"),
				array("name" => "Red","hex" => "#ff5555"),
				array("name" => "Purple","hex" => "#8646aa"),
				array("name" => "Green","hex" => "#44f484"),
				array("name" => "Orange","hex" => "#ffaa44")
			)
		)
	);
?>

<section id="beatsid">

	<div id="beatsid-header"></div>

	<div id="beatsid-preview" class="">
		<canvas id="canvas"></canvas>
	</div>

	<div id="beatsid-panel--button"></div>
	<div id="beatsid-panel" class="active">
		<script>
			jQuery(function() {
				$(document).on('click', "#beatsid-panel--button", function() {
					if ( $("#beatsid-panel").hasClass('active') ) {
						$("#beatsid-panel").removeClass('active');
						$("#beatsid-preview").addClass('active');
					} else {
						$("#beatsid-panel").addClass('active');
						$("#beatsid-preview").removeClass('active');
					}
				});
			});
		</script>

		<div id="beatsid-panel--inner" class="">
			<div id="beatsid-parts">
				<div class="beatsid-paneltitle">
					<h2>Headphone parts</h2>
				</div>

				<?php foreach( $parts as $part ): ?>
					<div class="beatsid-part" id="beatsid-part-<?= $part['simple']; ?>" data-simple="<?= $part['simple']; ?>">

						<div class="beatsid-part--icon" style="background-color: #ffffff;"></div>
						<div class="beatsid-part--content"><span><?= $part['name']; ?></span></div>
						<div class="beatsid-part--arrow"><i class="fa fa-arrow-right"></i></div>

					</div>
				<?php endforeach; ?>
				<div id="beatsid-panel--save">
					<button>Save my Beats</button>
				</div>
			</div>
			<div id="beatsid-colorsm">

				<div id="beatsid-colorsm--close"></div>
				<div class="beatsid-paneltitle">
					<h2><?= $part['name']; ?></h2>
					<h2>Color selection</h2>
				</div>
				<hr />
				<?php foreach( $parts as $part ): ?>
					<div class="beatsid-colors" id="beatsid-colors-<?= $part['simple']; ?>">
						<?php foreach( $part['colors'] as $color ): ?>
							<div class="beatsid-color" style="background-color: <?= $color['hex']; ?>;"
								onclick="changeColor('<?= $part['simple']; ?>', '<?= $color['hex']; ?>');"></div>
						<?php endforeach; ?>
					</div>
				<?php endforeach; ?>

				<div class="beatsid-paneltitle">
					<h2>Model selection</h2>
				</div>
				<hr />
				<?php foreach( $parts as $part ): ?>
					<div class="beatsid-models" id="beatsid-models-<?= $part['simple']; ?>">
						<?php foreach( $part['models'] as $model ): ?>
							<div class="beatsid-model" style="background-model: <?= $model['obj']; ?>;"
								onclick="changeModel('<?= $part['simple']; ?>', '<?= $model['obj']; ?>');"><?= $model['name']; ?></div>
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

	<div id="beatsid-save--popup">
		<div id="beatsid-save--popup-mask"></div>
		<div id="beatsid-save--popup-inner">
			<div id="userform">
				<h2>Save and Share your custom Beats Studio Wireless !</h2>
				<?php echo $this->Form->create(null, ['id'=>'beatsid-submit']); ?>
					<hr />
					<?php
						foreach( $parts as $part ) {
							echo $this->Form->input($part['simple'], ['label' => false, 'required'=>'required', 'type'=>'hidden', 'value'=>'#ffffff']);
						}
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
			$(document).on('click', "#beatsid-panel--save button", function() {
				$(".beatsid-part").each(function() {
					var color = giveHexColor( $(this).children(".beatsid-part--icon").css("background-color") );
					$("#beatsid-submit input[name="+$(this).data("simple")+"]").val( color );
				});
				$("#beatsid-save--popup").addClass("active");
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

		var jsonj = [
			{"name":"hoop", "obj":"hoop_normal.json", "color":"#ffffff"},
			{"name":"ear_pieces", "obj":"ear_pieces_normal.json", "color":"#ffffff"},
			{"name":"ear_cushions", "obj":"ear_cushions_normal.json", "color":"#ffffff"},
			{"name":"metal", "obj":"metal_normal.json", "color":"#ffffff"},
			{"name":"foam", "obj":"foam_normal.json", "color":"#ffffff"},
			{"name":"beats_outline", "obj":"beats_outline_normal.json", "color":"#ffffff"},
			{"name":"beats_shape", "obj":"beats_shape_normal.json", "color":"#ffffff"},
			{"name":"beats_b", "obj":"beats_b_normal.json", "color":"#ffffff"}
		];
		var numberOfBars = 40;
		var barsLeft = new Array();
		var barsRight = new Array();

		var scene, camera, renderer;
		var raycaster = new THREE.Raycaster();
		var mouse = new THREE.Vector2();

		var beats_headphone;

		var targetRotationX = 0;
		var targetRotationOnMouseDownX = 0;

		var targetRotationY = 0;
		var targetRotationOnMouseDownY = 0;

		var mouseX = 0;
		var mouseXOnMouseDown = 0;

		var mouseY = 0;
		var mouseYOnMouseDown = 0;

		var windowX = window.innerWidth;
		var windowY = window.innerHeight;

		var canvasX = document.getElementById("beatsid-preview").offsetWidth;
		var canvasY = document.getElementById("beatsid-preview").offsetHeight;

		var windowHalfX = window.innerWidth / 2;
		var windowHalfY = window.innerHeight / 2;

		var projector = new THREE.Projector(), 
			mouse_vector = new THREE.Vector3(),
			mouse = { x: 0, y: 0, z: 1 },
			ray = new THREE.Raycaster( new THREE.Vector3(0,0,0), new THREE.Vector3(0,0,0) ),
			intersects = [];

		var rtime;
		var timeout = false;
		var delta = 200;

		initialize();
		animate();

		function initialize() {
			scene = new THREE.Scene();

			renderer = new THREE.WebGLRenderer({antialias:true, alpha:true, canvas:document.getElementById("canvas")});
			renderer.setSize(canvasX, canvasY);
			//document.getElementById("beatsid-preview").appendChild(renderer.domElement);

			camera = new THREE.PerspectiveCamera(45, canvasX / canvasY, 0.1, 10000);
			camera.position.set( 0, 0, 60 );
			scene.add(camera);

			beats_headphone = new THREE.Group();
			beats_headphone.position.x = 0;
			beats_headphone.position.y = 0;
			beats_headphone.position.z = 0;
			scene.add( beats_headphone );

			// LIGHTS

			hemiLight = new THREE.HemisphereLight( 0xffffff, 0xffffff, 0.6 );
			hemiLight.color.setHSL( 0.6, 1, 0.6 );
			hemiLight.groundColor.setHSL( 0.095, 1, 0.75 );
			hemiLight.position.set( 0, 500, 0 );
			scene.add( hemiLight );

			//

			dirLight = new THREE.DirectionalLight( 0xffffff, 1 );
			dirLight.color.setHSL( 0.1, 1, 0.95 );
			dirLight.position.set( -1, 1.75, 1 );
			dirLight.position.multiplyScalar( 50 );
			scene.add( dirLight );

			dirLight.castShadow = true;

			dirLight.shadowMapWidth = 2048;
			dirLight.shadowMapHeight = 2048;

			var d = 50;

			dirLight.shadowCameraLeft = -d;
			dirLight.shadowCameraRight = d;
			dirLight.shadowCameraTop = d;
			dirLight.shadowCameraBottom = -d;

			dirLight.shadowCameraFar = 3500;
			dirLight.shadowBias = -0.0001;
			dirLight.shadowDarkness = 0.35;
			dirLight.shadowCameraVisible = true;

			addObjectToHeadphone2(jsonj[0].name, jsonj[0].obj, 200, jsonj[0].color);
			addObjectToHeadphone2(jsonj[1].name, jsonj[1].obj, 200, jsonj[1].color);
			addObjectToHeadphone2(jsonj[2].name, jsonj[2].obj, 20, jsonj[2].color);
			addObjectToHeadphone2(jsonj[3].name, jsonj[3].obj, 300, jsonj[3].color);
			addObjectToHeadphone2(jsonj[4].name, jsonj[4].obj, 20, jsonj[4].color);
			addObjectToHeadphone2(jsonj[5].name, jsonj[5].obj, 20, jsonj[5].color);
			addObjectToHeadphone2(jsonj[6].name, jsonj[6].obj, 100, jsonj[6].color);
			addObjectToHeadphone2(jsonj[7].name, jsonj[7].obj, 200, jsonj[7].color);

			document.getElementById("canvas").addEventListener( 'mousedown', onDocumentMouseDown, false );
			document.getElementById("canvas").addEventListener( 'touchstart', onDocumentTouchStart, false );
			document.getElementById("canvas").addEventListener( 'touchmove', onDocumentTouchMove, false );

			document.body.addEventListener("dragenter", function () {
			}, false);
			document.body.addEventListener("dragover", function (event) {
				event.stopPropagation();
				event.preventDefault();
				event.dataTransfer.dropEffect = 'copy';
			}, false);
			document.body.addEventListener("dragleave", function () {
			}, false);
			document.getElementById("canvas").addEventListener("drop", function (event) {
				event.stopPropagation();
				event.preventDefault();

				var file = event.dataTransfer.files[0];
				var fileName = file.name;

				var fileReader = new FileReader();
				fileReader.onload = function (event) {
					var fileResult = event.target.result;
					startAudio(fileResult);
				};
				fileReader.onerror = function (event) {
					debugger
				};
			   
				fileReader.readAsArrayBuffer(file);
			}, false);

			createBars();
			setupAudioProcessing();
			getAudio();

			window.addEventListener( 'resize', onWindowResize, false );
		}

		function createBars() {
			for (var i = 0; i < numberOfBars; i++) {

				var barGeometry = new THREE.BoxGeometry(0.1, 0.1, 0.1);

				var material = new THREE.MeshPhongMaterial({
					color: "#222222",
					ambient: 0x808080,
					specular: 0xffffff
				});

				barsLeft[i] = new THREE.Mesh(barGeometry, material);
				barsLeft[i].position.set(numberOfBars - i - numberOfBars, 0, -20);

				scene.add(barsLeft[i]);
			}
			for (var i = 0; i < numberOfBars; i++) {

				var barGeometry = new THREE.BoxGeometry(0.1, 0.1, 0.1);

				var material = new THREE.MeshPhongMaterial({
					color: "#222222",
					ambient: 0x808080,
					specular: 0xffffff
				});

				barsRight[i] = new THREE.Mesh(barGeometry, material);
				barsRight[i].position.set(i, 0, -20);

				scene.add(barsRight[i]);
			}
		}

		function setupAudioProcessing() {
			audioContext = new AudioContext();

			javascriptNode = audioContext.createScriptProcessor(2048, 1, 1);
			javascriptNode.connect(audioContext.destination);

			sourceBuffer = audioContext.createBufferSource();

			analyser = audioContext.createAnalyser();
			analyser.smoothingTimeConstant = 0.3;
			analyser.fftSize = 512;

			sourceBuffer.connect(analyser);
			analyser.connect(javascriptNode);
			sourceBuffer.connect(audioContext.destination);

			javascriptNode.onaudioprocess = function () {
				var array = new Uint8Array(analyser.frequencyBinCount);
				analyser.getByteFrequencyData(array);

				var step = Math.round(array.length / numberOfBars);
				for (var i = numberOfBars-1; i >= 0; i--) {
					var value = array[i * step] / 8;
					value = value < 1 ? 1 : value;
					barsLeft[i].scale.y = value*4;
				}
				for (var i = 0; i < numberOfBars; i++) {
					var value = array[i * step] / 8;
					value = value < 1 ? 1 : value;
					barsRight[i].scale.y = value*4;
				}
			}
		}

		function getAudio() {
			var request = new XMLHttpRequest();
			request.open("GET", "Asset/Aathi-StarMusiQ.Com.mp3", true);
			request.responseType = "arraybuffer";
			request.send();
			request.onload = function () {
				//that.start(request.response);
			}
		}

		function startAudio(buffer) {
			audioContext.decodeAudioData(buffer, decodeAudioDataSuccess, decodeAudioDataFailed);
			function decodeAudioDataSuccess(decodedBuffer) {
				sourceBuffer.buffer = decodedBuffer
				sourceBuffer.start(0);
			}
			function decodeAudioDataFailed() {
				debugger
			}
		};

		function addObjectToHeadphone2(obj_name, obj_json, obj_shininess, obj_color) {
			var loader = new THREE.JSONLoader();

			loader.load( '<?php echo $this->request->webroot."obj/"; ?>'+obj_json, function( geometry ) {
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
				beats_headphone.add( object );
			});
		}

		function removebeats_headphoneEntity(object) {
			var selectedObject = scene.getObjectByName( object );
			beats_headphone.remove( selectedObject );
		}

		function changeModel(obj_simple, obj_name) {
			save_color = scene.getObjectByName( obj_simple ).material.color.getHex();
			removebeats_headphoneEntity(obj_simple);
			var loader = new THREE.JSONLoader();

			loader.load( '<?php echo $this->request->webroot."obj/"; ?>'+obj_name, function( geometry ) {
				object = new THREE.Mesh( geometry,
					new THREE.MeshPhongMaterial({
						color: save_color,
						specular: 0x050505,
						shininess: 100
					})
				);
				object.name = obj_simple;
				object.scale.set(2.5,2.5,2.5);
				object.position.set(0,0,0);
				beats_headphone.add( object );
			});
		}
		function changeColor(obj_simple, obj_color) {
			scene.getObjectByName( obj_simple ).material.color.set( obj_color );
			var target = "#beatsid-part-"+obj_simple+" .beatsid-part--icon";
			$(target).attr("style", "background-color:"+obj_color+";");
		}

		function onWindowResize() {
			rtime = new Date();
			if (timeout === false) {
				timeout = true;
				setTimeout(onWindowResizeEnd, delta);
			}
		}

		function onWindowResizeEnd() {
			if (new Date() - rtime < delta) {
				setTimeout(onWindowResizeEnd, delta);
			} else {
				timeout = false;
				var canvasX = document.getElementById("beatsid-preview").offsetWidth;
				var canvasY = document.getElementById("beatsid-preview").offsetHeight;

				camera.aspect = canvasX / canvasY;
				camera.updateProjectionMatrix();

				renderer.setSize(canvasX, canvasY);
			}
		}

			//

		function onDocumentMouseDown( event ) {

			event.preventDefault();

			document.addEventListener( 'mousemove', onDocumentMouseMove, false );
			document.addEventListener( 'mouseup', onDocumentMouseUp, false );
			document.addEventListener( 'mouseout', onDocumentMouseOut, false );

			mouseXOnMouseDown = event.clientX - windowHalfX;
			targetRotationOnMouseDownX = targetRotationX;

			mouseYOnMouseDown = event.clientY - windowHalfY;
			targetRotationOnMouseDownY = targetRotationY;



			mouse.x = ( ( event.clientX - renderer.domElement.offsetLeft ) / renderer.domElement.width ) * 2 - 1;
			mouse.y = - ( ( event.clientY - renderer.domElement.offsetTop ) / renderer.domElement.height ) * 2 + 1;
			mouse_vector.set( mouse.x, mouse.y, mouse.z );

			projector.unprojectVector( mouse_vector, camera );
			var direction = mouse_vector.sub( camera.position ).normalize();

			ray.set( camera.position, direction );
			intersects = ray.intersectObject( beats_headphone, true );

			if( intersects.length ) {
				var target = "#beatsid-colors-"+intersects[0].object.name;
				$(".beatsid-colors").removeClass("visible");
				$(target).addClass("visible");
				$("#beatsid-panel--inner").addClass('color');
			}
		}

		function onDocumentMouseMove( event ) {

			mouseX = event.clientX - windowHalfX;
			mouseY = event.clientY - windowHalfY;

			targetRotationX = targetRotationOnMouseDownX + (mouseX - mouseXOnMouseDown) * 0.02;
			targetRotationY = targetRotationOnMouseDownY + (mouseY - mouseYOnMouseDown) * 0.02;
		}

		function onDocumentMouseUp( event ) {

			document.removeEventListener( 'mousemove', onDocumentMouseMove, false );
			document.removeEventListener( 'mouseup', onDocumentMouseUp, false );
			document.removeEventListener( 'mouseout', onDocumentMouseOut, false );
		}

		function onDocumentMouseOut( event ) {

			document.removeEventListener( 'mousemove', onDocumentMouseMove, false );
			document.removeEventListener( 'mouseup', onDocumentMouseUp, false );
			document.removeEventListener( 'mouseout', onDocumentMouseOut, false );
		}

		function onDocumentTouchStart( event ) {

			if ( event.touches.length == 1 ) {

				event.preventDefault();

				mouseXOnMouseDown = event.touches[ 0 ].pageX - windowHalfX;
				targetRotationOnMouseDownX = targetRotationX;
				
				mouseYOnMouseDown = event.touches[ 0 ].pageY - windowHalfY;
				targetRotationOnMouseDownY = targetRotationY;

			}
		}

		function onDocumentTouchMove( event ) {

			if ( event.touches.length == 1 ) {

				event.preventDefault();

				mouseX = event.touches[ 0 ].pageX - windowHalfX;
				targetRotationX = targetRotationOnMouseDownX + ( mouseX - mouseXOnMouseDown ) * 0.05;

				mouseY = event.touches[ 0 ].pageY - windowHalfY;
				targetRotationY = targetRotationOnMouseDownY + (mouseY - mouseYOnMouseDown) * 0.05;

			}
		}

		function animate() {
			requestAnimationFrame(animate);
			beats_headphone.rotation.x += ( targetRotationY - beats_headphone.rotation.x ) * 0.1;
			beats_headphone.rotation.y += ( targetRotationX - beats_headphone.rotation.y ) * 0.1;
			renderer.render(scene, camera);
		}

	</script>
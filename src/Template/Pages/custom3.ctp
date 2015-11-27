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

</div>

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
			{"name":"hoop", "color":"#ff00ff"},
			{"name":"ear_pieces", "color":"#ff2233"},
			{"name":"ear_cushions", "color":"#ffff44"}
		];

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

		animate();

		$(document).ready(function () {
			beatsByDre = new BeatsByDre();
			beatsByDre.initialize();
		}

		function BeatsByDre() {
			this.scene;
			this.camera;
			this.renderer;
			this.controls;
		}

		BeatsByDre.prototype.initialize = function () {
			this.scene = new THREE.Scene();

			this.renderer = new THREE.WebGLRenderer({antialias:true, alpha:true, canvas:document.getElementById("canvas")});
			this.renderer.setSize(canvasX, canvasY);
			//document.getElementById("beatsid-preview").appendChild(renderer.domElement);

			this.camera = new THREE.PerspectiveCamera(45, canvasX / canvasY, 0.1, 10000);
			this.camera.position.set( 0, 0, 60 );
			this.scene.add(camera);

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

			addObjectToHeadphone2(jsonj[0].name, jsonj[0].name+"_normal.json", 200, jsonj[0].color);
			addObjectToHeadphone2(jsonj[1].name, jsonj[1].name+"_normal.json", 200, jsonj[1].color);
			addObjectToHeadphone2(jsonj[2].name, jsonj[2].name+"_normal.json", 20, jsonj[2].color);
			addObjectToHeadphone2("metal", "metal_normal.json", 300, "#dddddd");
			addObjectToHeadphone2("foam", "foam_normal.json", 20, "#dddddd");
			addObjectToHeadphone2("beats_outline", "beats_outline_normal.json", 20, "#dddddd");
			addObjectToHeadphone2("beats_shape", "beats_shape_normal.json", 100, "#dddddd");
			addObjectToHeadphone2("beats_b", "beats_b_normal.json", 200, "#dddddd");

			document.getElementById("canvas").addEventListener( 'mousedown', onDocumentMouseDown, false );
			document.getElementById("canvas").addEventListener( 'touchstart', onDocumentTouchStart, false );
			document.getElementById("canvas").addEventListener( 'touchmove', onDocumentTouchMove, false );

			window.addEventListener( 'resize', onWindowResize, false );
		}

		function addObjectToHeadphone2 (obj_name, obj_json, obj_shininess, obj_color) {
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
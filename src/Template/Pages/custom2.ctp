<?= $this->Html->script('webgl/three.min.js') ?>
<?= $this->Html->script('webgl/OrbitControls.js') ?>
<?= $this->Html->script('webgl/MTLLoader.js') ?>
<?= $this->Html->script('webgl/OBJMTLLoader.js') ?>
<?= $this->Html->script('webgl/Detector.js') ?>
<?= $this->Html->script('webgl/stats.min.js') ?>

<?php
	$parts = array(
		"part1" => array(
			"name" => "Arseau",
			"icon" => "Icone image name",
			"obj_name" => "beats1",
			"colors" => array(
				"color1" => array(
					"name" => "Couleur Rouge",
					"mtl_name" => "beats1-red",
					"code" => "#ff0000"
				),
				"color2" => array(
					"name" => "Couleur Violette",
					"mtl_name" => "beats1-purple",
					"code" => "#ff00ff"
				)
			)
		),
		"part2" => array(
			"name" => "Enceintes",
			"icon" => "Icone image name",
			"obj_name" => "beats2",
			"colors" => array(
				"color1" => array(
					"name" => "Couleur Neige",
					"mtl_name" => "kuni",
					"code" => "#ff0000"
				)
			)
		),
		"part3" => array(
			"name" => "Logo",
			"icon" => "Icone image name",
			"obj_name" => "beats3",
			"colors" => array(
				"color1" => array(
					"name" => "Couleur Neige",
					"mtl_name" => "kuni",
					"code" => "#ff0000"
				)
			)
		)
	);
?>
	
<section id="beatsid">

	<div id="beatsid-preview"></div>

	<div id="beatsid-holder" onclick=""></div>

	<div id="beatsid-panel">

		<div id="beatsid-paneltitle">
			<h2>Choix des couleurs</h2>
		</div>

		<?php $index = 0; ?>
		<?php foreach( $parts as $part ): ?>
			<?php ++$index; ?>

			<div id="beatsid-panelbox-<?php echo $index; ?>" class="beatsid-panelbox">
				<div class="beatsid-panelbox--inner">
					<img src="<?php echo $this->request->webroot.'img/ui/headphone.png'; ?>" />
					<h3><?php echo $part["name"]; ?></h3>
				</div>

				<div id="beatsid-panelchoice-<?php echo $index; ?>" class="beatsid-panelchoice">
					<div class="beatsid-panelchoice--arrow"></div>
					<?php foreach( $part["colors"] as $color ): ?>

						<div class="beatsid-panelchoice--color">
							<div class="beatsid-panelchoice--color-inner"
								style="background-color: <?= $color['code'] ?>"
								title="<?= $color['name'] ?>"
								onclick="switchObject('<?= $part['obj_name'] ?>','<?= $color['mtl_name'] ?>')"
								data-object=""></div>
						</div>

					<?php endforeach; ?>
				</div>
			</div>

		<?php endforeach; ?>

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

		var scene, camera, renderer;

		var beats_headphone;

		var targetRotationX = 0;
		var targetRotationOnMouseDownX = 0;

		var targetRotationY = 0;
		var targetRotationOnMouseDownY = 0;

		var mouseX = 0;
		var mouseXOnMouseDown = 0;

		var windowHalfX = window.innerWidth / 2;
		var windowHalfY = window.innerHeight / 2;

		init();
		animate();

		function init() {

			scene = new THREE.Scene();
			var WIDTH = window.innerWidth,
				HEIGHT = window.innerHeight;

			renderer = new THREE.WebGLRenderer({antialias:true,alpha: true});
			renderer.setSize(WIDTH, HEIGHT);
			document.getElementById("beatsid-preview").appendChild(renderer.domElement);

			camera = new THREE.PerspectiveCamera(45, WIDTH / HEIGHT, 0.1, 10000);
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

			/*addObjectToHeadphone("beats1", "beats1-black");
			addObjectToHeadphone("beats2", "beats2-black");
			addObjectToHeadphone("beats3", "beats3-black");*/

			addObjectToHeadphone2("beats1");

			document.addEventListener( 'mousedown', onDocumentMouseDown, false );
			document.addEventListener( 'touchstart', onDocumentTouchStart, false );
			document.addEventListener( 'touchmove', onDocumentTouchMove, false );
			//
			window.addEventListener( 'resize', onWindowResize, false );

		}

		function addObjectToHeadphone (obj_name, mtl_name) {
			var loader = new THREE.OBJMTLLoader();
			loader.load( '<?php echo $this->request->webroot."obj/"; ?>'+obj_name+'.obj', '<?php echo $this->request->webroot."obj/"; ?>'+mtl_name+'.mtl', function ( object ) {
					object.position.y = 0;
					object.scale.x = 3;
					object.scale.y = 3;
					object.scale.z = 3;
					object.name = obj_name;
					beats_headphone.add( object );
			});
		}

		function addObjectToHeadphone2 (obj_name) {
			var loader = new THREE.JSONLoader();

			loader.load( '<?php echo $this->request->webroot."obj/"; ?>'+obj_name+'.json', function( geometry ) {
				object = new THREE.Mesh( geometry,
					new THREE.MeshPhongMaterial({ 
						color: 0x996633, 
						specular: 0x050505,
						shininess: 100
					})
				);
				object.scale.set(3,3,3);
				object.position.set(0,-10,0);
				beats_headphone.add( object );
			});
		}

		function removebeats_headphoneEntity(object) {
			var selectedObject = scene.getObjectByName( object );
			beats_headphone.remove( selectedObject );
		}

		function switchObject(obj_name, mtl_name) {
			removebeats_headphoneEntity(obj_name);
			addObjectToHeadphone (obj_name, mtl_name);
		}

		function onWindowResize() {

			windowHalfX = window.innerWidth / 2;
			windowHalfY = window.innerHeight / 2;

			camera.aspect = window.innerWidth / window.innerHeight;
			camera.updateProjectionMatrix();

			renderer.setSize( window.innerWidth, window.innerHeight );

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
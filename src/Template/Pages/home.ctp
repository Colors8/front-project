<?= $this->Html->script('webgl/three.min.js') ?>

<section id="home">
	<canvas id="home-canvas"></canvas>

	<header id="home-header">
		<div id="home-header--logo">
			<a href="<?php echo $this->Url->build(["controller" => "Pages", "action" => "prehome"]); ?>">
				<img src="<?php echo $this->request->webroot.'img/ui/logo-white.png' ?>" />
			</a>
		</div>
		<div id="home-header--title">
			<h1>studio wireless</h1>
		</div>
		<div id="home-header--title2">
			<h2>Beats <span>ID</span></h2>
		</div>
	</header>

	<div id="home-headphone">
		<div id="home-headphone--inner">

			<a href="<?php echo $this->Url->build(["controller" => "Beats", "action" => "add"]); ?>">
				<div class="home-chip dark" style="top:36%; left:78%;">
					<div class="home-chip--cicrle0"></div>
					<div class="home-chip--cicrle1"></div>
					<div class="home-chip--cicrle2"></div>
					<svg class="svg" style="top: -115px;" height="150px" width="200px">
						<line class="line" x1="17px" y1="133px" x2="200px" y2="40px" style="stroke-width:2" />
					</svg>
					<div class="home-chip--content right" style="top: -115px;left: 200px">
						<h2>Expérience 3D <span>360°</span></h2>
						<i>Découvrez et personnalisez votre Beats studio wireless</i>
					</div>
				</div>
			</a>

			<a href="<?php echo $this->Url->build(["controller" => "Beats", "action" => "index"]); ?>">
				<div class="home-chip dark" style="top:72%; left:65%;">
					<div class="home-chip--cicrle0"></div>
					<div class="home-chip--cicrle1"></div>
					<div class="home-chip--cicrle2"></div>
					<svg class="svg" style="top: 0px;" height="150px" width="200px">
						<line class="line" x1="17px" y1="17px" x2="200px" y2="75px" style="stroke-width:2" />
					</svg>
					<div class="home-chip--content right" style="top: 60px;left: 200px">
						<h2>Partage ta <span>passion Beats</span></h2>
						<i>Découvrez et personnalisez votre Beats studio wireless</i>
					</div>
				</div>
			</a>

			<a href="<?php echo $this->Url->build(["controller" => "Pages", "action" => "spec"]); ?>">
				<div class="home-chip" style="top:20%; left:32%;">
					<div class="home-chip--cicrle0"></div>
					<div class="home-chip--cicrle1"></div>
					<div class="home-chip--cicrle2"></div>
					<svg class="svg" style="top: -115px;left: -165px;" height="150px" width="200px">
						<line class="line" x1="183px" y1="133px" x2="0px" y2="120px" style="stroke-width:2" />
					</svg>
					<div class="home-chip--content left" style="top: -30px;right: 200px">
						<h2>Ses <span>caractéristiques</span></h2>
						<i>Découvrez et personnalisez votre Beats studio wireless</i>
					</div>
				</div>
			</a>

			<a href="<?php echo $this->Url->build(["controller" => "Pages", "action" => "video"]); ?>">
				<div class="home-chip" style="top:75%; left:28%;">
					<div class="home-chip--cicrle0"></div>
					<div class="home-chip--cicrle1"></div>
					<div class="home-chip--cicrle2"></div>
					<svg class="svg" style="top: 0px;left: -165px;" height="150px" width="200px">
						<line class="line" x1="183px" y1="18px" x2="0px" y2="50px" style="stroke-width:2" />
					</svg>
					<div class="home-chip--content left" style="top: 20px;right: 200px">
						<h2>Le casque <span>en action</span></h2>
						<i>Découvrez et personnalisez votre Beats studio wireless</i>
					</div>
				</div>
			</a>

		</div>
	</div>

	<footer id="home-footer">
		<div id="home-footer--content">
			<a href="<?php echo $this->Url->build(["controller" => "Pages", "action" => "about"]); ?>">About us</a>
		</div>
	</footer>

</section>

<script>
	jQuery(function() {
		$(window).resize(function() {
			var height = $("home-headphone--inner").height();
			$('home-headphone--inner').css({'width':height+'px'});
		});
	});
</script>

<script>

	var scene3D;
	$(document).ready(function () {
		scene3D = new Scene3D();

		scene3D.initialize();
		animate();
	});

	var Scene3D = function() {
		// Scene Three.js
		this.scene;
		this.camera;
		this.renderer;

		// JSON Loader
		this.loader = new THREE.JSONLoader();

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
		this.canvasX = document.getElementById("home-canvas").offsetWidth;
		this.canvasY = document.getElementById("home-canvas").offsetHeight;
	}

	Scene3D.prototype.initialize = function () {
		// Create scene
		this.scene = new THREE.Scene();

		// Initialize renderer
		this.renderer = new THREE.WebGLRenderer({ antialias:true, alpha:true, canvas:document.getElementById("home-canvas"), preserveDrawingBuffer:true });
		this.renderer.setSize( this.canvasX, this.canvasY );

		// Create camera
		this.camera = new THREE.PerspectiveCamera(45, this.canvasX / this.canvasY, 0.1, 10000);
		this.camera.position.set( 0, 0, 60 );
		this.scene.add( this.camera );

		// Headphone Group
		this.balls = new THREE.Group();
		this.balls.position.x = 0;
		this.balls.position.y = 0;
		this.balls.position.z = 0;
		this.scene.add( this.balls );

		// Ambient Light
		this.ambientLight = new THREE.AmbientLight( 0x444444 ); // soft white light
		this.scene.add( this.ambientLight );

		// Hemisphere Light
		this.hemiLight = new THREE.HemisphereLight( 0xffffff, 0xffffff, 0.6 );
		this.hemiLight.color.setHSL( 0.6, 1, 0.6 );
		this.hemiLight.groundColor.setHSL( 1, 1, 1 );
		this.hemiLight.position.set( 0, 500, 0 );
		this.scene.add( this.hemiLight );

		// Directional Light
		this.dirLight = new THREE.DirectionalLight( 0xffffff, 1 );
		this.dirLight.color.setHSL( 0.1, 1, 0.95 );
		this.dirLight.position.set( -1, 1.75, 1 );
		this.dirLight.position.multiplyScalar( 50 );
		this.scene.add( this.dirLight );

		var that = this;
		for (var i = 0; i < 20; i++) {
			this.loader.load( '<?php echo $this->request->webroot."obj/"; ?>'+"ball1.json", function( geometry ) {
				object = new THREE.Mesh( geometry,
					new THREE.MeshPhongMaterial({
						color: "#ffffff",
						specular: 0xffffff,
						shininess: 1
					})
				);
				object.name = "ball";
				object.scale.set(2.5,2.5,2.5);
				object.position.set(getRandom(), getRandom(), getRandom());
				object.rotation.set(getRandom(), getRandom(), getRandom());
				that.balls.add( object );
			});
		}

		// Event listeners
		canvas = document.getElementById("canvas");
		window.addEventListener( 'resize', onWindowResize, false );
	}

	function getRandom() {
		return Math.floor((Math.random() * -100) + 50);
	}

	function onWindowResize () {
		scene3D.canvasX = document.getElementById("home-canvas").offsetWidth;
		scene3D.canvasY = document.getElementById("home-canvas").offsetHeight;

		scene3D.camera.aspect = scene3D.canvasX / scene3D.canvasY;
		scene3D.camera.updateProjectionMatrix();

		scene3D.renderer.setSize(scene3D.canvasX, scene3D.canvasY);
	}

	function animate () {
		scene3D.balls.rotation.y = scene3D.balls.rotation.y + 0.0005;
		scene3D.renderer.render(scene3D.scene, scene3D.camera);
		requestAnimationFrame(animate);
	}

</script>
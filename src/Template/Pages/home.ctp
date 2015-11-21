<section id="home">

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
<section id="prehome">

	<header id="prehome-header">
		<div id="prehome-header--logo">
			<a href="<?php echo $this->Url->build(["controller" => "Pages", "action" => "prehome"]); ?>">
				<img src="<?php echo $this->request->webroot.'img/ui/logo-white.png' ?>" />
			</a>
		</div>
		<div id="prehome-header--title">
			<h1>studio wireless</h1>
		</div>
	</header>

	<div id="prehome-award">
		<img src="<?php echo $this->request->webroot.'img/ui/prehome-label.png' ?>" />
	</div>

	<div id="prehome-right">
		<h2>Get ready<br /><span>for greatness</span></h2>
		<p>Discover and personalize the brand new beats studio wireless</p>
		<a href="<?php echo $this->Url->build(["controller" => "Pages", "action" => "home"]); ?>">
			<button>Start</button>
		</a>
	</div>

</section>
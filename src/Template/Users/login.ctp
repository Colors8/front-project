<div id="site-header--spacer"></div>

<div id="userform">
	<h2>Login</h2>

	<?php echo $this->Form->create(null); ?>
		<hr />
		<?php
			echo $this->Form->label('email', '<i class="fa fa-envelope"></i><span>Email address</span>', ['escape' => false]);
			echo $this->Form->input('email', ['label' => false, 'required'=>'required', 'type'=>'email']);
		?>
		<hr />
		<?php
			echo $this->Form->label('password', '<i class="fa fa-key"></i><span>Password</span>', ['escape' => false]);
			echo $this->Form->input('password', ['label' => false, 'required'=>'required', 'type'=>'password']);
		?>
		<hr />
		<?php echo $this->Form->button(__('Login')); ?>
	<?php echo $this->Form->end() ?>
</div>
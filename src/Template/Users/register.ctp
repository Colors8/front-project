<div id="site-header--spacer"></div>

<div id="userform">
	<h2>Create an account</h2>

	<?php echo $this->Form->create($user, array('type' => 'file')); ?>
		<hr />
		<?php
			echo $this->Form->label('username', '<i class="fa fa-user"></i><span>Username</span>', ['escape' => false]);
			echo $this->Form->input('username', ['label' => false, 'required'=>'required']);
		?>
		<hr />
		<?php
			echo $this->Form->label('email', '<i class="fa fa-envelope"></i><span>Email address</span>', ['escape' => false]);
			echo $this->Form->input('email', ['label' => false, 'required'=>'required', 'type'=>'email']);
		?>
		<hr />
		<?php
			echo $this->Form->label('image', '<i class="fa fa-image"></i><span>User photo</span>', ['escape' => false]);
		?>
		<div id="userform-image">
			<img src="#" />
		</div>
		<?php
			echo $this->Form->input('image', ['label' => false, 'required'=>'required', 'type'=>'file', 'onchange'=>'readURL(this);']);
		?>
		<hr />
		<?php
			echo $this->Form->label('password', '<i class="fa fa-key"></i><span>Password</span>', ['escape' => false]);
			echo $this->Form->input('password', ['label' => false, 'required'=>'required', 'type'=>'password']);
		?>
		<hr />
		<?php
			echo $this->Form->label('password_confirm', '<i class="fa fa-key"></i><span>Password confirmation</span>', ['escape' => false]);
			echo $this->Form->input('password_confirm', ['label' => false, 'required'=>'required', 'type'=>'password']);
		?>
		<hr />
		<?php echo $this->Form->button(__('Create my account')); ?>
	<?php echo $this->Form->end() ?>
</div>

<script>
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('#userform-image img')
					.attr('src', e.target.result);
			};

			reader.readAsDataURL(input.files[0]);
		}
	}
</script>
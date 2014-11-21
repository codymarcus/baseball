<h1>Baseball Card Store</h1>
<h2>Login</h2>

<style>
	input { display: block;}
</style>

<?php
	echo form_open_multipart('store/login');

	echo form_label('Username'); 
	echo form_error('username');
	echo form_input('username',set_value('login'),"required");

	echo form_label('Password');
	echo form_error('password');
	echo form_password('password',set_value('password'),"required");
	
	echo form_submit('submit', 'Login');
	echo form_close();

	echo "<p>" . anchor('store/newAccountForm','Create Account') . "</p>";
?>
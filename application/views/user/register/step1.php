<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
	<div class="row">
		<?php if (validation_errors()) : ?>
			<div class="col-md-12">
				<div class="alert alert-danger" role="alert">
					<?= validation_errors() ?>
				</div>
			</div>
		<?php endif; ?>
		<?php if (isset($error)) : ?>
			<div class="col-md-12">
				<div class="alert alert-danger" role="alert">
					<?= $error ?>
				</div>
			</div>
		<?php endif; ?>
		<div class="col-md-12">
			<div class="page-header">
				<h1>Register</h1>
			</div>
			<?= form_open() ?>
				<div class="form-group">
					<label for="username">Username</label>
					<input type="text" class="form-control" id="username" value="<?php echo set_value('username'); ?>" name="username" placeholder="Enter a username">
					<p class="help-block">At least 4 characters, letters or numbers only</p>
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" class="form-control" id="email" value="<?php echo set_value('email'); ?>" name="email" placeholder="Enter your email">
					<p class="help-block">A valid email address</p>
				</div>
				<div class="form-group">
					<label for="facility_name">Facility Name</label>
					<input type="text" class="form-control" id="facility_name" value="<?php echo set_value('facility_name'); ?>" name="facility_name" placeholder="Enter your facility name">
					<p class="help-block">Your name</p>
				</div>
				<div class="form-group">
					<label for="facility_phone">Telefon</label>
					<input type="text" class="form-control" id="facility_phone" value="<?php echo set_value('facility_phone'); ?>" name="facility_phone" placeholder="Enter your facility phone numner (optional)">
					<p class="help-block">Your Phone</p>
				</div>
				<div class="form-group">
					<label for="facility_person_in_charge">Verantwortliche Person (Vor- und Nachname)</label>
					<input type="text" class="form-control" id="facility_person_in_charge" value="<?php echo set_value('facility_person_in_charge'); ?>" name="facility_person_in_charge" placeholder="Enter the name of the responsible person">
					<p class="help-block">Verantworltiche Person</p>
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" class="form-control" id="password" name="password" value="<?php echo set_value('password'); ?>" placeholder="Enter a password">
					<p class="help-block">At least 6 characters</p>
				</div>
				<div class="form-group">
					<label for="password_confirm">Confirm password</label>
					<input type="password" class="form-control" id="password_confirm" name="password_confirm" value="<?php echo set_value('password'); ?>" placeholder="Confirm your password">
					<p class="help-block">Must match your password</p>
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-default" value="Register">
				</div>
			</form>
		</div>
	</div><!-- .row -->
</div><!-- .container -->
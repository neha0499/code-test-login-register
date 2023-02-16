<!-- activate_account_form.php -->

<h2>Activate Your Account</h2>

<p>Your account is not yet activated. Please enter the activation code sent to your email address to activate your account.</p>

<?php echo form_open('activate-account'); ?>

  <div class="form-group">
    <label for="activation_code">Activation Code:</label>
    <input type="text" class="form-control" id="activation_code" name="activation_code" required>
  </div>

  <button type="submit" class="btn btn-primary">Activate Account</button>

<?php echo form_close(); ?>

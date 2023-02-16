<!-- reset_password_form.php -->

<h2>Reset Password</h2>

<p>Please enter your email address to receive a password reset link.</p>

<?php echo form_open('send_reset_password_link'); ?>

  <div class="form-group">
    <label for="email">Email:</label>
    <input type="email" class="form-control" id="email" name="email" required>
  </div>

  <button type="submit" class="btn btn-primary">Send Reset Link</button>

<?php echo form_close(); ?>

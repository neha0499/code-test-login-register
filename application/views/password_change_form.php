<!-- password_change_form.php -->

<h2>Change Password</h2>

<p>Please enter your current password and the new password to change your password.</p>

<?php echo form_open('change-password'); ?>

  <div class="form-group">
    <label for="current_password">Current Password:</label>
    <input type="password" class="form-control" id="current_password" name="current_password" required>
  </div>

  <div class="form-group">
    <label for="new_password">New Password:</label>
    <input type="password" class="form-control" id="new_password" name="new_password" required>
  </div>

  <div class="form-group">
    <label for="confirm_new_password">Confirm New Password:</label>
    <input type="password" class="form-control" id="confirm_new_password" name="confirm_new_password" required>
  </div>

  <button type="submit" class="btn btn-primary">Change Password</button>

<?php echo form_close(); ?>

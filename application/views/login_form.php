<!-- login_form.php -->

<h2>Login</h2>

<?php echo form_open('login'); ?>

  <div class="form-group">
    <label for="email">Email:</label>
    <input type="email" class="form-control" id="email" name="email" required>
  </div>

  <div class="form-group">
    <label for="password">Password:</label>
    <input type="password" class="form-control" id="password" name="password" required>
  </div>
  <br>
  <div class="form-group">
    <button type="submit" class="btn btn-primary">Login</button>
    <a href="<?php echo base_url();?>register" class=" btn-primary">Go to Register</a>
  </div>

<?php echo form_close(); ?>

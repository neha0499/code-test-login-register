<!-- registration_form.php -->

<h2>Registration Form</h2>
<div class="errors">
<?php echo validation_errors(); ?>

</div>

<?php echo form_open('register'); ?>

  <div class="form-group">
    <label for="name">Name:</label>
    <input type="text" class="form-control" id="name" name="name" >
  </div>

  <div class="form-group">
    <label for="dob">DOB:</label>
    <input type="date" class="form-control" id="dob" name="dob" >
  </div>

  <div class="form-group">
    <label for="email">Email:</label>
    <input type="email" class="form-control" id="email" name="email" >
  </div>

  <!-- <div class="form-group">
    <label for="password">Password:</label>
    <input type="password" class="form-control" id="password" name="password" >
  </div> -->
  <div class="form-group">
    <label for="mobile">Mobile:</label>
    <input type="tel" class="form-control" id="mobile" name="mobile" >
  </div>

  <div class="form-group">
    <label for="address">Address:</label>
    <input type="text" class="form-control" id="address" name="address" >
  </div>

  <div class="form-group">
    <label for="pincode">Pin-code:</label>
    <input type="text" class="form-control" id="pincode" name="pincode" >
  </div>
  <br>
  <div class="form-group">

  <button type="submit" class="btn btn-primary">Register</button>
  <a href="<?php echo base_url();?>login" class=" btn-primary">Go to Login</a>
  </div>

<?php echo form_close(); ?>

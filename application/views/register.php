
<h2>Registration Form</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('register'); ?>

<label>Name</label>
<input type="text" name="name" value="<?php echo set_value('name'); ?>" />

<label>Date of Birth</label>
<input type="date" name="dob" value="<?php echo set_value('dob'); ?>" />

<label>Email</label>
<input type="email" name="email" value="<?php echo set_value('email'); ?>" />

<label>Mobile</label>
<input type="text" name="mobile" value="<?php echo set_value('mobile'); ?>" />

<label>Address</label>
<input type="text" name="address" value="<?php echo set_value('address'); ?>" />

<label>Pin-code</label>
<input type="text" name="pincode" value="<?php echo set_value('pincode'); ?>" />

<input type="submit" name="submit" value="Register" />

<?php echo form_close(); ?>

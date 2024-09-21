<h1>Simple Form</h1>
<form method="post" action="<?php echo site_url('formcontroller/submit'); ?>">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" required>
    
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required>
    
    <button type="submit">Submit</button>
</form>

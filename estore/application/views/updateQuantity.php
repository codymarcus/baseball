<h2>Update Quantity</h2>

<style>
	input {display: block;}
</style>

<?php 
	echo "<p>" . anchor('store/shoppingCart','Back') . "</p>";

	echo "<h3>" . "Update Quantity of " . $product->name . "</h3>";
	
	echo form_open_multipart("store/updateQuantityForm");
		
	echo form_label('Quantity'); 
	echo form_error('quantity');
	echo form_input('quantity',set_value('quantity'),"required");	
	
	echo form_submit('submit', 'Update');
	echo form_close();
?>	


<h2>Add to Cart</h2>

<style>
	input {display: block;}
</style>

<?php 
	echo "<p>" . anchor('store/products','Back') . "</p>";

	echo "<h3>" . "Purchase " . $product->name . "</h3>";
	
	echo form_open_multipart("store/addToCart");
		
	echo form_label('Quantity'); 
	echo form_error('quantity');
	echo form_input('quantity',set_value('quantity', 1),"required");	
	
	echo form_submit('submit', 'Add to Cart');
	echo form_close();
?>	


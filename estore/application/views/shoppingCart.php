<h2>Shopping Cart</h2>


<?php
	echo "<p>" . anchor('store/index2', 'Return to Store') . "</p>";
	echo "<p>" . anchor('store', 'Checkout') . "</p>";

	echo "<table>";
	echo "<tr> <th>Name</th> <th>Description</th> <th>Price</th> <th>Photo</th> <th>Quantity</th> </tr>";

	foreach ($products as $product) {
			echo "<tr>";
			echo "<td>" . $product->name . "</td>";
			echo "<td>" . $product->description . "</td>";
			echo "<td>" . $product->price . "</td>";
			echo "<td><img src='" . base_url() . "images/product/" . $product->photo_url ."'/></td>";
			echo "<td>" . form_input('quantity', set_value('quantity'),'required') . "</td>";
			echo "<td>" . anchor("store/editForm/$product->id",'Update') . "</td>";
			echo "</tr>";
	}
	echo "<table>";
?>
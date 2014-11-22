<h2>Available Products</h2>


<?php
	echo "<p>" . "Hello " . $customer->first . "</p>";

	echo "<p>" . anchor('store/shoppingCart', 'Go to Shopping Cart') . "</p>";
	echo "<p>" . anchor('store/logout', 'Logout') . "</p>";

	echo "<table>";
	echo "<tr> <th>Name</th> <th>Description</th> <th>Price</th> <th>Photo</th> </tr>";

	foreach ($products as $product) {
		echo "<tr>";
		echo "<td>" . $product->name . "</td>";
		echo "<td>" . $product->description . "</td>";
		echo "<td>$" . number_format((float)$product->price, 2, '.', '') . "</td>";
		echo "<td><img src='" . base_url() . "images/product/" . $product->photo_url ."' width='100px'/></td>";
		echo "<td>" . anchor("store/addToCartForm/$product->id", 'Add to Cart') . "</td>";
		echo "</tr>";
	}
	echo "</table>";
?>
<h2>Available Products</h2>


<?php
	echo "<p>" . anchor('store/shoppingCart', 'Go to Shopping Cart') . "</p>";
	echo "<p>" . anchor('store', 'Logout') . "</p>";

	echo "<table>";
	echo "<tr> <th>Name</th> <th>Description</th> <th>Price</th> <th>Photo</th> </tr>";

	foreach ($products as $product) {
		echo "<tr>";
		echo "<td>" . $product->name . "</td>";
		echo "<td>" . $product->description . "</td>";
		echo "<td>" . $product->price . "</td>";
		echo "<td><img src='" . base_url() . "images/product/" . $product->photo_url ."'/></td>";
		echo "<td>" . anchor("store/addToCartForm/$product->id", 'Add to Cart') . "</td>";
		echo "</tr>";
	}
	echo "</table>";
?>
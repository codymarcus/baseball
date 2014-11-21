 <h2>Shopping Cart</h2>


<?php
	echo "<p>" . anchor('store/products', 'Return to Store') . "</p>";
	echo "<p>" . anchor('store/checkOut', 'Checkout') . "</p>";

	echo "<table>";
	echo "<tr> <th>Name</th> <th>Description</th> <th>Price</th> <th>Photo</th> <th>Quantity</th> </tr>";
	if (empty($picked_products)) {
		echo "Your cart is empty.";
	}
	else {
		$total = 0;
		foreach ($picked_products as $picked) {
				echo "<tr>";
				echo "<td>" . $picked->name . "</td>";
				echo "<td>" . $picked->description . "</td>";
				echo "<td>" . $picked->price . "</td>";
				echo "<td><img src='" . base_url() . "images/product/" . $picked->photo_url ."'/></td>";
				echo "<td>" . form_input('quantity', set_value('quantity'),'required') . "</td>";
				$total = $total + $picked->quantity * $picked->price;
				echo "<td>" . $picked->quantity * $picked->price; 
				//echo "<td>" . anchor("store/editForm/$item->id",'Update') . "</td>";
				echo "</tr>";
		}
		echo "<table>";
		echo "<br>Subtotal: $" . $total;
	}
?>
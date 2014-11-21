 <h2>Shopping Cart</h2>


<?php
	echo "<p>" . anchor('store/products', 'Return to Store') . "</p>";
	echo "<p>" . anchor('store/checkOut', 'Checkout') . "</p>";

	echo "<table>";
	echo "<tr> <th>Name</th> <th>Price</th> <th>Photo</th> <th>Quantity</th> <th>Total</th> </tr>";
	if (empty($picked_items)) {
		echo "Your cart is empty.";
	}
	else {
		$total = 0;
		foreach ($picked_items as $picked) {
				echo "<tr>";
				echo "<td>" . $picked->name . "</td>";
				echo "<td>$" . $picked->price . "</td>";
				echo "<td><img src='" . base_url() . "images/product/" . $picked->photo_url ."'/></td>";
				echo "<td>" . $picked->quantity . "</td>";
				$total = $total + $picked->quantity * $picked->price;
				echo "<td>$" . $picked->quantity * $picked->price; 
				echo "<td>" . anchor("store/updateQuantity/$picked->product_id", 'Change Quantity') . "</td>";
				echo "<td>" . anchor("store/removeItem/$picked->product_id", 'Remove from Cart') . "</td>";
				//echo "<td>" . anchor("store/editForm/$item->id",'Update') . "</td>";
				echo "</tr>";
		}
		echo "<table>";
		echo "<br>Subtotal: $" . $total;
	}
?>
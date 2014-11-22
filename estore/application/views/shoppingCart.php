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
			foreach ($products as $p) {
				if ($p->id == $picked->product_id)
					$product = $p;
			}
				echo "<tr>";
				echo "<td>" . $picked->name . "</td>";
				echo "<td>$" . number_format((float)$picked->price, 2, '.', '') . "</td>";
				echo "<td><img src='" . base_url() . "images/product/" . $product->photo_url ."' width='100px'/></td>";
				echo "<td>" . $picked->quantity . "</td>";
				$total = $total + $picked->quantity * $picked->price;
				echo "<td>$" . number_format((float)$picked->quantity * $picked->price, 2, '.', '') . "</td>";
				echo "<td>" . anchor("store/updateQuantity/$picked->product_id", 'Change Quantity') . "</td>";
				echo "<td>" . anchor("store/removeItem/$picked->product_id", 'Remove from Cart') . "</td>";
				//echo "<td>" . anchor("store/editForm/$item->id",'Update') . "</td>";
				echo "</tr>";
		}
		echo "<table>";
		echo "<br>Subtotal: $" . number_format((float)$total, 2, '.', '');
	}
?>
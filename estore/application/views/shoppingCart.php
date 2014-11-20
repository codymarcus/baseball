 <h2>Shopping Cart</h2>


<?php
	echo "<p>" . anchor('store/index2', 'Return to Store') . "</p>";
	echo "<p>" . anchor('store/checkOut', 'Checkout') . "</p>";

	echo "<table>";
	echo "<tr> <th>Name</th> <th>Description</th> <th>Price</th> <th>Photo</th> <th>Quantity</th> </tr>";
	if (empty($order_items)) {
		echo "Your cart is empty.";
	}
	else {
		foreach ($order_items as $item) {
				echo "<tr>";
				echo "<td>" . $item->name . "</td>";
				echo "<td>" . $item->description . "</td>";
				echo "<td>" . $item->price . "</td>";
				echo "<td><img src='" . base_url() . "images/product/" . $item->photo_url ."'/></td>";
				echo "<td>" . form_input('quantity', set_value('quantity'),'required') . "</td>";
				$total = $total + $item->quantity * $item->price;
				echo "<td>" . $item->quantity * $item->price; 
				echo "<td>" . anchor("store/editForm/$item->id",'Update') . "</td>";
				echo "</tr>";
		}
		echo "<table>";
		echo "<br>Subtotal: $" . $total;
	}
?>
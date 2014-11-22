<h2>E-mail</h2>

<?php
	echo "Thank you, for shopping with us. This is a list of your purchases: <br>";
	echo "<table>";
	echo "<tr><th>Card</th> <th>Price</th> <th>Quantity</th> <th>Total</th></tr>";
	$subtotal = 0;

	foreach ($items as $item) { //FIND OUT WHAT TO REPLACE FOR order_items
		echo "<tr>";
		echo "<td>" . $item->name . "</td>";
		echo "<td>" . $item->price . "</td>";
		echo "<td>" . $item->quantity . "</td>";
		echo "<td>" . $item->quantity * $item->price . "</td>";
		//echo "<td>" . $item->name . "</td>";
		$subtotal = $subtotal + $item->quantity * $item->price;
		echo "<td></td>";
		echo "</tr>";
	}
	echo "</table>";
	echo "<br> Total = $" . number_format((float)$subtotal, 2, '.', '');

?>
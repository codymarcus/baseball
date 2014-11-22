<h1>Baseball Card Store</h1>
<h2>Administrator Page</h2>


<?php
	echo "<p>" . anchor('store/adminOrders', 'Previous') . "</p>";
	echo "<h2>Order Items</h2>";
	echo "<table>";
	echo "<tr><th>Card</th> <th>Price</th> <th>Quantity</th> <th>Subtotal</th></tr>";
	$total = 0;

	foreach ($items as $item) { 
		echo "<tr>";
		echo "<td>" . $item->name . "</td>";
		echo "<td>$" . number_format((float)$item->price, 2, '.', '') . "</td>";
		echo "<td>" . $item->quantity . "</td>";
		echo "<td>" . $item->quantity * $item->price . "</td>";
		$total = $total + $item->quantity * $item->price;
		echo "<td></td>";
		echo "</tr>";
	}
	echo "</table>";
	echo "<br> Total = $" . number_format((float)$total, 2, '.', '');
?>
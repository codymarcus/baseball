<h1>Baseball Card Store</h1>
<h2>Administrator Page</h2>


<?php
	echo "<p>" . anchor('store/index', 'Return to Store') . "</p>";
	echo "<p>" . anchor('store/adminPage', 'Previous') . "</p>";
	echo "<h2>Finalized Orders</h2>";
	echo "<table>";
	echo "<tr><th>Order ID</th> <th>Customer ID</th> <th>Date</th> <th>Time</th> <th>Total</th></tr>";
	foreach ($orders as $order) {
		echo "<tr>";
		echo "<td>" . $order->id . "</td>";
		echo "<td>" . $order->customer_id . "</td>";
		echo "<td>" . $order->order_date . "</td>";
		echo "<td>" . $order->order_time . "</td>";
		echo "<td>" . $order->order_total . "</td>";
		echo "<td>" . $order->creditcard_number . "</td>";
		echo "<td>" . $order->creditcard_month . "</td>";
		echo "<td>" . $order->creditcard_year . "</td>";
		echo "</tr>";

	}
	echo "<table>";
?>
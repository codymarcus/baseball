<h1>Baseball Card Store</h1>
<h2>Administrator Page</h2>


<?php
	echo "<p>" . anchor('store/adminPage', 'Previous') . "</p>";
	echo "<h2>Orders</h2>";
	echo "<table>";
	echo "<tr><th>Order ID</th> <th>Customer ID</th> <th>Date</th> <th>Time</th> <th>Total</th></tr>";
	foreach ($orders as $order) {
		echo "<tr>";
		echo "<td>" . $order->id . "</td>";
		echo "<td>" . $order->customer_id . "</td>";
		echo "<td>" . $order->order_date . "</td>";
		echo "<td>" . $order->order_time . "</td>";
		echo "<td>$" . number_format((float)$order->total, 2, '.', '') . "</td>";
		echo "<td>" . anchor("store/listOrderItems/$order->id", 'Order Items') . "</td>";		
		echo "<td>" . anchor("store/deleteOrder/$order->id", 'Delete Order', "onClick = 'return confirm(\"Are you sure you want to delete this order?\");'") . "</td>";
	}
	echo "<table>";
?>
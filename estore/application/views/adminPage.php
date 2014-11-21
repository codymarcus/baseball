<h1>Baseball Card Store</h1>
<h2>Administrator Page</h2>


<?php
	echo "<p>" . anchor('store/index', 'Return to Store') . "</p>";
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
		echo "<td>" . $order->order_total . "</td>";
		echo "<td>" . anchor("store/listOrderItems/$order->id", 'Order Items') . "</td>";		
		echo "<td>" . anchor("store/deleteOrder/$order->id", 'Delete Order', "onClick = 'return confirm(\"Are you sure you want to delete this order?\");'") . "</td>";
	}
	echo "<table>";
?>

<h1>Baseball Card Store</h1>
<h2>Administrator Page</h2>


<?php
	echo "<p>" . anchor('store/index2', 'Return to Store') . "</p>";
	echo "<p>" . anchor('store/adminProducts', 'Add/Edit/Delete Products') . "</p>";
	echo "<p>" . anchor('store/finalizeOrders', 'Display Finalized Orders') . "</p>";
	echo "<p>" . anchor('store/adminOrders', 'View/Edit/Delete Orders') . "</p>";
	echo "<p>" . anchor('store/adminCustomers', 'Customers') . "</p>";
?>
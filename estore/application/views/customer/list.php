<h1>Baseball Card Store</h1>
<h2>Administrator Page</h2>


<?php
	echo "<p>" . anchor('store/index', 'Return to Store') . "</p>";
	echo "<p>" . anchor('store/adminPage', 'Previous') . "</p>";
	echo "<h2>Customers</h2>";
	echo "<table>";
	echo "<tr><th>First Name</th> <th>Last Name</th> <th>E-mail</th></tr>";
	foreach ($customers as $customer) {
		echo "<tr>";
		echo "<td>" . $customer->first . "</td>";
		echo "<td>" . $customer->last . "</td>";
		echo "<td>" . $customer->email . "</td>";
		echo "<td>" . anchor("store/deleteCustomer/$customer->id", 'Delete Customer', "onClick = 'return confirm(\"Are you sure you want to delete this customer?\");'") . "</td>";
	}
	echo "<table>";
?>
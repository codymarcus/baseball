<h1>Baseball Card Store</h1>
<h2>Administrator Page</h2>


<?php
	echo "<p>" . anchor('store/index', 'Logout') . "</p>";
	echo "<p>" . anchor('store/adminProducts', 'Add/Edit/Delete Products') . "</p>";
	echo "<p>" . anchor('store/adminOrders', 'Finalized Orders') . "</p>";
	echo "<p>" . anchor('store/adminCustomers', 'Customers') . "</p>";
?>
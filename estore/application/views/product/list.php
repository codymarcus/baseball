<h1>Baseball Card Store</h1>
<h2>Administrator Page</h2>


<?php
		echo "<p>" . anchor('store/adminPage', 'Previous') . "</p>";
		echo "<h2>Product Table</h2>";
		echo "<p>" . anchor('store/newForm','Add New') . "</p>";
 	  
		echo "<table>";
		echo "<tr><th>Name</th><th>Description</th><th>Price</th><th>Photo</th></tr>";
		
		foreach ($products as $product) {
			echo "<tr>";
			echo "<td>" . $product->name . "</td>";
			echo "<td>" . $product->description . "</td>";
			echo "<td>$" . number_format((float)$product->price, 2, '.', '') . "</td>";
			echo "<td><img src='" . base_url() . "images/product/" . $product->photo_url . "' width='100px' /></td>";
				
			echo "<td>" . anchor("store/delete/$product->id",'Delete',"onClick='return confirm(\"Do you really want to delete this record?\");'") . "</td>";
			echo "<td>" . anchor("store/editForm/$product->id",'Edit') . "</td>";
			echo "<td>" . anchor("store/read/$product->id",'View') . "</td>";
				
			echo "</tr>";
		}
		echo "<table>";
?>
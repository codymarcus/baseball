<h2>Receipt</h2>
<?php 
		
//echo $this->session->userdata('session_id');
	echo "<table>";
	echo "<tr><th>Card</th> <th>Price</th> <th>Quantity</th> <th>Total</th></tr>";
	$subtotal = 0;

	foreach ($items as $item) { 
		echo "<tr>";
		echo "<td>" . $item->name . "</td>";
		echo "<td>" . round($item->price, 2) . "</td>";
		echo "<td>" . $item->quantity . "</td>";
		echo "<td>" . $item->quantity * $item->price . "</td>";
		$subtotal = $subtotal + $item->quantity * $item->price;
		echo "<td></td>";
		echo "</tr>";
	}
	echo "</table>";
	echo "<br> Total = $" . number_format((float)$subtotal, 2, '.', '');
	echo "<br>";
	echo anchor('store/index2', 'Back to shop');
//$this->session->sess_destroy();
?>	
<p><button onClick="window.print()">Print receipt</button><p>
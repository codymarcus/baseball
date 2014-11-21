<h2>Receipt</h2>
<?php 
		
//echo $this->session->userdata('session_id');
	echo "<table>";
	echo "<tr><th>Card</th> <th>Price</th> <th>Quantity</th> <th>Total</th></tr>";
	$subtotal = 0;

	foreach ($this->cart->contents() as $item) { 
		echo "<tr>";
		echo "<td>" . $item['name'] . "</td>";
		echo "<td>" . $item['price'] . "</td>";
		echo "<td>" . $item['qty'] . "</td>";
		echo "<td>" . $item['qty'] * $item['price'] . "</td>";
		$subtotal = $subtotal + $item['qty'] * $item['price'];
		echo "<td></td>";
		echo "</tr>";
	}
	echo "</table>";
	echo "<br> Total = $" . $subtotal;
	echo "<br>";
	echo anchor('store/index2', 'Back to shop');
//$this->session->sess_destroy();
?>	
<p><button onClick="window.print()">Print receipt</button><p>
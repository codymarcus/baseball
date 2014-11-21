<h2>Check Out</h2>

<style>
	input { display: block;}
</style>


<?php

	echo "<p>" . anchor('store/shoppingCart','Back') . "</p>";

	echo form_open('store/checkOutForm');
	echo form_label('Credit Card Number');
	echo form_error('creditcard_number');
	echo form_input('creditcard_number',set_value('creditcard_number'),"required");
	echo form_label('Expiry Month');
	echo "<br>";
	$month = array('01' => '01', '02' =>'02', '03'=>'03', '04'=>'04', '05'=>'05', '06'=>'06', '07'=>'07', '08'=>'08', '09'=>'09', '10'=>'10', '11'=>'11', '12'=>'12');
	echo form_error('creditcard_month');
	echo form_dropdown('creditcard_month', $month, set_value('creditcard_month'));
	echo "<br>";
	echo form_label('Expiry Year');
	echo form_error('creditcard_year');
	echo form_input('creditcard_year',set_value('creditcard_year'),"required");
	echo form_submit('submit', 'Submit');
	echo form_close();

?>
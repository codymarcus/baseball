<h2>Check Out</h2>

<?php

echo form_open('store/createAccount');
echo form_label('Credit Card Number');
echo form_error('creditcard_num');
echo form_input('creditcard_num',set_value('creditcard_num'),"required");
echo form_label('Expiry Date');
echo form_error('creditcard_exp');
echo form_input('creditcard_exp',set_value('creditcard_exp'),"required");
echo form_submit('submit', 'Submit');
echo form_close();
echo anchor('store/createAccount', 'Return');

?>
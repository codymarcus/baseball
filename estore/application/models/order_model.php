<?php
class Order_model extends CI_Model {

	//Added this
	function construct($order) {
		return $this->db->insert("orders", array('customer_id' => $order->customer_id));
	}

	function getAll()
	{  
		$query = $this->db->get('orders');
		return $query->result('Order');
	}  
	
	function creditcard_info($id)
	{
		$this->db->where('id',$order->id);
		return $this->db->insert("orders", array('creditcard_num' => $order->creditcard_num,
												 'creditcard_month' => $order->creditcard_month,
												 'creditcard_year' => $order->creditcar_year));
	}
	
	function create_receipt($order) {
		$this->db->from('order_items');
		$this->db->where('id, $order->id');
		return $query->result('Item');
	}
	
}
?>

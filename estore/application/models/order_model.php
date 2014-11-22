<?php
class Order_model extends CI_Model {

	function getAll()
	{  
		$query = $this->db->query('SELECT orders.id, orders.customer_id, orders.order_date, orders.order_time, orders.total FROM orders INNER JOIN customers ON orders.customer_id=customers.id ORDER BY orders.id');
		return $query->result('Order');
	}  
	
	function get($id) {
		$query = $this->db->get_where('orders', array('id' => $id));
		return $query->row(0, 'Order');
	}

	function delete($id) {
		return $this->db->delete('orders', array('id' => $id));
	}

	function insert($order) {
		return $this->db->insert("orders", array('customer_id' => $order->customer_id,
												  'order_date' => $order->order_date,
												  'order_time' => $order->order_time,
												  'total' => $order->total,
												  'creditcard_number' => $order->creditcard_number,
												  'creditcard_month' => $order->creditcard_month,
												  'creditcard_year' => $order->creditcard_year));
	}

 	function creditcard_info($id)
	{
		$this->db->where('id',$order->id);
		return $this->db->insert("orders", array('creditcard_number' => $order->creditcard_number,
												 'creditcard_month' => $order->creditcard_month,
												 'creditcard_year' => $order->creditcar_year));
	}
	
	function create_receipt($order) {
		$this->db->from('order_items');
		$this->db->where('id', $order->id);
		return $query->result('Item');
	}
	
}
?>
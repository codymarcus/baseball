<?php
class Item_model extends CI_Model {

	function getAll($orderId)
	{  
		$query = $this->db->query('SELECT * FROM order_items INNER JOIN products on order_items.product_id = products.id WHERE order_id = '.$orderId.'');
		/*$this->db->select('products.id, products.name, products.description, products.price, products.photo_url, order_items.quantity');
		$this->db->from('products');
		$this->db->join('order_items', 'products.id = order_items.product_id');
		$this->db->where('orders', array('id' => $id));
		*/
		return $query->result('Item');
	}  

	function get($id)
	{
		return $this->db->get_where('order_items',array('id' => $id));
		
		return $query->row(0,'Item');
	}
	
	function delete_item($id)
	{
		return $this->db->delete("order_items", array('id' => $id));
	}
	
	function insert($item) {
		return $this->db->insert("order_items", array('order_id' => 0,
													'product_id' => $item->product_id,
													'quantity' => $item->quantity));
	}

	function update_quantity($item) {
		$this->db->where('id', $order->id);
		return ($this->db->update("order_items", array('quantity' => $item->quantity)));
	}
	
}
?>
<?php
class Item_model extends CI_Model {

	function getAll()
	{  
		$this->db->select('products.id, products.name, products.description, products.price, products.photo_url, order_items.quantity');
		$this->db->from('products');
		$this->db->join('order_items', 'products.id = order_items.product_id');
		$this->db->where('orders', array('id' => $id));
		return $query->result('Products');
	}  
	
	function delete_item($id)
	{
		return $this->db->delete("order_items", array('id' => $id));
	}
	
	function insert_item($item) {
		return $this->db->insert("order_items", array('order_id' => $item->order_id,
													  'product_id' => $item->product_id,
													  'quantity' => $item->quantity));
	}

	function update_quantity($item) {
		$this->db->where('id', $order->id);
		return $this->db->update("order_items", array('quantity' => $item->quantity));
	}
	
}
?>

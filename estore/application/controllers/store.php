<?php

class Store extends CI_Controller {
     
     
    function __construct() {
    		// Call the Controller constructor
	    	parent::__construct();
	    	session_start();
	    	
	    	$config['upload_path'] = './images/product/';
	    	$config['allowed_types'] = 'gif|jpg|png';
/*	    	$config['max_size'] = '100';
	    	$config['max_width'] = '1024';
	    	$config['max_height'] = '768';
*/
	    		    	
	    	$this->load->library('upload', $config);
	    //	$this->load->library('cart');
    }

    function index() {
    	if (isset($_SESSION['customer'])) {
    		redirect('store/products','refresh');
    	}
    	else {
    		$this->load->view('loginForm.php');
    	}
    }
    
    function index2() {
		$this->load->model('product_model');
		$products = $this->product_model->getAll();
		$data['products']=$products;
		$this->load->view('availableProducts.php', $data);
	}

    function login() {
    	$this->load->model('customer_model');
    	$this->load->library('form_validation');
    	$this->form_validation->set_rules('username','Username','required|is_unique[products.name]');
		$this->form_validation->set_rules('password','Password','required');

		// check if user in database...
		if ($this->form_validation->run() == true) {
			$login = $this->input->get_post('username');
			$password = $this->input->get_post('password');
			if($login == 'admin') {
					redirect('store/adminPage', 'refresh');

			}
			// If username and password are found in database
			if ($this->customer_model->login($login,$password)) {
				$customer = $this->customer_model->login($login,$password);

				if(isset($customer)) {
					$_SESSION['customer'] = $customer;
					$_SESSION['picked'] = array();
				}

				redirect('store/products', 'refresh');
			}
			else {
				$this->load->view('loginForm.php');
			}	
		}
		else {
			$this->load->view('loginForm.php');
		}
    }

    function logout() {
    	unset($_SESSION['customer']);
    	unset($_SESSION['picked']);
    	$this->index();
    }

    function newAccountForm() {
	    	$this->load->view('newAccountForm.php');
    }

    function createAccount() {
    	$this->load->library('form_validation');
		$this->form_validation->set_rules('first','First Name','required');
		$this->form_validation->set_rules('last','Last Name','required');
		$this->form_validation->set_rules('login','Username','required|is_unique[customers.login]');
		$this->form_validation->set_rules('password','Password','required|min_length[6]');
		$this->form_validation->set_rules('confPassword','Confirm Password','required|matches[password]');
		$this->form_validation->set_rules('email','Email','required|valid_email|is_unique[customers.email]');
		$this->form_validation->set_rules('confEmail','Confirm Email','required|matches[email]');
		
		if ($this->form_validation->run()) {
			$this->load->model('customer');
			$this->load->model('customer_model');

			$customer = new Customer();
			$customer->first = $this->input->get_post('first');
			$customer->last = $this->input->get_post('last');
			$customer->login = $this->input->get_post('login');
			$customer->password = $this->input->get_post('password');
			$customer->email = $this->input->get_post('email');
			
			$this->customer_model->insert($customer);

			//Then we redirect to the index page again
			redirect('store/index', 'refresh');
		}
		else {			
			$this->load->view('newAccountForm.php');
		}	
    }

    function products() {
    	$this->load->model('product_model');
    	$products = $this->product_model->getAll();
    	$customer = $_SESSION['customer'];
    	$data = array('products' => $products, 'customer' => $customer);
    	$this->load->view('availableProducts.php',$data);
    }

    function updateQuantityForm() {
    	$this->load->model('product_model');

    	$this->load->library('form_validation');
    	$this->form_validation->set_rules('quantity','Quantity','required|is_natural_no_zero');

    	$id = $_SESSION['current']->id;

    	foreach ($_SESSION['picked'] as $item) {
    		if ($item->product_id == $id)
    			$updateitem = $item;
    	}

    	if ($this->form_validation->run()) {
    		$updateitem->quantity = $this->input->get_post('quantity');
    	}

    	$this->shoppingCart();
    }

    function updateQuantity($id) {
    	$this->load->model('product_model');
    	$product = $this->product_model->get($id);
    	$data['product'] = $product;
    	$_SESSION['current'] = $product;
    	$this->load->view('updateQuantity.php',$data);
    }

    function removeItem($id) {
    	foreach ($_SESSION['picked'] as $item) {
    		if ($item->product_id == $id)
    			$removeditem = $item;
    	}
    	if(($key = array_search($removeditem, $_SESSION['picked'])) !== FALSE)
    		unset($_SESSION['picked'][$key]);
    	redirect('store/shoppingCart', 'refresh');
    }


    function addToCartForm($id) {
    	$this->load->model('product_model');
    	$product = $this->product_model->get($id);
    	$data['product'] = $product;
    	$_SESSION['current'] = $product;
    	$this->load->view('addToCart.php',$data);
    }

    function addToCart() {
    	$this->load->model('product_model');
    	$this->load->model('item_model');
    	$this->load->model('item');

    	$this->load->library('form_validation');
    	$this->form_validation->set_rules('quantity','Quantity','required|is_natural_no_zero');

    	if ($this->form_validation->run()) {
    		$product = $_SESSION['current'];
    		$product->quantity = $this->input->get_post('quantity');

    		$found_id = -1;

    		foreach ($_SESSION['picked'] as $picked_item) {
    			if ($picked_item->product_id == $product->id) {
    				$found_id = $picked_item->product_id;
    				$picked_item->quantity = $picked_item->quantity + $product->quantity;
    			}
    		} 

    		if ($found_id == -1) {
    			$item = new Item();
    			$item->product_id = $product->id;
    			$item->order_id = 0;
    			$item->name = $product->name;
    			$item->price = $product->price;
    			$item->quantity = $product->quantity;
    			echo $item->name;
    			$_SESSION['picked'][] = $item;
    		}

    	}
    	$this->shoppingCart();
    }

    function shoppingCart() {
    	$this->load->model('product_model');
    	$data['picked_items']=$_SESSION['picked'];
    	$this->load->view('shoppingCart.php',$data);
    }
    
    function checkOut() {
    	$this->load->view('checkOut.php');
    }

	function checkOutForm() {

		$this->load->view('checkOut.php');				

		$this->load->helper('date');
		$month = gmdate('m');
		$year = gmdate('Y');

		$cur_month = $this->input->post('creditcard_month');
		$cur_year = $this->input->post('creditcard_year');

		$this->load->library('form_validation');
		$this->form_validation->set_rules('creditcard_number', 'Credit Card Number', 'required|exact_length[16]|numeric');
		$this->form_validation->set_rules('creditcard_month', 'Credit Card Month', 'required|exact_length[2]|numeric');
		$this->form_validation->set_rules('creditcard_year', 'Credit Card Year', 'required|exact_length[4]|numeric');

		if($this->form_validation->run() == TRUE) {
			if($this->input->post('creditcard_year') < gmdate('Y')) {
					echo "Card Expired!";
					//$this->load->view('checkOut.php');
			}

			if($this->input->post('creditcard_year') == gmdate('Y')) {
				if($this->input->post('creditcard_month') < gmdate('m')) {
					echo "Card Expired!";
					//$this->load->view('checkOut.php');				
				}
				else {
					$this->load->model('customer_model');
					$id = $this->session->userdata('id');
		//$customer = $this->customer_model->get($id);
		$customer = $this->customer_model->get(1);
		$email = $customer->email;

		$this->load->library('email');
		$config = array('protocol' => 'smtp',
						'smtp_host' => 'smtp.gmail.com',
						'smtp_port' => 465, 
						'smtp_user' => 'estorecsc309@gmail.com',
						'smtp_pass' => 'estorecsc',
						'mailtype' => 'html',
						'charset' => 'iso-8859-1');

		$this->email->set_mailtype("html");
		$this->email->from('estorecsc309@gmail.com', 'Baseball Card eStore');
		$this->email->to($email);
		$this->email->subject('Purchase Confirmation E-mail');
		$data['items'] = $_SESSION['picked'];
		$message = $this->load->view('email/email', $data, true);
		// echo $_SESSION['customer']->email;
		// echo $this->email->print_debugger();
				$this->load->model('order');
				$this->load->model('order_model');
				$this->load->model('item_model');
				$this->load->helper('date');

				$cur_order = new Order();
				$cur_order->customer_id = $_SESSION['customer']->id;
				$cur_order->order_time = gmdate("%h:%i", time());
				$cur_order->order_date = gmdate("%Y - %m - %d", time());

				$cur_order->total = 0;

				$cur_order->creditcard_number = $this->input->get_post('creditcard_number');
				$cur_order->creditcard_month = $this->input->get_post('creditcard_month');
				$cur_order->creditcard_year = $this->input->get_post('creditcard_year');

				foreach ($_SESSION['picked'] as $picked_item) {
					$picked_item->order_id = $cur_order->id;
					$this->item_model->insert($picked_item);
					$cur_order->total = $cur_order->total + ($picked_item->price * $picked_item->quantity);
				}

				$this->order_model->insert($cur_order);
				//ADD ALL ITEMS FROM item_model TO THIS ORDER
				//$this->load->view('receipt.php');
				redirect('store/receipt', 'refresh');
				}

			}
			else {
						$this->load->model('customer_model');
		$id = $this->session->userdata('id');
		//$customer = $this->customer_model->get($id);
		$customer = $_SESSION['customer'];
		$email = $customer->email;

		$this->load->library('email');
		$config = array('protocol' => 'smtp',
						'smtp_host' => 'smtp.gmail.com',
						'smtp_port' => 465, 
						'smtp_user' => 'estorecsc309@gmail.com',
						'smtp_pass' => 'estorecsc',
						'mailtype' => 'html',
						'charset' => 'iso-8859-1');

		$this->email->set_mailtype("html");
		$this->email->from('estorecsc309@gmail.com', 'Baseball Card eStore');
		$this->email->to($email);
		$this->email->subject('Purchase Confirmation E-mail');
		$data['items'] = $_SESSION['picked'];
		$message = $this->load->view('email/email', $data, true);
		$this->email->message($message);
		$this->email->send();
		// echo $_SESSION['customer']->email;
		// echo $this->email->print_debugger();
				$this->load->model('order');
				$this->load->model('order_model');
				$this->load->model('item_model');
				$this->load->helper('date');

				$cur_order = new Order();
				$cur_order->customer_id = $_SESSION['customer']->id;
				$cur_order->order_time = gmdate("%h:%i", time());
				$cur_order->order_date = gmdate("%Y - %m - %d", time());

				$cur_order->total = 0;

				$cur_order->creditcard_number = $this->input->get_post('creditcard_number');
				$cur_order->creditcard_month = $this->input->get_post('creditcard_month');
				$cur_order->creditcard_year = $this->input->get_post('creditcard_year');
				$this->order_model->insert($cur_order);

				foreach ($_SESSION['picked'] as $picked_item) {
					$picked_item->order_id = $cur_order->id;
					$this->item_model->insert($picked_item);
					$cur_order->total = $cur_order->total + ($picked_item->price * $picked_item->quantity);
				}

				$this->order_model->insert($cur_order);
				//ADD ALL ITEMS FROM item_model TO THIS ORDER
				//$this->load->view('receipt.php');
				redirect('store/receipt', 'refresh');

				//$this->session->sess_destroy();
			}
		}
	
	}

	function finalizeOrders() {
		$this->load->model('order');
		$this->load->model('order_model');
		$orders = $this->order_model->getAll();
		$data['orders'] = $orders;

		$this->load->view('order/finalizedOrders.php', $data);
	}

	function email() {
		$this->load->model('customer_model');
		//$customer = $this->customer_model->get($id);
		$customer = $_SESSION['customer'];
		$email = $customer->email;

		$this->load->library('email');
		$config = array('protocol' => 'smtp',
						'smtp_host' => 'smtp.gmail.com',
						'smtp_port' => 465, 
						'smtp_user' => 'estorecsc309@gmail.com',
						'smtp_pass' => 'estorecsc',
						'mailtype' => 'html',
						'charset' => 'iso-8859-1');

		$this->email->set_mailtype("html");
		$this->email->from('estorecsc309@gmail.com', 'Baseball Card eStore');
		$this->email->to($email);
		$this->email->subject('Purchase Confirmation E-mail');
		$data['items'] = $_SESSION['picked'];
		$message = $this->load->view('email/email', $data, true);
		$this->email->message($message);
		$this->email->send();
		// echo $this->email->print_debugger();
	}

    function newForm() {
	    	$this->load->view('product/newForm.php');
    }
    
	function create() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name','Name','required|is_unique[products.name]');
		$this->form_validation->set_rules('description','Description','required');
		$this->form_validation->set_rules('price','Price','required');
		
		$fileUploadSuccess = $this->upload->do_upload();
		
		if ($this->form_validation->run() == true && $fileUploadSuccess) {
			$this->load->model('product_model');

			$product = new Product();
			$product->name = $this->input->get_post('name');
			$product->description = $this->input->get_post('description');
			$product->price = $this->input->get_post('price');
			
			$data = $this->upload->data();
			$product->photo_url = $data['file_name'];
			
			$this->product_model->insert($product);

			//Then we redirect to the index page again
			redirect('store/adminProducts', 'refresh');
		}
		else {
			if ( !$fileUploadSuccess) {
				$data['fileerror'] = $this->upload->display_errors();
				$this->load->view('product/newForm.php',$data);
				return;
			}
			
			$this->load->view('product/newForm.php');
		}	
	}
	
	function read($id) {
		$this->load->model('product_model');
		$product = $this->product_model->get($id);
		$data['product']=$product;
		$this->load->view('product/read.php',$data);
	}
	
	function editForm($id) {
		$this->load->model('product_model');
		$product = $this->product_model->get($id);
		$data['product']=$product;
		$this->load->view('product/editForm.php',$data);
	}
	
	function update($id) {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('description','Description','required');
		$this->form_validation->set_rules('price','Price','required');
		
		if ($this->form_validation->run() == true) {
			$product = new Product();
			$product->id = $id;
			$product->name = $this->input->get_post('name');
			$product->description = $this->input->get_post('description');
			$product->price = $this->input->get_post('price');
			
			$this->load->model('product_model');
			$this->product_model->update($product);
			//Then we redirect to the index page again
			redirect('store/index', 'refresh');
		}
		else {
			$product = new Product();
			$product->id = $id;
			$product->name = set_value('name');
			$product->description = set_value('description');
			$product->price = set_value('price');
			$data['product']=$product;
			$this->load->view('product/editForm.php',$data);
		}
	}
    	
	function delete($id) {
		$this->load->model('product_model');
		
		if (isset($id)) 
			$this->product_model->delete($id);
		
		//Then we redirect to the index page again
		redirect('store/index', 'refresh');
	}

	function receipt() {
		$data['items'] = $_SESSION['picked'];
		$this->load->view('receipt.php', $data);
	}
    
	function adminPage() {
		$this->load->view('adminPage.php');
	}

	function adminProducts() {
		$this->load->model('product_model');
		$products = $this->product_model->getAll();
		$data['products'] = $products;
		$this->load->view('product/list.php', $data);
	}

	function adminCustomers() {
		$this->load->model('customer_model');
		$customers = $this->customer_model->getAll();
		$data['customers'] = $customers;
		$this->load->view('customer/list.php', $data);
	}

	function adminOrders() {
		$this->load->model('order_model');
		$orders = $this->order_model->getAll();
		$data['orders'] = $orders;
		$this->load->view('order/list.php', $data);
	}

	function deleteCustomer($id) {
		$this->load->model('customer_model');

		if (isset($id))
			$this->customer_model->delete($id);

		redirect('store/adminCustomers', 'refresh');
	}

	function deleteOrder($id) {
		$this->load->model('order_model');

		if (isset($id))
			$this->order_model->delete($id);

		redirect('store/adminOrders', 'refresh');
	}

}

?>

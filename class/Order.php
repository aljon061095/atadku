<?php

class Order {	
	private $ordersTable = 'food_orders';	
	private $link;
	
	public function __construct($db){
        $this->link = $db;
    }	    
	
	public function insert(){		
		if($this->name) {
			$stmt = $this->link->prepare("
			INSERT INTO ".$this->ordersTable."(`customer_id`, `restaurant_id`, `order_id`, `item_id`, `name`, `price`, `quantity`, `payment_method`, `account_name`, `account_number`)
			VALUES(?,?,?,?,?,?,?,?,?,?)");	
            $this->customer_id = htmlspecialchars(strip_tags($this->customer_id));	
            $this->restaurant_id = htmlspecialchars(strip_tags($this->restaurant_id));
            $this->order_id = htmlspecialchars(strip_tags($this->order_id));	
			$this->item_id = htmlspecialchars(strip_tags($this->item_id));
			$this->name = htmlspecialchars(strip_tags($this->name));
			$this->price = htmlspecialchars(strip_tags($this->price));
			$this->quantity = htmlspecialchars(strip_tags($this->quantity));
			$this->order_date = htmlspecialchars(strip_tags($this->order_date));
			$this->payment_method = htmlspecialchars(strip_tags($this->payment_method));
			$this->account_name = htmlspecialchars(strip_tags($this->account_name));
			$this->account_number = htmlspecialchars(strip_tags($this->account_number));
			$stmt->bind_param("ssssssssss", $this->customer_id, $this->restaurant_id, $this->order_id, $this->item_id, $this->name, $this->price, $this->quantity, $this->payment_method, $this->account_name, $this->account_number);			
			if($stmt->execute()){
				return true;
			}		
		}
	}	
}
?>
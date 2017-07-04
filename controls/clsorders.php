<?php 
	require_once("config.php");
	
	class Orders
        
	{    
             public function saveorder($email)
 		{ 
			try {
				$conn = new PDO('mysql:host='.MYSQLDB_HOST.';dbname='.MYSQLDB_DATABASE.'', MYSQLDB_USER, MYSQLDB_PASS);
                                
				$query = $conn->prepare("insert into orders set email_id=:email");
                $query->execute(array(':email'=>$email));
				$pid=$conn->lastInsertId();
			}
			catch (Exception $e) {
				die ('Error : ' . $e->getMessage());
			}
			
			return $pid;
		}
		
		      public function saveorderitem($name,$price,$quantity,$order_id)
 		{ 
			try {
				$conn = new PDO('mysql:host='.MYSQLDB_HOST.';dbname='.MYSQLDB_DATABASE.'', MYSQLDB_USER, MYSQLDB_PASS);
                                
				$query = $conn->prepare("insert into order_items set name=:name,order_id=:order_id,price=:price,quantity=:quantity");
                $query->execute(array(':name'=>$name,':price'=>$price,':quantity'=>$quantity,':order_id'=>$order_id));
			}
			catch (Exception $e) {
				die ('Error : ' . $e->getMessage());
			}
			
			return $query;
		}

             public function updateorder($id,$status)
 		{ 
			try {
				$updated_at = date("Y-m-d H:i:s");
				$conn = new PDO('mysql:host='.MYSQLDB_HOST.';dbname='.MYSQLDB_DATABASE.'', MYSQLDB_USER, MYSQLDB_PASS);
                                
				$query = $conn->prepare("update orders set status=:status,updated_at=:updated_at where id=:id");
                $query->execute(array(':status'=>$status,':id'=>$id,':updated_at'=>$updated_at));
			}
			catch (Exception $e) {
				die ('Error : ' . $e->getMessage());
			}
			
			return $query;
		}

			  public function updateorderitem($id)
 		{ 
			try {
				$updated_at = date("Y-m-d H:i:s");
				$conn = new PDO('mysql:host='.MYSQLDB_HOST.';dbname='.MYSQLDB_DATABASE.'', MYSQLDB_USER, MYSQLDB_PASS);
                                
				$query = $conn->prepare("update order_items set updated_at=:updated_at where order_id=:id");
                $query->execute(array(':id'=>$id,':updated_at'=>$updated_at));
			}
			catch (Exception $e) {
				die ('Error : ' . $e->getMessage());
			}
			
			return $query;
		}
			  public function addpayment($id,$price)
 		{ 
			try {
				$updated_at = date("Y-m-d H:i:s");
				$conn = new PDO('mysql:host='.MYSQLDB_HOST.';dbname='.MYSQLDB_DATABASE.'', MYSQLDB_USER, MYSQLDB_PASS);
                                
				$query = $conn->prepare("update user_detail set updated_at=:updated_at,payment=:price where order_id=:id");
                $query->execute(array(':id'=>$id,':updated_at'=>$updated_at,':price'=>$price));
			}
			catch (Exception $e) {
				die ('Error : ' . $e->getMessage());
			}
			
			return $query;
		}

			  public function getorderitembyid($id)
 		{ 
			try {
				$conn = new PDO('mysql:host='.MYSQLDB_HOST.';dbname='.MYSQLDB_DATABASE.'', MYSQLDB_USER, MYSQLDB_PASS);
                                
				$query = $conn->prepare("select * from order_items where order_id=:id");
                $query->execute(array(':id'=>$id));
			}
			catch (Exception $e) {
				die ('Error : ' . $e->getMessage());
			}
			
			return $query;
		}
		
			  public function getorderbyid($id)
 		{ 
			try {
				$conn = new PDO('mysql:host='.MYSQLDB_HOST.';dbname='.MYSQLDB_DATABASE.'', MYSQLDB_USER, MYSQLDB_PASS);
                                
				$query = $conn->prepare("select * from orders where id=:id");
                $query->execute(array(':id'=>$id));
			}
			catch (Exception $e) {
				die ('Error : ' . $e->getMessage());
			}
			
			return $query;
		}
		
			  public function getuseridbyorder($id)
 		{ 
			try {
				$conn = new PDO('mysql:host='.MYSQLDB_HOST.';dbname='.MYSQLDB_DATABASE.'', MYSQLDB_USER, MYSQLDB_PASS);
                                
				$query = $conn->prepare("select user.username,ord.* from user_detail user left join orders ord on user.order_id=ord.id where user.id=:id");
                $query->execute(array(':id'=>$id));
			}
			catch (Exception $e) {
				die ('Error : ' . $e->getMessage());
			}
			
			return $query;
		}
		
			  public function getorderbytoday()
 		{ 
			try {
				$date = date("Y-m-d");
				$conn = new PDO('mysql:host='.MYSQLDB_HOST.';dbname='.MYSQLDB_DATABASE.'', MYSQLDB_USER, MYSQLDB_PASS);
                     
				$query = $conn->prepare("select * from orders where DATE(created_at)=:date");
                $query->execute(array(':date'=>$date));
			}
			catch (Exception $e) {
				die ('Error : ' . $e->getMessage());
			}
			
			return $query;
		}
		
		  public function saveuserdetail($name,$email,$order_id)
 		{ 
			try {
				$date = date("Y-m-d");
				$conn = new PDO('mysql:host='.MYSQLDB_HOST.';dbname='.MYSQLDB_DATABASE.'', MYSQLDB_USER, MYSQLDB_PASS);
                     
				$query = $conn->prepare("insert into user_detail set order_id=:order_id,username=:username,useremail=:useremail");
                $query->execute(array(':order_id'=>$order_id,':username'=>$name,':useremail'=>$email));
			}
			catch (Exception $e) {
				die ('Error : ' . $e->getMessage());
			}
			
			return $query;
		}
            
}	


?>
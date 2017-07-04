<?php 

include_once("controls/config.php");
include 'controls/clsorders.php';
if($_GET['fun']=='updateorder')
{
	updateorder();
}else if($_GET['fun']=='cancelorder')
{
	cancelorder();
}else if($_GET['fun']=='getorder')
{
	getorder();
}else if($_GET['fun']=='today')
{
	today();
}else if($_GET['fun']=='payment')
{
	payment();
}else if($_GET['fun']=='getuseridbyorder')
{
	getuseridbyorder();
}
function updateorder()
{
	$id=$_POST['id'];
	$status=$_POST['status'];
	$jsonResponse=array();
	$obj = new Orders();
    $query1 = $obj->updateorder($id,$status);
	if($query1)
	{
		$query = $obj->updateorderitem($id);
	}
	
	if($query)
	{
	
		$data['status']='success';
		
	}else{
		
		$data['status']='failed';
		
	}
	array_push($jsonResponse,$data);
	echo json_encode($jsonResponse);
	
}
function cancelorder()
{
	$id=$_POST['id'];
	$status='cancelled';
	$jsonResponse=array();
	$obj = new Orders();
    $query1 = $obj->updateorder($id,$status);
	if($query1)
	{
		$query = $obj->updateorderitem($id);
	}
	
	if($query)
	{
	
		$data['status']='success';
		
	}else{
		
		$data['status']='failed';
		
	}
	array_push($jsonResponse,$data);
	echo json_encode($jsonResponse);
	
}

function getorder()
{
	$id=$_POST['id'];
	$jsonResponse=array();
	$jsonResponseitem=array();
	
	$obj = new Orders();
    $query = $obj->getorderbyid($id);
	$result=$query->fetch(PDO::FETCH_ASSOC);
	
	$data['email_id']=$result['email_id'];
	$data['created_at']=$result['created_at'];
	$data['updated_at']=$result['updated_at'];
	$data['status']=$result['status'];
	
	
    $queryitem = $obj->getorderitembyid($id);
	while($result1=$queryitem->fetch(PDO::FETCH_ASSOC))
	{
		$dataitem['name']=$result1['name'];
		$dataitem['price']=$result1['price'];
		$dataitem['quantity']=$result1['quantity'];
		array_push($jsonResponseitem,$dataitem);
	}
	
	
	$data['order_items']=$jsonResponseitem;
	array_push($jsonResponse,$data);
	echo json_encode($jsonResponse);
	
	
}

function today()
{
	
	$jsonResponse=array();
	$jsonResponseitem=array();
	
	$obj = new Orders();
    $query = $obj->getorderbytoday();
	$result=$query->fetch(PDO::FETCH_ASSOC);
	
	$data['email_id']=$result['email_id'];
	$data['created_at']=$result['created_at'];
	$data['updated_at']=$result['updated_at'];
	$data['status']=$result['status'];
	$id=$result['id'];
	
	
    $queryitem = $obj->getorderitembyid($id);
	while($result1=$queryitem->fetch(PDO::FETCH_ASSOC))
	{
		$dataitem['name']=$result1['name'];
		$dataitem['price']=$result1['price'];
		$dataitem['quantity']=$result1['quantity'];
		array_push($jsonResponseitem,$dataitem);
	}
	
	
	$data['order_items']=$jsonResponseitem;
	array_push($jsonResponse,$data);
	echo json_encode($jsonResponse);
}

function payment()
{
	$id=$_POST['id'];
	$price=$_POST['price'];
	$jsonResponse=array();
	$obj = new Orders(); 
	$query = $obj->addpayment($id,$price);
	if($query)
	{
	
		$data['status']='success';
		
	}else{
		
		$data['status']='failed';
		
	}
	array_push($jsonResponse,$data);
	echo json_encode($jsonResponse);
}


function getuseridbyorder()
{
	$id=$_POST['user_id'];
	$jsonResponse=array();
	$jsonResponseitem=array();
	
	$obj = new Orders();
	
	
    $query = $obj->getuseridbyorder($id);
	$result=$query->fetch(PDO::FETCH_ASSOC);
	
	$data['email_id']=$result['email_id'];
	$data['created_at']=$result['created_at'];
	$data['updated_at']=$result['updated_at'];
	$data['status']=$result['status'];
	
	
    $queryitem = $obj->getorderitembyid($id);
	while($result1=$queryitem->fetch(PDO::FETCH_ASSOC))
	{
		$dataitem['name']=$result1['name'];
		$dataitem['price']=$result1['price'];
		$dataitem['quantity']=$result1['quantity'];
		array_push($jsonResponseitem,$dataitem);
	}
	
	
	$data['order_items']=$jsonResponseitem;
	array_push($jsonResponse,$data);
	echo json_encode($jsonResponse);
	
	
}


?>
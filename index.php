<?php 

include_once("controls/config.php");
include 'controls/clsorders.php';
 
if(isset($_POST['submit']))
{
	$jsonResponse=array();
	$email=$_POST['email_id'];
	$username=$_POST['username'];
	$obj = new Orders();
    $order_id = $obj->saveorder($email);
	
	$userdetail = $obj->saveuserdetail($username,$email,$order_id);
	
    for($i=1;$i<=$_POST['numrows'];$i++)
    {
		 $name = $_POST['name'.$i];
		 $price = $_POST['price'.$i];
         $quantity = $_POST['quantity'.$i];
		
		$query=$obj->saveorderitem($name,$price,$quantity,$order_id);
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

?>
<form action="" method="POST">
<h2>Add Order</h2> 
<div class="input_fields_wrap"> 

<input type="hidden" name="numrows" id="numrows" value="1"> <br>
<label>User Detail</label></br></br></br>


<label>Name</label>

<input type="text" name="username" id="username" required>
<label>E-mail</label> 
<input type="text" name="email_id" id="email_id" required>
    </br></br></br></br>
	
    </br></br>
	
	<div><label>Product Name</label><label style="margin-left: 12%;">Price</label><label style="margin-left: 11%;">Quantity</label></div>
    <div><input type="text" name="name1" required>&nbsp;&nbsp;&nbsp;
	<input type="text" name="price1" required>&nbsp;&nbsp;&nbsp;
	<input type="text" name="quantity1" required>&nbsp;&nbsp;&nbsp;<button class="add_field_button">Add More</button></div>
  
</div>
  </br></br></br></br>
<input type="submit" name="submit">
</form>



<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script>
$(document).ready(function() {
    var max_fields      = 10; 
    var wrapper         = $(".input_fields_wrap");
    var add_button      = $(".add_field_button");
    
    var x = 1; 
    $(add_button).click(function(e){ 
	var numrows=$("#numrows").val();
           numrows=parseInt(numrows) + 1;
        e.preventDefault();
        if(x < max_fields){
            $(wrapper).append('<div style="margin-top:1%"><input type="text" name="name'+numrows+'" required>&nbsp;&nbsp;&nbsp;<input type="text" name="price'+numrows+'" required>&nbsp;&nbsp;&nbsp;<input type="text" name="quantity'+numrows+'" required>&nbsp;&nbsp;&nbsp;<a href="#" class="remove_field">Remove</a></div>'); 
        }
		
    $("#numrows").val(numrows); 
    });
	
	
    $(wrapper).on("click",".remove_field", function(e){ 
        e.preventDefault(); $(this).parent('div').remove(); x--;
		var numrows=$("#numrows").val();
           numrows=parseInt(numrows) - 1;
		   $("#numrows").val(numrows); 
    })
});
</script>
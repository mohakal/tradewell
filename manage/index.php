<?php 
error_reporting(1);
session_start();
//print_r($_SESSION);
	include('include/header.php');
	include('include/menu.php');
if(isset($_GET['page'])){
	$page=$_GET['page'];	
	if($_SESSION['type']=='user'){	
switch($page){
		case 'dashboard': $content= 'users/dashboard.php'; $title='Create New User';
		break;
		
		 case 'categories': $content= 'users/categories.php'; $title='New Sales';
		break; 
		 case 'products': $content= 'users/products.php'; $title='New Products';
		break;
		
		 case 'other_settings': $content= 'users/other_settings.php'; $title='File Upload';
		break;
		 case 'add_products': $content= 'users/add_products.php'; $title='File Upload';
		break;
		case 'edit_products': $content= 'users/edit_product.php'; $title='File Upload';
		break;
		default : $content='users/dashboard.php'; $title.='Dashboard';
		}
}
else{
	
}
}
else{
	if($_SESSION['type']=='user'){	
	$content='users/dashboard.php'; $title.='Dashboard';
	}
	else{
	}

}
echo $content;
 include($content);
	?>
              
                
               <?php include('include/footer.php');?>
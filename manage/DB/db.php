<?php
	date_default_timezone_set('Asia/Dacca');
	
	$servername = "localhost";
	$username = "webmpsid_tradewell";
	$password = "webmpsid_tradewell";
	
	// Create connection
	$conn = mysqli_connect($servername, $username, $password,'webmpsid_tradewell');
	
	
	// Check connection
	/* if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
		}
	echo "Connected successfully"; */
	function get_string_between($string, $start, $end){
		$string = " ".$string;
		$ini = strpos($string,$start);
		if ($ini == 0) return "";
		$ini += strlen($start);
		$len = strpos($string,$end,$ini) - $ini;
		return substr($string,$ini,$len);
	}
	function authentication($username,$password){
		//qry for user checking
		$value['authenticated']=0;
		$conn=$GLOBALS['conn'];
		$qry_string="SELECT * FROM users WHERE email='".mysqli_escape_string($conn,$username)."' AND password='".md5($password)."' AND status=1";
		$qry=mysqli_query($conn,$qry_string);
		if(mysqli_num_rows($qry)>0){
			$data=mysqli_fetch_array($qry);
			$value['authenticated']=1;
			$value['user_id']=$data['id'];
			$value['type']=$data['user_type'];
			$value['company_id']=$data['company_id'];
			
		}	
		return $value;
		
	}
	function get_menu(){
		$conn=$GLOBALS['conn'];
		$qry1=mysqli_query($conn,"SELECT * FROM categories WHERE TYPE=1 AND STATUS=1");
		$menu=array();
		while($d1=mysqli_fetch_array($qry1)){
			$cat1=$d1['name'];
			$qry2=mysqli_query($conn,"SELECT * FROM categories WHERE TYPE=2 AND STATUS=1 AND parent_id='".$d1['id']."'");
			$cat2=array();
			$product1=array();
			if(mysqli_num_rows($qry2)>0){
				while($d2=mysqli_fetch_array($qry2)){
					//$cat2=$d2['name'];
					$qry3=mysqli_query($conn,"SELECT * FROM categories WHERE TYPE=3 AND STATUS=1 AND parent_id='".$d2['id']."'");
					$cat3=array();
					$product2=array();
					if(mysqli_num_rows($qry3)>0){
						while($d3=mysqli_fetch_array($qry3)){
							//$cat3=$d3['name'];
							$qry4=mysqli_query($conn,"SELECT * FROM products WHERE  STATUS=1 AND category_id='".$d3['id']."'");
							$product=array();
							while($d4=mysqli_fetch_array($qry4)){
								$id=$d4['id'];
								$product[$id]['fname']=$d4['first_name'];
								$product[$id]['lname']=$d4['second_name'];
								$product[$id]['id']=$id;
							}
							$id=$d3['id'];
							$cat3[$id]['name']=$d3['name'];
							$cat3[$id]['type']=$d3['type'];
							$cat3[$id]['products']=$product;
						}
					}
					else{
						$qry4=mysqli_query($conn,"SELECT * FROM products WHERE  STATUS=1 AND category_id='".$d2['id']."'");
						
						while($d4=mysqli_fetch_array($qry4)){
							$id=$d4['id'];
							$product2[$id]['fname']=$d4['first_name'];
							$product2[$id]['lname']=$d4['second_name'];
							$product2[$id]['id']=$id;
						}
					}
					$id=$d2['id'];
					$cat2[$id]['name']=$d2['name'];
					$cat2[$id]['type']=$d2['type'];
					$cat2[$id]['sub_item']=$cat3;
					$cat2[$id]['products']=$product2;
				}
			}
			else{
				$qry4=mysqli_query($conn,"SELECT * FROM products WHERE  STATUS=1 AND category_id='".$d1['id']."'");
				
				while($d4=mysqli_fetch_array($qry4)){
					$id=$d4['id'];
					$product1[$id]['fname']=$d4['first_name'];
					$product1[$id]['lname']=$d4['second_name'];
					$product1[$id]['id']=$id;
				}
			}
			$id=$d1['id'];
			$menu[$id]['name']=$d1['name'];
			$menu[$id]['type']=$d1['type'];
			$menu[$id]['sub_item']=$cat2;
			$menu[$id]['products']=$product1;
		}
		
		return $menu;
	}
	function get_brands(){
		$conn=$GLOBALS['conn'];
		$qry1=mysqli_query($conn,"SELECT * FROM brands WHERE status=1");
		$i=1;
		while($d1=mysqli_fetch_array($qry1)){
			$return[$i]['url']=$d1['url'];
			$return[$i]['image']=$d1['image_location'];
			$i++;
		}
		return $return;
	}
	function product_details($id){
		$conn=$GLOBALS['conn'];
		//get links breadcumbs
		$qry_str1="SELECT a.*,COALESCE(b.name,'none') AS subsubcat,COALESCE(c.name,'none') AS subcat,COALESCE(d.name,'none') AS  cat FROM products AS a
		LEFT JOIN categories AS b ON a.category_id=b.id
		LEFT JOIN categories AS c ON b.parent_id=c.id
		LEFT JOIN categories AS d ON c.parent_id=d.id
		WHERE a.id='".$id."' LIMIT 1";
		$qry1=mysqli_query($conn,$qry_str1);	
		$d1=mysqli_fetch_array($qry1);
		$return['product_name']=$d1['first_name'];
		if($d1['cat']!='none'){
			$return['bread']='Product/'.$d1['cat'].'/'.$d1['subcat'].'/'.$d1['subsubcat'].'/'.$d1['first_name'];
			
		}
		elseif($d1['cat']=='none' AND $d1['subcat']!='none'){
			$return['bread']='Product/'.$d1['subcat'].'/'.$d1['subsubcat'].'/'.$d1['first_name'];
			
		}
		else{
			$return['bread']='Product/'.$d1['subsubcat'].'/'.$d1['first_name'];
			
		}
		$return['company_logo']=$d1['company_image'];
		$return['measurement']=$d1['measurements'];
		$return['price']=$d1['price'];
		//further_information
		$return['further_information']=$d1['further_information'];
		$return['product_details']=$d1['product_details'];
		$return['other_information']=$d1['other_information'];
		//features
		$qry_str2="SELECT b.image  as name FROM product_features AS a
		LEFT JOIN features AS b ON a.feature_id=b.id
		WHERE a.product_id='".$id."' AND a.status='1'";
		$qry2=mysqli_query($conn,$qry_str2);
		while($d2=mysqli_fetch_array($qry2)){
			$features[]=$d2['name'];
		}
		$return['features']=$features;
		//images
		$qry_str3="SELECT * FROM product_images WHERE product_id='".$id."'";
		$qry3=mysqli_query($conn,$qry_str3);
		$i=1;
		while($d3=mysqli_fetch_array($qry3)){
			$images[$i]['image']=$d3['image'];
			$images[$i]['timage']=$d3['thumb_image'];
			$i++;
		}
		$return['images']=$images;
		return $return;
		
	}
	function products(){
		$conn=$GLOBALS['conn'];
		$qry_str1="
		SELECT a.*,COALESCE(b.name,'none') AS subsubcat,COALESCE(c.name,'none') AS subcat,COALESCE(d.name,'none') AS  cat,e.image,e.thumb_image FROM products AS a
		LEFT JOIN categories AS b ON a.category_id=b.id
		LEFT JOIN categories AS c ON b.parent_id=c.id
		LEFT JOIN categories AS d ON c.parent_id=d.id
		LEFT JOIN (
		SELECT * FROM product_images GROUP BY product_id ORDER BY id ASC		
		) AS e ON a.id=e.product_id";
		$qry1=mysqli_query($conn,$qry_str1);
		$i=1;
		
		while($d1=mysqli_fetch_array($qry1)){
			$return[$i]['id']=$d1['id'];
			$return[$i]['product_name']=$d1['first_name'];
			
			$return[$i]['image']=$d1['image'];
			if($d1['cat']!='none'){
				$return[$i]['cat']=$d1['cat'];
			}
			elseif($d1['cat']=='none' AND $d1['subcat']!='none' ){
				$return[$i]['cat']=$d1['subcat'];
			}
			else{
				$return[$i]['cat']=$d1['subsubcat'];
			}
			
			$return[$i]['price']=$d1['price'];
			$return[$i]['star']=$d1['star'];
			$i++;
		}
		return $return;
		
	}
		function products_search($p){
		$conn=$GLOBALS['conn'];
		$qry_str1="
		SELECT a.*,COALESCE(b.name,'none') AS subsubcat,COALESCE(c.name,'none') AS subcat,COALESCE(d.name,'none') AS  cat,e.image,e.thumb_image FROM products AS a
		LEFT JOIN categories AS b ON a.category_id=b.id
		LEFT JOIN categories AS c ON b.parent_id=c.id
		LEFT JOIN categories AS d ON c.parent_id=d.id
		LEFT JOIN (
		SELECT * FROM product_images GROUP BY product_id ORDER BY id ASC		
		) AS e ON a.id=e.product_id WHERE a.first_name LIKE '%".mysqli_escape_string($conn,$p)."%'";
		$qry1=mysqli_query($conn,$qry_str1);
		$i=1;
		
		while($d1=mysqli_fetch_array($qry1)){
			$return[$i]['id']=$d1['id'];
			$return[$i]['product_name']=$d1['first_name'];
			
			$return[$i]['image']=$d1['image'];
			if($d1['cat']!='none'){
				$return[$i]['cat']=$d1['cat'];
			}
			elseif($d1['cat']=='none' AND $d1['subcat']!='none' ){
				$return[$i]['cat']=$d1['subcat'];
			}
			else{
				$return[$i]['cat']=$d1['subsubcat'];
			}
			
			$return[$i]['price']=$d1['price'];
			$return[$i]['star']=$d1['star'];
			$i++;
		}
		return $return;
		
	}
	function get_categories(){
		$conn=$GLOBALS['conn'];
		$qry_str1="SELECT * FROM categories WHERE TYPE='1'";
		$qry1=mysqli_query($conn,$qry_str1);
		$i=1;
		while($d1=mysqli_fetch_array($qry1)){
			$return[$i]=$d1;
			$i++;
		}
		return $return;
	}
	function get_sub_categories(){
		$conn=$GLOBALS['conn'];
		$qry_str1="SELECT a.*,b.name AS cat FROM categories AS a 
		LEFT JOIN categories AS b ON a.parent_id=b.id
		WHERE a.type='2'";
		$qry1=mysqli_query($conn,$qry_str1);
		$i=1;
		while($d1=mysqli_fetch_array($qry1)){
			$return[$i]=$d1;
			$i++;
		}
		return $return;
	}
	function get_sub_categories_id($id){
		$conn=$GLOBALS['conn'];
		$qry_str1="SELECT a.*,b.name AS cat FROM categories AS a 
		LEFT JOIN categories AS b ON a.parent_id=b.id
		WHERE a.type='2' AND a.parent_id='".$id."'";
		$qry1=mysqli_query($conn,$qry_str1);
		$i=1;
		while($d1=mysqli_fetch_array($qry1)){
			$return[$i]=$d1;
			$i++;
		}
		return $return;
	}
	
	function get_sub_sub_categories(){
		$conn=$GLOBALS['conn'];
		$qry_str1="SELECT a.*,b.name AS subcat,c.name AS cat FROM categories AS a 
		LEFT JOIN categories AS b ON a.parent_id=b.id
		LEFT JOIN categories AS c ON b.parent_id=c.id
		WHERE a.type='3'";
		$qry1=mysqli_query($conn,$qry_str1);
		$i=1;
		while($d1=mysqli_fetch_array($qry1)){
			$return[$i]=$d1;
			$i++;
		}
		return $return;
	}
	function get_sub_sub_categories_id($id){
		$conn=$GLOBALS['conn'];
		$qry_str1="SELECT a.*,b.name AS subcat,c.name AS cat FROM categories AS a 
		LEFT JOIN categories AS b ON a.parent_id=b.id
		LEFT JOIN categories AS c ON b.parent_id=c.id
		WHERE a.type='3' AND a.parent_id='".$id."'";
		$qry1=mysqli_query($conn,$qry_str1);
		$i=1;
		while($d1=mysqli_fetch_array($qry1)){
			$return[$i]=$d1;
			$i++;
		}
		return $return;
	}
	function products_for_manage(){
		$conn=$GLOBALS['conn'];
		$qry_str1="
		SELECT a.*,b.name AS subsubcat,c.name AS subcat,d.name AS  cat,e.image,e.thumb_image FROM products AS a
		LEFT JOIN categories AS b ON a.category_id=b.id
		LEFT JOIN categories AS c ON b.parent_id=c.id
		LEFT JOIN categories AS d ON c.parent_id=d.id
		LEFT JOIN (
		SELECT * FROM product_images GROUP BY product_id ORDER BY id ASC		
		) AS e ON a.id=e.product_id";
		$qry1=mysqli_query($conn,$qry_str1);
		$i=1;
		
		while($d1=mysqli_fetch_array($qry1)){
			$return[$i]['id']=$d1['id'];
			$return[$i]['product_name']=$d1['first_name'];
			$return[$i]['subsubcat']=$d1['subsubcat'];
			$return[$i]['subcat']=$d1['subcat'];
			$return[$i]['image']=$d1['image'];
			$return[$i]['cat']=$d1['cat'];
			$return[$i]['price']=$d1['price'];
			$return[$i]['status']=$d1['status'];
			$i++;
		}
		return $return;
	} 
	function get_slider_images(){
		$conn=$GLOBALS['conn'];
		$qry_str1="SELECT * FROM slider";
		$qry1=mysqli_query($conn,$qry_str1);
		$i=1;
		while($d1=mysqli_fetch_array($qry1)){
			$return[$i]=$d1;
			$i++;
		}
		return $return;
	}
	function get_brands_formanage(){
		$conn=$GLOBALS['conn'];
		$qry_str1="SELECT * FROM brands";
		$qry1=mysqli_query($conn,$qry_str1);
		$i=1;
		while($d1=mysqli_fetch_array($qry1)){
			$return[$i]=$d1;
			$i++;
		}
		return $return;
	}
	function get_cat_childs($parent_id,$child){
		$conn=$GLOBALS['conn'];
		$return=array();
		//echo "SELECT * FROM categories WHERE parent_id='".$parent_id."'";
		$qry1=mysqli_query($conn,"SELECT * FROM categories WHERE parent_id='".$parent_id."'");
		$i=1;
		while($d1=mysqli_fetch_array($qry1)){
			$return[$i]=$d1;
			$i++;
		}
		return $return;
	}
	function add_product($data){
		$conn=$GLOBALS['conn'];
		$qry_str1="INSERT into products(category_id,
		first_name,
		second_name,
		company_image,
		measurements,
		price,
		status,
		further_information,
		product_details,
		other_information,
		star,
		add_datetime,
		added_by)
		VALUES(
		'".$data['category_id']."',
		'".$data['first_name']."',
		'".$data['second_name']."',
		'".$data['company_image']."',
		'".$data['measurements']."',
		'".$data['price']."',
		'".$data['status']."',
		'".$data['further_information']."',
		'".$data['product_details']."',
		'".$data['other_information']."',
		'".$data['star']."',
		'".$data['add_datetime']."',
		'".$data['added_by']."'
		)
		
		";
		$qry1=mysqli_query($conn,$qry_str1);
		$product_id=mysqli_insert_id($conn);
		//insert in product images
		$indert='';
		foreach($data['product_images'] AS $index=>$val){
			$insert.="('".$product_id."','".$val['l']."','".$val['s']."','1','".date('Y-m-d h:i:s')."','".$data['added_by']."'),";
		}
		$qry_str2="INSERT into product_images(
		product_id,
		image,
		thumb_image,
		status,
		add_datetime,
		added_by)
		VALUES 
		".rtrim($insert,',');
		$qry2=mysqli_query($conn,$qry_str2);
		echo mysqli_error($conn);
		//feature entry
		$qry3=mysqli_query($conn,"INSERT into features (image,status,add_datetime,added_by) VALUES(
		'".$data['features']."','1','".date('Y-m-d h:i:s')."','".$data['added_by']."'
		)");
		$feature_id=mysqli_insert_id($conn);
		$qry4=mysqli_query($conn,"INSERT into product_features(feature_id,product_id,status,added_by,add_datetime)
		VALUES('".$feature_id."','".$product_id."','1','".$data['added_by']."','".date('Y-m-d h:i:s')."')");
	}
	function add_category($data){
		$conn=$GLOBALS['conn'];
		$return=0;
		$qry=mysqli_query($conn,"INSERT into categories (
		type,
		parent_id,
		name,
		add_datetime,
		added_by,
		status) VALUES ('".$data['type']."',
		'".$data['parent_id']."',
		'".$data['name']."',
		'".$data['add_datetime']."',
		'".$data['added_by']."',
		'".$data['status']."')");
		if($qry){
			$return=1;
		}
		return $return;
	}
	function delete_cat($id){
		$conn=$GLOBALS['conn'];
		$qrys1=mysqli_query($conn,"SELECT id FROM categories WHERE parent_id='".$id."'");
		$s1='';
		while($ds1=mysqli_fetch_array($qrys1)){
			$s1.=$ds1['id'].',';
		}
		$s1=rtrim($s1,',');
		//echo "DELETE * FROM categories WHERE parent_id IN (".$s1.")";
		$qry1=mysqli_query($conn,"DELETE  FROM categories WHERE parent_id IN (".$s1.")");
		$qry2=mysqli_query($conn,"DELETE  FROM categories WHERE  parent_id='".$id."' ");
		$qry3=mysqli_query($conn,"DELETE  FROM categories WHERE id='".$id."' ");
	}
	function delete_product($id){
		$conn=$GLOBALS['conn'];
		
		$qry=mysqli_query($conn,"DELETE FROM products WHERE id='".$id."'");
		$qry=mysqli_query($conn,"DELETE FROM product_features WHERE product_id='".$id."'");
		$qry=mysqli_query($conn,"DELETE FROM product_images WHERE product_id='".$id."'");
	}
	function change_cat_status($id,$n){
		$conn=$GLOBALS['conn'];
		$qrys1=mysqli_query($conn,"UPDATE categories SET status='".$n."' WHERE id='".$id."'");
		
	}
	function change_brand_status($id,$n){
		$conn=$GLOBALS['conn'];
		$qrys1=mysqli_query($conn,"UPDATE brands SET status='".$n."' WHERE id='".$id."' LIMIT 1");
		
	}
	function delete_brand($id){
		$conn=$GLOBALS['conn'];
		$qrys1=mysqli_query($conn,"DELETE FROM  brands WHERE id='".$id."' LIMIT 1");
		
	}
	function add_brand($data){
		$conn=$GLOBALS['conn'];
		$qrys1=mysqli_query($conn,"INSERT into  brands (name,image_location,status,add_datetime,added_by) VALUES (
		'".$data['name']."','".$data['image_loaction']."','".$data['status']."','".$data['add_datetime']."','".$data['added_by']."'
		)");
		$r=0;
		if($qrys1){
			$r=1;
		}
		return $r;
	}
	function product_details_fro_edit($id){
		$conn=$GLOBALS['conn'];
		//get links breadcumbs
		$qry_str1="SELECT a.*,COALESCE(b.id,'none') AS subsubcat,COALESCE(c.id,'none') AS subcat,COALESCE(d.id,'none') AS  cat FROM products AS a
		LEFT JOIN categories AS b ON a.category_id=b.id
		LEFT JOIN categories AS c ON b.parent_id=c.id
		LEFT JOIN categories AS d ON c.parent_id=d.id
		WHERE a.id='".$id."' LIMIT 1";
		$qry1=mysqli_query($conn,$qry_str1);	
		$d1=mysqli_fetch_array($qry1);
		$return['product_name']=$d1['first_name'];
		$return['product_lname']=$d1['second_name'];
		if($d1['cat']!='none'){
			$return['bread']='Product/'.$d1['cat'].'/'.$d1['subcat'].'/'.$d1['subsubcat'].'/'.$d1['first_name'];
			$return['cat']=$d1['cat'];
			$return['subcat']=$d1['subcat'];
			$return['subsubcat']=$d1['subsubcat'];
		}
		elseif($d1['cat']=='none' AND $d1['subcat']!='none'){
			$return['bread']='Product/'.$d1['subcat'].'/'.$d1['subsubcat'].'/'.$d1['first_name'];
			$return['cat']=$d1['subcat'];
			$return['subcat']=$d1['subsubcat'];
			$return['subsubcat']='none';
		}
		else{
			$return['bread']='Product/'.$d1['subsubcat'].'/'.$d1['first_name'];
			$return['cat']=$d1['subsubcat'];
			$return['subcat']='none';
			$return['subsubcat']='none';
			
		}
		$return['company_logo']=$d1['company_image'];
		$return['star']=$d1['star'];
		$return['measurement']=$d1['measurements'];
		$return['price']=$d1['price'];
		//further_information
		$return['further_information']=$d1['further_information'];
		$return['product_details']=$d1['product_details'];
		$return['other_information']=$d1['other_information'];
		//features
		$qry_str2="SELECT b.image  as name FROM product_features AS a
		LEFT JOIN features AS b ON a.feature_id=b.id
		WHERE a.product_id='".$id."' AND a.status='1'";
		$qry2=mysqli_query($conn,$qry_str2);
		while($d2=mysqli_fetch_array($qry2)){
			$features[]=$d2['name'];
		}
		$return['features']=$features;
		//images
		$qry_str3="SELECT * FROM product_images WHERE product_id='".$id."'";
		$qry3=mysqli_query($conn,$qry_str3);
		$i=1;
		while($d3=mysqli_fetch_array($qry3)){
			$images[$i]['image']=$d3['image'];
			$images[$i]['timage']=$d3['thumb_image'];
			$i++;
		}
		$return['images']=$images;
		return $return;
		
	}
	function update_product($data){
		$conn=$GLOBALS['conn'];
		if($data['comapny_image_exist']==1){
			$qry_str1="UPDATE products SET category_id='".$data['category_id']."',
			first_name='".$data['first_name']."',
			second_name='".$data['second_name']."',
			company_image='".$data['company_image']."',
			measurements='".$data['measurements']."',
			price='".$data['price']."',
			
			further_information='".$data['further_information']."',
			product_details='".$data['product_details']."',
			other_information='".$data['other_information']."',
			star='".$data['star']."',
			add_datetime='".$data['add_datetime']."',
			added_by='".$data['added_by']."'
			WHERE id='".$data['product_id']."'
			
			";
		}
		else{
			$qry_str1="UPDATE products SET category_id='".$data['category_id']."',
			first_name='".$data['first_name']."',
			second_name='".$data['second_name']."',
			
			measurements='".$data['measurements']."',
			price='".$data['price']."',
			
			further_information='".$data['further_information']."',
			product_details='".$data['product_details']."',
			other_information='".$data['other_information']."',
			star='".$data['star']."',
			add_datetime='".$data['add_datetime']."',
			added_by='".$data['added_by']."'
			WHERE id='".$data['product_id']."'
			
			";
			
			
		}
		$qry1=mysqli_query($conn,$qry_str1);
		if($data['product_image_exist']==1){
		
		$qryd=mysqli_query($conn,"DELETE FROM product_images WHERE product_id='".$data['product_id']."'");
		
		}
		$product_id=$data['product_id'];
			//insert in product images
			$indert='';
			foreach($data['product_images'] AS $index=>$val){
			$insert.="('".$product_id."','".$val['l']."','".$val['s']."','1','".date('Y-m-d h:i:s')."','".$data['added_by']."'),";
			}
			$qry_str2="INSERT into product_images(
			product_id,
			image,
			thumb_image,
			status,
			add_datetime,
			added_by)
			VALUES 
			".rtrim($insert,',');
			$qry2=mysqli_query($conn,$qry_str2);
			echo mysqli_error($conn);
			//feature entry
			
			
			$qry3=mysqli_query($conn,"INSERT into features (image,status,add_datetime,added_by) VALUES(
			'".$data['features']."','1','".date('Y-m-d h:i:s')."','".$data['added_by']."'
			)");
			$feature_id=mysqli_insert_id($conn);
			$qry_dlt=mysqli_query($conn,"DELETE FROM product_features WHERE product_id='".$data['product_id']."'");
			
			$qry4=mysqli_query($conn,"INSERT into product_features(feature_id,product_id,status,added_by,add_datetime)
			VALUES('".$feature_id."','".$data['product_id']."','1','".$data['added_by']."','".date('Y-m-d h:i:s')."')");
			}
		function change_user_status($user_id){
			$conn=$GLOBALS['conn'];
			$qry1=mysqli_query($conn,"SELECT status FROM user WHERE user_id='".$user_id."' LIMIT 1");
			$d1=mysqli_fetch_array($qry1);
			if($d1['status']=='1'){
				$val=0;
			}
			else{
				$val=1;
			}
			$update=mysqli_query($conn,"UPDATE  user SET status='".$val."' WHERE user_id='".$user_id."' LIMIT 1");
		}
		function change_product_status($id,$n){
		$conn=$GLOBALS['conn'];
		$qrys1=mysqli_query($conn,"UPDATE products SET status='".$n."' WHERE id='".$id."'");
		
	}
		function get_user_info_by_id($user_id){
			$conn=$GLOBALS['conn'];
			$qry1=mysqli_query($conn,"SELECT * FROM user WHERE user_id='".$user_id."' LIMIT 1");
			$d1=mysqli_fetch_array($qry1);
			return $d1;
		}
		function change_password($zxy,$npassword){
			$conn=$GLOBALS['conn'];
			$qry1=mysqli_query($conn,"UPDATE user SET password='".md5($npassword)."' WHERE user_id='".$zxy."' LIMIT 1");
			$return=mysqli_affected_rows($conn);
			return $return;
		}
?>			
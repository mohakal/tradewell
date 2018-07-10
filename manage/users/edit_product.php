<?php
	define ("MAX_SIZE","10000"); 
	function getExtension2($str) 
	{
		$i = strrpos($str,".");
		if (!$i) { return ""; }
		$l = strlen($str) - $i;
		$ext = substr($str,$i+1,$l);
		return $ext;
	}
	if(isset($_POST['submit'])){
	
	$product_images=array();
		// Count # of uploaded files in array
	$total = count($_FILES['product_images']['name']);
		$product_images=array();
		if(file_exists($_FILES['product_images']['tmp_name'][0]) || is_uploaded_file($_FILES['product_images']['tmp_name'][0])) {
		$data['product_image_exist']=1;
		
		// Loop through each file
		for( $i=0 ; $i < $total ; $i++ ) {
			
			//Get the temp file path
			$tmpFilePath = $_FILES['product_images']['tmp_name'][$i];
			
			//Make sure we have a file path
			if ($tmpFilePath != ""){
				//echo $tmpFilePath;
				//Setup our new file path
				$extension = getExtension2(stripslashes($_FILES['product_images']['name'][$i]));
				$newFilePath1="img/".date("Y-m-d-His")."_pdoduct_image_".$i.".".$extension;
				$newFilePath = "../".$newFilePath1;
				$newFilePath21="img/".date("Y-m-d-His")."_pdoduct_image_".$i."_s.".$extension;
				$newFilePath2 = "../".$newFilePath21;
				$product_images[$i]['l']=$newFilePath1;
				$product_images[$i]['s']=$newFilePath21;
				//Upload the file into the temp dir
				//copy($tmpFilePath, $newFilePath);
				/* if(move_uploaded_file($tmpFilePath, $newFilePath)) {
					$product_images[$i]=$newFilePath1;
					echo $img = resize_image($newFilePath, 200, 200);
					echo copy($img,"1.jpg");
					//Handle other code here
					
				} */
				/* else{
					echo "can move";
				} */
				if($extension=="jpg" || $extension=="jpeg" )
				{
					
					$src = imagecreatefromjpeg($tmpFilePath);
				}
				else if($extension=="png")
				{
					
					$src = imagecreatefrompng($tmpFilePath);
				}
				else 
				{
					$src = imagecreatefromgif($tmpFilePath);
				}
				
				
				
				list($width,$height)=getimagesize($tmpFilePath);
				
				$newwidth=474;
				$newheight=388;
				$tmp=imagecreatetruecolor($newwidth,$newheight);
				$newwidth1=50;
				$newheight1=36;
				$tmp1=imagecreatetruecolor($newwidth1,$newheight1);
				
				imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight, $width,$height);
				imagecopyresampled($tmp1,$src,0,0,0,0,$newwidth1,$newheight1, $width,$height);
				
				
				$image_location=$filename = "2.jpg";
				$thumb_location=$filename1 = "3.jpg";
				
				imagejpeg($tmp,$newFilePath,474);
				imagejpeg($tmp1,$newFilePath2,50);
				
				imagedestroy($src);
				imagedestroy($tmp);
				imagedestroy($tmp1);
			}
		}
	}
		else{
		$data['product_image_exist']=0;
		}
		$newname1='';
		if(file_exists($_FILES['company_image']['tmp_name']) || is_uploaded_file($_FILES['company_image']['tmp_name'])) {
		$data['comapny_image_exist']=1;
		$exfile=$_FILES['company_image']['name'];
		$filename = stripslashes($_FILES['company_image']['name']);
		
		$extension = getExtension2($filename);
		if($extension=="jpg" || $extension=="jpeg" )
		{
			
			$src = imagecreatefromjpeg($_FILES['company_image']['tmp_name']);
		}
		else if($extension=="png")
		{
			
			$src = imagecreatefrompng($_FILES['company_image']['tmp_name']);
		}
		else 
		{
			$src = imagecreatefromgif($_FILES['company_image']['tmp_name']);
		}
		$newname1="img/".date("Y-m-d-His")."_company_logo.".$extension;
		$newname="../".$newname1;
		list($width,$height)=getimagesize($_FILES['company_image']['tmp_name']);
		
		$newwidth=211;
		$newheight=($height/$width)*$newwidth;
		$tmp=imagecreatetruecolor($newwidth,$newheight);
		
		
		imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight, $width,$height);
		
		
		
		
		imagejpeg($tmp,$newname,211);
		
		
		imagedestroy($src);
		imagedestroy($tmp);
		}
		else{
		$data['comapny_image_exist']=0;
		
		}
		//echo $_FILES['company_image']['tmp_name'];
		//move_uploaded_file($_FILES['company_image']['tmp_name'], $newname);
		$cat_id='';
		if($_POST['subsubcat']!='none'){
			$cat_id=$_POST['subsubcat'];
		}
		elseif($_POST['subsubcat']=='none' AND $_POST['subcat']!='none'){
			$cat_id=$_POST['subcat'];	
		}
		else{
			$cat_id=$_POST['cat_id'];
		}
		$data['category_id']=$cat_id;
		$data['product_id']=$_POST['product_id'];
		$data['first_name']=$_POST['first_name'];
		$data['second_name']=$_POST['second_name'];
		$data['company_image']=$newname1;
		$data['measurements']=$_POST['measurements'];
		$data['status']=1;
		$data['further_information']=$_POST['further_information'];
		$data['product_details']=$_POST['product_details'];
		$data['other_information']=$_POST['other_information'];
		$data['star']=$_POST['star'];
		$data['add_datetime']=date('Y-m-d h:i:s');
		$data['added_by']=$_SESSION['user_id'];
		$data['price']=$_POST['price'];
		$data['product_images']=$product_images;
		$data['features']=$_POST['product_features'];
		//print_r($data);
		$add_product=update_product($data);
		//print_r($_POST);
		
		/* $entry=add_purchase($data);
			if($entry){
			echo "<script>alert('Entry Successful');</script>";
			}
			else{
			echo "<script>alert('Error!!!');</script>";
		} */
	}
	$product_detais=product_details_fro_edit($_GET['id']);
	
?>
<script src="https://cdn.ckeditor.com/ckeditor5/10.0.1/classic/ckeditor.js"></script>
<article class="content dashboard-page" style="overflow:scroll;">
	<section class="section">
		<div class="row sameheight-container">
			
			<div class="col col-12 col-sm-12 col-md-12 col-xl-12 history-col">
				<div class="card sameheight-item" data-exclude="xs" id="dashboard-history">
					<div class="card-header card-header-sm bordered">
						<div class="header-block">
							<h3 class="title">Edit Products</h3>
							
						</div>
						<ul class="nav nav-tabs pull-right" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" href="#visits" role="tab" data-toggle="tab">New</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#downloads" role="tab" data-toggle="tab">Upload</a>
							</li>
						</ul>
					</div>
					<div class="card-block">
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane active fade show" id="visits">
								<form action="" method="post" enctype="multipart/form-data">
								<input type="hidden" name="product_id" value="<?php echo $_GET['id'];?>">
									<div class="row">
										<div class="col-md-6">
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label class="control-label">Select Category</label>
														<select class="form-control boxed" name="cat_id" onchange="set_child(this.value,'subcat')">
															<option value="">Select</option>
															<?php
																$cat=get_categories();
																foreach($cat AS $index=>$val){
																	$s='';
																	if($val['id']==$product_detais['cat']){
																	$s='selected';
																	}
																	echo "<option value='".$val['id']."' ".$s.">".$val['name']."</option>";
																}
															?>
														</select>
													</div>
												</div>
											</div>
											<?php if($product_detais['subcat']!='none')
											{
												?>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group" id="subcat" >
													<label class="control-label">Sub Category</label>
														<select class="form-control boxed" name="subcat" onchange="set_child(this.value,'subsubcat')" required>
															<option value="">Select</option>
															<?php
																$cat=get_sub_categories_id($product_detais['cat']);
																foreach($cat AS $index=>$val){
																	$s='';
																	if($val['id']==$product_detais['subcat']){
																	$s='selected';
																	}
																	echo "<option value='".$val['id']."' ".$s.">".$val['name']."</option>";
																}
															?>
														</select>
													</div>
												</div>
											</div>	
										<?php
											}
											else{
											?>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group" id="subcat" >
													<label class="control-label">Sub Category</label>
														<select class="form-control boxed" name="subcat" onchange="set_child(this.value,'subsubcat')" required>
															<option value="">Select</option>
															
															<option value="none" selected>none</option>
														</select>
													</div>
												</div>
											</div>
											<?php }?>
											<?php if($product_detais['subsubcat']!='none')
											{
												?>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group" id="subsubcat" >
													<label class="control-label">Sub SUB Category</label>
														<select class="form-control boxed" name="subsubcat" required>
															<option value="">Select</option>
															<?php
																$cat=get_sub_sub_categories_id($product_detais['subcat']);
																foreach($cat AS $index=>$val){
																	$s='';
																	if($val['id']==$product_detais['subsubcat']){
																	$s='selected';
																	}
																	echo "<option value='".$val['id']."' ".$s.">".$val['name']."</option>";
																}
															?>
														</select>
													</div>
												</div>
											</div>
											<?php
											}
											else{
											?>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group" id="subsubcat" >
													<label class="control-label">Sub SUB Category</label>
														<select class="form-control boxed" name="subsubcat" required>
															<option value="">Select</option>
															<option value="none" selected>none</option>
															
														</select>
													</div>
												</div>
											</div>
											<?php }?>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label class="control-label">Fist Name</label>
													<input class="form-control boxed"  type="text" name="first_name" value="<?php echo $product_detais['product_name'];?>"> </div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label class="control-label">Last Name</label>
													<input class="form-control boxed"  type="text" name="second_name" value="<?php echo $product_detais['product_lname'];?>"> </div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label class="control-label">Company Logo</label>
														<br/>
														<img src="<?php echo "../".$product_detais['company_logo'];?>">
														<br/>
													<input class="form-control boxed"  type="file" name="company_image"> </div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label class="control-label">Measurements</label>
														
													<input  class="form-control boxed"  type="text" name="measurements" value="<?php echo $product_detais['measurement'];?>"> </div>
												</div>
											</div>
											
											
										</div>
										<div class="col-md-6">
											<!--	<div class="form-group">
												<label class="control-label">Supply Location</label>
												<input class="form-control boxed" type="text" name="supply_location" name="supply_location"> </div>
												--><div class="form-group">
												<label class="control-label">Price</label>
											<input class="form-control boxed" type="number" name="price" value="<?php echo $product_detais['price'];?>"> </div>
											<div class="form-group">
												<label class="control-label">Star</label>
											<input class="form-control boxed"  type="number" name="star" value="<?php echo $product_detais['star'];?>"> </div>
											<!--			<div class="form-group">
												<label class="control-label">Discount</label>
												<input  class="form-control boxed"  type="number" name="discount"> </div>
												
												-->	<div class="form-group">
												<label class="control-label">Product Images</label>
												<br/>
												<?php
													foreach($product_detais['images'] AS $i=>$v){
													echo "<img src='../".$v['image']."' width='200px'><br/>";
													}
													
													?>
											<input  class="form-control boxed"  type="file" name="product_images[]" multiple="multiple"/>
											</div>
											<div class="form-group">
												<label class="control-label">Product Features</label>
												<!--<input class="form-control boxed"  type="text" name="product_features"> --> 
												<textarea  id="editor4" rows="3" class="form-control boxed" style="height: 146px;" name="product_features"><?php echo $product_detais['features'][0];?></textarea>
											</div>
											<!--	<div class="form-group">
												<label class="control-label">Remarks</label>
												<textarea rows="3" class="form-control boxed" name="remark"></textarea>
												</div>
											-->	
										</div>
										
										
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Further Information</label>
												<textarea rows="10" id="editor" rows="3" class="form-control boxed" style="height: 146px;" name="further_information"><?php echo $product_detais['further_information'];?></textarea>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Product Details</label>
												<textarea rows="10" id="editor2" class="form-control boxed" name="product_details"><?php echo $product_detais['product_details'];?></textarea>
											</div>
										</div>
									</div>	
									<div class="row">
										
									</div>	
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Other Information</label>
												<textarea rows="10" id="editor3" class="form-control boxed" name="other_information"><?php echo $product_detais['other_information'];?></textarea>
											</div>
										</div>
									</div>	
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<button type="submit" name="submit" class="btn btn-primary">Submit</button>
											</div>
										</div>
									</div>
									
									</form>
									</div>
									<div role="tabpanel" class="tab-pane fade" id="downloads">
									<form action="index.php?page=file_upload&type=purchase" method="post" enctype="multipart/form-data">
									<div class="row">
									
									<div class="col-md-6">
									
									<div class="form-group">
									<label class="control-label">File</label>
									<input  type="file" name="file" />
									</div>
									
									</div>
									
									
									</div>
									<div class="row">
									<div class="col-md-6">
									<div class="form-group">
									<button onclick="collect_data()" class="btn btn-primary">Submit</button>
									</div>
									</div>
									</div>
									
									</form>
									</div>
									</div>
									</div>
									</div>
									</div>
									</div>
									</section>
									
									
									</article>
									</article>
									<script>
									function set_child(id,child){
									var id2="#"+child;
									$(id2).load("users/get_form_fields.php?parent_id="+id+"&child="+child);  
									
									document.getElementById(child).style.display = "block"; 
									}
									function collect_data(){
									
									var str=document.getElementById("editor-container3").innerHTML;
									alert(str);
									}
									</script>
									<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.7.1/katex.min.js"></script>
									
									<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
									<script src="quil/quill.min.js"></script>-->
									
									<script>
									// var quill = new Quill('#editor-container', {
									// modules: {
									// formula: true,
									// syntax: true,
									// toolbar: '#toolbar-container'
									// },
									// placeholder: 'Compose an epic...',
									// theme: 'snow'
									// });
									// var quill2 = new Quill('#editor-container2', {
									// modules: {
									// formula: true,
									// syntax: true,
									// toolbar: '#toolbar-container2'
									// },
									// placeholder: 'Compose an epic...',
									// theme: 'snow'
									// });
									// var quill3 = new Quill('#editor-container3', {
									// modules: {
									// formula: true,
									// syntax: true,
									// toolbar: '#toolbar-container3'
									// },
									// placeholder: 'Compose an epic...',
									// theme: 'snow'
									// });
									</script>
									<script>
									ClassicEditor
									.create( document.querySelector( '#editor' ) )
									.catch( error => {
									console.error( error );
									} );
									ClassicEditor
									.create( document.querySelector( '#editor2' ) )
									.catch( error => {
									console.error( error );
									} );
									
									ClassicEditor
									.create( document.querySelector( '#editor3' ) )
									.catch( error => {
									console.error( error );
									} );
									ClassicEditor
									.create( document.querySelector( '#editor4' ) )
									.catch( error => {
									console.error( error );
									} );
									</script>																		
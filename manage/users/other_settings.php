<?php
	$tab1='active';
	$tab2='';
	$tab1t='active fade show';
	$tab2t='fade';
	define ("MAX_SIZE","10000"); 
	function getExtension2($str) 
	{
		$i = strrpos($str,".");
		if (!$i) { return ""; }
		$l = strlen($str) - $i;
		$ext = substr($str,$i+1,$l);
		return $ext;
	}	
	
	if(isset($_GET['change_brand_status'])){
		if($_GET['current_status']==1){
			$n=0;
		}
		else{
			$n=1;
		}
		$delete=change_brand_status($_GET['change_brand_status'],$n);
		$tab1='';
	$tab2='active';
	$tab1t='fade';
	$tab2t='active fade show';
	}
	if(isset($_GET['delete_brand'])){
		$delete=delete_brand($_GET['delete_brand']);
		$tab1='';
	$tab2='active';
	$tab1t='fade';
	$tab2t='active fade show';
	}
	
	if(isset($_POST['add_brand'])){
		
		//image part start
		$exfile=$_FILES['brand_image']['name'];
		$filename = stripslashes($_FILES['brand_image']['name']);
		
		$extension = getExtension2($filename);
		if($extension=="jpg" || $extension=="jpeg" )
		{
			
			$src = imagecreatefromjpeg($_FILES['brand_image']['tmp_name']);
		}
		else if($extension=="png")
		{
			
			$src = imagecreatefrompng($_FILES['brand_image']['tmp_name']);
		}
		else 
		{
			$src = imagecreatefromgif($_FILES['brand_image']['tmp_name']);
		}
		$newname1="image/brands/".date("Y-m-d-His")."_brand_logo.".$extension;
		$newname="../".$newname1;
		list($width,$height)=getimagesize($_FILES['brand_image']['tmp_name']);
		
		$newwidth=105;
		$newheight=58;
		$tmp=imagecreatetruecolor($newwidth,$newheight);
		
		
		imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight, $width,$height);
		
		
		
		
		imagejpeg($tmp,$newname,105);
		
		
		imagedestroy($src);
		imagedestroy($tmp);
		//image part end
		$data['name']=$_POST['name'];
		$data['image_loaction']=$newname1;
	$data['add_datetime']=date('Y-m-d h:i:s'); 
	$data['added_by']=$_SESSION['user_id']; 
	$data['status']=1; 
		$entry=add_brand($data);
		if($entry){
	echo "<script>alert('Entry Successful');</script>";
	}
	else{
	echo "<script>alert('Error!!!');</script>";
	}
	$tab1='';
	$tab2='active';
	$tab1t='fade';
	$tab2t='active fade show';
	}
?>
<article class="content dashboard-page">
	<section class="section">
		<div class="row sameheight-container">
			
			<div class="col col-12 col-sm-12 col-md-12 col-xl-12 history-col">
				<div class="card sameheight-item" data-exclude="xs" id="dashboard-history">
					<div class="card-header card-header-sm bordered">
						<div class="header-block">
							<h3 class="title">Other Web Settings</h3>
						</div>
						<ul class="nav nav-tabs pull-right" role="tablist">
							<li class="nav-item">
								<a class="nav-link <?php echo $tab1;?>" href="#cat" role="tab" data-toggle="tab">Slider</a>
							</li>
							<li class="nav-item">
								<a class="nav-link <?php echo $tab2;?>" href="#subcat" role="tab" data-toggle="tab">Brands</a>
							</li>
							
						</ul>
					</div>
					<div class="card-block" style="overflow:scroll;min-height:500px;">
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane <?php echo $tab1t;?>" id="cat">
								<?php $slider=get_slider_images();
									/*  echo "<pre>";
										print_r($products);
									echo "</pre>";  */
								?>
								<div class="card">
                                    <div class="card-block">
                                        <div class="card-title-block">
                                            <h3 class="title"> Products <button type="button" class="btn btn-oval btn-primary">Add New</button></h3>
										</div>
                                        <section class="example">
                                            <table class="table table-bordered">
												<thead>
                                                    <tr>
                                                        <th>Sl</th>
                                                        
														<th>Image</th>
														
                                                        <th>Status</th>
                                                        <th>Action</th>
													</tr>
												</thead>
                                                <tbody>
													<?php
														
														$i=1;
														foreach($slider AS $index=>$val){
															
														?>
														<tr>
															<th scope="row"><?php echo $i;?></th>
															
															<td><img src='../<?php echo $val['image_location'];?>' style="width:100px;"/></td>
															<td><label class="switch">
																<input type="checkbox" <?php if($val['status']==1) echo "checked";?>>
																<span class="slider round"></span>
															</label></td>
															<td><em class="fa fa-search"></em>&nbsp;<em class="fa fa-edit"></em>&nbsp;<em class="fa fa-trash-o"></em></td>
														</tr>
														<?php
															$i++;
														}
														
													?>
													
												</tbody>
											</table>
										</section>
									</div>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane <?php echo $tab2t;?>" id="subcat">
								<div class="card">
                                    <div class="card-block">
                                        <div class="card-title-block">
                                            <h3 class="title">Brands<button type="button" class="btn btn-oval btn-primary"  data-toggle="modal" data-target="#myModal">Add New</button></h3>
										</div>
                                        <section class="example">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Sl</th>
                                                        <th> Name</th>
														<th>Logo</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
													</tr>
												</thead>
                                                <tbody>
													<?php
														$brands=get_brands_formanage();
														$i=1;
														foreach($brands AS $index=>$val){
															
														?>
														<tr>
															<th scope="row"><?php echo $i;?></th>
															
															<td><?php echo $val['name'];?></td>
															<td><img src='../<?php echo $val['image_location'];?>' style="width:100px;"/></td>
															
															<td><label class="switch">
																<input type="checkbox" <?php if($val['status']==1) echo "checked";?>>
																<span class="slider round" onclick="window.location = 'index.php?page=other_settings&change_brand_status=<?php echo $val['id'];?>&current_status=<?php echo $val['status'];?>';"></span>
															</label></td>
														<td>&nbsp;<a href="index.php?page=other_settings&delete_brand=<?php echo $val['id'];?>"<em class="fa fa-trash-o"></em></a></td>
													</tr>
													<?php
														$i++;
													}
													
												?>
												
											</tbody>
										</table>
									</section>
								</div>
							</div>
						</div>
						
						<!-- modal-->
						<div id="myModal" class="modal fade" role="dialog">
							<div class="modal-dialog">
								
								<!-- Modal content-->
								<form action="" method="post" enctype="multipart/form-data">
									<div class="modal-content">
										<div class="modal-header">
											
											<h4 class="modal-title">Add Brands</h4>
										</div>
										<div class="modal-body">
											<div class="form-group">
												<label class="control-label">Name</label>
											<input class="form-control boxed"  type="text" name="name" required> </div>
											<div class="form-group">
												<label class="control-label">Logo</label>
											<input class="form-control boxed"  type="file" name="brand_image" required> </div>							
											
										</div>
										<div class="modal-footer">
											
											<button type="submit" name="add_brand" class="btn btn-primary">Submit</button>
											
											<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
										</div>
									</div>
								</form>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


</article>
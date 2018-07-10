<?php
	
if(isset($_POST['add_cat'])){
	
	//print_r($_POST);

	$data['type']=1;
	$data['parent_id']=0;
	$data['name']=$_POST['cat_name'];
	$data['add_datetime']=date('Y-m-d h:i:s'); 
	$data['added_by']=$_SESSION['user_id']; 
	$data['status']=1; 
	$entry=add_category($data);
	if($entry){
	echo "<script>alert('Entry Successful');</script>";
	}
	else{
	echo "<script>alert('Error!!!');</script>";
	}
}
if(isset($_POST['add_sub'])){
	
	//print_r($_POST);

	$data['type']=2;
	$data['parent_id']=$_POST['cat_id'];
	$data['name']=$_POST['sub_cat_name'];
	$data['add_datetime']=date('Y-m-d h:i:s'); 
	$data['added_by']=$_SESSION['user_id']; 
	$data['status']=1; 
	$entry=add_category($data);
	if($entry){
	echo "<script>alert('Entry Successful');</script>";
	}
	else{
	echo "<script>alert('Error!!!');</script>";
	}
}
if(isset($_POST['add_sub_sub'])){
	
	//print_r($_POST);

	$data['type']=3;
	$data['parent_id']=$_POST['subcat'];
	$data['name']=$_POST['subsub_cat_name'];
	$data['add_datetime']=date('Y-m-d h:i:s'); 
	$data['added_by']=$_SESSION['user_id']; 
	$data['status']=1; 
	$entry=add_category($data);
	if($entry){
	echo "<script>alert('Entry Successful');</script>";
	}
	else{
	echo "<script>alert('Error!!!');</script>";
	}
}
if(isset($_GET['delete'])){
	$delete=delete_cat($_GET['delete']);
}
if(isset($_GET['change_status'])){
	if($_GET['current_status']==1){
	$n=0;
	}
	else{
	$n=1;
	}
	$delete=change_cat_status($_GET['change_status'],$n);
}
?>
<article class="content dashboard-page">
	<section class="section">
		<div class="row sameheight-container">
			
			<div class="col col-12 col-sm-12 col-md-12 col-xl-12 history-col">
				<div class="card sameheight-item" data-exclude="xs" id="dashboard-history">
					<div class="card-header card-header-sm bordered">
						<div class="header-block">
							<h3 class="title">Category Management</h3>
						</div>
						<ul class="nav nav-tabs pull-right" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" href="#cat" role="tab" data-toggle="tab">Category</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#subcat" role="tab" data-toggle="tab">Sub Category</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#subsubcat2" role="tab" data-toggle="tab">Sub Sub Category</a>
							</li>
						</ul>
					</div>
					<div class="card-block">
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane active fade show" id="cat">
							<?php $cat=get_categories();
								/* echo "<pre>";
								print_r($cat);
								echo "</pre>"; */
								?>
								<div class="card">
                                    <div class="card-block">
                                        <div class="card-title-block">
                                            <h3 class="title"> Categories <button type="button" class="btn btn-oval btn-primary" data-toggle="modal" data-target="#myModal">Add New</button></h3>
                                        </div>
										
                                        <section class="example">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Sl</th>
                                                        <th>Category Name</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
												<?php
												$i=1;
													foreach($cat AS $index=>$val){
													
													?>
													 <tr>
                                                        <th scope="row"><?php echo $i;?></th>
                                                        <td><?php echo $val['name'];?></td>
                                                      <td><label class="switch">
  <input type="checkbox" <?php if($val['status']==1) echo "checked";?>>
  <span class="slider round" onclick="window.location = 'index.php?page=categories&change_status=<?php echo $val['id'];?>&current_status=<?php echo $val['status'];?>';"></span>
</label></td>
                                                        <td><em class="fa fa-edit"></em>&nbsp;<a href="index.php?page=categories&delete=<?php echo $val['id'];?>"><em class="fa fa-trash-o"></a></em></td>
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
							<div role="tabpanel" class="tab-pane fade" id="subcat">
								<div class="card">
                                    <div class="card-block">
                                        <div class="card-title-block">
                                            <h3 class="title">Sub Categories <button type="button" class="btn btn-oval btn-primary" data-toggle="modal" data-target="#myModal2">Add New</button></h3>
                                        </div>
                                        <section class="example">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Sl</th>
                                                        <th>Category Name</th>
														 <th>Sub Category Name</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
												<?php
												$subcat=get_sub_categories();
												$i=1;
													foreach($subcat AS $index=>$val){
													
													?>
													 <tr>
                                                        <th scope="row"><?php echo $i;?></th>
                                                        <td><?php echo $val['cat'];?></td>
														<td><?php echo $val['name'];?></td>
                                                        <td><label class="switch">
  <input type="checkbox" <?php if($val['status']==1) echo "checked";?>>
  <span class="slider round" onclick="window.location = 'index.php?page=categories&change_status=<?php echo $val['id'];?>&current_status=<?php echo $val['status'];?>';"></span>
</label></td>
                                                        <td><em class="fa fa-edit"></em>&nbsp;<a href="index.php?page=categories&delete=<?php echo $val['id'];?>"><em class="fa fa-trash-o"></a></td>
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
							<div role="tabpanel" class="tab-pane fade" id="subsubcat2">
							<div class="card">
                                    <div class="card-block">
                                        <div class="card-title-block">
                                            <h3 class="title">Sub Sub Categories <button type="button" class="btn btn-oval btn-primary"  data-toggle="modal" data-target="#myModal3">Add New</button></h3>
											
                                        </div>
                                        <section class="example">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Sl</th>
                                                        <th>Category Name</th>
														 <th>Sub Category Name</th>
														 <th>Sub Sub Category Name</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
												<?php
												$subsubcat=get_sub_sub_categories();
												$i=1;
													foreach($subsubcat AS $index=>$val){
													
													?>
													 <tr>
                                                        <th scope="row"><?php echo $i;?></th>
                                                        <td><?php echo $val['cat'];?></td>
														<td><?php echo $val['subcat'];?></td>
														<td><?php echo $val['name'];?></td>
                                                        <td><label class="switch">
  <input type="checkbox" <?php if($val['status']==1) echo "checked";?>>
  <span class="slider round" onclick="window.location = 'index.php?page=categories&change_status=<?php echo $val['id'];?>&current_status=<?php echo $val['status'];?>';"></span>
</label></td>
                                                        <td><em class="fa fa-edit"></em>&nbsp;<a href="index.php?page=categories&delete=<?php echo $val['id'];?>"><em class="fa fa-trash-o"></a></td>
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
							<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
	<form action="" method="post" >
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title">Add Category</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
										<label class="control-label">Name</label>
									<input class="form-control boxed"  type="text" name="cat_name"> </div>
									
      </div>
      <div class="modal-footer">
	  
	         <button type="submit" name="add_cat" class="btn btn-primary">Submit</button>
                                    
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
	</form>

  </div>
</div>
<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
	<form action="" method="post" >
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title">Add Sub Category</h4>
      </div>
      <div class="modal-body">
	  <div class="form-group">
										<label class="control-label">Select Category</label>
										<select class="form-control boxed" name="cat_id">
										<option value="">Select</option>
										<?php
											$cat=get_categories();
											foreach($cat AS $index=>$val){
											echo "<option value='".$val['id']."'>".$val['name']."</option>";
											}
										?>
										</select>
								 </div>	
        <div class="form-group">
										<label class="control-label">Name</label>
									<input class="form-control boxed"  type="text" name="sub_cat_name"> </div>
									
      </div>
      <div class="modal-footer">
	  
	         <button type="submit" name="add_sub" class="btn btn-primary">Submit</button>
                                    
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
	</form>

  </div>
</div>
<div id="myModal3" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
	<form action="" method="post" >
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title">Add Sub Sub Category</h4>
      </div>
      <div class="modal-body">
	  <div class="form-group">
										<label class="control-label">Select Category</label>
										<select class="form-control boxed" onchange="set_child(this.value,'subcat')">
										<option value="">Select</option>
										<?php
											$cat=get_categories();
											foreach($cat AS $index=>$val){
											echo "<option value='".$val['id']."'>".$val['name']."</option>";
											}
										?>
										</select>
								 </div>	
								 <div class="form-group" id="subcat2" >
										 </div>
        <div class="form-group">
										<label class="control-label">Name</label>
									<input class="form-control boxed"  type="text" name="subsub_cat_name"> </div>
									
      </div>
      <div class="modal-footer">
	  
	         <button type="submit" name="add_sub_sub" class="btn btn-primary">Submit</button>
                                    
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
<script>
function set_child(id,child){
	if(child=='subcat'){
	var id2="#"+child;
	$("#subcat2").load("users/get_form_fields.php?parent_id="+id+"&child="+child);  
	//alert("users/get_form_fields.php?parent_id="+id+"&child="+child);
	//document.getElementById(child).style.display = "block"; 
	}
}
function collect_data(){
	
var str=document.getElementById("editor-container3").innerHTML;
alert(str);
}
</script>
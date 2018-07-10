<?php
	
if(isset($_POST['date'])){
	
	//print_r($_POST);
	$data[0]['date']=$_POST['date'];
	$data[0]['invoice_no']=$_POST['invoice_no']; 
	$data[0]['company']=$_POST['company']; 
	$data[0]['contact_no']=$_POST['contact_no']; 
	$data[0]['trn']=$_POST['trn']; 
	$data[0]['address']=$_POST['address']; 
	$data[0]['supply_location']=$_POST['supply_location']; 
	$data[0]['vat']=$_POST['vat']; 
	$data[0]['discount']=$_POST['discount'];
	$data[0]['sub_total']=$_POST['sub_total']; 
	$data[0]['total']=$_POST['total'];
	$data[0]['remark']=$_POST['remark'];
	$data[0]['add_datetime']=date('Y-m-d h:i:s'); 
	$data[0]['added_by']=$_SESSION['user_id']; 
	$data[0]['company_id']=$_SESSION['company_id']; 
	$entry=add_sales($data);
	if($entry){
	echo "<script>alert('Entry Successful');</script>";
	}
	else{
	echo "<script>alert('Error!!!');</script>";
	}
}
if(isset($_GET['delete'])){
	$d=delete_product($_GET['delete']);
}
if(isset($_GET['change_status'])){
	if($_GET['current_status']==1){
	$n=0;
	}
	else{
	$n=1;
	}
	$delete=change_product_status($_GET['change_status'],$n);
}
?>
<article class="content dashboard-page">
	<section class="section">
		<div class="row sameheight-container">
			
			<div class="col col-12 col-sm-12 col-md-12 col-xl-12 history-col">
				<div class="card sameheight-item" data-exclude="xs" id="dashboard-history">
					<div class="card-header card-header-sm bordered">
						<div class="header-block">
							<h3 class="title">Product Management</h3>
						</div>
						<ul class="nav nav-tabs pull-right" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" href="#cat" role="tab" data-toggle="tab">Products</a>
							</li>
						<!--	<li class="nav-item">
								<a class="nav-link" href="#subcat" role="tab" data-toggle="tab">Sub Category</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#subsubcat" role="tab" data-toggle="tab">Sub Sub Category</a>
							</li> -->
						</ul>
					</div>
					<div class="card-block">
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane active fade show" id="cat">
							<?php $products=products_for_manage();
								/*  echo "<pre>";
								print_r($products);
								echo "</pre>";  */
								?>
								<div class="card">
                                    <div class="card-block">
                                        <div class="card-title-block">
                                            <h3 class="title"> Products <a target="_blank" href="index.php?page=add_products"><button type="button" class="btn btn-oval btn-primary">Add New</button></a></h3>
                                        </div>
                                        <section class="example">
                                            <table class="table table-bordered">
                                              <thead>
                                                    <tr>
                                                        <th>Sl</th>
                                                        <th>Category Name</th>
														 <th>Sub Category Name</th>
														 <th>Sub Sub Category Name</th>
														  <th>Product Name</th>
														  
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
												<?php
											
												$i=1;
													foreach($products AS $index=>$val){
													
													?>
													 <tr>
                                                        <th scope="row"><?php echo $i;?></th>
                                                        <td><?php echo $val['cat'];?></td>
														<td><?php echo $val['subcat'];?></td>
														<td><?php echo $val['subsubcat'];?></td>
														<td><?php echo $val['product_name'];?></td>
                                                        <td><label class="switch">
  <input type="checkbox" <?php if($val['status']==1) echo "checked";?>>
  <span class="slider round" onclick="window.location = 'index.php?page=products&change_status=<?php echo $val['id'];?>&current_status=<?php echo $val['status'];?>';"></span>
</label></td>
                                                        <td><em class="fa fa-search"></em>&nbsp;<a href="index.php?page=edit_products&id=<?php echo $val['id'];?>"><em class="fa fa-edit"></em></a>&nbsp;<a href="index.php?page=products&delete=<?php echo $val['id'];?>"><em class="fa fa-trash-o"></em></a></td>
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
                                            <h3 class="title">Sub Categories <button type="button" class="btn btn-oval btn-primary">Add New</button></h3>
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
  <span class="slider round"></span>
</label></td>
                                                        <td><em class="fa fa-edit"></em>&nbsp;<em class="fa fa-trash-o"></em></td>
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
							<div role="tabpanel" class="tab-pane fade" id="subsubcat">
							<div class="card">
                                    <div class="card-block">
                                        <div class="card-title-block">
                                            <h3 class="title">Sub Categories <button type="button" class="btn btn-oval btn-primary">Add New</button></h3>
											
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
  <span class="slider round"></span>
</label></td>
                                                        <td><em class="fa fa-edit"></em>&nbsp;<em class="fa fa-trash-o"></em></td>
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
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	
</article>
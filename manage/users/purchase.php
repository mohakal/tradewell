<?php
	
if(isset($_POST['date'])){
	
	//print_r($_POST);
	$data[0]['date']=$_POST['date'];
	$data[0]['invoice_no']=$_POST['invoice_no']; 
	$data[0]['company']=$_POST['company']; 
	$data[0]['contact_no']=$_POST['contact_no']; 
	$data[0]['trn']=$_POST['trn']; 
	$data[0]['address']=$_POST['address']; 
//	$data[0]['supply_location']=$_POST['supply_location']; 
	$data[0]['vat']=$_POST['vat']; 
//	$data[0]['discount']=$_POST['discount'];
	$data[0]['sub_total']=$_POST['sub_total']; 
	$data[0]['total']=$_POST['total'];
//	$data[0]['remark']=$_POST['remark'];
	$data[0]['add_datetime']=date('Y-m-d h:i:s'); 
	$data[0]['added_by']=$_SESSION['user_id']; 
	$data[0]['company_id']=$_SESSION['company_id']; 
	$entry=add_purchase($data);
	if($entry){
	echo "<script>alert('Entry Successful');</script>";
	}
	else{
	echo "<script>alert('Error!!!');</script>";
	}
}
?>
<article class="content dashboard-page">
	<section class="section">
		<div class="row sameheight-container">
			
			<div class="col col-12 col-sm-12 col-md-12 col-xl-12 history-col">
				<div class="card sameheight-item" data-exclude="xs" id="dashboard-history">
					<div class="card-header card-header-sm bordered">
						<div class="header-block">
							<h3 class="title">Purchase Entry</h3>
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
								<form action="" method="post">
								<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">Date</label>
									<input class="form-control boxed" type="date" name="date"> </div>
									<div class="form-group">
										<label class="control-label">Invoice No</label>
									<input class="form-control boxed" type="text" name="invoice_no"> </div>
									<div class="form-group">
										<label class="control-label">Company</label>
									<input class="form-control boxed"  type="text" name="company"> </div>
									
										<div class="form-group">
										<label class="control-label">Contact No</label>
									<input class="form-control boxed"  type="text" name="contact_no"> </div>
									<div class="form-group">
										<label class="control-label">TRN</label>
									<input  class="form-control boxed"  type="text" name="trn"> </div>
								
								
									</div>
									<div class="col-md-6">
								<!--	<div class="form-group">
										<label class="control-label">Supply Location</label>
									<input class="form-control boxed" type="text" name="supply_location" name="supply_location"> </div>
									--><div class="form-group">
										<label class="control-label">Sub Total</label>
									<input class="form-control boxed" type="number" name="sub_total"> </div>
									<div class="form-group">
										<label class="control-label">Vat</label>
									<input class="form-control boxed"  type="number" name="vat"> </div>
								<!--			<div class="form-group">
										<label class="control-label">Discount</label>
									<input  class="form-control boxed"  type="number" name="discount"> </div>
								
								-->	<div class="form-group">
										<label class="control-label">Total</label>
										<input  class="form-control boxed"  type="number" name="total"></textarea>
									</div>
										<div class="form-group">
										<label class="control-label">Address</label>
										<textarea rows="3" class="form-control boxed" name="address"></textarea>
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
                                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
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
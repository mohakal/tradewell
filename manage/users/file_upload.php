<?php
		if(isset($_POST['data'])){
	/*  */
	//print_r($_POST);
	$re=json_decode(base64_decode($_POST['data']));
	$re= json_decode(json_encode($re), true);
	//$file=$_POST['fle'];
	print_r($re);
	$entry=add_purchase($re);
	if($entry){
	echo "<script>alert('Entry Successful');</script>";
	}
	else{
	echo "<script>alert('Error!!!');</script>";
	}}
		if(isset($_POST['data2'])){
	/*  */
	//print_r($_POST);
	$re=json_decode(base64_decode($_POST['data2']));
	$re= json_decode(json_encode($re), true);
	//$file=$_POST['fle'];
	print_r($re);
	$entry=add_sales($re);
	if($entry){
	echo "<script>alert('Entry Successful');</script>";
	}
	else{
	echo "<script>alert('Error!!!');</script>";
	}}
	
	?>
<article class="content dashboard-page">
	<section class="section">
		<div class="row sameheight-container">
			
			<div class="col col-12 col-sm-12 col-md-12 col-xl-12 history-col">
				<?php

include('include/excel_read.php');
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
	

	
			$errors=0;
	$org_file=$exfile=$_FILES['file']['name'];
 	if ($exfile) 
 	{
	
 	//get the original name of the file from the clients machine
 		$filename = stripslashes($_FILES['file']['name']);
 	//get the extension of the file in a lower case format
  		$extension = getExtension2($filename);
 		$extension = strtolower($extension);
 		
	if ($extension != 'xls' && $extension != 'xlsx') 
		{
			//print error message
			$fail_reason='Unknown extension ';
			$err = $fail_reason;
			$fail_reason.=$extension;
			$errors=1;
		}
 		$size=filesize($_FILES['file']['tmp_name']);

	//compare the size with the maxim size we defined and print error if bigger
	if ($size > MAX_SIZE*10000)
		{
		$fail_reason='exceeded the size limit ';
		$err = $fail_reason;
		$errors=1;
		}
		
		if($errors==1){
			echo $err;
		}
		else
		{

			date_default_timezone_set('Asia/Dhaka');

 			if($extension == "xls")
			$newname="files/".date("Y-m-d-His").".xls";
 			if($extension == "xlsx")
			$newname="files/".date("Y-m-d-His").".xlsx";
			if($errors!=1){
			
			$copied = move_uploaded_file($_FILES['file']['tmp_name'], $newname);
			}
			if (!$copied) 
			{
				$fail_reason='Could not move uploaded file ';
				$errors=1;
				$error_type = ".";
			}
			else 
			{
				if($errors!=1){
					$status='Uploaded';
					$str11=1;
				//	echo 'Congratulations! You have successfully submitted the file.';
				}
				else
				{
					$status='Not Uploaded';
					$flag1=1;
					echo '<script>alert("Error in submitting. Your file was not saved! Please try to upload again!");</script>';
				}
			
			}
		}
	}
	if($errors==0){
		$a=excelToArray($newname, true);

		
	}
	
	if($errors==0){
	if($_GET['type']=='purchase'){
	?>
	<div class="card">
                                    <div class="card-block">
                                        <div class="card-title-block">
                                            <h3 class="title"> Transactions </h3>
                                        </div>
                                        <section class="example">
                                            <div class="table-flip-scroll">
                                                <table class="table table-striped table-bordered table-hover flip-content">
                                                    <thead class="flip-header">
			

                                                        <tr>
															<th>Sl</th>
                                                            <th>Date</th>
                                                            <th>Company</th>
                                                            <th>Invoice No</th>
                                                            <th>TRN</th>
                                                            <th>Address</th>
															<th>Contact No</th>
															<th>Sub Total</th>
															<th>Vat</th>
															<th>Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
										<?php			$i=1;
							foreach($a AS $index=>$val){
							$excel_date = $val['Date']; //here is that value 41621 or 41631
							$unix_date = ($excel_date - 25569) * 86400;
							$excel_date = 25569 + ($unix_date / 86400);
							$unix_date = ($excel_date - 25569) * 86400;
							$data[$i]['date']=gmdate("Y-m-d", $unix_date);
							$data[$i]['invoice_no']=$val['Invoice No']; 
							$data[$i]['company']=$val['Company']; 
							$data[$i]['contact_no']=$val['Contact No']; 
							$data[$i]['trn']=$val['TRN']; 
							$data[$i]['address']=$val['Address']; 
						//	$data[0]['supply_location']=$_POST['supply_location']; 
							$data[$i]['vat']=$val['Vat']; 
						//	$data[0]['discount']=$_POST['discount'];
							$data[$i]['sub_total']=$val['Sub Total']; 
							$data[$i]['total']=$val['Total'];
						//	$data[0]['remark']=$_POST['remark'];
							$data[$i]['add_datetime']=date('Y-m-d h:i:s'); 
							$data[$i]['added_by']=$_SESSION['user_id']; 
							$data[$i]['company_id']=$_SESSION['company_id']; 
							
							//echo gmdate("Y-m-d", $unix_date);
							echo '<tr class="odd gradeX">';
							echo '<td>'.$i.'</td>';
							echo '<td>'.gmdate("Y-m-d", $unix_date).'</td>';
							echo '<td>'.$val['Company'].'</td>';
							echo '<td>'.$val['Invoice No'].'</td>';
							echo '<td>'.$val['TRN'].'</td>';
							echo '<td>'.$val['Address'].'</td>';
							echo '<td>'.$val['Contact No'].'</td>';
							echo '<td>'.$val['Sub Total'].'</td>';
							echo '<td>'.$val['Vat'].'</td>';
							echo '<td>'.$val['Total'].'</td>';
							echo "</tr>";
							$i++;
							}
							?>
                                                        
                                                    </tbody>
                                                </table>
										
                                            </div>
												<form action="" class="form-horizontal" method="post" >
										
									
												<input type="hidden" name="data" value="<?php echo base64_encode(json_encode($data));?>">
														<!-- <input type="hidden" name="fle" value="<?php // echo $newname;?>"> -->
														<button type="submit"  class="btn btn-primary">Confirm</button>
															<button type="button" class="btn btn-secondary">Cancel</button>
														
									
									</form>	
                                        </section>
                                    </div>
                                </div>
	<?php
	}
	if($_GET['type']=='sales'){
	?>
	<div class="card">
                                    <div class="card-block">
                                        <div class="card-title-block">
                                            <h3 class="title"> Transactions </h3>
                                        </div>
                                        <section class="example" style="overflow:scroll;">
                                            
                                                <table class="table table-bordered" style="box-sizing:none;">
                                                    <thead >
			

                                                        <tr>
															<th>Sl</th>
                                                            <th>Date</th>
                                                            
                                                            <th>Invoice No</th>
															<th>Company</th>
                                                            <th>TRN</th>
                                                            <th>Address</th>
															<th>Contact No</th>
															<th>Supply Location</th>
															<th>Sub Total</th>
															<th>Vat</th>
															<th>Discount</th>
															<th>Total</th>
															<th>Remarks</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
										<?php			$i=1;
							foreach($a AS $index=>$val){
							$excel_date = $val['Date']; //here is that value 41621 or 41631
							$unix_date = ($excel_date - 25569) * 86400;
							$excel_date = 25569 + ($unix_date / 86400);
							$unix_date = ($excel_date - 25569) * 86400;
							$data[$i]['date']=gmdate("Y-m-d", $unix_date);
							$data[$i]['invoice_no']=$val['Invoice No']; 
							$data[$i]['company']=$val['Company']; 
							$data[$i]['contact_no']=$val['Contact No']; 
							$data[$i]['trn']=$val['TRN']; 
							$data[$i]['address']=$val['Address']; 
							$data[$i]['supply_location']=$val['Supply Location']; 
							$data[$i]['vat']=$val['Vat']; 
							$data[$i]['discount']=$val['Discount'];
							$data[$i]['sub_total']=$val['Sub Total']; 
							$data[$i]['total']=$val['Total'];
							$data[$i]['remark']=$val['Remarks'];
							$data[$i]['add_datetime']=date('Y-m-d h:i:s'); 
							$data[$i]['added_by']=$_SESSION['user_id']; 
							$data[$i]['company_id']=$_SESSION['company_id']; 
							
							//echo gmdate("Y-m-d", $unix_date);
							echo '<tr class="odd gradeX">';
							echo '<td>'.$i.'</td>';
							echo '<td>'.gmdate("Y-m-d", $unix_date).'</td>';
							echo '<td>'.$val['Invoice No'].'</td>';
							echo '<td>'.$val['Company'].'</td>';
							
							echo '<td>'.$val['TRN'].'</td>';
							echo '<td>'.$val['Address'].'</td>';
							echo '<td>'.$val['Supply Location'].'</td>';
							echo '<td>'.$val['Contact No'].'</td>';
							echo '<td>'.$val['Sub Total'].'</td>';
							echo '<td>'.$val['Vat'].'</td>';
							echo '<td>'.$val['Discount'].'</td>';
							echo '<td>'.$val['Total'].'</td>';
							echo '<td>'.$val['Remarks'].'</td>';
							echo "</tr>";
							$i++;
							}
							?>
                                                        
                                                    </tbody>
                                                </table>
										
                                            
												<form action="" class="form-horizontal" method="post" >
										
									
												<input type="hidden" name="data2" value="<?php echo base64_encode(json_encode($data));?>">
														<!-- <input type="hidden" name="fle" value="<?php // echo $newname;?>"> -->
														<button type="submit"  class="btn btn-primary">Confirm</button>
															<button type="button" class="btn btn-secondary">Cancel</button>
														
									
									</form>	
                                        </section>
                                    </div>
                                </div>
	<?php
	}
	}
	
	

}

?>
			</div>
		</div>
	</section>
	
	
</article>
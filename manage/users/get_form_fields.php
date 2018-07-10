<?php
include('../DB/db.php');
$child_list=get_cat_childs($_GET['parent_id'],$_GET['child']);


?>
<label class="control-label">
<?php 
if($_GET['child']=='subcat'){
	echo "Sub Category";
}
else{
	echo "Sub Sub Category";
}
?>

</label>
										<select class="form-control boxed"<?php if($_GET['child']=='subcat'){?> onchange="set_child(this.value,'subsubcat')" <?php }?>
<?php 
	if($_GET['child']=='subcat'){
	echo "name='subcat'";
}
else{
	echo "name='subsubcat'";
}
?> required>
	<option value="">Select</option>
										<?php
										if(count($child_list)>0){
											foreach($child_list AS $index=>$val){
											echo "<option value='".$val['id']."'>".$val['name']."</option>";
											}
										}
										?>
	<option value="none">None</option>									
										</select>		
<?php
	include('DB/db.php');
	$menu=get_menu();
	echo "<pre>";
	print_r($menu);
	echo "</pre>";
	echo "<ul style='list-style-type:square'>";
	foreach($menu AS $index1=>$value1){
		echo "<li>";
		echo $value1['name'];
		if(count($value1['sub_item'])>0){
			echo "<ul>";
			foreach($value1['sub_item'] AS $index2=>$value2){
				echo "<li>";
				echo $value2['name'];
				if(count($value2['sub_item'])>0){
					echo "<ul>";
					foreach($value2['sub_item'] AS $index3=>$value3){
						echo "<li>";
						echo $value3['name'];
						if(count($value3['products'])>0){
							echo "<ul>";
							foreach($value3['products'] AS $index4=>$value4){
								echo "<li>";
								echo $value4['fname'];
								echo "</li>";
							}
							echo "</ul>";
						}
						echo "</li>";
					}
					echo "</ul>";
				}
				echo "</li>";
			}
			echo "</ul>";	
		}
		echo "</li>";
	}
	echo "</ul>";
?>

<ul style="list-style-type:square">
	<li>Coffee</li>
	<li>Tea</li>
	<li>Milk</li>
</ul> 
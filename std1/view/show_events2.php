<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<?php
include_once('../controller/config.php');
$event_id=$_GET['event_id'];
$grade=0;
$prefix="";
$grade_name="";
$category="";
$type="";
$name="";

$sql="SELECT * FROM events WHERE id='$event_id'";
	 
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
	
	$grade=$row['grade_id'];
	$category=$row['category_id'];
	
	if($category == 1){
		$category = "All";
	}else if($category == 2){
		$category = "All Teachers & Student";
	}else if($category == 3){
		$category = "All Teachers & Specific Grades";
	}else if($category == 4){
		$category = "Only Specific Grades";
	}else if($category == 5){
		$category = "Only Teachers";
	}else if($category == 6){
		$category = "Only Students";
	}else if($category == 7){
		$category = "Only Parents";
	}else{
		
	}
	
	
	
	
	$creator_type=$row['creator_type'];
	$create_by=$row['create_by'];
	
	if($creator_type == "Admin"){
		
		$sql1="SELECT * FROM admin WHERE index_number='$create_by'";
	 
		$result1=mysqli_query($conn,$sql1);
		$row1=mysqli_fetch_assoc($result1);
		$name=$row1['i_name'];
		
	}
	
	if($creator_type == "Teacher"){
		
		$sql1="SELECT * FROM teacher WHERE index_number='$create_by'";
	 
		$result1=mysqli_query($conn,$sql1);
		$row1=mysqli_fetch_assoc($result1);
		$name=$row1['i_name'];
		
	}
			
?>

<div class="modal msk-fade" id="modalviewEvent5" tabindex="-1" role="dialog" aria-labelledby="insert_alert1" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog"><!--modal-dialog -->  
		<div class="container col-lg-6 modal-content1"><!--modal-content --> 
      		<div class="row">
          		<div class="panel"><!--panel --> 
            		<div class="panel-heading bg-orange">
                    	<button type="button" onClick="showAllNotfi1()"  class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
              			<h3 class="panel-title"><?php echo $row['title']; ?></h3>
            		</div>
            		<div class="panel-body"><!--panel-body -->
              			<div class="row">
                			<div class=" col-md-12"> 
                  				<table class="table table-user-information">
                    				<tbody>
                      					<tr>
                        					<td>Title:</td>
                        					<td id="title1"><?php echo $row['title']; ?> </td>
                      					</tr>
                      					<tr>
                        					<td>Category:</td>
                        					<td id="category1"><?php echo $category; ?></td>
                      					</tr>
                             			<tr>
                        					<td>Semester</td>
                        					<td id="grade1">
                                            	<?php 
													if($grade){
														
														$g=(explode(",",$grade));
														
														for($i=0;$i<count($g);$i++){
															$id=$g[$i];
															
															
															$sql1="SELECT * FROM grade WHERE id =$id";
															$result1=mysqli_query($conn,$sql1);
															$row1=mysqli_fetch_assoc($result1);
															
															$grade_name.=$prefix.$row1['name'];
															$prefix=',';
															
														}
														echo $grade_name;
													}else{
														echo "All";
													}
												?>
                                             </td>
                      					</tr>
                        				<tr>
                        					<td>from</td>
                        					<td id="_from1"> <?php echo $row['start_date_time']; ?></td>
                      					</tr>
                      					<tr>
                        					<td>To</td>
                        					<td id="_to1"> <?php echo $row['end_date_time']; ?></td>
                      					</tr>
                        					<td>Note</td>
                        					<td id="note"> <?php echo $row['note']; ?></td>
                      					</tr>
                                        </tr>
                        					<td>Create by</td>
                        					<td id="note"> <?php echo $name; ?></td>
                      					</tr>
                    				</tbody>
                  				</table>
                  			</div>
                   		</div>
                  	</div><!--/.panel-body -->
            	</div><!--/. panel--> 
			</div><!--/.row --> 
    	</div><!--/.modal-content -->
	</div><!--/.modal-dialog -->
</div><!--/.modal -->  
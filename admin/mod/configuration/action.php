<?php
session_start();
require_once("../../../dbconfig.php");
require_once("../../../settings.php");
require_once("controller.php");

$controller = new Controller();

if(isset($_POST['data']['0'])){	
	if($_POST['data']['0'] == "getCategories"){
		$data = array_values($_POST);
		$result = $controller->getCategories($data);
		
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
			?>
			<tr>
				<td>
					<a href="?p=configuration&catID=<?php echo $row['cat_id'];?>">
						<i class="fas fa-layer-group"></i>&nbsp;&nbsp;<?php echo $row['cat_name'];?>
					</a>
				</td>
				<td>
					<?php $result2 = $controller->countCategories($row['cat_id']); ?>
					<span class="badge bg-primary float-right"><?php echo ($result2['0'] == 1 ? $result2['3'] : 0);?></span>
				</td>
				<td>
					<a href="?p=configuration&option=category&action=edit&catID=<?php echo $row['cat_id'];?>&couID=0&ID=<?php echo $row['cat_id'];?>" title="Edit category">
						<i class="fas fa-edit"></i>
					</a>
				</td>
			</tr>			
			<?php
		}} else { ?>
			<tr>
				<td colspan="3">
					<i class="fas fa-exclamation-circle"></i>&nbsp;&nbsp;<?php echo $result['1'];?>
				</td>
			</tr>	
			<?php
		 } 
		
	} else if($_POST['data']['0'] == "getCourses"){
		$data = array_values($_POST);
		$result = $controller->getCourses($data);
		
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
			?>
			<tr>
				<td>
					<a href="?p=configuration&catID=<?php echo $row['cou_cat_id'];?>&courseID=<?php echo $row['cou_id'];?>" onClick="getContents(<?php echo $data['0']['1'];?>);">
					<i class="fas fa-book"></i>&nbsp;&nbsp;<?php echo $row['cou_name'];?>
				</td>
				<td>
					<?php $result2 = $controller->countCourses($row['cou_id']); ?>
					<span class="badge bg-primary float-right"><?php echo ($result2['0'] == 1 ? $result2['3'] : 0);?></span>
				</td>
				<td>
					<a href="?p=configuration&option=course&action=edit&catID=<?php echo $row['cou_cat_id'];?>&couID=<?php echo $row['cou_id'];?>&ID=<?php echo $row['cou_id'];?>" title="Edit course">
						<i class="fas fa-edit"></i>
					</a>
				</td>
			</tr>
			<?php
		}} else { ?>
			<tr>
				<td colspan="3">
					<i class="fas fa-exclamation-circle"></i>&nbsp;&nbsp;<?php echo $result['1'];?>
				</td>
			</tr>	
			<?php
		 } 
		 
	} else if($_POST['data']['0'] == "getContents"){
		$data = array_values($_POST);
		$result = $controller->getContents($data);		
		
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
			$resultCount = $controller->countDownload($row['con_id']);
			$count = (isset($resultCount['3']) ? $resultCount['3'] : 0);
			?>
			<tr>
				<td>
					<a href="../data/<?php echo $row["con_attachment"];?>" target="_blank">
						<i class="fas fa-book-open"></i>&nbsp;&nbsp;<?php echo $row['con_title'];?>
					</a><br>
					<small><small><strong><?php echo $row['cou_name'];?></strong> (<?php echo $count;?> downloads)</small></small>
					
				</td>
				<td><i class="fas fa-eye<?php echo ($row['con_display'] == 1 ? "" : "-slash");?>"></i></td>
				<td>
					<a href="?p=configuration&option=content&action=edit&catID=<?php echo $row['cou_cat_id'];?>&couID=<?php echo $row['con_cou_id'];?>&ID=<?php echo $row['con_id'];?>" title="Edit content">
						<i class="fas fa-edit"></i>
					</a>
				</td>
			</tr>			
			<?php
		}} else { ?>
			<tr>
				<td colspan="3">
					<i class="fas fa-exclamation-circle"></i>&nbsp;&nbsp;<?php echo $result['1'];?>
				</td>
			</tr>	
			<?php
		} 	
		
	} else if($_POST['data']['0'] == "getOption"){
		$data = array_values($_POST);
			
		if($data['0']['1'] == "category" && $data['0']['2'] == "new" && $data['0']['3'] == 0){
			?>
			<form role="form" onSubmit="return false;">			
				<div class="card-header">
					<h3 class="card-title"><?php echo ucwords($data['0']['2']." ".$data['0']['1']);?></h3>
				</div>
				<div class="card-body">
					<div class="form-group">
						<label for="cat_name">Category name</label>
						<input type="text" class="form-control" id="cat_name" placeholder="Enter category name" required>
					</div>
                </div>
                <div class="card-footer">
					<button type="button" class="btn btn-default" id="cancel" onClick="return confirm('Cancel action?') ? window.location.href='?p=configuration' : false;">Cancel</button>
					<button type="submit" class="btn btn-primary float-right" id="submit" onClick="return confirm('Save action?') ? processForm('<?php echo $data['0']['2'];?>') : false;"><?php echo ($data['0']['2'] == "new" ? "Submit" : "Update");?></button>
				</div>
            </form>
			<?php
			
		} else if($data['0']['1'] == "category" && $data['0']['2'] == "edit" && $data['0']['3'] != 0){
			?>
			<form role="form" onSubmit="return false;">
				<div class="card-header">
					<h3 class="card-title"><?php echo ucwords($data['0']['2']." ".$data['0']['1']);?></h3>
				</div>
				<div class="card-body">
					<div class="form-group">
						<label for="cat_id">Category ID</label>
						<input type="text" class="form-control" id="cat_id" value="" readonly>
					</div>
					<div class="form-group">
						<label for="cat_name">Category name</label>
						<input type="text" class="form-control" id="cat_name" placeholder="Enter category name" required>
					</div>
                </div>
                <div class="card-footer">
					<button type="button" class="btn btn-default" id="cancel" onClick="return confirm('Cancel action?') ? window.location.href='?p=configuration' : false;">Cancel</button>
					<button type="submit" class="btn btn-primary float-right" id="submit" onClick="return confirm('Save action?') ? processForm('<?php echo $data['0']['2'];?>') : false;"><?php echo ($data['0']['2'] == "new" ? "Submit" : "Update");?></button>
				</div>
            </form>
			<?php
			$result = $controller->getCategory($data);
			
			if($result['0'] == 1){ $row = $result['2']->fetch_assoc();
				?>
				<script>
					$('#cat_id').val('<?php echo $row["cat_id"];?>');
					$('#cat_name').val('<?php echo $row["cat_name"];?>');
				</script>
				<?php
			} else {
				?>
				<script>
					alert('<?php echo $result['1'];?> \nYou will be redirected to the main page.');
					window.location.href='?p=configuration';
				</script>
				<?php
			}
			
		} else if($data['0']['1'] == "course" && $data['0']['2'] == "new" && $data['0']['3'] == 0){
			?>
			<form role="form" onSubmit="return false;">
				<div class="card-header">
					<h3 class="card-title"><?php echo ucwords($data['0']['2']." ".$data['0']['1']);?></h3>
				</div>
				<div class="card-body">
					<div class="form-group">
						<label for="cou_cat_id">Category</label>
						<select class="form-control" id="cou_cat_id" required>
							<option value="">---select---</option>
							<?php
							$result = $controller->getCategories($data);
							if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
								echo '<option value="'.$row['cat_id'].'">'.$row['cat_name'].'</option>';
							}} else {
								echo '<option value="">'.$result['1'].'</option>';
							}
							?>
						<select>
					</div>
					<div class="form-group">
						<label for="cou_name">Course name</label>
						<input type="text" class="form-control" id="cou_name" placeholder="Enter course name" required>
					</div>
					<div class="form-group">
						<label for="cou_per_id">Course staff</label>
						<select class="form-control" id="cou_per_id" required>
							<option value="">---select---</option>
							<?php
							$result = $controller->getPersons($data);
							if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
								echo '<option value="'.$row['per_id'].'">'.$row['per_fullname']." ".($row['per_id'] == 1 ? "(TBA)" : "").'</option>';
							}} else {
								echo '<option value="">'.$result['1'].'</option>';
							}
							?>
						<select>
					</div>
                </div>
                <div class="card-footer">
					<button type="button" class="btn btn-default" id="cancel" onClick="return confirm('Cancel action?') ? window.location.href='?p=configuration' : false;">Cancel</button>
					<button type="submit" class="btn btn-primary float-right" id="submit" onClick="return confirm('Save action?') ? processForm('<?php echo $data['0']['2'];?>') : false;"><?php echo ($data['0']['2'] == "new" ? "Submit" : "Update");?></button>
				</div>
            </form>		
			<?php
			
		} else if($data['0']['1'] == "course" && $data['0']['2'] == "edit" && $data['0']['3'] != 0){
			?>
			<form role="form" onSubmit="return false;">
				<div class="card-header">
					<h3 class="card-title"><?php echo ucwords($data['0']['2']." ".$data['0']['1']);?></h3>
				</div>
				<div class="card-body">
					<div class="form-group">
						<label for="cou_id">Course ID</label>
						<input type="text" class="form-control" id="cou_id" readonly>
					</div>
					<div class="form-group">
						<label for="cou_cat_id">Category</label>
						<select class="form-control" id="cou_cat_id" required>
							<option value="">---select---</option>
							<?php
							$result = $controller->getCategories($data);
							if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
								echo '<option value="'.$row['cat_id'].'">'.$row['cat_name'].'</option>';
							}} else {
								echo '<option value="">'.$result['1'].'</option>';
							}
							?>
						<select>
					</div>
					<div class="form-group">
						<label for="cou_name">Course name</label>
						<input type="text" class="form-control" id="cou_name" placeholder="Enter course name" required>
					</div>
					<div class="form-group">
						<label for="cou_per_id">Course staff</label>
						<select class="form-control" id="cou_per_id" required>
							<option value="">---select---</option>
							<?php
							$result = $controller->getPersons($data);
							if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
								echo '<option value="'.$row['per_id'].'">'.$row['per_fullname']." ".($row['per_id'] == 1 ? "(TBA)" : "").'</option>';
							}} else {
								echo '<option value="">'.$result['1'].'</option>';
							}
							?>
						<select>
					</div>
                </div>
                <div class="card-footer">
					<button type="button" class="btn btn-default" id="cancel" onClick="return confirm('Cancel action?') ? window.location.href='?p=configuration' : false;">Cancel</button>
					<button type="submit" class="btn btn-primary float-right" id="submit" onClick="return confirm('Save action?') ? processForm('<?php echo $data['0']['2'];?>') : false;"><?php echo ($data['0']['2'] == "new" ? "Submit" : "Update");?></button>
				</div>
            </form>
			<?php
			$result = $controller->getCourse($data);
			
			if($result['0'] == 1){ $row = $result['2']->fetch_assoc();
				?>
				<script>
					$('#cou_id').val('<?php echo $row["cou_id"];?>');
					$('#cou_cat_id').val('<?php echo $row["cou_cat_id"];?>');
					$('#cou_name').val('<?php echo $row["cou_name"];?>');
					$('#cou_per_id').val('<?php echo $row["cou_per_id"];?>');
				</script>	
				<?php
			} else {
				?>
				<script>
					alert('<?php echo $result['1'];?> \nYou will be redirected to the main page.');
					window.location.href='?p=configuration';
				</script>
				<?php
			}
			
		} else if($data['0']['1'] == "content" && $data['0']['2'] == "new" && $data['0']['3'] == 0){
			?>
			<form role="form" onSubmit="return false;" enctype="multipart/form-data" id="myform">
				<div class="card-header">
					<h3 class="card-title"><?php echo ucwords($data['0']['2']." ".$data['0']['1']);?></h3>
				</div>
				<div class="card-body">
					<div class="form-group">
						<label for="con_cou_id">Course category</label>
						<select class="form-control" id="con_cou_id" required>
							<option value="">---select---</option>
							<?php
							$result = $controller->getCourses($data);
							if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
								echo '<option value="'.$row['cou_id'].'">'.$row['cou_name'].'</option>';
							}} else {
								echo '<option value="">'.$result['1'].'</option>';
							}
							?>							
						</select>
					</div>
					<div class="form-group">
						<label for="con_title">Content name</label>
						<input type="text" class="form-control" id="con_title" placeholder="Enter content title" required>
					</div>
					<div class="form-group">
						<label for="con_title">Content description</label>
						<textarea class="form-control" id="con_description" rows="3" placeholder="Enter content description" required></textarea>
					</div>
					<div class="form-group">
						<label for="con_attachment">Content attachment </label>
						<input type="hidden" class="form-control" id="con_attachment_old">
						<div class="input-group">
							<div class="custom-file">								
								<input type="file" class="form-control-file border" id="con_attachment" onchange="uploadAttachment();" required>								
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-6">
							<div class="form-group">
								<label for="con_datefrom">From</label>
								<input type="date" class="form-control" id="con_datefrom">
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label for="con_dateto">To</label>
								<input type="date" class="form-control" id="con_dateto">
							</div>
						</div>
					</div>
					<input type="hidden" class="form-control" id="con_per_id" value="<?php echo $logged_userID;?>">
					<div class="form-group">
						<div class="custom-control custom-switch">
							<input type="checkbox" class="custom-control-input" id="con_display" checked>	
							<label class="custom-control-label" for="con_display">Display</label>							
						</div>
					</div>					
                </div>
                <div class="card-footer">
					<button type="button" class="btn btn-default" id="cancel" onClick="return confirm('Cancel action?') ? window.location.href='?p=configuration' : false;">Cancel</button>
					<button type="submit" class="btn btn-primary float-right" id="submit" onClick="return confirm('Save action?') ? processForm('<?php echo $data['0']['2'];?>') : false;"><?php echo ($data['0']['2'] == "new" ? "Submit" : "Update");?></button>
				</div>
            </form>
			<?php
			
		} else if($data['0']['1'] == "content" && $data['0']['2'] == "edit" && $data['0']['3'] != 0){
			?>
			<form role="form" onSubmit="return false;" enctype="multipart/form-data" id="myform">
				<div class="card-header">
					<h3 class="card-title"><?php echo ucwords($data['0']['2']." ".$data['0']['1']);?></h3>
				</div>
				<div class="card-body">
					<div class="form-group">
						<label for="con_id">Content ID</label>
						<input type="text" class="form-control" id="con_id" readonly>
					</div>
					<div class="form-group">
						<label for="con_cou_id">Course category</label>
						<select class="form-control" id="con_cou_id" required>
							<option value="">---select---</option>
							<?php
							$result = $controller->getCourses($data);
							if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
								echo '<option value="'.$row['cou_id'].'">'.$row['cou_name'].'</option>';
							}} else {
								echo '<option value="">'.$result['1'].'</option>';
							}
							?>							
						</select>
					</div>
					<div class="form-group">
						<label for="con_title">Content name</label>
						<input type="text" class="form-control" id="con_title" placeholder="Enter content title" required>
					</div>
					<div class="form-group">
						<label for="con_title">Content description</label>
						<textarea class="form-control" id="con_description" rows="3" placeholder="Enter content description" required></textarea>
					</div>
					<div class="form-group">
						<label for="con_attachment_old">Content attachment </label> <small>(<i id="con_attachment_label"></i>)</small> <!-- <em>(<a href="#" id="con_attachment-link"><span id="con_attachment-text"></span>)</a></em> -->
						<input type="hidden" class="form-control" id="con_attachment_old">
						<div class="input-group">
							<div class="custom-file">								
								<input type="file" class="form-control-file border" id="con_attachment" onchange="uploadAttachment();" required>								
							</div>							
						</div>
					</div>
					<div class="row">
						<div class="col-6">
							<div class="form-group">
								<label for="con_datefrom">From</label>
								<input type="date" class="form-control" id="con_datefrom">
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label for="con_dateto">To</label>
								<input type="date" class="form-control" id="con_dateto">
							</div>
						</div>
					</div>
					<input type="hidden" class="form-control" id="con_per_id" value="<?php echo $logged_userID;?>">
					<div class="form-group">
						<div class="custom-control custom-switch">
							<input type="checkbox" class="custom-control-input" id="con_display">	
							<label class="custom-control-label" for="con_display">Display</label>							
						</div>
					</div>					
                </div>
                <div class="card-footer">
					<button type="button" class="btn btn-default" id="cancel" onClick="return confirm('Cancel action?') ? window.location.href='?p=configuration' : false;">Cancel</button>
					<button type="submit" class="btn btn-primary float-right" id="submit" onClick="return confirm('Save action?') ? processForm('<?php echo $data['0']['2'];?>') : false;"><?php echo ($data['0']['2'] == "new" ? "Submit" : "Update");?></button>
				</div>
            </form>
			<?php
			$result = $controller->getContent($data);
			
			if($result['0'] == 1){ $row = $result['2']->fetch_assoc();
				?>
				<script>
					$('#con_id').val('<?php echo $row["con_id"];?>');
					$('#con_cou_id').val('<?php echo $row["con_cou_id"];?>');
					$('#con_title').val('<?php echo $row["con_title"];?>');
					$('#con_description').val('<?php echo $row["con_description"];?>');
					// $('#con_attachment').val('<?php echo $row["con_attachment"];?>');
					$('#con_attachment_old').val('<?php echo $row["con_attachment"];?>');
					$('#con_attachment_label').html('<?php echo $row["con_attachment"];?>');
					/*
					$('#con_attachment-old').val('<?php echo $row["con_attachment"];?>');
					$('#con_attachment-text').html('<?php echo $row["con_attachment"];?>');
					$('#con_attachment-link').attr({
						target: '_blank', 
						href  : '../data/<?php echo $row["con_attachment"];?>'
					});
					*/
					$('#con_datefrom').val('<?php echo $row["con_datefrom"];?>');
					$('#con_dateto').val('<?php echo $row["con_dateto"];?>');
					$("#con_display").prop("checked", <?php echo $row["con_display"];?> == 1 ? true : false);
				</script>	
				<?php
			} else {
				?>
				<script>
					alert('<?php echo $result['1'];?> \nYou will be redirected to the main page.');
					window.location.href='?p=configuration';
				</script>
				<?php
			}
		} 
		
	} else if($_POST['data']['0'] == "getSide"){
		$data = array_values($_POST);
			
		if($data['0']['1'] == "category"){
			$result = $controller->getCategories($data);
			
			if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
				?>
				<tr>
					<td>
						<i class="fas fa-layer-group"></i>&nbsp;&nbsp;
						<?php echo $row['cat_name'];?>
					</td>
					<td align="right">
						<button class="btn btn-xs btn-default" onClick="moveSort(<?php echo $row['cat_id'];?>,-1,<?php echo $row['cat_sort'];?>);">
							<i class="fas fa-arrow-up"></i>
						</button>
						<button class="btn btn-xs btn-default" onClick="moveSort(<?php echo $row['cat_id'];?>,1,<?php echo $row['cat_sort'];?>);">					
							<i class="fas fa-arrow-down"></i>
						</button>
						<?php $result2 = $controller->getCourses(array(array(0,'', '', $row['cat_id'], ''))); ?>
						<button href="#" <?php echo (isset($result2['3']) ? "disabled" : "");?> class="btn btn-xs btn-default" onClick="return confirm('Confirm delete?') ? deleteOption(<?php echo $row['cat_id'];?>) : 'false';">
							<i class="fas fa-trash-alt"></i>
						</button>
					</td>
				</tr>
				<?php
			}} else{
				?>
				<tr>
					<td colspan="2"><?php echo $result['1'];?></td>
				</tr>
				<?php
			}	
			
		} else if($data['0']['1'] == "course"){
			$result = $controller->getCourses($data);
			
			if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
				?>
				<tr>
					<td>
						<i class="fas fa-book"></i>&nbsp;&nbsp; 
						<?php echo $row['cou_name'];?>
					</td>
					<td align="right">
						<button class="btn btn-xs btn-default" onClick="moveSort(<?php echo $row['cou_id'];?>,-1,<?php echo $row['cou_sort'];?>);">
							<i class="fas fa-arrow-up"></i>
						</button>
						<button class="btn btn-xs btn-default" onClick="moveSort(<?php echo $row['cou_id'];?>,1,<?php echo $row['cou_sort'];?>);">					
							<i class="fas fa-arrow-down"></i>
						</button>
						<?php $result2 = $controller->getContents(array(array(0,'', '', $row['cou_cat_id'], ''))); ?>
						<button href="#" <?php echo (isset($result2['3']) ? "disabled" : "");?> class="btn btn-xs btn-default" onClick="return confirm('Confirm delete?') ? deleteOption(<?php echo $row['cou_id'];?>) : 'false';">
							<i class="fas fa-trash-alt"></i>
						</button>
					</td>
				</tr>
				<?php
			}} else{
				?>
				<tr>
					<td colspan="2"><?php echo $result['1'];?></td>
				</tr>
				<?php
			}	
			
		} else if($data['0']['1'] == "content"){
			$result = $controller->getContents($data);
			
			if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
				?>
				<tr>
					<td>
						<i class="fas fa-book-open"></i>&nbsp;&nbsp; 
						<?php echo $row['con_title'];?><br>
						<small><small><?php echo $row['cou_name'];?></small></small>
					</td>
					<td align="right">
						<button class="btn btn-xs btn-default" onClick="moveSort(<?php echo $row['con_id'];?>,-1,<?php echo $row['con_sort'];?>);">
							<i class="fas fa-arrow-up"></i>
						</button>
						<button class="btn btn-xs btn-default" onClick="moveSort(<?php echo $row['con_id'];?>,1,<?php echo $row['con_sort'];?>);">					
							<i class="fas fa-arrow-down"></i>
						</button>
						<button href="#" class="btn btn-xs btn-default" onClick="displayToggle(<?php echo $row['con_id'];?>,<?php echo $row['con_display'];?>);">
							<i class="fas fa-eye<?php echo ($row['con_display'] == 1 ? "" : "-slash");?>"></i>
						</button>
						<button href="#" class="btn btn-xs btn-default" onClick="return confirm('Confirm delete?') ? deleteOption(<?php echo $row['con_id'];?>) : 'false';">
							<i class="fas fa-trash-alt"></i>
						</button>
					</td>
				</tr>
				<?php
			}} else{
				?>
				<tr>
					<td colspan="2"><?php echo $result['1'];?></td>
				</tr>
				<?php
			}			
		}
		
	} else if($_POST['data']['0'] == "saveOption"){
		$data = array_values($_POST);
			
		if($data['0']['1'] == "category"){
			$result = $controller->saveCategory($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);
			exit();
			
		} else if($data['0']['1'] == "course"){
			$result = $controller->saveCourse($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);
			exit();	

		} else if($data['0']['1'] == "content"){
			$result = $controller->saveContent($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);
			exit();	
		}
		
	} else if($_POST['data']['0'] == "editOption"){
		$data = array_values($_POST);
			
		if($data['0']['1'] == "category"){
			$result = $controller->updateCategory($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);
			exit();
			
		} else if($data['0']['1'] == "course"){
			$result = $controller->updateCourse($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);
			exit();
			
		} else if($data['0']['1'] == "content"){
			$result = $controller->updateContent($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);
			exit();
			
		} 
	
	} else if($_POST['data']['0'] == "deleteOption"){
		$data = array_values($_POST);
			
		if($data['0']['1'] == "category"){
			$result = $controller->deleteCategory($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);
			exit();
			
		} else if($data['0']['1'] == "course"){
			$result = $controller->deleteCourse($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);
			exit();
			
		} else if($data['0']['1'] == "content"){
			$result = $controller->deleteContent($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);
			exit();
			
		} 
		
	} else if($_POST['data']['0'] == "moveSort"){
		$data = array_values($_POST);
			
		if($data['0']['1'] == "category"){
			$result = $controller->moveSortCategory($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);
			exit();
			
		} else if($data['0']['1'] == "course"){
			$result = $controller->moveSortCourse($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);
			exit();
			
		} else if($data['0']['1'] == "content"){
			$result = $controller->moveSortContent($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);
			exit();
			
		} 
		
	} else if($_POST['data']['0'] == "displayToggle"){
		$data = array_values($_POST);
			
		$result = $controller->displayToggle($data);
			
		header("Content-Type: application/json");
		echo json_encode($result);
		exit();
	}
	
}
?>
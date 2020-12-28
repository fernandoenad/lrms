$(document).ready(function(){
	const urlParams = new URLSearchParams(window.location.search);
	var catID = urlParams.get('catID');
	var courseID = urlParams.get('courseID');
	getCourses(catID);
	getContents(courseID);
	getCategoryName(catID);	
	getCourseName(courseID);
});

function getCourses(catID){
	var action = 'getCourses';
	var data = [action, catID];
	
	$.ajax({
		type: 'POST',
		url: 'mod/browse/action.php',
		data: {data:data},	
		success: function(result){
			$('#course-list').html(result);			 
		}
	});
}

function getContents(courseID){
	var action = 'getContents';
	var data = [action, courseID]; 
			
	$.ajax({
		type: 'POST',
		url: 'mod/view/action.php',
		data: {data:data},	
		success: function(result){
			$('#content-list').html(result);
		}
	});
}

function getCategoryName(catID){
    var action = 'getCategoryName';
	var data = [action, catID];
	
	$.ajax({
		type: 'POST',
		url: 'mod/browse/action.php',
		data: {data:data},	
		success: function(result){
			$('#bc-link-2').html('<a href="?p=browse&catID='+catID+'">'+result[2].cat_name+"</a>");
		}
	});
}

function getCourseName(courseID){
    var action = 'getCourseName';
	var data = [action, courseID];
	
	$.ajax({
		type: 'POST',
		url: 'mod/view/action.php',
		data: {data:data},	
		success: function(result){
			$('#bc-link-3').html(result[2].cou_name);
		}
	});
}

function downloadCount(conID){
    var action = 'downloadCount';
	var data = [action, conID];
	
	$.ajax({
		type: 'POST',
		url: 'mod/view/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				toastr.success(result[1]);
			} else {
				toastr.error(result[1]);
			}
		}
	});	
}
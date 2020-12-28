$(document).ready(function(){
	const urlParams = new URLSearchParams(window.location.search);
	var catID = urlParams.get('catID');
	getCourses(catID);
	getCategoryName(catID);
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

function getCategoryName(catID){
    var action = 'getCategoryName';
	var data = [action, catID];
	
	$.ajax({
		type: 'POST',
		url: 'mod/browse/action.php',
		data: {data:data},	
		success: function(result){
			$('#bc-link-2').html(result[2].cat_name);
		}
	});
}
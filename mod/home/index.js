$(document).ready(function(){
	getCategories();
});

function getCategories(){
	var action = 'getCategories';
	var data = [action];
	
	$.ajax({
		type: 'POST',
		url: 'mod/home/action.php',
		data: {data:data},	
		success: function(result){
			$('#category-list').html(result);
		}
	});
}

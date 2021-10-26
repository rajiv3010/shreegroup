$(document).ready(function() {
$('.generationLevelC').click(function() {
        var level = $(this).data('user-level');  
		var user_id = $("#user_id").val();
        $("#clevel").text(level);    
			$.ajax({
			url: '/tree/generationLevel.jsp/'+user_id+'/'+level
			}).done(function(data) {
						$("#gld").empty();
						$("#gld").append(data);
			});
	
} );
$(".loading").show();
getLevel();
function getLevel(){
	$("#clevel").text(1);    
	var user_id = $("#user_id").val();
	$.ajax({
	url: '/tree/generationLevel.jsp/'+user_id+'/'+1
	}).done(function(data) {
	$("#gld").empty();
	$("#gld").append(data);
	});

	}
});
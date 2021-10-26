
$("#pan").keyup(function(e) {
        var pan = $(this).val();

   if (pan_no.value != "") {
      if (pan.length ==10){
            PanNo = pan_no.value;
            var panPattern = /^([a-zA-Z]{5})(\d{4})([a-zA-Z]{1})$/;
            if (PanNo.search(panPattern) == -1) {
                alert("Invalid Pan No");
                pan_no.focus();
                pan_no.value='';
                return false;
            }
          
        }
}

});

$(document).ready(function() {



var dt = new Date();
dt.setFullYear(new Date().getFullYear()-18);
  $(".dob").datepicker({
        viewMode: "years",
        endDate : dt
});
getNotification();
var user_key = $("#current_user").val();
if (user_key==undefined){

}else{
 getTree(user_key);
}



$( "#orgChartContainer" ).on( "click", ".myTree", function() {
			var user_key=$(this).attr('data-my-userKey');
			
			getTree(user_key);
});

$( "#apc_package" ).change(function() {
		var package_id =  $(this).val();
		var option ="";
		option +="<option>";
		option +="Searching...";
		option +="</option>";
		$("#apc_my_pins").html(option);

		$.ajax({
			url: '/dpc/get-apc/pin/'+ package_id
			}).done(function(data) {
					$("#takkingPin").text(" ");	
					if (data==0){
						var option ="";
						 option +="<option value='0'>";
						 option +="No pins for this package";
						 option +="</option>";
     					$("#apc_my_pins").html(option);

					}else{
					var obj = JSON.parse(data);
					var option ="";
					$.each( obj, function( key, value ) {
						 option +="<option value="+value.pin_number+">";
						 option +=""+value.pin_number+"";
						 option +="</option>";
					});
					$("#apc_my_pins").html(option);

					}
			});

});
$( "#addNew_package" ).change(function() {
		var package_id =  $(this).val();
		var option ="";
		option +="<option>";
		option +="Searching...";
		option +="</option>";
		$(".addNewUserPin").html(option);

		$.ajax({
			url: '/user/get/pin/'+ package_id
			}).done(function(data) {
					if (data==0){
						var option ="";
						 option +="<option value='0'>";
						 option +="No pins for this package";
						 option +="</option>";
     					$(".addNewUserPin").html(option);
					}else{
					var obj = JSON.parse(data);
					var option ="";
					$.each( obj, function( key, value ) {
						 option +="<option value="+value.pin_number+">";
						 option +=""+value.pin_number+"";
						 option +="</option>";
					});
					$(".addNewUserPin").html(option);

					}
			});

});

$( "#state_id" ).change(function() {
		var state_id =  $(this).val();
		$.ajax({
			url: '/classified/cities/'+ state_id
			}).done(function(data) {
					var obj = JSON.parse(data);
					var option ="";
     	        	getPin(obj[0].id)
					$.each( obj, function( key, value ) {
						 option +="<option value="+value.id+">";
						 option +=""+value.name+"";
						 option +="</option>";
					});
					$("#city_id").html(option);
			});

});

$( "#city_id" ).change(function() {
		 var city_id =  $(this).val();	
		 	getPin(city_id)
		});


	$( "#business_category_id" ).change(function() {
			var id =  $(this).val();
			if (id){
					if (id=='0'){
						var option = "<input  type='checkbox' name='business_sub_category_id[]' class='business_sub_category_id' value='0'>Other</option>";
						$("#business_sub_category_id").html(option);
					}else{
						
		$.ajax({
			url: '/classified/sub_business_category/'+ id
			}).done(function(data) {
					var obj = JSON.parse(data);
					var option ="";
					$.each( obj, function( key, value ) {
						option +='<input value='+value.id+' name="business_sub_category_id[]" type="checkbox" class="form-check-input" id="search'+key+'">';
						option +='<label class="form-check-label business_sub_category_id" for="search">'+value.name+'</label>';
						option +='&nbsp;&nbsp;&nbsp;&nbsp;';

					});
					$("#business_sub_category_id").html(option);
			});

			}	
			
			}else{

			}

		});


});




function getNotification(){
	$.ajax({
			url: '/get-notification/user'
			}).done(function(data) {
					$('#notification_li').html(data);
			});

	return false; // do not submit
}

function getTree(user_key){
	$.ajax({
			url: '/getTree/'+user_key,
    		 dataType : 'json'
			}).done(function(testdata) {
					org_chart = $('#orgChart').orgChart({
     				data: testdata.sort(),
     				  showControls: true,
            allowEdit: true,
            onAddNode: function(node){ 
                
                org_chart.newNode(node.data.id); 
            },
            onDeleteNode: function(node){
                
                org_chart.deleteNode(node.data.id); 
            },
            onClickNode: function(node){
               
            }

				});
			});

	return false; // do not submit
}


 function getWidget(){
	$.ajax({
			url: '/get-widget'
			}).done(function(data) {
					$('#loadingstate').hide();
					$('.dashboardwidget').html(data);
			});

	return false; // do not submit
} 

function getPin(city_id) {
	
		$.ajax({
			url: '/classified/cities/pincodes/'+ city_id
			}).done(function(data) {
					var obj = JSON.parse(data);
					var option ="";
					$.each( obj, function( key, value ) {
						 option +="<option value="+value.id+">";
						 option +=""+value.pincode+"";
						 option +="</option>";
					});
					$("#location_id").html(option);
			});
}

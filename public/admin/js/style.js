
$(document).ready(function() {




  $(".filter-pin").change(function(){
    var status = $("#status").val();
    var package_id = $("#package_id").val();
    var token =   $('meta[name="_token"]').attr('content');
     jQuery.ajax({
       url: '/admin/pin/searchFilter',
       method: 'post',
       data: {
          status: status,
          package_id: package_id,
          _token:token
       },
       success: function(e){

           $(".dataRow").html(e)

       }
     });
  });

$('#parent_key_check').keyup(function (event) {   

   var user_key = $(this).val();
  if (user_key.length==6){

    var token =   $('meta[name="_token"]').attr('content');
    jQuery.ajax({
       url: '/user-parent-details/',
       method: 'post',
       data: {
          user_key: user_key,
          _token:token
       },
       success: function(e){
        if (e=="No position available"){

           $("#placementleft").prop("checked", false).hide();
           $("#placementright").prop("checked", false).hide();
            $("#labelplacementRight").hide()
            $("#labelplacementLeft").hide()
          $('.parent_key_status').text(e);
          $("#addUser").attr("disabled", true);
          return false;
        }
        if (e=="Left Leg Free") {
           $("#placementleft").prop("checked", true).show();
           $("#placementright").prop("checked", false).hide();
           $("#addUser").attr("disabled", false);
            $("#labelplacementRight").hide()
            $("#labelplacementLeft").show()

        }
        if (e=="Right Leg Free") {
           $("#placementleft").prop("checked", true).hide();
           $("#placementright").prop("checked", true).show();
           $("#addUser").attr("disabled", false);
            $("#labelplacementRight").show()
            $("#labelplacementLeft").hide()
  
        }
        if (e=="Left and right leg are available") {
           $("#placementleft").prop("checked", true).show();
           $("#placementright").show();
           $("#addUser").attr("disabled", false);
           $("#labelplacementRight").show()
           $("#labelplacementLeft").show()
   
        }
        $('.parent_key_status').text(e);

       }
     });
  }
 
});



$('#pan').keyup(function (event) {   

       var regExp = /[a-zA-z]{5}\d{4}[a-zA-Z]{1}/; 
       var txtpan = $(this).val(); 
       if (txtpan.length == 10 ) { 
            if( txtpan.match(regExp) ){ 
               $('.panError').text('PAN match found');
            } else {
         $('.panError').text("Not a valid PAN number");
         event.preventDefault(); 
        } 
       }else { 
             $('.panError').text('Please enter 10 digits for a valid PAN number');
             event.preventDefault(); 
       } 

});





$("body").on("click", ".upload_doc_test",function(){
        $("#"+$(this).data('doc-name')).click();
    });

$("body").on("click", ".leftTableButton",function(){
                    
             $(".lefttableTree").fadeToggle();       

    });

    $("body").on("click", ".rightTableButton",function(){
                    
             $(".righttableTree").fadeToggle();       

    });

    $(".my-file").change(function(){
        $("#form-"+$(this).data('doc-id')).submit();
    });

  $(".copy").click(function(){
         copyToClipboardMsg($(this).attr('data-c-url'),'msg');
});
          




  $("#make_id").change(function(){
    var make_id = $(this).val();
  	var token = 	$('meta[name="_token"]').attr('content');
    jQuery.ajax({
       url: '/admin/car-make/model',
       method: 'post',
       data: {
          make_id: make_id,
          _token:token
       },
       success: function(e){
         var n = JSON.parse(e),
             t = "<option value=" + n.id + ">Select Model</option>";
         $.each(n, function(e, n) {
             t += "<option value=" + n.id + ">", t += "" + n.code, t += "</option>"
         }), $(".car_model_id").html(t)

       }
     });
  });



    $("body").on("click", ".sendtestEmail", function() {
        $("#myModal").modal("toggle"); $(".compnayName").text($(this).attr("data-compnay-name")), $(".send_advertisement_id").val($(this).attr("data-ad-id"))
    }),
     $("#is_affiliate").on("click", function() {
        $(".yes_affiliate").toggle()
    }),

	 $("body").on("click",".removeUserDetails",function() {
        $(".userDetailsDiv").hide()
    }),
	 $(".showUserDetails").on("click", function() {
        $(".userDetailsDiv").show()
    }),
$(".orderStatusChange").change(function()
{
            var OrderDetailsID = $(this).find(':selected').attr('data-detail-id');
            var status = $(this).val();
            swal({
            title: "Are you sure?",
            text: "You want to update product stat!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete)
            {
                $.ajax({
                    url: "/admin/mall/orders/orderStatus/"+ OrderDetailsID+"/"+status
                }).done(function(e) {
                });
                    swal("Done! Your Product status has been changed!", {
                    icon: "success",
                });

            } else
             {
                swal("Your imaginary file is safe!");
              }
            });
    }),


$( ".TreeGetDetails" ).mouseover(function() {
    alert($(this).attr('data-user-key'));
});



    $(".assignPinUser").keyup(function(e) {
        var user_key = $(this).val();
    	if (user_key.length > 5){
    	var token = 	$('meta[name="_token"]').attr('content');
    	e.preventDefault();
               jQuery.ajax({
                  url: '/transferpin/userDetails',
                  method: 'post',
                  data: {
                     user_key: user_key,
                     _token:token
                  },
                  success: function(result){
                  	if(result.status){
                  			var htmlData ='<h3>'+result.user.name+'</h3>';
								           
					$(".userDetailsDiv").html(htmlData);
                  	}else{

                  	}
                  }});
           }else{
           	return false;
           }
    }),




    $("#discount").keyup(function() {
        var e = $("#cost").val(),
            a = $(this).val();
        a = a || 0;
        var s = parseFloat(e) * parseFloat(a) / 100;
        $("#our_price").val(parseFloat(e) - s)
    }), $(".confirmation").on("click", function() {
        return confirm("Are you sure? Release the amount for the user")
    }), $(".changeProfile_photo").click(function() {
        $("#profile_photo").click()
    }), $(".advertisementsHistoryDetails").click(function() {
        var e;
        e = $(this).data("adver-id"), $.ajax({
            url: "/admanagement/history/details/" + e
        }).done(function(e) {
            return $("#advertisementsHistoryDetailsTable").html(e), !1
        })
    }), $("#profile_photo").change(function() {
        $(".loading").show(), $("#profileForm").submit()
    }), 
    

     $(".advertiser_id").change(function() {
        $("#company_name").val($(this).find(":selected").attr("data-cname"))
    }), $(".admanagement_id").change(function() {
        3 == $(this).val() ? ($(".cpltemplate").show(), $(".cpltemplate").html('<div class="form-group col-lg-6"><label>Make Template</label><br>Yes<input type="radio" name="is_template" checked="checked"  value="1">No<input type="radio" name="is_template"   value="0"></div>')) : ($(".cpltemplate").hide(), $(".cpltemplate").empty())
    }), $("#ad_level").keyup(function() {
        var e = $(this).val();
        if (e > 20) return alert("Level max limit is 20"), !1;
        $("#levelArea").empty();
        var a = "";
        for (index = 1; index <= e; ++index) a = '<div class="form-group col-lg-2">', a += "<label>Level " + index + "</label>", a += '<div class="input-group date">', a += '<div class="input-group-addon">', a += '<i class="fa fa-percent" aria-hidden="true"></i>', a += "</div>", a += '<input type="text"  name="levelpercent[]" class="form-control pull-right" placeholder="Enter percent for level ' + index + '" id="level">', a += "</div>", a += "</div>", $("#levelArea").append(a)
    }), $(".verify-pin-assoicate").click(function() {
        $(".message").html("<span class='alert alert-warning'>Please wait...   <i class='fa fa-spinner fa-spin fa-fw'></i></span>"), $(".messageDiv").slideDown(950), $(".loading").show();
        var e = $("#package_id").val(),
            a = $("#pin").val();
        return a ? e ? void $.ajax({
            url: "/verifypin/classified.jsp/" + a + "/" + e
        }).done(function(e) {
            $(".loading").hide(), 1 == e ? ($(".message").html("<span class='alert alert-success'>Pin Verifed <i class='fa fa-check' aria-hidden='true'></i></span>"), $(".addNewUser").attr("disabled", !1)) : ($(".message").html("<span class='alert alert-danger'>Pin not Verify <i class='fa fa-remove fa-fw'></i></span>"), $(".addNewUser").attr("disabled", !0))
        }) : ($(".message").html("<span class='alert alert-warning'>Please select package </span>"), !1) : ($(".message").html("<span class='alert alert-warning'>Please enter pin </span>"), !1)
    }), $("#verify-pin").click(function() {
        $(".message").html("<span class='alert alert-warning'>Please wait...   <i class='fa fa-spinner fa-spin fa-fw'></i></span>"), $(".messageDiv").slideDown(950), $(".loading").show(), $("#checksign").hide(), $("#verify-failed").hide();
        var e = $("#package_id").val(),
            a = $("#pinVerify").val();
        $.ajax({
            url: "/verifypin/classified.jsp/" + a + "/" + e
        }).done(function(e) {
            if ($(".loading").hide(), "dpc" == $("#dpc").val()) return 1 == e ? ($("#message").empty(), $("#message").html("<span class='alert alert-warning'>PIN Verifed  <i class='fa-li fa fa-check-square'></i></span>"), !1) : ($("#message").html("<span class='alert alert-danger'>Invalid combination   <i class='fa fa-remove'></i></span>"), !1);
            1 == e ? ($("#verify-pin").hide(), $("#verify-success").show()) : ($("#checksign").show(), $("#verify-pin").show(), $("#verify-failed").show())
        })
    }),$("#NextRegistration_details").click(function() {
        var e = $("#package_id").val(),
            a = $("#pin").val(),
            s = $("#sponsor_key").val();
        return a ? s ? ($.ajax({
            url: "/get-started/user/packageVerification.jsp/" + e + "/" + a + "/" + s
        }).done(function(e) {
            if (0 == e) return $(".message").html('<div class="alert alert-danger">Either your PIN is used or Invalid</div>'), $(".messageDiv").slideDown(950), !1;
            $(".message").html('<div class="alert alert-success">Details verify succesfully</div>'), $(".messageDiv").slideUp(950), $("#registration_page").html(e), $("#pin_details").slideUp(1e3), $(".registration_details").slideDown(950)
        }), !1) : ($(".message").html('<div class="alert alert-danger">Please Enter sponsor key</div>'), $(".messageDiv").slideDown(950), !1) : ($(".message").html('<div class="alert alert-danger">Please Enter PIN</div>'), $(".messageDiv").slideDown(950), !1)
    }); $("body").on("keyup", "#name", function() {
        $("#payee_name").val($(this).val())
    });

     $("#sponsor_key").keyup(function() {
        var e, a = $(this).val();
        6 >= a.toString().length ? (e = a, $.ajax({
            url: "/check/user/sponserUserName.jsp/" + e
        }).done(function(e) {
            var a = jQuery.parseJSON(e);
            return 0 == e ? ($("#sponser_name").removeClass("alert-success").addClass("alert-warning"), $("#sponser_name").html("Invalid id"), $("#sponser_name").slideDown(1e3)) : ($("#sponser_name").removeClass("alert-warning").addClass("alert-success"), $("#sponser_name").html(a.user_name), $("#sponser_name").slideDown(1e3)), !1
        }), $("#sponser_name").slideDown(1e3), $("#sponser_name").text("searching..."), $("#NextRegistration_details").attr("disabled", !1)) : $("#NextRegistration_details").attr("disabled", !0)
    }); 

     $(".login-page").on("click", ".resetDetails", function() {
        $("#registration_page").show(), $("#previewPageContent").hide()
    });












});


  $(".copy").click(function(){
  /* Get the text field */
  var share = $(this).attr("data-url-share");
  $("#c").val(share);
  var copyText = document.getElementById('c');
  copyText.select();
  document.execCommand("copy");
    setTimeout(function() {
        $("#msg").text("Copied the text: " + copyText.value);
    },100);
});


function getNotification() {
    return $.ajax({
        url: "/get-notification/user"
    }).done(function(e) {
        $("#notification_li").html(e)
    }), !1
}

function getTree(e) {
    return $.ajax({
        url: "/getTree/" + e,
        dataType: "json"
    }).done(function(e) {
        org_chart = $("#orgChart").orgChart({
            data: e.sort(),
            showControls: !0,
            allowEdit: !0,
            onAddNode: function(e) {
                org_chart.newNode(e.data.id)
            },
            onDeleteNode: function(e) {
                org_chart.deleteNode(e.data.id)
            },
            onClickNode: function(e) {}
        })
    }), !1
}

function getWidget() {
    return $.ajax({
        url: "/get-widget"
    }).done(function(e) {
        $("#loadingstate").hide(), $(".dashboardwidget").html(e)
    }), !1
}

function getPin(e) {
    $.ajax({
        url: "/classified/cities/pincodes/" + e
    }).done(function(e) {
        var n = JSON.parse(e),
            t = "";
        $.each(n, function(e, n) {
            t += "<option value=" + n.id + ">", t += "" + n.pincode, t += "</option>"
        }), $("#location_id").html(t)
    })
}
$(document).ready(function() {
    var n = $("#current_user").val();
    null == n || getTree(n), $("#orgChartContainer").on("click", ".myTree", function() {
        getTree($(this).attr("data-my-userKey"))
    }), $("#apc_package").change(function() {
        var e = $(this).val();
        $("#apc_my_pins").html("<option>Searching...</option>"), $.ajax({
            url: "/dpc/get-apc/pin/" + e
        }).done(function(e) {
            if ($("#takkingPin").text(" "), 0 == e) {
                var t = "";
                t += "<option value='0'>", t += "No pins for this package", t += "</option>", $("#apc_my_pins").html(t)
            } else {
                var n = JSON.parse(e);
                t = "";
                $.each(n, function(e, n) {
                    t += "<option value=" + n.pin_number + ">", t += "" + n.pin_number, t += "</option>"
                }), $("#apc_my_pins").html(t)
            }
        })
    }), 


    $("#addNew_package").change(function() {
        var e = $(this).val();
        $(".addNewUserPin").html("<option>Searching...</option>"), $.ajax({
            url: "/user/get/pin/" + e
        }).done(function(e) {
            if (0 == e) {
                var t = "";
                t += "<option value='0'>";
                t += "No pins for this package";
                t += "</option>";
                $(".addNewUserPin").html(t);
            } else {
                var n = JSON.parse(e);
                t = "";
                $.each(n, function(e, n) {
                    t += "<option value=" + n.pin_number + ">";
                    t += "" + n.pin_number;
                     t += "</option>"
                });
                 $(".addNewUserPin").html(t);
            }
        })
    }),
    $("#getAcpPackage").change(function() {
        var e = $(this).val();
        $(".addNewUserPin").html("<option>Searching...</option>"), $.ajax({
            url: "/apc/get/pin/" + e
        }).done(function(e) {
            if (0 == e) {
                var t = "";
                t += "<option value='0'>", t += "No pins for this package", t += "</option>", $(".addNewUserPin").html(t)
            } else {
                var n = JSON.parse(e);
                t = "";
                $.each(n, function(e, n) {
                    t += "<option value=" + n.pin_number + ">", t += "" + n.pin_number, t += "</option>"
                }), $(".addNewUserPin").html(t)
            }
        })
    }),

     $("#state_id").change(function() {
        var e = $(this).val();
        $.ajax({
            url: "/classified/cities/" + e
        }).done(function(e) {
            var n = JSON.parse(e),
                t = "";
            getPin(n[0].id), $.each(n, function(e, n) {
                t += "<option value=" + n.id + ">", t += "" + n.name, t += "</option>"
            }), $("#city_id").html(t)
        })
    })

     $("#MallproductCategory").change(function() {
        var e = $(this).val();
            if (e==1) {
            $(".forClothing").show();
        }else{
            $(".forClothing").hide();
        }
        $.ajax({
            url: "/admin/mall/product/getSubCategory/" + e
        }).done(function(e) {
            if (e==0){
                     $("#producSubcategory").append("<option>Sub category not found</option>")
            }else{
            var n = JSON.parse(e),
                t = "<option value='0'>Select item</option>";
            $.each(n, function(e, n) {
                t += "<option value=" + n.id + ">", t += "" + n.name, t += "</option>"
            }),
            $("#producSubcategory").html(t)

            }
        })
    })

  
         $("#producSubcategory").change(function() {
        var e = $(this).val();
        $.ajax({
            url: "/admin/mall/product/getSubCategoryBrand/" + e
        }).done(function(e) {
            if (e==0){
                     $("#productBrand").html("<option>Sub category not found</option>")

            }else{
            var n = JSON.parse(e),
           t = "<option value='0'>Select item</option>";
            $.each(n, function(e, n) {
                t += "<option value=" + n.id + ">", t += "" + n.name, t += "</option>"
            }),
            $("#productBrand").html(t)

            }
        })

/*RRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRR*/
        $.ajax({
            url: "/admin/mall/product/getSubCategorySize/" + e
        }).done(function(e) {
            if (e==0){
                     $("#size").html("<option>Size not found</option>")
            }else{
            var n = JSON.parse(e),
           t = "<option value='0'>Select item</option>";
            $.each(n, function(e, n) {
                t += "<option value=" + n.id + ">", t += "" + n.size, t += "</option>"
            }),
            $("#size").html(t)

            }
        })

/*TTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTT*/
/***********************************************/
        $.ajax({
            url: "/admin/mall/product/getSubCategoryColor/" + e
        }).done(function(e) {

            if (e==0){
                     $("#color").html("<option>Size not found</option>")
            }else{
            var n = JSON.parse(e),
           t = "<option value='0'>Select item</option>";
            $.each(n, function(e, n) {
                t += "<option value=" + n.id + ">", t += "" + n.name, t += "</option>"
            }),
            $("#color").html(t)

            }
        })

/***********************************************/



    })

 $("#productBrand").change(function() {
    })








     $("#city_id").change(function() {
        getPin($(this).val())
    }),

    $("#business_category_id").change(function() {
        var e = $(this).val();
        if (e)
            if ("0" == e) {
                $("#business_sub_category_id").html("<input  type='checkbox' name='business_sub_category_id[]' class='business_sub_category_id' value='0'>Other</option>")
            } else $.ajax({
                url: "/classified/sub_business_category/" + e
            }).done(function(e) {
                var n = JSON.parse(e),
                    t = "";
                $.each(n, function(e, n) {
                    t += "<input value=" + n.id + ' name="business_sub_category_id[]" type="checkbox" class="form-check-input" id="search' + e + '">', t += '<label class="form-check-label business_sub_category_id" for="search">' + n.name + "</label>", t += "&nbsp;&nbsp;&nbsp;&nbsp;"
                }), $("#business_sub_category_id").html(t)
            })
    })

    $("#productCategory").change(function() {
        var e = $(this).val();
        if (e)
            if ("0" == e) {
                $("#business_sub_category_id").html("<input  type='checkbox' name='business_sub_category_id[]' class='business_sub_category_id' value='0'>Other</option>")
            } else $.ajax({
                url: "/classified/sub_business_category/" + e
            }).done(function(e) {
                var n = JSON.parse(e),
               t = "<option value='0'>Select item</option>";
                $.each(n, function(e, n) {
                    t += "<input value=" + n.id + ' name="business_sub_category_id[]" type="checkbox" class="form-check-input" id="search' + e + '">', t += '<label class="form-check-label business_sub_category_id" for="search">' + n.name + "</label>", t += "&nbsp;&nbsp;&nbsp;&nbsp;"
                }), $("#business_sub_category_id").html(t)
            })
    })


});

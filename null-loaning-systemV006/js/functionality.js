$(document).ready(function() {
    $("#time_allotment").datepicker();
    $("#divContent").html($("#homeContent").html());
    
    display_clients();
    display_transactions();
	display_properties();
    
    $("#date").val(get_date());
	$("#search_client").keyup(function() {
		alert("yhis");
        $.ajax({
            type: "POST",
            url: "../php/objects/transaction/search_client.php",
            data: {"search_data": $("#search_client").val()},
            success: function(data) {
                $("#client_list").html(data);
            },
            error: function(data) {
                console.log("There's an error in searching a client. It says " + JSON.stringify(data));
            }
        });

        if($("#search_product_input_field").val() == "") {
            display_products();
        }
    });
	
    $("#form_client_data").submit(function() {
    	return false;
    });
		
	$("#cmd_home").click(function() {
		$("#divContent").html($("#homeContent").html());
		$("#date").val(get_date());
	}); 
	
	$("#cmd_clients").click(function() {
		$("#divContent").html($("#clientsContent").html());
	});  
	
	$("#cmd_transactions").click(function() {
		$("#divContent").html($("#transactionsContent").html());
	});
	
	$("#cmd_properties").click(function() {
		$("#divContent").html($("#propertiesContent").html());
	});
	
	$("#btn_submit_client_data").click(function() {
		var last_name = $("#lastname").val();
		var first_name = $("#firstname").val();
		var address = $("#address").val();
		var contact = $("#contact").val();
		var email = $("#email").val();
		var job = $("#job").val();
		var income = $("#income").val();
		
		var loan_type = $("#loan_type").val();
		var title = $("#loan_title").val();
		var amount = $("#amount").val();
		var collateral = $("#collateral").val();
		var mode_of_payment = $("#mode_of_payment").val();
		var remarks = $("#remarks").val();
		
		$.ajax({
			type: "POST",
            url: "php/objects/transaction/add_client.php",
            data: {"last_name": last_name, "first_name": first_name, "address": address, "contact": contact, "email": email, "job": job, "income": income,
            	   "date": "today", "loan_type": loan_type, "title": title, "amount": amount, "balance": amount, "collateral": collateral, "mode_of_payment": mode_of_payment,
            	   "remarks": remarks},
            success: function(data) {
            	console.log(data);
                alert("Data saved!");
                display_clients();
            },
            error: function(data) {
                console.log("There's an error in adding client. It says " + JSON.stringify(data));
            }
		});
	});
    
    $("#btn_login").click(function() {
    	$("#div_loading").html("Checking account...");
        $("#div_loading").dialog({
            title: "Please wait...",
            top: 0,
            modal: true,
            resizable: false,
            draggable: false,
            height: 100,
            width: 200,
            show: {effect: 'slide', direction: 'up'},
            hide: {effect: 'slide', direction: 'up'}
        });
        
        $.ajax({
            type: "POST",
            url: "php/objects/users/check_if_account_exist.php",
            data: {"username": $("#username").val(), "password": $("#password").val()},
            success: function(data) {
            	console.log(data);
                if(data == "admin") {
                	window.location.href = 'home.php';
                } else if(data == "client") {
                	window.location.href = 'client_home.php';
                } else {
                	$("#div_loading").html("Invalid credentials!");
                }
            },
            complete: function() {
            	$("#div_loading").dialog("close");
            },
            error: function(data) {
                console.log("There's an error in checking users account. It says " + JSON.stringify(data));
            }
        });
        
    });

});

function display_clients() {
	$.ajax({
		type: "POST",
		url: "php/objects/transaction/display_clients.php",
		success: function(data) {
			$("#client_list").html(data);
		}, 
		error: function(data) {
			console.log("Error in displaying clients. " + JSON.stringify(data));
		}
	});
}

function display_transactions() {
	$.ajax({
		type: "POST",
		url: "php/objects/transaction/display_transactions.php",
		success: function(data) {
			$("#transaction_list").html(data);
		}, 
		error: function(data) {
			console.log("Error in displaying transactions. " + JSON.stringify(data));
		}
	});
}

function display_properties() {
	$.ajax({
		type: "POST",
		url: "php/objects/transaction/display_properties.php",
		success: function(data) {
			$("#properties_list").html(data);
		}, 
		error: function(data) {
			console.log("Error in displaying properties. " + JSON.stringify(data));
		}
	});
}


function addProperty() {
	var type = $("#propType").val();
	var name = $("#propName").val();
	var price = $("#propPrice").val();
	var location = $("#propLocation").val();

	$.ajax({
		type: "POST",
		url: "php/objects/transaction/add_property.php",
		data: {"type": type, "name": name, "price": price, "location": location},
		success: function(data) {
			console.log(data);
			alert("Property saved!");
			display_properties();
		},
		error: function(data) {
			console.log("There's an error in adding client. It says " + JSON.stringify(data));
		}
	});
}

function get_date() {

    var curDateTime = new Date();
    var yr = curDateTime.getFullYear();
    var mnth = curDateTime.getMonth()+1;
    var dt = curDateTime.getDate();
    
    if(mnth < 10) mnth = "0"+mnth;
    if(dt < 10) dt = "0"+dt;
    
    var date = yr+"-"+mnth+"-"+dt;
    return date;
}
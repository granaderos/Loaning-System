$(document).ready(function() {
    $("#time_allotment").datepicker();
    $("#divContent").html($("#homeContent").html());
    
    display_clients();
    display_transactions();
	display_properties();
    
    $("#date").val(get_date());
	
	
	$("#updateClientForm").dialog();
	$("#updateClientForm").dialog("close");
	
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
	
	$("#cmd_home").click(function() {
		window.location.reload();
		//$("#divContent").html($("#homeContent").html());
		//$("#date").val(get_date());
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
	
	$("#type").change(function() {
		var type = $("#type").val();
		if(type != "Cash") {
			$.ajax({
				type: "POST",
				url: "php/objects/transaction/display_property_options.php",
				data: {"type": type},
				success: function(data) {
					$("#propertyTitleTD").html(data);
					getPropertyPrice();
				},
				error: function(data) {
					console.log("There's an error in displaying property options " + JSON.stringify(data));
				}
			});
		} else {
			$("#propertyTitleTD").html("<input type = 'text' id = 'loan_title' />");
			$("#amount").removeAttr("disabled");
			$("#amount").attr("enabled", "true");
			$("#amount").val("");
		}
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
		var date_due = $("#date_due").val();
		var remarks = $("#remarks").val();
		
		$.ajax({
			type: "POST",
            url: "php/objects/transaction/add_client.php",
            data: {"last_name": last_name, "first_name": first_name, "address": address, "contact": contact, "email": email, "job": job, "income": income,
            	   "date": "today", "loan_type": loan_type, "title": title, "amount": amount, "balance": amount, "collateral": collateral, "mode_of_payment": mode_of_payment, "date_due": date_due, "remarks": remarks},
            success: function(data) {
                alert("Data saved!");
                display_clients();
				display_transactions();
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
                	window.location.href = 'null_client.php';
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

var client_id;

function closeUpdateClientForm() {
	$("#updateClientForm").dialog("close");
}

function saveChangesClientInfo() {
	
	var last_name = $("#new_lastname").val();
	var first_name = $("#new_firstname").val();
	var address = $("#new_address").val();
	var contact = $("#new_contact").val();
	var email = $("#new_email").val();
	var job = $("#new_job").val();
	var income = $("#new_income").val();
	
	$.ajax({
		type: "POST",
		url: "php/objects/transaction/update_client.php",
		data: {"client_id": client_id, "last_name": last_name, "first_name": first_name, "address": address, "contact": contact, "email": email, "job": job, "income": income},
		success: function(data) {
			alert("Client's information updated! " + data);
			display_clients();
			$("#updateClientForm").dialog("close");
		},
		error: function(data) {
			console.log("There's an error in updating client. It says " + JSON.stringify(data));
		}
	});
}

function getPropertyPrice() {
	var prop_id = $("#propertyOptions").val();
	
	$.ajax({
		type: "POST",
		url: "php/objects/transaction/get_property_price.php",
		data: {"prop_id": prop_id},
		success: function(data) {
			$("#amount").val(data);
			$("#amount").attr("disabled", "true");
		},
		error: function(data) {
			console.log("There's an error in getting property price. " + JSON.stringify(data));
		}
	});
}

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
			console.log("There's an error in adding property. It says " + JSON.stringify(data));
		}
	});
}
var propId;
function updateProp(id) {
	propId = id;
	
	$("#cmd_add_property").attr("disabled", true);
	$("#cmd_save_property").removeAttr("disabled");
	
	$.ajax({
		type: "POST",
		url: "php/objects/transaction/retrieve_property_data.php",
		data: {"propId": id},
		success: function(data) {
			var d = JSON.parse(data);
			$("#propType").val(d.type);
			$("#propName").val(d.name);
			$("#propPrice").val(d.price);
			$("#propLocation").val(d.location);
		},
		error: function(data) {
			console.log("There's an error in updating property. It says " + JSON.stringify(data));
		}
	});
}

function saveProp() {
	var type = $("#propType").val();
	var name = $("#propName").val();
	var price = $("#propPrice").val();
	var location = $("#propLocation").val();

	$.ajax({
		type: "POST",
		url: "php/objects/transaction/update_property.php",
		data: {"type": type, "name": name, "price": price, "location": location, "propId": propId},
		success: function(data) {
			console.log(data + " at js is " + propId);
			display_properties();
			alert("Property saved!");
			$("#cmd_save_property").attr("disabled", true);
			$("#cmd_add_property").removeAttr("disabled");
		},
		error: function(data) {
			console.log("There's an error in updating property. It says " + JSON.stringify(data));
		}
	});
}

function deleteProp(propId) {
	$.ajax({
		type: "POST",
		url: "php/objects/transaction/delete_property.php",
		data: {"propId": propId},
		success: function(data) {
			display_properties();
		},
		error: function(data) {
			console.log("There's an error in deleting property. It says " + JSON.stringify(data));
		}
	});
}

function show_action_options(id) {
	$.ajax({
		type: "POST",
		url: "php/objects/transaction/get_client.php",
		data: {"client_id": id},
		success: function(data) {
			$("#homeActionClientDiv").html(data);
			$("#homeActionClientDiv").dialog({
				title: "Client on Action",
				top: 0,
				modal: true,
				resizable: false,
				draggable: false,
				height: 500,
				width: 900,
				show: {effect: 'slide', direction: 'up'},
				hide: {effect: 'slide', direction: 'up'}
			});
		},
		error: function(data) {
			console.log("There's an error in getting client. It says " + JSON.stringify(data));
		}
	});
	
}

function updateClient(id) {
	client_id = id;
	
	$("#homeActionClientDiv").dialog("close");
	
	$.ajax({
		type: "POST",
		url: "php/objects/transaction/retrieve_client_data.php",
		data: {"client_id": id},
		success: function(data) {
			var d = JSON.parse(data);
			
			$("#new_lastname").val(d.lastname);
			$("#new_firstname").val(d.firstname);
			$("#new_address").val(d.address);
			$("#new_contact").val(d.contact);
			$("#new_email").val(d.email);
			$("#new_job").val(d.job);
			$("#new_income").val(d.income);
			
			$("#updateClientForm").dialog({
				title: "Updating client's information...",
				top: 5,
				modal: true,
				resizable: false,
				draggable: false,
				height: 500,
				width: 480,
				show: {effect: 'slide', direction: 'up'},
				hide: {effect: 'slide', direction: 'up'}
			});
			
		},
		error: function(data) {
			console.log("There's an error in deleting property. It says " + JSON.stringify(data));
		}
	});
}

function deleteClient(id) {
	var choice = confirm("Client will be permanently deleted from the record.\nSure to delete client?");
	if(choice) {
		$.ajax({
			type: "POST",
			url: "php/objects/transaction/delete_client.php",
			data: {"client_id": id},
			success: function(data) {
				alert(data);
				$("#homeActionClientDiv").dialog("close");
				display_clients();
			},
			error: function(data) {
				console.log("There's an error in deleting client. It says " + JSON.stringify(data));
			}
		});
	} else {
		alert("Transaction cancelled...");
		$("#homeActionClientDiv").dialog("close");
	}
}

function closeClientAction() {
	$("#homeActionClientDiv").dialog("close");
}

function updateBalance(id) {
	var input = prompt("Enter amount: ");
	$.ajax({
			type: "POST",
			url: "php/objects/transaction/update_balance.php",
			data: {"trans_id": id, "amount": input},
			success: function(data) {
				display_transactions();
			},
			error: function(data) {
				console.log("There's an error in deleting client. It says " + JSON.stringify(data));
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
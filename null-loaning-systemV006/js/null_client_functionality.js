$(document).ready(function() {
    $("#time_allotment").datepicker();
    $("#divContent").html($("#nullClientHomeContent").html());
    
	$("#cmd_home").click(function() {
		$("#divContent").html($("#nullClientHomeContent").html());
	}); 
	
	$("#cmd_contact_admin").click(function() {
		$("#divContent").html($("#contactContent").html());
	});  
	
	$("#cmd_new_loan").click(function() {
		$("#divContent").html($("#newLoanContent").html());
	});  
    
    $("#cmd_account").click(function() {
		$("#divContent").html($("#accountContent").html());
	}); 
	
	$("#cmd_cashLoan").click(function() {
		alert("hey");
		$("#cashLoan").dialog({
            top: 0,
            modal: true,
            resizable: false,
            draggable: false,
            height: 100,
            width: 200,
            show: {effect: 'slide', direction: 'up'},
            hide: {effect: 'slide', direction: 'up'}
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
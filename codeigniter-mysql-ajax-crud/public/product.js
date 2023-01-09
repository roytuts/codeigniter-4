$(function() {
	//Delete a row from the table
	$(document).delegate('.delete', 'click', function() { 
		if (confirm('Do you really want to delete record?')) {
			var id = $(this).attr('id');
			var parent = $(this).parent().parent();
			$.ajax({
				url: "http://localhost:8080/index.php/product/delete/" + id,
				cache: false,
				success: function(msg) {
					parent.fadeOut('slow', function() {
						$(this).remove();
					});
					$("#msg").html(msg);
					//location.reload(true)
					/*window.setTimeout(function(){
						window.location.href = "http://localhost:8080/";
					}, 5000);*/
				},
				error: function() {
					$('#msg').html('<span style=\'color:red; font-weight: bold; font-size: 30px;\'>Error deleting record').fadeIn().fadeOut(4000, function() {
						$(this).remove();
					});
				}
			});
		}
	});
	
	//Edit the record
	$(document).delegate('.edit', 'click', function() {
		var parent = $(this).parent().parent();
		
		var id = parent.children("td:nth-child(1)");
		var code = parent.children("td:nth-child(2)");
		var name = parent.children("td:nth-child(3)");
		var price = parent.children("td:nth-child(4)");
		var buttons = parent.children("td:nth-child(5)");
		
		code.html("<input type='text' id='txtCode' value='" + code.html() + "'/>");
		name.html("<input type='text' id='txtName' value='" + name.html() + "'/>");
		price.html("<input type='text' id='txtPrice' value='" + price.html() + "'/>");
		buttons.html("<button id='save'>Save</button>&nbsp;&nbsp;<button class='delete' id='" + id.html() + "'>Delete</button>");
	});
	
	//Save the record
	$(document).delegate('#save', 'click', function() {
		var parent = $(this).parent().parent();
		
		var id = parent.children("td:nth-child(1)");
		var code = parent.children("td:nth-child(2)");
		var name = parent.children("td:nth-child(3)");
		var price = parent.children("td:nth-child(4)");
		var buttons = parent.children("td:nth-child(5)");
		
		$.ajax({
			method: "post",
			url: "http://localhost:8080/index.php/product/update",
			data: {'id' : id.html(), 'code' : code.children("input[type=text]").val(), 'name' : name.children("input[type=text]").val(), 'price' : price.children("input[type=text]").val()},
			cache: false,
			success: function(msg) {
				$("#msg").html(msg);
				code.html(code.children("input[type=text]").val());
				name.html(name.children("input[type=text]").val());
				price.html(price.children("input[type=text]").val());
				buttons.html("<button class='edit' id='" + id.html() + "'>Edit</button>&nbsp;&nbsp;<button class='delete' id='" + id.html() + "'>Delete</button>");
			},
			error: function() {
				$('#msg').html('<span style=\'color:red; font-weight: bold; font-size: 30px;\'>Error updating record').fadeIn().fadeOut(4000, function() {
					$(this).remove();
				});
			}
		});
	});
});

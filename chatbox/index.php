<!DOCTYPE html>
<html>
<head>
	<title>Welcome to basic Chatbox</title>
	<link rel="stylesheet" type="text/css" href="http://localhost/chatbox/bootstrap.min.css">
	<script type="text/javascript" src="http://localhost/chatbox/jquery.js"></script>
	<script type="text/javascript" src="http://localhost/chatbox/bootstrap.min.js"></script>
</head>
<body>
<div class="col-md-6 col-md-offset-3">
	<div class="panel panel-danger">
		<div class="panel-heading">
			<h1>ChatBox</h1>
			<form>
			<div class="form-group">
				<input type="text" name="username" id="username" class="form-control" placeholder="Enter Username">
			</div>
			<div class="form-group">
				<label>Last ID</label>
				<input type="text" name="id" id="id" class="form-control" value="0">
			</div>
		</div>
		<div class="panel-body">
			<div class="form-group">
				<textarea rows="10" class="form-control" name="content" id="content"></textarea>
			</div>

			<div class="form-group">
				<input type="text" name="message" id="message" class="form-control" placeholder="Enter Message Here">
			</div>
			<button class="btn btn-danger" type="button" id="submitBtn">Send</button>
			</form>
		</div>
	</div>
</div>
</body>
<script type="text/javascript">
	$(document).ready(function(){
		$("#submitBtn").click(function(){
			var id = $("#id").val();
			var username = $("#username").val();
			var message = $("#message").val();

			if(username == "" || username == null){
				alert("Username is strickly needed");
			}else{
				if(message == "" || message == null){
					alert("message is strickly needed!!!")
				}else{
					$.ajax({
						url: "http://localhost/chatbox/server.php",
						type: "get",
						data: {"last_id":id, "username": username, "message": message},
						dataType: "json",
						success: function(response, status, http){
								$.each(response, function( index, item){
									$("#content").val($("#content").val() + item.username + " : " + item.message + "\n");
									$("#id").val(item.chat_id);
									$("#message").val("");

								});
							}


					});
				}
			}
		});
		
		

		function viewchat(){
			var id = $("#id").val();
			$.ajax({
				url: "http://localhost/chatbox/server.php",
				type: "get",
				data: {"last_id": id},
				dataType: "json",
				success: function(response, status, http){
					$.each(response, function( index, item){
						$("#content").val($("#content").val() + item.username + " : " + item.message + "\n");
						$("#id").val(item.chat_id);
						$("#message").val("");

					});
				}

			});
			
		}
		//viewchat();
		setInterval(viewchat, 2000);

		

	});
</script>
</html>
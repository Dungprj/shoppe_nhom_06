<?php
session_start();

if (isset($_SESSION['user_name']) == false) {
	// Nếu người dùng chưa đăng nhập thì chuyển hướng website sang trang đăng nhập
	header('Location: ../login.php');
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

<html>
    <head>
        <title>Admin</title>
    </head>
    <body>
        <button><a href="./manage_user.php">Người Dùng</a></button>
        <button><a href="./manage_product.php">Sản Phẩm</a></button>
        <button><a href="./manage_cate.php">Danh Mục</a></button>
        <button><a href="./manage_binhluan.php">Bình luận</a></button>
    </body>
</html>
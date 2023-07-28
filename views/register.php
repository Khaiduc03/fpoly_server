<!DOCTYPE html>
<html>

<head>
  <title>Đăng ký</title>
</head>

<body>
  <h2>Form Đăng ký</h2>
  <form id="registerForm" method="post" action="register.php">
    <label for="username">Tên đăng nhập:</label>
    <input type="text" id="username" name="username" required><br>

    <label for="password">Mật khẩu:</label>
    <input type="password" id="password" name="password" required><br>

    <input type="submit" value="Đăng ký">
  </form>

  <script>
  document.getElementById("registerForm").addEventListener("submit", function(event) {
    event.preventDefault();

    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    var data = {
      "username": username,
      "password": password
    };

    fetch("../auth/register.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded"
        },
        body: new URLSearchParams(data).toString()
      })
      .then(response => response.json())
      .then(data => {
        if (data.message === "Register success") {
          alert("Đăng ký thành công!");
          // Chuyển hướng đến trang đăng nhập sau khi đăng ký thành công
          window.location.href = "login.php";
        } else {
          alert("Đăng ký thất bại!");
        }
      })
      .catch(error => {
        console.error("Lỗi khi gửi yêu cầu: ", error);
      });
  });
  </script>
</body>

</html>
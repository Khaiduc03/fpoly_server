<!DOCTYPE html>
<html>

<head>
  <title>Login Form</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet" />
</head>

<body>
  <h2>Login</h2>
  <form id="loginForm">
    <!-- Email input -->
    <div class="form-outline mb-4">
      <input type="text" id="username" name="username" class="form-control" />
      <label class="form-label" for="username">Email address</label>
    </div>

    <!-- Password input -->
    <div class="form-outline mb-4">
      <input type="password" id="password" name="password" class="form-control" />
      <label class="form-label" for="password">Password</label>
    </div>

    <!-- 2 column grid layout for inline styling -->
    <div class="row mb-4">
      <div class="col d-flex justify-content-center">
        <!-- Checkbox -->
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
          <label class="form-check-label" for="form1Example3"> Remember me </label>
        </div>
      </div>

      <div class="col">
        <!-- Simple link -->
        <a href="#!">Forgot password?</a>
      </div>
    </div>

    <!-- Submit button -->
    <input type="submit" value="Login">
  </form>
  <div id="result"></div>

  <script>
  document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);

    fetch('../auth/login.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        // Handle the response here
        const resultDiv = document.getElementById('result');
        if (data.status === 200) {
          resultDiv.textContent = "Login success!";
          window.location.href = "index.php"; // Chuyển hướng sau khi đăng nhập thành công
        } else {
          resultDiv.textContent = "Login fail. Please check your credentials.";
        }
      })
      .catch(error => {
        console.error('Error:', error);
        const resultDiv = document.getElementById('result');
        resultDiv.textContent = "An error occurred. Please try again later.";
      });
  });
  </script>
</body>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>

</html>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Aishan AI - Login</title>
    <style>
      :root {
        --primary: #6366f1;
        --primary-dark: #4f46e5;
        --secondary: #94a3b8;
        --dark-bg: #0f172a;
        --dark-card: #1e293b;
        --dark-border: #334155;
        --dark-gray: #757575;
        --gray: #e0e0e0;
        --light-gray: #f5f5f5;
        --text-light: #f1f5f9;
        --text-muted: #94a3b8;
        --sidebar-width: 260px;
        --header-height: 70px;
        --footer-height: 80px;
        --error: #e74c3c;
      }

      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      }

      body {
        background: linear-gradient(135deg, var(--dark-bg) 0%, var(--dark-card) 100%);
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 20px;
      }

      .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        width: 100%;
        max-width: 400px;
        background-color: white;
        overflow: hidden;
      }

      .header {
        background-color: var(--primary);
        color: white;
        width: 100%;
        text-align: center;
        padding: 20px 0;
        margin-bottom: 20px;
      }

      .header h2 {
        font-weight: 600;
        font-size: 1.8rem;
      }

      .error {
        color: var(--error);
        background-color: rgba(231, 76, 60, 0.1);
        padding: 12px 15px;
        border-radius: 8px;
        margin: 0 20px 20px;
        width: calc(100% - 40px);
        text-align: center;
        font-size: 0.9rem;
        border-left: 4px solid var(--error);
      }

      .form-container {
        width: 100%;
        padding: 0 30px 30px;
      }

      form {
        display: flex;
        flex-direction: column;
        width: 100%;
      }

      .form-group {
        margin-bottom: 20px;
      }

      label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: var(--dark-gray);
      }

      input {
        border: 1px solid var(--gray);
        border-radius: 8px;
        padding: 0 15px;
        height: 45px;
        width: 100%;
        font-size: 1rem;
        transition: all 0.3s ease;
      }

      input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 2px rgba(74, 108, 247, 0.2);
      }

      .btn {
        background-color: var(--primary);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 12px 20px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s ease;
        height: 45px;
        margin-top: 10px;
      }

      .btn:hover {
        background-color: var(--primary-dark);
      }

      .footer {
        margin-top: 20px;
        text-align: center;
        color: var(--dark-gray);
        font-size: 0.9rem;
      }

      .footer a {
        color: var(--primary);
        text-decoration: none;
      }

      .footer a:hover {
        text-decoration: underline;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="header">
        <h2>Aishan AI</h2>
      </div>

      <?php if (isset($_GET['error'])): ?>
       <div class="error">
        Invalid username or password. Please try again.
       </div>
      <?php endif; ?>

      <div class="form-container">
        <form method="post" action="login.php">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required />
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required />
          </div>

          <button type="submit" class="btn">Sign In</button>
        </form>

        <div class="footer">
          <p>Don't have an account? <a href="#">Sign up</a></p>
        </div>
      </div>
    </div>
  </body>
</html>

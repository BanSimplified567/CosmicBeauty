<?php
// Start a session to store user information on successful login
session_start();
require './config/db.php';

// Initialize variables
$error = '';
$success = '';
$username = '';
$login_attempts = isset($_SESSION['login_attempts']) ? $_SESSION['login_attempts'] : 0;
$last_attempt_time = isset($_SESSION['last_attempt_time']) ? $_SESSION['last_attempt_time'] : 0;

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = trim($_POST['username']);
  $password = $_POST['password'];
  $remember = isset($_POST['remember']) ? true : false;

  // Check for brute force protection
  $current_time = time();
  if ($login_attempts >= 5 && ($current_time - $last_attempt_time) < 300) {
    $error = "Too many failed attempts. Please try again in 5 minutes.";
  } else {
    // Prepare and execute query with prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT id, password, email, created_at FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
      $stmt->bind_result($user_id, $hashed_password, $email, $created_at);
      $stmt->fetch();

      // Verify password (using password_verify for hashed passwords)
      if (password_verify($password, $hashed_password)) {
        // Reset login attempts on successful login
        $_SESSION['login_attempts'] = 0;

        // Set session variables
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['login_time'] = time();

        // Set remember me cookie if checked
        if ($remember) {
          $token = bin2hex(random_bytes(32));
          $expiry = time() + (30 * 24 * 60 * 60); // 30 days

          // Store token in database
          $update_stmt = $conn->prepare("UPDATE users SET remember_token = ?, token_expiry = ? WHERE id = ?");
          $update_stmt->bind_param("ssi", $token, date('Y-m-d H:i:s', $expiry), $user_id);
          $update_stmt->execute();
          $update_stmt->close();

          // Set cookie
          setcookie('remember_token', $token, $expiry, '/', '', true, true);
        }

        // Log successful login
        $log_stmt = $conn->prepare("INSERT INTO login_logs (user_id, ip_address, user_agent, status) VALUES (?, ?, ?, 'success')");
        $log_stmt->bind_param("iss", $user_id, $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']);
        $log_stmt->execute();
        $log_stmt->close();

        // Redirect to index.php
        header("Location: index.php");
        exit;
      } else {
        // Increment login attempts
        $_SESSION['login_attempts'] = $login_attempts + 1;
        $_SESSION['last_attempt_time'] = time();

        // Log failed attempt
        $log_stmt = $conn->prepare("INSERT INTO login_logs (username, ip_address, user_agent, status) VALUES (?, ?, ?, 'failed')");
        $log_stmt->bind_param("sss", $username, $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']);
        $log_stmt->execute();
        $log_stmt->close();

        $error = "Invalid username or password.";
        if ($login_attempts >= 3) {
          $error .= " You have " . (5 - $login_attempts) . " attempts remaining.";
        }
      }
    } else {
      $_SESSION['login_attempts'] = $login_attempts + 1;
      $_SESSION['last_attempt_time'] = time();
      $error = "Invalid username or password.";
    }
    $stmt->close();
  }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Cosmic Beauty</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="favicon.svg">
  <style>
    * {
      font-family: 'Urbanist', sans-serif;
    }

    .cosmic-bg {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #312e81 100%);
      z-index: -10;
      overflow: hidden;
    }

    .star {
      position: absolute;
      background-color: white;
      border-radius: 50%;
      animation: twinkle 3s infinite alternate;
    }

    @keyframes twinkle {
      0% {
        opacity: 0.2;
      }

      100% {
        opacity: 1;
      }
    }

    .galaxy {
      position: absolute;
      border-radius: 50%;
      filter: blur(40px);
      animation: float 20s infinite alternate ease-in-out;
    }

    @keyframes float {
      0% {
        transform: translate(0, 0) scale(1);
      }

      100% {
        transform: translate(100px, 100px) scale(1.2);
      }
    }

    .gradient-text {
      background: linear-gradient(90deg, #8b5cf6, #ec4899, #3b82f6);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .gradient-border {
      position: relative;
      background: linear-gradient(135deg, #0f172a, #1e293b) padding-box,
        linear-gradient(135deg, #8b5cf6, #ec4899) border-box;
      border: 2px solid transparent;
    }

    .shake-animation {
      animation: shake 0.5s ease-in-out;
    }

    @keyframes shake {

      0%,
      100% {
        transform: translateX(0);
      }

      10%,
      30%,
      50%,
      70%,
      90% {
        transform: translateX(-5px);
      }

      20%,
      40%,
      60%,
      80% {
        transform: translateX(5px);
      }
    }

    .loading-spinner {
      border: 3px solid rgba(255, 255, 255, 0.3);
      border-radius: 50%;
      border-top: 3px solid #ffffff;
      width: 20px;
      height: 20px;
      animation: spin 1s linear infinite;
    }

    @keyframes spin {
      0% {
        transform: rotate(0deg);
      }

      100% {
        transform: rotate(360deg);
      }
    }

    .password-strength-bar {
      height: 4px;
      border-radius: 2px;
      transition: all 0.3s ease;
    }

    .floating {
      animation: floatElement 6s ease-in-out infinite;
    }

    @keyframes floatElement {

      0%,
      100% {
        transform: translateY(0);
      }

      50% {
        transform: translateY(-10px);
      }
    }

    .slide-in {
      animation: slideIn 0.5s ease-out forwards;
    }

    @keyframes slideIn {
      from {
        transform: translateY(20px);
        opacity: 0;
      }

      to {
        transform: translateY(0);
        opacity: 1;
      }
    }
  </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4">
  <!-- Cosmic Background -->
  <div class="cosmic-bg" id="cosmicBg"></div>

  <!-- Main Container -->
  <div class="flex flex-col md:flex-row w-full max-w-6xl rounded-2xl overflow-hidden shadow-2xl slide-in">
    <!-- Left Panel - Welcome Section -->
    <div class="md:w-1/2 p-8 md:p-12 gradient-border bg-gradient-to-br from-slate-900 to-slate-800">
      <div class="h-full flex flex-col justify-between">
        <!-- Logo -->
        <div class="floating">
          <div class="flex items-center space-x-3 mb-8">
            <div class="w-12 h-12 rounded-full bg-gradient-to-r from-purple-600 to-pink-500 flex items-center justify-center">
              <i class="fas fa-star text-white text-xl"></i>
            </div>
            <h1 class="text-2xl font-bold text-white">Cosmic Beauty</h1>
          </div>
        </div>

        <!-- Welcome Content -->
        <div class="mb-8">
          <h2 class="text-3xl font-bold text-white mb-4">Welcome Back, Star Traveler!</h2>
          <p class="text-slate-300 mb-8">Access your cosmic beauty account and continue your journey through the galaxy of skincare and wellness.</p>

          <!-- Features -->
          <div class="space-y-6">
            <div class="flex items-start space-x-4">
              <div class="w-10 h-10 rounded-full bg-purple-900/50 flex items-center justify-center flex-shrink-0">
                <i class="fas fa-shield-alt text-purple-400"></i>
              </div>
              <div>
                <h4 class="font-semibold text-white mb-1">Secure Login</h4>
                <p class="text-slate-300 text-sm">Your data is protected with cosmic-level security</p>
              </div>
            </div>

            <div class="flex items-start space-x-4">
              <div class="w-10 h-10 rounded-full bg-pink-900/50 flex items-center justify-center flex-shrink-0">
                <i class="fas fa-rocket text-pink-400"></i>
              </div>
              <div>
                <h4 class="font-semibold text-white mb-1">Quick Access</h4>
                <p class="text-slate-300 text-sm">Get instant access to your beauty journey</p>
              </div>
            </div>

            <div class="flex items-start space-x-4">
              <div class="w-10 h-10 rounded-full bg-blue-900/50 flex items-center justify-center flex-shrink-0">
                <i class="fas fa-crown text-blue-400"></i>
              </div>
              <div>
                <h4 class="font-semibold text-white mb-1">Exclusive Benefits</h4>
                <p class="text-slate-300 text-sm">Unlock special offers and personalized recommendations</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Decorative Elements -->
        <div class="flex justify-center">
          <div class="w-24 h-1 rounded-full bg-gradient-to-r from-purple-600 to-pink-500"></div>
        </div>
      </div>
    </div>

    <!-- Right Panel - Login Form -->
    <div class="md:w-1/2 p-8 md:p-12 bg-white/95 backdrop-blur-sm">
      <div class="max-w-md mx-auto">
        <!-- Form Header -->
        <div class="mb-8">
          <h2 class="text-2xl font-bold text-slate-800 mb-2">Access Your Account</h2>
          <p class="text-slate-600">Enter your credentials to explore the cosmic beauty universe</p>
        </div>

        <!-- Error/Success Messages -->
        <?php if ($error): ?>
          <div id="errorMessage" class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg flex items-start space-x-3 animate-pulse">
            <i class="fas fa-exclamation-circle text-red-500 mt-0.5"></i>
            <span class="text-red-700"><?php echo htmlspecialchars($error); ?></span>
          </div>
        <?php endif; ?>

        <?php if ($success): ?>
          <div id="successMessage" class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-start space-x-3">
            <i class="fas fa-check-circle text-green-500 mt-0.5"></i>
            <span class="text-green-700"><?php echo htmlspecialchars($success); ?></span>
          </div>
        <?php endif; ?>

        <!-- Login Form -->
        <form method="POST" action="" class="space-y-6" id="loginForm">
          <!-- Username Field -->
          <div>
            <label for="username" class="block text-sm font-medium text-slate-700 mb-2">
              <i class="fas fa-user-astronaut text-purple-500 mr-1"></i> Username or Email
            </label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-user text-slate-400"></i>
              </div>
              <input type="text"
                id="username"
                name="username"
                value="<?php echo htmlspecialchars($username); ?>"
                class="w-full pl-10 pr-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300"
                placeholder="Enter your username or email"
                required
                autocomplete="username">
            </div>
          </div>

          <!-- Password Field -->
          <div>
            <label for="password" class="block text-sm font-medium text-slate-700 mb-2">
              <i class="fas fa-key text-purple-500 mr-1"></i> Password
            </label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-lock text-slate-400"></i>
              </div>
              <input type="password"
                id="password"
                name="password"
                class="w-full pl-10 pr-12 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300"
                placeholder="Enter your password"
                required
                autocomplete="current-password">
              <button type="button"
                class="absolute inset-y-0 right-0 pr-3 flex items-center"
                id="togglePassword">
                <i class="fas fa-eye text-slate-400 hover:text-slate-600 cursor-pointer"></i>
              </button>
            </div>

            <!-- Password Strength Indicator -->
            <div id="passwordStrength" class="mt-3 hidden">
              <div class="flex justify-between mb-1">
                <span class="text-xs text-slate-500">Password strength</span>
              </div>
              <div class="flex space-x-1">
                <div class="password-strength-bar flex-1 bg-slate-200"></div>
                <div class="password-strength-bar flex-1 bg-slate-200"></div>
                <div class="password-strength-bar flex-1 bg-slate-200"></div>
                <div class="password-strength-bar flex-1 bg-slate-200"></div>
              </div>
            </div>
          </div>

          <!-- Remember Me & Forgot Password -->
          <div class="flex items-center justify-between">
            <label class="flex items-center space-x-2 cursor-pointer">
              <input type="checkbox"
                name="remember"
                id="remember"
                class="w-4 h-4 text-purple-600 rounded focus:ring-purple-500 border-slate-300">
              <span class="text-sm text-slate-700">Remember me</span>
            </label>
            <a href="forgot-password.php" class="text-sm text-purple-600 hover:text-purple-800 font-medium transition-colors duration-300">
              Forgot Password?
            </a>
          </div>

          <!-- Submit Button -->
          <button type="submit"
            class="w-full py-3 px-4 bg-gradient-to-r from-purple-600 to-pink-500 hover:from-purple-700 hover:to-pink-600 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center"
            id="submitBtn">
            <span id="btnText">Login to Cosmic Beauty</span>
            <i class="fas fa-paper-plane ml-2"></i>
          </button>

          <!-- Divider -->
          <div class="relative my-6">
            <div class="absolute inset-0 flex items-center">
              <div class="w-full border-t border-slate-300"></div>
            </div>
            <div class="relative flex justify-center text-sm">
              <span class="px-4 bg-white text-slate-500">Or continue with</span>
            </div>
          </div>

          <!-- Social Login -->
          <div class="flex justify-center space-x-4">
            <button type="button"
              class="w-12 h-12 rounded-full border border-slate-300 hover:border-red-300 flex items-center justify-center hover:bg-red-50 transition-all duration-300"
              onclick="socialLogin('google')">
              <i class="fab fa-google text-red-500"></i>
            </button>
            <button type="button"
              class="w-12 h-12 rounded-full border border-slate-300 hover:border-blue-300 flex items-center justify-center hover:bg-blue-50 transition-all duration-300"
              onclick="socialLogin('facebook')">
              <i class="fab fa-facebook-f text-blue-600"></i>
            </button>
            <button type="button"
              class="w-12 h-12 rounded-full border border-slate-300 hover:border-sky-300 flex items-center justify-center hover:bg-sky-50 transition-all duration-300"
              onclick="socialLogin('twitter')">
              <i class="fab fa-twitter text-sky-500"></i>
            </button>
          </div>

          <!-- Register Link -->
          <div class="text-center pt-4">
            <span class="text-slate-600">New to our cosmic journey?</span>
            <a href="register.php" class="ml-2 text-purple-600 hover:text-purple-800 font-semibold transition-colors duration-300">
              Create Account
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    // Create cosmic background
    function createCosmicBackground() {
      const bg = document.getElementById('cosmicBg');

      // Create stars
      for (let i = 0; i < 80; i++) {
        const star = document.createElement('div');
        star.classList.add('star');
        star.style.width = Math.random() * 3 + 'px';
        star.style.height = star.style.width;
        star.style.left = Math.random() * 100 + 'vw';
        star.style.top = Math.random() * 100 + 'vh';
        star.style.animationDelay = Math.random() * 4 + 's';
        star.style.animationDuration = (Math.random() * 2 + 2) + 's';
        bg.appendChild(star);
      }

      // Create nebula effects
      for (let i = 0; i < 4; i++) {
        const nebula = document.createElement('div');
        nebula.classList.add('galaxy');
        nebula.style.width = Math.random() * 300 + 150 + 'px';
        nebula.style.height = nebula.style.width;
        nebula.style.left = Math.random() * 100 + 'vw';
        nebula.style.top = Math.random() * 100 + 'vh';
        nebula.style.background = i % 2 === 0 ?
          'radial-gradient(circle, rgba(139, 92, 246, 0.3), transparent)' :
          'radial-gradient(circle, rgba(236, 72, 153, 0.3), transparent)';
        nebula.style.opacity = Math.random() * 0.3 + 0.1;
        nebula.style.zIndex = '-1';
        bg.appendChild(nebula);
      }
    }

    // Toggle password visibility
    document.getElementById('togglePassword').addEventListener('click', function() {
      const passwordInput = document.getElementById('password');
      const icon = this.querySelector('i');

      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      } else {
        passwordInput.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      }
    });

    // Form validation and submission
    document.getElementById('loginForm').addEventListener('submit', function(e) {
      e.preventDefault();

      const submitBtn = document.getElementById('submitBtn');
      const btnText = document.getElementById('btnText');
      const originalText = btnText.textContent;
      const originalHTML = submitBtn.innerHTML;

      // Show loading state
      submitBtn.innerHTML = '<div class="loading-spinner"></div>';
      submitBtn.disabled = true;

      // Check if form is valid
      if (!this.checkValidity()) {
        // Show error animation on invalid fields
        const inputs = this.querySelectorAll('input[required]');
        inputs.forEach(input => {
          if (!input.checkValidity()) {
            input.classList.add('shake-animation');
            setTimeout(() => {
              input.classList.remove('shake-animation');
            }, 500);
          }
        });

        // Reset button
        setTimeout(() => {
          submitBtn.innerHTML = originalHTML;
          btnText.textContent = originalText;
          submitBtn.disabled = false;
        }, 1000);

        return false;
      }

      // Simulate API call delay
      setTimeout(() => {
        // Reset button state
        submitBtn.innerHTML = originalHTML;
        btnText.textContent = originalText;
        submitBtn.disabled = false;

        // Actually submit the form
        this.submit();
      }, 1500);
    });

    // Social login simulation
    function socialLogin(provider) {
      const btn = event.target.closest('button');
      const originalHTML = btn.innerHTML;

      btn.innerHTML = '<div class="loading-spinner"></div>';
      btn.disabled = true;

      setTimeout(() => {
        alert(`Simulated ${provider} login. In a real application, this would redirect to ${provider} authentication.`);
        btn.innerHTML = originalHTML;
        btn.disabled = false;
      }, 2000);
    }

    // Password strength indicator
    document.getElementById('password').addEventListener('input', function(e) {
      const strengthBars = document.querySelectorAll('.password-strength-bar');
      const container = document.getElementById('passwordStrength');
      const password = e.target.value;

      if (password.length === 0) {
        container.classList.add('hidden');
        return;
      }

      container.classList.remove('hidden');

      // Calculate password strength
      let strength = 0;
      if (password.length >= 8) strength++;
      if (/[A-Z]/.test(password)) strength++;
      if (/[0-9]/.test(password)) strength++;
      if (/[^A-Za-z0-9]/.test(password)) strength++;

      // Update strength bars
      strengthBars.forEach((bar, index) => {
        // Reset colors
        bar.classList.remove('bg-red-500', 'bg-yellow-500', 'bg-green-500', 'bg-emerald-500');

        if (index < strength) {
          if (strength <= 2) {
            bar.classList.add('bg-red-500');
          } else if (strength === 3) {
            bar.classList.add('bg-yellow-500');
          } else {
            bar.classList.add('bg-emerald-500');
          }
        } else {
          bar.classList.add('bg-slate-200');
        }
      });
    });

    // Auto-hide messages after 5 seconds
    setTimeout(() => {
      const errorMessage = document.getElementById('errorMessage');
      const successMessage = document.getElementById('successMessage');

      if (errorMessage) {
        errorMessage.style.opacity = '0';
        setTimeout(() => {
          errorMessage.style.display = 'none';
        }, 500);
      }

      if (successMessage) {
        successMessage.style.opacity = '0';
        setTimeout(() => {
          successMessage.style.display = 'none';
        }, 500);
      }
    }, 5000);

    // Check for saved username
    document.addEventListener('DOMContentLoaded', function() {
      createCosmicBackground();

      // Focus on username field
      document.getElementById('username').focus();

      // Check for remembered username in localStorage
      if (localStorage.getItem('rememberedUsername')) {
        document.getElementById('username').value = localStorage.getItem('rememberedUsername');
        document.getElementById('remember').checked = true;
      }

      // Save username if remember me is checked
      document.getElementById('remember').addEventListener('change', function() {
        const username = document.getElementById('username').value;
        if (this.checked && username) {
          localStorage.setItem('rememberedUsername', username);
        } else {
          localStorage.removeItem('rememberedUsername');
        }
      });

      // Auto-save username when typing if remember me is checked
      document.getElementById('username').addEventListener('input', function() {
        if (document.getElementById('remember').checked) {
          localStorage.setItem('rememberedUsername', this.value);
        }
      });
    });
  </script>
</body>

</html>

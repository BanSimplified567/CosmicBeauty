<?php
// register.php
session_start();
require './config/db.php';

$error = '';
$success = '';
$username = '';
$email = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = trim($_POST['username']);
  $email = trim($_POST['email']);
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];
  $terms = isset($_POST['terms']) ? true : false;
  $subscribe = isset($_POST['subscribe']) ? true : false;

  // Validate username
  if (strlen($username) < 3) {
    $error = "Username must be at least 3 characters long";
  } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
    $error = "Username can only contain letters, numbers, and underscores";
  }
  // Validate email
  elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "Please enter a valid email address";
  }
  // Validate terms agreement
  elseif (!$terms) {
    $error = "You must agree to the Terms and Conditions";
  }
  // Validate password strength
  elseif (strlen($password) < 8) {
    $error = "Password must be at least 8 characters long";
  } elseif (!preg_match('/[A-Z]/', $password)) {
    $error = "Password must contain at least one uppercase letter";
  } elseif (!preg_match('/[a-z]/', $password)) {
    $error = "Password must contain at least one lowercase letter";
  } elseif (!preg_match('/[0-9]/', $password)) {
    $error = "Password must contain at least one number";
  } elseif (!preg_match('/[^A-Za-z0-9]/', $password)) {
    $error = "Password must contain at least one special character";
  }
  // Check if passwords match
  elseif ($password !== $confirm_password) {
    $error = "Passwords do not match";
  }
  // Check if username already exists
  else {
    $check_stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    $check_stmt->bind_param("ss", $username, $email);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
      $error = "Username or email already exists";
    } else {
      // Hash password
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);
      $created_at = date('Y-m-d H:i:s');
      $verification_token = bin2hex(random_bytes(32));

      // Insert new user
      $stmt = $conn->prepare("INSERT INTO users (username, email, password, verification_token, created_at) VALUES (?, ?, ?, ?, ?)");
      $stmt->bind_param("sssss", $username, $email, $hashed_password, $verification_token, $created_at);

      if ($stmt->execute()) {
        $user_id = $stmt->insert_id;

        // Save subscription preference
        if ($subscribe) {
          $sub_stmt = $conn->prepare("INSERT INTO newsletter_subscriptions (user_id, email, subscribed_at) VALUES (?, ?, ?)");
          $sub_stmt->bind_param("iss", $user_id, $email, $created_at);
          $sub_stmt->execute();
          $sub_stmt->close();
        }

        // Auto login after registration
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['login_time'] = time();
        $_SESSION['new_user'] = true;

        // Send verification email (simulated)
        // sendVerificationEmail($email, $username, $verification_token);

        // Send welcome email (simulated)
        // sendWelcomeEmail($email, $username);

        // Log registration
        $log_stmt = $conn->prepare("INSERT INTO registration_logs (user_id, ip_address, user_agent) VALUES (?, ?, ?)");
        $log_stmt->bind_param("iss", $user_id, $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']);
        $log_stmt->execute();
        $log_stmt->close();

        // Redirect to dashboard
        header("Location: index.php?welcome=true");
        exit;
      } else {
        $error = "Registration failed. Please try again.";
      }
      $stmt->close();
    }
    $check_stmt->close();
  }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register | Cosmic Beauty</title>
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

    .password-requirements {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.3s ease-out;
    }

    .password-requirements.active {
      max-height: 200px;
    }

    .progress-fill {
      transition: width 0.3s ease;
    }

    .requirement-check {
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

    .checkmark {
      display: inline-block;
      width: 20px;
      height: 20px;
      border-radius: 50%;
      border: 2px solid #cbd5e1;
      position: relative;
      flex-shrink: 0;
    }

    .checkmark.valid::after {
      content: '✓';
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      color: #10b981;
      font-weight: bold;
    }

    .checkmark.invalid::after {
      content: '✗';
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      color: #ef4444;
      font-weight: bold;
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
          <h2 class="text-3xl font-bold text-white mb-4">Join Our Cosmic Community!</h2>
          <p class="text-slate-300 mb-8">Begin your journey to radiant skin and discover exclusive cosmic benefits. Create your account today!</p>

          <!-- Features -->
          <div class="space-y-6 mb-8">
            <div class="flex items-start space-x-4">
              <div class="w-10 h-10 rounded-full bg-purple-900/50 flex items-center justify-center flex-shrink-0">
                <i class="fas fa-gift text-purple-400"></i>
              </div>
              <div>
                <h4 class="font-semibold text-white mb-1">Welcome Gift</h4>
                <p class="text-slate-300 text-sm">Get 15% off your first order</p>
              </div>
            </div>

            <div class="flex items-start space-x-4">
              <div class="w-10 h-10 rounded-full bg-pink-900/50 flex items-center justify-center flex-shrink-0">
                <i class="fas fa-crown text-pink-400"></i>
              </div>
              <div>
                <h4 class="font-semibold text-white mb-1">VIP Access</h4>
                <p class="text-slate-300 text-sm">Exclusive member-only products and offers</p>
              </div>
            </div>

            <div class="flex items-start space-x-4">
              <div class="w-10 h-10 rounded-full bg-blue-900/50 flex items-center justify-center flex-shrink-0">
                <i class="fas fa-shipping-fast text-blue-400"></i>
              </div>
              <div>
                <h4 class="font-semibold text-white mb-1">Free Shipping</h4>
                <p class="text-slate-300 text-sm">On all orders over ₱1,500</p>
              </div>
            </div>

            <div class="flex items-start space-x-4">
              <div class="w-10 h-10 rounded-full bg-emerald-900/50 flex items-center justify-center flex-shrink-0">
                <i class="fas fa-user-shield text-emerald-400"></i>
              </div>
              <div>
                <h4 class="font-semibold text-white mb-1">Secure Account</h4>
                <p class="text-slate-300 text-sm">Your data is protected with cosmic security</p>
              </div>
            </div>
          </div>

          <!-- Verification Note -->
          <div class="bg-purple-900/20 border border-purple-500/30 rounded-xl p-4">
            <div class="flex items-start space-x-3">
              <i class="fas fa-info-circle text-purple-400 mt-1"></i>
              <div>
                <p class="text-sm text-slate-300">
                  <span class="font-semibold text-purple-300">Email Verification:</span>
                  After registration, you'll receive a verification email to activate your account and unlock all cosmic benefits.
                </p>
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

    <!-- Right Panel - Registration Form -->
    <div class="md:w-1/2 p-8 md:p-12 bg-white/95 backdrop-blur-sm">
      <div class="max-w-md mx-auto">
        <!-- Form Header -->
        <div class="mb-8">
          <h2 class="text-2xl font-bold text-slate-800 mb-2">Create Cosmic Account</h2>
          <p class="text-slate-600">Fill in your details to join our galaxy of beauty enthusiasts</p>
        </div>

        <!-- Error/Success Messages -->
        <?php if ($error): ?>
          <div id="errorMessage" class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg flex items-start space-x-3 animate-pulse">
            <i class="fas fa-exclamation-circle text-red-500 mt-0.5"></i>
            <span class="text-red-700"><?php echo htmlspecialchars($error); ?></span>
          </div>
        <?php endif; ?>

        <?php if (isset($_GET['success']) && $_GET['success'] == 'pending'): ?>
          <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-start space-x-3">
            <i class="fas fa-check-circle text-green-500 mt-0.5"></i>
            <span class="text-green-700">Registration successful! Please check your email to verify your account.</span>
          </div>
        <?php endif; ?>

        <!-- Registration Form -->
        <form method="POST" action="" class="space-y-6" id="registerForm">
          <!-- Username Field -->
          <div>
            <label for="username" class="block text-sm font-medium text-slate-700 mb-2">
              <i class="fas fa-user-astronaut text-purple-500 mr-1"></i> Choose Username
            </label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-user-circle text-slate-400"></i>
              </div>
              <input type="text"
                id="username"
                name="username"
                value="<?php echo htmlspecialchars($username); ?>"
                class="w-full pl-10 pr-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300"
                placeholder="Enter your username"
                required
                minlength="3"
                maxlength="50"
                pattern="[a-zA-Z0-9_]+"
                autocomplete="username">
            </div>
            <!-- Username Availability -->
            <div id="usernameAvailability" class="mt-2 flex items-center space-x-2 opacity-0 transition-opacity duration-300">
              <div class="checkmark"></div>
              <span class="text-sm"></span>
            </div>
            <!-- Username Progress -->
            <div class="mt-2 h-2 bg-slate-200 rounded-full overflow-hidden">
              <div id="usernameProgress" class="h-full bg-purple-500 rounded-full" style="width: 0%"></div>
            </div>
          </div>

          <!-- Email Field -->
          <div>
            <label for="email" class="block text-sm font-medium text-slate-700 mb-2">
              <i class="fas fa-envelope text-purple-500 mr-1"></i> Email Address
            </label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-at text-slate-400"></i>
              </div>
              <input type="email"
                id="email"
                name="email"
                value="<?php echo htmlspecialchars($email); ?>"
                class="w-full pl-10 pr-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300"
                placeholder="your.email@example.com"
                required
                autocomplete="email">
            </div>
            <!-- Email Availability -->
            <div id="emailAvailability" class="mt-2 flex items-center space-x-2 opacity-0 transition-opacity duration-300">
              <div class="checkmark"></div>
              <span class="text-sm"></span>
            </div>
          </div>

          <!-- Password Field -->
          <div>
            <label for="password" class="block text-sm font-medium text-slate-700 mb-2">
              <i class="fas fa-key text-purple-500 mr-1"></i> Create Password
            </label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-lock text-slate-400"></i>
              </div>
              <input type="password"
                id="password"
                name="password"
                class="w-full pl-10 pr-12 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300"
                placeholder="Create a strong password"
                required
                minlength="8"
                autocomplete="new-password">
              <button type="button"
                class="absolute inset-y-0 right-0 pr-3 flex items-center"
                id="togglePassword">
                <i class="fas fa-eye text-slate-400 hover:text-slate-600 cursor-pointer"></i>
              </button>
            </div>
            <!-- Password Progress -->
            <div class="mt-2 h-2 bg-slate-200 rounded-full overflow-hidden">
              <div id="passwordProgress" class="h-full bg-purple-500 rounded-full" style="width: 0%"></div>
            </div>

            <!-- Password Requirements -->
            <div id="passwordRequirements" class="password-requirements mt-4">
              <h4 class="text-sm font-medium text-slate-700 mb-3">Password must contain:</h4>
              <div class="space-y-2">
                <div id="reqLength" class="flex items-center space-x-3 requirement-check">
                  <div class="checkmark"></div>
                  <span class="text-sm text-slate-600">At least 8 characters</span>
                </div>
                <div id="reqUppercase" class="flex items-center space-x-3 requirement-check">
                  <div class="checkmark"></div>
                  <span class="text-sm text-slate-600">One uppercase letter</span>
                </div>
                <div id="reqLowercase" class="flex items-center space-x-3 requirement-check">
                  <div class="checkmark"></div>
                  <span class="text-sm text-slate-600">One lowercase letter</span>
                </div>
                <div id="reqNumber" class="flex items-center space-x-3 requirement-check">
                  <div class="checkmark"></div>
                  <span class="text-sm text-slate-600">One number</span>
                </div>
                <div id="reqSpecial" class="flex items-center space-x-3 requirement-check">
                  <div class="checkmark"></div>
                  <span class="text-sm text-slate-600">One special character</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Confirm Password Field -->
          <div>
            <label for="confirm_password" class="block text-sm font-medium text-slate-700 mb-2">
              <i class="fas fa-key text-purple-500 mr-1"></i> Confirm Password
            </label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-lock text-slate-400"></i>
              </div>
              <input type="password"
                id="confirm_password"
                name="confirm_password"
                class="w-full pl-10 pr-12 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300"
                placeholder="Confirm your password"
                required
                autocomplete="new-password">
              <button type="button"
                class="absolute inset-y-0 right-0 pr-3 flex items-center"
                id="toggleConfirmPassword">
                <i class="fas fa-eye text-slate-400 hover:text-slate-600 cursor-pointer"></i>
              </button>
            </div>
            <!-- Password Match Indicator -->
            <div id="passwordMatch" class="mt-2 flex items-center space-x-2 opacity-0 transition-opacity duration-300">
              <div class="checkmark"></div>
              <span class="text-sm"></span>
            </div>
          </div>

          <!-- Newsletter Subscription -->
          <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 transition-all duration-300 hover:border-purple-300">
            <label class="flex items-start space-x-3 cursor-pointer">
              <input type="checkbox"
                name="subscribe"
                id="subscribe"
                class="w-5 h-5 text-purple-600 rounded focus:ring-purple-500 border-slate-300 mt-1"
                checked>
              <div>
                <div class="flex items-center space-x-2 mb-1">
                  <i class="fas fa-paper-plane text-purple-500"></i>
                  <span class="text-sm font-medium text-slate-700">Cosmic Newsletter</span>
                </div>
                <p class="text-sm text-slate-600">
                  Subscribe for exclusive offers, beauty tips, and new product launches
                </p>
              </div>
            </label>
          </div>

          <!-- Terms Agreement -->
          <div class="bg-slate-50 border border-slate-200 rounded-xl p-4">
            <label class="flex items-start space-x-3 cursor-pointer">
              <input type="checkbox"
                name="terms"
                id="terms"
                required
                class="w-5 h-5 text-purple-600 rounded focus:ring-purple-500 border-slate-300 mt-1">
              <div>
                <p class="text-sm text-slate-700">
                  I agree to the <a href="terms.php" target="_blank" class="text-purple-600 hover:text-purple-800 font-medium">Terms and Conditions</a>
                  and <a href="privacy.php" target="_blank" class="text-purple-600 hover:text-purple-800 font-medium">Privacy Policy</a>.
                  I understand that my data will be used in accordance with Cosmic Beauty's policies.
                </p>
              </div>
            </label>
          </div>

          <!-- Submit Button -->
          <button type="submit"
            class="w-full py-3 px-4 bg-gradient-to-r from-purple-600 to-pink-500 hover:from-purple-700 hover:to-pink-600 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center"
            id="submitBtn">
            <span id="btnText">Create Cosmic Account</span>
            <i class="fas fa-rocket ml-2"></i>
          </button>

          <!-- Divider -->
          <div class="relative my-6">
            <div class="absolute inset-0 flex items-center">
              <div class="w-full border-t border-slate-300"></div>
            </div>
            <div class="relative flex justify-center text-sm">
              <span class="px-4 bg-white text-slate-500">Or sign up with</span>
            </div>
          </div>

          <!-- Social Registration -->
          <div class="flex justify-center space-x-4">
            <button type="button"
              class="w-12 h-12 rounded-full border border-slate-300 hover:border-red-300 flex items-center justify-center hover:bg-red-50 transition-all duration-300"
              onclick="socialRegister('google')">
              <i class="fab fa-google text-red-500"></i>
            </button>
            <button type="button"
              class="w-12 h-12 rounded-full border border-slate-300 hover:border-blue-300 flex items-center justify-center hover:bg-blue-50 transition-all duration-300"
              onclick="socialRegister('facebook')">
              <i class="fab fa-facebook-f text-blue-600"></i>
            </button>
            <button type="button"
              class="w-12 h-12 rounded-full border border-slate-300 hover:border-sky-300 flex items-center justify-center hover:bg-sky-50 transition-all duration-300"
              onclick="socialRegister('twitter')">
              <i class="fab fa-twitter text-sky-500"></i>
            </button>
          </div>

          <!-- Login Link -->
          <div class="text-center pt-4">
            <span class="text-slate-600">Already have a cosmic account?</span>
            <a href="login.php" class="ml-2 text-purple-600 hover:text-purple-800 font-semibold transition-colors duration-300">
              Login here
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
      for (let i = 0; i < 100; i++) {
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

    // Toggle confirm password visibility
    document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
      const confirmInput = document.getElementById('confirm_password');
      const icon = this.querySelector('i');

      if (confirmInput.type === 'password') {
        confirmInput.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      } else {
        confirmInput.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      }
    });

    // Password strength checker
    document.getElementById('password').addEventListener('input', function(e) {
      const password = e.target.value;
      const requirements = document.getElementById('passwordRequirements');
      const progressBar = document.getElementById('passwordProgress');

      // Show/hide requirements
      if (password.length > 0) {
        requirements.classList.add('active');
      } else {
        requirements.classList.remove('active');
      }

      // Check requirements
      const hasLength = password.length >= 8;
      const hasUppercase = /[A-Z]/.test(password);
      const hasLowercase = /[a-z]/.test(password);
      const hasNumber = /[0-9]/.test(password);
      const hasSpecial = /[^A-Za-z0-9]/.test(password);

      // Update requirement indicators
      updateRequirement('reqLength', hasLength);
      updateRequirement('reqUppercase', hasUppercase);
      updateRequirement('reqLowercase', hasLowercase);
      updateRequirement('reqNumber', hasNumber);
      updateRequirement('reqSpecial', hasSpecial);

      // Calculate strength score
      let strength = 0;
      if (hasLength) strength++;
      if (hasUppercase) strength++;
      if (hasLowercase) strength++;
      if (hasNumber) strength++;
      if (hasSpecial) strength++;

      // Update progress bar
      progressBar.style.width = (strength / 5 * 100) + '%';
      progressBar.className = 'h-full rounded-full';

      // Update progress bar color
      if (strength <= 2) {
        progressBar.classList.add('bg-red-500');
      } else if (strength <= 4) {
        progressBar.classList.add('bg-yellow-500');
      } else {
        progressBar.classList.add('bg-emerald-500');
      }
    });

    function updateRequirement(id, isValid) {
      const element = document.getElementById(id);
      const checkmark = element.querySelector('.checkmark');

      if (isValid) {
        checkmark.classList.add('valid');
        checkmark.classList.remove('invalid');
        element.querySelector('span').classList.add('text-emerald-600');
        element.querySelector('span').classList.remove('text-slate-600');
      } else {
        checkmark.classList.add('invalid');
        checkmark.classList.remove('valid');
        element.querySelector('span').classList.remove('text-emerald-600');
        element.querySelector('span').classList.add('text-slate-600');
      }
    }

    // Check password match
    document.getElementById('confirm_password').addEventListener('input', function() {
      const password = document.getElementById('password').value;
      const confirmPassword = this.value;
      const matchElement = document.getElementById('passwordMatch');
      const checkmark = matchElement.querySelector('.checkmark');
      const textSpan = matchElement.querySelector('span');

      if (confirmPassword.length === 0) {
        matchElement.classList.remove('shake-animation');
        matchElement.style.opacity = '0';
        return;
      }

      if (password === confirmPassword && password.length > 0) {
        checkmark.classList.add('valid');
        checkmark.classList.remove('invalid');
        textSpan.textContent = 'Passwords match';
        textSpan.classList.add('text-emerald-600');
        textSpan.classList.remove('text-red-600');
      } else {
        checkmark.classList.add('invalid');
        checkmark.classList.remove('valid');
        textSpan.textContent = 'Passwords do not match';
        textSpan.classList.add('text-red-600');
        textSpan.classList.remove('text-emerald-600');
      }
      matchElement.style.opacity = '1';
    });

    // Check username availability (simulated)
    document.getElementById('username').addEventListener('input', debounce(function(e) {
      const username = e.target.value;
      const availabilityElement = document.getElementById('usernameAvailability');
      const checkmark = availabilityElement.querySelector('.checkmark');
      const textSpan = availabilityElement.querySelector('span');
      const progressBar = document.getElementById('usernameProgress');

      if (username.length === 0) {
        availabilityElement.classList.remove('shake-animation');
        availabilityElement.style.opacity = '0';
        progressBar.style.width = '0%';
        return;
      }

      // Update progress based on username length
      const progress = Math.min((username.length / 50) * 100, 100);
      progressBar.style.width = progress + '%';

      // Update progress bar color
      if (username.length >= 3) {
        progressBar.classList.add('bg-emerald-500');
        progressBar.classList.remove('bg-yellow-500', 'bg-red-500');
      } else if (username.length > 0) {
        progressBar.classList.add('bg-yellow-500');
        progressBar.classList.remove('bg-emerald-500', 'bg-red-500');
      }

      // Simulate API call for username check
      setTimeout(() => {
        // In real app, this would be an AJAX call to check database
        const takenUsernames = ['admin', 'user', 'test', 'cosmic']; // Example taken usernames
        const isValidPattern = /^[a-zA-Z0-9_]+$/.test(username);
        const isAvailable = username.length >= 3 && isValidPattern && !takenUsernames.includes(username.toLowerCase());

        if (username.length < 3) {
          checkmark.classList.add('invalid');
          checkmark.classList.remove('valid');
          textSpan.textContent = 'Username too short (min 3 chars)';
          textSpan.classList.add('text-red-600');
          textSpan.classList.remove('text-emerald-600');
        } else if (!isValidPattern) {
          checkmark.classList.add('invalid');
          checkmark.classList.remove('valid');
          textSpan.textContent = 'Only letters, numbers, underscores';
          textSpan.classList.add('text-red-600');
          textSpan.classList.remove('text-emerald-600');
        } else if (!isAvailable) {
          checkmark.classList.add('invalid');
          checkmark.classList.remove('valid');
          textSpan.textContent = 'Username already taken';
          textSpan.classList.add('text-red-600');
          textSpan.classList.remove('text-emerald-600');
        } else {
          checkmark.classList.add('valid');
          checkmark.classList.remove('invalid');
          textSpan.textContent = 'Username is available';
          textSpan.classList.add('text-emerald-600');
          textSpan.classList.remove('text-red-600');
        }
        availabilityElement.style.opacity = '1';
      }, 500);
    }, 300));

    // Check email availability (simulated)
    document.getElementById('email').addEventListener('input', debounce(function(e) {
      const email = e.target.value;
      const availabilityElement = document.getElementById('emailAvailability');
      const checkmark = availabilityElement.querySelector('.checkmark');
      const textSpan = availabilityElement.querySelector('span');

      if (email.length === 0 || !email.includes('@')) {
        availabilityElement.classList.remove('shake-animation');
        availabilityElement.style.opacity = '0';
        return;
      }

      // Simulate API call for email check
      setTimeout(() => {
        // In real app, this would be an AJAX call to check database
        const takenEmails = ['admin@example.com', 'test@example.com']; // Example taken emails
        const isValidEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        const isAvailable = isValidEmail && !takenEmails.includes(email.toLowerCase());

        if (!isValidEmail) {
          checkmark.classList.add('invalid');
          checkmark.classList.remove('valid');
          textSpan.textContent = 'Invalid email format';
          textSpan.classList.add('text-red-600');
          textSpan.classList.remove('text-emerald-600');
        } else if (!isAvailable) {
          checkmark.classList.add('invalid');
          checkmark.classList.remove('valid');
          textSpan.textContent = 'Email already registered';
          textSpan.classList.add('text-red-600');
          textSpan.classList.remove('text-emerald-600');
        } else {
          checkmark.classList.add('valid');
          checkmark.classList.remove('invalid');
          textSpan.textContent = 'Email is available';
          textSpan.classList.add('text-emerald-600');
          textSpan.classList.remove('text-red-600');
        }
        availabilityElement.style.opacity = '1';
      }, 500);
    }, 300));

    // Debounce function for performance
    function debounce(func, wait) {
      let timeout;
      return function executedFunction(...args) {
        const later = () => {
          clearTimeout(timeout);
          func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
      };
    }

    // Form submission
    document.getElementById('registerForm').addEventListener('submit', function(e) {
      const submitBtn = document.getElementById('submitBtn');
      const btnText = document.getElementById('btnText');
      const originalText = btnText.textContent;
      const originalHTML = submitBtn.innerHTML;

      // Validate password match
      const password = document.getElementById('password').value;
      const confirmPassword = document.getElementById('confirm_password').value;

      if (password !== confirmPassword) {
        e.preventDefault();
        const matchElement = document.getElementById('passwordMatch');
        matchElement.classList.add('shake-animation');
        setTimeout(() => {
          matchElement.classList.remove('shake-animation');
        }, 500);
        return false;
      }

      // Validate terms agreement
      if (!document.getElementById('terms').checked) {
        e.preventDefault();
        alert('Please agree to the Terms and Conditions');
        return false;
      }

      // Show loading state
      submitBtn.innerHTML = '<div class="loading-spinner"></div>';
      submitBtn.disabled = true;

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

    // Social registration simulation
    function socialRegister(provider) {
      const btn = event.target.closest('button');
      const originalHTML = btn.innerHTML;

      btn.innerHTML = '<div class="loading-spinner"></div>';
      btn.disabled = true;

      setTimeout(() => {
        alert(`Simulated ${provider} registration. In a real application, this would use OAuth for registration.`);
        btn.innerHTML = originalHTML;
        btn.disabled = false;
      }, 2000);
    }

    // Auto-hide error message after 5 seconds
    setTimeout(() => {
      const errorMessage = document.getElementById('errorMessage');
      if (errorMessage) {
        errorMessage.style.opacity = '0';
        setTimeout(() => {
          errorMessage.style.display = 'none';
        }, 500);
      }
    }, 5000);

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
      createCosmicBackground();

      // Focus on username field
      document.getElementById('username').focus();

      // Check for any existing errors
      const errorMessage = document.getElementById('errorMessage');
      if (errorMessage) {
        errorMessage.scrollIntoView({
          behavior: 'smooth',
          block: 'center'
        });
      }

      // Auto-check username and email if they have values
      const usernameInput = document.getElementById('username');
      const emailInput = document.getElementById('email');

      if (usernameInput.value.length > 0) {
        const event = new Event('input');
        usernameInput.dispatchEvent(event);
      }

      if (emailInput.value.length > 0) {
        const event = new Event('input');
        emailInput.dispatchEvent(event);
      }
    });
  </script>
</body>

</html>

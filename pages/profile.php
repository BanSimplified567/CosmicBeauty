<?php
session_start();
require_once '../config/../config/db.php'; // Adjust path as needed

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
  header("Location: ../auth/login.php");
  exit();
}

// Initialize variables to prevent undefined errors
$user = null;
$orders_result = null;
$wishlist_count = 0;
$update_message = '';
$update_error = '';

// Fetch user data from database
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user_result = $stmt->get_result();

if ($user_result->num_rows > 0) {
  $user = $user_result->fetch_assoc();

  // Fetch user's orders
  $order_stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY order_date DESC");
  $order_stmt->bind_param("i", $user_id);
  $order_stmt->execute();
  $orders_result = $order_stmt->get_result();

  // Fetch wishlist count
  $wishlist_stmt = $conn->prepare("SELECT COUNT(*) as count FROM wishlist WHERE user_id = ?");
  $wishlist_stmt->bind_param("i", $user_id);
  $wishlist_stmt->execute();
  $wishlist_result = $wishlist_stmt->get_result();
  $wishlist_row = $wishlist_result->fetch_assoc();
  $wishlist_count = $wishlist_row['count'] ?? 0;

  // Process form submissions
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_profile'])) {
      // Handle profile update
      $full_name = $_POST['full_name'] ?? '';
      $phone = $_POST['phone'] ?? '';
      $birthday = $_POST['birthday'] ?? '';
      $gender = $_POST['gender'] ?? '';
      $address = $_POST['address'] ?? '';
      $city = $_POST['city'] ?? '';
      $province = $_POST['province'] ?? '';
      $zip_code = $_POST['zip_code'] ?? '';

      $update_stmt = $conn->prepare("UPDATE users SET
                full_name = ?,
                phone = ?,
                birthday = ?,
                gender = ?,
                address = ?,
                city = ?,
                province = ?,
                zip_code = ?,
                updated_at = NOW()
                WHERE id = ?");

      $update_stmt->bind_param(
        "ssssssssi",
        $full_name,
        $phone,
        $birthday,
        $gender,
        $address,
        $city,
        $province,
        $zip_code,
        $user_id
      );

      if ($update_stmt->execute()) {
        $update_message = "Profile updated successfully!";
        // Refresh user data
        $user_result = $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();
      } else {
        $update_error = "Failed to update profile: " . $conn->error;
      }
    }

    if (isset($_POST['upload_avatar'])) {
      // Handle avatar upload
      if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $file_type = $_FILES['avatar']['type'];

        if (in_array($file_type, $allowed_types)) {
          $upload_dir = '../uploads/avatars/';
          if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
          }

          $file_ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
          $filename = 'avatar_' . $user_id . '_' . time() . '.' . $file_ext;
          $filepath = $upload_dir . $filename;

          if (move_uploaded_file($_FILES['avatar']['tmp_name'], $filepath)) {
            $avatar_path = '../uploads/avatars/' . $filename;
            $update_stmt = $conn->prepare("UPDATE users SET avatar = ? WHERE id = ?");
            $update_stmt->bind_param("si", $avatar_path, $user_id);

            if ($update_stmt->execute()) {
              $update_message = "Avatar updated successfully!";
              $user['avatar'] = $avatar_path;
            } else {
              $update_error = "Failed to update avatar in database";
            }
          } else {
            $update_error = "Failed to upload file";
          }
        } else {
          $update_error = "Invalid file type. Only JPG, PNG, and GIF are allowed.";
        }
      }
    }

    if (isset($_POST['change_password'])) {
      // Handle password change
      $current_password = $_POST['current_password'] ?? '';
      $new_password = $_POST['new_password'] ?? '';
      $confirm_password = $_POST['confirm_password'] ?? '';

      if (password_verify($current_password, $user['password'])) {
        if ($new_password === $confirm_password) {
          if (strlen($new_password) >= 8) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $update_stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
            $update_stmt->bind_param("si", $hashed_password, $user_id);

            if ($update_stmt->execute()) {
              $update_message = "Password changed successfully!";
            } else {
              $update_error = "Failed to update password";
            }
          } else {
            $update_error = "Password must be at least 8 characters long";
          }
        } else {
          $update_error = "New passwords do not match";
        }
      } else {
        $update_error = "Current password is incorrect";
      }
    }
  }
} else {
  // User not found in database
  session_destroy();
  header("Location: ../auth/login.php");
  exit();
}

$page_title = "My Profile - Cosmic Beauty";
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $page_title; ?></title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Fonts & Icons -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    * {
      font-family: 'Urbanist', sans-serif;
    }

    .gradient-text {
      background: linear-gradient(90deg, #8b5cf6, #ec4899, #3b82f6);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .cosmic-gradient {
      background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #312e81 100%);
    }

    .profile-sidebar {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .stat-card {
      transition: transform 0.3s ease;
    }

    .stat-card:hover {
      transform: translateY(-5px);
    }

    .tab-content {
      display: none;
    }

    .tab-content.active {
      display: block;
      animation: fadeIn 0.5s ease;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
      }

      to {
        opacity: 1;
      }
    }

    .avatar-upload {
      position: relative;
      width: 150px;
      height: 150px;
      margin: 0 auto;
    }

    .avatar-upload img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 50%;
      border: 4px solid white;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .avatar-upload label {
      position: absolute;
      bottom: 10px;
      right: 10px;
      background: white;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
    }

    .avatar-upload label:hover {
      transform: scale(1.1);
      box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
    }

    .order-status {
      padding: 4px 12px;
      border-radius: 20px;
      font-size: 0.875rem;
      font-weight: 600;
    }

    .status-pending {
      background: #fef3c7;
      color: #92400e;
    }

    .status-processing {
      background: #dbeafe;
      color: #1e40af;
    }

    .status-shipped {
      background: #f0f9ff;
      color: #0c4a6e;
    }

    .status-delivered {
      background: #dcfce7;
      color: #166534;
    }

    .status-cancelled {
      background: #fee2e2;
      color: #991b1b;
    }
  </style>
</head>

<body class="bg-slate-50">
  <!-- HEADER -->
  <?php include '../layouts/header.php'; ?>

  <!-- BREADCRUMB -->
  <div class="bg-gradient-to-r from-purple-50 to-pink-50 py-4">
    <div class="container mx-auto px-4">
      <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
          <li class="inline-flex items-center">
            <a href="index.php" class="inline-flex items-center text-sm text-slate-600 hover:text-purple-600">
              <i class="fas fa-home mr-2"></i>
              Home
            </a>
          </li>
          <li aria-current="page">
            <div class="flex items-center">
              <i class="fas fa-chevron-right text-slate-300 mx-2"></i>
              <span class="ml-1 text-sm font-medium text-purple-600 md:ml-2">My Profile</span>
            </div>
          </li>
        </ol>
      </nav>
    </div>
  </div>

  <!-- PROFILE CONTENT -->
  <div class="container mx-auto px-4 py-8">
    <!-- Success/Error Messages -->
    <?php if ($update_message): ?>
      <div class="mb-6">
        <div class="bg-green-50 border border-green-200 rounded-xl p-4 text-green-800">
          <div class="flex items-center">
            <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
            <div>
              <h3 class="font-semibold">Success!</h3>
              <p><?php echo $update_message; ?></p>
            </div>
          </div>
        </div>
      </div>
    <?php elseif ($update_error): ?>
      <div class="mb-6">
        <div class="bg-red-50 border border-red-200 rounded-xl p-4 text-red-800">
          <div class="flex items-center">
            <i class="fas fa-exclamation-circle text-red-500 text-xl mr-3"></i>
            <div>
              <h3 class="font-semibold">Error!</h3>
              <p><?php echo $update_error; ?></p>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
      <!-- Sidebar -->
      <div class="lg:col-span-1">
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
          <!-- Profile Header -->
          <div class="profile-sidebar p-8 text-white text-center">
            <div class="avatar-upload mb-4">
              <img src="<?php echo !empty($user['avatar']) ? $user['avatar'] : 'images/default-avatar.jpg'; ?>"
                alt="Profile Avatar"
                id="avatarPreview">
              <form method="POST" enctype="multipart/form-data" id="avatarForm">
                <input type="file" name="avatar" id="avatarInput" accept="image/*" class="hidden" onchange="uploadAvatar()">
                <label for="avatarInput" class="cursor-pointer">
                  <i class="fas fa-camera text-purple-600"></i>
                </label>
                <input type="hidden" name="upload_avatar" value="1">
              </form>
            </div>
            <h2 class="text-xl font-bold mb-2"><?php echo htmlspecialchars($user['full_name'] ?? $user['username']); ?></h2>
            <p class="text-purple-200 text-sm mb-4">Member since <?php echo date('F Y', strtotime($user['created_at'])); ?></p>
            <div class="flex justify-center space-x-4">
              <div class="text-center">
                <div class="text-2xl font-bold"><?php echo $wishlist_count; ?></div>
                <div class="text-sm text-purple-200">Wishlist</div>
              </div>
              <div class="text-center">
                <div class="text-2xl font-bold"><?php echo $orders_result->num_rows; ?></div>
                <div class="text-sm text-purple-200">Orders</div>
              </div>
            </div>
          </div>

          <!-- Navigation Tabs -->
          <nav class="p-4">
            <ul class="space-y-2">
              <li>
                <button onclick="switchTab('overview')"
                  class="w-full text-left px-4 py-3 rounded-lg flex items-center space-x-3 hover:bg-purple-50 text-slate-700 tab-button active"
                  data-tab="overview">
                  <i class="fas fa-user-circle text-purple-600"></i>
                  <span>Profile Overview</span>
                </button>
              </li>
              <li>
                <button onclick="switchTab('edit')"
                  class="w-full text-left px-4 py-3 rounded-lg flex items-center space-x-3 hover:bg-purple-50 text-slate-700 tab-button"
                  data-tab="edit">
                  <i class="fas fa-edit text-purple-600"></i>
                  <span>Edit Profile</span>
                </button>
              </li>
              <li>
                <button onclick="switchTab('orders')"
                  class="w-full text-left px-4 py-3 rounded-lg flex items-center space-x-3 hover:bg-purple-50 text-slate-700 tab-button"
                  data-tab="orders">
                  <i class="fas fa-shopping-bag text-purple-600"></i>
                  <span>My Orders</span>
                </button>
              </li>
              <li>
                <button onclick="switchTab('wishlist')"
                  class="w-full text-left px-4 py-3 rounded-lg flex items-center space-x-3 hover:bg-purple-50 text-slate-700 tab-button"
                  data-tab="wishlist">
                  <i class="fas fa-star text-purple-600"></i>
                  <span>Wishlist</span>
                </button>
              </li>
              <li>
                <button onclick="switchTab('security')"
                  class="w-full text-left px-4 py-3 rounded-lg flex items-center space-x-3 hover:bg-purple-50 text-slate-700 tab-button"
                  data-tab="security">
                  <i class="fas fa-shield-alt text-purple-600"></i>
                  <span>Security</span>
                </button>
              </li>
              <li>
                <a href="logout.php"
                  class="w-full text-left px-4 py-3 rounded-lg flex items-center space-x-3 hover:bg-red-50 text-red-600">
                  <i class="fas fa-sign-out-alt"></i>
                  <span>Logout</span>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>

      <!-- Main Content -->
      <div class="lg:col-span-3">
        <!-- Overview Tab -->
        <div id="overview" class="tab-content active">
          <div class="bg-white rounded-2xl shadow-sm p-8">
            <h2 class="text-2xl font-bold text-slate-800 mb-6">Profile Overview</h2>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
              <div class="stat-card bg-gradient-to-r from-purple-50 to-pink-50 p-6 rounded-xl">
                <div class="flex items-center justify-between">
                  <div>
                    <div class="text-2xl font-bold text-slate-800"><?php echo $orders_result->num_rows; ?></div>
                    <div class="text-sm text-slate-600">Total Orders</div>
                  </div>
                  <i class="fas fa-shopping-bag text-purple-600 text-2xl"></i>
                </div>
              </div>

              <div class="stat-card bg-gradient-to-r from-blue-50 to-cyan-50 p-6 rounded-xl">
                <div class="flex items-center justify-between">
                  <div>
                    <div class="text-2xl font-bold text-slate-800"><?php echo $wishlist_count; ?></div>
                    <div class="text-sm text-slate-600">Wishlist Items</div>
                  </div>
                  <i class="fas fa-star text-blue-600 text-2xl"></i>
                </div>
              </div>

              <div class="stat-card bg-gradient-to-r from-emerald-50 to-green-50 p-6 rounded-xl">
                <div class="flex items-center justify-between">
                  <div>
                    <div class="text-2xl font-bold text-slate-800">
                      <?php
                      $member_days = floor((time() - strtotime($user['created_at'])) / (60 * 60 * 24));
                      echo $member_days;
                      ?>
                    </div>
                    <div class="text-sm text-slate-600">Days as Member</div>
                  </div>
                  <i class="fas fa-calendar-alt text-emerald-600 text-2xl"></i>
                </div>
              </div>
            </div>

            <!-- Personal Information -->
            <div class="mb-8">
              <h3 class="text-xl font-semibold text-slate-800 mb-4">Personal Information</h3>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                  <label class="block text-sm font-medium text-slate-500 mb-1">Full Name</label>
                  <p class="text-lg text-slate-800"><?php echo htmlspecialchars($user['full_name'] ?? 'Not set'); ?></p>
                </div>
                <div>
                  <label class="block text-sm font-medium text-slate-500 mb-1">Email Address</label>
                  <p class="text-lg text-slate-800"><?php echo htmlspecialchars($user['email']); ?></p>
                </div>
                <div>
                  <label class="block text-sm font-medium text-slate-500 mb-1">Phone Number</label>
                  <p class="text-lg text-slate-800"><?php echo htmlspecialchars($user['phone'] ?? 'Not set'); ?></p>
                </div>
                <div>
                  <label class="block text-sm font-medium text-slate-500 mb-1">Birthday</label>
                  <p class="text-lg text-slate-800">
                    <?php echo !empty($user['birthday']) ? date('F d, Y', strtotime($user['birthday'])) : 'Not set'; ?>
                  </p>
                </div>
                <div>
                  <label class="block text-sm font-medium text-slate-500 mb-1">Gender</label>
                  <p class="text-lg text-slate-800"><?php echo htmlspecialchars($user['gender'] ?? 'Not specified'); ?></p>
                </div>
                <div>
                  <label class="block text-sm font-medium text-slate-500 mb-1">Member Since</label>
                  <p class="text-lg text-slate-800"><?php echo date('F d, Y', strtotime($user['created_at'])); ?></p>
                </div>
              </div>
            </div>

            <!-- Shipping Address -->
            <div>
              <h3 class="text-xl font-semibold text-slate-800 mb-4">Shipping Address</h3>
              <?php if (!empty($user['address'])): ?>
                <div class="bg-slate-50 rounded-xl p-6">
                  <p class="text-slate-800 mb-2">
                    <i class="fas fa-map-marker-alt text-purple-600 mr-2"></i>
                    <?php echo htmlspecialchars($user['address']); ?>
                  </p>
                  <p class="text-slate-600">
                    <?php echo htmlspecialchars($user['city']); ?>,
                    <?php echo htmlspecialchars($user['province']); ?>
                    <?php echo htmlspecialchars($user['zip_code']); ?>
                  </p>
                </div>
              <?php else: ?>
                <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-6 text-yellow-800">
                  <div class="flex items-center">
                    <i class="fas fa-exclamation-triangle mr-3"></i>
                    <div>
                      <p>No shipping address set yet. Please update your profile to add a shipping address.</p>
                    </div>
                  </div>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <!-- Edit Profile Tab -->
        <div id="edit" class="tab-content">
          <div class="bg-white rounded-2xl shadow-sm p-8">
            <h2 class="text-2xl font-bold text-slate-800 mb-6">Edit Profile</h2>
            <form method="POST" action="">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                  <label for="full_name" class="block text-sm font-medium text-slate-700 mb-2">
                    Full Name
                  </label>
                  <input type="text"
                    id="full_name"
                    name="full_name"
                    value="<?php echo htmlspecialchars($user['full_name'] ?? ''); ?>"
                    class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                </div>

                <div>
                  <label for="email" class="block text-sm font-medium text-slate-700 mb-2">
                    Email Address
                  </label>
                  <input type="email"
                    id="email"
                    value="<?php echo htmlspecialchars($user['email']); ?>"
                    class="w-full px-4 py-3 rounded-lg border border-slate-300 bg-slate-50 cursor-not-allowed"
                    disabled>
                  <p class="text-sm text-slate-500 mt-1">Email cannot be changed</p>
                </div>

                <div>
                  <label for="phone" class="block text-sm font-medium text-slate-700 mb-2">
                    Phone Number
                  </label>
                  <input type="tel"
                    id="phone"
                    name="phone"
                    value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>"
                    class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                    placeholder="+63 912 345 6789">
                </div>

                <div>
                  <label for="birthday" class="block text-sm font-medium text-slate-700 mb-2">
                    Birthday
                  </label>
                  <input type="date"
                    id="birthday"
                    name="birthday"
                    value="<?php echo htmlspecialchars($user['birthday'] ?? ''); ?>"
                    class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                </div>

                <div>
                  <label for="gender" class="block text-sm font-medium text-slate-700 mb-2">
                    Gender
                  </label>
                  <select id="gender"
                    name="gender"
                    class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    <option value="">Select Gender</option>
                    <option value="Male" <?php echo (isset($user['gender']) && $user['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                    <option value="Female" <?php echo (isset($user['gender']) && $user['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                    <option value="Other" <?php echo (isset($user['gender']) && $user['gender'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                    <option value="Prefer not to say" <?php echo (isset($user['gender']) && $user['gender'] == 'Prefer not to say') ? 'selected' : ''; ?>>Prefer not to say</option>
                  </select>
                </div>
              </div>

              <div class="mb-6">
                <h3 class="text-lg font-semibold text-slate-800 mb-4">Shipping Address</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-4">
                  <div>
                    <label for="address" class="block text-sm font-medium text-slate-700 mb-2">
                      Street Address
                    </label>
                    <input type="text"
                      id="address"
                      name="address"
                      value="<?php echo htmlspecialchars($user['address'] ?? ''); ?>"
                      class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                      placeholder="123 Main Street">
                  </div>

                  <div>
                    <label for="city" class="block text-sm font-medium text-slate-700 mb-2">
                      City
                    </label>
                    <input type="text"
                      id="city"
                      name="city"
                      value="<?php echo htmlspecialchars($user['city'] ?? ''); ?>"
                      class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                      placeholder="City">
                  </div>

                  <div>
                    <label for="province" class="block text-sm font-medium text-slate-700 mb-2">
                      Province
                    </label>
                    <input type="text"
                      id="province"
                      name="province"
                      value="<?php echo htmlspecialchars($user['province'] ?? ''); ?>"
                      class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                      placeholder="Province">
                  </div>
                </div>

                <div class="md:w-1/3">
                  <label for="zip_code" class="block text-sm font-medium text-slate-700 mb-2">
                    ZIP Code
                  </label>
                  <input type="text"
                    id="zip_code"
                    name="zip_code"
                    value="<?php echo htmlspecialchars($user['zip_code'] ?? ''); ?>"
                    class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                    placeholder="1234">
                </div>
              </div>

              <button type="submit"
                name="update_profile"
                value="1"
                class="px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-500 text-white font-semibold rounded-lg hover:shadow-lg transition-shadow">
                Update Profile
              </button>
            </form>
          </div>
        </div>

        <!-- Orders Tab -->
        <div id="orders" class="tab-content">
          <div class="bg-white rounded-2xl shadow-sm p-8">
            <div class="flex justify-between items-center mb-6">
              <h2 class="text-2xl font-bold text-slate-800">My Orders</h2>
              <a href="orders.php" class="text-purple-600 hover:text-purple-800 font-medium">
                View All Orders <i class="fas fa-arrow-right ml-2"></i>
              </a>
            </div>

            <?php if ($orders_result->num_rows > 0): ?>
              <div class="overflow-x-auto">
                <table class="w-full">
                  <thead>
                    <tr class="bg-slate-50">
                      <th class="px-6 py-3 text-left text-sm font-semibold text-slate-700">Order ID</th>
                      <th class="px-6 py-3 text-left text-sm font-semibold text-slate-700">Date</th>
                      <th class="px-6 py-3 text-left text-sm font-semibold text-slate-700">Total</th>
                      <th class="px-6 py-3 text-left text-sm font-semibold text-slate-700">Status</th>
                      <th class="px-6 py-3 text-left text-sm font-semibold text-slate-700">Action</th>
                    </tr>
                  </thead>
                  <tbody class="divide-y divide-slate-200">
                    <?php while ($order = $orders_result->fetch_assoc()): ?>
                      <tr>
                        <td class="px-6 py-4">
                          <div class="text-sm font-medium text-slate-800">#<?php echo $order['order_number']; ?></div>
                        </td>
                        <td class="px-6 py-4">
                          <div class="text-sm text-slate-600">
                            <?php echo date('M d, Y', strtotime($order['order_date'])); ?>
                          </div>
                        </td>
                        <td class="px-6 py-4">
                          <div class="text-sm font-semibold text-slate-800">
                            ₱<?php echo number_format($order['total_amount'], 2); ?>
                          </div>
                        </td>
                        <td class="px-6 py-4">
                          <?php
                          $status_class = '';
                          switch ($order['status']) {
                            case 'pending':
                              $status_class = 'status-pending';
                              break;
                            case 'processing':
                              $status_class = 'status-processing';
                              break;
                            case 'shipped':
                              $status_class = 'status-shipped';
                              break;
                            case 'delivered':
                              $status_class = 'status-delivered';
                              break;
                            case 'cancelled':
                              $status_class = 'status-cancelled';
                              break;
                            default:
                              $status_class = 'status-pending';
                          }
                          ?>
                          <span class="order-status <?php echo $status_class; ?>">
                            <?php echo ucfirst($order['status']); ?>
                          </span>
                        </td>
                        <td class="px-6 py-4">
                          <a href="order-details.php?id=<?php echo $order['id']; ?>"
                            class="text-sm text-purple-600 hover:text-purple-800 font-medium">
                            View Details
                          </a>
                        </td>
                      </tr>
                    <?php endwhile; ?>
                  </tbody>
                </table>
              </div>
            <?php else: ?>
              <div class="text-center py-12">
                <i class="fas fa-shopping-bag text-4xl text-slate-300 mb-4"></i>
                <h3 class="text-lg font-semibold text-slate-700 mb-2">No orders yet</h3>
                <p class="text-slate-500 mb-6">Start shopping to see your orders here!</p>
                <a href="shop.php"
                  class="inline-block px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-500 text-white font-semibold rounded-lg hover:shadow-lg transition-shadow">
                  Start Shopping
                </a>
              </div>
            <?php endif; ?>
          </div>
        </div>

        <!-- Wishlist Tab -->
        <div id="wishlist" class="tab-content">
          <div class="bg-white rounded-2xl shadow-sm p-8">
            <div class="flex justify-between items-center mb-6">
              <h2 class="text-2xl font-bold text-slate-800">My Wishlist</h2>
              <span class="text-slate-600"><?php echo $wishlist_count; ?> items</span>
            </div>

            <?php if ($wishlist_count > 0): ?>
              <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Sample wishlist items - Replace with actual data from database -->
                <div class="border border-slate-200 rounded-xl p-4">
                  <div class="flex space-x-4">
                    <img src="images/product-01.jpg"
                      alt="Product"
                      class="w-20 h-20 object-cover rounded-lg">
                    <div class="flex-1">
                      <h3 class="font-semibold text-slate-800 mb-1">Galactic Glow Serum</h3>
                      <p class="text-sm text-slate-600 mb-2">Skincare</p>
                      <div class="flex justify-between items-center">
                        <span class="font-bold text-slate-800">₱1,299.00</span>
                        <button class="text-red-500 hover:text-red-700">
                          <i class="fas fa-trash"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                  <button class="w-full mt-4 py-2 bg-purple-600 text-white rounded-lg font-medium hover:bg-purple-700 transition-colors">
                    Add to Cart
                  </button>
                </div>
              </div>
            <?php else: ?>
              <div class="text-center py-12">
                <i class="fas fa-star text-4xl text-slate-300 mb-4"></i>
                <h3 class="text-lg font-semibold text-slate-700 mb-2">Your wishlist is empty</h3>
                <p class="text-slate-500 mb-6">Save your favorite products here!</p>
                <a href="shop.php"
                  class="inline-block px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-500 text-white font-semibold rounded-lg hover:shadow-lg transition-shadow">
                  Browse Products
                </a>
              </div>
            <?php endif; ?>
          </div>
        </div>

        <!-- Security Tab -->
        <div id="security" class="tab-content">
          <div class="bg-white rounded-2xl shadow-sm p-8">
            <h2 class="text-2xl font-bold text-slate-800 mb-6">Security Settings</h2>

            <!-- Change Password Form -->
            <div class="max-w-lg">
              <h3 class="text-lg font-semibold text-slate-800 mb-4">Change Password</h3>
              <form method="POST" action="">
                <div class="space-y-4 mb-6">
                  <div>
                    <label for="current_password" class="block text-sm font-medium text-slate-700 mb-2">
                      Current Password
                    </label>
                    <input type="password"
                      id="current_password"
                      name="current_password"
                      required
                      class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                      placeholder="Enter your current password">
                  </div>

                  <div>
                    <label for="new_password" class="block text-sm font-medium text-slate-700 mb-2">
                      New Password
                    </label>
                    <input type="password"
                      id="new_password"
                      name="new_password"
                      required
                      class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                      placeholder="Enter new password (min. 8 characters)">
                  </div>

                  <div>
                    <label for="confirm_password" class="block text-sm font-medium text-slate-700 mb-2">
                      Confirm New Password
                    </label>
                    <input type="password"
                      id="confirm_password"
                      name="confirm_password"
                      required
                      class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                      placeholder="Confirm your new password">
                  </div>
                </div>

                <div class="mb-8">
                  <h4 class="text-sm font-medium text-slate-700 mb-2">Password Requirements:</h4>
                  <ul class="text-sm text-slate-600 space-y-1">
                    <li class="flex items-center">
                      <i class="fas fa-check text-green-500 mr-2"></i>
                      At least 8 characters long
                    </li>
                    <li class="flex items-center">
                      <i class="fas fa-check text-green-500 mr-2"></i>
                      Use a mix of letters, numbers, and symbols
                    </li>
                    <li class="flex items-center">
                      <i class="fas fa-check text-green-500 mr-2"></i>
                      Avoid common words or patterns
                    </li>
                  </ul>
                </div>

                <button type="submit"
                  name="change_password"
                  value="1"
                  class="px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-500 text-white font-semibold rounded-lg hover:shadow-lg transition-shadow">
                  Change Password
                </button>
              </form>
            </div>

            <!-- Account Security -->
            <div class="mt-8 pt-8 border-t border-slate-200">
              <h3 class="text-lg font-semibold text-slate-800 mb-4">Account Security</h3>
              <div class="bg-slate-50 rounded-xl p-6">
                <div class="flex items-center justify-between mb-4">
                  <div>
                    <h4 class="font-medium text-slate-800">Two-Factor Authentication</h4>
                    <p class="text-sm text-slate-600">Add an extra layer of security to your account</p>
                  </div>
                  <div class="relative">
                    <input type="checkbox" id="2fa-toggle" class="sr-only">
                    <label for="2fa-toggle" class="block w-12 h-6 bg-slate-300 rounded-full cursor-pointer"></label>
                  </div>
                </div>

                <div class="flex items-center justify-between">
                  <div>
                    <h4 class="font-medium text-slate-800">Login Activity</h4>
                    <p class="text-sm text-slate-600">Last login: <?php echo date('F d, Y \a\t h:i A', strtotime($user['last_login'] ?? 'now')); ?></p>
                  </div>
                  <a href="login-history.php" class="text-purple-600 hover:text-purple-800 font-medium text-sm">
                    View History
                  </a>
                </div>
              </div>
            </div>

            <!-- Account Deletion -->
            <div class="mt-8 pt-8 border-t border-slate-200">
              <div class="bg-red-50 border border-red-200 rounded-xl p-6">
                <div class="flex items-start">
                  <i class="fas fa-exclamation-triangle text-red-500 text-xl mt-1 mr-3"></i>
                  <div>
                    <h3 class="font-semibold text-red-800 mb-2">Danger Zone</h3>
                    <p class="text-red-700 mb-4">
                      Once you delete your account, there is no going back. This action cannot be undone.
                      All your data, orders, and preferences will be permanently removed.
                    </p>
                    <button type="button"
                      onclick="openDeleteModal()"
                      class="px-4 py-2 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition-colors">
                      Delete My Account
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Delete Account Modal -->
  <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl max-w-md w-full">
      <div class="p-6">
        <div class="flex items-center mb-4">
          <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mr-4">
            <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
          </div>
          <div>
            <h3 class="text-xl font-bold text-slate-800">Delete Account</h3>
            <p class="text-slate-600">Are you absolutely sure?</p>
          </div>
        </div>

        <p class="text-slate-700 mb-6">
          This action will permanently delete your Cosmic Beauty account and remove all your data from our servers. This includes:
        </p>

        <ul class="text-slate-600 mb-6 space-y-2">
          <li class="flex items-center">
            <i class="fas fa-times text-red-500 mr-2"></i>
            All personal information and profile data
          </li>
          <li class="flex items-center">
            <i class="fas fa-times text-red-500 mr-2"></i>
            Order history and transaction records
          </li>
          <li class="flex items-center">
            <i class="fas fa-times text-red-500 mr-2"></i>
            Wishlist and saved preferences
          </li>
          <li class="flex items-center">
            <i class="fas fa-times text-red-500 mr-2"></i>
            Reviews and ratings you've submitted
          </li>
        </ul>

        <div class="flex space-x-4">
          <button type="button"
            onclick="closeDeleteModal()"
            class="flex-1 px-4 py-3 border border-slate-300 text-slate-700 font-medium rounded-lg hover:bg-slate-50 transition-colors">
            Cancel
          </button>
          <button type="button"
            onclick="confirmDeleteAccount()"
            class="flex-1 px-4 py-3 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition-colors">
            Yes, Delete My Account
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- FOOTER -->
  <?php include '../layouts/footer.php'; ?>

  <script>
    // Tab Switching
    function switchTab(tabName) {
      // Hide all tab contents
      document.querySelectorAll('.tab-content').forEach(tab => {
        tab.classList.remove('active');
      });

      // Remove active class from all tab buttons
      document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('active');
      });

      // Show selected tab content
      document.getElementById(tabName).classList.add('active');

      // Add active class to clicked button
      event.target.closest('.tab-button').classList.add('active');
    }

    // Avatar Upload
    function uploadAvatar() {
      document.getElementById('avatarForm').submit();
    }

    // Preview avatar before upload (optional enhancement)
    document.getElementById('avatarInput')?.addEventListener('change', function(e) {
      if (e.target.files[0]) {
        const reader = new FileReader();
        reader.onload = function(event) {
          document.getElementById('avatarPreview').src = event.target.result;
        }
        reader.readAsDataURL(e.target.files[0]);
      }
    });

    // Delete Account Modal
    function openDeleteModal() {
      document.getElementById('deleteModal').classList.remove('hidden');
      document.getElementById('deleteModal').classList.add('flex');
    }

    function closeDeleteModal() {
      document.getElementById('deleteModal').classList.add('hidden');
      document.getElementById('deleteModal').classList.remove('flex');
    }

    function confirmDeleteAccount() {
      if (confirm('Are you absolutely sure? This action cannot be undone!')) {
        // Redirect to account deletion script
        window.location.href = 'delete-account.php';
      }
    }

    // Form Validation
    document.addEventListener('DOMContentLoaded', function() {
      // Password match validation
      const newPassword = document.getElementById('new_password');
      const confirmPassword = document.getElementById('confirm_password');

      if (newPassword && confirmPassword) {
        function validatePassword() {
          if (newPassword.value !== confirmPassword.value) {
            confirmPassword.setCustomValidity("Passwords don't match");
          } else {
            confirmPassword.setCustomValidity('');
          }
        }

        newPassword.onchange = validatePassword;
        confirmPassword.onkeyup = validatePassword;
      }

      // Show password strength
      const passwordInputs = document.querySelectorAll('input[type="password"]');
      passwordInputs.forEach(input => {
        input.addEventListener('input', function() {
          // Add password strength indicator logic here
        });
      });
    });

    // Toast Notification Function (for future enhancements)
    function showToast(message, type = 'success') {
      const toast = document.createElement('div');
      toast.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg text-white font-medium z-50 animate-slide-in ${
                type === 'success' ? 'bg-green-500' : 'bg-red-500'
            }`;
      toast.textContent = message;
      document.body.appendChild(toast);

      setTimeout(() => {
        toast.classList.add('animate-slide-out');
        setTimeout(() => toast.remove(), 300);
      }, 3000);
    }

    // Initialize tooltips
    document.querySelectorAll('[data-tooltip]').forEach(element => {
      element.addEventListener('mouseenter', function() {
        const tooltip = document.createElement('div');
        tooltip.className = 'absolute z-10 px-3 py-2 text-sm text-white bg-slate-800 rounded-lg shadow-lg';
        tooltip.textContent = this.getAttribute('data-tooltip');
        document.body.appendChild(tooltip);

        const rect = this.getBoundingClientRect();
        tooltip.style.top = `${rect.top - tooltip.offsetHeight - 10}px`;
        tooltip.style.left = `${rect.left + rect.width / 2 - tooltip.offsetWidth / 2}px`;

        this._tooltip = tooltip;
      });

      element.addEventListener('mouseleave', function() {
        if (this._tooltip) {
          this._tooltip.remove();
        }
      });
    });
  </script>
</body>

</html>

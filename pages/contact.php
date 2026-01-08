<?php
session_start();

// Handle form submission
$message_sent = false;
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Sanitize input
  $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
  $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
  $phone = filter_var(trim($_POST['phone']), FILTER_SANITIZE_STRING);
  $subject = filter_var(trim($_POST['subject']), FILTER_SANITIZE_STRING);
  $message = filter_var(trim($_POST['message']), FILTER_SANITIZE_STRING);

  // Validate input
  if (empty($name) || empty($email) || empty($message)) {
    $error_message = "Please fill in all required fields.";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error_message = "Please enter a valid email address.";
  } else {
    // In a real application, you would:
    // 1. Save to database
    // 2. Send email notification
    // 3. Process the contact request

    // For demo purposes, we'll just set a success message
    $message_sent = true;

    // You could add database saving here:
    /*
        require '../config/db.php';
        $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $email, $phone, $subject, $message);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        */
  }
}

$page_title = "Contact Us | Cosmic Beauty";
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

    .contact-info-card {
      transition: transform 0.3s ease;
    }

    .contact-info-card:hover {
      transform: translateY(-5px);
    }

    .form-input:focus {
      box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
    }

    .map-container {
      border-radius: 1rem;
      overflow: hidden;
      height: 400px;
    }
  </style>
</head>

<body class="bg-slate-50">
  <!-- HEADER -->
  <?php include '../layouts/header.php'; ?>

  <!-- BREADCRUMB -->
  <div class="bg-gradient-to-r from-emerald-50 to-teal-50 py-4">
    <div class="container mx-auto px-4">
      <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
          <li class="inline-flex items-center">
            <a href="index.php" class="inline-flex items-center text-sm text-slate-600 hover:text-emerald-600">
              <i class="fas fa-home mr-2"></i>
              Home
            </a>
          </li>
          <li aria-current="page">
            <div class="flex items-center">
              <i class="fas fa-chevron-right text-slate-300 mx-2"></i>
              <span class="ml-1 text-sm font-medium text-emerald-600 md:ml-2">Contact Us</span>
            </div>
          </li>
        </ol>
      </nav>
    </div>
  </div>

  <!-- CONTACT CONTENT -->
  <div class="container mx-auto px-4 py-12">
    <!-- Page Header -->
    <div class="text-center mb-12">
      <h1 class="text-4xl md:text-5xl font-bold text-slate-800 mb-4">Get in Touch with <span class="gradient-text">Cosmic Beauty</span></h1>
      <p class="text-lg text-slate-600 max-w-2xl mx-auto">
        We're here to help! Whether you have questions, need support, or want to share your cosmic beauty experience.
      </p>
    </div>

    <!-- Success/Error Messages -->
    <?php if ($message_sent): ?>
      <div class="max-w-2xl mx-auto mb-8">
        <div class="bg-green-50 border border-green-200 rounded-xl p-6 text-green-800">
          <div class="flex items-center">
            <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
            <div>
              <h3 class="font-semibold text-lg">Message Sent Successfully!</h3>
              <p>Thank you for contacting Cosmic Beauty. Our team will get back to you within 24-48 hours.</p>
            </div>
          </div>
        </div>
      </div>
    <?php elseif ($error_message): ?>
      <div class="max-w-2xl mx-auto mb-8">
        <div class="bg-red-50 border border-red-200 rounded-xl p-6 text-red-800">
          <div class="flex items-center">
            <i class="fas fa-exclamation-circle text-red-500 text-xl mr-3"></i>
            <div>
              <h3 class="font-semibold text-lg">Error Sending Message</h3>
              <p><?php echo htmlspecialchars($error_message); ?></p>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>

    <!-- Contact Methods -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
      <div class="contact-info-card bg-white p-8 rounded-2xl shadow-sm text-center">
        <div class="w-16 h-16 mx-auto mb-6 rounded-full bg-purple-100 flex items-center justify-center">
          <i class="fas fa-phone-alt text-purple-600 text-2xl"></i>
        </div>
        <h3 class="text-xl font-bold text-slate-800 mb-3">Call Us</h3>
        <p class="text-slate-600 mb-4">Speak directly with our beauty consultants</p>
        <a href="tel:+6391234567910" class="text-2xl font-bold text-purple-600 hover:text-purple-800">
          +63 912 3456 910
        </a>
        <p class="text-sm text-slate-500 mt-2">Mon-Fri: 9AM-6PM | Sat: 10AM-4PM</p>
      </div>

      <div class="contact-info-card bg-white p-8 rounded-2xl shadow-sm text-center">
        <div class="w-16 h-16 mx-auto mb-6 rounded-full bg-pink-100 flex items-center justify-center">
          <i class="fas fa-envelope text-pink-600 text-2xl"></i>
        </div>
        <h3 class="text-xl font-bold text-slate-800 mb-3">Email Us</h3>
        <p class="text-slate-600 mb-4">Send us an email anytime</p>
        <a href="mailto:hello@cosmicbeauty.com" class="text-xl font-semibold text-pink-600 hover:text-pink-800">
          hello@cosmicbeauty.com
        </a>
        <p class="text-sm text-slate-500 mt-2">Response within 24 hours</p>
      </div>

      <div class="contact-info-card bg-white p-8 rounded-2xl shadow-sm text-center">
        <div class="w-16 h-16 mx-auto mb-6 rounded-full bg-blue-100 flex items-center justify-center">
          <i class="fas fa-comments text-blue-600 text-2xl"></i>
        </div>
        <h3 class="text-xl font-bold text-slate-800 mb-3">Live Chat</h3>
        <p class="text-slate-600 mb-4">Chat with us in real-time</p>
        <button id="liveChatBtn" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors">
          Start Chat
        </button>
        <p class="text-sm text-slate-500 mt-2">Available 24/7 for urgent queries</p>
      </div>
    </div>

    <!-- Contact Form & Info -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
      <!-- Contact Form -->
      <div class="bg-white rounded-2xl shadow-sm p-8">
        <h2 class="text-2xl font-bold text-slate-800 mb-6">Send Us a Message</h2>
        <form method="POST" action="" class="space-y-6">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label for="name" class="block text-sm font-medium text-slate-700 mb-2">
                Full Name <span class="text-red-500">*</span>
              </label>
              <input type="text"
                id="name"
                name="name"
                required
                class="w-full px-4 py-3 rounded-lg border border-slate-300 form-input focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                placeholder="Your name"
                value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
            </div>

            <div>
              <label for="email" class="block text-sm font-medium text-slate-700 mb-2">
                Email Address <span class="text-red-500">*</span>
              </label>
              <input type="email"
                id="email"
                name="email"
                required
                class="w-full px-4 py-3 rounded-lg border border-slate-300 form-input focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                placeholder="your.email@example.com"
                value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label for="phone" class="block text-sm font-medium text-slate-700 mb-2">
                Phone Number
              </label>
              <input type="tel"
                id="phone"
                name="phone"
                class="w-full px-4 py-3 rounded-lg border border-slate-300 form-input focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                placeholder="+63 912 345 6789"
                value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>">
            </div>

            <div>
              <label for="subject" class="block text-sm font-medium text-slate-700 mb-2">
                Subject
              </label>
              <select id="subject"
                name="subject"
                class="w-full px-4 py-3 rounded-lg border border-slate-300 form-input focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                <option value="">Select a subject</option>
                <option value="General Inquiry" <?php echo (isset($_POST['subject']) && $_POST['subject'] == 'General Inquiry') ? 'selected' : ''; ?>>General Inquiry</option>
                <option value="Product Question" <?php echo (isset($_POST['subject']) && $_POST['subject'] == 'Product Question') ? 'selected' : ''; ?>>Product Question</option>
                <option value="Order Support" <?php echo (isset($_POST['subject']) && $_POST['subject'] == 'Order Support') ? 'selected' : ''; ?>>Order Support</option>
                <option value="Returns & Refunds" <?php echo (isset($_POST['subject']) && $_POST['subject'] == 'Returns & Refunds') ? 'selected' : ''; ?>>Returns & Refunds</option>
                <option value="Business Inquiry" <?php echo (isset($_POST['subject']) && $_POST['subject'] == 'Business Inquiry') ? 'selected' : ''; ?>>Business Inquiry</option>
                <option value="Other" <?php echo (isset($_POST['subject']) && $_POST['subject'] == 'Other') ? 'selected' : ''; ?>>Other</option>
              </select>
            </div>
          </div>

          <div>
            <label for="message" class="block text-sm font-medium text-slate-700 mb-2">
              Message <span class="text-red-500">*</span>
            </label>
            <textarea id="message"
              name="message"
              rows="6"
              required
              class="w-full px-4 py-3 rounded-lg border border-slate-300 form-input focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
              placeholder="Your message..."><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
          </div>

          <div class="flex items-center">
            <input type="checkbox"
              id="newsletter"
              name="newsletter"
              class="w-4 h-4 text-purple-600 rounded focus:ring-purple-500 border-slate-300">
            <label for="newsletter" class="ml-2 text-sm text-slate-600">
              Subscribe to our newsletter for beauty tips and exclusive offers
            </label>
          </div>

          <button type="submit"
            class="w-full py-3 px-4 bg-gradient-to-r from-purple-600 to-pink-500 text-white font-semibold rounded-lg hover:shadow-lg transform hover:-translate-y-1 transition-all duration-300">
            Send Message <i class="fas fa-paper-plane ml-2"></i>
          </button>
        </form>
      </div>

      <!-- Contact Information -->
      <div>
        <div class="bg-gradient-to-r from-purple-600 to-pink-500 rounded-2xl p-8 text-white mb-8">
          <h2 class="text-2xl font-bold mb-6">Visit Our Store</h2>
          <div class="space-y-6">
            <div class="flex items-start space-x-4">
              <i class="fas fa-map-marker-alt text-xl mt-1"></i>
              <div>
                <h3 class="font-semibold text-lg mb-1">Cosmic Beauty Headquarters</h3>
                <p>123 Starlight Avenue<br>
                  Makati City, Metro Manila<br>
                  Philippines 1200</p>
              </div>
            </div>

            <div class="flex items-start space-x-4">
              <i class="fas fa-clock text-xl mt-1"></i>
              <div>
                <h3 class="font-semibold text-lg mb-1">Store Hours</h3>
                <p>Monday - Friday: 10:00 AM - 8:00 PM<br>
                  Saturday: 10:00 AM - 6:00 PM<br>
                  Sunday: 12:00 PM - 5:00 PM</p>
              </div>
            </div>

            <div class="flex items-start space-x-4">
              <i class="fas fa-info-circle text-xl mt-1"></i>
              <div>
                <h3 class="font-semibold text-lg mb-1">Additional Info</h3>
                <p>Free parking available<br>
                  Wheelchair accessible<br>
                  Free WiFi in store</p>
              </div>
            </div>
          </div>
        </div>

        <!-- FAQ Preview -->
        <div class="bg-white rounded-2xl shadow-sm p-8">
          <h2 class="text-2xl font-bold text-slate-800 mb-6">Frequently Asked Questions</h2>
          <div class="space-y-4">
            <div>
              <h3 class="font-semibold text-slate-800 mb-2">What is your return policy?</h3>
              <p class="text-slate-600 text-sm">We offer a 30-day return policy for unopened products.</p>
            </div>
            <div>
              <h3 class="font-semibold text-slate-800 mb-2">Do you ship internationally?</h3>
              <p class="text-slate-600 text-sm">Yes, we ship to over 50 countries worldwide.</p>
            </div>
            <div>
              <h3 class="font-semibold text-slate-800 mb-2">Are your products cruelty-free?</h3>
              <p class="text-slate-600 text-sm">Absolutely! All our products are 100% cruelty-free.</p>
            </div>
          </div>
          <a href="faq.php" class="inline-flex items-center text-purple-600 font-semibold mt-6 hover:text-purple-800">
            View All FAQs <i class="fas fa-arrow-right ml-2"></i>
          </a>
        </div>
      </div>
    </div>

    <!-- Store Location Map -->
    <div class="mb-16">
      <h2 class="text-3xl font-bold text-slate-800 mb-8 text-center">Find Our Store</h2>
      <div class="map-container bg-slate-200">
        <!-- In a real implementation, you would embed Google Maps here -->
        <div class="w-full h-full flex items-center justify-center bg-gradient-to-r from-purple-100 to-pink-100">
          <div class="text-center p-8">
            <i class="fas fa-map-marked-alt text-6xl text-purple-600 mb-4"></i>
            <h3 class="text-xl font-bold text-slate-800 mb-2">Cosmic Beauty Store Location</h3>
            <p class="text-slate-600">123 Starlight Avenue, Makati City, Philippines</p>
            <a href="https://maps.google.com" target="_blank"
              class="inline-block mt-4 px-6 py-3 bg-purple-600 text-white rounded-lg font-semibold hover:bg-purple-700 transition-colors">
              <i class="fas fa-directions mr-2"></i> Get Directions
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- Social Media -->
    <div class="text-center">
      <h2 class="text-3xl font-bold text-slate-800 mb-6">Connect With Us</h2>
      <p class="text-slate-600 mb-8 max-w-2xl mx-auto">
        Follow us on social media for daily beauty tips, behind-the-scenes content,
        and exclusive online-only offers.
      </p>
      <div class="flex justify-center space-x-6">
        <a href="https://www.facebook.com/his.bannie" class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 hover:bg-purple-200 transition-colors">
          <i class="fab fa-facebook-f text-xl"></i>
        </a>
        <a href="https://www.instagram.com/his.bannie" class="w-12 h-12 rounded-full bg-pink-100 flex items-center justify-center text-pink-600 hover:bg-pink-200 transition-colors">
          <i class="fab fa-instagram text-xl"></i>
        </a>
        <a href="https://x.com/JBringcola" class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 hover:bg-blue-200 transition-colors">
          <i class="fab fa-twitter text-xl"></i>
        </a>
        <a href="https://www.youtube.com/@KnownAsBanBan" class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center text-red-600 hover:bg-red-200 transition-colors">
          <i class="fab fa-youtube text-xl"></i>
        </a>
        <a href="#" class="w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 hover:bg-emerald-200 transition-colors">
          <i class="fab fa-tiktok text-xl"></i>
        </a>
      </div>
    </div>
  </div>

  <!-- FOOTER -->
  <?php include '../layouts/footer.php'; ?>

  <script>
    // Live chat button
    document.getElementById('liveChatBtn').addEventListener('click', function() {
      const notification = document.createElement('div');
      notification.className = 'fixed top-4 right-4 bg-blue-500 text-white px-6 py-3 rounded-lg shadow-lg transform translate-x-full opacity-0 transition-all duration-300 z-50';
      notification.textContent = 'Live chat is currently offline. Please email us or call during business hours.';
      document.body.appendChild(notification);

      setTimeout(() => {
        notification.classList.remove('translate-x-full', 'opacity-0');
        notification.classList.add('translate-x-0', 'opacity-100');
      }, 10);

      setTimeout(() => {
        notification.classList.remove('translate-x-0', 'opacity-100');
        notification.classList.add('translate-x-full', 'opacity-0');
        setTimeout(() => {
          document.body.removeChild(notification);
        }, 300);
      }, 3000);
    });

    // Contact info card hover effects
    document.querySelectorAll('.contact-info-card').forEach(card => {
      card.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-5px)';
      });

      card.addEventListener('mouseleave', function() {
        this.style.transform = '';
      });
    });

    // Form validation
    document.querySelector('form').addEventListener('submit', function(e) {
      const name = document.getElementById('name').value.trim();
      const email = document.getElementById('email').value.trim();
      const message = document.getElementById('message').value.trim();

      if (!name || !email || !message) {
        e.preventDefault();

        const notification = document.createElement('div');
        notification.className = 'fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg transform translate-x-full opacity-0 transition-all duration-300 z-50';
        notification.textContent = 'Please fill in all required fields.';
        document.body.appendChild(notification);

        setTimeout(() => {
          notification.classList.remove('translate-x-full', 'opacity-0');
          notification.classList.add('translate-x-0', 'opacity-100');
        }, 10);

        setTimeout(() => {
          notification.classList.remove('translate-x-0', 'opacity-100');
          notification.classList.add('translate-x-full', 'opacity-0');
          setTimeout(() => {
            document.body.removeChild(notification);
          }, 300);
        }, 3000);
      }
    });
  </script>
</body>

</html>

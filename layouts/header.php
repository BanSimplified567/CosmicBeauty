<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once __DIR__ . '/../config/app.php';
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!-- HEADER -->
<header class="sticky top-0 z-50 bg-white/95 backdrop-blur-sm shadow-lg">
  <div class="container mx-auto px-4 py-3">
    <div class="flex items-center gap-4 justify-between">
      <!-- Mobile Menu Button -->
      <button class="lg:hidden flex flex-col space-y-1" id="mobileMenuBtn">
        <span class="w-6 h-0.5 bg-slate-700"></span>
        <span class="w-6 h-0.5 bg-slate-700"></span>
        <span class="w-6 h-0.5 bg-slate-700"></span>
      </button>

      <!-- Logo -->
      <a href="<?= BASE_URL ?>/index.php" class="flex items-center space-x-2">
        <div class="w-10 h-10 rounded-full bg-gradient-to-r from-purple-600 to-pink-500 flex items-center justify-center">
          <i class="fas fa-star text-white"></i>
        </div>
        <h3 class="text-xl font-bold gradient-text">Cosmic Beauty</h3>
      </a>

      <!-- Desktop Navigation -->
      <nav class="hidden lg:flex items-center space-x-8">
        <a href="<?= BASE_URL ?>/index.php"
          class="<?php echo $current_page == 'index.php' ? 'text-purple-600 font-semibold' : 'text-slate-700'; ?> hover:text-purple-600 font-medium transition-colors duration-300">
          Home
        </a>
        <a href="<?= BASE_URL ?>/pages/collection.php"
          class="<?php echo $current_page == 'collection.php' ? 'text-purple-600 font-semibold' : 'text-slate-700'; ?> hover:text-purple-600 font-medium transition-colors duration-300">
          Collection
        </a>
        <a href="<?= BASE_URL ?>/pages/shop.php"
          class="<?php echo $current_page == 'shop.php' ? 'text-purple-600 font-semibold' : 'text-slate-700'; ?> hover:text-purple-600 font-medium transition-colors duration-300">
          Shop
        </a>
        <a href="<?= BASE_URL ?>/pages/offers.php"
          class="<?php echo $current_page == 'offers.php' ? 'text-purple-600 font-semibold' : 'text-slate-700'; ?> hover:text-purple-600 font-medium transition-colors duration-300">
          Offers
        </a>
        <a href="<?= BASE_URL ?>/pages/blog.php"
          class="<?php echo $current_page == 'blog.php' ? 'text-purple-600 font-semibold' : 'text-slate-700'; ?> hover:text-purple-600 font-medium transition-colors duration-300">
          Blog
        </a>
        <a href="<?= BASE_URL ?>/pages/about.php"
          class="<?php echo $current_page == 'about.php' ? 'text-purple-600 font-semibold' : 'text-slate-700'; ?> hover:text-purple-600 font-medium transition-colors duration-300">
          About
        </a>
        <a href="<?= BASE_URL ?>/pages/contact.php"
          class="<?php echo $current_page == 'contact.php' ? 'text-purple-600 font-semibold' : 'text-slate-700'; ?> hover:text-purple-600 font-medium transition-colors duration-300">
          Contact
        </a>
      </nav>

      <!-- Search Bar -->
      <div class="hidden md:flex flex-1 max-w-md mx-8">
        <div class="relative w-full">
          <input type="search"
            placeholder="Search products..."
            class="w-full px-4 py-2 pl-10 rounded-full border border-slate-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" />
          <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
        </div>
      </div>

      <!-- Header Actions -->
      <div class="flex items-center space-x-4">
        <button class="hidden md:block relative p-2 hover:bg-slate-100 rounded-full transition-colors duration-300" id="searchBtn">
          <i class="fas fa-search text-slate-600"></i>
        </button>

        <?php if (isset($_SESSION['user_id'])): ?>
          <a href="<?= BASE_URL ?>/pages/profile.php" class="relative p-2 hover:bg-slate-100 rounded-full transition-colors duration-300">
            <i class="fas fa-user text-slate-600"></i>
          </a>
        <?php else: ?>
          <a href="<?= BASE_URL ?>/pages/login.php" class="relative p-2 hover:bg-slate-100 rounded-full transition-colors duration-300">
            <i class="fas fa-user text-slate-600"></i>
          </a>
        <?php endif; ?>

        <button class="relative p-2 hover:bg-slate-100 rounded-full transition-colors duration-300" id="wishlistBtn">
          <i class="fas fa-star text-slate-600"></i>
          <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center" id="wishlistCount">
            <?php echo isset($_SESSION['wishlist_count']) ? $_SESSION['wishlist_count'] : '0'; ?>
          </span>
        </button>

        <button class="relative p-2 hover:bg-slate-100 rounded-full transition-colors duration-300" id="cartBtn">
          <i class="fas fa-shopping-bag text-slate-600"></i>
          <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center" id="cartCount">
            <?php echo isset($_SESSION['cart_count']) ? $_SESSION['cart_count'] : '0'; ?>
          </span>
          <span class="absolute bottom-6 text-xs font-medium bold text-slate-700" id="cartTotal">
            ₱<?php echo isset($_SESSION['cart_total']) ? number_format($_SESSION['cart_total'], 2) : '0.00'; ?>
          </span>
        </button>
      </div>
    </div>
  </div>

  <!-- Mobile Navigation -->
  <div id="mobileMenu" class="hidden lg:hidden bg-white shadow-lg">
    <div class="container mx-auto px-4 py-4">
      <div class="space-y-4">
        <a href="<?= BASE_URL ?>/index.php"
          class="block <?php echo $current_page == 'index.php' ? 'text-purple-600 font-semibold' : 'text-slate-700'; ?> hover:text-purple-600 font-medium py-2">
          Home
        </a>
        <a href="<?= BASE_URL ?>/pages/collection.php"
          class="block <?php echo $current_page == 'collection.php' ? 'text-purple-600 font-semibold' : 'text-slate-700'; ?> hover:text-purple-600 font-medium py-2">
          Collection
        </a>
        <a href="<?= BASE_URL ?>/pages/shop.php"
          class="block <?php echo $current_page == 'shop.php' ? 'text-purple-600 font-semibold' : 'text-slate-700'; ?> hover:text-purple-600 font-medium py-2">
          Shop
        </a>
        <a href="<?= BASE_URL ?>/pages/offers.php"
          class="block <?php echo $current_page == 'offers.php' ? 'text-purple-600 font-semibold' : 'text-slate-700'; ?> hover:text-purple-600 font-medium py-2">
          Offers
        </a>
        <a href="<?= BASE_URL ?>/pages/blog.php"
          class="block <?php echo $current_page == 'blog.php' ? 'text-purple-600 font-semibold' : 'text-slate-700'; ?> hover:text-purple-600 font-medium py-2">
          Blog
        </a>
        <a href="<?= BASE_URL ?>/pages/about.php"
          class="block <?php echo $current_page == 'about.php' ? 'text-purple-600 font-semibold' : 'text-slate-700'; ?> hover:text-purple-600 font-medium py-2">
          About
        </a>
        <a href="<?= BASE_URL ?>/pages/contact.php"
          class="block <?php echo $current_page == 'contact.php' ? 'text-purple-600 font-semibold' : 'text-slate-700'; ?> hover:text-purple-600 font-medium py-2">
          Contact
        </a>
      </div>

      <!-- Mobile Search -->
      <div class="mt-4">
        <div class="relative">
          <input type="search"
            placeholder="Search products..."
            class="w-full px-4 py-2 pl-10 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" />
          <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
        </div>
      </div>
    </div>
  </div>
</header>

<script>
  // Mobile menu toggle
  document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');

    if (mobileMenuBtn && mobileMenu) {
      mobileMenuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
      });

      // Close mobile menu when clicking outside
      document.addEventListener('click', (event) => {
        if (!mobileMenu.contains(event.target) && !mobileMenuBtn.contains(event.target)) {
          mobileMenu.classList.add('hidden');
        }
      });
    }

    // Search button functionality
    const searchBtn = document.getElementById('searchBtn');
    if (searchBtn) {
      searchBtn.addEventListener('click', () => {
        const searchInput = document.querySelector('input[type="search"]');
        if (searchInput) {
          searchInput.focus();
        }
      });
    }
  });
</script>

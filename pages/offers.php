<?php
session_start();
$page_title = "Special Offers & Deals | Cosmic Beauty";
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

    .offer-card {
      position: relative;
      overflow: hidden;
      border-radius: 1rem;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .offer-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    }

    .ribbon {
      position: absolute;
      top: 10px;
      right: -30px;
      background: linear-gradient(135deg, #ef4444, #dc2626);
      color: white;
      padding: 4px 30px;
      transform: rotate(45deg);
      font-weight: 600;
      font-size: 0.875rem;
    }

    .countdown-timer {
      font-family: monospace;
      font-size: 1.5rem;
      font-weight: bold;
      color: #ef4444;
    }
  </style>
</head>

<body class="bg-slate-50">
  <!-- HEADER -->
  <?php include '../layouts/header.php'; ?>

  <!-- BREADCRUMB -->
  <div class="bg-gradient-to-r from-red-50 to-orange-50 py-4">
    <div class="container mx-auto px-4">
      <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
          <li class="inline-flex items-center">
            <a href="index.php" class="inline-flex items-center text-sm text-slate-600 hover:text-red-600">
              <i class="fas fa-home mr-2"></i>
              Home
            </a>
          </li>
          <li aria-current="page">
            <div class="flex items-center">
              <i class="fas fa-chevron-right text-slate-300 mx-2"></i>
              <span class="ml-1 text-sm font-medium text-red-600 md:ml-2">Special Offers</span>
            </div>
          </li>
        </ol>
      </nav>
    </div>
  </div>

  <!-- OFFERS CONTENT -->
  <div class="container mx-auto px-4 py-12">
    <!-- Page Header -->
    <div class="text-center mb-12">
      <h1 class="text-4xl md:text-5xl font-bold text-slate-800 mb-4">🌟 Cosmic Deals & Offers</h1>
      <p class="text-lg text-slate-600 max-w-2xl mx-auto">
        Don't miss out on our stellar deals! Limited time offers on your favorite cosmic beauty products.
      </p>
    </div>

    <!-- Flash Sale Banner -->
    <div class="bg-gradient-to-r from-red-600 to-orange-500 rounded-2xl p-6 md:p-8 mb-12 text-white">
      <div class="flex flex-col md:flex-row items-center justify-between">
        <div class="mb-6 md:mb-0 md:pr-8">
          <div class="flex items-center mb-4">
            <i class="fas fa-bolt text-2xl mr-3"></i>
            <h2 class="text-2xl md:text-3xl font-bold">FLASH SALE</h2>
          </div>
          <p class="text-red-100 mb-4">Ends in:</p>
          <div id="flash-sale-countdown" class="countdown-timer mb-4">
            24:59:59
          </div>
          <p class="text-lg">Up to 60% off selected items!</p>
        </div>
        <div class="text-center">
          <div class="text-5xl md:text-6xl font-bold mb-2">60%</div>
          <div class="text-lg">OFF</div>
          <a href="#flash-sale-products" class="inline-block mt-4 px-6 py-3 bg-white text-red-600 font-semibold rounded-lg hover:bg-slate-100 transition-colors">
            Shop Now <i class="fas fa-arrow-right ml-2"></i>
          </a>
        </div>
      </div>
    </div>

    <!-- Featured Offers -->
    <div class="mb-12">
      <h2 class="text-3xl font-bold text-slate-800 mb-8">Featured Offers</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php
        $featured_offers = [
          [
            'title' => 'Buy 1 Get 1 Free',
            'description' => 'On all lipsticks',
            'discount' => 'BOGO',
            'color' => 'from-pink-600 to-rose-500',
            'icon' => 'fas fa-gift',
            'expires' => '2024-12-31'
          ],
          [
            'title' => 'Weekend Special',
            'description' => '30% off skincare',
            'discount' => '30% OFF',
            'color' => 'from-purple-600 to-indigo-500',
            'icon' => 'fas fa-calendar-week',
            'expires' => '2024-03-17'
          ],
          [
            'title' => 'New Customer Deal',
            'description' => '15% off first order',
            'discount' => '15% OFF',
            'color' => 'from-blue-600 to-cyan-500',
            'icon' => 'fas fa-user-plus',
            'expires' => 'No expiry'
          ],
        ];

        foreach ($featured_offers as $offer):
        ?>
          <div class="offer-card bg-gradient-to-r <?php echo $offer['color']; ?> p-8 text-white">
            <div class="ribbon">HOT</div>
            <div class="mb-6">
              <i class="<?php echo $offer['icon']; ?> text-3xl mb-4"></i>
              <h3 class="text-2xl font-bold mb-2"><?php echo $offer['title']; ?></h3>
              <p class="text-white/80"><?php echo $offer['description']; ?></p>
            </div>
            <div class="flex justify-between items-center">
              <div class="text-3xl font-bold"><?php echo $offer['discount']; ?></div>
              <div class="text-right">
                <div class="text-sm">Expires:</div>
                <div class="font-semibold"><?php echo $offer['expires']; ?></div>
              </div>
            </div>
            <a href="shop.php?offer=<?php echo urlencode(strtolower(str_replace(' ', '-', $offer['title']))); ?>"
              class="mt-6 inline-block w-full text-center px-4 py-3 bg-white/20 rounded-lg font-semibold hover:bg-white/30 transition-colors">
              Claim Offer
            </a>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Flash Sale Products -->
    <div id="flash-sale-products" class="mb-12">
      <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-bold text-slate-800">Flash Sale Products</h2>
        <div class="flex items-center space-x-2">
          <span class="text-slate-600">Ends in:</span>
          <div id="product-countdown" class="countdown-timer bg-red-100 px-3 py-1 rounded-lg">
            24:59:59
          </div>
        </div>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <?php
        $flash_sale_products = [
          ['name' => 'Galaxy Highlighter', 'original' => '₱1,299', 'sale' => '₱799', 'discount' => '38%', 'image' => 'product-01.jpg'],
          ['name' => 'Star Serum', 'original' => '₱1,899', 'sale' => '₱999', 'discount' => '47%', 'image' => 'product-02.jpg'],
          ['name' => 'Moon Cream', 'original' => '₱1,499', 'sale' => '₱899', 'discount' => '40%', 'image' => 'product-03.jpg'],
          ['name' => 'Comet Lipstick', 'original' => '₱699', 'sale' => '₱349', 'discount' => '50%', 'image' => 'product-04.jpg'],
        ];

        foreach ($flash_sale_products as $product):
        ?>
          <div class="bg-white rounded-xl shadow-sm overflow-hidden offer-card">
            <div class="relative">
              <img src="../images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="w-full h-48 object-cover">
              <div class="absolute top-3 left-3 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                -<?php echo $product['discount']; ?>
              </div>
            </div>
            <div class="p-4">
              <h3 class="text-lg font-semibold text-slate-800 mb-2"><?php echo $product['name']; ?></h3>
              <div class="flex items-center space-x-2 mb-3">
                <span class="text-xl font-bold text-red-600"><?php echo $product['sale']; ?></span>
                <del class="text-slate-400"><?php echo $product['original']; ?></del>
              </div>
              <div class="flex items-center justify-between">
                <div class="w-full bg-slate-200 rounded-full h-2">
                  <div class="bg-red-500 h-2 rounded-full" style="width: <?php echo rand(60, 90); ?>%"></div>
                </div>
                <span class="text-sm text-slate-500 ml-2"><?php echo rand(10, 30); ?> left</span>
              </div>
              <button class="mt-4 w-full py-2 bg-red-500 text-white rounded-lg font-semibold hover:bg-red-600 transition-colors add-to-cart"
                data-product="<?php echo $product['name']; ?>"
                data-price="<?php echo $product['sale']; ?>">
                Add to Cart
              </button>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Bundle Deals -->
    <div class="mb-12">
      <h2 class="text-3xl font-bold text-slate-800 mb-8">Bundle Deals</h2>
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <?php
        $bundles = [
          [
            'title' => 'Complete Skincare Bundle',
            'description' => 'Get all essentials in one package',
            'products' => ['Cleanser', 'Toner', 'Serum', 'Moisturizer', 'Sunscreen'],
            'original' => '₱4,500',
            'bundle' => '₱2,999',
            'savings' => '₱1,501',
            'color' => 'from-purple-500 to-pink-500'
          ],
          [
            'title' => 'Makeup Starter Kit',
            'description' => 'Perfect for beginners',
            'products' => ['Foundation', 'Concealer', 'Mascara', 'Lipstick', 'Blush'],
            'original' => '₱3,800',
            'bundle' => '₱2,299',
            'savings' => '₱1,501',
            'color' => 'from-blue-500 to-cyan-500'
          ],
        ];

        foreach ($bundles as $bundle):
        ?>
          <div class="bg-white rounded-2xl shadow-sm p-8 offer-card">
            <div class="mb-6">
              <h3 class="text-2xl font-bold text-slate-800 mb-2"><?php echo $bundle['title']; ?></h3>
              <p class="text-slate-600 mb-4"><?php echo $bundle['description']; ?></p>
              <div class="flex flex-wrap gap-2 mb-6">
                <?php foreach ($bundle['products'] as $product): ?>
                  <span class="px-3 py-1 bg-slate-100 text-slate-700 rounded-full text-sm">
                    <?php echo $product; ?>
                  </span>
                <?php endforeach; ?>
              </div>
            </div>
            <div class="flex justify-between items-center">
              <div>
                <div class="text-3xl font-bold text-slate-800"><?php echo $bundle['bundle']; ?></div>
                <div class="flex items-center space-x-2">
                  <del class="text-slate-400"><?php echo $bundle['original']; ?></del>
                  <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-sm font-semibold">
                    Save <?php echo $bundle['savings']; ?>
                  </span>
                </div>
              </div>
              <button class="px-6 py-3 bg-gradient-to-r <?php echo $bundle['color']; ?> text-white font-semibold rounded-lg hover:shadow-lg transition-shadow add-to-cart"
                data-product="<?php echo $bundle['title']; ?>"
                data-price="<?php echo $bundle['bundle']; ?>">
                Add Bundle to Cart
              </button>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Newsletter Offer -->
    <div class="bg-gradient-to-r from-purple-600 to-pink-500 rounded-2xl p-8 md:p-12 text-white text-center">
      <i class="fas fa-envelope-open-text text-5xl mb-6"></i>
      <h2 class="text-3xl font-bold mb-4">Get Exclusive Offers!</h2>
      <p class="text-purple-100 mb-8 max-w-2xl mx-auto">
        Subscribe to our cosmic newsletter and be the first to know about new arrivals,
        exclusive discounts, and members-only deals.
      </p>
      <form id="newsletter-form" class="max-w-md mx-auto">
        <div class="flex flex-col sm:flex-row gap-4">
          <input type="email"
            placeholder="Enter your email"
            required
            class="flex-1 px-4 py-3 rounded-lg text-slate-800 focus:outline-none focus:ring-2 focus:ring-white">
          <button type="submit"
            class="px-6 py-3 bg-white text-purple-600 font-semibold rounded-lg hover:bg-slate-100 transition-colors">
            Subscribe Now
          </button>
        </div>
        <p class="text-sm text-purple-200 mt-4">By subscribing, you agree to our Privacy Policy</p>
      </form>
    </div>
  </div>

  <!-- FOOTER -->
  <?php include '../layouts/footer.php'; ?>

  <script>
    // Countdown timer
    function updateCountdown() {
      const now = new Date();
      const endOfDay = new Date();
      endOfDay.setHours(23, 59, 59, 999);

      const diff = endOfDay - now;

      const hours = Math.floor(diff / (1000 * 60 * 60));
      const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
      const seconds = Math.floor((diff % (1000 * 60)) / 1000);

      const format = (num) => num.toString().padStart(2, '0');

      document.getElementById('flash-sale-countdown').textContent =
        `${format(hours)}:${format(minutes)}:${format(seconds)}`;
      document.getElementById('product-countdown').textContent =
        `${format(hours)}:${format(minutes)}:${format(seconds)}`;
    }

    // Update countdown every second
    setInterval(updateCountdown, 1000);
    updateCountdown(); // Initial call

    // Add to cart functionality
    document.querySelectorAll('.add-to-cart').forEach(button => {
      button.addEventListener('click', function() {
        const product = this.getAttribute('data-product');
        const price = this.getAttribute('data-price');

        // Show notification
        const notification = document.createElement('div');
        notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transform translate-x-full opacity-0 transition-all duration-300 z-50';
        notification.textContent = `Added ${product} to cart for ${price}!`;
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
    });

    // Newsletter form
    document.getElementById('newsletter-form').addEventListener('submit', function(e) {
      e.preventDefault();

      const notification = document.createElement('div');
      notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transform translate-x-full opacity-0 transition-all duration-300 z-50';
      notification.textContent = 'Thank you for subscribing! Check your email for a welcome offer.';
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

      this.reset();
    });
  </script>
</body>

</html>

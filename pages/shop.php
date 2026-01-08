<?php
session_start();
$page_title = "Shop All Products | Cosmic Beauty";
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

    .glass-effect {
      backdrop-filter: blur(10px);
      background: rgba(255, 255, 255, 0.95);
    }

    .filter-hover:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
    }

    .price-tag {
      position: absolute;
      top: 10px;
      right: 10px;
      background: linear-gradient(135deg, #8b5cf6, #ec4899);
      color: white;
      padding: 4px 12px;
      border-radius: 20px;
      font-size: 0.875rem;
      font-weight: 600;
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
              <span class="ml-1 text-sm font-medium text-purple-600 md:ml-2">Shop All Products</span>
            </div>
          </li>
        </ol>
      </nav>
    </div>
  </div>

  <!-- SHOP CONTENT -->
  <div class="container mx-auto px-4 py-8">
    <div class="mb-8">
      <h1 class="text-4xl font-bold text-slate-800 mb-4">Shop Our Cosmic Collection</h1>
      <p class="text-slate-600">Discover our complete range of skincare, makeup, and beauty products.</p>
    </div>

    <!-- Filters & Sorting -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
      <div class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-4 md:space-y-0">
        <div class="flex items-center space-x-4">
          <button class="px-4 py-2 bg-purple-100 text-purple-600 rounded-lg font-medium hover:bg-purple-200 transition-colors">
            <i class="fas fa-filter mr-2"></i> Filters
          </button>
          <div class="hidden md:flex items-center space-x-2">
            <span class="text-slate-600">Category:</span>
            <select class="border border-slate-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
              <option>All Products</option>
              <option>Skincare</option>
              <option>Makeup</option>
              <option>Fragrance</option>
              <option>Bath & Body</option>
            </select>
          </div>
        </div>

        <div class="flex items-center space-x-4">
          <span class="text-slate-600">Sort by:</span>
          <select class="border border-slate-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
            <option>Featured</option>
            <option>Price: Low to High</option>
            <option>Price: High to Low</option>
            <option>Best Selling</option>
            <option>Newest</option>
          </select>
        </div>
      </div>

      <!-- Active Filters -->
      <div class="mt-4 flex flex-wrap gap-2">
        <span class="px-3 py-1 bg-slate-100 text-slate-700 rounded-full text-sm flex items-center">
          Skincare <button class="ml-2 text-slate-400 hover:text-slate-600"><i class="fas fa-times"></i></button>
        </span>
        <span class="px-3 py-1 bg-slate-100 text-slate-700 rounded-full text-sm flex items-center">
          Under ₱1000 <button class="ml-2 text-slate-400 hover:text-slate-600"><i class="fas fa-times"></i></button>
        </span>
        <button class="text-sm text-purple-600 hover:text-purple-800 ml-2">Clear all</button>
      </div>
    </div>

    <!-- Product Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-12">
      <?php
      // Sample products data
      $products = [
        ['name' => 'Cosmic Glow Serum', 'price' => '₱1,299.00', 'category' => 'Skincare', 'image' => 'product-01.jpg', 'sale' => true],
        ['name' => 'Starlight Foundation', 'price' => '₱899.00', 'category' => 'Makeup', 'image' => 'product-02.jpg', 'sale' => false],
        ['name' => 'Nebula Eye Palette', 'price' => '₱1,199.00', 'category' => 'Makeup', 'image' => 'product-03.jpg', 'sale' => true],
        ['name' => 'Galaxy Lipstick Set', 'price' => '₱799.00', 'category' => 'Makeup', 'image' => 'product-04.jpg', 'sale' => false],
        ['name' => 'Moonbeam Moisturizer', 'price' => '₱1,499.00', 'category' => 'Skincare', 'image' => 'product-05.jpg', 'sale' => false],
        ['name' => 'Solar Flare Highlighter', 'price' => '₱699.00', 'category' => 'Makeup', 'image' => 'product-06.jpg', 'sale' => true],
        ['name' => 'Asteroid Cleanser', 'price' => '₱599.00', 'category' => 'Skincare', 'image' => 'product-07.jpg', 'sale' => false],
        ['name' => 'Comet Perfume', 'price' => '₱1,899.00', 'category' => 'Fragrance', 'image' => 'product-08.jpg', 'sale' => true],
      ];

      foreach ($products as $product):
      ?>
        <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-lg transition-shadow duration-300 filter-hover">
          <div class="relative">
            <img src="../images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="w-full h-64 object-cover">
            <?php if ($product['sale']): ?>
              <div class="price-tag">SALE</div>
            <?php endif; ?>
            <div class="absolute top-3 right-3 flex flex-col space-y-2 opacity-0 hover:opacity-100 transition-opacity duration-300">
              <button class="add-to-cart w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md hover:bg-purple-50" data-product="<?php echo $product['name']; ?>" data-price="<?php echo $product['price']; ?>">
                <i class="fas fa-shopping-bag text-slate-600"></i>
              </button>
              <button class="add-to-wishlist w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md hover:bg-purple-50" data-product="<?php echo $product['name']; ?>">
                <i class="fas fa-star text-slate-600"></i>
              </button>
            </div>
          </div>
          <div class="p-4">
            <span class="text-xs text-purple-600 font-semibold"><?php echo $product['category']; ?></span>
            <h3 class="text-lg font-semibold text-slate-800 mt-1 mb-2"><?php echo $product['name']; ?></h3>
            <div class="flex justify-between items-center">
              <span class="text-xl font-bold text-slate-800"><?php echo $product['price']; ?></span>
              <div class="flex items-center">
                <i class="fas fa-star text-yellow-400 text-sm"></i>
                <span class="text-sm text-slate-500 ml-1">4.8</span>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Pagination -->
    <div class="flex justify-center">
      <nav class="flex items-center space-x-2">
        <button class="w-10 h-10 flex items-center justify-center rounded-lg border border-slate-300 text-slate-600 hover:bg-slate-50">
          <i class="fas fa-chevron-left"></i>
        </button>
        <button class="w-10 h-10 flex items-center justify-center rounded-lg bg-purple-600 text-white">1</button>
        <button class="w-10 h-10 flex items-center justify-center rounded-lg border border-slate-300 text-slate-600 hover:bg-slate-50">2</button>
        <button class="w-10 h-10 flex items-center justify-center rounded-lg border border-slate-300 text-slate-600 hover:bg-slate-50">3</button>
        <span class="text-slate-400">...</span>
        <button class="w-10 h-10 flex items-center justify-center rounded-lg border border-slate-300 text-slate-600 hover:bg-slate-50">10</button>
        <button class="w-10 h-10 flex items-center justify-center rounded-lg border border-slate-300 text-slate-600 hover:bg-slate-50">
          <i class="fas fa-chevron-right"></i>
        </button>
      </nav>
    </div>
  </div>

  <!-- FOOTER -->
  <?php include '../layouts/footer.php'; ?>

  <script>
    // Shopping cart functionality
    document.addEventListener('DOMContentLoaded', function() {
      // Add to cart buttons
      document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function() {
          const product = this.getAttribute('data-product');
          const price = this.getAttribute('data-price');

          // Show notification
          const notification = document.createElement('div');
          notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transform translate-x-full opacity-0 transition-all duration-300 z-50';
          notification.textContent = `Added ${product} to cart!`;
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

      // Add to wishlist buttons
      document.querySelectorAll('.add-to-wishlist').forEach(button => {
        button.addEventListener('click', function() {
          const product = this.getAttribute('data-product');

          const notification = document.createElement('div');
          notification.className = 'fixed top-4 right-4 bg-pink-500 text-white px-6 py-3 rounded-lg shadow-lg transform translate-x-full opacity-0 transition-all duration-300 z-50';
          notification.textContent = `Added ${product} to wishlist!`;
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
    });
  </script>
</body>

</html>

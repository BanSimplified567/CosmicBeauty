<?php
$page_title = "Collections | Cosmic Beauty";
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

    .collection-card {
      position: relative;
      overflow: hidden;
      border-radius: 1rem;
      height: 400px;
    }

    .collection-card img {
      transition: transform 0.5s ease;
    }

    .collection-card:hover img {
      transform: scale(1.05);
    }

    .collection-overlay {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
      padding: 2rem;
      color: white;
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
              <span class="ml-1 text-sm font-medium text-purple-600 md:ml-2">Collections</span>
            </div>
          </li>
        </ol>
      </nav>
    </div>
  </div>

  <!-- COLLECTIONS CONTENT -->
  <div class="container mx-auto px-4 py-12">
    <!-- Page Header -->
    <div class="text-center mb-12">
      <h1 class="text-4xl md:text-5xl font-bold text-slate-800 mb-4">Our Cosmic Collections</h1>
      <p class="text-lg text-slate-600 max-w-2xl mx-auto">
        Explore our curated collections designed for every skin type and beauty need.
        Each collection tells a unique cosmic story.
      </p>
    </div>

    <!-- Main Collections -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
      <?php
      $collections = [
        [
          'title' => 'Summer Glow Collection',
          'description' => 'Radiant skin for sunny days',
          'image' => 'collection-1.jpg',
          'products' => '12 products',
          'price' => 'From ₱799'
        ],
        [
          'title' => 'Winter Hydration',
          'description' => 'Nourish dry skin in cold weather',
          'image' => 'collection-2.jpg',
          'products' => '8 products',
          'price' => 'From ₱899'
        ],
        [
          'title' => 'Spring Renewal',
          'description' => 'Fresh start for your skin',
          'image' => 'collection-3.jpg',
          'products' => '10 products',
          'price' => 'From ₱699'
        ],
        [
          'title' => 'Autumn Radiance',
          'description' => 'Warm tones for fall',
          'image' => 'collection-3.jpg',
          'products' => '14 products',
          'price' => 'From ₱999'
        ],
        [
          'title' => 'Night Sky Routine',
          'description' => 'Evening skincare essentials',
          'image' => 'collection-2.jpg',
          'products' => '6 products',
          'price' => 'From ₱1,299'
        ],
        [
          'title' => 'Morning Boost',
          'description' => 'Wake up your skin',
          'image' => 'collection-1.jpg',
          'products' => '7 products',
          'price' => 'From ₱849'
        ]
      ];

      foreach ($collections as $collection):
      ?>
        <div class="collection-card group cursor-pointer">
          <img src="../images/<?php echo $collection['image']; ?>"
            alt="<?php echo $collection['title']; ?>"
            class="w-full h-full object-cover">
          <div class="collection-overlay">
            <h3 class="text-2xl font-bold mb-2"><?php echo $collection['title']; ?></h3>
            <p class="text-slate-200 mb-3"><?php echo $collection['description']; ?></p>
            <div class="flex justify-between items-center">
              <div>
                <span class="text-sm text-slate-300"><?php echo $collection['products']; ?></span>
                <div class="text-lg font-semibold"><?php echo $collection['price']; ?></div>
              </div>
              <a href="shop.php?collection=<?php echo urlencode(strtolower(str_replace(' ', '-', $collection['title']))); ?>"
                class="px-4 py-2 bg-white text-purple-600 rounded-lg font-semibold hover:bg-slate-100 transition-colors">
                Shop Now
              </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Featured Collections -->
    <div class="mb-12">
      <h2 class="text-3xl font-bold text-slate-800 mb-8 text-center">Featured Collections</h2>
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Featured Collection 1 -->
        <div class="bg-gradient-to-r from-purple-600 to-pink-500 rounded-2xl p-8 text-white">
          <div class="flex flex-col md:flex-row items-center">
            <div class="md:w-2/3 mb-6 md:mb-0 md:pr-8">
              <span class="inline-block px-3 py-1 bg-white/20 rounded-full text-sm mb-4">LIMITED EDITION</span>
              <h3 class="text-2xl font-bold mb-3">Galactic Glow Collection</h3>
              <p class="text-purple-100 mb-4">
                Experience the magic of the cosmos with our most radiant collection yet.
                Limited edition products that will make you shine like the stars.
              </p>
              <div class="flex items-center space-x-4 mb-4">
                <div>
                  <div class="text-2xl font-bold">15</div>
                  <div class="text-sm text-purple-200">Products</div>
                </div>
                <div>
                  <div class="text-2xl font-bold">₱12,999</div>
                  <div class="text-sm text-purple-200">Value</div>
                </div>
                <div>
                  <div class="text-2xl font-bold">₱8,999</div>
                  <div class="text-sm text-purple-200">Bundle Price</div>
                </div>
              </div>
              <a href="#" class="inline-block px-6 py-3 bg-white text-purple-600 font-semibold rounded-lg hover:bg-slate-100 transition-colors">
                Get the Bundle <i class="fas fa-arrow-right ml-2"></i>
              </a>
            </div>
            <div class="md:w-1/3 flex justify-center">
              <div class="w-48 h-48 rounded-full bg-white/20 flex items-center justify-center">
                <i class="fas fa-gem text-6xl"></i>
              </div>
            </div>
          </div>
        </div>

        <!-- Featured Collection 2 -->
        <div class="bg-gradient-to-r from-blue-600 to-cyan-500 rounded-2xl p-8 text-white">
          <div class="flex flex-col md:flex-row items-center">
            <div class="md:w-2/3 mb-6 md:mb-0 md:pr-8">
              <span class="inline-block px-3 py-1 bg-white/20 rounded-full text-sm mb-4">BEST SELLER</span>
              <h3 class="text-2xl font-bold mb-3">Essential Skincare Set</h3>
              <p class="text-blue-100 mb-4">
                Everything you need for a complete skincare routine. Perfect for beginners or anyone wanting to simplify their regimen.
              </p>
              <div class="flex items-center space-x-4 mb-4">
                <div>
                  <div class="text-2xl font-bold">5</div>
                  <div class="text-sm text-blue-200">Essential Products</div>
                </div>
                <div>
                  <div class="text-2xl font-bold">₱4,500</div>
                  <div class="text-sm text-blue-200">Value</div>
                </div>
                <div>
                  <div class="text-2xl font-bold">₱3,299</div>
                  <div class="text-sm text-blue-200">Set Price</div>
                </div>
              </div>
              <a href="#" class="inline-block px-6 py-3 bg-white text-blue-600 font-semibold rounded-lg hover:bg-slate-100 transition-colors">
                Shop the Set <i class="fas fa-arrow-right ml-2"></i>
              </a>
            </div>
            <div class="md:w-1/3 flex justify-center">
              <div class="w-48 h-48 rounded-full bg-white/20 flex items-center justify-center">
                <i class="fas fa-star text-6xl"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Collection Categories -->
    <div class="bg-white rounded-2xl shadow-sm p-8 mb-12">
      <h2 class="text-3xl font-bold text-slate-800 mb-8 text-center">Browse by Category</h2>
      <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        <?php
        $categories = [
          ['name' => 'Skincare', 'icon' => 'fas fa-spa', 'color' => 'text-purple-600', 'count' => '45 products'],
          ['name' => 'Makeup', 'icon' => 'fas fa-palette', 'color' => 'text-pink-600', 'count' => '32 products'],
          ['name' => 'Fragrance', 'icon' => 'fas fa-wind', 'color' => 'text-blue-600', 'count' => '18 products'],
          ['name' => 'Bath & Body', 'icon' => 'fas fa-bath', 'color' => 'text-emerald-600', 'count' => '27 products'],
        ];

        foreach ($categories as $category):
        ?>
          <a href="shop.php?category=<?php echo strtolower($category['name']); ?>"
            class="group p-6 bg-slate-50 rounded-xl hover:bg-purple-50 transition-colors duration-300 text-center">
            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-white flex items-center justify-center shadow-sm group-hover:shadow transition-shadow">
              <i class="<?php echo $category['icon']; ?> <?php echo $category['color']; ?> text-2xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-slate-800 mb-2"><?php echo $category['name']; ?></h3>
            <p class="text-sm text-slate-500"><?php echo $category['count']; ?></p>
          </a>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- CTA Section -->
    <div class="text-center">
      <h2 class="text-3xl font-bold text-slate-800 mb-4">Can't Find What You're Looking For?</h2>
      <p class="text-slate-600 mb-8 max-w-2xl mx-auto">
        Our beauty experts can help you create a personalized collection tailored to your unique needs.
      </p>
      <a href="contact.php" class="inline-block px-8 py-3 bg-gradient-to-r from-purple-600 to-pink-500 text-white font-semibold rounded-full hover:shadow-lg transition-shadow">
        <i class="fas fa-comments mr-2"></i> Get Personalized Recommendations
      </a>
    </div>
  </div>

  <!-- FOOTER -->
  <?php include '../layouts/footer.php'; ?>
</body>

</html>

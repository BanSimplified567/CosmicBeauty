<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cosmic Beauty</title>
  <link rel="shortcut icon" href="favicon.svg" type="image/svg+xml" />

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Fonts & Icons -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  <style>
    * {
      font-family: 'Urbanist', sans-serif;
    }

    .cosmic-gradient {
      background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #312e81 100%);
    }

    .gradient-text {
      background: linear-gradient(90deg, #8b5cf6, #ec4899, #3b82f6);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .shine-hover:hover {
      position: relative;
      overflow: hidden;
    }

    .shine-hover:hover::after {
      content: '';
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: linear-gradient(to right,
          rgba(255, 255, 255, 0) 0%,
          rgba(255, 255, 255, 0.3) 50%,
          rgba(255, 255, 255, 0) 100%);
      transform: rotate(30deg);
      animation: shine 1.5s ease-in-out infinite;
    }

    @keyframes shine {
      0% {
        transform: translateX(-100%) rotate(30deg);
      }

      100% {
        transform: translateX(100%) rotate(30deg);
      }
    }

    .carousel-container {
      position: relative;
      overflow: hidden;
      height: 500px;
      border-radius: 1rem;
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    @media (max-width: 768px) {
      .carousel-container {
        height: 400px;
      }
    }

    .carousel-slide {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      opacity: 0;
      transition: opacity 1s ease-in-out;
    }

    .carousel-slide.active {
      opacity: 1;
    }

    .carousel-slide img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .carousel-content {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      display: flex;
      align-items: center;
      background: linear-gradient(to right, rgba(0, 0, 0, 0.7) 0%, rgba(0, 0, 0, 0.3) 100%);
      padding: 0 4rem;
    }

    @media (max-width: 768px) {
      .carousel-content {
        padding: 0 2rem;
      }
    }

    .carousel-indicators {
      position: absolute;
      bottom: 2rem;
      left: 50%;
      transform: translateX(-50%);
      display: flex;
      gap: 0.75rem;
      z-index: 20;
    }

    .carousel-indicator {
      width: 12px;
      height: 12px;
      border-radius: 50%;
      background-color: rgba(255, 255, 255, 0.5);
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .carousel-indicator.active {
      background-color: white;
      transform: scale(1.2);
    }

    .carousel-nav {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      background-color: rgba(255, 255, 255, 0.2);
      width: 50px;
      height: 50px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all 0.3s ease;
      z-index: 20;
    }

    .carousel-nav:hover {
      background-color: rgba(255, 255, 255, 0.3);
    }

    .carousel-nav.prev {
      left: 2rem;
    }

    .carousel-nav.next {
      right: 2rem;
    }

    .carousel-nav i {
      color: white;
      font-size: 1.25rem;
    }

    @media (max-width: 768px) {
      .carousel-nav {
        width: 40px;
        height: 40px;
      }

      .carousel-nav.prev {
        left: 1rem;
      }

      .carousel-nav.next {
        right: 1rem;
      }
    }

    .fade-in {
      animation: fadeIn 0.8s ease-out;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .glass-effect {
      backdrop-filter: blur(10px);
      background: rgba(255, 255, 255, 0.95);
    }
  </style>
</head>

<body class="bg-slate-50">
  <main>
    <?php include './layouts/header.php'; ?>

    <!-- HERO SECTION WITH CAROUSEL -->
    <section id="home" class="py-8 md:py-12">
      <div class="container mx-auto px-4">
        <div class="carousel-container">
          <!-- Slide 1 -->
          <div class="carousel-slide active" data-slide="1">
            <img src="images/hero-banner-1.jpg"
              alt="Reveal The Beauty of Skin"
              class="w-full h-full object-cover" />
            <div class="carousel-content">
              <div class="max-w-2xl fade-in">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4 leading-tight">
                  Reveal The <br />
                  <span class="gradient-text">Beauty of Skin</span>
                </h1>
                <p class="text-lg text-gray-200 mb-6">
                  Made using clean, non-toxic ingredients, our products are designed for everyone.
                </p>
                <p class="text-2xl font-bold text-white mb-6">Starting at ₱977.99</p>
                <a href="#shop" class="inline-block px-8 py-3 bg-gradient-to-r from-purple-600 to-pink-500 text-white font-semibold rounded-full hover:shadow-lg transform hover:-translate-y-1 transition-all duration-300 hover:scale-105">
                  Shop Now <i class="fas fa-arrow-right ml-2"></i>
                </a>
              </div>
            </div>
          </div>

          <!-- Slide 2 -->
          <div class="carousel-slide" data-slide="2">
            <img src="images/hero-banner-2.jpg"
              alt="Natural Glow Collection"
              class="w-full h-full object-cover" />
            <div class="carousel-content">
              <div class="max-w-2xl fade-in">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4 leading-tight">
                  Discover Your <br />
                  <span class="gradient-text">Natural Glow</span>
                </h1>
                <p class="text-lg text-gray-200 mb-6">
                  Experience the cosmic transformation with our premium skincare collection.
                </p>
                <p class="text-2xl font-bold text-white mb-6">Starting at ₱779.99</p>
                <a href="#shop" class="inline-block px-8 py-3 bg-gradient-to-r from-purple-600 to-pink-500 text-white font-semibold rounded-full hover:shadow-lg transform hover:-translate-y-1 transition-all duration-300 hover:scale-105">
                  Shop Now <i class="fas fa-arrow-right ml-2"></i>
                </a>
              </div>
            </div>
          </div>

          <!-- Slide 3 -->
          <div class="carousel-slide" data-slide="3">
            <img src="images/hero-banner-3.jpg"
              alt="Cosmic Beauty Collection"
              class="w-full h-full object-cover" />
            <div class="carousel-content">
              <div class="max-w-2xl fade-in">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4 leading-tight">
                  Embrace Your <br />
                  <span class="gradient-text">Cosmic Beauty</span>
                </h1>
                <p class="text-lg text-gray-200 mb-6">
                  Unleash your inner star with our galaxy-inspired beauty products.
                </p>
                <p class="text-2xl font-bold text-white mb-6">Starting at ₱917.99</p>
                <a href="#shop" class="inline-block px-8 py-3 bg-gradient-to-r from-purple-600 to-pink-500 text-white font-semibold rounded-full hover:shadow-lg transform hover:-translate-y-1 transition-all duration-300 hover:scale-105">
                  Shop Now <i class="fas fa-arrow-right ml-2"></i>
                </a>
              </div>
            </div>
          </div>

          <!-- Slide 4 -->
          <div class="carousel-slide" data-slide="4">
            <img src="https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80"
              alt="Limited Edition Collection"
              class="w-full h-full object-cover" />
            <div class="carousel-content">
              <div class="max-w-2xl fade-in">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4 leading-tight">
                  Limited Edition <br />
                  <span class="gradient-text">Cosmic Collection</span>
                </h1>
                <p class="text-lg text-gray-200 mb-6">
                  Exclusive products inspired by the galaxy. Limited stock available.
                </p>
                <p class="text-2xl font-bold text-white mb-6">Starting at ₱699.99</p>
                <a href="#shop" class="inline-block px-8 py-3 bg-gradient-to-r from-purple-600 to-pink-500 text-white font-semibold rounded-full hover:shadow-lg transform hover:-translate-y-1 transition-all duration-300 hover:scale-105">
                  Shop Now <i class="fas fa-arrow-right ml-2"></i>
                </a>
              </div>
            </div>
          </div>

          <!-- Navigation Arrows -->
          <button class="carousel-nav prev" id="prevSlide">
            <i class="fas fa-chevron-left"></i>
          </button>
          <button class="carousel-nav next" id="nextSlide">
            <i class="fas fa-chevron-right"></i>
          </button>

          <!-- Indicators -->
          <div class="carousel-indicators" id="carouselIndicators">
            <div class="carousel-indicator active" data-slide="1"></div>
            <div class="carousel-indicator" data-slide="2"></div>
            <div class="carousel-indicator" data-slide="3"></div>
            <div class="carousel-indicator" data-slide="4"></div>
          </div>
        </div>
      </div>
    </section>

    <!-- COLLECTION SECTION -->
    <section id="collection" class="py-12 bg-slate-50">
      <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <!-- Collection 1 -->
          <div class="relative rounded-2xl overflow-hidden group shine-hover">
            <div class="relative h-64 md:h-80">
              <img src="images/collection-1.jpg"
                alt="Summer Collection"
                class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
              <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
              <div class="absolute bottom-0 left-0 p-6 text-white">
                <h3 class="text-2xl font-bold mb-2">Summer Collection</h3>
                <p class="mb-4">Starting at ₱917.99</p>
                <a href="#shop" class="inline-flex items-center text-white font-medium group">
                  <span class="mr-2">Shop Now</span>
                  <i class="fas fa-arrow-right transform group-hover:translate-x-2 transition-transform duration-300"></i>
                </a>
              </div>
            </div>
          </div>

          <!-- Collection 2 -->
          <div class="relative rounded-2xl overflow-hidden group shine-hover">
            <div class="relative h-64 md:h-80">
              <img src="images/collection-2.jpg"
                alt="What's New"
                class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
              <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
              <div class="absolute bottom-0 left-0 p-6 text-white">
                <h3 class="text-2xl font-bold mb-2">What's New?</h3>
                <p class="mb-4">Get the glow</p>
                <a href="#shop" class="inline-flex items-center text-white font-medium group">
                  <span class="mr-2">Discover Now</span>
                  <i class="fas fa-arrow-right transform group-hover:translate-x-2 transition-transform duration-300"></i>
                </a>
              </div>
            </div>
          </div>

          <!-- Collection 3 -->
          <div class="relative rounded-2xl overflow-hidden group shine-hover">
            <div class="relative h-64 md:h-80">
              <img src="images/collection-3.jpg"
                alt="Buy 1 Get 1"
                class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
              <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
              <div class="absolute bottom-0 left-0 p-6 text-white">
                <h3 class="text-2xl font-bold mb-2">Buy 1 Get 1</h3>
                <p class="mb-4">Starting at ₱699.99</p>
                <a href="#shop" class="inline-flex items-center text-white font-medium group">
                  <span class="mr-2">Discover Now</span>
                  <i class="fas fa-arrow-right transform group-hover:translate-x-2 transition-transform duration-300"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- SHOP SECTION - Bestsellers -->
    <section id="shop" class="py-12">
      <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
          <h2 class="text-3xl font-bold text-slate-800 mb-4 md:mb-0">Our Bestsellers</h2>
          <a href="#shop" class="inline-flex items-center text-purple-600 hover:text-purple-800 font-medium group">
            <span class="mr-2">Shop All Products</span>
            <i class="fas fa-arrow-right transform group-hover:translate-x-2 transition-transform duration-300"></i>
          </a>
        </div>

        <!-- Product Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
          <!-- Product 1 -->
          <div class="bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-xl transition-shadow duration-300">
            <div class="relative overflow-hidden">
              <img src="images/product-01.jpg"
                alt="Facial cleanser"
                class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500" />
              <span class="absolute top-3 left-3 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                -20%
              </span>
              <div class="absolute top-3 right-3 flex flex-col space-y-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                <button class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md hover:bg-purple-50 transition-colors duration-300 add-to-cart" data-product="Facial cleanser" data-price="829.00">
                  <i class="fas fa-shopping-bag text-slate-600"></i>
                </button>
                <button class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md hover:bg-purple-50 transition-colors duration-300 add-to-wishlist" data-product="Facial cleanser">
                  <i class="fas fa-star text-slate-600"></i>
                </button>
                <button class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md hover:bg-purple-50 transition-colors duration-300 compare-btn" data-product="Facial cleanser">
                  <i class="fas fa-retweet text-slate-600"></i>
                </button>
              </div>
            </div>
            <div class="p-4">
              <div class="flex items-center space-x-2 mb-2">
                <del class="text-slate-400">₱839.00</del>
                <span class="text-xl font-bold text-slate-800">₱829.00</span>
              </div>
              <h3 class="text-lg font-semibold text-slate-800 mb-2">
                <a href="#" class="hover:text-purple-600 transition-colors duration-300">
                  Facial cleanser
                </a>
              </h3>
              <div class="flex items-center space-x-1 mb-2">
                <i class="fas fa-star text-yellow-400"></i>
                <i class="fas fa-star text-yellow-400"></i>
                <i class="fas fa-star text-yellow-400"></i>
                <i class="fas fa-star text-yellow-400"></i>
                <i class="fas fa-star text-yellow-400"></i>
                <span class="text-sm text-slate-500 ml-2">5170 reviews</span>
              </div>
            </div>
          </div>

          <!-- Product 2 -->
          <div class="bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-xl transition-shadow duration-300">
            <div class="relative overflow-hidden">
              <img src="images/product-02.jpg"
                alt="Bio-shroom Rejuvenating Serum"
                class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500" />
              <div class="absolute top-3 right-3 flex flex-col space-y-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                <button class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md hover:bg-purple-50 transition-colors duration-300 add-to-cart" data-product="Bio-shroom Rejuvenating Serum" data-price="929.00">
                  <i class="fas fa-shopping-bag text-slate-600"></i>
                </button>
                <button class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md hover:bg-purple-50 transition-colors duration-300 add-to-wishlist" data-product="Bio-shroom Rejuvenating Serum">
                  <i class="fas fa-star text-slate-600"></i>
                </button>
                <button class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md hover:bg-purple-50 transition-colors duration-300 compare-btn" data-product="Bio-shroom Rejuvenating Serum">
                  <i class="fas fa-retweet text-slate-600"></i>
                </button>
              </div>
            </div>
            <div class="p-4">
              <div class="mb-2">
                <span class="text-xl font-bold text-slate-800">₱929.00</span>
              </div>
              <h3 class="text-lg font-semibold text-slate-800 mb-2">
                <a href="#" class="hover:text-purple-600 transition-colors duration-300">
                  Bio-shroom Rejuvenating Serum
                </a>
              </h3>
              <div class="flex items-center space-x-1 mb-2">
                <i class="fas fa-star text-yellow-400"></i>
                <i class="fas fa-star text-yellow-400"></i>
                <i class="fas fa-star text-yellow-400"></i>
                <i class="fas fa-star text-yellow-400"></i>
                <i class="fas fa-star text-yellow-400"></i>
                <span class="text-sm text-slate-500 ml-2">5170 reviews</span>
              </div>
            </div>
          </div>

          <!-- Product 3 -->
          <div class="bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-xl transition-shadow duration-300">
            <div class="relative overflow-hidden">
              <img src="images/product-03.jpg"
                alt="Coffee Bean Caffeine Eye Cream"
                class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500" />
              <div class="absolute top-3 right-3 flex flex-col space-y-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                <button class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md hover:bg-purple-50 transition-colors duration-300 add-to-cart" data-product="Coffee Bean Caffeine Eye Cream" data-price="829.00">
                  <i class="fas fa-shopping-bag text-slate-600"></i>
                </button>
                <button class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md hover:bg-purple-50 transition-colors duration-300 add-to-wishlist" data-product="Coffee Bean Caffeine Eye Cream">
                  <i class="fas fa-star text-slate-600"></i>
                </button>
                <button class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md hover:bg-purple-50 transition-colors duration-300 compare-btn" data-product="Coffee Bean Caffeine Eye Cream">
                  <i class="fas fa-retweet text-slate-600"></i>
                </button>
              </div>
            </div>
            <div class="p-4">
              <div class="mb-2">
                <span class="text-xl font-bold text-slate-800">₱829.00</span>
              </div>
              <h3 class="text-lg font-semibold text-slate-800 mb-2">
                <a href="#" class="hover:text-purple-600 transition-colors duration-300">
                  Coffee Bean Caffeine Eye Cream
                </a>
              </h3>
              <div class="flex items-center space-x-1 mb-2">
                <i class="fas fa-star text-yellow-400"></i>
                <i class="fas fa-star text-yellow-400"></i>
                <i class="fas fa-star text-yellow-400"></i>
                <i class="fas fa-star text-yellow-400"></i>
                <i class="fas fa-star text-yellow-400"></i>
                <span class="text-sm text-slate-500 ml-2">5170 reviews</span>
              </div>
            </div>
          </div>

          <!-- Product 4 -->
          <div class="bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-xl transition-shadow duration-300">
            <div class="relative overflow-hidden">
              <img src="images/product-04.jpg"
                alt="Hydrating Facial Moisturizer"
                class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500" />
              <div class="absolute top-3 right-3 flex flex-col space-y-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                <button class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md hover:bg-purple-50 transition-colors duration-300 add-to-cart" data-product="Hydrating Facial Moisturizer" data-price="749.00">
                  <i class="fas fa-shopping-bag text-slate-600"></i>
                </button>
                <button class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md hover:bg-purple-50 transition-colors duration-300 add-to-wishlist" data-product="Hydrating Facial Moisturizer">
                  <i class="fas fa-star text-slate-600"></i>
                </button>
                <button class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md hover:bg-purple-50 transition-colors duration-300 compare-btn" data-product="Hydrating Facial Moisturizer">
                  <i class="fas fa-retweet text-slate-600"></i>
                </button>
              </div>
            </div>
            <div class="p-4">
              <div class="mb-2">
                <span class="text-xl font-bold text-slate-800">₱749.00</span>
              </div>
              <h3 class="text-lg font-semibold text-slate-800 mb-2">
                <a href="#" class="hover:text-purple-600 transition-colors duration-300">
                  Hydrating Facial Moisturizer
                </a>
              </h3>
              <div class="flex items-center space-x-1 mb-2">
                <i class="fas fa-star text-yellow-400"></i>
                <i class="fas fa-star text-yellow-400"></i>
                <i class="fas fa-star text-yellow-400"></i>
                <i class="fas fa-star text-yellow-400"></i>
                <i class="fas fa-star text-yellow-400"></i>
                <span class="text-sm text-slate-500 ml-2">4890 reviews</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Under ₱1000 Section -->
        <div class="mt-16">
          <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
            <h2 class="text-3xl font-bold text-slate-800 mb-4 md:mb-0">Under ₱1000</h2>
            <a href="#shop" class="inline-flex items-center text-purple-600 hover:text-purple-800 font-medium group">
              <span class="mr-2">Shop All Products</span>
              <i class="fas fa-arrow-right transform group-hover:translate-x-2 transition-transform duration-300"></i>
            </a>
          </div>

          <!-- Product Grid for Under ₱1000 -->
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <!-- Product 5 -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-xl transition-shadow duration-300">
              <div class="relative overflow-hidden">
                <img src="images/product-07.jpg"
                  alt="Vitamin C Brightening Serum"
                  class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500" />
                <span class="absolute top-3 left-3 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                  -15%
                </span>
                <div class="absolute top-3 right-3 flex flex-col space-y-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                  <button class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md hover:bg-purple-50 transition-colors duration-300 add-to-cart" data-product="Vitamin C Brightening Serum" data-price="899.00">
                    <i class="fas fa-shopping-bag text-slate-600"></i>
                  </button>
                  <button class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md hover:bg-purple-50 transition-colors duration-300 add-to-wishlist" data-product="Vitamin C Brightening Serum">
                    <i class="fas fa-star text-slate-600"></i>
                  </button>
                  <button class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md hover:bg-purple-50 transition-colors duration-300 compare-btn" data-product="Vitamin C Brightening Serum">
                    <i class="fas fa-retweet text-slate-600"></i>
                  </button>
                </div>
              </div>
              <div class="p-4">
                <div class="flex items-center space-x-2 mb-2">
                  <del class="text-slate-400">₱999.00</del>
                  <span class="text-xl font-bold text-slate-800">₱899.00</span>
                </div>
                <h3 class="text-lg font-semibold text-slate-800 mb-2">
                  <a href="#" class="hover:text-purple-600 transition-colors duration-300">
                    Vitamin C Brightening Serum
                  </a>
                </h3>
                <div class="flex items-center space-x-1 mb-2">
                  <i class="fas fa-star text-yellow-400"></i>
                  <i class="fas fa-star text-yellow-400"></i>
                  <i class="fas fa-star text-yellow-400"></i>
                  <i class="fas fa-star text-yellow-400"></i>
                  <i class="fas fa-star text-yellow-400"></i>
                  <span class="text-sm text-slate-500 ml-2">4230 reviews</span>
                </div>
              </div>
            </div>

            <!-- Product 6 -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-xl transition-shadow duration-300">
              <div class="relative overflow-hidden">
                <img src="images/product-08.jpg"
                  alt="Charcoal Detox Mask"
                  class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500" />
                <div class="absolute top-3 right-3 flex flex-col space-y-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                  <button class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md hover:bg-purple-50 transition-colors duration-300 add-to-cart" data-product="Charcoal Detox Mask" data-price="699.00">
                    <i class="fas fa-shopping-bag text-slate-600"></i>
                  </button>
                  <button class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md hover:bg-purple-50 transition-colors duration-300 add-to-wishlist" data-product="Charcoal Detox Mask">
                    <i class="fas fa-star text-slate-600"></i>
                  </button>
                  <button class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md hover:bg-purple-50 transition-colors duration-300 compare-btn" data-product="Charcoal Detox Mask">
                    <i class="fas fa-retweet text-slate-600"></i>
                  </button>
                </div>
              </div>
              <div class="p-4">
                <div class="mb-2">
                  <span class="text-xl font-bold text-slate-800">₱699.00</span>
                </div>
                <h3 class="text-lg font-semibold text-slate-800 mb-2">
                  <a href="#" class="hover:text-purple-600 transition-colors duration-300">
                    Charcoal Detox Mask
                  </a>
                </h3>
                <div class="flex items-center space-x-1 mb-2">
                  <i class="fas fa-star text-yellow-400"></i>
                  <i class="fas fa-star text-yellow-400"></i>
                  <i class="fas fa-star text-yellow-400"></i>
                  <i class="fas fa-star text-yellow-400"></i>
                  <i class="fas fa-star text-yellow-400"></i>
                  <span class="text-sm text-slate-500 ml-2">5670 reviews</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- BANNER SECTION -->
    <section class="py-12">
      <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
          <!-- Banner 1 -->
          <div class="relative rounded-2xl overflow-hidden group shine-hover">
            <div class="relative h-64 md:h-80">
              <img src="images/banner-1.jpg"
                alt="New Collection"
                class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
              <div class="absolute inset-0 bg-gradient-to-r from-purple-900/60 to-transparent"></div>
              <div class="absolute inset-0 flex items-center p-6 text-white">
                <div>
                  <p class="text-sm font-semibold mb-2">New Collection</p>
                  <h3 class="text-2xl md:text-3xl font-bold mb-4">Discover Our Autumn Skincare</h3>
                  <a href="#shop" class="inline-block px-6 py-2 bg-white text-purple-600 font-semibold rounded-full hover:bg-slate-100 transition-colors duration-300">
                    Explore More
                  </a>
                </div>
              </div>
            </div>
          </div>

          <!-- Banner 2 -->
          <div class="relative rounded-2xl overflow-hidden group shine-hover">
            <div class="relative h-64 md:h-80">
              <img src="images/banner-2.jpg"
                alt="25% off Everything"
                class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
              <div class="absolute inset-0 bg-gradient-to-r from-pink-900/60 to-transparent"></div>
              <div class="absolute inset-0 flex items-center p-6 text-white">
                <div>
                  <h3 class="text-2xl md:text-3xl font-bold mb-2">25% off Everything</h3>
                  <p class="mb-4">Makeup with extended range in colors for every human.</p>
                  <a href="#shop" class="inline-block px-6 py-2 bg-white text-pink-600 font-semibold rounded-full hover:bg-slate-100 transition-colors duration-300">
                    Shop Sale
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- FEATURE SECTION -->
    <section class="py-12 bg-slate-50">
      <div class="container mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-bold text-center text-slate-800 mb-12">Why Shop with Cosmic Beauty?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <!-- Feature 1 -->
          <div class="text-center">
            <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gradient-to-r from-purple-100 to-pink-100 flex items-center justify-center">
              <i class="fas fa-shield-alt text-3xl text-purple-600"></i>
            </div>
            <h3 class="text-xl font-bold text-slate-800 mb-4">Guaranteed PURE</h3>
            <p class="text-slate-600">
              All Cosmic Beauty formulations adhere to strict purity standards and will never contain harsh or toxic ingredients.
            </p>
          </div>

          <!-- Feature 2 -->
          <div class="text-center">
            <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gradient-to-r from-purple-100 to-pink-100 flex items-center justify-center">
              <i class="fas fa-heart text-3xl text-pink-600"></i>
            </div>
            <h3 class="text-xl font-bold text-slate-800 mb-4">Completely Cruelty-Free</h3>
            <p class="text-slate-600">
              Our products are never tested on animals and are certified cruelty-free by international standards.
            </p>
          </div>

          <!-- Feature 3 -->
          <div class="text-center">
            <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gradient-to-r from-purple-100 to-pink-100 flex items-center justify-center">
              <i class="fas fa-leaf text-3xl text-emerald-600"></i>
            </div>
            <h3 class="text-xl font-bold text-slate-800 mb-4">Ethical Sourcing</h3>
            <p class="text-slate-600">
              We responsibly source all ingredients, ensuring fair trade practices and sustainable harvesting.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- OFFER SECTION -->
    <section id="offer" class="py-12">
      <div class="container mx-auto px-4">
        <div class="bg-gradient-to-r from-purple-600 to-pink-500 rounded-2xl p-8 md:p-12 text-white">
          <div class="flex flex-col md:flex-row items-center justify-between">
            <div class="md:w-1/2 mb-8 md:mb-0">
              <h2 class="text-3xl md:text-4xl font-bold mb-4">Special Offer</h2>
              <p class="text-lg mb-6">Get 20% off on all products this weekend only!</p>
              <div class="flex items-center space-x-4 mb-6">
                <div class="text-center">
                  <div class="text-3xl font-bold">15</div>
                  <div class="text-sm">Days</div>
                </div>
                <div class="text-center">
                  <div class="text-3xl font-bold">21</div>
                  <div class="text-sm">Hours</div>
                </div>
                <div class="text-center">
                  <div class="text-3xl font-bold">46</div>
                  <div class="text-sm">Minutes</div>
                </div>
                <div class="text-center">
                  <div class="text-3xl font-bold">08</div>
                  <div class="text-sm">Seconds</div>
                </div>
              </div>
              <a href="#shop" class="inline-block px-8 py-3 bg-white text-purple-600 font-semibold rounded-full hover:bg-slate-100 transition-colors duration-300">
                Shop Now
              </a>
            </div>
            <div class="md:w-1/2 flex justify-center">
              <div class="relative">
                <div class="w-48 h-48 md:w-64 md:h-64 rounded-full bg-white/20 flex items-center justify-center">
                  <i class="fas fa-gift text-6xl md:text-8xl text-white"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ABOUT SECTION -->
    <section id="about" class="py-12">
      <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
          <!-- Image -->
          <div class="relative rounded-2xl overflow-hidden">
            <img src="https://images.unsplash.com/photo-1596462502278-27bfdc403348?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
              alt="Cosmic Beauty"
              class="w-full h-auto rounded-2xl shadow-xl" />
          </div>

          <!-- Content -->
          <div>
            <h2 class="text-3xl font-bold text-slate-800 mb-6 flex items-center">
              <i class="fas fa-star text-yellow-400 mr-2"></i>
              Welcome to Cosmic Beauty
            </h2>
            <div class="space-y-4 text-slate-600">
              <p>
                Welcome to Cosmic Beauty, where the stars align to reveal your radiance. Our collection of skincare and cosmetics is inspired by the brilliance of the cosmos, blending the mysteries of the universe with cutting-edge innovation.
              </p>
              <p>
                Each product is infused with ingredients that are as rare as a shooting star, designed to illuminate your natural glow. Let Cosmic Beauty guide you to discover skincare and makeup that transcends the ordinary.
              </p>
              <p>
                At Cosmic Beauty, we believe your skin deserves the universe's best. That's why we source ingredients that mirror the wonders of the galaxy—think shimmering minerals, rejuvenating botanicals, and innovative formulations.
              </p>
              <p>
                Our mission is to make every moment magical. With Cosmic Beauty, your makeup becomes a constellation of possibilities. Explore our range of beauty essentials and unlock your star power.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CONTACT SECTION -->
    <section id="contact" class="py-12 bg-slate-50">
      <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
          <!-- Contact Form -->
          <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8">
            <h2 class="text-2xl font-bold text-slate-800 mb-6 flex items-center">
              <i class="fas fa-envelope text-purple-600 mr-2"></i>
              Contact Us
            </h2>
            <form id="contactForm" class="space-y-4">
              <div>
                <label for="name" class="block text-sm font-medium text-slate-700 mb-2">
                  <i class="fas fa-user text-purple-500 mr-1"></i> Name
                </label>
                <input type="text"
                  id="name"
                  name="name"
                  placeholder="Your Name"
                  required
                  class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300" />
              </div>

              <div>
                <label for="email" class="block text-sm font-medium text-slate-700 mb-2">
                  <i class="fas fa-envelope text-purple-500 mr-1"></i> Email
                </label>
                <input type="email"
                  id="email"
                  name="email"
                  placeholder="Your Email"
                  required
                  class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300" />
              </div>

              <div>
                <label for="message" class="block text-sm font-medium text-slate-700 mb-2">
                  <i class="fas fa-comment text-purple-500 mr-1"></i> Message
                </label>
                <textarea id="message"
                  name="message"
                  rows="5"
                  placeholder="Your Message"
                  required
                  class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300"></textarea>
              </div>

              <button type="submit"
                class="w-full py-3 px-4 bg-gradient-to-r from-purple-600 to-pink-500 text-white font-semibold rounded-lg hover:shadow-lg transform hover:-translate-y-1 transition-all duration-300">
                Send Message
              </button>
            </form>
          </div>

          <!-- Service Info -->
          <div class="bg-gradient-to-br from-purple-900 to-pink-800 rounded-2xl shadow-lg p-6 md:p-8 text-white">
            <h2 class="text-2xl font-bold mb-6 flex items-center">
              <i class="fas fa-star text-yellow-300 mr-2"></i>
              How Is Our Cosmic Service?
            </h2>
            <div class="space-y-4">
              <p>
                Your thoughts are like stardust to us. Share your cosmic insights and help us elevate our intergalactic journey. Your feedback propels us toward greater experiences!
              </p>
              <p>
                If you have questions, want to connect across the stars, or need support, don't hesitate to reach out. We are here to guide you through the universe of possibilities.
              </p>
              <div class="mt-6">
                <div class="flex items-center space-x-2 mb-4">
                  <i class="fas fa-phone text-green-300"></i>
                  <span class="font-semibold">+639 1234 567 910</span>
                </div>
                <div class="flex items-center space-x-2">
                  <i class="fas fa-envelope text-blue-300"></i>
                  <span class="font-semibold">SibongaSCC@cosmicbeauty.com</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <?php include './layouts/footer.php'; ?>

  <!-- Back to Top Button -->
  <a href="#home"
    class="fixed bottom-6 right-6 w-12 h-12 bg-gradient-to-r from-purple-600 to-pink-500 text-white rounded-full flex items-center justify-center shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 z-40"
    id="backToTop">
    <i class="fas fa-arrow-up"></i>
  </a>

  <script>
    // Mobile Menu Toggle
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

    // CAROUSEL FUNCTIONALITY
    class Carousel {
      constructor() {
        this.slides = document.querySelectorAll('.carousel-slide');
        this.indicators = document.querySelectorAll('.carousel-indicator');
        this.prevBtn = document.getElementById('prevSlide');
        this.nextBtn = document.getElementById('nextSlide');
        this.currentSlide = 0;
        this.totalSlides = this.slides.length;
        this.autoSlideInterval = null;
        this.autoSlideDelay = 5000; // 5 seconds

        if (this.slides.length > 0) {
          this.init();
        }
      }

      init() {
        // Set up event listeners
        if (this.prevBtn) this.prevBtn.addEventListener('click', () => this.prev());
        if (this.nextBtn) this.nextBtn.addEventListener('click', () => this.next());

        // Indicator click events
        this.indicators.forEach(indicator => {
          indicator.addEventListener('click', () => {
            const slideIndex = parseInt(indicator.getAttribute('data-slide')) - 1;
            this.goToSlide(slideIndex);
          });
        });

        // Start auto slide
        this.startAutoSlide();

        // Pause auto slide on hover
        const carousel = document.querySelector('.carousel-container');
        if (carousel) {
          carousel.addEventListener('mouseenter', () => this.stopAutoSlide());
          carousel.addEventListener('mouseleave', () => this.startAutoSlide());
        }

        // Touch swipe support for mobile
        this.setupTouchEvents();
      }

      showSlide(index) {
        // Hide all slides
        this.slides.forEach(slide => {
          slide.classList.remove('active');
          slide.classList.remove('fade-in');
        });

        // Remove active class from all indicators
        this.indicators.forEach(indicator => indicator.classList.remove('active'));

        // Show current slide
        this.slides[index].classList.add('active');
        setTimeout(() => {
          this.slides[index].classList.add('fade-in');
        }, 50);

        // Update active indicator
        this.indicators[index].classList.add('active');

        this.currentSlide = index;
      }

      next() {
        const nextIndex = (this.currentSlide + 1) % this.totalSlides;
        this.showSlide(nextIndex);
        this.restartAutoSlide();
      }

      prev() {
        const prevIndex = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
        this.showSlide(prevIndex);
        this.restartAutoSlide();
      }

      goToSlide(index) {
        if (index >= 0 && index < this.totalSlides) {
          this.showSlide(index);
          this.restartAutoSlide();
        }
      }

      startAutoSlide() {
        this.stopAutoSlide(); // Clear any existing interval
        this.autoSlideInterval = setInterval(() => this.next(), this.autoSlideDelay);
      }

      stopAutoSlide() {
        if (this.autoSlideInterval) {
          clearInterval(this.autoSlideInterval);
          this.autoSlideInterval = null;
        }
      }

      restartAutoSlide() {
        this.stopAutoSlide();
        this.startAutoSlide();
      }

      setupTouchEvents() {
        const carousel = document.querySelector('.carousel-container');
        if (!carousel) return;

        let touchStartX = 0;
        let touchEndX = 0;

        carousel.addEventListener('touchstart', (e) => {
          touchStartX = e.changedTouches[0].screenX;
        }, {
          passive: true
        });

        carousel.addEventListener('touchend', (e) => {
          touchEndX = e.changedTouches[0].screenX;
          this.handleSwipe(touchStartX, touchEndX);
        }, {
          passive: true
        });
      }

      handleSwipe(startX, endX) {
        const swipeThreshold = 50; // Minimum swipe distance

        if (startX - endX > swipeThreshold) {
          // Swipe left - next slide
          this.next();
        } else if (endX - startX > swipeThreshold) {
          // Swipe right - previous slide
          this.prev();
        }
      }
    }

    // Initialize carousel when DOM is loaded
    document.addEventListener('DOMContentLoaded', () => {
      new Carousel();
    });

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function(e) {
        if (this.getAttribute('href') === '#') return;

        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          target.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
          });
        }
      });
    });

    // Cart and Wishlist functionality
    let cartCount = 0;
    let wishlistCount = 0;
    let cartTotal = 0;

    // Update cart display
    function updateCartDisplay() {
      const cartCountEl = document.getElementById('cartCount');
      const cartTotalEl = document.getElementById('cartTotal');
      const wishlistCountEl = document.getElementById('wishlistCount');

      if (cartCountEl) cartCountEl.textContent = cartCount;
      if (cartTotalEl) cartTotalEl.textContent = `₱${cartTotal.toFixed(2)}`;
      if (wishlistCountEl) wishlistCountEl.textContent = wishlistCount;
    }

    // Add to cart functionality
    document.querySelectorAll('.add-to-cart').forEach(btn => {
      btn.addEventListener('click', function() {
        const product = this.getAttribute('data-product');
        const price = parseFloat(this.getAttribute('data-price'));

        cartCount++;
        cartTotal += price;
        updateCartDisplay();

        showNotification(`Added ${product} to cart!`);
      });
    });

    // Add to wishlist functionality
    document.querySelectorAll('.add-to-wishlist').forEach(btn => {
      btn.addEventListener('click', function() {
        const product = this.getAttribute('data-product');

        wishlistCount++;
        updateCartDisplay();

        showNotification(`Added ${product} to wishlist!`);
      });
    });

    // Compare functionality
    document.querySelectorAll('.compare-btn').forEach(btn => {
      btn.addEventListener('click', function() {
        const product = this.getAttribute('data-product');
        showNotification(`Added ${product} to compare list!`);
      });
    });

    // Search button functionality
    const searchBtn = document.getElementById('searchBtn');
    if (searchBtn) {
      searchBtn.addEventListener('click', () => {
        showNotification('Search functionality coming soon!');
      });
    }

    // Cart button functionality
    const cartBtn = document.getElementById('cartBtn');
    if (cartBtn) {
      cartBtn.addEventListener('click', () => {
        if (cartCount === 0) {
          showNotification('Your cart is empty!');
        } else {
          showNotification(`You have ${cartCount} items in your cart. Total: ₱${cartTotal.toFixed(2)}`);
        }
      });
    }

    // Wishlist button functionality
    const wishlistBtn = document.getElementById('wishlistBtn');
    if (wishlistBtn) {
      wishlistBtn.addEventListener('click', () => {
        if (wishlistCount === 0) {
          showNotification('Your wishlist is empty!');
        } else {
          showNotification(`You have ${wishlistCount} items in your wishlist.`);
        }
      });
    }

    // Show notification
    function showNotification(message) {
      const notification = document.createElement('div');
      notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transform translate-x-full opacity-0 transition-all duration-300 z-50';
      notification.textContent = message;
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

    // Form submission
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
      contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        showNotification('Message sent successfully!');
        this.reset();
      });
    }

    // Newsletter form submission
    const newsletterForm = document.getElementById('newsletterForm');
    if (newsletterForm) {
      newsletterForm.addEventListener('submit', function(e) {
        e.preventDefault();
        showNotification('Thank you for subscribing to our cosmic journey!');
        this.reset();
      });
    }

    // Back to top button
    const backToTop = document.getElementById('backToTop');
    if (backToTop) {
      window.addEventListener('scroll', () => {
        if (window.pageYOffset > 300) {
          backToTop.classList.remove('opacity-0', 'invisible');
          backToTop.classList.add('opacity-100', 'visible');
        } else {
          backToTop.classList.remove('opacity-100', 'visible');
          backToTop.classList.add('opacity-0', 'invisible');
        }
      });
    }
  </script>
</body>

</html>

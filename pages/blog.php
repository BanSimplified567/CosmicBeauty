<?php
session_start();
$page_title = "Beauty Blog | Cosmic Beauty";
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

    .blog-card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .blog-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    }

    .category-badge {
      position: absolute;
      top: 15px;
      left: 15px;
      background: rgba(255, 255, 255, 0.9);
      padding: 4px 12px;
      border-radius: 20px;
      font-size: 0.75rem;
      font-weight: 600;
      backdrop-filter: blur(4px);
    }

    .read-time {
      color: #6b7280;
      font-size: 0.875rem;
    }

    .author-img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
    }
  </style>
</head>

<body class="bg-slate-50">
  <!-- HEADER -->
  <?php include '../layouts/header.php'; ?>

  <!-- BREADCRUMB -->
  <div class="bg-gradient-to-r from-indigo-50 to-purple-50 py-4">
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
              <span class="ml-1 text-sm font-medium text-purple-600 md:ml-2">Blog</span>
            </div>
          </li>
        </ol>
      </nav>
    </div>
  </div>

  <!-- BLOG CONTENT -->
  <div class="container mx-auto px-4 py-12">
    <!-- Page Header -->
    <div class="text-center mb-12">
      <h1 class="text-4xl md:text-5xl font-bold text-slate-800 mb-4">✨ Cosmic Beauty Blog</h1>
      <p class="text-lg text-slate-600 max-w-2xl mx-auto">
        Discover beauty tips, skincare secrets, makeup tutorials, and cosmic inspiration.
      </p>
    </div>

    <!-- Featured Post -->
    <div class="mb-12">
      <div class="bg-white rounded-2xl shadow-sm overflow-hidden blog-card">
        <div class="md:flex">
          <div class="md:w-1/2 relative">
            <img src="../images/blog-1.jpg"
              alt="Featured Blog Post"
              class="w-full h-64 md:h-full object-cover">
            <div class="category-badge">FEATURED</div>
          </div>
          <div class="md:w-1/2 p-8">
            <div class="flex items-center space-x-4 mb-4">
              <span class="px-3 py-1 bg-purple-100 text-purple-600 rounded-full text-sm font-semibold">
                Skincare
              </span>
              <span class="read-time"><i class="far fa-clock mr-1"></i> 5 min read</span>
            </div>
            <h2 class="text-2xl md:text-3xl font-bold text-slate-800 mb-4">
              The Ultimate Guide to Glowing Skin: A Cosmic Approach
            </h2>
            <p class="text-slate-600 mb-6">
              Discover the secrets to achieving radiant, glowing skin using cosmic-inspired ingredients
              and techniques. Learn how to create a skincare routine that works with your skin's natural rhythm.
            </p>
            <div class="flex items-center justify-between">
              <div class="flex items-center space-x-3">
                <img src="../images/blog-2.jpg" alt="Author" class="author-img">
                <div>
                  <div class="font-semibold text-slate-800">Dr. Stella Nova</div>
                  <div class="text-sm text-slate-500">Beauty Expert</div>
                </div>
              </div>
              <a href="blog-single.php?id=1"
                class="text-purple-600 font-semibold hover:text-purple-800 transition-colors">
                Read More <i class="fas fa-arrow-right ml-2"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Blog Categories -->
    <div class="mb-12">
      <h2 class="text-2xl font-bold text-slate-800 mb-6">Browse by Category</h2>
      <div class="flex flex-wrap gap-4">
        <?php
        $categories = [
          ['name' => 'All', 'count' => '24', 'active' => true],
          ['name' => 'Skincare', 'count' => '8'],
          ['name' => 'Makeup', 'count' => '6'],
          ['name' => 'Wellness', 'count' => '5'],
          ['name' => 'Tutorials', 'count' => '4'],
          ['name' => 'Ingredients', 'count' => '7'],
        ];

        foreach ($categories as $category):
        ?>
          <a href="blog.php?category=<?php echo strtolower($category['name']); ?>"
            class="px-4 py-2 rounded-full border <?php echo $category['active'] ? 'border-purple-600 bg-purple-600 text-white' : 'border-slate-300 text-slate-700 hover:border-purple-300 hover:bg-purple-50'; ?> transition-colors">
            <?php echo $category['name']; ?>
            <span class="ml-2 text-xs px-2 py-1 rounded-full <?php echo $category['active'] ? 'bg-white/20' : 'bg-slate-100'; ?>">
              <?php echo $category['count']; ?>
            </span>
          </a>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Blog Posts Grid -->
    <div class="mb-12">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php
        $blog_posts = [
          [
            'title' => 'Moon Phase Skincare: Align Your Routine with Lunar Cycles',
            'excerpt' => 'Learn how different moon phases affect your skin and how to adjust your skincare routine accordingly.',
            'category' => 'Skincare',
            'image' => 'blog-1.jpg',
            'author' => 'Luna Moon',
            'date' => 'Mar 15, 2024',
            'read_time' => '4 min',
            'views' => '1.2k'
          ],
          [
            'title' => 'Galactic Glow: How to Achieve Starlight Highlighting',
            'excerpt' => 'Step-by-step tutorial for creating multidimensional highlight that mimics distant stars.',
            'category' => 'Makeup',
            'image' => 'blog-2.jpg',
            'author' => 'Aurora Sky',
            'date' => 'Mar 12, 2024',
            'read_time' => '3 min',
            'views' => '2.1k'
          ],
          [
            'title' => 'Celestial Ingredients: Starflower Extract Benefits',
            'excerpt' => 'Discover the amazing benefits of starflower extract for anti-aging and skin rejuvenation.',
            'category' => 'Ingredients',
            'image' => 'blog-3.jpg',
            'author' => 'Dr. Cosmo',
            'date' => 'Mar 10, 2024',
            'read_time' => '6 min',
            'views' => '890'
          ],
          [
            'title' => 'Meditation for Beautiful Skin: Cosmic Connection',
            'excerpt' => 'How daily meditation can improve your skin health and overall glow.',
            'category' => 'Wellness',
            'image' => 'hero-banner-1.jpg',
            'author' => 'Zenith Peace',
            'date' => 'Mar 8, 2024',
            'read_time' => '5 min',
            'views' => '1.5k'
          ],
          [
            'title' => 'Nebula Eye Makeup Tutorial: Create Cosmic Eyes',
            'excerpt' => 'Learn to create stunning nebula-inspired eye looks with our step-by-step guide.',
            'category' => 'Tutorials',
            'image' => 'hero-banner-2.jpg',
            'author' => 'Stella Shine',
            'date' => 'Mar 5, 2024',
            'read_time' => '8 min',
            'views' => '3.4k'
          ],
          [
            'title' => 'Seasonal Skincare Transition: Spring Edition',
            'excerpt' => 'How to adjust your skincare routine as we transition from winter to spring.',
            'category' => 'Skincare',
            'image' => 'hero-banner-3.jpg',
            'author' => 'Dr. Flora Bloom',
            'date' => 'Mar 3, 2024',
            'read_time' => '7 min',
            'views' => '1.8k'
          ],
        ];

        foreach ($blog_posts as $post):
        ?>
          <div class="bg-white rounded-xl shadow-sm overflow-hidden blog-card">
            <div class="relative">
              <img src="../images/<?php echo $post['image']; ?>"
                alt="<?php echo $post['title']; ?>"
                class="w-full h-48 object-cover">
              <div class="category-badge"><?php echo $post['category']; ?></div>
            </div>
            <div class="p-6">
              <div class="flex items-center justify-between mb-4">
                <span class="read-time">
                  <i class="far fa-clock mr-1"></i> <?php echo $post['read_time']; ?> read
                </span>
                <span class="text-sm text-slate-500">
                  <i class="far fa-eye mr-1"></i> <?php echo $post['views']; ?>
                </span>
              </div>
              <h3 class="text-xl font-bold text-slate-800 mb-3"><?php echo $post['title']; ?></h3>
              <p class="text-slate-600 mb-6"><?php echo $post['excerpt']; ?></p>
              <div class="flex items-center justify-between border-t border-slate-100 pt-4">
                <div class="flex items-center space-x-3">
                  <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center">
                    <i class="fas fa-user text-purple-600 text-sm"></i>
                  </div>
                  <div>
                    <div class="font-medium text-slate-800 text-sm"><?php echo $post['author']; ?></div>
                    <div class="text-xs text-slate-500"><?php echo $post['date']; ?></div>
                  </div>
                </div>
                <a href="blog-single.php?id=<?php echo array_search($post, $blog_posts) + 1; ?>"
                  class="text-purple-600 hover:text-purple-800 transition-colors">
                  <i class="fas fa-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Pagination -->
    <div class="flex justify-center mb-12">
      <nav class="flex items-center space-x-2">
        <button class="w-10 h-10 flex items-center justify-center rounded-lg border border-slate-300 text-slate-600 hover:bg-slate-50">
          <i class="fas fa-chevron-left"></i>
        </button>
        <button class="w-10 h-10 flex items-center justify-center rounded-lg bg-purple-600 text-white">1</button>
        <button class="w-10 h-10 flex items-center justify-center rounded-lg border border-slate-300 text-slate-600 hover:bg-slate-50">2</button>
        <button class="w-10 h-10 flex items-center justify-center rounded-lg border border-slate-300 text-slate-600 hover:bg-slate-50">3</button>
        <span class="text-slate-400">...</span>
        <button class="w-10 h-10 flex items-center justify-center rounded-lg border border-slate-300 text-slate-600 hover:bg-slate-50">6</button>
        <button class="w-10 h-10 flex items-center justify-center rounded-lg border border-slate-300 text-slate-600 hover:bg-slate-50">
          <i class="fas fa-chevron-right"></i>
        </button>
      </nav>
    </div>

    <!-- Newsletter Subscription -->
    <div class="bg-gradient-to-r from-indigo-500 to-purple-500 rounded-2xl p-8 md:p-12 text-white">
      <div class="flex flex-col md:flex-row items-center justify-between">
        <div class="mb-6 md:mb-0 md:pr-8">
          <h2 class="text-2xl md:text-3xl font-bold mb-4">Stay Updated with Cosmic Beauty</h2>
          <p class="text-indigo-100">
            Get the latest beauty tips, exclusive content, and special offers delivered directly to your inbox.
          </p>
        </div>
        <form class="w-full md:w-auto">
          <div class="flex flex-col sm:flex-row gap-4">
            <input type="email"
              placeholder="Your email address"
              required
              class="px-4 py-3 rounded-lg text-slate-800 focus:outline-none focus:ring-2 focus:ring-white">
            <button type="submit"
              class="px-6 py-3 bg-white text-indigo-600 font-semibold rounded-lg hover:bg-slate-100 transition-colors">
              Subscribe
            </button>
          </div>
          <p class="text-sm text-indigo-200 mt-3">No spam ever. Unsubscribe anytime.</p>
        </form>
      </div>
    </div>
  </div>

  <!-- FOOTER -->
  <?php include '../layouts/footer.php'; ?>

  <script>
    // Blog interactions
    document.addEventListener('DOMContentLoaded', function() {
      // Blog card hover effects
      document.querySelectorAll('.blog-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
          this.style.boxShadow = '0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)';
        });

        card.addEventListener('mouseleave', function() {
          this.style.boxShadow = '';
        });
      });

      // Newsletter form submission
      document.querySelector('form').addEventListener('submit', function(e) {
        e.preventDefault();

        const notification = document.createElement('div');
        notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transform translate-x-full opacity-0 transition-all duration-300 z-50';
        notification.textContent = 'Thank you for subscribing to our cosmic newsletter!';
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
    });
  </script>
</body>

</html>

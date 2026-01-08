<?php
session_start();
$page_title = "About Cosmic Beauty | Our Story";
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

    .mission-card {
      transition: transform 0.3s ease;
    }

    .mission-card:hover {
      transform: translateY(-5px);
    }

    .team-member {
      transition: all 0.3s ease;
    }

    .team-member:hover {
      transform: translateY(-5px);
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    }

    .timeline-item {
      position: relative;
      padding-left: 30px;
    }

    .timeline-item::before {
      content: '';
      position: absolute;
      left: 0;
      top: 8px;
      width: 12px;
      height: 12px;
      border-radius: 50%;
      background: linear-gradient(135deg, #8b5cf6, #ec4899);
    }

    .value-icon {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 20px;
      font-size: 2rem;
    }
  </style>
</head>

<body class="bg-slate-50">
  <!-- HEADER -->
  <?php include '../layouts/header.php'; ?>

  <!-- BREADCRUMB -->
  <div class="bg-gradient-to-r from-blue-50 to-cyan-50 py-4">
    <div class="container mx-auto px-4">
      <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
          <li class="inline-flex items-center">
            <a href="index.php" class="inline-flex items-center text-sm text-slate-600 hover:text-blue-600">
              <i class="fas fa-home mr-2"></i>
              Home
            </a>
          </li>
          <li aria-current="page">
            <div class="flex items-center">
              <i class="fas fa-chevron-right text-slate-300 mx-2"></i>
              <span class="ml-1 text-sm font-medium text-blue-600 md:ml-2">About Us</span>
            </div>
          </li>
        </ol>
      </nav>
    </div>
  </div>

  <!-- ABOUT CONTENT -->
  <div class="container mx-auto px-4 py-12">
    <!-- Hero Section -->
    <div class="text-center mb-16">
      <h1 class="text-4xl md:text-5xl font-bold text-slate-800 mb-6">
        Welcome to <span class="gradient-text">Cosmic Beauty</span>
      </h1>
      <p class="text-xl text-slate-600 max-w-3xl mx-auto">
        Where celestial wonders meet earthly beauty. We're on a mission to revolutionize
        skincare and cosmetics with ingredients inspired by the cosmos.
      </p>
    </div>

    <!-- Our Story -->
    <div class="mb-16">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div>
          <h2 class="text-3xl font-bold text-slate-800 mb-6">Our Cosmic Journey</h2>
          <div class="space-y-4 text-slate-600">
            <p>
              Founded in 2018 by astrophysicist Dr. Stella Nova and skincare expert Luna Moon,
              Cosmic Beauty began as a passion project to merge scientific innovation with natural beauty.
            </p>
            <p>
              What started as a small laboratory experiment in Stella's garage has grown into a
              globally recognized brand, loved by beauty enthusiasts and skincare experts alike.
            </p>
            <p>
              Our journey has been guided by the stars - literally. We study celestial patterns,
              cosmic radiation effects, and space-age technology to develop products that are truly out of this world.
            </p>
          </div>
          <div class="mt-8 flex items-center space-x-4">
            <div class="text-center">
              <div class="text-3xl font-bold text-blue-600">5+</div>
              <div class="text-sm text-slate-600">Years of Excellence</div>
            </div>
            <div class="text-center">
              <div class="text-3xl font-bold text-purple-600">50k+</div>
              <div class="text-sm text-slate-600">Happy Customers</div>
            </div>
            <div class="text-center">
              <div class="text-3xl font-bold text-pink-600">100+</div>
              <div class="text-sm text-slate-600">Products</div>
            </div>
          </div>
        </div>
        <div class="relative">
          <img src="../images/banner-1.jpg"
            alt="Our Story"
            class="rounded-2xl shadow-xl w-full">
          <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center text-white">
            <div class="text-center">
              <div class="text-2xl font-bold">2018</div>
              <div class="text-sm">Founded</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Our Mission -->
    <div class="mb-16">
      <h2 class="text-3xl font-bold text-slate-800 mb-12 text-center">Our Mission & Vision</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white p-8 rounded-2xl shadow-sm mission-card">
          <div class="value-icon bg-purple-100 text-purple-600">
            <i class="fas fa-star"></i>
          </div>
          <h3 class="text-xl font-bold text-slate-800 mb-4 text-center">Our Mission</h3>
          <p class="text-slate-600 text-center">
            To create innovative, effective beauty products using cosmic-inspired ingredients
            that deliver visible results while being sustainable and ethical.
          </p>
        </div>

        <div class="bg-white p-8 rounded-2xl shadow-sm mission-card">
          <div class="value-icon bg-pink-100 text-pink-600">
            <i class="fas fa-eye"></i>
          </div>
          <h3 class="text-xl font-bold text-slate-800 mb-4 text-center">Our Vision</h3>
          <p class="text-slate-600 text-center">
            To become the leading cosmic beauty brand worldwide, inspiring people to embrace
            their unique beauty while caring for our planet and its resources.
          </p>
        </div>

        <div class="bg-white p-8 rounded-2xl shadow-sm mission-card">
          <div class="value-icon bg-blue-100 text-blue-600">
            <i class="fas fa-heart"></i>
          </div>
          <h3 class="text-xl font-bold text-slate-800 mb-4 text-center">Our Promise</h3>
          <p class="text-slate-600 text-center">
            100% satisfaction guarantee, cruelty-free products, sustainable packaging,
            and transparent ingredient sourcing.
          </p>
        </div>
      </div>
    </div>

    <!-- Core Values -->
    <div class="mb-16">
      <h2 class="text-3xl font-bold text-slate-800 mb-12 text-center">Our Core Values</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <?php
        $values = [
          [
            'title' => 'Innovation',
            'icon' => 'fas fa-rocket',
            'color' => 'from-purple-500 to-pink-500',
            'description' => 'Pushing boundaries with cosmic-inspired technology'
          ],
          [
            'title' => 'Sustainability',
            'icon' => 'fas fa-leaf',
            'color' => 'from-emerald-500 to-green-500',
            'description' => 'Eco-friendly practices and packaging'
          ],
          [
            'title' => 'Transparency',
            'icon' => 'fas fa-search',
            'color' => 'from-blue-500 to-cyan-500',
            'description' => 'Clear ingredient lists and sourcing'
          ],
          [
            'title' => 'Inclusivity',
            'icon' => 'fas fa-users',
            'color' => 'from-orange-500 to-red-500',
            'description' => 'Products for all skin types and tones'
          ],
        ];

        foreach ($values as $value):
        ?>
          <div class="bg-gradient-to-r <?php echo $value['color']; ?> p-6 rounded-2xl text-white">
            <div class="w-16 h-16 rounded-full bg-white/20 flex items-center justify-center mb-4">
              <i class="<?php echo $value['icon']; ?> text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold mb-2"><?php echo $value['title']; ?></h3>
            <p class="text-white/80"><?php echo $value['description']; ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Our Timeline -->
    <div class="mb-16">
      <h2 class="text-3xl font-bold text-slate-800 mb-12 text-center">Our Journey Through Time</h2>
      <div class="max-w-4xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
          <div class="space-y-8">
            <?php
            $timeline_left = [
              [
                'year' => '2018',
                'title' => 'Cosmic Beauty Founded',
                'description' => 'Started in a small garage laboratory'
              ],
              [
                'year' => '2019',
                'title' => 'First Product Launch',
                'description' => 'Released our signature Galactic Glow Serum'
              ],
              [
                'year' => '2020',
                'title' => 'International Expansion',
                'description' => 'Launched in 10+ countries worldwide'
              ],
            ];

            foreach ($timeline_left as $item):
            ?>
              <div class="timeline-item">
                <div class="text-lg font-bold text-slate-800"><?php echo $item['year']; ?></div>
                <div class="text-xl font-semibold text-purple-600 mb-2"><?php echo $item['title']; ?></div>
                <p class="text-slate-600"><?php echo $item['description']; ?></p>
              </div>
            <?php endforeach; ?>
          </div>

          <div class="space-y-8 mt-12 md:mt-0">
            <?php
            $timeline_right = [
              [
                'year' => '2021',
                'title' => 'Sustainability Award',
                'description' => 'Received Green Beauty Innovation Award'
              ],
              [
                'year' => '2022',
                'title' => 'Research Facility',
                'description' => 'Opened state-of-the-art cosmic research lab'
              ],
              [
                'year' => '2023',
                'title' => '1 Million Customers',
                'description' => 'Reached milestone of 1 million satisfied customers'
              ],
            ];

            foreach ($timeline_right as $item):
            ?>
              <div class="timeline-item">
                <div class="text-lg font-bold text-slate-800"><?php echo $item['year']; ?></div>
                <div class="text-xl font-semibold text-pink-600 mb-2"><?php echo $item['title']; ?></div>
                <p class="text-slate-600"><?php echo $item['description']; ?></p>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>

    <!-- Meet the Team -->
    <div class="mb-16">
      <h2 class="text-3xl font-bold text-slate-800 mb-12 text-center">Meet Our Cosmic Team</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        <?php
        $team = [
          [
            'name' => 'Dr. Ban Simplified',
            'role' => 'Founder & CEO',
            'image' => 'bannie-1.jpg',
            'bio' => 'Astrophysicist turned beauty innovator'
          ],
          [
            'name' => 'Bannie',
            'role' => 'Co-Founder & CTO',
            'image' => 'bannie-2.jpg',
            'bio' => 'Skincare expert with 15+ years experience'
          ],
          [
            'name' => 'Ban Ban',
            'role' => 'Lead Scientist',
            'image' => 'bannie-3.jpg',
            'bio' => 'Cosmetic chemistry specialist'
          ],
          [
            'name' => 'Ban Dev',
            'role' => 'Creative Director',
            'image' => 'bannie-4.jpg',
            'bio' => 'Award-winning beauty artist'
          ],
        ];

        foreach ($team as $member):
        ?>
          <div class="team-member bg-white rounded-2xl shadow-sm overflow-hidden">
            <img src="../images/<?php echo $member['image']; ?>"
              alt="<?php echo $member['name']; ?>"
              class="w-full h-64 object-cover">
            <div class="p-6">
              <h3 class="text-xl font-bold text-slate-800 mb-1"><?php echo $member['name']; ?></h3>
              <div class="text-purple-600 font-semibold mb-2"><?php echo $member['role']; ?></div>
              <p class="text-slate-600 text-sm"><?php echo $member['bio']; ?></p>
              <div class="flex space-x-3 mt-4">
                <a href="https://www.linkedin.com/in/jadeivanbringcola567" class="text-slate-400 hover:text-purple-600">
                  <i class="fab fa-linkedin"></i>
                </a>
                <a href="https://www.instagram.com/his.bannie" class="text-slate-400 hover:text-pink-600">
                  <i class="fab fa-instagram"></i>
                </a>
                <a href="https://x.com/JBringcola" class="text-slate-400 hover:text-blue-600">
                  <i class="fab fa-twitter"></i>
                </a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Call to Action -->
    <div class="bg-gradient-to-r from-purple-600 to-pink-500 rounded-2xl p-8 md:p-12 text-white text-center">
      <h2 class="text-3xl font-bold mb-4">Join Our Cosmic Community</h2>
      <p class="text-purple-100 mb-8 max-w-2xl mx-auto">
        Be part of our journey to revolutionize beauty with cosmic-inspired innovation.
        Together, we can make the world more beautiful, one star at a time.
      </p>
      <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <a href="shop.php"
          class="px-6 py-3 bg-white text-purple-600 font-semibold rounded-lg hover:bg-slate-100 transition-colors">
          Shop Our Products
        </a>
        <a href="contact.php"
          class="px-6 py-3 bg-transparent border-2 border-white text-white font-semibold rounded-lg hover:bg-white/10 transition-colors">
          Get in Touch
        </a>
      </div>
    </div>
  </div>

  <!-- FOOTER -->
  <?php include '../layouts/footer.php'; ?>

  <script>
    // Team member hover effects
    document.querySelectorAll('.team-member').forEach(member => {
      member.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-5px)';
        this.style.boxShadow = '0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)';
      });

      member.addEventListener('mouseleave', function() {
        this.style.transform = '';
        this.style.boxShadow = '';
      });
    });

    // Mission card hover effects
    document.querySelectorAll('.mission-card').forEach(card => {
      card.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-5px)';
      });

      card.addEventListener('mouseleave', function() {
        this.style.transform = '';
      });
    });
  </script>
</body>

</html>

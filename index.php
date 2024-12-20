<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Cosmic Beauty</title>

        <link rel="shortcut icon" href="favicon.svg" type="image/svg+xml" />

        <link rel="stylesheet" href="css/style.css" />

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700;800&display=swap"
            rel="stylesheet" />

        <link rel="preload" as="image" href="images/logo.png" />
        <link rel="preload" as="image" href="images/hero-banner-1.jpg" />
        <link rel="preload" as="image" href="images/hero-banner-2.jpg" />
        <link rel="preload" as="image" href="images/hero-banner-3.jpg" />
    </head>

    <body id="top">
        <header class="header">

            <div class="header-top" data-header>
                <div class="container">
                    <button class="nav-open-btn" aria-label="open menu" data-nav-toggler>
                        <span class="line line-1"></span>
                        <span class="line line-2"></span>
                        <span class="line line-3"></span>
                    </button>

                    <div class="input-wrapper">
                        <input type="search" name="search" placeholder="Search product" class="search-field" />

                        <button class="search-submit" aria-label="search">
                            <ion-icon name="search-outline" aria-hidden="true"></ion-icon>
                        </button>
                    </div>

                    <a href="#" class="logo">
                        <h3>Cosmic Beauty</h3>
                    </a>

                    <div class="header-actions">
                        <button class="header-action-btn" aria-label="user">
                            <a href="login.php"><ion-icon name="person-outline" aria-hidden="true"
                                    aria-hidden="true"></ion-icon>
                            </a>
                        </button>

                        <button class="header-action-btn" aria-label="favourite item">
                            <ion-icon name="star-outline" aria-hidden="true" aria-hidden="true"></ion-icon>

                            <span class="btn-badge">0</span>
                        </button>

                        <button class="header-action-btn" aria-label="cart item">
                            <data class="btn-text" value="0">₱820.00</data>

                            <ion-icon name="bag-handle-outline" aria-hidden="true" aria-hidden="true"></ion-icon>

                            <span class="btn-badge">0</span>
                        </button>
                    </div>

                    <nav class="navbar">
                        <ul class="navbar-list">
                            <li>
                                <a href="#home" class="navbar-link has-after">Home</a>
                            </li>
                            <li>
                                <a href="#collection" class="navbar-link has-after">Collection</a>
                            </li>
                            <li>
                                <a href="#shop" class="navbar-link has-after">Shop</a>
                            </li>
                            <li>
                                <a href="#offer" class="navbar-link has-after">Offer</a>
                            </li>
                            <li>
                                <a href="#blog" class="navbar-link has-after">Blog</a>
                            </li>
                            <li>
                                <a href="#about" class="navbar-link has-after">About</a>
                            </li>
                            <li>
                                <a href="#contact" class="navbar-link has-after">Contact</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>

        <!-- MOBILE NAVBAR  -->

        <div class="sidebar">
            <div class="mobile-navbar" data-navbar>
                <div class="wrapper">
                    <a href="#" class="logo">
                        <img src="images/logo.png" width="179" height="26" alt="Glowing" />
                    </a>

                    <button class="nav-close-btn" aria-label="close menu" data-nav-toggler>
                        <ion-icon name="close-outline" aria-hidden="true"></ion-icon>
                    </button>
                </div>

                <ul class="navbar-list">
                    <li>
                        <a href="#home" class="navbar-link" data-nav-link>Home</a>
                    </li>
                    <li>
                        <a href="#collection" class="navbar-link" data-nav-link>Collection</a>
                    </li>
                    <li>
                        <a href="#shop" class="navbar-link" data-nav-link>Shop</a>
                    </li>
                    <li>
                        <a href="#offer" class="navbar-link" data-nav-link>Offer</a>
                    </li>
                    <li>
                        <a href="#blog" class="navbar-link" data-nav-link>Blog</a>
                    </li>
                </ul>
            </div>

            <div class="overlay" data-nav-toggler data-overlay></div>
        </div>

        <main>
            <article>
                <!-- HERO  -->

                <section class="section hero" id="home" aria-label="hero" data-section>
                    <div class="container">
                        <ul class="has-scrollbar">
                            <li class="scrollbar-item">
                                <div class="hero-card has-bg-image"
                                    style="background-image: url('images/hero-banner-1.jpg')">
                                    <div class="card-content">
                                        <h1 class="h1 hero-title">
                                            Reveal The <br />
                                            Beauty of Skin
                                        </h1>

                                        <p class="hero-text">
                                            Made using clean, non-toxic
                                            ingredients, our products are
                                            designed for everyone.
                                        </p>

                                        <p class="price">Starting at ₱977.99</p>

                                        <a href="#" class="btn btn-primary">Shop
                                            Now</a>
                                    </div>
                                </div>
                            </li>

                            <li class="scrollbar-item">
                                <div class="hero-card has-bg-image"
                                    style="background-image: url('images/hero-banner-2.jpg')">
                                    <div class="card-content">
                                        <h1 class="h1 hero-title">
                                            Reveal The <br />
                                            Beauty of Skin
                                        </h1>

                                        <p class="hero-text">
                                            Made using clean, non-toxic
                                            ingredients, our products are
                                            designed for everyone.
                                        </p>

                                        <p class="price">Starting at ₱779.99</p>

                                        <a href="#" class="btn btn-primary">Shop
                                            Now</a>
                                    </div>
                                </div>
                            </li>

                            <li class="scrollbar-item">
                                <div class="hero-card has-bg-image"
                                    style="background-image: url('images/hero-banner-3.jpg');">
                                    <div class="card-content">
                                        <h1 class="h1 hero-title">
                                            Reveal The <br />
                                            Beauty of Skin
                                        </h1>

                                        <p class="hero-text">
                                            Made using clean, non-toxic
                                            ingredients, our products are
                                            designed for everyone.
                                        </p>

                                        <p class="price">Starting at ₱917.99</p>

                                        <a href="#" class="btn btn-primary">Shop
                                            Now</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </section>

                <!-- COLLECTION -->

                <section class="section collection" id="collection" aria-label="collection" data-section>
                    <div class="container">
                        <ul class="collection-list">
                            <li>
                                <div class="collection-card has-before hover:shine">
                                    <h2 class="h2 card-title">Summer
                                        Collection</h2>

                                    <p class="card-text">Starting at ₱917.99</p>

                                    <a href="#" class="btn-link">
                                        <span class="span">Shop Now</span>

                                        <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
                                    </a>

                                    <div class="has-bg-image" style="background-image: url('images/collection-1.jpg')">
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="collection-card has-before hover:shine">
                                    <h2 class="h2 card-title">What’s New?</h2>

                                    <p class="card-text">Get the glow</p>

                                    <a href="#" class="btn-link">
                                        <span class="span">Discover Now</span>

                                        <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
                                    </a>

                                    <div class="has-bg-image" style="background-image: url('images/collection-2.jpg')">
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="collection-card has-before hover:shine">
                                    <h2 class="h2 card-title">Buy 1 Get 1</h2>

                                    <p class="card-text">Starting at ₱699.99</p>

                                    <a href="#" class="btn-link">
                                        <span class="span">Discover Now</span>

                                        <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
                                    </a>

                                    <div class="has-bg-image" style="background-image: url('images/collection-3.jpg')">
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </section>

                <!-- SHOP -->

                <section class="section shop" id="shop" aria-label="shop" data-section>
                    <div class="container">
                        <div class="title-wrapper">
                            <h2 class="h2 section-title">Our Bestsellers</h2>

                            <a href="#" class="btn-link">
                                <span class="span">Shop All Products</span>

                                <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
                            </a>
                        </div>

                        <ul class="has-scrollbar">
                            <li class="scrollbar-item">
                                <div class="shop-card">
                                    <div class="card-banner img-holder" style="--width: 540; --height: 720">
                                        <img src="images/product-01.jpg" width="540" height="720" loading="lazy"
                                            alt="Facial cleanser" class="img-cover" />

                                        <span class="badge" aria-label="20% off">-20%</span>

                                        <div class="card-actions">
                                            <button class="action-btn" aria-label="add to cart">
                                                <ion-icon name="bag-handle-outline" aria-hidden="true"></ion-icon>
                                            </button>

                                            <button class="action-btn" aria-label="add to whishlist">
                                                <ion-icon name="star-outline" aria-hidden="true"></ion-icon>
                                            </button>

                                            <button class="action-btn" aria-label="compare">
                                                <ion-icon name="repeat-outline" aria-hidden="true"></ion-icon>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="card-content">
                                        <div class="price">
                                            <del class="del">₱839.00</del>

                                            <span class="span">₱829.00</span>
                                        </div>

                                        <h3>
                                            <a href="#" class="card-title">Facial
                                                cleanser</a>
                                        </h3>

                                        <div class="card-rating">
                                            <div class="rating-wrapper" aria-label="5 start rating">
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                            </div>

                                            <p class="rating-text">5170
                                                reviews</p>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="scrollbar-item">
                                <div class="shop-card">
                                    <div class="card-banner img-holder" style="--width: 540; --height: 720">
                                        <img src="images/product-02.jpg" width="540" height="720" loading="lazy"
                                            alt="Bio-shroom Rejuvenating Serum" class="img-cover" />

                                        <div class="card-actions">
                                            <button class="action-btn" aria-label="add to cart">
                                                <ion-icon name="bag-handle-outline" aria-hidden="true"></ion-icon>
                                            </button>

                                            <button class="action-btn" aria-label="add to whishlist">
                                                <ion-icon name="star-outline" aria-hidden="true"></ion-icon>
                                            </button>

                                            <button class="action-btn" aria-label="compare">
                                                <ion-icon name="repeat-outline" aria-hidden="true"></ion-icon>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="card-content">
                                        <div class="price">
                                            <span class="span">₱929.00</span>
                                        </div>

                                        <h3>
                                            <a href="#" class="card-title">Bio-shroom
                                                Rejuvenating Serum</a>
                                        </h3>

                                        <div class="card-rating">
                                            <div class="rating-wrapper" aria-label="5 start rating">
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                            </div>

                                            <p class="rating-text">5170
                                                reviews</p>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="scrollbar-item">
                                <div class="shop-card">
                                    <div class="card-banner img-holder" style="--width: 540; --height: 720">
                                        <img src="images/product-03.jpg" width="540" height="720" loading="lazy"
                                            alt="Coffee Bean Caffeine Eye Cream" class="img-cover" />

                                        <div class="card-actions">
                                            <button class="action-btn" aria-label="add to cart">
                                                <ion-icon name="bag-handle-outline" aria-hidden="true"></ion-icon>
                                            </button>

                                            <button class="action-btn" aria-label="add to whishlist">
                                                <ion-icon name="star-outline" aria-hidden="true"></ion-icon>
                                            </button>

                                            <button class="action-btn" aria-label="compare">
                                                <ion-icon name="repeat-outline" aria-hidden="true"></ion-icon>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="card-content">
                                        <div class="price">
                                            <span class="span">₱829.00</span>
                                        </div>

                                        <h3>
                                            <a href="#" class="card-title">Coffee Bean
                                                Caffeine Eye Cream</a>
                                        </h3>

                                        <div class="card-rating">
                                            <div class="rating-wrapper" aria-label="5 start rating">
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                            </div>

                                            <p class="rating-text">5170
                                                reviews</p>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="scrollbar-item">
                                <div class="shop-card">
                                    <div class="card-banner img-holder" style="--width: 540; --height: 720">
                                        <img src="images/product-04.jpg" width="540" height="720" loading="lazy"
                                            alt="Facial cleanser" class="img-cover" />

                                        <div class="card-actions">
                                            <button class="action-btn" aria-label="add to cart">
                                                <ion-icon name="bag-handle-outline" aria-hidden="true"></ion-icon>
                                            </button>

                                            <button class="action-btn" aria-label="add to whishlist">
                                                <ion-icon name="star-outline" aria-hidden="true"></ion-icon>
                                            </button>

                                            <button class="action-btn" aria-label="compare">
                                                <ion-icon name="repeat-outline" aria-hidden="true"></ion-icon>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="card-content">
                                        <div class="price">
                                            <span class="span">₱829.00</span>
                                        </div>

                                        <h3>
                                            <a href="#" class="card-title">Facial
                                                cleanser</a>
                                        </h3>

                                        <div class="card-rating">
                                            <div class="rating-wrapper" aria-label="5 start rating">
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                            </div>

                                            <p class="rating-text">5170
                                                reviews</p>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="scrollbar-item">
                                <div class="shop-card">
                                    <div class="card-banner img-holder" style="--width: 540; --height: 720">
                                        <img src="images/product-05.jpg" width="540" height="720" loading="lazy"
                                            alt="Coffee Bean Caffeine Eye Cream" class="img-cover" />

                                        <span class="badge" aria-label="20% off">-20%</span>

                                        <div class="card-actions">
                                            <button class="action-btn" aria-label="add to cart">
                                                <ion-icon name="bag-handle-outline" aria-hidden="true"></ion-icon>
                                            </button>

                                            <button class="action-btn" aria-label="add to whishlist">
                                                <ion-icon name="star-outline" aria-hidden="true"></ion-icon>
                                            </button>

                                            <button class="action-btn" aria-label="compare">
                                                <ion-icon name="repeat-outline" aria-hidden="true"></ion-icon>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="card-content">
                                        <div class="price">
                                            <del class="del">₱839.00</del>

                                            <span class="span">₱829.00</span>
                                        </div>

                                        <h3>
                                            <a href="#" class="card-title">Coffee Bean
                                                Caffeine Eye Cream</a>
                                        </h3>

                                        <div class="card-rating">
                                            <div class="rating-wrapper" aria-label="5 start rating">
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                            </div>

                                            <p class="rating-text">5170
                                                reviews</p>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="scrollbar-item">
                                <div class="shop-card">
                                    <div class="card-banner img-holder" style="--width: 540; --height: 720">
                                        <img src="images/product-06.jpg" width="540" height="720" loading="lazy"
                                            alt="Facial cleanser" class="img-cover" />

                                        <div class="card-actions">
                                            <button class="action-btn" aria-label="add to cart">
                                                <ion-icon name="bag-handle-outline" aria-hidden="true"></ion-icon>
                                            </button>

                                            <button class="action-btn" aria-label="add to whishlist">
                                                <ion-icon name="star-outline" aria-hidden="true"></ion-icon>
                                            </button>

                                            <button class="action-btn" aria-label="compare">
                                                <ion-icon name="repeat-outline" aria-hidden="true"></ion-icon>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="card-content">
                                        <div class="price">
                                            <span class="span">₱829.00</span>
                                        </div>

                                        <h3>
                                            <a href="#" class="card-title">Facial
                                                cleanser</a>
                                        </h3>

                                        <div class="card-rating">
                                            <div class="rating-wrapper" aria-label="5 start rating">
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                            </div>

                                            <p class="rating-text">5170
                                                reviews</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </section>

                <section class="section shop" id="shop" aria-label="shop" data-section>
                    <div class="container">
                        <div class="title-wrapper">
                            <h2 class="h2 section-title">Under ₱1000</h2>

                            <a href="#" class="btn-link">
                                <span class="span">Shop All Products</span>

                                <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
                            </a>
                        </div>

                        <ul class="has-scrollbar">
                            <li class="scrollbar-item">
                                <div class="shop-card">
                                    <div class="card-banner img-holder" style="--width: 540; --height: 720">
                                        <img src="images/product-07.jpg" width="540" height="720" loading="lazy"
                                            alt="Facial cleanser" class="img-cover" />

                                        <span class="badge" aria-label="20% off">-20%</span>

                                        <div class="card-actions">
                                            <button class="action-btn" aria-label="add to cart">
                                                <ion-icon name="bag-handle-outline" aria-hidden="true"></ion-icon>
                                            </button>

                                            <button class="action-btn" aria-label="add to whishlist">
                                                <ion-icon name="star-outline" aria-hidden="true"></ion-icon>
                                            </button>

                                            <button class="action-btn" aria-label="compare">
                                                <ion-icon name="repeat-outline" aria-hidden="true"></ion-icon>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="card-content">
                                        <div class="price">
                                            <del class="del">₱839.00</del>

                                            <span class="span">₱921.99</span>
                                        </div>

                                        <h3>
                                            <a href="#" class="card-title">Facial
                                                cleanser</a>
                                        </h3>

                                        <div class="card-rating">
                                            <div class="rating-wrapper" aria-label="5 start rating">
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                            </div>

                                            <p class="rating-text">5170
                                                reviews</p>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="scrollbar-item">
                                <div class="shop-card">
                                    <div class="card-banner img-holder" style="--width: 540; --height: 720">
                                        <img src="images/product-08.jpg" width="540" height="720" loading="lazy"
                                            alt="Bio-shroom Rejuvenating Serum" class="img-cover" />

                                        <div class="card-actions">
                                            <button class="action-btn" aria-label="add to cart">
                                                <ion-icon name="bag-handle-outline" aria-hidden="true"></ion-icon>
                                            </button>

                                            <button class="action-btn" aria-label="add to whishlist">
                                                <ion-icon name="star-outline" aria-hidden="true"></ion-icon>
                                            </button>

                                            <button class="action-btn" aria-label="compare">
                                                <ion-icon name="repeat-outline" aria-hidden="true"></ion-icon>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="card-content">
                                        <div class="price">
                                            <span class="span">₱921.99</span>
                                        </div>

                                        <h3>
                                            <a href="#" class="card-title">Bio-shroom
                                                Rejuvenating Serum</a>
                                        </h3>

                                        <div class="card-rating">
                                            <div class="rating-wrapper" aria-label="5 start rating">
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                            </div>

                                            <p class="rating-text">5170
                                                reviews</p>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="scrollbar-item">
                                <div class="shop-card">
                                    <div class="card-banner img-holder" style="--width: 540; --height: 720">
                                        <img src="images/product-09.jpg" width="540" height="720" loading="lazy"
                                            alt="Coffee Bean Caffeine Eye Cream" class="img-cover" />

                                        <div class="card-actions">
                                            <button class="action-btn" aria-label="add to cart">
                                                <ion-icon name="bag-handle-outline" aria-hidden="true"></ion-icon>
                                            </button>

                                            <button class="action-btn" aria-label="add to whishlist">
                                                <ion-icon name="star-outline" aria-hidden="true"></ion-icon>
                                            </button>

                                            <button class="action-btn" aria-label="compare">
                                                <ion-icon name="repeat-outline" aria-hidden="true"></ion-icon>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="card-content">
                                        <div class="price">
                                            <span class="span">₱921.99</span>
                                        </div>

                                        <h3>
                                            <a href="#" class="card-title">Coffee Bean
                                                Caffeine Eye Cream</a>
                                        </h3>

                                        <div class="card-rating">
                                            <div class="rating-wrapper" aria-label="5 start rating">
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                            </div>

                                            <p class="rating-text">5170
                                                reviews</p>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="scrollbar-item">
                                <div class="shop-card">
                                    <div class="card-banner img-holder" style="--width: 540; --height: 720">
                                        <img src="images/product-10.jpg" width="540" height="720" loading="lazy"
                                            alt="Facial cleanser" class="img-cover"/>

                                        <div class="card-actions">
                                            <button class="action-btn" aria-label="add to cart">
                                                <ion-icon name="bag-handle-outline" aria-hidden="true"></ion-icon>
                                            </button>

                                            <button class="action-btn" aria-label="add to whishlist">
                                                <ion-icon name="star-outline" aria-hidden="true"></ion-icon>
                                            </button>

                                            <button class="action-btn" aria-label="compare">
                                                <ion-icon name="repeat-outline" aria-hidden="true"></ion-icon>
                                            </button>
                                        </div>
                                    </div>


                                    <div class="card-content">
                                        <div class="price">
                                            <span class="span">₱921.99</span>
                                        </div>

                                        <h3>
                                            <a href="#" class="card-title">Facial
                                                cleanser</a>
                                        </h3>

                                        <div class="card-rating">
                                            <div class="rating-wrapper" aria-label="5 start rating">
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                            </div>

                                            <p class="rating-text">5170
                                                reviews</p>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="scrollbar-item">
                                <div class="shop-card">
                                    <div class="card-banner img-holder" style="--width: 540; --height: 720">
                                        <img src="images/product-11.jpg" width="540" height="720" loading="lazy"
                                            alt="Coffee Bean Caffeine Eye Cream" class="img-cover" />

                                        <span class="badge" aria-label="20% off">-20%</span>

                                        <div class="card-actions">
                                            <button class="action-btn" aria-label="add to cart">
                                                <ion-icon name="bag-handle-outline" aria-hidden="true"></ion-icon>
                                            </button>

                                            <button class="action-btn" aria-label="add to whishlist">
                                                <ion-icon name="star-outline" aria-hidden="true"></ion-icon>
                                            </button>

                                            <button class="action-btn" aria-label="compare">
                                                <ion-icon name="repeat-outline" aria-hidden="true"></ion-icon>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="card-content">
                                        <div class="price">
                                            <del class="del">₱839.00</del>

                                            <span class="span">₱921.99</span>
                                        </div>

                                        <h3>
                                            <a href="#" class="card-title">Coffee Bean
                                                Caffeine Eye Cream</a>
                                        </h3>

                                        <div class="card-rating">
                                            <div class="rating-wrapper" aria-label="5 start rating">
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                            </div>

                                            <p class="rating-text">5170
                                                reviews</p>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="scrollbar-item">
                                <div class="shop-card">
                                    <div class="card-banner img-holder" style="--width: 540; --height: 720">
                                        <img src="images/product-01.jpg" width="540" height="720" loading="lazy"
                                            alt="Facial cleanser" class="img-cover" />

                                        <div class="card-actions">
                                            <button class="action-btn" aria-label="add to cart">
                                                <ion-icon name="bag-handle-outline" aria-hidden="true"></ion-icon>
                                            </button>

                                            <button class="action-btn" aria-label="add to whishlist">
                                                <ion-icon name="star-outline" aria-hidden="true"></ion-icon>
                                            </button>

                                            <button class="action-btn" aria-label="compare">
                                                <ion-icon name="repeat-outline" aria-hidden="true"></ion-icon>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="card-content">
                                        <div class="price">
                                            <span class="span">₱921.99</span>
                                        </div>

                                        <h3>
                                            <a href="#" class="card-title">Facial
                                                cleanser</a>
                                        </h3>

                                        <div class="card-rating">
                                            <div class="rating-wrapper" aria-label="5 start rating">
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                                <ion-icon name="star" aria-hidden="true"></ion-icon>
                                            </div>

                                            <p class="rating-text">5170
                                                reviews</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </section>

                <!--
        - #BANNER
        -->

                <section class="section banner" aria-label="banner" data-section>
                    <div class="container">
                        <ul class="banner-list">
                            <li>
                                <div class="banner-card banner-card-1 has-before hover:shine">
                                    <p class="card-subtitle">New Collection</p>

                                    <h2 class="h2 card-title">Discover Our
                                        Autumn Skincare</h2>

                                    <a href="#" class="btn btn-secondary">Explore
                                        More</a>

                                    <div class="has-bg-image" style="background-image: url('images/banner-1.jpg');">
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="banner-card banner-card-2 has-before hover:shine">
                                    <h2 class="h2 card-title">25% off
                                        Everything</h2>

                                    <p class="card-text">
                                        Makeup with extended range in colors for
                                        every human.
                                    </p>

                                    <a href="#" class="btn btn-secondary">Shop
                                        Sale</a>

                                    <div class="has-bg-image" style="
                      background-image: url('images/banner-2.jpg');
                    "></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </section>

                <!--
        - #FEATURE
      -->

                <section class="section feature" aria-label="feature" data-section>
                    <div class="container">
                        <h2 class="h2-large section-title">Why Shop with
                            Glowing?</h2>

                        <ul class="flex-list">
                            <li class="flex-item">
                                <div class="feature-card">
                                    <img src="images/feature-1.jpg" width="204" height="236" loading="lazy"
                                        alt="Guaranteed PURE" class="card-icon" />

                                    <h3 class="h3 card-title">Guaranteed
                                        PURE</h3>

                                    <p class="card-text">
                                        All Grace formulations adhere to strict
                                        purity standards and
                                        will never contain harsh or toxic
                                        ingredients
                                    </p>
                                </div>
                            </li>

                            <li class="flex-item">
                                <div class="feature-card">
                                    <img src="images/feature-2.jpg" width="204" height="236" loading="lazy"
                                        alt="Completely Cruelty-Free" class="card-icon" />

                                    <h3 class="h3 card-title">Completely
                                        Cruelty-Free</h3>

                                    <p class="card-text">
                                        All Grace formulations adhere to strict
                                        purity standards and
                                        will never contain harsh or toxic
                                        ingredients
                                    </p>
                                </div>
                            </li>

                            <li class="flex-item">
                                <div class="feature-card">
                                    <img src="images/feature-3.jpg" width="204" height="236" loading="lazy"
                                        alt="Ingredient Sourcing" class="card-icon" />

                                    <h3 class="h3 card-title">Ingredient
                                        Sourcing</h3>

                                    <p class="card-text">
                                        All Grace formulations adhere to strict
                                        purity standards and
                                        will never contain harsh or toxic
                                        ingredients
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </section>

                <!--
        - #OFFER
      -->

                <section class="section offer" id="offer" aria-label="offer" data-section>
                    <div class="container">
                        <figure class="offer-banner">
                            <img src="images/offer-banner-1.jpg" width="305" height="408" loading="lazy"
                                alt="offer products" class="w-100" />

                            <img src="images/offer-banner-2.jpg" width="450" height="625" loading="lazy"
                                alt="offer products" class="w-100" />
                        </figure>

                        <div class="offer-content">
                            <p class="offer-subtitle">
                                <span class="span">Special Offer</span>

                                <span class="badge" aria-label="20% off">-20%</span>
                            </p>

                            <h2 class="h2-large section-title">Mountain Pine
                                Bath Oil</h2>

                            <p class="section-text">
                                Made using clean, non-toxic ingredients, our
                                products are
                                designed for everyone.
                            </p>

                            <div class="countdown">
                                <span class="time" aria-label="days">15</span>
                                <span class="time" aria-label="hours">21</span>
                                <span class="time" aria-label="minutes">46</span>
                                <span class="time" aria-label="seconds">08</span>
                            </div>

                            <a href="#" class="btn btn-primary">Get Only
                                ₱839.00</a>
                        </div>
                    </div>
                </section>

                <!--
        - #BLOG
      -->

                <section class="section blog" id="blog" aria-label="blog" data-section>
                    <div class="container">
                        <h2 class="h2-large section-title">More to Discover</h2>

                        <ul class="flex-list">
                            <li class="flex-item">
                                <div class="blog-card">
                                    <figure class="card-banner img-holder has-before hover:shine"
                                        style="--width: 700; --height: 450">
                                        <img src="images/blog-1.jpg" width="700" height="450" loading="lazy"
                                            alt="Find a Store" class="img-cover" />
                                    </figure>

                                    <h3 class="h3">
                                        <a href="#" class="card-title">Find a
                                            Store</a>
                                    </h3>

                                    <a href="#" class="btn-link">
                                        <span class="span">Our Store</span>

                                        <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>
                                    </a>
                                </div>
                            </li>

                            <li class="flex-item">
                                <div class="blog-card">
                                    <figure class="card-banner img-holder has-before hover:shine"
                                        style="--width: 700; --height: 450">
                                        <img src="images/blog-2.jpg" width="700" height="450" loading="lazy"
                                            alt="From Our Blog" class="img-cover" />
                                    </figure>

                                    <h3 class="h3">
                                        <a href="#" class="card-title">From Our
                                            Blog</a>
                                    </h3>

                                    <a href="#" class="btn-link">
                                        <span class="span">Our Store</span>

                                        <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>
                                    </a>
                                </div>
                            </li>

                            <li class="flex-item">
                                <div class="blog-card">
                                    <figure class="card-banner img-holder has-before hover:shine"
                                        style="--width: 700; --height: 450">
                                        <img src="images/blog-3.jpg" width="700" height="450" loading="lazy"
                                            alt="Our Story" class="img-cover" />
                                    </figure>

                                    <h3 class="h3">
                                        <a href="#" class="card-title">Our
                                            Story</a>
                                    </h3>

                                    <a href="#" class="btn-link">
                                        <span class="span">Our Store</span>

                                        <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </section>
            </article>
            <div class="scrollbar-item">
                <section class="about-us">
                    <div class="about-container">
                        <!-- Image Container -->
                        <div class="image-container">
                            <img src="images/Model.jpg" alt="Cosmic Beauty" class="about-image" />
                        </div>

                        <!-- Text Container -->
                        <div class="text-container" id="about">
                            <div class="text-section-1">
                                <h2>🌟 Welcome to Cosmic Beauty</h2>
                                <p>
                                    Welcome to Cosmic Beauty, where the stars align to reveal your radiance. Our
                                    collection of skincare and cosmetics is inspired by the brilliance of the cosmos,
                                    blending the mysteries of the universe with cutting-edge innovation. From celestial
                                    serums to stellar highlighters, we bring you products that will transform your
                                    beauty routine into a galactic adventure.
                                </p>
                                <p>
                                    Each product is infused with ingredients that are as rare as a shooting star,
                                    designed to illuminate your natural glow. Let Cosmic Beauty guide you to discover
                                    skincare and makeup that transcends the ordinary, helping you achieve a luminous,
                                    otherworldly allure.
                                </p>
                            </div>
                            <div class="text-section-2">
                                <p>
                                    At Cosmic Beauty, we believe your skin deserves the universe’s best. That’s why we
                                    source ingredients that mirror the wonders of the galaxy—think shimmering minerals,
                                    rejuvenating botanicals, and innovative formulations. Our skincare products are
                                    crafted to awaken your inner star and provide a glow that defies gravity.
                                </p>
                                <p>
                                    Whether you're looking to refresh, restore, or radiate, Cosmic Beauty offers
                                    solutions that are truly out of this world. Step into the realm of cosmic luxury and
                                    experience skincare that’s as boundless as the night sky.
                                </p>
                            </div>
                            <div class="text-section-3">
                                <p>
                                    Our mission is to make every moment magical. With Cosmic Beauty, your makeup becomes
                                    a constellation of possibilities. From lipsticks that dazzle like nebulae to
                                    palettes that capture the essence of the Milky Way, every product is a celebration
                                    of cosmic creativity.
                                </p>
                                <p>
                                    Explore our range of beauty essentials and unlock your star power. Cosmic Beauty
                                    invites you to embrace a universe of infinite possibilities, where your glow shines
                                    brighter than the constellations.
                                </p>

                            </div>
                        </div>
                </section>

            </div>

            <div class="scrollbar-item">
                <section class="contact-section">
                    <section class="contact-section">
                        <div class="contact-form" id="contact">
                            <h2>✨ Contact Us</h2>
                            <form action="#" method="POST">
                                <label for="name">👤 Name</label>
                                <input type="text" id="name" name="name" placeholder="Your Name" required />

                                <label for="email">📧 Email</label>
                                <input type="email" id="email" name="email" placeholder="Your Email" required />

                                <label for="message">💬 Message</label>
                                <textarea id="message" name="message" rows="5" placeholder="Your Message"
                                    required></textarea>

                                <button type="submit" class="submit-btn">Send Message</button>
                            </form>
                        </div>

                        <div class="service-info">
                            <h2>🌌 How Is Our Cosmic Service?</h2>
                            <p>
                                Your thoughts are like stardust to us. Share your cosmic insights and help us elevate
                                our intergalactic journey. Your feedback propels us toward greater experiences!
                            </p>
                            <p>
                                If you have questions, want to connect across the stars, or need support, don't hesitate
                                to reach out. We are here to guide you through the universe of possibilities.
                            </p>
                        </div>
                    </section>

            </div>
        </main>
        <footer class="footer" data-section>
            <div class="container">
                <div class="footer-top">
                    <ul class="footer-list">
                        <li>
                            <p class="footer-list-title">🌠 Company</p>
                        </li>

                        <li>
                            <p class="footer-list-text">
                                Find a location nearest you. See
                                <a href="#" class="link">Our Cosmic Stores</a>
                            </p>
                        </li>

                        <li>
                            <p class="footer-list-text bold">+639 1234 567 910</p>
                        </li>

                        <li>
                            <p class="footer-list-text">SibongaSCC@cosmicbeauty.com</p>
                        </li>
                    </ul>

                    <ul class="footer-list">
                        <li>
                            <p class="footer-list-title">✨ Useful Links</p>
                        </li>

                        <li>
                            <a href="#" class="footer-link">New Star Products</a>
                        </li>

                        <li>
                            <a href="#" class="footer-link">Galactic Best Sellers</a>
                        </li>

                        <li>
                            <a href="#" class="footer-link">Bundle & Save</a>
                        </li>

                        <li>
                            <a href="#" class="footer-link">Online Gift Star</a>
                        </li>
                    </ul>

                    <ul class="footer-list">
                        <li>
                            <p class="footer-list-title">🌌 Information</p>
                        </li>

                        <li>
                            <a href="#" class="footer-link">Start a Return</a>
                        </li>

                        <li>
                            <a href="#" class="footer-link">Contact Us Across the Stars</a>
                        </li>

                        <li>
                            <a href="#" class="footer-link">Galactic Shipping FAQ</a>
                        </li>

                        <li>
                            <a href="#" class="footer-link">Terms & Conditions of the Cosmos</a>
                        </li>

                        <li>
                            <a href="#" class="footer-link">Cosmic Privacy Policy</a>
                        </li>
                    </ul>

                    <div class="footer-list">
                        <p class="newsletter-title">🚀 Receive Galactic News</p>

                        <p class="newsletter-text">
                            Enter your email below to be the first to know about new collections and stellar product
                            launches.
                        </p>

                        <form action class="newsletter-form">
                            <input type="email" name="email_address" placeholder="Enter your email address" required
                                class="email-field" />

                            <button type="submit" class="btn btn-primary">Join the Cosmic Journey</button>
                        </form>
                    </div>
                </div>

                <div class="footer-bottom">
                    <div class="wrapper">
                        <ul class="social-list">
                            <li>
                                <a href="#" class="social-link">
                                    <ion-icon name="logo-twitter"></ion-icon>
                                </a>
                            </li>

                            <li>
                                <a href="#" class="social-link">
                                    <ion-icon name="logo-facebook"></ion-icon>
                                </a>
                            </li>

                            <li>
                                <a href="https://instagram.com/nizar_masadeh" class="social-link">
                                    <ion-icon name="logo-instagram"></ion-icon>
                                </a>
                            </li>

                            <li>
                                <a href="#" class="social-link">
                                    <ion-icon name="logo-youtube"></ion-icon>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <a href="#home" class="logo">
                        BeautyCosmic
                    </a>

                    <img src="images/pay.png" width="313" height="28" alt="available all payment method"
                        class="w-100" />
                </div>
            </div>
        </footer>



        <a href="#top" class="back-top-btn" aria-label="back to top" data-back-top-btn>
            <ion-icon name="arrow-up" aria-hidden="true"></ion-icon>
        </a>


        <script src="js/script.js" defer></script>
        <!--
    - ionicon link
  -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </body>

</html>
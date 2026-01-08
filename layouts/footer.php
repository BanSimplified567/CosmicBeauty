<!-- FOOTER -->
<footer class="cosmic-gradient text-white py-12">
  <div class="container mx-auto px-4">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
      <!-- Company Info -->
      <div>
        <h3 class="text-lg font-bold mb-4 flex items-center">
          <i class="fas fa-building mr-2"></i> Company
        </h3>
        <p class="mb-4 text-slate-300">
          Find a location nearest you. See
          <a href="stores.php" class="text-purple-300 hover:text-white transition-colors duration-300">Our Cosmic Stores</a>
        </p>
        <p class="font-bold mb-2">+639 1234 567 910</p>
        <p class="text-slate-300">SibongaSCC@cosmicbeauty.com</p>
      </div>

      <!-- Useful Links -->
      <div>
        <h3 class="text-lg font-bold mb-4 flex items-center">
          <i class="fas fa-link mr-2"></i> Useful Links
        </h3>
        <ul class="space-y-2">
          <li><a href="shop.php?new=true" class="text-slate-300 hover:text-white transition-colors duration-300">New Star Products</a></li>
          <li><a href="shop.php?bestsellers=true" class="text-slate-300 hover:text-white transition-colors duration-300">Galactic Best Sellers</a></li>
          <li><a href="shop.php?bundles=true" class="text-slate-300 hover:text-white transition-colors duration-300">Bundle & Save</a></li>
          <li><a href="gifts.php" class="text-slate-300 hover:text-white transition-colors duration-300">Online Gift Star</a></li>
        </ul>
      </div>

      <!-- Information -->
      <div>
        <h3 class="text-lg font-bold mb-4 flex items-center">
          <i class="fas fa-info-circle mr-2"></i> Information
        </h3>
        <ul class="space-y-2">
          <li><a href="returns.php" class="text-slate-300 hover:text-white transition-colors duration-300">Start a Return</a></li>
          <li><a href="contact.php" class="text-slate-300 hover:text-white transition-colors duration-300">Contact Us Across the Stars</a></li>
          <li><a href="shipping.php" class="text-slate-300 hover:text-white transition-colors duration-300">Galactic Shipping FAQ</a></li>
          <li><a href="terms.php" class="text-slate-300 hover:text-white transition-colors duration-300">Terms & Conditions</a></li>
          <li><a href="privacy.php" class="text-slate-300 hover:text-white transition-colors duration-300">Privacy Policy</a></li>
        </ul>
      </div>

      <!-- Newsletter -->
      <div>
        <h3 class="text-lg font-bold mb-4 flex items-center">
          <i class="fas fa-rocket mr-2"></i> Receive Galactic News
        </h3>
        <p class="text-slate-300 mb-4">
          Enter your email below to be the first to know about new collections and stellar product launches.
        </p>
        <form id="footerNewsletterForm" class="space-y-3">
          <input type="email"
            placeholder="Enter your email address"
            required
            class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-slate-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" />
          <button type="submit"
            class="w-full py-3 px-4 bg-gradient-to-r from-purple-600 to-pink-500 text-white font-semibold rounded-lg hover:shadow-lg transform hover:-translate-y-1 transition-all duration-300">
            Join the Cosmic Journey
          </button>
        </form>
      </div>
    </div>

    <!-- Footer Bottom -->
    <div class="border-t border-white/20 pt-8">
      <div class="flex flex-col md:flex-row justify-between items-center">
        <!-- Social Links -->
        <div class="flex space-x-4 mb-4 md:mb-0">
          <a href="https://x.com/JBringcola" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-purple-500 transition-colors duration-300">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="https://www.facebook.com/his.bannie" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-blue-600 transition-colors duration-300">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="https://www.instagram.com/his.bannie" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-pink-600 transition-colors duration-300">
            <i class="fab fa-instagram"></i>
          </a>
          <a href="https://www.youtube.com/@KnownAsBanBan" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-red-600 transition-colors duration-300">
            <i class="fab fa-youtube"></i>
          </a>
        </div>

        <!-- Logo -->
        <a href="index.php" class="text-2xl font-bold gradient-text mb-4 md:mb-0">
          BeautyCosmic
        </a>

        <!-- Payment Methods -->
        <div class="flex items-center space-x-2">
          <i class="fab fa-cc-visa text-2xl text-white"></i>
          <i class="fab fa-cc-mastercard text-2xl text-white"></i>
          <i class="fab fa-cc-paypal text-2xl text-white"></i>
          <i class="fab fa-cc-amex text-2xl text-white"></i>
        </div>
      </div>

      <!-- Copyright -->
      <div class="text-center mt-6">
        <p class="text-slate-400 text-sm">
          &copy; <?php echo date('Y'); ?> Cosmic Beauty. All rights reserved. |
          <a href="sitemap.php" class="text-slate-300 hover:text-white">Sitemap</a>
        </p>
      </div>
    </div>
  </div>
</footer>

<!-- Back to Top Button -->
<a href="#top"
  class="fixed bottom-6 right-6 w-12 h-12 bg-gradient-to-r from-purple-600 to-pink-500 text-white rounded-full flex items-center justify-center shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 z-40"
  id="backToTop">
  <i class="fas fa-arrow-up"></i>
</a>

<script>
  // Newsletter form submission
  document.getElementById('footerNewsletterForm').addEventListener('submit', function(e) {
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

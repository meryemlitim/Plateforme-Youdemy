 <!-- Navbar Start -->
 <div class="container mx-auto p-4">
        <nav class="flex items-center justify-between bg-white py-3 px-5 shadow-md">
            <a href="index.html" class="flex items-center text-primary">
                <h1 class="text-4xl font-extrabold uppercase text-blue-600 flex items-center space-x-3">
                    <i class="fas fa-book-reader text-5xl"></i>
                    <span>Youdemy</span>
                </h1>
            </a>
            
            <button class="lg:hidden text-gray-500" id="menuToggle">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
            <div id="navbarCollapse" class="hidden lg:flex space-x-6">
                <a href="index.html" class="text-gray-500 font-extrabold hover:text-blue-600">Home</a>
                <a href="about.html" class="text-gray-500 font-extrabold hover:text-blue-600">About</a>
                <a href="course.html" class="text-gray-500 font-extrabold hover:text-blue-600">Courses</a>
                <a href="contact.html" class="text-gray-500 font-extrabold hover:text-blue-600">Contact</a>
            </div>
            <a href="sign_up.php" class="hidden lg:block bg-blue-600 text-white py-2 px-4 rounded">SIGN UP</a>
        </nav>
    </div>
    <!-- Navbar End -->
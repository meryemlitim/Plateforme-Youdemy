<nav id="sidebar" class="lg:min-w-[250px] w-max max-lg:min-w-8">
    <div id="sidebar-collapse-menu"
        class=" bg-white shadow-lg h-screen fixed top-0 left-0 overflow-auto z-[99] lg:min-w-[250px] lg:w-max max-lg:w-0 max-lg:invisible transition-all duration-500">
        <div class="pt-8 pb-2 px-6 sticky top-0 bg-white min-h-[80px] z-[100]">
            <a href="index.html" class="flex items-center text-primary">
                <h1 class="text-2xl font-extrabold uppercase text-blue-600 flex items-center space-x-2"> <!-- Adjusted text size and spacing -->
                    <i class="fas fa-book-reader text-5xl"></i> <!-- Adjusted icon size -->
                    <span>Youdemy</span>
                </h1>
            </a>
        </div>





        <div class="py-6 px-6">
            <ul class="space-y-2">
                <li>
                    <button id="dashboardBtn"
                        class="menu-item text-gray-800 text-sm w-full flex items-center cursor-pointer  hover:bg-blue-100 rounded-md px-3 py-3 transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-[18px] h-[18px] mr-4"
                            viewBox="0 0 24 24">
                            <path
                                d="M19.56 23.253H4.44a4.051 4.051 0 0 1-4.05-4.05v-9.115c0-1.317.648-2.56 1.728-3.315l7.56-5.292a4.062 4.062 0 0 1 4.644 0l7.56 5.292a4.056 4.056 0 0 1 1.728 3.315v9.115a4.051 4.051 0 0 1-4.05 4.05zM12 2.366a2.45 2.45 0 0 0-1.393.443l-7.56 5.292a2.433 2.433 0 0 0-1.037 1.987v9.115c0 1.34 1.09 2.43 2.43 2.43h15.12c1.34 0 2.43-1.09 2.43-2.43v-9.115c0-.788-.389-1.533-1.037-1.987l-7.56-5.292A2.438 2.438 0 0 0 12 2.377z"
                                data-original="#000000" />
                            <path
                                d="M16.32 23.253H7.68a.816.816 0 0 1-.81-.81v-5.4c0-2.83 2.3-5.13 5.13-5.13s5.13 2.3 5.13 5.13v5.4c0 .443-.367.81-.81.81zm-7.83-1.62h7.02v-4.59c0-1.933-1.577-3.51-3.51-3.51s-3.51 1.577-3.51 3.51z"
                                data-original="#000000" />
                        </svg>
                        <span>Dashboard</span>
                    </button>
                </li>
                <li>
                    <button id="GameBtn"
                        class="menu-item text-gray-800 text-sm w-full flex items-center cursor-pointer hover:bg-blue-100 rounded-md px-3 py-3 transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-[18px] h-[18px] mr-4"
                            viewBox="0 0 60.123 60.123">
                            <path
                                d="M57.124 51.893H16.92a3 3 0 1 1 0-6h40.203a3 3 0 0 1 .001 6zm0-18.831H16.92a3 3 0 1 1 0-6h40.203a3 3 0 0 1 .001 6zm0-18.831H16.92a3 3 0 1 1 0-6h40.203a3 3 0 0 1 .001 6z"
                                data-original="#000000" />
                            <circle cx="4.029" cy="11.463" r="4.029" data-original="#000000" />
                            <circle cx="4.029" cy="30.062" r="4.029" data-original="#000000" />
                            <circle cx="4.029" cy="48.661" r="4.029" data-original="#000000" />
                        </svg>
                        <span>teachers management</span>
                    </button>
                </li>
                <li>
                    <button id="userBtn"
                        class="menu-item text-gray-800 text-sm flex items-center cursor-pointer hover:bg-blue-100 rounded-md px-3 py-3 transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-[18px] h-[18px] mr-4"
                            viewBox="0 0 64 64">
                            <path
                                d="M16.4 29.594a2.08 2.08 0 0 1 2.08-2.08h31.2a2.08 2.08 0 1 1 0 4.16h-31.2a2.08 2.08 0 0 1-2.08-2.08zm0 12.48a2.08 2.08 0 0 1 2.08-2.08h12.48a2.08 2.08 0 1 1 0 4.16H18.48a2.08 2.08 0 0 1-2.08-2.08z"
                                data-original="#000000" />
                            <path fill-rule="evenodd"
                                d="M.8 18.154c0-8.041 6.519-14.56 14.56-14.56v-1.04a2.08 2.08 0 1 1 4.16 0v1.04h10.4v-1.04a2.08 2.08 0 1 1 4.16 0v1.04h10.4v-1.04a2.08 2.08 0 1 1 4.16 0v1.04c8.041 0 14.56 6.519 14.56 14.56v30.16c0 8.041-6.519 14.56-14.56 14.56H15.36C7.319 62.874.8 56.355.8 48.314zm33.28-10.4h10.4v1.04a2.08 2.08 0 1 0 4.16 0v-1.04c5.744 0 10.4 4.656 10.4 10.4v30.16c0 5.744-4.656 10.4-10.4 10.4H15.36c-5.744 0-10.4-4.656-10.4-10.4v-30.16c0-5.744 4.656-10.4 10.4-10.4v1.04a2.08 2.08 0 1 0 4.16 0v-1.04h10.4v1.04a2.08 2.08 0 1 0 4.16 0z"
                                clip-rule="evenodd" data-original="#000000" />
                        </svg>
                        <span>students management</span>
                    </button>
                </li>
                <li>
                    <a href="javascript:void(0)"
                        class="menu-item text-gray-800 text-sm flex items-center cursor-pointer hover:bg-blue-100 rounded-md px-3 py-3 transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-[18px] h-[18px] mr-4"
                            viewBox="0 0 682.667 682.667">
                            <defs>
                                <clipPath id="a" clipPathUnits="userSpaceOnUse">
                                    <path d="M0 512h512V0H0Z" data-original="#000000" />
                                </clipPath>
                            </defs>
                            <g fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
                                stroke-width="30" clip-path="url(#a)" transform="matrix(1.33333 0 0 -1.33333 0 682.667)">
                                <path
                                    d="M368 170.3V45c0-16.57-13.43-30-30-30H45c-16.57 0-30 13.43-30 30v422c0 16.571 13.43 30 30 30h293c16.57 0 30-13.429 30-30V261.26"
                                    data-original="#000000" />
                                <path
                                    d="m287.253 180.508 159.099 159.099c5.858 5.858 15.355 5.858 21.213 0l25.042-25.041c5.858-5.859 5.858-15.356 0-21.214L332.508 135.253l-84.853-39.599ZM411.703 304.958l45.255-45.255M80 400h224M80 320h176M80 240h128"
                                    data-original="#000000" />
                            </g>
                        </svg>
                        <span>courses management </span>
                    </a>
                </li>
                <!-- ------------------- -->
                <li>
                    <button id="tagBtn"
                        class="menu-item text-gray-800 text-sm w-full flex items-center cursor-pointer hover:bg-blue-100 rounded-md px-3 py-3 transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-[18px] h-[18px] mr-4"
                            viewBox="0 0 60.123 60.123">
                            <path
                                d="M57.124 51.893H16.92a3 3 0 1 1 0-6h40.203a3 3 0 0 1 .001 6zm0-18.831H16.92a3 3 0 1 1 0-6h40.203a3 3 0 0 1 .001 6zm0-18.831H16.92a3 3 0 1 1 0-6h40.203a3 3 0 0 1 .001 6z"
                                data-original="#000000" />
                            <circle cx="4.029" cy="11.463" r="4.029" data-original="#000000" />
                            <circle cx="4.029" cy="30.062" r="4.029" data-original="#000000" />
                            <circle cx="4.029" cy="48.661" r="4.029" data-original="#000000" />
                        </svg>
                        <span>Tags management </span>
                    </button>
                </li>
                <!-- ------------------- -->
                <!-- ------------------- -->
                <li>
                    <button id="categoryBtn"
                        class="menu-item text-gray-800 text-sm w-full flex items-center cursor-pointer hover:bg-blue-100 rounded-md px-3 py-3 transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-[18px] h-[18px] mr-4"
                            viewBox="0 0 60.123 60.123">
                            <path
                                d="M57.124 51.893H16.92a3 3 0 1 1 0-6h40.203a3 3 0 0 1 .001 6zm0-18.831H16.92a3 3 0 1 1 0-6h40.203a3 3 0 0 1 .001 6zm0-18.831H16.92a3 3 0 1 1 0-6h40.203a3 3 0 0 1 .001 6z"
                                data-original="#000000" />
                            <circle cx="4.029" cy="11.463" r="4.029" data-original="#000000" />
                            <circle cx="4.029" cy="30.062" r="4.029" data-original="#000000" />
                            <circle cx="4.029" cy="48.661" r="4.029" data-original="#000000" />
                        </svg>
                        <span>Categories management </span>
                    </button>
                </li>
                <!-- ------------------- -->


            </ul>

        </div>
    </div>
</nav>
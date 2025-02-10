<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/peta-logo.png') }}" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap");

        body {
            font-family: "Poppins", sans-serif;
        }

        .img {
            font-family: "Poppins", sans-serif;
        }

        .font-sub {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .bg-blackish {
            background-color: #111;
            /* Slightly lighter than pure black for better contrast */
        }

        .text-redish {
            color: #d00;
            /* Slightly toned down red */
        }

        #changing-text {
            transition: opacity 1s ease-in-out;
        }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'peta-red': '#be2c13',
                    },
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif'],
                        'sub': ['Verdana', 'Geneva', 'Tahoma', 'sans-serif'],
                    },
                },
            },
        }
    </script>
</head>

<body class="bg-gray-100">
    <div id="loading-screen"
        style="
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.8);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
      ">
        <div
            style="
          width: 50px;
          height: 50px;
          border-radius: 50%;
          border: 5px solid red;
          border-top-color: white;
          animation: spin 1s linear infinite;
        ">
        </div>
    </div>
    <!-- Header -->

    <!-- Breaking News -->

    <!-- Main Content -->

        @yield('content')


    <!-- Footer -->


    <script>
        const menuBtn = document.getElementById("menuBtn");
        const mobileMenu = document.getElementById("mobileMenu");
        const hamburgerIcon = document.getElementById("hamburgerIcon");
        const closeIcon = document.getElementById("closeIcon");

        menuBtn.addEventListener("click", () => {
            mobileMenu.classList.toggle("hidden");
            hamburgerIcon.classList.toggle("hidden");
            closeIcon.classList.toggle("hidden");
        });
    </script>
    <script>
        window.addEventListener("load", (event) => {
            const loadingScreen = document.getElementById("loading-screen");
            loadingScreen.style.display = "none";
        });
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            offset: 100,
            once: true,
        });
    </script>

</body>

</html>

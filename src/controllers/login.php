<?php 
include './components/header.php';
?>

<body>
    <div class="flex w-full items-center flex-col md:flex-row overflow-auto" style="height: 100vh;">
        <div class="hidden w-full h-full bg-cover md:block" style="background-image: url(../images/login_cover.png)">
        </div>
        <div class="w-full flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                <img class=" w-60 h-auto mr-2" src="../images/logo.png" alt="logo">
            </a>
            <div class="bg-white rounded-lg w-full">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1
                        class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Login to your account to continue
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="#" method="post" id="signup-form">
                        <div>
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="email" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5"
                                placeholder="name@company.com" required="">
                            <p id="email_incorrect" class="mt-2 text-xs text-red-600 dark:text-red-400"><span
                                    class="font-medium">Oops!</span> The email you have typed is incorrect. Please try
                                again.</p>
                        </div>
                        <div>
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>

                            <div
                                class="flex items-center justify-between bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 w-full p-2.5">
                                <input type="password" name="password" id="password" placeholder="••••••••"
                                    class="border-transparent bg-transparent border-opacity-0 focus:outline-none focus:ring-0 p-0 w-full required"
                                    style="border: none; outline: none;">
                                <i class="pass-visibilty fa-solid fa-eye text-lg cursor-pointer text-red-600"></i>
                            </div>


                            <p id="password_incorrect" class="mt-2 text-xs text-red-600 dark:text-red-400"><span
                                    class="font-medium">Oh, snapp!</span> The password you have typed is incorrect.
                                Please try again..</p>
                        </div>
                        <button type="submit" name="submit"
                            class="w-full text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Login</button>
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Don't have an account? <a href="./signup.php"
                                class="font-medium text-red-600 hover:underline dark:text-red-500">Signup here</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
        <div class="block w-full h-full bg-cover md:hidden">
            <img src="../images/login_cover.png" alt="" srcset="">
        </div>
    </div>

    <script>
    const password = document.getElementById('password');
    const passVisibilty = document.querySelector('.pass-visibilty');

    passVisibilty.addEventListener('click', function() {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
    </script>
</body>

</html>
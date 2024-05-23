<?php 
include './components/header.php';
?>

<body>
    <div class="flex w-full items-center flex-col md:flex-row overflow-auto" style="height: 100vh;" id="mainContent">
        <div class="hidden w-full h-full bg-cover md:block" style="background-image: url(../images/login_cover.png)">
        </div>
        <div class="w-full flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                <img class=" w-60 h-auto mr-2" src="../images/logo.png" alt="logo">
            </a>
            <div class="bg-white rounded-lg w-full px-0 md:px-8">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1
                        class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Login to your account to continue
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="#" method="post" id="login-form">
                        <div>
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="email" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5"
                                placeholder="name@company.com" required="">
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
                            <p id="credentials_incorrect" class="hidden mt-2 text-xs text-red-600 dark:text-red-400">
                                <span class="font-medium">Oh, snapp!</span> You have typed in the wrong email or
                                password. Please try again.
                            </p>
                            <p id="account_not_found" class="hidden mt-2 text-xs text-red-600 dark:text-red-400"><span
                                    class="font-medium">Hmmm,</span> seems like you haven't signed up for an account
                                yet. Please sign up first to login.</p>
                        </div>
                        <button type="submit" name="submit"
                            class="w-full text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Login
                            to your account</button>
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
    <div id="spinner" class="hidden items-center justify-center w-full overflow-hidden">
        <div role="status" class="absolute -translate-x-1/2 -translate-y-1/2 top-2/4 left-1/2">
            <svg aria-hidden="true" class="w-20 h-20 text-gray-200 animate-spin dark:text-gray-600 fill-red-600"
                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                    fill="currentColor" />
                <path
                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                    fill="currentFill" />
            </svg>
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
    $(document).ready(function() {
        $('#login-form').submit(function(event) {
            event.preventDefault();

            var email = $('#email').val();
            var password = $('#password').val();

            $.ajax({
                url: './ajax/login_handler.php',
                type: 'POST',
                data: {
                    email: email,
                    password: password
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        document.getElementById('spinner').classList.remove('hidden');
                        document.getElementById('spinner').classList.add('flex');

                        document.getElementById('mainContent').classList.add('opacity-20');
                        setTimeout(function() {
                            window.location.href = 'home.php';
                        }, 3000);
                    } else {
                        if (response.error === 'account_not_found') {
                            $('#account_not_found').removeClass('hidden');
                            $('#credentials_incorrect').addClass('hidden');
                        } else if (response.error === 'credentials_incorrect') {
                            $('#credentials_incorrect').removeClass('hidden');
                            $('#account_not_found').addClass('hidden');
                        } else {
                            alert('Error: ' + response.message);
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + status + ' ' + error);
                    alert('AJAX Error: ' + status + ' ' + error);
                }
            });
        });
    });


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
{{-- filepath: c:\ALaravel\eksul\resources\views\auth\login.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - SMK Telkom Banjarbaru</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        @keyframes slideIn {
            from { opacity: 0; transform: translateX(-30px); }
            to { opacity: 1; transform: translateX(0); }
        }
        .slide-in {
            animation: slideIn 0.6s ease-out;
        }
        .input-focus:focus {
            border-color: #dc2626;
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
            outline: none;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-red-600 via-red-700 to-red-900 p-4">
    <!-- Decorative Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-20 w-72 h-72 bg-white opacity-5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 right-20 w-96 h-96 bg-white opacity-5 rounded-full blur-3xl"></div>
    </div>

    <div class="bg-white rounded-3xl shadow-2xl flex w-full max-w-6xl h-auto lg:h-[700px] overflow-hidden relative z-10 slide-in">
        <!-- Left Section - Form -->
        <div class="w-full lg:w-1/2 p-8 lg:p-12 flex flex-col justify-center">
            <!-- Logo -->
            <div class="flex justify-center mb-8">
                <img src="{{ asset('auth/logo.webp') }}" alt="SMK Telkom Banjarbaru" class="w-64 lg:w-80" />
            </div>

            <!-- Welcome Text -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Selamat Datang!</h1>
                <p class="text-gray-600">Masuk ke akun Anda untuk melanjutkan</p>
            </div>

            <!-- Error Messages -->
            @if($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-lg">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-red-500 mt-0.5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <ul class="text-sm text-red-700">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('login.submit') }}" class="space-y-5">
                @csrf
                
                <!-- Username Input -->
                <div class="relative group">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                    <input 
                        type="text" 
                        name="username" 
                        placeholder="Masukkan username Anda" 
                        class="w-full border-2 border-gray-300 rounded-xl p-3.5 pl-4 pr-12 transition duration-200 input-focus" 
                        required 
                        value="{{ old('username') }}" 
                    />
                    <img 
                        src="{{ asset('auth/mdi_user.webp') }}" 
                        alt="icon user" 
                        class="w-6 h-6 absolute right-4 top-[42px] opacity-50 group-hover:opacity-100 transition-opacity" 
                    />
                </div>

                <!-- Password Input -->
                <div class="relative group">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input 
                        id="password" 
                        name="password" 
                        type="password" 
                        placeholder="Masukkan password Anda" 
                        class="w-full border-2 border-gray-300 rounded-xl p-3.5 pl-4 pr-12 transition duration-200 input-focus" 
                        required 
                    />
                    <img 
                        id="togglePassword" 
                        src="{{ asset('auth/basil_eye-closed-solid.webp') }}" 
                        alt="toggle password" 
                        class="w-6 h-6 absolute right-4 top-[42px] cursor-pointer opacity-50 hover:opacity-100 transition-opacity" 
                    />
                </div>

                <!-- Login Button -->
                <div class="pt-4">
                    <button 
                        type="submit"
                        class="w-full bg-gradient-to-r from-red-600 to-red-700 text-white font-semibold py-3.5 rounded-xl hover:from-red-700 hover:to-red-800 transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
                    >
                        MASUK
                    </button>
                </div>
            </form>
        </div>

        <!-- Right Section - Image -->
        <div class="hidden lg:flex w-1/2 bg-white items-center justify-center p-12">
            <!-- Student Image -->
            <img 
                src="{{ asset('auth/murid.webp') }}" 
                alt="Siswa SMK Telkom" 
                class="w-full max-w-md"
            />
        </div>
    </div>

    <script>
        const pw = document.getElementById("password");
        const toggle = document.getElementById("togglePassword");

        toggle.addEventListener("click", () => {
            if (pw.type === "password") {
                pw.type = "text";
                toggle.src = "{{ asset('auth/vector.webp') }}"; 
            } else {
                pw.type = "password";
                toggle.src = "{{ asset('auth/basil_eye-closed-solid.webp') }}"; 
            }
        });
    </script>
</body>
</html>
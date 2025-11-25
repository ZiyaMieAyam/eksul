{{-- filepath: c:\ALaravel\eksul\resources\views\auth\login.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - SMK Telkom Banjarbaru</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-red-500 to-red-800">
    <div class="bg-white rounded-2xl shadow-2xl flex w-[1000px] h-[650px] overflow-hidden border border-gray-200"> <!-- Ubah ukuran di sini -->
        <div class="w-1/2 p-10 flex flex-col justify-center">
            <div class="flex justify-center mb-14">
                <img src="{{ asset('auth/logo.webp') }}" alt="SMK Telkom Banjarbaru" class="w-90" />
            </div>
            @if($errors->any())
                <div class="mb-4">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li class="text-red-500">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('login.submit') }}">
                @csrf
                <div class="mb-4 relative">
                    <input type="text" name="username" placeholder="username" class="w-full border border-black rounded-xl p-3 pl-2 pr-10" required value="{{ old('username') }}" />
                    <img src="mdi_user.webp" alt="icon user" class="w-7 h-7 absolute right-2.5 top-1/2 -translate-y-1/2 cursor-pointer select-none" />
                </div>
                <div class="mb-2 relative">
                    <input id="password" name="password" type="password" placeholder="password" class="w-full border border-black rounded-xl p-3 pl-2 pr-10" required />
                    <img id="togglePassword" src="basil_eye-closed-solid.webp" alt="icon password" class="w-7 h-4.5 absolute right-2.5 top-1/2 -translate-y-1/2 cursor-pointer select-none" />
                </div>
                <button class="w-1/3 mx-auto bg-red-600 text-white font-semibold py-2 rounded-xl hover:bg-red-700 transition">LOGIN</button>
                
            </form>
        </div>
        <div class="w-1/3 mx-auto flex items-center justify-center bg-white p-6">
            <img src="murid.webp" alt="Siswa SMK Telkom" />
        </div>
    </div>
    <script>
        const pw = document.getElementById("password");
        const toggle = document.getElementById("togglePassword");

        toggle.addEventListener("click", () => {
            if (pw.type === "password") {
                pw.type = "text";
                toggle.src = "Vector.webp"; 
            } else {
                pw.type = "password";
                toggle.src = "basil_eye-closed-solid.webp"; 
            }
        });
    </script>
</body>
</html>
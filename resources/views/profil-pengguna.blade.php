@php
    $user = Auth::user();
    $profile = $user->profile ?? $user->profile()->firstOrCreate([]);
    $avatarUrl = $profile->avatar_url ? (Str::startsWith($profile->avatar_url, 'http') ? $profile->avatar_url : asset('storage/' . $profile->avatar_url)) : 'data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="%23cbd5e1"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>';

    $userPhone = $user->phone;
    $selectedCode = '+62';
    $displayPhone = $userPhone;

    if ($userPhone) {
        foreach (['+62', '+60', '+65', '+673', '+66', '+63'] as $code) {
            if (str_starts_with($userPhone, $code)) {
                $selectedCode = $code;
                $displayPhone = substr($userPhone, strlen($code));
                break;
            }
        }
        if (str_starts_with($userPhone, '62') && !str_starts_with($userPhone, '+')) {
            $selectedCode = '+62';
            $displayPhone = substr($userPhone, 2);
        }
    }

    $activities = $user->activities()->orderBy('created_at', 'desc')->take(5)->get();
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna | Setaman Bogor</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logosetaman.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <!-- Tailwind CSS CDN -->
    
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    <x-navbar />

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-12 grow">
        
        <!-- Header Profil -->
        <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b-4 border-gray-900 pb-2">
            <h1 class="text-3xl font-bold text-gray-900 uppercase tracking-wide">
                Profil Pengguna
            </h1>
            <a href="{{ route('profile.orders') }}" class="inline-flex items-center gap-2 bg-brand hover:bg-brand-dark text-white font-bold py-2.5 px-5 rounded-xl transition text-sm uppercase tracking-wider shadow-sm">
                <i class="fas fa-shopping-bag"></i> Riwayat Pesanan Saya
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-600 px-4 py-3 rounded-md mb-6 text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-50 text-red-500 p-4 rounded-md text-sm mb-6">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- Kolom Kiri: Kartu Identitas -->
            <div class="lg:w-1/3">
                <div class="bg-white border border-gray-200 p-6 lg:p-8 rounded-xl shadow-sm">
                    
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        
                        <!-- Avatar Preview & Input -->
                        <div id="avatar-container" class="w-full aspect-square bg-gray-100 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center mb-8 relative group cursor-pointer hover:bg-gray-50 transition overflow-hidden">
                            <img id="avatar-preview" src="{{ $avatarUrl }}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                                <div class="text-center text-white">
                                    <i class="fas fa-camera text-3xl mb-2"></i>
                                    <p class="text-xs font-bold uppercase tracking-widest border border-white px-3 py-1 rounded-sm bg-transparent">Ubah Avatar</p>
                                </div>
                            </div>
                            <input type="file" name="avatar" id="avatar-input" class="hidden" accept="image/*">
                        </div>

                        <!-- Info User -->
                        <div>
                            <label class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mb-1 block">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ Auth::user()->name }}" class="w-full border-b border-gray-300 py-2 focus:outline-none focus:border-brand font-bold text-gray-900" required>
                        </div>
                        <div>
                            <label class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mb-1 block">Alamat Email</label>
                            <input type="email" value="{{ Auth::user()->email }}" class="w-full border-b border-gray-300 py-2 text-gray-500 bg-gray-50 cursor-not-allowed" disabled>
                        </div>
                        <div>
                            <label class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mb-1 block">Nomor WhatsApp</label>
                            <div class="flex gap-2">
                                <select name="country_code" class="border-b border-gray-300 py-2 focus:outline-none focus:border-brand bg-white text-sm font-semibold">
                                    <option value="+62" {{ $selectedCode == '+62' ? 'selected' : '' }}>🇮🇩 +62</option>
                                    <option value="+60" {{ $selectedCode == '+60' ? 'selected' : '' }}>🇲🇾 +60</option>
                                    <option value="+65" {{ $selectedCode == '+65' ? 'selected' : '' }}>🇸🇬 +65</option>
                                    <option value="+673" {{ $selectedCode == '+673' ? 'selected' : '' }}>🇧🇳 +673</option>
                                    <option value="+66" {{ $selectedCode == '+66' ? 'selected' : '' }}>🇹🇭 +66</option>
                                    <option value="+63" {{ $selectedCode == '+63' ? 'selected' : '' }}>🇵🇭 +63</option>
                                </select>
                                <input type="tel" name="phone" value="{{ $displayPhone }}" class="grow border-b border-gray-300 py-2 focus:outline-none focus:border-brand text-gray-700">
                            </div>
                        </div>
                        <button type="submit" class="w-full mt-4 bg-brand hover:bg-brand-dark text-white font-bold py-3 px-4 rounded-md transition uppercase text-xs tracking-wider shadow-sm">
                            Simpan Perubahan Profil
                        </button>
                    </form>

                </div>
            </div>

            <!-- Kolom Kanan: Panel Info & Pengaturan -->
            <div class="lg:w-2/3 flex flex-col gap-6">
                
                <!-- Aktivitas Terakhir -->
                <div class="bg-white border border-gray-200 p-6 lg:p-8 rounded-xl shadow-sm">
                    <div class="flex justify-between items-center mb-6 border-b border-gray-100 pb-4">
                        <h3 class="text-lg font-bold text-gray-900 uppercase tracking-wide">Aktivitas Terakhir</h3>
                        <a href="javascript:void(0)" class="text-xs font-bold text-gray-500 border-b border-gray-500 hover:text-brand hover:border-brand transition pb-0.5 uppercase tracking-wider">Lihat Semua</a>
                    </div>
                    
                    <div class="space-y-0">
                        @forelse ($activities as $activity)
                            <div class="flex justify-between items-center py-4 border-b border-gray-100 hover:bg-gray-50 transition px-2 rounded-md group">
                                <div>
                                    <h4 class="font-bold text-gray-800 text-sm mb-1">{{ $activity->activity }}</h4>
                                    <p class="text-xs text-gray-500">{{ $activity->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 text-gray-400 text-sm">
                                Belum ada aktivitas terbaru.
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Row: Pengaturan & Ganti Password -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- Ganti Password -->
                    <div class="bg-white border border-gray-200 p-6 lg:p-8 rounded-xl shadow-sm flex flex-col">
                        <h3 class="text-lg font-bold text-gray-900 uppercase tracking-wide mb-6">Ganti Password</h3>
                        <form action="{{ route('profile.password') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mb-1 block">Password Lama</label>
                                <div class="relative">
                                    <input type="password" name="current_password" id="current_password" class="w-full border border-gray-300 rounded-md px-3 pr-10 py-2 text-sm focus:outline-none focus:border-brand" required>
                                    <button type="button" onclick="togglePasswordVisibility('current_password', this)" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-brand focus:outline-none">
                                        <i class="far fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div>
                                <label class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mb-1 block">Password Baru</label>
                                <div class="relative">
                                    <input type="password" name="password" id="password" class="w-full border border-gray-300 rounded-md px-3 pr-10 py-2 text-sm focus:outline-none focus:border-brand" required minlength="8">
                                    <button type="button" onclick="togglePasswordVisibility('password', this)" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-brand focus:outline-none">
                                        <i class="far fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div>
                                <label class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mb-1 block">Konfirmasi Password Baru</label>
                                <div class="relative">
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="w-full border border-gray-300 rounded-md px-3 pr-10 py-2 text-sm focus:outline-none focus:border-brand" required minlength="8">
                                    <button type="button" onclick="togglePasswordVisibility('password_confirmation', this)" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-brand focus:outline-none">
                                        <i class="far fa-eye"></i>
                                    </button>
                                </div>
                                <span id="password-match-error" class="text-xs text-red-500 mt-1 hidden">Konfirmasi password tidak cocok.</span>
                                <span id="password-match-success" class="text-xs text-green-600 mt-1 hidden">Password cocok.</span>
                            </div>
                            <button type="submit" class="w-full mt-2 bg-gray-900 hover:bg-black text-white font-bold py-2.5 px-4 rounded-md transition uppercase text-xs tracking-wider shadow-sm">
                                Update Password
                            </button>
                        </form>
                    </div>

                    <!-- Pengaturan -->
                    <div class="bg-white border border-gray-200 p-6 lg:p-8 rounded-xl shadow-sm">
                        <h3 class="text-lg font-bold text-gray-900 uppercase tracking-wide mb-6">Pintasan</h3>
                        <div class="space-y-4">
                            <a href="{{ route('profile.orders') }}" class="block w-full text-center bg-brand-light text-brand hover:bg-brand hover:text-white font-bold py-3 px-4 rounded-md transition uppercase text-xs tracking-wider border border-brand">
                                Lihat Riwayat Pesanan
                            </a>
                            <a href="{{ route('katalog') }}" class="block w-full text-center bg-white border border-gray-300 hover:border-brand hover:text-brand text-gray-700 font-bold py-3 px-4 rounded-md transition uppercase text-xs tracking-wider">
                                Belanja Lagi
                            </a>
                        </div>
                    </div>

                </div>

                <!-- Danger Zone / Sesi Aktif -->
                <div class="bg-red-50 border border-red-200 p-6 rounded-xl shadow-sm flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mt-2">
                    <div>
                        <h4 class="font-bold text-red-600 text-sm mb-1">Sesi Aktif</h4>
                        <p class="text-[10px] font-bold text-red-400 uppercase tracking-widest">Masuk dari: Bogor, ID (Desktop)</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-white text-red-600 border border-red-200 hover:bg-red-100 font-bold py-2 px-6 rounded-md transition uppercase text-xs tracking-wider cursor-pointer">
                            Keluar Akun
                        </button>
                    </form>
                </div>

            </div>

        </div>
    </main>

    <x-footer />

    <script>
        function togglePasswordVisibility(inputId, btn) {
            const input = document.getElementById(inputId);
            const icon = btn.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('far', 'fa-eye');
                icon.classList.add('fas', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fas', 'fa-eye-slash');
                icon.classList.add('far', 'fa-eye');
            }
        }

        const passwordInput = document.getElementById('password');
        const confirmInput = document.getElementById('password_confirmation');
        const matchError = document.getElementById('password-match-error');
        const matchSuccess = document.getElementById('password-match-success');

        function checkPasswordMatch() {
            if (confirmInput.value.length > 0) {
                if (passwordInput.value === confirmInput.value) {
                    confirmInput.classList.remove('border-red-500');
                    confirmInput.classList.add('border-green-500');
                    matchError.classList.add('hidden');
                    matchSuccess.classList.remove('hidden');
                } else {
                    confirmInput.classList.remove('border-green-500');
                    confirmInput.classList.add('border-red-500');
                    matchSuccess.classList.add('hidden');
                    matchError.classList.remove('hidden');
                }
            } else {
                confirmInput.classList.remove('border-green-500', 'border-red-500');
                matchError.classList.add('hidden');
                matchSuccess.classList.add('hidden');
            }
        }

        passwordInput.addEventListener('input', checkPasswordMatch);
        confirmInput.addEventListener('input', checkPasswordMatch);

        const avatarContainer = document.getElementById('avatar-container');
        const avatarInput = document.getElementById('avatar-input');
        const avatarPreview = document.getElementById('avatar-preview');

        if (avatarContainer && avatarInput && avatarPreview) {
            avatarContainer.addEventListener('click', () => avatarInput.click());
            avatarInput.addEventListener('change', (e) => {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (event) => {
                        avatarPreview.src = event.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    </script>
</body>
</html> 
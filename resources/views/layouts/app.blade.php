<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'SIGAPN') }}</title>
    <script>if(localStorage.getItem('theme')==='dark'){document.documentElement.classList.add('dark')}</script>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-slate-100 font-sans text-slate-900 antialiased dark:bg-slate-950 dark:text-slate-100">
<div class="min-h-screen">
    @include('layouts.sidebar')
    <div class="min-h-screen lg:pl-72">
        @include('layouts.topbar')
        <main class="p-4 sm:p-6 lg:p-8">
            @if(session('success'))<div class="mb-5 rounded-2xl bg-emerald-100 p-4 text-emerald-800">{{ session('success') }}</div>@endif
            @if($errors->any())<div class="mb-5 rounded-2xl bg-red-100 p-4 text-red-800">{{ $errors->first() }}</div>@endif
            {{ $slot }}
        </main>
    </div>
</div>
<script>
const html=document.documentElement; const themeToggle=document.getElementById('themeToggle');
if(themeToggle){themeToggle.onclick=()=>{html.classList.toggle('dark');localStorage.setItem('theme',html.classList.contains('dark')?'dark':'light')}}
const openSidebar=document.getElementById('openSidebar'), sidebar=document.getElementById('adminSidebar'), backdrop=document.getElementById('sidebarBackdrop');
if(openSidebar){openSidebar.onclick=()=>{sidebar.classList.remove('-translate-x-full');backdrop.classList.remove('hidden')}}
if(backdrop){backdrop.onclick=()=>{sidebar.classList.add('-translate-x-full');backdrop.classList.add('hidden')}}
</script>
</body>
</html>

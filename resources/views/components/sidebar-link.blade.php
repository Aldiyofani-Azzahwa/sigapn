@props(['href'=>'#','active'=>false])
<a href="{{ $href }}" {{ $attributes->merge(['class' => $active ? 'group flex items-center gap-3 rounded-2xl bg-emerald-800 px-4 py-3 text-sm font-semibold text-white shadow-lg' : 'group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium text-slate-300 transition hover:bg-white/10 hover:text-white']) }}>
    <span class="{{ $active ? 'bg-yellow-300' : 'bg-slate-500 group-hover:bg-yellow-300' }} h-2.5 w-2.5 rounded-full"></span><span>{{ $slot }}</span>
</a>

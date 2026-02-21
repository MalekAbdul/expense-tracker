@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'bg-white/5 border-white/10 focus:border-cyan-500/50 focus:ring-cyan-500/50 rounded-xl shadow-sm text-slate-200 placeholder-slate-500 transition-all']) !!}>

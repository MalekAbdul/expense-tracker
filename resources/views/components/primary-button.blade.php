<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-cyan-500 to-purple-600 border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:opacity-90 hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-cyan-500/50 transition-all duration-200 neon-glow-cyan active:scale-95']) }}>
    {{ $slot }}
</button>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Connection Issue - {{ config('app.name', 'Laravel') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=outfit:300,400,500,600,700&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-[#0F172A] text-slate-200 overflow-x-hidden flex items-center justify-center min-h-screen">
        <div class="max-w-md w-full px-6">
            <div class="glass-card p-10 border-red-500/20 text-center space-y-6">
                <div class="w-20 h-20 bg-gradient-to-br from-red-500 to-orange-500 rounded-2xl flex items-center justify-center mx-auto neon-glow-red animate-pulse">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                
                <h1 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-white to-slate-400">
                    Connection Lost
                </h1>
                
                <p class="text-slate-400 leading-relaxed">
                    We're having trouble connecting to our database. This is usually temporary and often resolved by a quick refresh.
                </p>

                <div class="pt-4">
                    <button onclick="window.location.reload()" class="w-full bg-gradient-to-r from-cyan-500 to-purple-500 text-white font-bold py-3 px-6 rounded-xl hover:scale-[1.02] transition-transform active:scale-95 neon-glow-cyan">
                        Try Again
                    </button>
                    
                    <a href="/" class="block mt-4 text-sm text-slate-500 hover:text-cyan-400 transition-colors">
                        Return to Dashboard
                    </a>
                </div>
            </div>
            
            <p class="mt-8 text-center text-xs text-slate-600">
                SQLSTATE[HY000] [2002] Connection Refused
            </p>
        </div>

        <style>
            .glass-card {
                background: rgba(30, 41, 59, 0.7);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.1);
                border-radius: 1.5rem;
            }
            .neon-glow-red {
                box-shadow: 0 0 20px rgba(239, 68, 68, 0.3);
            }
            .neon-glow-cyan {
                box-shadow: 0 0 20px rgba(6, 182, 212, 0.3);
            }
            @keyframes pulse {
                0%, 100% { opacity: 1; }
                50% { opacity: 0.8; }
            }
            .animate-pulse {
                animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
            }
        </style>
    </body>
</html>

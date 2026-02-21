<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header & Action -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8 stagger-child">
                <div>
                    <h1 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-white to-slate-400">Income History</h1>
                    <p class="text-slate-500 mt-2">Manage and track your earnings in Taka</p>
                </div>
                <a href="{{ route('incomes.create') }}" class="inline-flex items-center px-6 py-3 bg-cyan-500 hover:bg-cyan-400 text-white font-bold rounded-xl transition-all shadow-lg neon-glow-cyan transform hover:scale-[1.02]">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    New Income
                </a>
            </div>

            <!-- Stats Bar (Optional, can be added later) -->

            <!-- Table Card -->
            <div class="glass-card overflow-hidden stagger-child">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b border-white/5 bg-white/5">
                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-slate-400">Date</th>
                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-slate-400">Source</th>
                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-slate-400">Description</th>
                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-slate-400 text-right">Amount</th>
                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-slate-400 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @forelse ($incomes as $income)
                                <tr class="hover:bg-white/5 transition-colors group">
                                    <td class="px-6 py-4 text-sm text-slate-300">
                                        {{ \Carbon\Carbon::parse($income->date)->format('d M, Y') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 rounded-lg bg-cyan-500/20 flex items-center justify-center text-cyan-400 mr-3">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            </div>
                                            <span class="text-sm font-medium text-white">{{ $income->source }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-400">
                                        {{ $income->description ?? 'No description' }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <span class="text-sm font-bold text-green-400">৳{{ number_format($income->amount, 2) }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center space-x-2">
                                            <!-- Edit Button -->
                                            <a href="{{ route('incomes.edit', $income) }}" class="p-2 text-slate-500 hover:text-cyan-400 transition-colors" title="Edit">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 00-2 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </a>

                                            <!-- Delete Button -->
                                            <form action="{{ route('incomes.destroy', $income) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this income record?');" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-slate-500 hover:text-red-400 transition-colors" title="Delete">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-12 h-12 mb-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                            <p>No income records found.</p>
                                            <a href="{{ route('incomes.create') }}" class="mt-4 text-cyan-400 hover:text-cyan-300 font-bold">Add your first income</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($incomes->hasPages())
                    <div class="px-6 py-4 border-t border-white/5 bg-white/5">
                        {{ $incomes->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

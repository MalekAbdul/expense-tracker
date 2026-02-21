<x-app-layout>
    <div class="stagger-child space-y-8">
        <!-- Top Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Balance -->
            <div x-data="{ count: 0, target: {{ $balance }} }" x-init="let start = Date.now(); let duration = 2000; let step = () => { let progress = Math.min((Date.now() - start) / duration, 1); count = (progress * target).toLocaleString(undefined, {minimumFractionDigits: 2}); if (progress < 1) requestAnimationFrame(step); }; step()" class="glass-card p-6 border-cyan-500/20">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-2xl bg-cyan-500/10 flex items-center justify-center text-cyan-400 neon-glow-cyan">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
                <p class="text-sm text-slate-400 font-medium">Total Balance</p>
                <h3 class="text-3xl font-bold mt-1">৳<span x-text="count"></span></h3>
                <div class="flex items-center gap-1 mt-4 text-xs text-green-400 font-medium bg-green-400/10 w-fit px-2 py-1 rounded-full border border-green-400/20">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                    <span>+0%</span>
                </div>
            </div>

            <!-- Total Income -->
            <div x-data="{ count: 0, target: {{ $totalIncome }} }" x-init="let start = Date.now(); let duration = 2000; let step = () => { let progress = Math.min((Date.now() - start) / duration, 1); count = (progress * target).toLocaleString(undefined, {minimumFractionDigits: 2}); if (progress < 1) requestAnimationFrame(step); }; step()" class="glass-card p-6 border-green-500/20">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-2xl bg-green-500/10 flex items-center justify-center text-green-400 neon-glow-green">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    </div>
                </div>
                <p class="text-sm text-slate-400 font-medium">Total Income</p>
                <h3 class="text-3xl font-bold mt-1">৳<span x-text="count"></span></h3>
                <p class="text-xs text-slate-500 mt-4 leading-none">Overall</p>
            </div>

            <!-- Total Expenses -->
            <div x-data="{ count: 0, target: {{ $totalExpense }} }" x-init="let start = Date.now(); let duration = 2000; let step = () => { let progress = Math.min((Date.now() - start) / duration, 1); count = (progress * target).toLocaleString(undefined, {minimumFractionDigits: 2}); if (progress < 1) requestAnimationFrame(step); }; step()" class="glass-card p-6 border-red-500/20">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-2xl bg-red-500/10 flex items-center justify-center text-red-400 neon-glow-red">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0v-8m0 8l-8-8-4 4-6-6"></path></svg>
                    </div>
                </div>
                <p class="text-sm text-slate-400 font-medium">Total Expenses</p>
                <h3 class="text-3xl font-bold mt-1 text-red-400">৳<span x-text="count"></span></h3>
                <p class="text-xs text-slate-500 mt-4 leading-none">Overall</p>
            </div>

            <!-- Activity Goal -->
            <div class="glass-card p-6 border-purple-500/20">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-2xl bg-purple-500/10 flex items-center justify-center text-purple-400 neon-glow-purple">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <span class="text-xs font-bold text-purple-400">100%</span>
                </div>
                <p class="text-sm text-slate-400 font-medium">System Health</p>
                <h3 class="text-3xl font-bold mt-1">Active</h3>
                <div class="w-full h-1.5 bg-white/5 rounded-full mt-5 overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-purple-500 to-pink-500 w-full shadow-[0_0_10px_rgba(139,92,246,0.5)]"></div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Expense Trend Chart -->
            <div class="lg:col-span-2 glass-card p-6">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h4 class="text-lg font-bold">Expense Overview</h4>
                        <p class="text-xs text-slate-500">Monthly spending data analysis</p>
                    </div>
                    <div class="flex bg-white/5 p-1 rounded-xl">
                        <button class="px-3 py-1.5 text-xs font-semibold glass rounded-lg text-cyan-400 shadow-lg shadow-cyan-500/10 transition-all">Monthly</button>
                        <button class="px-3 py-1.5 text-xs font-semibold text-slate-400 hover:text-slate-200 transition-colors">Weekly</button>
                    </div>
                </div>
                <div id="expenseChart" class="w-full h-[300px]"></div>
            </div>

            <!-- Category Breakdown -->
            <div class="glass-card p-6 flex flex-col min-h-[400px]">
                <h4 class="text-lg font-bold mb-1">Category Breakdown</h4>
                <p class="text-xs text-slate-500 mb-8">Top spending sectors</p>
                
                @if(count($catLabels) > 0)
                    <div id="categoryChart" class="flex-1 flex items-center justify-center"></div>
                    <div class="mt-8 grid grid-cols-2 gap-4">
                        @foreach($catLabels as $index => $label)
                            <div class="flex items-center justify-between gap-2 p-2 rounded-xl bg-white/5 border border-white/5">
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 rounded-full" style="background-color: {{ ['#06b6d4', '#8b5cf6', '#ec4899', '#64748b', '#f59e0b', '#10b981', '#3b82f6', '#ef4444', '#6b7280'][$index % 9] }}"></div>
                                    <span class="text-[10px] text-slate-400 truncate max-w-[80px]">{{ $label }}</span>
                                </div>
                                <span class="text-[10px] font-bold text-slate-200 whitespace-nowrap">৳{{ number_format($catValues[$index], 0) }}</span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="flex-1 flex flex-col items-center justify-center text-slate-500">
                        <svg class="w-12 h-12 mb-4 text-slate-600 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>
                        <p class="text-sm">No expenses recorded yet</p>
                        <a href="{{ route('expenses.create') }}" class="mt-4 text-xs font-bold text-red-400 hover:text-red-300 transition-colors">Add Expense</a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="glass-card overflow-hidden">
            <div class="p-6 flex items-center justify-between border-b border-white/5">
                <h4 class="text-lg font-bold">Recent Transactions</h4>
                <span class="text-xs text-slate-500">Incomes & Expenses</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="text-left text-xs font-bold text-slate-500 uppercase tracking-widest border-b border-white/5">
                            <th class="px-6 py-4">Transaction</th>
                            <th class="px-6 py-4">Category / Source</th>
                            <th class="px-6 py-4">Date</th>
                            <th class="px-6 py-4">Amount</th>
                            <th class="px-6 py-4 text-right">Type</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm font-medium">
                        @forelse ($recentTransactions as $transaction)
                            <tr class="group hover:bg-white/5 transition-colors border-b border-white/5 last:border-0">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl glass flex items-center justify-center font-bold text-slate-400 group-hover:text-cyan-400 group-hover:neon-glow-cyan transition-all">
                                            {{ substr($transaction->type === 'income' ? $transaction->source : $transaction->category, 0, 1) }}
                                        </div>
                                        <span class="group-hover:text-white transition-colors">{{ $transaction->type === 'income' ? $transaction->source : ($transaction->description ?? 'Expense') }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-slate-400">{{ $transaction->type === 'income' ? 'Income Source' : $transaction->category }}</td>
                                <td class="px-6 py-4 text-slate-500">{{ \Carbon\Carbon::parse($transaction->date)->format('M d, Y') }}</td>
                                <td class="px-6 py-4 {{ $transaction->type === 'income' ? 'text-green-400' : 'text-red-400' }} font-bold">
                                    {{ $transaction->type === 'income' ? '+' : '-' }}৳{{ number_format($transaction->amount, 2) }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-tighter {{ $transaction->type === 'income' ? 'bg-green-500/10 text-green-400' : 'bg-red-500/10 text-red-400' }} border border-white/5">
                                        {{ ucfirst($transaction->type) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-slate-500">No transactions recorded yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Expense Trend Chart
            const expenseOptions = {
                series: [{
                    name: 'Expense',
                    data: @json($chartValues)
                }],
                chart: {
                    height: 300,
                    type: 'area',
                    toolbar: { show: false },
                    zoom: { enabled: false },
                    foreColor: '#94a3b8',
                    fontFamily: 'Outfit, sans-serif'
                },
                colors: ['#ef4444'],
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.3,
                        opacityTo: 0.05,
                        stops: [0, 100]
                    }
                },
                dataLabels: { enabled: false },
                stroke: {
                    curve: 'smooth',
                    width: 3,
                    lineCap: 'round'
                },
                grid: {
                    borderColor: 'rgba(255, 255, 255, 0.05)',
                    xaxis: { lines: { show: true } },
                    yaxis: { lines: { show: false } }
                },
                xaxis: {
                    categories: @json($chartLabels),
                    axisBorder: { show: false },
                    axisTicks: { show: false }
                },
                yaxis: { show: false },
                tooltip: {
                    theme: 'dark',
                    marker: { show: false },
                    x: { show: false }
                }
            };

            const expenseChart = new ApexCharts(document.querySelector("#expenseChart"), expenseOptions);
            expenseChart.render();

            // Category Breakdown Chart
            const catValues = @json($catValues).map(v => parseFloat(v) || 0);

            const categoryOptions = {
                series: catValues,
                chart: {
                    type: 'donut',
                    height: 250,
                    fontFamily: 'Outfit, sans-serif'
                },
                colors: ['#06b6d4', '#8b5cf6', '#ec4899', '#64748b', '#f59e0b', '#10b981', '#3b82f6', '#ef4444', '#6b7280'],
                labels: @json($catLabels),
                stroke: { show: false },
                dataLabels: { enabled: false },
                legend: { show: false },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '80%',
                            background: 'transparent',
                            labels: {
                                show: true,
                                name: { show: false },
                                value: {
                                    show: true,
                                    fontSize: '24px',
                                    fontWeight: 'bold',
                                    color: '#fff',
                                    formatter: (val) => '৳' + parseFloat(val).toLocaleString()
                                },
                                total: {
                                    show: true,
                                    label: 'Total',
                                    color: '#94a3b8',
                                    formatter: (w) => {
                                        const sum = w.globals.seriesTotals.reduce((a, b) => parseFloat(a) + parseFloat(b), 0);
                                        return '৳' + sum.toLocaleString();
                                    }
                                }
                            }
                        }
                    }
                },
                tooltip: { theme: 'dark' }
            };

            const categoryChartEl = document.querySelector("#categoryChart");
            if (categoryChartEl) {
                const categoryChart = new ApexCharts(categoryChartEl, categoryOptions);
                categoryChart.render();
            }
        });
    </script>
</x-app-layout>

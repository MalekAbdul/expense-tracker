<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8 stagger-child">
                <h1 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-white to-slate-400">Add New Expense</h1>
                <p class="text-slate-500 mt-2">Record your spending in Taka (৳)</p>
            </div>

            <!-- Form Card -->
            <div class="glass-card p-8 stagger-child">
                <form action="{{ route('expenses.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Amount -->
                        <div class="space-y-2">
                            <x-input-label for="amount" :value="__('Amount (৳)')" />
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-red-400 font-bold">৳</div>
                                <x-text-input id="amount" class="block w-full pl-10 border-red-500/20 focus:border-red-500/50 focus:ring-red-500/50" type="number" step="0.01" name="amount" :value="old('amount')" required autofocus placeholder="0.00" />
                            </div>
                            <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                        </div>

                        <!-- Date -->
                        <div class="space-y-2">
                            <x-input-label for="date" :value="__('Date')" />
                            <x-text-input id="date" class="block w-full" type="date" name="date" :value="old('date', date('Y-m-d'))" required />
                            <x-input-error :messages="$errors->get('date')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Category -->
                    <div class="space-y-2">
                        <x-input-label for="category" :value="__('Category')" />
                        <select id="category" name="category" class="block w-full bg-white/5 border-white/10 focus:border-red-500/50 focus:ring-red-500/50 rounded-xl shadow-sm text-slate-200 transition-all" onchange="updateSuggestions(this.value)">
                            @foreach($categories as $category)
                                <option value="{{ $category }}" {{ old('category') === $category ? 'selected' : '' }} class="bg-[#1E293B]">{{ $category }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category')" class="mt-2" />
                    </div>

                    <!-- Description -->
                    <div class="space-y-2">
                        <x-input-label for="description" :value="__('Description (Optional)')" />
                        <textarea id="description" name="description" class="block w-full bg-white/5 border-white/10 focus:border-red-500/50 focus:ring-red-500/50 rounded-xl shadow-sm text-slate-200 placeholder-slate-500 transition-all min-h-[100px]">{{ old('description') }}</textarea>
                        <div id="suggestion-hint" class="text-xs text-slate-500 mt-2 px-1 italic">
                            Suggestions: <span id="hint-text">Rice, lentils, vegetables...</span>
                        </div>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4 flex items-center justify-end space-x-4">
                        <a href="{{ route('expenses.index') }}" class="text-slate-400 hover:text-white transition-colors">Cancel</a>
                        <button type="submit" class="inline-flex items-center px-10 py-3 bg-red-500 hover:bg-red-400 text-white font-bold rounded-xl transition-all shadow-lg neon-glow-red transform hover:scale-[1.02]">
                            {{ __('Save Expense') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const suggestions = {
            'Household / Living': 'Rice, lentils, vegetables, fish/meat, oil, water, gas, electricity, rent, maid...',
            'Food & Snacks': 'Breakfast, lunch, cafe, chotpoti, coffee, restaurant bill...',
            'Transportation': 'Rickshaw, bus, CNG, Uber, fuel, parking...',
            'Communication & Internet': 'Mobile recharge, data pack, broadband, SMS...',
            'Personal & Essentials': 'Soap, shampoo, toothpaste, sanitary, haircut...',
            'Education / Office': 'Stationery, printing, office lunch, campus snacks, online sub...',
            'Health': 'Medicine, doctor visit, pharmacy...',
            'Family & Social': 'Guest, gift, donation, mosque...',
            'Financial': 'Loan installment, savings, bKash charge...'
        };

        function updateSuggestions(category) {
            document.getElementById('hint-text').innerText = suggestions[category] || '...';
        }

        // Initialize on load
        document.addEventListener('DOMContentLoaded', () => {
            updateSuggestions(document.getElementById('category').value);
        });
    </script>
    <style>
        .neon-glow-red {
            box-shadow: 0 0 15px rgba(239, 68, 68, 0.4);
        }
    </style>
</x-app-layout>

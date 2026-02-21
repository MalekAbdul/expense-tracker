<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8 stagger-child">
                <h1 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-white to-slate-400">Edit Income</h1>
                <p class="text-slate-500 mt-2">Update your income record (৳)</p>
            </div>

            <!-- Form Card -->
            <div class="glass-card p-8 stagger-child">
                <form action="{{ route('incomes.update', $income) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Amount -->
                        <div class="space-y-2">
                            <x-input-label for="amount" :value="__('Amount (৳)')" />
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-cyan-400 font-bold">৳</div>
                                <x-text-input id="amount" class="block w-full pl-10" type="number" step="0.01" name="amount" :value="old('amount', $income->amount)" required autofocus />
                            </div>
                            <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                        </div>

                        <!-- Date -->
                        <div class="space-y-2">
                            <x-input-label for="date" :value="__('Date')" />
                            <x-text-input id="date" class="block w-full" type="date" name="date" :value="old('date', \Carbon\Carbon::parse($income->date)->format('Y-m-d'))" required />
                            <x-input-error :messages="$errors->get('date')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Source -->
                    <div class="space-y-2">
                        <x-input-label for="source" :value="__('Income Source')" />
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500 group-focus-within:text-cyan-400 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <x-text-input id="source" class="block w-full pl-11" type="text" name="source" :value="old('source', $income->source)" required />
                        </div>
                        <x-input-error :messages="$errors->get('source')" class="mt-2" />
                    </div>

                    <!-- Description -->
                    <div class="space-y-2">
                        <x-input-label for="description" :value="__('Description (Optional)')" />
                        <textarea id="description" name="description" class="block w-full bg-white/5 border-white/10 focus:border-cyan-500/50 focus:ring-cyan-500/50 rounded-xl shadow-sm text-slate-200 placeholder-slate-500 transition-all min-h-[100px]">{{ old('description', $income->description) }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4 flex items-center justify-end space-x-4">
                        <a href="{{ route('incomes.index') }}" class="text-slate-400 hover:text-white transition-colors">Cancel</a>
                        <x-primary-button class="px-10">
                            {{ __('Update Income') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

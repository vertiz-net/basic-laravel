<x-layout>
    <x-slot:heading>Create a job</x-slot:heading>

    <form method="POST" action="/jobs">
        @csrf
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">Create a new Job</h2>
                <p class="mt-1 text-sm/6 text-gray-600">We just need a handful of details from you.</p>

                <div class="mt-10 grid grid-cols-6 gap-x-6 gap-y-8 sm:grid-cols-2">
                    <div class="sm:col-span-1">
                        <label for="title" class="block text-sm/6 font-medium text-gray-900">Title</label>
                        <div class="mt-2">
                            <input type="text" name="title" id="title" placeholder="Programmer" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" required>
                            @error('title')
                            <p class="text-red-500 text-xs font-semibold mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-1">
                        <label for="salary" class="block text-sm/6 font-medium text-gray-900">Salary</label>
                        <div class="mt-2">
                            <input type="text" name="salary" id="salary" placeholder="$60,000 per year" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" required>
                            @error('salary')
                            <p class="text-red-500 text-xs font-semibold mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <!-- <div class="mt-10">
                        @if($errors->any())
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li class="text-red-500 italic text-sm">{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div> -->
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</button>
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
        </div>
    </form>

</x-layout>
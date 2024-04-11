<x-layout>
    <section class="mt-4">
        <div class="flex justify-end">
            <a href="{{ route('posts.edit', $post->id) }}"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Edit</a>
        </div>
    </section>
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 mt-8 bg-slate-50 rounded-lg">
        <h1 class="text-3xl font-bold text-center text-indigo-600">{{ $post->title }}</h1>
        <main class="mt-4">
            <p class="text-lg text-center text-gray-700">{{ $post->content }}</p>
        </main>
    </div>
</x-layout>

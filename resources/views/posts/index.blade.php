<x-layout>

    <h1>Posts Index Page</h1>
    <div>My name is {{ $username }} and my age is {{ $age }}</div>
    <ul>
        @foreach ($posts as $post)
            <li>{{ $post }}</li>
        @endforeach
    </ul>
</x-layout>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pets</title>
</head>
<body>
    <h1>Pets</h1>
    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif
    @if($pets != null)
        <ul>
            @foreach($pets as $pet)
                <li>
                    @if(isset($pet['name']))
                        {{ $pet['name'] }} -
                    @endif
                    {{ $pet['status'] }}
                    <a href="{{ route('pets.edit', $pet['id']) }}">Edit</a>
                    <form action="{{ route('pets.destroy', $pet['id']) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @else
        <label for="null">There are no pets</label>
    @endif

    <form action="{{ route('pets.store') }}" method="post">
        @csrf
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <label for="status">Status:</label>
        <input type="text" id="status" name="status" required>
        <button type="submit">Add Pet</button>
    </form>
</body>
</html>
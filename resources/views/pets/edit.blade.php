<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pet</title>
</head>
<body>
    <h1>Edit Pet</h1>
    <form action="{{ route('pets.update', $pet['id']) }}" method="post">
        @csrf
        @method('PUT')
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ $pet['name'] ?? ""  }}" required>
        <label for="status">Status:</label>
        <input type="text" id="status" name="status" value="{{ $pet['status'] ?? ""  }}" required>
        
        <!-- Kategoria -->
        <label for="category_id">Category ID:</label>
        <input type="text" id="category_id" name="category_id" value="{{ $pet['category']['id'] ?? ""  }}" required>
        <label for="category_name">Category Name:</label>
        <input type="text" id="category_name" name="category_name" value="{{ $pet['category']['name'] ?? "" }}" required>
        
        <!-- Tagi -->
        @foreach($pet['tags'] as $tag)
            <label for="tag_id_{{ $tag['id'] }}">Tag ID:</label>
            <input type="text" id="tag_id_{{ $tag['id'] }}" name="tag_id[]" value="{{ $tag['id'] ?? ""  }}" required>
            <label for="tag_name_{{ $tag['id'] }}">Tag Name:</label>
            <input type="text" id="tag_name_{{ $tag['id'] }}" name="tag_name[]" value="{{ $tag['name'] ?? ""  }}" required>
        @endforeach
        
        <!-- Photo URLs -->
        @foreach($pet['photoUrls'] as $photoUrl)
            <label for="photo_url_{{ $loop->index }}">Photo URL:</label>
            <input type="text" id="photo_url_{{ $loop->index }}" name="photo_url[]" value="{{ $photoUrl ?? ""  }}" required>
        @endforeach
        
        <button type="submit">Update Pet</button>
    </form>
</body>
</html>
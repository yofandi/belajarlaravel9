<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Posting</title>
    {{-- css --}}
    <link href="{{ asset('bootstrap-5/css/bootstrap.min.css') }}" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1>Edit Postingan || Id: {{ $post->id }} </h1>
        <form action="{{ route('post.patch', ['id' => $post->id]) }}" method="post" class="form-control">
            @method('PATCH')
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" placeholder="Your Blog Title...." value="{{ $post->title }}">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Content</label>
                <textarea class="form-control" name="content" rows="3">{{ $post->content }}</textarea>
            </div>            
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Detail</label>
                <textarea class="form-control" name="detail" rows="3">{{ $post->detail }}</textarea>
            </div>
            <button type="submit" class="btn btn-info">Update</button>
        </form>
        {{-- <form method="POST" action="{{ url('posts/$post->id') }}"> --}}
        <form method="POST" action="{{ route('post.delete', ['id' => $post->id]) }}">
            @method('DELETE')
            @csrf
            <button class="btn btn-danger" type="submit">Hapus</button>
        </form>
    </div>  
    {{-- js --}}
    <script src="{{ asset('bootstrap-5/js/bootstrap.bundle.min.js') }}"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
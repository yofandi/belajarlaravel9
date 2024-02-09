@extends('layouts.app')

@section('title', 'Tambah Postingan')

@section('content')
<h1>Tambah Postingan</h1>
<form action="{{ route('post.store') }}" method="post" class="form-control">
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" name="title" placeholder="Your Blog Title....">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Content</label>
        <textarea class="form-control" name="content" rows="3"></textarea>
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Detail</label>
        <textarea class="form-control" name="detail" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-info">Save</button>
</form>
@endsection
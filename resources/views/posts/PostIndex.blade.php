{{-- diarahkan ke file master app yang ada di folder views/layouts --}}
@extends('layouts.app')

{{-- section adalah bagian yang diperuntukkan ditampilan ke master layout atau extends --}}
@section('title','Blog')

@section('content')
@if (session()->has('success'))
<div class="alert alert-primary">
    {{ session()->get('success') }}
</div>
@endif
<h1>
    Blog Code Learn From yofandi
    <a href="{{ route("post.create") }}" class="btn btn-success">Tambah Posting</a>
</h1>
@foreach ($posts as $post)
@php
// $post = explode(",", $post);
@endphp
<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title">{{ $post->title }}</h5>
        <p class="card-text">{{ $post->comment }} </p>
        <p class="card-text"><small class="text-body-secondary">Last updated {{ date("d M Y H:i",
                strtotime($post->created_at)) }}</small></p>
        <a href="{{ route('post.show', ['id' => $post->id]) }}" class="btn btn-primary">Selengkapnya .... </a>
        <a href="{{ route('post.edit', ['id' => $post->id]) }}" class="btn btn-warning"> Edit </a>
    </div>
</div>
@endforeach
@endsection
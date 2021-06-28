@extends('layouts.app')
@section('title','Support')
@section('content')
<div class="container">
  <p class="card-text">Some random header text.</p>      
  @isset($data)
    @foreach($data as $post)
      {{ $post['post_text'] }} from {{ $post['post_author'] }} <br>
    @endforeach
  @endisset
</div>
@endsection

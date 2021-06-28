@extends('layouts.app')
@section('title','Moderator Controll Panel')
@section('content')
<div class="container">
  <p class="card-text">Some random header text.</p>      
    @isset($value)
      {{ $value }}
    @endisset

</div>
@endsection

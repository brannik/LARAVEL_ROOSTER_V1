@extends('layouts.app')
@section('title','Guild Settings')
@section('content')
<div class="container">
  <p class="card-text">Some random header text.</p>      
    @isset($value)
      {{ $value }}
    @endisset

</div>
@endsection

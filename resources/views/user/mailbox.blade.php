@extends('layouts.app')
@section('title','Mailbox')
@section('content')
<div class="container">   
  <div id="accordion">
    @foreach($messages as $message)
    <div class="card mb-1">
      
      @if($message['is_system'] == 1)
      <div class="card-header bg-warning" id="headingOne"> 
        @if($message['is_read'] == 0)
          <h5 class="mb-0">
            <button class="btn btn-outline-warning text-danger" data-toggle="collapse" data-target="#{{ $message['token'] }}" aria-expanded="true" aria-controls="collapseOne">
              <h6><span class="badge badge-primary">NEW</span>&nbsp;{{ $message['title'] }}</h6>
            </button>
          </h5>
        </div>
        @else
          <h5 class="mb-0">
            <button class="btn btn-outline-warning text-danger" data-toggle="collapse" data-target="#{{ $message['token'] }}" aria-expanded="true" aria-controls="collapseOne">
              <h6>{{ $message['title'] }}</h6>
            </button>
          </h5>
        </div>
        @endif
        @else
          @if($message['is_read'] == 0)
          <div class="card-header bg-info" id="headingOne">
            <h5 class="mb-0">
              <button class="btn btn-outline-info text-primary" data-toggle="collapse" data-target="#{{ $message['token'] }}" aria-expanded="true" aria-controls="collapseOne">
                <h6><span class="badge badge-primary">NEW</span>&nbsp;{{ $message['title'] }} from <span class="badge badge-info">{{ $message['from'] }}</span></h6>
              </button>
            </h5>
          </div>
          @else
          <div class="card-header bg-info" id="headingOne">
            <h5 class="mb-0">
              <button class="btn btn-outline-info text-primary" data-toggle="collapse" data-target="#{{ $message['token'] }}" aria-expanded="true" aria-controls="collapseOne">
                <h6>{{ $message['title'] }} from <span class="badge badge-info">{{ $message['from'] }}</span></h6>
              </button>
            </h5>
          </div>
          @endif
        @endif
      
  
      <div id="{{ $message['token'] }}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
        <div class="card-body">
          {{ $message['text'] }}
          
        </div>
        <div class="card-footer">
          <span class="text-info">sent: <cite title="Source Title">{{ $message['date'] }}</cite></span>
          <div class="btn-group-sm float-right mb-1" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-outline-primary">Delete</button>
            @if($message['is_read'] == 0)
              <button type="button" class="btn btn-outline-primary">Mark as read</button>
            @endif
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection

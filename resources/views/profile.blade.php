@extends('layouts.app')
@section('title','User profile')
@section('content')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
<div class="container">  
  @php
    use App\Http\Controllers\AccountData;
    use App\Http\Controllers\AdminAccData;
    use App\Http\Controllers\Permission;
  @endphp 
  <div class="row justify-content-center border border-primary rounded-3">
    <div class="card bg-dark text-warning">
      <img id="profile_banner" class="card-img" src="{{ url($profile['banner']) }}"  alt="Card image">
      <div class="card-img-overlay">
        
        <div class="col">
          <div class="row">
            <div class="col col-lg-2">
              <img  class="d-block rounded-circle border border-primary" src="{{ url($profile['picture']) }}" alt="First slide" style="height: 84px; width: 84px;">
            </div>
            <div class="col">
                <div class="row">
                  <h5>{{ $profile['username'] }} 
                    @if(Cache::has('user-is-online-' . $profile['user_id']))
                      <span class="text-success">Online</span>
                        @else
                      <span class="text-secondary">Offline</span>
                    @endif
                  </h5>
                </div>
                <div class="row">
                  <h6>Rank: <span class="{{ $profile['rank_color'] }}">{{ $profile['rank_name'] }}</span></h6>
                </div>
                <div class="row">
                  <span class="blockquote-footer text-warning">Created: <cite title="Source Title">{{ $profile['created_at'] }}</cite></span>
                </div>


            </div>
            <div class="col-5">
              <div class="row justify-content-center">
                @if($profile['is_banned'] == 1)
                  <span class="badge bg-danger text-light">Suspended for: {{ $profile['ban_reason'] }}</span>
                @endif
              </div>
              <br>
              <div class="col">
              <div class="row justify-content-center">
                  @if(Auth::user()->rank >=3)
                    @if(strcmp($profile['has_warning'],'none') != 0)
                      <span class="badge bg-warning text-dark">Warning: {{ $profile['has_warning'] }}</span>
                    @endif
                  @endif
                </div>
              </div>
      
            </div>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-3">
            <span class="text-warning">Guild: {{ $profile['guild_name'] }}</span>
          </div>
      
          <div class="col-3">
                Rank: <span class="{{ $profile['guild_rank_color'] }}"> {{ $profile['guild_rank_name'] }}</span> 
          </div>
          
          <div class="col-3">
            <span class="text-warning"> DKP NET {{ $profile['dkp_net'] }}</span>
          </div>
          <div class="col-3">
            <span class="text-warning"> DKP TOT {{ $profile['dkp_tot'] }}</span>
          </div>
        </div>

        <div class="row mt-1">
          <div class="col-3">
              <span class="text-warning">Forum posts: 12</span> 
          </div>
          
          <div class="col-3">
              <span class="text-warning">Forum comments: 133</span>
          </div>
          
        </div>
        <div class="row mt-1">
          <div class="col-5">
            @if($profile['is_banned'] == 1)
              Comunity rank: Suspended
            @else
              Comunity rank: {{ AdminAccData::calc_comunity_rank($profile['user_id'])['rank'] }} ({{ AdminAccData::calc_comunity_rank($profile['user_id'])['percent'] }}%)
            @endif
          </div>
          <div class="col-6 ">
            @if($profile['is_banned'] == 1)
              <div class="progress" style="height: 25px;">
                <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Locked.</div>
              </div>
            @else
            <div class="progress" style="height: 25px;">
              <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" 
              aria-valuenow="{{ AdminAccData::calc_comunity_rank($profile['user_id'])['percent'] }}" 
              aria-valuemin="0" 
              aria-valuemax="100" 
              style="width: {{ AdminAccData::calc_comunity_rank($profile['user_id'])['percent'] }}%">
              
              </div>
              
            </div>
            @endif
            
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="row mt-3">
    <div class="col-3">
      <div class="btn-group " role="group" aria-label="Basic example">
        <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#add_fiend">Add Friend</button>
        <button type="button" class="btn btn-secondary btn-sm ml-1" data-toggle="modal" data-target="#send_message">Message</button>
        @if(AdminAccData::check_rate($profile['user_id'])['check_rate'] == 1 )
        @if(strcmp(AdminAccData::check_rate($profile['user_id'])['rate'],'up') == 0)
        <button type="button" class="btn btn-success btn-sm ml-1 disabled" data-toggle="modal" data-target="#send_message">
          Your rating {{ strtoupper(AdminAccData::check_rate($profile['user_id'])['rate']) }}
        </button>
        @else
        <button type="button" class="btn btn-danger btn-sm ml-1 disabled" data-toggle="modal" data-target="#send_message">
          Your rating {{ strtoupper(AdminAccData::check_rate($profile['user_id'])['rate']) }}
        </button>
        @endif
        
        @else
          @if(Permission::check('can_vote_for_user') == true)
            <a href="/rate_user?vote=up&target={{ $profile['user_id'] }}&sender={{ Auth::user()->id }}" class="btn btn-success btn-sm ml-1" role="button" aria-pressed="false">Rate +</a>
            <a href="/rate_user?vote=down&target={{ $profile['user_id'] }}&sender={{ Auth::user()->id }}" class="btn btn-danger btn-sm ml-1" role="button" aria-pressed="true">Rate -</a>
          @endif
        @endif
        

        @if((Auth::user()->rank >= 3) || (Auth::user()->guild_rank >= AccountData::is_rqruiter($profile['guild_id'])))
          @if($profile['guild_id'] == 0)
            <button type="button" class="btn btn-primary btn-sm ml-1" data-toggle="modal" data-target="#to_edit">Guild Invite</button>
          @else
            <button type="button" class="btn btn-primary btn-sm ml-1" data-toggle="modal" data-target="#to_edit">Guild Kick</button>
          @endif
        @endif
        @if(Auth::user()->rank >= 3)
        <div class="btn-group-sm ml-1">
          <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Moderator
          </button>
          <div class="dropdown-menu">
            @if(empty($profile['email_verified']))
              <button type="button" class="btn dropdown-item" data-toggle="modal" data-target="#to_edit">Email reminder</button>
            @endif
            <button type="button" class="btn dropdown-item" data-toggle="modal" data-target="#to_edit">Flag for rename</button>
            <button type="button" class="btn dropdown-item" data-toggle="modal" data-target="#to_edit">Warn</button>
          </div>
          
        </div>
        @endif
        @if(Auth::user()->rank >= 4)
        <div class="btn-group-sm ml-1">
          <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Admin
          </button>
          <div class="dropdown-menu">
            @if($profile['is_banned'] == 1)
              <button type="button" class="btn dropdown-item" data-toggle="modal" data-target="#to_edit">Unban</button>
            @else
              <button type="button" class="btn dropdown-item" data-toggle="modal" data-target="#to_edit">Ban</button>
            @endif
            <button type="button" class="btn dropdown-item" data-toggle="modal" data-target="#to_edit">Delete</button>
            <button type="button" class="btn dropdown-item" data-toggle="modal" data-target="#to_edit">Warn</button>
            <button type="button" class="btn dropdown-item" data-toggle="modal" data-target="#to_edit">Edit profile</button>
          </div>
        </div>
        @endif
        
      </div>
    </div>
  </div>

  <form action="/add_fiend" method="get">  
    <div class="modal fade" id="add_fiend" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="add_fiend">Add {{ $profile['username'] }} to your fiends?</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                  </div>
                  <div class="modal-body justify-content-center">
                    <input type="hidden" name="user_to_request_friend" value="{{ $profile['username'] }}">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-primary">Send request</button>
                  </div>
                  
              </div>
          </div>
      </div>
    </form>

    <form action="/send_message" method="get">  
      <div class="modal fade" id="send_message" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Send message to - {{ $profile['username'] }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control" name="message_title" placeholder="Title..">
                        <textarea class="form-control" cols="63" rows="4" name="message_text" placeholder="Text.."></textarea>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="user_id" value="{{ $profile['user_id'] }}">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </div>
            </div>
        </div>
      </form>

      <ul class="nav nav-pills mb-3 mt-2" id="pills-tab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Characters</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Event history</a>
        </li>
      </ul>
      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
          @php
            $counter = 0;
          @endphp
          <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($characters as $character)

            @if($counter < 4)
            <div class="col">
              <div class="card h-100 bg-transparent border border-warning rounded-3">
                <img src="{{ url('images/classes/' . $character['class'] . '.jpg') }}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">{{ $character['name'] }}</h5>
                  <p class="card-text text-small">
                    <div class="container text-secondary">
                      <div class="row" aria-colspan="2">
                        <div class="col">< {{ ucfirst($character['guild_name']) }} ></div>
                      </div>
                      <div class="row">
                        <div class="col-sm-5">Class</div>
                        <div class="col">{{ ucfirst($character['class']) }}</div>
                      </div>
                      <div class="row">
                        <div class="col-sm-5">Race</div>
                        <div class="col">{{ ucfirst($character['race']) }}</div>
                      </div>
                      <div class="row">
                        <div class="col-sm-5">Rank</div>
                        <div class="col">{{ ucfirst($character['rank']) }}</div>
                      </div>
                      <div class="row">
                        <div class="col-sm-5">MS</div>
                        <div class="col">{{ ucfirst($character['ms']) }} - {{ ucfirst($character['ms_gs']) }}</div>
                      </div>
                      <div class="row">
                        <div class="col-sm-5">OS</div>
                        <div class="col">{{ ucfirst($character['os']) }} - {{ ucfirst($character['os_gs']) }}</div>
                      </div>
                    </div>
                  </p>
                </div>
                <div class="card-footer">
                  <small class="text-muted"><a class="btn btn-outline-secondary btn-sm" href="{{ ucfirst($character['armory']) }}" target="_new">Armory</a></small>
                  @if((Auth::user()->rank >= 3) || (Auth::user()->guild_rank >= AccountData::is_rqruiter($profile['guild_id'])))
                    <button type="button" class="btn btn-outline-warning btn-sm ml-1" data-toggle="modal" data-target="#to_edit">Edit</button>
                  @endif
                  @if((Auth::user()->rank >= 4) || (Auth::user()->guild_rank >= AccountData::is_rqruiter($profile['guild_id'])))
                    <button type="button" class="btn btn-outline-danger btn-sm ml-1" data-toggle="modal" data-target="#to_edit">Delete</button>
                  @endif
                </div>
              </div>
            </div>
            @php
              $counter++;
            @endphp
            @else
              </div>
              <div class="row row-cols-1 row-cols-md-3 g-4">
                @php
                  $counter = 0;
                @endphp
            @endif

            @endforeach
            
          </div>

        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
          Events history
        </div>
        
      </div>

      
    
</div>
@endsection

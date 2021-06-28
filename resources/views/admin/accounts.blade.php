@php
    use App\Http\Controllers\AdminAccData;
@endphp
    <link rel="stylesheet" href="{{ asset('css/admin_account.css') }}">
    <div class="container-fluid p-2 h-auto w-auto" >
        <div class="row row-cols-xl-2">
            <div class="col-2" id="adm_nav">
                <div class="list-group list-group-vertical-sm" id="myList" role="tablist">
                    @foreach($accounts as $account)
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#{{ $account['token'] }}" role="tab">{{ ucfirst($account['username']) }}</a>
                    @endforeach
                </div>
            </div>
            <div class="col">
                <div class="tab-content">
                    @foreach($accounts as $account)
                   
                            <div class="tab-pane" id="{{ $account['token'] }}" role="tabpanel">
                                <form action="/save_profile" method="get">
                                <div class="row">
                                    <div class="col">
    
                                        <div class="card bg-dark text-white">
                                            <img src="{{ url(AdminAccData::get_picture($account['username'])) }}" class="card-img rounded-circle" style="height: 60px; width: 60px;" alt="...">
                                            <div class="card-img-overlay">
                                              <h5 class="card-title"></h5>
                                              <p class="card-text">
                                                  <div class="row float-right">
                                                      <div class="col float-right">
                                                        <h5>
                                                        @if(strcmp($account['username'],Auth::user()->name) == 0)
                                                            ME
                                                        @else
                                                            {{ ucfirst($account['username']) }} 
                                                        @endif
                                                        </h5>
                                                      </div>
                                                      <div class="col float-right">
                                                        @if(strcmp($account['username'],Auth::user()->name) == 0)
                                                        <a href="/my_account" class="btn btn-outline-primary btn-sm " role="button" aria-disabled="true">View profile</a>
                                                        @else
                                                        <a href="/view_profile?username={{ $account['username'] }}" class="btn btn-outline-primary btn-sm " role="button" aria-disabled="true">View profile</a> 
                                                        @endif
                                                        
                                                      </div>
                                                  </div>
                                                
                                            </div>
                                              
                                        </div>
    
                                    </div>
                                        
                                </div>
                                <div class="row pt-3">
                                    <div class="col">
                                        Faction
                                    </div>
                                    <div class="col">
                                        <select name="new_faction">
                                            @if(strcmp(AdminAccData::get_faction($account['username']),"Horde") == 0)
                                                <option selected>Horde</option>
                                                <option>Alliance</option>
                                            @endif
                                            @if(strcmp(AdminAccData::get_faction($account['username']),"Alliance") == 0)
                                                <option>Horde</option>
                                                <option selected>Alliance</option>
                                            @endif
                                            @if(strcmp(AdminAccData::get_faction($account['username']),"No Faction") == 0)
                                                <option selected>No Faction</option>
                                                <option>Horde</option>
                                                <option>Alliance</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="row pt-2">
                                    <div class="col">
                                        Username
                                    </div>
                                    <div class="col">
                                        <input type="text" placeholder="Chose another?" name="new_username">
                                    </div>
                                </div>

                                <div class="row pt-2">
                                    <div class="col">
                                        Web Rank
                                    </div>
                                    <div class="col">
                                        <select name="new_rank_web">
                                            <option selected>{{ AdminAccData::get_current_webrank($account['user_id']) }}</option>
                                            @foreach(AdminAccData::get_rank() as $webrank)
                                                <!-- AVOID DOUBLE VALUES WITH SELLECTED ONE -->
                                                @if(strcmp($webrank['rank'],AdminAccData::get_current_webrank($account['user_id'])) != 0)
                                                    <option>{{ $webrank['rank'] }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row pt-2">
                                    <div class="col">
                                        Rank
                                    </div>
                                    <div class="col">
                                        <select name="new_rank">
                                            <option selected>{{ AdminAccData::get_current_rank($account['guild_id'],$account['g_rank_id']) }}</option>
                                            @if($account['guild_id'] > 0)
                                                @foreach(AdminAccData::get_guild_ranks($account['guild_id']) as $rank)
                                                    @if(strcmp(AdminAccData::get_current_rank($account['guild_id'],$account['g_rank_id']),$rank['rank_name']) != 0)
                                                        <option id="12">{{ $rank['rank_name'] }}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="row pt-2">
                                    <div class="col">
                                        Guild
                                    </div>
                                    <div class="col">
                                        <select name="new_guild">
                                            <option selected>{{ AdminAccData::get_guild_name($account['guild_id']) }}</option>
                                            @foreach(AdminAccData::get_guilds() as $guild)
                                                @if(strcmp(AdminAccData::get_guild_name($account['guild_id']),$guild['guild_name']) != 0)
                                                    <option>{{ $guild['guild_name'] }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row pt-2">
                                    <div class="col">
                                        DKP NET
                                    </div>
                                    <div class="col">
                                        <input type="number" name="new_net_dkp" value="{{ AdminAccData::get_net_dkp($account['username']) }}">
                                    </div>
                                </div>
                                <div class="row pt-2">
                                    <div class="col">
                                        DKP TOT
                                    </div>
                                    <div class="col">
                                        <input type="number" name="new_tot_dkp" value="{{ AdminAccData::get_tot_dkp($account['username']) }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">Comunity rank</div>
                                    @if($account['banned'] == 0)
                                        <div class="col">{{ AdminAccData::calc_comunity_rank($account['user_id'])['rank'] }}</div>
                                    @else
                                        <div class="col">Suspended</div>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col">
                                        @if($account['banned'] == 1)
                                            <div class="progress" style="height: 25px;">
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Locked.</div>
                                            </div>
                                        @else
                                        <div class="progress" style="height: 25px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{ AdminAccData::calc_comunity_rank($account['user_id'])['percent'] }}" aria-valuemin="0" aria-valuemax="100" style="width: 75%">[{{ AdminAccData::calc_comunity_rank($account['user_id'])['current'] }}\{{ AdminAccData::calc_comunity_rank($account['user_id'])['maximum'] }}] until next level</div>
                                        </div>
                                    @endif
                                    </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="btn-toolbar pull-right pt-2" role="group" aria-label="Basic outlined example">
                                            @if($account['banned'] == 1)
                                                <a href="/unban?user_id={{ $account['user_id'] }}" class="btn btn-outline-danger btn-sm mr-1" role="button" aria-disabled="false">Unban</a>
                                            @else
                                                <button type="button" class="btn btn-outline-danger mr-1 btn-sm" data-toggle="modal" data-target="#ban_user">Ban</button>
                                            @endif
                                            

                                            <a href="#" class="btn btn-outline-danger btn-sm mr-1" role="button" aria-disabled="false">Delete</a>
                                            <button type="button" class="btn btn-outline-warning mr-1 btn-sm">Warn</button>
                                            <button type="submit" class="btn btn-outline-success mr-1 btn-sm">Save</button>
                                            <a href="#" class="btn btn-outline-info btn-sm mr-1" role="button" aria-disabled="false">Flag rename</a>
                                            @if(strcmp($account['email_verified'],'') == 0)
                                            <a href="#" class="btn btn-outline-info btn-sm mr-1" role="button" aria-disabled="false">Email verify request</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                </div>
                                <input type="hidden" name="user_id_to_edit" value="{{ $account['user_id'] }}">
                                </form>
                                

                            </div>

                            <!-- modals here -->
                            

                    @endforeach
                    
            </div>
        </div>
    </div>


</div>

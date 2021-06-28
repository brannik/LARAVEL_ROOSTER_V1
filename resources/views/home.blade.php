@extends('layouts.app')
@section('title','News feed')
@php
  use App\Http\Controllers\Permission;
@endphp
@section('new_post_button')
@if(Permission::check('post_news') == true)
<button type="button" class="btn btn-outline-primary float-right btn-sm" data-toggle="modal" data-target="#exampleModal">
  New post
</button>
@endif
@endsection

@section('content')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<div class="container pt-2">
  <form action="/new_post" method="get">  
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create new post</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" name="post_title" placeholder="Title..">
                    <textarea class="form-control" cols="63" rows="4" name="post_text" placeholder="Text.."></textarea>
                </div>
                <div class="modal-footer">
                    <input type="checkbox" aria-label="Checkbox for following text input" title="Locked?" name="check_important">Important
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Post</button>
                </div>
            </div>
        </div>
    </div>
  </form>
        
    @isset($data)
        @foreach($data as $post)

            <!-- category body-->
            <!-- border color depending on author rank -->
            @if($post['important'] == 1)
              <div class="card bg-transparent border-warning">
            @else
              <div class="card bg-transparent border-info">
            @endif
            
                <div class="card-header">
                      {{ $post['category_title'] }}
                      
                        <div class="btn-group float-right" role="group" aria-label="Basic example">
                          @if(Permission::check('edit_news') == true)
                          <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#edit_post{{ $post['token'] }}">Edit</button>
                          @endif
                          @if(Permission::check('delete_news') == true)
                          <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#delete_post{{ $post['token'] }}">Delete</button>
                          @endif
                        </div>


                        <!-- delete post -->
                        <form action="/delete_post" method="get">
                        <div class="modal fade" id="delete_post{{ $post['token'] }}" tabindex="-1" role="dialog" aria-labelledby="delete_post" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="delete_post{{ $post['token'] }}">Delete post ?</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                  </div>
                                  <div class="modal-body">
                                      <p>{{ $post['category_title']  }}</p>
                                  </div>
                                  <div class="modal-footer">
                                    <input type="hidden" name="token" value="{{ $post['token'] }}">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <button type="submit" class="btn btn-primary">Delete</button>
                                  </div>
                              </div>
                          </div>
                      </div>
                    </form>
                      <!-- edit post -->
                      <form action="/edit_post" method="get">
                      <div class="modal fade" id="edit_post{{ $post['token'] }}" tabindex="-1" role="dialog" aria-labelledby="edit_post" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="edit_post{{ $post['token'] }}">Edit post ?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <div class="modal-body">
                                  <input type="text" class="form-control" name="post_title" value="{{ $post['category_title'] }}">
                                    <textarea cols="63" rows="4" class="form-control" name="post_text">{{ $post['category_sample']  }}</textarea>
                                    
                                </div>
                                <div class="modal-footer">
                                       
                                      @if($post['important'] == 1)
                                      <label for="important_state">Important </label> 
                                      <input type="checkbox" aria-label="Checkbox for following text input" name="important_state" title="Locked?" value="on" checked>
                                      @else
                                      <label for="important_state">Important ?</label> 
                                      <input type="checkbox" aria-label="Checkbox for following text input" name="important_state" title="Locked?" value="off">
                                      @endif
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <input type="hidden" name="token" value="{{ $post['token'] }}">
                                      
                                      <button type="submit" class="btn btn-primary">Save</button>           
                                </div>
                            </div>
                        </div>
                    </div>
                  </form>
                     
                    
                </div>
                <div class="card-body">
                  <blockquote class="blockquote mb-0">

                    <div class="media my-1 p-1 text-info">
                      <img class="align-self-start mr-3 rounded-circle" src="{{ url($post['user_pic']) }}" alt="Generic placeholder image" style="width: 44px; height: 44px;">
                      <div class="media-body">
                        <h6 class="mt-0">
                          {{ $post['category_sample'] }}
                        </h6>
                      </div>
                    </div>

                    <p></p>
                    @if($post['author_id'] == Auth::user()->id)
                      @if($post['author_banned'] == 1)
                        <footer class="blockquote-footer">author <cite title="View user profile"><a href="/my_account"><span class="badge badge-pill badge-danger">Suspended: ME</span></cite><span class="float-right"><cite>{{ $post['time'] }}</cite></a></span></footer>
                      @else
                        <footer class="blockquote-footer">author <cite title="View user profile"><a href="/my_account"><span class="{{ $post['author_color'] }}">{{ $post['rank_name'] }}: ME 
                          @if(Cache::has('user-is-online-' . $post['author_id']))
                          <span class="badge rounded-pill bg-success"> Online</span>
                            @else
                          <span class="badge rounded-pill bg-danger"> Offline</span>
                          @endif
                        </span></cite><span class="float-right"><cite>{{ $post['time'] }}</cite></a></span></footer>
                      @endif
                    @else
                      @if($post['author_banned'] == 1)
                        <footer class="blockquote-footer">author <cite title="View user profile"><a href="/view_profile?username={{ $post['category_author'] }}"><span class="badge badge-pill badge-danger">Suspended: {{ ucfirst($post['category_author']) }}</span></cite><span class="float-right"><cite>{{ $post['time'] }}</cite></a></span></footer>
                      @else
                        <footer class="blockquote-footer">author <cite title="View user profile"><a href="/view_profile?username={{ $post['category_author'] }}"><span class="{{ $post['author_color'] }}">{{ $post['rank_name'] }}: {{ ucfirst($post['category_author']) }}
                          @if(Cache::has('user-is-online-' . $post['author_id']))
                          <span class="badge rounded-pill bg-success"> Online</span>
                            @else
                          <span class="badge rounded-pill bg-danger"> Offline</span>
                          @endif
                        </span></cite><span class="float-right"><cite>{{ $post['time'] }}</cite></a></span></footer>
                      @endif
                    @endif
                    
                  </blockquote>
                </div>
              </div>
            <br>
        @endforeach
        @if($pages > 1)
          <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center pagination-sm">
              @if($curr_page > 1)
                <li class="page-item"><a class="page-link" href="/view_home_page?page={{ $curr_page - 1 }}">Previous</a></li>
              @endif
              @for($i = 0; $i < $pages; $i++)
                @if($i+1 == $curr_page)
                  <li class="page-item active"><a class="page-link" href="/view_home_page?page={{ $i + 1 }}">{{ $i+1 }}<span class="sr-only">(current)</span></a></li>
                @else
                  <li class="page-item"><a class="page-link" href="/view_home_page?page={{ $i + 1 }}">{{ $i+1 }}</a></li>
                @endif              
              @endfor
              @if($curr_page < $pages)
                <li class="page-item">
                  <a class="page-link" href="/view_home_page?page={{ $curr_page + 1 }}">Next</a>
                </li>
              @endif
            </ul>
          </nav>
        @endif
    @endisset
</div>
@endsection

@extends('layouts.app')
@section('title','Forum')
@section('content')
<div class="container">
  <p class="card-text">Some random header text.</p>               
    @isset($category)
      @foreach($category as $categ)
        <div class="card bg-transparent border-info">
          <h5 class="card-header">
            <a href="#">{{ $categ['title'] }}</a>
          </h5>
          <div class="card-body">
          <h5 class="card-title">{{ $categ['author'] }}</h5>
          <p class="card-text">{{ $categ['short_text'] }}</p>
          <footer class="blockquote-footer">posts <cite title="Source Title">{{ $categ['posts_count'] }}</cite></footer>
          </div>
        </div>
        <br>
        @endforeach
        <br>
        @if($pages > 1)
          <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center pagination-sm bg-dark">
              @if($curr_page > 1)
                <li class="page-item"><a class="page-link" href="/view_category_page?page={{ $curr_page - 1 }}">Previous</a></li>
              @endif
              @for($i = 0; $i < $pages; $i++)
                @if($i+1 == $curr_page)
                  <li class="page-item active"><a class="page-link" href="/view_category_page?page={{ $i + 1 }}">{{ $i+1 }}<span class="sr-only">(current)</span></a></li>
                @else
                  <li class="page-item"><a class="page-link" href="/view_category_page?page={{ $i + 1 }}">{{ $i+1 }}</a></li>
                @endif              
              @endfor
              @if($curr_page < $pages)
                <li class="page-item">
                  <a class="page-link" href="/view_category_page?page={{ $curr_page + 1 }}">Next</a>
                </li>
              @endif
            </ul>
          </nav>
        @endif
      @endisset
</div>
@endsection

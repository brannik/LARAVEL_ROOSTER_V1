@extends('layouts.admin')
@section('title','Admin Controll Panel')
@section('content')
<link rel="stylesheet" href="{{ asset('css/admin_account.css') }}">
<div class="container h-75 bg-dark text-warning p-3 position-fixed ml-4 mb-4">
    <div class="row h-100">
      <div class="col float-left w-100" id="left-nav">
        <div class="d-flex align-items-start">
          <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Accounts</button>
            <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Guilds</button>
            <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Characters</button>
            <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Forums</button>
            <button class="nav-link" id="v-pills-news-tab" data-bs-toggle="pill" data-bs-target="#v-pills-news" type="button" role="tab" aria-controls="v-pills-news" aria-selected="false">News</button>
            <button class="nav-link" id="v-pills-website-tab" data-bs-toggle="pill" data-bs-target="#v-pills-website" type="button" role="tab" aria-controls="v-pills-website" aria-selected="false">Website</button>
          </div>
          <div class="tab-content h-100" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
              <div class="border border-warning" id="adm_container">
                @include('admin.accounts',['accounts' => $accounts])
              </div>
            </div>
            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
              <div class="border border-warning" id="adm_container">
                Guild Settings
              </div>
            </div>
            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
              <div class="border border-warning" id="adm_container">
                Character settings
              </div>
            </div>
            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
              <div class="border border-warning" id="adm_container">
                Forum settings
              </div>
            </div>
            <div class="tab-pane fade" id="v-pills-news" role="tabpanel" aria-labelledby="v-pills-news-tab">
              <div class="border border-warning" id="adm_container">
                News
              </div>
            </div>
            <div class="tab-pane fade" id="v-pills-website" role="tabpanel" aria-labelledby="v-pills-website-tab">
              <div class="border border-warning" id="adm_container">
                @include('admin.settings')
              </div>
            </div>
          </div>
        </div>
      </div>
      
      
    </div>

</div>
@endsection

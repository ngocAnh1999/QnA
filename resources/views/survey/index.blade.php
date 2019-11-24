@extends('layouts.app')
@section('title', 'Phiên khảo sát')
@section('content')
@push('styles')
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    <link href="{{ asset('css/survey/indexSurvey.css') }}" rel="stylesheet">
@endpush
<div class="body-content">    
    <div class="row toolbar border-bottom d-flex justify-content-between align-content-center px-0">
        <nav class="navbar navbar-expand-sm bg-white navbar-white"> 
            <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Các phiên </a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Tất cả các phiên</a>
                    <a class="dropdown-item" href="#">Phiên đang hoạt động</a>
                    <a class="dropdown-item" href="#">Phiên đã đóng</a>
                    <a class="dropdown-item" href="#">Các phiên của tôi</a>
                  </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('createSurvey') }}">Tạo phiên khảo sát mới</a>
                </li>
            </ul>
        </nav>
        <form class="search-cls" action="#" method="post">
            @csrf
                <input class="h-100" name="search" placeholder="Tìm kiếm" />
                <button class="ml-2 px-4 btn btn-success h-100" type="submit"><span class="glyphicon glyphicon-search"></span></button>
        </form> 
    </div>
    <div class="row content mx-auto d-flex flex-column align-items-center">
        @empty($sessions)          
        <div class="t_max text-secondary">Chưa có phiên nào!</div>
        @endempty
        @if(isset($sessions))
        <table class="table-bordered">
            <thead>
                <tr class="bg-dark text-white">
                    <th scope="col">STT</th>
                    <th scope="col">Session name</th>
                    <th scope="col">Time start</th>
                    <th scope="col">Time end</th>
                    <th scope="col">Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
        </table>
        @endif
    </div>
</div>
@endsection
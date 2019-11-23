@extends('layouts.app')
@section('title', 'Phiên khảo sát')
@section('content')
@push('styles')
    <link href="{{ asset('css/survey/indexSurvey.css') }}" rel="stylesheet">
@endpush
<div class="body-content">
    <div class="row toolbar border-bottom d-flex justify-content-between align-content-center px-0">
        <div class="form-group">
            <select class="btn list-session h-100 shadow">
                <option class="m-8" value="all" >Tất cả các phiên</option>
                <option class="m-8" value="activated" >Phiên đang hoạt động</option>
                <option class="m-8" value="closed" >Phiên đã đóng</option>
                <option class="m-8" value="my-session" selected>Các phiên của tôi</option>
            </select>
        </div>
            <form class="search-cls" action="#" method="post">
                @csrf
                    <input class="h-100" name="search" placeholder="Tìm kiếm" />
                    <button class="ml-2 px-4 btn btn-success h-100" type="submit"><span class="glyphicon glyphicon-search"></span></button>
            </form>
    </div>
    <div class="row px-4 py-2">
        <button data-toggle="modal" data-target="#addModal" class="btn btn-success rounded-circle">
            <span class="glyphicon glyphicon-plus"></span>
        </button>
        @error('time_start')
            <script>
                alert("lỗi !!!!");
            </script>
        @enderror
    </div>
    <div class="row content mx-auto d-flex flex-column align-items-center">
        @empty($sessions)
            
        <div class="t_max text-center">Chưa có phiên nào!</div>
        @endempty
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
    </div>
</div>

@endsection
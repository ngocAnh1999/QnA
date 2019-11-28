@extends('layouts.app')
@section('title', 'Phiên khảo sát')
@section('content')
@push('styles')
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    <link href="{{ asset('css/survey/indexSurvey.css') }}" rel="stylesheet">
@endpush
<div class="body-content">    
    <div class="row content mx-auto d-flex flex-column align-items-center">
        <div class="row toolbar border-bottom d-flex justify-content-between align-content-center px-0">
            <nav class="navbar navbar-expand-sm navbar-collapse bg-light">
                <div class="list-session h-100 p-2 dropdown-toggle nav-item border-right "
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @switch(Request::path())
                @case('survey/all')
                    Tất cả các phiên
                    @break
                @case('survey/own')
                    Các phiên của tôi
                @break
                @case('survey/opened')
                    Phiên đang mở
                @break
                @case('survey/locked')
                    Phiên bị khóa
                    @break
                @default 
                    <span class="glyphicon glyphicon-th-list"></span>
            @endswitch
                </div>
                <ul class="dropdown-menu dropdown-menu-left px-4">
                    <li role="presentation" class="text-left">
                        <a role="menuitem" href="{{ route('survey', 'all') }}">Tất cả các phiên</a>
                    </li>
                    <li role="presentation" class="text-left">
                        <a role="menuitem" href="{{ route('survey', 'opened') }}">Phiên đang mở</a>
                    </li>
                    <li role="presentation" class="text-left">
                        <a role="menuitem" href="{{ route('survey', 'locked') }}">Phiên bị khóa</a>
                    </li>
                    @hasrole('admin')
                    <li role="presentation" class="text-left">
                        <a role="menuitem" href="{{ route('survey', 'own') }}">Các phiên của tôi</a>
                    </li>
                    @endhasrole
                </ul>
                <a class="py-2 px-3 border-right nav-item" href="{{ route('newSurvey') }}">Tạo phiên mới</a>
                <a class="py-2 px-3 nav-item" href="#">
                    <span class="glyphicon glyphicon-indent-left"></span>
                    Thống kê
                </a> 
                <div class="text-secondary ml-auto">
                    <h2 class="my-auto">Phiên khảo sát</h2>
                </div>
            </nav>
            
            
        </div>
        {{-- @if(sizeof($sessions) > 0)
        <div class="w-100 t_max text-success">Thống kê phiên làm việc</div>
        @else 
        <div class="t_max text-secondary">Chưa có phiên nào!</div>
        @endif --}}

        <div class="m-2"></div>
        <div class="w-100">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Phiên khảo sát</th>
                        <th scope="col">Mô tả</th>
                        <th scope="col">Người tạo</th>
                        <th scope="col">trạng thái</th>
                        @hasrole('admin')
                        <th scope="col">Chỉnh sửa</th>
                        <th scope="col">Xóa</th>
                        @endhasrole
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td><a href="#">Phiên khảo sát ABCD</a></td>
                        <td>Mo ta</td>
                        <td><a href="#">admin</a></td>
                        <td data-toggle="tooltip" title="Bị khóa">
                            <span class="text-danger glyphicon glyphicon-ban-circle"></span>
                        </td>
                        @hasrole('admin')
                        <td>
                            <span class="glyphicon glyphicon-pencil"></span>
                        </td>
                        <td>
                            <span class="glyphicon glyphicon-trash"></span>
                        </td>
                        @endhasrole
                    </tr>
                    <tr>
                        <td>2</td>
                        <td><a href="#">Phiên khảo sát ABCD</a></td>
                        <td>Mo ta</td>
                        <td><a href="#">admin</a></td>
                        <td data-toggle="tooltip" title="Đang mở">
                            <span class="text-success glyphicon glyphicon-ok-sign"></span>
                        </td>
                        @hasrole('admin')
                        <td>
                            <span class="glyphicon glyphicon-pencil"></span>
                        </td>
                        <td>
                            <span class="glyphicon glyphicon-trash"></span>
                        </td>
                        @endhasrole
                    </tr>
                </tbody>
            </table>

        </div>


    </div>
</div>
@endsection
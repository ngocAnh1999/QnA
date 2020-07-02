@extends('layouts.app')
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
                @hasrole('admin')
                <a class="py-2 px-3 border-right nav-item text-success" 
                    data-toggle="modal" data-target="#newModal">Tạo phiên mới
                </a>
                <a class="py-2 px-3 nav-item" href="{{ route('statistic') }}">
                    <span class="glyphicon glyphicon-indent-left"></span>
                    Thống kê
                </a>
                @endhasrole
                <div class="text-secondary ml-auto">
                    <h2 class="my-auto">Phiên khảo sát</h2>
                </div>
            </nav>
            <div class="modal fade" id="newModal">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                  
                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title text-info">Tạo phiên khảo sát</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
                    <!-- Modal body -->
                    <form action="{{ route('createSurvey') }}" method="post">
                        @csrf
                        <div class="modal-body text-left">
                            <label class="text-secondary">Tên phiên:</label>
                            <div>
                            <input type="text" name="sur_name" placeholder="Nhập tên phiên"/>
                            <span class="text-danger">(*)</span>
                            </div>
                            <label class="text-secondary mt-2">Mô tả:</label>
                            <div>
                                <input type="text" name="sur_des" placeholder="Nhập mô tả" />
                                <span class="text-danger">(*)</span>
                            </div>
                            <label class="text-secondary w-100 mt-2">Mật khẩu phiên (nếu có):</label>
                            <input type="password" name="sur_pass" />
                        </div>
                        
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button class="btn btn-success" type="submit">Chuyển tiếp</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        </div>
                    </form>
                    
                  </div>
                </div>
              </div>
            
        </div>

        <div class="m-2"></div>
        <div class="row w-100">
            @yield('survey_content')
        </div>


    </div>
</div>
@endsection
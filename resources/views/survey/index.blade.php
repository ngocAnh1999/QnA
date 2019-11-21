@extends('layouts.app')

@section('title', 'Phiên khảo sát')

@section('content')
@push('styles')
    <link href="{{ asset('css/survey/indexSurvey.css') }}" rel="stylesheet">
@endpush
<div class="body-content">
    <div class="row toolbar font-weight-bolder border-bottom">
        <div class="col-sm-8 h-100">
            <div class="row h-100">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="./indexSurvey.html">Phiên của tôi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="./createSurvey.html">Tạo phiên khảo sát</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md"></div>

    </div>
    <div class="row content-header">
        <h3 id="survey_id" class="col-md text-info text-center">Phiên khảo sát</h3>
    </div>
    <div class="row content mx-auto d-flex flex-column align-items-center">
        <form action="" method="get" class="wrap bg-white m-4 wrap-content shadow mb-8">
            <h3 name="survey-name" property="survey_1">Tên phiên</h3>
            <p > Mô tả: </p>
            <p > Người tạo: </p>
            <p > Thời gian: </p>
            <div class=" d-flex justify-content-end">
                <button formaction="./answerSurvey.html" type="submit" class="btn btn-primary mr-2">Trả lời</button>
                <button formaction="#" type="submit" class="btn btn-primary mr-2">Thống kê</button>
                <button type="button" onclick="javascript:deleteSurvey(this)" class="btn btn-primary" data-toggle="modal" data-target="#modalDelete">Xóa</button>
            </div>
        </form>
        
    </div>
</div>

@endsection
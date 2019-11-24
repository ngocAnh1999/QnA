@extends('layouts.app')


@section('title', 'Phiên hỏi đáp - Câu hỏi')

@section('content')
@push('styles')
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    <link href="{{ asset('css/qna/questionQna.css') }}" rel="stylesheet">
@endpush

<div class="body-content">
        <div class="row toolbar font-weight-bolder border-bottom">
            <div class="col-sm-8 h-100">
                <div class="row h-100">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="">Phiên của tôi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="">Tạo phiên khảo sát</a>
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
        <div class="modal" id="modalDelete">
            <div class="modal-dialog">
                <div class="modal-content">

                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">Delete Survey</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>

                  <!-- Modal body -->
                    <form action="#" method="post">
                      <div class="modal-body">
                        Bạn có muốn xóa phiên <span id="survey-name" name="survey-name"></span> không ?
                      </div>

                      <!-- Modal footer -->
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" >Xóa</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
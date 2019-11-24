@extends('layouts.app')
@section('title', 'Phiên hỏi đáp')
@section('content')
@push('styles')
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    <link href="{{ asset('css/qna/indexQna.css') }}" rel="stylesheet">
@endpush
<div class="body-content">
    <div class="row toolbar border-bottom d-flex justify-content-between align-content-center px-0">
        <div class="">
           <a> Câu hỏi 
           <span class=" glyphicon glyphicon-chevron-right""></span>  
            Câu trả lời</a>
        </div>
    </div>
    <div class="row px-4 py-2">
        <button data-toggle="modal" data-target="#addModal" class="btn bg-info text-white ">
            <span>Thêm câu trả lời</span>
        </button> 
    </div>
    <div class="wrap-content p-3 border-dark  bg-white d-flex justify-content-between w-50">
        <div class="d-flex align-items-start flex-column bd-highlight mb-3" style="height: 150px;">
          <div class="mb-auto p-2 bd-highlight">
            <div class="user-account d-flex mr-4">
              <div class="avatar"><img class="rounded-circle" src="#" />
              </div>
                <a class="my-auto" href="#">User 5</a>
            </div>
          </div> 
          <div class="mb-5 p-3 bd-highlight">
              <p>[Chủ đề]:&nbsp;<span>Tên chủ đề</span></p>
              <a>Nội dung câu hỏi:</a>
          </div>
        </div>
    </div>
    <div class="row content mx-auto d-flex flex-column align-items-center">
        <form action="" method="get" class="wrap bg-white m-4 wrap-content shadow mb-8">
            <p > Người trả lời: </p>
            <p > Nội dung: </p>
            <div class=" d-flex justify-content-end">
                <button type="button" onclick="javascript:deleteSurvey(this)" class="btn btn-primary mr-2" data-toggle="modal" data-target="#modalEdit">Sửa</button>
                <button type="button" onclick="javascript:deleteSurvey(this)" class="btn btn-primary" data-toggle="modal" data-target="#modalDelete">Xóa</button>
            </div>
        </form>    
    </div>


    <div id="addModal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-dialog-centered">   
        <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title text-primary font-weight-bold">Thêm trả lời</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <form action="{{ route('addSession') }}" method="post">
                <div class="modal-body d-flex flex-column"> 
                  <label for="">Nội dung:</label>
                  <div>
                    <textarea onkeyup="javascript:validate(this);" style="resize:none" class="w-75" name="noidung" value="" cols="30" rows="5"></textarea>
                      <span class="text-danger">&nbsp;(*)</span>
                  </div>
                   <span class="text-danger d-none"><strong>{{ $message }}</strong></span>  
                </div>
                <div class="modal-footer">
                  <button type="submit" id="" class="btn btn-success">Save</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
          </form>
        </div>
      </div>          
    </div>
    <div class="modal" id="modalDelete">
        <div class="modal-dialog">
            <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Delete Answer</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- Modal body -->
                <form action="#" method="post">
                  <div class="modal-body">
                    Bạn có muốn xóa câu trả lời <span id="survey-name" name="survey-name"></span> không ?
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
    <div id="modalEdit" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-primary font-weight-bold">Sửa câu trả lời</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="#" method="post">
                    <div id="edit-modal" class="modal-body d-flex flex-column">
                        <label for="">Nội dung:</label>
                        <div>
                            <textarea onkeyup="javascript:validate(this);" style="resize:none"
                                class="e-noidung w-75" name="noidung" value="{{ old('noidung') }}" cols="30"
                                rows="5"></textarea>
                            <span class="text-danger">&nbsp;(*)</span>
                        </div>
                        <span class="text-danger d-none"><strong>error</strong></span>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <button type="button" class="btn btn-link mr-10"> << Câu hỏi trước</button>
    <button type="button" class="btn btn-link mr-5" > Câu hỏi sau >> </button>  
</div>
@endsection
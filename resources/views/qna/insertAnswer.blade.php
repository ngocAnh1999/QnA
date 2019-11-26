@extends('layouts.app')
@section('title', 'Phiên hỏi đáp')
@section('content')
@push('styles')
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    <link href="{{ asset('css/qna/indexQna.css') }}" rel="stylesheet">
@endpush
<div class="body-content">
    <div class="row toolbar border-bottom d-flex justify-content-between align-content-center px-0">
        <div class="d-flex flex-row">
            <!-- toolbar -->
            <a href="{{ route('qna','all') }}"> Phiên hỏi đáp&nbsp;</a>
            <span class="glyphicon glyphicon-chevron-right"></span>
            <a href="{{ route('showQuestion', $session->id) }}">&nbsp;{{ $session->name }}</a>
            <span class="glyphicon glyphicon-chevron-right"></span>
            <p class="text-secondary">&nbsp;{{ $question->title }}</p>
        </div>
        <form class=" search-cls" action="#" method="post">
            @csrf
                    <input type="hidden" name="_token" value="ZgU7Yorh1VFOkX8Snm3bIC9WngMAPQOYiOU7N7Jw"> 
                    <input class="h-100" name="search" placeholder="Tìm kiếm">
                    <button class="ml-2 px-4 btn btn-success h-100" type="submit"><span
                            class="glyphicon glyphicon-search"></span></button>
        </form>

    </div>
    <div class="row px-4 py-2">
        <button data-toggle="modal" data-target="#addModal" class="btn bg-success text-white ">
            <span>Thêm câu trả lời</span>
        </button> 
    </div>
    
    <div class="wrap-content p-3 bg-light d-flex justify-content-between w-75 mx-auto mb-2">

        <div class="d-flex border-bottom-info flex-column bd-highlight mb-3 w-75">
            <div class="mb-auto p-2 bd-highlight">
                <div class="user-account d-flex mr-4">
                    <div class="avatar">
                        <img class="rounded-circle"
                            src="{{ asset('storage/image/default_avata.png') }}" />
                    </div>
                    <a name="user_name" class="my-auto" href="#">{{ $q_user->name }}</a>
                </div>
            </div>
            <div class="mb-5 p-3 bd-highlight">
                <p class="text-lg-left text-primary">[Chủ đề]:&nbsp;<a href="#" name="title">{{ $question->title }}</a></p>
            <p class="text-lg-left text-secondary">[Câu hỏi]:&nbsp;
                <span class="text-dark" name="content" >{{ $question->content }}</span>
            </p>
                <p class="text-small text-secondary">Cập nhật lúc: {{ (new \DateTime($question->updated_at))->format('H:i d-m-Y') }}</p>
            </div>

        </div>

        <div class="d-flex align-items-end flex-column bd-highlight mb-3" >
            @if(Auth::user()->id == $question->user_id)
            <div class="p-2 bd-highlight">
                <button onclick="javascript:editModal(this)" class="btn bg-white  h-100"
                    data-toggle="modal" data-target="#editModal">
                    <span class="glyphicon glyphicon-pencil"></span>
                </button>
                
                <button onclick="javascript:deleteModal(this);" class="btn bg-white h-100"
                    data-toggle="modal" data-target="#deleteModal">
                    <span class="glyphicon glyphicon-trash"></span>
                </button>
            </div>
            @endif
        </div>
    </div>
    <div class="text-lg-center font-weight-bold text-secondary mb-2">_______________Trả lời_______________</div>
    <div class="row content mx-auto d-flex flex-column align-items-center">
        @if(count($answers) >0)
            @foreach ($answers as $i => $answer)
            <div id="ans_{{ $i }}" class="wrap border-bottom bg-white wrap-content shadow w-75">
                <div class="mb-auto p-2 bd-highlight">
                    <div class="user-account d-flex mr-4">
                        <div class="avatar">
                            <img class="rounded-circle"
                                src="{{ asset('storage/image/default_avata.png') }}" />
                        </div>
                        <a name="user_name" class="my-auto" href="#">{{ $answer->name }}</a>
                        <blockquote class="blockquote m-0 my-auto ml-3">đã trả lời</blockquote>
                    </div>
                </div>
                <p class="q_content text-dark p-2" name="content">
                    {{ $answer->content }}
                </p>
                <blockquote class="blockquote m-0 my-auto ml-3">updated at: {{ (new \DateTime($answer->updated_at))->format('H:i d-m-Y') }}</blockquote>
                
                <div class="mt-4 d-flex justify-content-between">
                    <div class="d-flex">
                        @if($answer->status == 1)
                            <p class="text-success">
                                <span class="glyphicon glyphicon-ok"></span>
                                &nbsp;Admin đã phê duyệt
                            </p>
                        @else 
                            @if(Auth::user()->id == $session->user_id)
                            <a class="ml-4" href="#">
                                <span class="glyphicon glyphicon-saved shadow p-1 border-secondary"></span>
                            </a>
                            @endif
                            <p class="text-secondary">
                                <span class="glyphicon glyphicon-hourglass"></span>
                                &nbsp;Đang chờ phê duyệt
                            </p>
                            
                        @endif
                    </div>
                    @if(Auth::user()->name == $answer->name)
                    <div>
                        <button type="button" onclick="javascript:editAns(this)" class="btn btn-primary mr-2" data-toggle="modal" data-target="#modalEdit">Sửa</button>
                        <button type="button" onclick="javascript:deleteAns(this)" class="btn btn-primary" data-toggle="modal" data-target="#modalDelete">Xóa</button>
                    </div>
                    @endif 
                </div>
            </div>
            @endforeach
            
        </div>
        <div class="bg-white my-4 d-flex justify-content-around">
            <button type="button" class="btn btn-link mr-10"> << Câu hỏi trước</button>
            <button type="button" class="btn btn-link mr-5" > Câu hỏi sau >> </button>  
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
        @else 
            <div class="t_max text-lg-center text-secondary">Chưa có câu trả lời</div>
        @endif 
    <div id="addModal" class="modal fade" role="dialog">
       
      <div class="modal-dialog modal-dialog-centered">   
        <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title text-primary font-weight-bold">Thêm trả lời</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <form action="{{ route('addAnswer',$question->id) }}" method="post">
                @csrf
                <div class="modal-body d-flex flex-column"> 
                  <label for="">Nội dung:</label>
                  <div>
                    <textarea onkeyup="javascript:validate(this);" style="resize:none" class="w-75" name="noidung" cols="30" rows="5"></textarea>
                      <span class="text-danger">&nbsp;(*)</span>
                  </div>
                    <span class="text-danger d-none"><strong>error</strong></span>  
                </div>
                <div class="modal-footer">
                  <button type="submit" id="" class="btn btn-success">Save</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
          </form>
        </div>
      </div>          
    </div>
    
    
</div>
@endsection
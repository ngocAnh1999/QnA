@extends('survey.index')
@section('title', 'Phiên khảo sát - Thêm mới')
@section('survey_content')

<div class="col-md-3 bg-white py-2 text-center">
    <h2 class="text-secondary py-4">Chọn kiểu câu hỏi:<hr class="my-1"/></h2>
    <div class="card my-2 shadow">
        <div class="card-header">Câu hỏi dạng text</div>
        <div class="card-body">
            <button data-toggle="modal" data-target="#textModal"
            class="btn btn-success">Thêm vào phiên
            </button>
        </div>
    </div>
    <div class="card my-2 shadow">
        <div class="card-header">Câu hỏi nhiều lựa chọn</div>
        <div class="card-body">
            <button data-toggle="modal" data-target="#multiModal"
            class="btn btn-success">Thêm vào phiên
            </button>
        </div>
    </div>
    <div class="card my-2 shadow">
        <div class="card-header ">Câu hỏi một đáp án</div>
        <div class="card-body">
            <button data-toggle="modal" data-target="#oneModal"
            class="btn btn-success">Thêm vào phiên
        </button>
        </div>
    </div>
    <div class="card my-2 shadow">
        <div class="card-header ">Câu hỏi đánh giá</div>
        <div class="card-body">
            <button data-toggle="modal" data-target="#starModal"
            class="btn btn-success">Thêm vào phiên
        </button>
        </div>
    </div>
    <!-- The Modal -->
    <div class="modal fade" id="textModal">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title text-primary">Thêm câu hỏi dạng text</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <form action="{{ route('saveQuestion', $session->id) }}" method="post">
                @csrf
                <div class="modal-body text-left">
                    <input class="d-none" type="text" name="type" value="text" />
                    <label class="w-100">Nội dung câu hỏi:</label>
                    <input type="text" name="q_content" />
                    <span class="text-danger">(*)</span>
                </div>
                
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Thêm vào</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                </div>
            </form>
            
        </div>
        </div>
    </div>
    <div class="modal fade" id="multiModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title text-primary">Thêm câu hỏi nhiều lựa chọn</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
            
                <form action="{{ route('saveQuestion', $session->id) }}" method="post">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body text-left">
                        <input class="d-none" type="text" name="type" value="multi" />
                        <label class="w-100">Nội dung câu hỏi:</label>
                        <input type="text" name="q_content" />
                        <span class="text-danger">(*)</span>
                        <button onclick="javascript:addMultiAnswer('multi-ans','muls');"
                        type="button" class="btn btn-info my-2">thêm đáp án</button>
                        <input class="d-none" type="number" name="num" id="muls">
                        <div id="multi-ans">
                        </div>

                    </div>
                    
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Thêm vào</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    </div>
                </form>
            
            </div>
        </div>
    </div>
    <div class="modal fade" id="oneModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title text-primary">Thêm câu hỏi một lựa chọn</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                
                    <form action="{{ route('saveQuestion', $session->id) }}" method="post">
                        @csrf
                        <!-- Modal body -->
                        <div class="modal-body text-left">
                            <input class="d-none" type="text" name="type" value="one-ans" />
                            <label class="w-100">Nội dung câu hỏi:</label>
                            <input type="text" name="q_content" />
                            <span class="text-danger">(*)</span>
                            <button onclick="javascript:addMultiAnswer('one-ans','ones');"
                            type="button" class="btn btn-info my-2">thêm đáp án</button>
                            <input class="d-none" type="number" name="num" id="ones">
                            <div id="one-ans">
                            </div>
    
                        </div>
                        
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Thêm vào</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        </div>
                    </form>
                
                </div>
            </div>
        </div>
    <div class="modal fade" id="starModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title text-primary">Thêm câu hỏi đánh giá</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
            
                <form action="{{ route('saveQuestion', $session->id) }}" method="post">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body text-left">
                        <input class="d-none" type="text" name="type" value="star-ans" />
                        <label class="w-100">Nội dung câu hỏi:</label>
                        <div>
                            <input type="text" name="q_content" />
                            <span class="text-danger">(*)</span>
                        </div>
                        <label class="w-100">Số đánh giá:</label>
                        <div>
                            <input type="number" name="total_star" class="w-25" />
                            <span class="text-danger">(*)</span>
                        </div>

                    </div>
                    
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Thêm vào</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    </div>
                </form>
            
            </div>
        </div>
    </div>
</div>
<div class="col-md bg-light">
    <h2 class="text-center text-secondary py-3">Bản xem trước (và chỉnh sửa)</h2>
    <div class="card my-2 mx-auto shadow">
        <div class="card-header text-center text-primary">
            <h3>
                {{ $session->name }}
            </h3>
        </div>
        <form action="#" method="post">
        @csrf
            <div class="card-body">
                <div id="id-content">
                    @if (count($questions) > 0)
                    @foreach ($questions as $i => $question)
                        
                    <div class="text-left mt-4">
                        <h3>Câu hỏi {{ $i+1 }}:&nbsp;
                            <input name="q_content" class="w-75" type="text" value="{{ $question->content }}" />
                        </h3>
                        @switch($question->type)
                            @case("multi")
                                <h3 class="text-secondary">Trả lời:</h3>
                                @foreach($answers as $answer)
                                    @if ($answer->question_id == $question->id)
                                        <div class="text-left d-flex">
                                            <input class="radio my-auto mr-2" type="checkbox" name="q_{{ $i+1 }}" />
                                            <input class="my-2 w-50" value="{{ $answer->content }}" >
                                        </div>
                                    @endif
                                @endforeach
                                @break
                            @case("one-ans")
                                <h3 class="text-secondary">Trả lời:</h3>
                                @foreach($answers as $answer)
                                    @if ($answer->question_id == $question->id)
                                        <div class="text-left d-flex">
                                            <input class="radio my-auto mr-2" type="radio" name="q_{{ $i+1 }}" />
                                            <input class="my-2 w-50" value="{{ $answer->content }}" >
                                        </div>
                                    @endif
                                @endforeach
                                @break
                            @case("star-ans")
                                <h3 class="text-secondary">Trả lời:</h3>
                                @foreach($answers as $answer)
                                    @if ($answer->question_id == $question->id && is_numeric($answer->content) && $answer->status == 1)
                                        @for($i = 0; $i < (int)$answer->content; $i++)
                                            <span class="mx-1 glyphicon glyphicon-heart-empty"></span>
                                        @endfor
                                        <br>
                                        <input class="w-25" type="number" name="total_star" value="{{ $answer->content }}" >
                                        <span>star</span>
                                    @endif
                                @endforeach
                                @break
                            @default
                                
                        @endswitch
                    </div>
                    @endforeach
                    @else
                        <h2 class="text-center text-secondary">Phiên khảo sát chưa có câu hỏi nào!</h2>
                    @endif
                </div>
            </div>
            <div class="card-footer">
                <div class="w-100 text-center">
                    <a href="{{ route('survey','all') }}" class="btn btn-success my-auto mr-2">Hoàn thành</a>
                    <button formaction="{{ route('deleteSurvey',$session->id) }}" formmethod="GET" class="btn btn-danger my-auto" type="submit">Xóa phiên?</button>
                </div>
            </div>
        </form>
    </div>
    <script src="{{ asset('js/survey/create_survey.js') }}"></script>
</div>

@endsection
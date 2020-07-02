@extends('survey.index')
@section('title', 'Phiên khảo sát - Thống kê')
@section('survey_content')

<div class="card w-75 mx-auto">
    <div class="card-body">
        <h2 class="text-center text-primary my-4">{{ $session->name }}</h2>
        <div id="id-content">
            @if (count($questions) > 0)
            @foreach ($questions as $i => $question)
                
            <div class="text-left mt-4">
                <h3>Câu hỏi {{ $i+1 }}: {{ $question->content }}
                </h3>
                <h3 class="text-secondary">Trả lời:</h3>
                @switch($question->type)
                    @case("multi")
                        @foreach($answers as $answer)
                            @if ($answer->question_id == $question->id)
                                <div class="text-left d-flex">
                                    <input class="radio my-auto mr-2" 
                                    type="checkbox" name="answer[]" 
                                    value="{{ $answer->id }}"/>
                                    <label class="w-75" for="">{{ $answer->content }}</label>
                                    <span>Số lượt chọn: {{ $answer->sum_user }}</span>
                                </div>
                            @endif
                        @endforeach
                        @break
                    @case("one-ans")
                        @foreach($answers as $answer)
                            @if ($answer->question_id == $question->id)
                                <div class="text-left d-flex">
                                    <input class="radio my-auto mr-2" 
                                    type="radio" name="answer[]" 
                                    value="{{ $answer->id }}" />
                                    <p class="w-75" for="">{{ $answer->content }}</p>
                                    <span>Số lượt chọn: {{ $answer->sum_user }}</span>
                                </div>
                            @endif
                        @endforeach
                        @break
                    @case("star-ans")
                        
                        @foreach($answers as $answer)
                            @if ($answer->question_id == $question->id && is_numeric($answer->content))
                                @for($i = 0; $i < (int)$answer->content; $i++)
                                    <span class="mx-1 glyphicon glyphicon-heart-empty"></span>
                                    
                                    @endfor
                                    <span class="ml-10">Số lượt chọn: {{ $answer->sum_user }}</span>
                                    <br>
                            @endif
                        @endforeach
                        @break
                    @default
                        @foreach($answers as $answer)
                            @if ($answer->question_id == $question->id)
                                <p class="w-75">{{ $answer->content }}</p>
                                <hr class="w-75">
                            @endif
                        @endforeach
                @endswitch
            </div>
            @endforeach
            @else
                <h2 class="text-center text-secondary">Phiên khảo sát chưa có câu hỏi nào!</h2>
            @endif
        </div>
    </div>
</div>


@endsection
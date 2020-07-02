@extends('survey.index')
@section('title', 'Phiên khảo sát')
@section('survey_content')

<div class="d-flex flex-row">
    <a href="{{ route('survey','all') }}">Phiên khảo sát</a>
    <span class="glyphicon glyphicon-chevron-right"></span>
    <p>{{ $session->name }}</p>
</div>
<div class="row card mx-auto d-flex flex-column w-75">
    <div class="card-header">{{ $session->name }}</div>
    <form action="{{ route('submitAnswer') }}" method="post">
    @csrf
        <div class="card-body text-left">
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
                                        <label class="w-75" for="">{{ $answer->content }}</label>
                                    </div>
                                @endif
                            @endforeach
                            @break
                        @case("star-ans")
                            
                            @foreach($answers as $answer)
                                @if ($answer->question_id == $question->id && is_numeric($answer->content) && $answer->status == 1)
                                    @for($i = 0; $i < (int)$answer->content; $i++)
                                        <span class="mx-1 glyphicon glyphicon-heart-empty"></span>
                                    @endfor
                                    <br>
                                    <input type="text" name="star[]" class="d-none" value="{{ $question->id }}" />
                                    <input class="w-25" name="star[]" />
                                    <span>&nbsp;/ {{ $answer->content }}</span>
                                @endif
                            @endforeach
                            @break
                        @default
                            <input type="text" name="text[]" class="d-none" value="{{ $question->id }}" />
                            <input type="text" name="text[]" id="" class="w-75"/>
                    @endswitch
                </div>
                @endforeach
                @else
                    <h2 class="text-center text-secondary">Phiên khảo sát chưa có câu hỏi nào!</h2>
                @endif
            </div>
        </div>
        @if (count($questions) > 0)
        <div class="card-footer text-center">
           <button type="submit" class="btn btn-success">Hoàn thành khảo sát</button> 
        </div>
        @else 
        <a href="{{ route('survey','all') }}">Quay lại</a>
        @endif
    </form>
</div>

@endsection
@extends('survey.index')
@section('title', 'Phiên khảo sát - Thống kê')
@section('survey_content')
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">STT</th>
            <th scope="col">phiên làm việc</th>
            <th scope="col">Số câu hỏi</th>
            <th scope="col">Lần cập nhật gần nhất</th>
            <th scope="col">Mật khẩu</th>
        </tr>
    </thead>
    <tbody>
        @if(count($sessions) > 0)
        @foreach ($sessions as $i => $session)
            
            <tr>
                <td scope="col">{{ $i+1 }}</td>
                <td>
                    <a href="{{ route('indexStatistic', $session->id) }}">{{ $session->name }}</a>
                </td>
                <td>{{ $session->sum_q }}</td>
                <td>{{ $session->updated_at }}</td>
                @if ($session->required )
                    
                <td>{{ $session->required }}</td>
                @else
                    <td>_</td>
                @endif
            </tr>
        @endforeach
        @endif
    </tbody>
</table>
<div class="row">
    @yield('index_survey')
</div>
@endsection
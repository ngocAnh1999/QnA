@extends('survey.index')
@section('title', 'Phiên khảo sát')
@section('survey_content')
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
        @if (count($sessions) > 0) 
            @foreach ($sessions as $i => $session)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>
                        @if ($session->required != null)
                            <a onclick="document.getElementById('sess_id').value = '{{ $session->id }}'"
                            data-toggle="modal" data-target="#requiredModal" class="text-info">
                                {{ $session->name }}
                            </a>
                        @else 
                            <a onclick=" document.getElementById('id_sess').value ='{{ $session->id }}';
                            document.getElementById('form-ans').submit()" class="text-info" href="#">
                                {{ $session->name }}
                            </a>
                        @endif
                    </td>
                    <td>{{ $session->mota }}</td>
                    <td><a href="#">{{ $session->user_name }}</a></td>
                    @if ($session->required != null)
                        <td data-toggle="tooltip" title="Bị khóa">
                            <span class="text-danger glyphicon glyphicon-ban-circle"></span>
                        </td>
                    @else
                        <td data-toggle="tooltip" title="Đang mở">
                            <span class="text-success glyphicon glyphicon-ok-sign"></span>
                        </td>
                    @endif
                    
                    @hasrole('admin')
                    @if (Auth::user()->name == $session->user_name)
                        <td>
                            <a href="{{ route('newSurvey', $session->id) }}">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('deleteSurvey',$session->id) }}">
                                <span class="glyphicon glyphicon-trash"></span>
                            </a>
                        </td>
                    @else
                        <td>_</td>
                        <td>_</td>
                    @endif
                    
                    @endhasrole
                </tr>
            @endforeach   
        @endif
    </tbody>
</table>
<form id="form-ans" action="{{ route('answerSurvey') }}" method="post" class="d-none">
@csrf
    <input class="d-none" name="session_id" id="id_sess" />
    <input class="d-none" name="required" value="" />
</form>
    
<div class="modal fade" id="requiredModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Nhập khóa phiên</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ route('answerSurvey') }}" method="post">
                @csrf
                <!-- Modal body -->
                <div class="modal-body">
                    <input name="session_id" id="sess_id" class="d-none" />
                    <label class="w-100" for="">Nhập mã khóa:</label>
                    <input type="text" name="required" />
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit">Hoàn thành</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
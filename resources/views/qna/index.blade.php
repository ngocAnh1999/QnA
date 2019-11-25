@extends('layouts.app')


@section('title', 'Phiên hỏi đáp')

@section('content')
@push('styles')
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    <link href="{{ asset('css/qna/indexQna.css') }}" rel="stylesheet">
@endpush
<div class="body-content">
    <div class="row toolbar border-bottom d-flex justify-content-between align-content-center px-0">
        <div>
            <div class="btn list-session h-100 shadow nav-link dropdown-toggle"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @switch(Request::path())
                    @case('qna/all')
                        Tất cả các phiên
                        @break
                    @case('qna/own')
                        Các phiên của tôi
                    @break
                    @case('qna/activated')
                        Phiên đang hoạt động
                    @break
                    @case('qna/closed')
                        Phiên đã đóng
                        @break
                    @default 
                        {{ Request::path() }}
                @endswitch
            </div>
            <ul class="dropdown-menu dropdown-menu-left px-4">
                <li role="presentation" class="text-left">
                    <a role="menuitem" href="{{ route('qna', 'all') }}">Tất cả các phiên</a>
                </li>
                <li role="presentation" class="text-left">
                    <a role="menuitem" href="{{ route('qna', 'activated') }}">Phiên đang hoạt động</a>
                </li>
                <li role="presentation" class="text-left">
                    <a role="menuitem" href="{{ route('qna', 'closed') }}">Phiên đã đóng</a>
                </li>
                @hasrole('admin')
                <li role="presentation" class="text-left">
                    <a role="menuitem" href="{{ route('qna', 'own') }}">Các phiên của tôi</a>
                </li>
                @endhasrole
            </ul>
        </div>
        
        <form class="search-cls" action="#" method="post">
            @csrf
                <input class="h-100" name="search" placeholder="Tìm kiếm" />
                <button class="ml-2 px-4 btn btn-success h-100" type="submit"><span class="glyphicon glyphicon-search"></span></button>
        </form>
        
    </div>
    @hasrole('admin')
    <div class="row px-4 py-2">
        <button data-toggle="modal" data-target="#addModal" class="btn btn-success rounded-circle">
            <span class="glyphicon glyphicon-plus"></span>
        </button>
        @error('time_start')
            <script>
                alert("lỗi !!!!");
            </script>
        @enderror
    </div>
    @endhasrole
    <div class="row content mx-auto d-flex flex-column align-items-center">
        @if(!empty($sessions))
            <table class="table-bordered">
                <thead>
                    <tr class="bg-dark text-white">
                        <th scope="col">STT</th>
                        <th scope="col">Session name</th>
                        <th scope="col">Session mô tả</th>
                        <th scope="col">Time start</th>
                        <th scope="col">Time end</th>
                        <th scope="col">Status</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sessions as $i => $session)
                    <tr property="{{ $session->id }}">
                        <td>{{ $i+1 }}</td>
                        <td class="td-name px-4 text-left">
                            <a href="{{ route('showQuestion', $session->id) }}">{{ $session->name }}</a>
                        </td>
                        <td class="td-mota px-4 text-left">{{ $session->mota }}</td>
                        <td>{{ (new \DateTime($session->time_start))->format('H:i d-m-Y') }}</td>
                        <td>{{ (new \DateTime($session->time_end))->format('H:i d-m-Y') }}</td>
                        <td>
                            @if ((new \DateTime($session->time_start,new DateTimeZone('Asia/Ho_Chi_Minh')))->getTimestamp() - $now->getTimestamp() >0)
                                chưa mở
                            @elseif ((new \DateTime($session->time_end,new DateTimeZone('Asia/Ho_Chi_Minh')))->getTimestamp() - $now->getTimestamp() < 0)
                                đã đóng
                            @else
                                đang hoạt động
                            @endif
                        </td>
                        <td>
                            <button onclick="javascript:EditModal(this)" 
                                class="btn bg-white" data-toggle="modal" data-target="#editModal">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </button>
                        </td>
                        <td>
                            <button onclick="javascript:DeleteModal(this);" 
                                class="btn bg-white" data-toggle="modal" data-target="#deleteModal">
                                <span class="glyphicon glyphicon-trash"></span>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div id="editModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
            
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title text-primary font-weight-bold">Sửa phiên</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <form action="{{ route('editSession') }}" method="post">
                            @csrf
                            <div id="edit-modal" class="modal-body d-flex flex-column">
                                <input name="id" class="e-id d-none" />
                                <label for="">Tên phiên:</label>
                                <div>
                                    <input onkeyup="javascript:validate(this);" 
                                        type="text" name="name" class="e-name w-75" value = "{{ old('name') }}"/>
                                    <span class="text-danger">&nbsp;(*)</span>
                                </div>
                                <label for="">Mô tả:</label>
                                <div>
                                <textarea onkeyup="javascript:validate(this);" style="resize:none" 
                                    class="e-mota w-75" name="mota" value="{{ old('mota') }}" cols="30" rows="5"></textarea>
                                    <span class="text-danger">&nbsp;(*)</span>
                                </div>
                                
                                <label for="">Time start:</label>
                                <div>
                                    <input onkeyup="javascript:validate(this);" type="datetime" 
                                        class="e-start w-75" name="time_start" 
                                        value = "{{ old('time_start') }}" placeholder="H:i dd-mm-yyyy"/>
                                    <span class="text-danger">&nbsp;(*)</span>
                                </div>
                                
                                <label for="">Time end:</label>
                                <div>
                                    <input onkeyup="javascript:validate(this);" type="datetime" class="e-end w-75" 
                                        name="time_end" value="{{ old('time_end') }}" placeholder="H:i dd-mm-yyyy">
                                    <span class="text-danger">&nbsp;(*)</span>
                                </div>
                                <span class="text-danger d-none"></span>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Save</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
            
                </div>
            </div>
            <div id="deleteModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
            
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-primary font-weight-bold">Cảnh báo xóa phiên</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="{{ route('deleteSession') }}" method="post">
                        @csrf
                        <div class="modal-body d-flex flex-column">
                            <p>Bạn có chắc chắn muốn xóa phiên "<span id="del-name"></span>"?</p>
                            <input class="d-none" id="del-id" name="del_id" />
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Xóa</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            
                </div>
            </div>
        @else
            <div class="t_max text-secondary">Chưa có phiên nào!</div>
        @endif
        <div id="addModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
            
                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-primary font-weight-bold">Thêm phiên</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('addSession') }}" method="post">
                    @csrf
                    <div class="modal-body d-flex flex-column">
                        <label for="">Tên phiên:</label>
                        <div>
                            <input onkeyup="javascript:validate(this);" type="text" name="name" class="w-75" value = "{{ old('name') }}"/>
                            <span class="text-danger">&nbsp;(*)</span>
                        </div>
                        @error('name')
                            <span class="text-danger"><strong>{{ $message }}</strong></span>
                        @enderror
                        <label for="">Mô tả:</label>
                        <div>
                        <textarea onkeyup="javascript:validate(this);" style="resize:none" class="w-75" name="mota" value="{{ old('mota') }}" cols="30" rows="5"></textarea>
                            <span class="text-danger">&nbsp;(*)</span>
                        </div>
                        @error('mota')
                            <span class="text-danger"><strong>{{ $message }}</strong></span>
                        @enderror
                        <label for="">Time start:</label>
                        <div>
                            <input onkeyup="javascript:validate(this);" type="datetime" class="w-75" name="time_start" value = "{{ old('time_start') }}" placeholder="H:i dd-mm-yyyy"/>
                            <span class="text-danger">&nbsp;(*)</span>
                        </div>
                        @error('time_start')
                            <span class="text-danger"><strong>{{ $message }}</strong></span>
                        @enderror
                        <label for="">Time end:</label>
                        <div>
                            <input onkeyup="javascript:validate(this);" type="datetime" class="w-75" name="time_end" value="{{ old('time_end') }}" placeholder="H:i dd-mm-yyyy">
                            <span class="text-danger">&nbsp;(*)</span>
                        </div>
                        <span class="text-danger d-none"></span>
                        @error('time_end')
                            <span class="text-danger"><strong>{{ $message }}</strong></span>
                        @enderror
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
    
    <script type="text/javascript" src="{{ asset('js/qna/index.js') }}" ></script>

    
</div>

@endsection

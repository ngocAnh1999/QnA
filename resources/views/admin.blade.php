@extends('layouts.app')

@section('title', 'Admin')

@section('content')
@push('styles')
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
@endpush
<div class="container">
    <div class="row justify-content-center">
        @if (sizeof($users) > 0)
        <div class="t_max text-info my-10">Danh sách người dùng</div>
        <table class="table-striped">
            <thead>
                <tr class="text-center">
                    <th scope="col">ID</th>
                    <th scope="col">username</th>
                    <th scope="col">email</th>
                    <th scope="col">role</th>
                    <th scope="col">edit role</th>
                    <th scope="col">add role</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $i => $user)
                <tr>
                `<td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if ($user->role_id == 1)
                            admin
                        @elseif ($user->role_id == 3)
                            super
                        @else 
                            guest
                        @endif
                    </td>
                    <td>
                        @if ($user->role_id != 3)
                        <span data-toggle="modal" data-target="#editModal"
                                onclick="javascript:EditModal('{{ $user->id}}', '{{ $user->name }}', '{{ $user->role_id }}');" 
                                    class="glyphicon glyphicon-pencil"></span>
                        @else 
                        <span class="glyphicon glyphicon-paperclip text-danger"></span>
                        @endif
                    </td>
                    <td>
                        <span data-toggle="modal" data-target="#addModal"
                        onclick="javascript:AddModal('{{ $user->id}}', '{{ $user->name }}', '{{ $user->role_id }}');" 
                            class="glyphicon glyphicon-plus text-success"></span>
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
                        <h4 class="modal-title text-primary font-weight-bold">Chỉnh sửa quyền</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="#" method="post">
                        @csrf
                        <div id="edit-modal" class="modal-body d-flex flex-column">
                            <input name="id" class="e-id d-none" />
                            <p >Username:&nbsp;<span class="text-danger"></span></p>
                            <div>
                                <label for="">Role:&nbsp;</label>
                                <input id="old-role" type="text" readonly/>
                                <span class="glyphicon glyphicon-arrow-right"></span>
                                <input name="e_role" type="text" required/>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Save</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
        
            </div>
        </div>
        <div id="addModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
        
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-primary font-weight-bold">Thêm quyền</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="#" method="post">
                        @csrf
                        <div id="add-modal" class="modal-body d-flex flex-column">
                            <input name="id" class="d-none" />
                            <p >Username:&nbsp;<span class="text-danger"></span></p>
                            <div>
                                <label for="">Role:&nbsp;</label>
                                <span class="glyphicon glyphicon-arrow-right"></span>
                                <input name="role" type="text" required/>
                            </div>
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
            <div class="text-secondary t_max">No user login</div>
        @endif
    </div>
    <script src="{{ asset('js/admin.js') }}"></script>
</div>
@endsection
@extends('layouts.app')


@section('title', 'Phiên hỏi đáp - Câu hỏi')

@section('content')
@push('styles')
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    <link href="{{ asset('css/qna/questionQna.css') }}" rel="stylesheet">
@endpush

<div class="body-content">
        <div class="row toolbar border-bottom d-flex justify-content-between align-content-center px-0">
            <div class="">
                <!-- toolbar -->
                <a> Phiên hỏi đáp
                    <span class=" glyphicon glyphicon-chevron-right"></span>
                Câu hỏi </a>
            </div>
            <form class=" search-cls" action="http://127.0.0.1:8000/qna#" method="post">
                        <input type="hidden" name="_token" value="ZgU7Yorh1VFOkX8Snm3bIC9WngMAPQOYiOU7N7Jw"> <input
                            class="h-100" name="search" placeholder="Tìm kiếm">
                        <button class="ml-2 px-4 btn btn-success h-100" type="submit"><span
                                class="glyphicon glyphicon-search"></span></button>
            </form>

        </div>

        <div class="row px-4 py-2">
            <button data-toggle="modal" data-target="#addModal" class="btn bg-white shadow">
                <span>Thêm câu hỏi</span>
            </button>
        </div>
        <div class="row content mx-auto d-flex flex-column align-items-center">
            <!--nd content  -->
            <div onclick="javascript:submitQuestion(this);"
            class="wrap-content p-3 border bg-light d-flex justify-content-between w-75">
                <div class="d-flex align-items-start flex-column bd-highlight mb-3" style="height: 150px;">
                    <div class="mb-auto p-2 bd-highlight">
                        <div class="user-account d-flex mr-4">
                            <div class="avatar">
                                <img class="rounded-circle"
                                    src="{{ asset('storage/image/default_avata.png') }}" />
                            </div>
                            <a class="my-auto" href="#">User 5</a>
                        </div>
                    </div>
                    <div class="mb-5 p-3 bd-highlight">
                        <p>[Chủ đề]:&nbsp;<span>Tên chủ đề</span></p>
                        <a>Nội dung câu hỏi</a>

                    </div>
                </div>
                <div class="d-flex align-items-end flex-column bd-highlight mb-3" style="height: 150px;">
                    <div class="p-2 bd-highlight">
                        <button onclick="javascript:EditModal(this)" class="btn bg-white  h-100"
                            data-toggle="modal" data-target="#editModal">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </button>
                        
                        <button onclick="javascript:DeleteModal(this);" class="btn bg-white h-100"
                            data-toggle="modal" data-target="#deleteModal">
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
                    </div>
                    <div class="mt-auto  bd-highlight">
                        <p>Trạng thái:&nbsp;<span>Chủ tọa đã trả lời</span></p>
                    </div>
                </div>
                <form class="d-none" action="#" method="get">
                    
                </form>
            </div>
        </div>

        <div id="addModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-primary font-weight-bold">Thêm câu hỏi</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="#" method="post">
                        @csrf
                        <div class="modal-body d-flex flex-column">
                            <label for="">Chủ đề:</label>
                            <div>
                                <input onkeyup="javascript:validate(this);" type="text" name="name" class="w-75"
                                    value="" />
                                <span class="text-danger">&nbsp;(*)</span>
                            </div>
                            <label for="">Nội dung:</label>
                            <div>
                                <textarea onkeyup="javascript:validate(this);" style="resize:none" class="w-75"
                                    name="noidung" value="" cols="30" rows="5"></textarea>
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
        <div id="editModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-primary font-weight-bold">Sửa câu hỏi</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="#" method="post">
                        @csrf
                        <div id="edit-modal" class="modal-body d-flex flex-column">
                            <label for="">Chủ đề:</label>
                            <div>
                                <input onkeyup="javascript:validate(this);" type="text" name="name"
                                    class="e-name w-75" value="" />
                                <span class="text-danger">&nbsp;(*)</span>
                            </div>
                            <span class="text-danger d-none"><strong>error</strong></span>

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
        <div id="deleteModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-primary font-weight-bold">Cảnh báo xóa câu hỏi</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="#" method="post">
                        @csrf
                        <div class="modal-body d-flex flex-column">
                            <p>Bạn có chắc chắn muốn xóa "<span id="del-name"></span>"?</p>
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

</div>
@endsection
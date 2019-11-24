@extends('layouts.app')


@section('title', 'Phiên hỏi đáp - Câu hỏi')

@section('content')
@push('styles')
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    <link href="{{ asset('css/qna/questionQna.css') }}" rel="stylesheet">
@endpush

<div class="body-content">
        <div class="row toolbar border-bottom d-flex justify-content-between align-content-center px-0">
            <div class="d-flex flex-row">
                <!-- toolbar -->
                <a href="{{ route('qna','all') }}"> Phiên hỏi đáp&nbsp;</a>
                <span class="glyphicon glyphicon-chevron-right"></span>
                <p>&nbsp;Câu hỏi</p>
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
            <button data-toggle="modal" data-target="#addModal" class="btn bg-white shadow">
                <span>Thêm câu hỏi</span>
            </button>
        </div>
        <div class="row content mx-auto d-flex flex-column align-items-center">
            <!--nd content  -->
            @if (!isset($questions))
                <div class="text-secondary t_max">Chưa có câu hỏi nào!!!</div>
            @else
            @foreach ($questions as $i => $question)
                <div class="wrap-content p-3 border bg-light d-flex justify-content-between w-75">

                    <form action="{{ route('qna','all') }}" method="GET" onclick="javascript:submited(this);"
                    class="d-flex border-bottom-info flex-column bd-highlight mb-3 w-75">
                        <div class="mb-auto p-2 bd-highlight">
                            <div class="user-account d-flex mr-4">
                                <div class="avatar">
                                    <img class="rounded-circle"
                                        src="{{ asset('storage/image/default_avata.png') }}" />
                                </div>
                                <a name="user_name" class="my-auto" href="#">{{ $question->name }}</a>
                            </div>
                        </div>
                        <div class="mb-5 p-3 bd-highlight">
                            <p class="text-lg-left text-primary">[Chủ đề]:&nbsp;<span name="title">{{ $question->title }}</span></p>
                            <p class="text-lg-left text-secondary">[Câu hỏi]:&nbsp;<span class="text-dark" name="content" >{{ $question->content }}</span></p>
                            <p class="text-small text-secondary">Cập nhật lúc: {{ (new \DateTime($question->updated_at))->format('H:i d-m-Y') }}</p>
                        </div>

                    </form>

                    <div class="d-flex align-items-end flex-column bd-highlight mb-3" >
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
                        <div class="mt-auto  bd-highlight">
                            <p class="text-secondary">Số lượt truy cập:&nbsp;<span class="badge badge-success">{{ $question->ans_count }}</span></p>
                        </div>
                    </div>
                </div>
            @endforeach
            @endif
        </div>

        <div id="addModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-primary font-weight-bold">Thêm câu hỏi</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="{{ route('addQuestion', $session_id) }}" method="post">
                        @csrf
                        <div class="modal-body d-flex flex-column">
                            <label for="">Chủ đề:</label>
                            <div>
                                <input type="text" name="title" class="w-75"
                                    value="" />
                                <span class="text-danger">&nbsp;(*)</span>
                            </div>
                            <label for="">Nội dung:</label>
                            <div>
                                <textarea onkeyup="javascript:validate(this);" style="resize:none" class="w-75"
                                    name="content" value="" cols="30" rows="5"></textarea>
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
    <script src="{{ asset('js/qna/question.js') }}"></script>
</div>
@endsection
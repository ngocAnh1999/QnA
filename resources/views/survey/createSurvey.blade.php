@extends('layouts.app')
@section('title', 'Phiên khảo sát')
@section('content')
@push('styles')
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
@endpush
    <div class="body-content">
        <div class="row content-header">
            <h3 id="survey_id" class="col-md text-info text-center">Tạo phiên khảo sát</h3>
        </div>
        <form action="#" method="post">
            <div id="content" class="row content mx-auto d-flex flex-column align-items-center">
                <div class="wrap m-4 wrap-content shadow" id="survey">
                    <div>
                        <label class="text-info font-weight-bold">Chủ đề: </label>
                        <div>
                            <input class="q-title" name="title" type="text" placeholder="Tiêu đề phiên" autofocus />
                            <span class="text-danger">&nbsp;(*)</span>
                        </div>

                        <label class="text-info font-weight-bold">Mô tả: </label>
                        <div class="d-flex">
                            <textarea id="input-common"></textarea>
                            <span class="text-danger ml-1">&nbsp;(*)</span>
                        </div>
                    </div>
                </div>
                <div id="paste-q"></div>
                <div class="wrap m-4 d-flex flex-column wrap-content shadow" id="add-question">
                    <h3 class="title-content text-secondary font-weight-bold">Add new</h3>
                    <div class="mx-auto">
                        <button onclick="javascript:createQuestion('common');" type="button"
                            class="btn mx-2 my-auto">Text</button>
                        <button onclick="javascript:createQuestion('multi-choice');" type="button"
                            class="btn mx-2 my-auto">Multi-choice</button>
                        <button onclick="javascript:createQuestion('one-answer');" type="button"
                            class="btn mx-2 my-auto">One Answer</button>
                        <button onclick="javascript:createQuestion('star-answer');" type="button"
                            class="btn mx-2 my-auto">Star Answer</button>
                    </div>
                </div>
                <div class="wrap m-4 wrap-content shadow" name="common">
                    <div class="d-flex justify-content-end">
                        <span onclick="javascript:onRemove(this);" data-toggle="tooltip" title="Xóa"
                            class="wrap-remove glyphicon glyphicon-remove"></span>
                    </div>
                    <h3 class="text-secondary">Câu hỏi text</h3>
                    <label class="text-info font-weight-bold">Câu hỏi&nbsp;<span></span>: </label>
                    <div>
                        <div class="d-flex">
                            <textarea id="input-common"></textarea>
                            <span class="text-danger ml-1">&nbsp;(*)</span>
                        </div>
                    </div>
                </div>
                <div class="wrap m-4 wrap-content shadow" name="multi-choice">
                    <div class="d-flex justify-content-end">
                        <span onclick="javascript:onRemove(this);" data-toggle="tooltip" title="Xóa"
                            class="wrap-remove glyphicon glyphicon-remove"></span>
                    </div>
                    <h3 class="text-secondary">Câu hỏi multi-choice</h3>
                    <label class="text-info font-weight-bold">Câu hỏi&nbsp;<span></span>: </label>
                    <div>
                        <div>
                            <input type="text" placeholder="Nhập câu hỏi" />
                            <span class="text-danger">&nbsp;(*)</span>
                        </div>
                        <label class="text-info font-weight-bold">Đáp án: </label>
                        <div id="add-ans"></div>
                        <div class="mx-auto my-2">
                            <button type="button" onclick="javascript:addMultiAnswer()"
                                class="multi-ans btn btn-info">Thêm
                                đáp án</button>
                        </div>
                    </div>
                </div>
                <div class="wrap m-4 wrap-content shadow" name="one-answer">
                    <div class="d-flex justify-content-end">
                        <span onclick="javascript:onRemove(this);" data-toggle="tooltip" title="Xóa"
                            class="wrap-remove glyphicon glyphicon-remove"></span>
                    </div>
                    <h3 class="text-secondary">Câu hỏi one answer</h3>
                    <label class="text-info font-weight-bold">Câu hỏi&nbsp;<span></span>: </label>
                    <div>
                        <div>
                            <input type="text" placeholder="Nhập câu hỏi" />
                            <span class="text-danger">&nbsp;(*)</span>
                        </div>
                        <label class="text-info font-weight-bold">Đáp án: </label>
                        <div id="add-one"></div>
                        <div class="mx-auto my-2">
                            <button type="button" onclick="javascript:addOneAnswer()"
                                class="multi-ans btn btn-info">Thêm
                                đáp án</button>
                        </div>
                    </div>

                </div>
                <div class="wrap m-4 wrap-content shadow" name="star-answer">
                    <div class="d-flex justify-content-end">
                        <span onclick="javascript:onRemove(this);" data-toggle="tooltip" title="Xóa"
                            class="wrap-remove glyphicon glyphicon-remove"></span>
                    </div>
                    <h3 class="text-secondary">Câu hỏi đánh giá sao</h3>
                    <label class="text-info font-weight-bold">Câu hỏi&nbsp;<span></span>: </label>
                    <div>
                        <div>
                            <input type="text" placeholder="Nhập câu hỏi" />
                            <span class="text-danger">&nbsp;(*)</span>
                        </div>
                        <label class="text-info font-weight-bold">Đáp án: </label>
                        <div class="my-2 d-flex">
                            <input class="star" type="number" placeholder="input star" />
                            <span class="mx-2 my-auto">/ 5</span>
                            <span class="star-none my-auto"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mx-auto d-flex flex-row justify-content-center">
                <button type="submit" class="btn btn-success px-4" disabled>Lưu</button>
            </div>
        </form>
    </div>
@endsection
@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')
@push('styles')
    <link href="{{ asset('css/bg_body.css') }}" rel="stylesheet">
@endpush
<div class="container">
    <div class="row justify-content-center phien">
        <div class="col-md-8 card shadow">
            <a class="text-secondary t_max text-center" href="{{ route('qna','all') }}">Phiên hỏi đáp</a>
            <hr/>
            <a class="text-secondary t_max text-center" href="{{ route('survey','all') }}">Phiên khảo sát</a>
        </div>
    </div>
</div>
@endsection

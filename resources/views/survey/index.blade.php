@extends('layouts.app')
@section('title', 'Phiên khảo sát')
@section('content')
@push('styles')
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    <link href="{{ asset('css/survey/indexSurvey.css') }}" rel="stylesheet">
@endpush
<div class="body-content">    
    <div class="row content mx-auto d-flex flex-column align-items-center">
        @empty($sessions)          
        <div class="t_max text-secondary">Chưa có phiên nào!</div>
        @endempty
        @if(sizeof($sessions) > 0)
        <div class="w-100 t_max text-success">Thống kê phiên làm việc</div>
        <div>Chưa có phiên nào</div>
        @endif
    </div>
</div>
@endsection
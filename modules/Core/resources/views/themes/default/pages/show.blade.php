@extends('layouts.master')
@section('title')
{{ $page->title }}
@stop
@section('content')
<div class="container">
    {!! $page->content !!}
</div>
@endsection
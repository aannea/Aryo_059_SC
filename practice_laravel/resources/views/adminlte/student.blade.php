@extends('admin_layout.app')
@section('title', 'Show Student')
@section('header')
    @include('admin_layout.header')
@endsection
@section('leftbar')
    @include('admin_layout.leftbar')
@endsection
@section('rightbar')
    @include('admin_layout.rightbar')
@endsection
@section('content')
    @include('student.index')
@endsection

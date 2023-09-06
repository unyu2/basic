@extends('layouts.master')

@section('title')
    Welcome
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Welcome</li>
@endsection

@section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-body text-center">
            <h1>Selamat Datang, {{ auth()->user()->name }}!</h1>
            </div>
        </div>
    </div>
</div>
<!-- /.row (main row) -->
@endsection
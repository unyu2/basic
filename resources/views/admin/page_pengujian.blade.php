@extends('layouts.master')

@section('title')
START INSPEKSI LAPANGAN
@endsection

@section('breadcrumb')
    @parent
    <li class="active">START INSPEKSI LAPANGAN</li>
@endsection

@section('content')
<div class="row">
<div class="col-lg-3 col-xs-4">
        <!-- small box -->
        <div class="small-box bg-yellow icon" action="{{ route('temuan.index') }}">
        <div class="inner">
                <h3></h3>

                <p><font size="4">DAILY CHECK</font></p>
            </div>
            <div class="icon">
                <i class="fa fa-train"></i>
            </div>
            <a href="{{ route('temuan.index') }}" class="small-box-footer"><font size="5">START</font> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-4">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3></h3>

                <p><font size="4">SARANA ON</font></p>
            </div>
            <div class="icon">
                <i class="fa fa-battery-full"></i>
            </div>
            <a href="{{ route('temuan.index') }}" class="small-box-footer"><font size="5">START</font> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-4">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3></h3>

                <p><font size="4">SARANA OFF</font></p>
            </div>
            <div class="icon">
                <i class="fa fa-train"></i>
            </div>
            <a href="{{ route('temuan.index') }}" class="small-box-footer"><font size="5">START</font> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
    <div class="row">
    <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3></h3>

                <p><font size="4">P1 PERAWATAN</font></p>
            </div>
            <div class="icon">
                <i class="fa fa-train"></i>
            </div>
            <a href="{{ route('permintaan.index') }}" class="small-box-footer"><font size="5">START</font> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3></h3>

                <p><font size="4">P3 PERAWATAN</font></p>
            </div>
            <div class="icon">
                <i class="fa fa-train"></i>
            </div>
            <a href="{{ route('permintaan.index') }}" class="small-box-footer"><font size="5">START</font> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
    <div class="row">
    <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3></h3>

                <p><font size="4">P6 PERAWATAN</font></p>
            </div>
            <div class="icon">
                <i class="fa fa-train"></i>
            </div>
            <a href="{{ route('permintaan.index') }}" class="small-box-footer"><font size="5">START</font> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3></h3>

                <p><font size="4">P12 PERAWATAN</font></p>
            </div>
            <div class="icon">
                <i class="fa fa-train"></i>
            </div>
            <a href="{{ route('permintaan.index') }}" class="small-box-footer"><font size="5">START</font> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->
<!-- Main row -->

@endsection

@extends('layouts.master')

@section('title')
Periodic Maintenance Trainset 10
@endsection

<!--For 
Periodic Maintenance Trainset 10
Periodic Maintenance TRAINSET 10
<h3>{{ number_format ($p1xts10, 2) }}%</h3>
<h3>{{ number_format ($p3xts10, 2) }}%</h3>
<h3>{{ number_format ($p6xts10, 2) }}%</h3>
<h3>{{ number_format ($p12xts10, 2) }}%</h3>
Replace-->

@section('breadcrumb')
    @parent
    <li class="active">Periodic Maintenance</li>
@endsection

@section('content')
<div class="box-header with-border">
                <h3 class="active"><b>Periodic Maintenance TRAINSET 10</b></h3>
            </div>
<!-- Small boxes (Stat box) -->
    <div class="row">
    <div class="col-lg-3 col-xs-7">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
            <h3>{{ number_format ($p1xts10, 2) }}%</h3>
                <p>P1 Perawatan</p>
            </div>
            <div class="icon">
                <i class="fa fa-battery-full"></i>
            </div>
            <a href="{{ route('emu.index') }}" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-7">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
            <h3>{{ number_format ($p3xts10, 2) }}%</h3>
                <p>P3 Perawatan</p>
            </div>
            <div class="icon">
                <i class="fa fa-battery-2"></i>
            </div>
            <a href="{{ route('emu.index') }}" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-7">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
            <h3>{{ number_format ($p6xts10, 2) }}%</h3>
                <p>P6 Perawatan</p>
            </div>
            <div class="icon">
                <i class="fa fa-rocket"></i>
            </div>
            <a href="{{ route('emu.index') }}" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-7">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
            <h3>{{ number_format ($p12xts10, 2) }}%</h3>
                <p>P12 Perawatan</p>
            </div>
            <div class="icon">
                <i class="fa fa-rocket"></i>
            </div>
            <a href="{{ route('emu.index') }}" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->
<!-- Main row -->
@endsection
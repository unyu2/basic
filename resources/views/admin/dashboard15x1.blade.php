@extends('layouts.master')

@section('title')
Routine Maintenance Trainset 14
@endsection

<!--For 
Routine Maintenance Trainset 14
Routine Maintenance TRAINSET 14
<h3>{{ number_format ($PDFxTS14, 2) }}%</h3>
<h3>{{ number_format ($PDCxTS14, 2) }}%</h3>
<h3>{{ number_format ($PDNxTS14, 2) }}%</h3>
Replace-->

@section('breadcrumb')
    @parent
    <li class="active">Routine Maintenance</li>
@endsection

@section('content')
<div class="box-header with-border">
                <h3 class="active"><b>Routine Maintenance TRAINSET 14</b></h3>
            </div>
<!-- Small boxes (Stat box) -->
    <div class="row">
    <div class="col-lg-3 col-xs-7">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
            <h3>{{ number_format ($PDFxTS14, 2) }}%</h3>
                <p>Check Sarana ON</p>
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
            <h3>{{ number_format ($PDCxTS14, 2) }}%</h3>
                <p>Check Sarana OFF</p>
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
            <h3>{{ number_format ($PDNxTS14, 2) }}%</h3>
                <p>Daily Check</p>
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
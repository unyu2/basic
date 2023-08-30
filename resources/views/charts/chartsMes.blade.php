@extends('layouts.master')

@section('title')
Mechanical Engineering System Schedule
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Mechanical Engineering System Schedule</li>
@endsection

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border"></div>
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="chart">
                            <div id="chart1" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
  $('body').addClass('sidebar-collapse');

  google.charts.load('current', { 'packages': ['gantt'] });
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    @if ($design->isEmpty())
      document.getElementById('chart1').innerHTML = '<p>Tidak Ada Data</p>';
    @else
    
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Task ID');
      data.addColumn('string', 'Task Name');
      data.addColumn('string', 'Resource');
      data.addColumn('date', 'Start Date');
      data.addColumn('date', 'End Date');
      data.addColumn('number', 'Duration');
      data.addColumn('number', 'Percent Complete');
      data.addColumn('string', 'Dependencies');

      @foreach ($design as $item)
        var taskName = '{!! html_entity_decode($item->kode_design . ' - ' . $item->nama_design) !!}';
        var reference = '{!! html_entity_decode($item->refrensi_design) !!}';
        
        data.addRows([
            ['{{ $item->id_design }}', taskName, reference,
            new Date({{ $item->tp_yy }}, {{ $item->tp_mm }}, {{ $item->tp_dd }}), new Date({{ $item->pa_yy }}, {{ $item->pa_mm }}, {{ $item->pa_dd }}), {{ $item->prediksi_hari }}, {{ $item->prosentase }}, null],
        ]);
      @endforeach

      var options = {
        height: 100000,
        gantt: {
          trackHeight: 30 
        }
      };

      var chart = new google.visualization.Gantt(document.getElementById('chart1'));
      chart.draw(data, options);
    @endif
  }
</script>


@endpush

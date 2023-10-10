@extends('layouts.master')

@section('title')
    Transaksi Pengembalian Barang
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('/AdminLTE-2/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('/AdminLTE-2/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
@endpush

@push('css')
<style>
    .tampil-bayar {
        font-size: 5em;
        text-align: center;
        height: 100px;
    }

    .tampil-terbilang {
        padding: 10px;
        background: #f0f0f0;
    }

    .table-kembali tbody tr:last-child {
        display: none;
    }

    .hidden-form {
        display: none;
    }

    @media(max-width: 768px) {
        .tampil-bayar {
            font-size: 3em;
            height: 70px;
            padding-top: 5px;
        }
    }
    
</style>
@endpush

@section('breadcrumb')
    @parent
    <li class="active">Transaksi Pengembalian Barang</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-body">
                    
                <form class="form-barang">
                    @csrf
                    <div class="form-group row">
                        <label for="kode_barang" class="col-lg-2">Barang Inventaris</label>
                        <div class="col-lg-5">
                            <div class="input-group">
                                <input type="hidden" name="id_pinjam" id="id_pinjam" value="{{ $id_pinjam }}">
                                <input type="hidden" name="id_barang" id="id_barang">
                                <input type="text" class="form-control" name="kode_barang" id="kode_barang">
                                <span class="input-group-btn">
                                    <button onclick="tampilBarang()" class="btn btn-info btn-flat" type="button"><i class="fa fa-arrow-right"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                </form>

                <table class="table table-stiped table-bordered table-kembali">
                    <thead>
                        <th width="5%">No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th width="15%">Jumlah</th>
                        <th width="15%"><i class="fa fa-cog"></i></th>
                    </thead>
                </table>
                <div class="row">
                    <div class="col-lg-5">
                        <form action="{{ route('transaksi_pengembalian.simpan') }}" class="form-kembali" method="post">
                            @csrf
                            <input type="hidden" name="id_pinjam" value="{{ $id_pinjam }}">
                            <input type="hidden" name="total_item" id="total_item">
                            <div class="form-group row">
                                <label for="fungsi" class="col-lg-2 control-label">Digunakan Untuk ?</label>
                                <div class="col-lg-12">
                                    <input type="text" name="fungsi" id="fungsi" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="id_peminjam" class="col-lg-2 control-label">Peminjam</label>
                                <div class="col-lg-12">
                                    <select type="text" name="id_peminjam" id="id_peminjam" class="form-control">
                                    <option></option>
                                    @foreach ($peminjam as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-sm btn-flat pull-right btn-simpan"><i class="fa fa-floppy-o"></i> Selesai</button>
            </div>
        </div>
    </div>
</div>

@includeIf('kembali_detail.barang')
@endsection

@push('scripts')
<script>
    let table;
    let table2;
    let table3;

    $(function () {
        $('body').addClass('sidebar-collapse');
        table = $('.table-kembali').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('transaksi_pengembalian.data', $id_pinjam) }}',
            },
            columns: [
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'kode_barang'},
                {data: 'nama_barang'},
                {data: 'jumlah'},
                {data: 'aksi', searchable: false, sortable: false},
            ],
            dom: 'Brt',
            bSort: false,
            paginate: false
        })

        table2 = $('.table-barang').DataTable();
        $(document).on('input', '.quantity', function () {
            let id = $(this).data('id');
            let jumlah = parseInt($(this).val());

            if (jumlah < 1) {
                $(this).val(1);
                alert('Jumlah tidak boleh kurang dari 1');
                return;
            }
            if (jumlah > 10000) {
                $(this).val(10000);
                alert('Jumlah tidak boleh lebih dari 10000');
                return;
            }

            $.post(`{{ url('/transaksi_pengembalian') }}/${id}`, {
                    '_token': $('[name=csrf-token]').attr('content'),
                    '_method': 'put',
                    'jumlah': jumlah
                })
                .done(response => {
                    $(this).on('mouseout', function () {
                        table.ajax.reload(() => loadForm($('#diskon').val()));
                    });
                })
                .fail(errors => {
                    alert('Tidak dapat menyimpan data');
                    return;
                });
        });

        $('.btn-simpan').on('click', function () {
            $('.form-kembali').submit();
        });
    });


    function tampilBarang() {
        $('#modal-barang').modal('show');
    }

    function hideBarang() {
        $('#modal-barang').modal('hide');
    }

    function pilihBarang(id, kode) {
        $('#id_barang').val(id);
        $('#kode_barang').val(kode);
        hideBarang();
        tambahBarang();
    }

    function tambahBarang() {
    $.post('{{ route('transaksi_pengembalian.store') }}', $('.form-barang').serialize())
        .done(response => {
            $('#kode_barang').focus();
            table.ajax.reload();
        })
        .fail(errors => {
            console.error('Gagal menyimpan data:', errors.responseText);
            alert('Tidak dapat menyimpan data');
            return;
        });
    }


function deleteData(url) {
    if (confirm('Yakin ingin menghapus data terpilih?')) {
        $.post(url, {
                '_token': $('[name=csrf-token]').attr('content'),
                '_method': 'delete'
            })
            .done((response) => {
                table.ajax.reload();
            })
            .fail((errors) => {
                alert('Tidak dapat menghapus data');
                return;
            });
    }
}

    function loadForm(diskon = 0, diterima = 0) {
        $('#total').val($('.total').text());
        $('#total_item').val($('.total_item').text());

        $.get(`{{ url('/transaksi_pengembalian/loadform') }}/${diskon}/${$('.total').text()}/${diterima}`)
            .done(response => {
                $('#totalrp').val('Rp. '+ response.totalrp);
                $('#bayarrp').val('Rp. '+ response.bayarrp);
                $('#bayar').val(response.bayar);
                $('.tampil-bayar').text('Bayar: Rp. '+ response.bayarrp);
                $('.tampil-terbilang').text(response.terbilang);

                $('#kembali').val('Rp.'+ response.kembalirp);
                if ($('#diterima').val() != 0) {
                    $('.tampil-bayar').text('Kembali: Rp. '+ response.kembalirp);
                    $('.tampil-terbilang').text(response.kembali_terbilang);
                }
            })
            .fail(errors => {
                alert('Tidak dapat menampilkan data');
                return;
            })
    }

</script>
@endpush
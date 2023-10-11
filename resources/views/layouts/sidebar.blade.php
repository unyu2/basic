<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ url(auth()->user()->foto ?? '') }}" class="img-circle img-profil" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        
<!-------------------------------------------Side Bar For Administartor ----------------------------------------------->

        @if (auth()->user()->level == 1)
        <ul class="sidebar-menu" data-widget="tree">
            <li>
                <a href="{{ route('dashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>My Performance</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard_oil') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard OIL</span>
                </a>
            </li>
            <li>
                <a href="{{ route('charts') }}">
                    <i class="fa fa-cube"></i> <span>Chart OIL</span>
                </a>
            </li>
            <li>
                <a href="{{ route('chartsDesign') }}">
                    <i class="fa fa-cube"></i> <span>Chart % Des-Eng</span>
                </a>
            </li>
            <li>
                <a href="{{ route('chartsCurva') }}">
                    <i class="fa fa-cube"></i> <span>Chart S-Curve</span>
                </a>
            </li>
            <li>
                <a href="{{ route('chartsJadwal') }}">
                    <i class="fa fa-cube"></i> <span>Chart Jadwal</span>
                </a>
            </li>
            <li class="header">MASTER</li>
            <li>
                <a href="{{ route('sistem.index') }}">
                    <i class="fa fa-cube"></i> <span>Sistem</span>
                </a>
            </li>
            <li>
                <a href="{{ route('subsistem.index') }}">
                    <i class="fa fa-cube"></i> <span>Sub Sistem</span>
                </a>
            </li>
            <li>
                <a href="{{ route('kategori.index') }}">
                    <i class="fa fa-cube"></i> <span>Kategori Komponen</span>
                </a>
            </li>
            <li>
                <a href="{{ route('kepala_gambar.index') }}">
                    <i class="fa fa-cube"></i> <span>Kepala Gambar</span>
                </a>
            </li>
            <li>
                <a href="{{ route('konfigurasi.index') }}">
                    <i class="fa fa-cube"></i> <span>Konfigurasi</span>
                </a>
            </li>
            <li>
                <a href="{{ route('produk.index') }}">
                    <i class="fa fa-cube"></i> <span>Komponen</span>
                </a>
            </li>
            <li>
                <a href="{{ route('jabatan.index') }}">
                    <i class="fa fa-cube"></i> <span>Bagian</span>
                </a>
            </li>
            <li>
                <a href="{{ route('subpengujian.index') }}">
                    <i class="fa fa-cube"></i> <span>Tipe Inspeksi / Pengujian</span>
                </a>
            </li>
            <li>
                <a href="{{ route('car.index') }}">
                    <i class="fa fa-cube"></i> <span>Trainset</span>
                </a>
            </li>
            <li>
                <a href="{{ route('proyek.index') }}">
                    <i class="fa fa-cube"></i> <span>Proyek</span>
                </a>
            </li>
            <li>
                <a href="{{ route('member.index') }}">
                    <i class="fa fa-cube"></i> <span>Team Kerja</span>
                </a>
            </li>
            <li>
                <a href="{{ route('supplier.index') }}">
                    <i class="fa fa-cube"></i> <span>Supplier</span>
                </a>
            </li>

            <li class="header">DOC DESIGN & ENG</li>
            <li>
                <a href="{{ route('design.index') }}">
                    <i class="fa fa-cube"></i> <span>Dokumen Saya</span>
                </a>
            </li>
            <li>
                <a href="{{ route('design_detail.index') }}">
                    <i class="fa fa-cube"></i> <span>Release Dokumen</span>
                </a>
            </li>
            <li>
                <a href="{{ route('design_overall.indexOverall') }}">
                    <i class="fa fa-cube"></i> <span>Overall Data</span>
                </a>
            </li>

            <li class="header">DOC TEK PRODUKSI</li>
            <li>
                <a href="{{ route('tekprod.index') }}">
                    <i class="fa fa-cube"></i> <span>Dokumen TP Saya</span>
                </a>
            </li>
            <li>
                <a href="{{ route('tekprod_detail.index') }}">
                    <i class="fa fa-cube"></i> <span>Release Dokumen TP</span>
                </a>
            </li>
            <li>
                <a href="{{ route('tekprod_overall.indexOverall') }}">
                    <i class="fa fa-cube"></i> <span>Overall Data TP</span>
                </a>
            </li>

            <li class="header">DATA DINAS</li>
            <li>
                <a href="{{ route('dinas.index') }}">
                    <i class="fa fa-cube"></i> <span>Data Dinas Saya</span>
                </a>
            </li>

            <li class="header">INSPEKSI</li>
            <li>
                <a href="{{ route('full_calender') }}" target="_blank">
                    <i class="fa fa-dashboard"></i> <span>Agenda Proyek</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dmu.index') }}">
                    <i class="fa fa-cubes"></i> <span>Buat Doc Inspeksi Com EMU/DMU </span>
                </a>
            </li>
            <li>
                <a href="{{ route('dmuapv.index') }}">
                    <i class="fa fa-cubes"></i> <span>Aprove Doc Inspeksi Com EMU/DMU </span>
                </a>
            </li>
            <li>
                <a href="{{ route('emu.index') }}">
                    <i class="fa fa-cubes"></i> <span>Start Inspeksi Com Emu/DMU</span>
                </a>
            </li>
            <li>
                <a href="{{ route('emu_ctrl.index') }}">
                    <i class="fa fa-cubes"></i> <span>Approve & Print Inspeksi</span>
                </a>
            </li>
            <li>
                <a href="{{ route('emu_ctrl2.index') }}">
                    <i class="fa fa-cubes"></i> <span>Follow Up Inspeksi</span>
                </a>
            </li>
            <li>
                <a href="{{ route('temuan.index') }}">
                    <i class="fa fa-cubes"></i> <span>Daftarkan Temuan (OIL)</span>
                </a>
            </li>
            <li>
                <a href="{{ route('temuan2.index') }}">
                    <i class="fa fa-cubes"></i> <span>Tindak Lanjut Temuan (OIL)</span>
                </a>
            </li>
            <li>
            <li class="header">PERMINTAAN BARANG</li>
            <li>
                <a href="{{ route('permintaan.index') }}">
                    <i class="fa fa-upload"></i> <span>Minta Barang</span>
                </a>
            </li>
            <li>
                <a href="{{ route('proses.index') }}">
                    <i class="fa fa-download"></i> <span>Terima Barang</span>
                </a>
            </li>
            <li class="header">PENGIRIMAN BARANG</li>
            <li>
                <a href="{{ route('minta.index') }}">
                    <i class="fa fa-cart-arrow-down"></i> <span>Terima Permintaan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('transaksi_pemesanan.baru') }}">
                    <i class="fa fa-truck"></i> <span>Kirim Barang</span>
                </a>
            </li>
            <li>
                <a href="{{ route('pemesanan.index') }}">
                    <i class="fa fa-upload"></i> <span>Data Out Barang</span>
                </a>
            </li>
            <li class="header">INVENTARIS</li>fa-diamond
            <li>
                <a href="{{ route('barang.index') }}">
                    <i class="fa fa-upload"></i> <span>Barang Inventaris</span>
                </a>
            </li>
            <li>
                <a href="{{ route('transaksi_pinjam.index') }}">
                    <i class="fa fa-download"></i> <span>Pinjam Barang</span>
                </a>
            </li>
            <li>
                <a href="{{ route('transaksi_pengembalian.index') }}">
                    <i class="fa fa-upload"></i> <span>Kembali Barang </span>
                </a>
            </li>
            <li>
                <a href="{{ route('data_pinjam_kembali.index') }}">
                    <i class="fa fa-upload"></i> <span>Data Pinjam & Kembali</span>
                </a>
            </li>
            <li class="header">KEUANGAN PROYEK</li>
            <li>
                <a href="{{ route('pengujian.index') }}">
                    <i class="fa fa-money"></i> <span>Pemasukan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('pengeluaran.index') }}">
                    <i class="fa fa-money"></i> <span>Pengeluaran</span>
                </a>
            </li>
            <li class="header">REPORT</li>
            <li>
                <a href="{{ route('laporan.index') }}">
                    <i class="fa fa-file-pdf-o"></i> <span>Laporan</span>
                </a>
            </li>
            <li class="header">SYSTEM</li>
            <li>
                <a href="{{ route('user.index') }}">
                    <i class="fa fa-users"></i> <span>User</span>
                </a>
            </li>
        </ul>
        @endif

<!-------------------------------------------Side Bar For Teknologi ----------------------------------------------->

        @if (auth()->user()->level == 2  || auth()->user()->level == 3 || auth()->user()->level == 4 || auth()->user()->level == 13 || auth()->user()->level == 14)
        <ul class="sidebar-menu" data-widget="tree">
            <li>
                <a href="{{ route('dashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>My Performance</span>
                </a>
            </li>
            <li>
                <a href="{{ route('chartsDesign') }}">
                    <i class="fa fa-cube"></i> <span>Chart Des & Eng</span>
                </a>
            </li>
            <li>
                <a href="{{ route('chartsJadwal') }}">
                    <i class="fa fa-cube"></i> <span>Chart Jadwal</span>
                </a>
            </li>
            <li>
                <a href="{{ route('chartsCurva') }}">
                    <i class="fa fa-cube"></i> <span>Chart S-Curve</span>
                </a>
            </li>
            <li class="header">MASTER</li>
            <li>
                <a href="{{ route('kepala_gambar.index') }}">
                    <i class="fa fa-cube"></i> <span>Kepala Gambar</span>
                </a>
            </li>

            <li class="header">DOC DESIGN & ENG</li>
            <li>
                <a href="{{ route('design.index') }}">
                    <i class="fa fa-cube"></i> <span>Dokumen Saya</span>
                </a>
            </li>
            <li>
                <a href="{{ route('design_detail.index') }}">
                    <i class="fa fa-cube"></i> <span>Release Dokumen</span>
                </a>
            </li>
            <li>
                <a href="{{ route('design_overall.indexOverall') }}">
                    <i class="fa fa-cube"></i> <span>Overall Data</span>
                </a>
            </li>

            <li class="header">DOC TEK PRODUKSI</li>
            <li>
                <a href="{{ route('tekprod.index') }}">
                    <i class="fa fa-cube"></i> <span>Dokumen TP Saya</span>
                </a>
            </li>
            <li>
                <a href="{{ route('tekprod_detail.index') }}">
                    <i class="fa fa-cube"></i> <span>Release Dokumen TP</span>
                </a>
            </li>
            <li>
                <a href="{{ route('tekprod_overall.indexOverall') }}">
                    <i class="fa fa-cube"></i> <span>Overall Data TP</span>
                </a>
            </li>

            <li class="header">DATA DINAS</li>
            <li>
                <a href="{{ route('dinas.index') }}">
                    <i class="fa fa-cube"></i> <span>Data Dinas Saya</span>
                </a>
            </li>

            <li class="header">AGENDA</li>
            <li>
                <a href="{{ route('full_calender') }}" target="_blank">
                    <i class="fa fa-dashboard"></i> <span>Agenda Proyek</span>
                </a>
            </li>
        </ul>
        @endif

<!-------------------------------------------Side Bar For Teknologi ----------------------------------------------->

@if (auth()->user()->level == 5)
        <ul class="sidebar-menu" data-widget="tree">
            <li>
                <a href="{{ route('dashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>My Performance</span>
                </a>
            </li>
            <li>
                <a href="{{ route('chartsDesign') }}">
                    <i class="fa fa-cube"></i> <span>Chart Des & Eng</span>
                </a>
            </li>
            <li>
                <a href="{{ route('chartsJadwal') }}">
                    <i class="fa fa-cube"></i> <span>Chart Jadwal</span>
                </a>
            </li>
            <li>
                <a href="{{ route('chartsCurva') }}">
                    <i class="fa fa-cube"></i> <span>Chart S-Curve</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard_oil') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard OIL</span>
                </a>
            </li>
            <li>
                <a href="{{ route('charts') }}">
                    <i class="fa fa-cube"></i> <span>Chart OIL</span>
                </a>
            </li>
        </ul>
        @endif

<!--------------------------------------------------Side Bar For Exsternal Sourche IMSS, IMST Dll ------------------------------------------------------>

        @if (auth()->user()->level == 6)
        <ul class="sidebar-menu" data-widget="tree">
        <li>
                <a href="{{ route('dashboard_oil') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard OIL</span>
                </a>
            </li>
            <li>
                <a href="{{ route('charts') }}">
                    <i class="fa fa-cube"></i> <span>Chart OIL</span>
                </a>
            </li>
            <li class="header">INSPEKSI & TEMUAN</li>
            <li>
                <a href="{{ route('emu.index') }}">
                    <i class="fa fa-cubes"></i> <span>Start Inspeksi Emu/DMU</span>
                </a>
            </li>
            <li>
                <a href="{{ route('temuan.index') }}">
                    <i class="fa fa-cubes"></i> <span>Daftarkan Temuan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('full_calender') }}" target="_blank">
                    <i class="fa fa-dashboard"></i> <span>Agenda Proyek</span>
                </a>
            </li>
        </ul>
        @endif

<!--------------------------------------------------Side Bar For Pengadaan ------------------------------------------------------>


        @if (auth()->user()->level == 7)
        <ul class="sidebar-menu" data-widget="tree">
        <li>
                <a href="{{ route('dashboard_oil') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard OIL</span>
                </a>
            </li>
            <li>
                <a href="{{ route('charts') }}">
                    <i class="fa fa-cube"></i> <span>Chart OIL</span>
                </a>
            </li>
        <li class="header">PENGIRIMAN BARANG</li>
            <li>
                <a href="{{ route('minta.index') }}">
                    <i class="fa fa-cart-arrow-down"></i> <span>Terima Permintaan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('transaksi_pemesanan.baru') }}">
                    <i class="fa fa-truck"></i> <span>Kirim Barang</span>
                </a>
            </li>
            <li>
                <a href="{{ route('pemesanan.index') }}">
                    <i class="fa fa-upload"></i> <span>Data Out Barang</span>
                </a>
            </li>
        </ul>
        @endif

<!--------------------------------------------------Side Bar For Manager QaQc ------------------------------------------------------>

        @if (auth()->user()->level == 12 || auth()->user()->level == 11 || auth()->user()->level == 8)
        <ul class="sidebar-menu" data-widget="tree">
            <li>
                <a href="{{ route('dashboard_oil') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard OIL</span>
                </a>
            </li>
            <li>
                <a href="{{ route('charts') }}">
                    <i class="fa fa-cube"></i> <span>Chart OIL</span>
                </a>
            </li>
            <li class="header">MASTER</li>
            <li>
                <a href="{{ route('kategori.index') }}">
                    <i class="fa fa-cube"></i> <span>Kategori Komponen</span>
                </a>
            </li>
            <li>
                <a href="{{ route('produk.index') }}">
                    <i class="fa fa-cube"></i> <span>Komponen</span>
                </a>
            </li>
            <li>
                <a href="{{ route('subpengujian.index') }}">
                    <i class="fa fa-cube"></i> <span>Tipe Inspeksi / Pengujian</span>
                </a>
            </li>
            <li>
                <a href="{{ route('car.index') }}">
                    <i class="fa fa-cube"></i> <span>Trainset</span>
                </a>
            </li>
            <li>
                <a href="{{ route('member.index') }}">
                    <i class="fa fa-cube"></i> <span>Team kerja</span>
                </a>
            </li>
            <li>
                <a href="{{ route('supplier.index') }}">
                    <i class="fa fa-cube"></i> <span>Supplier</span>
                </a>
            </li>
            <li class="header">INSPEKSI</li>
            <li>
                <a href="{{ route('full_calender') }}" target="_blank">
                    <i class="fa fa-dashboard"></i> <span>Agenda Proyek</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dmu.index') }}">
                    <i class="fa fa-cubes"></i> <span>Buat Doc Inspeksi EMU/DMU </span>
                </a>
            </li>
            <li>
                <a href="{{ route('emu.index') }}">
                    <i class="fa fa-cubes"></i> <span>Start Inspeksi Emu/DMU</span>
                </a>
            </li>
            <li>
                <a href="{{ route('emu_ctrl.index') }}">
                    <i class="fa fa-cubes"></i> <span>Approve & Print Inspeksi</span>
                </a>
            </li>
            <li>
                <a href="{{ route('emu_ctrl2.index') }}">
                    <i class="fa fa-cubes"></i> <span>Follow Up Inspeksi</span>
                </a>
            </li>
            <li>
                <a href="{{ route('temuan.index') }}">
                    <i class="fa fa-cubes"></i> <span>Daftarkan Temuan (OIL)</span>
                </a>
            </li>
            <li>
                <a href="{{ route('temuan2.index') }}">
                    <i class="fa fa-cubes"></i> <span>Tindak Lanjut Temuan (OIL)</span>
                </a>
            </li>
            <li>
            <li class="header">PERMINTAAN BARANG</li>
            <li>
                <a href="{{ route('permintaan.index') }}">
                    <i class="fa fa-upload"></i> <span>Minta Barang</span>
                </a>
            </li>
            <li>
                <a href="{{ route('proses.index') }}">
                    <i class="fa fa-download"></i> <span>Terima Barang</span>
                </a>
            </li>
            <li class="header">KEUANGAN PROYEK</li>
            <li>
                <a href="{{ route('pengujian.index') }}">
                    <i class="fa fa-money"></i> <span>Pemasukan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('pengeluaran.index') }}">
                    <i class="fa fa-money"></i> <span>Pengeluaran</span>
                </a>
            </li>
            <li class="header">REPORT</li>
            <li>
                <a href="{{ route('laporan.index') }}">
                    <i class="fa fa-file-pdf-o"></i> <span>Laporan</span>
                </a>
            </li>
            <li class="header">SYSTEM</li>
            <li>
                <a href="{{ route('user.index') }}">
                    <i class="fa fa-users"></i> <span>User</span>
                </a>
            </li>
        </ul>
        @endif

    </section>
    <!-- /.sidebar -->
</aside>
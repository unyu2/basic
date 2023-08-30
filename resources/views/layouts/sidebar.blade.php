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
        
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
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
                    <i class="fa fa-cube"></i> <span>Chart Design</span>
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
                    <i class="fa fa-cube"></i> <span>Jabatan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('part.index') }}">
                    <i class="fa fa-cube"></i> <span>Part</span>
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
                    <i class="fa fa-cube"></i> <span>Team</span>
                </a>
            </li>
            <li>
                <a href="{{ route('supplier.index') }}">
                    <i class="fa fa-cube"></i> <span>Supplier</span>
                </a>
            </li>
            <li class="header">DESIGN DRAWING</li>
            <li>
                <a href="{{ route('design.index') }}">
                    <i class="fa fa-cube"></i> <span>Design Drawing</span>
                </a>
            </li>
            <li>
                <a href="{{ route('design_detail.index') }}">
                    <i class="fa fa-cube"></i> <span>Release Design Drawing</span>
                </a>
            </li>

            <li class="header">INSPEKSI</li>
            <li>
                <a href="{{ route('full_calender') }}" target="_blank">
                    <i class="fa fa-dashboard"></i> <span>Schedule</span>
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
            <li class="header">INVENTARIS</li>
            <li>
                <a href="{{ route('barang.index') }}">
                    <i class="fa fa-upload"></i> <span>Barang Inventaris</span>
                </a>
            </li>
            <li>
                <a href="{{ route('transaksi.index') }}">
                    <i class="fa fa-download"></i> <span>Pinjam & Kembali Barang</span>
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


        @if (auth()->user()->level == 3)
        <ul class="sidebar-menu" data-widget="tree">
            <li>
                <a href="{{ route('dashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
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
                <a href="{{ route('proyek.index') }}">
                    <i class="fa fa-cube"></i> <span>Proyek</span>
                </a>
            </li>
            <li>
                <a href="{{ route('member.index') }}">
                    <i class="fa fa-cube"></i> <span>Team</span>
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
                    <i class="fa fa-dashboard"></i> <span>Schedule</span>
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
                    <i class="fa fa-cubes"></i> <span>Daftarkan Temuan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('temuan2.index') }}">
                    <i class="fa fa-cubes"></i> <span>Tindak Lanjut Temuan</span>
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


        @if (auth()->user()->level == 2)
        <ul class="sidebar-menu" data-widget="tree">
            <li>
                <a href="{{ route('dashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
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
                <a href="{{ route('proyek.index') }}">
                    <i class="fa fa-cube"></i> <span>Proyek</span>
                </a>
            </li>
            <li class="header">INSPEKSI</li>
            <li>
                <a href="{{ route('full_calender') }}" target="_blank">
                    <i class="fa fa-dashboard"></i> <span>Schedule</span>
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
                <a href="{{ route('temuan.index') }}">
                    <i class="fa fa-cubes"></i> <span>Daftarkan Temuan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('temuan2.index') }}">
                    <i class="fa fa-cubes"></i> <span>Tindak Lanjut Temuan</span>
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
            <li class="header">DESIGN DRAWING</li>
            <li>
                <a href="{{ route('design.index') }}">
                    <i class="fa fa-cube"></i> <span>Design Drawing</span>
                </a>
            </li>
            <li>
                <a href="{{ route('design_detail.index') }}">
                    <i class="fa fa-cube"></i> <span>Release Design Drawing</span>
                </a>
            </li>
        </ul>
        @endif

        @if (auth()->user()->level == 6)
        <ul class="sidebar-menu" data-widget="tree">
            <li>
                <a href="{{ route('dashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
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
                    <i class="fa fa-dashboard"></i> <span>Schedule</span>
                </a>
            </li>
        </ul>
        @endif
        @if (auth()->user()->level == 7)
        <ul class="sidebar-menu" data-widget="tree">
        <li>
                <a href="{{ route('dashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
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
    </section>
    <!-- /.sidebar -->
</aside>
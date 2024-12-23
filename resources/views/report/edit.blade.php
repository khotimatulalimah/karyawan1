@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Edit Laporan Penjualan</h1>

    <form action="{{ route('report.update', $laporan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_karyawan" class="form-label">Nama Karyawan</label>
            <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan" value="{{ $laporan->nama_karyawan }}" required>
        </div>

        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $laporan->tanggal }}" required>
        </div>

        <div class="mb-3">
            <label for="pendapatan" class="form-label">Pendapatan</label>
            <input type="number" class="form-control" id="pendapatan" name="pendapatan" value="{{ $laporan->pendapatan }}" min="0" step="0.01" required>
        </div>

        <button type="submit" class="btn btn-primary">Perbarui</button>
        <a href="{{ route('report.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection

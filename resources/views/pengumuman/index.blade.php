@extends('layouts.master')
@section('content')
<section class="content card" style="padding: 10px 10px 20px 20px  ">
    <div class="box">
        @if(session('sukses'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('sukses')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="row">
            <div class="col">
                <h3><i class="nav-icon fas fa-bullhorn my-0 btn-sm-1"></i> Data Pengumuman</h3>
                <hr>
            </div>
        </div>
        <div>
                <div class="col">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                        data-target="#tambahPengumuman"><i class="fas fa-plus"></i>
                        Tambah Data
                    </button>
                </div>
                <br>
        </div>
        <div class="row">
            <div class="row table-responsive">
                <div class="col-12">
                    <table class="table table-head-fixed" id='tabelAgendaMasuk'>
                        <thead>
                            <tr class="bg-light">
                                <th>No.</th>
                                <th>Judul</th>
                                <th>Dibuat Oleh</th>
                                <th>Waktu Pembuatan</th>
                                <th>Isi Pengumuman</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0;?>
                            @foreach($data_pengumuman as $pengumuman)
                            <?php $no++ ;?>
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$pengumuman->judul}}</td>
                                <td>{{$pengumuman->users->name}}</td>
                                <td>{{$pengumuman->created_at}}</td>
                                <td>{{$pengumuman->isi}}</td>
                                <td>
                                <a href="/pengumuman/{{$pengumuman->id}}/edit"
                                    class="btn btn-primary btn-sm my-1 mr-sm-1"><i
                                        class="nav-icon fas fa-pencil-alt"></i> Edit</a>
                                @if (auth()->user()->role == 'admin')
                                <a href="/pengumuman/{{$pengumuman->id}}/delete"
                                    class="btn btn-danger btn-sm my-1 mr-sm-1"
                                    onclick="return confirm('Hapus Data ?')"><i class="nav-icon fas fa-trash"></i>
                                    Hapus</a>
                                @endif
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Modal Tambah -->
        <div class="modal fade" id="tambahPengumuman" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i
                                class="nav-icon fas fa-bullhorn my-1 btn-sm-1"></i> Tambah Data Pengumuman</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/pengumuman/tambah" method="POST">
                            {{csrf_field()}}
                            <div class="row">
                                    <label for="judul">Judul Pengumuman</label>
                                    <input value="{{old('judul')}}" name="judul" type="text" class="form-control bg-light"
                                        id="judul" placeholder="Judul Pengumuman" required>
                                    <label for="isi">Isi Pengumuman</label>
                                    <textarea name="isi" class="form-control bg-light" id="isi" rows="7"
                                        placeholder="Isi Pengumuman" required>{{old('isi')}}</textarea>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i>
                                SIMPAN</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</section>
@endsection

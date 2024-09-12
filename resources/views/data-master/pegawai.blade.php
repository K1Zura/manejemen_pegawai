@extends('template.app')
@section('content')
@section('title', 'Pegawai')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<h1 style="font-family: 'Times New Roman', Times, serif">Pegawai</h1>
<div class="col-lg-12 mb-4 order-0">
    <div class="mb-3">
        <div class="d-flex justify-content-between">
            <div class="mb-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">
                    Tambah
                </button>
                <!-- Modal Tambah -->
                <div class="modal fade" id="tambahModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Tambah Pegawai</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="/tambah-pegawai" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <label for="nameBasic" class="form-label">Nama</label>
                                            <input type="text" id="nameBasic" name="nama" class="form-control"
                                                placeholder="Masukkan Nama" />
                                            @error('nama')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <label for="emailBasic" class="form-label">Alamat</label>
                                            <input type="text" name="alamat" id="emailBasic" class="form-control"
                                                placeholder="Masukkan Alamat" />
                                            @error('alamat')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="dobBasic" class="form-label">Tanggal Lahir</label>
                                            <input type="text" id="datepicker" name="tanggal_lahir"
                                                class="form-control" placeholder="DD / MM / YY" />
                                            @error('tanggal_lahir')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <label for="foto" class="form-label">Foto</label>
                                            <input class="dropzone" type="file" placeholder="Drop atau pilih file" name="photo" id="nameBasic my-awesome-dropzone" class="form-control" />
                                            @error('foto')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                        Batal
                                    </button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <div class="d-flex justify-content-between">
                        <select class="form-control select2" style="width: 100%;" id="mySelect2">
                            <option value="">Search...</option>
                            @foreach ($pegawai as $item)
                                <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <table id="myTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Tanggal Lahir</th>
                                <th>Foto</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pegawai as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td>{{ $item->tanggal_lahir }}</td>
                                    <td><img src="{{ asset('storage/foto/' . $item->foto) }}" alt="default.jpg"
                                            width="150"></td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#updateModal{{ $item->id }}">
                                                <box-icon type='solid' name='edit-alt'></box-icon>
                                            </button>
                                            <!-- Modal Edit-->
                                            <div class="modal fade" id="updateModal{{ $item->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel1">Edit Data
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="/update-pegawai/{{ $item->id }}"
                                                            method="post" enctype="multipart/form-data">
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-12 mb-3">
                                                                        <label for="nameBasic"
                                                                            class="form-label">Nama</label>
                                                                        <input type="text"
                                                                            value="{{ $item->nama }}"
                                                                            id="nameBasic" name="nama"
                                                                            class="form-control"
                                                                            placeholder="Masukkan Nama" />
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-12 mb-3">
                                                                        <label for="emailBasic"
                                                                            class="form-label">Alamat</label>
                                                                        <input type="text"
                                                                            value="{{ $item->alamat }}"
                                                                            name="alamat" id="emailBasic"
                                                                            class="form-control"
                                                                            placeholder="Masukkan Alamat" />
                                                                    </div>
                                                                    <div class="col-12 mb-3">
                                                                        <label for="dobBasic"
                                                                            class="form-label">Tanggal Lahir</label>
                                                                        <input type="date" id="datepicker"
                                                                            value="{{ $item->tanggal_lahir }}"
                                                                            id="dobBasic" name="tanggal_lahir"
                                                                            class="form-control"
                                                                            placeholder="DD / MM / YY" />
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-12 mb-3">
                                                                        <label for="foto"
                                                                            class="form-label">Foto</label>
                                                                        <input type="file" name="photo"
                                                                            id="nameBasic" class="form-control" />
                                                                        @error('foto')
                                                                            <div class="text-danger">
                                                                                {{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button"
                                                                    class="btn btn-outline-secondary"
                                                                    data-bs-dismiss="modal">
                                                                    Batal
                                                                </button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <form action="/delete-pegawai/{{ $item->id }}" method="post"
                                                id="deleteForm{{ $item->id }}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="button" class="btn btn-danger"
                                                    onclick="confirmDelete({{ $item->id }})">
                                                    <box-icon name='trash-alt' type='solid'></box-icon>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

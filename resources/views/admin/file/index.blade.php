@extends('layouts.dashboard')
@section('title', 'Admin | File')
    
@section('content')
<div class="row mb-3">
     <div class="col-md-12">
          @if (session('status'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
               <strong>{{ session('status') }}</strong>
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif
     </div>
</div>
<div class="row mb-3">
     <div class="col-md-12">
          <div class="card shadow">
               <div class="card-header d-flex justify-content-between">
                    <h4>Data File</h4>
                    <a href="{{ route('file.create') }}" class="btn btn-primary">Tambah</a>
               </div>
               <div class="card-body">
                    <div class="table-responsive">
                         <table class="table table-bordered table-hover" width="100%">
                              <thead>
                                   <tr>
                                        <th>No</th>
                                        <th>File</th>
                                        <th>Aksi</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   @php
                                       $no=1;
                                   @endphp
                                   @foreach ($files as $f)
                                   <tr>
                                        <td width="7%">{{ $no++ }}</td>
                                        <td width="74%"><a href="{{ url('storage/files/'. $f->file) }}" target="_blank">{{ $f->file }}</a></td>
                                        <td width="19%">
                                             <a href="#"
                                                  class="btn btn-info">
                                                  <i class="fa-solid fa-eye"></i>
                                              </a>
                                             <a href="{{ route('file.edit', encrypt($f->id)) }}"
                                                  class="btn btn-warning">
                                                  <i class="fa-solid fa-pen-to-square"></i>
                                              </a>
                                              <form action="#"
                                                  method="POST" class="d-inline mb-1">
                                                  @csrf
                                                  @method('delete')
                                                  <button type="submit" class="btn btn-danger"><i
                                                          class="fa-solid fa-trash"></i></button>
                                              </form>
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
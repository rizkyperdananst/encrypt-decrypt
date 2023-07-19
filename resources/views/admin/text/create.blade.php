@extends('layouts.dashboard')
@section('title', 'Admin | Encrypt Text')
    
@section('content')
<div class="row">
     <div class="col-md-12">
          <div class="card shadow">
               <div class="card-header">
                    <h4>Encrypt Text</h4>
               </div>
               <div class="card-body">
                    <form action="{{ route('text.store') }}" method="POST">
                         @csrf
                         <div class="row mb-3">
                              <div class="col-md-12">
                                   <label for="text" class="form-label">Text</label>
                                   <textarea name="text" id="text" cols="30" rows="10" class="form-control @error('text') is-invalid @enderror" placeholder="masukkan text"></textarea>
                                   @error('text')
                                       <div class="alert alert-danger mt-2 mb-2 p-2">{{ $message }}</div>
                                   @enderror
                              </div>
                         </div>
                         <div class="row mb-3">
                              <div class="col-md-12">
                                   <label for="key" class="form-label">Kunci</label>
                                   <input type="password" name="key" id="key" class="form-control @error('key') is-invalid @enderror" placeholder="masukkan kunci">
                                   @error('key')
                                       <div class="alert alert-danger mt-2 mb-2 p-2">{{ $message }}</div>
                                   @enderror
                              </div>
                         </div>
                         <div class="row mb-3">
                              <div class="col-md-12">
                                   <button class="btn btn-primary float-end ms-3">Encrypt</button>
                                   <a href="{{ route('text.index') }}" class="btn btn-secondary float-end">Kembali</a>
                              </div>
                         </div>
                    </form>
               </div>
          </div>
     </div>
</div>
@endsection
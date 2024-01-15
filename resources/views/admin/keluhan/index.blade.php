
@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Seluruh Data Keluhan</div>

                    <div class="card-body">
                        @if($keluhan->count() > 0)
                            <table class="table"  id="table1">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Tanggal</th>
                                        <th>Subject</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Response</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($keluhan as $item)
                                        <tr>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->created_at->isoFormat('D MMMM YYYY , HH:mm') }}</td>

                                            <td>{{ $item->subject }}</td>
                                            <td>{{ $item->description }}</td>
                                            <td>
                                                <span class="badge {{ $item->status === 'resolved' ? 'text-bg-success' : ($item->status === 'pending' ? 'text-bg-warning' : 'text-bg-default') }}">
                                                    {{ $item->status }}
                                                </span>
                                            </td>
                                            
                                            <td>{{ $item->admin_response ?? '-' }}</td>
                                            <td>
                                                @if ($item->status != 'resolved')
                                                    
                                                <button class="btn btn-primary"data-bs-toggle="modal" data-bs-target="#tanggapiModal{{ $item->id }}">
                                                    Tanggapi
                                                </button>
                                                @else
                                                <span class="text-success">Sudah ditanggapi</span>
                                                @endif

                                                <div class="modal fade" id="tanggapiModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalCenterTitle">Tanggapi Keluhan</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST" action="{{ route('keluhan.proses-tanggapi', $item->id) }}">
                                                                    @csrf
                                                                    <div class="form-group">
                                                                        <label for="subject">Nama</label>
                                                                        <input type="text" value="{{$item->user->name}}" name="subject" class="form-control" disabled>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="subject">Subject</label>
                                                                        <input type="text" value="{{$item->subject}}" name="subject" class="form-control" disabled>
                                                                    </div>
                                        
                                                                    <div class="form-group">
                                                                        <label for="description">Description</label>
                                                                        <textarea name="description"  class="form-control" disabled>{{$item->description}}</textarea>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="admin_response">Tanggapan Admin</label>
                                                                        <textarea name="admin_response" class="form-control" required></textarea>
                                                                    </div>
    
                                                                    <button type="submit" class="btn btn-primary">Tanggapi Keluhan</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>Tidak ada data keluhan.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

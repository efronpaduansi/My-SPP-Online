@extends('layouts.adminpanel')

@section('title')
    Data Staff
@endsection

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('staff.create') }}" class="btn btn-primary">Tambah Baru</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Ditambahkan</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $staff)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $staff->name }}</td>
                                    <td>{{ $staff->email }}</td>
                                    <td>{{ $staff->role->role }}</td>
                                    <td>{{ $staff->created_at->diffForHumans() }}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('staff.edit', $staff->id) }}"
                                            class="btn btn-sm btn-success me-2"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('staff.destroy', $staff->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Anda yakin menghapus data ini?')"><i
                                                    class="fas fa-times"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h3>Permissions</h3>
                            </div>
                            <div class="col text-right">
                                <a href="{{ route('permissions.create') }}" class="btn btn-primary float-end">Create Permission</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Permission</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($permissions->count())
                                    @foreach($permissions as $key => $permission)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $permission->name }}</td>
                                            <td>
                                                <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-primary">Edit</a>
                                                <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="3" class="text-center">No records found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        {{ $permissions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

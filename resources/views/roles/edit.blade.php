@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h3>
                                    Update Role
                                </h3>
                            </div>
                            <div class="col text-right">
                                <a href="{{ route('roles.index') }}" class="btn btn-primary float-end">Roles</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('roles.update', $role->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Role</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $role->name ?? old('name') }}">
                                        @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                           @foreach($permissions as $permission)
                                                <div class="form-check">
                                                    <label class="form-check--label">
                                                        <input type="checkbox" class="form-check-input" name="permissions[]" value="{{ $permission->id }}" {{ in_array($permission->id, $role->permissions->pluck('id')->toArray()) ? 'checked' : '' }}>
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                    </div>
                                </div>

                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

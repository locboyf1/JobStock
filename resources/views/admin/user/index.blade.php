@extends('admin.layout')
@section('title', 'Quản lý người dùng')
@section('content')
    <section class="section">
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Quản lý người dùng</h4>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Ảnh đại diện</th>
                                <th scope="col">Tên người dùng</th>
                                <th scope="col">Email</th>
                                <th scope="col">Số điện thoại</th>
                                <th scope="col">Vai trò</th>
                                <th class="col-3" scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>
                                        <figure class="avatar mr-2 avatar-xl">
                                            <img src="{{ asset('storage/' . $user->avatarPath) }}"
                                                alt="{{ $user->name }}">
                                        </figure>
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->role->name }}</td>
                                    <td>
                                        <div class="row">

                                            {{-- <a href="{{ route('admin.user.edit', ['id' => $user->id]) }}"
                                                class="btn btn-success"><i class="fa fa-edit"></i> Sửa</a> --}}
                                            <form method="post"
                                                action="{{ route('admin.user.status', ['id' => $user->id]) }}">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit"
                                                    class="btn {{ $user->is_active ? 'btn-warning' : 'btn-danger' }}"><i
                                                        class="fa {{ $user->is_active ? 'fa-unlock-alt' : 'fa-lock' }}"></i>
                                                    {{ $user->is_active ? 'Đang hoạt động' : 'Đã khóa' }}</button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Bảng người dùng hiện đang trống</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
@endsection

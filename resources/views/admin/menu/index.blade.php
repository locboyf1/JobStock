@extends('admin.layout')
@section('title', 'Quản lý menu')
@section('content')
    <section class="section">
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Quản lý menu</h4>
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.menu.create') }}" class="btn btn-success mb-3"><i
                            class="fas fa-file-medical"></i> Thêm nhóm menu</a>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Tiêu đề</th>
                                <th scope="col">Mô tả</th>
                                <th class="col-1" scope="col">Vị trí</th>
                                <th scope="col">Số menu con</th>
                                <th scope="col">Xem</th>
                                <th class="col-2" scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($menus as $menu)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $menu->title }}</td>
                                    <td>{{ $menu->description }}</td>
                                    <td class="row">
                                        <form action="{{ route('admin.menu.up', ['id' => $menu->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-secondary"><i
                                                    class="fas fa-arrow-up"></i></button>
                                        </form>
                                        <form action="{{ route('admin.menu.down', ['id' => $menu->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-secondary"><i
                                                    class="fas fa-arrow-down"></i></button>
                                        </form>

                                    </td>
                                    <td>{{ $menu->childrenMenus->count() }}</td>
                                    <td>
                                        <div><a href="{{ route('admin.job.index', ['id' => $menu->id]) }}"
                                                class="btn btn-info"><i class="fas fa-bars"></i> Danh sách</a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row">

                                            <a href="{{ route('admin.menu.edit', ['id' => $menu->id]) }}"
                                                class="btn btn-success"><i class="fa fa-edit"></i> Sửa</a>
                                            <form method="post"
                                                action="{{ route('admin.menu.status', ['id' => $menu->id]) }}">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit"
                                                    class="btn {{ $menu->is_show ? 'btn-warning' : 'btn-danger' }}"><i
                                                        class="fa {{ $menu->is_show ? 'fa-eye' : 'fa-eye-slash' }}"></i>{{ $menu->is_show ? 'Đang hiện' : 'Đã ẩn' }}</button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Bảng menu hiện đang trống</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
@endsection

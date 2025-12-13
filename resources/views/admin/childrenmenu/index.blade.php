@extends('admin.layout')
@section('title', 'Quản lý menu')
@section('content')
    <section class="section">
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Quản lý menu con | {{ $menuGroup->title }}</h4>
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.childrenmenu.create', ['id' => $menuGroup->id]) }}"
                        class="btn btn-success mb-3"><i class="fas fa-file-medical"></i> Thêm menu con</a>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Tiêu đề</th>
                                <th scope="col">Mô tả</th>
                                <th class="col-1" scope="col">Vị trí</th>
                                <th class="col-2" scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($menus as $menu)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $menu->title }}</td>
                                    <td>{{ $menu->description ? $menu->description : 'Trống' }}</td>
                                    <td class="row">
                                        <form action="{{ route('admin.childrenmenu.up', ['id' => $menu->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-secondary"><i
                                                    class="fas fa-arrow-up"></i></button>
                                        </form>
                                        <form action="{{ route('admin.childrenmenu.down', ['id' => $menu->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-secondary"><i
                                                    class="fas fa-arrow-down"></i></button>
                                        </form>

                                    </td>
                                    <td>
                                        <div class="row">

                                            <a href="{{ route('admin.childrenmenu.edit', ['id' => $menu->id]) }}"
                                                class="btn btn-success"><i class="fa fa-edit"></i> Sửa</a>
                                            <form method="post"
                                                action="{{ route('admin.childrenmenu.status', ['id' => $menu->id]) }}">
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
                                    <td colspan="6" class="text-center">Bảng menu hiện đang trống</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
@endsection

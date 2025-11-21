@extends('admin.layout')
@section('title', 'Quản lý công ty')

@section('content')
    <section class="section">
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Quản lý công ty</h4>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Logo</th>
                                <th scope="col">Tên công ty</th>
                                <th scope="col">Mã số thuế</th>
                                <th scope="col">Thời gian</th>
                                <th scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($companies as $company)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>
                                        <figure class="avatar mr-2 avatar-xl"><img
                                                src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->title }}" />
                                        </figure>
                                    </td>
                                    <td>{{ $company->title }}</td>
                                    <td>{{ $company->tax_code }}</td>
                                    <td>{{ $company->updated_at }}</td>
                                    <td>
                                        <div><a href="{{ route('admin.company.show', $company->id) }}" class="btn btn-info"><i
                                                    class="fas fa-eye"></i> Xem</a>
                                        </div>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Danh sách công ty cần phê duyệt hiện đang trống</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
@endsection

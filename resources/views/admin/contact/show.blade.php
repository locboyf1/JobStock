@extends('admin.layout')

@section('title', 'Liên hệ')

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Thông tin bài liên hệ</h4>
                    </div>
                    <div class="card-body">
                        <div class="col-md-4 col-4 b-r">
                            <strong>Tên người gửi</strong>
                            <br>
                            <p class="text-muted">{{ $contact->name }}</p>
                        </div>
                        <div class="row ml-1 mr-1">
                            <div class="col-md-4 col-4 b-r">
                                <strong>Email</strong>
                                <br>
                                <t class="text-muted"><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></p>
                            </div>
                            <div class="col-md-4 col-4 b-r">
                                <strong>Số điện thoại</strong>
                                <br>
                                <p class="text-muted"><a href="tel:{{ $contact->phone }}">{{ $contact->phone }}</a></p>
                            </div>
                        </div>
                        <hr>
                        <hr>
                        <div class="col-md-12 col-12 b-r">
                            <strong>Tiêu đề bài liên hệ</strong>
                            <br>
                            <p class="text-muted">{{ $contact->subject }}</p>
                        </div>
                        <div class="col-md-12 col-12 b-r">
                            <strong>Nội dung bài liên hệ</strong>
                            <br>
                            <p class="text-muted">{{ $contact->message }}</p>
                        </div>
                        <div class="float-right mt-3">
                            <a href="{{ route('admin.contact.index') }}" class="btn btn-secondary">Quay lại</a>
                            <form action="{{ route('admin.contact.status', ['id' => $contact->id]) }}"
                                style="display: inline-block;" method="post">
                                @csrf
                                @method('PUT')
                                <button type="submit"
                                    class="btn btn-primary">{{ $contact->is_processed ? 'Đánh dấu chưa xử lý' : 'Đánh dấu đã xử lý' }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('admin.layout')
@section('title', 'Cài đặt trợ lý ảo')
@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.chatbotsetting.update') }}" method="post" class="card">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Trợ lý chatbot</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="rules">Viết luật cho trợ lý chatbot</label>
                                <textarea class="form-control" name="rules" rows="500" style="height: 400px !important">{{ $rules }}</textarea>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary mr-1" type="submit">Lưu lại</button>
                            <button class="btn btn-secondary" type="reset">Đặt lại</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

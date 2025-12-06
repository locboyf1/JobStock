@extends('admin.layout')

@section('title', 'Thông tin công ty')

@section('content')
    @php use App\Utilities\functions; @endphp
    <section class="section">
        <div class="section-body">
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card author-box">
                        <div class="card-body">
                            <div class="author-box-center">
                                <img alt="image" src="{{ asset('storage/' . $company->logo) }}"
                                    class="rounded-circle author-box-picture">
                                <div class="clearfix"></div>
                                <div class="author-box-name">
                                    <a href="#">{{ $company->title }}</a>
                                </div>
                            </div>
                            <div class="text-center">
                                <div class="author-box-description">
                                    <p>{{ $company->description }}
                                    </p>
                                </div>
                                <hr>
                                <div class="mb-2 mt-3">
                                    <div class="text-small font-weight-bold"><strong>Địa chỉ:
                                        </strong>{{ $company->address }}</div>
                                </div>
                                <a href="#" class="btn btn-social-icon mr-1 btn-facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="btn btn-social-icon mr-1 btn-twitter">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="btn btn-social-icon mr-1 btn-github">
                                    <i class="fab fa-github"></i>
                                </a>
                                <a href="#" class="btn btn-social-icon mr-1 btn-instagram">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <div class="w-100 d-sm-none"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Personal Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="py-1">
                                <p class="clearfix">
                                    <span class="float-left">
                                        Trang web
                                    </span>
                                    @if ($company->website == null)
                                        <span class="float-right text-muted">
                                            Không có
                                        </span>
                                    @else
                                        <a href="{{ $company->website }}" class="float-right text-muted">
                                            Truy cập
                                        </a>
                                    @endif
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Cửa hàng
                                    </span>
                                    @if ($company->shop == null)
                                        <span class="float-right text-muted">
                                            Không có
                                        </span>
                                    @else
                                        <a href="{{ $company->shop }}" class="float-right text-muted">
                                            Truy cập
                                        </a>
                                    @endif
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Facebook
                                    </span>
                                    @if ($company->facebook == null)
                                        <span class="float-right text-muted">
                                            Không có
                                        </span>
                                    @else
                                        <a href="{{ $company->facebook }}" class="float-right text-muted">
                                            Truy cập
                                        </a>
                                    @endif
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Youtube
                                    </span>
                                    @if ($company->youtube == null)
                                        <span class="float-right text-muted">
                                            Không có
                                        </span>
                                    @else
                                        <a href="{{ $company->youtube }}" class="float-right text-muted">
                                            Truy cập
                                        </a>
                                    @endif
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Pinterest
                                    </span>
                                    @if ($company->pinterest == null)
                                        <span class="float-right text-muted">
                                            Không có
                                        </span>
                                    @else
                                        <a href="{{ $company->pinterest }}" class="float-right text-muted">
                                            Truy cập
                                        </a>
                                    @endif
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        LinkedIn
                                    </span>
                                    @if ($company->linkedin == null)
                                        <span class="float-right text-muted">
                                            Không có
                                        </span>
                                    @else
                                        <a href="{{ $company->linkedin }}" class="float-right text-muted">
                                            Truy cập
                                        </a>
                                    @endif
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Wikipedia
                                    </span>
                                    @if ($company->wikipedia == null)
                                        <span class="float-right text-muted">
                                            Không có
                                        </span>
                                    @else
                                        <a href="{{ $company->wikipedia }}" class="float-right text-muted">
                                            Truy cập
                                        </a>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-8">
                    <div class="card">
                        <div class="padding-20">
                            <div class="tab-content tab-bordered">
                                <div class="tab-pane show active">
                                    <div class="row">
                                        <div class="col-md-3 col-6 b-r">
                                            <strong>Mã số thuế</strong>
                                            <br>
                                            <p class="text-muted">{{ $company->tax_code }}</p>
                                        </div>
                                        <div class="col-md-3 col-6 b-r">
                                            <strong>Hotline</strong>
                                            <br>
                                            <p class="text-muted">{{ $company->phone }}</p>
                                        </div>
                                        <div class="col-md-3 col-6 b-r">
                                            <strong>Email</strong>
                                            <br>
                                            <p class="text-muted">{{ $company->email }}</p>
                                        </div>
                                        <div class="col-md-3 col-6">
                                            <strong>Vị trí</strong>
                                            <br>
                                            <p class="text-muted">{{ functions::getProvinceName($company->province_id) }}
                                            </p>
                                        </div>
                                    </div>
                                    @foreach ($company->content as $block)
                                        <div class="section-title">{{ $block['title'] }}</div>
                                        <p class="">{{ $block['description'] }}</p>
                                        <ul>
                                            @foreach ($block['row_content'] as $row)
                                                <li>{{ $row }}</li>
                                            @endforeach
                                        </ul>
                                    @endforeach

                                    <h4>Giấy tờ chứng minh quyền sở hữu/đại diện</h4>
                                    <img src="{{ asset('storage/' . $company->confirm_image) }}" width="100%" />
                                    @if ($company->confirm_updated_image != null)
                                        <h4>Giấy tờ chứng minh sự thay đổi thông tin</h4>
                                        <img src="{{ asset('storage/' . $company->confirm_updated_image) }}" width="100%" />
                                    @endif
                                    <div class="text-right mt-3">
                                        <form action="{{ route('admin.company.approve', $company->id) }}" method="post"
                                            class="d-inline-block">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn-primary" type="submit">Duyệt</button>
                                        </form>
                                        <form action="{{ route('admin.company.unapprove', $company->id) }}" method="post"
                                            class="d-inline-block">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn-danger" type="submit">Không duyệt</button>
                                        </form>
                                        <a href="{{ route('admin.company.index') }}" class="btn btn-secondary">Quay
                                            lại</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

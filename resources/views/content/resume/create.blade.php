@extends('content.layout')
@section('title', 'Tạo CV')
@section('content')
    <style>
        iframe {
            width: 100%;
            height: 100vh;
        }
    </style>
    <section class="inner-header-title" style="background-image:url({{ asset('assets/img/banner-10.jpg') }})">
        <div class="container">
            <h1>Tạo CV</h1>
        </div>
    </section>
    <div class="clearfix"></div>

    <iframe id="cv-iframe" src="https://resume-builder-swart-chi.vercel.app/builder"></iframe>

    <script>
        window.addEventListener("message", (event) => {
            if (event.data && event.data.type === 'CV_DATA_SAVE') {
                const cvJson = event.data.payload;

                console.log("Đã nhận dữ liệu từ React:", cvJson);

                saveToLaravel(cvJson);
            }
        }, false);

        function saveToLaravel(jsonData) {
            fetch('/api/save-cv', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        cv_data: jsonData
                    })
                })
                .then(response => response.json())
                .then(data => alert("Đã lưu CV thành công vào hệ thống!"));
        }
    </script>
@endsection

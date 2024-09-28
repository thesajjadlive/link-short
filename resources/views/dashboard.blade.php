@extends('layouts.frontend.master')
@section('content')

    <div class="counter">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-4 col-md-4 col-sm-6 cbr-1">
                    <div class="count-up">
                        <i class="fa-solid fa-link"></i>
                        <p class="counter-count">{{ $total_url??0 }}</p>
                        <h3>URL</h3>
                    </div>
                </div>

                <div class="col-12 col-lg-4 col-md-4 col-sm-6 cbr-1">
                    <div class="count-up">
                        <i class="fa-solid fa-link"></i>
                        <p class="counter-count">{{ $click_links??0 }}</p>
                        <h3>Clicked</h3>
                    </div>
                </div>

                <div class="col-12 col-lg-4 col-md-4 col-sm-6 cbr-1">
                    <div class="count-up">
                        <i class="fa-solid fa-link"></i>
                        <p class="counter-count">{{ $total_click??0 }}</p>
                        <h3>Total Click</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="banner">
        <div class="container ">
            <div class="row justify-content-center">
                <div class="col-8 col-lg-8 col-md-8">
                    <div style="margin-top:30px; margin-bottom: 30px">
                        <form id="url-shortener-form" class="form-inline" autocomplete="off">
                            <div class="form-group row mb-2">
                                <div class="col-10 col-lg-10 col-md-10">
                                    <input type="url" name="original_url" required class="form-control" id="url" placeholder="Type or paste your long link here">
                                </div>
                                <div class="col-2 col-lg-2 col-md-2">
                                    <button type="submit" class="btn btn-primary submit-btn">Short</button>
                                </div>
                            </div>
                        </form>
                        <div id="result" style="margin-top: 20px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="notice-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @if( session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Deleted!</strong> Data has been deleted successfully.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-8">
                            <h2 class="antialiased">URL Shorted </h2>
                        </div>
                    </div>

                    <div class="notice-box">
                        <table class="table table-bordered border-dark">
                            <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Original URL</th>
                                <th scope="col">Short URL</th>
                                <th scope="col">Clicked</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($links as $index=>$link)
                                <tr>
                                    <th scope="row">{{ $index+1 }}</th>
                                    <td>{{ $link->original_url }}</td>
                                    <td>
                                        <a href="{{ config('app.url').$link->short_url }}" target="_blank" class="p-2 font-weight-bold text-decoration-none">
                                            {{ $link->short_url }}
                                        </a>
                                    </td>
                                    <td>{{ $link->click_count }}</td>
                                    <td>
                                        <form id="delete-form" action="{{ route('destroy', $link->id) }}" method="POST">
                                            @csrf
                                            <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <h5 class="text-center"> No Data Found</h5>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            // Handle form submission via AJAX
            $('#url-shortener-form').on('submit', function(e) {
                e.preventDefault(); // Prevent form from submitting traditionally
                let url = $('#url').val();

                $.ajax({
                    url: "{{ route('shorten') }}", // Shortening URL route
                    type: "POST",
                    dataType: "json",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        url: url
                    },
                    success: function(response) {
                        $('#result').html(
                            '<p>Shortened URL: <a href="' + response.short_url + '" target="_blank">' + response.short_url + '</a></p>'
                        );
                    },
                    error: function(xhr, status, error) {
                        $('#result').html(
                            '<p style="color: red;">Error: ' + xhr.responseJSON.message + '</p>'
                        );
                    }
                });
            });
        });
    </script>

@endsection

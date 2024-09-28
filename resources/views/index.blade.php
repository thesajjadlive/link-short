@extends('layouts.frontend.master')
@section('content')
    <section class="banner">
        <div class="container ">
            <div class="row">
                <div class="col-4 col-lg-4 col-md-4">
                    <div class="banner-text">
                        <h2 class="text-5xl antialiased">Welcome to <br> <span class="text-primary">SHORTO</span></h2>
                        <p>The best link shortener for your links</p>
                    </div>
                </div>
                <div class="col-8 col-lg-8 col-md-8">
                    <div style="margin-top: 100px">
                        <form id="url-shortener-form" class="form-inline" autocomplete="off">
                            <div class="form-group row mb-2">
                                <div class="col-8 col-lg-8 col-md-8">
                                    <input type="url" name="original_url" required class="form-control" id="url" placeholder="Type or paste your long link here">
                                </div>
                                <div class="col-4 col-lg-4 col-md-4">
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

    <section id="about" class="section-padding bg-indigo-100">
        <div class="container">
            <div class="row">
                <div class="col-md-4 align-self-center">
                    <h4 class="antialiased">About Company</h4>
                </div>
                <div class="col-md-8">
                    <div class="about-content">
                        <p class="text-justify" style="font-size:15px;font-weight: 400;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in feugiat ante. Proin volutpat purus ut erat ornare, ut vestibulum ipsum auctor. Aenean facilisis placerat purus, quis hendrerit sem volutpat egestas. Sed diam neque, hendrerit sed sapien a, vulputate porta nisi. Sed nec neque ullamcorper, pharetra ipsum non, fermentum ante. Donec in aliquam nisi. Suspendisse eu tortor at est sagittis vestibulum eu vitae tortor. Sed condimentum nibh sit amet lorem iaculis imperdiet. Nam eleifend ante eu elementum congue.
                        </p>
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
                        if (xhr.responseJSON.message == 'Unauthenticated.') {
                            window.location.href = '{{ route("login") }}';
                        }
                        else{
                            $('#result').html(
                                '<p style="color: red;">Error: ' + xhr.responseJSON.message + '</p>'
                            );
                        }
                    }
                });
            });
        });
    </script>

@endsection

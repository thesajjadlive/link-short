@extends('layouts.master')
@php
    $pageTitle = 'Dashboard';
@endphp
@section('content')
    <!-- START PAGE CONTENT-->
    <div class="page-heading">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="page-title">{{ $pageTitle??'' }}</h1>
            </div>
            <div class="col-sm-6 pt-4 text-right">

            </div>
        </div>
    </div>
    <div class="page-content fade-in-up">
        <div class="ibox rounded">
            <div class="ibox-body">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="ibox bg-gradient-default color-white widget-stat">
                            <div class="ibox-body">
                                <h2 class="m-b-5 font-strong">{{ $total_url??0 }}</h2>
                                <div class="m-b-5">TOTAL LINK</div><i class="ti-link widget-stat-icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="ibox bg-gradient-info color-white widget-stat">
                            <div class="ibox-body">
                                <h2 class="m-b-5 font-strong">{{ $click_links??0 }}</h2>
                                <div class="m-b-5">CLICKED LINK</div><i class="ti-link widget-stat-icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="ibox bg-gradient-primary color-white widget-stat">
                            <div class="ibox-body">
                                <h2 class="m-b-5 font-strong">{{ $total_click??0 }}</h2>
                                <div class="m-b-5">TOTAL CLICK</div><i class="ti-link widget-stat-icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="ibox bg-gradient-danger color-white widget-stat">
                            <div class="ibox-body">
                                <h2 class="m-b-5 font-strong">{{ $user??0 }}</h2>
                                <div class="m-b-5">USERS</div><i class="ti-user widget-stat-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="ibox">
                            <div class="ibox-head">
                                <div class="ibox-title">Generated Links</div>
                            </div>
                            <div class="ibox-body">
                                <table class="table">
                                    <thead class="thead-default">
                                    <tr>
                                        <th>No.</th>
                                        <th>Original URL</th>
                                        <th>Short URL</th>
                                        <th>Clicked</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($links as $index=>$link)
                                        <tr>
                                            <td>{{ $index+1 }}</td>
                                            <td>{{ $link->original_url }}</td>
                                            <td>
                                                <a href="{{ config('app.url').$link->short_url }}" target="_blank" class="p-2 font-weight-bold text-decoration-none">
                                                    {{ $link->short_url }}
                                                </a>
                                            </td>
                                            <td>{{ $link->click_count }}</td>
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
            </div>
        </div>
    </div>
@endsection

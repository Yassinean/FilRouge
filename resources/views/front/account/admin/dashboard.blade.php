@extends('front.layouts.app')

@section('main')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">Account Settings</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="sticky-top">
                        @include('front.account.side-bar')
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="d-flex justify-content-evenly flex-wrap">
                        <div class="card col-lg-5 border-0 shadow mb-4">
                            <div class="media d-flex">
                                <div class="media-body text-center">
                                    <h3>{{$jobs}}</h3>
                                    <span>Offre D'emploi</span>
                                </div>
                            </div>
                        </div>
                        <div class="card col-lg-5 border-0 shadow mb-4">
                            <div class="media d-flex">
                                <div class="media-body text-center">
                                    <h3>{{$employers}}</h3>
                                    <span>Employers</span>
                                </div>
                            </div>
                        </div>
                        <div class="card col-lg-5 border-0 shadow mb-4">
                            <div class="media d-flex">
                                <div class="media-body text-center">
                                    <h3>{{$candidats}}</h3>
                                    <span>Candidats</span>
                                </div>
                            </div>
                        </div>
                        <div class="card col-lg-5 border-0 shadow mb-4">
                            <div class="media d-flex">
                                <div class="media-body text-center">
                                    <h3>{{$categories}}</h3>
                                    <span>Categories</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <canvas id="userChart"></canvas>
                    <div>
                        <x-message/>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@section('customJs')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('userChart').getContext('2d');
        var userChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['{{$jobs}} Jobs', '{{$categories}} Categories', '{{$candidats}} Candidats', '{{$employers}} Employers'],
                datasets: [{
                    label: ['{{$jobs}} Jobs', '{{$categories}} Categories','{{$candidats}} Candidats', '{{$employers}} Employers'],
                    data: [{{$jobs}}, {{$categories}}, {{$candidats}}, {{$employers}}],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 9, 32, 0.2)',
                        'rgba(25, 249, 13, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                    ],
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false,
                        position: 'top',
                        labels: {
                            font: {
                                size: 14
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection

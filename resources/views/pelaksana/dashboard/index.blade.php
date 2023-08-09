@extends('pelaksana.layout.core.index')
@section('title')
  @role('admin')
    Admin - Dashboard
  @endrole
  @role('panti')
    Panti - Dashboard
  @endrole
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/select2/css/select2.min.css') }}">
@endsection
@section('content')
  <div class="content-wrapper">
    <div class="row">
      <div class="col-sm-4 grid-margin">
        <div class="card">
          <div class="card-body">
            <h5>Total Panti Asuhan</h5>
            <div class="row">
              <div class="col-8 col-sm-12 col-xl-8 my-auto">
                <div class="d-flex d-sm-block d-md-flex align-items-center">
                  <h2 class="mb-0">{{$pantiVerif}}</h2>
                  <p class="text-success ml-2 mb-0 font-weight-medium">Terverifikasi</p>
                </div>
                <h6 class="text-muted font-weight-normal"> dari total {{$panti}} pengajuan panti asuhan</h6>
              </div>
              <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                <i class="icon-lg mdi mdi-home-variant text-primary ml-auto"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-4 grid-margin">
        <div class="card">
          <div class="card-body">
            <h5>Total Penggalangan Dana</h5>
            <div class="row">
              <div class="col-8 col-sm-12 col-xl-8 my-auto">
                <div class="d-flex d-sm-block d-md-flex align-items-center">
                  <h2 class="mb-0">{{$penggalanganVerif}}</h2>
                  <p class="text-success ml-2 mb-0 font-weight-medium">Terverifikasi</p>
                </div>
                <h6 class="text-muted font-weight-normal"> dari total {{$penggalangan}} pengajuan penggalangan dana</h6>
              </div>
              <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                <i class="icon-lg mdi mdi-library-books text-danger ml-auto"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-4 grid-margin">
        <div class="card">
          <div class="card-body">
            <h5>Total Donasi</h5>
            <div class="row">
              <div class="col-8 col-sm-12 col-xl-8 my-auto">
                <div class="d-flex d-sm-block d-md-flex align-items-center">
                  <h2 class="mb-0">{{$donasiVerif}}</h2>
                  <p class="text-danger ml-2 mb-0 font-weight-medium">Terverifikasi</p>
                </div>
                <h6 class="text-muted font-weight-normal">dari total {{$donasi}} donasi</h6>
              </div>
              <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                <i class="icon-lg mdi mdi-cash text-success ml-auto"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Donasi</h4>
            <canvas id="barChart" style="height:230px"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- content-wrapper ends -->
  <!-- partial:partials/_footer.html -->
@endsection
@section('js')
    <script>
    $(function () {
        /* ChartJS
        * -------
        * Data and config for chartjs
        */
        "use strict";
        var data = {
            labels: [
                "Januari",
                "Februari",
                "Maret",
                "April",
                "Mei",
                "Juni",
                "Juli",
                "Agustus",
                "September",
                "Oktober",
                "November",
                "Desember",
            ],
            datasets: [
                {
                    label: "# of Votes",
                    data: [
                        {{$donasiVerifJan}}, 
                        {{$donasiVerifFeb}}, 
                        {{$donasiVerifMar}}, 
                        {{$donasiVerifApr}},
                        {{$donasiVerifMei}},
                        {{$donasiVerifJun}},
                        {{$donasiVerifJul}},
                        {{$donasiVerifAgu}},
                        {{$donasiVerifSep}},
                        {{$donasiVerifOkt}},
                        {{$donasiVerifNov}},
                        {{$donasiVerifDes}}
                    ],
                    backgroundColor: [
                        "rgba(255, 99, 132, 0.2)",
                        "rgba(54, 162, 235, 0.2)",
                        "rgba(255, 206, 86, 0.2)",
                        "rgba(75, 192, 192, 0.2)",
                        "rgba(153, 102, 255, 0.2)",
                        "rgba(255, 159, 64, 0.2)",
                        "rgba(255, 255, 204, 0.2)",
                        "rgba(128, 255, 0, 0.2)",
                        "rgba(204, 255, 255, 0.2)",
                        "rgba(255, 153, 204, 0.2)",
                        "rgba(255, 102, 102, 0.2)",
                        "rgba(153, 153, 255, 0.2)",
                    ],
                    borderColor: [
                        "rgba(255,99,132,1)",
                        "rgba(54, 162, 235, 1)",
                        "rgba(255, 206, 86, 1)",
                        "rgba(75, 192, 192, 1)",
                        "rgba(153, 102, 255, 1)",
                        "rgba(255, 159, 64, 1)",
                        "rgba(255, 99, 132, 0.2)",
                        "rgba(54, 162, 235, 0.2)",
                        "rgba(255, 206, 86, 0.2)",
                        "rgba(75, 192, 192, 0.2)",
                        "rgba(153, 102, 255, 0.2)",
                        "rgba(255, 159, 64, 0.2)",
                    ],
                    borderWidth: 1,
                    fill: false,
                },
            ],
        };
        var multiLineData = {
            labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
            datasets: [
                {
                    label: "Dataset 1",
                    data: [12, 19, 3, 5, 2, 3],
                    borderColor: ["#587ce4"],
                    borderWidth: 2,
                    fill: false,
                },
                {
                    label: "Dataset 2",
                    data: [5, 23, 7, 12, 42, 23],
                    borderColor: ["#ede190"],
                    borderWidth: 2,
                    fill: false,
                },
                {
                    label: "Dataset 3",
                    data: [15, 10, 21, 32, 12, 33],
                    borderColor: ["#f44252"],
                    borderWidth: 2,
                    fill: false,
                },
            ],
        };
        var options = {
            scales: {
                yAxes: [
                    {
                        ticks: {
                            beginAtZero: true,
                        },
                        gridLines: {
                            color: "rgba(204, 204, 204,0.1)",
                        },
                    },
                ],
                xAxes: [
                    {
                        gridLines: {
                            color: "rgba(204, 204, 204,0.1)",
                        },
                    },
                ],
            },
            legend: {
                display: false,
            },
            elements: {
                point: {
                    radius: 0,
                },
            },
        };

        var doughnutPieData = {
            datasets: [
                {
                    data: [30, 40, 30],
                    backgroundColor: [
                        "rgba(255, 99, 132, 0.5)",
                        "rgba(54, 162, 235, 0.5)",
                        "rgba(255, 206, 86, 0.5)",
                        "rgba(75, 192, 192, 0.5)",
                        "rgba(153, 102, 255, 0.5)",
                        "rgba(255, 159, 64, 0.5)",
                    ],
                    borderColor: [
                        "rgba(255,99,132,1)",
                        "rgba(54, 162, 235, 1)",
                        "rgba(255, 206, 86, 1)",
                        "rgba(75, 192, 192, 1)",
                        "rgba(153, 102, 255, 1)",
                        "rgba(255, 159, 64, 1)",
                    ],
                },
            ],

            // These labels appear in the legend and in the tooltips when hovering different arcs
            labels: ["Pink", "Blue", "Yellow"],
        };
        var doughnutPieOptions = {
            responsive: true,
            animation: {
                animateScale: true,
                animateRotate: true,
            },
        };
        var areaData = {
            labels: [
                "Januari",
                "Februari",
                "Maret",
                "April",
                "Mei",
                "Juni",
                "Juli",
                "Agustus",
                "September",
                "Oktober",
                "November",
                "Desember",
            ],
            datasets: [
                {
                    label: "# of Votes",
                    data: [12, 19, 3, 5, 2, 3, 12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        "rgba(255, 99, 132, 0.2)",
                        "rgba(54, 162, 235, 0.2)",
                        "rgba(255, 206, 86, 0.2)",
                        "rgba(75, 192, 192, 0.2)",
                        "rgba(153, 102, 255, 0.2)",
                        "rgba(255, 159, 64, 0.2)",
                        "rgba(255, 99, 132, 0.2)",
                        "rgba(54, 162, 235, 0.2)",
                        "rgba(255, 206, 86, 0.2)",
                        "rgba(75, 192, 192, 0.2)",
                        "rgba(153, 102, 255, 0.2)",
                        "rgba(255, 159, 64, 0.2)",
                    ],
                    borderColor: [
                        "rgba(255,99,132,1)",
                        "rgba(54, 162, 235, 1)",
                        "rgba(255, 206, 86, 1)",
                        "rgba(75, 192, 192, 1)",
                        "rgba(153, 102, 255, 1)",
                        "rgba(255, 159, 64, 1)",
                        "rgba(255,99,132,1)",
                        "rgba(54, 162, 235, 1)",
                        "rgba(255, 206, 86, 1)",
                        "rgba(75, 192, 192, 1)",
                        "rgba(153, 102, 255, 1)",
                        "rgba(255, 159, 64, 1)",
                    ],
                    borderWidth: 1,
                    fill: true, // 3: no fill
                },
            ],
        };

        var areaOptions = {
            plugins: {
                filler: {
                    propagate: true,
                },
            },
            scales: {
                yAxes: [
                    {
                        gridLines: {
                            color: "rgba(204, 204, 204,0.1)",
                        },
                    },
                ],
                xAxes: [
                    {
                        gridLines: {
                            color: "rgba(204, 204, 204,0.1)",
                        },
                    },
                ],
            },
        };

        var multiAreaData = {
            labels: [
                "Jan",
                "Feb",
                "Mar",
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep",
                "Oct",
                "Nov",
                "Dec",
            ],
            datasets: [
                {
                    label: "Facebook",
                    data: [8, 11, 13, 15, 12, 13, 16, 15, 13, 19, 11, 14],
                    borderColor: ["rgba(255, 99, 132, 0.5)"],
                    backgroundColor: ["rgba(255, 99, 132, 0.5)"],
                    borderWidth: 1,
                    fill: true,
                },
                {
                    label: "Twitter",
                    data: [7, 17, 12, 16, 14, 18, 16, 12, 15, 11, 13, 9],
                    borderColor: ["rgba(54, 162, 235, 0.5)"],
                    backgroundColor: ["rgba(54, 162, 235, 0.5)"],
                    borderWidth: 1,
                    fill: true,
                },
                {
                    label: "Linkedin",
                    data: [6, 14, 16, 20, 12, 18, 15, 12, 17, 19, 15, 11],
                    borderColor: ["rgba(255, 206, 86, 0.5)"],
                    backgroundColor: ["rgba(255, 206, 86, 0.5)"],
                    borderWidth: 1,
                    fill: true,
                },
            ],
        };

        var multiAreaOptions = {
            plugins: {
                filler: {
                    propagate: true,
                },
            },
            elements: {
                point: {
                    radius: 0,
                },
            },
            scales: {
                xAxes: [
                    {
                        gridLines: {
                            display: false,
                        },
                    },
                ],
                yAxes: [
                    {
                        gridLines: {
                            display: false,
                        },
                    },
                ],
            },
        };

        var scatterChartData = {
            datasets: [
                {
                    label: "First Dataset",
                    data: [
                        {
                            x: -10,
                            y: 0,
                        },
                        {
                            x: 0,
                            y: 3,
                        },
                        {
                            x: -25,
                            y: 5,
                        },
                        {
                            x: 40,
                            y: 5,
                        },
                    ],
                    backgroundColor: ["rgba(255, 99, 132, 0.2)"],
                    borderColor: ["rgba(255,99,132,1)"],
                    borderWidth: 1,
                },
                {
                    label: "Second Dataset",
                    data: [
                        {
                            x: 10,
                            y: 5,
                        },
                        {
                            x: 20,
                            y: -30,
                        },
                        {
                            x: -25,
                            y: 15,
                        },
                        {
                            x: -10,
                            y: 5,
                        },
                    ],
                    backgroundColor: ["rgba(54, 162, 235, 0.2)"],
                    borderColor: ["rgba(54, 162, 235, 1)"],
                    borderWidth: 1,
                },
            ],
        };

        var scatterChartOptions = {
            scales: {
                xAxes: [
                    {
                        type: "linear",
                        position: "bottom",
                        gridLines: {
                            color: "rgba(204, 204, 204,0.1)",
                        },
                    },
                ],
                yAxes: [
                    {
                        gridLines: {
                            color: "rgba(204, 204, 204,0.1)",
                        },
                    },
                ],
            },
        };
        // Get context with jQuery - using jQuery's .get() method.
        if ($("#barChart").length) {
            var barChartCanvas = $("#barChart").get(0).getContext("2d");
            // This will get the first returned node in the jQuery collection.
            var barChart = new Chart(barChartCanvas, {
                type: "bar",
                data: data,
                options: options,
            });
        }

        if ($("#lineChart").length) {
            var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
            var lineChart = new Chart(lineChartCanvas, {
                type: "line",
                data: data,
                options: options,
            });
        }

        if ($("#linechart-multi").length) {
            var multiLineCanvas = $("#linechart-multi").get(0).getContext("2d");
            var lineChart = new Chart(multiLineCanvas, {
                type: "line",
                data: multiLineData,
                options: options,
            });
        }

        if ($("#areachart-multi").length) {
            var multiAreaCanvas = $("#areachart-multi").get(0).getContext("2d");
            var multiAreaChart = new Chart(multiAreaCanvas, {
                type: "line",
                data: multiAreaData,
                options: multiAreaOptions,
            });
        }

        if ($("#doughnutChart").length) {
            var doughnutChartCanvas = $("#doughnutChart").get(0).getContext("2d");
            var doughnutChart = new Chart(doughnutChartCanvas, {
                type: "doughnut",
                data: doughnutPieData,
                options: doughnutPieOptions,
            });
        }

        if ($("#pieChart").length) {
            var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
            var pieChart = new Chart(pieChartCanvas, {
                type: "pie",
                data: doughnutPieData,
                options: doughnutPieOptions,
            });
        }

        if ($("#areaChart").length) {
            var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
            var areaChart = new Chart(areaChartCanvas, {
                type: "line",
                data: areaData,
                options: areaOptions,
            });
        }

        if ($("#scatterChart").length) {
            var scatterChartCanvas = $("#scatterChart").get(0).getContext("2d");
            var scatterChart = new Chart(scatterChartCanvas, {
                type: "scatter",
                data: scatterChartData,
                options: scatterChartOptions,
            });
        }

        if ($("#browserTrafficChart").length) {
            var doughnutChartCanvas = $("#browserTrafficChart")
                .get(0)
                .getContext("2d");
            var doughnutChart = new Chart(doughnutChartCanvas, {
                type: "doughnut",
                data: browserTrafficData,
                options: doughnutPieOptions,
            });
        }
    });
    </script>
@endsection

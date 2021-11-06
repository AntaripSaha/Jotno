@extends("backend.template.layout")

@section('per_page_css')
@endsection

@section('body-content')
<div class="content-wrapper" style="min-height: 147px;">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item active">
                            @if( auth('web')->check() )
                            {{ auth('web')->user()->role->name }} Dashboard
                            @elseif( auth('super_admin')->check() )
                            Super Admin Dashboard
                            @endif
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Small boxes (Stat box) -->
            <div class="row">

                <!-- ITEM START -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $total_appoinment }}</h3>

                            <p>Total Appoinment</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                    </div>
                </div>
                <!-- ITEM END -->

                <!-- ITEM START -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $todays_appoinment }}</h3>

                            <p>Today's Appoinment</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                    </div>
                </div>
                <!-- ITEM END -->

                <!-- ITEM START -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $medicine }}</h3>

                            <p>Total Medicine</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                    </div>
                </div>
                <!-- ITEM END -->

                <!-- ITEM START -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $tests }}</h3>

                            <p>Total Tests</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                    </div>
                </div>
                <!-- ITEM END -->


            </div>
            <!-- /.row -->

            <div class="row">

                <div class="col-md-6 col-12" id="chart">
                    <p>Appoinment last 3 Months</p>
                </div>

                <div class="col-md-6 col-12" id="chart2">
                    <p>Registration Last 3 Months</p>
                </div>

                <div class="col-md-12 col-12 mt-5" id="chart3">
                    <p>Earning Last 6 Months</p>
                </div>

            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection

@section("per_page_js")
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    $.ajax({
        url: "{{ route('last.three.month.appoinment') }}",
        method: 'GET',
        data: {},
        success: function (data) {
            var pendingArray = Array(); 
            var confirmArray = Array(); 
            var completeArray = Array(); 
            var cancelArray = Array(); 
            var timeArray = Array(); 
            $.each(data.data, (key, value) => {
                pendingArray.push(value.pending) 
                confirmArray.push(value.confirm) 
                completeArray.push(value.complete)
                cancelArray.push(value.cancel) 
                timeArray.push(value.time) 
            })
            
            var options = {
                series: [{
                    name: 'Pending',
                    data:  pendingArray,
                },
                {
                    name: 'Confirm',
                    data:  confirmArray,
                },
                {
                    name: 'Complete',
                    data:  completeArray,
                },
                {
                    name: 'Cancel',
                    data:  cancelArray,
                }
                ],
                chart: {
                    height: 350,
                    type: 'bar',
                },
                plotOptions: {
                    bar: {
                        dataLabels: {
                            position: 'top', // top, center, bottom
                        },
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function (val) {
                        return val + "";
                    },
                    offsetY: -20,
                    style: {
                        fontSize: '11px',
                        colors: ["#0951a0"]
                    }
                },
                xaxis: {
                    categories: timeArray,
                    position: 'top',
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    crosshairs: {
                        fill: {
                            type: 'gradient',
                            gradient: {
                                colorFrom: '#0951a0',
                                colorTo: '#0951a0',
                                stops: [0, 100],
                                opacityFrom: 0.4,
                                opacityTo: 0.5,
                            }
                        }
                    },
                    tooltip: {
                        enabled: true,
                    }
                },
                yaxis: {
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false,
                    },
                    labels: {
                        show: false,
                        formatter: function (val) {
                            return val + "";
                        }
                    }
                },
                title: {
                    text: '',
                    floating: true,
                    offsetY: 330,
                    align: 'center',
                    style: {
                        color: '#444'
                    }
                }
            };
            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        }
    })
</script>

<script>
    $.ajax({
        url: "{{ route('last.three.month.registration') }}",
        method: 'GET',
        data: {},
        success: function (data) {
            var doctorArray = Array(); 
            var medicalAssistantArray = Array(); 
            var patientArray = Array(); 
            var timeArray = Array(); 
            $.each(data.data, (key, value) => {
                doctorArray.push(value.doctor) 
                medicalAssistantArray.push(value.medical_assistant) 
                patientArray.push(value.patient)
                timeArray.push(value.time) 
            })
            
            var options = {
                series: [{
                    name: 'Doctor',
                    data:  doctorArray,
                },
                {
                    name: 'Medical Assistant',
                    data:  medicalAssistantArray,
                },
                {
                    name: 'Patient',
                    data:  patientArray,
                },
                ],
                chart: {
                    height: 350,
                    type: 'bar',
                },
                plotOptions: {
                    bar: {
                        dataLabels: {
                            position: 'top', // top, center, bottom
                        },
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function (val) {
                        return val + "";
                    },
                    offsetY: -20,
                    style: {
                        fontSize: '11px',
                        colors: ["#0951a0"]
                    }
                },
                xaxis: {
                    categories: timeArray,
                    position: 'top',
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    crosshairs: {
                        fill: {
                            type: 'gradient',
                            gradient: {
                                colorFrom: '#0951a0',
                                colorTo: '#0951a0',
                                stops: [0, 100],
                                opacityFrom: 0.4,
                                opacityTo: 0.5,
                            }
                        }
                    },
                    tooltip: {
                        enabled: true,
                    }
                },
                yaxis: {
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false,
                    },
                    labels: {
                        show: false,
                        formatter: function (val) {
                            return val + "";
                        }
                    }
                },
                title: {
                    text: '',
                    floating: true,
                    offsetY: 330,
                    align: 'center',
                    style: {
                        color: '#444'
                    }
                }
            };
            var chart = new ApexCharts(document.querySelector("#chart2"), options);
            chart.render();
        }
    })
</script>


<script>
    $.ajax({
        url: "{{ route('last.six.month.sales') }}",
        method: 'GET',
        data: {},
        success: function (data) {
            var salesArray = Array(); 
            var timeArray = Array(); 
            $.each(data.data, (key, value) => {
                salesArray.push(value.sales) 
                timeArray.push(value.time) 
            })
            
            var options = {
                series: [{
                    name: 'Earn Amount',
                    data:  salesArray,
                },
                ],
                chart: {
                    height: 350,
                    type: 'bar',
                },
                plotOptions: {
                    bar: {
                        dataLabels: {
                            position: 'top', // top, center, bottom
                        },
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function (val) {
                        return val + "";
                    },
                    offsetY: -20,
                    style: {
                        fontSize: '11px',
                        colors: ["#0951a0"]
                    }
                },
                xaxis: {
                    categories: timeArray,
                    position: 'top',
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    crosshairs: {
                        fill: {
                            type: 'gradient',
                            gradient: {
                                colorFrom: '#0951a0',
                                colorTo: '#0951a0',
                                stops: [0, 100],
                                opacityFrom: 0.4,
                                opacityTo: 0.5,
                            }
                        }
                    },
                    tooltip: {
                        enabled: true,
                    }
                },
                yaxis: {
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false,
                    },
                    labels: {
                        show: false,
                        formatter: function (val) {
                            return val + "";
                        }
                    }
                },
                title: {
                    text: '',
                    floating: true,
                    offsetY: 330,
                    align: 'center',
                    style: {
                        color: '#444'
                    }
                }
            };
            var chart = new ApexCharts(document.querySelector("#chart3"), options);
            chart.render();
        }
    })
</script>
@endsection

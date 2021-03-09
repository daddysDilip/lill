@extends('layouts.admin_layout')
@section('name') Customer Detail @endsection

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
          <!-- users view start -->
          <section class="users-view">
            <!-- users view media object start -->
            <div class="row">
              <div class="col-12 col-sm-7">
                <div class="media mb-2">
                  <a class="mr-1" href="#">
                    <img src="{{asset('admin/images/user-avatar.png')}}" alt="users view avatar"
                      class="users-avatar-shadow rounded-circle" height="64" width="64">
                  </a>
                  <div class="media-body pt-25">
                    <h4 class="media-heading"><span class="users-view-name">{{$CustomerData->firstname ?? "No name found."." ".$CustomerData->lastname}} </span></h4>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-5 px-0 d-flex justify-content-end align-items-center px-1 mb-2">
                {{-- <a href="#" class="btn btn-sm mr-25 border"><i class="bx bx-envelope font-small-3"></i></a> --}}
                <a href="#" class="btn btn-sm mr-25 border">Profile</a>
                <a href="{{ route('users.edit', $CustomerData->id) }}" class="btn btn-sm btn-primary">Edit</a>
              </div>
            </div>
            <!-- users view media object ends -->
            <!-- users view card data start -->
            <div class="card">
              <div class="card-content">
                <div class="card-body">
                  <div class="row">
                    <div class="col-12 col-md-6">
                      <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td>Registered:</td>
                                <td>{{!empty($CustomerData->created_at) ? date('d M Y',strtotime($CustomerData->created_at)) : "" }}</td>
                            </tr>
                            <tr>
                                <td>Verified:</td>
                                <td class="users-view-verified">{{$CustomerData->status == 1 ? "Verified" : "Not Verified."}}</td>
                            </tr>
                            <tr>
                                <td>Role:</td>
                                <td class="users-view-role">{{$CustomerData->role_name}}</td>
                            </tr>
                            <tr>
                                <td>Email:</td>
                                <td>{{$CustomerData->email ?? '-'}}</td>
                            </tr>
                            <tr>
                                <td>Contact No:</td>
                                <td>{{$CustomerData->contactno ?? '-'}}</td>
                            </tr>
                            <tr>
                                <td>Account Type:</td>
                                <td>{{$CustomerData->account_type ?? '-'}}</td>
                            </tr>
                            <tr>
                                <td>Company Name:</td>
                                <td>{{$CustomerData->company_name ?? '-'}}</td>
                            </tr>
                            <tr>
                                <td>Status:</td>
                                <td><span class="badge {{$CustomerData->status == 1 ? "badge-light-active" : "badge-light-warning"}} users-view-status">{{$CustomerData->status == 1 ? "Active" : "Paused"}}</span></td>
                            </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="col-12 col-md-6">
                        <table class="table table-borderless">
                          <tbody>
                            <tr>
                                <td>Job Title:</td>
                                <td>{{$CustomerData->job_title ?? '-'}}</td>
                            </tr>
                            <tr>
                                <td>Company Website:</td>
                                <td>{{$CustomerData->company_website ?? '-'}}</td>
                            </tr>
                            <tr>
                                <td>Company Size:</td>
                                <td>{{$CustomerData->company_size ?? '-'}}</td>
                            </tr>
                            {{-- <tr>
                                <td>Country</td>
                                <td>{{$CustomerData->country_name ?? ''}}</td>
                            </tr>
                            <tr>
                                <td>State</td>
                                <td>{{$CustomerData->state_name ?? ''}}</td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td>{{$CustomerData->city_name ?? ''}}</td>
                            </tr> --}}
                            </tbody>
                        </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- users view card data ends -->
            <!-- users view card details start -->
            <div class="card">
              <div class="card-content">
                <div class="card-body">
                  <div class="row bg-primary bg-lighten-5 rounded mb-2 mx-25 text-center text-lg-left">
                    <div class="col-12 col-sm-4 p-2">
                      <h6 class="text-primary mb-0">Links: <span class="font-large-1 align-middle">{{get_user_links_count($CustomerData->id) ?? ''}}</span></h6>
                    </div>
                    <div class="col-12 col-sm-4 p-2">
                      <h6 class="text-primary mb-0">Link Groups: <span class="font-large-1 align-middle">{{get_user_links_group($CustomerData->id) ?? ""}}</span></h6>
                    </div>
                    <div class="col-12 col-sm-4 p-2">
                      <h6 class="text-primary mb-0">Following: <span class="font-large-1 align-middle">256</span></h6>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="table-responsive">
                        <table class="table" id="CustomerLinksInfo">
                            <thead>
                                <tr>
                                    <td>QR Code</td>
                                    <td>Destination URL</td>
                                    <td>Short URL</td>
                                    <td>Link Title</td>
                                    <td>Link Type</td>
                                    <td>Link Tags</td>
                                    <td>IP Address</td>
                                    <td>Status</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($CustomerData->links))
                                    @foreach ($CustomerData->links as $link)
                                        <tr>
                                            <td>
                                                @if (!empty($link->qr_code))
                                                    <img src="{{$link->qr_code}}" width="70px" />
                                                @endif
                                            </td>
                                            <td>{{$link->website_url}}</td>
                                            <td>{{$link->generated_link}}</td>
                                            <td>{{$link->link_title}}</td>
                                            <td>{{$link->links_type->type ?? ''}}</td>
                                            <td>
                                                @if (!empty($link->link_tags))
                                                    @foreach (explode(',',$link->link_tags) as $tags)
                                                        <span class="badge badge-active">{{$tags}}</span>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>{{$link->ip_address}}</td>
                                            <td><span class="badge badge-{{$link->status == 1 ? "success" : "error" }}">{{$link->status == 1 ? "Active" : "Paused" }}</span></td>
                                            <td>
                                                <a href="{{route('view.link.statistics',$link->id)}}" class="btn btn-sm btn-info btn-fetch-link-stats">View Statistics</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- users view card details ends -->

          </section>
          <!-- users view ends -->
        </div>
      </div>
    </div>
    <!-- END: Content-->

    <div class="modal fade" id="LinkDataModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Link Statistics</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Monthly Clicks Report</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body pl-0">
                                        <div class="height-300">
                                            <canvas id="link-bar-chart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        $('#CustomerLinksInfo').DataTable();

        $(document).on('click','a.btn-fetch-link-stats', function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('href'),
                success: function(data) {
                    if(data == "fail") {
                        Swal.fire({ 
                            type: "error", 
                            title: "Failed!", 
                            text: "Unable to fetch link details. Please try again later.", 
                            showCancelButton: 1,
                        })
                    } else {
                        setTimeout(function () {
                            var a = "#5A8DEE",
                            e = "#39DA8A",
                            o = "#FF5B5C",
                            i = "#FDAC41",
                            t = "#475F7B",
                            r = "#dae1e7",
                            l = "#f3f3f3",
                            s = "#fff",
                            n = [a, i, o, e, "#00CFDD", t],
                            d = $("#line-chart");
                            var Years = new Array();
                            var Months = new Array();
                            var Labels = new Array();
                            var Clicks = new Array();
                            data.monthly_report.forEach(function(data){
                                Months.push(data.month);
                                //Labels.push(data.stockName);
                                Clicks.push(data.total_clicks);
                            });
                            var ctx = document.getElementById("link-bar-chart").getContext('2d');
                            var myChart = new Chart(ctx, {
                                type: "bar",
                                options: {
                                    elements: {
                                        rectangle: {
                                            borderWidth: 2,
                                            borderSkipped: "left"
                                        }
                                    },
                                    responsive: !0,
                                    maintainAspectRatio: !1,
                                    responsiveAnimationDuration: 500,
                                    legend: {
                                        display: !1
                                    },
                                    scales: {
                                        xAxes: [{
                                            display: !0,
                                            gridLines: {
                                                color: r
                                            },
                                            scaleLabel: {
                                                display: !0
                                            }
                                        }],
                                        yAxes: [{
                                            display: !0,
                                            gridLines: {
                                                color: r
                                            },
                                            scaleLabel: {
                                                display: !0
                                            },
                                            ticks: {
                                                stepSize: 1e3
                                            }
                                        }]
                                    },
                                    title: {
                                        display: !0,
                                        text: "Total Clicks Per Month"
                                    }
                                },
                                data: {
                                    labels: Months,
                                    datasets: [{
                                        label: "Total Clicks",
                                        data: Clicks,
                                        backgroundColor: n,
                                        borderColor: "transparent"
                                    }]
                                }

                                
                            });
                            $('#LinkDataModal').modal('show');
                        },300);
                    }   
                }
            }).done(function() {
                setTimeout(function() {
                    $('#overlay').fadeOut(300);
                },500);
            });
        });

    </script>
@endsection
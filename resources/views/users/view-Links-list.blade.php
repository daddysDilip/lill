@extends('layouts.client_dashboard_layout')
@section('title') Link List @endsection

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
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
              <div class="col-12 col-md-7">
                <div class="media mb-2">
                <form class="user-link-report-date-form">
  <div class="form-row align-items-center">
    <div class="col-auto my-1">
      <label class="mr-sm-2 mb-2" for="">Select Date:</label>
      <input class="form-control" type="text" name="daterange" value="{{$daterange}}" />
    </div>
 
    <div class="col-auto my-1 mt-4">
      <button type="submit" class="btn  btn-block btn-theme p-2">Submit</button>
    </div>
  </div>
</form>
                </div>
              </div>

 

              <div class="col-12 col-md-5 px-0 d-flex justify-content-end align-items-center px-1 mb-2">
                
                {{-- <a href="" class="btn btn-sm btn-primary">Edit</a> --}}
              </div>
            </div>
            <!-- users view card data ends -->
            <!-- users view card details start -->
            <div class="card">
              <div class="card-content">
                <div class="card-body">
                  <div class="col-12">
                    <div class="table-responsive">
                      <table class="display nowrap" id="CustomerLinksInfo">
                        <thead>
                          <tr>
                            <th>Link</th>
                            <th>Create Date</th>
                            <th>Total clicks</th>
                            <th>Favorite</th>
                          </tr>
                        </thead>
                        <tbody>
                          @if (!empty($LinksData))
                            @foreach ($LinksData as $data)
                              <tr>
                                <td>{{$data->generated_link}}</td>
                                <td>{{date('d M Y',strtotime($data->created_at))}}</td>
                                <td>{{get_link_count($data->id)}}</td>
                                <td>{{$data->favorite_id ? "yes" : "no"}}</td>
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

@endsection

@section('js')
<script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
      $('#CustomerLinksInfo').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "order": [[ 1, "desc" ]], //or asc 
        "columnDefs" : [{"targets":1, "type":"date"}]
      });
  } );
  $(function() {
    $('input[name="daterange"]').daterangepicker({
      opens: 'left'
    }, function(start, end, label) {
      console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
    });
  });
</script>
@endsection
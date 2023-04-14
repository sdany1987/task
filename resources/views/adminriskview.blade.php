@php($layoutarr=['datatable' => true])
@extends('layouts.app',$layoutarr)

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <span class="float-end">
                <a href="{{route('home')}}" title="Home" class="btn btn-info text-white">
                    <i class="fa fw-bold fa-plus"></i>
                    Home Page
                </a>
            </span>
            <div class="card">
                <div class="card-header bg-info text-white">{{ __('Select from Admin') }}</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="col-md-10">
                        <div class="col-md-3">
                            <select id="risk_status_val" class="form-control ">
                                <option value="1">name</option>
                                <option value="0">description</option>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <form id="product_filter" class="form-horizontal mr-15">
                                <div class="input-group">
                                    <input type="text" id="risk_search_val" class="form-control" placeholder="Filter values">
                                    <span class="input-group-btn">
                                        <button id="risk_search" class="btn btn-info" type="button" alt="Search" title="Search">Search</button>
                                        <button id="risk_search_reset" class="btn btn-info" type="button" alt="Reset" title="Reset">Cancel</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="tableview risk_list">
                        @if(isset($risks) && count($risks) > 0)
                        <table class="table table-stripped" id="risktable">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i=0)
                                @foreach($risks as $risk)
                                <?php
                                $i++;
                                $id = $risk->id ?? '';
                                $name = $risk->name ?? '';
                                $description = $risk->description ?? '';
                                ?>
                                <tr>
                                    <td>
                                        <a style="text-decoration: none;" href="{{ route('risk.editRiskDet', ['id' => $id, 'type' => 1])  }}" title="View">+</a>
                                    </td>
                                    <td>{{$i}}</td>
                                    <td>{{$name}}</td>
                                    <td>{{$description}}</td>
                                    <td>
                                        <a onclick="viewRiskDet('{{$id}}');" data-toggle="modal" data-target=".bd-example-modal-lg1" href="#" title="View"><i class="fa fa-eye"></i></a>
                                        <a onclick="assign('{{$id}}');" href="#" title="assign"><i class="fa fa-thumbs-up"></i></a>
                                        <a onclick="deleteItem1('{{$id}}');" href="#" title="Delete"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else

                        <h3 class="alert alert-warning">No risk records found</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg1" id="viewRisk" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" id="viewRisk">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">View Risk
                        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                   </button> -->
                    </h5>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('js')
<script>
    $(document).ready(function() {
        $('#risktable').DataTable();
    });


    function viewRiskDet(id) {
        var addrurl = "{{ route('risk.view') }}";
        $.ajax({
            type: "post",
            dataType: 'json',
            url: addrurl,
            data: {
                id: id,
                "_token": "{{ csrf_token() }}",
            },
            success: function(response) {
                $("#viewRisk .modal-body").html(response.response_html);
                $("#viewRisk").modal('show');
            }
        });

    }

    function deleteItem1(fid) {
        var addrurl = "{{ route('risk.delete') }}";
        var text;
        text = "You will not be able to recover this file!";
        Swal.fire({
            title: "Are you sure?",
            text: text,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: true
        }).then(function(e) {
            //    function () {
            $.ajax({
                url: addrurl,
                data: {
                    id: fid,
                    _token: '{{ csrf_token() }}',
                },
                type: 'post',
                success: function(e) {
                    location.reload();
                },
            });
        });
    }

    function assign(fid) {
        var addrurl = "{{ route('risk.assign') }}";
        var redirecturl = "{{ route('home') }}";
        var text;
        text = "You will assign this risk!";
        Swal.fire({
            title: "Are you sure?",
            text: text,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, assign it!",
            closeOnConfirm: true
        }).then(function(e) {
            //    function () {
            $.ajax({
                url: addrurl,
                data: {
                    id: fid,
                    _token: '{{ csrf_token() }}',
                },
                type: 'post',
                success: function(e) {
                    location.href = redirecturl;
                },
            });
        });
    }

    $(document).on('click', '#risk_search', function(e) {
        e.preventDefault();
        var redirecturl = "{{route('risk.adminview')}}";
        var addrurl = "{{ route('risk.search') }}";
        var _token = $('meta[name="csrf-token"]').attr('content');
        var risk_status_val = $("#risk_status_val").val();
        var risk_search_val = $("#risk_search_val").val();
        if(risk_search_val != ''){
            location.href = redirecturl + '?risk_status_val=' + risk_status_val + '&risk_search_val=' + risk_search_val;
        }else{
            swal.fire('Enter values');
        }
        // $.ajax({
        //     url: addrurl,
        //     method: "POST",
        //     data: {
        //         _token: _token,
        //         risk_status_val: risk_status_val,
        //         risk_search_val: risk_search_val,
        //     },
        //     success: function(data) {
        //         $('.risk_list').html(data);
        //         // $('#risktable').DataTable();
        //     }
        // });
    });

    $(document).on('click', '#risk_search_reset', function(e) {
        e.preventDefault();
        var redirecturl = "{{route('risk.adminview')}}";
        var addrurl = "{{ route('risk.search') }}";
        var _token = $('meta[name="csrf-token"]').attr('content');
        location.href = redirecturl;
        // $.ajax({
        //     url: addrurl,
        //     method: "POST",
        //     data: {
        //         _token: _token,
        //     },
        //     success: function(data) {
        //         $("#risk_status_val").val('1');
        //         $("#risk_search_val").val('');
        //         $('.risk_list').html(data);
        //     }
        // });
    });
</script>

@endpush
@php($layoutarr=['datatable' => true])
@extends('layouts.app',$layoutarr)

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">

                <div class="col-md-10">
                    <div class="col-md-5">
                        <span class="float-end">
                            <a href="{{route('risk.create')}}" title="Create Risk" class="btn btn-info text-white">
                                <i class="fa fw-bold fa-plus"></i>
                                Create
                            </a>
                        </span>
                    </div>
                    <div class="col-md-5">
                        <span class="float-end">
                            <a href="{{route('risk.adminview')}}" title="Select Admin" class="btn btn-info text-white">
                                <i class="fa fw-bold fa-plus"></i>
                                Select from Admin
                            </a>
                        </span>
                    </div>
                </div>
                <div class="card-header bg-info text-white">{{ __('User Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="tableview">
                        @if(isset($risks) && count($risks) > 0)
                        <table class="table table-stripped" id="risktable">
                            <thead>
                                <tr>
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
                                    <td>{{$i}}</td>
                                    <td>{{$name}}</td>
                                    <td>{{$description}}</td>
                                    <td>
                                        <a onclick="viewRiskDet('{{$id}}');" data-toggle="modal" data-target=".bd-example-modal-lg1" href="#" title="View"><i class="fa fa-eye"></i></a>
                                        <a style="text-decoration: none;" href="{{ route('risk.editRiskDet', ['id' => $id, 'type' => 3])  }}" title="View"><i class="fa fa-edit"></i></a>
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
<script src="/js/sweetalert2.all.min.js'"></script>
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
</script>

@endpush
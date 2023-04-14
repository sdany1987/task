@if(isset($risks) && count($risks) > 0)
<?php 

echo 'sh4333sh';
die;
?>
<table class="table table-stripped" id="risktable1">
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
@push('js')
<script>
        $('#risktable').DataTable();
</script>
@endpush
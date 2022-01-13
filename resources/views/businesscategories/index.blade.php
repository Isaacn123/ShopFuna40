@extends('layouts.admin')
@section('content')
 <!-- <div class="container"> -->
 <div class="d-flex justify-content-end mb-2">
     <a href="{{route('business_sub-category.create')}}" class="btn btn-danger mr-2">Add Business SubCategory</a>
    <a href="{{ route('businesscategory.create')}}" class="btn btn-success">Add Business Category</a>
</div>

<div class="card card-default">
    <div class="card-header">
       Business Category
    </div>

    <div class="card card-body">

       <table class="table mb-5">
           <thead>
               <th>
                   Name
               </th>
               <th>Slug</th>
               <th></th>
               <th></th>
           </thead>
          <tbody>
              @foreach($businesscategory as $category) 
              <tr>
                <td>
                 {{$category->name}} 
                </td>
                <td class="text-warning">
                 {{$category->slug}}       
                </td>

                <td>
                <a href="{{route('category.edit', $category->id)}}" class="btn btn-primary btn-small">Edit</a>
                </td>
                <td>
                  <button class="btn btn-danger btn-small" onclick="deleteModel({{$category->id}})">Delete</button>
                </td>
              </tr>

              @endforeach
          </tbody>

       </table>

       
       <!-- Pagination Section Here -->

       {{
        $businesscategory -> links()

       }}



    </div>
</div>

<form action="" id="deleteCategoryform" method="post" >

  @csrf

  @method('DELETE')

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this Category?
      </div>
      <div class="modal-footer">
        <button type="button"  class="btn btn-secondary" data-dismiss="modal">Go Back</button>
        <button type="submit"  class="btn btn-primary">Yes, Delete</button>
      </div>
    </div>
  </div>
</div>

</form>

 

<!-- <h1 class="text-center">
    Hello WOrld
</h1> -->



@endsection



@section('scripts')

<script>
    function deleteModel(id){

           $('#deleteModal').modal('show');
      var form =  document.getElementById('deleteCategoryform');
        //model.popup('deleteModel');
          form.action = '/businesscategory/' + id;
    //    console.log('Deleting model here now ');
          console.log(form);
    //    console.log(id);
    }
</script>



@endsection
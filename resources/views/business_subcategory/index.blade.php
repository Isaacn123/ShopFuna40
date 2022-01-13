@extends('layouts.admin')


@section('content')

<div class="card card-default">
    <div class="card-header">
     BusinessSub Categories
    </div>

    <div class="card card-body">

  

       <table class="table">
         <thead>
             <th>Name</th>
             <th>Slug</th>
             <th>Category_ID</th>
             <th></th>
         </thead>

         <tbody>
         @foreach($business_subcategories as $subcategory)
             <tr class="mb-6">
                 <td>
                    
                   {{$subcategory->subcategoryname}}
                   
                 </td>
                 <td>
                     {{$subcategory->slug}}
                 </td>
                 <td>
                     {{$subcategory->category_id}}
                 </td>        
                 <td>

    <button  onclick="handleDelete({{$subcategory->id}})" class="btn btn-danger btn-sm">Delete</button>
                 </td>
             </tr>
             @endforeach

             <!-- Pagination here  -->
             {{
                $subcategories ->links() 
             }}


         </tbody>
       </table>
    </div>
</div>

<form action="" method="post" id="deleteSubcategoryForm">

@csrf

@method('DELETE')

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">You about to delete this Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this SubCategory?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Go Back</button>
        <button type="submit" class="btn btn-primary">Yes delete</button>
      </div>
    </div>
  </div>
</div>

</form>


@endsection


@section('scripts')

<script>
     function handleDelete(id) {
         console.log(id);
         $('#deleteModal').modal('show');
         var form = document.getElementById('deleteSubcategoryForm');
         form.action = '/business_sub-category/' + id;
       
         console.log(form);

         console.log("am about to delete");
     }
</script>

@endsection
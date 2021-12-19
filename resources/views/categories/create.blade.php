
@extends('layouts.admin')



@section('content')
<!-- <p class="text-center">
    Hello
</p> -->
 <div class="card card-default">

     

    <div class="card-header">
        
        {{isset($category) ? 'Edit Category' : 'Create Category'}}
    </div>

   <div class="card-body">
   
   @if($errors->any())
 
   <div class="alert alert-danger">
       <div class="list-group-item">
           <ul class="list-group">

          
           @foreach($errors->all() as $error)
           <li class="list-group text-danger">{{$error}}</li> 
           @endforeach
        </ul>
       </div>
   </div>

   @endif


       <form action="{{ isset($category) ? route('category.update', $category->id) : route('category.store')}}" method="POST" >
       <!-- @csrf -->
       @csrf
         @if(isset($category))
          <!-- {{ csrf_field() }}
          {{ method_field('PUT') }} -->
          @method('PUT')

          @endif

         <div class="form-group">
             <label for="name">Name</label>
             <input type="text" value="{{isset($category) ? $category->name : ''}}" id="name" name="name" class="form-control">

         </div>
         <div class="form-group">
             <label for="slug">Slug</label>
             <input type="text" id="slug" value="{{isset($category) ? $category->slug : ''}}" name="slug" class="form-control">
         </div>

         <div class="form-group">
             <label for="">Featured_image</label>
             <!-- <x-cld-upload-button>
            Upload Files
            </x-cld-upload-button> -->
            <input type="file" name="image" class="form-control"/>
         </div>
        <div class="form-group mt-2">
         <button  class="btn btn-success" >
           
             {{isset($category) ? 'Edit Category' : '  Add Category'}}
         </button>
        </div>

       </form>
   </div>
</div> 



@endsection
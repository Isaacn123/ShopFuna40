
@extends('layouts.admin')



@section('content')
<!-- <p class="text-center">
    Hello
</p> -->
 <div class="card card-default">

     

    <div class="card-header">
        
        {{isset($businesscategory) ? 'Edit BusinessCategory' : 'Create BusinessCategory'}}
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


       <form action="{{ isset($businesscategory) ? route('businesscategory.update', $businesscategory->id) : route('businesscategory.store')}}" method="POST" enctype="multipart/form-data" >
       <!-- @csrf -->
       @csrf
         @if(isset($businesscategory))
          <!-- {{ csrf_field() }}
          {{ method_field('PUT') }} -->
          @method('PUT')

          @endif

         <div class="form-group">
             <label for="name">Name</label>
             <input type="text" value="{{isset($businesscategory) ? $businesscategory->name : ''}}" id="name" name="name" class="form-control">

         </div>
         <div class="form-group">
             <label for="slug">Slug</label>
             <input type="text" id="slug" value="{{isset($businesscategory) ? $businesscategory->slug : ''}}" name="slug" class="form-control">
         </div>

         <div class="form-group">
             <label for="">Featured_image</label>
            <input type="file" name="image" class="form-control"/>
         </div>
        <div class="form-group mt-2">
         <button  class="btn btn-success" >
           
             {{isset($businesscategory) ? 'Edit BusinessCategory' : '  Add BusinessCategory'}}
         </button>
        </div>

       </form>
   </div>
</div> 



@endsection
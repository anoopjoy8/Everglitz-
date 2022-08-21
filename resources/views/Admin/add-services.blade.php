@extends('admin.layout')
@section('title','{{$title}}')
@section('header-script')
<link rel="stylesheet" href="{{env('ASSET_URL')}}/admin/summernote-0.8.18-dist/summernote.min.css">
@endsection
@section('content')
<!---- Add Div starts here --->
<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title"> Add Page</h4>
      <form class="forms-sample" role="form" action="{{ empty($id) ? url('admin/add-services') : url('admin/update-services')  }}" method="post" enctype="multipart/form-data" id="form">
        @csrf
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="exampleInputName1">Title</label>
              <input type="text" name="titlep" class="form-control" value="{{ $titlep ?? old('titlep')}}" id="exampleInputName1" placeholder="Title">
              <input type="hidden" name="id" value={{$id ?? ''}}>
              <input type="hidden" name="page" value={{$page ?? ''}}>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="exampleInputName1">Description</label>
              <textarea id="summernote" name="description"> {{ $description ?? old('description ')}} </textarea>
            </div>
          </div>
          <hr>
          <div class="col-md-12">
            <div class="col-md-4">
              <div class="form-group">
                <label class="form-label" for="customFile">Image</label>
                <input type="file" name="main_img" class="form-control form-img" id="customFile" value="{{ $image ?? old('image ')}}" enctype="multipart/form-data" />
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <div id="imgPreview" />
            </div>
          </div>
        </div>
    </div>
    <button type="submit" class="btn btn-{{getButton($id ??"")['button_labl']}} me-2">{{getButton($id ??"")['button_sta']}}</button>
    <button class="btn btn-light">Cancel</button>
    @csrf
    </form>
  </div>
</div>
</div>
@endsection
@section('footer-script')
<script src="{{env('ASSET_URL')}}/admin/summernote-0.8.18-dist/summernote.min.js"></script>
@endsection
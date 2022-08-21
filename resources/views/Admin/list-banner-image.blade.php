@extends('admin.layout')
@section('title','{{$title}}')
@section('header-script')
<link rel="stylesheet" href="{{env('ASSET_URL')}}/admin/summernote-0.8.18-dist/summernote.min.css">
@endsection
@section('content')
<!---- Add Div starts here --->
<div style="display:{{$add_div}}">
  <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title"> Banner Informations</h4>
        <form class="forms-sample" role="form" action="{{ url('admin/update-banner')  }}" method="post" enctype="multipart/form-data" id="form">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="exampleInputName1">Title</label>
                <input type="text" name="titlep" class="form-control" value="{{ $titlep ?? old('titlep')}}" id="exampleInputName1" placeholder="Title">
                <input type="hidden" name="id" value=1>
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
</div>
<!---- List Div starts here --->
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-8">
          <h4 class="card-title cardtitle">{{$title}}</h4>
        </div>
        <div class="col-md-4 menu-button">
          <a href="{{ url('admin/list-banner-image')}}">
            <button type="button" class="btn btn-warning btn-icon-text">
              <i class="fa-solid fa-arrows-rotate"></i>
              Refresh
            </button>
          </a>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Title</th>
              <th>Description</th>
              <th>Image</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @if($banner_list->count()>0)
            @foreach($banner_list as $key=>$val)
            <tr>
              <td>{{$val->title}}</td>
              <td>{{Str::words(($val->description),'3','...') }}</td>
              <td>
                @if($val->image)
                <img class="thumb-image" src="{{ url('thumbnail/'.$val->image) }}">
                @endif
              </td>

              <td>
                <a href="{{ url('admin/list-banner-image?edit='.$val->id.'&page='.$page) }}">
                  <button type="button" class="btn btn-sm btn-success btn-icon no-round">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </button>
                </a>
              </td>
            </tr>
            @endforeach
            @else
            <tr>
              <td>
                <h4> ...No result Found .... </h4>
              </td>
            </tr>
            @endif
          </tbody>
        </table>
        <div class="template-demo">
          <div class="btn-group" role="group" aria-label="Basic example">
            @if(!empty(paginate($count)))
            @foreach(paginate($count) as $key=>$val)
            <a href="{{ url('admin/list-banner-image?page='.$val)}}">
              <button type="button" class="btn btn-outline-secondary @if($val == $page)pagn @endif ">{{$val}}</button>
            </a>
            @endforeach
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('footer-script')
<script src="{{env('ASSET_URL')}}/admin/summernote-0.8.18-dist/summernote.min.js"></script>
@endsection
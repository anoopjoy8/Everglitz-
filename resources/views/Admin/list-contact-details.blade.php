@extends('admin.layout')
@section('title','{{$title}}')
@section('header-script')
<!----- Add custom scripts here --->
@endsection
@section('content')
<!---- Search Div starts here --->
<div style="display:{{$srch_div}}">
  <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title"> Search Contact Informations</h4>
        <form class="forms-sample" role="form" action="{{url('admin/list-contact-details')}}" method="post" enctype="multipart/form-data" id="form">
          @csrf
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleInputName1">Phone No</label>
                <input type="text" name="phone1" class="form-control" value="{{ $phone1 ?? old('phone1')}}" id="exampleInputName1" placeholder="Phone Number">
                <input type="hidden" name="sr" value="yes">
                <input type="hidden" name="page" value={{$page ?? ''}}>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary me-2">Search</button>
          <a href="{{ url('admin/list-contact-details')}}"><button class="btn btn-light">Cancel</button></a>
          @csrf
        </form>
      </div>
    </div>
  </div>
</div>
<!---- Add Div starts here --->
<div style="display:{{$add_div}}">
  <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title"> Contact Informations</h4>
        <form class="forms-sample" role="form" action="{{ empty($id) ? url('admin/add-contacts') : url('admin/update-contacts')  }}" method="post" enctype="multipart/form-data" id="form">
          @csrf
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleInputName1">Phone 1</label>
                <input type="text" name="phone1" class="form-control" value="{{ $phone1 ?? old('phone1')}}" id="exampleInputName1" placeholder="Phone 1">
                <input type="hidden" name="id" value={{$id ?? ''}}>
                <input type="hidden" name="page" value={{$page ?? ''}}>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleInputName1">Phone 2</label>
                <input type="text" name="phone2" class="form-control" value="{{ $phone2 ?? old('phone2')}}" id="exampleInputName1" placeholder="Phone 2">
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
          <a href="{{ url('admin/list-contact-details?add=1')}}">
            <button type="button" class="btn btn-primary btn-icon-text">
              <i class="fa-solid fa-file-lines"></i>
              Add
            </button>
          </a>
          <a href="{{ url('admin/list-contact-details?search=1')}}">
            <button type="button" class="btn btn-success btn-icon-text">
              <i class="fa-solid fa-filter"></i>
              Search
            </button>
          </a>
          <a href="{{ url('admin/list-contact-details')}}">
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
              <th>Phone 1</th>
              <th>Phone 2</th>
              <th>Email</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @if($page_list->count()>0)
            @foreach($page_list as $key=>$val)
            <tr>
              <td>{{$val->phone1}}</td>
              <td>{{$val->phone2}}</td>
              <td>{{$val->email}}</td>
          
              <td>
                <a href="{{ url('admin/list-contact-details?edit='.$val->id.'&page='.$page) }}">
                  <button type="button" class="btn btn-sm btn-success btn-icon no-round">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </button>
                </a>
                <a href="{{ url('admin/delete-contact?id='.$val->id.'&page='.$page) }}" onClick="return confirm('Do you want to delete this contact detail?')">
                  <button type="button" class="btn btn-sm btn-danger btn-icon no-round">
                    <i class="fa-solid fa-trash"></i>
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
            <a href="{{ url('admin/list-contact-details?page='.$val)}}">
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
<!----- Add custom scripts here --->
@endsection
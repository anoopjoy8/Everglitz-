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
        <h4 class="card-title"> Search Informations</h4>
        <form class="forms-sample" role="form" action="{{url('admin/list-enquiry')}}" method="post" enctype="multipart/form-data" id="form">
          @csrf
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleInputName1">Name</label>
                <input type="text" name="name" class="form-control" value="{{ $name ?? old('name')}}" id="exampleInputName1" placeholder="Name">
                <input type="hidden" name="sr" value="yes">
                <input type="hidden" name="page" value={{$page ?? ''}}>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleInputName1">Email</label>
                <input type="text" name="email" class="form-control" value="{{ $email ?? old('email')}}" id="exampleInputName1" placeholder="Email">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleInputName1">Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ $phone ?? old('phone')}}" id="exampleInputName1" placeholder="Phone">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleInputName1">Location</label>
                <input type="text" name="location" class="form-control" value="{{ $location ?? old('location')}}" id="exampleInputName1" placeholder="Location">
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary me-2">Search</button>
          <a href="{{ url('admin/list-enquiry')}}"><button class="btn btn-light">Cancel</button></a>
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
        <a href="{{ url('admin/list-enquiry?search=1')}}">
            <button type="button" class="btn btn-success btn-icon-text">
              <i class="fa-solid fa-filter"></i>
              Search
            </button>
          </a>
          <a href="{{ url('admin/list-enquiry')}}">
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
              <th>Name</th>
              <th>Phone</th>
              <th>Email</th>
              <th>Location</th>
              <th>Message</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @if($contact_list->count()>0)
            @foreach($contact_list as $key=>$val)
            <tr>
              <td>{{$val->name}}</td>
              <td>{{$val->phone}}</td>
              <td>{{$val->email}}</td>
              <td>{{$val->location}}</td>
              <td>{{Str::words(($val->message),'3','...') }}</td>

              <td>
                <a href="{{ url('admin/delete-enquiry?id='.$val->id.'&page='.$page) }}" onClick="return confirm('Do you want to delete this Enquiry?')">
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
            <a href="{{ url('admin/list-enquiry?page='.$val)}}">
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
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
         {{--  bootstrap --}}
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">  
        <style>
            body {
                font-family: 'Nunito';
            }
        </style>
    </head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-8">
            @if($errors->any())
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger">
                    {{$error}}
                </div>
                @endforeach
            @endif
            @if(Session::has('status'))
                <div class="alert alert-success">
                    {{Session::get('status')}}
                </div>
            @endif
            <form method="post" enctype="multipart/form-data">
                @csrf
                <div class="input-group">
                    <div class="custom-file">
                    <input type="file" class="custom-file-input" name="image[]" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" multiple>
                    <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                    </div>
                    <div class="input-group-append">
                    <button class="btn btn-primary" id="inputGroupFileAddon04">Upload</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row mt-5">
 
        @foreach ($galleries as $item)
            <div class="col-4 mb-3">
              <div class="card">
                  <div class="card-body">
                     <img src="{{$item->image_link}}" alt="" class="w-100" height="170">
                  </div>
                  <div class="card-footer">
                      <a href="{{$item->image_link}}" target="_blank" class="btn btn-sm btn-info">View</a>
                      <a href="{{route("home.download",$item->id)}}" class="btn btn-sm btn-success">Download</a>
                      <a href="{{route("home.delete",$item->id)}}" class="btn btn-sm btn-danger float-right">Delete</a>
                  </div>
              </div>
            </div>
        @endforeach

    </div>
</div>
</body>
</html>

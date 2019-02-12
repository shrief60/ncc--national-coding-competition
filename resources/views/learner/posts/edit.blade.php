<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>OCP</title>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-lite.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-lite.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <meta name="_token" content="{{csrf_token()}}" />
</head>
<body>
    <div class="container-fluid" >
        <div class="row">
                <div class="col-lg-2" >
                    <div class="sidenav"  style="padding: 5px;">
                        <div class="sidebar-header">

                        </div>
                        @yield('sidebarcontent')
                    </div>
                </div>
                <div class="col-lg-10" style="margin-left:-3.5%;width:100%;" >

                    <div id="content_div">
                        <br/>
                        <form  action = "/posts/edit/{{ $post->id }}" method="POST">
                        @csrf
                            <h2>Update Post </h2>
                            <div class= "form-group">
                                <label for  ="post title">Post Title</label>
                                <input class="form-control" type="text" name = "title" id="title" placeholder="post Title" value = "{{ $post->title }}">
                            </div>
                            <div class= "form-group">
                                <label for  ="post title">Post Tags</label>
                                <input class="form-control" type="text" name = "tag" id="tag" placeholder="post Tag" value ="{{  $tagsBody}}">
                            </div>
                            <div class= "form-group">
                                <label for  ="post title">Post Category</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Categories</label>
                                    </div>
                                    <select class="custom-select" id="categorySelect" name="cat">
                                        @foreach($categories as $cat)
                                            @if($cat->id == $post->category_id)
                                                <option value="{{$cat->id}}" selected>{{$cat->body}}</option>
                                            @else
                                                <option value="{{$cat->id}}">{{$cat->body}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class= "form-group">
                                <label for  ="post body">Post Body</label>
                                <textarea id="summernote" name="body">{!! $post->body!!}</textarea>
                            </div>
                            <br/>
                            <center>
                                <input type="submit" class="btn btn-default" id="add_post" value="Update Post"/>
                            </center>
                        </form>
                    </div>
                </div>
        </div>
    </div>

    <script>
      $('#summernote').summernote({
        placeholder: 'Post body UI',
        tabsize: 2,
        height: 100
      });

      function validate (){
        let body = document.getElementById('summernote').value;
        let title = document.getElementById('title').value;
        let tag = document.getElementById('tag').value;
        if(body === "" && title === ""){
            alert ("Enter Valid title & Body");
        }
        else if(tag ==="" ){
            alert ("Enter Valid Tag");
        }
        else if(title === ""){
            alert ("Enter Valid Title");
        }
        else if(body === ""){
            alert ("Enter Valid Body");
        }

        else if(title != "" && body != "" && tag != ""){
            addPost();
        }
      }
      function  addPost (){
            let body = document.getElementById('summernote').value;
            let title = document.getElementById('title').value;
            let tag = document.getElementById('tag').value;
            let cat = document.getElementById('categorySelect').value;
            console.log(cat);
                var formdata = {
                    "body"     : body ,
                    "title"     : title ,
                    "tag"      : tag ,
                    "cat"       : cat ,
                };
                $.ajax({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    url: "{{ url('/posts') }}",
                    method: 'POST',
                    data: formdata,
                    dataType    : 'json',
                    encode      : true,
                    success: function (response) {

                    },
                    error: function(xhr, textStatus, thrownError) {
                                alert(thrownError);
                    }
                });


        }
    </script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</body>
</html>

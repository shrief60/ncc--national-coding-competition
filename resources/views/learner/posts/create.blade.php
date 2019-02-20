  <html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Competition</title>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <link href="{{ asset('css/learner/posts/tagsinput.css') }}" rel="stylesheet" type="text/css" >
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-lite.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-lite.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <meta name="_token" content="{{csrf_token()}}" />
</head>
<body style ="background: #383A3F;">
    <div class="container-fluid" >
        <div class="row" style= "color:#fff;">
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
                        <form  >
                        @csrf
                            <h2>Create Post</h2>
                            <div class="alert alert-danger" style ="display:none" id ="errors" role="alert"></div>
                            <div class="alert alert-info" style ="display:none" id ="success" role="alert">Your Post added Successfully</div>
                            <div class= "form-group">
                                <label for  ="post title">Post Title</label>
                                <input class="form-control" type="text" name = "Title" id="title" placeholder="post Title">
                            </div>
                            <div class= "form-group">
                                <label for  ="post title">Post Tags</label>
                                <p style= "font-size :12px;margin-top:-5px;color:#fff;">hint : click enter after each tag .</p>
                                <input type="text"  id = "Tag" name= "Tag" data-role="tagsinput" value="" class="sr-only">
                            </div>

                            <div class= "form-group">
                                <label for  ="post title">Post Category</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Categories</label>
                                    </div>
                                    <select class="custom-select" id="categorySelect" name = "Category">
                                        <option value="" selected>Choose...</option>
                                        @foreach($categories as $cat)
                                            <option value="{{$cat->id}}">{{$cat->bodyen}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class= "form-group">
                                <label for  ="post body">Post Body</label>
                                <textarea id="summernote" name="Body" onchange="myFunction()"></textarea>
                                 <input type="hidden" name="shortbody" id = "shortbody" />
                            </div>
                            <br/>
                            <center>
                                <input type="button" class="btn btn-default" onclick="addPost()" id="add_post" value="Add Post"/>
                            </center>
                             @include('layouts.errors')
                        </form>
                    </>
                </div>
        </div>
    </div>

    <script>
      $('#summernote').summernote({
        placeholder: 'Post body UI',
        tabsize: 3,
        height: 200
      });
        function myFunction() {
            console.log("ggggg");
            var x = document.getElementById("summernote").value;
            document.getElementById("output").innerHTML = "You wrote: " + x;
        }
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
      function  addPost(){
            let body = document.getElementById('summernote').value;
            let title = document.getElementById('title').value;
            let tag = document.getElementById('Tag').value;
            let cat = document.getElementById('categorySelect').value;
            console.log(cat);
                var formdata = {
                    "Body"     : body ,
                    "Title"    : title ,
                    "Tag"      : tag ,
                    "Category" : cat ,
                };
                $.ajax({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    url: "/posts",
                    method: 'POST',
                    data: formdata,
                    dataType    : 'json',
                    encode      : true,
                    success: function (response) {
                        console.log(response);
                        var yourUl = document.getElementById("success");
                        yourUl.style.display = yourUl.style.display === 'none' ? '' : 'none';
                        window.location.href = "../posts";
                    },
                    error: function(error){
                                let  errors = error.responseJSON.errors ;
                                let output = "";
                                for (var key in errors) {
                                   console.log(key);
                                   output += key + " : "+errors[key]+"<br/>";
                                }
                                document.getElementById('errors').innerHTML = output ;
                                var yourUl = document.getElementById("errors");
                                yourUl.style.display = yourUl.style.display === 'none' ? '' : 'none';

                    }
                });


        }
    </script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{ asset('js/learners/posts/tagsinput.js') }}"></script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
</html>

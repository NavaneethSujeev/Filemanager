@extends('main')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('sidebar')
<style>
    .spanfont{
        color:black;
        font-size: 12px;
        padding-left: 2px;
    }
</style>
<ul>
@foreach($fulldata as $singledata)
 
    <li> 
      @if($singledata->type=='Folder') <span class="fas fa-folder"><span class="spanfont">{{$singledata->Filename}}</span></span>
       @else
        <span class="fas fa-file"><span class="spanfont">{{$singledata->Filename}}</span></span>
      @endif
    </li>

@endforeach
</ul>
@endsection


@section('content')
<style>

.iconcolor{
    color: 	#153ff6;
}
ul {
  list-style-type: none;
  padding-left: 20px;
  margin: 0;
}

input[type=radio]{
    display: none;
    padding-left: 2px;
}
</style>
<div class="section">
    <div>
        @if (Session::has('message'))
   <div class="alert alert-success">{{ Session::get('message') }}</div>
@endif
        <button type="button" class="btn btn-info" id="Createbtn">New Folder</button>&nbsp;
        <button type="button" class="btn btn-info" id="uploadbtn">Upload</button>
    </div>
    <div class="row pt-2">
    @foreach($data as $data)
    <div class="col-3">
        @if($data->type == 'Folder')
        <button class="btn select" value="{{$data->id}}" >
          <span class="fas fa-folder fa-5x iconcolor"></span>
          <br><span class="titlename">{{$data->Filename}}</span>
        </button>
        @else
       
        <button class="btn select" value="{{$data->id}}" >
          <embed src="{{ asset('images/'.$data->Filename) }}"  width="80px" height="80px">
            <br><span class="titlename">{{$data->Filename}}</span>
        </button>
        @endif
    </div> 
    @endforeach
    </div>
    <form action="{{route('filemanager')}}" method="post" id="filePosition">
      @csrf
      <input type="hidden" id="selectedId" name="id" value="">
      <input type="hidden" id="currentposition" name="currentposition" value="{{$id}}">
    </form>
 {{-- modal --}}
    <div class="modal fade bd-example-modal-sm" id="fileModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <ul>
                <input type="radio" id="Open" name="actiontype" value="Open">
                 <label for="Open">Open</label><br>
                 <input type="radio" id="Rename" name="actiontype" value="Rename">
                 <label for="Rename">Rename</label><br>
                 <input type="radio" id="Delete" name="actiontype" value="Delete">
                 <label for="Delete">Delete</label>
            </ul>
        </div>
        </div>
    </div>
    <div class="modal fade" id="formmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" >
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">File Upload</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form name="image-upload" id="image-upload" method="post" action="{{url('addfile')}}" enctype="multipart/form-data">
                    @csrf
                     <div class="form-group">
                       <label for="exampleInputEmail1">Please Select Image</label>
                       <input type="file" id="image" name="image">
                       <input type="hidden" id="locationId" name="locationId" value="{{$id}}">
                     </div>
                     <button type="submit" class="btn btn-primary">Submit</button>
                   </form>
            </div>
          </div>
        </div>
    </div>

    <div class="modal fade" id="createnew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" >
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Create New Folder</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('addfolder')  }}" method="Post">
                    @csrf
                    <div class="form-group">
                        <label for="Name">Name</label>
                      <input type="text" class="form-control" id="name" name="name" required>
                      <input type="hidden" id="locationId" name="locationId" value="{{$id}}">

                    </div>
                   <button type="submit" class="btn btn-primary" id="uploadbtn">Upload</button> 
                </form>
            </div>
          </div>
        </div>
    </div>
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" >
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <form action="{{ url('update')  }}" method="Post">
                  @csrf
                  <div class="form-group">
                      <label for="Name">Name</label>
                    <input type="text" class="form-control" id="editname" name="editname" required>
                    <input type="hidden" id="editid" name="editid" value="">

                  </div>
                 <button type="submit" class="btn btn-primary" id="uploadbtn">Edit</button> 
              </form>
          </div>
        </div>
      </div>
  </div>
</div>
<script>
  $( document ).ready(function() {

      $(".select").click(function(){

    var id = $(this).val();

      
      $("#selectedId").val(id);
      $('#fileModal').modal('show');

      });
      $("#uploadbtn").click(function(){

      $('#formmodal').modal('show');

      });

      $("#Createbtn").click(function(){

      $('#createnew').modal('show');

      });

      $('input[type=radio][name=actiontype]').change(function() {

      var action = $(this).val();
      var id = $('#selectedId').val();
      $('#fileModal').modal('hide')

      if(action == 'Open'){
        $.ajax({
          //    type:'POST',
              url:"{{ url('/edit') }}",
              data:{id:$('#selectedId').val()},
              success:function(data) {
                if(data.type != "Folder"){
                 var mains = "{{asset('images/')}}";
                  console.log(mains)
                  window.open(mains+'/'+  data.Filename,'_blank');
                }else{
                  $("#filePosition").submit();
                }
              }
          });
      }
      if(action == 'Rename'){
      $('#editmodal').modal('show');
      $.ajax({
          //    type:'POST',
              url:"{{ url('/edit') }}",
              data:{id:$('#selectedId').val()},
              success:function(data) {
              // console.log(data.Filename)
              $('#editname').val(data.Filename);
              $('#editid').val(data.id);

              }
          });
      }      
      if(action == 'Delete'){

          $.ajax({
          //    type:'POST',
              url:"{{ url('/delete') }}",
              data:{id:$('#selectedId').val()},
              success:function(data) {
                location.reload();
              }
          });
          
      }

      });

      $(".select").dblclick(function(){
        alert("The paragraph was double-clicked");
      });

  });
</script>
@endsection

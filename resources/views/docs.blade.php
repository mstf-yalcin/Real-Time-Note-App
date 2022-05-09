<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
 
    <title>{{$title}} - Online Note-App</title>
   <link rel="stylesheet" href="{{url('css/ck.css')}}">
  </head>
  <link href="{{asset('css/bootstrap.css')}}"  type="text/css" rel="stylesheet">
  <link rel="shortcut icon" href="{{asset('img/logo.png')}}" />


  <body>
  
    
    {{-- <div class="document-editor">

      <div class="header">
        <div class="whiteBar">
          <a href="#"><img class="docsLogo" src="{{asset('img/logo.png')}}" alt=""></a>
          <h1 id="untitled">
           Untitled document
          </h1>
    
          <ul id="mainMenu">
            <li>File</li>
            <li>Edit</li>
            <li>View</li>
            <li>Insert</li>
            <li>Format</li>
            <li>Tools</li>
            <li>Table</li>
            <li>Add-Ons</li>
            <li>Help</li>
          </ul>
    
          <div class="rightSide">
         
            <div style="width: 36px;height:36px;border-radius:50%;background-color:Red"></div>



             <span id="emailLogin">pablo@inkling.com<img id="emailcaret" src="http://static1.squarespace.com/static/55dcfb03e4b07360409d0471/55e724bde4b0c296de94c811/55e724bde4b076794acc4218/1441211581744/caret.png?format=300w" alt=""></span>
    
            <ul class="extraButtons">
              <li>Comments</li>
              <li>Share</li>
            </ul>  
          </div><!--end right side-->

          
        </div>
        <div class="centered">
          <div class="document-editor__toolbar"></div>
        </div>
      </div>



      <div class="document-editor__editable-container">
          <div class="document-editor__editable"></div>
      </div>
  </div> --}}


{{-- document editor --}}
  
   <input type="hidden" id="docData" value="{{$lastDocsData['data']}}">
   <input type="hidden" id="perm" value="{{$perm}}">

     <div class="document-editor">

    <div id="header" style="z-index:9999;display: flex;flex-wrap:wrap;flex-shrink:1;width:100%;height:110px;position: fixed;background-color:#fff;border: 1px hsl( 0,0%,82.7% ) solid ;box-shadow: 0 0 5px rgba(0, 0, 0, 0.3) ;">


           {{--History Div  --}}
      <div id="historyDiv" style="display: none;align-items:center;margin-left:30px">
        <img onclick="back()" src="{{asset('img/back.png')}}" style="width: 32px;height:32px;cursor:pointer" alt="">
        <span style="margin-left: 15px;font-size:1.1em" >{{Carbon\Carbon::parse($lastDocsData['created_at'])->format('M d, g:i A');}}</span>

        <div onclick="printDiv('print')" id="print" style="cursor:pointer;margin-left:30px;display:flex;align-items:center">
        <img  src="{{asset('img/printer.png')}}" style="width: 32px;height:32px;" alt="">
        <span style="margin-left: 5px;font-size:1.1em" >Print</span>
       </div>

       <button onclick="restoreData()" style="margin-left: 30px;padding:5px 24px;display:none;" id="restoreButton" type="button" class="btn btn-primary">Restore this version</button>

       <div class="historyBar" style="">

        <div style="height:10%;width:100%;font-size:1.2em;padding:15px;cursor:default;background-color:#fff;border-bottom: 1px hsl( 0,0%,82.7% ) solid !important; ">
          Version history
            </div>
          <div id="historyData" style="background: white;height:90%;width:100%;background-color:#fff;">
            @php $i=0; @endphp
            @foreach($docsData as $key=>$doc)
            @php $i++ @endphp
            @if($loop->first)
          <div onclick="selectVersion(`{{$i}}`,`{{$lastDocsData['data']}}`)" id="{{$i}}" style="height:90px !important;" class="versions">
            <div style="width: 90%;height:33%;"> <span id="date{{$i}}" style="font-size:1em" >{{Carbon\Carbon::parse($lastDocsData['created_at'])->format('M d, g:i A');}}</span></div>
            <a href="javascript:void(0)" type="button" id="defaultDropdown" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false" style="width: 10%;height:33%;">
              <img src="{{asset('img/dot.png')}}" style="height: 20px;width:20px;" alt="">
            </a>
              <ul class="dropdown-menu" aria-labelledby="defaultDropdown">
                {{-- <li><a class="dropdown-item" href="#">Delete this version</a></li> --}}
                <li><a class="dropdown-item"  href="javascript:void(0)">Make a copy</a></li>
              </ul>
            <div style="width: 90%;height:33%;font-size:0.9em" >Current Version</div>
            @else
          <div onclick="selectVersion(`{{$doc['pushId']}}`,`{{$doc['data']}}`)" id="{{$doc['pushId']}}" class="versions">
            <div style="width: 90%;height:60%;"> <span id="date{{$doc['pushId']}}" style="font-size:1em" > {{Carbon\Carbon::parse($doc['created_at'])->format('M d, g:i A');}}</span></div>

            <a href="javascript:void(0)" type="button" id="defaultDropdown" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false" style="width: 10%;height:60%;">
              <img src="{{asset('img/dot.png')}}" style="height: 20px;width:20px;" alt="">
            </a>
              <ul class="dropdown-menu" aria-labelledby="defaultDropdown">
                <li><a class="dropdown-item" onclick="restoreData()" href="javascript:void(0)">Restore this version</a></li>
                <li><a class="dropdown-item" onclick="deleteVersion()" href="javascript:void(0)">Delete this version</a></li>
                <li><a class="dropdown-item" onclick="makeCopy()" href="javascript:void(0)">Make a copy</a></li>
              </ul>
            @endif
            <div style="width: 90%;height:40%; overflow:hidden; white-space:nowrap; text-overflow: ellipsis;font-size:0.9em" >{{$doc['editedByName']}}</div>
          </div>
          @endforeach
            
          </div>

       </div>


      </div>
           {{--End History Div  --}}

      {{-- logo menu user  --}}
      <div id="menuDiv" style="display:flex;justify-content:space-between;align-items:center;width:100%;height:80px;">

        {{-- logo-menu --}}
        <div   style="display:flex;align-items:center;height:100%;padding:5px">
      
          {{-- logo  --}}
          <div style="display: flex;justify-content:center;align-items:center;width:8%;height:90%;" >
            <a style="width: 52px;height:52px;" href="{{route('index')}}"><img src="{{asset('img/logo.png')}}"  style="width:52px;height:52px" alt=""></a>
          </div>
          {{--end logo  --}}

          {{-- MENU div --}}
          <div  style="display:flex;flex-wrap:wrap;flex-shrink:1;width: 90%;height:90%;margin-left:10px" >
          
            {{-- Title --}}
            <div style="display:flex;align-items:center;width:100%;height:40%;margin-top:5px;" >
            @if($perm==0)
            <input style="font-size:1.1em" id="title"  class="titleInput" type="text" value="{{$title}}">
            @else
            <input style="font-size:1.1em" disabled class="titleInput" type="text" value="{{$title}}">
            @endif
            <input type="hidden" id="docsId" value="{{$docsId}}" >
            <div id="saving" style="visibility: hidden">
              <div style="margin-left: 15px" class="spinner-border spinner-border-sm" role="status">
              </div>
              <div style="margin-left:2px;width: 15px;height:15px" class="spinner-grow spinner-grow-sm" role="status">
              </div>
              <span style="margin-left:2px;font-size:1.1em">Saving...</span>
            </div>
            {{-- <div id="saved" style="display: none;align-items:center" >
              <img src="{{asset('img/cloud.png')}}" style="width: 32px;height:32px;" alt="">
              <span style="margin-left:5px;font-size:0.9em">Saved to drive.</span>
            </div> --}}
            
            </div>
            
            {{-- end Title --}}

            {{-- MENU --}}
            <div  class="menu" style="display:flex;flex-shrink:1;align-items:center;:100%;height:60%;margin-top:8px" >
                <li onclick="test()" >File</li>
                <li>Edit</li>
                <li onclick="readOnly()">View</li>
                <li>Insert</li>
                <li>Format</li>
                <li>Tools</li>
                <li>Table</li>
                {{-- <li>Add-Ons</li> --}}
                <li>Help</li>
               <span id="editDate" @if($perm==0) onclick="history()" @endif style="margin-left:20px;margin-top:-2px;text-decoration:underline;color:#777;cursor: pointer;font-size:1em;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;">
               Last edit was  @php echo \Carbon\Carbon::createFromTimeStamp(strtotime($lastDocsData['created_at']))->diffForHumans() @endphp
                </span>
            </div>
  
            {{-- end MENU --}}

          </div>
           {{-- end MENU div --}}
            
        
        </div>
           {{-- end logo menu user  --}}


        {{-- right bar --}}
        <div style="display:flex;justify-content:center;align-items:center;width:12%;height:100%;min-width:170px">
        
          {{-- share --}}
          <div style="width: 50%;height:50%;display:flex;justify-content:center;align-items:center;color:white;font-family: Arial, Sans-Serif;" >
            @if($perm==0)
            <button data-bs-toggle="modal" data-bs-target="#shareModal"   style="display: flex;justify-content:center;align-items:center;background-color:#03a9f4;padding:8px 20px;border-radius:10px" class="btn" type="button"   >
             <img src="{{asset('img/share.png')}}"  style="width: 18px;height:18px" alt="">  
            <span style="margin-left: 5px;color:#fff"> Share</span>  
            </button>
            @else
            <button disabled  style="display: flex;justify-content:center;align-items:center;background-color:#03a9f4;padding:8px 20px;border-radius:10px" class="btn" type="button"  id="dropdownMenuClickableInside"  >
              <img src="{{asset('img/share.png')}}"  style="width: 18px;height:18px" alt="">  
             <span style="margin-left: 5px;color:#fff"> Share</span>  
             </button>
            @endif
            <div   class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuClickableInside">

                <li><button class="dropdown-item" type="button">Action</button></li>
                <li><button class="dropdown-item" type="button">Another action</button></li>
                <li><button class="dropdown-item" type="button">Something else here</button></li>
            </div>

          </div>




              {{-- share modal --}}
    <div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <div style="width: 36px;height:36px;border-radius:50%;background-color:#03a9f4;display:flex;justify-content:center;align-items:center" > <img src="{{asset('img/add-user.png')}}" style="width:18px;height:18px" alt=""> </div>   <h5 style="margin-left:10px" class="modal-title" id="exampleModalLabel">  Share with people and groups</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div class="mb-3">
                <input   type="text" class="form-control" placeholder="Add people and groups" id="userMail" value="">
              </div>
            <div id="userArea" style="display: flex;align-items:center;width:100%;justify-content: space-between;flex-wrap:wrap" >
              
              @if($sharedUsers !=null)
              @foreach ($sharedUsers as $i=> $shareduser)
             
             
            <div style="display: flex;margin-top:10px;width:60%">
              <img src="{{asset($shareduser['pp'])}}" referrerpolicy="no-referrer" style="width:48px;height:48px;border-radius:50%" alt="">  
               <div style="display: flex;flex-direction:column;align-items:flex-start;margin-left:15px;" >
                 <div>{{$shareduser['name']}}</div>
                 <div>{{$shareduser['email']}}</div>
                 <input type="hidden" id="uid{{$shareduser['uid']}}" value="{{$shareduser['email']}}">
             </div>
          </div>

          <div>
            @if(Session::get('uid')!=$shareduser['uid'] && $userControl!=1)
           <select onchange="permChange('{{$shareduser['uid']}}')" id="select{{$shareduser['uid']}}" class="form-select" aria-label="Default select example">
             @if($shareduser['stat']=="write")
             <option  value="1">Viewer</option>
             <option selected value="2">Editor</option>
             <option value="3">Remove</option>
             @elseif($shareduser['stat']=="read")
             <option selected value="1">Viewer</option>
             <option value="2">Editor</option>
             <option value="3">Remove</option>
             @endif
           </select>
            @else
            <select disabled  class="form-select" aria-label="Default select example">
              <option selected value="1">Owner</option>
            </select>
            @endif
          </div>
          <br>
       @endforeach
       @endif

            </div>
          </div>
          <div class="modal-footer">
            <div style="width: 100%;justify-content: flex-start;display:flex;align-items:center;flex-wrap:wrap" class="modal-header">
              <div style="width: 36px;height:36px;border-radius:50%;background-color:#9aa0a6;display:flex;justify-content:center;align-items:center" >
                 <img src="{{asset('img/link.png')}}" style="width:18px;height:18px" alt=""> 
                </div>  
                 <h6 style="margin-left:10px"  class="modal-title" id="exampleModalLabel"> Get link</h6>
                 <button onclick="copyUrl()" id="copyButton" style="margin-left: 240px" class="btn btn-primary">Copy Link</button>
                 <label style="margin-top: 10px;">Restricted Only people added can open with this link</label>
            </div>

            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button onclick="savePerm()" type="button" class="btn btn-primary">SAVE</button>
          </div>
        </div>
      </div>
    </div>
    {{-- share modal --}}



          {{-- end share --}}

          {{-- USER --}}
          <div style="display:flex;justify-content:center;align-items:center;width:50%;height:50%;" >
          @include('include.user')
          </div>
          {{--end USER  --}}
          <div>
        {{-- end right bar --}}
          </div>
        </div>
      </div>

      {{-- toolbar --}}
      <div id="toolbar" style="width:100%;display:flex;justify-content:center;border:0;background:transparent">
      <div class="document-editor__toolbar"></div>
      </div>
      {{-- end toolbar --}}


    </div>

    <div  class="document-editor__editable-container">
      <div id="documentEditor" class="document-editor__editable"></div>
      {{-- <div class="history">
        <span class="historyText"  > History  </span>
      <img style="width: 28px;height:28px " src="{{asset('img/history.png')}}" alt="">
      </div> --}}
  
  </div>
</div> 

<input type="hidden" id="userId" @if(Session::get('uid')!=null) value="{{Session::get('uid')}}" @else value="Anonymous" @endif >
@include('include/load')

  
  </body>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>

  <script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-app.js" ></script>
  <script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-database.js" ></script>
  <script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-auth.js" ></script>

  <script src="{{asset('js/config.js')}}"></script>

  <script src="{{asset('js/ckeditor.js')}}"></script>


  <script>
    var permArray=[];
    var permSave=0;
     function permChange(id)
    {
      var select=document.getElementById('select'+id);
      if(id.toLowerCase()=="public")
       id="public";

      if(permArray.length!=0)
      {
       
      var index = permArray.findIndex(p => p.id == id)
        if(index==-1)
        {
          permArray.push({'uid':id,'perm':select.value});
        }
        else
        {
           permArray[index]={'uid':id,'perm':select.value};
        }
      }
      else
      {
        permSave=1;
        permArray.push({'uid':id,'perm':select.value});
      }

    }
  </script>



   <script>
     var editor;

     DecoupledDocumentEditor.create( document.querySelector( '.document-editor__editable' ), {
          removePlugins: ['Title'],
          placeholder: '',
          fontSize: {
               options: [
                   9,11,13,'default',17,19,21,23,25,27,29,36,48],
           },
           fontBackgroundColor: {
                      columns: 10,
                      documentColors: 200,
                      colors: [{color: 'hsl(6, 54%, 95%)', label:' '}, {color: 'hsl(6, 54%, 89%)', label:' '}, {color: 'hsl(6, 54%, 78%)', label:' '}, {color: 'hsl(6, 54%, 68%)', label:' '}, {color: 'hsl(6, 54%, 57%)', label:' '}, {color: 'hsl(6, 63%, 46%)', label:' '}, {color: 'hsl(6, 63%, 41%)', label:' '}, {color: 'hsl(6, 63%, 35%)', label:' '}, {color: 'hsl(6, 63%, 29%)', label:' '}, {color: 'hsl(6, 63%, 24%)', label:' '}, {color: 'hsl(6, 78%, 96%)', label:' '}, {color: 'hsl(6, 78%, 91%)', label:' '}, {color: 'hsl(6, 78%, 83%)', label:' '}, {color: 'hsl(6, 78%, 74%)', label:' '}, {color: 'hsl(6, 78%, 66%)', label:' '}, {color: 'hsl(6, 78%, 57%)', label:' '}, {color: 'hsl(6, 59%, 50%)', label:' '}, {color: 'hsl(6, 59%, 43%)', label:' '}, {color: 'hsl(6, 59%, 37%)', label:' '}, {color: 'hsl(6, 59%, 30%)', label:' '}, {color: 'hsl(283, 39%, 95%)', label:' '}, {color: 'hsl(283, 39%, 91%)', label:' '}, {color: 'hsl(283, 39%, 81%)', label:' '}, {color: 'hsl(283, 39%, 72%)', label:' '}, {color: 'hsl(283, 39%, 63%)', label:' '}, {color: 'hsl(283, 39%, 53%)', label:' '}, {color: 'hsl(283, 34%, 47%)', label:' '}, {color: 'hsl(283, 34%, 40%)', label:' '}, {color: 'hsl(283, 34%, 34%)', label:' '}, {color: 'hsl(283, 34%, 28%)', label:' '}, {color: 'hsl(282, 39%, 95%)', label:' '}, {color: 'hsl(282, 39%, 89%)', label:' '}, {color: 'hsl(282, 39%, 79%)', label:' '}, {color: 'hsl(282, 39%, 68%)', label:' '}, {color: 'hsl(282, 39%, 58%)', label:' '}, {color: 'hsl(282, 44%, 47%)', label:' '}, {color: 'hsl(282, 44%, 42%)', label:' '}, {color: 'hsl(282, 44%, 36%)', label:' '}, {color: 'hsl(282, 44%, 30%)', label:' '}, {color: 'hsl(282, 44%, 25%)', label:' '}, {color: 'hsl(204, 51%, 94%)', label:' '}, {color: 'hsl(204, 51%, 89%)', label:' '}, {color: 'hsl(204, 51%, 78%)', label:' '}, {color: 'hsl(204, 51%, 67%)', label:' '}, {color: 'hsl(204, 51%, 55%)', label:' '}, {color: 'hsl(204, 64%, 44%)', label:' '}, {color: 'hsl(204, 64%, 39%)', label:' '}, {color: 'hsl(204, 64%, 34%)', label:' '}, {color: 'hsl(204, 64%, 28%)', label:' '}, {color: 'hsl(204, 64%, 23%)', label:' '}, {color: 'hsl(204, 70%, 95%)', label:' '}, {color: 'hsl(204, 70%, 91%)', label:' '}, {color: 'hsl(204, 70%, 81%)', label:' '}, {color: 'hsl(204, 70%, 72%)', label:' '}, {color: 'hsl(204, 70%, 63%)', label:' '}, {color: 'hsl(204, 70%, 53%)', label:' '}, {color: 'hsl(204, 62%, 47%)', label:' '}, {color: 'hsl(204, 62%, 40%)', label:' '}, {color: 'hsl(204, 62%, 34%)', label:' '}, {color: 'hsl(204, 62%, 28%)', label:' '}, {color: 'hsl(168, 55%, 94%)', label:' '}, {color: 'hsl(168, 55%, 88%)', label:' '}, {color: 'hsl(168, 55%, 77%)', label:' '}, {color: 'hsl(168, 55%, 65%)', label:' '}, {color: 'hsl(168, 55%, 54%)', label:' '}, {color: 'hsl(168, 76%, 42%)', label:' '}, {color: 'hsl(168, 76%, 37%)', label:' '}, {color: 'hsl(168, 76%, 32%)', label:' '}, {color: 'hsl(168, 76%, 27%)', label:' '}, {color: 'hsl(168, 76%, 22%)', label:' '}, {color: 'hsl(168, 42%, 94%)', label:' '}, {color: 'hsl(168, 42%, 87%)', label:' '}, {color: 'hsl(168, 42%, 74%)', label:' '}, {color: 'hsl(168, 42%, 61%)', label:' '}, {color: 'hsl(168, 45%, 49%)', label:' '}, {color: 'hsl(168, 76%, 36%)', label:' '}, {color: 'hsl(168, 76%, 31%)', label:' '}, {color: 'hsl(168, 76%, 27%)', label:' '}, {color: 'hsl(168, 76%, 23%)', label:' '}, {color: 'hsl(168, 76%, 19%)', label:' '}, {color: 'hsl(145, 45%, 94%)', label:' '}, {color: 'hsl(145, 45%, 88%)', label:' '}, {color: 'hsl(145, 45%, 77%)', label:' '}, {color: 'hsl(145, 45%, 65%)', label:' '}, {color: 'hsl(145, 45%, 53%)', label:' '}, {color: 'hsl(145, 63%, 42%)', label:' '}, {color: 'hsl(145, 63%, 37%)', label:' '}, {color: 'hsl(145, 63%, 32%)', label:' '}, {color: 'hsl(145, 63%, 27%)', label:' '}, {color: 'hsl(145, 63%, 22%)', label:' '}, {color: 'hsl(145, 61%, 95%)', label:' '}, {color: 'hsl(145, 61%, 90%)', label:' '}, {color: 'hsl(145, 61%, 80%)', label:' '}, {color: 'hsl(145, 61%, 69%)', label:' '}, {color: 'hsl(145, 61%, 59%)', label:' '}, {color: 'hsl(145, 63%, 49%)', label:' '}, {color: 'hsl(145, 63%, 43%)', label:' '}, {color: 'hsl(145, 63%, 37%)', label:' '}, {color: 'hsl(145, 63%, 31%)', label:' '}, {color: 'hsl(145, 63%, 25%)', label:' '}, {color: 'hsl(48, 89%, 95%)', label:' '}, {color: 'hsl(48, 89%, 90%)', label:' '}, {color: 'hsl(48, 89%, 80%)', label:' '}, {color: 'hsl(48, 89%, 70%)', label:' '}, {color: 'hsl(48, 89%, 60%)', label:' '}, {color: 'hsl(48, 89%, 50%)', label:' '}, {color: 'hsl(48, 88%, 44%)', label:' '}, {color: 'hsl(48, 88%, 38%)', label:' '}, {color: 'hsl(48, 88%, 32%)', label:' '}, {color: 'hsl(48, 88%, 26%)', label:' '}, {color: 'hsl(37, 90%, 95%)', label:' '}, {color: 'hsl(37, 90%, 90%)', label:' '}, {color: 'hsl(37, 90%, 80%)', label:' '}, {color: 'hsl(37, 90%, 71%)', label:' '}, {color: 'hsl(37, 90%, 61%)', label:' '}, {color: 'hsl(37, 90%, 51%)', label:' '}, {color: 'hsl(37, 86%, 45%)', label:' '}, {color: 'hsl(37, 86%, 39%)', label:' '}, {color: 'hsl(37, 86%, 33%)', label:' '}, {color: 'hsl(37, 86%, 27%)', label:' '}, {color: 'hsl(28, 80%, 95%)', label:' '}, {color: 'hsl(28, 80%, 90%)', label:' '}, {color: 'hsl(28, 80%, 81%)', label:' '}, {color: 'hsl(28, 80%, 71%)', label:' '}, {color: 'hsl(28, 80%, 61%)', label:' '}, {color: 'hsl(28, 80%, 52%)', label:' '}, {color: 'hsl(28, 74%, 46%)', label:' '}, {color: 'hsl(28, 74%, 39%)', label:' '}, {color: 'hsl(28, 74%, 33%)', label:' '}, {color: 'hsl(28, 74%, 27%)', label:' '}, {color: 'hsl(24, 71%, 94%)', label:' '}, {color: 'hsl(24, 71%, 88%)', label:' '}, {color: 'hsl(24, 71%, 77%)', label:' '}, {color: 'hsl(24, 71%, 65%)', label:' '}, {color: 'hsl(24, 71%, 53%)', label:' '}, {color: 'hsl(24, 100%, 41%)', label:' '}, {color: 'hsl(24, 100%, 36%)', label:' '}, {color: 'hsl(24, 100%, 31%)', label:' '}, {color: 'hsl(24, 100%, 26%)', label:' '}, {color: 'hsl(24, 100%, 22%)', label:' '}, {color: 'hsl(192, 15%, 99%)', label:' '}, {color: 'hsl(192, 15%, 99%)', label:' '}, {color: 'hsl(192, 15%, 97%)', label:' '}, {color: 'hsl(192, 15%, 96%)', label:' '}, {color: 'hsl(192, 15%, 95%)', label:' '}, {color: 'hsl(192, 15%, 94%)', label:' '}, {color: 'hsl(192, 5%, 82%)', label:' '}, {color: 'hsl(192, 3%, 71%)', label:' '}, {color: 'hsl(192, 2%, 60%)', label:' '}, {color: 'hsl(192, 1%, 49%)', label:' '}, {color: 'hsl(204, 8%, 98%)', label:' '}, {color: 'hsl(204, 8%, 95%)', label:' '}, {color: 'hsl(204, 8%, 90%)', label:' '}, {color: 'hsl(204, 8%, 86%)', label:' '}, {color: 'hsl(204, 8%, 81%)', label:' '}, {color: 'hsl(204, 8%, 76%)', label:' '}, {color: 'hsl(204, 5%, 67%)', label:' '}, {color: 'hsl(204, 4%, 58%)', label:' '}, {color: 'hsl(204, 3%, 49%)', label:' '}, {color: 'hsl(204, 3%, 40%)', label:' '}, {color: 'hsl(184, 9%, 96%)', label:' '}, {color: 'hsl(184, 9%, 92%)', label:' '}, {color: 'hsl(184, 9%, 85%)', label:' '}, {color: 'hsl(184, 9%, 77%)', label:' '}, {color: 'hsl(184, 9%, 69%)', label:' '}, {color: 'hsl(184, 9%, 62%)', label:' '}, {color: 'hsl(184, 6%, 54%)', label:' '}, {color: 'hsl(184, 5%, 47%)', label:' '}, {color: 'hsl(184, 5%, 40%)', label:' '}, {color: 'hsl(184, 5%, 32%)', label:' '}, {color: 'hsl(184, 6%, 95%)', label:' '}, {color: 'hsl(184, 6%, 91%)', label:' '}, {color: 'hsl(184, 6%, 81%)', label:' '}, {color: 'hsl(184, 6%, 72%)', label:' '}, {color: 'hsl(184, 6%, 62%)', label:' '}, {color: 'hsl(184, 6%, 53%)', label:' '}, {color: 'hsl(184, 5%, 46%)', label:' '}, {color: 'hsl(184, 5%, 40%)', label:' '}, {color: 'hsl(184, 5%, 34%)', label:' '}, {color: 'hsl(184, 5%, 27%)', label:' '}, {color: 'hsl(210, 12%, 93%)', label:' '}, {color: 'hsl(210, 12%, 86%)', label:' '}, {color: 'hsl(210, 12%, 71%)', label:' '}, {color: 'hsl(210, 12%, 57%)', label:' '}, {color: 'hsl(210, 15%, 43%)', label:' '}, {color: 'hsl(210, 29%, 29%)', label:' '}, {color: 'hsl(210, 29%, 25%)', label:' '}, {color: 'hsl(210, 29%, 22%)', label:' '}, {color: 'hsl(210, 29%, 18%)', label:' '}, {color: 'hsl(210, 29%, 15%)', label:' '}, {color: 'hsl(210, 9%, 92%)', label:' '}, {color: 'hsl(210, 9%, 85%)', label:' '}, {color: 'hsl(210, 9%, 70%)', label:' '}, {color: 'hsl(210, 9%, 55%)', label:' '}, {color: 'hsl(210, 14%, 39%)', label:' '}, {color: 'hsl(210, 29%, 24%)', label:' '}, {color: 'hsl(210, 29%, 21%)', label:' '}, {color: 'hsl(210, 29%, 18%)', label:' '}, {color: 'hsl(210, 29%, 16%)', label:' '}, {color: 'hsl(210, 29%, 13%)', label:' '}
                              ]
                            },
          fontColor: {
                    columns: 10,
                    documentColors: 200,
                    colors: [{color: 'hsl(6, 54%, 95%)', label:' '}, {color: 'hsl(6, 54%, 89%)', label:' '}, {color: 'hsl(6, 54%, 78%)', label:' '}, {color: 'hsl(6, 54%, 68%)', label:' '}, {color: 'hsl(6, 54%, 57%)', label:' '}, {color: 'hsl(6, 63%, 46%)', label:' '}, {color: 'hsl(6, 63%, 41%)', label:' '}, {color: 'hsl(6, 63%, 35%)', label:' '}, {color: 'hsl(6, 63%, 29%)', label:' '}, {color: 'hsl(6, 63%, 24%)', label:' '}, {color: 'hsl(6, 78%, 96%)', label:' '}, {color: 'hsl(6, 78%, 91%)', label:' '}, {color: 'hsl(6, 78%, 83%)', label:' '}, {color: 'hsl(6, 78%, 74%)', label:' '}, {color: 'hsl(6, 78%, 66%)', label:' '}, {color: 'hsl(6, 78%, 57%)', label:' '}, {color: 'hsl(6, 59%, 50%)', label:' '}, {color: 'hsl(6, 59%, 43%)', label:' '}, {color: 'hsl(6, 59%, 37%)', label:' '}, {color: 'hsl(6, 59%, 30%)', label:' '}, {color: 'hsl(283, 39%, 95%)', label:' '}, {color: 'hsl(283, 39%, 91%)', label:' '}, {color: 'hsl(283, 39%, 81%)', label:' '}, {color: 'hsl(283, 39%, 72%)', label:' '}, {color: 'hsl(283, 39%, 63%)', label:' '}, {color: 'hsl(283, 39%, 53%)', label:' '}, {color: 'hsl(283, 34%, 47%)', label:' '}, {color: 'hsl(283, 34%, 40%)', label:' '}, {color: 'hsl(283, 34%, 34%)', label:' '}, {color: 'hsl(283, 34%, 28%)', label:' '}, {color: 'hsl(282, 39%, 95%)', label:' '}, {color: 'hsl(282, 39%, 89%)', label:' '}, {color: 'hsl(282, 39%, 79%)', label:' '}, {color: 'hsl(282, 39%, 68%)', label:' '}, {color: 'hsl(282, 39%, 58%)', label:' '}, {color: 'hsl(282, 44%, 47%)', label:' '}, {color: 'hsl(282, 44%, 42%)', label:' '}, {color: 'hsl(282, 44%, 36%)', label:' '}, {color: 'hsl(282, 44%, 30%)', label:' '}, {color: 'hsl(282, 44%, 25%)', label:' '}, {color: 'hsl(204, 51%, 94%)', label:' '}, {color: 'hsl(204, 51%, 89%)', label:' '}, {color: 'hsl(204, 51%, 78%)', label:' '}, {color: 'hsl(204, 51%, 67%)', label:' '}, {color: 'hsl(204, 51%, 55%)', label:' '}, {color: 'hsl(204, 64%, 44%)', label:' '}, {color: 'hsl(204, 64%, 39%)', label:' '}, {color: 'hsl(204, 64%, 34%)', label:' '}, {color: 'hsl(204, 64%, 28%)', label:' '}, {color: 'hsl(204, 64%, 23%)', label:' '}, {color: 'hsl(204, 70%, 95%)', label:' '}, {color: 'hsl(204, 70%, 91%)', label:' '}, {color: 'hsl(204, 70%, 81%)', label:' '}, {color: 'hsl(204, 70%, 72%)', label:' '}, {color: 'hsl(204, 70%, 63%)', label:' '}, {color: 'hsl(204, 70%, 53%)', label:' '}, {color: 'hsl(204, 62%, 47%)', label:' '}, {color: 'hsl(204, 62%, 40%)', label:' '}, {color: 'hsl(204, 62%, 34%)', label:' '}, {color: 'hsl(204, 62%, 28%)', label:' '}, {color: 'hsl(168, 55%, 94%)', label:' '}, {color: 'hsl(168, 55%, 88%)', label:' '}, {color: 'hsl(168, 55%, 77%)', label:' '}, {color: 'hsl(168, 55%, 65%)', label:' '}, {color: 'hsl(168, 55%, 54%)', label:' '}, {color: 'hsl(168, 76%, 42%)', label:' '}, {color: 'hsl(168, 76%, 37%)', label:' '}, {color: 'hsl(168, 76%, 32%)', label:' '}, {color: 'hsl(168, 76%, 27%)', label:' '}, {color: 'hsl(168, 76%, 22%)', label:' '}, {color: 'hsl(168, 42%, 94%)', label:' '}, {color: 'hsl(168, 42%, 87%)', label:' '}, {color: 'hsl(168, 42%, 74%)', label:' '}, {color: 'hsl(168, 42%, 61%)', label:' '}, {color: 'hsl(168, 45%, 49%)', label:' '}, {color: 'hsl(168, 76%, 36%)', label:' '}, {color: 'hsl(168, 76%, 31%)', label:' '}, {color: 'hsl(168, 76%, 27%)', label:' '}, {color: 'hsl(168, 76%, 23%)', label:' '}, {color: 'hsl(168, 76%, 19%)', label:' '}, {color: 'hsl(145, 45%, 94%)', label:' '}, {color: 'hsl(145, 45%, 88%)', label:' '}, {color: 'hsl(145, 45%, 77%)', label:' '}, {color: 'hsl(145, 45%, 65%)', label:' '}, {color: 'hsl(145, 45%, 53%)', label:' '}, {color: 'hsl(145, 63%, 42%)', label:' '}, {color: 'hsl(145, 63%, 37%)', label:' '}, {color: 'hsl(145, 63%, 32%)', label:' '}, {color: 'hsl(145, 63%, 27%)', label:' '}, {color: 'hsl(145, 63%, 22%)', label:' '}, {color: 'hsl(145, 61%, 95%)', label:' '}, {color: 'hsl(145, 61%, 90%)', label:' '}, {color: 'hsl(145, 61%, 80%)', label:' '}, {color: 'hsl(145, 61%, 69%)', label:' '}, {color: 'hsl(145, 61%, 59%)', label:' '}, {color: 'hsl(145, 63%, 49%)', label:' '}, {color: 'hsl(145, 63%, 43%)', label:' '}, {color: 'hsl(145, 63%, 37%)', label:' '}, {color: 'hsl(145, 63%, 31%)', label:' '}, {color: 'hsl(145, 63%, 25%)', label:' '}, {color: 'hsl(48, 89%, 95%)', label:' '}, {color: 'hsl(48, 89%, 90%)', label:' '}, {color: 'hsl(48, 89%, 80%)', label:' '}, {color: 'hsl(48, 89%, 70%)', label:' '}, {color: 'hsl(48, 89%, 60%)', label:' '}, {color: 'hsl(48, 89%, 50%)', label:' '}, {color: 'hsl(48, 88%, 44%)', label:' '}, {color: 'hsl(48, 88%, 38%)', label:' '}, {color: 'hsl(48, 88%, 32%)', label:' '}, {color: 'hsl(48, 88%, 26%)', label:' '}, {color: 'hsl(37, 90%, 95%)', label:' '}, {color: 'hsl(37, 90%, 90%)', label:' '}, {color: 'hsl(37, 90%, 80%)', label:' '}, {color: 'hsl(37, 90%, 71%)', label:' '}, {color: 'hsl(37, 90%, 61%)', label:' '}, {color: 'hsl(37, 90%, 51%)', label:' '}, {color: 'hsl(37, 86%, 45%)', label:' '}, {color: 'hsl(37, 86%, 39%)', label:' '}, {color: 'hsl(37, 86%, 33%)', label:' '}, {color: 'hsl(37, 86%, 27%)', label:' '}, {color: 'hsl(28, 80%, 95%)', label:' '}, {color: 'hsl(28, 80%, 90%)', label:' '}, {color: 'hsl(28, 80%, 81%)', label:' '}, {color: 'hsl(28, 80%, 71%)', label:' '}, {color: 'hsl(28, 80%, 61%)', label:' '}, {color: 'hsl(28, 80%, 52%)', label:' '}, {color: 'hsl(28, 74%, 46%)', label:' '}, {color: 'hsl(28, 74%, 39%)', label:' '}, {color: 'hsl(28, 74%, 33%)', label:' '}, {color: 'hsl(28, 74%, 27%)', label:' '}, {color: 'hsl(24, 71%, 94%)', label:' '}, {color: 'hsl(24, 71%, 88%)', label:' '}, {color: 'hsl(24, 71%, 77%)', label:' '}, {color: 'hsl(24, 71%, 65%)', label:' '}, {color: 'hsl(24, 71%, 53%)', label:' '}, {color: 'hsl(24, 100%, 41%)', label:' '}, {color: 'hsl(24, 100%, 36%)', label:' '}, {color: 'hsl(24, 100%, 31%)', label:' '}, {color: 'hsl(24, 100%, 26%)', label:' '}, {color: 'hsl(24, 100%, 22%)', label:' '}, {color: 'hsl(192, 15%, 99%)', label:' '}, {color: 'hsl(192, 15%, 99%)', label:' '}, {color: 'hsl(192, 15%, 97%)', label:' '}, {color: 'hsl(192, 15%, 96%)', label:' '}, {color: 'hsl(192, 15%, 95%)', label:' '}, {color: 'hsl(192, 15%, 94%)', label:' '}, {color: 'hsl(192, 5%, 82%)', label:' '}, {color: 'hsl(192, 3%, 71%)', label:' '}, {color: 'hsl(192, 2%, 60%)', label:' '}, {color: 'hsl(192, 1%, 49%)', label:' '}, {color: 'hsl(204, 8%, 98%)', label:' '}, {color: 'hsl(204, 8%, 95%)', label:' '}, {color: 'hsl(204, 8%, 90%)', label:' '}, {color: 'hsl(204, 8%, 86%)', label:' '}, {color: 'hsl(204, 8%, 81%)', label:' '}, {color: 'hsl(204, 8%, 76%)', label:' '}, {color: 'hsl(204, 5%, 67%)', label:' '}, {color: 'hsl(204, 4%, 58%)', label:' '}, {color: 'hsl(204, 3%, 49%)', label:' '}, {color: 'hsl(204, 3%, 40%)', label:' '}, {color: 'hsl(184, 9%, 96%)', label:' '}, {color: 'hsl(184, 9%, 92%)', label:' '}, {color: 'hsl(184, 9%, 85%)', label:' '}, {color: 'hsl(184, 9%, 77%)', label:' '}, {color: 'hsl(184, 9%, 69%)', label:' '}, {color: 'hsl(184, 9%, 62%)', label:' '}, {color: 'hsl(184, 6%, 54%)', label:' '}, {color: 'hsl(184, 5%, 47%)', label:' '}, {color: 'hsl(184, 5%, 40%)', label:' '}, {color: 'hsl(184, 5%, 32%)', label:' '}, {color: 'hsl(184, 6%, 95%)', label:' '}, {color: 'hsl(184, 6%, 91%)', label:' '}, {color: 'hsl(184, 6%, 81%)', label:' '}, {color: 'hsl(184, 6%, 72%)', label:' '}, {color: 'hsl(184, 6%, 62%)', label:' '}, {color: 'hsl(184, 6%, 53%)', label:' '}, {color: 'hsl(184, 5%, 46%)', label:' '}, {color: 'hsl(184, 5%, 40%)', label:' '}, {color: 'hsl(184, 5%, 34%)', label:' '}, {color: 'hsl(184, 5%, 27%)', label:' '}, {color: 'hsl(210, 12%, 93%)', label:' '}, {color: 'hsl(210, 12%, 86%)', label:' '}, {color: 'hsl(210, 12%, 71%)', label:' '}, {color: 'hsl(210, 12%, 57%)', label:' '}, {color: 'hsl(210, 15%, 43%)', label:' '}, {color: 'hsl(210, 29%, 29%)', label:' '}, {color: 'hsl(210, 29%, 25%)', label:' '}, {color: 'hsl(210, 29%, 22%)', label:' '}, {color: 'hsl(210, 29%, 18%)', label:' '}, {color: 'hsl(210, 29%, 15%)', label:' '}, {color: 'hsl(210, 9%, 92%)', label:' '}, {color: 'hsl(210, 9%, 85%)', label:' '}, {color: 'hsl(210, 9%, 70%)', label:' '}, {color: 'hsl(210, 9%, 55%)', label:' '}, {color: 'hsl(210, 14%, 39%)', label:' '}, {color: 'hsl(210, 29%, 24%)', label:' '}, {color: 'hsl(210, 29%, 21%)', label:' '}, {color: 'hsl(210, 29%, 18%)', label:' '}, {color: 'hsl(210, 29%, 16%)', label:' '}, {color: 'hsl(210, 29%, 13%)', label:' '}
                            ]
                          },
           
              }).then( editor => {
                    this.toolbarContainer = document.querySelector( '.document-editor__toolbar' );
                    toolbarContainer.appendChild( editor.ui.view.toolbar.element );
                    this.editor = editor;
                    window.editor = editor;
                    var data=document.getElementById('docData').value;
                    var perm=document.getElementById('perm').value;
                    editor.setData(data);

                    if(perm !=0 && perm !=1)
                    this.editor.enableReadOnlyMode('document-editor__editable');

                    //only read

              }).catch( err => {
             console.error( err );
        });
   </script>
   
   <script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });
</script>
 
  <script>
    var click=0;
    function readOnly()
    {
      var header=document.getElementById('header');
      var content=document.getElementsByClassName('document-editor__editable-container');

      if(this.click==0)
      {
      header.style.height="90px";
      this.editor.ui.view.toolbar.element.style.display = 'none';
      this.editor.enableReadOnlyMode('document-editor__editable');
      content[0].style.marginTop="15px";  
      this.click=1;
      }
      else
      {
      header.style.height="110px";
      this.editor.ui.view.toolbar.element.style.display = 'flex';
      this.editor.disableReadOnlyMode('document-editor__editable');
      this.click=0;
      content[0].style.marginTop="50px";  

      }
    }
  </script>


  
  <script>
   var historyClick=0;
    function history()
    {
      var htmlData=document.getElementsByClassName('ck-restricted-editing_mode_standard document-editor__editable ck ck-content ck-editor__editable ck-rounded-corners ck-editor__editable_inline');
      saveData=htmlData[0].innerHTML;
      // var load=document.getElementById('loading-wrapper');
      //           load.style.display="block";
      // getHistoryData();
      var header=document.getElementById('header');
      var menu=document.getElementById('menuDiv');
      var toolbar=document.getElementById('toolbar');
      var content=document.getElementsByClassName('document-editor__editable-container');
      var history=document.getElementById('historyDiv');
      header.style.height="70px";
      this.editor.ui.view.toolbar.element.style.display = 'none';
      this.editor.enableReadOnlyMode('document-editor__editable');
      content[0].style.marginTop="15px"; 
      content[0].style.marginRight="300px"; 
      menu.style.display="none";
      toolbar.style.display="none";
      history.style.display="flex";
      historyClick=1;

    }
   
    var backClick=0;
    function back()
    {
      var header=document.getElementById('header');
      var menu=document.getElementById('menuDiv');
      var toolbar=document.getElementById('toolbar');
      var content=document.getElementsByClassName('document-editor__editable-container');
      var history=document.getElementById('historyDiv');
      header.style.height="110px";
      this.editor.ui.view.toolbar.element.style.display = 'flex';
      this.editor.disableReadOnlyMode('document-editor__editable');
      this.click=0;
      content[0].style.marginTop="50px";
      content[0].style.marginRight="0"; 

      menu.style.display="flex";
      toolbar.style.display="flex";
      history.style.display="none";

    
      if(this.id!=null)
      {

      var restoreButton=document.getElementById('restoreButton');
      var x=document.getElementById(this.id);
      var date=document.getElementById('date'+this.id);
      date.style.fontWeight ="normal";  
      x.style.backgroundColor="#fff";
      x.style.color="#000";
      restoreButton.style.display="none";

      }

       this.historyClick=0;
       this.backClick=1;



       if(this.restoreclick==0)
       {
        this.editor.setData(this.saveData);
       }

    }
  </script>
 

 <script>
   var id;
   var historyData;
  //  var saveData=document.getElementById('docData').value;
  var saveData;

   function selectVersion(id,data)
   { 
 

    if(this.id==null)
     this.id=id;

     var restoreButton=document.getElementById('restoreButton');
     if(id!=1)
     {
       restoreButton.style.display="block";
       this.editor.setData(data);
       historyData=data;
     }
     else
     {
       restoreButton.style.display="none";
       this.editor.setData(saveData);
     }


     if(this.id == id)
     {
       var x=document.getElementById(id);
       var date=document.getElementById(`date${id}`);
       date.style.fontWeight ="700";
       x.style.color="#1a73e8";
       x.style.backgroundColor="#e8f0fe";
     }
     else
     {
       var x=document.getElementById(this.id);
       var y=document.getElementById(id);
       var date1=document.getElementById(`date${id}`);
       var date2=document.getElementById(`date${this.id}`);

       x.style.backgroundColor="#fff";
       y.style.backgroundColor="#e8f0fe";

       x.style.color="#000";
       y.style.color="#1a73e8";

       date1.style.fontWeight ="700";
       date2.style.fontWeight ="normal";

       this.id=id;
     }

   }
 </script>

<script>
  restoreclick=0;
  function restoreData(data)
  {

    if(restoreclick==0)
    {
      var docsId=document.getElementById('docsId').value;
      var db=firebase.database();
      var pushId = db.ref().push().key;
      var load=document.getElementById('loading-wrapper');
      load.style.display="block";

      $.ajax({
       method: "post",
       type: "post",
       url: '{{route('restoreData')}}',
       data: {'docsId':docsId,'pushId':id,'docsData':historyData,'pushId':pushId},
       success: function (response) {
      load.style.display="none";
      location.reload();

       },
       error:function (error)
       {
       }
      });  

    }


  }
</script>

<script>
  function deleteVersion()
  {
    var docsId=document.getElementById('docsId').value;
      var load=document.getElementById('loading-wrapper');
      load.style.display="block";
      

      $.ajax({
       method: "post",
       type: "post",
       url: '{{route('deleteVersion')}}',
       data: {'docsId':docsId,'pushId':id},
       success: function (response) {
         var deleteData=document.getElementById(id);
         deleteData.style.display="none";
         deleteData.style.innerHTML="";
      load.style.display="none";
      editor.setData(saveData);
      toastr.success("Version deleted!","Version deleted!",({ "closeButton": false,
         "debug": false,
         "newestOnTop": true,
         "progressBar": true,
         "positionClass": "toast-top-center",
         "preventDuplicates": true,
         "onclick": null,
         "showDuration": "150",
         "hideDuration": "500",
         "timeOut": "1500",
         "extendedTimeOut": "500",
         "showEasing": "swing",
         "hideEasing": "linear",
         "showMethod": "fadeIn",
         "hideMethod": "fadeOut"
      }));


      // location.reload();
       },
       error:function (error)
       {
       }
      });  
  }
</script>

<script>
  function makeCopy()
  {
    var docsId=document.getElementById('docsId').value;
      var load=document.getElementById('loading-wrapper');
      load.style.display="block";

      var db=firebase.database();
      var pushId = db.ref().push().key;
      var dataPushId = db.ref().push().key;
      
      var titleId = document.getElementById("title");

      $.ajax({
       method: "post",
       type: "post",
       url: '{{route('makeCopy')}}',
       data: {'pushId':id,'dataPushId':dataPushId,'title':titleId.value+' Copy','data':historyData},
       success: function (response) {
         var deleteData=document.getElementById(id);
         deleteData.style.display="none";
         deleteData.style.innerHTML="";

         const full = location.protocol + '//' + location.host;
         load.style.display="none";
         window.open(full+'/docs/'+id);
       },
       error:function (error)
       {
       }
      });  
  }
</script>



<script>
  // change title
var titleId = document.getElementById("title");
     
// https://www.educative.io/edpresso/how-to-use-the-debounce-function-in-javascript
    const debounce = (func, wait, immediate)=> {
    var timeout;

    return function executedFunction() {
        var context = this;
        var args = arguments;
            
        var later = function() {
        timeout = null;
        if (!immediate) func.apply(context, args);
        };

        var callNow = immediate && !timeout;
        
        clearTimeout(timeout);

        timeout = setTimeout(later, wait);
        
        if (callNow) func.apply(context, args);
        };
    };
    titleId.addEventListener('change', debounce(function() { 
      
      title=titleId.value;
       if(title=='')
         title="Untitled";
        var docsId=document.getElementById('docsId').value;

   $.ajax({
       method: "post",
       type: "post",
       url: '{{route('changeTitle')}}',
       data: {'docsId':docsId,'title':title},
       success: function (response) {
          document.title=title+"- Online Note-App";
       },
       error:function (error)
       {
       }
      });   

    }, 500)); 

</script>



<script>
  // write data

  function debounce2(func, wait, immediate) {
  var timeout;

  return function executedFunction() {
    var context = this;
    var args = arguments;
	    
    var later = function() {
      timeout = null;
      if (!immediate) func.apply(context, args);
    };

    var callNow = immediate && !timeout;
	
    clearTimeout(timeout);

    timeout = setTimeout(later, wait);
	
    if (callNow) func.apply(context, args);
  };
};


var htmlData=document.getElementsByClassName('ck-restricted-editing_mode_standard document-editor__editable ck ck-content ck-editor__editable ck-rounded-corners ck-editor__editable_inline');

editor.model.document.on( 'change:data', debounce2(function() {
                      
  if(historyClick==0 && backClick==0 && realTimeControl==0 )
  {
   var saveElement = document.getElementById('saving');
   saveElement.style.visibility="visible";
   
    var data=htmlData[0].innerHTML;
    //  var data=editor.getData();
    var docsId=document.getElementById('docsId').value;
    var db=firebase.database();
    var pushId = db.ref().push().key;
    var user =document.getElementById('userId');

    if(data=="")
      data="&nbsp;";

   $.ajax({
       method: "post",
       type: "post",
       url: '{{route('addDocsData')}}',
       data: {'docsId':docsId,'docsData':data,'pushId':pushId,'userId':user.value},
       success: function (response) {
       dateCalculate();
       setTimeout(() => {
         saveElement.style.visibility="hidden";
        //  saved.style.display="flex";
   
       }, 1500);

       },
       error:function (error)
       {
       }
      });   
    }
    else
    {
      backClick=0;
      realTimeControl=0;
    }
 
  },200));


// $("body").on('DOMSubtreeModified', "#documentEditor", debounce2(function() {
// //  var saved=document.getElementById('saved');
// //  saved.style.display="none";

//     },400));
  
</script>

<script>

const myTimeout = setInterval(dateCalculate, 60000);

 function dateCalculate()
  {
      $.ajax({
       method: "post",
       type: "post",
       url: '{{route('dateCalculate')}}',
       success: function (response) {
       var editDate=document.getElementById('editDate');
       editDate.innerText="Last edit was "+response;
       },
       error:function (error)
       {
       }
      }); 
  }
</script>

<script>
  var realTimeControl=0;

  var user =document.getElementById('userId');
      if(user.value == "Anonymous")
      user.value='Anonymous'+Math.random()*10000;
      else
      user.value=user.value;
  getRealTimeData();
  function getRealTimeData()
  {

//     firebase.auth().onAuthStateChanged(function(user) {
//   if (user) {
//   } else {
//     // No user is signed in.
//   }
// });


var docsId=document.getElementById('docsId').value;

    var db = firebase.database().ref('lastDocsData/' + docsId );
   db.on('value', (snapshot) => {
    const data = snapshot.val();

    if(data.editedById!=user.value)
    {
      this.editor.setData(data.data);
      realTimeControl=1;
      editor.model.change( writer => {
      writer.setSelection( writer.createPositionAt( editor.model.document.getRoot(), 'end' ) );
    } );
    }
 
    
    })


//     firebase.database().ref("lastDocsData/"+docsId).once("value").then((snapshot) => {
//   console.log(snapshot.val());
// }).catch(e => {
//   console.log(e);
// })


  }

</script>


<script>
 


 function debounce3(func, wait, immediate) {
  var timeout;

  return function executedFunction() {
    var context = this;
    var args = arguments;
	    
    var later = function() {
      timeout = null;
      if (!immediate) func.apply(context, args);
    };

    var callNow = immediate && !timeout;
	
    clearTimeout(timeout);

    timeout = setTimeout(later, wait);
	
    if (callNow) func.apply(context, args);
  };
};

  var userArea=document.getElementById('userArea');
  var orjUserArea=userArea.innerHTML;
  var userMail=document.getElementById('userMail');
   

   userMail.addEventListener('input', debounce3(function() { 
    if(userMail.value!="" && userMail.value.toLowerCase() != "public")
    {
      $.ajax({
       method: "post",
       type: "post",
       url: '{{route('searchUser')}}',
       data: {'email':userMail.value,},
       success: function (response) {

       var array=[];
        for (const record of Object.keys(response)) {
          if (record) {
           array.push(response[record]);
           }
        }
        var htmlData=""
        array.forEach(element => {
          if(element.pp=='img/user.png')
          {
            const full = location.protocol + '//' + location.host;
            htmlData+=`
            <div style="display: flex;margin-bottom:10px;">
               <img src="${full}/img/user.png" style="width:48px;height:48px" alt="">  
                <div style="display: flex;flex-direction:column;align-items:flex-start;margin-left:15px;" >
                  <div>${element.email}</div>
                  <div>${element.name}</div>
                  <input id="newShareId" type="hidden" value="${element.uid}">
              </div>
           </div>

           <div>
            <select id="newShare" class="form-select" aria-label="Default select example">
              <option value="0">Please Select</option>
              <option value="1">Viewer</option>
              <option value="2">Editor</option>

            </select>
           </div>`;
          }
          else
          {
            htmlData+=`
            <div style="display: flex;margin-bottom:10px;">
               <img src=${element.pp} style="width:48px;height:48px;border-radius:50%" alt="">  
                <div style="display: flex;flex-direction:column;align-items:flex-start;margin-left:15px;" >
                  <div>${element.email}</div>
                  <div>${element.name}</div>
                  <input  id="newShareId" type="hidden" value="${element.uid}">
              </div>
           </div>

           <div>
            <select id="newShare" class="form-select" aria-label="Default select example">
              <option value="0">Please Select</option>
              <option value="1">Viewer</option>
              <option value="2">Editor</option>
            </select>
           </div>`;
          }
        
        });
   
        if(htmlData!="")
        userArea.innerHTML=htmlData;

       },
       error:function (error)
       {
       }
      }); 
    }
    else if(userMail.value.toLowerCase()=="public")
    {
      var htmlData=""
      const full = location.protocol + '//' + location.host;
            htmlData+=`
            <div style="display: flex;margin-bottom:10px;">
               <img src="${full}/img/user.png" style="width:48px;height:48px" alt="">  
                <div style="display: flex;flex-direction:column;align-items:flex-start;margin-left:15px;" >
                  <div>Public</div>
                  <div>Public</div>
                  <input id="newShareId" type="hidden" value="Public">
              </div>
           </div>

           <div>
            <select id="newShare" class="form-select" aria-label="Default select example">
              <option value="0">Please Select</option>
              <option value="1">Viewer</option>
              <option value="2">Editor</option>

            </select>
           </div>`;

           userArea.innerHTML=htmlData;
    }
    else
    {
      
      userArea.innerHTML=orjUserArea;
    }

    },300));

</script>


<link href="{{asset('css/toastr.css')}}" rel="stylesheet">
<script src="{{asset('js/toastr.min.js')}}"></script>

<script>
  function copyUrl()
  {
      navigator.clipboard.writeText('{{Request::url()}}');
      toastr.info("Link copied!",'Link copied!',({ "closeButton": false,
      "debug": false,
      "newestOnTop": true,
      "progressBar": true,
      "positionClass": "toast-top-center",
      "preventDuplicates": true,
      "onclick": null,
      "showDuration": "150",
      "hideDuration": "500",
      "timeOut": "1500",
      "extendedTimeOut": "500",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
      }))
  }
  

</script>

<script>
  $('#shareModal').on('hidden.bs.modal', function () {
  var userMail=document.getElementById('userMail');
  userMail.value="";
  permSave=0;
  permArray=[];
  var userArea=document.getElementById('userArea');
    userArea.innerHTML=orjUserArea;
})
</script>

<script>
  function savePerm()
  {
    var newShare=document.getElementById('newShare');
    var newShareId=document.getElementById('newShareId');
      var load=document.getElementById('loading-wrapper');
      load.style.display="block";
           
    
    var docsId=document.getElementById('docsId').value;
    if(permSave==0 && newShare!=null && newShare.value!=0 )
    {
      if(newShareId.value.toLowerCase()=="public")
      newShareId.value=newShareId.value.toLowerCase()
      var userId=document.getElementById('userId').value;
      $.ajax({
       method: "post",
       type: "post",
       url: '{{route('changePerm')}}',
       data: {'docsId':docsId,'uid':newShareId.value,'perm':newShare.value},
       success: function (response) {
       load.style.display="none";
       $('#shareModal').modal('hide');

       toastr.success("Permission updated!",'Permission updated!',({ "closeButton": false,
         "debug": false,
         "newestOnTop": true,
         "progressBar": true,
         "positionClass": "toast-top-center",
         "preventDuplicates": true,
         "onclick": null,
         "showDuration": "150",
         "hideDuration": "500",
         "timeOut": "1500",
         "extendedTimeOut": "500",
         "showEasing": "swing",
         "hideEasing": "linear",
         "showMethod": "fadeIn",
         "hideMethod": "fadeOut"
      }));
      location.reload();
       },
       error:function (error)
       {
       }
      });   
      
    }
    else if(permSave==1)
    {
      load.style.display="block";
      $.ajax({
       method: "post",
       type: "post",
       url: '{{route('changePerm2')}}',
       data: {'docsId':docsId,'data':permArray},
       success: function (response) {
       load.style.display="none";
       $('#shareModal').modal('hide');
       toastr.success("Permission updated!",'Permission updated!',({ "closeButton": false,
         "debug": false,
         "newestOnTop": true,
         "progressBar": true,
         "positionClass": "toast-top-center",
         "preventDuplicates": true,
         "onclick": null,
         "showDuration": "150",
         "hideDuration": "500",
         "timeOut": "1500",
         "extendedTimeOut": "500",
         "showEasing": "swing",
         "hideEasing": "linear",
         "showMethod": "fadeIn",
         "hideMethod": "fadeOut"
      }))
      
      location.reload();
      permSave=0;
      permArray=[];
       },
       error:function (error)
       {
       }
      });   
    }
    else
    {
      load.style.display="none";
      $('#shareModal').modal('hide');
    }
  }
    
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.debug.js"></script>
<script>
  function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
   
     var htmlData=document.getElementsByClassName('ck-restricted-editing_mode_standard document-editor__editable ck ck-content ck-editor__editable ck-rounded-corners ck-editor__editable_inline ');
 

     w=window.open();
    w.document.write(htmlData[0].innerHTML);
    w.print();
    w.close();
     
    //  var originalContents = document.body.innerHTML;

    //  document.body.innerHTML = htmlData[0].innerHTML;

    //  window.print();

    //  document.body.innerHTML = originalContents;
}
</script>


{{-- <script>
  function getHistoryData()
  {
 
    var docsId=document.getElementById('docsId').value;

    $.ajax({
       method: "post",
       type: "post",
       url: '{{route('getHistoryData')}}',
       data:{'docsId':docsId},
       success: function (response) {
       var array=[];
        for (const record of Object.keys(response)) {
          if (record) {
           array.push(response[record]);
           }
        }
        console.log(array.reverse());
        var historyData=document.getElementById('historyData');
        var load=document.getElementById('loading-wrapper');
                load.style.display="none";

         var htmlData="";
         var count=0;
        array.forEach(element => {
          console.log(element);
           count++;
           if(count==1)
           {
            htmlData+=`  <div onclick="selectVersion('${count}','${element.data}')" id="${count}" style="height:90px !important;" class="versions">
            <div style="width: 90%;height:33%;"> <span id="date${count}" style="font-size:1em" >Date </span></div>
            <a href="javascript:void()" type="button" id="defaultDropdown" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false" style="width: 10%;height:33%;">
              <img src="{{asset('img/dot.png')}}" style="height: 20px;width:20px;" alt="">
            </a>
              <ul class="dropdown-menu" aria-labelledby="defaultDropdown">
                <li><a class="dropdown-item" href="#">Delete this version</a></li>
                <li><a class="dropdown-item" href="#">Make a copy</a></li>
              </ul>
            <div style="width: 90%;height:33%;font-size:0.9em" >Current Version</div>
            <div style="width: 80%;height:40%; overflow:hidden; white-space:nowrap; text-overflow: ellipsis;font-size:0.9em" >${element.editedByName}</div>
          </div>`
           }
           else
           {
             htmlData+= `<div onclick="selectVersion('${count}','${element.data}')" id="${count}"  class="versions">
            <div style="width: 90%;height:60%;"> <span id="date${count}" style="font-size:1em" >Date</span></div>

            <a href="javascript:void()" type="button" id="defaultDropdown" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false" style="width: 10%;height:60%;">
              <img src="{{asset('img/dot.png')}}" style="height: 20px;width:20px;" alt="">
            </a>
              <ul class="dropdown-menu" aria-labelledby="defaultDropdown">
                <li><a class="dropdown-item" href="#">Restore this version</a></li>
                <li><a class="dropdown-item" href="#">Delete this version</a></li>
                <li><a class="dropdown-item" href="#">Make a copy</a></li>
              </ul>
            <div style="width: 80%;height:40%; overflow:hidden; white-space:nowrap; text-overflow: ellipsis;font-size:0.9em" >${element.editedByName}</div>
          </div>`
           }
    

        });

         historyData.innerHTML=htmlData;

       },
       error:function (error)
       {
       }
      }); 

  }

</script> --}}


   
    <script>
      function test()
      {
        // save
         var htmlData=document.getElementsByClassName('ck-restricted-editing_mode_standard document-editor__editable ck ck-content ck-editor__editable ck-rounded-corners ck-editor__editable_inline ck-blurred');

      }
    </script>


</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
    <title>Online Note-App</title>
</head>
<link href="{{asset('css/bootstrap.css')}}"  type="text/css" rel="stylesheet">
<link href="{{asset('css/ck.css')}}"  type="text/css" rel="stylesheet">
<link href="{{asset('css/style.css')}}"  type="text/css" rel="stylesheet">

<link rel="shortcut icon" href="{{asset('img/logo.png')}}" />
<style>
  svg
{
max-width: 15px;

}
table  {
  border: 1px double #b3b3b3;
    border-collapse: collapse;
    border-spacing: 0;
    height: 100%;
    width: 100%;
}
tbody
{
  border-color: inherit;
    border-style: solid;
    border-width: 0;
}
tr
{
  border-color: inherit;
    border-style: solid;
    border-width: 0;
}
td
{
  border: 1px solid #bfbfbf;
    min-width: 2em;
    padding: 0.4em;
    /* text-align: center; */
    /* vertical-align: bottom; */
    padding: 10px;
    min-width: 2em;
    padding: 0.4em;
    border: 1px solid hsl(0, 0%, 75%);
}
img{
  width: 100%;
}
</style>

<body>

    <header class="indexHeaderContainer">
        
    {{--end hamburger menu- button-logo   --}}
        <div style="height:100%;width:15%;display:flex;align-items:center;">
            <img src="{{asset('img/menu.png')}}" style="width: 28px;height:28px;margin-left:15px;cursor: pointer;" alt="">
            <a style="margin-left:15px;width: 48px;height:48px;" href=""><img src="{{asset('img/logo.png')}}"  style="width:48px;height:48px" alt="">
            </a>
           <a href="" style="text-decoration: none;color:#000" > <span style="margin-left:10px;font-size: 1.4em" >Docs</span></a>
        </div>
  {{-- end hamburger menu- button-logo  --}}

  {{-- search --}}
  <div class="search">
  {{-- <span >search</span> --}}
  <svg style="margin-left:15px;fill: #5f6368;" focusable="false" height="24px" viewBox="0 0 24 24" width="24px" xmlns="http://www.w3.org/2000/svg"><path d="M20.49,19l-5.73-5.73C15.53,12.2,16,10.91,16,9.5C16,5.91,13.09,3,9.5,3S3,5.91,3,9.5C3,13.09,5.91,16,9.5,16 c1.41,0,2.7-0.47,3.77-1.24L19,20.49L20.49,19z M5,9.5C5,7.01,7.01,5,9.5,5S14,7.01,14,9.5S11.99,14,9.5,14S5,11.99,5,9.5z"></path><path d="M0,0h24v24H0V0z" fill="none"></path></svg>
  <input class="inputSearch" type="search" placeholder="Search">
 </div>
 
  {{-- endsearh --}}

  {{-- right side --}}
  <div class="indexRightSide">
    <img src="{{asset('img/dots-menu.png')}}" style="width: 18px;height:18px;cursor: pointer;" alt="">  
 <div class="rightSideUser">
 @include('include.user')
 <input type="hidden" id="uid" value="{{Session::get('uid')}}">
</div>
{{--end USER  --}}
<div>

  {{-- end right side --}}
 
    </header>

    {{-- New document --}}
    <div  class="newDocument">

        <div style="width: 65%;height:15%;display:flex;align-items:center;justify-content:space-between" >
        <span style="font-size: 1.2em;color:#616161">Start a new document</span>
        <a href="javascript:void()" >
            <img src="{{asset('img/dot.png')}}" style="height: 24px;width:24px;margin-right:30px" alt="">
          </a>
        </div>

        <div class="newDocContainer"   >
         
            <div class="documentContainer"  onclick="newDoc('blank')">
               <div class="document" >
                    <img style="width: 100%;height:100%" src="https://ssl.gstatic.com/docs/templates/thumbnails/docs-blank-googlecolors.png" alt="">    
               </div>
                <span style="margin-left:5px;margin-top:5px;">Blank</span>
            </div>

            <div class="documentContainer" onclick="newDoc('spearmint')">
                <div class="document" style="padding: 10px" >
                        <table class="scaleFit"><tbody><tr><td style="padding:7.2pt;vertical-align:top;"><p><span style="background-color:transparent;color:#000000;"><strong>Your Name</strong></span></p><p><span style="background-color:transparent;color:#000000;">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</span></p></td><td style="padding:7.2pt;vertical-align:top;"><p><span style="background-color:transparent;color:#000000;">123 Your Street</span></p><p><span style="background-color:transparent;color:#000000;">Your City, ST 12345</span></p><p><span style="background-color:transparent;color:#000000;"><strong>(123) 456-7890</strong></span></p><p><span style="background-color:transparent;color:#000000;"><strong>no_reply@example.com</strong></span></p></td></tr><tr><td style="padding:7.2pt;vertical-align:top;"><h2><span style="background-color:transparent;color:#2079c7;"><strong>EXPERIENCE</strong></span></h2><h2><span style="background-color:transparent;color:#000000;"><strong>Company,&nbsp;</strong>Location —&nbsp;<i>Job Title</i></span></h2><h3><span style="background-color:transparent;color:#666666;">MONTH 20XX - PRESENT</span></h3><p><span style="background-color:transparent;color:#666666;">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.</span></p><h2><span style="background-color:transparent;color:#000000;"><strong>Company,&nbsp;</strong>Location —&nbsp;<i>Job Title</i></span></h2><h3><span style="background-color:transparent;color:#666666;">MONTH 20XX - MONTH 20XX</span></h3><p><span style="background-color:transparent;color:#666666;">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.</span></p><h2><span style="background-color:transparent;color:#000000;"><strong>Company,&nbsp;</strong>Location<strong>&nbsp;</strong>—&nbsp;<i>Job Title</i></span></h2><h3><span style="background-color:transparent;color:#666666;">MONTH 20XX - MONTH 20XX</span></h3><p><span style="background-color:transparent;color:#666666;">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.</span></p><h2><span style="background-color:transparent;color:#2079c7;"><strong>EDUCATION</strong></span></h2><h2><span style="background-color:transparent;color:#000000;"><strong>School Name,&nbsp;</strong>Location —&nbsp;<i>Degree</i></span></h2><h3><span style="background-color:transparent;color:#666666;">MONTH 20XX - MONTH 20XX</span></h3><p><span style="background-color:transparent;color:#666666;">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore.</span></p><h2><span style="background-color:transparent;color:#000000;"><strong>School Name,&nbsp;</strong>Location —&nbsp;<i>Degree</i></span></h2><h3><span style="background-color:transparent;color:#666666;">MONTH 20XX - MONTH 20XX</span></h3><p><span style="background-color:transparent;color:#666666;">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam.</span></p><h2><span style="background-color:transparent;color:#2079c7;"><strong>PROJECTS</strong></span></h2><h2><span style="background-color:transparent;color:#000000;"><strong>Project Name&nbsp;</strong>—&nbsp;<i>Detail</i></span></h2><p><span style="background-color:transparent;color:#666666;">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</span></p></td><td style="padding:7.2pt;vertical-align:top;"><h2><span style="background-color:transparent;color:#2079c7;"><strong>SKILLS</strong></span></h2><ul><li><span style="background-color:transparent;color:#666666;">Lorem ipsum dolor sit amet.</span></li><li><span style="background-color:transparent;color:#666666;">Consectetuer adipiscing elit.</span></li><li><span style="background-color:transparent;color:#666666;">Sed diam nonummy nibh euismod tincidunt.</span></li><li><span style="background-color:transparent;color:#666666;">L​​​‌​aoreet dolore magna aliquam erat volutpat.</span></li></ul><h2><span style="background-color:transparent;color:#2079c7;"><strong>AWARDS</strong></span></h2><p><span style="background-color:transparent;color:#666666;"><strong>Lorem ipsum</strong>&nbsp;<strong>dolor sit</strong> amet Consectetuer adipiscing elit, Sed diam nonummy</span></p><p><span style="background-color:transparent;color:#666666;"><strong>Nibh euismod tincidunt</strong> ut laoreet dolore magna aliquam erat volutpat.</span></p><p><span style="background-color:transparent;color:#666666;"><strong>Lorem ipsum dolor sit</strong> amet Consectetuer adipiscing elit, Sed diam nonummy</span></p><p><span style="background-color:transparent;color:#666666;"><strong>Nibh euismod tincidunt</strong> ut laoreet dolore magna aliquam erat volutpat.</span></p><h2><span style="background-color:transparent;color:#2079c7;"><strong>LANGUAGES</strong></span></h2><p><span style="background-color:transparent;color:#666666;">Lorem ipsum, Dolor sit amet, Consectetuer</span></p></td></tr></tbody></table>
                </div>
              <span style="margin-left:5px;margin-top:5px;">Resume</span>
              <span style="margin-left:5px;font-size:0.9em;color:#5f6368">Spearmint</span>

             </div>
             
             <div class="documentContainer" onclick="newDoc('coral')">
                <div class="document" style="padding: 10px">
                    <div class="scaleFit">
                        <p ><span style="background-color:transparent;color:#f75d5d;"><strong>Hello</strong></span><br><span style="background-color:transparent;color:#000000;"><strong>I’m Your Name</strong></span></p><p><span style="background-color:transparent;color:#000000;">123 YOUR STREET</span></p><p><span style="background-color:transparent;color:#000000;">YOUR CITY, ST 12345</span></p><p><span style="background-color:transparent;color:#000000;"><strong>(123) 456-7890</strong></span></p><p><span style="background-color:transparent;color:#000000;"><strong>NO_REPLY@EXAMPLE.COM</strong></span></p><h2><span style="background-color:transparent;color:#f75d5d;"><strong>Skills</strong></span></h2><p><span style="background-color:transparent;color:#000000;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ac interdum nisi. Sed in consequat mi. Sed pulvinar lacinia felis eu finibus.</span></p><h2><span style="background-color:transparent;color:#f75d5d;"><strong>Experience</strong></span></h2><h2 style="margin-left:-0.75pt;"><span style="background-color:transparent;color:#666666;">MONTH 20XX - PRESENT</span></h2><h3 style="margin-left:-0.75pt;"><span style="background-color:transparent;color:#000000;"><strong>Company Name, Location</strong><i> - Job Title</i></span></h3><ul><li><span style="background-color:transparent;color:#000000;">Lorem ipsum dolor sit amet, consectetur adipiscing elit.&nbsp;</span></li><li><span style="background-color:transparent;color:#000000;">Aenean ac interdum nisi. Sed in consequat mi.</span></li><li><span style="background-color:transparent;color:#000000;">Sed in consequat mi, sed pulvinar lacinia felis eu finibus.</span></li></ul><h2 style="margin-left:-0.75pt;"><span style="background-color:transparent;color:#666666;">MONTH 20XX - MONTH 20XX</span></h2><h3 style="margin-left:-0.75pt;"><span style="background-color:transparent;color:#000000;"><strong>Company Name, Location</strong><i> - Job Title</i></span></h3><ul><li><span style="background-color:transparent;color:#000000;">Lorem ipsum dolor sit amet, consectetur adipiscing elit.&nbsp;</span></li><li><span style="background-color:transparent;color:#000000;">Aenean ac interdum nisi. Sed in consequat mi.&nbsp;</span></li></ul><h2 style="margin-left:-0.75pt;"><span style="background-color:transparent;color:#666666;">MONTH 20XX - MONTH 20XX</span></h2><h3 style="margin-left:-0.75pt;"><span style="background-color:transparent;color:#000000;"><strong>Company Name, Location</strong><i> - Job Title</i></span></h3><ul><li><span style="background-color:transparent;color:#000000;">Lorem ipsum dolor sit amet, consectetur adipiscing elit.&nbsp;</span></li><li><span style="background-color:transparent;color:#000000;">Aenean ac interdum nisi. Sed in consequat mi.&nbsp;</span></li><li><span style="background-color:transparent;color:#000000;">Sed pulvinar lacinia felis eu finibus.&nbsp;</span></li></ul><h2><span style="background-color:transparent;color:#f75d5d;"><strong>Education</strong></span></h2><h2 style="margin-left:-0.75pt;"><span style="background-color:transparent;color:#666666;">MONTH&nbsp; 20XX - MONTH 20XX</span></h2><h3 style="margin-left:-0.75pt;"><span style="background-color:transparent;color:#000000;"><strong>College Name, Location</strong><i> - Degree</i></span></h3><p><span style="background-color:transparent;color:#000000;">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore.</span></p><h2><span style="background-color:transparent;color:#f75d5d;"><strong>Awards</strong></span></h2><p><span style="background-color:transparent;color:#000000;">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span></p><p><span style="background-color:transparent;color:#000000;">Aenean ac interdum nisi.&nbsp;</span></p><p><br><br data-cke-filler="true"></p>
                    </div>
                  </div>
              <span style="margin-left:5px;margin-top:5px;">Resume</span>
              <span style="margin-left:5px;font-size:0.9em;color:#5f6368">Coral</span>
             </div>

             {{-- <div class="documentContainer" onclick="newDoc('luxe')">
                <div class="document" style="padding: 10px">
                    <div class="scaleFit">
                      <p style="margin-left:-0.75pt;"><span style="background-color:transparent;color:#666666;">COURSE NAME</span></p><p><span style="background-color:transparent;color:#000000;"><strong>REPORT TITLE</strong></span></p><p style="margin-left:-0.75pt;"><span style="background-color:transparent;color:#000000;">LOREM IPSUM DOLOR SIT AMET</span></p><p style="margin-left:-0.75pt;"><span style="background-color:transparent;color:#000000;"><span class="image-inline ck-widget ck-widget_with-resizer" contenteditable="false"><img style="width: 100%" src="https://lh5.googleusercontent.com/neE0O6jfiBiOePAVbzWLSZujosFgn_hN8PTkPXGhKjDM7VuaUVYzEO8TApMdbtLgoaeLddu2wrTyxmPcoEbcqo0KVXuIK7FlDDZCjgDIOAEf46PyYuvmNFWIMZpeLj4xw_eZ6bpC0422qhPaXw"><div class="ck ck-reset_all ck-widget__resizer" style="display: none;"><div class="ck-widget__resizer__handle ck-widget__resizer__handle-top-left"></div><div class="ck-widget__resizer__handle ck-widget__resizer__handle-top-right"></div><div class="ck-widget__resizer__handle ck-widget__resizer__handle-bottom-right"></div><div class="ck-widget__resizer__handle ck-widget__resizer__handle-bottom-left"></div><div class="ck ck-size-view" style="display: none;"></div></div></span></span></p><h2 style="margin-left:-0.75pt;"><span style="background-color:transparent;color:#000000;"><span class="image-inline ck-widget ck-widget_with-resizer" contenteditable="false"><img style="width: 100%" src="https://lh6.googleusercontent.com/nPF5YCNBSZEDQAQ2W-yzyG4B0eom-tnTKmSDZmPKbKfjoTWityMgvKL7YHn1Jw9ugQMIRNgRDh1O_zNFGNwc5ZuAC5kikUT6gzTY_IV0GjPZYOlGelNtuoo9Z8gGZxdYEzcYjQszB2kclJNEiw"><div class="ck ck-reset_all ck-widget__resizer" style="display: none;"><div class="ck-widget__resizer__handle ck-widget__resizer__handle-top-left"></div><div class="ck-widget__resizer__handle ck-widget__resizer__handle-top-right"></div><div class="ck-widget__resizer__handle ck-widget__resizer__handle-bottom-right"></div><div class="ck-widget__resizer__handle ck-widget__resizer__handle-bottom-left"></div><div class="ck ck-size-view" style="display: none;"></div></div></span></span></h2><h2 style="margin-left:-0.75pt;"><span style="background-color:transparent;color:#000000;"><strong>Introduction</strong></span></h2><p style="margin-left:-0.75pt;"><span style="background-color:transparent;color:#000000;">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan.</span></p><h2 style="margin-left:-0.75pt;"><span style="background-color:transparent;color:#000000;"><strong>Lorem ipsum</strong></span></h2><p style="margin-left:-0.75pt;"><span style="background-color:transparent;color:#000000;">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius.</span></p><p style="margin-left:-0.75pt;"><span style="background-color:transparent;color:#000000;">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</span></p><h3 style="margin-left:-0.75pt;"><span style="background-color:transparent;color:#8c7252;"><strong>Dolor sit amet</strong></span></h3><p style="margin-left:-0.75pt;"><span style="background-color:transparent;color:#000000;">Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan.</span></p><p><br><br data-cke-filler="true"></p>
                    </div>
                  </div>
              <span style="margin-left:5px;margin-top:5px;">Report</span>
              <span style="margin-left:5px;font-size:0.9em;color:#5f6368">Luxe</span>
             </div> --}}
             
        </div>


    </div>
    {{-- end New document --}}

    {{-- user document --}}
    <div class="userDoc">
        <div style="width: 65%;display:flex;align-items:center;justify-content:space-between;margin-top:25px" >
            <span style="font-size: 1.2em;color:#616161">Recent document</span>
            <a href="javascript:void()" >
                <img src="{{asset('img/folder.png')}}" style="height: 24px;width:24px;margin-right:30px" alt="">
              </a>
            </div>
    
            <div style="width: 65%;display:flex;flex-wrap:wrap;margin-bottom:30px">
            @if($lastDocsData!=null)
            @foreach ($lastDocsData as $i=>$doc)
                <div  class="userDocContainer" >
                   <div onclick="docOpen('{{$docsData[$i]['docsId']}}')" class="userDocument"  href="javascript:void()">
                    <div class="userScaleFit">
                      @php
                      echo $doc['data']
                      @endphp
                    </div>
                   </div>
                   {{-- bar --}}
                   <div style="border-top: 1px hsl( 0,0%,82.7% ) solid !important;z-index:999;padding:10px;background-color:#fff">
                    <div class="userDocBar" onclick="docOpen('{{$docsData[$i]['docsId']}}')" id="title{{$docsData[$i]['docsId']}}" >{{$docsData[$i]['title']}}</div>

                    <div  style="display:flex;justify-content:space-between;align-items:center" >

                    <div  onclick="docOpen('{{$docsData[$i]['docsId']}}')" style="display: flex;justify-content:center;">
                    <img src="{{asset('img/logo.png')}}" style="width: 24px;height:22px" alt=""> 
                    <span style="margin-left:5px;color:#80868b">
                       {{-- @php echo \Carbon\Carbon::createFromTimeStamp(strtotime($docsData[$i]['created_at']))->toDateTimeString() @endphp --}}
                       @php echo \Carbon\Carbon::createFromTimeStamp(strtotime($docsData[$i]['created_at']))->diffForHumans() @endphp
                      </span>
                    </div>

                     <a  class="test" href="javascript:void()" type="button" id="defaultDropdown" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                       <img src="{{asset('img/dot.png')}}" style="width: 18px;height:18px;" alt="">
                      </a> 
                      <ul class="dropdown-menu" aria-labelledby="defaultDropdown">
                        <li><a data-bs-toggle="modal" data-bs-target="#renameModal{{$docsData[$i]['docsId']}}" style="display: flex;align-items:center" class="dropdown-item" href="javascript:void()"><img src="{{asset('img/font.png')}}" style="width: 24px;height:24px;margin-right:10px" alt=""> Rename</a></li>
                        <li><a data-bs-toggle="modal" data-bs-target="#deleteModal{{$docsData[$i]['docsId']}}" style="display: flex;align-items:center" class="dropdown-item" href="javascript:void()"><img src="{{asset('img/remove.png')}}" style="width: 24px;height:24px;margin-right:10px" alt="">Remove</a></li>
                        <li><a style="display: flex;align-items:center" class="dropdown-item" href="{{route('docs',$docsData[$i]['docsId'])}}" target="_blank" ><img src="{{asset('img/expand.png')}}" style="width: 24px;height:24px;margin-right:10px" alt="">Open in new tab</a></li>
                      </ul>

                  </div>

                   </div>
                  {{--end bar  --}}

                </div>

  {{-- delete Modal --}}
    <div class="modal fade" id="deleteModal{{$docsData[$i]['docsId']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Move to trash?</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form>
              <div class="mb-3">
                <label>"{{$docsData[$i]['title']}}" will be moved to Drive trash and deleted.</label>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" onclick="deleteDocs(`{{$docsData[$i]['docsId']}}`)"  class="btn btn-primary">MOVE TO TRASH</button>
          </div>
        </div>
      </div>
    </div>
    {{--end delete Modal  --}}

    {{-- rename modal --}}
    <div class="modal fade" id="renameModal{{$docsData[$i]['docsId']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Rename</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form>
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Please enter a new name for the item:</label>
                <br>
                <input type="text" class="form-control" id="input{{$docsData[$i]['docsId']}}" value="{{$docsData[$i]['title']}}">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" onclick="changeTitle(`{{$docsData[$i]['docsId']}}`)"  class="btn btn-primary">SAVE</button>
          </div>
        </div>
      </div>
    </div>
    {{-- endrename modal --}}

                @endforeach
                @endif
            </div>
    </div>

    @include('include/load')

    {{-- end user document --}}

</body>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>

<link href="{{asset('css/toastr.css')}}" rel="stylesheet">
<script src="{{asset('js/toastr.min.js')}}"></script>

<script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-app.js" ></script>
<script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-database.js" ></script>
<script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-auth.js" ></script>

<script src="{{asset('js/config.js')}}"></script>

{{-- <script type="module">
import {getAuth } from 'https://www.gstatic.com/firebasejs/9.6.10/firebase-auth.js'
import { getDatabase,ref,set,child,update,push,get  } from "https://www.gstatic.com/firebasejs/9.6.10/firebase-database.js";
import { initializeApp } from 'https://www.gstatic.com/firebasejs/9.6.10/firebase-app.js'
</script> --}}


<script>


  var db=firebase.database();

  function newDoc(id)
  {
    var load=document.getElementById('loading-wrapper');
              load.style.display="block";
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });
     
     var data;
     var title;
     var uid=document.getElementById('uid');
     var pushId = db.ref().push().key;
     var dataPushId = db.ref().push().key;

    if(id=="blank")
    {
    data="Blank Template";
    title="Untitled document";
    }
    else if(id=="spearmint")
    {
      data="<table><tbody><tr><td style='padding:7.2pt;vertical-align:top;'><p><span style='background-color:transparent;color:#000000;'><strong>Your Name</strong></span></p><p><span style='background-color:transparent;color:#000000;'>Lorem ipsum dolor sit amet, consectetuer adipiscing elit</span></p></td><td style='padding:7.2pt;vertical-align:top;'><p><span style='background-color:transparent;color:#000000;'>123 Your Street</span></p><p><span style='background-color:transparent;color:#000000;'>Your City, ST 12345</span></p><p><span style='background-color:transparent;color:#000000;'><strong>(123) 456-7890</strong></span></p><p><span style='background-color:transparent;color:#000000;'><strong>no_reply@example.com</strong></span></p></td></tr><tr><td style='padding:7.2pt;vertical-align:top;'><h2><span style='background-color:transparent;color:#2079c7;'><strong>EXPERIENCE</strong></span></h2><h2><span style='background-color:transparent;color:#000000;'><strong>Company,&nbsp;</strong>Location —&nbsp;<i>Job Title</i></span></h2><h3><span style='background-color:transparent;color:#666666;'>MONTH 20XX - PRESENT</span></h3><p><span style='background-color:transparent;color:#666666;'>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.</span></p><h2><span style='background-color:transparent;color:#000000;'><strong>Company,&nbsp;</strong>Location —&nbsp;<i>Job Title</i></span></h2><h3><span style='background-color:transparent;color:#666666;'>MONTH 20XX - MONTH 20XX</span></h3><p><span style='background-color:transparent;color:#666666;'>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.</span></p><h2><span style='background-color:transparent;color:#000000;'><strong>Company,&nbsp;</strong>Location<strong>&nbsp;</strong>—&nbsp;<i>Job Title</i></span></h2><h3><span style='background-color:transparent;color:#666666;'>MONTH 20XX - MONTH 20XX</span></h3><p><span style='background-color:transparent;color:#666666;'>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.</span></p><h2><span style='background-color:transparent;color:#2079c7;'><strong>EDUCATION</strong></span></h2><h2><span style='background-color:transparent;color:#000000;'><strong>School Name,&nbsp;</strong>Location —&nbsp;<i>Degree</i></span></h2><h3><span style='background-color:transparent;color:#666666;'>MONTH 20XX - MONTH 20XX</span></h3><p><span style='background-color:transparent;color:#666666;'>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore.</span></p><h2><span style='background-color:transparent;color:#000000;'><strong>School Name,&nbsp;</strong>Location —&nbsp;<i>Degree</i></span></h2><h3><span style='background-color:transparent;color:#666666;'>MONTH 20XX - MONTH 20XX</span></h3><p><span style='background-color:transparent;color:#666666;'>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam.</span></p><h2><span style='background-color:transparent;color:#2079c7;'><strong>PROJECTS</strong></span></h2><h2><span style='background-color:transparent;color:#000000;'><strong>Project Name&nbsp;</strong>—&nbsp;<i>Detail</i></span></h2><p><span style='background-color:transparent;color:#666666;'>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</span></p></td><td style='padding:7.2pt;vertical-align:top;'><h2><span style='background-color:transparent;color:#2079c7;'><strong>SKILLS</strong></span></h2><ul><li><span style='background-color:transparent;color:#666666;'>Lorem ipsum dolor sit amet.</span></li><li><span style='background-color:transparent;color:#666666;'>Consectetuer adipiscing elit.</span></li><li><span style='background-color:transparent;color:#666666;'>Sed diam nonummy nibh euismod tincidunt.</span></li><li><span style='background-color:transparent;color:#666666;'>L​​​‌​aoreet dolore magna aliquam erat volutpat.</span></li></ul><h2><span style='background-color:transparent;color:#2079c7;'><strong>AWARDS</strong></span></h2><p><span style='background-color:transparent;color:#666666;'><strong>Lorem ipsum</strong>&nbsp;<strong>dolor sit</strong> amet Consectetuer adipiscing elit, Sed diam nonummy</span></p><p><span style='background-color:transparent;color:#666666;'><strong>Nibh euismod tincidunt</strong> ut laoreet dolore magna aliquam erat volutpat.</span></p><p><span style='background-color:transparent;color:#666666;'><strong>Lorem ipsum dolor sit</strong> amet Consectetuer adipiscing elit, Sed diam nonummy</span></p><p><span style='background-color:transparent;color:#666666;'><strong>Nibh euismod tincidunt</strong> ut laoreet dolore magna aliquam erat volutpat.</span></p><h2><span style='background-color:transparent;color:#2079c7;'><strong>LANGUAGES</strong></span></h2><p><span style='background-color:transparent;color:#666666;'>Lorem ipsum, Dolor sit amet, Consectetuer</span></p></td></tr></tbody></table>";
      title="Spearmint";
   
    }
    else if(id=="coral")
    {
      data="<p><span style='background-color:transparent;color:#f75d5d;'><strong>Hello</strong></span><br><span style='background-color:transparent;color:#000000;'><strong>I’m Your Name</strong></span></p><p><span style='background-color:transparent;color:#000000;'>123 YOUR STREET</span></p><p><span style='background-color:transparent;color:#000000;'>YOUR CITY, ST 12345</span></p><p><span style='background-color:transparent;color:#000000;'><strong>(123) 456-7890</strong></span></p><p><span style='background-color:transparent;color:#000000;'><strong>NO_REPLY@EXAMPLE.COM</strong></span></p><h2><span style='background-color:transparent;color:#f75d5d;'><strong>Skills</strong></span></h2><p><span style='background-color:transparent;color:#000000;'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ac interdum nisi. Sed in consequat mi. Sed pulvinar lacinia felis eu finibus.</span></p><h2><span style='background-color:transparent;color:#f75d5d;'><strong>Experience</strong></span></h2><h2 style='margin-left:-0.75pt;'><span style='background-color:transparent;color:#666666;'>MONTH 20XX - PRESENT</span></h2><h3 style='margin-left:-0.75pt;'><span style='background-color:transparent;color:#000000;'><strong>Company Name, Location</strong><i> - Job Title</i></span></h3><ul><li><span style='background-color:transparent;color:#000000;'>Lorem ipsum dolor sit amet, consectetur adipiscing elit.&nbsp;</span></li><li><span style='background-color:transparent;color:#000000;'>Aenean ac interdum nisi. Sed in consequat mi.</span></li><li><span style='background-color:transparent;color:#000000;'>Sed in consequat mi, sed pulvinar lacinia felis eu finibus.</span></li></ul><h2 style='margin-left:-0.75pt;'><span style='background-color:transparent;color:#666666;'>MONTH 20XX - MONTH 20XX</span></h2><h3 style='margin-left:-0.75pt;'><span style='background-color:transparent;color:#000000;'><strong>Company Name, Location</strong><i> - Job Title</i></span></h3><ul><li><span style='background-color:transparent;color:#000000;'>Lorem ipsum dolor sit amet, consectetur adipiscing elit.&nbsp;</span></li><li><span style='background-color:transparent;color:#000000;'>Aenean ac interdum nisi. Sed in consequat mi.&nbsp;</span></li></ul><h2 style='margin-left:-0.75pt;'><span style='background-color:transparent;color:#666666;'>MONTH 20XX - MONTH 20XX</span></h2><h3 style='margin-left:-0.75pt;'><span style='background-color:transparent;color:#000000;'><strong>Company Name, Location</strong><i> - Job Title</i></span></h3><ul><li><span style='background-color:transparent;color:#000000;'>Lorem ipsum dolor sit amet, consectetur adipiscing elit.&nbsp;</span></li><li><span style='background-color:transparent;color:#000000;'>Aenean ac interdum nisi. Sed in consequat mi.&nbsp;</span></li><li><span style='background-color:transparent;color:#000000;'>Sed pulvinar lacinia felis eu finibus.&nbsp;</span></li></ul><h2><span style='background-color:transparent;color:#f75d5d;'><strong>Education</strong></span></h2><h2 style='margin-left:-0.75pt;'><span style='background-color:transparent;color:#666666;'>MONTH&nbsp; 20XX - MONTH 20XX</span></h2><h3 style='margin-left:-0.75pt;'><span style='background-color:transparent;color:#000000;'><strong>College Name, Location</strong><i> - Degree</i></span></h3><p><span style='background-color:transparent;color:#000000;'>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore.</span></p><h2><span style='background-color:transparent;color:#f75d5d;'><strong>Awards</strong></span></h2><p><span style='background-color:transparent;color:#000000;'>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span></p><p><span style='background-color:transparent;color:#000000;'>Aenean ac interdum nisi.&nbsp;</span></p><p><br><br data-cke-filler='true'></p>";
      title="Coral";

    }
    else if(id=='luxe')
    {
    data="<p style='margin-left:-0.75pt;'><span style='background-color:transparent;color:#666666;'>COURSE NAME</span></p><p><span style='background-color:transparent;color:#000000;'><strong>REPORT TITLE</strong></span></p><p style='margin-left:-0.75pt;'><span style='background-color:transparent;color:#000000;'>LOREM IPSUM DOLOR SIT AMET</span></p><p style='margin-left:-0.75pt;'><span style='background-color:transparent;color:#000000;'><span class='image-inline ck-widget ck-widget_with-resizer' contenteditable='false'><img style='width: 100%' src='https://lh5.googleusercontent.com/neE0O6jfiBiOePAVbzWLSZujosFgn_hN8PTkPXGhKjDM7VuaUVYzEO8TApMdbtLgoaeLddu2wrTyxmPcoEbcqo0KVXuIK7FlDDZCjgDIOAEf46PyYuvmNFWIMZpeLj4xw_eZ6bpC0422qhPaXw'><div class='ck ck-reset_all ck-widget__resizer' style='display: none;'><div class='ck-widget__resizer__handle ck-widget__resizer__handle-top-left'></div><div class='ck-widget__resizer__handle ck-widget__resizer__handle-top-right'></div><div class='ck-widget__resizer__handle ck-widget__resizer__handle-bottom-right'></div><div class='ck-widget__resizer__handle ck-widget__resizer__handle-bottom-left'></div><div class='ck ck-size-view' style='display: none;'></div></div></span></span></p><h2 style='margin-left:-0.75pt;'><span style='background-color:transparent;color:#000000;'><span class='image-inline ck-widget ck-widget_with-resizer' contenteditable='false'><img style='width: 100%' src='https://lh6.googleusercontent.com/nPF5YCNBSZEDQAQ2W-yzyG4B0eom-tnTKmSDZmPKbKfjoTWityMgvKL7YHn1Jw9ugQMIRNgRDh1O_zNFGNwc5ZuAC5kikUT6gzTY_IV0GjPZYOlGelNtuoo9Z8gGZxdYEzcYjQszB2kclJNEiw'><div class='ck ck-reset_all ck-widget__resizer' style='display: none;'><div class='ck-widget__resizer__handle ck-widget__resizer__handle-top-left'></div><div class='ck-widget__resizer__handle ck-widget__resizer__handle-top-right'></div><div class='ck-widget__resizer__handle ck-widget__resizer__handle-bottom-right'></div><div class='ck-widget__resizer__handle ck-widget__resizer__handle-bottom-left'></div><div class='ck ck-size-view' style='display: none;'></div></div></span></span></h2><h2 style='margin-left:-0.75pt;'><span style='background-color:transparent;color:#000000;'><strong>Introduction</strong></span></h2><p style='margin-left:-0.75pt;'><span style='background-color:transparent;color:#000000;'>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan.</span></p><h2 style='margin-left:-0.75pt;'><span style='background-color:transparent;color:#000000;'><strong>Lorem ipsum</strong></span></h2><p style='margin-left:-0.75pt;'><span style='background-color:transparent;color:#000000;'>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius.</span></p><p style='margin-left:-0.75pt;'><span style='background-color:transparent;color:#000000;'>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</span></p><h3 style='margin-left:-0.75pt;'><span style='background-color:transparent;color:#8c7252;'><strong>Dolor sit amet</strong></span></h3><p style='margin-left:-0.75pt;'><span style='background-color:transparent;color:#000000;'>Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan.</span></p><p><br><br data-cke-filler='true'></p>";
    title="Luxe";
   }

    $.ajax({
            method: "post",
            type: "post",
            url: '{{route('addDocs')}}',
            data: {"data":data,"title":title,"pushId":pushId,"dataPushId":dataPushId},
            success: function (response) {
             window.location.href =`docs/${pushId}`;
            },
            error:function (error)
            {

            }
        });

  }
</script>

<script>
  function docOpen(id)
  {
    var load=document.getElementById('loading-wrapper');
              load.style.display="block";
    window.location.href =`docs/${id}`;
  }
</script>

<script>
      $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });
</script>

<script>
  function changeTitle(id)
  {
   
    var title=document.getElementById('input'+id).value;

     $.ajax({
            method: "post",
            type: "post",
            url: '{{route('changeTitle')}}',
            data: {'docsId':id,'title':title},
            success: function (response) {

          var docTitle=document.getElementById('title'+id);
            docTitle.innerText=title;
            $('#renameModal'+id).modal('toggle');
            toastr.success("Title has been changed!",'INFO!',({ "closeButton": false,
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
            },
            error:function (error)
            {
            }
           });       

  }
</script>

<script>
  function deleteDocs(id)
  {
    $.ajax({
            method: "post",
            type: "post",
            url: '{{route('deleteDocs')}}',
            data: {'docsId':id},
            success: function (response) {
              $('#deleteModal'+id).modal('toggle');
              location.reload();
            },
            error:function (error)
            {
            }
           });       



  }
</script>

</html>
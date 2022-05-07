 
<div>
     <a  style="cursor: pointer" id="dropdownMenuClickableInside"  @if($user['uid']!=null) data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false" @else href="{{route('login')}}" @endif>
     <img style="width: 42px;height:42px;border-radius:50%;"  @if($user['uid']!=null) src='{{asset($user["pp"])}}'  referrerpolicy="no-referrer" @else src="{{asset('img/user.png')}}" @endif alt="">
   </a>

    <ul  class="dropdown-menu" aria-labelledby="dropdownMenuClickableInside">

     <div class="card" style="width: 18rem;border:0 !important;">
       <div style="display: flex;flex-wrap:wrap">
         <div style="width: 100%;height:25%;display: flex;justify-content:center;padding:10px 0;">
           <a href="">
           <img style="width: 64px;height:64px;border-radius:50%;" src="{{asset($user['pp'])}}" 
            alt="">
         </a>
         </div>
         <div style="width: 100%;height:25%;">
           <a style="text-decoration: none;color:black" href=""><h5 style="text-align: center;">{{$user['name']}}</h5></a>
           <p  style="text-align: center" class="card-text">{{$user['email']}}</p>
         </div>
         <div style="width: 100%;height:25%;text-align: center;border-top: 1px hsl( 0,0%,82.7% ) solid !important;margin-top:10px">
        <form action="{{route('signOut')}}" method="POST"> @csrf 
          <button type="submit" style="margin-top:10px" type="button" class="btn btn-primary">Sign out</button>
         </form> 

         </div>
         <div>
         </div>
       </div>
     </div>

    </ul>
</div>



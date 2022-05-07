<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Kreait\Firebase\Contract\Database;
use \Kreait\Firebase\Contract\Auth;
use \Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Str;



class dbController extends Controller
{
    public $start;
    public function __construct(Database $database,Auth $auth)
    {
        $this->database = $database;
        $this->auth = $auth;
        // $time=Carbon::now();
        // $this->start  = new Carbon($time);
        // Session::put('startDate',$time);
    }

    public function ckeditor()
    {
        return view('ckeditor');
    }

    public function routeControl($id)
    {
        return redirect()->to('/');
    }
    
    public function index()
    {
        $control=$this->database->getReference('docs/-N1AIYF0fqkbYBhOTy98')->getSnapshot()->getValue();
        if(Session::get('uid')!=null)
        {
            $data['user']=['uid'=>Session::get('uid'),'email'=>Session::get('email'),'name'=>Session::get('name'),'pp'=>Session::get('pp'),'docs'=>Session::get('docs')];
            // dd($data['user']['docs']);
            $userDocs=$data['user']['docs'];
            $data['docsData']=[];
            $data['lastDocsData']=[];
            if($userDocs!=null)
            foreach ($userDocs as $key => $doc) {
                if($doc!= null)
                {
                    $dbDoc=$this->database->getReference('docs/'.$doc)->getSnapshot()->getValue();
                    if($dbDoc!=null && $dbDoc['stat'] == "1")
                    {
                        array_push($data['docsData'],$this->database->getReference('docs/'.$doc)->getSnapshot()->getValue());
                        array_push($data['lastDocsData'],$this->database->getReference('lastDocsData/'.$doc)->getSnapshot()->getValue());
                    }
                }
              
            }
            $data['docsData'] = array_reverse($data['docsData']);
            $data['lastDocsData'] = array_reverse($data['lastDocsData']);

            return view('index',$data);
        }
        else
        return redirect()->to('login');
    }

    public function index2()
    {
        return view('index2');
    }

    public function kayit()
    {
        return view('test');
    }

    public function login()
    {
        if(Session::get('uid')==null)
        return view('login');
        else
        return redirect()->to('/');

    }

    public function signUp()
    {
        if(Session::get('uid')==null)
        return view('sign-up');
        else
        return redirect()->to('/');
    }

    public function test()
    {
        
        $this->database->getReference('config/website/name')->set('New name');

        $data['data']='yok';
        return view('index',$data);
        
    }

    public function sendData(Request $request)
    {

        $this->database->getReference('test')->set($request->data);

        return response()->json('test');

    }

    public function loginRequest(Request $request)
    {
        if($request->stat==0)
        {
            Session::put('uid',$request['uid']);
            Session::put('email',$request->email);
            Session::put('name',$request->name);
            Session::put('docs',$request->docs);
            Session::put('pp',$request->pp);
            return response()->json($request);
        }
        else if($request->stat==1)
        {
        $time=Carbon::now();

            $this->database->getReference('users/'.$request['uid'])->set([
                'uid' => $request['uid'],
                'email' => $request->email,
                'name' => $request->name,
                'pp'=>$request->pp,
                'created_at'=>$time,
               ]);
            Session::put('uid',$request['uid']);
            Session::put('email',$request->email);
            Session::put('name',$request->name);
            Session::put('docs',$request->docs);
            Session::put('pp',$request->pp);
               
        }
        Session::put('asd',$request->stat);
            return response()->json($request);
        

    }
  
    public function signUpRequest(Request $request)
    {
        $time=Carbon::now();
        $this->database->getReference('users/'.$request['uid'])->set([
       'uid' => $request['uid'],
       'email' => $request->email,
       'name' => $request->name,
       'pp'=>'img/user.png',
       'created_at'=>$time,
      ]);

        Session::put('uid',$request['uid']);
        Session::put('email',$request->email);
        Session::put('name',$request->name);
        Session::put('pp',$request->pp);
        return response()->json($request);
    }
 
    public function signOut()
    {
        Session::forget('uid');
        Session::forget('email');
        Session::forget('name');
        Session::forget('pp');
        Session::forget('docs');
        Session::forget('startDate');
        Session::flush();
        return redirect()->to('login');
    }
   
    public function docs($docsId)
    {
       $control=$this->database->getReference('docs/'.$docsId)->getSnapshot()->getValue();
       $uid=Session::get('uid');
       $data['docsId']=$docsId;      
       //owner Id
       //perm==0  read-write-update
       //perm==1 read-write
       //perm==2 read

       
       if($control==null || $control['stat']==0)
        {
            return view('remove');
            //404
            // return redirect()->to('/');
        }
       else if($control['ownerId']==$uid || $control['ownerId']=="public")
       {
           $data['docsData']=$this->database->getReference('docsData/'.$docsId)->getSnapshot()->getValue();
           $data['lastDocsData']=$this->database->getReference('lastDocsData/'.$docsId)->getSnapshot()->getValue();
           $data['perm']=0;

           if($uid==null)
           $data['userControl']=1;
           else
           $data['userControl']=0;
           

           $data['title'] = $control['title'];

       }
       else
       {
        $data['userControl']=0;

        $data['title'] = $control['title'];
       $indexRead=array_search($uid,$control['read']);
       $indexWrite=array_search($uid,$control['write']);
       
       if($indexRead==false)
       $indexRead=array_search("public",$control['read']);
       
       if($indexWrite==false)
       $indexWrite=array_search("public",$control['write']);


       if($indexRead!=false && $indexWrite!=false)
       { 
           $data['perm']=1;
           $data['lastDocsData']=$this->database->getReference('lastDocsData/'.$docsId)->getSnapshot()->getValue();
           $data['docsData']=$this->database->getReference('docsData/'.$docsId)->getSnapshot()->getValue();

        //    dd("read-write");
       }
       else if($indexRead!=false )
       {
           $data['perm']=2;
           $data['lastDocsData']=$this->database->getReference('lastDocsData/'.$docsId)->getSnapshot()->getValue();
           $data['docsData']=$this->database->getReference('docsData/'.$docsId)->getSnapshot()->getValue();

        //    dd("only read");
       }
    //    else if($indexWrite!=false )
    //    {
    //        dd("only write");
    //    }
       else
       {
         
        return view('permission');

       }
       
       }
       

       $write=$control['write'];
       $read=$control['read'];
       $data['sharedUsers']=[]; 
       $data['sharedUserId']=[];
       foreach($write as  $uid)
       {
           $userInfo=$this->database->getReference('users/'.$uid)->getSnapshot()->getValue();
           if($uid!="public")
           {
               array_push($data['sharedUsers'],array('uid'=>$userInfo['uid'],'name'=>$userInfo['name'],'email'=>$userInfo['email'],'pp'=>$userInfo['pp'],'stat'=>'write'));
               array_push($data['sharedUserId'],$uid);
           }
           else
           {
               array_push($data['sharedUsers'],array('uid'=>"Public",'name'=>"Public",'email'=>"Public",'pp'=>'img/user.png','stat'=>'write'));
               array_push($data['sharedUserId'],$uid);

           }
           
       }
 
       foreach($read as  $uid)
       {
           $a=array_search($uid,$data['sharedUserId']);
           if($a === false)
           {
               $userInfo=$this->database->getReference('users/'.$uid)->getSnapshot()->getValue();
               if($uid!="public" )
               {
                array_push($data['sharedUsers'],array('uid'=>$userInfo['uid'],'name'=>$userInfo['name'],'email'=>$userInfo['email'],'pp'=>$userInfo['pp'],'stat'=>'read'));
                array_push($data['sharedUserId'],$uid);
               }
               else
               {
                array_push($data['sharedUsers'],array('uid'=>"Public",'name'=>"Public",'email'=>"Public",'pp'=>'img/user.png','stat'=>'read'));
                array_push($data['sharedUserId'],$uid);
            
            }
           }

       }

       
        Session::put('dateDiff',$data['lastDocsData']['created_at']);

       //Read write
    //  dd($data);

        $data['user']=['uid'=>Session::get('uid'),'email'=>Session::get('email'),'name'=>Session::get('name'),'pp'=>Session::get('pp')];
        $data['docsData']=array_reverse($data['docsData']);

        return view('docs',$data);

    }
    public function addDocs(Request $request)
    {

        $time=Carbon::now();
        $uid=Session::get('uid');
        $this->database->getReference('docs/'.$request->pushId)->set([
       'docsId' => $request->pushId,
       'title' => $request->title,
       'ownerId' => $uid,
       'read' =>array($uid),
       'write'=>array($uid),
       'stat'=>1,
       'created_at'=>$time,
        ]);
      
      $this->database->getReference('docsData/'.$request->pushId.'/'.$request->dataPushId)->set([
        'data' =>$request->data,
        'editedById' => $uid,
        'editedByName' => Session::get('name'),
        'created_at'=>$time,
        'pushId'=>$request->dataPushId
       ]);

            
      $this->database->getReference('lastDocsData/'.$request->pushId)->set([
        'data' =>$request->data,
        'editedById' => $uid,
        'editedByName' => Session::get('name'),
        'created_at'=>$time,
       ]);
        
       $docs=Session::get('docs');

      if($docs==null)
      {
          $docs[0]=$request->pushId;
          Session::put('docs',$docs);
      }
      else
       array_push($docs,$request->pushId);
       Session::put('docs',$docs);
       $this->database->getReference('users/'.$uid)->update([
       'docs'=>$docs
       ]);

        return response()->json($request);
    }

    public function guestDocs()
    {
        $rndStr=Str::random(30);
        $time=Carbon::now();
        $anonymousId=$time.$rndStr;
        $pushId=sha1($anonymousId);
        $dataPushId=sha1($pushId);
        $this->database->getReference('docs/'.$pushId)->set([
       'docsId' => $pushId,
       'title' => 'Untitled Document',
       'ownerId' => 'public',
       'read' =>array("public" => "public"),
       'write'=>array("public" => "public"),
       'stat'=>1,
       'created_at'=>$time,
        ]);

        $this->database->getReference('docsData/'.$pushId.'/'.$dataPushId)->set([
            'data' =>'&nbsp;',
            'editedById' =>'Anonymous',
            'editedByName' =>'Anonymous',
            'created_at'=>$time,
            'pushId'=>$dataPushId
           ]);
    
                
          $this->database->getReference('lastDocsData/'.$pushId)->set([
            'data' =>'&nbsp;',
            'editedById' =>'Anonymous',
            'editedByName' =>'Anonymous',
            'created_at'=>$time,
           ]);

           return redirect()->to('docs/'.$pushId);
    }

    public function deleteDocs(Request $request)
    {
         
         $id=$request->docsId;
         $docs=Session::get('docs');
         $uid=Session::get('uid');
     
         $index= array_search($id,$docs);
         unset($docs[$index]);
         
         Session::put('docs',$docs);

        $this->database->getReference('users/'.$uid)->update([
            'docs'=>$docs,
             ]);

        $this->database->getReference('docs/'.$id)->update([
            'stat'=>0,
             ]);

             return response()->json($request);

    }

    public function changeTitle(Request $request)
    {

        $this->database->getReference('docs/'.$request->docsId)->update([
            'title'=>$request->title,
             ]);

        return response()->json($request);

    }

    public function addDocsData(Request $request)
    {
        $time=Carbon::now();
        $uid=Session::get('uid');
        $name=Session::get('name');
          
        if($uid==null && $name==null)
        {
            $uid=$request->userId;
            $name='Anonymous';
        }
    
        
        $this->database->getReference('lastDocsData/'.$request->docsId)->update([
            'data'=>$request->docsData,
            'editedById'=>$uid,
            'created_at'=>$time,
             ]);

         //  $startDate = ($this->start);
        // Session::put('startDate',$time);

        $date=Session::get('startDate');

        if($date==null)
        $date=Session::put('startDate',$time);

        $date=Session::put('dateDiff',$time);

        // $startDate = Session::get('startDate');

        $data['lastDocsData']=$this->database->getReference('docsData/'.$request->docsId)->orderByKey()->limitToLast(1)->getSnapshot()->getValue();
        $key=array_keys($data['lastDocsData']);
        $startDate = new Carbon($data['lastDocsData'][$key[0]]['created_at']);

     
            
             $endDate = $time;
             $diff=$startDate->diff($endDate)->format('%i');
       
             //1 minute
             if($diff>0)
             {
                $this->database->getReference('docsData/'.$request->docsId.'/'.$request->pushId)->set([
                    'created_at'=>$time,
                    'data'=>$request->docsData,
                    'editedById'=>$uid,
                    'editedByName'=>$name,
                    'pushId'=>$request->pushId
                      ]);     

                // Session::put('startDate',$time);
             }
        
             $data['start']=$startDate;
             $data['end']=$endDate;
             $data['diff']=$diff;

        return response()->json($request);
    }

    public function getHistoryData(Request $request)
    {
        $data=$this->database->getReference('docsData/'.$request->docsId)->getSnapshot()->getValue();
        return response()->json($data);

    }

    public function dateCalculate()
    {
       $date=Session::get('dateDiff');
       $date= Carbon::createFromTimeStamp(strtotime($date))->diffForHumans();
        return response($date);

    }

    public function searchUser(Request $request)
    {

        $data=$this->database->getReference('users')->orderByChild('email')->equalTo($request->email)->getSnapshot()->getValue();

        return response()->json($data);

    }

    public function changePerm(Request $request)
    {

        $control=$this->database->getReference('docs/'.$request->docsId)->getSnapshot()->getValue();
        $read=$control['read'];
        $write=$control['write'];

        
        //read
        if($request['perm']==1)
        {
             $search=array_search($request['uid'],$write);
             if($search !== false)
             unset($write[$search]);

            $read[$request['uid']]=$request['uid'];
            $this->database->getReference('docs/'.$request->docsId)->update([
                'read'=>$read,
                'write'=>$write,
                  ]);   
        }
        //read-write
        elseif($request['perm']==2)
        {
            $search=array_search($request['uid'],$read);
            if($search === false)
            $read[$request['uid']]=$request['uid'];

            $write[$request['uid']]=$request['uid'];
            $this->database->getReference('docs/'.$request->docsId)->update([
                'read'=>$read,
                'write'=>$write,
                  ]);  
        }
      

        return response()->json($request);
    }


    public function changePerm2(Request $request)
    {

        $control=$this->database->getReference('docs/'.$request->docsId)->getSnapshot()->getValue();
        $read=$control['read'];
        $write=$control['write'];

        
        //read
        foreach($request->data as $data)
        {
          if($data['perm']==1)
          {
               $search=array_search($data['uid'],$write);
               if($search !== false)
               unset($write[$search]);
  
              $read[$data['uid']]=$data['uid'];
              $this->database->getReference('docs/'.$request->docsId)->update([
                  'read'=>$read,
                  'write'=>$write,
                    ]);   
          }
          //read-write
          elseif($data['perm']==2)
          {
              $search=array_search($data['uid'],$read);
              if($search === false)
              $read[$data['uid']]=$data['uid'];
  
               $write[$data['uid']]=$data['uid'];
              $this->database->getReference('docs/'.$request->docsId)->update([
                  'read'=>$read,
                  'write'=>$write,
                    ]);  
          }
          elseif($data['perm']==3)
          {
            $searchRead=array_search($data['uid'],$read);
            $searchWrite=array_search($data['uid'],$write);

            if($searchRead !== false)
            unset($read[$searchRead]);

            if($searchWrite !== false)
            unset($write[$searchWrite]);

            $this->database->getReference('docs/'.$request->docsId)->update([
                'read'=>$read,
                'write'=>$write,
                  ]);  
          }
        }
       
        return response()->json($request->data);
    }


    public function restoreData(Request $request)
    {

        $time=Carbon::now();
        $uid=Session::get('uid');
        $name=Session::get('name');

                
        $this->database->getReference('lastDocsData/'.$request->docsId)->update([
            'data'=>$request->docsData,
            'editedById'=>$uid,
            'editedByName'=>$name,
            'created_at'=>$time,
             ]);

        $this->database->getReference('docsData/'.$request->docsId.'/'.$request->pushId)->set([
            'created_at'=>$time,
            'data'=>$request->docsData,
            'editedById'=>$uid,
            'editedByName'=>$name,
            'pushId'=>$request->pushId
              ]);   


        return response()->json($request);

    }

    public function deleteVersion(Request $request)
    {


        $this->database->getReference('docsData/'.$request->docsId.'/'.$request->pushId)->remove();  

        return response()->json($request);
    }

    public function makeCopy(Request $request)
    {
        $time=Carbon::now();
        $uid=Session::get('uid');
        $this->database->getReference('docs/'.$request->pushId)->set([
       'docsId' => $request->pushId,
       'title' => $request->title,
       'ownerId' => $uid,
       'read' =>array($uid),
       'write'=>array($uid),
       'stat'=>1,
       'created_at'=>$time,
        ]);
      
      $this->database->getReference('docsData/'.$request->pushId.'/'.$request->dataPushId)->set([
        'data' =>$request->data,
        'editedById' => $uid,
        'editedByName' => Session::get('name'),
        'created_at'=>$time,
        'pushId'=>$request->dataPushId
       ]);

            
      $this->database->getReference('lastDocsData/'.$request->pushId)->set([
        'data' =>$request->data,
        'editedById' => $uid,
        'editedByName' => Session::get('name'),
        'created_at'=>$time,
       ]);
        
       $docs=Session::get('docs');
    
       array_push($docs,$request->pushId);
       Session::put('docs',$docs);
       $this->database->getReference('users/'.$uid)->update([
       'docs'=>$docs
       ]);
    }

}

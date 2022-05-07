<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Permission Denied</title>
  <link rel="shortcut icon" href="{{asset('img/logo.png')}}" />
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />

</head>
<style>
    html,body
    {
        width: 100%;
        height: 100%;
        overflow-x: hidden;
        overflow-y: hidden;
    }
</style>
<body>

    <div style="display: flex;justify-content:center;align-items:center;width:100%;height:100%;" > 
       <div>
       <a href="{{route('index')}}"><img src="{{asset('img/logo.png')}}" style="width: 64px;height:64px;" alt=""></a> 

            <p><b> You need access.</b></p>
            <p>Request access or switch to an account that has access.<a style="text-decoration: none" href="{{route('index')}}"> More information.</a></p>
        </div>
    </div>
</body>
</html>
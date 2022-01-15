<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit</title>
</head>
<body>
    
   <form action="{{url('provider/update/'.$list->rt_id)}}" method="Post">
    @csrf
<input type="text" value="{{$list->rt_contact}}" name="rt_contact">

<button type="submit">Update</button>


</form>
    
</body>
</html>
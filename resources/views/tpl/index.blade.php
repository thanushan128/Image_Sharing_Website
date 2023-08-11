
@extends('front_end')
@section('content')
<form action="/" method="POST" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Please Insert Your Title"><br>
    <input type="file" name="image" id="">
    @csrf
    <input type="submit" name="send" value="Save">
</form>
@stop

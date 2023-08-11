@extends('front_end')
@section('content')
<table style="width: 100%">
    <tr>
        <td width="450" valign="top">
            <p>Title : {{$image->title}}</p>
            <img src="{{url(Config::get('image.uploads_folder').'/'.$image->image)}}" alt="">
        </td>
        <td>
            <p>Direct Image URL</p>
            <input onclick="this.select()" type="text" width="100percentage" value="{{url(Config::get('image.uploads_folder').'/'.$image->image)}}">
            <p>Thumbnail HTML code </p>
            <input onclick="this.select()" type="text" width="100percentage" value="<a href='{{url('snatch/'.$image->id)}}'><img src='{{url(Config::get('image.thumb_folder').'/'.$image->image)}}" >
        </td>
    </tr>
    <tr>
        <td>
            <a href="{{url('delete/'.$image->id)}}">Delete Image</a>
        </td>
        <td>
            <a href="{{url('all')}}">See All Images</a>
        </td>
    </tr>
</table>

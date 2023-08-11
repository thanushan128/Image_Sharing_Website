@extends('front_end')
@section('content')
    @if(count($images)>0)
        <ul>
            @foreach ($images as $image)
                <li><a href="{{url('snatch/'.$image->id)}}"><img src="{{Config::get('image.thumb_folder').'/'.$image->image}}" alt=""></a></li>
            @endforeach
        </ul>

    @else
    <p>No images uploaded yet, <a href="{{url('/')}}">Care to upload one?</a></p>
    @endif
@stop


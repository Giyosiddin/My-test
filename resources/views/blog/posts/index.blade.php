@extends('layouts.app')

@section('content')
@foreach($items as $item)
<table>
    <td>{{$item->id}} </td>
    <td>{{$item->title}}</td>
    <td>{{$item->published_at}}</td>

</table>
@endforeach

@endsection



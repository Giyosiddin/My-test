@extends('layouts.app')

@section('content')
	
                <form method="post" action="{{ route('upload') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-md-3">Select images</div>
                        <div class="col-md-9">
                            <input type="file" name="file[]" id="file"> 
                        </div>
                        <input type="submit" name="upload">
                    </div>

                </form>
@endsection

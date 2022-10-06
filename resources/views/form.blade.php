@extends('layouts.default')
<style>
    .th-required::after{
    	content: '※';
        color: red;
    }
    .td-main{
    	display: flex;
    }
    .span-ex{
    	width: 100%;
        margin: 0 20px;
    	color: gray;
    }
    .error{
        display: block;
        font-size: small;
        color: red;
    }
    .error-name{
        width: 50%;
        display: block;
        font-size: small;
        color: red;
    }
    .input-form{
    	width: 100%;
        margin: 0 5px;
    }
    .textarea-form{
    	width: 100%;
        height: 100px;
        margin: 0 5px;
    }
    .btn-edit{
    	display: block;
		text-decoration: underline;
		border: none;
		background: none;
		text-align: center;
	}
</style>
@livewireStyles
@section('content')
    @livewire('contact-form')
@endsection
@section('scripts')
    @livewireScripts
@endsection
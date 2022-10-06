@extends('layouts.default')
<style>
	.form-admin{
		border: solid;
	}
    .th-main{
    	text-align: left;
    }
    .td-main{
    	display: flex;
    }
    .div-center-wrapper{
    	width : 100%;
        text-align: center;
    }
    .a-admin{
    	display: block;
        width: 100%;
        text-align: center;
    	color: black;
    }
    .center-wrapper{
    	display: flex;
        justify-content: space-between;
    }
    .page-link{
      height: 20px;
      padding: 5px 10px;
      border: solid gray;
      background-color: white;
      text-decoration: none;
      color: black;
    }
    .div-active {
      background-color: black;
      color: white;
    }
    .div-results-main,
    .div-results-email,
    .div-results-opinion,
    .div-results-delete{
    	padding-left: 10px; 
    }
    .div-results-opinion{
    	position: relative;
    }
    .div-results-delete{
    	width: 150px;
    }
    .span-hover{
    	position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
        visibility: hidden;
        background: white;
        border: solid;
    }
    .div-results-opinion:hover .span-hover{
        opacity: 1;
        visibility: visible;
    }
</style>
@section('content')
<div>
	<h1 class='h1-main'>管理システム</h1>
    <form class='form-admin' action='/search' method='get'>
    	@csrf
        <table>
    	    <tr>
                <th class='th-main'>お名前</th>
                <td class='td-main'>
                    <input class='input-form' type="text" name="fullname" value={{$fullname}}>
                </td>
    	        <th class='th-main'>性別</th>
                <td>
                    <input type="radio" value=0 name='gender' wire:model="gender" name="gender" @if($gender==0) checked='checked' @endif>すべて
                    <input type="radio" value=1 name='gender' wire:model="gender" name="gender" @if($gender==1) checked='checked' @endif>男性
                    <input type="radio" value=2 name='gender' wire:model="gender" name="gender" @if($gender==2) checked='checked' @endif>女性
                </td>

            </tr>
    	    <tr>
                <th class='th-main'>登録日</th>
                <td class='td-main'>
                    <input class='input-form' type="date" name="createdSince" value={{$createdSince}}>
                </td>
                <th class='th-main'>〜</th>
                <td class='td-main'>
                    <input class='input-form' type="date" name="createdBy" value={{$createdBy}} >
                </td>
            </tr>
    	    <tr>
    	        <th class='th-main'>メールアドレス</th>
                <td class='td-main'>
                    <input class='input-form' type="text" name="email" value={{$email}}>
                </td>
            </tr>
        </table>
        <div class='div-center-wrapper'>
	        <button class='btn-main btn-big' type="submit">検索</button>
		</div>
        <a class='a-admin' href="/admin">リセット</a>
		
    </form>
    <div class='center-wrapper'>
    	<p>全{{$countAll}}件中　{{$dispFrom}}〜{{$dispTo}}件</p>
        <div class='center-wrapper'>
        	{{$contacts->links('pagination.default')}}
        </div>
    </div>
    <table>
    		<tr>
	    	    <th class='div-results-main'>ID</th>
     	   	    <th class='div-results-main'>お名前</th>
 	       	    <th class='div-results-main'>性別</th>
 	   	        <th class='div-results-email'>メールアドレス</th>
 	   	        <th class='div-results-opinion'>ご意見</th>
 	   	        <th class='div-results-delete'></th>
			</tr>
        @foreach($contacts as $contact)
            	<tr>
        	    	<td class='div-results-main'>{{$contact->id}}</td>
        	    	<td class='div-results-main'>{{$contact->fullname}}</td>
        			<td class='div-results-main'>
        				@if($contact->gender==1)男性@endif
           	         @if($contact->gender==2)女性@endif
           		 </td>
        			<td class='div-results-email'>{{$contact->email}}</td>
        			<td class='div-results-opinion'>
                    	@if(mb_strlen($contact->opinion)<=25)
                            {{$contact->opinion}}
                        @else
                            {{mb_substr($contact->opinion,0,25) . '...'}}
                            <span class='span-hover'>
                                {{$contact->opinion}}
                            <span>
                        @endif
					</td>
					<td class='div-results-delete'>
						<form action={{'/remove/'.$contact->id}} method='post'>
     		               @csrf
      	                  <input type="hidden" name="fullname" value={{$fullname}}>
      	                  <input type="hidden" name="gender" value={{$gender}}>
      	                  <input type="hidden" name="createdSince" value={{$createdSince}}>
      	                  <input type="hidden" name="createdBy" value={{$createdBy}}>
      	                  <input type="hidden" name="email" value={{$email}}>
      	                  <button class='btn-main' type='submit'>削除</button>
      	              </form>
					</td>
        		</tr>
        @endforeach
    </table>
</div>
@endsection
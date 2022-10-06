<div>
    <h1 class='h1-main'>
    	@if($isEntry)
        お問い合わせ
        @else
        内容確認
        @endif
    </h1>
    <form class='form-main' wire:submit.prevent='saveInfo'>
    	@csrf
        <table>
    	    <tr>
    			@if($isEntry) 
                <th class= 'th-main th-required'>
                @else
                <th class= 'th-main'>
                @endif
				お名前
				</th>
                <td class='td-main'>
                	@if($isEntry)
                    <input class='input-form' type="text" wire:model="familyName" wire:focusout="focusOut('familyName')" name="familyName">
                    <input class='input-form' type="text" wire:model="givenName" wire:focusout="focusOut('givenName')" name="givenName">
                    <input type='hidden' name='fullname' value={{$familyName . $givenName}}>
                    @else
                    {{$familyName . '　' . $givenName}}
                    @endif
                </td>
            </tr>
            <tr>
            	@if($isEntry)
            	<th></th>
                <td class='td-main'>
                    <span class=span-ex>
                        例）山田
                    </span>
                    <span class=span-ex>
                        例）太郎
                    </span>
                </td>
                @endif
            </tr>
            <tr>
            	<th></th>
                <td class='td-main'>
                    <span class="error">@error('familyName') {{ $message }}@enderror</span> 
                    <span class="error">@error('givenName') {{ $message }}@enderror</span> 
                </td>
            </tr>
    	    <tr>
            	@if($isEntry)
    	        <th class='th-main th-required'>
                @else
                <th class= 'th-main'>
                @endif
					性別
				</th>
                <td>
	            	@if($isEntry)
                    <input type="radio" value=1 name='gender' wire:model="gender" name="gender" checked='checked'>男性
                    <input type="radio" value=2 name='gender' wire:model="gender" name="gender">女性
                    @elseif($gender === 1)
                    	男性
                    @else
                    	女性
                    @endif
                </td>
            </tr>
    	    <tr>
            	@if($isEntry)
    	        <th class='th-main th-required'>
                @else
                <th class= 'th-main'>
                @endif
					メールアドレス
                <td>
                	@if($isEntry)
                    <input class='input-form' type="text" wire:model="email" wire:focusout="focusOut('email')" name="email">
	                @else
					{{$email}}
					@endif
                </td>
            </tr>
            <tr>
            	@if($isEntry)
            	<th></th>
                <td>
                    <span class=span-ex>
                        例）test@example.com
                    </span>
                </td>
                @endif
            </tr>
            <tr>
            	<th></th>
                <td>
                    @error('email') <span class="error">{{ $message }}</span> @enderror
                </td>
            </tr>
    	    <tr>
    			@if($isEntry)
    	        <th class='th-main th-required'>
    			@else
    	        <th class='th-main'>
    			@endif
					郵便番号
				</th>
                <td class='td-main'>
                	〒
                    @if($isEntry)
					<input class='input-form' type="text" wire:model="postcode" wire:focusout="focusOut('postcode')" name="postcode">
					@else
						{{$postcode}}
					@endif
                </td>
            </tr>
            <tr>
            	@if($isEntry)
            	<th></th>
                <td>
                    <span class=span-ex>
                        例）123-4567
                    </span>
                </td>
                @endif
            </tr>
            <tr>
            	<th></th>
                <td>
                    @error('postcode') <span class="error">{{ $message }}</span> @enderror
                </td>
            </tr>
    	    <tr>
    	        @if($isEntry)
				<th class='th-main th-required'>
				@else
				<th class='th-main'>
				@endif
					住所
				</th>
                <td class='td-main'>
                	@if($isEntry)
                    <input class='input-form' type="text" wire:model="address" wire:focusout="focusOut('address')" name="address">
                    @else
                    {{$address}}
                    @endif
                </td>
            </tr>
            <tr>
            	@if($isEntry)
            	<th></th>
                <td>
                    <span class=span-ex>
                        例）東京都渋谷区千駄ヶ谷1-2-3
                    </span>
                </td>
                @endif
            </tr>
            <tr>
            	<th></th>
                <td>
                    @error('address') <span class="error">{{ $message }}</span> @enderror
                </td>
            </tr>
    	    <tr>
    	        <th class='th-main'>建物名</th>
                <td class='td-main'>
                	@if($isEntry)
                    <input class='input-form' type="text" wire:model="building_name" wire:focusout="focusOut('building_name')" name="building_name">
                    @else
                    {{$building_name}}
                    @endif
                </td>
            </tr>
            <tr>
            	@if($isEntry)
            	<th></th>
                <td>
                    <span class=span-ex>
                        例）千駄ヶ谷マンション101
                    </span>
                </td>
                @endif
            </tr>
            <tr>
            	<th></th>
                <td>
                    @error('building_name') <span class="error">{{ $message }}</span> @enderror
                </td>
            </tr>
    	    <tr>
    	        @if($isEntry)
				<th class='th-main th-required'>
				@else
				<th class='th-main'>
				@endif
					ご意見
				</th>
                <td class='td-main'>
                    @if($isEntry)
                	<textarea class='textarea-form' maxlength=120 wire:model='opinion' wire:focusout="focusOut('opinion')" name='opinion'></textarea>
                	@else
                	{{$opinion}}
                	@endif
                </td>
            </tr>
            <tr>
            	<th></th>
                <td>
                    @error('opinion') <span class="error">{{ $message }}</span> @enderror
                </td>
            </tr>
        </table>
        <div class='div-center-wrapper'>
	        @if(!$isEntry)
			<button class='btn-main btn-big' type='submit'>送信</button>
			@endif			
		</div>		
	</form>
    <div class='div-center-wrapper'>
		@if($isEntry)
			<button class='btn-main btn-big' wire:click='switchMode'>確認</button>    
		@else
    		<button class='btn-edit' wire:click='switchMode'>修正する</button>
		@endif
		</div>
</div>

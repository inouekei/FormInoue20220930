<?php

namespace App\Http\Livewire;

use Livewire\Component;
use GuzzleHttp\Client;
use App\Models\Contact;
use App\Rules\PostcodeRule;

class ContactForm extends Component
{
    public $isEntry = true;
    public $givenName = '';
    public $familyName = '';
    public $gender = 1;
    public $email = '';
    public $postcode = '';
    public $address = '';
    public $building_name = '';
    public $opinion = '';
    private $familyMax;
    private $postcodeRule;

    public function rules()
    {
        $postcodeRule = new PostcodeRule();
        $familyMax = 255 - strlen($this->givenName);
        return [
            'familyName'  => ['required', 'max:' . $familyMax],
            'givenName' => 'required',
            'email' => 'required|email|max:255',
            'postcode' => ['required', $postcodeRule],
            'address' => 'required|max:255',
            'building_name' => 'max:255',
            'opinion' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'required' => config('const.REQUIRED'),
            'max' => config('const.OVER_MAX'),
            'email' => config('const.NOT_EMAIL'),
            'familyName.required' => config('const.REQUIRED_FAMILYNAME'),
            'familyName.max' => config('const.OVER_MAX_NAME'),
            'givenName.required' => config('const.REQUIRED_GIVENNAME'),
        ];
    }

    public function updated($propertyName)
    {
        
    }
    public function focusOut($propertyName)
    {        
		if($propertyName === 'postcode'){
			$this->postcode = mb_convert_kana($this->postcode, "a");
		}
        $this->validateOnly($propertyName);
        
        if($propertyName <> 'postcode') return;
    	$url = "https://zipcloud.ibsnet.co.jp/api/search";
        $method = "POST";
        $option = [
			'headers' => [
				'Accept' => '*/*',
				'Content-Type' => 'application/x-www-form-urlencoded'
			],
			'form_params' => [
				'zipcode' => $this->postcode,
				'limit' => 1 //default 20
			],
			'connect_timeout' => 10,
			"timeout" => 10
		];

        //接続
        $client = new Client();
        try{
	        $response = $client->request($method, $url, $option);
			$result = json_decode($response->getBody()->getContents(), true);
 	       $this->address = $result['results'][0]['address1'] . $result['results'][0]['address2'] . $result['results'][0]['address3'];
		} catch(\Exception $e) {
		}
    }
    public function render()
    {
        return view('livewire.contact-form');
    }

    public function switchMode()
    {
        $this->validate();
    	$this->isEntry = !($this->isEntry);
    }

    public function saveInfo()
    {
        $this->validate();
    
        Contact::create([
            'fullname' => $this->familyName . $this->givenName,
            'gender' => $this->gender,
            'email' => $this->email,
            'postcode' => $this->postcode,
            'address' => $this->address,
            'building_name' => $this->building_name,
            'opinion' => $this->opinion,
        ]);
        
        return redirect()->to('/thankyou');
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
	    public function index()
    {
        $countAll = Contact::All()->count();
    	$contacts = Contact::Paginate(10);
        $countDisp = $contacts->count();
        $dispFrom = ($contacts->currentPage() - 1) * 10;
        if($countDisp <> 0) $dispFrom++;
    	$dispTo = $dispFrom + $countDisp;
        if($countDisp <> 0) $dispTo--;

    	return view('admin', [
            'fullname' => '',
            'gender' => 0,
            'createdSince' => '',
            'createdBy' => '',
            'email' => '',
            'contacts' => $contacts,
            'countAll' => $countAll,
            'dispFrom' => $dispFrom,
            'dispTo' => $dispTo,
        ]);
    }
    public function add(Request $request)
    {
    	return view('confirm', [
            'givenName' => $request->givenName,
            'familyName' => $request->familyName,
            'gender' => $request->gender,
            'email' => $request->email,
            'postcode' => $request->postcode,
            'address' => $request->address,
            'building_name' => $request->building_name,
            'opinion' => $request->opinion,
        ]);
    }
    public function edit(Request $request)
    {
    	return view('form', [
            'givenName' => $request->givenName,
            'familyName' => $request->familyName,
            'gender' => $request->gender,
            'email' => $request->email,
            'postcode' => $request->postcode,
            'address' => $request->address,
            'building_name' => $request->building_name,
            'opinion' => $request->opinion,
        ]);
    }
    public function create(Request $request)
    {
    	$form = $request->all();
        unset($form['_token']);
        Contact::create($form);
        return view('/thankyou');
    }
    public function search(Request $request)
    {
    	$contactQuery = [];
        if($request->fullname <> null){
            array_push($contactQuery, ['fullname', 'LIKE BINARY', '%' . $request->fullname . '%']);
        }
        if($request->gender <> 0){
            array_push($contactQuery, ['gender', '=', $request->gender]);
        }
        if($request->email <> null){
            array_push($contactQuery, ['email', 'LIKE BINARY', '%' . $request->email . '%']);
        }
        if($request->createdSince <> null){
            array_push($contactQuery, ['created_at', '>=', $request->createdSince]);
        }
        if($request->createdBy <> null){
            array_push($contactQuery, ['created_at', '<=', $request->createdBy]);
        }
        $contacts = Contact::where($contactQuery)->Paginate(10);
        $countAll =  Contact::where($contactQuery)->count();
        $countDisp = $contacts->count();
        $dispFrom = ($contacts->currentPage() - 1) * 10;
        if($countDisp <> 0) $dispFrom++;
    	$dispTo = $dispFrom + $countDisp;
        if($countDisp <> 0) $dispTo--;
        return view('/admin', [
            'fullname' => $request->fullname,
            'gender' => $request->gender,
            'createdSince' => $request->createdSince,
            'createdBy' => $request->createdBy,
            'email' => $request->email,
            'contacts' => $contacts,
            'countAll' => $countAll,
            'dispFrom' => $dispFrom,
            'dispTo' => $dispTo,
        ]);
    }
    public function remove($id, Request $request)
    {
        if(isset($id)){
            Contact::find($id)->delete();
        }
        $redirect = '/search?' .
            '_token=' . $request->_token .
            '&fullname=' . $request->fullname .
            '&gender=' . $request->gender .
            '&createdSince=' . $request->createdSince .
            '&createdBy=' . $request->createdBy .
            '&email=' . $request->email;
        return redirect($redirect);
    }
}

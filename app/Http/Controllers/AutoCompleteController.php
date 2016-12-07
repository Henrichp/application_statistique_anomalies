<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AutoCompleteController extends Controller {

public function index(){
    return view('autocomplete.index');
}

public function autoComplete(Request $request) {
    $query = $request->get('term','');

    $cotes = DB::table('bourse_stats.cotes_lkup')
        ->where('nom','LIKE','%'.$query.'%')->get();
    //$products=Product::where('name','LIKE','%'.$query.'%')->get();

    $data=array();

    foreach ($cotes as $cote) {
        $data[]=array('value'=>$cote->name,'id'=>$cote->id);
    }

    if(count($data))
        return $data;
    else
        return ['value'=>'No Result Found','id'=>''];
}

}
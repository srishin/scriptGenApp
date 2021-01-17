<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Models\Rules;

class FilesController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->query('id');
        $rules = Rules::with('triggers')->where('token',$id)->firstOrFail();  
        //  echo '<pre>';
        // echo var_dump($rules);
        // echo '<pre>'; 
        // dd($rules);
        $js_content = View::make('script',$rules);
        return Response($js_content, 200)
            ->header('Content-Type', 'application/javascript');
    }
}

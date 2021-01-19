<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rules;
use App\Models\Triggers;
use Illuminate\Support\Str;


class RulesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rules = Rules::with('triggers')->where('user_id',auth()->user()->id)->get()->first();    
        return view('home',["rules"=> $rules]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $body = $request->all();
        $userId = auth()->user()->id;
        $rule = Rules::where('user_id',$userId)->get()->first();
        $request->validate([
            'alert_text' => 'required||max:255',
        ]);
        if($rule){
            $rule->alert_text = $body['alert_text'];
            $rule->save();
        }else{
            $rule = Rules::create([
                'alert_text' =>  $body['alert_text'],
                'token' => Str::random(32),
                'user_id' => $userId
            ]);
        }
        $triggers = [];
        Triggers::where('rule_id',  $rule->id)->delete();
        foreach($body['uri'] as $key=>$value) {
            $triggers[] = [
                'enable_alert' => $body['enable_alert'][$key],
                'condition' =>  $body['condition'][$key],
                'uri' => $body['uri'][$key],
                'rule_id' => $rule->id,
            ];
        }
        Triggers::insert($triggers);
        return view('snippet',["token" => '<script src="'.env('APP_URL', 'http://localhost:8000').'/task.js?id='.$rule->token.'"></script>']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

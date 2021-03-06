<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $uri = 'http://localhost:8000/api/';

    public function index()
    {
        $data = Http::get($this->uri.'usuarios/');
        return $data;
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
        $response = Http::asForm()->post($this->uri.'register',[
            'name' => $request['name'],
            'email' => $request['email'],
            'password' =>$request['password'],
        ]);
        if ($response['status'] != 200) {
            return view('auth.register', compact('response'));
        }
        return redirect('/login');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Http::get($this->uri.'usuarios/'.$id);
        return $data->body();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Http::get($this->uri.'usuarios/'.$id);
        return view('auth.update', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(int $user, Request $request)
    {
        $response = Http::asForm()->put($this->uri.'usuarios/'.$user, [
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => $request['password'],
        ]);
        if ($response['status'] != 200) {
            return view('auth.update', compact('response'));
        }
        return view('home',compact('response'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::delete($this->uri.'usuarios/'.$id);
        if ($response['status'] != 200) {
            return view('home', compact('response'));
        }
        // return view('welcome');
        return redirect('/');
    }

    public function register(Request $request)
    {
        $response = Http::asForm()->post($this->uri.'register',[
            'name' => $request['name'],
            'email' => $request['email'],
            'password' =>$request['password'],
        ]);
        if ($response['status'] != 200) {
            return view('auth.register', compact('response'));
        }
        return redirect('/login');
    }
}

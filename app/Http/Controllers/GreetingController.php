<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;

    class GreetingController extends Controller {

        // public function show(Request $request,$greeting) {
        //     // $abc = 'hello world!!';
        //     // return view('greeting.show', compact('abc','greeting'));

        //     //dd($request);
        //     $name = $request->nama;
        //     $age = $request->umur;

        //     return view('greeting.show', compact('name','age'));

        // }

        public function show() {
            $greeting = __('greeting.hello');
            return view('greeting.show', compact('greeting'));
        }
    }

?>
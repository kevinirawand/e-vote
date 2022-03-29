<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use App\Models\Choice;
use App\Models\Polling;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PollingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // cek data vote suatu user
        $userHasVoted = Vote::select('polling_id')->where('user_id', 1)->pluck('polling_id')->toArray();

        // ambil semua polling yang sudah di vote user diatas
        $pollingHasVoted = Polling::with('choice')->whereIn('id', $userHasVoted)->get();

        // ambil semua polling yang belum di vote user diatas
        $pollingNotVoted = Polling::with('choice')->whereNotIn('id', $userHasVoted)->get();

        // add column to polling has voted
        $pollingHasVoted->map(function ($item) {
            $item->has_voted = true;
            return $item;
        });

        // add custom column to polling not voted
        $pollingNotVoted->map(function ($item) {
            $item->has_voted = false;
            return $item;
        });

        // combine polling has voted and polling not voted
        $data   = array_merge($pollingHasVoted->toArray(), $pollingNotVoted->toArray());

        // sort data by created_at
        usort($data, function($a, $b) {
            return $a['created_at'] <=> $b['created_at'];
        });

        // return $data;
        return view('polling',[
            'data' => $data,
        ]);
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
        // $votes = Vote::with('polling', 'choice')->get();
        $data = [
            'choice_id' => $request->choice_id,
            'polling_id' => $request->polling_id
        ];
        return $request->all();

        Vote::create([
            'choice_id' => $request->choice_id,
            'polling_id' => $request->polling_id,
            'user_id' => 1
        ]);
        return redirect()->route('index')->with('success', 'Insert Success');
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

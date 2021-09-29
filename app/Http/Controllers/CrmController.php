<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Crm;
use GuzzleHttp\Client;
use App\Http\Requests\CrmRequest;

class CrmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $crms = Crm::all();
        return view('crms.index', compact('crms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $method = "GET";
        $zipcode = $request->zipcode;
        $url = 'https://zipcloud.ibsnet.co.jp/api/search?zipcode=' . $zipcode;
        $options = [];

        $client = new Client();

        try {
            $response = $client->request($method, $url, $options);
            $body = $response->getBody();
            $crms = json_decode($body, false);
            $results = $crms->results[0];
            $address = $results->address1 . $results->address2 . $results->address3;
            // dd($address);
        } catch (\Throwable $th) {
            // return back();
            dd($th);
            $crms = null;
            $address = null;
        }

        return view('crms.create')->with(compact('zipcode', 'address'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CrmRequest $request)
    {
        $crm = new Crm();

        $crm->name = $request->name;
        $crm->email = $request->email;
        $crm->zipcode = $request->zipcode;
        $crm->address = $request->address;
        $crm->phone_number = $request->phone_number;

        $crm->save();
        return redirect()->route('crms.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Crm $crm)
    {
        return view('crms.show', compact('crm'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Crm $crm)
    {
        return view('crms.edit', compact('crm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Crmrequest $request, Crm $crm)
    {
        $crm->name = $request->name;
        $crm->email = $request->email;
        $crm->zipcode = $request->zipcode;
        $crm->address = $request->address;
        $crm->phone_number = $request->phone_number;

        $crm->save();

        return redirect()->route('crms.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Crm $crm)
    {
        $crm->delete();
        return redirect()->route('crms.index');
    }

    public function search()
    {
        return view('crms.search');
    }
}

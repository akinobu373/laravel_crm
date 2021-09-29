<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Crm;
use GuzzleHttp\Client;
use App\Http\Requests\CrmRequest;

class CrmController extends Controller
{
    public function index()
    {
        $crms = Crm::all();
        return view('crms.index', compact('crms'));
    }

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
        } catch (\Throwable $th) {
            return back();
        }

        return view('crms.create')->with(compact('zipcode', 'address'));
    }

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

    public function show(Crm $crm)
    {
        return view('crms.show', compact('crm'));
    }

    public function edit(Crm $crm)
    {
        return view('crms.edit', compact('crm'));
    }

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

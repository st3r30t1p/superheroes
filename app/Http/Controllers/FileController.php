<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    protected $client;
    protected $folder_id;
    protected $service;
    protected $ClientId     = '165191285288-sduonk4lhsj27ram2jvooa2gko9e81lg.apps.googleusercontent.com';
    protected $ClientSecret = 'CsESnYekWtAAey0eaj2LPD3O';
    protected $refreshToken = 'xxx';

    public function __construct() {
        $this->client = new \Google_Client();
        $this->client->setApplicationName('Drive');
        //$this->client->setAuthConfig(asset('access/client_credentials.json'));
        $this->client->setClientId($this->ClientId);
        $this->client->setClientSecret($this->ClientSecret);
        //$this->client->refreshToken($this->refreshToken);
        $this->service = new \Google_Service_Drive($this->client);
        // we cache the id to avoid having google creating
        // a new folder on each time we call it,
        // because google drive works with 'id' not 'name'
        // & thats why u could have duplicated folders under the same name
        \Cache::rememberForever('1_kq1PlclRPjJ_8YuF7ivMV7fInnPf9e4', function () {
            return $this->create_folder();
        });
        $this->folder_id = \Cache::get('1_kq1PlclRPjJ_8YuF7ivMV7fInnPf9e4');
    }

    public function files_count()
    {
        $response = $this->service->files->listFiles([
            'q' => "'$this->folder_id' in parents and trashed=false",
        ]);
        return count($response->files);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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

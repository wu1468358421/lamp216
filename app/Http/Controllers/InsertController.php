<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;

class InsertController extends Controller
{
    //
    public function index()
    {
    	$data = ['uname'=>'admin','upass'=>Hash::make('123123')];
    	DB::table('admin_users')->insert($data);
    }
}

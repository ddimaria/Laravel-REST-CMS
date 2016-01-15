<?php namespace App\LaravelRestCms;

use Illuminate\Http\Request;

interface ApiInterface
{
	public function show($id);
	public function collection();
	public function create(Request $data);
} 

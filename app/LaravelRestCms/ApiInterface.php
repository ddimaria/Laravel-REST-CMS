<?php namespace App\LaravelRestCms;

interface ApiInterface
{
	public function show($id);
	public function collection();
	public function create($data);
} 

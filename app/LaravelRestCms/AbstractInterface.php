<?php namespace App\LaravelRestCms;

interface AbstractInterface
{
	public function show($id);
	public function collection();
	public function create($data);
} 

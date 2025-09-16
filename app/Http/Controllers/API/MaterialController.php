<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\MaterialResource;
use App\Http\Resources\home\ProductResource as HomeProductResource;
use App\Http\Resources\ProductResource;
use App\Models\Material;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class MaterialController extends Controller
{
    private $material;
    public function __construct(Material $material)
    {
        $this->material = $material;
    }

    public function index()
    {
        try {
            $data['materials'] = MaterialResource::collection($this->material->latest()->get());
            return successResponse($data);
        } catch (Exception $e) {

            return failedResponse($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $data['material'] = new MaterialResource($this->material->findorfail($id));
            return successResponse($data);
        } catch (Exception $e) {

            return failedResponse($e->getMessage());
        }
    }




}
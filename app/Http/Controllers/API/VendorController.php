<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\VendorResource;
use App\Http\Resources\home\ProductResource as HomeProductResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\SubvendorResource;
use App\Models\Vendor;
use App\Models\Subvendor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class VendorController extends Controller
{
    private $vendor;
    public function __construct(Vendor $vendor)
    {
        $this->vendor = $vendor;
    }

    public function index()
    {
        try {
            $data['vendors'] = VendorResource::collection($this->vendor->latest()->get());
            return successResponse($data);
        } catch (Exception $e) {

            return failedResponse($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $data['vendor'] = new VendorResource($this->vendor->findorfail($id));
            return successResponse($data);
        } catch (Exception $e) {

            return failedResponse($e->getMessage());
        }
    }
}
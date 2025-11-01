<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\VendorRequest;
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


    public function store(VendorRequest $request)
    {
        try {
            $data = $request->except(['image', 'profile_avatar_remove', 'video', 'profile_video_remove']);
            $data['is_active'] = $request->boolean('is_active');

            $vendor = $this->vendor->create($data);

            if ($request->hasFile('image')) {
                $vendor->uploadFile();
            }

            return response()->json([
                'status' => true,
                'message' => 'Vendor created successfully',
                'data' => $vendor
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * PUT /api/vendors/{id}
     */
    public function update(Request $request, Vendor $vendor)
    {
        try {
            $data = $request->except(['image', 'profile_avatar_remove', 'video']);
            $data['is_active'] = $request->boolean('is_active');

            $vendor->update($data);

            if ($request->hasFile('image')) {
                $vendor->updateFile();
            }

            return response()->json([
                'status' => true,
                'message' => 'Vendor updated successfully',
                'data' => $vendor
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * DELETE /api/vendors/{id}
     */
    public function destroy(Vendor $vendor)
    {
        try {
            $vendor->deleteFile();
            $vendor->delete();

            return response()->json([
                'status' => true,
                'message' => 'Vendor deleted successfully'
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
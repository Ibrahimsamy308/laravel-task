<?php

namespace App\Traits;

use App\Models\File as ModelsFile;
use Exception;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\File;

trait MorphMaterials
{
    public function materials(): MorphMany
    {
        return $this->morphMany(ModelsFile::class, 'fileable');
    }

    public function uploadMaterials()
    {
        if (request()->hasFile('materials')) {
            try {
                foreach (request()->file('materials') as $file) {
                    $this->storeMaterial($file);
                }
            } catch (Exception $e) {
                dd($e->getMessage());
                return redirect()->back()->with(['error' => __('general.something_wrong')]);
            }
        }
    }

    public function updateMaterials()
    {
        try {
            $this->deleteMaterials();

            if (request()->hasFile('materials')) {
                foreach (request()->file('materials') as $file) {
                    $this->storeMaterial($file);
                }
            }
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with(['error' => __('general.something_wrong')]);
        }
    }

    public function deleteMaterials()
    {
        try {
            foreach ($this->materials as $material) {
                $path = public_path($material->url);

                if (file_exists($path)) {
                    File::delete($path);
                }

                $material->delete();
            }
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with(['error' => __('general.something_wrong')]);
        }
    }

    protected function storeMaterial($file)
    {
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        // نخزن الملفات جوه public/materials
        $file->move(public_path('materials'), $fileName);

        $this->materials()->create([
            'url' => 'materials/' . $fileName
        ]);
    }

    public function getMaterialsListAttribute()
    {
        return $this->materials->map(function ($material) {
            return asset($material->url);
        });
    }
}
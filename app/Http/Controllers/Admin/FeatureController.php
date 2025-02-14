<?php

namespace App\Http\Controllers\Admin;

use App\Datatables\FeatureDatatable;
use App\Helpers\FileUploader;
use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Services\ToasterService;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    protected $featureDatatable;

    public function __construct(FeatureDatatable $featureDatatable)
    {
        $this->featureDatatable = $featureDatatable;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return $this->featureDatatable->get();
        }
        return view('admin.feature.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Feature $feature)
    {
        return view(
            'admin.feature.show',
            ['feature' => $feature]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feature $feature)
    {
        return view('admin.feature.edit', ['feature' => $feature]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feature $feature)
    {
        $validated = $request->validate([
            "name" => ['required', 'string', 'max:255'],
            "description" => ['nullable', 'string'],
            "thumbnail" => ['nullable', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            "fee" => ['required', 'numeric', 'min:0'],
            "enable" => ['required', 'boolean'],
        ]);

        try {

            if ($request->has('thumbnail')) {

                $fileUploader = new FileUploader();

                $fileUploader->deleteFile($feature->getRawOriginal('image'));

                $validated['image'] = $fileUploader
                    ->setHeight(200)
                    ->setWidth(200)
                    ->setDirectory('feature')
                    ->uploadImage($request->file('thumbnail'));
            }


            $feature->update($validated);

            ToasterService::success('update success.!');
            return redirect()->route('admin.features.index');

        } catch (\Exception $e) {

            // ToasterService::error('Failed to update service. Please try again.');
            ToasterService::error($e->getMessage());
            return redirect()->back();

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feature $feature)
    {
        //
    }
}

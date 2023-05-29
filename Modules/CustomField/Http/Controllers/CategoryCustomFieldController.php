<?php

namespace Modules\CustomField\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use Illuminate\Contracts\Support\Renderable;
use Modules\CustomField\Entities\CustomField;
use Modules\CustomField\Entities\CustomFieldGroup;

class CategoryCustomFieldController extends Controller
{
    public function categoryCustomFieldCreate(Category $category)
    {
        $custom_fields = CustomField::latest()->get(['id', 'name']);
        $category_fields = $category->customFields->pluck('id')->toArray();
        $groups = CustomFieldGroup::latest()->get(['id', 'name']);

        return view('customfield::category.custom-field-add', compact('custom_fields', 'category_fields', 'category', 'groups'));
    }

    public function categoryCustomFieldStore(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|min:2',
            'type' => 'required',
            'group' => 'required',
            'icon' => 'required',
            'categories.*' => 'required',
        ]);

        if ($request->type == 'select' || $request->type == 'radio' || $request->type == 'checkbox_multiple') {
            $request->validate([
                'values' => 'required',
            ]);
        } elseif ($request->type == 'checkbox') {
            $request->validate([
                'value' => 'required',
            ]);
        }

        $custom_field = CustomField::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'type' => $request->type,
            'required' => $request->required ? true : false,
            'filterable' => $request->filterable ? true : false,
            'listable' => $request->listable ? true : false,
            'custom_field_group_id' => $request->group,
            'icon' => $request->icon,
        ]);


        if ($request->type == 'select' || $request->type == 'radio' || $request->type == 'checkbox_multiple') {
            foreach ($request->values as $value) {
                $custom_field->values()->create([
                    'value' => $value,
                ]);
            }
        } elseif ($request->type == 'checkbox') {
            $custom_field->values()->create(['value' => $request->value]);
        }

        if ($custom_field) {
            $category->customFields()->attach($custom_field->id);
        }

        flashSuccess('Custom Field Created Successfully !');
        return back();
    }

    public function categoryCustomFieldAttach(Request $request, Category $category)
    {
        $category->customFields()->sync($request->fields);

        flashSuccess('Custom field added successfully.');
        return back();
    }


    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('customfield::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('customfield::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('customfield::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('customfield::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace Modules\CustomField\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CustomField\Entities\CustomFieldGroup;

class CustomFieldGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index($slug = null)
    {
        if ($slug) {
            if (!userCan('custom-field-group.update')) {
                return abort(403);
            }

            $group = CustomFieldGroup::whereSlug($slug)->firstOrFail();
        }

        $groups = CustomFieldGroup::withCount('customFields')->oldest('order')->paginate(15);

        return view('customfield::group.index', [
            'groups' => $groups,
            'edit_group' => $group ?? null,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        if (!userCan('custom-field-group.create')) {
            return abort(403);
        }

        $request->validate([
            'name' => 'required|unique:custom_field_groups,name|max:255',
        ]);

        CustomFieldGroup::create([
            'name' => $request->name,
        ]);

        flashSuccess('Group Created Successfully');
        return back();
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, CustomFieldGroup $custom_field_group)
    {
        if (!userCan('custom-field-group.update')) {
            return abort(403);
        }

        $custom_field_group->update([
            'name' => $request->name,
        ]);

        flashSuccess('Group Updated Successfully');
        return redirect()->route('module.custom.field.group.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(CustomFieldGroup $custom_field_group)
    {
        if (!userCan('custom-field-group.delete')) {
            return abort(403);
        }

        $custom_field_group->delete();

        flashSuccess('Group Deleted Successfully');
        return back();
    }

    public function sorting(Request $request)
    {
        try {
            $fields = CustomFieldGroup::all();

            foreach ($fields as $field) {
                $field->timestamps = false;
                $id = $field->id;

                foreach ($request->order as $order) {
                    if ($order['id'] == $id) {
                        $field->update(['order' => $order['position']]);
                    }
                }
            }
            return response()->json(['message' => 'Custom Field Group Sorted Successfully!']);
        } catch (\Throwable $th) {
            flashError();
            return back();
        }
    }
}

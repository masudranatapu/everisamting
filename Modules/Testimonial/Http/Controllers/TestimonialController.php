<?php

namespace Modules\Testimonial\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\Testimonial\Entities\Testimonial;
use Modules\Testimonial\Actions\CreateTestimonial;
use Modules\Testimonial\Actions\DeleteTestimonial;
use Modules\Testimonial\Actions\UpdateTestimonial;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Modules\Testimonial\Http\Requests\TestimonialFormRequest;

class TestimonialController extends Controller
{
    use ValidatesRequests;

    public function __construct()
    {
        abort_if(!enableModule('testimonial'), 404);
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if (!userCan('testimonial.view')) {
            return abort(403);
        }
        if (!enableModule('testimonial')) {
            abort(404);
        }
        $testimonials = Testimonial::latest()->get();
        return view('testimonial::index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        if (!userCan('testimonial.create')) {
            return abort(403);
        }
        if (!enableModule('testimonial')) {
            abort(404);
        }
        return view('testimonial::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(TestimonialFormRequest $request)
    {
        if (!userCan('testimonial.create')) {
            return abort(403);
        }
        $testimonial = CreateTestimonial::create($request);

        if ($testimonial) {
            flashSuccess('Testimonial Added Successfully');
            return back();
        } else {
            flashError();
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Testimonial $testimonial)
    {
        if (!userCan('testimonial.update')) {
            return abort(403);
        }
        if (!enableModule('testimonial')) {
            abort(404);
        }
        return view('testimonial::edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(TestimonialFormRequest $request, Testimonial $testimonial)
    {
        if (!userCan('testimonial.update')) {
            return abort(403);
        }
        $testimonial = UpdateTestimonial::update($request, $testimonial);

        if ($testimonial) {
            flashSuccess('Testimonial Updated Successfully');
            return redirect(route('module.testimonial.index'));
        } else {
            flashError();
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Testimonial $testimonial)
    {
        if (!userCan('testimonial.delete')) {
            return abort(403);
        }

        $testimonial = DeleteTestimonial::delete($testimonial);

        if ($testimonial) {
            flashSuccess('Testimonial Deleted Successfully');
            return back();
        } else {
            flashError();
            return back();
        }
    }
}

<?php

namespace Modules\Brand\Repositories;

interface BrandInterface
{
    public function all();
    public function store(Object $data);
    public function update(Object $request, Object $data);
    public function destroy(Object $data);
}

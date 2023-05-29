<?php

namespace Modules\Category\Repositories;


interface CategoryInterface
{
    public function all();
    public function store($data);
    public function destroy(object $data);
}

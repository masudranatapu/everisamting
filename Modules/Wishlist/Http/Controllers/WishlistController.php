<?php

namespace Modules\Wishlist\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Modules\Wishlist\Entities\Wishlist;

class WishlistController extends Controller
{
    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Wishlist $wishlist)
    {
        $wishlistDelete = $wishlist->delete();

        if ($wishlistDelete) {
            flashSuccess('Wishlist Deleted Successfully');
            return back();
        } else {
            flashError();
            return back();
        }
    }
}

<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        "/admin/checkCurrentPassword",
        "/admin/updateSectionStatus",
        "/admin/updateCategoryStatus",
        "/admin/appendLevel",
        "/admin/updateProductStatus",
        "/admin/updateAttributeStatus",
        "/admin/updateImageStatus",
        "/admin/updateBrandStatus",
        "/admin/updateBannerStatus",
        "/admin/updateCouponStatus"
    ];
}

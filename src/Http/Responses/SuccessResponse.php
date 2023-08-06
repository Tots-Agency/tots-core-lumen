<?php

namespace Tots\Core\Http\Responses;

class SuccessResponse
{
    static public function make()
    {
        return [
            'success' => true,
        ];
    }
}

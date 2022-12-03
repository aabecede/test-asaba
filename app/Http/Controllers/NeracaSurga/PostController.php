<?php

namespace App\Http\Controllers\NeracaSurga;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function ajaxHitungNeraca(Request $request){
        try {
            // dd($request->all());
            $result = (new SetController)->setHitungNeraca($request);
            return $this->successJson(
                $result
            );
        } catch (\Throwable $th) {
            return $this->exceptionJson($th);
        }
    }
}

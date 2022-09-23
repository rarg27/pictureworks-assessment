<?php

namespace App\Http\Controllers;

use App\Http\Actions\AppendUserComments;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getUser($id = null)
    {
        $id ??= request('id');

        // strictly check id as integer
        if (!(is_numeric($id) && floor($id) === floatval($id))) {
            return response('Invalid id', 422);
        }

        if ($user = User::find($id)) {
            return view('view', ['user' => $user]);
        }

        return response("No such user ($id)", 404);
    }

    public function storeComment(Request $request, AppendUserComments $appendUserComments)
    {
        $args = $this->validate($request, [
            'id' => 'integer|required',
            'comments' => 'required',
            'password' => 'required'
        ]);

        if (strtoupper($args['password']) != '720DF6C2482218518FA20FDC52D4DED7ECC043AB') {
            return response('Invalid password', 401);
        }

        try {
            $appendUserComments->execute($args['id'], $args['comments']);
        } catch (\Exception $exception) {
            return response('Could not update database: '.$exception->getMessage(), 500);
        }

        return response('OK');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    /**
     * Constructor method
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->addBaseRoute('user');
        $this->addBaseView('user');
    }

    public function index(Request $request)
    {
        $users = new User();
        if ('' != $request->keyword) {
            $users = $users->where('name', 'LIKE', '%'.$request->keyword.'%');
        }
        $users = $users->paginate(15);
        return $this->renderView($this->getView('index'), compact('users'), 'User List');
    }
    
}

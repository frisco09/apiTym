<?php

namespace App\Http\Controllers\User;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class UserViewController extends ApiController
{
    /**
     * @var User
     */
    private $user;
    /**
     * UserApiController constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
    	$this->user = $user;
    }
    /**
     * return paginated records of users
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
    	/*$users = $this->user->paginate(15);
        
    	return response()->json($users);

		$users = User::all();
        return $this->showAll($users);*/
        return redirect()->route('home');
    }
}

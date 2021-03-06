<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Jetstream\HasProfilePhoto;
use Carbon\Carbon;

class UserHistoryController extends Controller
{
    protected $table = 'user_histories';
    protected $prefix = 'history';


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // fetch all data
        $userManager = new UserController();
        $defaultPhotoPath = $userManager->getDefaultProfilePhotoUrl(auth()->id());
        $userProfilePath = $userManager->getUserProfilePicture();

        $userHistory = DB::table($this->table)->where('fk_user_id', '=', auth()->id())->orderByDesc('created_at')->paginate(10);


        $currentUser = DB::table('users')->where('id', '=', auth()->id())->first();

        return view($this->prefix . '.history-overview', compact('userHistory', 'currentUser', 'defaultPhotoPath', 'userProfilePath'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $userHistory = new UserHistory();

        $userHistory->visited_page = $request->pageName;
        $userHistory->page_url = $request->url;
        $userHistory->fk_user_id = $request->user_id;
        $userHistory->fk_classroom_id = $request->classroom_id;

        $userHistory->save();
    }

    /**
     * Display the specified resource.
     * @param  \App\Models\UserHistory  $userHistory
     * @return \Illuminate\Http\Response
     */
    public function show(UserHistory $userHistory)
    {
        //
    }

    public function updateVisited(Request $visited)
    {
        $this->store($visited);
    }




}

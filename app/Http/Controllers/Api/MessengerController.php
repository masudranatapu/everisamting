<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Messenger;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewMessageNotification;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MessengerController extends Controller
{
    /**
     * Messenger
     *
     * @param String $username
     * @return View
     */
    public function index()
    {


        $data['user'] = Auth::guard('api')->user();



        $users = Messenger::join('users',  function ($join) {
            $join->on('messengers.from_id', '=', 'users.id')
                ->orOn('messengers.to_id', '=', 'users.id');
        })->where(function ($q) {
            $q->where('messengers.from_id', Auth::guard('api')->id())
                ->orWhere('messengers.to_id', Auth::guard('api')->id());
        })->orderBy('messengers.created_at', 'desc')

            ->select('users.id as id', 'users.name', 'users.username', 'users.image', 'messengers.created_at', 'messengers.body')
            ->groupBy('id')
            ->get();
        $users = $users
            ->where('id', '!=', Auth::guard('api')->id())
            ->map(function ($item) {
                $item->image_url = $item->image ? asset($item->image) : asset('backend/image/default-user.png');
                return $item;
            });

        $alluser = [];
        foreach ($users as $user) {
            $alluser[] = [
                "id" => $user->id,
                "name" => $user->name,
                "username" => $user->username,
                "image" => $user->image,
                "created_at" => $user->created_at,
                "body" => $user->body,
                "image_url" => $user->image_url,
            ];
        }

        $data['users'] = $alluser;

        return sendResponse(200, "User chat member List", $data, true, []);
    }



    public function show($username = null)
    {



        $data['user'] = Auth::guard('api')->user();



        $data['selected_user'] =  User::where('username', $username)->first();

        if ($data['selected_user']) {
            $data['messages'] = $this->getMessages($data['selected_user']);
        }
        if (!isset($username)) {
        } else {
            $discription = ['username' => "Must provide a username as a string as peram"];
            return sendResponse(200, "User chat message List", $data, true, $discription);
        }
    }



    /**
     * Get selected user messages
     *
     * @param App\Models\User $user
     * @return Collection
     */
    public function getMessages($user)
    {
        $id = $user->id;
        return Messenger::where(function ($query) use ($id) {
            $query->where(function ($q) use ($id) {
                $q->where('from_id', Auth::guard('api')->id());
                $q->where('to_id', $id);
            })
                ->orWhere(function ($q) use ($id) {
                    $q->where('to_id', Auth::guard('api')->id());
                    $q->where('from_id', $id);
                });
        })
            ->where('body', '!=', '.')
            ->latest()
            ->get();
    }



    /**
     * Send message to user
     *
     * @param Request $request
     * @param String $username
     * @return void

     */
    public function sendMessage(Request $request, $username)
    {
        $validator = Validator::make($request->all(), [
            'body' => "required|max:255",
        ]);
        $discription = [
            'body' => "Must Be String maximum carecter 255",
            'username' => "Must provid a username as a string"
        ];

        if ($validator->fails()) {
            return sendError("Validation Error", [$discription, $validator->errors()]);
        }

        $user = User::where('username', $username)->firstOrFail();

        if ($user->id === Auth::guard('api')->id()) {
            return response()->json([
                'success' => false,
                'message' => 'You can not send message to yourself',
            ]);
        }

        if (!$this->checkMessageLists($user->id)) {
            Messenger::create([
                'from_id'   =>  Auth::guard('api')->id(),
                'to_id'     =>  $user->id,
                'body'      =>  $request->body,
            ]);
            $data['messages'] = $this->getMessages($user);


            return response()->json([
                'success' => true,
                'message' => 'Message sent successfully',
                'data' => $data,
            ]);
        }

        $message = Messenger::create([
            'from_id'   =>  Auth::guard('api')->id(),
            'to_id'     =>  $user->id,
            'body'      =>  $request->body,
        ]);






        $selected_user =  User::where('username', $username)->first();

        if ($selected_user) {
            $data['messages'] = $this->getMessages($selected_user);
        }
        if (isset($username)) {
            // if (checkSetup('mail')) {
            //     $user->notify(new NewMessageNotification($message, Auth::user()));
            // }
            return sendResponse(200, "Message Send", $data, true, $discription);
        }
    }

    /**
     * Check is already in message lists
     *
     * @param init  $id
     * @return bool
     */
    public function checkMessageLists($id)
    {
        return (bool) Messenger::where(function ($query) use ($id) {
            $query->where(function ($q) use ($id) {
                $q->where('from_id', Auth::guard('api')->id());
                $q->where('to_id', $id);
            })
                ->orWhere(function ($q) use ($id) {
                    $q->where('to_id', Auth::guard('api')->id());
                    $q->where('from_id', $id);
                });
        })
            ->count();
    }
}

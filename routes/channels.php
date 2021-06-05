<?php

// Broadcast::channel('App.User.{id}', function($user,$id){
//     return (int) $user->id === (int) $id;
// });

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.User.{id}', function ($user , $id) {
    return $user->id == $id && get_class($user) === "App\User";
});


Broadcast::channel('online', function($user){
    return $user;
});

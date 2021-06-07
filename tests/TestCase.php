<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUpUser(){
        Artisan::call('migrate:fresh');


        foreach (User::all() as $user)
        {
            $user->delete();
        }
    
        $user = new User();
        $user->name = 'ivan';
        $user->email = uniqid().'@gmail.com';
        $user->password = '12345678';
        $user->save();
        $this->be($user);
    }
}

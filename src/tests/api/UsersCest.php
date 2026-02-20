<?php

namespace tests\api;

class UsersCest
{
    public function getUserList(\ApiTester $I)
    {
        $I->wantTo('get a list of users');
        $I->sendGET('/users');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'users'  => [],
            '_links' => [],
            '_meta'  => []
        ]);
    }

    public function getUser(\ApiTester $I)
    {
        $I->sendGET('/users/1');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'id'         => 'integer',
            'first_name' => 'string',
            'last_name'  => 'string',
            'albums'     => 'array'
        ]);
    }
}
<?php

namespace api;

class AlbumsCest
{

    public function getAlbumsList(\ApiTester $I)
    {
        $I->sendGET('/albums');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'albums' => [],
            '_links' => [],
            '_meta' => []
        ]);
    }

    public function getAlbum(\ApiTester $I)
    {
        $I->sendGET('/albums/1');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContains('id');
        $I->seeResponseContains('first_name');
        $I->seeResponseContains('last_name');
        $I->seeResponseContainsJson(['photos' => []]);
    }

}
<?php

namespace Tests\Integration;

use TestCase;

class UserTest extends TestCase
{

    public function testIndex()
    {
        $this->call('GET', 'user');
        $this->assertResponseOk();
    }

    public function testSearch()
    {
        $this->call('GET', 'user/search', ['search_str' => 'Laravel']);
        $this->assertResponseOk();
    }

    public function testShow()
    {
        $this->call('GET', 'user/1');
        $this->assertResponseOk();
    }

    public function testCreate()
    {
        $this->call('GET', 'user/create');
        $this->assertResponseOk();
    }

    public function testStore()
    {
        $data = [
            'email' => 'phpunit@gmail.com',
            'uid' => '1234',
            'username' => 'PUPUNIT',
            'group_id' => 2,
            '_token' => csrf_token(),
        ];
        $this->call('POST', 'user', $data);
        $this->assertRedirectedToRoute('user.index');
    }

    public function testStoreWithWrongData()
    {
        $data = [
            'uid' => '1234',
            'username' => 'PUPUNIT',
            'group_id' => 2,
            '_token' => csrf_token(),
        ];
        $this->call('POST', 'user', $data);
        $this->assertResponseStatus(302);
    }

    public function testEdit()
    {
        $this->call('GET', 'user/1/edit');
        $this->assertResponseOk();
    }

    public function testUpdate()
    {
        $data = [
            'email' => 'phpunitupdate@gmail.com',
            'uid' => '12345678',
            'username' => 'PUPUNIT UPDATE',
            'group_id' => 2,
            '_token' => csrf_token(),
        ];
        $this->call('PUT', 'user/1', $data);
        $this->assertRedirectedToRoute('user.index');
    }

    public function testDestroy()
    {
        $this->call('DELETE', 'user/1', ['_token' => csrf_token()]);
        $this->assertRedirectedToRoute('user.index');
    }
}

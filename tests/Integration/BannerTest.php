<?php

namespace Tests\Integration;

use TestCase;

class BannerTest extends TestCase
{

    public function testIndex()
    {
        $this->call('GET', 'banner');
        $this->assertResponseOk();
    }

    public function testSearch()
    {
        $this->call('GET', 'banner/search', ['search_str' => '預登']);
        $this->assertResponseOk();
    }

    public function testCreate()
    {
        $this->call('GET', 'banner/create');
        $this->assertResponseOk();
    }

    public function testStore()
    {
        $data = [
            'title' => 'PHPUNIT TEST',
            'img_path' => '/kizna/web/名將參戰/level150_380x224.jpg',
            'rank' => 1,
            'url' => 'http://phpunit.garena.tw',
            'status' => 1,
            '_token' => csrf_token(),
        ];
        $this->call('POST', 'banner', $data);
        $this->assertRedirectedToRoute('banner.index');
    }

    public function testStoreWithWrongData()
    {
        $data = [
            'title' => 'PHPUNIT TEST',
            'rank' => 1,
            'url' => 'http://phpunit.garena.tw',
            'status' => 1,
            '_token' => csrf_token(),
        ];
        $this->call('POST', 'banner', $data);
        $this->assertResponseStatus(302);
    }

    public function testEdit()
    {
        $this->call('GET', 'banner/1/edit');
        $this->assertResponseOk();
    }

    public function testUpdate()
    {
        $data = [
            'title' => 'PHPUNIT TEST UPDATE',
            'img_path' => '/kizna/web/0325%E5%90%8D%E5%B0%87%E6%9B%B4%E6%96%B0/newcardskill_380x224.jpg',
            'rank' => 2,
            'url' => 'http://phpunit2.garena.tw',
            'status' => 2,
            '_token' => csrf_token(),
        ];
        $this->call('PUT', 'banner/1', $data);
        $this->assertRedirectedToRoute('banner.index');
    }

    public function testUpdateWithWrongData()
    {
        $data = [
            'title' => 'PHPUNIT TEST UPDATE',
            'rank' => 2,
            'url' => 'http://phpunit2.garena.tw',
            'status' => 2,
            '_token' => csrf_token(),
        ];
        $this->call('PUT', 'banner/1', $data);
        $this->assertResponseStatus(302);
    }

    public function testDestroy()
    {
        $this->call('DELETE', 'banner/1', ['_token' => csrf_token()]);
        $this->assertRedirectedToRoute('banner.index');
    }
}

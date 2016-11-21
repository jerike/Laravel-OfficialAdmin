<?php

namespace Tests\Integration;

use TestCase;

class NewsTest extends TestCase
{

    public function testIndex()
    {
        $this->call('GET', 'news');
        $this->assertResponseOk();
    }

    public function testSearch()
    {
        $this->call('GET', 'news/search', ['search_str' => 'Laravel']);
        $this->assertResponseOk();
    }

    public function testShow()
    {
        $this->call('GET', 'news/1');
        $this->assertResponseOk();
    }

    public function testCreate()
    {
        $this->call('GET', 'news/create');
        $this->assertResponseOk();
    }

    public function testStore()
    {
        $data = [
            'news_category_id' => 1,
            'title' => 'PHPUNIT TEST',
            'content' => 'PHPUNIT TEST CONTENT',
            'status' => 1,
            '_token' => csrf_token(),
        ];
        $this->call('POST', 'news', $data);
        $this->assertRedirectedToRoute('news.index');
    }

    public function testStoreWithWrongData()
    {
        $data = [
            'news_category_id' => 1,
            'content' => 'PHPUNIT TEST CONTENT',
            'status' => 1,
            '_token' => csrf_token(),
        ];
        $this->call('POST', 'news', $data);
        $this->assertResponseStatus(302);
    }

    public function testEdit()
    {
        $this->call('GET', 'news/1/edit');
        $this->assertResponseOk();
    }

    public function testUpdate()
    {
        $data = [
            'news_category_id' => 2,
            'title' => 'PHPUNIT TEST',
            'content' => 'PHPUNIT TEST CONTENT UPDATE',
            'status' => 1,
            '_token' => csrf_token(),
        ];
        $this->call('PUT', 'news/1', $data);
        $this->assertRedirectedToRoute('news.index');
    }

    public function testUpdateWithWrongData()
    {
        $data = [
            'news_category_id' => 2,
            'title' => 'PHPUNIT TEST',
            'content' => 'PHPUNIT TEST CONTENT UPDATE',
            'status' => 1,
            '_token' => csrf_token(),
        ];
        $this->call('PUT', 'news/1', $data);
        $this->assertResponseStatus(302);
    }

    public function testDestroy()
    {
        $this->call('DELETE', 'news/1', ['_token' => csrf_token()]);
        $this->assertRedirectedToRoute('news.index');
    }

    public function testUpdateTopStatus()
    {
        $this->call('GET', 'news/2/update', ['top_status' => 2]);
        $this->assertRedirectedToRoute('news.index');
    }
}

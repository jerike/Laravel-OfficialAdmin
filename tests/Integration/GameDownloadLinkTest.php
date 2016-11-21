<?php

namespace Tests\Integration;

use TestCase;

class GameDownloadLinkTest extends TestCase
{
    public function testIndex()
    {
        $this->call('GET', 'game-download-link');
        $this->assertResponseOk();
    }

    public function testUpdate()
    {
        $data = [
            'url' => 'http://test',
            'note' => 'PHPUNIT TEST',
            '_token' => csrf_token()
        ];
        $this->call('PUT', 'game-download-link/1', $data);
        $this->assertRedirectedToRoute('game_download_link.index');
    }
}

<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\VersionControl\FileSystem\FileSystem;
use App\VersionControl\FileSystem\Add;

use Illuminate\FileSystem\FileSystem as OSFileSystem;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Collection;

class FileSystemTest extends TestCase
{
    private $filesystem;
    private $tempDir;
    private $repo;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testList()
    {
        $pass = true;
        $files = $this->repo->list('');


        $this->assertEquals('main.c', $files[0]->name);
        $this->assertEquals('file', $files[0]->type);

        $this->assertEquals('subdir', $files[1]->name);
        $this->assertEquals('directory', $files[1]->type);
        $this->assertTrue($pass);
    }

    public function testListSubDir()
    {
        $files = $this->repo->list('subdir/');

        $this->assertEquals('list.c', $files[0]->name);
        $this->assertEquals('file', $files[0]->type);
    }

    public function testBadPath()
    {
        $files = $this->repo->list('noexist/test/');
        $this->assertEquals([], $files);
    }

    //Test adding a subdirectory
    public function testAdd()
    {
        $actions = new Collection();

        $staging = $this->staging;
        $this->filesystem->put($staging . 'abc.c', 'abc123');
        $this->filesystem->put($staging . 'zyx.c', 'zyx987');

        $actions->push(new Add($this->tempDir, $staging . 'abc.c', '' ,'abc.c'));
        $actions->push(new Add($this->tempDir, $staging . 'zyx.c', 'subdir/', 'zyx.c'));
        $results = $this->repo->commit($actions);

        $this->assertTrue($this->filesystem->isfile($this->tempDir.'abc.c'));
        $this->assertTrue($this->filesystem->isfile($this->tempDir.'subdir/zyx.c'));

        foreach($results as $result)
        {
            $this->assertTrue($result->success);
        }

        $this->filesystem->delete($this->tempDir . 'abc.c');
        $this->filesystem->delete($this->tempDir .'subdir/zyx.c');


    }
    public function setUp()
    {
        parent::setUp();
        $this->filesystem = new OSFileSystem();
        $this->tempDir = __DIR__.'/testRepo/';
        $this->subDir = $this->tempDir . 'subdir/';
        $this->staging = __DIR__.'/staging/';

        mkdir($this->staging);
        mkdir($this->tempDir);
        mkdir($this->subDir);
        $this->filesystem->put($this->tempDir.'main.c', 'int main()');
        $this->filesystem->put($this->subDir.'list.c', 'void list');

        $this->repo = new FileSystem($this->tempDir);
    }


    public function tearDown()
    {
        $this->filesystem->deleteDirectory($this->tempDir);
        $this->filesystem->deleteDirectory($this->staging);
    }
}

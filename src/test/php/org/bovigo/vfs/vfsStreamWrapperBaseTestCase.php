<?php
/**
 * Test for org::bovigo::vfs::vfsStreamWrapper.
 *
 * @author      Frank Kleine <mikey@bovigo.org>
 * @package     bovigo_vfs
 * @subpackage  test
 */
require_once 'org/bovigo/vfs/vfsStream.php';
require_once 'PHPUnit/Framework.php';
/**
 * Test for org::bovigo::vfs::vfsStreamWrapper.
 *
 * @package     bovigo_vfs
 * @subpackage  test
 */
abstract class vfsStreamWrapperBaseTestCase extends PHPUnit_Framework_TestCase
{
    /**
     * root directory
     *
     * @var  vfsStreamDirectory
     */
    protected $foo;
    /**
     * URL of root directory
     *
     * @var  string
     */
    protected $fooURL;
    /**
     * sub directory
     *
     * @var  vfsStreamDirectory
     */
    protected $bar;
    /**
     * URL of sub directory
     *
     * @var  string
     */
    protected $barURL;
    /**
     * a file
     *
     * @var  vfsStreamFile
     */
    protected $baz1;
    /**
     * URL of file 1
     *
     * @var  string
     */
    protected $baz1URL;
    /**
     * another file
     *
     * @var  vfsStreamFile
     */
    protected $baz2;
    /**
     * URL of file 2
     *
     * @var  string
     */
    protected $baz2URL;

    /**
     * set up test environment
     */
    public function setUp()
    {
        $this->fooURL  = vfsStream::url('foo');
        $this->barURL  = vfsStream::url('foo/bar');
        $this->baz1URL = vfsStream::url('foo/bar/baz1');
        $this->baz2URL = vfsStream::url('foo/baz2');
        $this->foo     = new vfsStreamDirectory('foo');
        $this->foo->setFilemtime(100);
        $this->bar     = new vfsStreamDirectory('bar');
        $this->bar->setFilemtime(200);
        $this->baz1    = vfsStream::newFile('baz1')->lastModified(300)->withContent('baz 1');
        $this->baz2    = vfsStream::newFile('baz2')->withContent('baz2')->setFilemtime(400);
        $this->bar->addChild($this->baz1);
        $this->foo->addChild($this->bar);
        $this->foo->addChild($this->baz2);
        vfsStreamWrapper::register();
        vfsStreamWrapper::setRoot($this->foo);
    }
}
?>
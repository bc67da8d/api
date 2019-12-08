<?php
namespace Lackky\Aws;

use Phalcon\Http\Request\FileInterface;

class File implements FileInterface
{
    /**
     * @var \SplFileInfo
     */
    protected $obj;

    /**
     * File constructor.
     *
     * @param string $file
     */
    public function __construct($file)
    {
        $obj = new \SplFileInfo($file);
        $this->obj = $obj;
    }
    /**
     * @return string|null
     */
    public function getError()
    {
    }

    /**
     * @return string|null
     */
    public function getKey()
    {
    }

    /**
     * @return string
     */
    public function getExtension()
    {
        return $this->obj->getExtension();
    }


    /**
     * Returns the file size of the uploaded file
     *
     * @return int
     */
    public function getSize()
    {
        return $this->obj->getSize();
    }

    /**
     * Returns the real name of the uploaded file
     *
     * @return string
     */
    public function getName()
    {
        return $this->obj->getFilename();
    }

    /**
     * Returns the temporary name of the uploaded file
     *
     * @return string
     */
    public function getTempName()
    {
        return $this->obj->getPathname();
    }

    /**
     * Returns the mime type reported by the browser
     * This mime type is not completely secure, use getRealType() instead
     *
     * @return string
     */
    public function getType()
    {
        return $this->obj->getType();
    }

    /**
     * Gets the real mime type of the upload file using finfo
     *
     * @return string
     */
    public function getRealType()
    {
        if (in_array($this->obj->getExtension(), ['png', 'jpg', 'jpeg'])) {
            return 'image/' . $this->obj->getExtension();
        }
        return 'video/' . $this->obj->getExtension();
    }

    /**
     * Checks whether the file has been uploaded via Post.
     *
     * @return bool
     */
    public function isUploadedFile()
    {
    }

    /**
     * Moves the temporary file to a destination within the application
     *
     * @param string $destination
     * @return bool
     */
    public function moveTo($destination)
    {
    }
}

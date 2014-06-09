<?php namespace PHRETS\Models;

class Object
{
    protected $content_type;
    protected $content_id;
    protected $object_id;
    protected $mime_version;
    protected $location;
    protected $content_description;
    protected $content_sub_description;
    protected $content;

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContentDescription()
    {
        return $this->content_description;
    }

    /**
     * @param mixed $content_description
     * @return $this
     */
    public function setContentDescription($content_description)
    {
        $this->content_description = $content_description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContentId()
    {
        return $this->content_id;
    }

    /**
     * @param mixed $content_id
     * @return $this
     */
    public function setContentId($content_id)
    {
        $this->content_id = $content_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContentSubDescription()
    {
        return $this->content_sub_description;
    }

    /**
     * @param mixed $content_sub_description
     * @return $this
     */
    public function setContentSubDescription($content_sub_description)
    {
        $this->content_sub_description = $content_sub_description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContentType()
    {
        return $this->content_type;
    }

    /**
     * @param mixed $content_type
     * @return $this
     */
    public function setContentType($content_type)
    {
        $this->content_type = $content_type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     * @return $this
     */
    public function setLocation($location)
    {
        $this->location = $location;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMimeVersion()
    {
        return $this->mime_version;
    }

    /**
     * @param mixed $mime_version
     * @return $this
     */
    public function setMimeVersion($mime_version)
    {
        $this->mime_version = $mime_version;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getObjectId()
    {
        return $this->object_id;
    }

    /**
     * @param mixed $object_id
     * @return $this
     */
    public function setObjectId($object_id)
    {
        $this->object_id = $object_id;
        return $this;
    }

    public function setFromHeader($name, $value)
    {
        $headers = [
            'Content-Description' => 'ContentDescription',
            'Content-Sub-Description' => 'ContentSubDescription',
            'Content-ID' => 'ContentId',
            'Object-ID' => 'ObjectId',
            'Location' => 'Location',
            'Content-Type' => 'ContentType',
            'MIME-Version' => 'MimeVersion',
        ];

        $headers = array_change_key_case($headers, CASE_UPPER);

        if (array_key_exists(strtoupper($name), $headers)) {
            $method = 'set' . $headers[strtoupper($name)];
            $this->$method($value);
        }
    }

    /**
     * @return $this
     */
    public function downloadFromURL()
    {
        $this->setContent(file_get_contents($this->getLocation()));
        return $this;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return strlen($this->getContent());
    }
}
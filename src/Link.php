<?php

class Link
{
    /**
     * @var int
     */
    protected $id;
    /**
     * @var string
     */
    protected $real_url;

    /**
     * @var string
     */
    protected $code;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param $code string
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getRealUrl()
    {
        return $this->real_url;
    }

    /**
     * @param $real_url string
     */
    public function setRealUrl($real_url)
    {
        $this->real_url = $real_url;
    }

    /**
     * @PrePersist @PreUpdate
     */
    public function validate()
    {
        if ($this->real_url == null) {
            throw new \Exception('Empty url');
        }

        $this->real_url = preg_replace("/%u([0-9a-f]{3,4})/i", "&#x\\1;", urldecode($this->real_url));
        $this->real_url = strip_tags(html_entity_decode($this->real_url, null, 'UTF-8'));

        if (strlen($this->real_url) == 0) {
            throw new \Exception('Incorrect url');
        }

        return true;
    }
}

?>

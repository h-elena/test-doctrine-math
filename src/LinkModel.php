<?php

class LinkModel
{
    protected $entityManager;

    public function __construct()
    {
        require_once __DIR__ . "/../bootstrap.php";
        $this->entityManager = $entityManager;
    }

    public function createLink(string $str): string
    {
        $link = new Link();
        $link->setRealUrl($str);

        $code = md5($str . time());
        $link->setCode($code);

        if ($link->validate()) {
            $this->entityManager->persist($link);
            $this->entityManager->flush();

            return (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . $code;
        } else {
            return false;
        }
    }

    /**
     * @return bool
     */
    protected function validateCode(string $code): bool
    {
        if ($code == null) {
            throw new \Exception('Empty url');
        }

        $code = filter_var(
            $code,
            FILTER_VALIDATE_REGEXP,
            array('options' => array('regexp' => '/[a-z0-9]+/is'))
        );

        if (strlen($code) == 0) {
            throw new \Exception('Incorrect url');
        }

        return true;
    }

    /**
     * @param string $code
     * @return bool
     * @throws Exception
     */
    public function getRealUrl(string $code)
    {
        $link = new Link();
        $link->setCode($code);

        if ($this->validateCode($code)) {
            if ($url = $this->entityManager->getRepository('Link')->findOneBy(array('code' => $code))) {
                return $url->getRealUrl();
            }
        }

        return false;
    }

}
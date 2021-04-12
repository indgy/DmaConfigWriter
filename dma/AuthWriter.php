<?php

namespace Dma;


class AuthWriter extends Writer
{
    # The filepath of the config file to write
    protected $filepath = "/etc/dma/auth.conf";
    # The mail host name
    protected $host;
    # The mail host auth username
    protected $username;
    # The mail host auth password
    protected $password;


    /**
     * Returns the formatted auth.conf file contents
     *
     * @return String
     */
    public function getContents(): String
    {
        $header = sprintf("# Automatically generated on %s by Dma\AuthWriter", date("r"));
        return sprintf("%s\n%s|%s:%s", $header, $this->username, $this->host, $this->password);
    }
}

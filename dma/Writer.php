<?php

namespace Dma;

use RuntimeException;


class Writer
{
    /**
     * Returns an array of editable config vars
     *
     * @return Array
     */
    public function getConfigVars(): Array
    {
        $vars = get_object_vars($this);
        unset($vars["filepath"]);

        return $vars;
    }
    /**
     * Sets the config values from the provided name=>value pairs array
     *
     * @param Array<String,Mixed> $config An array of name=>value pairs 
     * @return void
     */
    public function setConfig(Array $config): Void
    {
        $vars = $this->getConfigVars();
        foreach ($config as $name=>$value) {
            if (array_key_exists($name, $vars)) {
                $this->$name = $value;
            }
        }
    }
    /**
     * Sets the filepath of the config file to write
     *
     * @param String $path The filepath 
     * @return void
     */
    public function setFilepath(String $path): Void
    {
        $this->filepath = $path;
    }
    /**
     * Writes the config to file
     *
     * @return void
     */
    public function write(): Void
    {
        if ( ! is_dir(dirname($this->filepath))) {
            if (false === mkdir(dirname($this->filepath), 0755, true)) {
                throw new RuntimeException("Failed to create config path");
            }
        }
        if (false === touch($this->filepath)) {
            throw new RuntimeException("Failed to create mail config file");
        }
        if (false === chmod($this->filepath, 0600)) {
            throw new RuntimeException("Failed to change mail config permissions");
        }
        if (false === is_writeable($this->filepath)) {
            throw new RuntimeException("Cannot write to mail config file");
        }

        if (false === file_put_contents($this->filepath, $this->getContents())) {
            throw new RuntimeException("Failed writing to mail config file");
        }
    }
}

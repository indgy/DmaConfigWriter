<?php

namespace Dma;


class ConfWriter extends Writer
{
    # The filepath of the config file to write
    protected $filepath = "/etc/dma/dma.conf";
    # Your smarthost (also called relayhost).  Leave blank if you don't want smarthost support.
    protected $smarthost = false;
    # Use this SMTP port.  Most users will be fine with the default (25)
    protected $port = false;
    # Path to your alias file.  Just stay with the default.
    protected $aliases = "/etc/aliases";
    # Path to your spooldir.  Just stay with the default.
    protected $spooldir = "/var/spool/dma";
    # SMTP authentication
    protected $authpath = "/etc/dma/auth.conf";
    # Uncomment if yout want TLS/SSL support
    protected $securetransfer = false;
    # Uncomment if you want STARTTLS support (only used in combination with SECURETRANSFER)
    protected $starttls = false;
    # Uncomment if you have specified STARTTLS above and it should be allowed
    # to fail ("opportunistic TLS", use an encrypted connection when available
    # but allow an unencrypted one to servers that do not support it)
    protected $opportunistic_tls = false;
    # Path to your local SSL certificate
    protected $certfile = false;
    # If you want to use plain text SMTP login without using encryption, change
    # the SECURE entry below to INSECURE.  Otherwise plain login will only work
    # over a secure connection.  Use this option with caution.
    protected $secure = false;
    # Uncomment if you want to defer your mails.  This is useful if you are
    # behind a dialup line.  You have to submit your mails manually with dma -q
    protected $defer = false;
    # Uncomment if you want the bounce message to include the complete original
    # message, not just the headers.
    protected $fullbounce = false;
    # The internet hostname dma uses to identify the host.
    # If not set or empty, the result of gethostname(2) is used.
    # If MAILNAME is an absolute path to a file, the first line of this file
    # will be used as the hostname.
    protected $mailname = false;
    # Masquerade envelope from addresses with this address/hostname.
    # Use this if mails are not accepted by destination mail servers because
    # your sender domain is invalid.
    # By default, MASQUERADE is not set.
    # Format: MASQUERADE [user@][host]
    # Examples:
    # MASQUERADE john@  on host "hamlet" will send all mails as john@hamlet
    # MASQUERADE percolator  will send mails as $username@percolator, e.g. fish@percolator
    # MASQUERADE herb@ert  will send all mails as herb@ert
    protected $masquerade = false;
    # Directly forward the mail to the SMARTHOST bypassing aliases and local delivery
    protected $nullclient = false;


    /**
     * Returns the formatted dma.conf file contents
     *
     * @return String
     */
    public function getContents()
    {
        $out = [];
        $header = sprintf("# Automatically generated on %s by Dma\ConfWriter", date("r"));
        $out[] = $header;
        foreach ($this->getConfigVars() as $name=>$value) {
            $out[] = $this->getLine($name, $value);
        }
        // adds final new line
        $out[] = "";

        return join("\n", $out);
    }
    /**
     * Returns a formatted config line entry, where:
     * false or default values are commented, true values are uncommented
     * and non empty values are unquoted strings
     *
     * @param String $name The config name
     * @param Mixed $value The config value
     * @return String
     */
    private function getLine(String $name, $value): String
    {
        if (false === $value) {
            return sprintf('#%s', strtoupper($name));
        }
        if (true === $value) {
            return sprintf('%s', strtoupper($name));
        }

        return sprintf('%s %s', strtoupper($name), $value);
    }
}

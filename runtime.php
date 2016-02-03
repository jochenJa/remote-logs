<?php

class Runtime
{
    const FINISHED = 'finished';
    const PROGRESS = 'progress';

    private $logs;
    private $status;

    public function __construct($logs, $status)
    {
        $this->logs = $logs;
        $this->status = $status;
    }

    public function log($line)
    {
        $this->logs[] = array(strtolower($line), date('H:i:s', time()));
    }

    public function reset()
    {
        $this->logs = array();
    }

    public function finished()
    {
        $this->status = self::FINISHED;
    }

    public function progress()
    {
        $this->status = self::PROGRESS;
    }

    public function __toString()
    {
        return json_encode(
            array(
                'finished' => $this->status == self::FINISHED ? 1 : 0,
                'progress' => $this->status == self::PROGRESS ? 1 : 0,
                'lines' => array_slice($this->logs, -35)
            )
        );
    }


}

class SH
{
    const LOGS = 'SHLOGS';
    const STATUS = 'SHSTATUS';

    /** @var  Runtime */
    static $runtime;

    public static function load()
    {
        if (is_object(self::$runtime))
        {
            return;
        }

        if (isset($_SESSION[self::LOGS]) && is_object($_SESSION[self::LOGS]))
        {
            self::$runtime = $_SESSION[self::LOGS];
            return;
        }

        self::reset();
    }

    public static function log($line)
    {
        self::load();
        self::$runtime->log($line);
    }

    public static function finish()
    {
        self::load();
        self::$runtime->finished();
    }

    public static function flush()
    {
        self::load();
        return (string)self::$runtime;
    }

    public static function reset()
    {
        $_SESSION[self::LOGS] = self::$runtime = new Runtime(
            array(),
            Runtime::PROGRESS
        );
    }
}

function __($line)
{
    SH::log($line);
}


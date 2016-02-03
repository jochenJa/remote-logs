<?php

/**
 * Created by PhpStorm.
 * User: jochen
 * Date: 2/02/2016
 * Time: 21:29
 */
session_start();
$runtime = Runtime::init();
//$runtime->reset();
$runtime->progress();
$runtime->log('test');
$runtime->finished();

echo $runtime;
exit;

class Runtime
{
    const FINISHED = 'finished';
    const PROGRESS = 'progress';

    private $logs;
    private $status;

    public static function init()
    {
        if (!($_SESSION['shell'] instanceof self))
        {
            $_SESSION['shell'] = new self();
        }

        return $_SESSION['shell'];
    }

    private function __construct()
    {
        $this->reset();
        $this->progress();
    }

    public function log($line)
    {
        $this->logs[] = array($line, date('H:i:s', time()));
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


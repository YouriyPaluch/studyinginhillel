<?php

namespace Homework\PhpPro\Models;

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

use Homework\PhpPro\Interfaces\IMyLogger;

class MyLogger implements IMyLogger {
    /**
     * @var string
     */
    protected string $pathLog;

    /**
     * @param string $pathLog
     */
    public function __construct(string $pathLog) {
        $this->pathLog = $pathLog . '/my-logs/log.log';
    }

    /**
     * @param string $message
     * @param string $level
     * @return void
     */
    public function log(string $message, string $level = ''): void {
        $log = new Logger('first');
        switch ($level) {
            case 'debug':
                $log->pushHandler(new StreamHandler($this->pathLog, Level::Debug));
                $log->debug($message);
                break;
            case 'notice':
                $log->pushHandler(new StreamHandler($this->pathLog, Level::Notice));
                $log->notice($message);
                break;
            case 'warning':
                $log->pushHandler(new StreamHandler($this->pathLog, Level::Warning));
                $log->warning($message);
                break;
            case 'error':
                $log->pushHandler(new StreamHandler($this->pathLog, Level::Error));
                $log->error($message);
                break;
            case 'critical':
                $log->pushHandler(new StreamHandler($this->pathLog, Level::Critical));
                $log->critical($message);
                break;
            case 'alert':
                $log->pushHandler(new StreamHandler($this->pathLog, Level::Alert));
                $log->alert($message);
                break;
            case 'emergency':
                $log->pushHandler(new StreamHandler($this->pathLog, Level::Emergency));
                $log->emergency($message);
                break;
            default:
                $log->pushHandler(new StreamHandler($this->pathLog, Level::Info));
                $log->info($message);
                break;
        }

        $log->error('Bar');
    }
}
<?php

namespace Homework\PhpPro\Coder;

use Homework\PhpPro\Coder\Interfaces\IMyLogger;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;

class MyLogger implements IMyLogger {

    /**
     * @param string $pathLog
     */
    public function __construct(
        protected string $pathLog,
        protected Logger $log
    )
    {}

    /**
     * @param string $message
     * @param string $level
     * @return void
     */
    public function log(string $message, string $level = ''): void {
        switch ($level) {
            case 'debug':
                $this->log->pushHandler(new StreamHandler($this->pathLog, Level::Debug));
                $this->log->debug($message);
                break;
            case 'notice':
                $this->log->pushHandler(new StreamHandler($this->pathLog, Level::Notice));
                $this->log->notice($message);
                break;
            case 'warning':
                $this->log->pushHandler(new StreamHandler($this->pathLog, Level::Warning));
                $this->log->warning($message);
                break;
            case 'error':
                $this->log->pushHandler(new StreamHandler($this->pathLog, Level::Error));
                $this->log->error($message);
                break;
            case 'critical':
                $this->log->pushHandler(new StreamHandler($this->pathLog, Level::Critical));
                $this->log->critical($message);
                break;
            case 'alert':
                $this->log->pushHandler(new StreamHandler($this->pathLog, Level::Alert));
                $this->log->alert($message);
                break;
            case 'emergency':
                $this->log->pushHandler(new StreamHandler($this->pathLog, Level::Emergency));
                $this->log->emergency($message);
                break;
            default:
                $this->log->pushHandler(new StreamHandler($this->pathLog, Level::Info));
                $this->log->info($message);
                break;
        }
    }
}
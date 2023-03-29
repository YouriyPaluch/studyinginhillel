<?php

namespace Homework\PhpPro\Interfaces;

interface IMyLogger {
    /**
     * @param string $message
     * @param string $level
     * @return void
     */
    public function log(string $message, string $level = ''): void;
}
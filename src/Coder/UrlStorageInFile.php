<?php

namespace Homework\PhpPro\Coder;

use Homework\PhpPro\Coder\Interfaces\IUrlStorage;
use InvalidArgumentException;

class UrlStorageInFile implements IUrlStorage
{

    protected array $data = [];

    /**
     * @param string $filePath
     */
    public function __construct(protected string $filePath)
    {
        $this->getData();
    }

    /**
     * @return string
     */
    public function getFilePath(): string
    {
        return $this->filePath;
    }

    /**
     * @return void
     */
    public function getData(): void
    {
        if (file_exists($this->filePath)) {
            $this->data = (array) json_decode(file_get_contents($this->filePath));
        }
    }

    /**
     * @param string $url
     * @return string
     */
    public function getCodeByUrl(string $url): string
    {
        if (!$code = array_search($url, $this->data)) {
            throw new InvalidArgumentException('Code not found');
        }
        return $code;
    }

    /**
     * @param string $code
     * @return string
     */
    public function getUrlByCode(string $code): string
    {
        if (empty($this->data[$code])) {
            throw new InvalidArgumentException('File not has code: ' . $code);
        }

        return $this->data[$code];
    }

    /**
     * @param string $code
     * @param string $url
     * @return bool
     */
    public function saveCode(string $code, string $url): bool
    {
        $this->data[$code] = $url;
        return true;
    }

    /**
     * @param string $dataInFile
     * @return void
     */
    public function addToStorage(string $dataInFile): void
    {
        $file = fopen($this->filePath, 'w+');
        fwrite($file, $dataInFile);
        fclose($file);
    }

    public function __destruct()
    {
        $this->addToStorage(json_encode($this->data));
    }
}
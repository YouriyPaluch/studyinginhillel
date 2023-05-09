<?php

namespace Homework\PhpPro\Coder\Interfaces;

interface IUrlStorage {

	/**
	 * @param string $url
	 * @return string
	 */
	public function getCodeByUrl(string $url): string;

	/**
	 * @param string $code
	 * @return string
	 */
	public function getUrlByCode(string $code): string;

	/**
	 * @param string $code
	 * @param string $url
	 * @return bool
	 */
	public function saveCode(string $code, string $url): bool;
}
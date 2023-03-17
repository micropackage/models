<?php

declare(strict_types=1);

namespace Micropackage\Models\Traits;

use Closure;

trait Rememberable
{
	/**
	 * Storage used by trait.
	 *
	 * @var  array<string, array<string-class, mixed>>
	 */
	private static array $rememberStorage = [];

	/**
	 * Gets and remembers object data for given key.
	 *
	 * @param   string   $key      Data key.
	 * @param   Closure  $callback Callback to execute when value is not stored.
	 * @return  mixed
	 */
	protected static function remember(string $key, Closure $callback)
	{
		if (!isset(self::$rememberStorage[static::class][$key])) {
			self::$rememberStorage[static::class][$key] = $callback();
		}

		return self::$rememberStorage[static::class][$key];
	}
}

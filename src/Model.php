<?php
/**
 * Abstract class defining base model methods.
 *
 * @package micropackage/models
 */

declare(strict_types=1);

namespace Micropackage\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Stringable;
use Micropackage\DocHooks\HookTrait;
use Micropackage\Models\Traits\Rememberable;

/**
 * Model class
 */
abstract class Model
{
	use HookTrait;
	use Rememberable;

	/**
	 * Object class name suffix
	 */
	protected static string $suffix;

	/**
	 * Model constructor.
	 */
	public function __construct()
	{
		$this->add_hooks();
	}

	/**
	 * Returns post type slug.
	 *
	 * @return string
	 */
	public static function getSlug(): string
	{
		/** @var string */
		return self::remember(
			'slug',
			static function (): string {
				return Str::of(static::class)
				->when(
					static::$suffix,
					static function (Stringable $slug, string $suffix) {
						return $slug->replaceMatches("/{$suffix}$/", '');
					}
				)
				->classBasename()
				->kebab()
				->value();
			}
		);
	}

	/**
	 * Returns post type name.
	 *
	 * @return string
	 */
	public static function getName(): string
	{
		/** @var string */
		return self::remember(
			'name',
			static function (): string {
				return Str::of(static::getSlug())
				->replace('-', ' ')
				->title()
				->singular()
				->value();
			}
		);
	}

	/**
	 * Returns post type name in plural form.
	 *
	 * @return string
	 */
	public static function getPluralName(): string
	{
		/** @var string */
		return self::remember(
			'pluralName',
			static function (): string {
				return Str::of(static::getName())
				->plural()
				->value();
			}
		);
	}

	/**
	 * Returns a list of label templates.
	 *
	 * @return array<string, string>
	 */
	protected static function getLabelTemplates(): array
	{
		return array_merge(
			[
				/* translators: %s is a post type or taxonomy name. */
				'add_new_item' => sprintf(__('Add New %s', 'micropackage-models'), '{singular}'),
				/* translators: %s is a post type or taxonomy name. */
				'all_items' => sprintf(__('All %s', 'micropackage-models'), '{plural}'),
				/* translators: %s is a post type or taxonomy name. */
				'edit_item' => sprintf(__('Edit %s', 'micropackage-models'), '{singular}'),
				'item_link' => sprintf(
					/* translators: %s is a post type or taxonomy name. */
					_x('%s Link', 'navigation link block title', 'micropackage-models'),
					'{singular}'
				),
				'item_link_description' => sprintf(
					/* translators: %s is a post type or taxonomy name. */
					_x('A link to a %s.', 'navigation link block description', 'micropackage-models'),
					'{singularLower}'
				),
				/* translators: %s is a post type or taxonomy name. */
				'items_list' => sprintf(__('%s list', 'micropackage-models'), '{plural}'),
				/* translators: %s is a post type or taxonomy name. */
				'items_list_navigation' => sprintf(__('%s list navigation', 'micropackage-models'), '{plural}'),
				'name' => '{plural}',
				/* translators: %s is a post type or taxonomy name. */
				'not_found' => sprintf(__('No %s found.', 'micropackage-models'), '{pluralLower}'),
				/* translators: %s is a post type or taxonomy name. */
				'parent_item_colon' => sprintf(__('Parent %s:', 'micropackage-models'), '{singular}'),
				/* translators: %s is a post type or taxonomy name. */
				'search_items' => sprintf(__('Search %s', 'micropackage-models'), '{plural}'),
				'singular_name' => '{singular}',
				/* translators: %s is a post type or taxonomy name. */
				'view_item' => sprintf(__('View %s', 'micropackage-models'), '{singular}'),
			],
			static::getObjectLabelTemplates()
		);
	}

	/**
	 * Returns object-specific labels.
	 *
	 * @return array<string, string>
	 */
	abstract protected static function getObjectLabelTemplates(): array;

	/**
	 * Returns prepared post type labels.
	 *
	 * @return array<string, string>
	 */
	public static function getLabels(): array
	{
		$name = static::getName();
		$pluralName = static::getPluralName();

		$search = [
			'{singular}',
			'{singularLower}',
			'{plural}',
			'{pluralLower}',
		];

		$replace = [
			$name,
			Str::lower($name),
			$pluralName,
			Str::lower($pluralName),
		];

		$labels = array_map(
			static fn ($item) => str_replace($search, $replace, $item),
			static::getLabelTemplates()
		);

		return $labels;
	}

	/**
	 * Returns post type args.
	 *
	 * @return array<string, mixed>
	 */
	protected static function getArgs(): array
	{
		return [];
	}
}

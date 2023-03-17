<?php
/**
 * Abstract class of taxonomy model.
 *
 * @package micropackage/models
 */

declare(strict_types=1);

namespace Micropackage\Models;

/**
 * Taxonomy abstract class
 */
abstract class Taxonomy extends Model
{
	/**
	 * Object class name suffix
	 */
	protected static string $suffix = 'Taxonomy';

	/**
	 * Object types this taxonomy will be associated with.
	 *
	 * @var array<string>
	 */
	protected static array $objectTypes = [];

	/**
	 * Returns an array of object types with which ths taxonomy should be associated.
	 *
	 * @return array<string> Object types.
	 */
	public static function getObjectTypes(): array
	{
		return array_map(
			static fn ($type) => class_exists($type) && is_subclass_of($type, PostType::class)
				? $type::getSlug()
				: $type,
			static::$objectTypes
		);
	}

	/**
	 * Returns a list of label templates.
	 *
	 * @return array<string, string>
	 */
	protected static function getObjectLabelTemplates(): array
	{
		return [
			/* translators: %s is a taxonomy name. */
			'add_or_remove_items' => sprintf(__('Add or remove %s', 'micropackage-wp-objects'), '{pluralLower}'),
			/* translators: %s is a taxonomy name. */
			'back_to_items' => sprintf(__('Go to %s', 'micropackage-wp-objects'), '{plural}'),
			'choose_from_most_used' => sprintf(
				/* translators: %s is a taxonomy name. */
				__('Choose from the most used %s', 'micropackage-wp-objects'),
				'{pluralLower}'
			),
			/* translators: %s is a taxonomy name. */
			'filter_by_item' => sprintf(__('Filter by %s', 'micropackage-wp-objects'), '{singularLower}'),
			'most_used' => __('Most Used', 'micropackage-wp-objects'),
			/* translators: %s is a taxonomy name. */
			'new_item_name' => sprintf(__('New %s Name', 'micropackage-wp-objects'), '{singular}'),
			/* translators: %s is a taxonomy name. */
			'no_terms' => sprintf(__('No %s', 'micropackage-wp-objects'), '{pluralLower}'),
			/* translators: %s is a taxonomy name. */
			'parent_item' => sprintf(__('Parent %s', 'micropackage-wp-objects'), '{singular}'),
			/* translators: %s is a taxonomy name. */
			'popular_items' => sprintf(__('Popular %s', 'micropackage-wp-objects'), '{plural}'),
			'separate_items_with_commas' => sprintf(
				/* translators: %s is a taxonomy name. */
				__('Separate %s with commas', 'micropackage-wp-objects'),
				'{pluralLower}'
			),
			/* translators: %s is a taxonomy name. */
			'update_item' => sprintf(__('Update %s', 'micropackage-wp-objects'), '{singular}'),
		];
	}

	/**
	 * Registers a post type.
	 *
	 * @action init
	 *
	 * @return void
	 */
	public function register(): void
	{
		register_taxonomy(
			static::getSlug(),
			static::getObjectTypes(),
			// @phpstan-ignore-next-line
			array_merge(
				static::getArgs(),
				['labels' => static::getLabels()]
			)
		);
	}
}

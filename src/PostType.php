<?php
/**
 * Abstract class of post type model.
 *
 * @package micropackage/models
 */

declare(strict_types=1);

namespace Micropackage\Models;

use Illuminate\Support\Str;

/**
 * Post type abstract class
 */
abstract class PostType extends Model
{
	/**
	 * Object class name suffix
	 */
	protected static string $suffix = 'PostType';

	/**
	 * Featured image name
	 */
	protected static string $featuredImageName;

	/**
	 * Returns a list of label templates.
	 *
	 * @return array<string, string>
	 */
	protected static function getObjectLabelTemplates(): array
	{
		return [
			/* translators: %s is a post type name. */
			'archives' => sprintf(__('%s Archives', 'micropackage-models'), '{singular}'),
			/* translators: %s is a post type name. */
			'attributes' => sprintf(__('%s Attributes', 'micropackage-models'), '{singular}'),
			/* translators: %s is a post type name. */
			'filter_items_list' => sprintf(__('Filter %s list', 'micropackage-models'), '{pluralLower}'),
			/* translators: %s is a post type name. */
			'insert_into_item' => sprintf(__('Insert into %s', 'micropackage-models'), '{singularLower}'),
			/* translators: %s is a post type name. */
			'item_published' => sprintf(__('%s published.', 'micropackage-models'), '{singular}'),
			'item_published_privately' => sprintf(
				/* translators: %s is a post type name. */
				__('%s published privately.', 'micropackage-models'),
				'{singular}'
			),
			/* translators: %s is a post type name. */
			'item_reverted_to_draft' => sprintf(__('%s reverted to draft.', 'micropackage-models'), '{singular}'),
			/* translators: %s is a post type name. */
			'item_scheduled' => sprintf(__('%s scheduled.', 'micropackage-models'), '{singular}'),
			/* translators: %s is a post type name. */
			'item_updated' => sprintf(__('%s updated.', 'micropackage-models'), '{singular}'),
			/* translators: %s is a post type name. */
			'new_item' => sprintf(__('New %s', 'micropackage-models'), '{singular}'),
			/* translators: %s is a post type name. */
			'not_found_in_trash' => sprintf(__('No %s found in Trash.', 'micropackage-models'), '{pluralLower}'),
			/* translators: %s is a post type name. */
			'uploaded_to_this_item' => sprintf(__('Uploaded to this %s', 'micropackage-models'), '{singularLower}'),
			/* translators: %s is a post type name. */
			'view_items' => sprintf(__('View %s', 'micropackage-models'), '{plural}'),
		];
	}

	/**
	 * Returns featured image labels.
	 *
	 * @return array<string, string>
	 */
	protected static function getFeaturedImageLabels(): array
	{
		$featuredImageName = static::$featuredImageName ?? __('featured image', 'micropackage-models');

		return array_map(
			static fn ($value) => Str::ucfirst(sprintf($value, $featuredImageName)),
			[
				'featured_image' => '%s',
				/* translators: %s is a featured image name. */
				'set_featured_image' => __('Set %s', 'micropackage-models'),
				/* translators: %s is a featured image name. */
				'remove_featured_image' => __('Remove %s', 'micropackage-models'),
				/* translators: %s is a featured image name. */
				'use_featured_image' => __('Use as %s', 'micropackage-models'),
			]
		);
	}

	/**
	 * Returns prepared post type labels.
	 *
	 * @return array<string, string>
	 */
	public static function getLabels(): array
	{
		return array_merge(
			parent::getLabels(),
			static::getFeaturedImageLabels()
		);
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
		// phpcs:ignore WordPress.NamingConventions.ValidPostTypeSlug.NotStringLiteral
		register_post_type(
			static::getSlug(),
			// @phpstan-ignore-next-line
			array_merge(
				static::getArgs(),
				['labels' => static::getLabels()]
			)
		);
	}
}

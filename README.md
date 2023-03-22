# Models

[![BracketSpace Micropackage](https://img.shields.io/badge/BracketSpace-Micropackage-brightgreen)](https://bracketspace.com)
[![Latest Stable Version](https://poser.pugx.org/micropackage/models/v/stable)](https://packagist.org/packages/micropackage/models)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/micropackage/models.svg)](https://packagist.org/packages/micropackage/models)
[![Total Downloads](https://poser.pugx.org/micropackage/models/downloads)](https://packagist.org/packages/micropackage/models)
[![License](https://poser.pugx.org/micropackage/models/license)](https://packagist.org/packages/micropackage/models)

<p align="center">
    <img src="https://bracketspace.com/extras/micropackage/micropackage-small.png" alt="Micropackage logo"/>
</p>

## 🧬 About Models

Package that simplifies registration of WordPress Model-like objects - Custom Post Types and Custom Taxonomies. Automatically generates name, slug and all required labels of Models.

## 💾 Installation

``` bash
composer require micropackage/models
```

## 🕹 Usage

### Adding new Custom Post Type

> Classname of Post Types should ends with `PostType`.

```php
<?php

use Micropackage\Models\PostType;

class TestimonialPostType extends PostType
{
	/**
	 * Define icon, whether post type should be public and other attributes.
	 * Labels will be generated automatically.
	 *
	 * @see https://developer.wordpress.org/reference/functions/register_post_type/
	 */
	protected static function getArgs(): array
	{
		return [
			'menu_icon' => 'dashicons-cart',
			'public' => true,
		];
	}
}

new TestimonialPostType();
```

### Adding new Custom Taxonomy

> Classname of Taxonomies should ends with `Taxonomy`.

```php
<?php

use Micropackage\Models\Taxonomy;

class PlaceTaxonomy extends Taxonomy
{
	/**
	 * Define to which post types taxonomy should belongs.
	 *
	 * You can use slug of any post types or classname of post types created
	 * using this package.
	 */
	protected static array $objectTypes = [
		'product',
		TestimonialPostType::class,
	];

	/**
	 * Define whether taxonomy should be hierarchical and other attributes.
	 * Labels will be generated automatically.
	 *
	 * @see https://developer.wordpress.org/reference/functions/register_taxonomy/
	 */
	protected static function getArgs(): array
	{
		return [
			'hierarchical' => true,
		];
	}
}

new PlaceTaxonomy();
```
## 📦 About the Micropackage project

Micropackages - as the name suggests - are micro packages with a tiny bit of reusable code, helpful particularly in WordPress development.

The aim is to have multiple packages which can be put together to create something bigger by defining only the structure.

Micropackages are maintained by [BracketSpace](https://bracketspace.com).

## 📖 Changelog

[See the changelog file](./CHANGELOG.md).

## 📃 License

GNU General Public License (GPL) v3.0. See the [LICENSE](./LICENSE) file for more information.

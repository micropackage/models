<?php

use Micropackage\Models\Taxonomy;
use Micropackage\Models\PostType;

test('it generates slug', function() {
	$this->assertSame('example', ExampleTaxonomy::getSlug());
	$this->assertSame('multiple-words', MultipleWordsTaxonomy::getSlug());
	$this->assertSame('taxonomy-without-suffix', TaxonomyWithoutSuffix::getSlug());
});

test('it generates singular name', function() {
	$this->assertSame('Example', ExampleTaxonomy::getName());
	$this->assertSame('Multiple Word', MultipleWordsTaxonomy::getName());
	$this->assertSame('Taxonomy Without Suffix', TaxonomyWithoutSuffix::getName());
});

test('it generates plural name', function() {
	$this->assertSame('Examples', ExampleTaxonomy::getPluralName());
	$this->assertSame('Multiple Words', MultipleWordsTaxonomy::getPluralName());
	$this->assertSame('Taxonomy Without Suffixes', TaxonomyWithoutSuffix::getPluralName());
});

test('it gets object types', function() {
	$this->assertSame([], ExampleTaxonomy::getObjectTypes());
	$this->assertSame(['test'], MultipleWordsTaxonomy::getObjectTypes());
	$this->assertSame(['foo', 'other-post-type'], TaxonomyWithoutSuffix::getObjectTypes());
});

test('it generates labels', function() {
	$this->assertSame([
		'add_new_item' => 'Add New Example',
		'all_items' => 'All Examples',
		'edit_item' => 'Edit Example',
		'item_link' => 'Example Link',
		'item_link_description' => 'A link to a example.',
		'items_list' => 'Examples list',
		'items_list_navigation' => 'Examples list navigation',
		'name' => 'Examples',
		'not_found' => 'No examples found.',
		'parent_item_colon' => 'Parent Example:',
		'search_items' => 'Search Examples',
		'singular_name' => 'Example',
		'view_item' => 'View Example',
		'add_or_remove_items' => 'Add or remove examples',
		'back_to_items' => 'Go to Examples',
		'choose_from_most_used' => 'Choose from the most used examples',
		'filter_by_item' => 'Filter by example',
		'most_used' => 'Most Used',
		'new_item_name' => 'New Example Name',
		'no_terms' => 'No examples',
		'parent_item' => 'Parent Example',
		'popular_items' => 'Popular Examples',
		'separate_items_with_commas' => 'Separate examples with commas',
		'update_item' => 'Update Example',
	], ExampleTaxonomy::getLabels());
});

class ExampleTaxonomy extends Taxonomy
{
	//
}

class MultipleWordsTaxonomy extends Taxonomy
{
	protected static array $objectTypes = ['test'];
}

class FooPostType extends PostType
{
	//
}

class TaxonomyWithoutSuffix extends Taxonomy
{
	protected static array $objectTypes = [FooPostType::class, 'other-post-type'];
}

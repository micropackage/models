<?php

use Micropackage\Models\PostType;

test('it generates slug', function() {
	$this->assertSame('example', ExamplePostType::getSlug());
	$this->assertSame('multiple-words', MultipleWordsPostType::getSlug());
	$this->assertSame('post-type-without-suffix', PostTypeWithoutSuffix::getSlug());
});

test('it generates singular name', function() {
	$this->assertSame('Example', ExamplePostType::getName());
	$this->assertSame('Multiple Word', MultipleWordsPostType::getName());
	$this->assertSame('Post Type Without Suffix', PostTypeWithoutSuffix::getName());
});

test('it generates plural name', function() {
	$this->assertSame('Examples', ExamplePostType::getPluralName());
	$this->assertSame('Multiple Words', MultipleWordsPostType::getPluralName());
	$this->assertSame('Post Type Without Suffixes', PostTypeWithoutSuffix::getPluralName());
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
		'archives' => 'Example Archives',
		'attributes' => 'Example Attributes',
		'filter_items_list' => 'Filter examples list',
		'insert_into_item' => 'Insert into example',
		'item_published' => 'Example published.',
		'item_published_privately' => 'Example published privately.',
		'item_reverted_to_draft' => 'Example reverted to draft.',
		'item_scheduled' => 'Example scheduled.',
		'item_updated' => 'Example updated.',
		'new_item' => 'New Example',
		'not_found_in_trash' => 'No examples found in Trash.',
		'uploaded_to_this_item' => 'Uploaded to this example',
		'view_items' => 'View Examples',
		'featured_image' => 'Featured image',
		'set_featured_image' => 'Set featured image',
		'remove_featured_image' => 'Remove featured image',
		'use_featured_image' => 'Use as featured image',
	], ExamplePostType::getLabels());
});

class ExamplePostType extends PostType
{
	//
}

class MultipleWordsPostType extends PostType
{
	//
}

class PostTypeWithoutSuffix extends PostType
{
	//
}

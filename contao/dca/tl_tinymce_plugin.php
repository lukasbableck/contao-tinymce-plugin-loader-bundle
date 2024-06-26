<?php

use Contao\DC_Table;

$GLOBALS['TL_DCA']['tl_tinymce_plugin'] = [
	'config' => [
		'dataContainer' => DC_Table::class,
		'enableVersioning' => true,
		'sql' => [
			'keys' => [
				'id' => 'primary',
			],
		],
	],

	'list' => [
		'sorting' => [
			'mode' => 0,
			'flag' => 11,
			'headerFields' => ['name'],
			'panelLayout' => 'filter;sort,search,limit',
			'child_record_class' => 'no_padding',
		],
		'label' => [
			'fields' => ['name'],
		],
		'global_operations' => [
			'all' => [
				'href' => 'act=select',
				'class' => 'header_edit_all',
				'attributes' => 'onclick="Backend.getScrollOffset(]" accesskey="e"',
			],
		],
		'operations' => [
			'edit' => [
				'href' => 'act=edit',
				'icon' => 'edit.svg',
			],
			'copy' => [
				'href' => 'act=copy',
				'icon' => 'copy.gif',
			],
			'delete' => [
				'href' => 'act=delete',
				'icon' => 'delete.gif',
				'attributes' => 'onclick="if(!confirm(\''.($GLOBALS['TL_LANG']['MSC']['deleteConfirm'] ?? null).'\'))return false;Backend.getScrollOffset()"',
			],
			'show' => [
				'href' => 'act=show',
				'icon' => 'show.gif',
			],
		],
	],

	'palettes' => [
		'default' => '{title_legend},name,script',
	],

	'fields' => [
		'id' => [
			'sql' => 'int(10) unsigned NOT NULL auto_increment',
		],
		'tstamp' => [
			'sql' => "int(10) unsigned NOT NULL default '0'",
		],
		'name' => [
			'exclude' => true,
			'search' => true,
			'inputType' => 'text',
			'eval' => ['unique' => true, 'mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'],
			'sql' => "varchar(255) NOT NULL default ''",
		],
		'script' => [
			'exclude' => true,
			'inputType' => 'fileTree',
			'eval' => ['multiple' => false, 'fieldType' => 'radio', 'filesOnly' => true, 'extensions' => 'js', 'mandatory' => true, 'tl_class' => 'clr'],
			'sql' => 'binary(16) NULL',
		],
	],
];

<?php

// ---------------------------------------------------------------------------------------------------------------------
// Modul in TYPO3 tt_content registrieren
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(
	array(
		'LLL:EXT:ps14_hero/Resources/Private/Language/locallang_tca.xlf:hero.title',
		'ps14_hero',
		'ps14-module-hero'
	),
	'CType',
	'ps14_hero'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(
	array(
		'LLL:EXT:ps14_hero/Resources/Private/Language/locallang_tca.xlf:hero-slider.title',
		'ps14_hero_slider',
		'ps14-module-hero'
	),
	'CType',
	'ps14_hero_slider'
);

// ---------------------------------------------------------------------------------------------------------------------
// Modul TCA anpassen

// Felddefinitionen
$GLOBALS['TCA']['tt_content']['types']['ps14_hero']['showitem'] = \Ps14\Site\Service\TcaService::getShowitem(
	['general', 'appearance', 'language', 'access', 'categories', 'notes', 'extended'],
	[
		'general' => '--palette--;;general, --palette--;;headers, --palette--;;foundation_identifier, bodytext, image,'
	]
);

// Bodytext mit CKEditor rendern
$GLOBALS['TCA']['tt_content']['types']['ps14_hero']['columnsOverrides']['bodytext']['config'] = [
	'enableRichtext' => true,
	'richtextConfiguration' => 'ps14Default',
];

// Videos ebenfalls zulassen
$GLOBALS['TCA']['tt_content']['types']['ps14_hero']['columnsOverrides']['image'] = [
	'label' => 'LLL:EXT:ps14_foundation/Resources/Private/Language/locallang_tca.xlf:tt_content.media',
	'config' => [
		'allowed' => 'jpg, jpeg, png, svg ,mp4, ogg, flac, opus, webm',
		'appearance' => [
			'fileUploadAllowed' => false,
			'createNewRelationLinkTitle' => 'LLL:EXT:ps14_foundation/Resources/Private/Language/locallang_tca.xlf:tt_content.media.add-file-reference'
		],
	]
];

// Crop-Varianten fuer Image-Feld
$GLOBALS['TCA']['tt_content']['types']['ps14_hero']['columnsOverrides']['image']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants'] = \Ps14\Site\Service\TcaService::getCropVariants(
	[
		'default' => [
			'allowedAspectRatios' => ['16_9'],
			'selectedRatio' => '16_9'
		],
	]
);
/*
// ---------------------------------------------------------------------------------------------------------------------
// Elements TCA anpassen

// Definition Record
$GLOBALS['TCA']['tt_content']['types']['ps14_hero']['columnsOverrides']['tx_foundation_elements']['config']['overrideChildTca'] = [
	'columns' => [
		'record_type' => [
			'config' => [
				'items' => [
					[
						'label' => 'LLL:EXT:ps14_hero/Resources/Private/Language/locallang_tca.xlf:elements.record-type.default',
						'value' => 'ps14_hero_default'
					],
				],
				'default' => 'ps14_hero_default'
			]
		],
		'description' => [
			'config' => [
				'richtextConfiguration' => 'ps14Default'
			]
		]
	],
	'types' => [
		'ps14_hero_default' => [
			'showitem' => \Ps14\Site\Service\TcaService::getShowitem(
				['general', 'appearance', 'access'],
				[
					'general' => '--palette--;;general, --palette--;;header, description, media,'
				],
				'tx_foundation_domain_model_elements'
			)
		],
	]
];

// Anpassung Crop-Varianten fuer Elements
$GLOBALS['TCA']['tt_content']['types']['ps14_hero']['columnsOverrides']['tx_foundation_elements']['config']['overrideChildTca']['columns']['media']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants'] = \Ps14\Site\Service\TcaService::getCropVariants(
	[
		'default' => [
			'allowedAspectRatios' => ['16_9'],
			'selectedRatio' => '16_9'
		],
	]
);
*/
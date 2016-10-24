<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
	'modules' =>[
		'social' => [
			'class' => 'common\modules\social\Social',
		],
        'insights' => [
            'class' => 'common\modules\insights\Insight',
        ],
	]  
];

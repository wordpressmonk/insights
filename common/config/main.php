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
		/** Uncomment this to use insights as a module **/
		/**
        'insights' => [
            'class' => 'common\modules\insights\Insight',
        ],
		**/
	]  
];

<?php
return array(
    'log' => array(
        'Log\App' => array(
            'writers' => array(
                'file' => array(
                    'name' => 'stream',
                    'priority' => 1000,
                    'options' => array(
                        'stream' => 'data/logs/app.log',
                        'filters' => array(
                            'priority' => array(
                                'name' => 'priority',
                                'options' => array(
                                    'priority' => 7
                                )
                            ),
                            'suppress' => array(
                                'name' => 'suppress',
                                'options' => array(
                                    'suppress' => false
                                )
                            )
                        ),
                        'formatter' => array(
                            'name' => 'simple',
                            'options' => array(
                                'dateTimeFormat' => 'Y-m-d H:i:s'
                            )
                        )
                    ),
                ),
            ),
        ),
    ),
);
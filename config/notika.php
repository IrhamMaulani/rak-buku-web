<?php


return [

      'title'   =>  'Notika Integration',

      // show or hide default widget.
      // default widget can be found in header-widgets.blade.php

      'default-header-widgets'    => true,

      'icon'      => 'img/favicon.ico',

      // add target for nested menu

      'menus'    =>  [
            [
                  'text' =>   'Home',
                  'url'  =>   '',
                  'icon' =>   'notika-house',
            ],
            [
                  'text' => 'Data',
                  'icon' => 'notika-app',
                  'target' => 'mailbox',
                  'url' => [
                        'dataaaa',
                        'data',
                  ],
                  'nested' => [

                        [
                              'text' => 'main-data',
                        ],
                        [
                              'text' => 'main-s',
                        ],
                  ],
            ],

            [
                  'text' => 'Wew',
                  'icon' => 'notika-draft',
                  'target' => 'Interface',
                  'url' => [
                        'ca'
                  ],
                  'nested' => [
                        [
                              'text' => 'main-wew',
                        ],
                  ],
            ],

      ],
];



// .notika-menu-befores

// .notika-menu-after

// .notika-menu-before

// .notika-menu-sidebar

// .notika-skype

// .notika-app

// .notika-form

// .notika-windows

// .notika-bar-chart

// .notika-alarm

// .notika-arrow-right

// .notika-avable

// .notika-back

// .notika-calendar

// .notika-chat

// .notika-checked

// .notika-close

// .notika-cloud

// .notika-credit-card

// .notika-dollar

// .notika-dot

// .notika-down-arrow

// .notika-draft

// .notika-edit

// .notika-eye

// .notika-facebook

// .notika-file

// .notika-finance

// .notika-flag

// .notika-house

// .notika-ip-locator

// .notika-left-arrow

// .notika-mail

// .notika-map

// .notika-menu

// .notika-menus

// .notika-minus-symbol

// .notika-more-button

// .notika-next

// .notika-next-pro

// .notika-paperclip

// .notika-phone

// .notika-picture

// .notika-pinterest

// .notika-plus-symbol

// .notika-print

// .notika-promos

// .notika-refresh

// .notika-right-arrow

// .notika-search

// .notika-sent

// .notika-settings

// .notika-social

// .notika-star

// .notika-success

// .notika-support

// .notika-tax

// .notika-trash

// .notika-travel

// .notika-twitter

// .notika-up-arrow

// .notika-wifi

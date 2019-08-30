<?php


return [

      'title'   =>  'Rak Buku',

      // show or hide default widget.
      // default widget can be found in header-widgets.blade.php

      'default-header-widgets'    => true,

      'icon'      => 'img/favicon.ico',

      'footer-text' => 'Copyright © 2018 . All rights reserved. Template by Colorlib.',

      // add target for nested menu

      'menus'    =>  [
            [
                  'text' =>   'Home',
                  'url'  =>   'home',
                  'icon' =>   'notika-house',
            ],
            [
                  'text' => 'Books',
                  'icon' => 'notika-form',
                  'target' => 'book',
                  'url' => [
                        'add-book',
                        'aaa',
                  ],
                  'nested' => [

                        [
                              'text' => 'Add Book',
                        ],
                        [
                              'text' => 'main-s',
                        ],
                  ],
            ],

            [
                  'text' => 'User',
                  'icon' => 'notika-support',
                  'target' => 'User',
                  'url' => [
                        'user',
                        'moderator',
                        'member',
                        'author',
                  ],
                  'nested' => [
                        [
                              'text' => 'All',
                        ],
                        [
                              'text' => 'Moderator',
                        ],
                        [
                              'text' => 'Member',
                        ],
                        [
                              'text' => 'Author',
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

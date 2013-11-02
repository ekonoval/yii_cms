<?php
use Ekv\B\components\User\Auth\BUser;

return array(
    BUser::ROLE_GUEST => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Guest',
        'bizRule' => null,
        'data' => null
    ),

    BUser::ROLE_USER => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'User',
        'children' => array(
            BUser::ROLE_GUEST, // inherit from the guest
        ),
        'bizRule' => null,
        'data' => null
    ),

    BUser::ROLE_MODER => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Moderator',
        'children' => array(
            BUser::ROLE_USER, // inherit from user
        ),
        'bizRule' => null,
        'data' => null
    ),

    BUser::ROLE_ADMIN => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Administrator',
        'children' => array(
            BUser::ROLE_MODER, // inherit from moder
        ),
        'bizRule' => null,
        'data' => null
    ),
);
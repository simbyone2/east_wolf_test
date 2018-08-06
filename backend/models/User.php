<?php
namespace backend\models;

use Yii;
use yii\web\IdentityInterface;
use Da\User\Model\User as BaseUser;

/**
 * User model
 */
class User extends BaseUser implements IdentityInterface
{

}

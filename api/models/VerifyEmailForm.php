<?php

namespace api\models;

use common\models\User;
use common\models\UserNotification;
use yii\base\InvalidArgumentException;
use yii\base\Model;

class VerifyEmailForm extends Model
{
    /**
     * @var string
     */
    public $token;

    /**
     * @var User
     */
    private $_user;


    /**
     * Creates a form model with given token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws InvalidArgumentException if token is empty or not valid
     */
    public function __construct($token, array $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidArgumentException('Verify email token cannot be blank.');
        }
        $this->_user = User::findByVerificationToken($token);
        if (!$this->_user) {
            throw new InvalidArgumentException('Wrong verify email token.');
        }
        parent::__construct($config);
    }

    /**
     * Verify email
     *
     * @return User|null the saved model or null if saving fails
     */
    public function verifyEmail()
    {
        $user = $this->_user;
//        $user->status = User::STATUS_INACTIVE;
        $user->email_confirm = 1;
        return $user->save(false) ? $user : null;
    }
    public function verifyEmailAdmin()
    {
        $user = $this->_user;

        if ($user->email_confirm == 1) {
            $user->status = User::STATUS_ACTIVE;

            $notification = new UserNotification();
            $notification->user_id = $user->id;
            $notification->title = 'Account Activated';
            $notification->description =
                'Hello,' . $user->username . '.<br>'.
                'Your account is activated';
            $notification->priority = UserNotification::NORMAL_PRIORITY;
            $notification->status = UserNotification::STATUS_UNREAD;
            $notification->save();

            return $user->save(false) ? $user : null;

        }


        return null;
    }
}

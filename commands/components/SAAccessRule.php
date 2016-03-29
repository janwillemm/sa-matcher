<?php

namespace app\commands\components;

use yii\filters\AccessRule;

class SAAccessRule extends AccessRule{

    /**
     * @param User $user the user object
     * @return boolean whether the rule applies to the role
     */
    protected function matchRole($user)
    {
        if (empty($this->roles)) {
            // TODO: MAKE THIS FALSE
            return true;
        }

        foreach ($this->roles as $role) {
            if ($role === '?') {
                if ($user->getIsGuest()) {
                    return true;
                }
            } else {
                if (!$user->getIsGuest() && $user->isAllowed($role)) {
                    return true;
                }
            }
        }

        return false;
    }
}
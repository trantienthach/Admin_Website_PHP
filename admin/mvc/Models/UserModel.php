<?php


class UserModel extends Database {

    const TABLE_USER = 'tbl_user';

    public function checkLogin( $username, $password ) {
        $sql = "SELECT `user_is_active`,`user_is_disable`,`user_numPassword_attempts`,`user_email`,`user_password` FROM ".self::TABLE_USER." WHERE `user_username` = '{$username}'";
        $userItem = $this->selectRowItem($sql);
        if( !empty($userItem) ) {
            /**
             * Check account disabled
             */
            if( $userItem['user_is_disable'] == '1' ) {
                return [
                    'status' => false,
                    'errorTxt' => "<span class='error'>(*) Tài khoảng của bạn đã bị vô hiệu hóa, vui lòng liên hệ admin để mở lại tài khoảng </span>"
                ];
            } else {
                /**
                 * Check account active
                 */
                if( $userItem['user_is_active'] == '0' ) {
                    return [
                        'status' => false,
                        'errorTxt' => "<span class='error'>(*) Tài khoảng chưa được active, vui lòng truy cập email để active tài khoảng </span>"
                    ];
                } else {
                    /**
                     * Check password true
                     */
                    $userEmail = $userItem['user_email'];
                    $userPassword = $userItem['user_password'];
                    $passwordConfig = md5( $password.$userEmail );
                    if( $passwordConfig == $userPassword ) {
                        $this->update( self::TABLE_USER, ['user_is_disable' => '0'], "`user_username` = '{$username}'" );
                        $this->update( self::TABLE_USER,['user_numPassword_attempts' => '0'], "`user_username` = '{$username}'" );
                        return [
                            'status' => true
                        ];
                    } else {
                        /**
                         * Plus user numPassword attempts
                         */
                        $userNumPasswordAttempts = $userItem['user_numPassword_attempts'] + 1;
                        if( $userItem['user_numPassword_attempts'] >= 2 ) {
                            $this->update( self::TABLE_USER, ['user_is_disable' => '1'], "`user_username` = '{$username}'" );
                        }
                        $this->update( self::TABLE_USER,['user_numPassword_attempts' => $userNumPasswordAttempts], "`user_username` = '{$username}'" );
                        $numLogin = 3 - ((int)$userItem['user_numPassword_attempts'] + 1);
                        return [
                            'status' => false,
                            'errorTxt' => "<span class='error'>(*) Mật khẩu không chính xác vui lòng thử lại [còn ". $numLogin ." lần]</span>"
                        ];
                    }
                }
            }
        } else {
            return [
                "status" => false,
                "errorTxt" => "<span class='error'>(*) Tài khoảng không tồn tại, vui lòng đăng nhập lại </span>"
            ];
        }

    }

}
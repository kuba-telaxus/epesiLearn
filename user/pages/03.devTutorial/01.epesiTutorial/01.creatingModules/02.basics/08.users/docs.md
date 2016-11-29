---
title: Users
taxonomy:
    category: docs
---

There are few methods given at your disposal to gather information about currently logged in user:

   * Base_AclCommon::i_am_user() - returns true if user is logged in

   * Base_AclCommon::i_am_admin() - returns true if current user is an administrator

   * Base_AclCommon::i_am_sa() - returns true if current user is a super administrator

   * Base_AclCommon::get_user() - returns current user id

   * Base_UserCommon::get_my_user_login() - returns current user login

	Notice: Acl::i_am_user() will return false if an account on which user is logged in doesn't have User rights.

   * Base_UserCommon::get_user_id($username) returns id of a user which login is given as first parameter. If there is no such user - returns false

   * Base_UserCommon::get_user_login($i) returns login of a user which id is given as first parameter. If there is no such user - returns false
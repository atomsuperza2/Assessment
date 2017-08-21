<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends \Spatie\Permission\Models\Permission

{
  public static function defaultPermissions()
      {
          return [
              'view_users',
              'add_users',
              'edit_users',
              'delete_users',

              'view_roles',
              'add_roles',
              'edit_roles',
              'delete_roles',

              'view_questionnaire',
              'add_questionnaire',
              'edit_questionnaire',
              'delete_questionnaire',

              'store_assessment',
              'clear_assessment',

              'view_data_stored_comment',
              'view_data_stored',

          ];
      }
}

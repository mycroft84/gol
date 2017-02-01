<?php
/**
 * User: MyCroft
 * Date: 2013.09.02.
 * Time: 8:33
 * Project: d2cadmin3.3
 * Company: d2c
 */
class Kohana_Access_Control_List
{
    public static function getClassIndentifier(ORM $orm)
    {
        $table = $orm->table_name();
        $class = get_class($orm);
        
        return self::getIdentifier($class,$table);
    }

    public static function getObjectIndentifier(ORM $orm)
    {
        $table = $orm->table_name();
        $class = get_class($orm);
        $id = $orm->pk();

        return self::getIdentifier($class,$table,$id);
    }

    public static function getUserIndentifier(ORM $orm)
    {
        $table = $orm->table_name();
        $class = get_class($orm);
        $id = $orm->pk();

        return self::getIdentifier($class,$table,$id,1);
    }

    public static function getRoleIdentifier($role)
    {
        $currentRole = new Model_Role();
        $currentRole->where('name','=',strtolower($role))->find();

        $table = $currentRole->table_name();
        $class = get_class($currentRole);
        $id = $currentRole->pk();

        return self::getIdentifier($class,$table,$id,false,1);
    }

    public static function addAccess($resAclID, $userAclID, $mask)
    {
        $current = DB::select()
            ->from('acl_permissions')
            ->where('aclp_resource_id','=',$resAclID)
            ->where('aclp_user_id','=',$userAclID)
            ->execute()->current();

        if ($current) {
            $row = array(
                'aclp_mask'=>$mask
            );

            try {
                DB::update('acl_permissions')
                    ->set($row)
                    ->where('aclp_id','=',$current['aclp_id'])
                    ->execute();

                return array('error'=>false);
            } catch (Exception $e) {
                return array('error'=>true,'message'=>$e->getMessage());
            }
        } else {

            $row = array(
                'aclp_resource_id'=>$resAclID,
                'aclp_user_id'=>$userAclID,
                'aclp_mask'=>$mask,
            );

            try {
                DB::insert('acl_permissions',array_keys($row))->values($row)->execute();

                return array('error'=>false);
            } catch (Exception $e) {
                return array('error'=>true,'message'=>$e->getMessage());
            }
        }
    }

    public static function isGranted($mask, ORM $resource, ORM $user)
    {
        $classID = self::getClassIndentifier($resource);
        $objectID = self::getObjectIndentifier($resource);
        $userID = self::getUserIndentifier($user);

        $mb = new Maskbuilder();
        $mb->add($mask);
        $maskNum = $mb->get();

        $roles = $user->roles->find_all();

        $masks = array();
        $masks[] = self::getPermissionMask($classID,$userID);
        $masks[] = self::getPermissionMask($objectID,$userID);

        foreach($roles as $item)
        {
            $roleID = self::getRoleIdentifier($item->name);

            $masks[] = self::getPermissionMask($classID,$roleID);
            $masks[] = self::getPermissionMask($objectID,$roleID);
        }
        
        //echo Debug::vars($masks,$maskNum);
        return max($masks) >= $maskNum;
    }

    private static function getPermissionMask($resourceID,$userID)
    {
        $query = DB::select()
            ->from('acl_permissions')
            ->where('aclp_resource_id','=',$resourceID)
            ->where('aclp_user_id','=',$userID)
            ->execute()->current();
        
        return ($query) ? (int) $query['aclp_mask'] : 0;
    }

    private static function getIdentifier($class, $table, $ref_id = false, $is_user = false, $is_role = false)
    {
        $current = DB::select()
            ->from('acl_identifiers')
            ->where('acli_class','=',$class)
            ->where('acli_table','=',$table);

        if ($ref_id) $current->where('acli_ref_id','=',$ref_id);
        else $current->where('acli_ref_id','IS',NULL);

        if ($is_user) $current->where('acli_is_user','=',$is_user);
        else $current->where('acli_is_user','IS',NULL);

        if ($is_role) $current->where('acli_is_role','=',$is_role);
        else $current->where('acli_is_role','IS',NULL);

        $current = $current->execute()->current();

        if ($current) {
            return $current['acli_id'];
        } else {

            $row = array(
                'acli_class' =>$class,
                'acli_table' => $table
            );

            if ($ref_id) $row['acli_ref_id'] = $ref_id;
            if ($is_user) $row['acli_is_user'] = $is_user;
            if ($is_role) $row['acli_is_role'] = $is_role;

            try {
                $insert = DB::insert('acl_identifiers',array_keys($row))->values($row)->execute();

                return $insert[0];
            } catch (Exception $e) {
                return array('error'=>true,'message'=>$e->getMessage());
            }
        }
    }
    
}
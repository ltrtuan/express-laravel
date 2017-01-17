<?php

namespace App\CustomFacadeFunction;

use App\Models\UserMeta as UserMetaModel;

class UserMeta
{
    /**
     * [get Get option value by key]
     * @param  string $key [meta_key column in Usermeta table]
     * @param  string $array [is array ?]
     * @param  string $orderBy [Column in Options table]
     * @param  string $order
     * @return [type]      [description]
     */
    public function get($userId, $key = '', $array = false, $orderBy = 'id', $order = 'desc')
    {
        if($key == '' || $userId <=0) return false;
        if($array == false)
        {
            $valueExist = UserMetaModel::where('user_id', $userId)->where('meta_key', $key)->orderBy($orderBy, $order)->value('meta_value');
            if($valueExist != '')
            {
                return unserialize($valueExist);
            }
        }else
        {
            $valueExist = UserMetaModel::where('user_id', $userId)->where('meta_key', $key)->orderBy($orderBy, $order)->get()->toArray();
            if(is_array($valueExist) && count($valueExist) > 0)
            {               
                return $valueExist;
            }
        }
        
        return '';
    }

    /**
     * [save Save option into Usermeta table]
     * @param  string  $key   [meta_key]
     * @param  string  $value [meta_value]
     * @param  boolean $array [is array ?]
     * @param  string $prev_value [update exactly meta_value]
     * @return [type]         [description]
     */
    public function save($userId = 0, $key = '', $value = '', $prev_value = '', $array = false)
    {      
        if($key == '' || $userId <=0) return false;

        if($prev_value != '')
        {
            $valueExist = UserMetaModel::where('user_id', $userId)->where('meta_key', $key)->where('meta_value', serialize($prev_value))->first();
            if(!is_null($valueExist))
            {
                /**
                * If meta_key is exist
                */
                return $this->updateOption($valueExist, $value);
            }
            return false;
        }else
        {       
            /**
            * IF NOT ARRAY STORE
            */
            if($array == false)
            {
                /**
                * If single value option
                */
                $valueExist = UserMetaModel::where('user_id', $userId)->where('meta_key', $key)->orderBy('id', 'desc')->first();
                
                if(!is_null($valueExist))
                {
                    /**
                    * If meta_key is exist
                    */
                    return $this->updateOption($valueExist, $value);
                }else
                {
                    /**
                    * If meta_key is not exist
                    */
                    return $this->saveNewOption($userId, $key, $value);                
                }
            }else//End if($array == false)
            {
                return $this->saveNewOption($userId, $key, $value);
            }
        }
        
    }


    /**
     * [saveNewOption Create new record option]
     * @param  [type] $key   [meta_key]
     * @param  [type] $value [meta_value]
     * @return [type]        [description]
     */
    private function saveNewOption($userId, $key, $value){
        $userMeta = new UserMetaModel;
        $userMeta->user_id = $userId;
        $userMeta->meta_key = $key;
        $userMeta->meta_value = serialize($value);
        $userMeta->save();
        return $userMeta->id;
    }

    /**
     * [updateOption description]
     * @param  UserMetaModel $userMeta [UserMetaModel instance]  
     * @param  [type]      $value  [meta_value]
     * @return [type]              [description]
     */
    private function updateOption(UserMetaModel $userMeta, $value){        
        $userMeta->meta_value = serialize($value);
        $userMeta->save();
        return $userMeta->id;
    }

    /**
     * [delete description]
     * @param  string $key        [meta_key]
     * @param  string $prev_value [old value meta_value]
     * @return [type]             [description]
     */
    public function delete($userId, $key = '', $prev_value = ''){
        if($key == '' || $userId <= 0) return false;
       
        if($prev_value != '')
        {
            return UserMetaModel::where('user_id', $userId)->where('meta_key', $key)->where('meta_value', serialize($prev_value))->delete();
        }else
        {
            return UserMetaModel::where('user_id', $userId)->where('meta_key', $key)->delete();
        }
    }
}
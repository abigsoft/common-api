<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class BaseModel extends Model
{
    protected $autoWriteTimestamp = 'datetime';

    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';

    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = null;
}
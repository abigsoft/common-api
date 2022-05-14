<?php
/*
 * Copyright (c) 2017-2018 THL A29 Limited, a Tencent company. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *    http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
namespace TencentCloud\Dcdb\V20180411\Models;
use TencentCloud\Common\AbstractModel;

/**
 * DescribeDBSlowLogs请求参数结构体
 *
 * @method string getInstanceId() 获取实例 ID，形如：dcdbt-hw0qj6m1
 * @method void setInstanceId(string $InstanceId) 设置实例 ID，形如：dcdbt-hw0qj6m1
 * @method integer getOffset() 获取从结果的第几条数据开始返回
 * @method void setOffset(integer $Offset) 设置从结果的第几条数据开始返回
 * @method integer getLimit() 获取返回的结果条数
 * @method void setLimit(integer $Limit) 设置返回的结果条数
 * @method string getStartTime() 获取查询的起始时间，形如2016-07-23 14:55:20
 * @method void setStartTime(string $StartTime) 设置查询的起始时间，形如2016-07-23 14:55:20
 * @method string getShardId() 获取实例的分片ID，形如shard-53ima8ln
 * @method void setShardId(string $ShardId) 设置实例的分片ID，形如shard-53ima8ln
 * @method string getEndTime() 获取查询的结束时间，形如2016-08-22 14:55:20。如果不填，那么查询结束时间就是当前时间
 * @method void setEndTime(string $EndTime) 设置查询的结束时间，形如2016-08-22 14:55:20。如果不填，那么查询结束时间就是当前时间
 * @method string getDb() 获取要查询的具体数据库名称
 * @method void setDb(string $Db) 设置要查询的具体数据库名称
 * @method string getOrderBy() 获取排序指标，取值为query_time_sum或者query_count。不填默认按照query_time_sum排序
 * @method void setOrderBy(string $OrderBy) 设置排序指标，取值为query_time_sum或者query_count。不填默认按照query_time_sum排序
 * @method string getOrderByType() 获取排序类型，desc（降序）或者asc（升序）。不填默认desc排序
 * @method void setOrderByType(string $OrderByType) 设置排序类型，desc（降序）或者asc（升序）。不填默认desc排序
 * @method integer getSlave() 获取是否查询从机的慢查询，0-主机; 1-从机。不填默认查询主机慢查询
 * @method void setSlave(integer $Slave) 设置是否查询从机的慢查询，0-主机; 1-从机。不填默认查询主机慢查询
 */
class DescribeDBSlowLogsRequest extends AbstractModel
{
    /**
     * @var string 实例 ID，形如：dcdbt-hw0qj6m1
     */
    public $InstanceId;

    /**
     * @var integer 从结果的第几条数据开始返回
     */
    public $Offset;

    /**
     * @var integer 返回的结果条数
     */
    public $Limit;

    /**
     * @var string 查询的起始时间，形如2016-07-23 14:55:20
     */
    public $StartTime;

    /**
     * @var string 实例的分片ID，形如shard-53ima8ln
     */
    public $ShardId;

    /**
     * @var string 查询的结束时间，形如2016-08-22 14:55:20。如果不填，那么查询结束时间就是当前时间
     */
    public $EndTime;

    /**
     * @var string 要查询的具体数据库名称
     */
    public $Db;

    /**
     * @var string 排序指标，取值为query_time_sum或者query_count。不填默认按照query_time_sum排序
     */
    public $OrderBy;

    /**
     * @var string 排序类型，desc（降序）或者asc（升序）。不填默认desc排序
     */
    public $OrderByType;

    /**
     * @var integer 是否查询从机的慢查询，0-主机; 1-从机。不填默认查询主机慢查询
     */
    public $Slave;

    /**
     * @param string $InstanceId 实例 ID，形如：dcdbt-hw0qj6m1
     * @param integer $Offset 从结果的第几条数据开始返回
     * @param integer $Limit 返回的结果条数
     * @param string $StartTime 查询的起始时间，形如2016-07-23 14:55:20
     * @param string $ShardId 实例的分片ID，形如shard-53ima8ln
     * @param string $EndTime 查询的结束时间，形如2016-08-22 14:55:20。如果不填，那么查询结束时间就是当前时间
     * @param string $Db 要查询的具体数据库名称
     * @param string $OrderBy 排序指标，取值为query_time_sum或者query_count。不填默认按照query_time_sum排序
     * @param string $OrderByType 排序类型，desc（降序）或者asc（升序）。不填默认desc排序
     * @param integer $Slave 是否查询从机的慢查询，0-主机; 1-从机。不填默认查询主机慢查询
     */
    function __construct()
    {

    }

    /**
     * For internal only. DO NOT USE IT.
     */
    public function deserialize($param)
    {
        if ($param === null) {
            return;
        }
        if (array_key_exists("InstanceId",$param) and $param["InstanceId"] !== null) {
            $this->InstanceId = $param["InstanceId"];
        }

        if (array_key_exists("Offset",$param) and $param["Offset"] !== null) {
            $this->Offset = $param["Offset"];
        }

        if (array_key_exists("Limit",$param) and $param["Limit"] !== null) {
            $this->Limit = $param["Limit"];
        }

        if (array_key_exists("StartTime",$param) and $param["StartTime"] !== null) {
            $this->StartTime = $param["StartTime"];
        }

        if (array_key_exists("ShardId",$param) and $param["ShardId"] !== null) {
            $this->ShardId = $param["ShardId"];
        }

        if (array_key_exists("EndTime",$param) and $param["EndTime"] !== null) {
            $this->EndTime = $param["EndTime"];
        }

        if (array_key_exists("Db",$param) and $param["Db"] !== null) {
            $this->Db = $param["Db"];
        }

        if (array_key_exists("OrderBy",$param) and $param["OrderBy"] !== null) {
            $this->OrderBy = $param["OrderBy"];
        }

        if (array_key_exists("OrderByType",$param) and $param["OrderByType"] !== null) {
            $this->OrderByType = $param["OrderByType"];
        }

        if (array_key_exists("Slave",$param) and $param["Slave"] !== null) {
            $this->Slave = $param["Slave"];
        }
    }
}

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
namespace TencentCloud\Dlc\V20210125\Models;
use TencentCloud\Common\AbstractModel;

/**
 * 任务实例
 *
 * @method string getDatabaseName() 获取任务所属Database的名称。
 * @method void setDatabaseName(string $DatabaseName) 设置任务所属Database的名称。
 * @method integer getDataAmount() 获取任务数据量。
 * @method void setDataAmount(integer $DataAmount) 设置任务数据量。
 * @method string getId() 获取任务Id。
 * @method void setId(string $Id) 设置任务Id。
 * @method integer getUsedTime() 获取计算时长，单位： ms。
 * @method void setUsedTime(integer $UsedTime) 设置计算时长，单位： ms。
 * @method string getOutputPath() 获取任务输出路径。
 * @method void setOutputPath(string $OutputPath) 设置任务输出路径。
 * @method string getCreateTime() 获取任务创建时间。
 * @method void setCreateTime(string $CreateTime) 设置任务创建时间。
 * @method integer getState() 获取任务状态：0 初始化， 1 执行中， 2 执行成功，-1 执行失败，-3 已取消。
 * @method void setState(integer $State) 设置任务状态：0 初始化， 1 执行中， 2 执行成功，-1 执行失败，-3 已取消。
 * @method string getSQLType() 获取任务SQL类型，DDL|DML等
 * @method void setSQLType(string $SQLType) 设置任务SQL类型，DDL|DML等
 * @method string getSQL() 获取任务SQL语句
 * @method void setSQL(string $SQL) 设置任务SQL语句
 * @method boolean getResultExpired() 获取结果是否过期。
 * @method void setResultExpired(boolean $ResultExpired) 设置结果是否过期。
 * @method string getRowAffectInfo() 获取数据影响统计信息。
 * @method void setRowAffectInfo(string $RowAffectInfo) 设置数据影响统计信息。
 * @method string getDataSet() 获取任务结果数据表。
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setDataSet(string $DataSet) 设置任务结果数据表。
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getError() 获取失败信息, 例如：errorMessage。该字段已废弃。
 * @method void setError(string $Error) 设置失败信息, 例如：errorMessage。该字段已废弃。
 * @method integer getPercentage() 获取任务执行进度num/100(%)
 * @method void setPercentage(integer $Percentage) 设置任务执行进度num/100(%)
 * @method string getOutputMessage() 获取任务执行输出信息。
 * @method void setOutputMessage(string $OutputMessage) 设置任务执行输出信息。
 * @method string getTaskType() 获取执行SQL的引擎类型
 * @method void setTaskType(string $TaskType) 设置执行SQL的引擎类型
 * @method string getProgressDetail() 获取任务进度明细
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setProgressDetail(string $ProgressDetail) 设置任务进度明细
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getUpdateTime() 获取任务结束时间
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setUpdateTime(string $UpdateTime) 设置任务结束时间
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getDataEngineId() 获取计算资源id
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setDataEngineId(string $DataEngineId) 设置计算资源id
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getOperateUin() 获取执行sql的子uin
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setOperateUin(string $OperateUin) 设置执行sql的子uin
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getDataEngineName() 获取计算资源名字
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setDataEngineName(string $DataEngineName) 设置计算资源名字
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getInputType() 获取导入类型是本地导入还是cos
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setInputType(string $InputType) 设置导入类型是本地导入还是cos
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getInputConf() 获取导入配置
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setInputConf(string $InputConf) 设置导入配置
注意：此字段可能返回 null，表示取不到有效值。
 * @method integer getDataNumber() 获取数据条数
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setDataNumber(integer $DataNumber) 设置数据条数
注意：此字段可能返回 null，表示取不到有效值。
 * @method boolean getCanDownload() 获取查询数据能不能下载
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setCanDownload(boolean $CanDownload) 设置查询数据能不能下载
注意：此字段可能返回 null，表示取不到有效值。
 */
class TaskResponseInfo extends AbstractModel
{
    /**
     * @var string 任务所属Database的名称。
     */
    public $DatabaseName;

    /**
     * @var integer 任务数据量。
     */
    public $DataAmount;

    /**
     * @var string 任务Id。
     */
    public $Id;

    /**
     * @var integer 计算时长，单位： ms。
     */
    public $UsedTime;

    /**
     * @var string 任务输出路径。
     */
    public $OutputPath;

    /**
     * @var string 任务创建时间。
     */
    public $CreateTime;

    /**
     * @var integer 任务状态：0 初始化， 1 执行中， 2 执行成功，-1 执行失败，-3 已取消。
     */
    public $State;

    /**
     * @var string 任务SQL类型，DDL|DML等
     */
    public $SQLType;

    /**
     * @var string 任务SQL语句
     */
    public $SQL;

    /**
     * @var boolean 结果是否过期。
     */
    public $ResultExpired;

    /**
     * @var string 数据影响统计信息。
     */
    public $RowAffectInfo;

    /**
     * @var string 任务结果数据表。
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $DataSet;

    /**
     * @var string 失败信息, 例如：errorMessage。该字段已废弃。
     */
    public $Error;

    /**
     * @var integer 任务执行进度num/100(%)
     */
    public $Percentage;

    /**
     * @var string 任务执行输出信息。
     */
    public $OutputMessage;

    /**
     * @var string 执行SQL的引擎类型
     */
    public $TaskType;

    /**
     * @var string 任务进度明细
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $ProgressDetail;

    /**
     * @var string 任务结束时间
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $UpdateTime;

    /**
     * @var string 计算资源id
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $DataEngineId;

    /**
     * @var string 执行sql的子uin
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $OperateUin;

    /**
     * @var string 计算资源名字
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $DataEngineName;

    /**
     * @var string 导入类型是本地导入还是cos
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $InputType;

    /**
     * @var string 导入配置
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $InputConf;

    /**
     * @var integer 数据条数
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $DataNumber;

    /**
     * @var boolean 查询数据能不能下载
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $CanDownload;

    /**
     * @param string $DatabaseName 任务所属Database的名称。
     * @param integer $DataAmount 任务数据量。
     * @param string $Id 任务Id。
     * @param integer $UsedTime 计算时长，单位： ms。
     * @param string $OutputPath 任务输出路径。
     * @param string $CreateTime 任务创建时间。
     * @param integer $State 任务状态：0 初始化， 1 执行中， 2 执行成功，-1 执行失败，-3 已取消。
     * @param string $SQLType 任务SQL类型，DDL|DML等
     * @param string $SQL 任务SQL语句
     * @param boolean $ResultExpired 结果是否过期。
     * @param string $RowAffectInfo 数据影响统计信息。
     * @param string $DataSet 任务结果数据表。
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $Error 失败信息, 例如：errorMessage。该字段已废弃。
     * @param integer $Percentage 任务执行进度num/100(%)
     * @param string $OutputMessage 任务执行输出信息。
     * @param string $TaskType 执行SQL的引擎类型
     * @param string $ProgressDetail 任务进度明细
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $UpdateTime 任务结束时间
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $DataEngineId 计算资源id
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $OperateUin 执行sql的子uin
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $DataEngineName 计算资源名字
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $InputType 导入类型是本地导入还是cos
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $InputConf 导入配置
注意：此字段可能返回 null，表示取不到有效值。
     * @param integer $DataNumber 数据条数
注意：此字段可能返回 null，表示取不到有效值。
     * @param boolean $CanDownload 查询数据能不能下载
注意：此字段可能返回 null，表示取不到有效值。
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
        if (array_key_exists("DatabaseName",$param) and $param["DatabaseName"] !== null) {
            $this->DatabaseName = $param["DatabaseName"];
        }

        if (array_key_exists("DataAmount",$param) and $param["DataAmount"] !== null) {
            $this->DataAmount = $param["DataAmount"];
        }

        if (array_key_exists("Id",$param) and $param["Id"] !== null) {
            $this->Id = $param["Id"];
        }

        if (array_key_exists("UsedTime",$param) and $param["UsedTime"] !== null) {
            $this->UsedTime = $param["UsedTime"];
        }

        if (array_key_exists("OutputPath",$param) and $param["OutputPath"] !== null) {
            $this->OutputPath = $param["OutputPath"];
        }

        if (array_key_exists("CreateTime",$param) and $param["CreateTime"] !== null) {
            $this->CreateTime = $param["CreateTime"];
        }

        if (array_key_exists("State",$param) and $param["State"] !== null) {
            $this->State = $param["State"];
        }

        if (array_key_exists("SQLType",$param) and $param["SQLType"] !== null) {
            $this->SQLType = $param["SQLType"];
        }

        if (array_key_exists("SQL",$param) and $param["SQL"] !== null) {
            $this->SQL = $param["SQL"];
        }

        if (array_key_exists("ResultExpired",$param) and $param["ResultExpired"] !== null) {
            $this->ResultExpired = $param["ResultExpired"];
        }

        if (array_key_exists("RowAffectInfo",$param) and $param["RowAffectInfo"] !== null) {
            $this->RowAffectInfo = $param["RowAffectInfo"];
        }

        if (array_key_exists("DataSet",$param) and $param["DataSet"] !== null) {
            $this->DataSet = $param["DataSet"];
        }

        if (array_key_exists("Error",$param) and $param["Error"] !== null) {
            $this->Error = $param["Error"];
        }

        if (array_key_exists("Percentage",$param) and $param["Percentage"] !== null) {
            $this->Percentage = $param["Percentage"];
        }

        if (array_key_exists("OutputMessage",$param) and $param["OutputMessage"] !== null) {
            $this->OutputMessage = $param["OutputMessage"];
        }

        if (array_key_exists("TaskType",$param) and $param["TaskType"] !== null) {
            $this->TaskType = $param["TaskType"];
        }

        if (array_key_exists("ProgressDetail",$param) and $param["ProgressDetail"] !== null) {
            $this->ProgressDetail = $param["ProgressDetail"];
        }

        if (array_key_exists("UpdateTime",$param) and $param["UpdateTime"] !== null) {
            $this->UpdateTime = $param["UpdateTime"];
        }

        if (array_key_exists("DataEngineId",$param) and $param["DataEngineId"] !== null) {
            $this->DataEngineId = $param["DataEngineId"];
        }

        if (array_key_exists("OperateUin",$param) and $param["OperateUin"] !== null) {
            $this->OperateUin = $param["OperateUin"];
        }

        if (array_key_exists("DataEngineName",$param) and $param["DataEngineName"] !== null) {
            $this->DataEngineName = $param["DataEngineName"];
        }

        if (array_key_exists("InputType",$param) and $param["InputType"] !== null) {
            $this->InputType = $param["InputType"];
        }

        if (array_key_exists("InputConf",$param) and $param["InputConf"] !== null) {
            $this->InputConf = $param["InputConf"];
        }

        if (array_key_exists("DataNumber",$param) and $param["DataNumber"] !== null) {
            $this->DataNumber = $param["DataNumber"];
        }

        if (array_key_exists("CanDownload",$param) and $param["CanDownload"] !== null) {
            $this->CanDownload = $param["CanDownload"];
        }
    }
}

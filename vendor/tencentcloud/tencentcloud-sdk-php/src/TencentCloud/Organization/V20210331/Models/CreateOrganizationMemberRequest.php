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
namespace TencentCloud\Organization\V20210331\Models;
use TencentCloud\Common\AbstractModel;

/**
 * CreateOrganizationMember请求参数结构体
 *
 * @method string getName() 获取名称
 * @method void setName(string $Name) 设置名称
 * @method string getPolicyType() 获取关系策略  取值：Financial
 * @method void setPolicyType(string $PolicyType) 设置关系策略  取值：Financial
 * @method array getPermissionIds() 获取关系权限 取值：1-查看账单、2-查看余额、3-资金划拨、4-合并出账、5-开票 ，1、2 默认必须
 * @method void setPermissionIds(array $PermissionIds) 设置关系权限 取值：1-查看账单、2-查看余额、3-资金划拨、4-合并出账、5-开票 ，1、2 默认必须
 * @method integer getNodeId() 获取成员所属部门的节点ID
 * @method void setNodeId(integer $NodeId) 设置成员所属部门的节点ID
 * @method string getAccountName() 获取账号名
 * @method void setAccountName(string $AccountName) 设置账号名
 * @method string getRemark() 获取备注
 * @method void setRemark(string $Remark) 设置备注
 * @method integer getRecordId() 获取重试创建传记录ID
 * @method void setRecordId(integer $RecordId) 设置重试创建传记录ID
 * @method string getPayUin() 获取代付者Uin
 * @method void setPayUin(string $PayUin) 设置代付者Uin
 * @method array getIdentityRoleID() 获取管理身份
 * @method void setIdentityRoleID(array $IdentityRoleID) 设置管理身份
 */
class CreateOrganizationMemberRequest extends AbstractModel
{
    /**
     * @var string 名称
     */
    public $Name;

    /**
     * @var string 关系策略  取值：Financial
     */
    public $PolicyType;

    /**
     * @var array 关系权限 取值：1-查看账单、2-查看余额、3-资金划拨、4-合并出账、5-开票 ，1、2 默认必须
     */
    public $PermissionIds;

    /**
     * @var integer 成员所属部门的节点ID
     */
    public $NodeId;

    /**
     * @var string 账号名
     */
    public $AccountName;

    /**
     * @var string 备注
     */
    public $Remark;

    /**
     * @var integer 重试创建传记录ID
     */
    public $RecordId;

    /**
     * @var string 代付者Uin
     */
    public $PayUin;

    /**
     * @var array 管理身份
     */
    public $IdentityRoleID;

    /**
     * @param string $Name 名称
     * @param string $PolicyType 关系策略  取值：Financial
     * @param array $PermissionIds 关系权限 取值：1-查看账单、2-查看余额、3-资金划拨、4-合并出账、5-开票 ，1、2 默认必须
     * @param integer $NodeId 成员所属部门的节点ID
     * @param string $AccountName 账号名
     * @param string $Remark 备注
     * @param integer $RecordId 重试创建传记录ID
     * @param string $PayUin 代付者Uin
     * @param array $IdentityRoleID 管理身份
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
        if (array_key_exists("Name",$param) and $param["Name"] !== null) {
            $this->Name = $param["Name"];
        }

        if (array_key_exists("PolicyType",$param) and $param["PolicyType"] !== null) {
            $this->PolicyType = $param["PolicyType"];
        }

        if (array_key_exists("PermissionIds",$param) and $param["PermissionIds"] !== null) {
            $this->PermissionIds = $param["PermissionIds"];
        }

        if (array_key_exists("NodeId",$param) and $param["NodeId"] !== null) {
            $this->NodeId = $param["NodeId"];
        }

        if (array_key_exists("AccountName",$param) and $param["AccountName"] !== null) {
            $this->AccountName = $param["AccountName"];
        }

        if (array_key_exists("Remark",$param) and $param["Remark"] !== null) {
            $this->Remark = $param["Remark"];
        }

        if (array_key_exists("RecordId",$param) and $param["RecordId"] !== null) {
            $this->RecordId = $param["RecordId"];
        }

        if (array_key_exists("PayUin",$param) and $param["PayUin"] !== null) {
            $this->PayUin = $param["PayUin"];
        }

        if (array_key_exists("IdentityRoleID",$param) and $param["IdentityRoleID"] !== null) {
            $this->IdentityRoleID = $param["IdentityRoleID"];
        }
    }
}

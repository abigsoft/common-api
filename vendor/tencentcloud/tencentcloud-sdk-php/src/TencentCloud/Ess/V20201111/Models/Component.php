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
namespace TencentCloud\Ess\V20201111\Models;
use TencentCloud\Common\AbstractModel;

/**
 * 模板控件信息
 *
 * @method string getComponentType() 获取如果是 Component 控件类型，则可选类型为：
TEXT - 内容文本控件
DATE - 内容日期控件
SELECT - 勾选框控件
如果是 SignComponent 控件类型，则可选类型为：
SIGN_SEAL - 签署印章控件
SIGN_DATE - 签署日期控件
SIGN_SIGNATURE - 手写签名控件
 * @method void setComponentType(string $ComponentType) 设置如果是 Component 控件类型，则可选类型为：
TEXT - 内容文本控件
DATE - 内容日期控件
SELECT - 勾选框控件
如果是 SignComponent 控件类型，则可选类型为：
SIGN_SEAL - 签署印章控件
SIGN_DATE - 签署日期控件
SIGN_SIGNATURE - 手写签名控件
 * @method float getComponentWidth() 获取参数控件宽度，单位px
 * @method void setComponentWidth(float $ComponentWidth) 设置参数控件宽度，单位px
 * @method float getComponentHeight() 获取参数控件高度，单位px
 * @method void setComponentHeight(float $ComponentHeight) 设置参数控件高度，单位px
 * @method integer getComponentPage() 获取参数控件所在页码，取值为：1-N
 * @method void setComponentPage(integer $ComponentPage) 设置参数控件所在页码，取值为：1-N
 * @method float getComponentPosX() 获取参数控件X位置，单位px
 * @method void setComponentPosX(float $ComponentPosX) 设置参数控件X位置，单位px
 * @method float getComponentPosY() 获取参数控件Y位置，单位px
 * @method void setComponentPosY(float $ComponentPosY) 设置参数控件Y位置，单位px
 * @method integer getFileIndex() 获取控件所属文件的序号（模板中的resourceId排列序号，取值为：0-N）
 * @method void setFileIndex(integer $FileIndex) 设置控件所属文件的序号（模板中的resourceId排列序号，取值为：0-N）
 * @method string getComponentId() 获取控件编号
 * @method void setComponentId(string $ComponentId) 设置控件编号
 * @method string getComponentName() 获取控件名称
 * @method void setComponentName(string $ComponentName) 设置控件名称
 * @method boolean getComponentRequired() 获取是否必选，默认为false
 * @method void setComponentRequired(boolean $ComponentRequired) 设置是否必选，默认为false
 * @method string getComponentExtra() 获取参数控件样式
 * @method void setComponentExtra(string $ComponentExtra) 设置参数控件样式
 * @method string getComponentRecipientId() 获取控件关联的签署人ID
 * @method void setComponentRecipientId(string $ComponentRecipientId) 设置控件关联的签署人ID
 * @method string getComponentValue() 获取控件所填写的内容
 * @method void setComponentValue(string $ComponentValue) 设置控件所填写的内容
 * @method boolean getIsFormType() 获取是否是表单域类型，默认不存在
 * @method void setIsFormType(boolean $IsFormType) 设置是否是表单域类型，默认不存在
 * @method string getGenerateMode() 获取NORMAL 正常模式，使用坐标制定签署控件位置
FIELD 表单域，需使用ComponentName指定表单域名称
KEYWORD 关键字，使用ComponentId指定关键字
 * @method void setGenerateMode(string $GenerateMode) 设置NORMAL 正常模式，使用坐标制定签署控件位置
FIELD 表单域，需使用ComponentName指定表单域名称
KEYWORD 关键字，使用ComponentId指定关键字
 * @method integer getComponentDateFontSize() 获取日期控件类型字号
 * @method void setComponentDateFontSize(integer $ComponentDateFontSize) 设置日期控件类型字号
 */
class Component extends AbstractModel
{
    /**
     * @var string 如果是 Component 控件类型，则可选类型为：
TEXT - 内容文本控件
DATE - 内容日期控件
SELECT - 勾选框控件
如果是 SignComponent 控件类型，则可选类型为：
SIGN_SEAL - 签署印章控件
SIGN_DATE - 签署日期控件
SIGN_SIGNATURE - 手写签名控件
     */
    public $ComponentType;

    /**
     * @var float 参数控件宽度，单位px
     */
    public $ComponentWidth;

    /**
     * @var float 参数控件高度，单位px
     */
    public $ComponentHeight;

    /**
     * @var integer 参数控件所在页码，取值为：1-N
     */
    public $ComponentPage;

    /**
     * @var float 参数控件X位置，单位px
     */
    public $ComponentPosX;

    /**
     * @var float 参数控件Y位置，单位px
     */
    public $ComponentPosY;

    /**
     * @var integer 控件所属文件的序号（模板中的resourceId排列序号，取值为：0-N）
     */
    public $FileIndex;

    /**
     * @var string 控件编号
     */
    public $ComponentId;

    /**
     * @var string 控件名称
     */
    public $ComponentName;

    /**
     * @var boolean 是否必选，默认为false
     */
    public $ComponentRequired;

    /**
     * @var string 参数控件样式
     */
    public $ComponentExtra;

    /**
     * @var string 控件关联的签署人ID
     */
    public $ComponentRecipientId;

    /**
     * @var string 控件所填写的内容
     */
    public $ComponentValue;

    /**
     * @var boolean 是否是表单域类型，默认不存在
     */
    public $IsFormType;

    /**
     * @var string NORMAL 正常模式，使用坐标制定签署控件位置
FIELD 表单域，需使用ComponentName指定表单域名称
KEYWORD 关键字，使用ComponentId指定关键字
     */
    public $GenerateMode;

    /**
     * @var integer 日期控件类型字号
     */
    public $ComponentDateFontSize;

    /**
     * @param string $ComponentType 如果是 Component 控件类型，则可选类型为：
TEXT - 内容文本控件
DATE - 内容日期控件
SELECT - 勾选框控件
如果是 SignComponent 控件类型，则可选类型为：
SIGN_SEAL - 签署印章控件
SIGN_DATE - 签署日期控件
SIGN_SIGNATURE - 手写签名控件
     * @param float $ComponentWidth 参数控件宽度，单位px
     * @param float $ComponentHeight 参数控件高度，单位px
     * @param integer $ComponentPage 参数控件所在页码，取值为：1-N
     * @param float $ComponentPosX 参数控件X位置，单位px
     * @param float $ComponentPosY 参数控件Y位置，单位px
     * @param integer $FileIndex 控件所属文件的序号（模板中的resourceId排列序号，取值为：0-N）
     * @param string $ComponentId 控件编号
     * @param string $ComponentName 控件名称
     * @param boolean $ComponentRequired 是否必选，默认为false
     * @param string $ComponentExtra 参数控件样式
     * @param string $ComponentRecipientId 控件关联的签署人ID
     * @param string $ComponentValue 控件所填写的内容
     * @param boolean $IsFormType 是否是表单域类型，默认不存在
     * @param string $GenerateMode NORMAL 正常模式，使用坐标制定签署控件位置
FIELD 表单域，需使用ComponentName指定表单域名称
KEYWORD 关键字，使用ComponentId指定关键字
     * @param integer $ComponentDateFontSize 日期控件类型字号
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
        if (array_key_exists("ComponentType",$param) and $param["ComponentType"] !== null) {
            $this->ComponentType = $param["ComponentType"];
        }

        if (array_key_exists("ComponentWidth",$param) and $param["ComponentWidth"] !== null) {
            $this->ComponentWidth = $param["ComponentWidth"];
        }

        if (array_key_exists("ComponentHeight",$param) and $param["ComponentHeight"] !== null) {
            $this->ComponentHeight = $param["ComponentHeight"];
        }

        if (array_key_exists("ComponentPage",$param) and $param["ComponentPage"] !== null) {
            $this->ComponentPage = $param["ComponentPage"];
        }

        if (array_key_exists("ComponentPosX",$param) and $param["ComponentPosX"] !== null) {
            $this->ComponentPosX = $param["ComponentPosX"];
        }

        if (array_key_exists("ComponentPosY",$param) and $param["ComponentPosY"] !== null) {
            $this->ComponentPosY = $param["ComponentPosY"];
        }

        if (array_key_exists("FileIndex",$param) and $param["FileIndex"] !== null) {
            $this->FileIndex = $param["FileIndex"];
        }

        if (array_key_exists("ComponentId",$param) and $param["ComponentId"] !== null) {
            $this->ComponentId = $param["ComponentId"];
        }

        if (array_key_exists("ComponentName",$param) and $param["ComponentName"] !== null) {
            $this->ComponentName = $param["ComponentName"];
        }

        if (array_key_exists("ComponentRequired",$param) and $param["ComponentRequired"] !== null) {
            $this->ComponentRequired = $param["ComponentRequired"];
        }

        if (array_key_exists("ComponentExtra",$param) and $param["ComponentExtra"] !== null) {
            $this->ComponentExtra = $param["ComponentExtra"];
        }

        if (array_key_exists("ComponentRecipientId",$param) and $param["ComponentRecipientId"] !== null) {
            $this->ComponentRecipientId = $param["ComponentRecipientId"];
        }

        if (array_key_exists("ComponentValue",$param) and $param["ComponentValue"] !== null) {
            $this->ComponentValue = $param["ComponentValue"];
        }

        if (array_key_exists("IsFormType",$param) and $param["IsFormType"] !== null) {
            $this->IsFormType = $param["IsFormType"];
        }

        if (array_key_exists("GenerateMode",$param) and $param["GenerateMode"] !== null) {
            $this->GenerateMode = $param["GenerateMode"];
        }

        if (array_key_exists("ComponentDateFontSize",$param) and $param["ComponentDateFontSize"] !== null) {
            $this->ComponentDateFontSize = $param["ComponentDateFontSize"];
        }
    }
}

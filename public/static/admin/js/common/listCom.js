var listCom = {
    switchBtn: function (id, filed, type = 0, url) {
        var str = "";
        str = '<input class="mui-switch mui-switch-animbg ' + filed + id + '" type="checkbox" onclick="listCom.updateStatus(' + id + ',' + type + ',\'' + filed + '\',\'' + url + '\')"';
        if (type === 0) {
            str += ' checked';
        }
        return str + '>';
    },
    updateStatus: function (pk, value, field, url){
        let str = "." + field + pk;
        const ajax = new $ax(url, function (res) {
            if (res.status === 200) {
                com.success(res.msg, 1000);
            } else {
                com.error(res.msg)
                $(str).prop("checked", !$(str).prop("checked"));
            }

        });
        const val = $(str).prop("checked") ? 1 : 0;
        ajax.set('id', pk);
        ajax.set(field, val);
        ajax.start();
    },
    formatStr: function (val, param = []){
        for(let i = 0;i< param.length ;i++){
            if(param[i]['key'] === val){
                return param[i]['val'];
            }
        }
        return '--';
    },
    picFormatter: function(value) {
        if(value){
            return "<a href=\"javascript:void(0)\" onclick=\"openImg('"+value+"')\"><img height='30' src="+value+"></a>";
        }
    },
    order: function(id,sort,url,fk = 0){
        return "<i class=\"fa fa-long-arrow-up\" onclick=\"listCom.arrowSort("+id+","+sort+",1,\''"+url+"\'," + fk + ")\" style=\"cursor:pointer;\" title=\"上移\"></i>&nbsp;<i class=\"fa fa-long-arrow-down\" style=\"cursor:pointer;\" onclick=\"listCom.arrowSort("+id+","+sort+",2,\'"+ url +"\'," + fk +")\"  title=\"下移\"></i>";
    },
    arrowSort: function (pk,sort,type,url,fk = 0) {
        var ajax = new $ax(url, function (res) {
            if (200 === res.status) {
                com.success(res.msg);
                TableList.table.refresh();
            } else {
                com.error(res.msg);
            }
        });
        ajax.set('id', pk);
        ajax.set('type', type);
        ajax.set('sort', sort);
        ajax.set('fk',fk);
        ajax.start();
    },
    copy: function(val){
        var myText = document.createElement("textarea")
        myText.value = val;
        document.body.appendChild(myText)
        myText.select();
        document.execCommand('copy');
        document.body.removeChild(myText);
        com.success('复制成功');
    }
}

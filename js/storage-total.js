/*
 * @Author: Angra Mainyu
 * @Date: 2018-12-29 19:49:07
 * @LastEditors: Angra Mainyu
 * @LastEditTime: 2018-12-30 21:40:31
 * @Description: file content
 */
/* 总库存系统使用的js函数 */
layui.use(['table', 'laydate'], function () {
    var table = layui.table;
    var tableName = document.getElementById("storage").attributes["tablename"].value;

    //渲染
    tableIns = table.render({
        elem: '#storage'
        , height: 'full'
        , title: '入库货物表'
        , url: 'storage-inout.php'
        // , skin: 'row'
        , method: 'POST'
        , where: {
            token: 'secret',
            action: 'select',
            table: tableName
        }
        , page: true
        , id: "storage"
        , totalRow: true
        , toolbar: '#toolbar'
        , cols: [[ //表头
            { type: 'checkbox', fixed: 'left'}
            , { field: 'id', title: 'ID', sort: true, width: '30%'}
            , { field: 'name', title: '货物名', sort: true, width: '50%'}
            , { field: 'count', title: '数量', sort: true, totalRow: true}
            , { fixed: 'right', title: '操作', align: 'center', toolbar: '#Headbar' }
        ]]
        , done: function (res, curr, count) {
            layer.msg(res["msg"]);
        }
    });

    table.on('row(storage)', function (obj) {
        console.log(obj);
        //layer.closeAll('tips');
    });

    //监听表格行点击
    table.on('tr', function (obj) {
        console.log(obj)
    });

    //监听表格复选框选择
    table.on('checkbox(storage)', function (obj) {
        console.log(obj)
    });

    //监听表格单选框选择
    table.on('radio(storage)', function (obj) {
        console.log(obj)
    });

    //监听表格单选 框选择
    table.on('rowDouble(storage)', function (obj) {
        console.log(obj);
    });

    //监听单元格编辑
    table.on('edit(storage)', function (obj) {
        var value = obj.value //得到修改后的值
            , data = obj.data //得到所在行所有键值
            , field = obj.field; //得到字段
        console.log(obj);
    });

    var $ = layui.jquery, active = {
        parseTable: function () {
            table.init('parse-table-demo', {
                limit: 3
            });
        },
        add: function () {
            table.addRow('storage')
        },
        reload: function () {
            //执行重载
            console.log("start reload");
            tableIns.reload({
                page: {
                    curr: 1 //重新从第 1 页开始
                }
                , where: {
                    token: 'secret',
                    action: 'select',
                    table: tableName,
                    id: $('#reload-id').val() == '' ? undefined : $('#reload-id').val(),
                    name: $("#reload-name").val() == '' ? undefined : $("#reload-name").val()
                }
            });
        }
    };

    $('i').on('click', function () {
        var type = $(this).data('type');
        active[type] ? active[type].call(this) : '';
    });
    $('.layui-btn').on('click', function () {
        var type = $(this).data('type');
        active[type] ? active[type].call(this) : '';
    });

});
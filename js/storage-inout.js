/*
 * @Author: Angra Mainyu
 * @Date: 2018-12-10 19:21:33
 * @LastEditors: Angra Mainyu
 * @LastEditTime: 2018-12-30 21:38:02
 * @Description: file content
 */
/* 出入库系统使用的js函数 */
layui.use(['table', 'laydate'], function () {
    var table = layui.table;
    var tableName = document.getElementById("storage").attributes["tablename"].value;
    if (tableName == "input") {
        var ord_id = 'iid';
    }
    else {
        var ord_id = 'oid';
    }

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
            { type: 'checkbox', fixed: 'left' },
            { field: ord_id, title: '订单号', sort: true, totalRowText: '合计' }
            , { field: 'name', title: '货物名', sort: true, edit: 'text' }
            // , { field: 'id', title: 'ID', sort: true, edit: 'text' }
            , { field: 'price', title: '单价', sort: true, edit: 'text' }
            , { field: 'count', title: '数量', sort: true, edit: 'test', totalRow: true }
            , { field: 'total', title: '总价', sort: true, totalRow: true }
            , { field: 'manager', title: '经手人', edit: 'text' }
            , { field: 'date', title: '操作日期', sort: true }
            , { field: 'time', title: '操作时间', sort: true }
            , { fixed: 'right', title: '操作', align: 'center', toolbar: '#Headbar' }
        ]]
        , done: function (res, curr, count) {
            layer.msg(res["msg"]);
        }
    });

    //工具栏事件
    table.on('toolbar(storage)', function (obj) {
        var checkStatus = table.checkStatus(obj.config.id);
        switch (obj.event) {
            case 'add':
                layer.open({
                    title: '货物信息添加',
                    type: 2,
                    skin: 'layui-layer-rim', //加上边框
                    area: ['50%', '70%'], //宽高
                    content: 'item-add.html', //弹出的页面
                    shadeClose: true, //点击遮罩关闭
                    success: function (layero, index) {
                        var body = layer.getChildFrame('body', index);
                        // console.log(body.html()) //得到iframe页的body内容
                        //初始化表单数据的值
                        body.find("#edit-table").val(tableName);
                    },
                    // end: function () {
                    //     location.reload();
                    // }
                });
                layer.msg('添加');
                break;
            case 'update':
                layer.msg('编辑');
                break;
            case 'delete':
                var data = checkStatus.data;
                layer.alert(JSON.stringify(data));
                // console.log("delete data");
                console.log(JSON.stringify(data));
                layer.confirm('确认要删除吗?', function (index) {
                    //捉到所有被选中的，发异步进行删除
                    layer.msg('删除成功', { icon: 1 });
                    $(".layui-form-checked").not('.header').parents('tr').remove();
                });
                // layer.msg('删除');
                break;
            case 'getCheckData':
                var data = checkStatus.data;
                layer.alert(JSON.stringify(data));
                break;
            case 'getCheckLength':
                var data = checkStatus.data;
                layer.msg('选中了：' + data.length + ' 个');
                break;
            case 'isAll':
                layer.msg(checkStatus.isAll ? '全选' : '未全选')
                break;
        };
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
        layer.confirm("确定将" + field + "修改成" + value + "?", function () {
            $.post(
                url = 'storage-inout.php',
                data = {
                    token: 'secret',
                    action: 'update',
                    table: tableName,
                    data: JSON.stringify(data),
                    field: field,
                    value: value
                },
                success = function (res) {
                    console.log(res);
                    res = JSON.parse(res);
                    if (res["code"] == 1) {
                        // 更新页面元素
                        layer.msg("编辑成功");
                    }
                    tableIns.reload({
                        where: {
                            token: 'secret',
                            action: 'select',
                            table: tableName,
                        }
                    });
                }
            );
        })
    });

    //监听行工具事件
    table.on('tool(storage)', function (obj) {
        var data = obj.data;
        //console.log(obj)
        switch (obj.event) {
            case 'edit':
                layer.open({
                    title: '货物信息修改',
                    type: 2,
                    skin: 'layui-layer-rim', //加上边框
                    area: ['50%', '70%'], //宽高
                    content: 'item-edit.html', //弹出的页面
                    shadeClose: true, //点击遮罩关闭
                    success: function (layero, index) {
                        var body = layer.getChildFrame('body', index);
                        // console.log(body.html()) //得到iframe页的body内容
                        //初始化表单数据的值
                        body.find("#edit-iid").val(data['iid']); //要修改的每个td的值存为变量传进去
                        body.find("#edit-oid").val(data['oid']);
                        // body.find("#edit-iid").defaultValue = data['iid'];
                        body.find("#edit-name").val(data['name']);
                        body.find("#edit-id").val(data['id']);
                        body.find("#edit-price").val(data['price']);
                        body.find("#edit-count").val(data['count']);
                        body.find("#edit-total").val(data['total']);
                        body.find("#edit-manager").val(data['manager']);
                    }
                });
                break;
            case 'view':
                layer.open({
                    title: '货物信息修改',
                    type: 2,
                    skin: 'layui-layer-rim', //加上边框
                    area: ['50%', '70%'], //宽高
                    content: 'item-view.html', //弹出的页面
                    shadeClose: true, //点击遮罩关闭
                    success: function (layero, index) {
                        var body = layer.getChildFrame('body', index);
                        // console.log(body.html()) //得到iframe页的body内容
                        //初始化表单数据的值
                        body.find("#edit-ord-id").val(data[ord_id]); //要修改的每个td的值存为变量传进去
                        // body.find("#edit-iid").defaultValue = data['iid'];
                        body.find("#edit-name").val(data['name']);
                        body.find("#edit-id").val(data['id']);
                        body.find("#edit-price").val(data['price']);
                        body.find("#edit-count").val(data['count']);
                        body.find("#edit-total").val(data['total']);
                        body.find("#edit-manager").val(data['manager']);
                    }
                });
                break;
            case 'del':
                layer.confirm('确认要删除吗？', function (index) {
                    //发异步删除数据
                    $.post(
                        url = 'storage-inout.php',
                        data = {
                            token: 'secret',
                            action: 'delete',
                            table: tableName,
                            data: JSON.stringify(data)
                        },
                        success = function (res) {
                            console.log(res);
                            res = JSON.parse(res);
                            if (res["code"] == 1) {
                                // 更新页面元素,执行重载
                                tableIns.reload({
                                    where: {
                                        token: 'secret',
                                        action: 'select',
                                        table: tableName,
                                    }
                                });
                                layer.msg("删除成功");
                            }
                            else {
                                layer.msg("删除失败");
                            }
                        }
                    );
                });
                break;
            default:
                break;
        }
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
                    iid: $('#reload-iid').val() == '' ? undefined : $('#reload-iid').val(),
                    oid: $('#reload-oid').val() == '' ? undefined : $('#reload-oid').val(),
                    name: $("#reload-name").val() == '' ? undefined : $("#reload-name").val(),
                    manager: $("#reload-manager").val() == '' ? undefined : $("#reload-manager").val(),
                    date1: $("#datetime").val() == '' ? undefined : $("#datetime").val().substr(0, 10),
                    date2: $("#datetime").val() == '' ? undefined : $("#datetime").val().substr(22, 10),
                    time1: $("#datetime").val() == '' ? undefined : $("#datetime").val().substr(11, 8),
                    time2: $("#datetime").val() == '' ? undefined : $("#datetime").val().substr(33, 8),
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

    var laydate = layui.laydate;
    laydate.render({
        elem: '#datetime' //指定元素
        , type: 'datetime'
        , trigger: 'click'
        , lang: 'zh'
        , range: true //开启日期范围，默认使用“_”分割
        , done: function (value, date, endDate) {
            console.log(value, date, endDate);
        }
        , change: function (value, date, endDate) {
            console.log(value, date, endDate);
        }
    });
});
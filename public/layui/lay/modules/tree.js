/**

 @Name：layui.tree 树组件
 @Author：贤心
 @License：MIT
    
 */
 
 
layui.define('jquery', function(exports){
  "use strict";
  
  var $ = layui.$
  ,hint = layui.hint();
  
  var enterSkin = 'layui-tree-enter', Tree = function(options){
    this.options = options;
    //选中的叶子节点，用于在数渲染完成后，初始化默认选择状态
    this.checkedLeafNodes = [];
  };
  
  //图标
  var icon = {
    arrow: ['&#xe623;', '&#xe625;'] //箭头
    ,checkbox: ['&#xe680;', '&#xe721;', '&#xe669;'] //复选框
    ,radio: ['&#xe67e;', '&#xe633;'] //单选框
    ,branch: ['&#xe622;', '&#xe622;'] //父节点
    ,leaf: '&#xe621;' //叶节点
  };
  
  //初始化
  Tree.prototype.init = function(elem){
    var that = this;
    that.root = elem;//根节点
    elem.addClass('layui-box layui-tree'); //添加tree样式
    if(that.options.skin){
      elem.addClass('layui-tree-skin-'+ that.options.skin);
    }
    //清空
    that.checkedLeafNodes.length = 0;
    that.tree(elem);
    that.on(elem);
    //数据加载完后，初始化各个节点的选择状态
    if (that.checkedLeafNodes.length > 0) {
      layui.each(that.checkedLeafNodes, function (index, node) {
        that.checkThisNode(node);
      });
    }
  };
  
  //树节点解析
  Tree.prototype.tree = function(elem, children){
    var that = this
        ,options = that.options
        ,nodes = children || options.nodes;

    layui.each(nodes, function(index, item){
      var hasChild = item.children && item.children.length > 0;
      var ul = $('<ul class="'+ (item.spread ? "layui-show" : "") +'"></ul>');
      var li = $(['<li '+ (item.spread ? 'data-spread="'+ item.spread +'"' : '') +'>'
        //展开箭头
        ,function(){
          return hasChild ? '<i class="layui-icon layui-tree-spread">'+ (
            item.spread ? icon.arrow[1] : icon.arrow[0]
          ) +'</i>' : '';
        }()
        
        //复选框/单选框
        ,function(){
          return options.check ? (
            '<i class="layui-icon-ext layui-tree-check">'+ (
              options.check === 'checkbox' ? icon.checkbox[0] : (
                options.check === 'radio' ? icon.radio[0] : ''
              )
            ) +'</i>'
          ) : '';
        }()
        
        //节点
        ,function(){
          return '<a href="'+ (item.href || 'javascript:;') +'" '+ (
            options.target && item.href ? 'target=\"'+ options.target +'\"' : ''
          ) +'>'
          + ('<i class="layui-icon layui-tree-'+ (hasChild ? "branch" : "leaf") +'">'+ (
            hasChild ? (
              item.spread ? icon.branch[1] : icon.branch[0]
            ) : icon.leaf
          ) +'</i>') //节点图标
          + ('<cite>'+ (item.name||'未命名') +'</cite></a>');
        }()
      
      ,'</li>'].join(''));
      
      //如果有子节点，则递归继续生成树
      if(hasChild){
        li.append(ul);
        that.tree(ul, item.children);
      }

      var json = $.extend({}, item);
      delete json.children;//去掉子节点数据
      li.data('json', json);
      //默认未选中
      if (options.check) {
        li.children('i.layui-tree-check').data('uncheck', true);
        //记录默认选中的叶子节点
        if (!hasChild && item.checked) {
          that.checkedLeafNodes.push(li);
        }
      }
      elem.append(li);

      //触发点击节点回调
      typeof options.click === 'function' && that.click(li, item); 
      
      //伸展节点
      that.spread(li, item);
      
      //拖拽节点
      options.drag && that.drag(li, item); 
    });
  };

  //设置当前节点的选择状态
  Tree.prototype.checkThisNode = function (elem) {
    var that = this,
        options = that.options,
        iconElem = elem.children('i.layui-tree-check');
    if (options.check == 'checkbox') {//复选
      var iconText;
      var checkFlag = true;
      if (iconElem.data('uncheck') || iconElem.data('halfcheck')) {
        iconText = icon.checkbox[1];
        iconElem.data('halfcheck', false).data('uncheck', false).data('check', true);
      } else {
        checkFlag = false;
        iconText = icon.checkbox[0];
        iconElem.data('halfcheck', false).data('check', false).data('uncheck', true);
      }
      iconElem.html(iconText);
      //(取消)选中所有子节点
      elem.find('ul>li').each(function () {
        $(this).children('i.layui-tree-check')
            .html(iconText)
            .data('halfcheck', !checkFlag)
            .data(checkFlag ? 'uncheck' : 'check', false)
            .data(checkFlag ? 'check' : 'uncheck', true);
      });
      !elem.parent().hasClass('layui-tree') && that.checkNode(elem);
    } else if (options.check == 'radio') {//单选
      if (iconElem.data('uncheck')) {//选中
        //取消其他节点选中
        $(that.root).find('i[class*="layui-tree-check"]').each(function () {
          $(this).html(icon.radio[0]).data('check', false).data('uncheck', true);
        });
        iconElem.html(icon.radio[1]).data('uncheck', false).data('check', true);
      } else {//是否需要取消选中?
        //iconElem.html(icon.radio[0]).removeAttr('check').attr('uncheck', '');
      }
    }
  };

  //选中节点
  Tree.prototype.checkNode = function(elem) {
    var that = this;

    //是否所有节点（含当前节点、其兄弟节点、所有子节点）都选中
    var allNodeCheck = true;
    //未选中的节点数量
    var uncheck = 0;
    //当前节点 & 兄弟节点
    var lis = $.merge(elem.siblings(), [elem]);
    layui.each(lis, function () {
      var iconElem = $(this).children('i.layui-tree-check');
      if (iconElem.data('uncheck')) {
        allNodeCheck = false;
        uncheck++;
      }
    });

    var parentNode;
    //是否需要继续处理父级节点
    var checkParentNode = false;
    //父节点已是根节点
    if ((parentNode = elem.parent()).hasClass('layui-tree')) {
      // ignore
    } else if (!(parentNode = elem.parent().parent()).hasClass('layui-tree')) {
      checkParentNode = true;
    }

    //如果当前节点 & 兄弟节点都已选中，还需要验证所有子节点
    parentNode.children('ul').find('i.layui-tree-check').each(function () {
      if ($(this).data('uncheck') || $(this).data('halfcheck')) {
        allNodeCheck = false;
      }
    });

    //是否所有节点都未选中
    var allNodeUncheck = uncheck == lis.length;
    var iconText = (allNodeUncheck ? icon.checkbox[0] : (
        allNodeCheck ? icon.checkbox[1] : icon.checkbox[2]
    ));

    //处理选中状态图标
    var iconCheck = parentNode.children('i.layui-tree-check').html(iconText);
    if (allNodeUncheck) {
      iconCheck.data('check', false).data('halfcheck', false).data('uncheck', true);
    } else {
      iconCheck.data('uncheck', false).data('check', true);
      allNodeCheck ? iconCheck.data('halfcheck', false) : iconCheck.data('halfcheck', true);
    }

    //继续处理父级节点
    checkParentNode && that.checkNode(parentNode);
  };

  /**
   * 获取选中节点
   * @param onlyLeaf 是否只返回叶子节点
   * @returns {Array}
   */
  Tree.prototype.getChecked = function(onlyLeaf) {
    var checkedNodes = [];
    var allNodes = this.root.find('li');
    layui.each(allNodes, function () {
      var elem = $(this);
      if (elem.children('i.layui-tree-check').data('check')) {
        if (onlyLeaf) {
          if (elem.children('a').find('i.layui-tree-leaf')[0]) {
            checkedNodes.push(elem.data('json'));
          }
        } else {
          checkedNodes.push(elem.data('json'));
        }
      }
    });
    return checkedNodes;
  };
  
  //点击节点回调
  Tree.prototype.click = function(elem, item){
    var that = this, options = that.options;
    elem.children('a,i.layui-tree-check').on('click', function(e){
      layui.stope(e);
      options.click(item);

      //单选/复选开启
      options.check && that.checkThisNode(elem);
    });
  };
  
  //伸展节点
  Tree.prototype.spread = function(elem, item){
    var that = this, options = that.options;
    var arrow = elem.children('.layui-tree-spread')
    var ul = elem.children('ul'), a = elem.children('a');
    
    //执行伸展
    var open = function(){
      if(elem.data('spread')){
        elem.data('spread', null)
        ul.removeClass('layui-show');
        arrow.html(icon.arrow[0]);
        a.find('.layui-icon').html(icon.branch[0]);
      } else {
        elem.data('spread', true);
        ul.addClass('layui-show');
        arrow.html(icon.arrow[1]);
        a.find('.layui-icon').html(icon.branch[1]);
      }
    };
    
    //如果没有子节点，则不执行
    if(!ul[0]) return;
    
    arrow.on('click', open);
    a.on('dblclick', open);
  }
  
  //通用事件
  Tree.prototype.on = function(elem){
    var that = this, options = that.options;
    var dragStr = 'layui-tree-drag';
    
    //屏蔽选中文字
    elem.find('i').on('selectstart', function(e){
      return false
    });
    
    //拖拽
    if(options.drag){
      $(document).on('mousemove', function(e){
        var move = that.move;
        if(move.from){
          var to = move.to, treeMove = $('<div class="layui-box '+ dragStr +'"></div>');
          e.preventDefault();
          $('.' + dragStr)[0] || $('body').append(treeMove);
          var dragElem = $('.' + dragStr)[0] ? $('.' + dragStr) : treeMove;
          (dragElem).addClass('layui-show').html(move.from.elem.children('a').html());
          dragElem.css({
            left: e.pageX + 10
            ,top: e.pageY + 10
          })
        }
      }).on('mouseup', function(){
        var move = that.move;
        if(move.from){
          move.from.elem.children('a').removeClass(enterSkin);
          move.to && move.to.elem.children('a').removeClass(enterSkin);
          that.move = {};
          $('.' + dragStr).remove();
        }
      });
    }
  };
    
  //拖拽节点
  Tree.prototype.move = {};
  Tree.prototype.drag = function(elem, item){
    var that = this, options = that.options;
    var a = elem.children('a'), mouseenter = function(){
      var othis = $(this), move = that.move;
      if(move.from){
        move.to = {
          item: item
          ,elem: elem
        };
        othis.addClass(enterSkin);
      }
    };
    a.on('mousedown', function(){
      var move = that.move
      move.from = {
        item: item
        ,elem: elem
      };
    });
    a.on('mouseenter', mouseenter).on('mousemove', mouseenter)
    .on('mouseleave', function(){
      var othis = $(this), move = that.move;
      if(move.from){
        delete move.to;
        othis.removeClass(enterSkin);
      }
    });
  };
  
  //暴露接口
  exports('tree', function(options){
    var tree = new Tree(options = options || {});
    var elem = $(options.elem);
    if(!elem[0]){
      return hint.error('layui.tree 没有找到'+ options.elem +'元素');
    }
    tree.init(elem);
    return tree;
  });
});

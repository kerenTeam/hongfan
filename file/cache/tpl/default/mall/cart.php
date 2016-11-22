<?php defined('IN_DESTOON') or exit('Access Denied');?><?php include template('header');?>
<?php if($action == 'show') { ?>
<div class="m">
<div class="left_box">
<div class="pos">
您的位置: <a href="<?php echo DT_PATH;?>">首页</a> 
&raquo; <a href="<?php echo $MOD['linkurl'];?>"><?php echo $MOD['name'];?></a>
&raquo; <a href="<?php echo $MOD['linkurl'];?>cart.php">购物车</a>
</div>
<?php if($code > 0) { ?>
<div style="padding:80px;" class="t_c px14 f_b"><img src="<?php echo DT_STATIC;?><?php echo $MODULE['2']['moduledir'];?>/image/ok.gif" alt="" align="absmiddle"/>  商品已成功加入购物车！ 
&nbsp;&nbsp;&nbsp;<a href="<?php echo DT_PATH;?>api/redirect.php?mid=<?php echo $moduleid;?>&itemid=<?php echo $code;?>" class="b">继续购物</a>&nbsp;&nbsp;&nbsp;<a href="<?php echo $MOD['linkurl'];?>cart.php" class="b">去购物车结算</a></div>
<?php } else { ?>
<div style="padding:80px;" class="t_c px14 f_b">
<img src="<?php echo DT_STATIC;?><?php echo $MODULE['2']['moduledir'];?>/image/ko.gif" alt="" align="absmiddle"/>
添加失败！
<?php if($code == -1) { ?>
商品已经下架
<?php } else if($code == -2) { ?>
商品由您自己发布
<?php } else { ?>
商品已经下架或由您自己发布
<?php } ?>
&nbsp;&nbsp;&nbsp;<a href="<?php if($code == -1) { ?><?php echo $MOD['linkurl'];?><?php } else { ?><?php echo DT_PATH;?>api/redirect.php?mid=<?php echo $moduleid;?>&itemid=<?php echo $id;?><?php } ?>
" class="b">继续购物</a>&nbsp;&nbsp;&nbsp;<a href="<?php echo $MOD['linkurl'];?>cart.php" class="b">去购物车结算</a>
</div>
<?php } ?>
</div>
</div>
<?php } else { ?>
<script type="text/javascript">
var errimg = '<?php echo DT_SKIN;?>image/nopic50.gif';
function check() {
if(Dd('itemid').value == 0 || Dd('itemid').value == '') {
alert('请输入商品ID');
Dd('itemid').focus();
return false;
}
return true;
}
</script>
<div class="m">
<div class="left_box">
<div class="pos">
<div class="f_r">
<a href="?action=clear" onclick="return confirm('确定要清空购物车吗？');" class="b">清空</a>&nbsp;&nbsp;
</div>
您的位置: <a href="<?php echo DT_PATH;?>">首页</a> 
&raquo; <a href="<?php echo $MOD['linkurl'];?>"><?php echo $MOD['name'];?></a>
&raquo; <a href="<?php echo $MOD['linkurl'];?>cart.php">购物车</a>
</div>
<?php if($lists) { ?>
<form method="post" action="<?php echo $MOD['linkurl'];?>buy.php" onsubmit="return Mcheck();">
<input type="hidden" name="from" value="cart"/>
<table cellpadding="10" cellspacing="0" width="100%">
<tr align="center" bgcolor="#F6F6F6">
<td width="20"><input type="checkbox" onclick="checkall(this.form);calculate();"/></td>
<td width="60">图片</td>
<td>商品</td>
<td>库存</td>
<td>单价</td>
<td>数量</td>
<td width="100">小计</td>
<td width="40">操作</td>
</tr>
<?php if(is_array($lists)) { foreach($lists as $i => $t) { ?>
<tr align="center"<?php if($i%2==1) { ?> bgcolor="#F6F6F6"<?php } ?>
 id="tr_<?php echo $t['key'];?>">
<td>
<input type="checkbox" name="cart[]" value="<?php echo $t['key'];?>" checked onclick="calculate()" id="check_<?php echo $t['key'];?>"/>
<input type="hidden" id="a1_<?php echo $t['key'];?>" value="<?php echo $t['a1'];?>"/>
<input type="hidden" id="a2_<?php echo $t['key'];?>" value="<?php echo $t['a2'];?>"/>
<input type="hidden" id="a3_<?php echo $t['key'];?>" value="<?php echo $t['a3'];?>"/>
<input type="hidden" id="p1_<?php echo $t['key'];?>" value="<?php echo $t['p1'];?>"/>
<input type="hidden" id="p2_<?php echo $t['key'];?>" value="<?php echo $t['p2'];?>"/>
<input type="hidden" id="p3_<?php echo $t['key'];?>" value="<?php echo $t['p3'];?>"/>
<input type="hidden" id="amount_<?php echo $t['key'];?>" value="<?php echo $t['amount'];?>"/>
</td>
<td><a href="<?php echo $t['linkurl'];?>" target="_blank"><img src="<?php echo $t['thumb'];?>" width="50" alt="<?php echo $t['alt'];?>"  onerror="this.src=errimg;"/></a></td>
<td align="left" style="line-height:24px;color:#666666;"><a href="<?php echo $t['linkurl'];?>" target="_blank" class="b" title="<?php echo $t['alt'];?>"><?php echo $t['title'];?></a><br/>
<?php if($t['vip']) { ?><img src="<?php echo DT_SKIN;?>image/vip_<?php echo $t['vip'];?>.gif" alt="<?php echo VIP;?>" title="<?php echo VIP;?>:<?php echo $t['vip'];?>级" align="absmiddle"/> <?php } ?>
<a href="<?php echo userurl($t['username']);?>" target="_blank"><?php echo $t['company'];?></a>
<?php if($DT['im_web']) { ?><?php echo im_web($t['username'].'&mid='.$moduleid.'&itemid='.$t['itemid']);?>&nbsp;<?php } ?>
<?php if($t['qq'] && $DT['im_qq']) { ?><?php echo im_qq($t['qq']);?>&nbsp;<?php } ?>
<?php if($t['ali'] && $DT['im_ali']) { ?><?php echo im_ali($t['ali']);?>&nbsp;<?php } ?>
<?php if($t['msn'] && $DT['im_msn']) { ?><?php echo im_msn($t['msn']);?>&nbsp;<?php } ?>
<?php if($t['skype'] && $DT['im_skype']) { ?><?php echo im_skype($t['skype']);?></a>&nbsp;<?php } ?>
<br/>品牌:<?php if($t['brand']) { ?><?php echo $t['brand'];?><?php } else { ?>未填写<?php } ?>
&nbsp;<?php if($t['m1']) { ?><?php echo $t['n1'];?>:<?php echo $t['m1'];?>&nbsp;<?php } ?>
<?php if($t['m2']) { ?><?php echo $t['n2'];?>:<?php echo $t['m2'];?>&nbsp;<?php } ?>
<?php if($t['m3']) { ?><?php echo $t['n3'];?>:<?php echo $t['m3'];?>&nbsp;<?php } ?>
</td>
<td><?php echo $t['amount'];?></td>
<td title="<?php if($t['a2']) { ?><?php echo $t['a1'];?>-<?php echo $t['a2'];?><?php echo $t['unit'];?> <?php echo $DT['money_sign'];?><?php echo $t['p1'];?>&#10;<?php if($t['a3']) { ?><?php echo $t['a2']+1;?>-<?php echo $t['a3'];?><?php echo $t['unit'];?> <?php echo $DT['money_sign'];?><?php echo $t['p2'];?>&#10;<?php echo $t['a3'];?><?php echo $t['unit'];?>以上 <?php echo $DT['money_sign'];?><?php echo $t['p3'];?><?php } else { ?><?php echo $t['a2']+1;?><?php echo $t['unit'];?>以上 <?php echo $DT['money_sign'];?><?php echo $t['p2'];?><?php } ?>
<?php } else { ?><?php echo $DT['money_sign'];?><?php echo $t['p1'];?><?php } ?>
"><span class="f_price" id="price_<?php echo $t['key'];?>"><?php echo $t['price'];?></span></td>
<td><img src="<?php echo DT_SKIN;?>image/arrow_l.gif" width="16" height="8" alt="减少" class="c_p" onclick="alter('<?php echo $t['key'];?>', '-');"/><input type="text" name="amounts[<?php echo $t['key'];?>]" value="<?php echo $t['a'];?>" id="number_<?php echo $t['key'];?>" size="3" onblur="calculate();" class="cc_inp"/> <img src="<?php echo DT_SKIN;?>image/arrow_r.gif" width="16" height="8" alt="增加" class="c_p" onclick="alter('<?php echo $t['key'];?>', '+');"/></td>
<td><span class="f_price" id="total_<?php echo $t['key'];?>"><?php echo $t['price'];?></span></td>
<td class="c_p f_dblue" onclick="if(confirm('确定要移除此商品吗？')) move('<?php echo $t['key'];?>');">删除</a></td>
</tr>
<?php } } ?>
</table>
<div class="b10">&nbsp;</div>
<div class="cart_foot">已选商品 <span class="f_red f_b px16" id="total_good"></span> 件&nbsp;&nbsp;&nbsp;&nbsp;合计(不含运费)： <span class="f_red f_b px16" id="total_amount"></span> <?php echo $DT['money_unit'];?></div>
<div class="b10">&nbsp;</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr align="center">
<td height="60">&nbsp;</td>
<td width="280"><a href="<?php echo $MOD['linkurl'];?>"><img src="<?php echo DT_SKIN;?>image/btn_browse.gif" width="106" height="33" alt="继续购物"/></a></td>
<td width="280"><input type="image" src="<?php echo DT_SKIN;?>image/btn_buynext.gif"/></td>
</tr>
<tr align="center">
<td height="50">&nbsp;</td>
<td class="f_gray">您也可以返回到<?php echo $MOD['name'];?>首页，继续挑选商品</td>
<td class="f_gray">如果您已经完成挑选，请您点下一步进入提交订单</td>
</tr>
</table>
</form>
<?php } else { ?>
<div style="padding:80px;" class="t_c px14 f_b"><img src="<?php echo DT_SKIN;?>image/cart_empty.png" width="57" height="49" alt="" align="absmiddle"/> 您的 <span class="f_orange">购物车</span> 还是空的，赶快行动吧！马上去 <a href="<?php echo $MOD['linkurl'];?>" class="b">挑选商品</a></div>
<?php } ?>
</div>
</div>
<script type="text/javascript">
function Mcheck() {
if(Dd('total_good').innerHTML == '0') {
alert('最少需要挑选1件商品');
window.scroll(0, 0);
return false;
}
    return true;
}
function move(i) {
Dd('check_'+i).checked = false;
Dd('check_'+i).disabled = true;
Dh('tr_'+i);
calculate();
makeRequest('action=delete&ajax=1&key='+i, '?', '_move');
}
function _move() {
if(xmlHttp.readyState==4 && xmlHttp.status==200) {
var cart_num = get_cart();
$('#destoon_cart').html(cart_num > 0 ? '<strong>'+cart_num+'</strong>' : '0');
if(xmlHttp.responseText == 1 && Dd('total_good').innerHTML == '0') Go('?rand=<?php echo $DT_TIME;?>');
}
}
function alter(i, t) {
if(t == '+') {
var maxa = parseFloat(Dd('amount_'+i).value);
if(maxa && Dd('number_'+i).value >= maxa) return;
Dd('number_'+i).value =  parseInt(Dd('number_'+i).value) + 1;
} else {
var mina = parseFloat(Dd('a1_'+i).value);
if(Dd('number_'+i).value <= mina) return;
Dd('number_'+i).value = parseInt(Dd('number_'+i).value) - 1;
}
calculate();
}
function get_price(i) {
if(Dd('a2_'+i).value > 0) {
if(Dd('a3_'+i).value > 1 && parseInt(Dd('number_'+i).value) > parseInt(Dd('a3_'+i).value)) return Dd('p3_'+i).value;
if(Dd('a2_'+i).value > 1 && parseInt(Dd('number_'+i).value) > parseInt(Dd('a2_'+i).value)) return Dd('p2_'+i).value;
}
return Dd('p1_'+i).value
}
function calculate() {
var itemids = [<?php if(is_array($lists)) { foreach($lists as $i => $t) { ?><?php if($i) { ?>,<?php } ?>
'<?php echo $t['key'];?>'<?php } } ?>];
var _good = _amount = _total = 0;
for(var i = 0; i < itemids.length; i++) {
if(Dd('check_'+itemids[i]).checked && !Dd('check_'+itemids[i]).disabled) {
itemid = itemids[i];
var num, good, maxa, mina, price;
num = parseInt(Dd('number_'+itemid).value);
maxa = parseInt(Dd('amount_'+itemid).value);
mina = parseInt(Dd('a1_'+itemid).value);
if(num < mina) Dd('number_'+itemid).value = num = mina;
if(num > maxa) Dd('number_'+itemid).value = num = maxa;
if(isNaN(num) || num < 0) Dd('number_'+itemid).value = num = mina;
_good++;
price = parseFloat(get_price(itemid));
_total = price*num;
_amount += _total;
Dd('price_'+itemid).innerHTML = price.toFixed(2);
Dd('total_'+itemid).innerHTML = _total.toFixed(2);
}
}
Dd('total_good').innerHTML = _good;
Dd('total_amount').innerHTML = _amount.toFixed(2);
}
<?php if($lists) { ?>calculate();<?php } ?>
</script>
<?php } ?>
<?php include template('footer');?>
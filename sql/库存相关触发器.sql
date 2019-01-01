/* 入库insert  */

create trigger insert_input
after insert on input
for each row
begin
	declare thing varchar(45);
	select name into thing from goods where id = new.id;
	if new.name != thing
	then
		signal sqlstate'HY000' set message_text = '货物id与货物不对应，插入失败';
	end if;
	
	update stock set count = count + new.count where id = new.id;
    
    if not exists (select id from stock where id = new.id) then
		insert into stock value(new.id,new.name,new.count);
	end if;
    
end;



/* 入库delete */

create trigger delete_input
before delete on input
for each row
begin

	declare num int;
	select count into num from stock where id = old.id;
    
    if old.count > num
    then
		signal sqlstate'HY000' set message_text = '库存中此商品数量不足，删除入库订单失败';
	else
	update stock set count = count - old.count where id = old.id;
    end if;  
    
end;


/* 入库update */

create trigger update_input
before update on input
for each row
begin

	declare num int;
	select count into num from stock where id = old.id;
    
    if( old.id = new.id ) then
    begin
		if( (num - old.count + new.count) < 0 ) then
			signal sqlstate'HY000' set message_text = '修改入库订单数量后，库存中此商品数量不足，修改入库订单失败';
		else
			update stock set count = count - old.count + new.count where id = old.id;
		end if;
    end;
    
	
	else
		if ( old.count > num ) then
			signal sqlstate'HY000' set message_text = '修改入库订单商品后，库存中原商品数量不足，修改入库订单失败';
		else
        begin
			update stock set count = count - old.count where id = old.id;
			update stock set count = count + new.count where id = new.id;
    
			if not exists (select id from stock where id = new.id) then
			insert into stock value(new.id,new.name,new.count);
			end if;
		end;
		end if; 
        
	end if;
    
end;


/* 出库insert */

create trigger insert_output
before insert on output
for each row
begin

	declare num int;
	select count into num from stock where id = new.id;
    
    if not exists (select id from stock where id = new.id) 
    then
		signal sqlstate'HY000' set message_text = '库存并不存在此商品，出库失败';
	end if;
    
    if new.count > num
    then
		signal sqlstate'HY000' set message_text = '库存此商品不足，出库失败';
	else
	update stock set count = count - new.count where id = new.id;
    end if;  
    
end;


/* 出库delete */

create trigger delete_output
before delete on output
for each row
begin

	update stock set count = count + old.count where id = old.id;
    
end;

/* 出库update */

create trigger update_output
before update on output
for each row
begin

	declare num int;
	select count into num from stock where id = new.id;
    
    if( old.id = new.id ) then
    begin
		if( (num + old.count - new.count) < 0 ) then
			signal sqlstate'HY000' set message_text = '修改出库订单数量后，库存中此商品数量不足，修改出库订单失败';
		else
			update stock set count = count + old.count - new.count where id = new.id;
		end if;
    end;
    
	
	else
		if ( new.count > num ) then
			signal sqlstate'HY000' set message_text = '修改出库订单商品后，库存中此商品数量不足，修改出库订单失败';
		else
        begin
			update stock set count = count + old.count where id = old.id;
			update stock set count = count - new.count where id = new.id;
		end;
		end if; 
        
	end if;
    
end;
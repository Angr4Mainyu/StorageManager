/*
 * @Author: Angra Mainyu
 * @Date: 2018-12-10 14:58:09
 * @LastEditors: Angra Mainyu
 * @LastEditTime: 2018-12-30 21:37:59
 * @Description: file content
 */

-- -----------------------------------------------------
-- Data for table `storage`.`input`
-- -----------------------------------------------------
START TRANSACTION;
USE `storage`;
INSERT INTO `storage`.`input` (`iid`, `id`, `name`, `count`, `price`, `manager`, `date`, `time`) VALUES (100001, 3, '苹果', 10, 7, '郑子铭', '2018-12-9', '18:23:14');
INSERT INTO `storage`.`input` (`iid`, `id`, `name`, `count`, `price`, `manager`, `date`, `time`) VALUES (100002, 2, '香蕉', 2, 6, 'Bob', '2018-12-9', '18:23:15');
INSERT INTO `storage`.`input` (`iid`, `id`, `name`, `count`, `price`, `manager`, `date`, `time`) VALUES (100003, 1, '牛奶', 4, 11, 'Bob', '2018-12-9', '18:23:16');
INSERT INTO `storage`.`input` (`iid`, `id`, `name`, `count`, `price`, `manager`, `date`, `time`) VALUES (100004, 1, '牛奶', 7, 12, 'Bob', '2018-12-9', '18:23:17');
INSERT INTO `storage`.`input` (`iid`, `id`, `name`, `count`, `price`, `manager`, `date`, `time`) VALUES (100005, 2, '香蕉', 44, 6, 'Alice', '2018-12-9', '18:23:18');
INSERT INTO `storage`.`input` (`iid`, `id`, `name`, `count`, `price`, `manager`, `date`, `time`) VALUES (100006, 3, '苹果', 11, 8, 'admin', '2018-12-9', '18:23:19');
INSERT INTO `storage`.`input` (`iid`, `id`, `name`, `count`, `price`, `manager`, `date`, `time`) VALUES (100007, 55, '笔袋', 35, 635, '小王', '2018-12-9', '18:23:30');
INSERT INTO `storage`.`input` (`iid`, `id`, `name`, `count`, `price`, `manager`, `date`, `time`) VALUES (100008, 76, '书包', 88, 123, '校长', '2018-12-9', '18:23:46');
INSERT INTO `storage`.`input` (`iid`, `id`, `name`, `count`, `price`, `manager`, `date`, `time`) VALUES (100009, 345, '电脑', 4999, 34, '陆开开', '2018-12-9', '18:23:48');
INSERT INTO `storage`.`input` (`iid`, `id`, `name`, `count`, `price`, `manager`, `date`, `time`) VALUES (100011, 222, '咖啡', 123, 12, 'Alice', '2018-12-9', '18:23:49');
INSERT INTO `storage`.`input` (`iid`, `id`, `name`, `count`, `price`, `manager`, `date`, `time`) VALUES (100012, 80, '铅笔', 444, 12, 'Candy', '2018-12-9', '18:23:55');

COMMIT;


-- -----------------------------------------------------
-- Data for table `storage`.`output`
-- -----------------------------------------------------
START TRANSACTION;
USE `storage`;
INSERT INTO `storage`.`output` (`oid`, `id`, `name`, `count`, `price`, `manager`, `date`, `time`) VALUES (100001, 3, '苹果', 10, 7, '郑子铭', '2018-12-9', '18:23:14');
INSERT INTO `storage`.`output` (`oid`, `id`, `name`, `count`, `price`, `manager`, `date`, `time`) VALUES (100002, 2, '香蕉', 2, 6, 'Bob', '2018-12-9', '18:23:15');
INSERT INTO `storage`.`output` (`oid`, `id`, `name`, `count`, `price`, `manager`, `date`, `time`) VALUES (100003, 1, '牛奶', 4, 11, 'Bob', '2018-12-9', '18:23:16');
INSERT INTO `storage`.`output` (`oid`, `id`, `name`, `count`, `price`, `manager`, `date`, `time`) VALUES (100004, 1, '牛奶', 7, 12, 'Bob', '2018-12-9', '18:23:17');
INSERT INTO `storage`.`output` (`oid`, `id`, `name`, `count`, `price`, `manager`, `date`, `time`) VALUES (100005, 2, '香蕉', 44, 6, 'Alice', '2018-12-9', '18:23:18');
INSERT INTO `storage`.`output` (`oid`, `id`, `name`, `count`, `price`, `manager`, `date`, `time`) VALUES (100006, 3, '苹果', 11, 8, 'admin', '2018-12-9', '18:23:19');
INSERT INTO `storage`.`output` (`oid`, `id`, `name`, `count`, `price`, `manager`, `date`, `time`) VALUES (100007, 55, '笔袋', 35, 635, '小王', '2018-12-9', '18:23:30');
INSERT INTO `storage`.`output` (`oid`, `id`, `name`, `count`, `price`, `manager`, `date`, `time`) VALUES (100008, 76, '书包', 88, 123, '校长', '2018-12-9', '18:23:46');
INSERT INTO `storage`.`output` (`oid`, `id`, `name`, `count`, `price`, `manager`, `date`, `time`) VALUES (100009, 345, '电脑', 4999, 34, '陆开开', '2018-12-9', '18:23:48');
INSERT INTO `storage`.`output` (`oid`, `id`, `name`, `count`, `price`, `manager`, `date`, `time`) VALUES (100011, 222, '咖啡', 123, 12, 'Alice', '2018-12-9', '18:23:49');
INSERT INTO `storage`.`output` (`oid`, `id`, `name`, `count`, `price`, `manager`, `date`, `time`) VALUES (100012, 80, '铅笔', 444, 12, 'Candy', '2018-12-9', '18:23:55');

COMMIT;


-- -----------------------------------------------------
-- Data for table `storage`.`user`
-- -----------------------------------------------------
START TRANSACTION;
USE `storage`;
INSERT INTO `storage`.`user` (`manager`, `passwd`) VALUES ('admin', 'admin');

COMMIT;

-- -----------------------------------------------------
-- Data for table `storage`.`goods`
-- -----------------------------------------------------
START TRANSACTION;
USE `storage`;
INSERT INTO `storage`.`goods` (`id`, `name`) VALUES (3, '苹果');
INSERT INTO `storage`.`goods` (`id`, `name`) VALUES (2, '香蕉');
INSERT INTO `storage`.`goods` (`id`, `name`) VALUES (1, '牛奶');
INSERT INTO `storage`.`goods` (`id`, `name`) VALUES (55, '笔袋');
INSERT INTO `storage`.`goods` (`id`, `name`) VALUES (76, '书包');
INSERT INTO `storage`.`goods` (`id`, `name`) VALUES (345, '电脑');
INSERT INTO `storage`.`goods` (`id`, `name`) VALUES (222, '咖啡');
INSERT INTO `storage`.`goods` (`id`, `name`) VALUES (80, '铅笔');

COMMIT;
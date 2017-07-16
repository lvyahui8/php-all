DROP TABLE IF EXISTS node1;
CREATE TABLE node1 (
  id INT AUTO_INCREMENT PRIMARY KEY ,
  name VARCHAR(12) NOT NULL,
  num INT NOT NULL DEFAULT 0 COMMENT '节点下叶子的数量、节点权重（可认为分类下产品数量）',
  p_id INT NOT NULL DEFAULT 0 COMMENT '0表示根节点'
);
DROP TABLE IF EXISTS node2;
CREATE TABLE node2 (
  id INT AUTO_INCREMENT PRIMARY KEY ,
  name VARCHAR(12) NOT NULL ,
  num INT NOT NULL DEFAULT 0 COMMENT '节点下叶子的数量、节点权重（可认为分类下产品数量）',
  p_id INT NOT NULL DEFAULT 0 COMMENT '0表示根节点',
  search_key VARCHAR(128)  DEFAULT '' COMMENT '用来快速搜索子孙的key，存储根节点到该节点的路径',
  level INT DEFAULT 0 COMMENT '层级'
);
DROP TABLE IF EXISTS node3;
CREATE TABLE node3 (
  id INT AUTO_INCREMENT PRIMARY KEY ,
  tree_id INT NOT NULL COMMENT '为保证对某一棵的操作不影响森林中的其他书',
  name VARCHAR(12) NOT NULL ,
  num INT NOT NULL DEFAULT 0 COMMENT '节点下叶子的数量、节点权重（可认为分类下产品数量）',
  lft INT NOT NULL ,
  rgt INT NOT NULL ,
  level INT DEFAULT 0
);

##########################################################################################
DELETE FROM node1;
INSERT INTO node1(id,name, num, p_id) VALUES
  (1,'A',10,0),
  (2,'B',7,1),
  (3,'C',3,1),
  (4,'D',1,3),
  (5,'E',2,3),
  (6,'F',2,0),
  (7,'G',2,6)
;
# 第一种方法优点是结构简单，更新简单，缺点是查询麻烦，特别是要查询子孙节点时，只能通过递归形式查询，效率极差


# 查询森林的根节点
SELECT * FROM node1 WHERE p_id=0;
# 查询节点下所有子孙节点 需要递归查询
# 更新某个节点的权值 需要递归查询出子孙节点累加

##########################################################################################
DELETE FROM node2;
INSERT INTO node2(id,name, num, p_id,search_key) VALUES
  (1,'A',10,0,'0-1'),
  (2,'B',7,1,'0-1-2'),
  (3,'C',3,1,'0-1-3'),
  (4,'D',1,3,'0-1-3-4'),
  (5,'E',2,3,'0-1-3-5'),
  (6,'F',2,0,'0-6'),
  (7,'G',2,6,'0-6-7');

# 第二种方式在仅仅添加了一个路径字段，使得查询变的简单，并且更新也容易，在节点深度有限的情况下，个人认为第二种方式是比较优的选择
# 查询森林的根节点
SELECT * FROM node2 WHERE p_id = 0 AND search_key LIKE '0-%' AND level = 0;

# 查询节点A下所有子孙节点 需要递归查询
# SELECT * FROM node2 WHERE search_key LIKE '{A.search_key}%';
SELECT * FROM node2 WHERE search_key LIKE '0-1-%';

# 更新某个节点的权值，只需要一次select与一次update操作
# 例如，更新节点C的权重
UPDATE node2,( SELECT sum(num) AS sum FROM node2 WHERE search_key LIKE '0-1-3-%') rt SET num = rt.sum WHERE id=3;

# 有节点权重累加时，将所有父辈权重再加1
# 只需要将该节点的search_key以'-' 切分，得到的就是所有父辈的id（0除外）
# 例如，将节点D的权重+1，这里使用where locate，实际更好是先将search_key split之后使用where in查询
UPDATE node2,(SELECT search_key FROM node2 WHERE id = 4) rt SET num=num+1 WHERE locate(id,rt.search_key);

# 删除某个节点，比如删除B节点
# 假设删除节点子孙全部清理

DELETE FROM node2 WHERE search_key LIKE '0-1-2%';

# 假设子节点不清除
# 将子孙节点挂到父辈节点下，更新儿子节点的search_key、p_id、level字段
# UPDATE node2, SET p_id = {B.p_id}
UPDATE node2 SET p_id = 1 AND search_key = concat('0-1-',id);
# 删除
DELETE FROM node2 WHERE id=2;

##########################################################################################

DELETE FROM node3;

insert into node3 (tree_id, name, num, lft, rgt, level) VALUE (1,'B',7,2,3,2);
insert into node3 (tree_id, name, num, lft, rgt, level) VALUE (1,'D',1,5,6,3);
insert into node3 (tree_id, name, num, lft, rgt, level) VALUE (1,'E',2,7,8,3);
insert into node3 (tree_id, name, num, lft, rgt, level) VALUE (1,'C',3,4,9,2);
insert into node3 (tree_id, name, num, lft, rgt, level) VALUE (1,'A',10,1,10,1);
insert into node3 (tree_id, name, num, lft, rgt, level) VALUE (2,'G',2,2,3,2);
insert into node3 (tree_id, name, num, lft, rgt, level) VALUE (2,'F',2,1,4,1);


DROP FUNCTION IF EXISTS insert_node;
CREATE FUNCTION insert_node(param_name VARCHAR(12),param_num INT,param_p_id INT,param_tree_id INT)
returns INT
BEGIN
  DECLARE p_lft INT;
  DECLARE p_rgt INT;
  DECLARE p_level INT;
  DECLARE ret INT;
  SELECT lft,rgt,level INTO p_lft,p_rgt,p_level FROM node3 WHERE tree_id = param_tree_id AND id=param_p_id ;
  UPDATE node3 SET lft = lft + 2 WHERE tree_id = param_tree_id AND lft > p_lft;
  # 按照先序遍历规则，在一个节点M下添加节点之后，节点M的右值必然也要加2
  UPDATE node3 SET rgt = rgt + 2 WHERE tree_id = param_tree_id AND rgt >= p_rgt;
  INSERT INTO node3 (tree_id,name, num, lft, rgt, level) VALUE (param_tree_id,param_name,param_num,p_lft + 1,p_rgt + 1,p_level + 1);
  SELECT LAST_INSERT_ID() INTO ret;
  RETURN ret;
END;

select insert_node(1,'M',7,1);

#### 这里先介绍几种简单的单元操作
-- append操作，待加入节点不带子节点
-- remove操作，待删除节点没有子节点
--  假如删除节点下有子节点，那还要考虑子节点怎么处理，是一并delete

####### 添加节点

DROP FUNCTION IF EXISTS append_node;
CREATE FUNCTION append_node(param_name VARCHAR(12), param_num INT, param_p_id INT, param_tree_id INT)
  returns INT
  BEGIN
    DECLARE p_lft INT;
    DECLARE p_rgt INT;
    DECLARE p_level INT;
    DECLARE ret INT;

    SELECT lft,rgt,level INTO p_lft,p_rgt,p_level FROM node3 WHERE tree_id = param_tree_id AND id=param_p_id ;
    # 比前一个节点左值大的需要加2
    UPDATE node3 SET lft = lft + 2 WHERE tree_id = param_tree_id AND lft > p_lft;
    # 按照先序遍历规则，在一个节点M下添加节点之后，节点M的右值必然也要加2
    UPDATE node3 SET rgt = rgt + 2 WHERE tree_id = param_tree_id AND rgt >= p_rgt;
    INSERT INTO node3 (tree_id,name, num, lft, rgt, level)
      VALUE (param_tree_id,param_name,param_num,p_lft + 1,p_rgt + 1,p_level + 1);
    SELECT LAST_INSERT_ID() INTO ret;
    RETURN ret;
  END;

# 在节点C下添加节点M，已知节点C的id为4，tree_id为1。
select append_node('M', 7, 4, 1);

######### 删除掉M节点 ，反向操作，进行-2操作，这里直接以待删除节点的数据来操作，那便是进行减1操作
DROP FUNCTION IF EXISTS remove_node;
create FUNCTION remove_node(param_id INT)
  RETURNS INT
  BEGIN

  END;

#### 更新节点（可以视为先delete节点，再讲节点挂到要挂在的位置）


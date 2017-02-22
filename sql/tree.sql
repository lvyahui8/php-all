CREATE TABLE node1 (
  id INT AUTO_INCREMENT PRIMARY KEY ,
  name VARCHAR(12) NOT NULL,
  num INT NOT NULL DEFAULT 0 COMMENT '节点下叶子的数量、节点权重（可认为分类下产品数量）',
  p_id INT NOT NULL DEFAULT 0 COMMENT '0表示根节点'
);
CREATE TABLE node2 (
  id INT AUTO_INCREMENT PRIMARY KEY ,
  name VARCHAR(12) NOT NULL ,
  num INT NOT NULL DEFAULT 0 COMMENT '节点下叶子的数量、节点权重（可认为分类下产品数量）',
  p_id INT NOT NULL DEFAULT 0 COMMENT '0表示根节点',
  search_key VARCHAR(128)  DEFAULT '' COMMENT '用来快速搜索子孙的key，存储根节点到该节点的路径',
  level INT DEFAULT 0 COMMENT '层级'
);
CREATE TABLE node3 (
  id INT AUTO_INCREMENT PRIMARY KEY ,
  name VARCHAR(12) NOT NULL ,
  num INT NOT NULL DEFAULT 0 COMMENT '节点下叶子的数量、节点权重（可认为分类下产品数量）',
  lft INT NOT NULL ,
  rgt INT NOT NULL ,
  level INT DEFAULT 0
);

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

# 查询森林的根节点
SELECT * FROM node1 WHERE p_id=0;
# 查询节点下所有子孙节点 需要递归查询

# 更新某个节点的权值 需要递归查询出子孙节点累加



DELETE FROM node2;
INSERT INTO node2(id,name, num, p_id,search_key) VALUES
  (1,'A',10,0,'0-1'),
  (2,'B',7,1,'0-1-2'),
  (3,'C',3,1,'0-1-3'),
  (4,'D',1,3,'0-1-3-4'),
  (5,'E',2,3,'0-1-3-5'),
  (6,'F',2,0,'0-6'),
  (7,'G',2,6,'0-6-7');

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

# 将子孙节点挂到父辈节点下，更新儿子节点的search_key、p_id、level字段
# UPDATE node2, SET p_id = {B.p_id}
UPDATE node2, SET p_id = 1
# 分两步，第一、把子节点挂到自己父节点下


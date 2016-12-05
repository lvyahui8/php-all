CREATE TABLE kl_product(
  id INT AUTO_INCREMENT PRIMARY KEY ,
  name VARCHAR(64) NOT NULL COMMENT '产品名称'
);

# 可以做成多级模块，这里先简单的做
CREATE TABLE kl_module(
  id INT AUTO_INCREMENT PRIMARY KEY ,
  product_id INT NOT NULL COMMENT '产品ID',
  name VARCHAR(64) NOT NULL COMMENT '模块名称',
  KEY fk_module_product_idx (product_id),
  CONSTRAINT fk_module_product_idx FOREIGN KEY (product_id) REFERENCES kl_product(id)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE kl_api(
  id INT AUTO_INCREMENT PRIMARY KEY ,
  module_id INT NOT NULL COMMENT '模块ID',
  name VARCHAR(64) NOT NULL COMMENT 'API名称',
  KEY fk_api_module_idx (module_id),
  CONSTRAINT fk_api_module_idx FOREIGN KEY (module_id) REFERENCES kl_module(id)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE kl_resp_type(
  id INT AUTO_INCREMENT PRIMARY KEY ,
  name  VARCHAR(64) NOT NULL DEFAULT 'text/html',
  UNIQUE KEY name (name)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE kl_param(
  id INT AUTO_INCREMENT PRIMARY KEY ,
  api_id  INT NOT NULL COMMENT 'API ID',
  name VARCHAR(32) NOT NULL COMMENT '参数',
  cn_name VARCHAR(64) NULL COMMENT '参数中文名',
  required BOOL NOT NULL DEFAULT FALSE ,
  type enum('number','string','date') NOT NULL DEFAULT 'string',
  resp_type_id INT NOT NULL,
  succes_resp TEXT NULL COMMENT '成功响应',
  error_resp  TEXT NULL  COMMENT '失败响应',
  KEY fk_param_api_idx (api_id),
  CONSTRAINT fk_param_api_idx FOREIGN KEY (api_id) REFERENCES kl_api(id),
  KEY fk_param_resp_type_idx (resp_type_id),
  CONSTRAINT fk_param_resp_type_idx FOREIGN KEY (resp_type_id) REFERENCES kl_resp_type(id)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
